<?php
    require "config.php";

    $exibirContatos = $pdo->query("SELECT * FROM contato");
    // $exibirContatos->execute();
    $exibirContatos = $exibirContatos->fetchAll();

    $contagemMensagens = $pdo->prepare("SELECT COUNT(id) FROM contato");
    $contagemMensagens->execute();
    $contagemMensagens = (int)$contagemMensagens->fetchColumn();

    if (isset($_POST['excluir'])) {
        $id = $_POST['id'];
        $excluir = $pdo->prepare("DELETE FROM contato WHERE id = ?");
        $excluir->execute([$id]);
        header("Location: contatos.php");
        exit;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contatos</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/gh/exacti/floating-labels@latest/floating-labels.min.css" media="screen">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../assets/style.css">
    <script src="../assets/script.js"></script>
    <link rel="icon" type="image/png" href="https://cdn-icons-png.flaticon.com/512/16796/16796125.png">
</head>
<body class="contatos-body">
    <a href="dashboard.php" class="contatos-voltar">
        <i class="bi bi-arrow-left"></i> Voltar
    </a>
    <h1 class="contatos-titulo">Mensagens Recebidas</h1>
    <table class="contatos-tabela">
        <tr class="contatos-header">
            <th>ID</th>
            <th>Nome</th>
            <th>E-mail</th>
            <th>Mensagem</th>
            <th>Ações</th>
        </tr>
        <?php
            if ($contagemMensagens > 0) {
                foreach($exibirContatos as $c) {
                    echo "<tr class='contatos-linha'>
                            <td class='contatos-id'>" . $c['id'] . "</td>
                            <td class='contatos-nome'>" . $c['nome'] . "</td>
                            <td class='contatos-email'>" . $c['email'] . "</td>
                            <td class='contatos-msg'>" . $c['mensagem'] . "</td>
                            <td class='contatos-acoes'>
                                <form method='POST' class='contatos-form'>
                                    <input type='hidden' name='id' value='" . $c['id'] . "'>
                                    <input name='excluir' type='submit' value='Excluir' class='contatos-btn-excluir'>
                                </form>
                            </td>
                        </tr>";
                }
            } else {
                echo "<tr><td colspan='5' class='contatos-sem-msg'>Sem mensagens.</td></tr>";
            }
        ?>
    </table>
</body>
</html>