<?php

/**
 * Classe ProdutosController
 *
 */

namespace Mini\Controller;
use Mini\Controller\LoginController;
use Mini\Model\Produto;
use Exception;
class ProdutosController
{
    public function index()
    {
        LoginController::verificaLogin();

        $Produto = new Produto();

        $produtos = $Produto->getAllProdutos();
        $amount_of_produtos = $Produto->getAmountOfProdutos();

        require APP . 'view/_templates/header.php';
        require APP . 'view/produtos/index.php';
        require APP . 'view/_templates/footer.php';
    }



    public function getProdutoPorcodigo($codigo){
        LoginController::verificaLogin();
        try {
            $Produto = new Produto();
            $produtos = $Produto->getProduto($codigo);
            if($produtos){
                $data['data']= $produtos;
                echo json_encode($data);
                return;
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
        
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
        if (isset($_POST["submit_add_produto"])) {
            
            $Produto = new Produto();
            
            $result = $Produto->add($_POST);
        }

        header('location: ' . URL . 'produtos/index');
    }

   
    public function delete($produto_id)
    {
        LoginController::verificaLogin();
  
        if (isset($produto_id)) {
 
            $Produto = new Produto();

            $Produto->delete($produto_id);
        }


        header('location: ' . URL . 'produtos/index');
    }

   
    public function edit($produto_id)
    {
        LoginController::verificaLogin();

        if (isset($produto_id)) {

            $Produto = new Produto();

            $produto = $Produto->getProduto($produto_id);

            if ($produto === false) {
                $page = new \Mini\Controller\ErrorController();
                $page->index();
            } else {
                
                require APP . 'view/_templates/header.php';
                require APP . 'view/produtos/edit.php';
                require APP . 'view/_templates/footer.php';
            }
        } else {

            header('location: ' . URL . 'produtos/index');
        }
    }

    public function insert()
    {
        LoginController::verificaLogin();
                 
                 require APP . 'view/_templates/header.php';
                 require APP . 'view/produtos/insert.php';
                 require APP . 'view/_templates/footer.php';
    }

  
    public function update()
    {
        LoginController::verificaLogin();
       
        if (isset($_POST["submit_update_produto"])) {
            
            $Produto = new Produto();
            
            $Produto->update($_POST["descricao"], $_POST["unidade"],$_POST["codigo"], $_POST['produto_id']);
        }

        
        header('location: ' . URL . 'produtos/index');
    }

    
    public function ajaxGetStats()
    {
        
        $Produto = new Produto();
        $amount_of_produtos = $Produto->getAmountOfProdutos();
        
        echo $amount_of_produtos;
    }

}
