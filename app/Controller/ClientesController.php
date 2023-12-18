<?php

/**
 * Classe ClientesController
 *
 */

namespace Mini\Controller;
use Mini\Controller\LoginController;
use Mini\Model\Cliente;
use Mini\Model\Endereco;
use Exception;
class ClientesController
{
    public function index()
    {
   
        LoginController::verificaLogin();
        $Cliente = new Cliente();
        $clientes = $Cliente->getAllClientes();
        $amount_of_clientes = $Cliente->getAmountOfClientes(); 

        require APP . 'view/_templates/header.php';
        require APP . 'view/clientes/index.php';
        require APP . 'view/_templates/footer.php';
    }

    function buscaClienteById($cliente_id){
        LoginController::verificaLogin();
           $Cliente = new Cliente();
           $clientes = $Cliente->getCliente($cliente_id);
           echo json_encode($clientes);
    }
    public function obterTodosClientesToCombox(){
        LoginController::verificaLogin();
        try {
            $Cliente = new Cliente();
            $clientes = $Cliente->getClienteCombobox();
            
            if($clientes){
                $data['data']= $clientes;
                $data['success']=true;
                $data['status']=200;
                echo json_encode($data);
                return true;
            }
            echo "";
            return;
        } catch (Exception $e) {
          die('error: ' . $e->getMessage());
        }
       }

    public function add()
    {
        LoginController::verificaLogin();
        if (isset($_POST["submit_add_cliente"])) {
            $Cliente = new Cliente();
            $Endereco = new Endereco();
            $result=$Cliente->add($_POST ["razao_social"], $_POST["email"], $_POST["nome_fantasia"], $_POST["cnpj"], $_POST["telefone"]);
           if($result==true){
            $resultendereco= $Endereco->add(
                           $_POST ["logradouro"], 
                           $_POST["numero"], 
                           $_POST["bairro"], 
                           $_POST["estado"], 
                           $_POST["municipio"], 
                           $_POST["pais"],
                           $_POST["cep"],
                           $result["id_cliente"]
                        );
           }
            header('location: ' . URL . 'clientes/index');
        }  
        
    }

    public function delete($cliente_id)
    {
        LoginController::verificaLogin();
        if (isset($cliente_id)) {
            $Cliente = new Cliente();
            $Cliente->delete($cliente_id);
        }
        header('location: ' . URL . 'clientes/index');
    }

    public function edit($cliente_id)
    {
        LoginController::verificaLogin();
        if (isset($cliente_id)) {
            $Cliente = new Cliente();
            $Endereco = new Endereco();
            $cliente = $Cliente->getCliente($cliente_id);
            $endereco = $Endereco->getEnderecocliente($cliente_id);
        
            if ($cliente === false) {
                $page = new \Mini\Controller\ErrorController();
                $page->index();
            } else {
                require APP . 'view/_templates/header.php';
                require APP . 'view/clientes/edit.php';
                require APP . 'view/_templates/footer.php';
            }
        } else {
            header('location: ' . URL . 'clientes/index');
        }
    }

    public function update()
    {
        LoginController::verificaLogin();
        if (isset($_POST["submit_update_cliente"])) {
            $Cliente = new Cliente();
            $Cliente->update($_POST);
            $Endereco = new Endereco();  
            $endereco = $Endereco->updateEnderecoByCliente($_POST);
        }
        header('location: ' . URL . 'clientes/index');
    }

    public function insert()
    {
        LoginController::verificaLogin();
                 require APP . 'view/_templates/header.php';
                 require APP . 'view/clientes/insert.php';
                 require APP . 'view/_templates/footer.php';
    }

    public function ajaxGetStats()
    {
        $Cliente = new Cliente();
        $amount_of_clientes = $Cliente->getAmountOfClientes();
        echo $amount_of_clientes;
    }

}
