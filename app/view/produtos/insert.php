<div class="col-md-12">

    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Cadastro de produto</h3>
        </div>
        <div class="card-body">
        <form action="<?php echo URL; ?>produtos/add" method="POST">
          <div class="row">
            <div class="col-sm-6">
            <!-- text input -->
              <div class="form-group">
                 <label>Descrição</label>
                 <input type="text" name="descricao" value="" required class="form-control"/>
              </div>
            </div>

            <div class="col-sm-6">
                <div class="form-group">
                     <label>Unidade</label>
                    <input autofocus type="text" name="unidade" value="" required class="form-control" />
                </div>
            </div>
         </div>
            <!-- fim razao social  nome fantazia -->
            <div class="row">
            <div class="col-sm-4">
               <div class="form-group">
                    <label>E-mail</label>
                    <input type="email" name="email" value="" id ="email" required class="form-control"/>
               </div>
            </div>
            <div class="col-sm-4">
               <div class="form-group">
                  <label>Telefone</label>
                  <input type="text" name="telefone" value="" id="telefone" class="form-control"/>
               </div>
            </div>
            <div class="col-sm-4">
               <div class="form-group">
                  <label>CNPJ</label>
                  <input type="text" name="cnpj" value="" id="cnpj" class="form-control"/>
               </div>
            </div>
        </div> <!--- end row 2 -->


            <div class="row">

                <div class="col-sm-4">
                    <label>CEP</label>
                    <input type="text" name="cep" value=""   id ="cep" onblur="buscarEnderecoCepApi(this.value);" class="form-control"/>
                </div>

                <div class="col-sm-8">
                    <label>Logradouro</label>
                    <input type="text" name="logradouro" value=""  id="logradouro"  required class="form-control"/>
                </div>
            </div>
            <div class="row">

                <div class="col-sm-4">
                    <label>Número</label>
                    <input autofocus type="text" name="numero" value="" id="numero"  required class="form-control" />
                </div>

                <div class="col-sm-8">
                    <label>Bairro</label>
                    <input type="bairro" name="bairro" value=""  id ="bairro" required class="form-control"/>
                    </div>
            </div>
               <div class="row">
                <div class="col-sm-4">
                <div class="form-group">
                  <label for="estado">Estado</label>
                  <select class="custom-select form-control-border" name="estado" id="estado">
                  <option value="">Informe seu estado</option>
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
                    <input type="text" name="municipio" value="" id="municipio" class="form-control"/>
                </div>


                <div class="col-sm-4">
                    <label>País</label>
                    <input type="text" name="pais" value="Brasil" class="form-control"/>
                </div>
            <div>
               <br>
                <input type="submit" name="submit_add_produto" value="Enviar" class="btn btn-primary"/>
            </div>
            <br/>
            <br/>
        </form>
        </div>
    </div>
  </div>

    <script>
        function buscarEnderecoCepApi(cep){
            $.ajax({url:'https://viacep.com.br/ws/'+cep+'/json/',
                success: function(data)
                {
                    $('#logradouro').val(data.logradouro);
                    $('#bairro').val(data.bairro);
                    $('#municipio').val(data.localidade);
                    $('#estado').val(data.uf);
                    $('#cep').val(data.cep);

                    debugger;
                    console.log(data);
                }
            })
        }

    </script>
