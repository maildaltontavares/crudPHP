<?php
 
  session_start();

  require_once '../config.php';
  require_once ROOT_PATH . '/controller/tabelaCtr.php'; 
  require_once ROOT_PATH . '/controller/tabpadCtr.php';  
  

  if(!isset($_SESSION['user'])):
    header('Location:login.php');  
  endif;  


  include_once "menu.php"; 

  $Altera = "N"; 

  $id = 0;
  $id_tp = 0;
  $str1 = '';
  $str2 = '';
  $str3 = '';
  $flag1 = '';
  $flag2 = '';
  $flag3 = '';
  $num1 = '';
  $num2 = '';
  $num3 = '';
  $data1='';
  $data2='';
  $data3='';


  if (isset($_GET['Altera'])):
     $Altera = "S";
     

     //var_dump($_GET['Id']);

     $tabelaCtr = new TabelaCtr();   
     $p_tabela = $tabelaCtr->buscaTabela($_GET['Id']);   
     
     //var_dump($p_tabela);


      if(!empty($p_tabela)): 
        $id         = $p_tabela[0]['id'];  
        $id_tp      = $p_tabela[0]['id_tp'];  
        $str1       = $p_tabela[0]['str1'];  
        $str2       = $p_tabela[0]['str2'];  
        $str3       = $p_tabela[0]['str3'];  
        $flag1      = $p_tabela[0]['flag1'];  
        $flag2      = $p_tabela[0]['flag2'];  
        $flag3      = $p_tabela[0]['flag3'];  
        $num1       = $p_tabela[0]['num1'];  
        $num2       = $p_tabela[0]['num2'];   
        $num3       = $p_tabela[0]['num3'];  
        $data1      = $p_tabela[0]['data1'];  
        $data2      = $p_tabela[0]['data2'];  
        $data3      = $p_tabela[0]['data3'];  
      endif;  
  endif; 

   //var_dump($id);

  if (isset($_POST['gravar'])):
      
              if(isset($_POST['grupoTab'])):                
                $id_tp = $_POST['grupoTab'];
                 $id_tp = (INT)$id_tp;
              endif; 

              $erros = array(); 

              if(isset($_POST['str1']) and !EMPTY($_POST['str1'])):            
                  $str1 = filter_input(INPUT_POST, 'str1',FILTER_SANITIZE_STRING);  

                  //var_dump($nometabpad);
                  if(!filter_var($str1,FILTER_SANITIZE_STRING)):
                      $erros[] = "Descrição campo 1 inválida!";              
                  endif;   
              else:
                  $str1 = ''; 
              endif;  

              if(isset($_POST['str2']) and !EMPTY($_POST['str2'])):    
                  $str2 = filter_input(INPUT_POST, 'str2',FILTER_SANITIZE_STRING);  
                  
                  if(!filter_var($str2,FILTER_SANITIZE_STRING)):
                      $erros[] = "Descrição campo 2 inválida!";              
                  endif; 
              else:
                  $str2 = ''; 
              endif; 
                  
              if(isset($_POST['str3']) and !EMPTY($_POST['str3'])):    
                  $str3 = filter_input(INPUT_POST, 'str3',FILTER_SANITIZE_STRING);  
                  
                  if(!filter_var($str3,FILTER_SANITIZE_STRING)):
                      $erros[] = "Descrição campo 3 inválida!";              
                  endif; 
              else:
                  $str3 = ''; 
              endif;  

              if(isset($_POST['flag1']) and !EMPTY($_POST['flag1'])):    
                  $flag1 = filter_input(INPUT_POST, 'flag1',FILTER_SANITIZE_STRING);  
                  
                  if(!filter_var($flag1,FILTER_SANITIZE_STRING)):
                      $erros[] = "Descrição flag 1 inválida!";              
                  endif; 
              else:
                  $flag1 = ''; 
              endif; 

              if(isset($_POST['flag2']) and !EMPTY($_POST['flag2'])):    
                  $flag2 = filter_input(INPUT_POST, 'flag2',FILTER_SANITIZE_STRING);  
                  
                  if(!filter_var($flag2,FILTER_SANITIZE_STRING)):
                      $erros[] = "Descrição flag 2 inválida!";              
                  endif; 
              else:
                  $flag2 = ''; 
              endif;

              if(isset($_POST['flag3']) and !EMPTY($_POST['flag3'])):    
                  $flag3 = filter_input(INPUT_POST, 'flag3',FILTER_SANITIZE_STRING);  
                  
                  if(!filter_var($flag3,FILTER_SANITIZE_STRING)):
                      $erros[] = "Descrição flag 3 inválida!";              
                  endif; 
              else:
                  $flag3 = ''; 
              endif; 


              if(isset($_POST['num1']) and !EMPTY($_POST['num1'])):    
                  $num1 = filter_input(INPUT_POST, 'num1',FILTER_SANITIZE_NUMBER_INT);  
                  
                  if(!filter_var($num1,FILTER_SANITIZE_NUMBER_INT)):
                      $erros[] = "Numerico 1 inválido!";              
                  endif; 
              else:
                  $num1 = ''; 
              endif;               

              if(isset($_POST['num2']) and !EMPTY($_POST['num2'])):    
                  $num2 = filter_input(INPUT_POST, 'num2',FILTER_SANITIZE_NUMBER_FLOAT);  
                  
                  if(!filter_var($num2,FILTER_SANITIZE_NUMBER_FLOAT)):
                      $erros[] = "Numerico 2 inválido!";              
                  endif; 
              else:
                  $num2 = ''; 
              endif;               

 
              if(isset($_POST['num3']) and !EMPTY($_POST['num3'])):    
                  $num3 = filter_input(INPUT_POST, 'num3',FILTER_SANITIZE_NUMBER_FLOAT);  
                  
                  if(!filter_var($num3,FILTER_SANITIZE_NUMBER_FLOAT)):
                      $erros[] = "Numerico 3 inválido!";              
                  endif; 
              else:
                  $num3 = ''; 
              endif;  

              if(isset($_POST['data1']) and !EMPTY($_POST['data1'])):    
                  $data1 = filter_input(INPUT_POST, 'data1',FILTER_SANITIZE_STRING);  
                  
                  if(!filter_var($data1,FILTER_SANITIZE_STRING)):
                      $erros[] = "Descrição data 1 inválida!";              
                  endif; 
              else:
                  $data1 = ''; 
              endif;  

              if(isset($_POST['data2']) and !EMPTY($_POST['data2'])):    
                  $data2 = filter_input(INPUT_POST, 'data2',FILTER_SANITIZE_STRING);  
                  
                  if(!filter_var($data2,FILTER_SANITIZE_STRING)):
                      $erros[] = "Descrição data 2 inválida!";              
                  endif; 
              else:
                  $data2 = ''; 
              endif;  

              if(isset($_POST['data3']) and !EMPTY($_POST['data3'])):    
                  $data3 = filter_input(INPUT_POST, 'data3',FILTER_SANITIZE_STRING);  
                  
                  if(!filter_var($data3,FILTER_SANITIZE_STRING)):
                      $erros[] = "Descrição data 3 inválida!";              
                  endif; 
              else:
                  $data3 = ''; 
              endif;    

              if (empty($erros)):  // Nao tem erros de digitacao

                  $tabelaCtr = new TabelaCtr();  
                  if ($Altera == "N"):

                      if ($tabelaCtr->create($id_tp,$str1,$str2,$str3,$flag1, $flag2,$flag3, $num1,$num2 ,$num3,$data1, $data2,$data3 )== 'OK'):  
                          echo '<div class="alert alert-primary" role="alert"><li>' . "Registro inserido com sucesso"  . '</li></div>';  
                   
                          //header('Location:principal.php');   
                      else:  
                          echo '<div class="alert alert-primary" role="alert"><li>' . "Parametrização inválida!!"  . '</li></div>';                  
                      endif;  

                  else: 
                      
                      if ($tabelaCtr->update($id,$id_tp,$str1,$str2,$str3,$flag1, $flag2,$flag3, $num1,$num2 ,$num3,$data1, $data2,$data3 )== 'OK'):  
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
<style type="text/css">
  .form-check {
    margin-top: 25px;
  } 
</style>

  <script  src="https://code.jquery.com/jquery-3.5.1.js"  integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="  crossorigin="anonymous"></script>

<script> 
  
  var vAltera = "<?=$Altera?>";  
  
  $(document).ready(function() { 
     if (vAltera=='S'){
        $('#grupoTabela').attr('disabled', true); 
      }  
  });  
 
</script>
 <link rel="stylesheet" type="text/css" href="estiloVirtuax.css">

<form method="POST" > 
  <div class = 'container'> 

    <div id='modelo'>
        <div class="cabecalho">
            <h1 class="p-3 mb-2  text-dark cTitulo">Tabelas</h1>
            <div id="grupoBotoes">
               <a href="tabelaCad.php" class="btn btn-primary paramBt">Novo</a>                       
               <button type="submit" name= "gravar" class="btn btn-primary paramBt">Gravar</button>
               <a href="lista_tabela.php" class="btn btn-primary  paramBt">Voltar</a> 
               <a href="lista_tabela.php" class="btn btn-primary  paramBt">Imprimir</a> 
            </div> 

        </div> 
    </div>


      <div class="form-row">


        <div class="form-group col-md-8"> 
          <label for="grupoTabela">Selecione Grupo Tabela</label>
          <select class="form-control" id="grupoTabela" name="grupoTab" >

          <?php

              $tabpad = new tabpadCtr();
              foreach($tabpad->listatabpad() as $p_tabpad):
                  if ($p_tabpad['id'] == $id_tp):
                    echo ' <option value=' . $p_tabpad['id']  . ' selected >' . $p_tabpad['descricao']  .'</option>';  
                  else:  
                    echo ' <option value=' . $p_tabpad['id']  . ' >' . $p_tabpad['descricao']  .'</option>';  
                  endif;  
              endforeach;

          ?>

 
          </select> 

          <label class="form-check-label" for="str1">Descrição campo 1 </label>
          <input id="str1" name ="str1" type="text" class="form-control"   value="<?php  echo $str1;  ?>"   >
 
          <label class="form-check-label" for="str1">Descrição campo 2 </label>
          <input id="str2" name ="str2" type="text" class="form-control"   value="<?php  echo $str2;  ?>"   > 

          <label class="form-check-label" for="str1">Descrição campo 3 </label>
          <input id="str3" name ="str3" type="text" class="form-control"   value="<?php  echo $str3;  ?>"   >  

          <label class="form-check-label" for="flag1">Descrição Flag 1 </label>
          <input id="flag1" name ="flag1" type="text" class="form-control"   value="<?php  echo $flag1;  ?>"   >  

          <label class="form-check-label" for="flag2">Descrição Flag 2 </label>
          <input id="flag2" name ="flag2" type="text" class="form-control"   value="<?php  echo $flag2;  ?>"   >  

          <label class="form-check-label" for="flag3">Descrição Flag 3 </label>
          <input id="flag3" name ="flag3" type="text" class="form-control"   value="<?php  echo $flag3;  ?>"   >  

          <label class="form-check-label" for="num1">Descrição Numerico 1 </label>
          <input id="num1" name ="num1" type="text" class="form-control"   value="<?php  echo $num1;  ?>"   >  

          <label class="form-check-label" for="num2">Descrição Numerico 2 </label>
          <input id="num2" name ="num2" type="text" class="form-control"   value="<?php  echo $num2;  ?>"   >  

          <label class="form-check-label" for="num3">Descrição Numerico3 </label>
          <input id="num3" name ="num3" type="text" class="form-control"   value="<?php  echo $num3;  ?>"   >  

          <label class="form-check-label" for="data1">Descrição Data 1 </label>
          <input id="data1" name ="data1" type="text" class="form-control"   value="<?php  echo $data1;  ?>"   >  

          <label class="form-check-label" for="data1">Descrição Data 2 </label>
          <input id="data2" name ="data2" type="text" class="form-control"   value="<?php  echo $data2;  ?>"   > 

          <label class="form-check-label" for="data3">Descrição Data 3 </label>
          <input id="data3" name ="data3" type="text" class="form-control"   value="<?php  echo $data3;  ?>"   > 


        </div> 

      </div>   



  </div> 
</form> 