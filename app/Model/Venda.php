<?php


namespace Mini\Model;

use Mini\Core\Model;
use PDOException;
use Mini\Libs\Helper;
class Venda extends Model
{

    public function getAllVenda()
    {
        $sql = "SELECT * FROM vendas v 
                inner join itens_venda i on(i.id_venda = v.id)
                inner join clientes c on(c.id = v.id_cliente)
                inner join funcionarios f on(f.id = v.id_funcionario)
                inner join produtos p on(p.id = i.id_produto)";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }

    public function relatorio($request)
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
            FROM vendas v "; 

    $sql .= " inner join itens_venda i on(i.id_venda = v.id)
            inner join clientes c on(c.id = v.id_cliente)
            inner join funcionarios f on(f.id = v.id_funcionario)
            inner join produtos p on(p.id = i.id_produto)";
   $sql .=  " where 1=1 ";
   $parameters = array();
   
   if (!empty($request['data_inicial']) && !empty($request['data_final'])) {

    $sql .= " AND v.data_venda BETWEEN :data_inicial AND :data_final";
    $parameters[':data_inicial'] = $request['data_inicial'];
    $parameters[':data_final'] = $request['data_final'];
   }

   if (isset($request['status']) &&(!empty($request['status']))) {
    $sql .= " AND v.status_venda = :status_venda";
    $parameters[':status_venda'] = $request['status'];
   }

   if (isset($request['vendedor']) &&(!empty($request['vendedor']))) {
    $sql .= " AND v.id_funcionario = :id_vendedor";
    $parameters[':id_vendedor'] = $request['vendedor'];
   }
  
   
   if (isset($request['cliente']) &&(!empty($request['cliente']))) {
    $sql .= " AND v.id_cliente = :id_cliente";
    
    $parameters[':id_cliente'] = $request['cliente'];
   }
   $sql .= " group by v.id,c.id order by i.id,c.id";
       
        $query = $this->db->prepare($sql);
        $query->execute($parameters);
        
        return $query->fetchAll();
    }
    

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
            
            return array('success' => $result, 'id_vendas' => $this->db->lastInsertId());
        } catch (PDOException $e) {
            $this->db->rollback();
           
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
        
        return array('success' =>  $result ,
                     'id_vendas'=> $this->db->lastInsertId()
                    );
        }catch(PDOException $e){
            $this->db->rollback();
        }
    }

    
    public function delete($id_venda)
    {
        $sql = "DELETE FROM vendas WHERE id = :id_venda";
        $query = $this->db->prepare($sql);
        $parameters = array(':id_venda' => $id_venda);

        

        $query->execute($parameters);
    }

    
    public function getProduto($id_venda)
    {
        $sql = "SELECT * FROM vendas v inner join itens_venda i on(i.id_vendas = v.id)
        inner join cliente c on(c.id = i.cliente_id)
        inner join funcionario f on(f.id = i.id_funcionario)
        inner join produtos p on(p.id = i.id_produto) WHERE id = :id_venda";
        $query = $this->db->prepare($sql);
        $parameters = array(':id_venda' => $id_venda);


        $query->execute($parameters);

        
        return ($query->rowcount() ? $query->fetch() : false);
    }

    
    public function update($quantidade, $unidade, $produto_id)
    {
        $sql = "UPDATE vendas SET quantidade = :quantidade, unidade = :unidade, valor = :valor WHERE id = :produto_id";
        $query = $this->db->prepare($sql);
        $parameters = array(':quantidade' => $quantidade, ':unidade' => $unidade, ':valor' => $valor, ':produto_id' => $produto_id);
        
        $query->execute($parameters);
    }

    public function cancelar($venda_id)
    {
        $sql = "UPDATE vendas SET status = :status WHERE id = :$venda_id";
        $query = $this->db->prepare($sql);
        $parameters = array( ':status' => 'cancelado', ':$venda_id' => $venda_id);

        

        $query->execute($parameters);
    }
    
    public function getAmountOfVenda($statusvendas = null)
    {
        $filter = ' ';
        $parameters = null;
        
        if($statusvendas != null){
            $filter = ' where status_venda = :statusVendas';
            $parameters = array(':statusVendas' => $statusvendas);
        }
        $sql = "SELECT COUNT(id) AS amount_of_vendas FROM vendas".$filter;
        $query = $this->db->prepare($sql);
        $query->execute($parameters);

        return $query->fetch()->amount_of_vendas;
    }
}