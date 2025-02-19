<?php
// Define o diretório base (opcional)
$baseDir = '/var/www/html/acesso/';
$caminhoAtual = isset($_GET['dir']) ? $_GET['dir'] : $baseDir;

// Listando arquivos e diretórios
$saida = shell_exec("sudo ls -la " . escapeshellarg($caminhoAtual) . " 2>/var/www/html/errorlog.tmp");


if (file_exists('/var/www/html/errorlog.tmp')) {
    $erro = file_get_contents('/var/www/html/errorlog.tmp');
} else {
    $erro = '';
}

// Listar apenas os diretórios
$diretoriosApenas = shell_exec("sudo ls -l " . escapeshellarg($caminhoAtual) . " | grep '^d' | awk '{print $9}' ");

//trata dos espaços da string
$diretoriosApenas = preg_replace('/\s+/', ' ', trim($diretoriosApenas));

//transforma em uma array
$diretoriosarrya = explode(' ', $diretoriosApenas);


?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navegador de Diretórios</title>
</head>
<body>
    <h2>Diretório atual: <?php echo htmlspecialchars($caminhoAtual); ?></h2>

    <h3>Listagem:</h3>
    <fieldset>
        <pre><?php echo nl2br(htmlspecialchars($saida)); ?></pre>
        <?php if ($erro): ?>
            <p style="color: red;">Erro: <?php echo nl2br(htmlspecialchars($erro)); ?></p>
        <?php endif; ?>
    </fieldset>

    <h3>Executar Comando:</h3>
    <form action="" method="get">
        <input type="hidden" name="dir" value="<?php echo htmlspecialchars($caminhoAtual); ?>">
        <input type="text" name="cmd" placeholder="Comando" required>
        <input type="submit" value="Executar">
    </form>


    <h3>Subir um nível:</h3>
    <form action="" method="get">
        <input type="hidden" name="dir" value="<?php echo htmlspecialchars(dirname($caminhoAtual)); ?>/">
        <input type="submit" value="Subir">
    </form>

    <h3>Acessar diretorio</h3>
    <form action="" method="get">

        <select name="dir">

            <?php
               foreach ($diretoriosarrya as $dir) {
                echo "<option value='$caminhoAtual" . htmlspecialchars($dir) . "'>" . htmlspecialchars($dir) . "</option>";
               }
            ?>

        </select>
        <input type="submit" value="Acessar">
    </form>

    <br>
    <br>
    <th>    </th>

    <fieldset>
        <legend>Scripts</legend>
            <table>
                <tr>
                    <td>
                    <form action="./decider.php" method="POST">
                        <input type="submit" value="Copiar imagens" name="Script_1">
                        <input type="hidden" name="camihoatual" value="<?php echo $caminhoAtual; ?>">
                    </form>
                    </td>
                

                
                    <td>
                    <form action="./decider.php" method="POST">
                        <input type="submit" value="Deletar imagens" name="Script_2">
                        <input type="hidden" name="camihoatual" value="<?php echo $caminhoAtual; ?>">
                    </form>
                    </td>
                


                
                    <td>
                    <form action="./decider.php" method="POST">
                        <input type="submit" value="Copiar arquivos" name="Script_3">
                        <input type="hidden" name="camihoatual" value="<?php echo $caminhoAtual; ?>">
                    </form>
                    </td>

                    <td>
                    <form action="./decider.php" method="POST">
                        <input type="submit" value="Deletar arquivos" name="Script_4">
                        <input type="hidden" name="camihoatual" value="<?php echo $caminhoAtual; ?>">
                    </form>
                    </td>
                </tr>
            </table>

            <h3><?php echo $caminhoAtual; ?></h3>
    </fieldset>
</body>
</html>
