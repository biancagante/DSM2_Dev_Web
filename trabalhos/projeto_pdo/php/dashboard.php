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
    <title>Configurações</title>
</head>

<body>
    <main>
        <h1>Seus dados</h1>
        <?php
            if (!empty($usuario['foto'])) {
                echo "<img src='{$usuario['foto']}'>";
            } 
            else {
                echo "Sem foto de perfil.";
            }
        ?>
    </main>
</body>

</html>