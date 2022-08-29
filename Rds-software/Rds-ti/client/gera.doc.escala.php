<?php
include_once "../controller/conecta.php";
include_once "../controller/headers.php";
$conexao = db_connect();
session_start();

if(isset($_GET['arquivaEscala'])){
    arquivarEscala();
}


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
					
				?>

        <div class="main">
            
            <?php
                include_once "menu.logout.php";
            ?>  

            <main class="content">

            <div class="container-fluid p-0">

                <form method="GET" action="gera.arquivo.php">
                    <div class="row">
                        <div class="col-12 col-lg-2">
                            <div class="card">
                                <div class="card-header" style="text-align:center;">
                                    <h5 class="card-title mb-0">Gerar arquivo word!</h5>
                                </div>
                                <div class="card-body">
                                    <div style="text-align:center;">
                                        <button  type='submit' class="btn btn-success" name="escolheEscala" value="<?php echo $_GET['escolheEscala']; ?>">Gerar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

                <div class="container-fluid p-0">
						<?php
                            gerarEscalaCompleta();
                           
                            
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