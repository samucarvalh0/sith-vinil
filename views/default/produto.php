<?php require "views/default/include/header.php"; ?>

<?php require "views/default/include/navbar.php"; ?>

<main class="py-5">
    <div class="container">
        <?php if (empty($produto)): ?>
            <div class="alert alert-danger">
                <i class="bi bi-exclamation-triangle me-2"></i>
                Produto não encontrado!
            </div>
            <a href="?page=catalogo" class="btn btn-primary">
                <i class="bi bi-arrow-left me-2"></i>Voltar ao Catálogo
            </a>
        <?php else: ?>
            <div class="row bg-dark p-4 rounded shadow-sm">
                <div class="col-md-6 mb-4">
                    <?php if (!empty($produto['imagem'])): ?>
                        <img src="<?= htmlspecialchars($produto['imagem']) ?>" class="img-fluid rounded"
                            alt="<?= htmlspecialchars($produto['titulo']) ?>" style="max-height: 500px; object-fit: contain;">
                    <?php else: ?>
                        <div class="bg-secondary text-white d-flex align-items-center justify-content-center rounded"
                            style="height: 500px;">
                            <div class="text-center">
                                <i class="bi bi-image" style="font-size: 5rem;"></i>
                                <p class="mt-2">Sem imagem</p>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="col-md-6 path">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="?page=home">Home</a></li> &nbsp /
                            <li class="breadcrumb-item"><a href="?page=catalogo">Catálogo</a></li> &nbsp /
                            <li class="breadcrumb-item active"><?= htmlspecialchars($produto['titulo']) ?></li>
                        </ol>
                    </nav>

                    <h1><?= htmlspecialchars($produto['titulo']) ?></h1>

                    <?php if (!empty($produto['artista'])): ?>
                        <p class="">
                            Artista: <?= htmlspecialchars($produto['artista']) ?>
                        </p>
                    <?php endif; ?>

                    <?php if (!empty($produto['ano'])): ?>
                        <p class="">
                            Ano de Lançamento: <?= htmlspecialchars($produto['ano']) ?>
                        </p>
                    <?php endif; ?>

                    <p class="">
                        Categoria:
                        <span
                            class="badge bg-secondary"><?= htmlspecialchars($produto['categoria_nome'] ?? 'Sem categoria') ?></span>
                    </p>

                    <hr>

                    <h3 class="mb-3">R$ <?= number_format($produto['preco'], 2, ',', '.') ?></h3>

                    <?php if ($produto['estoque'] > 0): ?>
                        <p class="text-success mb-3">
                            <i class="bi bi-check-circle me-2"></i>
                            <strong><?= $produto['estoque'] ?> unidades em estoque</strong>
                        </p>

                        <form method="POST" action="?page=adicionar-carrinho" class="mb-4">
                            <input type="hidden" name="produto_id" value="<?= $produto['id'] ?>">
                            <div class="input-group mb-3">
                                <button class="btn btn-outline-secondary" type="button" id="decrease">-</button>
                                <input type="number" class="form-control text-center" id="quantidade" name="quantidade"
                                    value="1" min="1" max="<?= $produto['estoque'] ?>" style="width: 60px;">
                                <button class="btn btn-outline-secondary" type="button" id="increase">+</button>
                            </div>
                            <button type="submit" class="btn btn-primary btn-lg w-100">
                                <i class="bi bi-cart-plus me-2"></i>Adicionar ao Carrinho
                            </button>
                        </form>

                        <script>
                            document.getElementById('increase').addEventListener('click', function () {
                                const input = document.getElementById('quantidade');
                                if (parseInt(input.value) < parseInt(input.max)) {
                                    input.value = parseInt(input.value) + 1;
                                }
                            });
                            document.getElementById('decrease').addEventListener('click', function () {
                                const input = document.getElementById('quantidade');
                                if (parseInt(input.value) > 1) {
                                    input.value = parseInt(input.value) - 1;
                                }
                            });
                        </script>
                    <?php else: ?>
                        <p class="text-danger mb-3">
                            <i class="bi bi-x-circle me-2"></i>
                            <strong>Produto indisponível no momento</strong>
                        </p>
                    <?php endif; ?>

                    <a href="?page=catalogo" class="btn btn-outline-secondary mt-4">
                        <i class="bi bi-arrow-left me-2"></i>Voltar ao Catálogo
                    </a>
                </div>


                <hr class="my-5">

                <div class="col-md-12">
                    <h4>Descrição do Produto</h4>
                    <p><?= nl2br(htmlspecialchars($produto['descricao'] ?? '')) ?></p>
                </div>
            </div>
        <?php endif; ?>
    </div>
</main>

<?php require "views/default/include/footer.php"; ?>