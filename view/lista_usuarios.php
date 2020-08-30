<?php
 
  session_start();

  require_once '../config.php';
  require_once ROOT_PATH . '/controller/usuarioCtr.php';  
  

  if(!isset($_SESSION['user'])):
  	header('Location:login.php');  
  endif;

  include_once "menuPrincipal.php";
  include_once "menu.php";
  include_once "confPaginacao.php"; 

  if(isset($_GET['p_nome'])): 
     $p_nome = filter_input(INPUT_GET, 'p_nome',FILTER_SANITIZE_STRING);   
     $_SESSION['arg1Tp'] = filter_var($p_nome,FILTER_SANITIZE_STRING); 
  else:  
     $_SESSION['arg1Tp'] = '';
   endif;

  if(isset($_GET['p_email'])):
     $p_email = filter_input(INPUT_GET, 'p_email',FILTER_SANITIZE_STRING);   
     $_SESSION['arg2Tp'] = filter_var($p_email,FILTER_SANITIZE_STRING);  
  else:  
     $_SESSION['arg2Tp'] = '';
   endif;   

   if (isset($_GET['pesquisa_todos'])):
   	   $_SESSION['arg1Tp'] = '';
   	   $_SESSION['arg2Tp'] = '';
   endif;	


  


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


		echo '
		<form >
	        <div class="row">
	          <div class="col-md-4 mb-3"> ';
				           
	        if (isset($_SESSION['arg1Tp'])):			      
				   echo '<input type="text" class="form-control"  name="p_nome" placeholder="Pesquise por Nome" value="' . $_SESSION['arg1Tp'] .'">';
	        else:
				   echo '<input type="text" class="form-control"  name="p_nome" placeholder="Pesquise por Nome">'; 

		    endif;

		    Echo '	      	       
 
	          </div>
	          <div class="col-md-4 mb-3">';
				           
	        if (isset($_SESSION['arg2Tp'])):			      
				   echo '<input type="text" class="form-control" id="email" name="p_email" placeholder="Pesquise por email"  value="' . $_SESSION['arg2Tp'] .'">';
	        else:
				   echo '<input type="text" class="form-control" id="email" name="p_email" placeholder="Pesquise por email" >' ;

		    endif;

		    Echo '	 
 
	          </div>
	        </div>

	        <div class="row">

		        <button type="submit" class="btn btn-primary mb-2 paramBtListagem" name = "pesquisar"> Pesquisar </button>
				<button type="submit" class="btn btn-light paramBtListagem" name = "pesquisa_todos"> Listar Todos </button>
				<a href="usuarioCad.php?novo=S" class="btn btn-primary paramBtListagem">  Novo  </a>

			</div>
        </form>
		';



/*

		ECHO '
		<div class="row">
			<div class="col-12">

			    <form class="form-inline" >
			      <div class="form-group mx-sm-3 mb-2">';
			           
        if (isset($_SESSION['arg1Tp'])):			      
			   echo '<input type="text" class="form-control"  name="p_nome" placeholder="Pesquise por Nome" value="' . $_SESSION['arg1Tp'] .'">';
        else:
			   echo '<input type="text" class="form-control"  name="p_nome" placeholder="Pesquise por Nome">'; 

	    endif;

	    Echo '	      	       
			      </div> 

			      <div class="form-group mx-sm-3 mb-2">';
			           
        if (isset($_SESSION['arg2Tp'])):			      
			   echo '<input type="text" class="form-control" id="email" name="p_email" placeholder="Pesquise por email"  value="' . $_SESSION['arg2Tp'] .'">';
        else:
			   echo '<input type="text" class="form-control" id="email" name="p_email" placeholder="Pesquise por email" >' ;

	    endif;

	    Echo '	      	       
			           	           
			          
			      </div> 

			      <button type="submit" class="btn btn-primary mb-2" name = "pesquisar"> Pesquisar </button>
			     
			      <div class="form-group mx-sm-3 mb-2">			          
			         <button type="submit" class="btn btn-light" name = "pesquisa_todos"> Listar Todos </button>
			      </div>

			      <div class="form-group mx-sm-3 mb-2">
			         <a href="usuarioCad.php?novo=S" class="btn btn-primary">Novo</a>
			      </div> 

			    </form>



			</div>
		</div>';  
*/
        /*"table table-striped" */
		echo '<table class="table table-hover">    
			  <thead>
			    <tr>
			      <th scope="col-2">Editar</th> 
			      <th scope="col">Nome</th>
			      <th scope="col">Email</th>
			      <th scope="col">Tel</th>
			      <th scope="col">Id</th>
			      

			    </tr>
			  </thead>
			  <tbody>';
		$usuario = new UsuarioCtr();	
  

		if((isset($_GET['pesquisa_todos']) ) or (!isset($_GET['pesquisa_todos']) and !isset($_GET['pesquisar']) ) ):
			 
            if($_SESSION['arg1Tp'] =='' and $_SESSION['arg2Tp'] ==''):
            	$aTab = $usuario->listaUsuario($linha_inicial);
            else:
            	$aTab = $usuario->listaUsuarioF($_SESSION['arg1Tp'],$_SESSION['arg2Tp'],$linha_inicial);
            endif; 

			foreach($aTab as $p_usuario):

				 
				echo '<tr>' .
				      '<td> <a href="usuarioCad.php?Id='  . $p_usuario['id'] . '&Altera=S'  . '"   "><img src="edit.png"width="32" height="32" placeholder="Editar" /></a>  </td>' . 
				      '<td>' .  $p_usuario['nome']      . '</td> ' .
				      '<td>' .  $p_usuario['email']         . '</td> ' .
				      '<td>' .  $p_usuario['tel']           . '</td> ' .
				      '<th scope="row">' . $p_usuario['id'] . '</th>' . 
	          		  
	                  //'<td><a href="excluirUsuario.php?Id=' . $p_usuario['id'] . '">Excluir</a> </td>'.



	                 // '<td><a href="" onclick=excluir("'. $p_usuario['id'] . '")>Excluir</a> </td>'.
	                  //'<td><button type="submit" name="excluir" onclick=excluir("'. $p_usuario['id'] . '")>Excluir</button> 
				      //'<td><button type="submit" name="excluir" onclick=excluir("'. $p_usuario['id'] . '")>Excluir</button> </td>'.  
				    '</tr>' .
				    '<input type="hidden"  name="Id" value='  . $p_usuario['id'] . '>'; 

			endforeach;

		elseif(isset($_GET['pesquisar'])):

			foreach($usuario->listaUsuarioF($_SESSION['arg1Tp'],$_SESSION['arg2Tp'],$linha_inicial) as $p_usuario):
				//var_dump($p_usuario);
                //var_dump($p_usuario['id']);
				echo '<tr>' . 
				      '<td> <a href="usuarioCad.php?Id='  . $p_usuario['id'] . '&Altera=S'  . '"   "><img src="edit.png"width="32" height="32" placeholder="Editar" /></a>  </td>' . 
				      '<td>' .  $p_usuario['nome']      . '</td> ' .
				      '<td>' .  $p_usuario['email']         . '</td> ' .
				      '<td>' .  $p_usuario['tel']           . '</td> ' .
				      '<th scope="row">' . $p_usuario['id'] . '</th>' . 
                       

	                 // '<td><a href="" onclick=excluir("'. $p_usuario['id'] . '")>Excluir</a> </td>'.
	                  //'<td><button type="submit" name="excluir" onclick=excluir("'. $p_usuario['id'] . '")>Excluir</button> 
				      //'<td><button type="submit" name="excluir" onclick=excluir("'. $p_usuario['id'] . '")>Excluir</button> </td>'.  
				    '</tr>' .
				    '<input type="hidden"  name="Id" value='  . $p_usuario['id'] . '>'; 


	                  //'<td><a href="excluirUsuario.php?Id=' . $p_usuario['id'] . '">Excluir</a> </td>'.
				     // '<td><button  type="submit" name="excluir" onclick=excluir("'. $p_usuario['id'] . '")>Excluir</button> </td>'.   

				    '</tr>'	.

				    '<input type="hidden"  name="Id" value='  . $p_usuario['id'] . '>';

			endforeach;	 

		endif;

		echo ' </tbody>
		   </table>';   
		 


		?>

		<?php  

		//Paginação 

			 if( (isset($_GET['pesquisa_todos']) ) or (!isset($_GET['pesquisa_todos']) and !isset($_GET['pesquisar']) ) ): 
  
		         if($_SESSION['arg1Tp'] =='' and $_SESSION['arg2Tp'] ==''):
		          	$aValor = $usuario->totRegistros('',''); 
		         else:
		          	$aValor = $usuario->totRegistros($_SESSION['arg1Tp'],$_SESSION['arg2Tp']); 
		         endif;

			 elseif(isset($_GET['pesquisar'])):  
			     $aValor = $usuario->totRegistros($_SESSION['arg1Tp'],$_SESSION['arg2Tp']);  
			 endif;

			 include_once "paginas.php";

         ?>

		 <div class='box-paginacao'>     
			   <a class='box-navegacao <?=$exibir_botao_inicio?> btn btn-light' href="lista_usuarios.php?page=<?=$primeira_pagina?>&p_nome=<?=$_SESSION['arg1Tp']?>&p_email=<?=$_SESSION['arg2Tp']?>" title="Primeira Página"><<</a>    
			   <a class='box-navegacao <?=$exibir_botao_inicio?> btn btn-light' href="lista_usuarios.php?page=<?=$pagina_anterior?>&p_nome=<?=$_SESSION['arg1Tp']?>&p_email=<?=$_SESSION['arg2Tp']?>" title="Página Anterior"><</a>     

			  <?php  

			  /* Loop para montar a páginação central com os números */   
			  for ($i=$range_inicial; $i <= $range_final; $i++):   
			    $destaque = ($i == $pagina_atual) ? 'destaque' : '' ;  
			    ?>   
			    <a class='box-numero <?=$destaque?>' href="lista_usuarios.php?page=<?=$i?>&p_nome=<?=$_SESSION['arg1Tp']?>&p_email=<?=$_SESSION['arg2Tp']?>"><?=$i?></a>    
			    <!--<a class='box-numero <?=$destaque?>' href="lista_tp.php?page=<?=$i?>"><?=$i?></a>     -->
			  <?php endfor; ?>    

			   <a class='box-navegacao <?=$exibir_botao_final?> btn btn-light ' href="lista_usuarios.php?page=<?=$proxima_pagina?>&p_nome=<?=$_SESSION['arg1Tp']?>&p_email=<?=$_SESSION['arg2Tp']?>" title="Próxima Página">></a>    
			   <a class='box-navegacao <?=$exibir_botao_final?> btn btn-light ' href="lista_usuarios.php?page=<?=$ultima_pagina?>&p_nome=<?=$_SESSION['arg1Tp']?>&p_email=<?=$_SESSION['arg2Tp']?>" title="Última Página">>></a>    
		 </div>   




 	</div>


<?php

  include_once "footer.php";

?>  