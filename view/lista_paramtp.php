<?php
 
  session_start(); 

  require_once '../config.php';
  require_once ROOT_PATH . '/controller/paramtpCtr.php';  
  require_once ROOT_PATH . '/bibliotecas/funcoes.php';  
  
  if(!isset($_SESSION['user'])):
  	header('Location:login.php');  
  endif;	

  //include_once "menuPrincipal.php";
  //include_once "menu.php"; 

  // Valida os acessos
  $acesso = new Funcao();
  $validaAcesso = $acesso->validaAcesso('00002');
  //var_dump($validaAcesso);

  if (strlen($validaAcesso)==0): 
     header('Location:semAcesso.php?tela="Parametrização de tabelas"'); 
     //exit; 
  endif; 

 // include_once "menuPrincipal.php";
 // include_once "menu.php"; 
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
          var vAcessos  = "<?php Echo $validaAcesso ?>"; 
          var vBtNovo   = vAcessos.indexOf("btNovo");  

          if (vBtNovo==-1){            
               /*$('#btNovo').attr('disabled', true);        
               $('#btNovo').addClass('disabled');   
           } 
   */

 })
</script> 

  <link rel="stylesheet" type="text/css" href="estiloVirtuax.css">

  	<style type="text/css">
  		.container{
  			z-index: 1; 	
  		}

    </style>
   	<div class="limiteTela" >
	<!--<div class="container"  style="">   -->
		<?php   

		//echo '<h1 class="p-3 mb-2 bg-light text-dark">tabpads</h1>'; 
		echo '<h1 class="p-3 mb-2 text-dark">Parametrização de Tabelas</h1>'; 


		echo '
		<form >
	        <div class="row">
	          <div class="col-md-8 mb-3"> ';
				           
	        if (isset($_SESSION['arg1Tp'])):			      
				   echo '<input type="text" class="form-control"  name="p_nome" placeholder="Pesquise por nome do grupo" value="' . $_SESSION['arg1Tp'] .'">';
	        else:
				   echo '<input type="text" class="form-control"  name="p_nome" placeholder="Pesquise por nome do grupo">'; 

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
                   '<a class="btn btn-primary  paramBtListagem" href="paramtpCad.php?novo=S" role="button" id="btNovo" >Novo</a> ';

              else:
                   Echo 
                   '<a class="btn btn-primary  paramBtListagem disabled" href="paramtpCad.php?novo=S" role="button" id="btNovo"  >Novo</a> ';

              endif; 
				 
		    
		    Echo '	 

			</div>
        </form>
		';
		echo '<table class="table table-hover">    
			  <thead>
			    <tr>
			      <th scope="col-2">Editar</th>
			      <th scope="col">Nome do Grupo</th>
			      <th scope="col">id</th>

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
				      '<td><a href="paramtpCad.php?Id='  . $p_paramtb['id'] . '&Altera=S'  . '"><img src="edit.png"width="32" height="32" placeholder="Editar" /></a> </td>' .
				      '<td>' .  $p_paramtb['nome_grupo']      . '</td> ' .  
	                   '<th scope="row">' . $p_paramtb['id'] . '</th>' .
				      //'<td><button type="submit" name="excluir" onclick=excluir("'. $p_paramtb['id'] . '")>Excluir</button> </td>'.  
				    '</tr>' .
				    '<input type="hidden"  name="Id" value='  . $p_paramtb['id'] . '>';



			endforeach;

		elseif(isset($_GET['pesquisar'])):

			foreach($paramtb->listaParamTbF($_SESSION['arg1Tp'],$linha_inicial) as $p_paramtb):

				echo '<tr>' .
				      '<td><a href="paramtpCad.php?Id='  . $p_paramtb['id'] . '&Altera=S'  . '"><img src="edit.png"width="32" height="32" placeholder="Editar" /></a> </td>' .
				      '<td>' .  $p_paramtb['nome_grupo']      . '</td> ' .  
	                   '<th scope="row">' . $p_paramtb['id'] . '</th>' .
				      //'<td><button type="submit" name="excluir" onclick=excluir("'. $p_paramtb['id'] . '")>Excluir</button> </td>'.  
				    '</tr>' .
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
			   <a class='box-navegacao <?=$exibir_botao_inicio?> btn btn-light paramBtPagin' href="lista_paramtp.php?page=<?=$primeira_pagina?>&p_nome=<?=$_SESSION['arg1Tp']?>" title="Primeira Página"><<</a>    
			   <a class='box-navegacao <?=$exibir_botao_inicio?> btn btn-light paramBtPagin ' href="lista_paramtp.php?page=<?=$pagina_anterior?>&p_nome=<?=$_SESSION['arg1Tp']?>" title="Página Anterior"><</a>     

			  <?php  

			  /* Loop para montar a páginação central com os números */   
			  for ($i=$range_inicial; $i <= $range_final; $i++):   
			    $destaque = ($i == $pagina_atual) ? 'destaque' : '' ;  
			    ?>  
		     <a class=' btn btn-light paramBtPag <?=$destaque?>' href="lista_paramtp.php?page=<?=$i?>&p_nome=<?=$_SESSION['arg1Tp']?>"> <?=$i?></a>  

			   <!-- <a class='box-numero <?=$destaque?>' href="lista_paramtp.php?page=<?=$i?>&p_nome=<?=$_SESSION['arg1Tp']?>"><?=$i?></a>    
			    <!--<a class='box-numero <?=$destaque?>' href="lista_tp.php?page=<?=$i?>"><?=$i?></a>     -->
			  <?php endfor; ?>    

			   <a class='box-navegacao <?=$exibir_botao_final?> btn btn-light paramBtPagin' href="lista_paramtp.php?page=<?=$proxima_pagina?>&p_nome=<?=$_SESSION['arg1Tp']?>" title="Próxima Página">></a>    
			   <a class='box-navegacao <?=$exibir_botao_final?> btn btn-light paramBtPagin ' href="lista_paramtp.php?page=<?=$ultima_pagina?>&p_nome=<?=$_SESSION['arg1Tp']?>" title="Última Página">>></a>    
		 </div>   

		

 	</div>


<?php
  include_once "menuNavRodape.php";
  //include_once "footer.php";

?>  