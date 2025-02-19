

<!DOCTYPE html>
<html lang="pt-be">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/principal.css">
    <title>Desmontar</title>
</head>
<body>

    <nav>
        <a href="./">Voltar</a>
    </nav>


    <header>
        <h2>Desmontando partição</h2>
    </header>

    <section>

        <div class="Container1">

            <?php

                exec("sudo systemctl stop android-mount.service");
                $resultado = exec("sudo journalctl -u android-mount.service -n 4 | grep 'codigoError=' | cut -d ':' -f 4 | cut -d '=' -f 2");;

                if ($resultado == "0") {
                    echo "Desmontado com sucesso!";
                }else {
                    echo "Erro! </br> code: $resultado";
                }

            ?>

        </div>

    </section>


    <footer>

    </footer>
</body>
</html>