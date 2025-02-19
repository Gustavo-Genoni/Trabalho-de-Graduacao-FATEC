<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <script>
        // Atualiza a página a cada 5 segundos
        setInterval(() => {
            location.reload();
        }, 5000);
    </script>
</head>
<body>

    <h2>Seja bem-vindo(a) ao sistema Raspberry PI Jacking!</h2>
    <h3>Este sistema foi criado para o trabalho de graduação da FATEC OURINHOS!</h3>

    <fieldset>
        <legend>Lista de dispositivos conectados via USB</legend>
        
        <table border="1" cellpadding="5" cellspacing="0">
            <tr>
                <th>Nome do Dispositivo</th>
                <th>Ação</th>
            </tr>
            <?php
                // Executa o comando para listar dispositivos USB, excluindo 003, 002 e 001
                $output = shell_exec("lsusb | egrep -v 'Device (003|002|001)'");

                // Divide o resultado em linhas e exibe cada dispositivo em uma linha da tabela
                $devices = explode("\n", trim($output));
                foreach ($devices as $device) {
                    if (!empty($device)) { // Verifica se a linha não está vazia
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($device) . "</td>";
                        echo "<td><button onclick=\"alert('Ação executada para o dispositivo!')\">Iniciar montagem</button></td>";
                        echo "</tr>";
                    }
                }
            ?>
        </table>
    </fieldset>

</body>
</html>
