<?php

function db_connect(){
   $PDO = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME.';charset=utf8', DB_USER, DB_PASS);
   
    return $PDO;
}

function testar_log(){

    $login = $_POST['username'];
    $senha = sha1($_POST['senha']);
    $consulta = db_connect();
    $verificacao = $consulta->query("SELECT * FROM tb_login WHERE username = BINARY '$login' AND senha = '$senha';");
    

    while($row = $verificacao->fetch()){
        $_SESSION['usuario']= $row['username'];
        $_SESSION['id']= $row['id_login'];
        $_SESSION['nome']= $row['nome'];
        $_SESSION['nivel']= $row['nivel'];
        $_SESSION['loja']= $row['loja'];
    }

    header("Refresh:1;client/index.php");
}

function deslogar(){
    
    unset($_SESSION['usuario']);
    unset($_SESSION['id']);
    unset($_SESSION['nome']);
    unset($_SESSION['nivel']);
    unset($_SESSION['loja']);
    header("Refresh:1;../index.php");
}

function enviarToner(){
    $consulta = db_connect();
    if(isset($_GET['enviaToner'])){
        $indice = $_GET['enviaToner'];
        $hoje = date("Y/m/d");
        $impressora = $_GET['idImpressora'];
        $solicitante = $_GET['solicitante'];
        
        
        $update = $consulta->query("UPDATE tb_solicitacao
                SET   status  = 'Enviado!'
                WHERE id = $indice;
                UPDATE tb_impressora
                SET T_toner = '$hoje' , U_solicitacao = '$solicitante' 
                WHERE id = '$impressora';");

        /*$update2 = $consulta->query("UPDATE tb_impressora
            SET T_toner = '$hoje' , U_solicitacao = '$solicitante' 
            WHERE id = '$impressora';");*/
        
        index();

    }

    if(isset($_GET['arquivaSolicitacao'])){
        $indice = $_GET['arquivaSolicitacao'];
        $update = $consulta->query("UPDATE tb_solicitacao
                SET   status  = 'Arquivado!'
                WHERE id = $indice;");
        index();
        
    }
    
}

function gerar_escala() {
    $dias=$_GET['dias'];
    $colaboradores=$_GET['colaboradores'];
    echo "<input type='hidden' value='$dias' name='nDias'>";
    echo "<input type='hidden' value='$colaboradores' name='nColaboradores'>";

    echo "<div class='col-12 col-lg-4'>
            <div class='card'>
                <div class='card-header'>
                    <h5 class='card-title mb-0'>Qual o setor da escala?</h5>
                </div>
                <div class='card-body'>
                    <div>
                        <label class='form-check'>
                            <input class='form-check-input' type='radio' value='operador' name='setor' checked>
                                <span class='form-check-label'>
                                    Operador de caixa
                                </span>
                        </label>
                        <label class='form-check'>
                            <input class='form-check-input' type='radio' value='fiscal' name='setor'>
                            <span class='form-check-label'>
                                Fiscal
                            </span>
                        </label>
                        <label class='form-check'>
                            <input class='form-check-input' type='radio' value='hortifruti' name='setor'>
                            <span class='form-check-label'>
                                Hortifruti
                            </span>
                        </label>
                        <label class='form-check'>
                            <input class='form-check-input' type='radio' value='loja' name='setor'>
                            <span class='form-check-label'>
                                Loja
                            </span>
                        </label>
                        <label class='form-check'>
                            <input class='form-check-input' type='radio' value='padaria' name='setor'>
                            <span class='form-check-label'>
                                Padaria
                            </span>
                        </label>
                        <label class='form-check'>
                            <input class='form-check-input' type='radio' value='acougue' name='setor'>
                            <span class='form-check-label'>
                                Açougue
                            </span>
                        </label>
                        <label class='form-check'>
                            <input class='form-check-input' type='radio' value='prevencao' name='setor'>
                            <span class='form-check-label'>
                                Prevenção
                            </span>
                        </label>
                        ";

                        if($_SESSION['nivel']>=2){
                            echo "<label class='form-check'>
                                <input class='form-check-input' type='radio' value='gerente' name='setor'>
                                <span class='form-check-label'>
                                    Gerencia
                                </span>
                            </label>";
                        }

                    echo "</div>
                </div>
            </div>
        </div>";

        echo "<div class='col-12 col-lg-4'>
            <div class='card'>
                <div class='card-header'>
                    <h5 class='card-title mb-0'>Qual a sua loja?</h5>
                </div>
                <div class='card-body'>
                    <div>
                        <label class='form-check'>
                            <input class='form-check-input' type='radio' value='Matriz' name='loja' checked>
                                <span class='form-check-label'>
                                    Matriz
                                </span>
                        </label>

                        <label class='form-check'>
                            <input class='form-check-input' type='radio' value='NSG' name='loja'>
                            <span class='form-check-label'>
                                Filial NSG
                            </span>
                        </label>

                        <label class='form-check'>
                            <input class='form-check-input' type='radio' value='PA' name='loja'>
                            <span class='form-check-label'>
                                Filial PA
                            </span>
                        </label>

                        <label class='form-check'>
                            <input class='form-check-input' type='radio' value='OH' name='loja'>
                            <span class='form-check-label'>
                                Filial OH
                            </span>
                        </label>

                        <label class='form-check'>
                            <input class='form-check-input' type='radio' value='PM' name='loja'>
                            <span class='form-check-label'>
                                Filial PM
                            </span>
                        </label>
                        ";

                    echo "</div>
                </div>
            </div>
        </div>";


    for ( $i = 0; $i < $dias; $i++) {
        echo "<div class='row'>".
            "<div class='col-12 col-lg-12'>".
            "<div class='col-12 col-lg-3'>".
            "<div class='card'>".
            "<div class='card-header'>".
            "<h5 class='card-title mb-0'>Data ". ($i + 1). ":</h5>".
            "</div>".
            "<div class='card-body'>".
            "<div>".
            "<input type='date' class='form-control' required name='data[]'>".
            "</div>".
            "</div>".
            "</div>".
            "</div>".
            "</div>";
        for ($x = 0; $x < $colaboradores; $x++) {
            echo "<div class='col-12 col-lg-3'>".
                "<div class='card'>".
                "<div class='card-header'>".
                "<h5 class='card-title mb-0'>Colaborador ". ($x + 1) .":</h5>".
                "</div>".
                "<div class='card-body'>".
                "<div>".
                "<input type='text' class='form-control' name='nome".$i."[]'>".
                "</div>".
                "</div>".
                "</div>".
                "</div>".
                "<div class='col-12 col-lg-3'>".
                "<div class='card'>".
                "<div class='card-header'>" .
                "<h5 class='card-title mb-0'>folga colaborador ". ($x + 1) .":</h5>".
                "</div>".
                "<div class='card-body'>" .
                "<div>" .
                "<input type='date' class='form-control' name='folga".$i."[]'>".
                "</div>" .
                "</div>" .
                "</div>" .
                "</div>" ;
        }

    }
    echo "<div class='col-12 col-lg-12'>".
        "</div>".
        "<div class='col-12 col-lg-2'>".
        "<button type='submit' class='btn btn-success' name='btn_escala'>Enviar</button>".
        "</div>".
        "</div>";
}

function gerarSolicitacoesTonerTi(){
    header("Refresh:300; ../client/index.php");
    $conexao = db_connect();
    $consulta = $conexao->query("SELECT * FROM tb_solicitacao WHERE status = 'Solicitado!' ORDER BY data DESC;");
    
    
        echo "<h1 class='h3 mb-3'><strong>Solicitações</strong></h1>

        <div class='col-12 col-lg-12'>
            <div class='card'>
                <div class='card-body'>
                        <table class='table table-hover table-striped'>
                            <thead>
                                <tr>
                                    <th scope='col'>Cod.</th>
                                        <th scope='col'>Solicitação</th>
                                        <th scope='col'>Status</th>
                                        <th scope='col'></th>
                                        <th scope='col'></th>
                                    </tr>
                            </thead>
                            <tbody>";
                                                        
                                
                                                        
                                    while ($row = $consulta->fetch()) {
                                        if(isset($titulo)){
                                        }else{
                                            $titulo = 0;
                                            echo "<script>
                                                    document.title = 'Solicitação de toner!';
                                                    favicon.setAttribute('href', '../img/icons/notificacao.png');
                                                </script>";
                                        }
                                                                
                                        echo "<form method='GET' action='#'>".
                                            "<input type='hidden' name='idImpressora' value='".$row['id_impressora']."'>".
                                            "<input type='hidden' name='solicitante' value='".$row['solicitante']."'>".
                                            "<tr>".
                                        
                                            "<th scope='row'>".$row['id'].
                                            "</th><td>Eu ".$row['solicitante']." solicito ".$row['comentario']." para a impressora ".$row['modelo']."</td>".
                                                "<td>".$row['status']."</td>".
                                                "<td><button name='enviaToner' class='btn btn-primary btn-sm' type='submit' value='".$row['id']."'>"."<svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-check' viewBox='0 0 16 16'>".
                                                "<path d='M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z'/>".
                                                "</svg></button></td>".
                                                "<td><button type='submit' name='arquivaSolicitacao' value='".$row['id']."' class='btn btn-outline-danger'>
                                                    <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-archive' viewBox='0 0 16 16'>
                                                    <path d='M0 2a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1v7.5a2.5 2.5 0 0 1-2.5 2.5h-9A2.5 2.5 0 0 1 1 12.5V5a1 1 0 0 1-1-1V2zm2 3v7.5A1.5 1.5 0 0 0 3.5 14h9a1.5 1.5 0 0 0 1.5-1.5V5H2zm13-3H1v2h14V2zM5 7.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5z'></path>
                                                    </svg>
                                                    </button>".
                                                "</td>".
                                                "</tr>".
                                        "</form>";
                                                                
                                    }
                                                        
                            echo "</tbody>
                        </table>
                </div>
            </div>
        </div>";
}

function gerarSolicitacoesTonerUsuario(){
    $conexao = db_connect();
        echo "<h1 class='h3 mb-3'><strong>Solicitações</strong></h1>
        <div class='col-12 col-lg-12'>
            <div class='card'>
                <div class='card-body'>
                    <form method='GET' action='#'>
                        <table class='table table-hover table-striped'>
                            <thead>
                                <tr>
                                    <th scope='col'>Cod.</th>
                                        <th scope='col'>Solicitação</th>
                                        <th scope='col'>Status</th>
                                        <th scope='col'></th>
                                    </tr>
                            </thead>
                            <tbody>";
                                                       
                            $nome = $_SESSION['nome'];
                            $consulta = $conexao->query("SELECT * FROM tb_solicitacao WHERE solicitante = '$nome' AND status = 'Solicitado!' ORDER BY data DESC;"); 
                            
                            while ($row = $consulta->fetch()) {
                                        
                                echo "<tr>".
                                "<th scope='row' style='text-align: center;'>".$row['id'].
                                "</th><td>Eu ".$row['solicitante']." solicito ".$row['comentario']." para a impressora ".$row['modelo']."</td>".
                                "<td>".$row['status']."</td>".
                                "<td></td>".
                                "</tr>";   
                            }
                                                     
                            echo "</tbody>
                        </table>
                    </form>
                </div>
            </div>
        </div>";
}

function gerarSolicitacoesEscalaRh(){
    $conexao = db_connect();
        echo "<h1 class='h3 mb-3'><strong>Escalas</strong></h1>
        <div class='col-12 col-lg-12'>
            <div class='card'>
                <div class='card-body'>
                    
                        <table class='table table-hover table-striped'>
                            <thead>
                                <tr>
                                    <th scope='col'>Cod.</th>
                                    <th scope='col'>Autor</th>
                                    <th scope='col'>Loja</th>
                                    <th scope='col'>Data</th>
                                    <th scope='col'>Status</th>
                                    <th scope='col'></th>
                                    <th scope='col'></th>
                                </tr>
                            </thead>
                            <tbody>";
                                                       
                            
                            $consulta = $conexao->query("SELECT * FROM tb_escala INNER JOIN tb_login 
                            ON tb_escala.id_usuario = tb_login.id_login 
                            WHERE tb_escala.status = 'Recebido!'
                            ORDER BY data DESC;"); 
                            
                            
                            while ($row = $consulta->fetch()) {
                                        
                                echo "<form method='GET' action='gera.doc.escala.php'>".
                                "<tr>".
                                "<th scope='row'>".$row['id'].
                                "</th><td>".$row['nome']."</td>".
                                "</th><td>".$row['loja_escala']."</td>".
                                "<td>".date('d/m/Y', strtotime($row['data']))."</td>".
                                "<td>".$row['status']."</td>".
                                "<td><button name='escolheEscala' class='btn btn-primary btn-sm' type='submit' value='".$row['id']."'>"."<svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-check' viewBox='0 0 16 16'>".
                                "<path d='M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z'/>".
                                "</svg></button></td>".
                                "<td><button type='submit' name='arquivaEscala' value='".$row['id']."' class='btn btn-outline-danger'>
                                    <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-archive' viewBox='0 0 16 16'>
                                    <path d='M0 2a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1v7.5a2.5 2.5 0 0 1-2.5 2.5h-9A2.5 2.5 0 0 1 1 12.5V5a1 1 0 0 1-1-1V2zm2 3v7.5A1.5 1.5 0 0 0 3.5 14h9a1.5 1.5 0 0 0 1.5-1.5V5H2zm13-3H1v2h14V2zM5 7.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5z'></path>
                                    </svg>
                                    </button>".
                                "</td>".
                                "</tr>".
                                "</form>";
                                        
                            }
                                                            
                                                    
                            echo "</tbody>
                        </table>
                    </form>
                </div>
            </div>
        </div>";
}

function gerarEscalaCompleta(){
    $conexao = db_connect();
    $idEscala = $_GET['escolheEscala'];
    $escolheSetor = $conexao->query("SELECT setor_escala FROM tb_escala WHERE id = '$idEscala';");
    $setor = $escolheSetor->fetch();
    $diaSemana = array(
        1 => "Segunda-feira",
        2 => "Terça-feira",
        3 => "Quarta-feira",
        4 => "Quinta-feira",
        5 => "Sexta-feira",
        6 => "Sábado",
        7 => "Domingo"
    );


    $consulta = $conexao->query("SELECT * FROM tb_semana AS semana 
    INNER JOIN tb_escala AS escala ON semana.id_escala = escala.id 
    INNER JOIN tb_login AS login ON escala.id_usuario = login.id_login
    WHERE semana.id_escala = '$idEscala';");


        echo "
        <div class='col-12 col-lg-12'>
            <div class='card'>
                <div class='card-body'>
                        <table style='border: solid 2px black;'>
                            <thead>
                                <tr>
                                    <th colspan='3' style='border: solid 2px black; text-align: center; background-color: LightSteelBlue;'>Escala ".$setor['setor_escala']."</th>
                                </tr>
                            </thead>
                            <tbody>";
                                        
                            while ($row = $consulta->fetch()) {
                                        
                                echo "<tr>".
                                    "<th colspan='3' style='border: solid 2px black; text-align: center; background-color: LightSteelBlue;'>". $diaSemana[date('N',strtotime($row['dia']))]." - ".date('d/m/Y', strtotime($row['dia']))."</th>".
                                "</tr>";
                                if($row['pessoa_0']!= ''){
                                    echo "<tr>".
                                    "<th style='border: solid 2px black; padding: 3px; max-width: 100px; text-overflow: word-break;' >".$row['pessoa_0'].
                                    "</th><td  style='border: solid 2px black; padding: 3px;' >"; echo date('d/m/Y', strtotime($row['f_pessoa_0']))."</td>".
                                    "</th><td  style='border: solid 2px black; padding: 3px;'>"; echo $diaSemana[date('N',strtotime($row['f_pessoa_0']))]."</td>".
                                    "</tr>";
                                }
                                if($row['pessoa_1']!= ''){
                                    echo "<tr>".
                                    "<th style='border: solid 2px black; padding: 3px;' >".$row['pessoa_1'].
                                    "</th><td  style='border: solid 2px black; padding: 3px;'>"; echo date('d/m/Y', strtotime($row['f_pessoa_1']))."</td>".
                                    "</th><td  style='border: solid 2px black; padding: 3px;'>"; echo $diaSemana[date('N',strtotime($row['f_pessoa_1']))]."</td>".
                                    "</tr>";
                                }
                                if($row['pessoa_2']!= ''){
                                    echo "<tr>".
                                    "<th style='border: solid 2px black; padding: 3px;' >".$row['pessoa_2'].
                                    "</th><td  style='border: solid 2px black; padding: 3px;'>"; echo date('d/m/Y', strtotime($row['f_pessoa_2']))."</td>".
                                    "</th><td  style='border: solid 2px black; padding: 3px;'>"; echo $diaSemana[date('N',strtotime($row['f_pessoa_2']))]."</td>".
                                    "</tr>";
                                }
                                if($row['pessoa_3']!= ''){
                                    echo "<tr>".
                                    "<th style='border: solid 2px black; padding: 3px;' >".$row['pessoa_3'].
                                    "</th><td  style='border: solid 2px black; padding: 3px;'>"; echo date('d/m/Y', strtotime($row['f_pessoa_3']))."</td>".
                                    "</th><td  style='border: solid 2px black; padding: 3px;'>"; echo $diaSemana[date('N',strtotime($row['f_pessoa_3']))]."</td>".
                                    "</tr>";
                                }
                                if($row['pessoa_4']!= ''){
                                    echo "<tr>".
                                    "<th style='border: solid 2px black; padding: 3px;' >".$row['pessoa_4'].
                                    "</th><td  style='border: solid 2px black; padding: 3px;'>"; echo date('d/m/Y', strtotime($row['f_pessoa_4']))."</td>".
                                    "</th><td  style='border: solid 2px black; padding: 3px;'>"; echo $diaSemana[date('N',strtotime($row['f_pessoa_4']))]."</td>".
                                    "</tr>";
                                }
                                if($row['pessoa_5']!= ''){
                                    echo "<tr>".
                                    "<th style='border: solid 2px black; padding: 3px;' >".$row['pessoa_5'].
                                    "</th><td  style='border: solid 2px black; padding: 3px;'>"; echo date('d/m/Y', strtotime($row['f_pessoa_5']))."</td>".
                                    "</th><td  style='border: solid 2px black; padding: 3px;'>"; echo $diaSemana[date('N',strtotime($row['f_pessoa_5']))]."</td>".
                                    "</tr>";
                                }
                                if($row['pessoa_6']!= ''){
                                    echo "<tr>".
                                    "<th style='border: solid 2px black; padding: 3px;' >".$row['pessoa_6'].
                                    "</th><td  style='border: solid 2px black; padding: 3px;'>"; echo date('d/m/Y', strtotime($row['f_pessoa_6']))."</td>".
                                    "</th><td  style='border: solid 2px black; padding: 3px;'>"; echo $diaSemana[date('N',strtotime($row['f_pessoa_6']))]."</td>".
                                    "</tr>";
                                }
                                if($row['pessoa_7']!= ''){
                                    echo "<tr>".
                                    "<th style='border: solid 2px black; padding: 3px;' >".$row['pessoa_7'].
                                    "</th><td  style='border: solid 2px black; padding: 3px;'>"; echo date('d/m/Y', strtotime($row['f_pessoa_7']))."</td>".
                                    "</th><td  style='border: solid 2px black; padding: 3px;'>"; echo $diaSemana[date('N',strtotime($row['f_pessoa_7']))]."</td>".
                                    "</tr>";
                                }
                                if($row['pessoa_8']!= ''){
                                    echo "<tr>".
                                    "<th style='border: solid 2px black; padding: 3px;' >".$row['pessoa_8'].
                                    "</th><td  style='border: solid 2px black; padding: 3px;'>"; echo date('d/m/Y', strtotime($row['f_pessoa_8']))."</td>".
                                    "</th><td  style='border: solid 2px black; padding: 3px;'>"; echo $diaSemana[date('N',strtotime($row['f_pessoa_8']))]."</td>".
                                    "</tr>";
                                }
                                if($row['pessoa_9']!= ''){
                                    echo "<tr>".
                                    "<th style='border: solid 2px black; padding: 3px;' >".$row['pessoa_9'].
                                    "</th><td  style='border: solid 2px black; padding: 3px;'>"; echo date('d/m/Y', strtotime($row['f_pessoa_9']))."</td>".
                                    "</th><td  style='border: solid 2px black; padding: 3px;'>"; echo $diaSemana[date('N',strtotime($row['f_pessoa_9']))]."</td>".
                                    "</tr>";
                                }
                                if($row['pessoa_10']!= ''){
                                    echo "<tr>".
                                    "<th style='border: solid 2px black; padding: 3px;' >".$row['pessoa_10'].
                                    "</th><td  style='border: solid 2px black; padding: 3px;'>"; echo date('d/m/Y', strtotime($row['f_pessoa_10']))."</td>".
                                    "</th><td  style='border: solid 2px black; padding: 3px;'>"; echo $diaSemana[date('N',strtotime($row['f_pessoa_10']))]."</td>".
                                    "</tr>";
                                }
                                if($row['pessoa_11']!= ''){
                                    echo "<tr>".
                                    "<th style='border: solid 2px black; padding: 3px;' >".$row['pessoa_11'].
                                    "</th><td  style='border: solid 2px black; padding: 3px;'>"; echo date('d/m/Y', strtotime($row['f_pessoa_11']))."</td>".
                                    "</th><td  style='border: solid 2px black; padding: 3px;'>"; echo $diaSemana[date('N',strtotime($row['f_pessoa_11']))]."</td>".
                                    "</tr>";
                                }
                            }
                            echo "</tbody>
                        </table>
                </div>
            </div>
        </div>";
}

function gerarArquivoWord(){
    $conexao = db_connect();
    $idEscala = $_GET['escolheEscala'];
    if($_SESSION['nivel']==2){
        $escolheSetor = $conexao->query("UPDATE `tb_escala` SET `status` = 'Gerado!' WHERE `tb_escala`.`id` = '$idEscala';");
    }
    
    header("Content-Type: application/vnd.msword");
    header("Expires: 0");
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header("content-disposition: attachment;filename=escala.doc");
            
    echo "<html>";
    echo "<head><meta charset='UTF-8'></head>";
    echo gerarEscalaCompleta();
    echo "</html>";       
}

function gerarListaEscalaRh(){
    $conexao = db_connect();
        echo "<h1 class='h3 mb-3'><strong>Escalas</strong></h1>
        <div class='col-12 col-lg-12'>
            <div class='card'>
                <div class='card-body'>
                    
                        <table class='table table-hover table-striped'>
                            <thead>
                                <tr>
                                    <th scope='col'>Cod.</th>
                                    <th scope='col'>Autor</th>
                                    <th scope='col'>Loja</th>
                                    <th scope='col'>Data</th>
                                    <th scope='col'>Status</th>
                                    <th scope='col'></th>
                                    <th scope='col'></th>
                                </tr>
                            </thead>
                            <tbody>";
                                                       
                            
                            $consulta = $conexao->query("SELECT * FROM tb_escala INNER JOIN tb_login 
                            ON tb_escala.id_usuario = tb_login.id_login 
                            ORDER BY data DESC;"); 
                            
                            while ($row = $consulta->fetch()) {
                                        
                                echo "<form method='GET' action='gera.doc.escala.php'>".
                                "<tr>".
                                "<th scope='row'>".$row['id'].
                                "</th><td>".$row['nome']."</td>".
                                "</th><td>".$row['loja_escala']."</td>".
                                "<td>".date('d/m/Y', strtotime($row['data']))."</td>".
                                "<td>".$row['status']."</td>".
                                "<td><button name='escolheEscala' class='btn btn-primary btn-sm' type='submit' value='".$row['id']."'>"."<svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-check' viewBox='0 0 16 16'>".
                                "<path d='M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z'/>".
                                "</svg></button></td>".
                                "<td><button type='submit' name='arquivaEscala' value='".$row['id']."' class='btn btn-outline-danger'>
                                    <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-archive' viewBox='0 0 16 16'>
                                    <path d='M0 2a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1v7.5a2.5 2.5 0 0 1-2.5 2.5h-9A2.5 2.5 0 0 1 1 12.5V5a1 1 0 0 1-1-1V2zm2 3v7.5A1.5 1.5 0 0 0 3.5 14h9a1.5 1.5 0 0 0 1.5-1.5V5H2zm13-3H1v2h14V2zM5 7.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5z'></path>
                                    </svg>
                                    </button>".
                                "</td>".
                                "</tr>".
                                "</form>";
                            }
                        
                            echo "</tbody>
                        </table>
                    
                </div>
            </div>
        </div>";
}

function arquivarEscala(){
    $conexao = db_connect();
    $idEscala = $_GET['arquivaEscala'];
    $escolheSetor = $conexao->query("UPDATE `tb_escala` SET `status` = 'Arquivado!' WHERE `tb_escala`.`id` = '$idEscala';");
    echo "<script>
    window.location.href = 'index.php';
    </script>";
}

function gerarListaEscalaUsuario(){
    $conexao = db_connect();
    $idUsuario = $_SESSION['id'];
        echo "<h1 class='h3 mb-3'><strong>Escalas</strong></h1>
        <div class='col-12 col-lg-12'>
            <div class='card'>
                <div class='card-body'>
                    
                        <table class='table table-hover table-striped'>
                            <thead>
                                <tr>
                                    <th scope='col'>Cod.</th>
                                    <th scope='col'>Autor</th>
                                    <th scope='col'>Loja</th>
                                    <th scope='col'>Data</th>
                                    <th scope='col'>Status</th>
                                    <th scope='col'></th>
                                </tr>
                            </thead>
                            <tbody>";
                                           
                            $consulta = $conexao->query("SELECT * FROM tb_escala 
                            INNER JOIN tb_login ON tb_escala.id_usuario = tb_login.id_login 
                            WHERE tb_escala.id_usuario = '$idUsuario'
                            ORDER BY data DESC;"); 
                            
                            while ($row = $consulta->fetch()) {
                                        
                                echo "<form method='GET' action='gera.doc.escala.php'>".
                                "<tr>".
                                "<th scope='row'>".$row['id'].
                                "</th><td>".$row['nome']."</td>".
                                "</th><td>".$row['loja_escala']."</td>".
                                "<td>".date('d/m/Y', strtotime($row['data']))."</td>".
                                "<td>".$row['status']."</td>".
                                "<td><button name='escolheEscala' class='btn btn-primary btn-sm' type='submit' value='".$row['id']."'>"."<svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-check' viewBox='0 0 16 16'>".
                                "<path d='M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z'/>".
                                "</svg></button></td>".
                                "</tr>".
                                "</form>";
                                        
                            }                     
                                                    
                            echo "</tbody>
                        </table>
                    
                </div>
            </div>
        </div>";
}

function gerarEscalaEnviadaUsuario(){
    $conexao = db_connect();
    $idUsuario = $_SESSION['id'];
        echo "<h1 class='h3 mb-3'><strong>Escalas</strong></h1>
        <div class='col-12 col-lg-12'>
            <div class='card'>
                <div class='card-body'>
                        <table class='table table-hover table-striped'>
                            <thead>
                                <tr>
                                    <th scope='col'>Cod.</th>
                                    <th scope='col'>Autor</th>
                                    <th scope='col'>Loja</th>
                                    <th scope='col'>Data</th>
                                    <th scope='col'>Status</th>
                                    <th scope='col'></th>
                                </tr>
                            </thead>
                            <tbody>";
                                           
                            $consulta = $conexao->query("SELECT * FROM tb_escala 
                            INNER JOIN tb_login ON tb_escala.id_usuario = tb_login.id_login 
                            WHERE tb_escala.id_usuario = '$idUsuario' AND tb_escala.status = 'Recebido!'
                            ORDER BY data DESC;"); 
                            
                            while ($row = $consulta->fetch()) {
                                        
                                echo "<form method='GET' action='gera.doc.escala.php'>".
                                "<tr>".
                                "<th scope='row'>".$row['id'].
                                "</th><td>".$row['nome']."</td>".
                                "</th><td>".$row['loja_escala']."</td>".
                                "<td>".date('d/m/Y', strtotime($row['data']))."</td>".
                                "<td>".$row['status']."</td>".
                                "<td><button name='escolheEscala' class='btn btn-primary btn-sm' type='submit' value='".$row['id']."'>"."<svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-check' viewBox='0 0 16 16'>".
                                "<path d='M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z'/>".
                                "</svg></button></td>".
                                "</tr>".
                                "</form>";
                                        
                            }                     
                                                    
                            echo "</tbody>
                        </table>
                </div>
            </div>
        </div>";
}

function gerar_lista_usuario(){
    $conexao = db_connect();
    echo
    "<table class='table table-dark table-hover align-middle caption-top'>
		<caption style='text-align:center;'>Lista de usuários</caption>
		<thead>
			<tr>
				<th scope='col1'></th>
				<th scope='col1'>Nome</th>
				<th scope='col1'>Login</th>
				<th scope='col1'>Nivel</th>
				<th scope='col1'>loja</th>
			</tr>
		</thead>
		<tbody>";
										
			if($_SESSION['nivel']==3){
			    $consulta = $conexao->query("SELECT * FROM tb_login");
            }else if($_SESSION['nivel']==2){
                $consulta = $conexao->query("SELECT * FROM tb_login WHERE nivel <'3'"); 
            }
																
				while ($row = $consulta->fetch()) {
																				
					echo "<tr>".
						"<th scope='row'><button name='codUsu' type='submit' value='".$row['id_login']."'>"."<i data-feather='edit'></i>".
						"</button>
                        </th><td>".$row['nome'].
						"</td><td>".$row['username'];
							    if($row['nivel']==0){
								    echo "</td><td>Temporário";
								}else if($row['nivel']==1){
									echo "</td><td>Usuário";
								}else if($row['nivel']==2){
									echo "</td><td>RH";
								}else{
									echo "</td><td>Administrador";
								}
						echo "</td><td>".$row['loja']."</td></tr>";
				}
		echo 																
		"</tbody>
    </table>";
}

function gerar_lista_impressora_com_filtro(){
    $conexao = db_connect();
    if(isset($_GET['filtroModelo'])){
        $filtro= $_GET['filtroModelo'];
        $consulta = $conexao->query("SELECT * FROM tb_impressora WHERE modelo LIKE '%$filtro%';");
    }else if(isset($_GET['filtroLoja'])){
        $filtro= $_GET['filtroLoja'];
        $consulta = $conexao->query("SELECT * FROM tb_impressora WHERE loja LIKE '%$filtro%';");
    }else if(isset($_GET['filtroSetor'])){
        $filtro= $_GET['filtroSetor'];
        $consulta = $conexao->query("SELECT * FROM tb_impressora WHERE setor LIKE '%$filtro%';");
    }else{
        $consulta = $conexao->query("SELECT * FROM tb_impressora ;");
    }
    
    
    echo "
    <table class='table table-dark table-hover align-middle caption-top'>
		<caption style='text-align:center;'>Lista de impressoras</caption>
			<thead>
		        <tr>
				    <th scope='col'>indice</th>
					<th scope='col'>Modelo</th>
					<th scope='col'>Serial</th>
					<th scope='col'>Loja</th>
		            <th scope='col'>Ip</th>
					<th scope='col'>Setor</th>
					<th scope='col'>Data da última troca de toner</th>
					<th scope='col'>Data do último concerto</th>
					<th scope='col'>Quem fez a última solicitação</th>
				</tr>
			</thead>
			<tbody>";
															
				 
													
				while ($row = $consulta->fetch()) {
																
					echo "<tr>".
							"<th scope='row'><button name='codImp' type='submit' value='".$row['id']."' style='border-radius: 5px;'><i data-feather='edit'></i>".
							"</button></th><td>".$row['modelo'].
							"</td><td>".$row['serial'].
							"</td><td>".$row['loja'].
							"</td><td>".$row['ip'].
							"</td><td>".$row['setor']."</td>".
							"</td><td>".date('d/m/Y', strtotime($row['T_toner']))."</td>".
							"</td><td>".date('d/m/Y', strtotime($row['D_concerto']))."</td>".
							"</td><td>".$row['U_solicitacao']."</td>".
						"</tr>";
																
				}
															
		echo "									
        </tbody>
	</table>";
}

function gerar_cadastro_usuario(){
    echo "
    <div class='container-fluid p-0'>
        <form method='POST' action='../controller/registrar.php'>
            <div class='mb-3'>
                <h1 class='h3 d-inline align-middle'>Cadastro de usuário</h1>
            </div>
            <div class='row'>
                <div class='col-12 col-lg-6'>
                    <div class='card'>
                        <div class='card-header'>
                            <h5 class='card-title mb-0'>Digite o NOME do usuário</h5>
                        </div>
                        <div class='card-body'>
                            <input type='text' class='form-control' placeholder='Nome' name='nome'>
                        </div>
                    </div>

                    <div class='card'>
                        <div class='card-header'>
                            <h5 class='card-title mb-0'>Digite o LOGIN do usuário</h5>
                        </div>
                        <div class='card-body'>
                            <input type='text' class='form-control' placeholder='Login' name='login'>
                        </div>
                    </div>

                    <div class='card'>
                        <div class='card-header'>
                            <h5 class='card-title mb-0'>Digite a SENHA do usuário</h5>
                        </div>
                        <div class='card-body'>
                            <input type='password' class='form-control' placeholder='Senha' name='senha'>
                        </div>
                    </div>

                    <div class='card'>
                        <div class='card-header'>
                            <h5 class='card-title mb-0'>Qual o nível de acesso do usuário?</h5>
                        </div>
                        <div class='card-body'>
                            <div>
                                <label class='form-check'>
                                    <input class='form-check-input' type='radio' value='0' name='tipoUsuario' checked>
                                    <span class='form-check-label'>Temporário</span>
                                </label>
                                <label class='form-check'>
                                    <input class='form-check-input' type='radio' value='1' name='tipoUsuario' checked>
                                    <span class='form-check-label'>Usuário</span>
                                </label>
                                <label class='form-check'>
                                    <input class='form-check-input' type='radio' value='2' name='tipoUsuario' checked>
                                    <span class='form-check-label'>Rh</span>
                                </label>";
                                if($_SESSION['nivel']==3){
                                    echo "
                                    <label class='form-check'>
                                    <input class='form-check-input' type='radio' value='3' name='tipoUsuario'>
                                    <span class='form-check-label'>Administrador</span>
                                    </label>";
                                }
                            echo " 
                            </div>
                        </div>
                    </div>

                    <div class='card'>
                            <div class='card-header'>
                                <h5 class='card-title mb-0'>Selecione a LOJA em que está o usuário:</h5>
                            </div>
                            <div class='card-body'>
                                <select class='form-select mb-3' name='loja'>";
                                if($_SESSION['nivel']==3){
                                    echo "<option value='*'>Administrador não precisa selecionar</option>";
                                }
                                    
                                echo "
                                <option value='MATRIZ'>Matriz</option>
                                <option value='NSG'>NSG</option>
                                <option value='PA'>PA</option>
                                <option value='OH'>OH</option>
                                <option value='PM'>PM</option>
                                                        
                                </select>               
                            </div>
                    </div>

                    <div class='card'>
                        <div class='card-body'>
                            <div>
                                <button type='submit' name='cadUsuario' class='btn btn-success'>Cadastrar</button>
                                    
                            </div>
                                
                        </div>
                    </div>                                
                </div>
            </div>
        </form>
    </div>";
}

function gerar_formulario_solicitacao_toner(){
    $conexao = db_connect();
    $cod = $_GET['codImp'];
    $consulta = $conexao->query("SELECT * FROM tb_impressora WHERE id = '$cod'");
    $row = $consulta->fetch();

    echo "
    <div class='container-fluid p-0'>
    <form method='POST' action='../controller/registrar.php'>
        <input type='hidden' value='$cod' name='codImp'>
        <div class='mb-3'>
            <h1 class='h3 d-inline align-middle'>Solicitação de toner</h1>
            
        </div>
        <div class='row'>
            <div class='col-12 col-lg-4'>
                <div class='card'>
                    <div class='card-header'>
                        <h5 class='card-title mb-0'>Solicitante </h5>
                    </div>
                    <div class='card-body'>
                        <input type='text' class='form-control' value='".$_SESSION['nome']."' name='nome' readonly>
                    </div>
                </div>

            </div>";
            if($row['tipo']=='toner'){
                echo"
                <div class='col-12 col-lg-4'>
                    <div class='card'>
                        <div class='card-header'>
                            <h5 class='card-title mb-0'>Tipo</h5>
                        </div>
                        <div class='card-body'>
                            <input type='text' class='form-control' value='toner' name='tipo' readonly> 
                        </div>
                    </div>
                </div>";
            }else{
                echo"
                    <div class='col-12 col-lg-1'>
                        <div class='card'>
                            <div class='card-header'>
                                <h5 class='card-title mb-0'>Tipo</h5>
                            </div>
                            <div class='card-body'>
                            <input type='text' class='form-control' value='tinta' name='tipo' readonly>
                            </div>
                        </div>
					</div>
                    <div class='col-12 col-lg-3'>
                        <div class='card'>
                            <div class='card-header'>
                                <h5 class='card-title mb-0'>Cores</h5>
                            </div>
                            <div class='card-body'>
                                <input type='text' class='form-control' name='tintas' placeholder='Digite as cores' required>
                            </div>
                        </div>
					</div>";
            }
            echo "
            <div class='col-12 col-lg-4'>
                <div class='card'>
                    <div class='card-header'>
                        <h5 class='card-title mb-0'>Impressora</h5>
                    </div>
                    <div class='card-body'>
                        <input type='text' class='form-control' value='".$row['modelo']."' name='modelo' readonly>
                    </div>
                </div>
            </div>
            <div class='col-12 col-lg-12' style='text-align: center;'>
                <div class='col-12 col-lg-5'></div>
                    <div class='card'>
                    
                        <div class='card-header'>
                            <h5 class='card-title mb-0'>Confirmar?</h5>
                        </div>
                        <div class='card-body'>
                            <div>
                                <button type='submit' name='cadSolicitacao' class='btn btn-success' style='padding: 7px 13px 7px 13px;'><i data-feather='mail'></i></button>
                            </div>
                        </div>
                    </div> 
            </div>
        </div>
    </form>
    </div>";
}

function gerar_lista_solicitacao(){
    $conexao=db_connect();
    if($_SESSION['nivel']==3){
        $consulta = $conexao->query("SELECT * FROM tb_solicitacao ORDER BY data DESC;");
    }else{
        $nome = $_SESSION['nome'];
        $consulta = $conexao->query("SELECT * FROM tb_solicitacao WHERE solicitante = '$nome' ORDER BY data DESC;");
    }

    echo"
    <div class='col-12 col-lg-12'>
									
        <div class='card'>
            <div class='card-body'>
                <form method='GET' action='#'>
                    <table class='table table-hover table-striped'>
                        <thead>
                            <tr>
                                <th scope='col'>Cod.</th>
                                <th scope='col'>Solicitação</th>
                                <th scope='col'>Status</th>
                                <th scope='col'>data</th>
                            </tr>
                        </thead>
                        <tbody>";
                                                          
                            while ($row = $consulta->fetch()) {
                                                                
                                echo "<tr>".
                                "<th scope='row' style='text-align: center;'>".$row['id'].
                                "</th><td>Eu ".$row['solicitante']." solicito ".$row['comentario']." para a impressora ".$row['modelo']."</td>".
                                "<td>".$row['status']."</td>".
                                "<td >".date('d/m/Y - G:i:s', strtotime($row['data']))."</td>".
                               "</tr>";
                                                                        
                            }
                                                            
                        echo"                                  
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
	</div>";
}

function gerar_formulario_editar_impressora(){
    $conexao = db_connect();
    $i = $_GET["codImp"];
    $consulta = $conexao->query("SELECT * FROM tb_impressora WHERE id = '$i'");

    
                            while ($row = $consulta->fetch()){
                                echo "<div class='row'>
                                <input type='hidden' value=' $i' name='indice'>
                                <div class='col-12 col-lg-6'>
                                    <div class='card'>
                                        <div class='card-header'>
                                            <h5 class='card-title mb-0'>Modelo da impressora</h5>
                                        </div>
                                        <div class='card-body'>
                                            <input type='text' value='".$row['modelo']."' name='newModelo' class='form-control' readonly>
                                        </div>
                                    </div>
    
                                    <div class='card'>
                                        <div class='card-header'>
                                            <h5 class='card-title mb-0'>Digite o ip da impressora</h5>
                                        </div>
                                        <div class='card-body'>
                                            <input type='text' name='newIp' value='".$row['ip']."' class='form-control' placeholder='Se não houver deixe em branco!'>
                                        </div>
                                    </div>
    
                                    
                                    
                                    <div class='card'>
                                        <div class='card-header'>
                                            <h5 class='card-title mb-0'>Digite da última troca de toner</h5>
                                        </div>
                                        <div class='card-body'>
                                            <input type='date' name='newToner' value='".$row['T_toner']."' class='form-control' >
                                        </div>
                                    </div>

                                    <div class='card'>
                                        <div class='card-header'>
                                            <h5 class='card-title mb-0'>Data do último concerto</h5>
                                        </div>
                                        <div class='card-body'>
                                            <input type='date' name='newConcerto' value='".$row['D_concerto']."' class='form-control'>
                                        </div>
                                    </div>


                                    <div class='card'>
                                        <div class='card-header'>
                                            <h5 class='card-title mb-0'>Quem fez a última solicitação</h5>
                                        </div>
                                        <div class='card-body'>
                                            <input type='text' name='newSolicitacao' value='".$row['U_solicitacao']."' class='form-control'>
                                        </div>
                                    </div>
    
                                </div>
                                
                                <div class='col-12 col-lg-6'>
                                        <div class='card'>
                                            <div class='card-header'>
                                                <h5 class='card-title mb-0'>Serial da impressora</h5>
                                            </div>
                                            <div class='card-body'>
                                                <input type='text' name='newSerial' value='".$row['serial']."' class='form-control' readonly>
                                            </div>
                                        </div>

                                        <div class='card'>
                                        <div class='card-header'>
                                            <h5 class='card-title mb-0'>Digite o SETOR da impressora</h5>
                                        </div>
                                        <div class='card-body'>
                                            <input type='text' name='newSetor' value='".$row['setor']."' class='form-control'  required>
                                        </div>
                                        </div>
                                    
    
                                        <div class='card'>
                                            <div class='card-header'>
                                                <h5 class='card-title mb-0'>Selecione a LOJA em que esta a impressora:</h5>
                                            </div>
                                            <div class='card-body'>
                                                <select class='form-select mb-3' name='newLoja' required>
                                                    <option value='".$row['loja']."'>".$row['loja']."</option>
                                                    <option value='MATRIZ'>Matriz</option>
                                                    <option value='NSG'>NSG</option>
                                                    <option value='PA'>PA</option>
                                                    <option value='OH'>OH</option>
                                                    <option value='PM'>PM</option>
                                                </select>               
                                            </div>
                                        </div>

                                        
                                    </div>
                                    <div class='col-12 col-lg-12'>
                                        <div class='card'>
                                                <div class='card-body'>
                                                    <div>
                                                    <button type='submit' name='editaImpressora' class='btn btn-success'>Cadastrar</button>
                                                    </div>
                                                </div>
                                        </div> 
                                    </div>
                                </div>";
                            }
         
}

function gerar_formulario_editar_usuario(){
    $conexao = db_connect();
    $i = $_GET["codUsu"];
    $consulta = $conexao->query("SELECT * FROM tb_login WHERE id_login = '$i'");

    while ($row = $consulta->fetch()){
        echo "<div class='row'>
        <input type='hidden' value=' $i' name='indice'>
        <div class='col-12 col-lg-6'>
            <div class='card'>
                <div class='card-header'>
                    <h5 class='card-title mb-0'>Nome do usuário</h5>
                </div>
                <div class='card-body'>
                    <input type='text' value='".$row['nome']."' name='newNome' class='form-control'>
                </div>
            </div>

            <div class='card'>
                <div class='card-header'>
                    <h5 class='card-title mb-0'>Username</h5>
                </div>
                <div class='card-body'>
                    <input type='text' name='newUsername' value='".$row['username']."' class='form-control'>
                </div>
            </div>

            <div class='card'>
                <div class='card-header'>
                    <h5 class='card-title mb-0'>Senha</h5>
                </div>
                <div class='card-body'>
                    <input type='password' name='newSenha' class='form-control'>
                </div>
            </div>

            
            <div class='card'>
                <div class='card-header'>
                    <h5 class='card-title mb-0'>Nível de acesso do usuário</h5>
                </div>
                <div class='card-body'>
                    <div>
                        <label class='form-check'>
                            <input class='form-check-input' type='radio' value='0' name='newTipoUsuario'>
                            <span class='form-check-label'>Temporário</span>
                        </label>
                        <label class='form-check'>
                            <input class='form-check-input' type='radio' value='1' name='newTipoUsuario'>
                            <span class='form-check-label'>Usuário</span>
                        </label>
                        <label class='form-check'>
                            <input class='form-check-input' type='radio' value='2' name='newTipoUsuario'>
                            <span class='form-check-label'>
                                RH
                            </span>
                        </label>";
                        if($_SESSION['nivel']==3){
                            echo "<label class='form-check'>
                            <input class='form-check-input' type='radio' value='3' name='newTipoUsuario'>
                            <span class='form-check-label'>
                                Administrador
                            </span>
                            </label>";
                        }

                        echo "
                    </div>
                </div>
            </div>

            <div class='card'>
                <div class='card-header'>
                    <h5 class='card-title mb-0'>LOJA</h5>
                </div>
                <div class='card-body'>
                    <select class='form-select mb-3' name='newLoja'>
                        <option value='".$row['loja']."'>".$row['loja']."</option>";
                        if($_SESSION['nivel']==3){
                            echo "<option value='*'>Todas</option>";
                        }
                            
                        echo"
                        <option value='MATRIZ'>Matriz</option>
                        <option value='NSG'>NSG</option>
                        <option value='PA'>PA</option>
                        <option value='OH'>OH</option>
                        <option value='PM'>PM</option>
                    </select>               
                </div>
            </div>
        </div>
        
        <div class='col-12 col-lg-12'>
            <div class='card'>
                <div class='card-body'>
                    <div>
                        <button type='submit' name='editaUsuario' class='btn btn-success'>Cadastrar</button>
                    </div>
                </div>
            </div> 
        </div>";
    }
}

function gerar_lista_solicitar_toner(){
    $conexao = db_connect();
    if($_SESSION['loja']=='*'){
        $consulta = $conexao->query("SELECT * FROM tb_impressora"); 
    }else{
        $loja = $_SESSION['loja'];
        $consulta = $conexao->query("SELECT * FROM tb_impressora WHERE loja = '$loja'"); 
    }
    
    while ($row = $consulta->fetch()) {
                
        echo "<tr>".
        "<th scope='row' style='text-align: center;'><button name='codImp' class='btn btn-primary btn-sm' type='submit' value='".$row['id']."'>".$row['id'].
        "</button></th><td>".$row['modelo'].
        "</td><td>".$row['loja'].
        "</td><td>".$row['setor']."</td>".
        "</tr>";
                
    }
}

function alterar_escala() {
    $conexao = db_connect();
    $escala = $_GET['escolheEscala'];
    $consulta = $conexao->query("SELECT * FROM tb_semana AS semana 
    WHERE semana.id_escala = '$escala';");

    echo "<div class='row'>";

    while($row = $consulta->fetch()){
            if(isset($i)){
                $i++;
            }else{
                $i=0;
                echo "<input type='hidden' value='".$row['id_escala']."' name='id'>";
            }
            echo "<div class='col-12 col-lg-12'>".
                "<div class='col-12 col-lg-3'>".
                "<div class='card'>".
                "<div class='card-header'>".
                "<h5 class='card-title mb-0'>Data ". ($i + 1). ":</h5>".
                "</div>".
                "<div class='card-body'>".
                "<div>".
                "<input type='date' class='form-control' name='data[]' value='".$row['dia']."'>".
                "</div>".
                "</div>".
                "</div>".
                "</div>".
                "</div>";
            
            
            for ($x = 0; $x < 12; $x++) {
                echo "<div class='col-12 col-lg-3'>".
                    "<div class='card'>".
                    "<div class='card-header'>".
                    "<h5 class='card-title mb-0'>Colaborador ". ($x + 1) .":</h5>".
                    "</div>".
                    "<div class='card-body'>".
                    "<div>".
                    "<input type='text' class='form-control' name='nome".$i."[]' value='".$row['pessoa_'.$x]."'>".
                    "</div>".
                    "</div>".
                    "</div>".
                    "</div>".
                    "<div class='col-12 col-lg-3'>".
                    "<div class='card'>".
                    "<div class='card-header'>" .
                    "<h5 class='card-title mb-0'>folga colaborador ". ($x + 1) .":</h5>".
                    "</div>".
                    "<div class='card-body'>" .
                    "<div>" .
                    "<input type='date' class='form-control' name='folga".$i."[]' value='".$row['f_pessoa_'.$x]."'>".
                    "</div>" .
                    "</div>" .
                    "</div>" .
                    "</div>" ;
                
            }
        
    }

    echo "<div class='col-12 col-lg-1'>".
        "<button type='submit' class='btn btn-success' name='btn_altera_escala'>".
        "<svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-send' viewBox='0 0 16 16'>".
        "<path d='M15.854.146a.5.5 0 0 1 .11.54l-5.819 14.547a.75.75 0 0 1-1.329.124l-3.178-4.995L.643 7.184a.75.75 0 0 1 .124-1.33L15.314.037a.5.5 0 0 1 .54.11ZM6.636 10.07l2.761 4.338L14.13 2.576 6.636 10.07Zm6.787-8.201L1.591 6.602l4.339 2.76 7.494-7.493Z'/>".
        "</svg>".
        "</button>".
        "</div>";
    
}

?>