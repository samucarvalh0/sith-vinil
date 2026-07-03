<?php

require_once __DIR__ . "/../models/Produtos.php";

class ProdutoController
{

    private Produto $produto;

    public function __construct()
    {
        $this->produto = new Produto();
    }

    private function resolveCategoriaId(string $categoriaNome): int
    {
        require_once __DIR__ . "/../models/Categoria.php";
        $categoria = new Categoria();
        $categoriaNome = trim($categoriaNome);

        if ($categoriaNome === '') {
            return 0;
        }

        $categoriaExistente = $categoria->buscarPorNome($categoriaNome);

        if ($categoriaExistente) {
            return $categoriaExistente['id'];
        }

        $categoria->cadastrar(['nome' => $categoriaNome, 'descricao' => '']);
        $novaCategoria = $categoria->buscarPorNome($categoriaNome);

        return $novaCategoria['id'] ?? 0;
    }

    private function saveImageUpload(array $file): string
    {
        if (empty($file['tmp_name']) || !is_uploaded_file($file['tmp_name'])) {
            return '';
        }

        $uploadsDir = __DIR__ . "/../uploads/";

        if (!is_dir($uploadsDir)) {
            mkdir($uploadsDir, 0755, true);
        }

        $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
        $filename = uniqid('prod_', true) . ($ext ? '.' . $ext : '');
        $destination = $uploadsDir . $filename;

        if (move_uploaded_file($file['tmp_name'], $destination)) {
            return 'uploads/' . $filename;
        }

        return '';
    }

    public function listar()
{
    require_once __DIR__ . "/../models/Categoria.php";

    $categoriaModel = new Categoria();

    $categorias = $categoriaModel->listar();

    $filtros = [

        'busca' => $_GET['busca'] ?? '',

        'artista' => $_GET['artista'] ?? '',

        'categoria' => $_GET['categoria'] ?? '',

        'preco' => $_GET['preco'] ?? '',

        'ordem' => $_GET['ordem'] ?? ''

    ];

    $produtos = $this->produto->listar($filtros);

    require "views/default/catalogo.php";
}

    public function listarAdmin()
    {
        Auth::requireAdmin();

        $produtos = $this->produto->listar();

        require __DIR__ . "/../admin/listProd.php";
    }

    public function criarAdmin()
    {
        Auth::requireAdmin();

        require_once __DIR__ . "/../models/Categoria.php";
        $categoria = new Categoria();
        $categorias = $categoria->listar();

        require __DIR__ . "/../admin/cadProd.php";
    }

    public function salvarAdmin()
    {
        Auth::requireAdmin();

        $dados = $_POST;

        if (!empty($dados['categoria_nome'])) {
            $dados['categoria_id'] = $this->resolveCategoriaId($dados['categoria_nome']);
        }

        if (!empty($_FILES['imagem']['tmp_name'])) {
            $imagemPath = $this->saveImageUpload($_FILES['imagem']);
            if ($imagemPath !== '') {
                $dados['imagem'] = $imagemPath;
            }
        }

        $this->produto->cadastrar($dados);

        header("Location:?page=admin-produtos");
        exit;
    }

    public function editarAdmin($id)
    {
        Auth::requireAdmin();

        $produto = $this->produto->buscarPorId($id);

        require_once __DIR__ . "/../models/Categoria.php";
        $categoria = new Categoria();
        $categorias = $categoria->listar();

        require __DIR__ . "/../admin/editProd.php";
    }

    public function atualizarAdmin()
    {
        Auth::requireAdmin();

        $dados = $_POST;

        if (!empty($dados['categoria_nome'])) {
            $dados['categoria_id'] = $this->resolveCategoriaId($dados['categoria_nome']);
        }

        if (!empty($_FILES['imagem']['tmp_name'])) {
            $imagemPath = $this->saveImageUpload($_FILES['imagem']);
            if ($imagemPath !== '') {
                $dados['imagem'] = $imagemPath;
            }
        }

        $this->produto->editar($_POST['id'], $dados);

        header("Location:?page=admin-produtos");
        exit;
    }

    public function excluirAdmin($id)
    {
        Auth::requireAdmin();

        $this->produto->excluir($id);

        header("Location:?page=admin-produtos");
        exit;
    }

    public function detalhes($id)
    {
        $produto = $this->produto->buscarPorId($id);

        require "views/default/produto.php";
    }

    public function cadastrar()
    {
        Auth::requireAdmin();

        $dados = $_POST;

        if (!empty($dados['categoria_nome'])) {
            $dados['categoria_id'] = $this->resolveCategoriaId($dados['categoria_nome']);
        }

        if (!empty($_FILES['imagem']['tmp_name'])) {
            $imagemPath = $this->saveImageUpload($_FILES['imagem']);
            if ($imagemPath !== '') {
                $dados['imagem'] = $imagemPath;
            }
        }

        $this->produto->cadastrar($dados);

        header("Location:?page=produtos");
    }

    public function editar($id)
    {
        Auth::requireAdmin();

        $dados = $_POST;

        if (!empty($dados['categoria_nome'])) {
            $dados['categoria_id'] = $this->resolveCategoriaId($dados['categoria_nome']);
        }

        if (!empty($_FILES['imagem']['tmp_name'])) {
            $imagemPath = $this->saveImageUpload($_FILES['imagem']);
            if ($imagemPath !== '') {
                $dados['imagem'] = $imagemPath;
            }
        }

        $this->produto->editar($id, $dados);

        header("Location:?page=produtos");
    }

    public function excluir($id)
    {
        Auth::requireAdmin();

        $this->produto->excluir($id);

        header("Location:?page=produtos");
    }

}
?>