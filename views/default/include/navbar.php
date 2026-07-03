<nav class="navbar navbar-expand-lg navbar-dark bg-dark">

    <div class="container">

        <!-- Logo -->
        <a class="navbar-brand" href="?page=home">
            Sinth-vinil
        </a>

        <!-- Ícones da direita (sempre visíveis) -->
        <div class="d-flex align-items-center order-lg-3 ms-auto">

            <a href="?page=carrinho" class="text-white text-decoration-none position-relative me-3">

                <i class="bi bi-cart3 fs-3"></i>

                <?php
                $quantidade = 0;

                if (!empty($_SESSION['carrinho'])) {
                    foreach ($_SESSION['carrinho'] as $item) {
                        $quantidade += $item['quantidade'];
                    }
                }

                if ($quantidade > 0):
                    ?>

                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                        <?= $quantidade ?>
                    </span>

                <?php endif; ?>

            </a>

            <div class="dropdown">

                <a class="text-white text-decoration-none" href="#" role="button" data-bs-toggle="dropdown">

                    <i class="bi bi-person-circle fs-2"></i>

                </a>

                <ul class="dropdown-menu dropdown-menu-end">

                    <?php if (empty($_SESSION['usuario'])): ?>

                        <li>
                            <a class="dropdown-item" href="?page=login">
                                <i class="bi bi-box-arrow-in-right me-2"></i>
                                Entrar
                            </a>
                        </li>

                        <li>
                            <a class="dropdown-item" href="?page=cadastro">
                                <i class="bi bi-person-plus me-2"></i>
                                Criar conta
                            </a>
                        </li>

                    <?php else: ?>

                        <li>
                            <span class="dropdown-item-text">
                                Olá,
                                <strong><?= htmlspecialchars($_SESSION['usuario']['nome']) ?></strong>
                            </span>
                        </li>

                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item" href="?page=meus-pedidos">
                                <i class="bi bi-bag me-2"></i>
                                Meus Pedidos
                            </a>
                        </li>

                        <li>
                            <a class="dropdown-item text-danger" href="?page=logout">
                                <i class="bi bi-box-arrow-right me-2"></i>
                                Sair
                            </a>
                        </li>

                    <?php endif; ?>

                </ul>

            </div>

        </div>

        <button class="navbar-toggler order-lg-2 ms-3" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarPrincipal">

            <span class="navbar-toggler-icon"></span>

        </button>

        <div class="collapse navbar-collapse justify-content-center order-lg-2" id="navbarPrincipal">

            <ul class="navbar-nav">

                <li class="nav-item mx-2">
                    <a class="nav-link" href="?page=catalogo">Catálogo</a>
                </li>

                <li class="nav-item mx-2">
                    <a class="nav-link" href="?page=sobre">Sobre</a>
                </li>

                <li class="nav-item mx-2">
                    <a class="nav-link" href="?page=contato">Contato</a>
                </li>

            </ul>

        </div>

    </div>

</nav>