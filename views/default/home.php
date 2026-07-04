<?php require "views/default/include/header.php"; ?>
<?php require "views/default/include/navbar.php"; ?>

<main>

    <section class="hero-banner">

        <div class="hero-overlay">

            <div class="container text-center">
                <div class="row">
                    <div class="col-7"></div>
                    <div class="col-5 top d-flex flex-column justify-content-start align-items-left">
                        <h1>DESTAQUE <br>
                            DA SEMANA </h1>
                            <h4>Retro Echoes</h4>
                        <a href="?page=catalogo" class="btn btn-primary btn-lg px-5">
                            Ver Mais
                        </a>
                    </div>
                </div>
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
                        <div class="col-6 col-md-6 col-lg-4 col-xl-3 mb-4">
                            <div class="card h-100 shadow-sm">
                                <?php if (!empty($produto['imagem'])): ?>
                                    <img src="<?= htmlspecialchars($produto['imagem']) ?>" class="card-img-top"
                                        alt="<?= htmlspecialchars($produto['titulo']) ?>" style="height: 200px; object-fit: cover;">
                                <?php else: ?>
                                    <div class="bg-secondary text-white d-flex align-items-center justify-content-center"
                                        style="height: 200px;">
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

    <section class=" bg-dark py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h2>Sobre a Sinth-vinil</h2>
                    <p>A Sinth-vinil é a loja online número 1 em vinis raros, clássicos e edições limitadas.</p>
                    <p>Com mais de 1000 produtos em catálogo, oferecemos a melhor qualidade e os melhores preços do
                        mercado.</p>
                </div>
                <div class="col-md-6">
                    <h2>Por que escolher a Sinth-vinil?</h2>
                    <ul class="list-unstyled">
                        <li><i class="bi bi-check-circle text-success me-2"></i>Garantia de qualidade</li>
                        <li><i class="bi bi-check-circle text-success me-2"></i>Atendimento 24/7</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
</main>

<?php require "views/default/include/footer.php"; ?>