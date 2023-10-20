<div class="col-md-12">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Cadastro de produto</h3>
        </div>
        <div class="card-body">
            <form action="<?php echo URL; ?>produtos/add" method="POST">
                <div class="row">
                    <div class="col-sm-4">
                    <!-- text input -->
                    <div class="form-group">
                        <label>Descrição</label>
                        <input type="text" name="descricao" value="" required class="form-control"/>
                    </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Unidade</label>
                            <input autofocus type="text" name="unidade" value="" required class="form-control" />
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Preço</label>
                            <input autofocus type="text" name="valor" value="" required class="form-control" />
                        </div>
                    </div>
                </div>
                <br/>
                <br>
                <input type="submit" name="submit_add_produto" value="Enviar" class="btn btn-primary"/>
                <br/>
            </form>
        </div>
    </div>
  </div>
