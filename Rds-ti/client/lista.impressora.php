<?php
ob_start();
include_once "../model/Impressora.class.php";
include_once "../controller/conecta.php";
include_once "../controller/headers.php";
session_start();
$conexao = db_connect();


if(isset($_SESSION['usuario'])){
	if($_SESSION['nivel']==3){
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
			
		?>
		<div class="main">
				<?php
					include_once "menu.logout.php";
				?>

					<main class="content">
						<div class="container-fluid p-0">

							<div class="mb-3">
								<h1 class="h3 d-inline align-middle">Lista de impressoras</h1>
							</div>
							<div class="row">
								
								<div class="col-12 col-lg-4">
									<form method="GET" action="#">
										<div class="card">

											<div class="card-header">
												<h5 class="card-title mb-0">Buscar impressora por MODELO</h5>
											</div>
											<div class="card-body">
												<input type="text" class="form-control" name='filtroModelo' placeholder="MODELO">
											</div>
										</div>

										<div class="card">
											<div class="card-body">
												<div>
													<button type='submit' class="btn btn-success">Buscar</button>
												</div>
											</div>
										</div>
									</form>
								</div>
								<div class="col-12 col-lg-4">
									<form method="GET" action="#">
										<div class="card">
											<div class="card-header">
												<h5 class="card-title mb-0">Buscar impressora por LOJA</h5>
											</div>
											<div class="card-body">
												<input type="text" class="form-control" name='filtroLoja' placeholder="LOJA">
											</div>
										</div>

										<div class="card">
												<div class="card-body">
													<div>
														<button type='submit' class="btn btn-success">Buscar</button>
													</div>
												</div>
										</div>
									</form>
								</div>
								<div class="col-12 col-lg-4">
									<form method="GET" action="#">
										<div class="card">
											<div class="card-header">
												<h5 class="card-title mb-0">Buscar impressora por SETOR</h5>
											</div>
											<div class="card-body">
												<input type="text" class="form-control" name='filtroSetor' placeholder="SETOR">
											</div>
										</div>

										<div class="card">
												<div class="card-body">
													<div>
														<button type='submit' class="btn btn-success">Buscar</button>
													</div>
												</div>
										</div>
									</form>
								</div>
							</div>

							<div class="col-12 col-lg-12">
									
								<div class="card">
									<div class="card-body">
										<form method="GET" action="editar.impressora.php">

											<?php
												gerar_lista_impressora_com_filtro();
											?>
											
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