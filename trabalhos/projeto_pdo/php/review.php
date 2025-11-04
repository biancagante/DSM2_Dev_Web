<?php
    require "config.php";

    session_start();
    

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nome = $_POST['nome'];
        $estrelas = $_POST['estrelas'];
        $comentario = $_POST['comentario'];

        $query = $pdo->prepare('INSERT INTO avaliacao(nome, estrelas, comentario) VALUES (?, ?, ?)');
        $query->execute([$nome, $estrelas, $comentario]);
        header("Location: ../index.php");
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Saiba Mais</title>
</head>
<body>
    <?php
        if (isset($_SESSION['usuario_id'])) {
        echo "<form method='post'>
                    <h3>Enviar avaliação</h3>
                    <div class='mb-3'>
                        <label class='form-label'>Seu nome</label>
                        <input type='text' class='form-control' placeholder='Digite nome' name='nome'>
                    </div>
                        <label class='form-label'>Estrelas</label>
                        <input type='number' class='form-control' placeholder='Quantidade de estrelas' name='estrelas'>
                    <div class='mb-3'>
                        <label class='form-label'>Mensagem</label>
                        <textarea rows='4' class='form-control' placeholder='Digite sua mensagem' name='comentario'></textarea>
                    </div>
                    <button class='btn btn-dark w-100'>Enviar</button>
                </form>";
    }

    else {
        echo "<span>Crie uma conta ou faça Login para poder deixar uma avaliação!<a href='login.php'>Faça login</a></span>";
    }
    ?>
</body>
</html>