<?php

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
		 
		 if($pagina_anterior==0):
		 	$pagina_atual=1;
		 endif;

		 /* Cálcula qual será a proxima página em relação a página atual em exibição */   
		 $proxima_pagina = ($pagina_atual < $ultima_pagina) ? $pagina_atual +1 : 0 ;  
		   
		 /* Cálcula qual será a página inicial do nosso range */    
		 //var_dump($pagina_atual);
		 $range_inicial  = (($pagina_atual - RANGE_PAGINAS) >= 1) ? $pagina_atual - RANGE_PAGINAS : 1 ;   
		   
		 /* Cálcula qual será a página final do nosso range */    
		 $range_final   = (($pagina_atual + RANGE_PAGINAS) <= $ultima_pagina ) ? $pagina_atual + RANGE_PAGINAS : $ultima_pagina ;   
		   
		 /* Verifica se vai exibir o botão "Primeiro" e "Proximo" */   
		 $exibir_botao_inicio = ($range_inicial < $pagina_atual) ? 'mostrar' : 'esconder'; 
		   
		 /* Verifica se vai exibir o botão "Anterior" e "Último" */   
		 $exibir_botao_final = ($range_final > $pagina_atual) ? 'mostrar' : 'esconder';  
?>		 