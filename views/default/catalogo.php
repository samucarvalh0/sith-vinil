<?php require "views/default/include/header.php"; ?>

<?php require "views/default/include/navbar.php"; ?>

<main class="py-5">

    <div class="container-fluid">

        <div class="row">

            <!-- SIDEBAR -->

            <div class="col-lg-3 col-xl-2 mb-4">

                <div class="card shadow-sm sticky-top" style="top:20px;">

                    <div class="card-header bg-dark text-white">

                        <h5 class="mb-0">

                            <i class="bi bi-funnel-fill"></i>

                            Filtros

                        </h5>

                    </div>

                    <div class="card-body">

                        <form method="GET">

                            <input type="hidden" name="page" value="catalogo">

                            <div class="mb-3">

                                <label class="form-label">

                                    Buscar

                                </label>

                                <input type="text" name="busca" class="form-control" value="<?= $_GET['busca'] ?? '' ?>"
                                    placeholder="Nome do disco">

                            </div>

                            <div class="mb-3">

                                <label class="form-label">

                                    Artista

                                </label>

                                <input type="text" name="artista" class="form-control"
                                    value="<?= $_GET['artista'] ?? '' ?>" placeholder="Nome do artista">

                            </div>

                            <div class="mb-3">

                                <label class="form-label">

                                    Categoria

                                </label>

                                <select name="categoria" class="form-select">

                                    <option value="">

                                        Todas

                                    </option>

                                    <?php foreach ($categorias as $categoria): ?>

                                        <option value="<?= $categoria['id'] ?>" <?= (($_GET['categoria'] ?? '') == $categoria['id']) ? 'selected' : '' ?>>

                                            <?= htmlspecialchars($categoria['nome']) ?>

                                        </option>

                                    <?php endforeach; ?>

                                </select>

                            </div>

                            <div class="mb-3">

                                <label class="form-label">

                                    Preço máximo

                                </label>

                                <input type="number" name="preco" class="form-control"
                                    value="<?= $_GET['preco'] ?? '' ?>" min="0">

                            </div>

                            <div class="mb-3">

                                <label class="form-label">

                                    Ordenar por

                                </label>

                                <select name="ordem" class="form-select">

                                    <option value="">Padrão</option>

                                    <option value="menor" <?= (($_GET['ordem'] ?? '') == 'menor') ? 'selected' : '' ?>>
                                        Menor preço
                                    </option>

                                    <option value="maior" <?= (($_GET['ordem'] ?? '') == 'maior') ? 'selected' : '' ?>>
                                        Maior preço
                                    </option>

                                    <option value="az" <?= (($_GET['ordem'] ?? '') == 'az') ? 'selected' : '' ?>>
                                        A-Z
                                    </option>

                                    <option value="za" <?= (($_GET['ordem'] ?? '') == 'za') ? 'selected' : '' ?>>
                                        Z-A
                                    </option>

                                </select>

                            </div>

                            <button class="btn btn-dark w-100">

                                <i class="bi bi-search"></i>

                                Filtrar

                            </button>

                            <a href="?page=catalogo" class="btn btn-outline-secondary w-100 mt-2">

                                Limpar filtros

                            </a>

                        </form>

                    </div>

                </div>

            </div>

            <!-- PRODUTOS -->

            <div class="col-lg-9 col-xl-10">

                <div class="d-flex justify-content-between align-items-center mb-4">

                    <div>

                        <h2>

                            Catálogo

                        </h2>

                        <p class="text-muted mb-0">

                            <?= count($produtos) ?> produto(s) encontrado(s)

                        </p>

                    </div>

                </div>

                <div class="row">

                    <?php if (empty($produtos)): ?>

                        <div class="col-12">

                            <div class="alert alert-warning">

                                Nenhum produto encontrado.

                            </div>

                        </div>

                    <?php endif; ?>

                    <?php foreach ($produtos as $produto): ?>

                        <div class="col-md-6 col-lg-4 col-xl-3 mb-4">

                            <div class="card h-100 shadow-sm">

                                <?php if (!empty($produto['imagem'])): ?>

                                    <img src="<?= htmlspecialchars($produto['imagem']) ?>" class="card-img-top"
                                        style="height:260px;object-fit:cover;">

                                <?php else: ?>

                                    <div class="bg-light d-flex justify-content-center align-items-center"
                                        style="height:260px;">

                                        <i class="bi bi-image" style="font-size:60px;"></i>

                                    </div>

                                <?php endif; ?>

                                <div class="card-body">

                                    <h5>

                                        <?= htmlspecialchars($produto['titulo']) ?>

                                    </h5>

                                    <p class="text-muted mb-1">

                                        <?= htmlspecialchars($produto['artista']) ?>

                                    </p>

                                    <small class="text-secondary">

                                        <?= htmlspecialchars($produto['categoria_nome']) ?>

                                    </small>

                                    <hr>

                                    <h4 class="text-success">

                                        R$
                                        <?= number_format(
                                            $produto['preco'],
                                            2,
                                            ',',
                                            '.'
                                        ) ?>

                                    </h4>

                                </div>

                                <div class="card-footer bg-white">

                                    <a href="?page=produto&id=<?= $produto['id'] ?>" class="btn btn-dark w-100">

                                        Ver detalhes

                                    </a>

                                </div>

                            </div>

                        </div>

                    <?php endforeach; ?>

                </div>

            </div>

        </div>

    </div>

</main>

<?php require "views/default/include/footer.php"; ?>