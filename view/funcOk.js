<script type="text/javascript">
 

    function novaFuncao(){ 

      var pesq = '<div class="form-row">'+
        '<div class="form-group col-md-8">'+               
                '<input type="text" class="form-control" >' +  
                '<button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg"  >...</button></br> '+
                '<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">'+
                   '<div class="modal-dialog modal-lg">'+
                       '<div class="modal-content"><div class="modal-header">'+
                           '<h5 class="modal-title" id="exampleModalLabel">Selecione a Função</h5>'+
                           '<button type="button" class="close" data-dismiss="modal" aria-label="Close">'+
                           '<span aria-hidden="true">&times;</span></button>'+
                       '</div>'+
                       '<div class="modal-body">'+  
                                      '<form name="form_pesquisa" id="form_pesquisa" method="post" action=""> '+ 
                                          '<fieldset> ' +
                                              ' <legend>Digite o nome a pesquisar</legend> ' +
                                                  ' <div class="input-prepend"> ' +
                                                      ' <span class="add-on"><i class="icon-search"></i></span> ' +

                                                       '<div class="form-row">'+
                                                             '<div class="form-group col-md-10">'+
                                                                 ' <input type="text" class="form-control" name="pesquisaCliente" id="pesquisaCliente" value=""  ' +
                                                                 'tabindex="1" placeholder="Descrição da Função" /> ' +
                                                             '</div>'+
                                                       '</div>'+  
                                                      
                                                   '</div> ' +

                                                   '<div class="form-group col-md-2">'+
                                                   '      <button type="button" class="btn btn-primary"  id="busca"  >Pesquisar</button>'+
                                                   '</div>'+                                                    
                                          '</fieldset>'+
                                      '</form>' + 
                                      '<div id="contentLoading"> ' +
                                          '<div id="loading"></div> '+
                                      '</div> '+
                                      '<section class="jumbotron"> '+
                                          ' <div id="MostraPesq"></div>'+
                                      '</section> '+ 
                       '</div>'+
                       '<div class="modal-footer">'+
                      '       <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>'+
                            '<button type="button" class="btn btn-primary" data-dismiss="modal" name="excluir" >Confirmar</button>'+
                      ' </div>'+
                   '</div>'+                 
                '</div>'+ 
            '</div>'+             
        '</div>'+
  '</div>' ;
  
      $(".nFuncao").append(pesq); 
    }        



    </script>