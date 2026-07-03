<?php

require_once "config/constants.php";
require_once "config/session.php";
require_once "config/database.php";
require_once "config/auth.php";

$page = $_GET['page'] ?? 'home';

switch ($page) {

    case 'home':
        require_once "controllers/HomeController.php";
        (new HomeController())->index();
        break;

    case 'catalogo':
        require_once "controllers/ProdutoController.php";
        (new ProdutoController())->listar();
        break;

    case 'produto':
        require_once "controllers/ProdutoController.php";
        (new ProdutoController())->detalhes($_GET['id'] ?? null);
        break;

    case 'login':
        require_once "controllers/UsuarioController.php";
        (new UsuarioController())->login();
        break;

    case 'autenticar':
        require_once "controllers/UsuarioController.php";
        (new UsuarioController())->autenticar();
        break;

    case 'cadastro':
        require_once "controllers/UsuarioController.php";
        (new UsuarioController())->cadastro();
        break;

    case 'salvarCadastro':
        require_once "controllers/UsuarioController.php";
        (new UsuarioController())->salvarCadastro();
        break;

    case 'logout':
        require_once "controllers/UsuarioController.php";
        (new UsuarioController())->logout();
        break;

    case 'carrinho':
        require_once "controllers/CarrinhoController.php";
        (new CarrinhoController())->listar();
        break;

    case 'adicionar-carrinho':
        require_once "controllers/CarrinhoController.php";
        (new CarrinhoController())->adicionar();
        break;

    case 'remover-carrinho':
        require_once "controllers/CarrinhoController.php";
        (new CarrinhoController())->remover($_GET['id'] ?? null);
        break;

    case 'atualizar-carrinho':
        require_once "controllers/CarrinhoController.php";
        (new CarrinhoController())->atualizar();
        break;

    case 'limpar-carrinho':
        require_once "controllers/CarrinhoController.php";
        (new CarrinhoController())->limpar();
        break;

    case 'checkout':
        require_once "controllers/PedidoController.php";
        (new PedidoController())->checkout();
        break;

    case 'finalizar-pedido':
        require_once "controllers/PedidoController.php";
        (new PedidoController())->finalizar();
        break;

    case 'meus-pedidos':
        require_once "controllers/PedidoController.php";
        (new PedidoController())->listar();
        break;

    case 'detalhe-pedido':
        require_once "controllers/PedidoController.php";
        (new PedidoController())->detalhe($_GET['id'] ?? null);
        break;

    case 'sobre':
        require_once "controllers/HomeController.php";
        (new HomeController())->sobre();
        break;

    case 'contato':
        require_once "controllers/HomeController.php";
        (new HomeController())->contato();
        break;

    case 'confirmacao':
        require_once "controllers/PedidoController.php";
        (new PedidoController())->confirmacao();
        break;

    case 'cancelar-pedido':
        require_once "controllers/PedidoController.php";
        (new PedidoController())->cancelar($_GET['id'] ?? null);
        break;

    default:
        http_response_code(404);
        echo "Página não encontrada.";

}
?>