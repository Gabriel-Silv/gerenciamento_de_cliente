<?php


namespace Mini\Model;

use Mini\Core\Model;

class Produto extends Model
{
 
    public function getAllProdutos()
    {
        $sql = "SELECT id, descricao, unidade,valor,codigo FROM produtos";
        $query = $this->db->prepare($sql);
        $query->execute();
        
        return $query->fetchAll();
    }

    public function add($request)
    {
        try{
            $this->db->beginTransaction();
            $sql = "INSERT INTO produtos (descricao,  unidade, valor,codigo) VALUES (:descricao, :unidade, :valor,:valor)";
            $query = $this->db->prepare($sql);
            $parameters = array(':descricao' => $request['descricao'], 
            ':unidade' => $request['unidade'], 
            ':valor' => $request['valor'] ,
            ':codigo' => $request['codigo'] 
        );
        $this->db->commit();
        $result = $query->execute($parameters);
        
        return array('success' =>  $result ,
                     'id_produtos'=> $this->db->lastInsertId()
                    );
        }catch(PDOException $e){
            $this->db->rollback();
        }
    }

   
    public function delete($produto_id)
    {
        $sql = "DELETE FROM produtos WHERE id = :produto_id";
        $query = $this->db->prepare($sql);
        $parameters = array(':produto_id' => $produto_id);


        $query->execute($parameters);
    }

    public function getProduto($produto_id)
    {
        $sql = "SELECT id, descricao, unidade, valor,codigo FROM produtos WHERE id = :produto_id LIMIT 1";
        $query = $this->db->prepare($sql);
        $parameters = array(':produto_id' => $produto_id);
        
        $query->execute($parameters);
       
        return ($query->rowcount() ? $query->fetch() : false);
    }

    public function getProdutoPorcodigo($codigo)
    {
        $sql = "SELECT id, descricao, unidade, valor,codigo FROM produtos WHERE id = :produto_id LIMIT 1";
        $query = $this->db->prepare($sql);
        $parameters = array(':codigo' => $codigo);
        
        $query->execute($parameters);
        
        return ($query->rowcount() ? $query->fetch() : false);
    }

    
    public function update($descricao, $unidade,$valor,$codigo,$produto_id)
    {
        $sql = "UPDATE produtos SET descricao = :descricao, unidade = :unidade, valor = :valor,codigo = :codigo WHERE id = :produto_id";
        $query = $this->db->prepare($sql);
        $parameters = array(
                ':descricao' => $descricao, 
                ':unidade' => $unidade, 
                ':valor' => $valor, 
                ':produto_id' => $produto_id,
                ':codigo' => $codigo
            );

        

        $query->execute($parameters);
    }

    
    public function getAmountOfProdutos()
    {
        $sql = "SELECT COUNT(id) AS amount_of_produtos FROM produtos";
        $query = $this->db->prepare($sql);
        $query->execute();

        
        return $query->fetch()->amount_of_produtos;
    }
}
