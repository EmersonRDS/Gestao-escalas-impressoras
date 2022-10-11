<?php

    class Semana{
        private $dia;
        private $pessoa = array();
        private $folgaPessoa = array();
       
        
        public function __construct($dia){
            $this->dia = $dia;
            
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

        
    }
?>