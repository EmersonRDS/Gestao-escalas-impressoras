<?php

    class Impressora{
        private $modelo;
        private $serial;
        private $toner;
        private $setor;
        private $ip;
        private $concerto;
        private $solicitacao;
        private $loja;



        public function __construct($m, $s, $ip, $setor, $loja){
            $this->modelo = $m;
            $this->serial = $s;
            $this->ip = $ip;
            $this->setor = $setor;
            $this->loja = $loja;

        }

        public function setModelo($m){
            $this->modelo = $m;
        }

        public function getModelo(){
            return $this->modelo;
        }

        public function setSerial($s){
            $this->serial = $s;
        }

        public function getSerial(){
            return $this->serial;
        }

        public function setToner($t){
            $this->toner = $t;
        }

        public function getToner(){
            return $this->toner;
        }

        public function setSetor($s){
            $this->setor = $s;
        }

        public function getSetor(){
            return $this->setor;
        }

        public function setIp($ip){
            $this->ip = $ip;
        }

        public function getip(){
            return $this->ip;
        }

        public function setConcerto($c){
            $this->concerto = $c;
        }

        public function getConcerto(){
            return $this->concerto;
        }

        public function setSolicitacao($s){
            $this->solicitacao = $s;
        }

        public function getSolicitacao(){
            return $this->solicitacao;
        }

        public function setloja($l){
            $this->loja = $l;
        }

        public function getLoja(){
            return $this->loja;
        }
        
    }
?>