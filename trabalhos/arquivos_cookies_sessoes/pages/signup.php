<?php
    if ($_SERVER['REQUEST_METHOD']==='POST') {
        if (isset($_POST['email']) && !empty($_POST['email'])) {
            $nome = $_POST["nome"];
            $email = $_POST["email"];
            $senha = $_POST["psw"];

            cadastrarUser($nome, $email, $senha);
            verificarCredenciais($nome, $email, $senha);

            setcookie("email", $email, time() + 3600);
            header('Location: login.php');
        }
    }
    /*
    $contador = 0;
    do {
        $dados_cadastrais = fopen("dados.txt", "a");
        fwrite($dados_cadastrais, "Username | E-mail | Password");
        $contador++;
        } while ($contador < 1);
        */
    $dados_cadastrais = fopen("dados.txt", "w");
    function cadastrarUser($nome, $email, $senha) {
        $dados_cadastrais = fopen("dados.txt", "a");
        fwrite($dados_cadastrais, ($nome . " | " . $email . " | " . $senha . "\n"));
        fclose($dados_cadastrais);
    }
    
    function verificarCredenciais($nome, $email, $senha) {
        $dados_cadastrais = fopen("dados.txt", "r");
        fread($dados_cadastrais, filesize("dados.txt"));
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastre-se</title>
    <link rel="stylesheet" href="../style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</head>
<body>
    <main>
        <form action="#" method="POST" class="mb-3">
            <label for="nome" class="form-label">Nome de usuário:    
                <input type="text" name="nome" placeholder="..." class="form-control">
            </label>
            <label for="email" class="form-label">E-mail:
                <input type="email" name="email" placeholder="..." class="form-control" require>
            </label>
            <label for="psw" class="form-label">Senha:
                <input type="password" name="psw" placeholder="..." class="form-control" require>
            </label>
            <button type="submit" class="btn btn-dark">Salvar</button>
        </form>
    </main>
</body>
</html>