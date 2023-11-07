<?php

/**
 * Class Vendas
 */

namespace Mini\Model;

use Mini\Core\Model;
use PDOException;
use Mini\Libs\Helper;
class Venda extends Model
{
    /**
     * Get all Vendas from database
     */
    public function getAllVenda()
    {
        $sql = "SELECT * FROM vendas v 
                inner join itens_venda i on(i.id_venda = v.id)
                inner join clientes c on(c.id = v.id_cliente)
                inner join funcionarios f on(f.id = v.id_funcionario)
                inner join produtos p on(p.id = i.id_produto)";
        $query = $this->db->prepare($sql);
        $query->execute();

        // fetchAll() é o método PDO que recebe todos os registros retornados, aqui em object-style porque definimos isso em
        // core/controller.php! Se preferir obter um array associativo como resultado, use
        // $query->fetchAll(PDO::FETCH_ASSOC); ou mude as opções em core/controller.php's PDO para
        // $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC ...
        return $query->fetchAll();
    }

    public function relatorio()
    {
        $sql = "SELECT
					
            v.id_cliente,
            DATE_FORMAT(v.data_venda, '%d/%m/%Y') data_venda,
            v.id as codigo,
            v.status_venda,
            v.total_venda,
            sum(i.quantidade) as quantidade,
            i.valor_unit,
            f.nome as nome_vendedor,
            c.razao_social 
            FROM vendas v 
            inner join itens_venda i on(i.id_venda = v.id)
            inner join clientes c on(c.id = v.id_cliente)
            inner join funcionarios f on(f.id = v.id_funcionario)
            inner join produtos p on(p.id = i.id_produto)
            group by i.id,v.id,c.id order by i.id,c.id";
        $query = $this->db->prepare($sql);
        $query->execute();

        // fetchAll() é o método PDO que recebe todos os registros retornados, aqui em object-style porque definimos isso em
        // core/controller.php! Se preferir obter um array associativo como resultado, use
        // $query->fetchAll(PDO::FETCH_ASSOC); ou mude as opções em core/controller.php's PDO para
        // $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC ...
        return $query->fetchAll();
    }

    /**
     * Adicionar um Produto para o banco
     * @param string $descricao Descrição
     * @param string $unidade Unidade
     */
    public function add($request)
    {
        try {
            $this->db->beginTransaction();
    
            $sql = "INSERT INTO vendas (id_funcionario, id_cliente, total_venda, status_venda) 
                    VALUES (:id_vendedor,:id_cliente,:total_venda,:status_venda)";
            
            $query = $this->db->prepare($sql);
            $parameters = $this->setParamsVendas($request);
            $this->db->commit();
            
            $result = $query->execute($parameters);
            //echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();
            return array('success' => $result, 'id_vendas' => $this->db->lastInsertId());
        } catch (PDOException $e) {
            $this->db->rollback();
            // Handle the exception or log the error message
            // throw new Exception("Failed to add the record: " . $e->getMessage());
        }
    }

    function setParamsVendas($request){
        return  array(
         ':id_vendedor'    => $request['id_vendedor'],
         ':id_cliente'     => $request['id_cliente'], 
         ':total_venda'    => $request['total_venda'],
         ':status_venda'   => $request['status_venda'] );
    }

    public function addItens($request)
    {
        try{
            $this->db->beginTransaction();
            $sql = "INSERT INTO itens_venda (quantidade, id_venda, id_produto, valor_unit) VALUES (:quantidade, :id_venda, :id_produto, :valor_unit)";
            $query = $this->db->prepare($sql);
            $parameters = array(':quantidade' => $request['quantidade'], ':id_venda' => $request['id_venda'], ':id_produto' => $request['id_produto'], ':valor_unit' => $request['valor_unit'] );
        $this->db->commit();
        $result = $query->execute($parameters);
        //echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();
        return array('success' =>  $result ,
                     'id_vendas'=> $this->db->lastInsertId()
                    );
        }catch(PDOException $e){
            $this->db->rollback();
        }
    }

    /**
     * Excluir um Produto do banco de dados
     * Por favor note: este é apenas um exemplo! Em uma aplicação real, você não deixaria simplesmente ninguém excluir
     * add/update/delete equipe!
     * @param int $id_venda Id do Produto
     */
    public function delete($id_venda)
    {
        $sql = "DELETE FROM vendas WHERE id = :id_venda";
        $query = $this->db->prepare($sql);
        $parameters = array(':id_venda' => $id_venda);

        // útil para debugar: você pode ver o SQL atrás da construção usando:
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();

        $query->execute($parameters);
    }

    /**
     * Receber um Produto do banco
     * @param integer $produto_id
     */
    public function getProduto($id_venda)
    {
        $sql = "SELECT * FROM vendas v inner join itens_venda i on(i.id_vendas = v.id)
        inner join cliente c on(c.id = i.cliente_id)
        inner join funcionario f on(f.id = i.id_funcionario)
        inner join produtos p on(p.id = i.id_produto) WHERE id = :id_venda";
        $query = $this->db->prepare($sql);
        $parameters = array(':id_venda' => $id_venda);

        // útil para debugar: você pode ver o SQL atrás da construção usando:
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();

        $query->execute($parameters);

        // fetch() é o método do PDO que recebe exatamente um registro
        return ($query->rowcount() ? $query->fetch() : false);
    }

    /**
     * Atualizar um Produto no banco
     * @param string $quantidade Descrição
     * @param string $unidade Unidade
     * @param int $produto_id Id
     */
    public function update($quantidade, $unidade, $produto_id)
    {
        $sql = "UPDATE vendas SET quantidade = :quantidade, unidade = :unidade, valor = :valor WHERE id = :produto_id";
        $query = $this->db->prepare($sql);
        $parameters = array(':quantidade' => $quantidade, ':unidade' => $unidade, ':valor' => $valor, ':produto_id' => $produto_id);

        // útil para debugar: você pode ver o SQL atrás da construção usando:
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();

        $query->execute($parameters);
    }

    public function cancelar($venda_id)
    {
        $sql = "UPDATE vendas SET status = :status WHERE id = :$venda_id";
        $query = $this->db->prepare($sql);
        $parameters = array( ':status' => 'cancelado', ':$venda_id' => $venda_id);

        // útil para debugar: você pode ver o SQL atrás da construção usando:
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();

        $query->execute($parameters);
    }
    /**
     * Obtenha "estatísticas" simples. Esta é apenas uma demonstração simples para mostrar
     * como usar mais de um modelo em um controlador
     * (veja application/controller/vendas.php para detalhes)
     */
    public function getAmountOfVenda()
    {
        $sql = "SELECT COUNT(id) AS amount_of_vendas FROM vendas";
        $query = $this->db->prepare($sql);
        $query->execute();

        // fetch() é o método do PDO que recebe exatamente um registro
        return $query->fetch()->amount_of_vendas;
    }
}