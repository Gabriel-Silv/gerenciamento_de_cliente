<?php

/**
 * Classe vendaController
 *
 */ 

namespace Mini\Controller;

use Dompdf\Dompdf;
use Mini\Model\Funcionario;
use Mini\Model\Venda;
use Mini\Model\ItensVenda;
use Mini\Controller\LoginController;
use PDO;
class VendaController
{
    
    public function index()
    {
        LoginController::verificaLogin();
        
        $Venda = new Venda();
        $Usuario = new Funcionario();
        
        $vendas = $Venda->getAllvenda();
        $amount_of_venda_concluida = $Venda->getAmountOfvenda('concluida');
        $amount_of_venda_pendente = $Venda->getAmountOfvenda('pendente');
        $amount_of_venda_cancelada = $Venda->getAmountOfvenda('cancelada');
        $amount_of_funcionario = $Usuario->getAmountOfFuncionarios();
        
       
        require APP . 'view/_templates/header.php';
        require APP . 'view/venda/index.php';
        require APP . 'view/_templates/footer.php';
    }

    public function cancelar($id){
        $Venda = new Venda();
        $venda = $Vanda->cancelar($id);
        header('location: ' . URL . 'venda/index');
    }

    public function add()
    {
        LoginController::verificaLogin();
        
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        $Venda = new Venda();
        $result = $Venda->add($_POST);
        header('location: ' . URL . 'venda/insert');
    }

    public function relatorioVendas(){
        LoginController::verificaLogin();
       
        $dompdf = new Dompdf();
        if (isset($_POST["geraPdf"])) {
            
        $dompdf->loadHtml($_POST["html"]);
            
           $dompdf->setPaper('A4', 'landscape');
            
           $dompdf->render();
           file_put_contents('relatorioVendas.pdf', $dompdf->output());
            
           
           header("Location:/relatorioVendas.pdf");
        }
        
        $Venda = new Venda();
        
        $vendas = $Venda->relatorio($_POST);
        require APP . 'view/_templates/header.php';
        require APP . 'view/venda/relatorio_vendas.php';
        require APP . 'view/_templates/footer.php';
    }

    public function conteVendapendente($statusVenda){
       
       $Venda = new venda();
       $statusVenda = $_POST['statusVenda'];
       $amount_of_venda = $Venda->getAmountOfvenda($statusVenda);
       
       echo $amount_of_venda;
    }

    public function filterRelatorioVendas(){
        LoginController::verificaLogin();
        
        $Venda = new Venda();
        
        $vendas = $Venda->relatorio($_POST);

        require APP . 'view/_templates/header.php';
        require APP . 'view/venda/filter_relatorio.php';
        require APP . 'view/_templates/footer.php';
    }

   
     public function finalizarVenda(){
        LoginController::verificaLogin();
        try{

        $dadosVendasRequest=json_decode($_POST['dados_venda'],1);
        $itensVendasRequest=json_decode($_POST['itens_venda'],1);
        $dadosVendasRequest=$this->getDadosVendas($dadosVendasRequest);
        $dadosVendasRequest['total_venda'] =$this->calcuclaTotal($itensVendasRequest);
      
        if(isset($dadosVendasRequest)){
            $Venda = new Venda();
            $result=$Venda->add($dadosVendasRequest); 
            $itensVendasRequest['id_venda']=$result['id_vendas'];
            if($result['success']==true){
                $this->saveIntensVenda($itensVendasRequest);
            }
            $this->db->commit();
            echo json_encode(["status"=>"sucesss"]);
            header('location: ' . URL .'venda/insert');  
        }
    } catch(Exception $e){
        echo json_encode(["status"=>"error"]);
    }
  }
     public function delete($venda_id)
    {
        LoginController::verificaLogin();
        if (isset($venda_id)) {
            $Venda = new Venda();
            $Venda->delete($venda_id);
        }
        header('location: ' . URL . 'venda/index');
    }

    public function edit($venda_id)
    {
        LoginController::verificaLogin();
       
        if (isset($venda_id)) {
            
            $Venda = new Venda();
            
            $Venda = $Venda->getVenda($venda_id);

 
            if ($Venda === false) {
                $page = new \Mini\Controller\ErrorController();
                $page->index();
            } else {

                require APP . 'view/_templates/header.php';
                require APP . 'view/venda/edit.php';
                require APP . 'view/_templates/footer.php';
            }
        } else {

            header('location: ' . URL . 'venda/index');
        }
    }
    public function insert()
    {
        LoginController::verificaLogin();

                 require APP . 'view/_templates/header.php';
                 require APP . 'view/venda/insert.php';
                 require APP . 'view/_templates/footer.php';
    }
    
    public function update()
    {
        LoginController::verificaLogin();
       
        if (isset($_POST["submit_update_Venda"])) {
           
            $Venda = new Venda();
            
            $Venda->update($_POST["descricao"], $_POST["unidade"], $_POST['venda_id']);
        }
        
        header('location: ' . URL . 'venda/index');
    }
   
    public function ajaxGetStats()
    {
        LoginController::verificaLogin();
        
        $Venda = new venda();
        $amount_of_venda = $Venda->getAmountOfvenda();
        
        echo $amount_of_venda;
    }
    public function saveIntensVenda($itensVenda) {
        LoginController::verificaLogin();
        foreach ($itensVenda as $item) {
          $itemVenda = new ItensVenda();
          $item['id_venda']=$itensVenda['id_venda'];
          $item['valor']=$this->convertToDouble($item['valor']);
          $itemVenda->add($item);
        }
        $response = array('status' => 'success');
        return json_encode($response);
      }
      function getDadosVendas($dadosVendas) {
        LoginController::verificaLogin();
        $dadosVendas['id_cliente'] = $dadosVendas[0]['cliente'];
        $dadosVendas['id_vendedor'] = $dadosVendas[0]['vendedor'];
        $dadosVendas['status_venda']='finalizada';
        return $dadosVendas;
    }
  function calcuclaTotal($itensVendas){
    $total = 0;
    foreach ($itensVendas as $item) {
     if ($item){
      $total +=$this->convertToDouble($item['valor_total']);
    }
   }
    return $total;
  }
  function convertToDouble($value) {
    $pattern = '/[^\d.,]+/'; 
    $valueWithoutCurrency = preg_replace($pattern, '', $value);
    $doubleValue = doubleval(str_replace(',', '.', $valueWithoutCurrency));
    return $doubleValue;
  }
}