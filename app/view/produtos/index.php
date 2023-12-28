
        <div id="javascript-ajax-result-box"></div>


<a href="<?php echo URL . 'produtos/insert'; ?>" class="btn btn-primary" id="btn-novo-cliente">
    <i class="fas fa-user-plus"></i>
    Novo Produto
</a>
</br>
</br>
<table id="table-cliente" class="table-striped">
    <thead style="background-color: #ddd; font-weight: bold;">
        <tr>
            <td>Codigo</td>
            <td>Descrição</td>
            <td>Unidade</td>
            <td>Preço</td>
            <td>Ação</td>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($produtos as $produto): ?>
    <tr>
        <td><?php if (isset($produto->codigo)) echo htmlspecialchars($produto->codigo, ENT_QUOTES, 'UTF-8'); ?></td>
        <td><?php if (isset($produto->descricao)) echo htmlspecialchars($produto->descricao, ENT_QUOTES, 'UTF-8'); ?></td>
        <td><?php if (isset($produto->unidade)) echo htmlspecialchars($produto->unidade, ENT_QUOTES, 'UTF-8'); ?></td>
        <td><?php if (isset($produto->valor)) echo htmlspecialchars( 'R$ ' . number_format($produto->valor, 2, '.', ','), ENT_QUOTES, 'UTF-8'); ?></td>
        <td><a href="<?php echo URL . 'produtos/delete/' . htmlspecialchars($produto->id, ENT_QUOTES, 'UTF-8'); ?>"><i class="fas fa-trash-alt"></i></a>
         &nbsp;&nbsp;&nbsp;
        <a href="<?php echo URL . 'produtos/edit/' . htmlspecialchars($produto->id, ENT_QUOTES, 'UTF-8'); ?>"><i class="fas fa-edit"></i></a></td>
    </tr>
    <?php endforeach; ?>
    </tbody>
</table>
</div>
</div>