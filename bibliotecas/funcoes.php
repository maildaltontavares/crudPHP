<?php
 
	
	class Funcao{ 
 
		 public function validaAcesso($p_funcao){ 
                  $aAcesso = "";
                  $z=0;                  

                  //echo '</br>';
                  //echo '</br>';
                  //echo '</br>';
                  //echo '</br>';
                  //echo '</br>';echo '</br>';
                  //echo '</br>';


                  for($i=0;$i<count($_SESSION['perfil']);$i++)
                    { 
                       if ($_SESSION['perfil'][$i]['sigla']==$p_funcao):
	                          //var_dump($_SESSION['perfil'][$i]['nome_botao']);   
		                      if ($z!=0):
		                          $aAcesso = $aAcesso . '|';
		                      endif;
		                      $aAcesso = $aAcesso . implode("|", $_SESSION['perfil'][$i]);
		                      $z = $z + 1;                       
	                   endif;   

                    }   
                    return   $aAcesso;  
                    var_dump($aAcesso);  

		 }  



     public function configura_botoes($p_validaAcesso,$p_cad,$p_lista,$p_excluiu,$p_Altera,$p_id,$p_gravou){ 
                  

              $vBtNovo    = strpos($p_validaAcesso,"btNovo");
              $vBtExcluir = strpos($p_validaAcesso,"btExcluir");
              $vBtGravar  = strpos($p_validaAcesso,"btGravar");  
              
              if($vBtNovo>=0  and $vBtNovo!=false): 
                   Echo 
                   '<a class="btn btn-primary  paramBtListagem" href="' . $p_cad . '.php?novo=S" role="button" id="btNovo" >Novo</a> ';

              else:
                   Echo 
                   '<a class="btn btn-primary  paramBtListagem disabled" href="' . $p_cad . '.php?novo=S" role="button" id="btNovo"  >Novo</a> ';

              endif;

              if($vBtGravar>=0 and $vBtGravar!=false):
                  if($p_excluiu=='S'):
                     Echo ' 
                      <button type="submit" name= "gravar" class="btn btn-primary paramBt" id="btGravar" disabled >Gravar</button>';
                  else:
                      if($p_Altera == "S"):  
                            Echo ' 
                                     <button type="submit" name= "gravar" class="btn btn-primary paramBt" id="btGravar">Gravar</button>'; 
                      else: // Inclusão

                         //if ($gravou)=='S'):
                        if ($p_gravou == "S"):
                             if($p_Altera == "S"):
                                 Echo ' 
                                  <button type="submit" name= "gravar" class="btn btn-primary paramBt" id="btGravar"   >Gravar</button>';
                             else:
                                 Echo ' 
                                  <button type="submit" name= "gravar" class="btn btn-primary paramBt" id="btGravar" disabled >Gravar</button>';                             
                             endif;      
                         else:
                              Echo ' 
                             <button type="submit" name= "gravar" class="btn btn-primary paramBt" id="btGravar">Gravar</button>';
                         endif;   
                      endif;
                  endif;   
              else:
                     Echo ' 
                      <button type="submit" name= "gravar" class="btn btn-primary paramBt" id="btGravar" disabled >Gravar</button>';
              endif; 

              if($vBtExcluir>=0 and $vBtExcluir!=false):   
                   if(isset($_GET['novo'])):   
                       if ($_GET['novo']!='S'):
                             Echo '
                                   <!-- Button trigger modal -->
                                   <button type="button" id="btExcluir" class="btn btn-primary paramBt" data-toggle="modal" data-target="#exampleModal"  disabled>
                                   Excluir
                                  </button> ';
                       endif;
                   
                   else:
                       if($p_excluiu=='S'):
                              Echo '
                                   <!-- Button trigger modal -->
                                   <button type="button" id="btExcluir" class="btn btn-primary paramBt" data-toggle="modal" data-target="#exampleModal" disabled>
                                   Excluir
                                  </button> ';

                       else:
                              Echo '
                                   <!-- Button trigger modal -->
                                   <button type="button" id="btExcluir" class="btn btn-primary paramBt" data-toggle="modal" data-target="#exampleModal" >
                                   Excluir
                                  </button> ';
                       endif;           
                   endif; 
                           
               endif;

              echo '
                  <!-- Modal -->
                  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Exclusão</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          Confirma ?
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                          <form >
                                  <input type="hidden"  name="Idx" value= ' .   $p_id    . '>
                                  <button type="submit" class="btn btn-primary"  name="excluir" >Confirmar</button> 
                          </form>
                        </div>
                      </div>
                    </div>
                  </div> 

               <a href="'. $p_lista .'.php" class="btn btn-primary  paramBt">Pesquisar</a> ';
 



         return true;


     }  

 
	}



?>
 