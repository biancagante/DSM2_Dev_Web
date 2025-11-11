<?php
    require "config.php";

    session_start();

    if (!isset($_SESSION['usuario_id'])) {
        header('Location: login.php');
        exit;
    }

    $query = $pdo->prepare('SELECT nome, email, foto FROM usuario WHERE id = ?');
    $query->execute([$_SESSION['usuario_id']]);
    $usuario = $query->fetch();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/gh/exacti/floating-labels@latest/floating-labels.min.css" media="screen">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../assets/style.css">
    <script src="../assets/script.js"></script>
    <link rel="icon" type="image/png" href="https://cdn-icons-png.flaticon.com/512/16796/16796125.png">
</head>
<body>
    <main class="dashboard-container">
        <header class="dashboard-header">
            <a href="../index.php" class="btn-home"><i class="bi bi-house-door"></i> Home</a>
            <?php
                echo "<h1>Bem-vindo(a), " . $usuario['nome'] . "!</h1>";
            ?>
            <a href="logout.php" class="btn-logout"><i class="bi bi-box-arrow-right"></i> Sair</a>
        </header>

        <section class="user-info">
            <?php
                if (!empty($usuario['foto'])) {
                    echo "<img src='" . $usuario['foto'] . "' class='user-photo' alt='Foto de perfil'>";
                } 
                else {
                    echo "<div class='user-photo placeholder'><i class='bi bi-person'></i></div>";
                }

                echo "
                <div>
                    <h2>" . $usuario['nome'] . "</h2>
                    <p>" . $usuario['email'] . "</p>
                </div>";
            ?>
        </section>
        <section class="cards-grid">
            <div class="dashboard-card">
                <i class="bi bi-box-seam"></i>
                <h3>Avaliações</h3>
                <a href='avaliacao.php' class='btn-card'>Acessar</a>
            </div>
            <div class="dashboard-card">
                <i class="bi bi-box-seam"></i>
                <h3>Produtos</h3>
                <a href='produtos.php' class='btn-card'>Acessar</a>
            </div>
            <div class="dashboard-card">
                <i class="bi bi-chat-dots"></i>
                <h3>Contato</h3>
                <a href='contatos.php' class='btn-card'>Acessar</a>
            </div>
            <div class="dashboard-card">
                <i class="bi bi-people"></i>
                <h3>Usuários</h3>
                <a href='usuarios.php' class='btn-card'>Acessar</a>
            </div>
        </section>
    </main>
</body>
</html>