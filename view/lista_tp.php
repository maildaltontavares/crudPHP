<?php
 
  session_start();

  require_once '../config.php';
  require_once ROOT_PATH . '/controller/tabpadCtr.php';  
  

  if(!isset($_SESSION['user'])):
  	header('Location:login.php');  
  endif;	

  include_once "menuPrincipal.php";
  include_once "menu.php"; 

  /* Recebe o número da página via parâmetro na URL */  
  $pagina_atual = (isset($_GET['page']) && is_numeric($_GET['page'])) ? $_GET['page'] : 1;   
  
  /* Calcula a linha inicial da consulta */  
 
  $linha_inicial = ($pagina_atual -1) * QTDE_REGISTROS;    
 
?>  
   <link rel="stylesheet" type="text/css" href="estiloVirtuax.css">
 
 <body>
	<div class="container" >  
		<?php   

		//echo '<h1 class="p-3 mb-2 bg-light text-dark">tabpads</h1>'; 
		echo '<h1 class="p-3 mb-2 text-dark">Grupo de Tabelas</h1>'; 

		ECHO '
		<div class="row">
			<div class="col-12">

			    <form class="form-inline" >
			      <div class="form-group mx-sm-3 mb-2">
			           
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

			foreach($tabpad->listatabpad($linha_inicial) as $p_tabpad):

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

			foreach($tabpad->listatabpadF($_GET['p_nome'],$linha_inicial) as $p_tabpad):

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
		     $aValor = $tabpad->totRegistros('');   
		 elseif(isset($_GET['pesquisar'])):  
		     $aValor = $tabpad->totRegistros($_GET['p_nome']);  
		 endif;
		 if(!empty($aValor)): 
            $valor = $aValor[0]['totreg']; 
         else:
            $valor = 0;
         endif;
		 /* Idêntifica a primeira página */  
		 $primeira_pagina = 1;   
		   
		 /* Cálcula qual será a última página */  
		 $ultima_pagina  = ceil( (int)$valor / QTDE_REGISTROS);  
		 
		 /* Cálcula qual será a página anterior em relação a página atual em exibição */   
		 $pagina_anterior = ($pagina_atual > 1) ? $pagina_atual -1 : 0 ;   
		   
		 /* Cálcula qual será a proxima página em relação a página atual em exibição */   
		 $proxima_pagina = ($pagina_atual < $ultima_pagina) ? $pagina_atual +1 : 0 ;  
		   
		 /* Cálcula qual será a página inicial do nosso range */    
		 $range_inicial  = (($pagina_atual - RANGE_PAGINAS) >= 1) ? $pagina_atual - RANGE_PAGINAS : 1 ;   
		   
		 /* Cálcula qual será a página final do nosso range */    
		 $range_final   = (($pagina_atual + RANGE_PAGINAS) <= $ultima_pagina ) ? $pagina_atual + RANGE_PAGINAS : $ultima_pagina ;   
		   
		 /* Verifica se vai exibir o botão "Primeiro" e "Proximo" */   
		 $exibir_botao_inicio = ($range_inicial < $pagina_atual) ? 'mostrar' : 'esconder'; 
		   
		 /* Verifica se vai exibir o botão "Anterior" e "Último" */   
		 $exibir_botao_final = ($range_final > $pagina_atual) ? 'mostrar' : 'esconder';  

		 ?>

		 <div class='box-paginacao'>     
			   <a class='box-navegacao <?=$exibir_botao_inicio?>' href="lista_tp.php?page=<?=$primeira_pagina?>" title="Primeira Página">Primeira</a>    
			   <a class='box-navegacao <?=$exibir_botao_inicio?>' href="lista_tp.php?page=<?=$pagina_anterior?>" title="Página Anterior">Anterior</a>     

			  <?php  
			  /* Loop para montar a páginação central com os números */   
			  for ($i=$range_inicial; $i <= $range_final; $i++):   
			    $destaque = ($i == $pagina_atual) ? 'destaque' : '' ;  
			    ?>   
			    <a class='box-numero <?=$destaque?>' href="lista_tp.php?page=<?=$i?>"><?=$i?></a>    
			  <?php endfor; ?>    

			   <a class='box-navegacao <?=$exibir_botao_final?>' href="lista_tp.php?page=<?=$proxima_pagina?>" title="Próxima Página">Próxima</a>    
			   <a class='box-navegacao <?=$exibir_botao_final?>' href="lista_tp.php?page=<?=$ultima_pagina?>" title="Última Página">Último</a>    
		 </div>   








 	</div>


<?php

  include_once "footer.php";

?>  

</body> 

