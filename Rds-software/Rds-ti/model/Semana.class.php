<?php

    class Semana{
        private $dia;
        private $pessoa = array();
        private $folgaPessoa = array();
        private $pessoa_0;
        private $f_pessoa_0;
        private $pessoa_1;
        private $f_pessoa_1;
        private $pessoa_2;
        private $f_pessoa_2;
        private $pessoa_3;
        private $f_pessoa_4;
        private $pessoa_5;
        private $f_pessoa_5;
        private $pessoa_6;
        private $f_pessoa_6;
        private $pessoa_7;
        private $f_pessoa_7;
        private $pessoa_8;
        private $f_pessoa_8;
        private $pessoa_9;
        private $f_pessoa_9;
        private $pessoa_10;
        private $f_pessoa_10;
        private $pessoa_11;
        private $f_pessoa_11;
        


        public function __construct($dia){
            $this->dia = $dia;
            
            
            
            /*$this->pessoa_0 = null;
            $this->f_pessoa_0 = null;
            $this->pessoa_1= null;
            $this->f_pessoa_1 = null;
            $this->pessoa_2 = null;
            $this->f_pessoa_2 = null;
            $this->pessoa_3 = null;
            $this->f_pessoa_3 = null;
            $this->pessoa_4 = null;
            $this->f_pessoa_4 = null;
            $this->pessoa_5 = null;
            $this->f_pessoa_5 = null;
            $this->pessoa_6 = null;
            $this->f_pessoa_6 = null;
            $this->pessoa_7 = null;
            $this->f_pessoa_7 = null;
            $this->pessoa_8 = null;
            $this->f_pessoa_8 = null;
            $this->pessoa_9 = null;
            $this->f_pessoa_9 = null;
            $this->pessoa_10 = null;
            $this->f_pessoa_10 = null;
            $this->pessoa_11 = null;
            $this->f_pessoa_11 = null;*/

        }

        public function setDia($dia){
            $this->dia = $dia;
        }

        public function getDia(){
            return $this->dia;
        }

        public function setPessoa($nome){
            $this->pessoa[]=$nome;
        }

        public function getPessoa(){
            return $this->pessoa;
        }

        public function setFolgaPessoa($folga){
            $this->folgaPessoa[]=$folga;
        }

        public function getFolgaPessoa(){
            return $this->folgaPessoa;
            
        }

        /*public function setPessoa_0($pessoa){
            $this->pessoa_0 = $pessoa;
        }

        public function getPessoa_0(){
            return $this->pessoa_0;
        }

        public function setF_Pessoa_0($f_pessoa){
            $this->f_pessoa_0 = $f_pessoa;
        }

        public function getF_Pessoa_0(){
            return $this->f_pessoa_0;
        }

        public function setPessoa_1($pessoa){
            $this->pessoa_1 = $pessoa;
        }

        public function getPessoa_1(){
            return $this->pessoa_1;
        }

        public function setF_Pessoa_1($f_pessoa){
            $this->f_pessoa_1 = $f_pessoa;
        }

        public function getF_Pessoa_1(){
            return $this->f_pessoa_1;
        }

        public function setPessoa_2($pessoa){
            $this->pessoa_2 = $pessoa;
        }

        public function getPessoa_2(){
            return $this->pessoa_2;
        }

        public function setF_Pessoa_2($f_pessoa){
            $this->f_pessoa_2 = $f_pessoa;
        }

        public function getF_Pessoa_2(){
            return $this->f_pessoa_2;
        }

        public function setPessoa_3($pessoa){
            $this->pessoa_3 = $pessoa;
        }

        public function getPessoa_3(){
            return $this->pessoa_3;
        }

        public function setF_Pessoa_3($f_pessoa){
            $this->f_pessoa_3 = $f_pessoa;
        }

        public function getF_Pessoa_3(){
            return $this->f_pessoa_3;
        }

        public function setPessoa_4($pessoa){
            $this->pessoa_4 = $pessoa;
        }

        public function getPessoa_4(){
            return $this->pessoa_4;
        }

        public function setF_Pessoa_4($f_pessoa){
            $this->f_pessoa_4 = $f_pessoa;
        }

        public function getF_Pessoa_4(){
            return $this->f_pessoa_4;
        }

        public function setPessoa_5($pessoa){
            $this->pessoa_5 = $pessoa;
        }

        public function getPessoa_5(){
            return $this->pessoa_5;
        }

        public function setF_Pessoa_5($f_pessoa){
            $this->f_pessoa_5 = $f_pessoa;
        }

        public function getF_Pessoa_5(){
            return $this->f_pessoa_5;
        }

        public function setPessoa_6($pessoa){
            $this->pessoa_6 = $pessoa;
        }

        public function getPessoa_6(){
            return $this->pessoa_6;
        }

        public function setF_Pessoa_6($f_pessoa){
            $this->f_pessoa_6 = $f_pessoa;
        }

        public function getF_Pessoa_6(){
            return $this->f_pessoa_6;
        }

        public function setPessoa_7($pessoa){
            $this->pessoa_7 = $pessoa;
        }

        public function getPessoa_7(){
            return $this->pessoa_7;
        }

        public function setF_Pessoa_7($f_pessoa){
            $this->f_pessoa_7 = $f_pessoa;
        }

        public function getF_Pessoa_7(){
            return $this->f_pessoa_7;
        }

        public function setPessoa_8($pessoa){
            $this->pessoa_8 = $pessoa;
        }

        public function getPessoa_8(){
            return $this->pessoa_8;
        }

        public function setF_Pessoa_8($f_pessoa){
            $this->f_pessoa_8 = $f_pessoa;
        }

        public function getF_Pessoa_8(){
            return $this->f_pessoa_8;
        }

        public function setPessoa_9($pessoa){
            $this->pessoa_9 = $pessoa;
        }

        public function getPessoa_9(){
            return $this->pessoa_9;
        }

        public function setF_Pessoa_9($f_pessoa){
            $this->f_pessoa_9 = $f_pessoa;
        }

        public function getF_Pessoa_9(){
            return $this->f_pessoa_9;
        }

        public function setPessoa_10($pessoa){
            $this->pessoa_10 = $pessoa;
        }

        public function getPessoa_10(){
            return $this->pessoa_10;
        }

        public function setF_Pessoa_10($f_pessoa){
            $this->f_pessoa_10 = $f_pessoa;
        }

        public function getF_Pessoa_10(){
            return $this->f_pessoa_10;
        }

        public function setPessoa_11($pessoa){
            $this->pessoa_11 = $pessoa;
        }

        public function getPessoa_11(){
            return $this->pessoa_11;
        }

        public function setF_Pessoa_11($f_pessoa){
            $this->f_pessoa_11 = $f_pessoa;
        }

        public function getF_Pessoa_11(){
            return $this->f_pessoa_11;
        }*/

        

        
        
    }
?>