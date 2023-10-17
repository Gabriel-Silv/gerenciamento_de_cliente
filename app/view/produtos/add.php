
<div class="container">
    <h2>Você está na View: application/view/produtos/edit.php (tudo nesta tela vem desse arquivo)</h2>
    <!-- add song form -->
    <div>
        <h3>Editar um Produto</h3>
        <div class="box">
        <h3>Adicionar um Produto</h3>
        <form action="<?php echo URL; ?>produtos/add" method="POST">
            <div class="form-group">
                <br>
                <div class="col-xs-6">
                    <label>descricao</label>
                    <input autofocus type="text" name="descricao" value="<?php echo htmlspecialchars($produto->descricao, ENT_QUOTES, 'UTF-8'); ?>" required class="form-control" />
                </div>
              
                <div class="col-xs-12">
                    <label>unidade</label>
                    <input type="unidade" name="unidade" value="" required class="form-control"/>
                </div>                
                <div class="col-xs-6">
                    
                </div>
                <br>
                <br>
                <input type="submit" name="submit_add_produto" value="Enviar" class="btn btn-primary"/>
            </div>
        </form>
    </div>
    </div>
</div>

