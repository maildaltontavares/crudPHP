<?php
 
  session_start();

  require_once '../config.php';
  require_once ROOT_PATH . '/controller/paramtpCtr.php';  
  

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
			      <div class="form-group mx-sm-3 mb-2">';

			           
        if (isset($_SESSION['arg1Tp'])):			      
			   echo '<input type="text" class="form-control"  name="p_nome" placeholder="Pesquise nome do grupo"value="' . $_SESSION['arg1Tp'] .'">';
        else:
			   echo '<input type="text" class="form-control"  name="p_nome" placeholder="Pesquise nome do grupo">'; 

	    endif;

	    Echo '		    
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

            if($_SESSION['arg1Tp'] ==''):
            	$aTab = $paramtb->listaParamTb($linha_inicial);
            else:
            	$aTab = $paramtb->listaParamTbF($_SESSION['arg1Tp'],$linha_inicial);
            endif;

			 
			foreach($aTab as $p_paramtb):

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

			foreach($paramtb->listaParamTbF($_SESSION['arg1Tp'],$linha_inicial) as $p_paramtb):

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



		<?php  

		//Paginação 

			 if( (isset($_GET['pesquisa_todos']) ) or (!isset($_GET['pesquisa_todos']) and !isset($_GET['pesquisar']) ) ): 

		         if($_SESSION['arg1Tp'] ==''):
		          	$aValor = $paramtb->totRegistros(''); 
		         else:
		          	$aValor = $paramtb->totRegistros($_SESSION['arg1Tp']); 
		         endif;

			 elseif(isset($_GET['pesquisar'])):  
			     $aValor = $paramtb->totRegistros($_SESSION['arg1Tp']);  
			 endif;

			 include_once "paginas.php";

         ?>

		 <div class='box-paginacao'>     
			   <a class='box-navegacao <?=$exibir_botao_inicio?> btn btn-light' href="lista_paramtp.php?page=<?=$primeira_pagina?>&p_nome=<?=$_SESSION['arg1Tp']?>" title="Primeira Página"><<</a>    
			   <a class='box-navegacao <?=$exibir_botao_inicio?> btn btn-light' href="lista_paramtp.php?page=<?=$pagina_anterior?>&p_nome=<?=$_SESSION['arg1Tp']?>" title="Página Anterior"><</a>     

			  <?php  

			  /* Loop para montar a páginação central com os números */   
			  for ($i=$range_inicial; $i <= $range_final; $i++):   
			    $destaque = ($i == $pagina_atual) ? 'destaque' : '' ;  
			    ?>   
			    <a class='box-numero <?=$destaque?>' href="lista_paramtp.php?page=<?=$i?>&p_nome=<?=$_SESSION['arg1Tp']?>"><?=$i?></a>    
			    <!--<a class='box-numero <?=$destaque?>' href="lista_tp.php?page=<?=$i?>"><?=$i?></a>     -->
			  <?php endfor; ?>    

			   <a class='box-navegacao <?=$exibir_botao_final?> btn btn-light' href="lista_paramtp.php?page=<?=$proxima_pagina?>&p_nome=<?=$_SESSION['arg1Tp']?>" title="Próxima Página">></a>    
			   <a class='box-navegacao <?=$exibir_botao_final?> btn btn-light ' href="lista_paramtp.php?page=<?=$ultima_pagina?>&p_nome=<?=$_SESSION['arg1Tp']?>" title="Última Página">>></a>    
		 </div>   

		

 	</div>


<?php

  include_once "footer.php";

?>  