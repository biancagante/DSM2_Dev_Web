<?php
    require "config.php";
    
    session_start();
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

        if (!empty($nome) && isset($email) && isset($senha)) {
            $query = $pdo->prepare("INSERT INTO usuario (nome, email, senha) VALUES (?, ?, ?);");
            $query->execute([$nome, $email, $senha_hash]);

            header("Location: login.php");
            exit;
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/gh/exacti/floating-labels@latest/floating-labels.min.css" media="screen">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../assets/style.css">
    <script src="../assets/script.js"></script>
</head>
<body class="bg-light d-flex justify-content-center align-items-center min-vh-100">
    <a href="../index.php">Voltar</a>
    <div class="card p-4">
        <div class="card-body">
            <h4 class="card-title text-center mb-4">Cadastro</h4>
            <form action="#" method="post">
                <div class="form-label-group outline">
                    <input type="text" name="nome" class="form-control" placeholder="." />
                    <span><label for="nome">Nome</label></span>
                </div>
                <div class="form-label-group outline">
                    <input type="email" name="email" class="form-control" placeholder="." />
                    <span><label for="name">E-mail</label></span>
                </div>
                <div class="form-label-group outline position-relative">
                    <input type="password" name="senha" class="form-control" placeholder="." />
                    <span><label for="senha">Senha</label></span>
                    <i class="bi bi-eye-slash position-absolute" onclick="mostrarSenha()" id="icon_eye"></i>
                </div>
                <div class="d-grid">
                    <input type="submit" value="Criar conta" class="btn btn-primary">
                </div>
            </form>
            <a href="login.php" class="d-flex row justify-content-center p-3">Efetue Login</a>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>