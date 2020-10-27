<?php
 
	
	class GrupoTabela{

		private $Id;
		private $nome;
		private $tabela;
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

		public function setTabela($id_GrupoTabela){
		 	$this->tabela = $id_GrupoTabela;
		}

		public function getTabela(){
			return $this->tabela;
		}				
		 
		
		public function setChave($chave){
		 	$this->chave = $chave;
		}

		public function getChave(){
			return $this->chave;
		}		


	}



?>