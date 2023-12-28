<?php

/**
 * Class Funcionarios
 */

namespace Mini\Model;

use Mini\Core\Model;
use Exception;
use Mini\Libs\Helper;
class Funcionario extends Model
{
    
    public function getAllFuncionarios()
    {
        $sql = "SELECT * FROM funcionarios";
        $query = $this->db->prepare($sql);
        $query->execute();
        
        return $query->fetchAll();
    }
    
    public function add($request)
    {
       try{
        $this->db->beginTransaction();
        
        $resultUsuario=$this->createUsuario($request);
        $request['id_usuario']=$resultUsuario['id_usuario'];
        $parameters = $this->setRequestParams($request);
      
        

        $sql = "INSERT INTO funcionarios (nome,cpf,telefone,perfil,email,id_usuario) VALUES (:nome,:cpf,:telefone,:perfil,:email,:id_usuario)";
        $query = $this->db->prepare($sql);
        $result = $query->execute($parameters);
        $this->db->commit();
        
        return $result;
      }catch(Exception $e){
        var_dump($e);
        die('aqui');
        $this->db->rollback();
     }
   }
    
    public function delete($funcionario_id)
    {
        $sql = "DELETE FROM funcionarios WHERE id = :funcionario_id";
        $query = $this->db->prepare($sql);
        $parameters = array(':funcionario_id' => $funcionario_id);
        
        $query->execute($parameters);
    }
    
    public function getFuncionario($funcionario_id)
    {
        $sql = "SELECT * FROM funcionarios 
        inner join usuario on usuario.id = funcionarios.id_usuario
        WHERE funcionarios.id = :funcionario_id LIMIT 1";
        $query = $this->db->prepare($sql);
        $parameters = array('funcionario_id' => $funcionario_id);
        
        $query->execute($parameters);
        
        return ($query->rowcount() ? $query->fetch() : false);
    }
    public function getFuncionarioCombobox()
    {
        $sql = "SELECT id,nome FROM funcionarios where perfil =:vendedor";
        $parameters = array('vendedor' => 'vendedor');
        $query = $this->db->prepare($sql);
        $query->execute($parameters);
        return ($query->rowcount() ? $query->fetchAll() : false);
    }


    
    public function update($request)
    {
       
        $sql = "UPDATE funcionarios SET nome = :nome,cpf = :cpf, telefone = :telefone,perfil = :perfil,email = :email WHERE id_usuario = :id_usuario";
        $query = $this->db->prepare($sql);
        $parameters = $this->setRequestParams($request);
        
        $query->execute($parameters);
    }

    public function getAmountOfFuncionarios()
    {
        $sql = "SELECT COUNT(id) AS amount_of_funcionarios FROM funcionarios";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetch()->amount_of_funcionarios;
    }
    public function setRequestParams($request)
    {
        return array(
            ':nome' => @$request['nome'],
            ':cpf' => $request['cpf'],
            ':telefone' => $request['telefone'],
            ':perfil' => $request['perfil'],
            ':email' => $request['email'],
            ':id_usuario' => intval($request['id_usuario']),
        );

    }

    public function setRequestParamsUsuario($request)
    {
        return array(
            ":nome" => $request['nome'],
            ':login' => $request['email'],
            ':perfil' => $request['perfil'],
            ':email' => $request['email'],
            ':password' => md5($request['password']),
            ':status' => true,
            ':url_foto' => $request['url_foto'],
        );
    }
    public function createUsuario($request)
    {
      try{
        $sql = "INSERT INTO usuario (nome,login,perfil,email,password,status,url_foto) VALUES (:nome,:login,:perfil,:email,:password,:status,:url_foto)";
        $query = $this->db->prepare($sql);
        $parameters = $this->setRequestParamsUsuario($request);
        $result = $query->execute($parameters);
        if ($result) {
            return array(
                'success' => $result,
                'id_usuario' => $this->db->lastInsertId(),
            );
        }
        }catch(Exception $e){
            return array(
                'success' => false,
                'error' => $e->getMessage(),
            );
        }
        

    }
}