<?php
 
  session_start();

  require_once '../config.php';
  require_once ROOT_PATH . '/controller/tabpadCtr.php';
  require_once ROOT_PATH . '/controller/filialCtr.php';  
  require_once ROOT_PATH . '/controller/grupoEmpresaCtr.php';  
  require_once ROOT_PATH . '/bibliotecas/funcoes.php';  
  
  if(!isset($_SESSION['user'])):
    header('Location:login.php');  
  endif;  

  //include_once "menuPrincipal.php";
  //include_once "menu.php"; 

  // Valida os acessos
  $acesso = new Funcao();
  $validaAcesso = $acesso->validaAcesso('00012');
 //var_dump($acesso->validaAcesso('00001'));
  if (strlen($validaAcesso)==0): 
     header('Location:semAcesso.php?tela="Filial"'); 
     //exit; 
  endif;


  //include_once "menuPrincipal.php";
  //include_once "menu.php";   

  include_once "menuNavCab.php";
  $Altera = "N"; 

  $id = 0;
  $filial = '';
  $gravou = 'N'; // nova fucao seguranca

  if (isset($_GET['Altera'])):
     $Altera = "S";
     
     $filialCtr = new FilialCtr();   
     $p_filial = $filialCtr->buscaFilial($_GET['Id']);  

     //var_dump($p_filial);

      if(!empty($p_filial)):

        $id = $p_filial[0]['id'];  
        $filial = $p_filial[0]['descricao']; 
        $idGrupo = $p_filial[0]['idgrupo']; 
 
      endif; 
  endif;

  $excluiu='N';
  if (isset($_POST['excluir'])): 
      $filialCtr = new FilialCtr(); 
          
      if ($filialCtr->delete($_POST['Idx'])== 'OK'):   
         $excluiu = 'S';
         echo '<div class="alert alert-primary" role="alert"><li>' . "Registro excluido com sucesso!"  . '</li></div>';
      else:         
         echo '<div class="alert alert-primary" role="alert"><li>' . "Erro ao Excluir!"  . '</li></div>';
      endif; 

  endif;

  if (isset($_POST['gravar'])):
     

              $erros = array();              

              $filial =  filter_input(INPUT_POST, 'filial',FILTER_SANITIZE_STRING); 
           
              if(!filter_var($filial,FILTER_SANITIZE_STRING)):
                     $erros[] = "Descrição inválida!";   
              elseif($filial==''):
                    $erros[] = "Descrição inválida!";                  
              endif;    

               $idGrupo =  $_POST['grupoEmpresa'];  


              if (empty($erros)):  // Nao tem erros de digitacao

                  $filialCtr = new FilialCtr();  
                  if ($Altera == "N"): 

                      if ($filialCtr->create($filial,$idGrupo)== 'OK'):  
                          echo '<div class="alert alert-primary" role="alert"><li>' . "Registro inserido com sucesso"  . '</li></div>';  
                   
                          $gravou = "S";  
                         

                      else:  
                          echo '<div class="alert alert-primary" role="alert"><li>' . "Registro não gravado!!"  . '</li></div>';                        
                          $gravou = "N";                  
                      endif;  

                  else:

                      if ($filialCtr->update($id,$filial,$idGrupo)== 'OK'):  
                          echo '<div class="alert alert-primary" role="alert"><li>' . "Registro alterado com sucesso"  . '</li></div>'; 
                                            
                          $gravou = "S";  
                          
                      else:  
                          echo '<div class="alert alert-primary" role="alert"><li>' . "Erro ao alterar!!!"  . '</li></div>';
                          $gravou = "N";                  
                      endif;  

                  endif;    

              else:

                  foreach ($erros as $erro):                 
                      echo '<div class="alert alert-primary" role="alert"><li>' . $erro  . '</li></div>';  
                  endforeach;  

              endif; 
 

  endif; 


  ?>

 <script  src="https://code.jquery.com/jquery-3.5.1.js"  integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="  crossorigin="anonymous"></script>

 

 <link rel="stylesheet" type="text/css" href="estiloVirtuax.css">



<form method="POST" > 
  <div class="limiteTela" >
  <!--<div class="container" >  -->
    
    <div id='modelo'>
        <div class="cabecalho">
            <h1 class="p-3 mb-2  text-dark cTitulo">Filiais</h1>
            <div id="grupoBotoes">  
              <?php



                     $acesso->configura_botoes($validaAcesso,'filialCad','lista_filial',$excluiu,$Altera,$id,$gravou);
               ?>
            </div> 

        </div> 
    </div>
 
    <div class="form-row">  

        <div class="form-group col-md-8">
          <label for="filial">Descrição</label> 

          <input id="filial" name ="filial" type="text" class="form-control"   value="<?php  echo $filial;  ?>"       >          

        </div> 


    </div>  
    <div class="form-row"> 
        <div class="form-group col-md-8">
            <label for="selecioneFilial">Grupo Empresarial</label>  
            <select class="form-control" id="selecioneFilial" name="grupoEmpresa" >  
            <?php 

                $grupoEmpresa = new GrupoEmpresaCtr();               
                $aGrupoEmp = $grupoEmpresa->lerTodas();

                //var_dump($aTab) ;
  
                foreach($aGrupoEmp as $p_grupoEmpresa):

                    if ($p_grupoEmpresa['id'] ==  $idGrupo ):
                      echo ' <option value=' . $p_grupoEmpresa['id']  . ' selected >' . $p_grupoEmpresa['descricao']  .'</option>';  
                    else:  
                      echo ' <option value=' . $p_grupoEmpresa['id']  . ' >' . $p_grupoEmpresa['descricao']  .'</option>';  
                    endif;  

                endforeach;
  
            ?>       
            </select> 
        </div>  
    </div>          
 
     

  </div> 

<?php

  //include_once "footer.php";
  include_once "menuNavRodape.php";
?>    
</form>

