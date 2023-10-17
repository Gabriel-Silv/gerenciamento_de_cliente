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

        // fetchAll() é o método PDO que recebe todos os registros retornados, aqui em object-style porque definimos isso em
        // core/controller.php! Se preferir obter um array associativo como resultado, use
        // $query->fetchAll(PDO::FETCH_ASSOC); ou mude as opções em core/controller.php's PDO para
        // $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC ...
        return $query->fetchAll();
    }

    /**
     * Adicionar um cliente para o banco
     * @param string $nome Nome
     * @param string $email E-mail
     * @param string $data_nasc Nascimento
     * @param string $cnpj cnpj
     */
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
    /**
     * Excluir um cliente do banco de dados
     * Por favor note: este é apenas um exemplo! Em uma aplicação real, você não deixaria simplesmente ninguém excluir
     * add/update/delete equipe!
     * @param int $cliente_id Id do cliente
     */
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
        //echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();
        $query->execute($parameters);
    }
    /**
     * Receber um buscarEnderecoCepApi cliente do banco
     * @param integer $cliente_id
     */
    public function getCliente($cliente_id)
    {
        $sql = "SELECT * FROM clientes WHERE id = :cliente_id LIMIT 1";
        $query = $this->db->prepare($sql);
        $parameters = array(':cliente_id' => $cliente_id);
        $query->execute($parameters);
        // fetch() é o método do PDO que recebe exatamente um registro
        return ($query->rowcount() ? $query->fetch() : false);
    }
    /**
     * Atualizar um cliente no banco
     * @param string $nome Nome
     * @param string $email E-mail
     * @param string $data_nasc Nascimento
     * @param string $cnpj cnpj
     * @param int $cliente_id Id
     */
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
        // útil para debugar: você pode ver o SQL atrás da construção usando:
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();
      return   $query->execute($parameters);
    }

    /**
     * Obtenha "estatísticas" simples. Esta é apenas uma demonstração simples para mostrar
     * como usar mais de um modelo em um controlador
     * (veja application/controller/clientes.php para detalhes)
     */
    public function getAmountOfClientes()
    {
        $sql = "SELECT COUNT(id) AS amount_of_clientes FROM clientes";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetch()->amount_of_clientes;
    }
}