<?php
 
  session_start();

  require_once '../config.php';
  require_once ROOT_PATH . '/controller/tabpadCtr.php';  
  

  if(!isset($_SESSION['user'])):
  	header('Location:login.php');  
  endif;	

  include_once "menuHome.php";
  include_once "menu.php";

  ?>  
   <link rel="stylesheet" type="text/css" href="estiloVirtuax.css">

  	<style type="text/css">
  		.container{
  			/*position: absolute;
  			top:180px;
  			left: 50px;*/
  			z-index: 1; 	
  		}

    </style>
 
	<div class="container">  
		<?php   

		//echo '<h1 class="p-3 mb-2 bg-light text-dark">tabpads</h1>'; 
		echo '<h1 class="p-3 mb-2 text-dark">Grupo de Tabelas</h1>'; 

		ECHO '
		<div class="row">
			<div class="col-12">

			    <form class="form-inline" >
			      <div class="form-group mx-sm-3 mb-2">
			          <label for="nomecateg">Nome do Grupo >> </label>	
			          <input type="text" class="form-control"  name="p_nome" placeholder="Pesquise por Nome">		       
			      </div>  

			      <button type="submit" class="btn btn-primary mb-2" name = "pesquisar"> Pesquisar </button>
			     
			      <div class="form-group mx-sm-3 mb-2">			          
			         <button type="submit" class="btn btn-light" name = "pesquisa_todos"> Listar Todos </button>
			      </div>

			      <div class="form-group mx-sm-3 mb-2">
			         <a href="tabpadCad.php" class="btn btn-primary">Novo</a>
			      </div> 

			    </form>



			</div>
		</div>';  

        /*"table table-striped" */
		echo '<table class="table table-hover">    
			  <thead>
			    <tr>
			      <th scope="col">id</th>
			      <th scope="col">Nome</th>
 
			      <th scope="col-2">Acao</th>

			    </tr>
			  </thead>
			  <tbody>';
		$tabpad = new tabpadCtr();	
  

		if( (isset($_GET['pesquisa_todos']) ) or (!isset($_GET['pesquisa_todos']) and !isset($_GET['pesquisar']) ) ):
			 
			foreach($tabpad->listatabpad() as $p_tabpad):

				echo '<tr>' .
				      '<th scope="row">' . $p_tabpad['id'] . '</th>' .
				      '<td>' .  $p_tabpad['descricao']      . '</td> ' .
				  
	          		  '<td><a href="tabpadCad.php?Id='  . $p_tabpad['id'] . '&Altera=S'  . '">Alterar</a> </td>' .
	                  '<td><a href="excluirtabpad.php?Id=' . $p_tabpad['id'] . '">Excluir</a> </td>'.
				      //'<td><button type="submit" name="excluir" onclick=excluir("'. $p_tabpad['id'] . '")>Excluir</button> </td>'.  
				    '</tr>' .
				    '<input type="hidden"  name="Id" value='  . $p_tabpad['id'] . '>';



			endforeach;

		elseif(isset($_GET['pesquisar'])):

			foreach($tabpad->listatabpadF($_GET['p_nome']) as $p_tabpad):

				echo '<tr>' .
				      '<th scope="row">' . $p_tabpad['id'] . '</th>' .
				      '<td>' .  $p_tabpad['descricao']      . '</td> ' .
				      
				      '<td><a href="tabpadCad.php?Id='  . $p_tabpad['id'] . '&Altera=S'  . '">Alterar</a> </td>' .
	                  '<td><a href="excluirTabPad.php?Id=' . $p_tabpad['id'] . '">Excluir</a> </td>'.
				     // '<td><button  type="submit" name="excluir" onclick=excluir("'. $p_tabpad['id'] . '")>Excluir</button> </td>'.  



				    '</tr>'	.

				    '<input type="hidden"  name="Id" value='  . $p_tabpad['id'] . '>';

			endforeach;	 

		endif;

		echo ' </tbody>
		   </table>';   
		 


		?>

 	</div>


<?php

  include_once "footer.php";

?>  