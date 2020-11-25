<?php
 
	
	class Leitura{

		private $Id; 
		private $filial;
		private $tear;
		private $dtLeitura;
		private $turno;
		private $leitura;
		private $rpm;
		private $par_trama;
		private $par_urdume;
		private $par_outros;
		private $dtInclusao;
		private $usrInclusao;
		private $dtAlteracao;
		private $usrAlteracao;  

		public function setId($Id){
			$this->Id = $Id;
		}

		public function getId(){
			return $this->Id;
		}		

		public function setFilial($filial){
			$this->filial = $filial;
		}

		public function getFilial(){
			return $this->filial;
		}

		public function setTear($tear){
			$this->tear = $tear;
		}

		public function getTear(){
			return $this->tear;
		}
		public function setDtLeitura($dtLeitura){
			$this->dtLeitura = $dtLeitura;
		}

		public function getDtLeitura(){
			return $this->dtLeitura;
		}		
		 
		public function setTurno($turno){
			$this->turno = $turno;
		}

		public function getTurno(){
			return $this->turno;
		}		 

		public function setLeitura($leitura){
			$this->leitura = $leitura;
		}

		public function getLeitura(){
			return $this->leitura;
		}	

		public function setRpm($rpm){
			$this->rpm = $rpm;
		}

		public function getRpm(){
			return $this->rpm;
		}	

		public function setParTrama($par_Trama){
			$this->par_trama = $par_Trama;
		}

		public function getParTrama(){
			return $this->par_trama;
		}	

		public function setParUrdume($par_urdume){
			$this->par_urdume = $par_urdume;
		}

		public function getParUrdume(){
			return $this->par_urdume;
		}	

		public function setParOutros($par_outros){
			$this->par_outros = $par_outros;
		}

		public function getParOutros(){
			return $this->par_outros;
		}	

		public function setDtInclusao($dtInclusao){
			$this->dtInclusao = $dtInclusao;
		}

		public function getDtInclusao(){
			return $this->dtInclusao;
		}	

		public function setUsrInclusao($usrInclusao){
			$this->usrInclusao = $usrInclusao;
		}

		public function getUsrInclusao(){
			return $this->usrInclusao;
		}	

		public function setDtAlteracao($dtAlteracao){
			$this->dtAlteracao = $dtAlteracao;
		}

		public function getDtAlteracao(){
			return $this->dtAlteracao;
		}	

		public function setUsrAlteracao($usrAlteracao){
			$this->usrAlteracao = $usrAlteracao;
		}

		public function getUsrAlteracao(){
			return $this->usrAlteracao;
		}			



	}



?>