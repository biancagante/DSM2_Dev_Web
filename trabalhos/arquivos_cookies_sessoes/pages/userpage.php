<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página do usuário</title>
    <link rel="stylesheet" href="../assets/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
</head>

<body>
        <main style="display: flex; flex-direction: column;">
                <?php
                    session_start();
                    if (isset($_SESSION["nome"]) && isset($_SESSION["email"])) {
                        $nome = $_SESSION["nome"];
                        $email = $_SESSION["email"];

                        echo "<form action='#' method='POST'>
                                    <h1>Bem-vindo $nome!</h1>
                                    <p>$email</p>
                                    <button class='btn btn-danger' name='btn_destroy'>Terminar sessão</button>
                            </form>
                        ";

                        if ($_SERVER['REQUEST_METHOD'] === "POST") {
                            if (isset($_POST["btn_destroy"])) {
                                session_destroy();
                                header('Location: login.php');
                            }
                        }
                    } else {
                        $nome = "";
                        $email = "";
                        echo "<span>Sessão expirada</span>";
                        header('Location: login.php');
                    }
                ?>
        </main>
</body>

</html>