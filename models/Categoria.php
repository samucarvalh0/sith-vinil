<?php

class Categoria
{

    public function listar()
    {
        global $conn;

        $sql = "SELECT * FROM categorias ORDER BY nome ASC";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        }

        return [];
    }

    public function buscarPorId($id)
    {
        global $conn;

        $sql = "SELECT * FROM categorias WHERE id = ?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();

        $result = $stmt->get_result();

        return $result->fetch_assoc();
    }

    public function buscarPorNome($nome)
    {
        global $conn;

        $sql = "SELECT * FROM categorias WHERE nome = ? LIMIT 1";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $nome);
        $stmt->execute();

        $result = $stmt->get_result();

        return $result->fetch_assoc();
    }

    public function cadastrar($dados)
    {
        global $conn;

        $nome = $dados['nome'] ?? '';

        $sql = "INSERT INTO categorias (nome) VALUES (?)";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $nome);

        return $stmt->execute();
    }

    public function editar($id, $dados)
    {
        global $conn;

        $nome = $dados['nome'] ?? '';

        $sql = "UPDATE categorias SET nome = ? WHERE id = ?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $nome, $id);

        return $stmt->execute();
    }

    public function excluir($id)
    {
        global $conn;

        $sql = "DELETE FROM categorias WHERE id = ?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);

        return $stmt->execute();
    }

    public function contar()
    {
        global $conn;

        $sql = "SELECT COUNT(*) as total FROM categorias";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();

        return $row['total'] ?? 0;
    }

}
