<?php
include_once "controller/conecta.php";
include_once "controller/functions.php";
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
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="shortcut icon" href="img/icons/icon-48x48.png" />

	<title>Hiperbem - TI</title>

	<link href="css/app.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
    <div class="wrapper">
        <nav id="sidebar" class="sidebar js-sidebar">
            <div class="sidebar-content js-simplebar">
                <a class="sidebar-brand" href="index.php">
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
					<form method="POST" action="#">
						<div class="mb-3">
							<h1 class="h3 d-inline align-middle">Login</h1>
							
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
											<button type='submit' name='btn_login' class="btn btn-success">Entrar</button>
											</div>
										</div>
								</div> 
							</div>
						</div>
					</form>

                    
			</main>

            <?php
                include_once "client/footer.php";
            ?>
        </div>
    </div>

    <script src="js/app.js"></script>
</body>

</html>