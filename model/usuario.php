<?php
 
	
	class Usuario{

		private $Id;
		private $nome;
		private $senha;
		private $email;
		private $tel;  

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
			 
		public function setEmail($email){
			$this->email = $email;
		}

		public function getEmail(){
			return $this->email;
		}

		public function setSenha($senha){
			$this->senha = $senha;
		}

		public function getSenha(){
			return $this->senha;
		}

		public function setTel($tel){
			$this->tel = $tel;
		}

		public function getTel(){
			return $this->tel;
		}


	}



?>