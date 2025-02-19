<?php


 //verifica se o botão de script 1 foi pessionado
if (isset($_POST['Script_1'])) {

    // Definindo variáveis
    $caminhoatual = $_POST['camihoatual'];

    echo "Iniciando o processo de cópia para a pasta padrão!<br>";

    // Executando o script e capturando a saída
    $output = [];
    exec("sudo /var/www/html/scripts/copyImagem.sh $caminhoatual", $output, $return_var);

    // Verifica se o comando foi executado com sucesso
    if ($return_var === 0) {
        echo "Realizando a cópia das imagens para: <a href='../scripts/downloads/img/'>Diretorio /img/</a>";
        echo "<pre>" . implode("\n", array_map('htmlspecialchars', $output)) . "</pre>";
    } else {
        echo "Erro ao executar o comando!";
    }

    //verifica se o botão de script 2 foi pessionado
} elseif (isset($_POST['Script_2'])) {
    
    //definindo o caminho atual do dispositivo
    $caminhoatual = $_POST['camihoatual'];

    // executando o script e salvando a saida

    $output = [];

    exec("sudo /var/www/html/scripts/delImagem.sh $caminhoatual", $output, $retorno_var);

    //verifica se o comando foi realizado com sucesso!
    if ($retorno_var === 0) {
        echo "Deletando arquivos de imagem";
    }else{
        echo "Erro ao executar o comando!";
    }

} elseif (isset($_POST['Script_3'])) {
    
    // definindo o caminho atual
    $caminhoatual = $_POST['camihoatual'];


    $output = [];

    // executa o script de cópia de arquivos
    exec("sudo /var/www/html/scripts/copyDoc.sh $caminhoatual", $output, $retorno_var);

    //verifica se funcionou a execução do script
    if ($retorno_var === 0) {
        echo "Realizando a cópia dos documentos para: <a href='../scripts/downloads/docs/'>Diretorio /docs/</a> ";
    }else{
        echo "Erro ao executar o comando!";
    }

} elseif (isset($_POST['Script_4'])) {
    
    $caminhoatual = $_POST['camihoatual'];

    exec(" sudo /var/www/html/scripts/delDoc.sh $caminhoatual",$output, $retorno_var);

    if ($retorno_var === 0) {
        echo "Arquivos removidos com sucesso!";
    }else{
        echo "Erro ao executar o comando";
    }
}

