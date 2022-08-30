<?php
ob_start();
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
    }
    else if($_SESSION['nivel']==2){
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

                    <div class="col-12 col-lg-12">
						<div class="card">
                        	<div class="card-body">
								<form method="GET" action="cadastrar.solicitacao.php">
                                    <table class="table table-hover table-striped">
                                        <thead>
                                            <tr>
                                            <th scope="col"></th>
                                            <th scope="col">Modelo</th>
                                            <th scope="col">Loja</th>
                                            <th scope="col">Setor</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                                
                                            <?php
                                                gerar_lista_solicitar_toner();
                                            ?>
                                        </tbody>
                                    </table>
								</form>
                            </div>
						</div>
					</div>
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
    ob_end_flush();
    echo "<h1>Usuário não conectado!</h1>";
    index();
}
?>