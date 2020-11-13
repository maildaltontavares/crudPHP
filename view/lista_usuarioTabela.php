<?php
 
  session_start(); 
 
  require_once '../config.php';
  require_once ROOT_PATH . '/controller/usuarioTabelaCtr.php';  
  require_once ROOT_PATH . '/bibliotecas/funcoes.php';  
  
  if(!isset($_SESSION['user'])):
  	header('Location:login.php');  
  endif;	

  //include_once "menuPrincipal.php";
  //include_once "menu.php"; 

  // Valida os acessos
  $acesso = new Funcao();
  $validaAcesso = $acesso->validaAcesso('00014');
 //var_dump($acesso->validaAcesso('00001'));
  if (strlen($validaAcesso)==0): 
     header('Location:semAcesso.php?tela="Usuario tabela"'); 
     //exit; 
  endif;

  //include_once "menuPrincipal.php";
  //include_once "menu.php"; 
  include_once "menuNavCab.php";
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

<script  src="https://code.jquery.com/jquery-3.5.1.js"  integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="  crossorigin="anonymous"></script>

<script>  

  $(document).ready(function(){   
/*
          var vAcessos  = "<?php //Echo $validaAcesso ?>"; 
          var vBtNovo   = vAcessos.indexOf("btNovo");  

          if (vBtNovo==-1){            
               /*$('#btNovo').attr('disabled', true);       
               $('#btNovo').addClass('disabled');   
           } 

*/
 })
</script> 
   <link rel="stylesheet" type="text/css" href="estiloVirtuax.css">
 
 <body>
 	<div class="limiteTela" >
	<!--<div class="container" >  -->
		<?php   

		//echo '<h1 class="p-3 mb-2 bg-light text-dark">tabpads</h1>'; 
		echo '<h1 class="p-3 mb-2 text-dark">Tabelas usuários</h1>'; 

		echo '
		<form >
	        <div class="row">
	          <div class="col-md-8 mb-3"> ';
				           
	        if (isset($_SESSION['arg1Tp'])):			      
				   echo '<input type="text" class="form-control"  name="p_nome" placeholder="Pesquise por nome" value="' . $_SESSION['arg1Tp'] .'">';
	        else:
				   echo '<input type="text" class="form-control"  name="p_nome" placeholder="Pesquise por nome">'; 

		    endif;

		    Echo '	      	       
 
	            </div>
	          
	        </div>

	        <div class="row">

		        <button type="submit" class="btn btn-primary mb-2 paramBtListagem" name = "pesquisar"> Pesquisar </button>
				<button type="submit" class="btn btn-light paramBtListagem" name = "pesquisa_todos"> Listar Todos </button> 
            ';
             
              $vBtNovo    = strpos($validaAcesso,"btNovo");
              if($vBtNovo>=0  and $vBtNovo!=false): 
                   Echo 
                   '<a class="btn btn-primary  paramBtListagem" href="perfilCad.php?novo=S" role="button" id="btNovo" >Novo</a> ';

              else:
                   Echo 
                   '<a class="btn btn-primary  paramBtListagem disabled" href="perfilCad.php?novo=S" role="button" id="btNovo"  >Novo</a> ';

              endif; 
				 
		    
		    Echo '	

			</div>
        </form>
		';
 
        /*"table table-striped" */
		Echo '<table class="table table-hover">    
			  <thead>
			    <tr>
			      <th scope="col-2">Editar</th>			      
			      <th scope="col">Nome</th>
			      <th scope="col">id</th>
 
			      

			    </tr>
			  </thead>
			  <tbody>';

		$perfil = new PerfilCtr();	 


		if( (isset($_GET['pesquisa_todos']) ) or (!isset($_GET['pesquisa_todos']) and !isset($_GET['pesquisar']) ) ):   

            if($_SESSION['arg1Tp'] ==''):
            	$aTab = $perfil->listaPerfil($linha_inicial);
            else:
            	$aTab = $perfil->listaPerfilF($_SESSION['arg1Tp'],$linha_inicial);
            endif;

            
			//foreach($perfil->listaPerfil($linha_inicial) as $p_perfil):
            foreach($aTab as $p_perfil):
				echo '<tr>' .
	          		  '<td><a href="perfilCad.php?Id='  . $p_perfil['id'] . '&Altera=S'  . '"><img src="edit.png"width="32" height="32" placeholder="Editar" /></a> </td>' .
				      '<td>' .  $p_perfil['descricao']      . '</td> ' .
				      '<th scope="row">' . $p_perfil['id'] . '</th>' .				  


	 
				      //'<td><button type="submit" name="excluir" onclick=excluir("'. $p_perfil['id'] . '")>Excluir</button> </td>'.  
				    '</tr>' .
				    '<input type="hidden"  name="Id" value='  . $p_perfil['id'] . '>';



			endforeach;

		elseif(isset($_GET['pesquisar'])):
 		      
 
				foreach($perfil->listaPerfilF($_SESSION['arg1Tp'],$linha_inicial) as $p_perfil):
		        	echo '<tr>' .
          		  '<td><a href="perfilCad.php?Id='  . $p_perfil['id'] . '&Altera=S'  . '"><img src="edit.png"width="32" height="32" placeholder="Editar" /></a> </td>' .
			      '<td>' .  $p_perfil['descricao']      . '</td> ' .
			      '<th scope="row">' . $p_perfil['id'] . '</th>' .		

					    '</tr>'	.

					    '<input type="hidden"  name="Id" value='  . $p_perfil['id'] . '>';

				endforeach;	 
	 

			 
		endif;

		echo ' </tbody>
		   </table>';   
		 


		?>

		<?php  

		//Paginação 

			 if( (isset($_GET['pesquisa_todos']) ) or (!isset($_GET['pesquisa_todos']) and !isset($_GET['pesquisar']) ) ): 

		         if($_SESSION['arg1Tp'] ==''):
		          	$aValor = $perfil->totRegistros(''); 
		         else:
		          	$aValor = $perfil->totRegistros($_SESSION['arg1Tp']); 
		         endif;

			 elseif(isset($_GET['pesquisar'])):  
			     $aValor = $perfil->totRegistros($_SESSION['arg1Tp']);  
			 endif;

			 include_once "paginas.php";

         ?>

		 <div class='box-paginacao'>     
			   <a class='box-navegacao <?=$exibir_botao_inicio?> btn btn-light paramBtPagin ' href="lista_perfil.php?page=<?=$primeira_pagina?>&p_nome=<?=$_SESSION['arg1Tp']?>" title="Primeira Página"><<</a>    
			   <a class='box-navegacao <?=$exibir_botao_inicio?> btn btn-light paramBtPagin ' href="lista_perfil.php?page=<?=$pagina_anterior?>&p_nome=<?=$_SESSION['arg1Tp']?>" title="Página Anterior"><</a>     

			  <?php  

			  /* Loop para montar a páginação central com os números */   
			  for ($i=$range_inicial; $i <= $range_final; $i++):   
			    $destaque = ($i == $pagina_atual) ? 'destaque' : '' ;  
			    ?>   

			     <a class=' btn btn-light paramBtPag <?=$destaque?>' href="lista_perfil.php?page=<?=$i?>&p_nome=<?=$_SESSION['arg1Tp']?>"> <?=$i?></a>  
			    
			    <!--<a class='box-numero <?=$destaque?>' href="lista_perfil.php?page=<?=$i?>&p_nome=<?=$_SESSION['arg1Tp']?>"><?=$i?></a>    
			    <a class='box-numero <?=$destaque?>' href="lista_perfil.php?page=<?=$i?>"><?=$i?></a>     -->
			  <?php endfor; ?>    

			   <a class='box-navegacao <?=$exibir_botao_final?> btn btn-light paramBtPagin ' href="lista_perfil.php?page=<?=$proxima_pagina?>&p_nome=<?=$_SESSION['arg1Tp']?>" title="Próxima Página">></a>    
			   <a class='box-navegacao <?=$exibir_botao_final?> btn btn-light paramBtPagin ' href="lista_perfil.php?page=<?=$ultima_pagina?>&p_nome=<?=$_SESSION['arg1Tp']?>" title="Última Página">>></a>    
		 </div>   


 	</div>


<?php

  //include_once "footer.php";
  include_once "menuNavRodape.php";
?>  

</body> 

