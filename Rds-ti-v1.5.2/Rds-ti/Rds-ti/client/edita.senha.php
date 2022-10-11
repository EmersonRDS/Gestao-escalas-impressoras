<?php
include_once "../controller/conecta.php";
include_once "../controller/functions.php";
session_start();
$conexao=db_connect();

if(isset($_GET['btn_logout'])){
    deslogar();
}

if(isset($_POST['btn_login'])){
    testar_log();
}


?>
<html lang="pt-br">
    <?php
        include_once "head.php";
    ?>

<body>
    <div class="wrapper">
        <nav id="sidebar" class="sidebar js-sidebar">
            <div class="sidebar-content js-simplebar">
                <a class="sidebar-brand" href="../index.php">
                    <span class="align-middle">RDS - TI</span>
                </a>

            </div>
        </nav>

        <div class="main">
            <nav class="navbar navbar-expand navbar-light navbar-bg">
                <a class="sidebar-toggle js-sidebar-toggle">
                    <i class="hamburger align-self-center"></i>
                </a>
            </nav>

            <main class="content">
				<div class="container-fluid p-4">
					<form method="POST" action="../controller/registrar.php">
						<div class="mb-3">
							<h1 class="h3 d-inline align-middle">Alterar credenciais:</h1>
							
						</div>
						<div class="row">
							<div class="col-12 col-lg-6">
								<div class="card">
									<div class="card-header">
										<h5 class="card-title mb-0">Username</h5>
									</div>
									<div class="card-body">
										<input type="text" name='username' class="form-control" required>
									</div>
								</div>

								<div class="card">
									<div class="card-header">
										<h5 class="card-title mb-0">Senha</h5>
									</div>
									<div class="card-body">
										<input type="password" name='senha' class="form-control" required>
									</div>
								</div>

								   
							</div>
                            <div class="col-12 col-lg-6">
                            </div>
							<div class="col-12 col-lg-6">
								<div class="card">
										<div class="card-body">
											<div>
											<button type='submit' name='btn_altera_senha' class="btn btn-success">Cadastrar</button>
											</div>
										</div>
								</div> 
							</div>
						</div>
					</form>
				</div>
			</main>

            <?php
				include_once "footer.php";
			?>
        </div>
    </div>

    <script src="js/app.js"></script>
</body>

</html>