<?php

/**
 * Class Clientes
 */

namespace Mini\Model;

use Mini\Core\Model;
use Mini\Libs\Helper;

class Cliente extends Model
{
    /**
     * Get all clientes from database
     */
   
    public $razao_social; 
    public $email;
    public $nome_fantasia;
    public $cnpj; 
    public $cliente_id;
    public $telefone;

    public function getAllClientes()
    {
        $sql = "SELECT * FROM clientes";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }

    public function getClienteCombobox()
    {
        $sql = "SELECT id,razao_social FROM clientes ";
        $query = $this->db->prepare($sql);
        $query->execute();
        return ($query->rowcount() ? $query->fetchAll() : false);
    }

    
    public function add($razao_social, $email, $nome_fantasia, $cnpj, $telefone)
    {
        try{
            $this->db->beginTransaction();
            $sql = "INSERT INTO clientes (razao_social, email, nome_fantasia, cnpj, telefone) VALUES (:razao_social, :email, :nome_fantasia, :cnpj, :telefone)";
            $query = $this->db->prepare($sql);
            $parameters = array(':razao_social' => $razao_social, ':email' => $email, ':nome_fantasia' => $nome_fantasia, ':cnpj' => $cnpj, ':telefone' => $telefone );
        $this->db->commit();
        return array('success' =>  $query->execute($parameters),
                     'id_cliente'=> $this->db->lastInsertId()
                    );
        }catch(PDOException $e){
            $this->db->rollback();
        }
    }
    
    public function delete($cliente_id)
    {
       $result = $this->deleteEnderecoCliente($cliente_id);
        $sql = "DELETE FROM clientes WHERE id = :cliente_id";
        $query = $this->db->prepare($sql);
        $parameters = array(':cliente_id' => $cliente_id);
        $query->execute($parameters);
    }

    public function deleteEnderecoCliente($cliente_id)
    {
        $sql = "DELETE FROM enderecos WHERE id_cliente = :cliente_id";
        $query = $this->db->prepare($sql);
        $parameters = array(':cliente_id' => $cliente_id);
        
        $query->execute($parameters);
    }
    
    public function getCliente($cliente_id)
    {
        $sql = "SELECT * FROM clientes WHERE id = :cliente_id LIMIT 1";
        $query = $this->db->prepare($sql);
        $parameters = array(':cliente_id' => $cliente_id);
        $query->execute($parameters);
        
        return ($query->rowcount() ? $query->fetch() : false);
    }
    
    public function update($request)
    {
        $sql =  "UPDATE clientes 
                 SET razao_social = :razao_social, 
                 email = :email, 
                 nome_fantasia = :nome_fantasia, 
                 cnpj = :cnpj, 
                 telefone = :telefone 
                 WHERE id = :cliente_id";
        $query = $this->db->prepare($sql);
        $parameters = array(':razao_social'   => $request['razao_social'], 
                             ':email'         => $request['email'], 
                             ':nome_fantasia' => $request['nome_fantasia'], 
                             ':cnpj'          => $request['cnpj'], 
                             ':cliente_id'    => $request['cliente_id'], 
                             ':telefone'      => $request['telefone']
                            );
        
      return   $query->execute($parameters);
    }

    
    public function getAmountOfClientes()
    {
        $sql = "SELECT COUNT(id) AS amount_of_clientes FROM clientes";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetch()->amount_of_clientes;
    }
}