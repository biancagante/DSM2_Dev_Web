<?php
    require "config.php";

    $exibirUsuarios = $pdo->query("SELECT * FROM usuario");
    $exibirUsuarios = $exibirUsuarios->fetchAll();

    $id = $_POST['id'] ?? null;
    $nome = $_POST['nome'] ?? null;
    $email = $_POST['email'] ?? null;
    $senha = $_POST['senha'] ?? null;
    $nivel = $_POST['nivel'] ?? null;
    $foto = $_POST['foto'] ?? null;

    $usuarioEditar = null;

    if (isset($_POST['novoUser'])) {
        echo "<div class='py-5 form-editar'><h2>Novo Usuário</h2>
            <form class=''mx-auto' action='' method='post'>
                <label>Nome:</label>
                <input class='form-control' type='text' name='nome' value=''><br>
                <label>Email:</label>
                <input class='form-control' type='email' name='email' value=''><br>
                <label>Senha:</label>
                <input class='form-control' type='password' name='senha' value=''><br>
                <label>Nível:</label>
                <input class='form-control' type='text' name='nivel' value=''><br>
                <label>Foto:</label>
                <input class='form-control' type='file' name='foto'><br>
                <input class='btn btn-success' type='submit' name='salvar' value='Salvar Alterações'>
                <input class='btn btn-secondary' type='submit' name='cancelar' value='Cancelar'>
            </form></div>";
    }

    if (isset($_POST['excluir'])) {
        $id = $_POST['id'];
        $excluir = $pdo->prepare("DELETE FROM usuario WHERE id = ?");
        $excluir->execute([$id]);
        header("Location: usuarios.php");
        exit;
    }
    
    if (isset($_POST['editar'])) {
        $id = $_POST['id'];
        $query = $pdo->prepare("SELECT * FROM usuario WHERE id = ?");
        $query->execute([$id]);
        $usuarioEditar = $query->fetch();
    }

    if (isset($_POST['salvar'])) {
        if (!empty($_FILES['foto']['name'])) {
            $caminho = 'uploads/' . basename($_FILES['foto']['name']);
            move_uploaded_file($_FILES['foto']['tmp_name'], $caminho);
            $foto = $caminho;
        }

        $verifica = $pdo->prepare("SELECT id FROM usuario WHERE email = ?");
        $verifica->execute([$email]);

        if ($verifica->fetch()) {
            echo "<script>alert('Esse e-mail já está cadastrado!');</script>";
        } 
        else {
            $senha_hash = password_hash($senha, PASSWORD_DEFAULT);
            $uploadDir = "uploads/";
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            $fotoNome = basename($_FILES['foto']['name']);
            $caminhoFoto = $uploadDir . $fotoNome;
            move_uploaded_file($_FILES['foto']['tmp_name'], $caminhoFoto);

            $novoUsuario = $pdo->prepare("INSERT INTO usuario (nome, email, senha, nivel, foto) VALUES (?, ?, ?, ?, ?)");
            $novoUsuario->execute([$nome, $email, $senha_hash, $nivel, $caminhoFoto]);
        }

        header("Location: usuarios.php");
        exit;
    }

    if (isset($_POST['cancelar'])) {
        header("Location: usuarios.php");
        exit;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuários</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/gh/exacti/floating-labels@latest/floating-labels.min.css" media="screen">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../assets/style.css">
    <script src="../assets/script.js"></script>
    <link rel="icon" type="image/png" href="https://cdn-icons-png.flaticon.com/512/16796/16796125.png">
</head>
<body>
    <body class="usuarios-body">
    <a href="dashboard.php" class="usuarios-voltar">
        <i class="bi bi-arrow-left"></i> Voltar
    </a>

    <h1 class="usuarios-titulo">Gerenciar Usuários</h1>

    <form action="" method="post" class="usuarios-form-novo">
        <input name="novoUser" type="submit" value="Novo Usuário" class="usuarios-btn-novo">
    </form>

    <table class="usuarios-tabela">
        <tr class="usuarios-header">
            <th>ID</th>
            <th>Foto</th>
            <th>Nome</th>
            <th>E-mail</th>
            <th>Nível</th>
            <th>Ações</th>
        </tr>
        <?php
            foreach($exibirUsuarios as $user) {
                echo "<tr class='usuarios-linha'>
                        <td class='usuarios-id'>" . $user['id'] . "</td>
                        <td class='usuarios-foto'><img src='" . $user['foto'] . "' width='50'></td>
                        <td class='usuarios-nome'>" . $user['nome'] . "</td>
                        <td class='usuarios-email'>" . $user['email'] . "</td>
                        <td class='usuarios-nivel'>" . $user['nivel'] . "</td>
                        <td class='usuarios-acoes'>
                            <form method='POST' class='usuarios-form'>
                                <input type='hidden' name='id' value='" . $user['id'] . "'>
                                <input name='editar' type='submit' value='Editar' class='usuarios-btn-editar'>
                                <input name='excluir' type='submit' value='Excluir' class='usuarios-btn-excluir'>
                            </form>
                        </td>
                    </tr>";
            }
        ?>
    </table>

    <?php
        if ($usuarioEditar) {
            echo "
            <div class='usuarios-editar'>
                <h2 class='usuarios-editar-titulo'>Editar Usuário</h2>
                <form action='' method='post' enctype='multipart/form-data' class='usuarios-editar-form'>
                    <input type='hidden' name='id' value='{$usuarioEditar['id']}'>
                    
                    <label>Nome:</label>
                    <input type='text' name='nome' value='{$usuarioEditar['nome']}' required><br>
                    
                    <label>Email:</label>
                    <input type='email' name='email' value='{$usuarioEditar['email']}' required><br>
                    
                    <label>Nível:</label>
                    <input type='text' name='nivel' value='{$usuarioEditar['nivel']}'><br>
                    
                    <label>Foto:</label>
                    <input type='file' name='foto'><br>
                    
                    <div class='usuarios-editar-botoes'>
                        <input type='submit' name='salvar' value='Salvar Alterações' class='usuarios-btn-salvar'>
                        <input type='submit' name='cancelar' value='Cancelar' class='usuarios-btn-cancelar'>
                    </div>
                </form>
            </div>";
        }
    ?>
</body>
</html>