<div class="col-md-12">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Inserção de Funcionário</h3>
        </div>
        <div class="card-body">
            <form action="<?php echo URL; ?>funcionarios/add" method="POST" enctype="multipart/form-data">
                <div class="row">
          
                        <input type="hidden" name="funcionario_id" value="" />
                        <div class="col-sm-6">
                        <div class="form-group">
                            <div >
                                <img  name="foto-File"id="img-preview" src="../../img/demo-image.png" style="
                                                      width: 89px;
                                                      height: 90px;
                                                       border: solid 1px;
                                                       " />
                            </div>
                            </div>
                        </div>
                        
                        <div class="col-sm-12">
                        <div class="form-group">
                        </div>
                            </div>

                            <div class="col-sm-2">
                              <br>
                            <div class="form-group">
                            
                            <div class="custom-file" >
                                <input type="file" class="custom-file-input " id="input-file" name="foto-File"
                                    accept="image/*">
                                <label class="custom-file-label" for="input-file">imagem</label>
                            </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                        <div class="form-group">

                        </div>
                        </div>

                        <div class="col-sm-6">
                        <div class="form-group">
                          
                                <label>Nome</label>
                                <input type="text" name="nome" id="nome" value="" required class="form-control" />
                            </div>
                        </div>
                        <div class="col-sm-6">
                        <div class="form-group">
                           
                                <label>CPF</label>
                                <input autofocus type="text" name="cpf" value="" required class="form-control"
                                    data-inputmask='"mask": "999.999.999-99"' data-mask />
                            </div>
                        </div>
                </div>
                
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Telefone</label>
                            <input type="text" name="telefone" value="" id="telefone" class="form-control"
                                data-inputmask='"mask": "(99) 9999-99999"' data-mask />
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="estado">Perfil</label>
                            <select class="custom-select form-control-border" name="perfil" id="perfil">
                                <option value="Vendedor">Vendedor</option>
                                <option value="Administrador">Administrador</option>
                                <option value="Cliente">Cliente</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>email</label>
                            <input type="emal" name="email" value="" id="email" required class="form-control" />
                        </div>
                    </div>


                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Senha</label>
                            <input type="password" name="password" value="" id="password" required
                                class="form-control" />
                        </div>
                    </div>
                </div>

                <div class="row">
                    <input type="submit" name="submit_insert_funcionario" value="Enviar" class="btn btn-primary" />
                </div>
                <br />
            </form>
        </div>
    </div>
</div>