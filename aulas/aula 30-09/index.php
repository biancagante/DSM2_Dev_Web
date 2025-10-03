<?php
    if(isset($_COOKIE['background'])) {
        $cor = $_COOKIE['background'];
    }

    // Sessão
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        session_start();
        if (!empty($_POST["nome"]) && isset($_POST["nome"])) {
            $_SESSION["nome"] = $_POST["nome"]; 
            header('Location: usuario.php');
        }
        else {
            echo "<script>alert('Nenhum nome inserido')</script>";
        }
    }
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cookies e Sessões</title>
    <link rel="stylesheet" href="style.css">
</head>
<body style="background-color: <?php echo $cor;?>;">

    <main class="container">
        <h2>Sistema PHP</h2>

        <form method="POST" action="#">
            <input type="text" name="nome" placeholder="seu username">
            <input type="submit" value="Entrar" class="botao">
        </form>

        <a href="config.php" class="config-link">Configurações</a>

    </main>

</body>
</html>
