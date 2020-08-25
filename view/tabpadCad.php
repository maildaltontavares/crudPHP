<?php
 
  session_start();

  require_once '../config.php';
  require_once ROOT_PATH . '/controller/tabpadCtr.php'; ;
  

  if(!isset($_SESSION['user'])):
    header('Location:login.php');  
  endif;  


  include_once "menuPrincipal.php";
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
                     $erros[] = "Nome grupo de Tabela inválido!";   
              elseif($nometabpad==''):
                    $erros[] = "Nome grupo de Tabela inválido!";                  
              endif;   


              $sigla =  filter_input(INPUT_POST, 'sigla',FILTER_SANITIZE_STRING); 
           
              if(!filter_var($sigla,FILTER_SANITIZE_STRING)):
                  $erros[] = "Sigla inválida!";          
              elseif($sigla==''):
                  $erros[] = "Sigla inválida!";                             
              endif; 



              if (empty($erros)):  // Nao tem erros de digitacao

                  $tabpadCtr = new tabpadCtr();  
                  if ($Altera == "N"):

                      if ($tabpadCtr->create($nometabpad,$sigla)== 'OK'):  
                          echo '<div class="alert alert-primary" role="alert"><li>' . "Registro inserido com sucesso"  . '</li></div>';  
                   
                          $_SESSION['gravou'] = "S";  
                      else:  
                          echo '<div class="alert alert-primary" role="alert"><li>' . "Grupo inválido!!"  . '</li></div>';                        
                          $_SESSION['gravou'] = "N";                  
                      endif;  

                  else:

                      if ($tabpadCtr->update($id,$nometabpad,$sigla)== 'OK'):  
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

 <script  src="https://code.jquery.com/jquery-3.5.1.js"  integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="  crossorigin="anonymous"></script>

<script>  

  $(document).ready(function(){  
          
          var vGrava    = "<?=((isset($_POST['gravar']))?"S":"N");?>";  
          var vCommit   = "<?=((isset($_SESSION['gravou']))?"S":"N");?>";
          var vAlterac  = "<?=((isset($_GET['Altera']   ))?"S":"N");?>";  

          if(vCommit=="S") {      
               vCommit = "<?=$_SESSION['gravou']?>";
          }  

          if(vGrava=="S"){    

               <?php $_SESSION['gravou'] = "N";?>

               if(vCommit=="S"){
                  //alert('Registro gravado com sucesso!');
                  $('#btGravar').attr('disabled', true); 

                  if(vAlterac=="S"){
                    $('#btGravar').attr('disabled', false);
                  }  
               }  
          }  

 })
</script> 

 <link rel="stylesheet" type="text/css" href="estiloVirtuax.css">



<form method="POST" > 
  <div class = 'container'>
    
    <div id='modelo'>
        <div class="cabecalho">
            <h1 class="p-3 mb-2  text-dark cTitulo">Grupos de Tabelas</h1>
            <div id="grupoBotoes">
               <a href="tabpadCad.php" class="btn btn-primary paramBt">Novo</a>                       
               <button type="submit" name= "gravar" class="btn btn-primary paramBt" id="btGravar">Gravar</button>
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

