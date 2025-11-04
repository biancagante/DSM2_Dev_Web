<?php
require "php/config.php";

session_start();

if (isset($_SESSION['usuario_id'])) {
    $query = $pdo->prepare('SELECT foto, email FROM usuario WHERE id = ?');
    $query->execute([$_SESSION['usuario_id']]);
    $usuario = $query->fetch();
}

else {
    echo "Sessão expirada";
}

$s_query = $pdo->query('SELECT foto, titulo, descricao FROM servico');
$servico = $s_query->fetchAll(); 
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

                        if (!empty($usuario['foto'])) {
                            echo "<img width='40px' class='rounded-circle latte-user-img' src='" . $usuario['foto'] . "'>";
                        } else {
                            echo "<img width='40px' class='rounded-circle latte-user-img' src='https://upload.wikimedia.org/wikipedia/commons/thumb/2/2c/Default_pfp.svg/2048px-Default_pfp.svg.png'>";
                        }

                        echo "<a href='php/logout.php'>Sair</a>";
                    } else {
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
                                                <a href='php/review.php'>
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
                <div class="bento-grid">
                    <div class="bento-item big">
                        <img src="https://media.istockphoto.com/id/1134371245/pt/foto/cute-cat-face-latte-art-coffee-in-white-cup-on-wooden-table-love-coffee-cute-neko-latte-art.jpg?s=170667a&w=0&k=20&c=fN9w05B3kiy1TxfkSAigt41vr3w5lUwJkdzi-HOIaBo="
                            alt="">
                        <div class="info">
                            <h4>Latte Mia</h4>
                            <span>R$ 18,00</span>
                            <div class="buy-box">
                                <i class="bi bi-bag"></i>
                                <span class="buy-text">Comprar</span>
                            </div>
                        </div>
                    </div>
                    <div class="bento-item tall">
                        <img src="https://images.ctfassets.net/qfxflpv0atz9/4UVsJWUnEMghn0VrlE4Ml5/5410bd2cfb4d6d1d5dd1841451da6f97/cappuccino-em-casa-destaque.jpg"
                            alt="">
                        <div class="info">
                            <h4>Cappuccino Rose</h4>
                            <span>R$ 22,00</span>
                            <div class="buy-box">
                                <i class="bi bi-bag"></i>
                                <span class="buy-text">Comprar</span>
                            </div>
                        </div>
                    </div>
                    <div class="bento-item">
                        <img src="https://i.pinimg.com/564x/e7/25/9d/e7259d762e48c9b9f1dc30564581db05.jpg" alt="">
                        <div class="info">
                            <h4>Cookie Gatinho</h4>
                            <span>R$ 9,00</span>
                            <div class="buy-box">
                                <i class="bi bi-bag"></i>
                                <span class="buy-text">Comprar</span>
                            </div>
                        </div>
                    </div>
                    <div class="bento-item wide">
                        <img src="https://assets.unileversolutions.com/recipes-v2/237868.jpg" alt="">
                        <div class="info">
                            <h4>Mocha Felino</h4>
                            <span>R$ 20,00</span>
                            <div class="buy-box">
                                <i class="bi bi-bag"></i>
                                <span class="buy-text">Comprar</span>
                            </div>
                        </div>
                    </div>
                    <div class="bento-item">
                        <img src="https://recipesblob.oetker.com.br/assets/677216088b6540a0b110ca1d74479af6/1272x764/brownie-com-sorvete.webp"
                            alt="">
                        <div class="info">
                            <h4>Brownie Mia</h4>
                            <span>R$ 12,00</span>
                            <div class="buy-box">
                                <i class="bi bi-bag"></i>
                                <span class="buy-text">Comprar</span>
                            </div>
                        </div>
                    </div>
                    <div class="bento-item big">
                        <img src="https://blog.finamac.com/wp-content/uploads/2019/10/309956-como-oferecer-os-melhores-sabores-de-milkshake-para-os-clientes.jpg"
                            alt="">
                        <div class="info">
                            <h4>Frapê Caramel Cat</h4>
                            <span>R$ 26,00</span>
                            <div class="buy-box">
                                <i class="bi bi-bag"></i>
                                <span class="buy-text">Comprar</span>
                            </div>
                        </div>
                    </div>
                    <div class="bento-item">
                        <img src="https://docesemimosgourmet.com.br/wp-content/uploads/2019/09/IMG_7949_Easy-Resize.com_.jpg"
                            alt="">
                        <div class="info">
                            <h4>Mini Tartlette</h4>
                            <span>R$ 7,00</span>
                            <div class="buy-box">
                                <i class="bi bi-bag"></i>
                                <span class="buy-text">Comprar</span>
                            </div>
                        </div>
                    </div>
                    <div class="bento-item tall">
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSAq83mKxX81nHDhMixnJMKwLSQ729W63lPOQ&s"
                            alt="">
                        <div class="info">
                            <h4>Espresso Mia</h4>
                            <span>R$ 10,00</span>
                            <div class="buy-box">
                                <i class="bi bi-bag"></i>
                                <span class="buy-text">Comprar</span>
                            </div>
                        </div>
                    </div>
                    <div class="bento-item">
                        <img src="https://images.unsplash.com/photo-1563805042-7684c019e1cb?auto=format&w=900&q=80">
                        <div class="info">
                            <h4>Cheesecake Berry Paws</h4>
                            <span>R$ 16,00</span>
                            <div class="buy-box">
                                <i class="bi bi-bag"></i>
                                <span class="buy-text">Comprar</span>
                            </div>
                        </div>
                    </div>
                    <div class="bento-item wide">
                        <img src="https://static01.nyt.com/images/2021/08/15/magazine/affogato/affogato-threeByTwoLargeAt2X-v2.jpg"
                            alt="">
                        <div class="info">
                            <h4>Affogato Mia</h4>
                            <span>R$ 22,00</span>
                            <div class="buy-box">
                                <i class="bi bi-bag"></i>
                                <span class="buy-text">Comprar</span>
                            </div>
                        </div>
                    </div>
                    <div class="bento-item">
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRvMXFTHAi9EQEulLKSDGKabwisF8FMF6FzJg&s"
                            alt="">
                        <div class="info">
                            <h4>Mousse Duo Gatinho</h4>
                            <span>R$ 11,00</span>
                            <div class="buy-box">
                                <i class="bi bi-bag"></i>
                                <span class="buy-text">Comprar</span>
                            </div>
                        </div>
                    </div>
                    <div class="bento-item">
                        <img src="https://cdn.shopify.com/s/files/1/1456/8506/files/shutterstock_717825796_600x600.jpg?v=1717872256"
                            alt="">
                        <div class="info">
                            <h4>Matcha Mia</h4>
                            <span>R$ 19,00</span>
                            <div class="buy-box">
                                <i class="bi bi-bag"></i>
                                <span class="buy-text">Comprar</span>
                            </div>
                        </div>
                    </div>
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
                <form class="mx-auto" style="max-width: 600px;">
                    <div class="mb-3">
                        <label class="form-label">Seu nome</label>
                        <input type="text" class="form-control" placeholder="Digite seu nome">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Seu e-mail</label>
                        <input type="email" class="form-control" placeholder="Digite seu e-mail">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Mensagem</label>
                        <textarea rows="4" class="form-control" placeholder="Digite sua mensagem"></textarea>
                    </div>
                    <button class="btn btn-dark w-100">Enviar</button>
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