<?php
 
	
	class GrupoEmpresa{

		private $Id;
		private $nome;
		 
	 

		public function setId($Id){
			$this->Id = $Id;
		}

		public function getId(){
			return $this->Id;
		}		

		public function setNome($nome){
			$this->nome = $nome;
		}

		public function getNome(){
			return $this->nome;
		}

		 
		 


	}



?>