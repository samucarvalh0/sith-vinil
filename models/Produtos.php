<?php

class Produto
{

    public function listar($filtros = [])
    {
        global $conn;

        $sql = "SELECT
                p.*,
                c.nome AS id_categorias
            FROM produtos p
            LEFT JOIN categorias c
                ON c.id = p.id_categorias
            WHERE p.estoque > 0";

        $parametros = [];
        $tipos = "";


        if (!empty($filtros['busca'])) {

            $sql .= " AND p.titulo LIKE ?";

            $parametros[] = "%" . $filtros['busca'] . "%";

            $tipos .= "s";
        }

        if (!empty($filtros['artista'])) {

            $sql .= " AND p.artista LIKE ?";

            $parametros[] = "%" . $filtros['artista'] . "%";

            $tipos .= "s";
        }

        if (!empty($filtros['categoria'])) {

            $sql .= " AND p.id_categorias = ?";

            $parametros[] = $filtros['categoria'];

            $tipos .= "i";
        }


        if (!empty($filtros['preco'])) {

            $sql .= " AND p.preco <= ?";

            $parametros[] = $filtros['preco'];

            $tipos .= "d";
        }


        switch ($filtros['ordem'] ?? '') {

            case 'menor':
                $sql .= " ORDER BY p.preco ASC";
                break;

            case 'maior':
                $sql .= " ORDER BY p.preco DESC";
                break;

            case 'az':
                $sql .= " ORDER BY p.titulo ASC";
                break;

            case 'za':
                $sql .= " ORDER BY p.titulo DESC";
                break;

            default:
                $sql .= " ORDER BY p.titulo ASC";
                break;

        }

        $stmt = $conn->prepare($sql);

        if (!empty($parametros)) {

            $stmt->bind_param($tipos, ...$parametros);

        }

        $stmt->execute();

        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function buscarPorId($id)
    {
        global $conn;

        $sql = "SELECT p.*, c.nome AS categoria_nome FROM produtos p
                LEFT JOIN categorias c ON p.id_categorias = c.id
                WHERE p.id = ?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();

        $result = $stmt->get_result();

        return $result->fetch_assoc();
    }

    public function cadastrar($dados)
    {
        global $conn;

        $nome = $dados['titulo'] ?? $dados['nome'] ?? '';
        $categoria_id = (int) ($dados['id_categorias'] ?? $dados['categoria_id'] ?? 0);
        $artista = $dados['artista'] ?? '';
        $ano = (int) ($dados['ano'] ?? date('Y'));
        $preco = (float) ($dados['preco'] ?? 0);
        $estoque = (int) ($dados['estoque'] ?? 0);
        $descricao = $dados['descricao'] ?? '';
        $imagem = $dados['imagem'] ?? '';

        $sql = "INSERT INTO produtos (titulo, id_categorias, artista, ano, preco, estoque, descricao, imagem)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sisidiss", $nome, $categoria_id, $artista, $ano, $preco, $estoque, $descricao, $imagem);

        return $stmt->execute();
    }

    public function editar($id, $dados)
    {
        global $conn;

        $nome = $dados['titulo'] ?? $dados['nome'] ?? '';
        $categoria_id = (int) ($dados['id_categorias'] ?? $dados['categoria_id'] ?? 0);
        $artista = $dados['artista'] ?? '';
        $ano = (int) ($dados['ano'] ?? date('Y'));
        $preco = (float) ($dados['preco'] ?? 0);
        $estoque = (int) ($dados['estoque'] ?? 0);
        $descricao = $dados['descricao'] ?? '';
        $imagem = $dados['imagem'] ?? null;

        if (!empty($imagem)) {
            $sql = "UPDATE produtos SET titulo = ?, id_categorias = ?, artista = ?, ano = ?, preco = ?, estoque = ?, descricao = ?, imagem = ? WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sisidissi", $nome, $categoria_id, $artista, $ano, $preco, $estoque, $descricao, $imagem, $id);
        } else {
            $sql = "UPDATE produtos SET titulo = ?, id_categorias = ?, artista = ?, ano = ?, preco = ?, estoque = ?, descricao = ? WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sisidisi", $nome, $categoria_id, $artista, $ano, $preco, $estoque, $descricao, $id);
        }

        return $stmt->execute();
    }

    public function excluir($id)
    {
        global $conn;

        $sql = "DELETE FROM produtos WHERE id = ?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);

        return $stmt->execute();
    }

    public function contar()
    {
        global $conn;

        $sql = "SELECT COUNT(*) as total FROM produtos";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();

        return $row['total'] ?? 0;
    }

}