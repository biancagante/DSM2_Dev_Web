<?php
    $dados_cadastrais = fopen("dados.txt", "a");
    fclose($dados_cadastrais);

    function cadastrarUser($nome, $email, $senha) {
        $dados_cadastrais = fopen("dados.txt", "a");
        fwrite($dados_cadastrais, ($nome . "," . $email . "," . $senha . "\n"));
        fclose($dados_cadastrais);
    }
    
    function verificarCredenciais($nome, $email, $senha) {
        $dados_cadastrais = fopen("dados.txt", "r");
        while(($linha = fgets($dados_cadastrais)) != false) {
            $array_dados = explode(',', trim($linha));
            if (in_array($email, $array_dados) && in_array($senha, $array_dados)) {
                session_start();
                $_SESSION["nome"] = $_POST["nome"];
                $_SESSION["email"] = $_POST["email"];
                header('Location: userpage.php');
                return "Acesso liberado";
            }
        }
        fclose($dados_cadastrais);
        return "Credenciais não encontradas";
    }
?>