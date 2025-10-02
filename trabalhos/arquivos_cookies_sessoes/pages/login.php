<?php
    if (isset($_COOKIE["email"])) {
        $email = $_COOKIE["email"];
    }

    if ($_SERVER['REQUEST_METHOD']==="POST") {
        if (isset($_POST["nome"]) && !empty($_POST["nome"])) {
            $nome = $_POST["nome"];
            echo $nome;
        }
        else {
            echo "Algum campo não foi preenchido.";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Entre</title>
    <link rel="stylesheet" href="../style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</head>
<body>
    <main>
        <form action="#" method="POST" class="mb-3">
            <label for="nome" class="form-label">Nome:    
                <input type="text" name="nome" placeholder="..." class="form-control">
            </label>
            <label for="email" class="form-label">E-mail:
                <input type="email" name="email" placeholder="..." class="form-control" value="<?php echo $email;?>">
            </label>
            <label for="psw" class="form-label">Senha:
                <input type="password" name="psw" placeholder="..." class="form-control" require>
            </label>
            <button type="submit" class="btn btn-dark">Salvar</button>
        </form>
    </main>
</body>
</html>