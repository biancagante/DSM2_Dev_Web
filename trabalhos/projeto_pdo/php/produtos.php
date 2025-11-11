<?php
require "config.php";

$query = $pdo->query("SELECT * FROM produto");
$produtos = $query->fetchAll();
$produtoEditar = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') { 
    $id = $_POST['id'] ?? null;
    $nome = $_POST['nome'] ?? null;
    $descricao = $_POST['descricao'] ?? null;
    $preco = $_POST['preco'] ?? null;
    $foto = $_POST['foto'] ?? null;
    
    if (isset($_POST['editar'])) {
        $query = $pdo->prepare("SELECT * FROM produto WHERE id = ?");
        $query->execute([$id]);
        $produtoEditar = $query->fetch();
    }

    if (isset($_POST['novoProd'])) {
        echo "<div class='py-5 form-editar'><h2>Novo Produto</h2>
        <form class='mx-auto' action='' method='post' enctype='multipart/form-data'>
            <label>Nome:</label>
            <input class='form-control' type='text' name='nome' value=''><br>
            <label>Descrição:</label>
            <textarea name='descricao' rows='4' class='form-control' placeholder='Adicione uma descrição sobre o produto...'></textarea>
            <label class='form-label'>Preço</label>
            <input class='form-control' type='number' name='preco' min='0.00' step='0.01' placeholder='0.00' value='00.00'><br>
            <label>Foto:</label>
            <input class='form-control' type='file' name='foto'><br>
            <input class='btn btn-success' type='submit' name='salvar' value='Salvar'>
            <input class='btn btn-secondary' type='submit' name='cancelar' value='Cancelar'>
        </form></div>";
    }

    if (isset($_POST['excluir'])) {
        $excluir = $pdo->prepare("DELETE FROM produto WHERE id = ?");
        $excluir->execute([$id]);
        header("Location: produtos.php");
        exit;
    }

    if (isset($_POST['editarProduto'])) {
        if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
            $extensao = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
            $nome_arquivo = uniqid('produto_', true) . '.' . $extensao;
            $caminho_foto = '../assets/img/produtos/' . $nome_arquivo;
            move_uploaded_file($_FILES['foto']['tmp_name'], $caminho_foto);
            $foto = $caminho_foto;
        } else {
            $foto = $_POST['foto_atual'] ?? null;
        }

        $update = $pdo->prepare("UPDATE produto SET nome = ?, descricao = ?, preco = ?, foto = ? WHERE id = ?");
        $update->execute([$nome, $descricao, $preco, $foto, $id]);
        header("Location: produtos.php");
        exit;
    }

    if (isset($_POST['salvar'])) {
        if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
            $extensao = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
            $nome_arquivo = uniqid('produto_', true) . '.' . $extensao;
            $caminho_foto = '../assets/img/produtos/' . $nome_arquivo;
            move_uploaded_file($_FILES['foto']['tmp_name'], $caminho_foto);
            $foto = $caminho_foto;
        }

        $novoProduto = $pdo->prepare("INSERT INTO produto (nome, descricao, preco, foto) VALUES (?, ?, ?, ?)");
        $novoProduto->execute([$nome, $descricao, $preco, $foto]);
        header("Location: produtos.php");
        exit;
    }

    if (isset($_POST['cancelar'])) {
        header("Location: produtos.php");
        exit;
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos</title>
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
    <h3 class="contatos-titulo">Produtos</h3>
    <form action="" method="post" class="usuarios-form-novo">
        <input name="novoProd" type="submit" value="Novo Produto" class="usuarios-btn-novo">
    </form>
    <table class="produtos-tabela">
        <tr class="produtos-header">
            <th>ID</th>
            <th>Foto</th>
            <th>Nome</th>
            <th>Descrição</th>
            <th>Preço</th>
            <th>Ações</th>
        </tr>
        <?php
        foreach ($produtos as $p) {
            echo "<tr class='produto-linha'>
                    <td class='produto-id'>" . $p['id'] . "</td>
                    <td class='produto-foto'><img src='" . $p['foto'] . "' width='50'></td>
                    <td class='produto-nome'>" . $p['nome'] . "</td>
                    <td class='produto-email'>" . $p['descricao'] . "</td>
                    <td class='produto-nivel'>" . number_format($p['preco'], 2, ',', '.') . "</td>
                    <td class='produto-acoes'>
                        <form method='POST' class='produto-form'>
                            <input type='hidden' name='id' value='" . $p['id'] . "'>
                            <input name='editar' type='submit' value='Editar' class='produto-btn-editar'>
                            <input name='excluir' type='submit' value='Excluir' class='produto-btn-excluir'>
                        </form>
                    </td>
                </tr>";
        }
        ?>
    </table>
    <?php
    if ($produtoEditar) {
        echo "
        <div class='usuarios-editar'>
            <h2 class='usuarios-editar-titulo'>Editar Produto</h2>
            <form action='' method='post' enctype='multipart/form-data' class='usuarios-editar-form'>
                <img src='{$produtoEditar['foto']}' width='300px'>
                <input type='hidden' name='id' value='{$produtoEditar['id']}'>
                <input type='hidden' name='foto_atual' value='{$produtoEditar['foto']}'>
                <label>Nome:</label>
                <input type='text' name='nome' value='{$produtoEditar['nome']}'><br>
                <label>Descrição:</label>
                <textarea name='descricao' rows='4' class='form-control' placeholder='Adicione uma descrição sobre o produto...'>{$produtoEditar['descricao']}</textarea>
                <label class='form-label'>Preço</label>
                <input class='form-control' type='number' name='preco' min='0.00' step='0.01' placeholder='0.00' value='{$produtoEditar['preco']}'><br>
                <label>Foto:</label>
                <input type='file' name='foto'><br>
                <div class='usuarios-editar-botoes'>
                    <input type='submit' name='editarProduto' value='Salvar Alterações' class='usuarios-btn-salvar'>
                    <input type='submit' name='cancelar' value='Cancelar' class='usuarios-btn-cancelar'>
                </div>
            </form>
        </div>";
    }
    ?>
</body>
</html>
