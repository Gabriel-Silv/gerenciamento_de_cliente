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
    /**
     * Get all funcionarios from database
     */
    public function getAllFuncionarios()
    {
        $sql = "SELECT * FROM funcionarios";
        $query = $this->db->prepare($sql);
        $query->execute();
        // fetchAll() é o método PDO que recebe todos os registros retornados, aqui em object-style porque definimos isso em
        // core/controller.php! Se preferir obter um array associativo como resultado, use
        // $query->fetchAll(PDO::FETCH_ASSOC); ou mude as opções em core/controller.php's PDO para
        // $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC ...
        return $query->fetchAll();
    }
    /**
     * Adicionar um funcionario para o banco
     * @param string $nome Nome
     * @param string $cpf CPF
     * @param string $obs Observação
     */
    public function add($request)
    {
       try{
        $this->db->beginTransaction();
        $sql = "INSERT INTO funcionarios (nome,cpf,telefone,perfil,email,id_usuario) VALUES (:nome,:cpf,:telefone,:perfil,:email,:id_usuario)";
        $query = $this->db->prepare($sql);
        //cria um usuário para vincular a um funcionário
        $resultUsuario=$this->createUsuario($request);
        $request['id_usuario']=$resultUsuario['id_usuario'];
        $parameters = $this->setRequestParams($request);
        // útil para debugar: você pode ver o SQL atrás da construção usando:
        //echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();
        $result = $query->execute($parameters);
        $this->db->commit();
        return $result;
      }catch(PDOException $e){
        $this->db->rollback();
     }
   }
    /**
     * Excluir um funcionario do banco de dados
     * Por favor note: este é apenas um exemplo! Em uma aplicação real, você não deixaria simplesmente ninguém excluir
     * add/update/delete equipe!
     * @param int $funcionario_id Id do Funcionario
     */
    public function delete($funcionario_id)
    {
        $sql = "DELETE FROM funcionarios WHERE id = :funcionario_id";
        $query = $this->db->prepare($sql);
        $parameters = array(':funcionario_id' => $funcionario_id);
        // útil para debugar: você pode ver o SQL atrás da construção usando:
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();
        $query->execute($parameters);
    }
    /**
     * Receber um Funcionario do banco
     * @param integer $funcionario_id
     */
    public function getFuncionario($funcionario_id)
    {
        $sql = "SELECT * FROM funcionarios 
        inner join usuario on usuario.id = 
        funcionarios.id_usuario
        WHERE funcionarios.id = :funcionario_id LIMIT 1";
        $query = $this->db->prepare($sql);
        $parameters = array('funcionario_id' => $funcionario_id);
        // útil para debugar: você pode ver o SQL atrás da construção usando:
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();
        $query->execute($parameters);
        // fetch() é o método do PDO que recebe exatamente um registro
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


    /**
     * Atualizar um Funcionario no banco
     * @param string $nome Nome
     * @param string $cpf CPF
     * @param string $obs Observação
     * @param int $funcionario_id Id
     */
    public function update($request)
    {
        $sql = "UPDATE funcionarios SET nome = :nome, cpf = :cpf, obs = :obs,perfil = :perfil WHERE id = :funcionario_id";
        $query = $this->db->prepare($sql);
        $parameters = $this->setRequestParams($request);
        // útil para debugar: você pode ver o SQL atrás da construção usando:
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();
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
            ':url_foto' => $request['url_foto'],
        );
    }

    public function createUsuario($request)
    {
      try{
 
       
        $sql = "INSERT INTO usuario (login,perfil,email,password,status,url_foto) VALUES (:login,:perfil,:email,:password,:status,:url_foto)";
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

        // útil para debugar: você pode ver o SQL atrás da construção usando:
         echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();

    }
}