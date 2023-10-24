<div class="col-md-12">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Cadastro de Venda</h3>
        </div>
        <div class="card-body">
            <form action="<?php echo URL; ?>venda/add" method="POST">
                <div class="row">
                    <div class="col-sm-6">
                    <!-- text input -->
                        <div class="form-group">
                            <label>Cliente</label>
                            <input type="text" name="cliente" value="" required class="form-control"/>
                            <input type="hidden" name="cliente_id" value="" required class="form-control"/>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Vendedor</label>
                            <input type="text" name="vendedor" value="" required class="form-control"/>
                            <input type="hidden" name="vendedor_id" value="" required class="form-control"/>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>CPF</label>
                            <input type="text" name="cpf" value="" required class="form-control"/>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Codigo</label>
                            <input type="text" name="codigo" id="codigo" value="" required class="form-control"/>
                        </div>
                    </div>
                    <div class="col-sm-9">
                        <div class="form-group">
                            <label>Descrição</label>
                            <input type="text" name="descricao" id="descricao" value="" required class="form-control"/>
                        </div>
                    </div>

                    <div class="col-sm-2">
                        <div class="form-group">
                            <label>Quantidade</label>
                            <input autofocus type="text" name="quantidade" id="quantidade" value="" required class="form-control" />
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label>Tabela</label>
                            <input autofocus type="text" name="tabela" id="tabela" value="" required class="form-control" />
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label>Valor Unit.</label>
                            <input autofocus type="text" name="valor" id="valor" value="" required class="form-control" />
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label>Desconto</label>
                            <input autofocus type="text" name="desconto" id="desconto" value="" onblur="CalcularValorTotal()" required class="form-control" />
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label>Valor Total</label>
                            <input autofocus type="text" name="valor_total"  id="valor_total" value="" required class="form-control" />
                        </div>
                    </div>
                </div>
                <br/>
                <div class="row">
                <div class="col-12 table-responsive">
                  <table id="table_vendas" class="table table-striped">
                    <thead>
                    <tr>
                      <th>Codigo</th>
                      <th>Produto</th>
                      <th>Unid.</th>
                      <th>QTD</th>
                      <th>Valor</th>
                      <th>Desconto</th>
                      <th>Valor Total</th>
                    </tr>
                    </thead>
                    <tbody>
                <tr>
                    
                </tr>
                    </tbody>
                  </table>
                </div>
                <!-- /.col -->
              </div>
                <br>
                
                <br/>
            </form>
            <input type="button" name="submit_add_venda" value="Adicionar" class="btn btn-primary" onclick="AddItens()"/>
        </div>
    </div>
  </div>
