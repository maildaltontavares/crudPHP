
<?php

	require_once "../model/categoria.php";
	require_once "../model/categoriaDao.php";
	
	class CategoriaCtr{

		public function delete($p_id){

			$categoria = new categoria();
			$categoria->setId($p_id);

			$categoriaDao = new categoriaDao($categoria);  
			return $categoriaDao->delete($categoria); 


		}		

		public function buscacategoria($p_id){

			$categoria = new categoria();
			$categoria->setId($p_id);

			$categoriaDao = new categoriaDao($categoria);  
			return $categoriaDao->buscacategoria($categoria); 


		 } 


		public function update($p_id,$p_categoria){


			// Prepara Bean categoria
			$categoria = new categoria();
			$categoria->setId($p_id);
			$categoria->setNome($p_categoria); 

			//  Vzalida categoria
			$categoriaDao = new categoriaDao();
			$r = $categoriaDao->update($categoria); 
			return  $r;  
		 }


		public function create($p_categoria){


			// Prepara Bean categoria
			$categoria = new categoria();
			$categoria->setNome($p_categoria);  

			$categoriaDao = new categoriaDao();
			$r = $categoriaDao->create($categoria); 
			return  $r;  
		 }
 


		public function listacategoria(){

			$categoria = new categoriaDao();
			return $categoria->read();
			

		 } 


		public function listacategoriaF($p_categoria){

			// Prepara Bean categoria
			$categoria = new categoria();

			$categoria->setNome($p_categoria);
			 
			$categoriaDao = new categoriaDao();
			return $categoriaDao->readF($categoria);
			

		 } 


	}	 

?>
