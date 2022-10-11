<?php
include_once "../controller/conecta.php";
include_once "../controller/headers.php";
$conexao = db_connect();
session_start();

if(isset($_GET['escolheEscala'])){
    gerarArquivoWord();
}
?>