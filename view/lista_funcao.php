<?php
 
  session_start();

  require_once '../config.php';
  require_once ROOT_PATH . '/controller/funcaoSistemaCtr.php';  
  

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
 	<div class="limiteTela" >
	<!--<div class="container" >   -->
		<?php   

		//echo '<h1 class="p-3 mb-2 bg-light text-dark">tabpads</h1>'; 
		echo '<h1 class="p-3 mb-2 text-dark">Funções do Sistema</h1>'; 

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
				<a href="funcaoSistemaCad.php?novo=S" class="btn btn-primary paramBtListagem">  Novo  </a>

			</div>
        </form>
		';
 
        /*"table table-striped" */
		Echo '<table class="table table-hover">    
			  <thead>
			    <tr>
			      <th scope="col-2">Editar</th>			      
			      <th scope="col">Descrição</th>
			      <th scope="col">id</th>
 
			      

			    </tr>
			  </thead>
			  <tbody>';

		$funcaoSistemaCtr = new FuncaoSistemaCtr();	 


		if( (isset($_GET['pesquisa_todos']) ) or (!isset($_GET['pesquisa_todos']) and !isset($_GET['pesquisar']) ) ):   

            if($_SESSION['arg1Tp'] ==''):
            	$aTab = $funcaoSistemaCtr->listaFuncaoSistema($linha_inicial);
            else:
            	$aTab = $funcaoSistemaCtr->listaFuncSysF($_SESSION['arg1Tp'],$linha_inicial);
            endif;

            ///var_dump($aTab);
            
			//foreach($funcaoSistema->FuncaoSistemaCtr($linha_inicial) as $p_funcaoSistema):
            foreach($aTab as $p_funcaoSistema):
				echo '<tr>' .
	          		  '<td><a href="funcaoSistemaCad.php?Id='  . $p_funcaoSistema['id'] . '&Altera=S'  . '"><img src="edit.png"width="32" height="32" placeholder="Editar" /></a> </td>' .
				      '<td>' .  $p_funcaoSistema['descricao']      . '</td> ' .
				      '<th scope="row">' . $p_funcaoSistema['id'] . '</th>' .				  


	 
				      //'<td><button type="submit" name="excluir" onclick=excluir("'. $p_funcaoSistema['id'] . '")>Excluir</button> </td>'.  
				    '</tr>' .
				    '<input type="hidden"  name="Id" value='  . $p_funcaoSistema['id'] . '>';



			endforeach;

		elseif(isset($_GET['pesquisar'])):
 		      
 
				foreach($funcaoSistemaCtr->listaFuncSysF($_SESSION['arg1Tp'],$linha_inicial) as $p_funcaoSistema):
		        	echo '<tr>' .
          		  '<td><a href="funcaoSistemaCad.php?Id='  . $p_funcaoSistema['id'] . '&Altera=S'  . '"><img src="edit.png"width="32" height="32" placeholder="Editar" /></a> </td>' .
			      '<td>' .  $p_funcaoSistema['descricao']      . '</td> ' .
			      '<th scope="row">' . $p_funcaoSistema['id'] . '</th>' .		

					    '</tr>'	.

					    '<input type="hidden"  name="Id" value='  . $p_funcaoSistema['id'] . '>';

				endforeach;	 
	 

			 
		endif;

		echo ' </tbody>
		   </table>';   
		 


		?>

		<?php  

		//Paginação 

			 if( (isset($_GET['pesquisa_todos']) ) or (!isset($_GET['pesquisa_todos']) and !isset($_GET['pesquisar']) ) ): 

		         if($_SESSION['arg1Tp'] ==''):
		          	$aValor = $funcaoSistemaCtr->totRegistros(''); 
		         else:
		          	$aValor = $funcaoSistemaCtr->totRegistros($_SESSION['arg1Tp']); 
		         endif;

			 elseif(isset($_GET['pesquisar'])):  
			     $aValor = $funcaoSistemaCtr->totRegistros($_SESSION['arg1Tp']);  
			 endif;

			 include_once "paginas.php";

         ?>

		 <div class='box-paginacao'>     
			   <a class='box-navegacao <?=$exibir_botao_inicio?> btn btn-light' href="lista_funcao.php?page=<?=$primeira_pagina?>&p_nome=<?=$_SESSION['arg1Tp']?>" title="Primeira Página"><<</a>    
			   <a class='box-navegacao <?=$exibir_botao_inicio?> btn btn-light' href="lista_funcao.php?page=<?=$pagina_anterior?>&p_nome=<?=$_SESSION['arg1Tp']?>" title="Página Anterior"><</a>     

			  <?php  

			  /* Loop para montar a páginação central com os números */   
			  for ($i=$range_inicial; $i <= $range_final; $i++):   
			    $destaque = ($i == $pagina_atual) ? 'destaque' : '' ;  
			    ?>   
			    <a class='box-numero <?=$destaque?>' href="lista_funcao.php?page=<?=$i?>&p_nome=<?=$_SESSION['arg1Tp']?>"><?=$i?></a>    
			    <!--<a class='box-numero <?=$destaque?>' href="lista_funcao.php?page=<?=$i?>"><?=$i?></a>     -->
			  <?php endfor; ?>    

			   <a class='box-navegacao <?=$exibir_botao_final?> btn btn-light' href="lista_funcao.php?page=<?=$proxima_pagina?>&p_nome=<?=$_SESSION['arg1Tp']?>" title="Próxima Página">></a>    
			   <a class='box-navegacao <?=$exibir_botao_final?> btn btn-light ' href="lista_funcao.php?page=<?=$ultima_pagina?>&p_nome=<?=$_SESSION['arg1Tp']?>" title="Última Página">>></a>    
		 </div>   


 	</div>


<?php

  include_once "footer.php";

?>  

</body> 

