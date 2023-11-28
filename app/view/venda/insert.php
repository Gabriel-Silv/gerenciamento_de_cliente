<div class="col-md-12">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Registro  de Venda</h3>
        </div>
        <div class="card-body">
            <form id="form_insert_venda" action="#" method="">
                <div class="row ">
                    <div class="col-sm-12">
                    Dados Da venda
                     <hr>
                        <div class="form-group">
                            <label>Vendedor</label>
                            <select class="easyui-combobox_  form-control" id="vendedor" name="vendedor"
                                label="vendedor:" labelPosition="top" style="width:100%;" required>
                             </select>
                            <input type="hidden" name="vendedor_id" value="" required class="form-control" />
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <!-- text input -->
                        <div class="form-group">
                            <input type="hidden" name="cliente_id" value="" required class="form-control" />
                            <label>Cliente</label>
                            <select class="easyui-combobox_ form-control" name="cliente" id="cliente" label="cliente:"
                                labelPosition="top" style="width:100%;" required onchange="buscarClienteId()">
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>CPF/CNPJ</label>
                            <input type="text" name="cpf_cnpj" id="cpf_cnpj" value="" required disabled class="form-control" data-inputmask='"mask": "99.999.999/9999-99"' data-mask/>
                        </div>
                    </div>
                </div>
                <hr>
                 Itens Da vendas
                <hr>
            
                <div class="row">
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Codigo</label>
                            <input type="hidden" name="id_produto" id="id_produto" value="" required class="form-control" />
                            <input type="text" name="codigo" id="codigo" value="" required class="form-control"
                                onblur="buscarDadosDoProduto()" />
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
                            <input autofocus type="text" name="quantidade" id="quantidade" value="1" required
                                class="form-control" onblur="CalcularValorTotal()" />
                        </div>
                    </div>
                    <div class="col-sm-2">
                    <div class="form-group">
                        <label>Unidade</label>
                        <select  autofocus type="text" name="unidade" id="unidade" value="" required
                                class="form-control">
                            <option value="">Selecione uma Unidade</option>
                            <option value="AMPOLA">AMPOLA</option>
                            <option value="ARR">ARROBA</option>
                            <option value="BANDEJ">BANDEJ</option>
                            <option value="BANDEJA">BANDEJA</option>
                            <option value="BARRIL">BARRIL</option>
                            <option value="BD">BALDE</option>
                            <option value="BISNAGA">BISNAGA</option>
                            <option value="BL">BLOCO</option>
                            <option value="BOB">BOBINA</option>
                            <option value="BOM">BOMBONA</option>
                            <option value="BR">BARRA</option>
                            <option value="BTJ">BOTIJAO</option>
                            <option value="CAPS">CAPSULA</option>
                            <option value="CC">CILINDRADA</option>
                            <option value="CH">CHAPA</option>
                            <option value="CIL">CILINDRO</option>
                            <option value="CJ">CONJUNTO</option>
                            <option value="CJT">CONJUNTO</option>
                            <option value="CM">CENTIMETRO</option>
                            <option value="CM2">CENTIMETRO QUADRADO</option>
                            <option value="CM3">CENTIMETRO CUBICO</option>
                            <option value="CO">CONTEINER</option>
                            <option value="CTE">CARTELA</option>
                            <option value="CTL">CARTELA</option>
                            <option value="CX">CAIXA</option>
                            <option value="DISP">DISPLAY</option>
                            <option value="DM">DECIMETRO</option>
                            <option value="DM2">DECIMETRO QUADRADO</option>
                            <option value="DM3">DECIMETRO CUBICO</option>
                            <option value="EMBAL">EMBALAGEM</option>
                            <option value="FD">FARDO</option>
                            <option value="FL">FOLHA</option>
                            <option value="FLAC">FLACONETE</option>
                            <option value="FR">FRASCO</option>
                            <option value="G">GRAMA</option>
                            <option value="GL">GALAO</option>
                            <option value="GR">GROSSA</option>
                            <option value="GRF">GARRAFA</option>
                            <option value="GRR">GARRAFAO</option>
                            <option value="HG">HECTOGRAMA</option>
                            <option value="JD">JARDA</option>
                            <option value="JD2">JARDA QUADRADA</option>
                            <option value="KB">QUILOBYTE</option>
                            <option value="KG">QUILOGRAMA</option>
                            <option value="KV">QUILOVOLT</option>
                            <option value="KW">QUILOWATT</option>
                        </select>
                        

                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label>Valor Unit.</label>
                            <input autofocus type="text" name="valor" id="valor" value="" required disabled
                                class="form-control" />
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label>Desconto</label>
                            <input autofocus type="text" name="desconto" id="desconto" value=""
                                onblur="CalcularValorTotal()" required class="form-control" />
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label>Valor Total</label>
                            <input autofocus type="text" name="valor_total" id="valor_total" value="" required
                                class="form-control disabled" disabled />
                        </div>
                    </div>


                    <div class="col-sm-2">
                        <div class="form-group">
                            <br>
                            <label><br></label>
                            <input type="button" name="submit_add_venda" value="Adicionar item" class="btn btn-primary"
                                onclick="AddItens()" style="margin-top: 8px" />
                        </div>
                    </div>



                </div>
        </div>
        <br />
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
        <br />
        </form>
        <div class="col-sm-2">
            <input type="button" name="submit_add_venda" value="Finalizar Venda" class="btn btn-primary"
                onclick="finalizarVenda()" />
        </div>
        <br />

    </div>
</div>
</div>