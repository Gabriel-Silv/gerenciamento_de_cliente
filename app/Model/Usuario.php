<?php

/**
 * Class Usuarios
 */

namespace Mini\Model;

use Mini\Core\Model;
use Exception;
use Mini\Libs\Helper;
class Usuario extends Model
{

    public function getAllUsuarios()
    {
        $sql = "SELECT * FROM usuarios";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }

    public function add($request)
    {
       try{
        $this->db->beginTransaction();
        $sql = "INSERT INTO usuarios (nome,cpf,telefone,perfil,email,id_usuario) VALUES (:nome,:cpf,:telefone,:perfil,:email,:id_usuario)";
        $query = $this->db->prepare($sql);
        
        $resultUsuario=$this->createUsuario($request);
        $request['id_usuario']=$resultUsuario['id_usuario'];
        $parameters = $this->setRequestParams($request);
        
        
        $result = $query->execute($parameters);
        $this->db->commit();
        return $result;
      }catch(PDOException $e){
        $this->db->rollback();
     }
   }
    
    public function delete($usuario_id)
    {
        $sql = "DELETE FROM usuarios WHERE id = :usuario_id";
        $query = $this->db->prepare($sql);
        $parameters = array(':usuario_id' => $usuario_id);
        
        
        $query->execute($parameters);
    }
    
    public function getUsuario($usuario_id)
    {
        $sql = "SELECT * FROM usuario WHERE id = :usuario_id LIMIT 1";
        $query = $this->db->prepare($sql);
        $parameters = array('usuario_id' => $usuario_id);
        
        
        $query->execute($parameters);
        
        return ($query->rowcount() ? $query->fetch() : false);
    }

    public function login($email, $password)
    {
        $sql = "SELECT * FROM usuario WHERE email = :email and password = :password LIMIT 1";
        $query = $this->db->prepare($sql);
        $parameters = array('email' => $email, 'password' => md5($password) );
        
        
        $query->execute($parameters);
        
        return ($query->rowcount() ? $query->fetch() : false);
    }

    public function getUsuarioCombobox()
    {
        $sql = "SELECT id,nome FROM usuarios where perfil =:vendedor";
        $parameters = array('vendedor' => 'vendedor');
        $query = $this->db->prepare($sql);
        $query->execute($parameters);
        return ($query->rowcount() ? $query->fetchAll() : false);
    }

    public function update($request)
    {
        $sql = "UPDATE usuarios SET nome = :nome, cpf = :cpf, obs = :obs,perfil = :perfil WHERE id = :usuario_id";
        $query = $this->db->prepare($sql);
        $parameters = $this->setRequestParams($request);
        
        
        $query->execute($parameters);
    }

    public function getAmountOfUsuarios()
    {
        $sql = "SELECT COUNT(id) AS amount_of_usuarios FROM usuarios";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetch()->amount_of_usuarios;
    }
    public function setRequestParams($request)
    {
        return array(
            ':nome' => $request['nome'],
            ':cpf' => $request['cpf'],
            ':telefone' => $request['telefone'],
            ':perfil' => $request['perfil'],
            ':email' => $request['email'],
            ':id_usuario' => $request['id_usuario'],
        );

    }

    public function setRequestParamsUsuario($request)
    {
        return array(
            ':login' => $request['email'],
            ':perfil' => $request['perfil'],
            ':email' => $request['email'],
            ':password' => md5($request['password']),
            ':status' => true,
        );
    }

    public function createUsuario($request)
    {
      try{
        $sql = "INSERT INTO usuario (login,perfil,email,password,status) VALUES (:login,:perfil,:email,:password,:status)";
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