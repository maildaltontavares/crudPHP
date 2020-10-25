<?php
 
	
	class GrupoUsuario{

		private $Id;
		private $nome; 
		private $chave;
		private $itens;

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
 
		public function setItens($p_itens){
			$this->itens = $p_itens;
		}

		public function getItens(){
			return $this->itens;
		}

		public function setChave($chave){
		 	$this->chave = $chave;
		}

		public function getChave(){
			return $this->chave;
		}	
		

	}



?>