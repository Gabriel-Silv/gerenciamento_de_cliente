<?php

/**
 * Classe vendaController
 *
 */ 

namespace Mini\Controller;

use Mini\Model\Venda;
use Mini\Model\ItensVenda;

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
        $venda = $Venda->getAllvenda();
        $amount_of_venda = $Venda->getAmountOfvenda();

       // carregar a view venda. com as views nós podemos mostrar os $venda e a $amount_of_venda facilmente
        require APP . 'view/_templates/header.php';
        require APP . 'view/venda/index.php';
        require APP . 'view/_templates/footer.php';
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

        $dadosVendasRequest=json_decode($_POST['dados_venda'],1);
        $itensVendasRequest=json_decode($_POST['itens_vendas'],1);
        $dadosVendasRequest=$this->getDadosVendas($dadosVendasRequest);
        $dadosVendasRequest['dados_venda']['total_venda'] =$this->calcuclaTotal($itensVendasRequest);
      
        if(isset($dadosVendasRequest)){
            $Venda = new Venda();
            $idVenda=$Venda->add($dadosVendasRequest['dadosVenda']); 
            $itensVendasRequest['id_venda']=$idVenda;
            if($idVenda){
                $itensVenda = new ItensVenda();
                $itensVenda->saveIntensVenda($itensVendasRequest);
            }
            header('location: ' . URL .'venda/insert');  
        }
     }
     public function delete($venda_id)
    {
        // se temos um id de um Venda que deve ser deletado
        if (isset($venda_id)) {
            // Instanciar novo Model (Venda)
            $Venda = new Venda();
            // fazer delete() em Model/Model.php
            $Venda->delete($venda_id);
        }

        // onde ir depois que o Venda foi excluído
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
    public function saveIntensVenda($itens_vendas) {
        foreach ($itensVenda as $item) {
          $itemVenda = new ItensVenda();
          $itemVenda->add($itensVenda);
        }
        $response = array('status' => 'success');
        return json_encode($response);
      }
      function getDadosVendas($dadosVendas) {
        //$encodedString = 'dados_venda=%5B%7B%22vendedor%22%3A%221%22%2C%22vendedor_id%22%3A%22%22%2C%22cliente_id%22%3A%22%22%2C%22cliente%22%3A%2248%22%2C%22codigo%22%3A%22%22%2C%22descricao%22%3A%22%22%2C%22quantidade%22%3A%22%22%2C%22unidade%22%3A%22%22%2C%22desconto%22%3A%22%22%7D%5D&itens_vendas=%7B%22itensVendas%22%3A%5B%5B%5D%2C%5B%5D%2C%5B%22000003%22%2C%22IN+NEC+ORCI.%22%2C%22AMPOLA%22%2C%223%22%2C%22R%24%C2%A0140%2C00%22%2C%2212%22%2C%22R%24%C2%A0408%2C00%22%5D%5D%7D';
        //parse_str($encodedString, $dadosVendas);
        $dadosVendas['dados_venda']['id_cliente'] = $dadosVendas['dados_venda']['cliente'];
        $dadosVendas['dados_venda']['id_vendedor'] = $dadosVendas['dados_venda']['vendedor'];
        $dadosVendas['dados_venda']['status_venda']='finalizada';
        return $dadosVendas;
    }
  function calcuclaTotal($itensVendas){
    $total = 0;
    foreach (json_decode($_POST['itens_venda'],1) as $item) {
     if ($item){
      $total += $item['valor']*$item['quantidade'];
    }
   }
    return $total;
  }
}