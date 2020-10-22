 

       //Aqui a ativa a imagem de load
  function loading_show(){
      $('#loading').html("<img src='img/edit.png'/>").fadeIn('fast');
  }
   
  //Aqui desativa a imagem de loading
  function loading_hide(){
      $('#loading').fadeOut('fast');
  }     
    
  function load_dados(valores, page, div){
                
        $.ajax
            ({
                type: 'POST',
                dataType: 'html',
                url: page,
                beforeSend: function(){//Chama o loading antes do carregamento
                      loading_show();
                },
                data: valores,
                success: function(msg){
                    loading_hide();
                    var data = msg;
                    $(div).html(data).fadeIn();             
                }
            });

  } 

  function loadDescricao(valores,page, pTxt){
                
        $.ajax
            ({
                type: 'POST',
                dataType: 'html',
                url: page,
                beforeSend: function(msg){//Chama o loading antes do carregamento
                     
                },
                data: valores,
                success: function(msg){ 
                    var data = msg; 
                    $(pTxt).val(data);             
                }
            });

  } 

  function buscarDescricao(numInput,page){   
     if($('#fItem'+numInput).val()!==""){
        var par = $('#fItem'+numInput).val();   
        loadDescricao(null, page + '.php?pesquisaCmp='+ par.toString(), '#desc'+numInput);
     }
  }  


  function buscarDado(numInput,page){   
     var par = $('#pesquisaCmp'+numInput).val();  
    load_dados(null, page+'.php?pesquisaCmp=%'+ par +'%', '#MostraPesq'+numInput);
  }

  function limpaTela(numInput){ 
    $('#pesquisaCmp'+numInput).val("");
    load_dados(null, 'limpaPesq.php', '#MostraPesq'+numInput); 
  }

  function excluirItem(numInput){   


     $('#fItem'+numInput).val("");  
     $('#desc'+numInput).val("");   
     
 
  } 

  function gravaNum(numInput){  
       $('#fItem'+numInput).val($('#MostraPesq'+numInput + " input:checked").val());
       $('#desc'+numInput).val($('#MostraPesq'+numInput + " input:checked").attr('nome'));

      var det = $('#detalhe').val();    
      if (typeof($('#MostraPesq'+numInput + " input:checked").attr('nome')) != "undefined") {      
         // $('#detalhe').val(det + '['  + numInput + ']' + $('#MostraPesq'+numInput + " input:checked").val()) ;       
      };

     

  } 


   function montaItens(){  

    var vItens='';  
    var vDescItens=''; 
    var nCampos='';
    var nCamposInvalidos='';

    $('#detalhe').val('');
    $('#numCampos').val('');


    // monta os itens que não devrão ser gravados pois não tem a descricao preenchida

    $(".descItem").each(function() {

        var vDesc = '*' + $( this ).val() + '*';   
         if ($( this ).val().length <= 1  ) {             
            $('#fItem' + $(this).attr('descUnica') ).val("");
         };            
    });

   $( ".idItem" ).each(function() {

        var vVal = '*' + $( this ).val() + '*'; 
        if ($( this ).val().length > 0 ) {  
             if (vItens.indexOf(vVal) == -1){
                 vItens = vItens + vVal  + ';'; 
                 nCampos = nCampos + $(this).attr('idUnico') + '*;*'; 
             };
         };  
       

    });
    $('#detalhe').val(vItens); 
    $('#numCampos').val(nCampos);  
 

  }  

 
  function novoItem(p_id,p_descricao, p_descSelecione, p_descPlacHld,pageDesc,pageDiv){ 

      numCampo++;   
 
       /*Excluir Item*/
       var txtExcluir = ' <button type="button" id="btExcluirItem' + numCampo.toString() + '" class=" btExcIt  " data-toggle="modal" ' +
              ' data-target="#excluirItem' + numCampo.toString() + '" > ' +
              '  <img src="delete.png"width="20" height="20" placeholder="Excluir" /> ' + 
              '</button> ' +
              '   <!-- Modal --> ' +
                 '<div class="modal fade" id="excluirItem' + numCampo.toString() + '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">'+
                    '<div class="modal-dialog">' +
                      '<div class="modal-content">' +
                        '<div class="modal-header">' +
                          '<h5 class="modal-title" id="exampleModalLabel">Excluir</h5>' +
                          '<button type="button" class="close" data-dismiss="modal" aria-label="Close">' +
                            '<span aria-hidden="true">&times;</span>' +
                          '</button>' +
                        '</div>' +
                        '<div class="modal-body">' +
                          'Confirma exclusão? '+
                        '</div>' +
                        '<div class="modal-footer">' +
                          '<button type="button" class="btn btn-secondary" data-dismiss="modal" >Cancelar</button>' + 

                          '<button type="button" class="btn btn-primary" data-dismiss="modal" name="confirmar" onclick="excluirItem(\''+ numCampo.toString() + '\')" >Confirmar</button>'+  
                        '</div>' +
                      '</div>' +
                    '</div>' +
                 ' </div> '; 

       var TxtBtTxt = '<div class="form-row"   >'+  txtExcluir 
       +
      '<div class="form-inline "  >' +

        /*campo com código do item*/
        '<input type="number" name= "fItem' + numCampo.toString() + '" idUnico=' + numCampo.toString() + '  id= "fItem' + numCampo.toString() + '" class="form-control btPesq idItem"  onfocusout="buscarDescricao(\''+ numCampo.toString() + '\',\'' + pageDesc +   '\')" value="' + p_id + '">' +
      

      '</div>'+

      /*Botão de lupa para abrir o Pop-up*/
       '<button type="button" class="btn btn-primary btPesq" data-toggle="modal" data-target=".bd-example-modal-lg' + numCampo.toString() + '" onclick="limpaTela(\''+ numCampo.toString() + '\')" id= "funcao' + numCampo.toString() + '"  ><img src="pesquisar.png"width="15" height="15" placeholder="Excluir" /></button></br> '   +
     
      /*Descrição do Item */
      '<div class="col-md-5"  >'+
        '<input class="form-control descItem " type="text" id="desc' + numCampo.toString() + '" descUnica=' + numCampo.toString() +  ' value="' + p_descricao + '" disabled>'+ 
      '</div>'
      ;
 
 

      var pesq = TxtBtTxt +  
                '<div class="modal fade bd-example-modal-lg' + numCampo.toString() + '" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">'+
                   '<div class="modal-dialog modal-lg">'+
                       '<div class="modal-content"><div class="modal-header">'+
                           '<h5 class="modal-title" id="exampleModalLabel">' + p_descSelecione +  ' </h5>'+
                           '<button type="button" class="close" data-dismiss="modal" aria-label="Close">'+
                           '<span aria-hidden="true">&times;</span></button>'+
                       '</div>'+
                       '<div class="modal-body">'+  

                                      /*Form de Pesquisa do Pop-up*/
                                      '<form name="form_pesquisa" id="form_pesquisa" method="post" action=""> '+ 
                                          '<fieldset> ' +
                                              ' <legend>Digite a descrição a pesquisar</legend> ' +
                                                  ' <div class="input-prepend"> ' +
                                                      ' <span class="add-on"><i class="icon-search"></i></span> ' +

                                                       '<div class="form-row">'+
                                                             '<div class="form-group col-md-10">'+
                                                                  
                                                                  /*Campo de pesquisa do pop-up*/

                                                                 ' <input type="text" class="form-control" name="pesquisaCmp' + numCampo.toString() + '" id="pesquisaCmp' + numCampo.toString() + '" value=""  ' +
                                                                 'tabindex="1" placeholder="' + p_descPlacHld +  '" /> ' +
                                                             '</div>'+
                                                       '</div>'+  
                                                      
                                                   '</div> ' +


                                                  /* Botao Pesquisa pop-up*/
                                                   '<div class="form-group col-md-2">'+
                                                   '      <button type="button" class="btn btn-primary" onclick="buscarDado(\''+ numCampo.toString() + '\',\'' + pageDiv + '\')" id="busca"  >Pesquisar</button>'+
                                                   '</div>'+                                                    
                                          '</fieldset>'+
                                      '</form>' + 


                                      /*Botoes do rodape do pop-up*/
                                      '<div id="contentLoading"> ' +
                                          '<div id="loading"></div> '+
                                      '</div> '+
                                      '<section class="jumbotron"> '+
                                          ' <div class ="MostraPesq" id="MostraPesq' + numCampo.toString() + '" ></div>'+
                                      '</section> '+ 
                       '</div>'+
                       '<div class="modal-footer">'+
                      '       <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>'+
                            '<button type="button" class="btn btn-primary" data-dismiss="modal" name="confirmar" onclick="gravaNum(\''+ numCampo.toString() + '\')" >Confirmar</button>'+
  
                      ' </div>'+
                   '</div>'+                 
                '</div>'+ 
            '</div>'+             
        '</div>'+
  '</div><hr/>' ;
  
    $(".nItem").append(pesq); 
     
    }        
