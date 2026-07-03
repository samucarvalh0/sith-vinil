<?php

require_once "../config/constants.php";
require_once "../config/database.php";
require_once "../config/session.php";
require_once "../config/Auth.php";

$page = $_GET['page'] ?? 'dashboard';

switch ($page) {

    case 'login':
        require "../controllers/AdminController.php";
        (new AdminController())->login();
        break;

    case 'autenticar':
        require "../controllers/AdminController.php";
        (new AdminController())->autenticar();
        break;

    case 'dashboard':
        require "../controllers/AdminController.php";
        (new AdminController())->dashboard();
        break;

    case 'admin-produtos':
        require "../controllers/ProdutoController.php";
        (new ProdutoController())->listarAdmin();
        break;

    case 'admin-categorias':
        require "../controllers/CategoriaController.php";
        (new CategoriaController())->listarAdmin();
        break;

    case 'cadProd':
        require "../controllers/ProdutoController.php";
        (new ProdutoController())->criarAdmin();
        break;

    case 'salvarProd':
        require "../controllers/ProdutoController.php";
        (new ProdutoController())->salvarAdmin();
        break;

    case 'editProd':
        require "../controllers/ProdutoController.php";
        (new ProdutoController())->editarAdmin($_GET['id'] ?? null);
        break;

    case 'atualizarProd':
        require "../controllers/ProdutoController.php";
        (new ProdutoController())->atualizarAdmin();
        break;

    case 'excluirProd':
        require "../controllers/ProdutoController.php";
        (new ProdutoController())->excluirAdmin($_GET['id'] ?? null);
        break;

    case 'cadCat':
        require "../controllers/CategoriaController.php";
        (new CategoriaController())->criarAdmin();
        break;

    case 'salvarCat':
        require "../controllers/CategoriaController.php";
        (new CategoriaController())->salvarAdmin();
        break;

    case 'editCat':
        require "../controllers/CategoriaController.php";
        (new CategoriaController())->editarAdmin($_GET['id'] ?? null);
        break;

    case 'atualizarCat':
        require "../controllers/CategoriaController.php";
        (new CategoriaController())->atualizarAdmin();
        break;

    case 'excluirCat':
        require "../controllers/CategoriaController.php";
        (new CategoriaController())->excluirAdmin($_GET['id'] ?? null);
        break;

    case 'admin-pedidos':
        require "../controllers/PedidoController.php";
        (new PedidoController())->listarAdmin();
        break;

    case 'detalhePed':
        require "../controllers/PedidoController.php";
        (new PedidoController())->detalheAdmin($_GET['id'] ?? null);
        break;

    case 'alterarStatus':
        require "../controllers/PedidoController.php";
        (new PedidoController())->alterarStatus();
        break;

    case 'excluirPedido':
        require "../controllers/PedidoController.php";
        (new PedidoController())->excluirAdmin($_GET['id'] ?? null);
        break;

    case 'logout':
        require "../controllers/AdminController.php";
        (new AdminController())->logout();
        break;
}
?>