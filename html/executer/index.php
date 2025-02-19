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

// Trata dos espaços da string
$diretoriosApenas = preg_replace('/\s+/', ' ', trim($diretoriosApenas));

// Transforma em uma array
$diretoriosArray = explode(' ', $diretoriosApenas);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/principal.css">
    <title>Navegador de Diretórios</title>

</head>
<body>
   
    <div class="directory-title">Diretório Atual: <?php echo htmlspecialchars($caminhoAtual); ?></div>

    <div class="commands">
        <h3>Listagem de Arquivos:</h3>
        <fieldset>
            <pre><?php echo nl2br(htmlspecialchars($saida)); ?></pre>
            <?php if ($erro): ?>
                <p style="color: red;">Erro: <?php echo nl2br(htmlspecialchars($erro)); ?></p>
            <?php endif; ?>
        </fieldset>
    </div>

    <div class="directory-selector">
        <h3>Acessar Diretório</h3>
        <form action="" method="get">
            <select name="dir">
                <?php foreach ($diretoriosArray as $dir): ?>
                    <option value="<?php echo htmlspecialchars($caminhoAtual . '/' . $dir); ?>"><?php echo htmlspecialchars($dir); ?></option>
                <?php endforeach; ?>
            </select>
            <input type="submit" value="Acessar">
        </form>

        <h3>Subir um Nível</h3>
        <form action="" method="get">
            <input type="hidden" name="dir" value="<?php echo htmlspecialchars(dirname($caminhoAtual)); ?>/">
            <input type="submit" value="Subir">
        </form>
    </div>

    <div class="scripts-section">
        <fieldset>
            <legend>Scripts</legend>
            <div class="scripts-flex">
                <form action="./decider.php" method="POST">
                    <input type="submit" value="Copiar Imagens" name="Script_1">
                    <input type="hidden" name="camihoatual" value="<?php echo htmlspecialchars($caminhoAtual); ?>">
                </form>
                <form action="./decider.php" method="POST">
                    <input type="submit" value="Deletar Imagens" name="Script_2">
                    <input type="hidden" name="camihoatual" value="<?php echo htmlspecialchars($caminhoAtual); ?>">
                </form>
                <form action="./decider.php" method="POST">
                    <input type="submit" value="Copiar Arquivos" name="Script_3">
                    <input type="hidden" name="camihoatual" value="<?php echo htmlspecialchars($caminhoAtual); ?>">
                </form>
                <form action="./decider.php" method="POST">
                    <input type="submit" value="Deletar Arquivos" name="Script_4">
                    <input type="hidden" name="camihoatual" value="<?php echo htmlspecialchars($caminhoAtual); ?>">
                </form>
            </div>
        </fieldset>
    </div>
</body>
</html>
