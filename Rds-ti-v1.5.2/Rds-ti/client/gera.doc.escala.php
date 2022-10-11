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
                    }else{
                        include_once "nav.usuario.php";
                    }
					
				?>

        <div class="main">
            
            <?php
                include_once "menu.logout.php";
            ?>  

            <main class="content">

                <div class="container-fluid p-0">
                    <div class="row">
                        <div class="col-3">
                            <div class="card">
                                <div class="card-header" style="text-align:center;">
                                    <h5 class="card-title mb-0">Gerar arquivo word!</h5>
                                </div>
                                <form method="GET" action="gera.arquivo.php">
                                    <div class="card-body">
                                        <div style="text-align:center;">
                                            <button  type='submit' class="btn btn-success" name="escolheEscala" value="<?php echo $_GET['escolheEscala']; ?>">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-download align-middle me-2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
                                                Gerar
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="card">
                                <div class="card-header" style="text-align:center;">
                                    <h5 class="card-title mb-0">Editar escala!</h5>
                                </div>
                                <form method="GET" action="envia.escala.php">
                                <div class="card-body">
                                    <div style="text-align:center;">
                                        <button  type='submit' class="btn btn-info" name="escolheEscala" value="<?php echo $_GET['escolheEscala']; ?>">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-3 align-middle me-2"><path d="M12 20h9"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path></svg>
                                            alterar
                                        </button>
                                    </div>
                                </div>
                                </form>
                            </div>
                        </div>        
                    </div>
                </div>

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