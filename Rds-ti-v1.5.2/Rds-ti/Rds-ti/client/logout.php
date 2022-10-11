<?php
ob_start();
include_once "../model/Impressora.class.php";
include_once "../controller/conecta.php";
include_once "../controller/headers.php";
$conexao = db_connect();
session_start();



?>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="shortcut icon" href="../img/icons/icon-48x48.png" />


    <title>Gestão</title>

    <link href="../css/app.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
    <div class="wrapper">

        <div class="main">
            <?php
                include_once "menu.logout.php";
            ?>

            <main class="content">
                <div class="container-fluid p-0">
                <?php
                    if(isset($_GET['btn_logout'])){
                        deslogar();
                    }else{
                        index();
                    }
                ?>
                

                </div>
            </main>

            <footer class="footer">
                <div class="container-fluid">
                    <div class="row text-muted">
                        <div class="col-6 text-start">
                            <p class="mb-0">
                                <a class="text-muted" href="/" target="_blank"><strong>Developed by: Émerson Rodrigues da Silva</strong></a> &copy;
                            </p>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <script src="../js/app.js"></script>
</body>

</html>

<?php
    ob_end_flush();

?>
