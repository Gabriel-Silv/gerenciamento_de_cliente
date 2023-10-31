<?php

namespace Mini\Model;

use Mini\Core\Model;
use PDOException;
class ItensVenda extends Model
{
    public function getAllItensVendas()
    {
        $sql = "SELECT * FROM itens_vendas";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }

    public function add($request)
    {
        try {
            $this->db->beginTransaction();
            $sql = "INSERT INTO itens_venda (id_venda, id_produto, valor_unit, quantidade) VALUES (:id_venda,:id_produto,:valor_unit,:quantidade)";
            $query = $this->db->prepare($sql);
            $parameters = [
                ':id_venda' => $request['id_venda'],
                ':id_produto' => $request['id_produto'],
                ':valor_unit' => $request['valor'],
                ':quantidade' => $request['quantidade']
            ];
            $result = $query->execute($parameters);
            $this->db->commit();
            return [
                'success' => $result,
                'id_itens_venda' => $this->db->lastInsertId()
            ];
        } catch (PDOException $e) {
            $this->db->rollback();
        }
    }

    public function delete($itensVendas_id)
    {
        $sql = "DELETE FROM itens_vendas WHERE id = :itensVendas_id";
        $query = $this->db->prepare($sql);
        $parameters = [':itensVendas_id' => $itensVendas_id];
        $query->execute($parameters);
    }

    public function getItensVendas($itensVendas_id)
    {
        $sql = "SELECT * FROM itens_vendas WHERE id = :itensVendas_id LIMIT 1";
        $query = $this->db->prepare($sql);
        $parameters = [':itensVendas_id' => $itensVendas_id];
        $query->execute($parameters);
        return ($query->rowCount() ? $query->fetch() : false);
    }

    public function getItensVendasPorCodigo($codigo)
    {
        $sql = "SELECT id, descricao, unidade, valor, codigo FROM itens_vendas WHERE codigo = :codigo LIMIT 1";
        $query = $this->db->prepare($sql);
        $parameters = [':codigo' => $codigo];
        $query->execute($parameters);
        return ($query->rowCount() ? $query->fetch() : false);
    }

    public function update($descricao, $unidade, $valor, $codigo, $itensVendasId)
    {
        $sql = "UPDATE itens_vendas SET quantidade = :quantidade, valor_unit = :valor_unit  WHERE id = :itensVendas_id";
        $query = $this->db->prepare($sql);
        $parameters = [
            ':quantidade' => $descricao,
            ':valor_unit' => $unidade,
            ':itensVendas_id' => $itensVendasId
        ];
        $query->execute($parameters);
    }

    public function getAmountOfItensVendas()
    {
        $sql = "SELECT COUNT(id) AS amount_of_ItensVendas FROM itens_vendas";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetch()->amount_of_ItensVendas;
    }
}