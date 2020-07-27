<?php
 
  session_start();

  require_once '../config.php';
  require_once ROOT_PATH . '/controller/categoriaCtr.php';  
  

  if(!isset($_SESSION['user'])):
  	header('Location:login.php');  
  endif;	


  include_once "menu.php";

  ?>  
  	<script type="text/javascript">
  		
  		var conf;

  		function excluir($p_id){
  			conf=confirm("Confirma exclusao da categoria: " + $p_id + " ?");
  			
  			if(conf){
  				alert(conf); 
  			}
  		} 

  	</script>

  	<style type="text/css">
  		.container{
  			position: absolute;
  			top:180px;
  			left: 50px;
  			z-index: 1; 	
  		}

    </style>
 
	<div class="container">  
		<?php   

		//echo '<h1 class="p-3 mb-2 bg-light text-dark">categorias</h1>'; 
		echo '<h1 class="p-3 mb-2 text-dark">Categorias de Lojas</h1>'; 

		ECHO '
		<div class="row">
			<div class="col-12">

			    <form class="form-inline" >
			      <div class="form-group mx-sm-3 mb-2">
			          <label for="nomecateg">Categoria ></label>	
			          <input type="text" class="form-control"  name="p_nome" placeholder="Pesquise por Nome">		       
			      </div>  

			      <button type="submit" class="btn btn-primary mb-2" name = "pesquisar"> Pesquisar </button>
			     
			      <div class="form-group mx-sm-3 mb-2">			          
			         <button type="submit" class="btn btn-light" name = "pesquisa_todos"> Listar Todos </button>
			      </div>

			      <div class="form-group mx-sm-3 mb-2">
			         <a href="categoriaCad.php" class="btn btn-primary">Nova categoria</a>
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
		$categoria = new categoriaCtr();	
  

		if( (isset($_GET['pesquisa_todos']) ) or (!isset($_GET['pesquisa_todos']) and !isset($_GET['pesquisar']) ) ):
			 
			foreach($categoria->listacategoria() as $p_categoria):

				echo '<tr>' .
				      '<th scope="row">' . $p_categoria['id'] . '</th>' .
				      '<td>' .  $p_categoria['nome_categ']      . '</td> ' .
				  
	          		  '<td><a href="categoriaCad.php?Id='  . $p_categoria['id'] . '&Altera=S'  . '">Alterar</a> </td>' .
	                  '<td><a href="excluircategoria.php?Id=' . $p_categoria['id'] . '">Excluir</a> </td>'.
				      //'<td><button type="submit" name="excluir" onclick=excluir("'. $p_categoria['id'] . '")>Excluir</button> </td>'.  
				    '</tr>' .
				    '<input type="hidden"  name="Id" value='  . $p_categoria['id'] . '>';



			endforeach;

		elseif(isset($_GET['pesquisar'])):

			foreach($categoria->listacategoriaF($_GET['p_nome']) as $p_categoria):

				echo '<tr>' .
				      '<th scope="row">' . $p_categoria['id'] . '</th>' .
				      '<td>' .  $p_categoria['nome_categ']      . '</td> ' .
				      
				      '<td><a href="categoriaCad.php?Id='  . $p_categoria['id'] . '&Altera=S'  . '">Alterar</a> </td>' .
	                  '<td><a href="excluircategoria.php?Id=' . $p_categoria['id'] . '">Excluir</a> </td>'.
				     // '<td><button  type="submit" name="excluir" onclick=excluir("'. $p_categoria['id'] . '")>Excluir</button> </td>'.  



				    '</tr>'	.

				    '<input type="hidden"  name="Id" value='  . $p_categoria['id'] . '>';

			endforeach;	 

		endif;

		echo ' </tbody>
		   </table>';   
		 


		?>

 	</div>


<?php

  include_once "footer.php";

?>  