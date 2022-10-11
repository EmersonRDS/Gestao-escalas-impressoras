<?php
session_start();
ob_start();
include_once "../controller/conecta.php";
include_once "../controller/headers.php";


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
				<div class="container-fluid p-0">
					<form method="POST" action="../controller/registrar.php">
						<div class="mb-3">
							<h1 class="h3 d-inline align-middle">Edição da usuário</h1>
						</div>

                        <?php
                            gerar_formulario_editar_usuario();
                        ?>
						
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

}else{
    ob_end_flush();
    echo "<h1>Usuário não conectado!</h1>";
    index();
}
?>