<?php
require('../assets/funcoes.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['email']) && !empty($_POST['email'])) {
        $nome = $_POST["nome"];
        $email = $_POST["email"];
        $senha = $_POST["psw"];

        cadastrarUser($nome, $email, $senha);

        setcookie("email", $email, time() + 3600);
        header('Location: login.php');
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastre-se</title>
    <link rel="shortcut icon" href="https://img.icons8.com/?size=100&id=121409&format=png&color=000000" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../assets/style.css">
    <script src="../assets/script.js"></script>
</head>

<body>
    <main>
        <form action="#" method="POST" class="mb-3">
            <div class="mb-3">
                <label for="nome" class="form-label">Nome:
                    <input type="text" name="nome" placeholder="..." class="form-control">
                </label>
                <label for="email" class="form-label">E-mail:
                    <input type="email" name="email" placeholder="..." class="form-control" require>
                </label>
                <label for="psw" class="form-label">Senha:
                    <div class="form-control">
                        <input type="password" name="psw" id="campoSenha" placeholder="..." require>
                        <i class="bi bi-eye-slash" onclick="alterarVisibilidadeSenha()" id="olho"></i>
                    </div>
                </label>
                <button type="submit" class="btn btn-dark">Salvar</button>
            </div>
            <a href="login.php">Entre na sua conta</a>
        </form>
    </main>
</body>

</html>