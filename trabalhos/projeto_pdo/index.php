<?php
require_once "php/config.php";

session_start();
$usuario = null;

if (!isset($_COOKIE['visitante'])) {
    setcookie('visitante', '1', time() + (30 * 24 * 60 * 60), '/');
}

if (isset($_SESSION['usuario_id'])) {
    $query = $pdo->prepare('SELECT * FROM usuario WHERE id = ?');
    $query->execute([$_SESSION['usuario_id']]);
    $usuario = $query->fetch();

    if (!$usuario) {
        session_destroy();
        $usuario = null;
    }
} 
else {
    if (isset($_COOKIE['visitante'])) {
        echo "Sessão expirada";
    }
}

$s_query = $pdo->query("SELECT foto, titulo, descricao, id FROM servico");
$servico = $s_query->fetchAll();

$p_query = $pdo->query("SELECT foto, nome, descricao, preco FROM produto");
$produto = $p_query->fetchAll();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = trim($_POST['nome'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $mensagem = trim($_POST['mensagem'] ?? '');

    if ($nome && $email && $mensagem) {
        $contato = $pdo->prepare("INSERT INTO contato (nome, email, mensagem) VALUES (?, ?, ?)");
        $contato->execute([$nome, $email, $mensagem]);
        $mensagem_enviada = true;
    } else {
        $erro = "Preencha todos os campos antes de enviar.";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Latte&Mia - Cat Café</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="assets/style.css">
    <link rel="icon" type="image/png" href="https://cdn-icons-png.flaticon.com/512/16796/16796125.png">
</head>
<body>
    <header class="latte-header">
        <div class="latte-container">
            <a class="latte-logo" href="#"><img src="https://cdn-icons-png.flaticon.com/512/16796/16796125.png" alt=""
                    width="24px"><span>Latte&Mia</span></a>
            <nav class="latte-nav">
                <ul class="latte-nav-links">
                    <li><a href="#home">Home</a></li>
                    <li><a href="#servicos">Serviços</a></li>
                    <li><a href="#cardapio">Cardápio</a></li>
                    <li><a href="#sobreNos">Sobre</a></li>
                    <li><a href="#gatinhos">Gatinhos</a></li>
                    <li><a href="#contato">Contato</a></li>
                </ul>
            </nav>
            <div class="latte-actions">
                <?php
                    if (isset($_SESSION['usuario_id'])) {
                        echo "<span class='latte-user'>" . $usuario['email'] . "</span>";
                        if ($usuario['nivel'] === 'admin') {
                            echo "<a href='php/dashboard.php'>Dashboard</a>";
                        }
                        echo "<img width='40px' class='rounded-circle latte-user-img' src='" . $usuario['foto'] . "'>";
                        echo "<a href='php/logout.php'>Sair</a>";
                    } 
                    else {
                        echo "<a href='php/signup.php' class='latte-btn-signup'>Cadastro</a>";
                        echo "<a href='php/login.php' class='latte-btn-login'>Login</a>";
                    }
                ?>
                <button class="latte-menu-toggle" id="latte-menu-toggle"><i class="fas fa-bars"></i></button>
            </div>
        </div>
    </header>
    <main>
        <section class="hero-latte d-flex align-items-center" id="home">
            <div class="container text-center">
                <h1 class="display-4 fw-bold">Bem-vindo ao Latte&Mia</h1>
                <p class="lead mb-4">O primeiro Cat Café encantador para amantes de gatos e café ❤🐾</p>
                <div class="hero-buttons-wrapper">
                    <p class="hero-text">O lugar mais aconhegante que você vai encontrar!</p>
                    <a href="#cardapio" class="btn hero-btn mt-4 px-4 py-2">Ver Cardápio ☕🐱</a>
                </div>
            </div>
            <div class="coffee-img">
                <img src="https://thebeancoffeecompany.com/cdn/shop/files/Coffee_Bean_2.png?v=1730998929" alt="">
            </div>
            <div class="cat-img">
                <img src="https://png.pngtree.com/png-vector/20241012/ourmid/pngtree-cat-peeking-from-frame-png-image_14067902.png"
                    alt="">
            </div>
        </section>
        <section id="servicos" class="py-5 bg-cream">
            <div class="container">
                <h2 class="fw-bold text-center mb-4" style="color:#4E372E;">Nossos Serviços</h2>
                <p class="text-center mb-5" style="max-width:700px;margin:auto;color:#6b4b3a;">
                    Uma experiência acolhedora pensada para quem ama café, tranquilidade e gatinhos 🐾☕
                </p>
                <div class="row g-4">
                    <?php 
                        foreach($servico as $s) {
                            echo "<div class='col-md-6'>
                                    <div class='service-card p-4 d-flex align-items-center gap-3'>
                                        <div class='service-img'>
                                            <img src='" . $s['foto'] . "' class='s-img'>
                                        </div>
                                        <div>
                                            <h5 class='fw-bold mb-1'>" . $s['titulo'] . "</h5>
                                            <p class='mb-0'>" . $s['descricao'] . "</p>
                                            <div class='d-flex justify-content-end'>
                                                <a href='php/avaliar.php?id={$s['id']}'>
                                                <input type='submit' value='Saiba Mais'>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            ";
                        }
                    ?>
                </div>
            </div>
        </section>
        <section id="cardapio" class="py-5">
            <div class="container">
                <h2 class="text-center mb-5 fw-bold" style="color: #4E372E">Cardápio</h2>
                <div class="product-grid">
                    <?php
                    foreach ($produto as $p) {
                        echo "
                        <div class='product-card'>
                            <img src='" . $p['foto'] . "' class='s-img' alt='" . $p['nome'] . "'>
                            <div class='info'>
                                <h5 class='fw-bold mb-1'>" . $p['nome'] . "</h5>
                                <p class='mb-0'>" . $p['descricao'] . "</p>
                                <p class='fw-bold mb-0'>R$ " . number_format($p['preco'], 2, ',', '.') . "</p>
                                <div class='buy-box'>
                                    <a href='php/checkout.php'>
                                        <input type='submit' value='Adicionar ao Carrinho'>
                                    </a>
                                </div>
                            </div>
                        </div>
                        ";
                    }
                    ?>

                </div>
            </div>
        </section>
        <section class="py-5 bg-light" id="sobreNos">
            <div class="container text-center">
                <h2 class="section-title fw-bold" style="color:#4E372E;">Quem nós somos</h2>
                <p class="mb-5" style="max-width:700px;margin:auto;color:#6b4b3a;">
                    Somos apaixonados por gatos, café e bons momentos. Um espaço feito para relaxar,
                    aproveitar bebidas artesanais e conviver com felinos resgatados em um ambiente
                    aconchegante e cheio de amor 🐾☕
                </p>
                <div class="row g-4 justify-content-center">
                    <div class="col-md-4">
                        <div class="reason-box p-4 h-100 rounded shadow-sm">
                            <i class="bi bi-heart-fill reason-icon"></i>
                            <h4 class="fw-bold" style="color:#4E372E;">Carinho & Felinos</h4>
                            <p class="mb-0" style="color:#6b4b3a;">
                                Convívio com gatinhos resgatados e socialização — amor em forma de ronronar.
                            </p>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="reason-box p-4 h-100 rounded shadow-sm">
                            <i class="bi bi-book-half reason-icon"></i>
                            <h4 class="fw-bold" style="color:#4E372E;">Espaço de Leitura</h4>
                            <p class="mb-0" style="color:#6b4b3a;">
                                Sofás, estantes e áreas calmas para ler, estudar e relaxar com companhia felina.
                            </p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="reason-box p-4 h-100 rounded shadow-sm">
                            <i class="bi bi-cup-hot-fill reason-icon"></i>
                            <h4 class="fw-bold" style="color:#4E372E;">Café Artesanal</h4>
                            <p class="mb-0" style="color:#6b4b3a;">
                                Cafés e doces exclusivos preparados com carinho e ingredientes selecionados.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="cat-carousel mt-5" id="gatinhos">
                    <h3 class="fw-bold mb-3" style="color:#4E372E;">Gatinhos Residentes 🐾</h3>
                    <div id="catsCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="1000">
                        <div class="carousel-inner">

                            <div class="carousel-item active text-center">
                                <img src="https://www.gatildosresgatados.com/_next/image?url=%2Fapi%2Fmedia%2Ffile%2Fgato1.png&w=750&q=75"
                                    class="rounded-circle resident-img mb-2">
                                <h5>Mia</h5>
                            </div>

                            <div class="carousel-item text-center">
                                <img src="https://www.gatildosresgatados.com/_next/image?url=%2Fapi%2Fmedia%2Ffile%2FIMG_8579.jpeg&w=640&q=75"
                                    class="rounded-circle resident-img mb-2">
                                <h5>Latte</h5>
                            </div>

                            <div class="carousel-item text-center">
                                <img src="https://www.gatildosresgatados.com/_next/image?url=%2Fapi%2Fmedia%2Ffile%2FIMG_3808.jpeg&w=640&q=75"
                                    class="rounded-circle resident-img mb-2">
                                <h5>Choco</h5>
                            </div>

                            <div class="carousel-item text-center">
                                <img src="https://www.gatildosresgatados.com/_next/image?url=%2Fapi%2Fmedia%2Ffile%2FIMG_8655.jpeg&w=640&q=75"
                                    class="rounded-circle resident-img mb-2">
                                <h5>Cookie</h5>
                            </div>

                        </div>
                    </div>
                </div>
        </section>
        <section class="py-5" id="contato">
            <div class="container">
                <h2 class="section-title text-center">Entre em Contato</h2>
                <form action="#" method="POST" class="mx-auto" style="max-width: 600px;">
                    <div class="mb-3">
                        <label class="form-label">Seu nome</label>
                        <input name="nome" type="text" class="form-control" placeholder="Digite seu nome">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Seu e-mail</label>
                        <input name="email" type="email" class="form-control" placeholder="Digite seu e-mail">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Mensagem</label>
                        <textarea name="mensagem" rows="4" class="form-control" placeholder="Digite sua mensagem"></textarea>
                    </div>
                    <input type="submit" value="Enviar" class="btn btn-dark w-100">
                </form>
            </div>
        </section>
    </main>
    <footer class="footer bg-dark text-light pt-5 pb-3 mt-5">
        <div class="container">
            <div class="row gy-4">
                <div class="col-md-4">
                    <h4 class="fw-bold mb-3">Latte&Mia</h4>
                    <p style="max-width: 260px;">
                        O primeiro Cat Café encantador onde café, livros e ronronadas se encontram 🐾☕
                    </p>
                    <div class="social-links mt-3">
                        <a href="#" class="social-icon"><i class="bi bi-instagram"></i></a>
                        <a href="#" class="social-icon"><i class="bi bi-tiktok"></i></a>
                        <a href="#" class="social-icon"><i class="bi bi-whatsapp"></i></a>
                    </div>
                </div>
                <div class="col-md-2">
                    <h6 class="fw-bold mb-3">Menu</h6>
                    <ul class="footer-links">
                        <li><a href="#home">Início</a></li>
                        <li><a href="#cardapio">Cardápio</a></li>
                        <li><a href="#sobreNos">Sobre</a></li>
                        <li><a href="#contato">Contato</a></li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h6 class="fw-bold mb-3">Serviços</h6>
                    <ul class="footer-links">
                        <li><a href="#">Café Artesanal</a></li>
                        <li><a href="#">Espaço de Leitura</a></li>
                        <li><a href="#">Interação com Gatinhos</a></li>
                        <li><a href="#">Eventos Temáticos</a></li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h6 class="fw-bold mb-3">Contato</h6>
                    <p class="small mb-1"><i class="bi bi-geo-alt-fill me-2"></i>Praia Grande, SP</p>
                    <p class="small mb-1"><i class="bi bi-telephone-fill me-2"></i>(13) 99999-9999</p>
                    <p class="small mb-1"><i class="bi bi-envelope-fill me-2"></i>contato@lattemia.com</p>
                </div>
            </div>
            <hr class="border-light my-4">
            <div class="text-center small">
                Latte&Mia © 2025 | Feito com amor e patinhas 🐾
            </div>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>