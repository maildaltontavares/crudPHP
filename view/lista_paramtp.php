<?php
 
  session_start();

  require_once '../config.php';
  require_once ROOT_PATH . '/controller/paramtpCtr.php';  
  

  if(!isset($_SESSION['user'])):
  	header('Location:login.php');  
  endif;	

  include_once "menuPrincipal.php";
  include_once "menu.php";

  ?>  
  <link rel="stylesheet" type="text/css" href="estiloVirtuax.css">

  	<style type="text/css">
  		.container{
  			z-index: 1; 	
  		}

    </style>
 
	<div class="container"  style="">  
		<?php   

		//echo '<h1 class="p-3 mb-2 bg-light text-dark">tabpads</h1>'; 
		echo '<h1 class="p-3 mb-2 text-dark">Parametrização de Tabelas</h1>'; 

		ECHO '
		<div class="row">
			<div class="col-12">

			    <form class="form-inline" >
			      <div class="form-group mx-sm-3 mb-2">
	 
			          <input type="text" class="form-control"  name="p_nome" placeholder="Pesquise nome do grupo">		       
			      </div>  

			      <button type="submit" class="btn btn-primary mb-2" name = "pesquisar"> Pesquisar </button>
			     
			      <div class="form-group mx-sm-3 mb-2">			          
			         <button type="submit" class="btn btn-light" name = "pesquisa_todos"> Listar Todos </button>
			      </div>

			      <div class="form-group mx-sm-3 mb-2">
			         <a href="paramtpCad.php" class="btn btn-primary ">Novo</a>
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
		$paramtb = new ParamTpCtr();	
  

		if( (isset($_GET['pesquisa_todos']) ) or (!isset($_GET['pesquisa_todos']) and !isset($_GET['pesquisar']) ) ):
			 
			foreach($paramtb->listaParamTb() as $p_paramtb):

				echo '<tr>' .
				      '<th scope="row">' . $p_paramtb['id'] . '</th>' .
				      '<td>' .  $p_paramtb['nome_grupo']      . '</td> ' .
				  
	          		  '<td><a href="paramtpCad.php?Id='  . $p_paramtb['id'] . '&Altera=S'  . '">Alterar</a> </td>' .
	                  '<td><a href="excluirParamtp.php?Id=' . $p_paramtb['id'] . '">Excluir</a> </td>'.
				      //'<td><button type="submit" name="excluir" onclick=excluir("'. $p_paramtb['id'] . '")>Excluir</button> </td>'.  
				    '</tr>' .
				    '<input type="hidden"  name="Id" value='  . $p_paramtb['id'] . '>';



			endforeach;

		elseif(isset($_GET['pesquisar'])):

			foreach($paramtb->listaParamTbF($_GET['p_nome']) as $p_paramtb):

				echo '<tr>' .
				      '<th scope="row">' . $p_paramtb['id'] . '</th>' .
				      '<td>' .  $p_paramtb['nome_grupo']      . '</td> ' .
				      
				      '<td><a href="paramtpCad.php?Id='  . $p_paramtb['id'] . '&Altera=S'  . '">Alterar</a> </td>' .
	                  '<td><a href="excluirParamtp.php?Id=' . $p_paramtb['id'] . '">Excluir</a> </td>'.
				     // '<td><button  type="submit" name="excluir" onclick=excluir("'. $p_paramtb['id'] . '")>Excluir</button> </td>'.  



				    '</tr>'	.

				    '<input type="hidden"  name="Id" value='  . $p_paramtb['id'] . '>';

			endforeach;	 

		endif;

		echo ' </tbody>
		   </table>';   
		 


		?>

 	</div>


<?php

  include_once "footer.php";

?>  