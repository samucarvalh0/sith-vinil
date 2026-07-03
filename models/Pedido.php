<?php

class Pedido
{
    public function listar($usuario = null)
    {
        global $conn;

        if ($usuario !== null) {

            $sql = "SELECT
                        p.*,
                        c.nome AS cliente
                    FROM pedidos p
                    LEFT JOIN clientes c
                        ON p.cliente_id = c.id
                    WHERE p.cliente_id = ?
                    ORDER BY p.data DESC";

            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $usuario);
            $stmt->execute();

            return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        }

        $sql = "SELECT
                    p.*,
                    c.nome AS cliente
                FROM pedidos p
                LEFT JOIN clientes c
                    ON p.cliente_id = c.id
                ORDER BY p.data DESC";

        $result = $conn->query($sql);

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function listarPorUsuario($usuarioId)
    {
        global $conn;

        $sql = "SELECT *
                FROM pedidos
                WHERE cliente_id = ?
                ORDER BY data DESC";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $usuarioId);
        $stmt->execute();

        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function buscar($id)
    {
        global $conn;

        $sql = "SELECT
                    p.*,
                    c.nome AS cliente,
                    c.email,
                    c.telefone,
                    c.endereco
                FROM pedidos p
                LEFT JOIN clientes c
                    ON c.id = p.cliente_id
                WHERE p.id = ?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();

        return $stmt->get_result()->fetch_assoc();
    }

    public function buscarItens($pedidoId)
    {
        global $conn;

        $sql = "SELECT
                    ip.*,
                    p.titulo,
                    p.imagem
                FROM itens_pedido ip
                INNER JOIN produtos p
                    ON p.id = ip.produto_id
                WHERE ip.pedido_id = ?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $pedidoId);
        $stmt->execute();

        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function finalizar($dados)
    {
        global $conn;

        $cliente = $dados['cliente_id'];
        $total = $dados['total'];
        $status = $dados['status'];

        $sql = "INSERT INTO pedidos
                (cliente_id,data,total,status)
                VALUES (?,NOW(),?,?)";

        $stmt = $conn->prepare($sql);

        $stmt->bind_param(
            "ids",
            $cliente,
            $total,
            $status
        );

        if ($stmt->execute()) {
            return $conn->insert_id;
        }

        return false;
    }

    public function salvarItem($pedidoId, $produtoId, $quantidade, $valorUnitario)
    {
        global $conn;

        $sql = "INSERT INTO itens_pedido
                (pedido_id,produto_id,quantidade,valor_unitario)
                VALUES (?,?,?,?)";

        $stmt = $conn->prepare($sql);

        $stmt->bind_param(
            "iiid",
            $pedidoId,
            $produtoId,
            $quantidade,
            $valorUnitario
        );

        return $stmt->execute();
    }

    public function atualizarStatus($id, $status)
    {
        global $conn;

        $sql = "UPDATE pedidos
                SET status = ?
                WHERE id = ?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $status, $id);

        return $stmt->execute();
    }

    public function excluir($id)
    {
        global $conn;

        $stmt = $conn->prepare(
            "DELETE FROM itens_pedido
             WHERE pedido_id = ?"
        );

        $stmt->bind_param("i", $id);
        $stmt->execute();

        $stmt = $conn->prepare(
            "DELETE FROM pedidos
             WHERE id = ?"
        );

        $stmt->bind_param("i", $id);

        return $stmt->execute();
    }

    public function contar()
    {
        global $conn;

        $sql = "SELECT COUNT(*) total FROM pedidos";

        $result = $conn->query($sql);

        return $result->fetch_assoc()['total'];
    }

    public function listarUltimos($limite = 5)
    {
        global $conn;

        $sql = "SELECT
                    p.*,
                    c.nome AS cliente
                FROM pedidos p
                LEFT JOIN clientes c
                    ON c.id = p.cliente_id
                ORDER BY p.data DESC
                LIMIT ?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $limite);
        $stmt->execute();

        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function cancelar($id)
{
    global $conn;

    $sql = "UPDATE pedidos
            SET status = 'cancelado'
            WHERE id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    return $stmt->execute();
}
}