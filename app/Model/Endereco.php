<?php

/**
 * Class Enderecos
 */

namespace Mini\Model;

use Mini\Core\Model;

class Endereco extends Model
{
    /**
     * Get all Enderecos from database
     */

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

        // fetchAll() é o método PDO que recebe todos os registros retornados, aqui em object-style porque definimos isso em
        // core/controller.php! Se preferir obter um array associativo como resultado, use
        // $query->fetchAll(PDO::FETCH_ASSOC); ou mude as opções em core/controller.php's PDO para
        // $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC ...
        return $query->fetchAll();
    }

    /**
     * Adicionar um Endereco para o banco
     * @param string $nome Nome
     * @param string $numero E-mail
     * @param string $data_nasc Nascimento
     * @param string $estado estado
     */
    public function add($logradouro, $numero, $bairro, $estado, $municipio, $pais, $cep)
    {
        $sql = "INSERT INTO Enderecos (logradouro, numero, bairro, estado, municipio) VALUES (:logradouro, :numero, :bairro, :estado, :municipio, :pais, :cep)";
        $query = $this->db->prepare($sql);
        $parameters = array(':logradouro' => $logradouro, ':numero' => $numero, ':bairro' => $bairro, ':estado' => $estado, ':municipio' => $municipio, ':pais' => $pais, ':cep' => $cep );
        

        // útil para debugar: você pode ver o SQL atrás da construção usando:
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();

        $query->execute($parameters);
    }

    /**
     * Excluir um Endereco do banco de dados
     * Por favor note: este é apenas um exemplo! Em uma aplicação real, você não deixaria simplesmente ninguém excluir
     * add/update/delete equipe!
     * @param int $Endereco_id Id do Endereco
     */
    public function delete($Endereco_id)
    {
        $sql = "DELETE FROM Enderecos WHERE id = :Endereco_id";
        $query = $this->db->prepare($sql);
        $parameters = array(':Endereco_id' => $Endereco_id);

        // útil para debugar: você pode ver o SQL atrás da construção usando:
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();

        $query->execute($parameters);
    }

    /**
     * Receber um Endereco do banco
     * @param integer $Endereco_id
     */
    public function getEndereco($cliente_id)
    {
        $sql = "SELECT id, nome, numero, data_nasc, estado FROM Enderecos WHERE id = :cliente_id LIMIT 1";
        $query = $this->db->prepare($sql);
        $parameters = array(':Endereco_id' => $cliente_id);

        // útil para debugar: você pode ver o SQL atrás da construção usando:
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();

        $query->execute($parameters);

        // fetch() é o método do PDO que recebe exatamente um registro
        return ($query->rowcount() ? $query->fetch() : false);
    }

    /**
     * Atualizar um Endereco no banco
     * @param string $nome Nome
     * @param string $numero E-mail
     * @param string $data_nasc Nascimento
     * @param string $estado estado
     * @param int $Endereco_id Id
     */
    public function update($logradouro, $numero, $bairro, $estado, $Endereco_id, $municipio, $pais, $cep)
    {
        $sql = "UPDATE Enderecos SET logradouro = :logradouro, numero = :numero, bairro = :bairro, estado = :estado, municipio = :municipio, pais = :pais, cep = :cep WHERE id = :Endereco_id";
        $query = $this->db->prepare($sql);
        $parameters = array(':logradouro' => $logradouro, ':numero' => $numero, ':bairro' => $bairro, 'estado' => $estado, ':Endereco_id' => $Endereco_id, 'municipio'=>$municipio, 'pais'=>$pais, 'cep'=>$cep);

    
        // útil para debugar: você pode ver o SQL atrás da construção usando:
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();

        $query->execute($parameters);
    }

    /**
     * Obtenha "estatísticas" simples. Esta é apenas uma demonstração simples para mostrar
     * como usar mais de um modelo em um controlador
     * (veja application/controller/Enderecos.php para detalhes)
     */
    public function getAmountOfEnderecos()
    {
        $sql = "SELECT COUNT(id) AS amount_of_Enderecos FROM Enderecos";
        $query = $this->db->prepare($sql);
        $query->execute();

        // fetch() é o método do PDO que recebe exatamente um registro
        return $query->fetch()->amount_of_Enderecos;
    }
}
