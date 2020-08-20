<?php
 
  session_start();

  require_once '../config.php';
  require_once ROOT_PATH . '/controller/tabelaCtr.php'; 
  require_once ROOT_PATH . '/controller/tabpadCtr.php';  
  require_once ROOT_PATH . '/controller/paramtpCtr.php';  
  

  if(!isset($_SESSION['user']) or !isset($_SESSION['tabelaAtual'])):
    header('Location:login.php');  
  endif;  

  include_once "menuPrincipal.php";
  include_once "menu.php"; 

  $Altera = "N"; 

  $id = 0;
 
  $str1 = '';
  $str2 = '';
  $str3 = '';
  $flag1 = '';
  $flag2 = '';
  $flag3 = '';
  $num1 = 0;
  $num2 = 0;
  $num3 = 0;
  $data1='';
  $data2='';
  $data3='';
  $sigla = $_SESSION['tabelaAtual'];
  $nometabpad = '';

  $tabpadCtr = new tabpadCtr();      
  $p_tabpad = $tabpadCtr->buscatpSigla($sigla);
  
  if(!empty($p_tabpad)): 
    $id_tp = $p_tabpad[0]['id'];
    $nometabpad = $p_tabpad[0]['descricao'];   
  else:
    exit();  
  endif; 
 
  if (isset($_GET['Altera'])):
     $Altera = "S";
     

     //var_dump($_GET['Id']);

     $tabelaCtr = new TabelaCtr();   
     $p_tabela = $tabelaCtr->buscaTabela($_GET['Id']);   
     
     //var_dump($p_tabela);


      if(!empty($p_tabela)): 
        $id         = $p_tabela[0]['id'];  
        //$id_tp      = $p_tabela[0]['id_tp'];  
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
      
              //if(isset($_POST['grupoTab'])):                
              //  $id_tp = $_POST['grupoTab']; 
              //endif; 

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
                  
                  //var_dump($num1 );

                  if(!filter_var($num1,FILTER_SANITIZE_NUMBER_INT)):
                      $erros[] = "Numerico 1 inválido!";              
                  endif; 
              else:
                  $num1 = 0; 
              endif;               

              if(isset($_POST['num2']) and !EMPTY($_POST['num2'])):                  
                  $num2 = $_POST['num2'] ;//filter_input(INPUT_POST, 'num2',FILTER_SANITIZE_NUMBER_FLOAT);  
                  
                  if(!filter_var($num2,FILTER_SANITIZE_NUMBER_FLOAT)):
                      $erros[] = "Numerico 2 inválido!";              
                  endif; 
              else:
                  $num2 = 0; 
              endif;               

 
              if(isset($_POST['num3']) and !EMPTY($_POST['num3'])):    
                  $num3 = $_POST['num3']; //filter_input(INPUT_POST, 'num3',FILTER_SANITIZE_NUMBER_FLOAT);  
                  
                  if(!filter_var($num3,FILTER_SANITIZE_NUMBER_FLOAT)):
                      $erros[] = "Numerico 3 inválido!";              
                  endif; 
              else:
                  $num3 = 0; 
              endif;  

              if(isset($_POST['data1']) and !EMPTY($_POST['data1'])):    
                  $data1 = $_POST['data1'];   
                  if(  !filter_var (preg_replace("([^0-9/] | [^0-9-])","",$_POST['data1']))  ):
                      $erros[] = "Data 1 inválida!";              
                  endif; 
              else: 
                  $data1 = ''; 
              endif;  

              if(isset($_POST['data2']) and !EMPTY($_POST['data2'])):    
                  $data2 = $_POST['data2']; //filter_input(INPUT_POST, 'data2',FILTER_SANITIZE_STRING);  
                  
                  if(!filter_var($data2,FILTER_SANITIZE_STRING)):
                      $erros[] = "Descrição data 2 inválida!";              
                  endif; 
              else:
                  $data2 = ''; 
              endif;  

              if(isset($_POST['data3']) and !EMPTY($_POST['data3'])):    
                  $data3 = $_POST['data3']; //filter_input(INPUT_POST, 'data3',FILTER_SANITIZE_STRING);  
                  
                  if(!filter_var($data3,FILTER_SANITIZE_STRING)):
                      $erros[] = "Descrição data 3 inválida!";              
                  endif; 
              else:
                  $data3 = ''; 
              endif;    

              if (empty($erros)):  // Nao tem erros de digitacao

                  $tabelaCtr = new TabelaCtr();  
                  if ($Altera == "N"):


                      //var_dump('XX');
                      //var_dump($id_tp);

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

  $vStr1 = '';
  $vDesc_str1 = '';
  $vStr2 = '';
  $vDesc_str2 = '';
  $vStr3 = '';
  $vDesc_str3 = '';

  $vFlag1 = '';
  $vDesc_flag1 = '';
  $vFlag2 = '';
  $vDesc_flag2 = '';
  $vFlag3 = '';
  $vDesc_flag3 = '';

  $vNum1 = 0;
  $vDesc_num1 ='';
  $vNum2 = 0;
  $vDesc_num2 ='';
  $vNum3 = 0;
  $vDesc_num3 ='';

  $vData1='';   
  $vDesc_data1 ='';
  $vData2='';   
  $vDesc_data2 ='';
  $vData3='';   
  $vDesc_data3 ='';    


  $paramtpCtr = new paramtpCtr();   
  $p_paramtp = $paramtpCtr->buscaParamTbPd($id_tp);   

  //var_dump($p_paramtp);


  if(!empty($p_paramtp)): 
   
    $vStr1       = $p_paramtp[0]['str1']; 
    $vDesc_str1  = $p_paramtp[0]['desc_str1']; 
    $vStr2       = $p_paramtp[0]['str2']; 
    $vDesc_str2  = $p_paramtp[0]['desc_str2'];  
    $vStr3       = $p_paramtp[0]['str3']; 
    $vDesc_str3  = $p_paramtp[0]['desc_str3']; 

    $vFlag1      = $p_paramtp[0]['flag1'];         
    $vDesc_flag1 = $p_paramtp[0]['desc_flag1']; 
    $vFlag2      = $p_paramtp[0]['flag2'];         
    $vDesc_flag2 = $p_paramtp[0]['desc_flag2']; 
    $vFlag3      = $p_paramtp[0]['flag3'];         
    $vDesc_flag3 = $p_paramtp[0]['desc_flag3'];       

    $vNum1        = $p_paramtp[0]['num1']; 
    $vDesc_num1   = $p_paramtp[0]['desc_num1']; 
    $vNum2        = $p_paramtp[0]['num2']; 
    $vDesc_num2   = $p_paramtp[0]['desc_num2']; 
    $vNum3        = $p_paramtp[0]['num3']; 
    $vDesc_num3   = $p_paramtp[0]['desc_num3'];         
    

    $vData1      = $p_paramtp[0]['data1'];        
    $vDesc_data1 = $p_paramtp[0]['desc_data1']; 
    $vData2      = $p_paramtp[0]['data2'];        
    $vDesc_data2 = $p_paramtp[0]['desc_data2']; 
    $vData3      = $p_paramtp[0]['data3'];        
    $vDesc_data3 = $p_paramtp[0]['desc_data3'];         
    

  endif;  



  ?>
<style type="text/css">
  .form-check {
    margin-top: 25px;
  } 
</style>


    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>



  <script  src="https://code.jquery.com/jquery-3.5.1.js"  integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="  crossorigin="anonymous"></script>

<script> 
 
 
   function validaNum(p) {
      var x, text;  
      x =  p;
     
      // If x is Not a Number or less than one or greater than 10
      if (isNaN(x) || x < 1 || x > 1000000) {
        text = "Número Inválido";
        alert(text);
      }
    
    } 

  $(document).ready(function(){

 
          $('#num2').focusout(function() {
              validaNum($('#num2').val());
          });

          $('#num2').change(function() {  
             this.value = parseFloat(this.value).toFixed(2);
          });
        
          $('#num3').focusout(function() {
              validaNum($('#num3').val());
          }); 
        

        var jsStr1       =  "<?=$vStr1?>";       
        var jsDesc_str1  =  "<?=$vDesc_str1?>";  
        var jsStr2       =  "<?=$vStr2?>";       
        var jsDesc_str2  =  "<?=$vDesc_str2?>";  
        var jsStr3       =  "<?=$vStr3?>";       
        var jsDesc_str3  =  "<?=$vDesc_str3?>";  

        var jsFlag1      =  "<?=$vFlag1?>";        
        var jsDesc_flag1 =  "<?=$vDesc_flag1?>"; 
        var jsFlag2      =  "<?=$vFlag2?>";        
        var jsDesc_flag2 =  "<?=$vDesc_flag2?>"; 
        var jsFlag3      =  "<?=$vFlag3?>";        
        var jsDesc_flag3 =  "<?=$vDesc_flag3?>";   

        var jsNum1        = "<?=$vNum1?>";       
        var jsDesc_num1   = "<?=$vDesc_num1?>";  
        var jsNum2        = "<?=$vNum2?>";       
        var jsDesc_num2   = "<?=$vDesc_num2 ?>"; 
        var jsNum3        = "<?=$vNum3?>";       
        var jsDesc_num3   = "<?=$vDesc_num3?>";    
        

        var jsData1      =  "<?=$vData1?>";       
        var jsDesc_data1 =  "<?=$vDesc_data1?>"; 
        var jsData2      =  "<?=$vData2?>";       
        var jsDesc_data2 =  "<?=$vDesc_data2?>"; 
        var jsData3      =  "<?=$vData3?>";       
        var jsDesc_data3 =  "<?=$vDesc_data3?>";   

        $('#grupoTabela').attr('disabled', true); 
        
        if(!(jsStr1=='S')){
           $("#lbStr1").hide();
           $("#str1").hide();           
         }  
         else{       
           $("#lbStr1").text(jsDesc_str1); 
         }

        if(!(jsStr2=='S')){
           $("#lbStr2").hide();
           $("#str2").hide();           
         }  
         else{       
           $("#lbStr2").text(jsDesc_str2); 
         }         
         
         if(!(jsStr3=='S')){
           $("#lbStr3").hide();
           $("#str3").hide();           
         }  
         else{       
           $("#lbStr3").text(jsDesc_str3); 
         }    

        if(!(jsFlag1=='S')){
           $("#lbFlag1").hide();
           $("#flag1").hide();           
         }  
         else{       
           $("#lbFlag1").text(jsDesc_flag1); 
         }     

        if(!(jsFlag2=='S')){
           $("#lbFlag2").hide();
           $("#flag2").hide();           
         }  
         else{       
           $("#lbFlag2").text(jsDesc_flag2); 
         }                  

        if(!(jsFlag3=='S')){
           $("#lbFlag3").hide();
           $("#flag3").hide();           
         }  
         else{       
           $("#lbFlag3").text(jsDesc_flag3); 
         }                  

        if(!(jsNum1=='S')){
           $("#lbNum1").hide();
           $("#num1").hide();           
         }  
         else{       
           $("#lbNum1").text(jsDesc_num1); 
         }

        if(!(jsNum2=='S')){
           $("#lbNum2").hide();
           $("#num2").hide();           
         }  
         else{       
           $("#lbNum2").text(jsDesc_num2); 
         }     

        if(!(jsNum3=='S')){
           $("#lbNum3").hide();
           $("#num3").hide();           
         }  
         else{       
           $("#lbNum3").text(jsDesc_num3); 
         }    


        if(!(jsData1=='S')){
           $("#lbData1").hide();
           $("#data1").hide();           
         }  
         else{       
           $("#lbData1").text(jsDesc_data1); 
         } 

        if(!(jsData2=='S')){
           $("#lbData2").hide();
           $("#data2").hide();           
         }  
         else{       
           $("#lbData2").text(jsDesc_data2); 
         }          

        if(!(jsData3=='S')){
           $("#lbData3").hide();
           $("#data3").hide();           
         }  
         else{       
           $("#lbData3").text(jsDesc_data3); 
         }   

  });  
</script>
 <link rel="stylesheet" type="text/css" href="estiloVirtuax.css">

<form method="POST" > 
  <div class = 'container'> 

    <div id='modelo'>
        <div class="cabecalho">
 
            <?php
                echo '<h1 class="p-3 mb-2 text-dark">Tabela de ' . $nometabpad .  '</h1>'; 
            ?>

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
          <label for="grupoTabela">Tabela</label>
          <select class="form-control" id="grupoTabela" name="grupoTab" >

          <?php

              $tabpad = new tabpadCtr();

              foreach($tabpad->lerTodas() as $p_tabpad):
                  if ($p_tabpad['id'] == $id_tp or $p_tabpad['sigla'] == $sigla):
                    echo ' <option value=' . $p_tabpad['id']  . ' selected >' . $p_tabpad['descricao']  .'</option>';  
                  else:  
                    echo ' <option value=' . $p_tabpad['id']  . ' >' . $p_tabpad['descricao']  .'</option>';  
                  endif;  
              endforeach;

          ?>

 
          </select> 

          <label class="form-check-label paramLb" for="str1" id="lbStr1">Descrição campo 1 </label>
          <input id="str1" name ="str1" type="text" class="form-control"   value="<?php  echo $str1;  ?>"   >
 
          <label class="form-check-label paramLb" for="str1" id="lbStr2">Descrição campo 2 </label>
          <input id="str2" name ="str2" type="text" class="form-control"   value="<?php  echo $str2;  ?>"   > 

          <label class="form-check-label paramLb" for="str1" id="lbStr3">Descrição campo 3 </label>
          <input id="str3" name ="str3" type="text" class="form-control"   value="<?php  echo $str3;  ?>"   >  

          <label class="form-check-label paramLb" for="flag1" id="lbFlag1" >Descrição Flag 1 </label>
          <input id="flag1" name ="flag1" type="text" class="form-control"   value="<?php  echo $flag1;  ?>"   >  

          <label class="form-check-label paramLb" for="flag2" id="lbFlag2" >Descrição Flag 2 </label>
          <input id="flag2" name ="flag2" type="text" class="form-control"   value="<?php  echo $flag2;  ?>"   >  

          <label class="form-check-label paramLb" for="flag3" id="lbFlag3" >Descrição Flag 3 </label>
          <input id="flag3" name ="flag3" type="text" class="form-control"   value="<?php  echo $flag3;  ?>"   >  

          <label class="form-check-label paramLb" for="num1" id="lbNum1" >Descrição Numerico 1 </label>
          <input id="num1" name ="num1" type="number" min="0" max="999" class="form-control"   value="<?php  echo $num1;  ?>"   >  

          <label class="form-check-label paramLb" for="num2" id="lbNum2" >Descrição Numerico 2 </label>
          <input id="num2" name ="num2" step="0.01" type="number" class="form-control"   value="<?php  echo $num2;  ?>"   >  

          <label class="form-check-label paramLb" for="num3" id="lbNum3" >Descrição Numerico3 </label>
          <input id="num3" name ="num3" type="number" step="any"  class="form-control"   value="<?php  echo $num3;  ?>"   >  

          <label class="form-check-label paramLb" for="data1"  id="lbData1" >Descrição Data 1 </label>
          <input id="data1" name ="data1" type="date" class="form-control"   value="<?php  echo $data1;  ?>"   >  

          <label class="form-check-label paramLb" for="data2" id="lbData2" >>Descrição Data 2 </label>
          <input id="data2" name ="data2" type="date" class="form-control"   value="<?php  echo $data2;  ?>"   > 

          <label class="form-check-label paramLb" for="data3" id="lbData3" >>Descrição Data 3 </label>
          <input id="data3" name ="data3" type="date" class="form-control"   value="<?php  echo $data3;  ?>"   > 


        </div> 

      </div>   



  </div> 
</form> 