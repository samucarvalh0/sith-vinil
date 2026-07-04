<?php require "views/default/include/header.php"; ?>

<?php require "views/default/include/navbar.php"; ?>

<main class="py-5">
    <div class="container bg-dark p-4 rounded shadow-sm">
        <h1 class="mb-4">Fale Conosco</h1>

        <div class="row">
            <div class="col-md-6">
                <h3>Envie sua mensagem</h3>
                <form method="POST" action="?page=enviar-contato">
                    <div class="mb-3">
                        <label for="nome" class="form-label">Nome</label>
                        <input type="text" class="form-control" id="nome" name="nome" required>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>

                    <div class="mb-3">
                        <label for="telefone" class="form-label">Telefone (opcional)</label>
                        <input type="tel" class="form-control" id="telefone" name="telefone">
                    </div>

                    <div class="mb-3">
                        <label for="assunto" class="form-label">Assunto</label>
                        <select class="form-control" id="assunto" name="assunto" required>
                            <option value="">Selecione um assunto</option>
                            <option value="duvida">Dúvida sobre produto</option>
                            <option value="pedido">Problema com pedido</option>
                            <option value="reclamacao">Reclamação</option>
                            <option value="sugestao">Sugestão</option>
                            <option value="outro">Outro</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="mensagem" class="form-label">Mensagem</label>
                        <textarea class="form-control" id="mensagem" name="mensagem" rows="5" required></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-send me-2"></i>Enviar Mensagem
                    </button>
                </form>
            </div>

            <div class="col-md-6">
                <h3>Informações de Contato</h3>

                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title"><i class="bi bi-telephone me-2"></i>Telefone</h5>
                        <p class="card-text">(11) 3333-3333</p>
                    </div>
                </div>

                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title"><i class="bi bi-envelope me-2"></i>Email</h5>
                        <p class="card-text">contato@sinthvinil.com.br</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php require "views/default/include/footer.php"; ?>