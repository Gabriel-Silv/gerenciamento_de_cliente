<?php

/**
 * Classe vendaController
 *
 */ 

namespace Mini\Controller;

use Dompdf\Dompdf;
use Mini\Model\Venda;
use Mini\Model\ItensVenda;
use PDO;
class VendaController
{
    /**
     * Action: index
     * Este método manipula o que acontece quando acessa http://localhost/venda/index
     */
    public function index()
    {
        // Instanciar novo Model (Venda)
        $Venda = new Venda();
        // receber todos os venda e a quantidade de venda
        $vendas = $Venda->getAllvenda();
        $amount_of_venda = $Venda->getAmountOfvenda();
       // carregar a view venda. com as views nós podemos mostrar os $venda e a $amount_of_venda facilmente
        require APP . 'view/_templates/header.php';
        require APP . 'view/venda/index.php';
        require APP . 'view/_templates/footer.php';
    }

    public function cancelar($id){
        $Venda = new Venda();
        $venda = $Vanda->cancelar($id);
        header('location: ' . URL . 'venda/index');
    }
    /**
     * ACTION: add
     * Este método manipula o que acontece quando acessamos http://localhost/projeto/venda/add
     * IMPORTANTE: Isto não é uma página normal, isto é um ACTION. Isto é onde está o form "adicionar um Venda" em venda/index
     * direciona o usuário após o envio do formulário. Esse método manipula todos os dados POST do formulário e, em seguida, redireciona
     * o usuário de volta para venda/index através da última linha: header(...)
     * Este é um exemplo de como lidar com uma solicitação POST.
     */
    public function add()
    {
        // se tivermos dados POST para criar uma nova entrada do Venda
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        $Venda = new Venda();
        $result = $Venda->add($_POST);
        header('location: ' . URL . 'venda/insert');
    }

    public function relatorioVendas(){
        $dompdf = new Dompdf();



        if (isset($_POST["submit_update_Venda"])) {
            //lendo o arquivo HTML correspondente
            
            $html = file_get_contents('exemplo.html');
            
            //inserindo o HTML que queremos converter

            $dompdf->loadHtml($html);

            // Definindo o papel e a orientação

            $dompdf->setPaper('A4', 'landscape');

            // Renderizando o HTML como PDF

            $dompdf->render();

            // Enviando o PDF para o browser

            $dompdf->stream();
         
        }
        // Instanciar novo Model (Venda)
        $Venda = new Venda();
        // receber todos os venda e a quantidade de venda
        $vendas = $Venda->relatorio($_POST);

        require APP . 'view/venda/relatorio_vendas.php';
    }

    public function filterRelatorioVendas(){

        require APP . 'view/_templates/header.php';
        require APP . 'view/venda/filter_relatorio.php';
        require APP . 'view/_templates/footer.php';
    }

    /**
     * ACTION: delete
     * Este método lida com o que acontece quando você se move para http://localhost/venda/delete
     * IMPORTANTE: Esta não é uma página normal, é uma ACTION. Isto é onde o botãoe "excluir um Venda" em venda/index
     * direciona o usuário após o clique. Este método trata de todos os dados da requisição GET (na URL!) E depois
     * redireciona o usuário de volta para venda/index através da última linha: header(...)
     * Este é um exemplo de como lidar com uma solicitação GET.
     * @param int $venda_id Id do Venda para excluir
     */
   
     public function finalizarVenda(){
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
        if (isset($venda_id)) {
            $Venda = new Venda();
            $Venda->delete($venda_id);
        }
        header('location: ' . URL . 'venda/index');
    }
     /**
     * ACTION: edit
     * Este método lida com o que acontece quando você se move para http://localhost/projeto/venda/edit
     * @param int $venda_id Id do Venda a editar
     */
    public function edit($venda_id)
    {
        // se temos um id de um Venda que deve ser editado
        if (isset($venda_id)) {
            // Instanciar novo Model (Venda)
            $Venda = new Venda();
            // fazer getVenda() em Model/Model.php
            $Venda = $Venda->getVenda($venda_id);

            // Se o Venda não foi encontrado, então ele teria retornado falso, e precisamos exibir a página de erro
            if ($Venda === false) {
                $page = new \Mini\Controller\ErrorController();
                $page->index();
            } else {
                // carregar a view venda. nas views nós podemos mostrar $Venda facilmente
                require APP . 'view/_templates/header.php';
                require APP . 'view/venda/edit.php';
                require APP . 'view/_templates/footer.php';
            }
        } else {
            // redirecionar o usuário para a página de índice do Venda (pois não temos um venda_id)
            header('location: ' . URL . 'venda/index');
        }
    }
    public function insert()
    {
                 // carregar a view venda. nas views nós podemos mostrar $cliente facilmente
                 require APP . 'view/_templates/header.php';
                 require APP . 'view/venda/insert.php';
                 require APP . 'view/_templates/footer.php';
    }
    /**
     * ACTION: update
     * Este método lida com o que acontece quando você se move para http://localhost/projeto/venda/update
     * IMPORTANTE: Esta não é uma página normal, é uma ACTION. Isto é onde o form "atualizar um Venda" fica venda/edit
     * direciona o usuário após o envio do formulário. Esse método manipula todos os dados POST do formulário e, em seguida, redireciona
     * o usuário de volta para venda/index através da última linha: header(...)
     * Este é um exemplo de como lidar com uma solicitação POST.
     */
    public function update()
    {
        // se tivermos dados POST para criar uma nova entrada do Venda
        if (isset($_POST["submit_update_Venda"])) {
            // Instanciar novo Model (Venda)
            $Venda = new Venda();
            // fazer update() do Model/Model.php
            $Venda->update($_POST["descricao"], $_POST["unidade"], $_POST['venda_id']);
        }
        // onde ir depois que o Venda foi adicionado
        header('location: ' . URL . 'venda/index');
    }
    /**
     * AJAX-ACTION: ajaxGetStats
     * TODO documentação
     */
    public function ajaxGetStats()
    {
        // Instance new Model (Venda)
        $Venda = new venda();
        $amount_of_venda = $Venda->getAmountOfvenda();
        // simplesmente ecoar alguma coisa. Uma API supersimple seria possível fazendo eco ao JSON aqui
        echo $amount_of_venda;
    }
    public function saveIntensVenda($itensVenda) {
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
    $pattern = '/[^\d.,]+/'; // Regular expression pattern to match non-numeric, non-dot, non-comma characters
    $valueWithoutCurrency = preg_replace($pattern, '', $value);
    $doubleValue = doubleval(str_replace(',', '.', $valueWithoutCurrency));
    return $doubleValue;
  }
}