

<div class="col-md-12">

    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Cadastro de Cliente</h3>
        </div>
        <div class="card-body">
        <form action="<?php echo URL; ?>clientes/add" method="POST">
          <div class="row">
            <div class="col-sm-6">
            
              <div class="form-group">
                 <label>Razão social </label>
                 <input type="text" name="razao_social" value="" required class="form-control"/>
              </div>
            </div>

            <div class="col-sm-6">
                <div class="form-group">
                     <label>Nome Fantasia</label>
                    <input autofocus type="text" name="nome_fantasia" value="" required class="form-control" />
                </div>
            </div>
         </div>
            
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
                  <input type="tel" name="telefone" value="" id="telefone"  class="form-control" data-inputmask='"mask": "(99) 9999-99999"' data-mask>
               </div>
            </div>
            <div class="col-sm-4">
               <div class="form-group">
                  <label>CNPJ</label>
                  <input type="text" name="cnpj" value="" id="cnpj" class="form-control" data-inputmask='"mask": "99.999.999/9999-99"' data-mask/>
               </div>
            </div>
        </div> <!--- end row 2 -->


            <div class="row">

                <div class="col-sm-4">
                    <label>CEP</label>
                    <input type="text" name="cep" value=""   id ="cep" onblur="buscarEnderecoCepApi(this.value);" class="form-control" data-inputmask='"mask": "999.999.999-99"' data-mask/>
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
                <input type="submit" name="submit_add_cliente" value="Enviar" class="btn btn-primary"/>
            </div>
            <br/>
            <br/>
        </form>
        </div>
    </div>
  </div>
<script>
    $(function() {
        //Initialize Select2 Elements
        $('.select2').select2()

        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })

        //Date and time picker
        $('#reservationdatetime').datetimepicker({
            icons: {
                time: 'far fa-clock'
            }
        });

        //Date range picker
        $('#reservation').daterangepicker()
        //Date range picker with time picker
        $('#reservationtime').daterangepicker({
            timePicker: true,
            timePickerIncrement: 30,
            locale: {
                format: 'MM/DD/YYYY hh:mm A'
            }
        })
    })
    // BS-Stepper Init
    document.addEventListener('DOMContentLoaded', function() {
        window.stepper = new Stepper(document.querySelector('.bs-stepper'))
    })
    // DropzoneJS Demo Code Start
    Dropzone.autoDiscover = false

    // Get the template HTML and remove it from the doumenthe template HTML and remove it from the doument
    var previewNode = document.querySelector("#template")
    previewNode.id = ""
    var previewTemplate = previewNode.parentNode.innerHTML
    previewNode.parentNode.removeChild(previewNode)

    var myDropzone = new Dropzone(document.body, { // Make the whole body a dropzone
        url: "/target-url", // Set the url
        thumbnailWidth: 80,
        thumbnailHeight: 80,
        parallelUploads: 20,
        previewTemplate: previewTemplate,
        autoQueue: false, // Make sure the files aren't queued until manually added
        previewsContainer: "#previews", // Define the container to display the previews
        clickable: ".fileinput-button" // Define the element that should be used as click trigger to select files.
    })



    // DropzoneJS Demo Code End
    function buscarEnderecoCepApi(cep) {
          $.ajax({url:'https://viacep.com.br/ws/'+cep+'/json/',
            success:function(data){
              debugger;
              $('#logradouro').val(data.logradouro);
              $('#complemento').val(data.complemento);
              $('#bairro').val(data.bairro);
              $('#municipio').val(data.localidade);
              $('#estado').val(data.uf);
          }
        })
    }
    </script>