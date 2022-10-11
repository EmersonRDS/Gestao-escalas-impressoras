<?php
    function cadastrar_Impressora(){
        header("Refresh:3; ../client/cadastrar.impressora.php");
    }

    function cadastrar_Usuario(){
        header("Refresh:3; ../client/cadastrar.usuario.php");
    }

    function alterar_Impressora(){
        header("Refresh:3; ../client/lista.impressora.php");
    }

    function muda_Senha(){
        header("Refresh:0;../client/edita.senha.php");
    }

    function index(){
        header("Refresh:1; ../client/index.php");
    }

    function alterar_Usuario(){
        header("Refresh:3; ../client/lista.usuario.php");
    }

    function envia_Escala(){
        header("Refresh:3; ../client/envia.escala.php");
    }

    function lista_Escala(){
        header("Refresh:3; ../client/lista.escala.php");
    }
?>