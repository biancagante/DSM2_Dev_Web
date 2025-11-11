<?php
require "config.php";
session_start();

$servico = null;
$id = isset($_GET['id']) ? (int) $_GET['id'] : null;

if ($id) {
    $query = $pdo->prepare("SELECT * FROM servico WHERE id = ?");
    $query->execute([$id]);
    $servico = $query->fetch();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $id) {
    if (!isset($_SESSION['usuario_id'])) {
        header("Location: login.php");
        exit;
    }
    $nome = trim($_POST['nome'] ?? '');
    $estrelas = (int) ($_POST['estrelas'] ?? 0);
    $comentario = trim($_POST['comentario'] ?? '');
    if ($nome === '') $nome = 'Anônimo';
    if ($estrelas < 1) $estrelas = 1;
    if ($estrelas > 5) $estrelas = 5;
    $insert = $pdo->prepare('INSERT INTO avaliacao (nome, estrelas, comentario, id_servico) VALUES (?, ?, ?, ?)');
    $insert->execute([$nome, $estrelas, $comentario, $id]);
    header("Location: avaliar.php?id=" . $id);
    exit;
}

$avaliacoes = [];
if ($id) {
    $avaliacoes = $pdo->prepare("SELECT nome, estrelas, comentario FROM avaliacao WHERE id_servico = ? ORDER BY id DESC");
    $avaliacoes->execute([$id]);
    $avaliacoes = $avaliacoes->fetchAll();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Saiba Mais</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/gh/exacti/floating-labels@latest/floating-labels.min.css" media="screen">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../assets/style.css">
    <script src="../assets/script.js"></script>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
<div class='container-flex'>
<?php
    if ($servico) {
        echo "<div class='card-servico'>
                <img src='" . $servico['foto'] . "' class='w-100' style='height:300px;object-fit:cover;'>
                <div class='p-4 text-center'>
                    <h2 class='fw-bold mb-3'>" . $servico['titulo'] . "</h2>
                    <p class='text-muted fs-5'>" . $servico['descricao'] . "</p>
                    <a href='../index.php' class='btn btn-outline-primary mt-3 px-4'>Voltar</a>
                </div>
            </div>";

        if (isset($_SESSION['usuario_id'])) {
            echo "<form method='post' class='avaliacao-form'>
                    <h3>Enviar avaliação</h3>
                    <div class='mb-3'>
                        <label class='form-label'>Seu nome</label>
                        <input type='text' class='form-control' name='nome' placeholder='Digite seu nome' required>
                    </div>
                    <div class='mb-3'>
                        <label class='form-label'>Estrelas (1 a 5)</label>
                        <input type='number' min='1' max='5' class='form-control' name='estrelas' placeholder='Quantidade de estrelas' required>
                    </div>
                    <div class='mb-3'>
                        <label class='form-label'>Comentário</label>
                        <textarea class='form-control' rows='4' name='comentario' placeholder='Digite seu comentário' required></textarea>
                    </div>
                    <button class='btn btn-dark w-100'>Enviar</button>
                </form>";
        } else {
            echo "<div class='text-center' style='max-width:400px'>
                    <p class='fs-5'>Crie uma conta ou faça login para poder deixar uma avaliação!</p>
                    <a href='login.php' class='btn btn-primary px-4'>Fazer Login</a>
                </div>";
        }
    } 
    else {
        echo "<div class='alert alert-danger text-center mt-5'>Serviço não encontrado!</div>";
    }
?>
</div>
<div class='avaliacao-list py-5'>
<div class='container'>
<h4 class='py-3'>Avaliações</h4>
<?php
    if (count($avaliacoes) > 0) {
        foreach ($avaliacoes as $a) {
            echo "<div class='card mb-3'>
                    <div class='card-body'>
                        <div class='d-flex justify-content-between align-items-start'>
                            <div>
                                <strong>" . $a['nome'] . "</strong>
                            </div>
                            <div>
                            
                    <p>Estrelas: " . $a['estrelas'] ."</p>";
            // $n = (int)($a['estrelas'] ?? 0);
            // for ($i = 0; $i < 5; $i++) {
            //     if ($i < $n) echo "<i class='bi bi-star-fill estrela'></i>";
            //     else echo "<i class='bi bi-star'></i>";
            // }
            echo "</div>
                        </div>
                        <p class='mt-2 mb-0'>" . $a['comentario'] . "</p>
                    </div>
                </div>";
        }
    } 
    else {
        echo "<p>Sem avaliações.</p>";
    }
?>
</div>
</div>

</body>
</html>