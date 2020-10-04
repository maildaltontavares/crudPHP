 

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

  function buscarDado(numInput){  
    var par = $('#pesquisaCmp'+numInput).val();  
    load_dados(null, 'pesquisa.php?pesquisaCmp=%'+ par +'%', '#MostraPesq'+numInput);
  }

  function limpaTela(numInput){ 
    $('#pesquisaCmp'+numInput).val("");
    load_dados(null, 'limpaPesq.php', '#MostraPesq'+numInput); 
  }

  function gravaNum(numInput){  
       $('#func'+numInput).val($('#MostraPesq'+numInput + " input:checked").val());
       $('#desc'+numInput).val($('#MostraPesq'+numInput + " input:checked").attr('nome'));      
  }
