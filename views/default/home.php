<?php require "views/default/include/header.php"; ?>
<?php require "views/default/include/navbar.php"; ?>

<main>

<section class="hero-banner">

    <div class="hero-overlay">

        <div class="container text-center">

            <h1 class="display-3 fw-bold mb-3">
                Bem-vindo à Sinth-Vinil
            </h1>

            <p class="lead mb-4">
                Descubra discos clássicos, edições limitadas e os maiores sucessos do vinil.
            </p>

            <a href="?page=catalogo" class="btn btn-primary btn-lg px-5">

                <i class="bi bi-music-note-beamed me-2"></i>

                Explorar Catálogo

            </a>

        </div>

    </div>

</section>

    <section class="py-5">
        <div class="container">
            <h2 class="mb-4">Produtos em Destaque</h2>
            <div class="row">
                <?php
                    require_once "models/Produtos.php";
                    $produtoModel = new Produto();
                    $produtos = $produtoModel->listar();
                    $featured = array_slice($produtos, 0, 6);
                    
                    if (!empty($featured)):
                        foreach ($featured as $produto):
                ?>
                    <div class="col-md-4 col-lg-3 mb-4">
                        <div class="card h-100 shadow-sm">
                            <?php if (!empty($produto['imagem'])): ?>
                                <img src="<?= htmlspecialchars($produto['imagem']) ?>" class="card-img-top" alt="<?= htmlspecialchars($produto['titulo']) ?>" style="height: 200px; object-fit: cover;">
                            <?php else: ?>
                                <div class="bg-secondary text-white d-flex align-items-center justify-content-center" style="height: 200px;">
                                    <i class="bi bi-image" style="font-size: 2rem;"></i>
                                </div>
                            <?php endif; ?>
                            <div class="card-body">
                                <h6 class="card-title"><?= htmlspecialchars($produto['titulo']) ?></h6>
                                <p class="card-text text-muted small">
                                    <?php if (!empty($produto['artista'])): ?>
                                        <?= htmlspecialchars($produto['artista']) ?><br>
                                    <?php endif; ?>
                                    <?php if (!empty($produto['ano'])): ?>
                                        <?= htmlspecialchars($produto['ano']) ?>
                                    <?php endif; ?>
                                </p>
                            </div>
                            <div class="card-footer bg-white border-top">
                                <div class="d-flex justify-content-between align-items-center">
                                    <strong>R$ <?= number_format($produto['preco'], 2, ',', '.') ?></strong>
                                    <a href="?page=produto&id=<?= $produto['id'] ?>" class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-cart-plus"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                        endforeach;
                    else:
                ?>
                    <div class="col-md-12">
                        <p class="text-center text-muted">Nenhum produto disponível</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <section class="bg-light py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h2>Sobre a VinilStore</h2>
                    <p>A VinilStore é a loja online número 1 em vinis raros, clássicos e edições limitadas.</p>
                    <p>Com mais de 1000 produtos em catálogo, oferecemos a melhor qualidade e os melhores preços do mercado.</p>
                    <ul class="list-unstyled">
                        <li><i class="bi bi-check-circle text-success me-2"></i>Frete grátis acima de R$ 100</li>
                        <li><i class="bi bi-check-circle text-success me-2"></i>Garantia de qualidade</li>
                        <li><i class="bi bi-check-circle text-success me-2"></i>Atendimento 24/7</li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <img src="https://via.placeholder.com/400x300?text=VinilStore" alt="VinilStore" class="img-fluid rounded">
                </div>
            </div>
        </div>
    </section>
</main>

<?php require "views/default/include/footer.php"; ?>