<?php
 
	
	class TabPad{

		private $Id;
		private $nome;
		private $sigla;
		private $sistema;
	 

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

		public function setSigla($sigla){
			$this->sigla = $sigla;
		}

		public function getSigla(){
			return $this->sigla;
		}				
		 
		public function setSistema($p_sistema){
			$this->sistema = $p_sistema;
		}

		public function getSistema(){
			return $this->sistema;
		}			 


	}



?>