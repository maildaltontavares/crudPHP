 <?php
 
  session_start();

  require_once '../config.php';
  require_once ROOT_PATH . '/controller/perfilCtr.php'; ;
  
   

  if(!isset($_SESSION['user'])):
    header('Location:login.php');  
  endif;  


  //include_once "menuPrincipal.php";
  //include_once "menu.php"; 
  
  include_once "menuNavCab.php";

  $Altera = "N"; 

  $id = 0;
  $nomePerfil = '';
   

  if (isset($_GET['Altera'])):
     $Altera = "S";

     
  /*
   echo '<div class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Modal body text goes here.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>';
 
    */ 
     $perfilCtr = new PerfilCtr();   
     $p_perfil = $perfilCtr->buscaPerfil($_GET['Id']);  

//     var_dump($_GET['Id']);

      if(!empty($p_perfil)): 
        $id = $p_perfil[0]['id'];  
        $nomePerfil = $p_perfil[0]['descricao'];    
        
      endif;  
  endif;

  $excluiu='N';
  if (isset($_POST['excluir'])): 
      $perfilCtr = new PerfilCtr(); 
          
      if ($perfilCtr->delete($_POST['Idx'])== 'OK'):  
         $excluiu = 'S';
         echo '<div class="alert alert-primary" role="alert"><li>' . "Registro excluido com sucesso!"  . '</li></div>';
      else:         
         echo '<div class="alert alert-primary" role="alert"><li>' . "Erro ao Excluir!"  . '</li></div>';
      endif; 

  endif;

  if (isset($_POST['gravar'])):
     

              $erros = array();

              $nomePerfil =  filter_input(INPUT_POST, 'nomePerfil',FILTER_SANITIZE_STRING); 
           
              if(!filter_var($nomePerfil,FILTER_SANITIZE_STRING)):
                     $erros[] = "Nome perfil inválido!";   
              elseif($nomePerfil==''):
                    $erros[] = "Nome perfil inválido!";                  
              endif;  

              if (empty($erros)):  // Nao tem erros de digitacao

                  $perfilCtr = new PerfilCtr();  
                  if ($Altera == "N"):

                      if ($perfilCtr->create($nomePerfil)== 'OK'):  
                          echo '<div class="alert alert-primary" role="alert"><li>' . "Registro inserido com sucesso"  . '</li></div>';  
                   
                          $_SESSION['gravou'] = "S";  
                      else:  
                          echo '<div class="alert alert-primary" role="alert"><li>' . "Perfil inválido!!"  . '</li></div>';                        
                          $_SESSION['gravou'] = "N";                  
                      endif;  

                  else:

                      if ($perfilCtr->update($id,$nomePerfil)== 'OK'):  
                          echo '<div class="alert alert-primary" role="alert"><li>' . "Registro alterado com sucesso"  . '</li></div>'; 
                                            
                          $_SESSION['gravou'] = "S"; 
                      else:  
                          echo '<div class="alert alert-primary" role="alert"><li>' . "Erro ao alterar!!!"  . '</li></div>';
                          $_SESSION['gravou'] = "N";                  
                      endif;  

                  endif;    

              else:

                  foreach ($erros as $erro):                 
                      echo '<div class="alert alert-primary" role="alert"><li>' . $erro  . '</li></div>';  
                  endforeach;  

              endif;
 

  endif; 


  ?>
 <script  src="https://code.jquery.com/jquery-3.5.1.js"  integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="  crossorigin="anonymous">
  
 </script>

<script type="text/javascript" src="func.js"></script>
 <button type="button" onclick="alo()" > Adicionar função</button>
   
 