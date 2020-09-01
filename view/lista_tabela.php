<?php
 
  session_start();

  require_once '../config.php';
  require_once ROOT_PATH . '/controller/tabelaCtr.php';  
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
  	<div class="limiteTela" >
	<!--<div class="container">   -->
		<?php   

			//echo '<h1 class="p-3 mb-2 bg-light text-dark">tabelas</h1>'; 
			echo '<h1 class="p-3 mb-2 text-dark">Tabela de ' . $nometabpad .  '</h1>'; 

			echo '
			<form >
		        <div class="row">
		          <div class="col-md-8 mb-3"> ';
					           
		        if (isset($_SESSION['arg1Tp'])):			      
					   echo '<input type="text" class="form-control"  name="p_nome" placeholder="Pesquise por descrição" value="' . $_SESSION['arg1Tp'] .'">';
		        else:
					   echo '<input type="text" class="form-control"  name="p_nome" placeholder="Pesquise por descrição">'; 

			    endif;

			    Echo '	      	       
	 
		            </div>
		          
		        </div>

		        <div class="row">

			        <button type="submit" class="btn btn-primary mb-2 paramBtListagem" name = "pesquisar"> Pesquisar </button>
					<button type="submit" class="btn btn-light paramBtListagem" name = "pesquisa_todos"> Listar Todos </button>
					<a href="tabelaCad.php?novo=S" class="btn btn-primary paramBtListagem">  Novo  </a>

				</div>
	        </form>
			';

	        /*"table table-striped" */
			echo '<table class="table table-hover">    
				  <thead>
				    <tr>
				    <th scope="col-2">Editar</th>
				      
				      <th scope="col">Descrição</th>
				      <th scope="col">Tabela</th>
				      <th scope="col">id</th>

	 
				      

				    </tr>
				  </thead>
				  <tbody>';
			$tabela = new tabelaCtr();	
	  

			if( (isset($_GET['pesquisa_todos']) ) or (!isset($_GET['pesquisa_todos']) and !isset($_GET['pesquisar']) ) ):
				 
	            if($_SESSION['arg1Tp'] ==''):
	            	$aTab = $tabela->listaTabela($sigla,$linha_inicial);
	            else:
	            	$aTab = $tabela->listaTabelaF($_SESSION['arg1Tp'],$sigla,$linha_inicial);
	            endif;

				foreach($aTab as $p_tabela):

					echo '<tr>' .
					      '<td><a href="tabelaCad.php?Id='  . $p_tabela['id'] . '&Altera=S'  . '"><img src="edit.png"width="32" height="32" placeholder="Editar" /></a> </td>' .
					      '<td>' .  $p_tabela['str1']      . '</td> ' .
					      '<td>' .  $p_tabela['nome_grupo']      . '</td> ' .   
		                  '<th scope="row">' . $p_tabela['id'] . '</th>' .
					      //'<td><button type="submit" name="excluir" onclick=excluir("'. $p_tabela['id'] . '")>Excluir</button> </td>'.  
					    '</tr>' .
					    '<input type="hidden"  name="Id" value='  . $p_tabela['id'] . '>'; 

				endforeach;

			elseif(isset($_GET['pesquisar'])):

				foreach($tabela->listaTabelaF($_SESSION['arg1Tp'],$sigla,$linha_inicial) as $p_tabela):

					echo '<tr>' .
					      '<td><a href="tabelaCad.php?Id='  . $p_tabela['id'] . '&Altera=S'  . '"><img src="edit.png"width="32" height="32" placeholder="Editar" /></a> </td>' .
					      '<td>' .  $p_tabela['str1']      . '</td> ' .
					      '<td>' .  $p_tabela['nome_grupo']      . '</td> ' .   
		                  '<th scope="row">' . $p_tabela['id'] . '</th>' .
					      //'<td><button type="submit" name="excluir" onclick=excluir("'. $p_tabela['id'] . '")>Excluir</button> </td>'.  
					    '</tr>' .

					    '<input type="hidden"  name="Id" value='  . $p_tabela['id'] . '>';

				endforeach;	 

			endif;

			echo ' </tbody>
			   </table>';   
		 


		?>


		<?php  

		//Paginação 

			 if( (isset($_GET['pesquisa_todos']) ) or (!isset($_GET['pesquisa_todos']) and !isset($_GET['pesquisar']) ) ): 

		         if($_SESSION['arg1Tp'] ==''):
		          	$aValor = $tabela->totRegistros('',$sigla); 
		         else:
		          	$aValor = $tabela->totRegistros($_SESSION['arg1Tp'],$sigla); 
		         endif;

			 elseif(isset($_GET['pesquisar'])):  
			     $aValor = $tabela->totRegistros($_SESSION['arg1Tp'],$sigla);  
			 endif;

			 include_once "paginas.php";

         ?>

		 <div class='box-paginacao'>     
			   <a class='box-navegacao <?=$exibir_botao_inicio?> btn btn-light' href="lista_tabela.php?page=<?=$primeira_pagina?>&p_nome=<?=$_SESSION['arg1Tp']?>" title="Primeira Página"><<</a>    
			   <a class='box-navegacao <?=$exibir_botao_inicio?> btn btn-light' href="lista_tabela.php?page=<?=$pagina_anterior?>&p_nome=<?=$_SESSION['arg1Tp']?>" title="Página Anterior"><</a>     

			  <?php  

			  /* Loop para montar a páginação central com os números */   
			  for ($i=$range_inicial; $i <= $range_final; $i++):   
			    $destaque = ($i == $pagina_atual) ? 'destaque' : '' ;  
			    ?>   
			    <a class='box-numero <?=$destaque?>' href="lista_tabela.php?page=<?=$i?>&p_nome=<?=$_SESSION['arg1Tp']?>"><?=$i?></a>    
			    <!--<a class='box-numero <?=$destaque?>' href="lista_tp.php?page=<?=$i?>"><?=$i?></a>     -->
			  <?php endfor; ?>    

			   <a class='box-navegacao <?=$exibir_botao_final?> btn btn-light' href="lista_tabela.php?page=<?=$proxima_pagina?>&p_nome=<?=$_SESSION['arg1Tp']?>" title="Próxima Página">></a>    
			   <a class='box-navegacao <?=$exibir_botao_final?> btn btn-light ' href="lista_tabela.php?page=<?=$ultima_pagina?>&p_nome=<?=$_SESSION['arg1Tp']?>" title="Última Página">>></a>    
		 </div> 



 	</div>


<?php

  include_once "footer.php";

?>  