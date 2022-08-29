<?php
ob_start();
include_once "../controller/conecta.php";
include_once "../controller/headers.php";
$conexao = db_connect();
session_start();



if(isset($_SESSION['usuario'])){
    if($_SESSION['nivel']>=2){
?>
<html lang="pt-br">

    <?php
        include_once "head.php";
    ?>

<body>
<div class="wrapper">

    <?php
        if($_SESSION['nivel']==3){
            include_once "nav.administrador.php";
        }else if($_SESSION['nivel']==2){
            include_once "nav.rh.php";
        }
        
    ?>
    <div class="main">
        <?php
            include_once "menu.logout.php";
        ?>

        <main class="content">

            <?php
                gerar_cadastro_usuario();
            ?>
                
        </main>

        <?php
            include_once "footer.php";
        ?>
            
    </div>

	<script src="../js/app.js"></script>
</div>
</body>

</html>
<?php

    }else{			//Fechando if de nivel de acesso
        ob_end_flush();
        echo "<h1>Usuário sem permissão!</h1>";
        index();
    }


}else{
    ob_end_flush();
    echo "<h1>Usuário não conectado!</h1>";
    index();
}
?>