<?php
 
	
	class Filial{

		private $Id;
		private $nome;
		private $IdGrupo;
		 

		//private $sigla;
	 

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

		public function setGrupo($id_func){
		 	$this->IdGrupo = $id_func;
		}

		public function getGrupo(){
			return $this->IdGrupo;
		}				
		 
		 


	}



?>