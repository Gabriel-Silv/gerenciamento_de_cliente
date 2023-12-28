<?php

/**
 * Class Enderecos
 */

namespace Mini\Model;

use Mini\Core\Model;
use Exception;
use Mini\Libs\Helper;

class Endereco extends Model
{


    public $db;
    public $logradouro; 
    public $numero;
    public $bairro;
    public $estado; 
    public $Endereco_id;
    public $municipio;
    public $pais;
    public $cep;
   
    public function getAllEnderecos()
    {
        $sql = "SELECT * FROM Enderecos";
        $query = $this->db->prepare($sql);
        $query->execute();

        
        return $query->fetchAll();
    }

    
    public function add($logradouro, $numero, $bairro, $estado, $municipio, $pais, $cep,$id_cliente)
    {
     try{
        $this->db->beginTransaction();
        $sql = "INSERT INTO enderecos (logradouro, numero, bairro, estado, municipio, pais, cep,id_cliente) VALUES (:logradouro, :numero, :bairro, :estado, :municipio, :pais, :cep,:id_cliente)";
        $query = $this->db->prepare($sql);
        $parameters = array(':logradouro' => $logradouro, ':numero' => $numero, ':bairro' => $bairro, ':estado' => $estado, ':municipio' => $municipio, ':pais' => $pais, ':cep' => $cep,':id_cliente' => $id_cliente );
        
       $this->db->commit();
       return  $query->execute($parameters);
    }catch(PDOException $e){
        $this->db->rollback();
        var_dump($e->getMessage());
     }
  }

    
    public function delete($Endereco_id)
    {
        $sql = "DELETE FROM Enderecos WHERE id = :Endereco_id";
        $query = $this->db->prepare($sql);
        $parameters = array(':Endereco_id' => $Endereco_id);
        
        $query->execute($parameters);
    }
    
    public function getEndereco($cliente_id)
    {
        $sql = "SELECT id, nome, numero, data_nasc, estado FROM Enderecos WHERE id = :cliente_id LIMIT 1";
        $query = $this->db->prepare($sql);
        $parameters = array(':Endereco_id' => $cliente_id);

        

        $query->execute($parameters);

        
        return ($query->rowcount() ? $query->fetch() : false);
    }


    
    public function getEnderecoCliente($cliente_id)
    {
        $sql = "SELECT * FROM enderecos WHERE id_cliente = :cliente_id LIMIT 1";
        $query = $this->db->prepare($sql);
        $parameters = array(':cliente_id' => $cliente_id);


        $query->execute($parameters);

       
        return ($query->rowcount() ? $query->fetch() : false);
    }

    
    public function update($logradouro, $numero, $bairro, $estado, $Endereco_id, $municipio, $pais, $cep)
    {
        $sql = "UPDATE enderecos SET logradouro = :logradouro, numero = :numero, bairro = :bairro, estado = :estado, municipio = :municipio, pais = :pais, cep = :cep WHERE id = :Endereco_id";
        $query = $this->db->prepare($sql);
        $parameters = array(':logradouro' => $logradouro, ':numero' => $numero, ':bairro' => $bairro, 'estado' => $estado, ':Endereco_id' => $Endereco_id, 'municipio'=>$municipio, 'pais'=>$pais, 'cep'=>$cep);
        
        $query->execute($parameters);
    }

    public function updateEnderecoByCliente($resquestEndereco)
    {
        $sql = "UPDATE enderecos SET 
                logradouro = :logradouro, 
                numero     = :numero,  
                bairro     = :bairro, 
                estado     = :estado, 
                municipio  = :municipio, 
                pais       = :pais, 
                cep        = :cep 
                WHERE id_cliente   = :cliente_id";
        $query = $this->db->prepare($sql);

        $parameters = array(':logradouro'   => $resquestEndereco['logradouro'], 
                             ':numero'      => $resquestEndereco['numero'], 
                             ':bairro'      => $resquestEndereco['bairro'], 
                             ':estado'      => $resquestEndereco['estado'], 
                             ':cliente_id'  => $resquestEndereco['cliente_id'], 
                             ':municipio'    => $resquestEndereco['municipio'],
                             ':pais'        => $resquestEndereco['pais'], 
                             ':cep'         => $resquestEndereco['cep']
                            );

        $query->execute($parameters);
    }

   
    public function getAmountOfEnderecos()
    {
        $sql = "SELECT COUNT(id) AS amount_of_Enderecos FROM Enderecos";
        $query = $this->db->prepare($sql);
        $query->execute();
        
        return $query->fetch()->amount_of_Enderecos;
    }
}