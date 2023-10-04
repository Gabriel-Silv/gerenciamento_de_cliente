<div class="container">
    <h2>Você está na View: application/view/clientes/edit.php (tudo nesta tela vem desse arquivo)</h2>
    <!-- add song form -->
    <div>
        <h3>Editar um cliente</h3>
        <form action="<?php echo URL; ?>clientes/update" method="POST">
            <label>razao_social</label>
            <input autofocus type="text" name="razao_social" value="<?php echo htmlspecialchars($cliente->razao_social, ENT_QUOTES, 'UTF-8'); ?>" required />
            <label>nome_fantasia</label>
            <input autofocus type="text" name="nome_fantasia" value="<?php echo htmlspecialchars($cliente->nome_fantasia, ENT_QUOTES, 'UTF-8'); ?>" required />
            <label>E-mail</label>
            <input type="email" name="email" value="<?php echo htmlspecialchars($cliente->email, ENT_QUOTES, 'UTF-8'); ?>" required />
            <label>telefone</label>
            <input type="text" name="telefone" value="<?php echo htmlspecialchars($cliente->telefone, ENT_QUOTES, 'UTF-8'); ?>" />
            <label>cnpj</label>
            <input type="text" name="cnpj" value="<?php echo htmlspecialchars($cliente->cnpj, ENT_QUOTES, 'UTF-8'); ?>" />
            <input type="hidden" name="cliente_id" value="<?php echo htmlspecialchars($cliente->id, ENT_QUOTES, 'UTF-8'); ?>" />
            <input type="submit" name="submit_update_cliente" value="Editar" />
        </form>
    </div>
</div>

