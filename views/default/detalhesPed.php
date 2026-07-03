<?php require "views/default/include/header.php"; ?>

<?php require "views/default/include/navbar.php"; ?>

<main class="py-5">
    <div class="container">

        <div class="d-flex justify-content-between align-items-center mb-4">

            <h2>
                Pedido #<?= $pedido['id'] ?>
            </h2>

            <a href="?page=meus-pedidos" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i>
                Voltar
            </a>

        </div>

        <div class="row">

            <div class="col-lg-8">

                <div class="card shadow-sm">

                    <div class="card-header bg-dark text-white">

                        <h5 class="mb-0">
                            Produtos do Pedido
                        </h5>

                    </div>

                    <div class="card-body">

                        <div class="table-responsive">

                            <table class="table table-hover align-middle">

                                <thead>

                                    <tr>

                                        <th>Produto</th>

                                        <th width="120">Quantidade</th>

                                        <th width="150">Valor Unitário</th>

                                        <th width="150">Subtotal</th>

                                    </tr>

                                </thead>

                                <tbody>

                                    <?php if (count($itens) > 0): ?>

                                        <?php
                                        $subtotal = 0;
                                        ?>

                                        <?php foreach ($itens as $item): ?>

                                            <?php
                                            $linha = $item['quantidade'] * $item['valor_unitario'];

                                            $subtotal += $linha;
                                            ?>

                                            <tr>

                                                <td>

                                                    <strong>

                                                        <?= htmlspecialchars($item['titulo']) ?>

                                                    </strong>

                                                </td>

                                                <td>

                                                    <?= $item['quantidade'] ?>

                                                </td>

                                                <td>

                                                    R$
                                                    <?= number_format(
                                                        $item['valor_unitario'],
                                                        2,
                                                        ',',
                                                        '.'
                                                    ) ?>

                                                </td>

                                                <td>

                                                    <strong>

                                                        R$
                                                        <?= number_format(
                                                            $linha,
                                                            2,
                                                            ',',
                                                            '.'
                                                        ) ?>

                                                    </strong>

                                                </td>

                                            </tr>

                                        <?php endforeach; ?>

                                    <?php else: ?>

                                        <tr>

                                            <td colspan="5" class="text-center text-muted py-5">

                                                Nenhum produto encontrado neste pedido.

                                            </td>

                                        </tr>

                                    <?php endif; ?>

                                </tbody>

                            </table>

                        </div>

                    </div>

                </div>

            </div>
            <div class="col-lg-4">

                <form method="POST" action="?page=alterarStatus">

                    <input type="hidden" name="id" value="<?= $pedido['id'] ?>">

                    <div class="card shadow-sm mb-3">

                        <div class="card-header bg-dark text-white">
                            <h5 class="mb-0">Resumo do Pedido</h5>
                        </div>

                        <div class="card-body">


                            <div class="d-flex justify-content-between border-top pt-2">

                                <span class="fw-bold">
                                    Total
                                </span>

                                <strong class="text-success">

                                    R$
                                    <?= number_format($pedido['total'], 2, ',', '.') ?>

                                </strong>

                            </div>
                            <?php if ($pedido['status'] == 'pendente'): ?>

                                <a href="?page=cancelar-pedido&id=<?= $pedido['id'] ?>" class="btn btn-danger mt-3"
                                    onclick="return confirm('Deseja realmente cancelar este pedido?');">

                                    <i class="bi bi-x-circle"></i>
                                    Cancelar Pedido

                                </a>

                            <?php endif; ?>
                        </div>


                    </div>

                </form>

                <div class="card shadow-sm">

                    <div class="card-header bg-dark text-white">

                        <h5 class="mb-0">

                            Cliente

                        </h5>

                    </div>

                    <div class="card-body">

                        <table class="table table-borderless mb-0">

                            <tr>

                                <th width="100">
                                    Nome
                                </th>

                                <td>

                                    <?= htmlspecialchars($pedido['cliente']) ?>

                                </td>

                            </tr>

                            <tr>

                                <th>

                                    Email

                                </th>

                                <td>

                                    <?= htmlspecialchars($pedido['email']) ?>

                                </td>

                            </tr>

                            <tr>

                                <th>

                                    Telefone

                                </th>

                                <td>

                                    <?= htmlspecialchars($pedido['telefone']) ?>

                                </td>

                            </tr>

                            <tr>

                                <th>

                                    Endereço

                                </th>

                                <td>

                                    <?= htmlspecialchars($pedido['endereco']) ?>

                                </td>

                            </tr>

                            <tr>

                                <th>

                                    Data

                                </th>

                                <td>

                                    <?= date('d/m/Y H:i', strtotime($pedido['data'])) ?>

                                </td>

                            </tr>

                            <tr>

                                <th>

                                    Pedido

                                </th>

                                <td>

                                    #
                                    <?= $pedido['id'] ?>

                                </td>

                            </tr>

                        </table>

                    </div>

                </div>

            </div>

        </div>

    </div>

</main>