<div class="col-md-12">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Editar um produto</h3>
        </div>
        <div class="card-body">
        <form action="<?php echo URL; ?>produtos/update" method="POST">
          <div class="row">
            <div class="col-sm-6">
            
            <div class="row">
                    <div class="col-sm-4">
                    
                    <div class="form-group">
                        <label>Descrição</label>
                        <input type="text" name="descricao" value="<?php echo htmlspecialchars($produto->descricao, ENT_QUOTES, 'UTF-8'); ?>" required class="form-control"/>
                    </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Unidade</label>
                            <input autofocus type="text" name="unidade" value="<?php echo htmlspecialchars($produto->unidade, ENT_QUOTES, 'UTF-8'); ?>" required class="form-control" />
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Preço</label>
                            <input autofocus type="text" name="valor" value="<?php echo htmlspecialchars($produto->valor, ENT_QUOTES, 'UTF-8'); ?>" required class="form-control" />
                        </div>
                    </div>
                </div>
            
            <input type="hidden" name="produto_id" value="<?php echo htmlspecialchars($produto->id, ENT_QUOTES, 'UTF-8'); ?>" />
            
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

