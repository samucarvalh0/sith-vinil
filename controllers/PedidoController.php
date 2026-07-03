<?php

require_once __DIR__ . "/../models/Pedido.php";
require_once __DIR__ . "/../models/Carrinho.php";

class PedidoController
{
    private Pedido $pedido;

    public function __construct()
    {
        $this->pedido = new Pedido();
    }

    /* ===========================
       ÁREA DO CLIENTE
    =========================== */

    public function checkout()
    {
        Auth::requireLogin();

        require __DIR__ . "/../views/default/checkout.php";
    }

    public function finalizar()
    {
        Auth::requireLogin();

        $clienteId = $_SESSION['usuario']['id'];

        $carrinho = new Carrinho();
        $itens = $carrinho->listar();

        if (empty($itens)) {
            header("Location: ?page=carrinho");
            exit;
        }

        $total = $carrinho->obterTotal() + 10;

        $pedidoId = $this->pedido->finalizar([
            'cliente_id' => $clienteId,
            'total' => $total,
            'status' => 'pendente'
        ]);

        if (!$pedidoId) {
            header("Location: ?page=checkout");
            exit;
        }

        foreach ($itens as $item) {

            $this->pedido->salvarItem(
                $pedidoId,
                $item['id'],
                $item['quantidade'],
                $item['preco']
            );

        }

        $carrinho->limpar();

        header("Location: ?page=confirmacao&pedido=" . $pedidoId);
        exit;
    }

    public function confirmacao()
    {
        Auth::requireLogin();

        $pedidoId = $_GET['pedido'] ?? null;

        if (!$pedidoId) {
            header("Location: ?page=meus-pedidos");
            exit;
        }

        $pedido = $this->pedido->buscar($pedidoId);

        if (!$pedido) {
            header("Location: ?page=meus-pedidos");
            exit;
        }

        $itens = $this->pedido->buscarItens($pedidoId);

        require __DIR__ . "/../views/default/confirmacao.php";
    }

    public function listar()
    {
        Auth::requireLogin();

        $clienteId = $_SESSION['usuario']['id'];

        $pedidos = $this->pedido->listarPorUsuario($clienteId);

        require __DIR__ . "/../views/default/pedidos.php";
    }

    public function detalhe($id)
    {
        Auth::requireLogin();

        if (!$id) {
            header("Location: ?page=meus-pedidos");
            exit;
        }

        $pedido = $this->pedido->buscar($id);

        if (!$pedido) {
            header("Location: ?page=meus-pedidos");
            exit;
        }

        /**
         * Impede que um cliente visualize
         * pedidos de outro cliente
         */
        if ($pedido['cliente_id'] != $_SESSION['usuario']['id']) {
            header("Location: ?page=meus-pedidos");
            exit;
        }

        $itens = $this->pedido->buscarItens($id);

        require __DIR__ . "/../views/default/detalhesPed.php";
    }

    /* ===========================
       ÁREA ADMIN
    =========================== */

    public function listarAdmin()
    {
        Auth::requireAdmin();

        $pedidos = $this->pedido->listar();

        require __DIR__ . "/../admin/listPed.php";
    }

    public function detalheAdmin($id)
    {
        Auth::requireAdmin();

        if (!$id) {
            header("Location: ?page=admin-pedidos");
            exit;
        }

        $pedido = $this->pedido->buscar($id);

        if (!$pedido) {
            header("Location: ?page=admin-pedidos");
            exit;
        }

        $itens = $this->pedido->buscarItens($id);

        require __DIR__ . "/../admin/detalhePed.php";
    }

    public function alterarStatus()
    {
        Auth::requireAdmin();

        $id = $_POST['id'] ?? null;
        $status = $_POST['status'] ?? null;

        if (!$id || !$status) {
            header("Location: ?page=admin-pedidos");
            exit;
        }

        $this->pedido->atualizarStatus($id, $status);

        header("Location: ?page=detalhePed&id=" . $id);
        exit;
    }

    public function excluirAdmin($id)
    {
        Auth::requireAdmin();

        if (!$id) {
            header("Location: ?page=admin-pedidos");
            exit;
        }

        $this->pedido->excluir($id);

        header("Location: ?page=admin-pedidos");
        exit;
    }

    public function cancelar($id)
    {
        Auth::requireLogin();

        if (!$id) {
            header("Location: ?page=meus-pedidos");
            exit;
        }

        $pedido = $this->pedido->buscar($id);

        if (!$pedido) {
            header("Location: ?page=meus-pedidos");
            exit;
        }

        if ($pedido['cliente_id'] != $_SESSION['usuario']['id']) {
            header("Location: ?page=meus-pedidos");
            exit;
        }

        if ($pedido['status'] != 'pendente') {
            header("Location: ?page=detalhe-pedido&id=" . $id);
            exit;
        }

        $this->pedido->cancelar($id);

        header("Location: ?page=detalhe-pedido&id=" . $id);
        exit;
    }
}