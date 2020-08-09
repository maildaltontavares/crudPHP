<?php
 
  session_start();

  require_once '../config.php';
  require_once ROOT_PATH . '/controller/usuarioCtr.php';  
  

  if(!isset($_SESSION['user'])):
  	header('Location:login.php');  
  endif;

  include_once "menuPrincipal.php";
  include_once "menu.php";

  ?>  
    <link rel="stylesheet" type="text/css" href="estiloVirtuax.css">
  	<script type="text/javascript">
  		
  		var conf;

  		function excluir($p_id){
  			conf=confirm("Confirma exclusao do usuario: " + $p_id + " ?");
  			
  			if(conf){
  				alert(conf); 
  			}
  		} 

  	</script>

  	<style type="text/css">
  		.container{
  			z-index: 1; 	
  		}

    </style>
 
	<div class="container">  
		<?php   

		//echo '<h1 class="p-3 mb-2 bg-light text-dark">Usuarios</h1>'; 
		echo '<h1 class="p-3 mb-2 text-dark">Usuarios</h1>'; 

		ECHO '
		<div class="row">
			<div class="col-12">

			    <form class="form-inline" >
			      <div class="form-group mx-sm-3 mb-2">
			           
			          <input type="text" class="form-control"  name="p_nome" placeholder="Pesquise por nome">		       
			      </div> 

			      <div class="form-group mx-sm-3 mb-2">
			           	           
			          <input type="text" class="form-control" id="email" name="p_email" placeholder="Pesquise por email" > 
			      </div> 

			      <button type="submit" class="btn btn-primary mb-2" name = "pesquisar"> Pesquisar </button>
			     
			      <div class="form-group mx-sm-3 mb-2">			          
			         <button type="submit" class="btn btn-light" name = "pesquisa_todos"> Listar Todos </button>
			      </div>

			      <div class="form-group mx-sm-3 mb-2">
			         <a href="usuarioCad.php" class="btn btn-primary">Novo</a>
			      </div> 

			    </form>



			</div>
		</div>';  

        /*"table table-striped" */
		echo '<table class="table table-hover">    
			  <thead>
			    <tr>
			      <th scope="col">Id</th>
			      <th scope="col">Nome</th>
			      <th scope="col">Senha</th>
			      <th scope="col">Email</th>
			      <th scope="col">Tel</th>
			      <th scope="col-2">Acao</th>

			    </tr>
			  </thead>
			  <tbody>';
		$usuario = new UsuarioCtr();	
  

		if((isset($_GET['pesquisa_todos']) ) or (!isset($_GET['pesquisa_todos']) and !isset($_GET['pesquisar']) ) ):
			 
			foreach($usuario->listaUsuario() as $p_usuario):

				 
				echo '<tr>' .
				      '<th scope="row">' . $p_usuario['id'] . '</th>' .
				      '<td>' .  $p_usuario['nome']      . '</td> ' .
				      '<td>' .  $p_usuario['senha']      . '</td> ' .
				      '<td>' .  $p_usuario['email']         . '</td> ' .
				      '<td>' .  $p_usuario['tel']           . '</td> ' .
	          		  '<td><a href="usuarioCad.php?Id='  . $p_usuario['id'] . '&Altera=S'  . '">Alterar</a> </td>' .
	                  '<td><a href="excluirUsuario.php?Id=' . $p_usuario['id'] . '">Excluir</a> </td>'.
				      //'<td><button type="submit" name="excluir" onclick=excluir("'. $p_usuario['id'] . '")>Excluir</button> </td>'.  
				    '</tr>' .
				    '<input type="hidden"  name="Id" value='  . $p_usuario['id'] . '>';



			endforeach;

		elseif(isset($_GET['pesquisar'])):

			foreach($usuario->listaUsuarioF($_GET['p_nome'],$_GET['p_email']) as $p_usuario):
				//var_dump($p_usuario);
                //var_dump($p_usuario['id']);
				echo '<tr>' . 
				      '<th scope="row">' . $p_usuario['id'] . '</th>' .
				      '<td>' .  $p_usuario['nome']      . '</td> ' .
				      '<td>' .  $p_usuario['senha']      . '</td> ' .
				      '<td>' .  $p_usuario['email']         . '</td> ' .
				      '<td>' .  $p_usuario['tel']           . '</td> ' .
				      '<td><a href="usuarioCad.php?Id='  . $p_usuario['id'] . '&Altera=S'  . '">Alterar</a> </td>' .
	                  '<td><a href="excluirUsuario.php?Id=' . $p_usuario['id'] . '">Excluir</a> </td>'.
				     // '<td><button  type="submit" name="excluir" onclick=excluir("'. $p_usuario['id'] . '")>Excluir</button> </td>'.  



				    '</tr>'	.

				    '<input type="hidden"  name="Id" value='  . $p_usuario['id'] . '>';

			endforeach;	 

		endif;

		echo ' </tbody>
		   </table>';   
		 


		?>

 	</div>


<?php

  include_once "footer.php";

?>  