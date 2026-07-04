<?php require __DIR__ . "/include/sidebar.php"; ?>
<?php require __DIR__ . "/include/header.php"; ?>



<div class="main-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h1 class="mb-4">Cadastrar Novo Produto</h1>

                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="?page=salvarProd" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label class="form-label">Nome do Produto</label>
                                <input type="text" name="titulo" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <label class="form-label mb-0">Categoria</label>
                                    <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal"
                                        data-bs-target="#modalNovaCategoria">
                                        <i class="bi bi-plus-circle me-1"></i>Criar Categoria
                                    </button>
                                </div>
                                <input type="text" name="categoria_nome" list="categorias-list" class="form-control"
                                    required placeholder="Digite ou selecione uma categoria">
                                <datalist id="categorias-list">
                                    <?php if (!empty($categorias)): ?>
                                        <?php foreach ($categorias as $cat): ?>
                                            <option value="<?= htmlspecialchars($cat['nome']) ?>"></option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </datalist>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Artista</label>
                                        <input type="text" name="artista" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Ano</label>
                                        <input type="number" name="ano" class="form-control" min="1900" max="2100"
                                            value="<?= date('Y') ?>">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Preço</label>
                                        <input type="number" name="preco" class="form-control" step="0.01" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Estoque</label>
                                        <input type="number" name="estoque" class="form-control" required>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Descrição</label>
                                <textarea name="descricao" class="form-control" rows="4"></textarea>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Imagem</label>
                                <input type="file" name="imagem" class="form-control" accept="image/*">
                            </div>

                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-check-circle me-2"></i>Salvar Produto
                                </button>
                                <a href="?page=admin-produtos" class="btn btn-secondary">
                                    <i class="bi bi-x-circle me-2"></i>Cancelar
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="modalNovaCategoria" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Criar Nova Categoria</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="formNovaCategoria">
                    <div class="mb-3">
                        <label class="form-label">Nome da Categoria</label>
                        <input type="text" name="nome" class="form-control" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" id="btnSalvarCategoria">
                    <i class="bi bi-check-circle me-2"></i>Salvar Categoria
                </button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.getElementById('btnSalvarCategoria').addEventListener('click', function () {
        const nome = document.querySelector('#formNovaCategoria input[name="nome"]').value;

        if (!nome.trim()) {
            alert('Digite o nome da categoria');
            return;
        }

        fetch('?page=salvarCat', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: 'nome=' + encodeURIComponent(nome)
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Categoria criada com sucesso!');
                    location.reload();
                } else {
                    alert('Erro ao salvar categoria');
                }
            })
            .catch(error => {
                console.error('Erro:', error);
                alert('Erro ao salvar categoria');
            });
    });
</script>