<?php
include_once "../model/Impressora.class.php";
include_once "../controller/conecta.php";
include_once "../controller/headers.php";
$conexao = db_connect();
session_start();


if(isset($_SESSION['usuario'])){
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
                    else if($_SESSION['nivel']==1){
                        include_once "nav.usuario.php";
                    }
					
				?>

        <div class="main">
            
            <?php
                include_once "menu.logout.php";
            ?>  

            <main class="content">
                <div class="container-fluid p-0">
					<?php

                        if($_SESSION['nivel']>=2){
                            gerarListaEscalaRh();
                        }
                        else if($_SESSION['nivel']==1){
                            gerarListaEscalaUsuario();
                        }

                    ?>
                </div>
            </main>

            <?php
                include_once "footer.php";
            ?>
        </div>
    </div>

    <script src="../js/app.js"></script>
</body>

</html>

<?php
}else{
    echo "<h1>Usuário desconectado!</h1>";
    header("Refresh:1; ../index.php");
}


?>