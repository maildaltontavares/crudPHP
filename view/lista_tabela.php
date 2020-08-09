<?php
 
  session_start();

  require_once '../config.php';
  require_once ROOT_PATH . '/controller/tabelaCtr.php';  
  require_once ROOT_PATH . '/controller/tabpadCtr.php';    
  

  if(!isset($_SESSION['user'])):
  	header('Location:login.php');  
  endif;	
  
  include_once "menuHome.php";
  include_once "menu.php"; 
  
  $id = 0;
  $nometabpad = '';
  $sigla  = ''; 
  
  if ((!isset($_GET['pesquisa_todos']) and !isset($_GET['pesquisar']) )     ): 
   	   
       if(isset($_GET['idTp'])): //Executa apenas a primeira vez
	       $tabpadCtr = new tabpadCtr();   
	       $p_tabpad = $tabpadCtr->buscatabpad($_GET['idTp']);  
	       $_SESSION['tabelaAtual'] = $p_tabpad[0]['sigla'];  
	      // var_dump($_SESSION['tabelaAtual']);  
	    else:
	       $tabpadCtr = new tabpadCtr();   
	       $tb =  $_SESSION['tabelaAtual'] ;
	       $p_tabpad = $tabpadCtr->buscatpSigla($tb);   	       
	   endif;    

  else:
       $tabpadCtr = new tabpadCtr();   
       $tb =  $_SESSION['tabelaAtual'] ;
       $p_tabpad = $tabpadCtr->buscatpSigla($tb);   
  endif;	  

  if(!empty($p_tabpad)): 
     $id = $p_tabpad[0]['id'];  
     $nometabpad = $p_tabpad[0]['descricao'];    
     $sigla = $p_tabpad[0]['sigla'];    
  endif;   

  

  ?>  
   <link rel="stylesheet" type="text/css" href="estiloVirtuax.css">

  	<style type="text/css">
  		.container{
  			z-index: 1; 	
  		}

    </style>
 
	<div class="container">  
		<?php   

		//echo '<h1 class="p-3 mb-2 bg-light text-dark">tabelas</h1>'; 
		echo '<h1 class="p-3 mb-2 text-dark">Tabela de ' . $nometabpad .  '</h1>'; 

		ECHO '
		<div class="row">
			<div class="col-12">

			    <form class="form-inline" >
			      <div class="form-group mx-sm-3 mb-2">
			          <label  >Descrição >> </label>	
			          <input type="text" class="form-control"  name="p_nome" placeholder="Pesquise por Descrição">		       
			      </div>  

			      <button type="submit" class="btn btn-primary mb-2" name = "pesquisar"> Pesquisar </button>
			     
			      <div class="form-group mx-sm-3 mb-2">			          
			         <button type="submit" class="btn btn-light" name = "pesquisa_todos"> Listar Todos </button>
			      </div>

			      <div class="form-group mx-sm-3 mb-2">
			         <a href="tabelaCad.php" class="btn btn-primary">Novo</a>
			      </div> 

			    </form>



			</div>
		</div>';  

        /*"table table-striped" */
		echo '<table class="table table-hover">    
			  <thead>
			    <tr>
			      <th scope="col">id</th>
			      <th scope="col">Descrição</th>
			      <th scope="col">Tabela</th>

 
			      <th scope="col-2">Ação</th>

			    </tr>
			  </thead>
			  <tbody>';
		$tabela = new tabelaCtr();	
  

		if( (isset($_GET['pesquisa_todos']) ) or (!isset($_GET['pesquisa_todos']) and !isset($_GET['pesquisar']) ) ):
			 
			foreach($tabela->listaTabela($sigla) as $p_tabela):

				echo '<tr>' .
				      '<th scope="row">' . $p_tabela['id'] . '</th>' .
				      '<td>' .  $p_tabela['str1']      . '</td> ' .
				      '<td>' .  $p_tabela['nome_grupo']      . '</td> ' .
				      
				  
	          		  '<td><a href="tabelaCad.php?Id='  . $p_tabela['id'] . '&Altera=S'  . '">Alterar</a> </td>' .
	                  '<td><a href="excluirTabela.php?Id=' . $p_tabela['id'] . '">Excluir</a> </td>'.
				      //'<td><button type="submit" name="excluir" onclick=excluir("'. $p_tabela['id'] . '")>Excluir</button> </td>'.  
				    '</tr>' .
				    '<input type="hidden"  name="Id" value='  . $p_tabela['id'] . '>';



			endforeach;

		elseif(isset($_GET['pesquisar'])):

			foreach($tabela->listaTabelaF($_GET['p_nome'],$sigla) as $p_tabela):

				echo '<tr>' .
				      '<th scope="row">' . $p_tabela['id'] . '</th>' .
				      '<td>' .  $p_tabela['str1']      . '</td> ' . 
				      '<td>' .  $p_tabela['nome_grupo']      . '</td> ' .
				     
				      '<td><a href="tabelaCad.php?Id='  . $p_tabela['id'] . '&Altera=S'  . '">Alterar</a> </td>' .
	                  '<td><a href="excluirtabela.php?Id=' . $p_tabela['id'] . '">Excluir</a> </td>'.
				     // '<td><button  type="submit" name="excluir" onclick=excluir("'. $p_tabela['id'] . '")>Excluir</button> </td>'.  



				    '</tr>'	.

				    '<input type="hidden"  name="Id" value='  . $p_tabela['id'] . '>';

			endforeach;	 

		endif;

		echo ' </tbody>
		   </table>';   
		 


		?>

 	</div>


<?php

  include_once "footer.php";

?>  