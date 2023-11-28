<?php

/**
 * Classe EnderecosController
 *
 */

namespace Mini\Controller;
use Mini\Controller\LoginController;
use Mini\Model\Endereco;

class EnderecosController
{
    /**
     * Action: index
     * Este método manipula o que acontece quando acessa http://localhost/projeto/Enderecos/index
     */
    public function index()
    {
   
        LoginController::verificaLogin();
	  // Instanciar novo Model (Endereco)
        $Endereco = new Endereco();
        // receber todos os Enderecos e a quantidade de Enderecos
        $Enderecos = $Endereco->getAllEnderecos();// Esta propriedade é recebida na view: view/Enderecos/index.php em forma de array
        $amount_of_Enderecos = $Endereco->getAmountOfEnderecos(); // Esta propriedade também é recebida na view: view/Enderecos/index.php

       // Carregar a view Enderecos. Com as views nós podemos mostrar os $Enderecos e a $amount_of_Enderecos facilmente
        require APP . 'view/_templates/header.php';
        require APP . 'view/Enderecos/index.php';
        require APP . 'view/_templates/footer.php';
    }

    /**
     * ACTION: add
     * Este método manipula o que acontece quando acessamos http://localhost/projeto/Enderecos/add
     * IMPORTANTE: Isto não é uma página normal, isto é um ACTION. Isto é onde está o form "adicionar um Endereco" em Enderecos/index
     * direciona o usuário após o envio do formulário. Esse método manipula todos os dados POST do formulário e, em seguida, redireciona
     * o usuário de volta para Enderecos/index através da última linha: header(...)
     * Este é um exemplo de como lidar com uma solicitação POST.
     */
    public function add()
    {
        LoginController::verificaLogin();
        // se tivermos dados POST para criar uma nova entrada do Endereco
        if (isset($_POST["submit_add_Endereco"])) {
            // Instanciar novo Model (Endereco)
            $Endereco = new Endereco();
            // do add() em Model/Model.php
            $Endereco->add($_POST ["logradouro"], $_POST["numero"], $_POST["bairro"], $_POST["estado"], $_POST["municipio"], $_POST["pais"], $_POST["cep"]);
        }

        // onde ir depois que o Endereco foi adicionado
        header('location: ' . URL . 'Enderecos/index');
    }

    /**
     * ACTION: delete
     * Este método lida com o que acontece quando você se move para http://localhost/projeto/Enderecos/delete
     * IMPORTANTE: Esta não é uma página normal, é uma ACTION. Isto é onde o botãoe "excluir um Endereco" em Enderecos/index
     * direciona o usuário após o clique. Este método trata de todos os dados da requisição GET (na URL!) E depois
     * redireciona o usuário de volta para Enderecos/index através da última linha: header(...)
     * Este é um exemplo de como lidar com uma solicitação GET.
     * @param int $Endereco_id Id do Endereco para excluir
     */
    public function delete($Endereco_id)
    {
        LoginController::verificaLogin();
        // se temos um id de um Endereco que deve ser deletado
        if (isset($Endereco_id)) {
            // Instanciar novo Model (Endereco)
            $Endereco = new Endereco();
            // fazer delete() em Model/Model.php
            $Endereco->delete($Endereco_id);
        }

        // onde ir depois que o Endereco foi excluído
        header('location: ' . URL . 'Enderecos/index');
    }

     /**
     * ACTION: edit
     * Este método lida com o que acontece quando você se move para http://localhost/projeto/Enderecos/edit
     * @param int $Endereco_id Id do Endereco a editar
     */
    public function edit($Endereco_id)
    {
        LoginController::verificaLogin();
        // se temos um id de um Endereco que deve ser editado
        if (isset($Endereco_id)) {
            // Instanciar novo Model (Endereco)
            $Endereco = new Endereco();
            // fazer getEndereco() em Model/Model.php
            $Endereco = $Endereco->getEndereco($Endereco_id);

            // Se o Endereco não foi encontrado, então ele teria retornado falso, e precisamos exibir a página de erro
            if ($Endereco === false) {
                $page = new \Mini\Controller\ErrorController();
                $page->index();
            } else {
                // carregar a view Enderecos. nas views nós podemos mostrar $Endereco facilmente
                require APP . 'view/_templates/header.php';
                require APP . 'view/Enderecos/edit.php';
                require APP . 'view/_templates/footer.php';
            }
        } else {
            // redirecionar o usuário para a página de índice do Endereco (pois não temos um client_id)
            header('location: ' . URL . 'Enderecos/index');
        }
    }

    /**
     * ACTION: update
     * Este método lida com o que acontece quando você se move para http://localhost/projeto/Enderecos/update
     * IMPORTANTE: Esta não é uma página normal, é uma ACTION. Isto é onde o form "atualizar um Endereco" fica Enderecos/edit
     * direciona o usuário após o envio do formulário. Esse método manipula todos os dados POST do formulário e, em seguida, redireciona
     * o usuário de volta para Enderecos/index através da última linha: header(...)
     * Este é um exemplo de como lidar com uma solicitação POST.
     */
    public function update()
    {
        LoginController::verificaLogin();
        // se tivermos dados POST para criar uma nova entrada do Endereco
        if (isset($_POST["submit_update_Endereco"])) {
            // Instanciar novo Model (Endereco)
            $Endereco = new Endereco();
            // fazer update() do Model/Model.php
            $Endereco->update($_POST ["logradouro"], $_POST["numero"], $_POST["bairro"], $_POST["estado"], $_POST["municipio"], $_POST["pais"], $_POST["cep"], $_POST["id_Endereco"]);
        }
        
        // onde ir depois que o Endereco foi adicionado
        header('location: ' . URL . 'Enderecos/index');
    }

    /**
     * AJAX-ACTION: ajaxGetStats
     * TODO documentação
     */
    public function ajaxGetStats()
    {
        // Instance new Model (Endereco)
        $Endereco = new Endereco();
        $amount_of_Enderecos = $Endereco->getAmountOfEnderecos();

        // simplesmente ecoar alguma coisa. Uma API supersimple seria possível fazendo eco ao JSON aqui
        echo $amount_of_Enderecos;
    }

}
