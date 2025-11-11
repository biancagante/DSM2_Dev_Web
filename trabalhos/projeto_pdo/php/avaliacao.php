<?php
    require "config.php";

    $exibirAvaliacoes = $pdo->query("SELECT * FROM avaliacao");
    $exibirAvaliacoes = $exibirAvaliacoes->fetchAll();

    $contagemAvaliacoes = $pdo->prepare("SELECT COUNT(id) FROM avaliacao");
    $contagemAvaliacoes->execute();
    $contagemAvaliacoes = (int)$contagemAvaliacoes->fetchColumn();

    if (isset($_POST['excluir'])) {
        $id = $_POST['id'];
        $excluir = $pdo->prepare("DELETE FROM avaliacao WHERE id = ?");
        $excluir->execute([$id]);
        header("Location: avaliacao.php");
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
    <h1 class="contatos-titulo">Avaliações Recebidas</h1>
    <table class="contatos-tabela">
        <tr class="contatos-header">
            <th>ID</th>
            <th>Nome</th>
            <th>E-mail</th>
            <th>Mensagem</th>
            <th>ID Serviço</th>
            <th>Ações</th>
        </tr>
        <?php
            if ($contagemAvaliacoes > 0) {
                foreach($exibirAvaliacoes as $a) {
                    echo "<tr class='contatos-linha'>
                            <td class='contatos-id'>" . $a['id'] . "</td>
                            <td class='contatos-nome'>" . $a['nome'] . "</td>
                            <td class='contatos-email'>" . $a['estrelas'] . "</td>
                            <td class='contatos-msg'>" . $a['comentario'] . "</td>
                            <td class='contatos-msg'>" . $a['id_servico'] . "</td>
                            <td class='contatos-acoes'>
                                <form method='POST' class='contatos-form'>
                                    <input type='hidden' name='id' value='" . $a['id'] . "'>
                                    <input name='excluir' type='submit' value='Excluir' class='contatos-btn-excluir'>
                                </form>
                            </td>
                        </tr>";
                }
            } else {
                echo "<tr><td colspan='5' class='contatos-sem-msg'>Sem avaliações.</td></tr>";
            }
        ?>
    </table>
</body>
</html>