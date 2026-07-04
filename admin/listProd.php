<?php require __DIR__ . "/include/sidebar.php"; ?>
<?php require __DIR__ . "/include/header.php"; ?>

<div class="main-content">
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Produtos</h1>
            <a href="?page=cadProd" class="btn btn-primary">
                <i class="bi bi-plus-circle me-2"></i>Novo Produto
            </a>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Título</th>
                                <th>Artista</th>
                                <th>Ano</th>
                                <th>Categoria</th>
                                <th>Preço</th>
                                <th>Estoque</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($produtos)): ?>
                                <tr>
                                    <td colspan="8" class="text-center text-muted">Nenhum produto encontrado</td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($produtos as $produto): ?>
                                    <tr>
                                        <td><?= $produto['id'] ?></td>
                                        <td><?= $produto['titulo'] ?></td>
                                        <td><?= $produto['artista'] ?? 'N/A' ?></td>
                                        <td><?= $produto['ano'] ?? 'N/A' ?></td>
                                        <td><?= $produto['id_categorias'] ?? 'N/A' ?></td>
                                        <td>R$ <?= number_format($produto['preco'], 2, ',', '.') ?></td>
                                        <td><span class="badge bg-info"><?= $produto['estoque'] ?></span></td>
                                        <td>
                                            <a href="?page=editProd&id=<?= $produto['id'] ?>" class="btn btn-sm btn-warning">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <a href="?page=excluirProd&id=<?= $produto['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza?')">
                                                <i class="bi bi-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>