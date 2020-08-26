<?php
 
  session_start();

  require_once '../config.php';
  require_once ROOT_PATH . '/controller/paramtpCtr.php'; 
  require_once ROOT_PATH . '/controller/tabpadCtr.php';  
  

  if(!isset($_SESSION['user'])):
    header('Location:login.php');  
  endif;  

  include_once "menuPrincipal.php";
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

  $num1 = '';
  $i_num1 = '';
  $desc_num1 ='';
  
  $num2 = '';
  $i_num2 = '';
  $desc_num2 ='';  

  $num3 = '';
  $i_num3 = '';
  $desc_num3 ='';  

  $data1='';
  $i_data1 = '';
  $desc_data1 ='';

  $data2='';
  $i_data2 = '';
  $desc_data2 ='';  

  $data3='';
  $i_data3 = '';
  $desc_data3 ='';  



  if (isset($_GET['Altera'])):
     $Altera = "S";
     

     //var_dump($_GET['Id']);

     $paramtpCtr = new paramtpCtr();   
     $p_paramtp = $paramtpCtr->buscaParamTb($_GET['Id']);   
     
     //var_dump($p_paramtp);


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

        $num1      = $p_paramtp[0]['num1']; 
        if($num1== 'S'):
          $i_num1= 'checked';
        else:  
          $i_num1= '';
        endif;   
        $desc_num1 = $p_paramtp[0]['desc_num1']; 

        $num2      = $p_paramtp[0]['num2']; 
        if($num2== 'S'):
          $i_num2= 'checked';
        else:  
          $i_num2= '';
        endif;   
        $desc_num2 = $p_paramtp[0]['desc_num2']; 

        $num3      = $p_paramtp[0]['num3']; 
        if($num3== 'S'):
          $i_num3= 'checked';
        else:  
          $i_num3= '';
        endif;   
        $desc_num3 = $p_paramtp[0]['desc_num3']; 

        $data1      = $p_paramtp[0]['data1']; 
        if($data1== 'S'):
          $i_data1= 'checked';
        else:  
          $i_data1= '';
        endif;   
        $desc_data1 = $p_paramtp[0]['desc_data1']; 

        $data2      = $p_paramtp[0]['data2']; 
        if($data2== 'S'):
          $i_data2= 'checked';
        else:  
          $i_data2= '';
        endif;   
        $desc_data2 = $p_paramtp[0]['desc_data2']; 

        $data3      = $p_paramtp[0]['data3']; 
        if($data3== 'S'):
          $i_data3= 'checked';
        else:  
          $i_data3= '';
        endif;   
        $desc_data3 = $p_paramtp[0]['desc_data3']; 

      endif;  
  endif; 

   //var_dump($id);

  if (isset($_POST['gravar'])):
      
              $erros = array(); 

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
                $erros[] = "Obrigatório marcar o checkbox da String 1!"; 
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

              if(isset($_POST['i_num1'])):
                $num1= 'S';
                $i_num1 = 'checked';                
              else:
                $num1 = 'N';
                $i_num1 = '';                  
              endif ;  

              if(isset($_POST['i_num2'])):
                $num2= 'S';
                $i_num2 = 'checked';                
              else:
                $num2 = 'N';
                $i_num2 = '';                  
              endif ;                

              if(isset($_POST['i_num3'])):
                $num3= 'S';
                $i_num3 = 'checked';                
              else:
                $num3 = 'N';
                $i_num3 = '';                  
              endif ;  

              if(isset($_POST['i_data1'])):
                $data1= 'S';
                $i_data1 = 'checked';                
              else:
                $data1 = 'N';
                $i_data1 = '';                  
              endif ;  


              if(isset($_POST['i_data2'])):
                $data2= 'S';
                $i_data2 = 'checked';                
              else:
                $data2 = 'N';
                $i_data2 = '';                  
              endif ;  
                  
              if(isset($_POST['i_data3'])):
                $data3= 'S';
                $i_data3 = 'checked';                
              else:
                $data3 = 'N';
                $i_data3 = '';                  
              endif ;  


              if(isset($_POST['desc_str1']) and !EMPTY($_POST['desc_str1']) ) :  
                  if($_POST['desc_str1'] != ''):          
                      $desc_str1 = filter_input(INPUT_POST, 'desc_str1',FILTER_SANITIZE_STRING);   
                      
                      if(!filter_var($desc_str1,FILTER_SANITIZE_STRING)):
                          $erros[] = "Descrição String 1 inválida!";              
                      endif;    
                  else:
                      $erros[] = "Descrição String 1 inválida!";  
                  endif; 
              else: 
                      $erros[] = "Descrição String 1 inválida!"; 
                      $desc_str1 = ''; 
              endif;  


 /*             

              if(isset($_POST['desc_str1']) and !EMPTY($_POST['desc_str1'])):            
                  $desc_str1 = filter_input(INPUT_POST, 'desc_str1',FILTER_SANITIZE_STRING);  

                  //var_dump($nometabpad);
                  if(!filter_var($desc_str1,FILTER_SANITIZE_STRING)):
                      $erros[] = "Descrição string 1 inválida!";              
                  endif;   
              else:
                  $desc_str1 = ''; 
              endif;  
*/

              if($i_str2 == 'checked'):
                  if(isset($_POST['desc_str2']) and !EMPTY($_POST['desc_str2']) ) :  
                      if($_POST['desc_str2'] != ''):          
                          $desc_str2 = filter_input(INPUT_POST, 'desc_str2',FILTER_SANITIZE_STRING);   
                          
                          if(!filter_var($desc_str2,FILTER_SANITIZE_STRING)):
                              $erros[] = "Descrição String 2 inválida!";              
                          endif;    
                      else:
                          $erros[] = "Descrição String 2 inválida!";  
                      endif; 
                  else: 
                          $erros[] = "Descrição String 2 inválida!"; 
                          $desc_str2 = ''; 
                  endif;
              else:
                   $desc_str2 = ''; 
              endif;
                  
              if($i_str3 == 'checked'):
                  if(isset($_POST['desc_str3']) and !EMPTY($_POST['desc_str3']) ) :  
                      if($_POST['desc_str3'] != ''):          
                          $desc_str3 = filter_input(INPUT_POST, 'desc_str3',FILTER_SANITIZE_STRING);   
                          
                          if(!filter_var($desc_str3,FILTER_SANITIZE_STRING)):
                              $erros[] = "Descrição String 3 inválida!";              
                          endif;    
                      else:
                          $erros[] = "Descrição String 3 inválida!";  
                      endif; 
                  else: 
                          $erros[] = "Descrição String 3 inválida!"; 
                          $desc_str3 = ''; 
                  endif;
              else:
                   $desc_str3 = ''; 
              endif;

              if($i_flag1 == 'checked'):
                  if(isset($_POST['desc_flag1']) and !EMPTY($_POST['desc_flag1']) ) :  
                      if($_POST['desc_flag1'] != ''):          
                          $desc_flag1 = filter_input(INPUT_POST, 'desc_flag1',FILTER_SANITIZE_STRING);   
                          
                          if(!filter_var($desc_flag1,FILTER_SANITIZE_STRING)):
                              $erros[] = "Descrição flag 1 inválida!";             
                          endif;    
                      else:
                          $erros[] = "Descrição flag 1 inválida!";   
                      endif; 
                  else: 
                          $erros[] = "Descrição flag 1 inválida!";   
                          $desc_flag1 = ''; 
                  endif;
              else:
                   $desc_flag1 = ''; 
              endif;
/*
              if(isset($_POST['desc_flag2']) and !EMPTY($_POST['desc_flag2'])):    
                  $desc_flag2 = filter_input(INPUT_POST, 'desc_flag2',FILTER_SANITIZE_STRING);  
                  
                  if(!filter_var($desc_flag2,FILTER_SANITIZE_STRING)):
                      $erros[] = "Descrição flag 2 inválida!";              
                  endif; 
              else:
                  $flag2 = ''; 
              endif;
*/




              if($i_flag2 == 'checked'):
                  if(isset($_POST['desc_flag2']) and !EMPTY($_POST['desc_flag2']) ) :  
                      if($_POST['desc_flag2'] != ''):          
                          $desc_flag2 = filter_input(INPUT_POST, 'desc_flag2',FILTER_SANITIZE_STRING);   
                          
                          if(!filter_var($desc_flag2,FILTER_SANITIZE_STRING)):
                              $erros[] = "Descrição flag 2 inválida!";             
                          endif;    
                      else:
                          $erros[] = "Descrição flag 2 inválida!";   
                      endif; 
                  else: 
                          $erros[] = "Descrição flag 2 inválida!";   
                          $desc_flag2 = ''; 
                  endif;
              else:
                   $desc_flag2 = ''; 
              endif;

              if($i_flag3 == 'checked'):
                  if(isset($_POST['desc_flag3']) and !EMPTY($_POST['desc_flag3']) ) :  
                      if($_POST['desc_flag3'] != ''):          
                          $desc_flag3 = filter_input(INPUT_POST, 'desc_flag3',FILTER_SANITIZE_STRING);   
                          
                          if(!filter_var($desc_flag3,FILTER_SANITIZE_STRING)):
                              $erros[] = "Descrição flag 3 inválida!";             
                          endif;    
                      else:
                          $erros[] = "Descrição flag 3 inválida!";   
                      endif; 
                  else: 
                          $erros[] = "Descrição flag 3 inválida!";   
                          $desc_flag3 = ''; 
                  endif;
              else:
                   $desc_flag3 = ''; 
              endif;


              if($i_num1 == 'checked'):
                  if(isset($_POST['desc_num1']) and !EMPTY($_POST['desc_num1']) ) :  
                      if($_POST['desc_num1'] != ''):          
                          $desc_num1 = filter_input(INPUT_POST, 'desc_num1',FILTER_SANITIZE_STRING);   
                          
                          if(!filter_var($desc_num1,FILTER_SANITIZE_STRING)):
                              $erros[] = "Descrição numerico 1 inválida!";            
                          endif;    
                      else:
                          $erros[] = "Descrição numerico 1 inválida!";    
                      endif; 
                  else: 
                          $erros[] = "Descrição numerico 1 inválida!";   
                          $desc_num1 = ''; 
                  endif;
              else:
                   $desc_num1 = ''; 
              endif;           
/*
              if(isset($_POST['desc_num2']) and !EMPTY($_POST['desc_num2'])):    
                  $desc_num2 = filter_input(INPUT_POST, 'desc_num2',FILTER_SANITIZE_STRING);  
                  
                  if(!filter_var($desc_num2,FILTER_SANITIZE_STRING)):
                      $erros[] = "Descrição numerico 2 inválida!";              
                  endif; 
              else:
                  $num2 = ''; 
              endif;               
*/


              if($i_num2 == 'checked'):
                  if(isset($_POST['desc_num2']) and !EMPTY($_POST['desc_num2']) ) :  
                      if($_POST['desc_num2'] != ''):          
                          $desc_num2 = filter_input(INPUT_POST, 'desc_num1',FILTER_SANITIZE_STRING);   
                          
                          if(!filter_var($desc_num2,FILTER_SANITIZE_STRING)):
                              $erros[] = "Descrição numerico 2 inválida!";            
                          endif;    
                      else:
                          $erros[] = "Descrição numerico 2 inválida!";    
                      endif; 
                  else: 
                          $erros[] = "Descrição numerico 2 inválida!";   
                          $desc_num2 = ''; 
                  endif;
              else:
                   $desc_num2 = ''; 
              endif;                
 
   

              if($i_num3 == 'checked'):
                  if(isset($_POST['desc_num3']) and !EMPTY($_POST['desc_num3']) ) :  
                      if($_POST['desc_num3'] != ''):          
                          $desc_num3 = filter_input(INPUT_POST, 'desc_num3',FILTER_SANITIZE_STRING);   
                          
                          if(!filter_var($desc_num3,FILTER_SANITIZE_STRING)):
                              $erros[] = "Descrição numerico 3 inválida!";            
                          endif;    
                      else:
                          $erros[] = "Descrição numerico 3 inválida!";    
                      endif; 
                  else: 
                          $erros[] = "Descrição numerico 3 inválida!";   
                          $desc_num3 = ''; 
                  endif;
              else:
                   $desc_num3 = ''; 
              endif;     

              if($i_data1 == 'checked'):
                  if(isset($_POST['desc_data1']) and !EMPTY($_POST['desc_data1']) ) :  
                      if($_POST['desc_data1'] != ''):          
                          $desc_data1 = filter_input(INPUT_POST, 'desc_data1',FILTER_SANITIZE_STRING);   
                          
                          if(!filter_var($desc_data1,FILTER_SANITIZE_STRING)):
                              $erros[] = "Descrição data 1 inválida!";           
                          endif;    
                      else:
                          $erros[] = "Descrição data 1 inválida!";   
                      endif; 
                  else: 
                          $erros[] = "Descrição data 1 inválida!"; 
                          $desc_data1 = ''; 
                  endif;
              else:
                   $desc_data1 = ''; 
              endif;                          
/*
              if(isset($_POST['desc_data2']) and !EMPTY($_POST['desc_data2'])):    
                  $desc_data2 = filter_input(INPUT_POST, 'desc_data2',FILTER_SANITIZE_STRING);  
                  
                  if(!filter_var($desc_data2,FILTER_SANITIZE_STRING)):
                      $erros[] = "Descrição data 2 inválida!";              
                  endif; 
              else:
                  $data2 = ''; 
              endif;  
*/

              if($i_data2 == 'checked'):
                  if(isset($_POST['desc_data2']) and !EMPTY($_POST['desc_data2']) ) :  
                      if($_POST['desc_data2'] != ''):          
                          $desc_data2 = filter_input(INPUT_POST, 'desc_data2',FILTER_SANITIZE_STRING);   
                          
                          if(!filter_var($desc_data2,FILTER_SANITIZE_STRING)):
                              $erros[] = "Descrição data 2 inválida!";           
                          endif;    
                      else:
                          $erros[] = "Descrição data 2 inválida!";   
                      endif; 
                  else: 
                          $erros[] = "Descrição data 2 inválida!"; 
                          $desc_data2 = ''; 
                  endif;
              else:
                   $desc_data2 = ''; 
              endif; 


              if($i_data3 == 'checked'):
                  if(isset($_POST['desc_data3']) and !EMPTY($_POST['desc_data3']) ) :  
                      if($_POST['desc_data3'] != ''):          
                          $desc_data3 = filter_input(INPUT_POST, 'desc_data3',FILTER_SANITIZE_STRING);   
                          
                          if(!filter_var($desc_data3,FILTER_SANITIZE_STRING)):
                              $erros[] = "Descrição data 3 inválida!";           
                          endif;    
                      else:
                          $erros[] = "Descrição data 3 inválida!";   
                      endif; 
                  else: 
                          $erros[] = "Descrição data 3 inválida!"; 
                          $desc_data3 = ''; 
                  endif;
              else:
                   $desc_data3 = ''; 
              endif;    

              if (empty($erros)):  // Nao tem erros de digitacao

                  $paramtpCtr = new paramtpCtr();  
                  if ($Altera == "N"):

                      if ($paramtpCtr->create($id_tp,$str1,$desc_str1,$str2,$desc_str2,$str3,$desc_str3,$flag1,$desc_flag1,$flag2,$desc_flag2,$flag3,$desc_flag3,$num1,$desc_num1,$num2,$desc_num2,$num3,$desc_num3,$data1,$desc_data1,$data2,$desc_data2,$data3,$desc_data3 )== 'OK'):  
                          echo '<div class="alert alert-primary" role="alert"><li>' . "Registro inserido com sucesso"  . '</li></div>';  
                   
                           $_SESSION['gravou'] = "S";
                          //header('Location:principal.php');   
                      else:  
                          echo '<div class="alert alert-primary" role="alert"><li>' . "Parametrização inválida!!"  . '</li></div>';                  
                          $_SESSION['gravou'] = "N";
                      endif;  

                  else: 
                      
                      if ($paramtpCtr->update($id,$id_tp,$str1,$desc_str1,$str2,$desc_str2,$str3,$desc_str3,$flag1,$desc_flag1,$flag2,$desc_flag2,$flag3,$desc_flag3,$num1,$desc_num1,$num2,$desc_num2,$num3,$desc_num3,$data1,$desc_data1,$data2,$desc_data2,$data3,$desc_data3 )== 'OK'):  
                          echo '<div class="alert alert-primary" role="alert"><li>' . "Registro alterado com sucesso"  . '</li></div>'; 
                          $_SESSION['gravou'] = "S";
                                            
                          //header('Location:principal.php');   
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
<style type="text/css">
  .form-check {
    margin-top: 25px;
  } 
</style>

  <script  src="https://code.jquery.com/jquery-3.5.1.js"  integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="  crossorigin="anonymous"></script>

<script> 
  
  
  $(document).ready(function() { 

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
     
     var vAltera = "<?=$Altera?>";  
     if (vAltera=='S' || vGrava=="S"){
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
               <button type="submit" name= "gravar" class="btn btn-primary paramBt" id="btGravar">Gravar</button>
               <a href="lista_paramtp.php" class="btn btn-primary  paramBt">Voltar</a> 
               
            </div> 

        </div> 
    </div>


      <div class="form-row">


        <div class="form-group col-md-8"> 
          <label for="grupoTabela">Selecione Grupo Tabela</label>
          <select class="form-control" id="grupoTabela" name="grupoTab" >

          <?php

              $tabpad = new tabpadCtr();
              if($Altera =='S' or isset($_POST['gravar'])):
                  $aTab = $tabpad->lerTodas() ;
              else:
                  $aTab = $tabpad->lerNParam() ;

              endif;
              
              foreach($aTab as $p_tabpad):
               
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
              String1 (100 caracteres)
            </label>
          </div>  

          <label class="form-check-label" for="desc_str1">Descrição String 1 </label>
          <input id="desc_str1" name ="desc_str1" type="text" class="form-control"   value="<?php  echo $desc_str1;  ?>"   >

          <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="str2" name="i_str2" <?php echo $i_str2; ?> >
            <label class="form-check-label" for="str2">
              String2 (100 caracteres)
            </label>
          </div>  

          <label class="form-check-label" for="desc_str1">Descrição String 2 </label>
          <input id="desc_str2" name ="desc_str2" type="text" class="form-control"   value="<?php  echo $desc_str2;  ?>"   >


          <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="str3" name="i_str3" <?php echo $i_str3; ?>
            <label class="form-check-label" for="str3">
              String3 (100 caracteres)
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
              Flag2 (3 caracteres)
            </label>
          </div>  

          <label class="form-check-label" for="desc_flag2">Descrição Flag 2 </label>
          <input id="desc_flag2" name ="desc_flag2" type="text" class="form-control"   value="<?php  echo $desc_flag2;  ?>"   > 

          <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="flag3" name="i_flag3" <?php echo $i_flag3; ?>
            <label class="form-check-label" for="flag3">
              Flag3 (3 caracteres)
            </label>
          </div>  

          <label class="form-check-label" for="desc_flag3">Descrição Flag 3 </label>
          <input id="desc_flag3" name ="desc_flag3" type="text" class="form-control"   value="<?php  echo $desc_flag3;  ?>"   > 


          <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="num1" name="i_num1" <?php echo $i_num1; ?>
            <label class="form-check-label" for="num1">
              Numérico 1 (integer)
            </label>
          </div>  

          <label class="form-check-label" for="desc_num1">Descrição Numerico 1 </label>
          <input id="desc_num1" name ="desc_num1" type="text" class="form-control"   value="<?php  echo $desc_num1;  ?>"   > 

          <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="num2" name="i_num2" <?php echo $i_num2; ?>
            <label class="form-check-label" for="num2">
              Numérico 2 (Float)
            </label>
          </div>  

          <label class="form-check-label" for="desc_num2">Descrição Numerico 2 </label>
          <input id="desc_num2" name ="desc_num2" type="text" class="form-control"   value="<?php  echo $desc_num2;  ?>"   > 

          <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="num3" name="i_num3" <?php echo $i_num3; ?>
            <label class="form-check-label" for="num3">
              Numérico 3 (Float)
            </label>
          </div>  

          <label class="form-check-label" for="desc_num3">Descrição Numerico3 </label>
          <input id="desc_num3" name ="desc_num3" type="text" class="form-control"   value="<?php  echo $desc_num3;  ?>"   > 

          <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="data1" name="i_data1" <?php echo $i_data1; ?>
            <label class="form-check-label" for="data1">
              Data 1 
            </label>
          </div>  

          <label class="form-check-label" for="desc_data1">Descrição Data 1 </label>
          <input id="desc_data1" name ="desc_data1" type="text" class="form-control"   value="<?php  echo $desc_data1;  ?>"   > 

          <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="data2" name="i_data2" <?php echo $i_data2; ?>
            <label class="form-check-label" for="data2">
              Data 2 
            </label>
          </div>  

          <label class="form-check-label" for="desc_data1">Descrição Data 2 </label>
          <input id="desc_data2" name ="desc_data2" type="text" class="form-control"   value="<?php  echo $desc_data2;  ?>"   > 

          <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="data3" name="i_data3" <?php echo $i_data3; ?>
            <label class="form-check-label" for="data3">
              Data 3 
            </label>
          </div>  

          <label class="form-check-label" for="desc_data3">Descrição Data 3 </label>
          <input id="desc_data3" name ="desc_data3" type="text" class="form-control"   value="<?php  echo $desc_data3;  ?>"   > 


        </div> 

      </div>  








  </div> 
</form> 