<div class="col-md-12">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Edição de Funcionário</h3>
        </div>
        <div class="card-body">
        <form action="<?php echo URL; ?>funcionarios/update" method="POST">
          <div class="row">

          <div class="col-sm-12">
                        <div class="form-group">
                            <div >
                                <img id="img-preview" src="<?php echo URL.'/'.$funcionario->url_foto;?>" style="
                                                      width: 89px;
                                                      height: 90px;
                                                       border: solid 1px;
                                                       " />
                            </div>
                            </div>
                        </div>

            <div class="col-sm-6">
            <input type="hidden" name="id_usuario" value="<?php echo htmlspecialchars($funcionario->id, ENT_QUOTES, 'UTF-8'); ?>" />
            <!-- text input -->
              <div class="form-group"> 
                 <label>Nome</label>
                 <?php   $funcionario->nome=$funcionario->nome?$funcionario->nome:'';?>
                 <input type="text" name="nome" value="<?php 
                   $funcionario->nome=$funcionario->nome?$funcionario->nome:'';
                   echo htmlspecialchars($funcionario->nome, ENT_QUOTES, 'UTF-8'); ?>" required class="form-control"/>
              </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                     <label>CPF</label>
                    <input autofocus type="text" name="cpf" value="<?php 
                    echo htmlspecialchars( $funcionario->cpf, ENT_QUOTES, 'UTF-8'); ?>" required class="form-control" 
                    data-inputmask='"mask": "999.999.999-99"' data-mask/>
                </div>
            </div> 
         </div>
            <!-- fim razao social  nome fantazia -->
            <div class="row">
            <div class="col-sm-4">
            <div class="col-sm-6">
                        <div class="form-group">
                            <label>Telefone</label>
                            <input type="text" name="telefone" id="telefone" class="form-control"
                                data-inputmask='"mask": "(99) 9999-99999"' data-mask  value="<?php echo htmlspecialchars($funcionario->telefone, ENT_QUOTES, 'UTF-8'); ?>"/>
                        </div>
                    </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                  <label for="estado">Perfil</label>
                  <select class="custom-select form-control-border" name="perfil" id="perfil">
                  <option value="Vendedor">Vendedor</option>
                     <option value="Administrador">Administrador</option>
                     <option value="Cliente">Cliente</option>
                  </select>
                 </div>
            </div>
            <div class="col-sm-4">
               <div class="form-group">
                    <label>E-mail</label>
                    <input type="email" name="email" value="<?php echo htmlspecialchars($funcionario->email, ENT_QUOTES, 'UTF-8'); ?>" id ="email" required class="form-control"/>
               </div>
            </div>
      
        </div> <!--- end row 2 -->
        
        <div class="row">
                <input type="submit" name="submit_update_funcionario" value="Enviar" class="btn btn-primary"/>
            </div>
            <br/>
       </form>
        </div>
    </div>
  </div>