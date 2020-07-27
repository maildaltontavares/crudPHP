<?php
 
  session_start();

  require_once '../config.php';
  require_once ROOT_PATH . '/controller/categoriaCtr.php'; ;
  

  if(!isset($_SESSION['user'])):
    header('Location:login.php');  
  endif;  


  include_once "menu.php"; 

  $Altera = "N";
  if (isset($_GET['Altera'])):
     $Altera = "S";
     
     $categoriaCtr = new CategoriaCtr();     
     $p_categoria = $categoriaCtr->buscaCategoria($_GET['Id']);  
    

      //var_dump($p_categoria);
      $acategoria=[];
      if(!empty($p_categoria)):
        $acategoria[] = $p_categoria[0]['nome_categ'];          
        $acategoria[] = $p_categoria[1]['id'];  
      endif;  

  endif;



  if (isset($_POST['gravar'])):
     

              $erros = array();

              $nomecateg = filter_input(INPUT_POST, 'nomecateg',FILTER_SANITIZE_STRING);  
              if(!filter_var($nomecateg,FILTER_SANITIZE_STRING)):
                  $erros[] = "Categoria inválida!";              
              endif;    

              if (empty($erros)):  // Nao tem erros de digitacao

                  $categoriaCtr = new categoriaCtr(); 
                  if ($Altera == "N"):

                      if ($categoriaCtr->create($nomecateg)== 'OK'):  
                          echo '<div class="alert alert-primary" role="alert"><li>' . "Registro inserido com sucesso"  . '</li></div>';  
                   
                          //header('Location:principal.php');   
                      else:  
                          echo '<div class="alert alert-primary" role="alert"><li>' . "Categoria inválida!!"  . '</li></div>';                  
                      endif;  

                  else:

                      if ($categoriaCtr->update($acategoria[1],$nomecateg)== 'OK'):  
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


  <form method="POST"   
  <div class = 'container'>
    
    <h1 class="p-3 mb-2  text-dark">Categorias de Lojas</h1>
 
      <div class="form-row">


        <div class="form-group col-md-8">
          <label for="inputPassword4">Nome categoria</label>
          <input id="categoria" name ="nomecateg" type="text" class="form-control"  >
        </div>
 

      </div> 

        <div class="form-row">
          <div class="form-group col-md-1">             
              <div class="col-3"><button type="submit" name= "gravar" class="btn btn-primary">Gravar</button></div>
          </div> 
          <div class="form-group col-md-1">
              <a href="lista_categorias.php" class="btn btn-primary">Voltar</a>
          </div> 
 
        </div> 
  </div> 
</form>