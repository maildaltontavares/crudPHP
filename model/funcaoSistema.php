<?php
 
	
	class FuncaoSistema{

		private $Id;
		private $nome;
		private $IdFunc;
		private $IdAcao;
		private $chave;

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

		public function setFunc($id_func){
		 	$this->IdFunc = $id_func;
		}

		public function getFunc(){
			return $this->IdFunc;
		}				
		 
		public function setAcao($id_acao){
		 	$this->IdAcao = $id_acao;
		}

		public function getAcao(){
			return $this->IdAcao;
		}			 
		public function setChave($chave){
		 	$this->chave = $chave;
		}

		public function getChave(){
			return $this->chave;
		}		


	}



?>