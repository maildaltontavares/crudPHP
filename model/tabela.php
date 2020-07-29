<?php
 
	
	class Tabela{

		private $Id;
		private $idTp;
		private $str1;
		private $str2;
		private $str3;
		private $flag1;
		private $flag2;
		private $flag3;
		private $num1;
		private $num2;
		private $num3;
        private $data1;
        private $data2;
        private $data3;
		private $descTabPad; 
		private $sigla;

		public function setSigla($sigla){
			$this->sigla = $sigla;
		}

		public function getSigla(){
			return $this->sigla;
		}

		public function setData3($data3){
			$this->data3 = $data3;
		}

		public function getData3(){
			return $this->data3;
		} 
		public function setData2($data2){
			$this->data2 = $data2;
		}

		public function getData2(){
			return $this->data2;
		} 
		public function setData1($data1){
			$this->data1 = $data1;
		}

		public function getData1(){
			return $this->data1;
		}

		public function setNum1($num1){
			$this->num1 = $num1;
		}

		public function getNum1(){
			return $this->num1;
		}


		public function setNum2($num2){
			$this->num2 = $num2;
		}

		public function getNum2(){
			return $this->num2;
		}	
		
		public function setNum3($num3){
			$this->num3 = $num3;
		}

		public function getNum3(){
			return $this->num3;
		}	 

		public function setDescTabPad($descTabPad){
			$this->descTabPad = $descTabPad;
		}

		public function getDescTabPad(){
			return $this->descTabPad;
		}	 

		public function setFlag3($flag3){
			$this->flag3 = $flag3;
		}

		public function getFlag3(){
			return $this->flag3;
		}	 

		public function setFlag2($flag2){
			$this->flag2 = $flag2;
		}

		public function getFlag2(){
			return $this->flag2;
		} 

		public function setFlag1($flag1){
			$this->flag1 = $flag1;
		}

		public function getFlag1(){
			return $this->flag1;
		} 

		public function setStr3($str3){
			$this->str3 = $str3;
		}

		public function getStr3(){
			return $this->str3;
		}	 

		public function setStr2($str2){
			$this->str2 = $str2;
		}

		public function getStr2(){
			return $this->str2;
		}	 	

		public function setStr1($str1){
			$this->str1 = $str1;
		}

		public function getStr1(){
			return $this->str1;
		}	


		public function setId($Id){
			$this->Id = $Id;
		}

		public function getId(){
			return $this->Id;
		}		

		public function setIdTp($idTp){
			$this->idTp = $idTp;
		}

		public function getIdTp(){
			return $this->idTp;
		}
		 


	}



?>