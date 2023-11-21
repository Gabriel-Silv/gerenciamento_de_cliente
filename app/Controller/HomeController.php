<?php

/**
 * Classe HomeController
 *
 */

namespace Mini\Controller;

use Mini\Model\Funcionario;
use Mini\Model\Venda;

class HomeController
{
    /**
     * PAGE: index
     * Este método lida com o que acontece quando você se move para http://localhost/projeto/home/index (que é a página padrão)
     */
    public function index()
    {
        $Venda = new Venda();
        $Usuario = new Funcionario();
        // receber todos os venda e a quantidade de venda
        $vendas = $Venda->getAllvenda();
        $amount_of_venda_concluida = $Venda->getAmountOfvenda('finalizada');
        $amount_of_venda_pendente = $Venda->getAmountOfvenda('pendente');
        $amount_of_venda_cancelada = $Venda->getAmountOfvenda('cancelada');
        $amount_of_funcionario = $Usuario->getAmountOfFuncionarios();
        $amount_of_venda_all = $Venda->getAmountOfvenda();
        $amount_of_venda_pedente=($amount_of_venda_pendente/$amount_of_venda_all)*100;
        
        // Carregar a view home
        require APP . 'view/_templates/header.php';
        require APP . 'view/home/index.php';
        require APP . 'view/_templates/footer.php';
    }
}
