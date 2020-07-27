<?php
 
  session_start();

  require_once '../config.php';
  require_once ROOT_PATH . '/controller/paramtpCtr.php'; 
  require_once ROOT_PATH . '/controller/tabpadCtr.php';  
  

  if(!isset($_SESSION['user'])):
    header('Location:login.php');  
  endif;  


  include_once "menu.php"; 

  $Altera = "N"; 

  $id = 0;
  $id_tp = 0;
  $str1 = '';
  $i_str1 = 'checked';
  $desc_str1 = '';
  $str2 = '';
  $i_str2 = '';
  $desc_str2 = '';
  $str3 = '';
  $i_str3 = '';
  $desc_str3 = '';
  $flag1 = '';
  $i_flag1 = '';
  $desc_flag1 = '';
  $flag2 = '';
  $i_flag2 = '';
  $desc_flag2 = '';
  $flag3 = '';
  $i_flag3 = '';
  $desc_flag3 = '';

  if (isset($_GET['Altera'])):
     $Altera = "S";
     

     //var_dump($_GET['Id']);

     $paramtpCtr = new paramtpCtr();   
     $p_paramtp = $paramtpCtr->buscaParamTb($_GET['Id']);   
     
     //ar_dump($p_paramtp);


      if(!empty($p_paramtp)): 
        $id         = $p_paramtp[0]['id'];  
        $id_tp      = $p_paramtp[0]['id_tp']; 
        
        $str1       = $p_paramtp[0]['str1']; 
        if($str1 == 'S'):
          $i_str1 = 'checked';
        else:  
          $i_str1 = '';
        endif;  
        $desc_str1  = $p_paramtp[0]['desc_str1']; 

        $str2       = $p_paramtp[0]['str2']; 
        if($str2 == 'S'):
          $i_str2 = 'checked';
        else:  
          $i_str2 = '';
        endif;  
        $desc_str2  = $p_paramtp[0]['desc_str2']; 

        $str3       = $p_paramtp[0]['str3']; 
        if($str3== 'S'):
          $i_str3= 'checked';
        else:  
          $i_str3= '';
        endif;  
        $desc_str3  = $p_paramtp[0]['desc_str3']; 

        $flag1      = $p_paramtp[0]['flag1']; 
        if($flag1== 'S'):
          $i_flag1= 'checked';
        else:  
          $i_flag1= '';
        endif;   
        $desc_flag1 = $p_paramtp[0]['desc_flag1']; 

        $flag2      = $p_paramtp[0]['flag2']; 
        if($flag2== 'S'):
          $i_flag2= 'checked';
        else:  
          $i_flag2= '';
        endif;   
        $desc_flag2 = $p_paramtp[0]['desc_flag2']; 

        $flag3      = $p_paramtp[0]['flag3']; 
        if($flag3== 'S'):
          $i_flag3= 'checked';
        else:  
          $i_flag3= '';
        endif;   
        $desc_flag3 = $p_paramtp[0]['desc_flag3']; 
      endif;  
  endif; 

   //var_dump($id);

  if (isset($_POST['gravar'])):
      
              if(isset($_POST['grupoTab'])):                
                $id_tp = $_POST['grupoTab'];
                 $id_tp = (INT)$id_tp;
              endif;
              
              //var_dump($_POST);


              if(isset($_POST['i_str1'])):
                $str1 = 'S';
                $i_str1 = 'checked';
                //var_dump($str1); 
              else:
                $str1 = 'N';
                $i_str1 = '';
                //var_dump($str1);  
              endif ;

              if(isset($_POST['i_str2'])):
                $str2 = 'S';
                $i_str2 = 'checked';                
              else:
                $str2 = 'N';
                $i_str2 = '';                  
              endif ;

              if(isset($_POST['i_str3'])):
                $str3 = 'S';
                $i_str3 = 'checked';                
              else:
                $str3 = 'N';
                $i_str3 = '';                  
              endif ;              

              if(isset($_POST['i_flag1'])):
                $flag1 = 'S';
                $i_flag1 = 'checked';                
              else:
                $flag1 = 'N';
                $i_flag1 = '';                  
              endif ;  

              if(isset($_POST['i_flag2'])):
                $flag2 = 'S';
                $i_flag2 = 'checked';                
              else:
                $flag2 = 'N';
                $i_flag2 = '';                  
              endif ;  

              if(isset($_POST['i_flag3'])):
                $flag3 = 'S';
                $i_flag3 = 'checked';                
              else:
                $flag3 = 'N';
                $i_flag3 = '';                  
              endif ;  
                  
              $erros = array(); 

              if(isset($_POST['desc_str1']) and !EMPTY($_POST['desc_str1'])):            
                  $desc_str1 = filter_input(INPUT_POST, 'desc_str1',FILTER_SANITIZE_STRING);  

                  //var_dump($nometabpad);
                  if(!filter_var($desc_str1,FILTER_SANITIZE_STRING)):
                      $erros[] = "Descrição string 1 inválida!";              
                  endif;   
              else:
                  $desc_str1 = ''; 
              endif;  

              if(isset($_POST['desc_str2']) and !EMPTY($_POST['desc_str2'])):    
                  $desc_str2 = filter_input(INPUT_POST, 'desc_str2',FILTER_SANITIZE_STRING);  
                  
                  if(!filter_var($desc_str2,FILTER_SANITIZE_STRING)):
                      $erros[] = "Descrição string 2 inválida!";              
                  endif; 
              else:
                  $desc_str2 = ''; 
              endif; 
                  
              if(isset($_POST['desc_str3']) and !EMPTY($_POST['desc_str3'])):    
                  $desc_str3 = filter_input(INPUT_POST, 'desc_str3',FILTER_SANITIZE_STRING);  
                  
                  if(!filter_var($desc_str3,FILTER_SANITIZE_STRING)):
                      $erros[] = "Descrição string 3 inválida!";              
                  endif; 
              else:
                  $desc_str3 = ''; 
              endif;  

              if(isset($_POST['desc_flag1']) and !EMPTY($_POST['desc_flag1'])):    
                  $desc_flag1 = filter_input(INPUT_POST, 'desc_flag1',FILTER_SANITIZE_STRING);  
                  
                  if(!filter_var($desc_flag1,FILTER_SANITIZE_STRING)):
                      $erros[] = "Descrição flag 1 inválida!";              
                  endif; 
              else:
                  $flag1 = ''; 
              endif; 

              if(isset($_POST['desc_flag2']) and !EMPTY($_POST['desc_flag2'])):    
                  $desc_flag2 = filter_input(INPUT_POST, 'desc_flag2',FILTER_SANITIZE_STRING);  
                  
                  if(!filter_var($desc_flag2,FILTER_SANITIZE_STRING)):
                      $erros[] = "Descrição flag 2 inválida!";              
                  endif; 
              else:
                  $flag2 = ''; 
              endif;

              if(isset($_POST['desc_flag3']) and !EMPTY($_POST['desc_flag3'])):    
                  $desc_flag3 = filter_input(INPUT_POST, 'desc_flag3',FILTER_SANITIZE_STRING);  
                  
                  if(!filter_var($desc_flag3,FILTER_SANITIZE_STRING)):
                      $erros[] = "Descrição flag 3 inválida!";              
                  endif; 
              else:
                  $flag3 = ''; 
              endif; 

 
              if (empty($erros)):  // Nao tem erros de digitacao

                  $paramtpCtr = new paramtpCtr();  
                  if ($Altera == "N"):

                      if ($paramtpCtr->create($id_tp,$str1,$desc_str1,$str2,$desc_str2,$str3,$desc_str3,$flag1,$desc_flag1,$flag2,$desc_flag2,$flag3,$desc_flag3)== 'OK'):  
                          echo '<div class="alert alert-primary" role="alert"><li>' . "Registro inserido com sucesso"  . '</li></div>';  
                   
                          //header('Location:principal.php');   
                      else:  
                          echo '<div class="alert alert-primary" role="alert"><li>' . "Parametrização inválida!!"  . '</li></div>';                  
                      endif;  

                  else: 
                      
                      if ($paramtpCtr->update($id,$id_tp,$str1,$desc_str1,$str2,$desc_str2,$str3,$desc_str3,$flag1,$desc_flag1,$flag2,$desc_flag2,$flag3,$desc_flag3)== 'OK'):  
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
            <h1 class="p-3 mb-2  text-dark cTitulo">Parametrização de Tabelas</h1>
            <div id="grupoBotoes">
               <a href="paramtpCad.php" class="btn btn-primary paramBt">Novo</a>                       
               <button type="submit" name= "gravar" class="btn btn-primary paramBt">Gravar</button>
               <a href="lista_paramtp.php" class="btn btn-primary  paramBt">Voltar</a> 
               <a href="lista_paramtp.php" class="btn btn-primary  paramBt">Imprimir</a> 
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

          <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="str1" name="i_str1" <?php echo $i_str1; ?> >
            <label class="form-check-label" for="str1">
              String1 (50 caracteres)
            </label>
          </div>  

          <label class="form-check-label" for="desc_str1">Descrição String 1 </label>
          <input id="desc_str1" name ="desc_str1" type="text" class="form-control"   value="<?php  echo $desc_str1;  ?>"   >

          <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="str2" name="i_str2" <?php echo $i_str2; ?> >
            <label class="form-check-label" for="str2">
              String2 (50 caracteres)
            </label>
          </div>  

          <label class="form-check-label" for="desc_str1">Descrição String 2 </label>
          <input id="desc_str2" name ="desc_str2" type="text" class="form-control"   value="<?php  echo $desc_str2;  ?>"   >


          <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="str3" name="i_str3" <?php echo $i_str3; ?>
            <label class="form-check-label" for="str3">
              String3 (50 caracteres)
            </label>
          </div>  

          <label class="form-check-label" for="desc_str1">Descrição String 3 </label>
          <input id="desc_str3" name ="desc_str3" type="text" class="form-control"   value="<?php  echo $desc_str3;  ?>"   > 



          <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="flag1" name="i_flag1"  <?php echo $i_flag1; ?>
            <label class="form-check-label" for="flag1">
              Flag1 (1 caracter)
            </label>
          </div>  

          <label class="form-check-label" for="desc_flag1">Descrição Flag 1 </label>
          <input id="desc_flag1" name ="desc_flag1" type="text" class="form-control"   value="<?php  echo $desc_flag1;  ?>"   > 

          <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="flag2" name="i_flag2" <?php echo $i_flag2; ?>
            <label class="form-check-label" for="flag2">
              Flag2 (1 caracter)
            </label>
          </div>  

          <label class="form-check-label" for="desc_flag2">Descrição Flag 2 </label>
          <input id="desc_flag2" name ="desc_flag2" type="text" class="form-control"   value="<?php  echo $desc_flag2;  ?>"   > 

          <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="flag3" name="i_flag3" <?php echo $i_flag3; ?>
            <label class="form-check-label" for="flag3">
              Flag3 (1 caracter)
            </label>
          </div>  

          <label class="form-check-label" for="desc_flag3">Descrição Flag 3 </label>
          <input id="desc_flag3" name ="desc_flag3" type="text" class="form-control"   value="<?php  echo $desc_flag3;  ?>"   > 

        </div> 

      </div>  








  </div> 
</form> 