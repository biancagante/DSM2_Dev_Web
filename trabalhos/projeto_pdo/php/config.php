<?php
    $host = 'localhost';
    $banco = 'sistema';
    $usuario = 'root';
    $senha = '';

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$banco", $usuario, $senha);

        $query = $pdo->prepare("SELECT COUNT(id) FROM usuario WHERE email = 'administrador@admin.com'");
        $query->execute();
        $existeAdm = (int)$query->fetchColumn();

        $senha_adm_hash = password_hash("123", PASSWORD_DEFAULT);

        if ($existeAdm === 0) {
            $addAdm = $pdo->prepare("INSERT INTO usuario(nome, email, senha, nivel) VALUES (?, ?, ?, ?)");
            $addAdm = $addAdm->execute(['ADMIN', 'administrador@admin.com', $senha_adm_hash, 'admin']);
        }
    } catch (PDOException $e) {
        die("Erro na conexão com o banco: " . $e->getMessage());
    }
?>