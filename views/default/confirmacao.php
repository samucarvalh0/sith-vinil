<?php require_once __DIR__ . "/include/header.php"; ?>
<?php require_once __DIR__ . "/include/navbar.php"; ?>

<main class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 text-center">
                <div class="mb-4">
                    <i class="bi bi-check-circle text-success" style="font-size: 5rem;"></i>
                </div>
                <h1 class="mb-3">Pedido Confirmado!</h1>
                <p class="lead mb-4">
                    Seu pedido foi realizado com sucesso. Você receberá uma confirmação por email.
                </p>

                <div class="alert alert-info">
                    <h6>Número do Pedido:</h6>
                    <h4 class="mb-0">#<?= htmlspecialchars($_GET['pedido'] ?? 'N/A') ?></h4>
                </div>

                <div class="mt-5">
                    <a href="?page=meus-pedidos" class="btn btn-primary btn-lg me-2">
                        <i class="bi bi-list-check me-2"></i>Ver Meus Pedidos
                    </a>
                    <a href="?page=home" class="btn btn-outline-primary btn-lg">
                        <i class="bi bi-house me-2"></i>Voltar ao Home
                    </a>
                </div>
            </div>
        </div>
    </div>
</main>

<?php require_once __DIR__ . "/include/footer.php"; ?>