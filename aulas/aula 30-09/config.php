<?php
    // precisa colocar no começo do código
    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        $cor = $_POST["tema"];
        setcookie("background", $cor, time() + (60 * 60));
        // 30 dias = time() + (60 * 60 * 24 * 30)
        header('Location: index.php');
    }
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cookies e Sessões</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <main class="container">
        <h2>Configurações</h2>

        <form method="POST" action="#">
            <label>Escolha um Tema:</label>
            <select name="tema">
                <option value="gainsboro">Escolha um tema:</option>
                <option value="white">Branco</option>
                <option value="lightgrey">Cinza</option>
                <option value="black">Preto</option>
            </select>

            <input type="submit" value="Salvar"  class="botao">
        </form>

    </main>

</body>
</html>
