<div class="container">
    <h1>Clientes</h1>
    <h2>--</h2>
    <!-- add cliente form -->
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
                
                <br>
                <br>
                <div class="col-xs-2">
                    <label>cep</label>
                    <input type="text" name="cep" value="<?php echo htmlspecialchars($cliente->cep, ENT_QUOTES, 'UTF-8'); ?>" class="form-control"/>
                </div>

                <div class="col-xs-10">
                    <label>logradouro</label>
                    <input type="text" name="logradouro" value="" required class="form-control"/>
                </div>
               
                <div class="col-xs-3">
                    <label>numero</label>
                    <input autofocus type="text" name="numero" value="<?php echo htmlspecialchars($cliente->numero, ENT_QUOTES, 'UTF-8'); ?>" required class="form-control" />
                </div>
              
                <div class="col-xs-4">
                    <label>bairro</label>
                    <input type="bairro" name="bairro" value="" required class="form-control"/>
                </div>
      
                <div class="col-xs-4">
                    <label>estado</label>
                    <input type="text" name="estado" value="<?php echo htmlspecialchars($cliente->estado, ENT_QUOTES, 'UTF-8'); ?>" class="form-control"/>
                </div>
                
                
                <div class="col-xs-4">
                    <label>municipio</label>
                    <input type="text" name="municipio" value="<?php echo htmlspecialchars($cliente->municipio, ENT_QUOTES, 'UTF-8'); ?>" class="form-control"/>
                </div>

                <div class="col-xs-6">
                    <label>pais</label>
                    <input type="text" name="pais" value="<?php echo htmlspecialchars($cliente->pais, ENT_QUOTES, 'UTF-8'); ?>" class="form-control"/>
                </div>
                

                
                <input type="submit" name="submit_add_cliente" value="Enviar" class="btn btn-primary"/>
            </div>

<br/>
            <br/>
            <br/>



        </form>
    </div>
</div>
<!--    -->

    <!-- main content output -->
    <div class="box">
      <!--  <h3>Total de clientes: <//?php echo $amount_of_clientes; ?></h3>
        <h3>Total de clientes (via AJAX)</h3>   -->
        <div id="javascript-ajax-result-box"></div>

       <!-- <h3>Lista de clientes (dados do model)</h3> -->
        <table id="table-cliente" class="table-striped">
            <thead style="background-color: #ddd; font-weight: bold;">
            <tr>
                <td>ID</td>
                <td>Razao_social</td>
                <td>Nome_fantasia</td>
                <td>E-mail</td>
                <td>Telefone</td>
                <td>CNPJ</td>
                <td>Excluir</td>
                <td>Editar</td>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($clientes as $cliente) {
                
                ?>
                <tr>
                    <td><?php if (isset($cliente->id)) echo htmlspecialchars($cliente->id, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php if (isset($cliente->razao_social)) echo htmlspecialchars($cliente->razao_social, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php if (isset($cliente->nome_fantasia)) echo htmlspecialchars($cliente->nome_fantasia, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php if (isset($cliente->email)) echo htmlspecialchars($cliente->email, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php if (isset($cliente->telefone)) echo htmlspecialchars($cliente->telefone, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php if (isset($cliente->cnpj)) echo htmlspecialchars($cliente->cnpj, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><a href="<?php echo URL . 'clientes/delete/' . htmlspecialchars($cliente->id, ENT_QUOTES, 'UTF-8'); ?>" class="btn btn-danger">Excluir</a></td>
                    <td><a href="<?php echo URL . 'clientes/edit/' . htmlspecialchars($cliente->id, ENT_QUOTES, 'UTF-8'); ?>" class="btn btn-info">Editar</a></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>
