<!-- main content output -->

<!--  <h3>Total de clientes: <//?php echo $amount_of_clientes; ?></h3>
        <h3>Total de clientes (via AJAX)</h3>   -->
        <div id="javascript-ajax-result-box"></div>

<!-- <h3>Lista de clientes (dados do model)</h3> -->
<a href="<?php echo URL . 'venda/insert'; ?>" class="btn btn-primary" id="btn-novo-cliente">
 <i class="fas fa-user-plus"></i>
 Nova Venda 
</a> 
 </br>
</br>
<table id="table-cliente" class="table-striped">
            <thead style="background-color: #ddd; font-weight: bold;">
            <tr>
                <td>ID</td>
                <td>Cliente</td>
                <td>Vendedor</td>
                <td>Valor Total</td>
                <td>Data</td>
                <td>status</td>
                <td>Excluir</td>
                <td>Atualizar</td>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($vendas as $venda): ?>
            <tr>
              <td><?= isset($venda->id) ? htmlspecialchars($venda->id, ENT_QUOTES, 'UTF-8') : ''; ?></td>
              <td><?= isset($venda->nome) ? htmlspecialchars($venda->nome, ENT_QUOTES, 'UTF-8') : ''; ?></td>
              <td><?= isset($venda->razao_social) ? htmlspecialchars($venda->razao_social, ENT_QUOTES, 'UTF-8') : ''; ?></td>
              <td><?= isset($venda->total_venda) ? htmlspecialchars(number_format($venda->total_venda, 2, '.', ',') , ENT_QUOTES, 'UTF-8') : ''; ?></td>
              <td><?= isset($venda->data_venda) ? htmlspecialchars($venda->data_venda, ENT_QUOTES, 'UTF-8') : ''; ?></td>
              <td><?= isset($venda->status_venda) ? htmlspecialchars($venda->status_venda, ENT_QUOTES, 'UTF-8') : ''; ?></td>
              <td><a href="<?= URL . 'vendas/delete/' . htmlspecialchars($venda->id, ENT_QUOTES, 'UTF-8'); ?>">Excluir</a></td>
              <td><a href="<?= URL . 'vendas/edit/' . htmlspecialchars($venda->id, ENT_QUOTES, 'UTF-8'); ?>">Editar</a></td>
           </tr>
       <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
