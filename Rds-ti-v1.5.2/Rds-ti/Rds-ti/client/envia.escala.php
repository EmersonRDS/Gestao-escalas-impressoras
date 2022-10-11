<?php
ob_start();
include_once "../controller/conecta.php";
include_once "../controller/headers.php";
session_start();
$conexao = db_connect();

if(isset($_SESSION['usuario'])){
	if($_SESSION['nivel']<=3){
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
							<div class="mb-3">
								<h1 class="h3 d-inline align-middle">Cadastro de escalas</h1>
							</div>
							<form method="GET" action="#">
								<div class="row">
									<div class="col-12 col-lg-4">
										<div class="card">
											<div class="card-header">
												<h5 class="card-title mb-0">Quantos domingos/feriados no mês?</h5>
											</div>
											<div class="card-body">
												<input type="number" class="form-control" name="dias" required min='1' max='7'>
											</div>
										</div>
									</div>
									<div class="col-12 col-lg-4">
										<div class="card">
											<div class="card-header">
												<h5 class="card-title mb-0">Quantos colaboradores por dia?</h5>
											</div>
											<div class="card-body">
												<input type="number" class="form-control" name="colaboradores" required min='1' max='12'>
											</div>
										</div>
									</div>
									<div class="col-12 col-lg-1">
										<div class="card">
											<div class="card-header">
												<h5 class="card-title mb-0"></h5>
											</div>
											<div class="card-body">
												<div style="text-align:center;">
													<button  type='submit' class="btn btn-success" name="gerar_escala">Gerar</button>
												</div>
											</div>
										</div>
									</div>
								</div>
							</form>
								
							<form method="POST" action="../controller/registrar.php" id='form'>
								<?php
									if(isset($_GET['escolheEscala'])){
										alterar_escala();
									}
									else if(isset($_GET['gerar_escala'])){
										gerar_escala();
									}
								?>
							</form>	
						</div>
					</main>

					<?php
						include_once "footer.php";
					?>
				</div>
		</div>
	</div>
	<script src="../js/app.js"></script>
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