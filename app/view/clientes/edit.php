<div class="col-md-12">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Cadastro de Cliente</h3>
        </div>
        <div class="card-body">
        <form action="<?php echo URL; ?>clientes/update" method="POST">
          <div class="row">
            <div class="col-sm-6">
            <input type="hidden" name="cliente_id" value="<?php echo htmlspecialchars($cliente->id, ENT_QUOTES, 'UTF-8'); ?>" />
              <div class="form-group">
                 <label>Razão social </label>
                 <input type="text" name="razao_social" value="<?php echo htmlspecialchars($cliente->razao_social, ENT_QUOTES, 'UTF-8'); ?>" required class="form-control"/>
              </div>
            </div>

            <div class="col-sm-6">
                <div class="form-group">
                     <label>Nome Fantasia</label>
                    <input autofocus type="text" name="nome_fantasia" value="<?php echo htmlspecialchars($cliente->nome_fantasia, ENT_QUOTES, 'UTF-8'); ?>" required class="form-control" />
                </div>
            </div>
         </div>
            
            <div class="row">
            <div class="col-sm-4">
               <div class="form-group">
                    <label>E-mail</label>
                    <input type="email" name="email" value="<?php echo htmlspecialchars($cliente->email, ENT_QUOTES, 'UTF-8'); ?>" id ="email" required class="form-control"/>
               </div>
            </div>
            <div class="col-sm-4">
               <div class="form-group">
                  <label>Telefone</label>
                  <input type="text" name="telefone" value="<?php echo htmlspecialchars($cliente->telefone, ENT_QUOTES, 'UTF-8'); ?>" id="telefone" class="form-control"/>
               </div>
            </div>
            <div class="col-sm-4">
               <div class="form-group">
                  <label>CNPJ</label>
                  <input type="text" name="cnpj" value="<?php echo htmlspecialchars($cliente->cnpj, ENT_QUOTES, 'UTF-8'); ?>" id="cnpj" class="form-control"/>
               </div>
            </div>
        </div> 


            <div class="row">

                <div class="col-sm-4">
                    <label>CEP</label>
                    <input type="text" name="cep" value="<?php echo htmlspecialchars($endereco->cep, ENT_QUOTES, 'UTF-8'); ?>"   id ="cep" onblur="buscarEnderecoCepApi(this.value);" class="form-control"/>
                </div>

                <div class="col-sm-8">
                    <label>Logradouro</label>
                    <input type="text" name="logradouro" value="<?php echo htmlspecialchars($endereco->logradouro, ENT_QUOTES, 'UTF-8'); ?>"  id="logradouro"  required class="form-control"/>
                </div>
            </div>
            <div class="row">

                <div class="col-sm-4">
                    <label>Número</label>
                    <input autofocus type="text" name="numero" value="<?php echo htmlspecialchars($endereco->numero, ENT_QUOTES, 'UTF-8'); ?>" id="numero"  required class="form-control" />
                </div>

                <div class="col-sm-8">
                    <label>Bairro</label>
                    <input type="bairro" name="bairro" value="<?php echo htmlspecialchars($endereco->bairro, ENT_QUOTES, 'UTF-8'); ?>"  id ="bairro" required class="form-control"/>
                    </div>
            </div>
               <div class="row">
                <div class="col-sm-4">
                <div class="form-group">
                  <label for="estado">Estado</label>
                  <select class="custom-select form-control-border" name="estado" id="estado">
                  <option value="AC">Acre</option>
                    <option value="AL">Alagoas</option>
                    <option value="AP">Amapá</option>
                    <option value="AM">Amazonas</option>
                    <option value="BA">Bahia</option>
                    <option value="CE">Ceará</option>
                    <option value="DF">Distrito Federal</option>
                    <option value="ES">Espírito Santo</option>
                    <option value="GO">Goiás</option>
                    <option value="MA">Maranhão</option>
                    <option value="MT">Mato Grosso</option>
                    <option value="MS">Mato Grosso do Sul</option>
                    <option value="MG">Minas Gerais</option>
                    <option value="PA">Pará</option>
                    <option value="PB">Paraíba</option>
                    <option value="PR">Paraná</option>
                    <option value="PE">Pernambuco</option>
                    <option value="PI">Piauí</option>
                    <option value="RJ">Rio de Janeiro</option>
                    <option value="RN">Rio Grande do Norte</option>
                    <option value="RS">Rio Grande do Sul</option>
                    <option value="RO">Rondônia</option>
                    <option value="RR">Roraima</option>
                    <option value="SC">Santa Catarina</option>
                    <option value="SP">São Paulo</option>
                    <option value="SE">Sergipe</option>
                    <option value="TO">Tocantins</option>
                  </select>
                </div>
                </div>
                <div class="col-sm-4">
                    <label>Municipio</label>
                    <input type="text" name="municipio" value="<?php echo htmlspecialchars($endereco->municipio, ENT_QUOTES, 'UTF-8'); ?>" id="municipio" class="form-control"/>
                </div>


                <div class="col-sm-4">
                    <label>País</label>
                    <input type="text" name="pais" value="Brasil" class="form-control"/>
                </div>
            <div>
               <br>
                <input type="submit" name="submit_update_cliente" value="Enviar" class="btn btn-primary"/>
            </div>
            <br/>
            <br/>
        </form>
        </div>
    </div>
  </div>