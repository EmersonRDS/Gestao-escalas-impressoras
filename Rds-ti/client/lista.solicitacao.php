<?php
ob_start();
include_once "../model/Impressora.class.php";
include_once "../controller/conecta.php";
include_once "../controller/headers.php";
session_start();
$conexao = db_connect();


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

						<?php
                            gerar_lista_solicitacao();
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
    ob_end_flush();
    echo "<h1>Usuário não conectado!</h1>";
    index();
}
?>