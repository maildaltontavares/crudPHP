<?php
 
  session_start();

  require_once '../config.php';
  require_once ROOT_PATH . '/controller/tabpadCtr.php';  
  

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

   if (isset($_GET['pesquisa_todos'])):
   	   $_SESSION['arg1Tp'] = '';
   endif;	   
 

?>  
   <link rel="stylesheet" type="text/css" href="estiloVirtuax.css">
 
 <body>
	<div class="container" >  
		<?php   

		//echo '<h1 class="p-3 mb-2 bg-light text-dark">tabpads</h1>'; 
		echo '<h1 class="p-3 mb-2 text-dark">Grupo de Tabelas</h1>'; 

		Echo  '
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
		Echo '<table class="table table-hover">    
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

            if($_SESSION['arg1Tp'] ==''):
            	$aTab = $tabpad->listatabpad($linha_inicial);
            else:
            	$aTab = $tabpad->listatabpadF($_SESSION['arg1Tp'],$linha_inicial);
            endif;

            
			//foreach($tabpad->listatabpad($linha_inicial) as $p_tabpad):
            foreach($aTab as $p_tabpad):
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
 		      
 
					foreach($tabpad->listatabpadF($_SESSION['arg1Tp'],$linha_inicial) as $p_tabpad):

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

		<?php  

		//Paginação 

			 if( (isset($_GET['pesquisa_todos']) ) or (!isset($_GET['pesquisa_todos']) and !isset($_GET['pesquisar']) ) ): 

		         if($_SESSION['arg1Tp'] ==''):
		          	$aValor = $tabpad->totRegistros(''); 
		         else:
		          	$aValor = $tabpad->totRegistros($_SESSION['arg1Tp']); 
		         endif;

			 elseif(isset($_GET['pesquisar'])):  
			     $aValor = $tabpad->totRegistros($_SESSION['arg1Tp']);  
			 endif;

			 include_once "paginas.php";

         ?>

		 <div class='box-paginacao'>     
			   <a class='box-navegacao <?=$exibir_botao_inicio?> btn btn-light' href="lista_tp.php?page=<?=$primeira_pagina?>&p_nome=<?=$_SESSION['arg1Tp']?>" title="Primeira Página"><<</a>    
			   <a class='box-navegacao <?=$exibir_botao_inicio?> btn btn-light' href="lista_tp.php?page=<?=$pagina_anterior?>&p_nome=<?=$_SESSION['arg1Tp']?>" title="Página Anterior"><</a>     

			  <?php  

			  /* Loop para montar a páginação central com os números */   
			  for ($i=$range_inicial; $i <= $range_final; $i++):   
			    $destaque = ($i == $pagina_atual) ? 'destaque' : '' ;  
			    ?>   
			    <a class='box-numero <?=$destaque?>' href="lista_tp.php?page=<?=$i?>&p_nome=<?=$_SESSION['arg1Tp']?>"><?=$i?></a>    
			    <!--<a class='box-numero <?=$destaque?>' href="lista_tp.php?page=<?=$i?>"><?=$i?></a>     -->
			  <?php endfor; ?>    

			   <a class='box-navegacao <?=$exibir_botao_final?> btn btn-light' href="lista_tp.php?page=<?=$proxima_pagina?>&p_nome=<?=$_SESSION['arg1Tp']?>" title="Próxima Página">></a>    
			   <a class='box-navegacao <?=$exibir_botao_final?> btn btn-light ' href="lista_tp.php?page=<?=$ultima_pagina?>&p_nome=<?=$_SESSION['arg1Tp']?>" title="Última Página">>></a>    
		 </div>   


 	</div>


<?php

  include_once "footer.php";

?>  

</body> 

