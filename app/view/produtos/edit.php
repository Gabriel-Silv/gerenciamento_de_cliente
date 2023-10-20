<<<<<<< Updated upstream
<div class="container">
    <h2>Você está na View: app/view/produtos/edit.php (tudo nesta tela vem desse arquivo)</h2>
    <!-- add song form -->
    <div>
        <h3>Editar um produto</h3>
        <form action="<?php echo URL; ?>produtos/update" method="POST">
            <label>Descrição</label>
            <input autofocus type="text" name="descricao" value="<?php echo htmlspecialchars($produto->descricao, ENT_QUOTES, 'UTF-8'); ?>" required />
=======
<div class="col-md-12">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Editar um produto</h3>
        </div>
        <div class="card-body">
        <form action="<?php echo URL; ?>produtos/update" method="POST">
          <div class="row">
            <div class="col-sm-6">
            <input type="hidden" name="produto_id" value="<?php echo htmlspecialchars($produto->id, ENT_QUOTES, 'UTF-8'); ?>" />
            <!-- text input -->
              <div class="form-group">
              <label>Descrição</label>
            <input autofocus type="text" name="descricao" value="<?php echo htmlspecialchars($produto->descricao, ENT_QUOTES, 'UTF-8'); ?>" required />
              </div>
            </div>
>>>>>>> Stashed changes
            <label>Unidade</label>
            <input type="text" name="unidade" value="<?php echo htmlspecialchars($produto->unidade, ENT_QUOTES, 'UTF-8'); ?>" />
            <input type="hidden" name="produto_id" value="<?php echo htmlspecialchars($produto->id, ENT_QUOTES, 'UTF-8'); ?>" />
            <input type="submit" name="submit_update_produto" value="Atualizar" />
<<<<<<< Updated upstream
        </form>
    </div>
</div>
=======
            <div>
               <br>
                <input type="submit" name="submit_update_produto" value="Atualizar" class="btn btn-primary"/>
            </div>
            <br/>
            <br/>
        </form>
        </div>
    </div>
  </div>









>>>>>>> Stashed changes

