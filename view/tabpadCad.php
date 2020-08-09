<?php
 
  session_start();

  require_once '../config.php';
  require_once ROOT_PATH . '/controller/tabpadCtr.php'; ;
  

  if(!isset($_SESSION['user'])):
    header('Location:login.php');  
  endif;  


  include "menuHome.php";
  include_once "menu.php"; 

  $Altera = "N"; 

  $id = 0;
  $nometabpad = '';
  $sigla  = '';

  if (isset($_GET['Altera'])):
     $Altera = "S";
     
     $tabpadCtr = new tabpadCtr();   
     $p_tabpad = $tabpadCtr->buscatabpad($_GET['Id']);  

     //var_dump($p_tabpad);

      if(!empty($p_tabpad)): 
        $id = $p_tabpad[0]['id'];  
        $nometabpad = $p_tabpad[0]['descricao'];    
        $sigla = $p_tabpad[0]['sigla'];    
      endif;  
  endif;



  if (isset($_POST['gravar'])):
     

              $erros = array();

              $nometabpad =  filter_input(INPUT_POST, 'nometabpad',FILTER_SANITIZE_STRING); 
           
              if(!filter_var($nometabpad,FILTER_SANITIZE_STRING)):
                  $erros[] = "Grupo de Tabela inválido!";              
              endif;    

              $sigla =  filter_input(INPUT_POST, 'sigla',FILTER_SANITIZE_STRING); 
           
              if(!filter_var($sigla,FILTER_SANITIZE_STRING)):
                  $erros[] = "Sigla inválida!";              
              endif; 



              if (empty($erros)):  // Nao tem erros de digitacao

                  $tabpadCtr = new tabpadCtr();  
                  if ($Altera == "N"):

                      if ($tabpadCtr->create($nometabpad,$sigla)== 'OK'):  
                          echo '<div class="alert alert-primary" role="alert"><li>' . "Registro inserido com sucesso"  . '</li></div>';  
                   
                          //header('Location:principal.php');   
                      else:  
                          echo '<div class="alert alert-primary" role="alert"><li>' . "Grupo inválido!!"  . '</li></div>';                  
                      endif;  

                  else:

                      if ($tabpadCtr->update($id,$nometabpad,$sigla)== 'OK'):  
                          echo '<div class="alert alert-primary" role="alert"><li>' . "Registro alterado com sucesso"  . '</li></div>'; 
                                            
                          //header('Location:principal.php');   
                      else:  
                          echo '<div class="alert alert-primary" role="alert"><li>' . "Erro ao alterar!!!"  . '</li></div>';                  
                      endif;  

                  endif;    

              else:

                  foreach ($erros as $erro):                 
                      echo '<div class="alert alert-primary" role="alert"><li>' . $erro  . '</li></div>';  
                  endforeach;  

              endif;
 

  endif; 


  ?>
 
 <link rel="stylesheet" type="text/css" href="estiloVirtuax.css">



<form method="POST" > 
  <div class = 'container'>
    
    <div id='modelo'>
        <div class="cabecalho">
            <h1 class="p-3 mb-2  text-dark cTitulo">Grupos de Tabelas</h1>
            <div id="grupoBotoes">
               <a href="tabpadCad.php" class="btn btn-primary paramBt">Novo</a>                       
               <button type="submit" name= "gravar" class="btn btn-primary paramBt">Gravar</button>
               <a href="lista_tp.php" class="btn btn-primary  paramBt">Voltar</a> 
            </div> 

        </div> 
    </div>
 
    <div class="form-row"> 

        <div class="form-group col-md-8">
          <label for="tabpad">Nome Grupo Tabela</label> 

          <input id="tabpad" name ="nometabpad" type="text" class="form-control"   value="<?php  echo $nometabpad;  ?>"       >

        </div>
    </div>  

    <div class="form-row"> 

        <div class="form-group col-md-8">
          <label for="sigla">Sigla</label> 

          <input id="sigla" name ="sigla" type="text" class="form-control"   value="<?php  echo $sigla;  ?>"       >

        </div>
    </div>      


  </div> 
</form>

