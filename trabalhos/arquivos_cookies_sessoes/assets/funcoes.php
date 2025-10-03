<?php
    $contador = 0;
    while ($contador < 1); {
        $dados_cadastrais = fopen("dados.txt", "a");
        fwrite($dados_cadastrais, "Username | E-mail | Password");
        $contador++;
    }
    // setcookie("contador", $contador, time() + 86400);
    // fclose($dados_cadastrais);

    function cadastrarUser($nome, $email, $senha) {
        $dados_cadastrais = fopen("dados.txt", "a");
        fwrite($dados_cadastrais, ($nome . "," . $email . "," . $senha . "\n"));
        fclose($dados_cadastrais);
    }
    
    function verificarCredenciais($nome, $email, $senha) {
        $dados_cadastrais = fopen("dados.txt", "r");
        while(($linha = fgets($dados_cadastrais)) != false) {
            $array_dados = explode(',', trim($linha));
            if (in_array($email, $array_dados)) {
                return "Acesso liberado";
            }
        }
        fclose($dados_cadastrais);
        return "Credenciais não encontradas";
    }
?>