<?php
 
	
	class Usuario{

		private $Id;
		private $nome;
		private $senha;
		private $email;
		private $tel;  
		private $chave;
		private $itens;		
		private $filial;		
		private $filialPad;	
		private $bloqueado; 
		private $dtInclusao;
		private $dtAlteracao;
		private $chaveAutenticacao;
		private $alterSenhaPrxLogin;
		private $chaveAltSenha;

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


		public function setFilial($p_fil){
			$this->filial = $p_fil;
		}

		public function getFilial(){
			return $this->filial;
		}	 
	 
		public function setFilialPad($p_fil){
			$this->filialPad = $p_fil;
		}

		public function getFilialPad(){
			return $this->filialPad;
		}

		public function setBloqueado($p_blq){
			$this->bloqueado = $p_blq;
		}

		public function getBloqueado(){
			return $this->bloqueado;
		}

		public function setDtInclusao($p_dt_inc){
			$this->dtInclusao = $p_dt_inc;
		}

		public function getDtInclusao(){
			return $this->dtInclusao;
		}

 		public function setDtAlteracao($p_dt_alt){
			$this->dtAlteracao = $p_dt_alt;
		}

		public function getDtAlteracao(){
			return $this->dtAlteracao;
		}
 
  		public function setChaveAutenticacao($p_chave_aut){
			$this->chaveAutenticacao = $p_chave_aut;
		}

		public function getChaveAutenticacao(){
			return $this->chaveAutenticacao;
		}
 
   		public function setAlterSenhaPrxLogin($p_alter_pwd){
			$this->alterSenhaPrxLogin = $p_alter_pwd;
		}

		public function getAlterSenhaPrxLogin(){
			return $this->alterSenhaPrxLogin;
		}
 		
  		public function setChaveAltSenha($p_chaveAltSenha){
			$this->chaveAltSenha = $p_chaveAltSenha;
		}

		public function getChaveAltSenha(){
			return $this->chaveAltSenha;
		}
 	 

	}



?>