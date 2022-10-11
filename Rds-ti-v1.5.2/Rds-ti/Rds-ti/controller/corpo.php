<div class="wrapper">
				<?php

					if($_SESSION['nivel']==3){
						include_once "../client/nav.administrador.php";
					}
					else if($_SESSION['nivel']==2){
						include_once "../client/nav.rh.php";
					}
					else if($_SESSION['nivel']==1){
						include_once "../client/nav.usuario.php";
					}
					
				?>
			<div class="navbar-collapse collapse">
	
</div>	
<div class="main">
<?php
	include_once "../client/menu.logout.php";
?>