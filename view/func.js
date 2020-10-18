 

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

  function buscarDescricao(numInput){  
     if($('#func'+numInput).val()!==""){
        var par = $('#func'+numInput).val();   
        loadDescricao(null, 'pesquisaDescFuncSys.php?pesquisaCmp='+ par.toString(), '#desc'+numInput);
     }
  }  


  function buscarDado(numInput){  
    var par = $('#pesquisaCmp'+numInput).val();  
    load_dados(null, 'pesquisa.php?pesquisaCmp=%'+ par +'%', '#MostraPesq'+numInput);
  }

  function limpaTela(numInput){ 
    $('#pesquisaCmp'+numInput).val("");
    load_dados(null, 'limpaPesq.php', '#MostraPesq'+numInput); 
  }

  function excluirItem(numInput){   


     $('#func'+numInput).val("");  
     $('#desc'+numInput).val("");  
     /*
     $('#func'+numInput).remove(); 
     $('#funcao'+numInput).remove(); 
     $('#desc'+numInput).remove(); 
     $('#btExcluirItem'+numInput).remove();
     $('#idClasseFuncIL'+numInput).remove();
     $('#idClasseFuncMd'+numInput).remove();
     */
      
     /*$('#idClasseFunc'+numInput).removeClass(); */
     
 
  } 

  function gravaNum(numInput){  
       $('#func'+numInput).val($('#MostraPesq'+numInput + " input:checked").val());
       $('#desc'+numInput).val($('#MostraPesq'+numInput + " input:checked").attr('nome'));

      var det = $('#detalhe').val();    
      if (typeof($('#MostraPesq'+numInput + " input:checked").attr('nome')) != "undefined") {      
         // $('#detalhe').val(det + '['  + numInput + ']' + $('#MostraPesq'+numInput + " input:checked").val()) ;       
      };

     

  }
