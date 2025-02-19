<?php
// Recebe o nome do dispositivo via POST
$dispositivo = $_POST['dispositivo'];


//criando

// Construindo o comando jmtpfs
// Construindo o comando jmtpfs com sudo

// Executando o comando para montagem
exec("sudo systemctl start android-mount.service");

//comando que consulta o log e verifica o codigoError, para saber se o dispositvo foi montado
$resultado = exec("sudo journalctl -u android-mount.service -n 4 | grep 'codigoError=' | cut -d ':' -f 4 | cut -d '=' -f 2");




// Redirecionando para a página principal
#header('Location: index.php'); // Substitua 'index.php' pelo nome da sua página principal
?>

<!DOCTYPE html>
<html lang="pr-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/principal.css">
    <title>Montagem</title>
</head>
<body>

    <nav>
        <a href="./">Voltar</a>
    </nav>

    <header>
        <h1>Montagem de dispositivos conectados</h1>
    </header>

        <section>
            <div class="Container1">
                <?php

                if ($resultado == "0") {
                    echo "<h3>Dispositivo montado com sucesso!</h3>";
                    echo '<p><a href="./executer">Acessar dispositivo</a></p>';
                }else{
                    echo "<h3>Erro ao montar o dispositivo!</h3>";
                    echo "<p>Verifique se o dispositivo está em MTP</p>";
                    exec("sudo systemctl stop android-mount.service");
                }

                ?>

            </div>
        </section>

    <footer>

    </footer>
</body>
</html>
