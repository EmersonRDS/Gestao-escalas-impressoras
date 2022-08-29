<?php
    session_start();
    ob_start();
    include_once "../model/Impressora.class.php";
    include_once "../model/Semana.class.php";
    
    include_once "conecta.php";
    include_once "headers.php";
    $conexao = db_connect();


    //dando um valor para o ip caso esteja vazio

    //deixando os dados como null caso nao estejam preenchido, para ocasionar a tela de
    //  DADOS INVÁLIDOS!!!
    if(empty($_POST['modelo'])){
        $_POST['modelo'] = null;
    }

    if(empty($_POST['serial'])){
        $_POST['serial'] = null;
    }

    if(empty($_POST['setor'])){
        $_POST['setor'] = null;
    }

    if(empty($_POST['loja'])){
        $_POST['loja'] = null;
    }

    if(isset($_GET['btn_logout'])){
        deslogar();
    }

    if(isset($_SESSION['usuario'])){
        include_once "../client/head.php";
        include_once "corpo.php";
?>
<main class="content">
	<div class="container-fluid p-0">
        <?php
                //-------------------------------------------------------------
                //cadastrar os dados da impressora
                //-------------------------------------------------------------
            if(isset($_POST['cadImpressora'])){
                if(isset($_POST['modelo']) and isset($_POST['serial'])
                and isset($_POST['setor']) and isset($_POST['loja'])){
                    //colocando os dados numa variável
                    
                       
                    $tempImpressora = new Impressora($_POST['modelo'], $_POST['serial'],
                        $_POST['ip'], $_POST['setor'],$_POST['loja']);
                    
                    //Gravando no BD

                    try {          
                        $modelo = $tempImpressora->getModelo();
                        $serial = $tempImpressora->getSerial();
                        $ip = $tempImpressora->getIP();
                        $loja = $tempImpressora->getLoja();
                        $setor = $tempImpressora->getSetor();
                        $toner = $tempImpressora->getToner();
                        $concerto = $tempImpressora->getConcerto();
                        $solicitacao = $tempImpressora->getSolicitacao();
                        $tipo = $_POST['tipo'];


                        $comandoSQL = "INSERT INTO tb_impressora (modelo,serial,loja,ip,setor,tipo,T_toner,D_concerto,U_solicitacao) 
                                        VALUES ('$modelo','$serial','$loja','$ip','$setor','$tipo','$toner','$concerto','$solicitacao')";        
                        $grava = $conexao->prepare($comandoSQL); //testa o comando
                        $grava->execute(array());     
                        
                        
                        echo "<div class='cadastradoDiv'>".
                        "<h2 style='color: green;'>Foi cadastrada com sucesso!</h2>".
                        "<p>A impressora de dados:</p>".
                        "<p>Modelo: ".$tempImpressora->getModelo()."</p>".
                        "<p>Serial: ".$tempImpressora->getSerial()."</p>".
                        "<p>IP: ".$tempImpressora->getIP()."</p>".
                        "<p>Loja: ".$tempImpressora->getLoja()."</p>".
                        "<p>Setor: ".$tempImpressora->getSetor()."</p>".
                        "<p>Insumo: ".$tipo."</p>".
                        "<p>Ult. toner: ".$tempImpressora->getToner()."</p>".
                        "<p>Ult. concerto: ".$tempImpressora->getConcerto()."</p>".
                        "<p>Ult. a solicitar: ".$tempImpressora->getSolicitacao()."</p>".
                        "</div>";

                        cadastrar_Impressora();
                       
                    }catch(PDOException $e) { // caso retorne erro
                        
                        echo '<h1>
                        Erro ' . $e->getMessage() .
                             '</h1>';

                        echo '<h2>
                            REGISTRE A TELA E CONTATE A TI!! '.
                        '</h2>';
                        
                    }

                }else{
                    echo "<h2 style='color: red;'>Dados inválidos!</h2>";
                    index();
                }

            }
            else if(isset($_POST['editaImpressora'])){
                //-------------------------------------------------------------
                //deixando os dados como null caso nao estejam preenchido, para ocasionar a tela de
                //  DADOS INVÁLIDOS!!!
                //-------------------------------------------------------------
                if(empty($_POST['newModelo'])){
                    $_POST['newModelo'] = null;
                }
                
                if(empty($_POST['newSerial'])){
                    $_POST['newSerial'] = null;
                }

                $lojaTemp = addslashes($_POST['newLoja']);

                //-------------------------------------------------------------
                //editar os dados da impressora
                //-------------------------------------------------------------

                if(isset($_POST['newModelo']) and isset($_POST['newSerial'])
                and isset($_POST['indice']) and isset($_POST['newIp']) 
                and isset($_POST['newSetor'])
                and isset($_POST['newToner']) and isset($_POST['newConcerto']) 
                and isset($_POST['newSolicitacao'])){

                    $i = ($_POST['indice']);
                    
                    
                    $modelo = $_POST['newModelo'];
                    $serial = $_POST['newSerial'];
                    $ip = $_POST['newIp'];
                    $setor =$_POST['newSetor'];
                    $loja = $lojaTemp;
                    $toner = $_POST['newToner'];
                    $concerto = $_POST['newConcerto'];
                    $solicitacao = $_POST['newSolicitacao'];

                    $update = $conexao->query("UPDATE tb_impressora
                    SET  modelo = '$modelo' , serial = '$serial' , loja = '$loja' , ip = '$ip', setor = '$setor', T_toner = '$toner', D_concerto = '$concerto', U_solicitacao = '$solicitacao'
                    WHERE id = $i;");
                    
                    echo "<div class='cadastradoDiv'>".
                    "<h2 style='color: green;'>Foi alterada com sucesso!</h2>".
                    "<p>A impressora de dados:</p>";
                        $consulta = $conexao->query("SELECT * FROM tb_impressora WHERE id = '$i'");
                        while ($row = $consulta->fetch()) {
                            echo "<p>Modelo: ".$row['modelo']."</p>
                            <p>Serial: ".$row['serial']."</p>
                            <p>IP: ".$row['ip']."</p>
                            <p>Loja: ".$row['loja']."</p>
                            <p>Setor: ".$row['setor']."</p>
                            <p>Ult. toner: ".$row['T_toner']."</p>
                            <p>Ult. concerto: ".$row['D_concerto']."</p>
                            <p>Ult. a solicitar: ".$row['U_solicitacao']."</p>";
                        }
                    
                    "</div>";

                    alterar_Impressora();

                }else{
                    echo "<h2 style='color: red;'>Dados inválidos!</h2>";
                    alterar_Impressora();
                }
            }
                //-------------------------------------------------------------
                //Cadastrar usuário
                //-------------------------------------------------------------
            else if(isset($_POST['cadUsuario'])){
                if(isset($_POST['nome']) and isset($_POST['login'])
                and isset($_POST['senha']) and isset($_POST['tipoUsuario'])
                and isset($_POST['loja'])){
                    //colocando os dados numa variável
                    
                    
                    //Gravando no BD

                    try {          
                        $nome = $_POST['nome'];
                        $login = $_POST['login'];
                        $senha = sha1($_POST['senha']);
                        $tipoUsuario = $_POST['tipoUsuario'];
                        $loja = addslashes($_POST['loja']);


                        $comandoSQL = "INSERT INTO tb_login (nome,username,senha,nivel,loja) 
                                        VALUES ('$nome','$login','$senha','$tipoUsuario','$loja')";        
                        $grava = $conexao->prepare($comandoSQL); //testa o comando
                        $grava->execute(array());     
                        
                        
                        echo "<div>".
                        "<h2 style='color: green;'>Foi cadastrada com sucesso!</h2>".
                        "<p>O usuário de dados:</p>".
                        "<p>Nome: ".$nome."</p>".
                        "<p>Login: ".$login."</p>".
                        "<p>Tipo: ".$tipoUsuario."</p>".
                        "<p>Loja: ".$loja."</p>".
                        "</div>";

                        cadastrar_Usuario();
                       
                    }catch(PDOException $e) { // caso retorne erro
                        if($e->getCode()==23000){
                            echo '<h2>
                            Nome de usuário já utilizado!! '.
                                '</h2>';

                            cadastrar_Usuario();
                        }else{
                            echo '<h1>
                            Erro ' . $e->getMessage() .
                            '</h1>';

                            echo '<h2>
                            REGISTRE A TELA E CONTATE A TI!! '.
                            '</h2>';
                        }
                    }

                }else{
                    echo "<h2 style='color: red;'>Dados inválidos!</h2>";
                    index();
                }

            }

            else if(isset($_POST['editaUsuario'])){
                
                //-------------------------------------------------------------
                //editar os dados do usuário
                //-------------------------------------------------------------

                if(isset($_POST['newNome']) and isset($_POST['newUsername'])
                and isset($_POST['newLoja']) and isset($_POST['newTipoUsuario'])){
                    

                    $i = ($_POST['indice']);
                    
                    
                    $nome = $_POST['newNome'];
                    $username = $_POST['newUsername'];
                    $nivel =$_POST['newTipoUsuario'];
                    $loja = addslashes($_POST['newLoja']);
                    try{
                        if(empty($_POST['newSenha'])){
                            $update = $conexao->query("UPDATE tb_login
                            SET  nome = '$nome' , username = '$username' ,  nivel = '$nivel', loja = '$loja'
                            WHERE id_login = $i;");
                            
                        }else{
                            $senha =sha1($_POST['newSenha']);
                            $update = $conexao->query("UPDATE tb_login
                            SET  nome = '$nome' , username = '$username' , senha = '$senha' , nivel = '$nivel', loja = '$loja'
                            WHERE id_login = $i;");
                        }
                    }catch(PDOException $e) { 
                        if($e->getCode()==23000){
                            echo '<h2>
                            Nome de usuário já utilizado!! '.
                                '</h2>';

                        }else{
                            echo '<h1>
                            Erro ' . $e->getMessage() .
                            '</h1>';

                            echo '<h2>
                            REGISTRE A TELA E CONTATE A TI!! '.
                            '</h2>';
                        }
                    }

                    echo "<div class='cadastradoDiv'>".
                    "<h2 style='color: green;'>Foi alterado com sucesso!</h2>".
                    "<p>O usuário de dados:</p>";
                        $consulta = $conexao->query("SELECT * FROM tb_login WHERE id_login = '$i'");
                        while ($row = $consulta->fetch()) {
                            echo "<p>Nome: ".$row['nome']."</p>
                            <p>Username: ".$row['username']."</p>
                            <p>Nivel: ".$row['nivel']."</p>
                            <p>Loja: ".$row['loja']."</p>";
                        }
                    
                    echo "</div>";

                    alterar_Usuario();

                }else{
                    echo "<h2 style='color: red;'>Dados inválidos!</h2>";
                    index();
                }
            }else if(isset($_POST['btn_altera_senha'])){
                //-------------------------------------------------------------
                //altera dados de primeiro acesso
                //-------------------------------------------------------------

                if(isset($_POST['username']) and isset($_POST['senha'])){
                    
                    try{
                        $i = ($_SESSION['id']);
                        
                        
                        $username = $_POST['username'];
                        $senha = sha1($_POST['senha']);
                        
                        
                            $update = $conexao->query("UPDATE tb_login
                            SET  username = '$username' ,  nivel = '1', senha = '$senha'
                            WHERE id_login = $i;");
                          
                        
                        
                        echo "<div class='cadastradoDiv'>".
                        "<h2 style='color: green;'>Foi alterado com sucesso!</h2>".
                        "<p>O usuário de dados:</p>";
                            $consulta = $conexao->query("SELECT * FROM tb_login WHERE id_login = '$i'");
                            while ($row = $consulta->fetch()) {
                                echo "<p>Nome: ".$row['nome']."</p>
                                <p>Username: ".$row['username']."</p>
                                <p>Nivel: ".$row['nivel']."</p>
                                <p>Loja: ".$row['loja']."</p>";
                            }
                        
                        echo "</div>";

                        deslogar();

                    }catch(PDOException $e) { //caso retorne erro
                        if($e->getCode()==23000){
                            echo '<h1>Username já utilizado, escolha outro!</h1>';
                            muda_Senha();
                        }else{
                        echo '<h1>
                                 Erro ' . $e->getMessage() .
                             '</h1>';
                            muda_Senha();
                        }
                    }

                }else{
                    echo "<h2 style='color: red;'>Dados inválidos!</h2>";
                    index();
                }
                
            }else if(isset($_POST['cadSolicitacao'])){
                

                //-------------------------------------------------------------
                //Cadastro de solicitação
                //-------------------------------------------------------------

                if(isset($_POST['nome']) and isset($_POST['codImp'])
                    and isset($_POST['modelo'])){
                    
                    
                    try {          

                        $i = ($_POST['codImp']);
                        $nome = $_POST['nome'];
                        $modelo =$_POST['modelo'];
                        $status = "Solicitado!";

                        if(isset($_POST['tintas'])){
                            $tintas = ('tintas das cores ' . $_POST['tintas']);
                            $comandoSQL = "INSERT INTO tb_solicitacao (status,solicitante,modelo,id_impressora,comentario) 
                                        VALUES ('$status','$nome','$modelo','$i','$tintas')";
                        }else{
                            $tintas = 'toner';
                            $comandoSQL = "INSERT INTO tb_solicitacao (status,solicitante,modelo,id_impressora,comentario) 
                                        VALUES ('$status','$nome','$modelo','$i','$tintas')"; 
                        }

                              
                        $grava = $conexao->prepare($comandoSQL); //testa o comando
                        $grava->execute(array());
                        
                        
                        echo "<div>".
                        "<h2 style='color: green;'>Foi solicitado com sucesso!</h2>".
                        "</div>";

                        //header("Refresh:4;../client/cadastrar.impressora.php");
                        cadastrar_Usuario();
                       
                    }catch(PDOException $e) { // caso retorne erro
                        
                        echo '<h1>
                        Erro ' . $e->getMessage() .
                             '</h1>';

                        echo '<h2>
                            REGISTRE A TELA E CONTATE A TI!! '.
                        '</h2>';
                        
                    }

                    
                    index();

                }else{
                    echo "<h2 style='color: red;'>Dados inválidos!</h2>";
                    index();
                }
            
            
            }else if(isset($_POST['btn_escala'])){
                
                //-------------------------------------------------------------
                //Cadastro de escala
                //-------------------------------------------------------------

                if(isset($_POST['nDias']) and isset($_POST['nColaboradores'])){
                    $nDias = ($_POST['nDias']);
                    $nColaboradores = ($_POST['nColaboradores']);

                    try {          

                        $idUsuario = $_SESSION['id'];
                        $setor = $_POST['setor'];

                            
                        $comandoSQL = "INSERT INTO tb_escala (id_usuario,setor_escala ) VALUES ('$idUsuario','$setor')"; 
                        $grava = $conexao->prepare($comandoSQL); //testa o comando
                        $grava->execute(array());
                            
                        $idEscala = $conexao->lastInsertId();
                        
                    }catch(PDOException $e) { // caso retorne erro
                            
                            echo '<h1>
                            Erro ' . $e->getMessage() .
                                '</h1>';
                            
                            echo '<h2>
                                REGISTRE A TELA E CONTATE A TI!! '.
                            '</h2>';
                    }
                        

                        for($i=0; $i<$nDias ; $i++){
                            $dia = $_POST["data"][$i];

                            $semana = new Semana($dia);
                            
                            

                            for($x=0 ; $x < $nColaboradores; $x++){
                                $semana->setPessoa($_POST["nome".$i][$x]);
                                $semana->setFolgaPessoa($_POST["folga".$i][$x]);

                                if(($x+1)==$nColaboradores){
                                    for($f=$x ; $f <12 ; $f++){
                                        $semana->setPessoa('');
                                        $semana->setFolgaPessoa('');
                                    }
                                }

                            }

                            $colaboradores = $semana->getPessoa();
                            $folgaColaboradores = $semana->getFolgaPessoa();
                            

                            $grava = $conexao->prepare("INSERT INTO tb_semana (id_escala,dia,pessoa_0,f_pessoa_0,
                            pessoa_1,f_pessoa_1,pessoa_2,f_pessoa_2,pessoa_3,f_pessoa_3,pessoa_4,f_pessoa_4,
                            pessoa_5,f_pessoa_5,pessoa_6,f_pessoa_6,pessoa_7,f_pessoa_7,pessoa_8,
                            f_pessoa_8,pessoa_9,f_pessoa_9,pessoa_10,f_pessoa_10,pessoa_11,f_pessoa_11) 
                            VALUES 
                            ('$idEscala' , '$dia' , '$colaboradores[0]' , '$folgaColaboradores[0]' ,
                            '$colaboradores[1]' , '$folgaColaboradores[1]' , '$colaboradores[2]' , '$folgaColaboradores[2]' ,
                            '$colaboradores[3]' , '$folgaColaboradores[3]' , '$colaboradores[4]' , '$folgaColaboradores[4]' , 
                            '$colaboradores[5]' , '$folgaColaboradores[5]' , '$colaboradores[6]' , '$folgaColaboradores[6]' ,
                            '$colaboradores[7]' , '$folgaColaboradores[7]' , '$colaboradores[8]' , '$folgaColaboradores[8]' ,
                            '$colaboradores[9]' , '$folgaColaboradores[9]' , '$colaboradores[10]' , '$folgaColaboradores[10]' ,
                            '$colaboradores[11]' , '$folgaColaboradores[11]');");

                            $grava->execute(array());

                        }
                    echo  "<div>".
                        "<h2 style='color: green;'>Foi enviado com sucesso!</h2>".
                        "</div>";
                    
                    envia_Escala();

                }else{
                    echo "<h2 style='color: red;'>Dados inválidos!</h2>";
                    index();
                }
            }
            
            
            
            else{
                echo "ERRO!!!!";
                index();

            }
            ?>
				</div>
			</main>

			<?php
                include_once "../client/footer.php";
            ?>
		</div>
	</div>

	<script src="../js/app.js"></script>

</body>
<?php
   }else{
    ob_end_flush();
    echo "<h1>Usuário não conectado!</h1>";
    index();
    }

?>