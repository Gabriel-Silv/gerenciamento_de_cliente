
<div class="container">
    <h2>Você está na View: application/view/clientes/edit.php (tudo nesta tela vem desse arquivo)</h2>
    <!-- add song form -->
    <div>
        <h3>Editar um cliente</h3>
        <div class="box">
        <h3>Adicionar um cliente</h3>
        <form action="<?php echo URL; ?>clientes/add" method="POST">
            <div class="form-group">
                <br>
                <div class="col-xs-6">
                    <label>razao_social</label>
                    <input type="text" name="razao_social" value="" required class="form-control"/>
                </div>

                <div class="col-xs-6">
                    <label>nome_fantasia</label>
                    <input autofocus type="text" name="nome_fantasia" value="<?php echo htmlspecialchars($cliente->nome_fantasia, ENT_QUOTES, 'UTF-8'); ?>" required class="form-control" />
                </div>
              
                <div class="col-xs-12">
                    <label>E-mail</label>
                    <input type="email" name="email" value="" required class="form-control"/>
                </div>
      
                <div class="col-xs-6">
                    <label>telefone</label>
                    <input type="text" name="telefone" value="<?php echo htmlspecialchars($cliente->telefone, ENT_QUOTES, 'UTF-8'); ?>" class="form-control"/>
                </div>
                
                
                <div class="col-xs-6">
                    <label>cnpj</label>
                    <input type="text" name="cnpj" value="<?php echo htmlspecialchars($cliente->cnpj, ENT_QUOTES, 'UTF-8'); ?>" class="form-control"/>
                </div>
                
                <div class="col-xs-6">
                    
                </div>
                <br>
                <br>
                <input type="submit" name="submit_add_cliente" value="Enviar" class="btn btn-primary"/>
            </div>
        </form>
    </div>
    </div>
</div>

