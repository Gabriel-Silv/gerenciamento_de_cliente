
<div id="javascript-ajax-result-box"></div>


<a href="<?php echo URL . 'clientes/insert'; ?>" class="btn btn-primary" id="btn-novo-cliente">
 <i class="fas fa-user-plus"></i>
 Novo cliente 
</a> 
 </br>
</br>
<table id="table-cliente" class="table-striped">
    <thead style="background-color: #ddd; font-weight: bold;">
        <tr>
            <td>ID</td>
            <td>Razao_social</td>
            <td>Nome_fantasia</td>
            <td>E-mail</td>
            <td>Telefone</td>
            <td>CNPJ</td>
            <td>Edita</td>
            <td>Excluir</td>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($clientes as $cliente) {

    ?>
        <tr>
            <td><?php if (isset($cliente->id)) {
        echo htmlspecialchars($cliente->id, ENT_QUOTES, 'UTF-8');
    }
    ?></td>
            <td>
                <?php 
    if (isset($cliente->razao_social)) {
        echo htmlspecialchars($cliente->razao_social, ENT_QUOTES, 'UTF-8');
    }
    ?>
            </td>
            <td>
                <?php 
    if (isset($cliente->nome_fantasia)) {
        echo htmlspecialchars($cliente->nome_fantasia, ENT_QUOTES, 'UTF-8');
    }
    ?>
            </td>
            <td><?php if (isset($cliente->email)) {
        echo htmlspecialchars($cliente->email, ENT_QUOTES, 'UTF-8');
    }
    ?>
            </td>
            <td><?php if (isset($cliente->telefone)) {
        echo htmlspecialchars($cliente->telefone, ENT_QUOTES, 'UTF-8');
    }
    ?></td>
            <td><?php if (isset($cliente->cnpj)) {
        echo htmlspecialchars($cliente->cnpj, ENT_QUOTES, 'UTF-8');
    }
    ?></td>
            <td>
                <a href="<?php echo URL . 'clientes/edit/' . htmlspecialchars($cliente->id, ENT_QUOTES, 'UTF-8'); ?>"
                    class="btn btn-info">
                    <i class="fas fa-pencil-alt"></i>
                </a>
            </td>


            <td>
                <a href="<?php echo URL . 'clientes/delete/' . htmlspecialchars($cliente->id, ENT_QUOTES, 'UTF-8'); ?>"
                    class="btn btn-danger"> <i class="fas fa-trash">
                    </i>
                </a>
            </td>

        </tr>
        <?php }?>
    </tbody>
</table>