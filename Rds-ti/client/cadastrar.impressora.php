<?php
ob_start();
include_once "../model/Impressora.class.php";
include_once "../controller/conecta.php";
include_once "../controller/headers.php";
$conexao = db_connect();
session_start();


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
	include_once "nav.administrador.php";
	
?>
<div class="main">
	<?php 
		include_once "menu.logout.php";
	?>

			<main class="content">
				<div class="container-fluid p-0">
				<form method="POST" action="../controller/registrar.php">
						<div class="mb-3">
							<h1 class="h3 d-inline align-middle">Cadastro de impressoras</h1>
							
						</div>
						<div class="row">
							<div class="col-12 col-lg-6">
								<div class="card">
									<div class="card-header">
										<h5 class="card-title mb-0">Digite o MODELO da impressora</h5>
									</div>
									<div class="card-body">
										<input type="text" name='modelo' class="form-control" placeholder="MODELO" required>
									</div>
								</div>

								<div class="card">
										<div class="card-header">
											<h5 class="card-title mb-0">Qual o tipo de insumo:</h5>
										</div>
										<div class="card-body">
										<select class="form-select mb-3" name='tipo' required>
												<option value='toner'>Toner</option>
												<option value='tinta'>Tinta</option>
												
											</select> 
										</div>
									</div>

								

								<div class="card">
									<div class="card-header">
										<h5 class="card-title mb-0">Digite o SETOR da impressora</h5>
									</div>
									<div class="card-body">
										<input type="text" name='setor' class="form-control" placeholder="SETOR" required>
									</div>
								</div>

								   
							</div>
								
							
							<div class="col-12 col-lg-6">
									<div class="card">
										<div class="card-header">
											<h5 class="card-title mb-0">Digite o Serial da impressora</h5>
										</div>
										<div class="card-body">
											<input type="text" name='serial' class="form-control" placeholder="Serial" required>
										</div>
									</div>

									<div class="card">
										<div class="card-header">
											<h5 class="card-title mb-0">Selecione a LOJA em que esta a impressora:</h5>
										</div>
										<div class="card-body">
											<select class="form-select mb-3" name='loja' required>
												<option selected>Loja</option>
												<option value='MATRIZ'>Matriz</option>
												<option value='NSG'>NSG</option>
												<option value='PA'>PA</option>
												<option value='OH'>OH</option>
												<option value='PM'>PM</option>
												
											</select>               
										</div>
									</div>

									<div class="card">
										<div class="card-header">
											<h5 class="card-title mb-0">Digite o IP da impressora</h5>
										</div>
										<div class="card-body">
											<input type="text" name='ip' class="form-control" placeholder="Se não houver deixe em branco!">
										</div>
									</div>
									
							</div>
							

							<div class="col-12 col-lg-12">
								<div class="card">
										<div class="card-body">
											<div>
											<button type='submit' name='cadImpressora' class="btn btn-success">Cadastrar</button>
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

	<script src="../js/app.js"></script>

</body>

</html>
<?php
	}else{			//Fechando if de nivel de acesso
		ob_end_flush();
		echo "<h1>Usuário sem permissão!</h1>";
		index();
	}



}else{				//Fechando if de sessao
    ob_end_flush();
    echo "<h1>Usuário não conectado!</h1>";
    index();
}

?>