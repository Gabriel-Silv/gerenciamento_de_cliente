

<div class="col-md-12">

    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Dados do Cliente</h3>
        </div>
        <div class="card-body">
        <form action="<?php echo URL; ?>clientes/add" method="POST">
            <div class="form-group">
                <br>
                <div class="col-xs-6">
                    <label>razao_social</label>
                    <input type="text" name="razao_social" value="" required class="form-control"/>
                </div>

                <div class="col-xs-6">
                    <label>nome_fantasia</label>
                    <input autofocus type="text" name="nome_fantasia" value="" required class="form-control" />
                </div>
              
                <div class="col-xs-12">
                    <label>E-mail</label>
                    <input type="email" name="email" value="" required class="form-control"/>
                </div>
      
                <div class="col-xs-6">
                    <label>telefone</label>
                    <input type="text" name="telefone" value="" class="form-control"/>
                </div>
                
                
                <div class="col-xs-6">
                    <label>cnpj</label>
                    <input type="text" name="cnpj" value="" class="form-control"/>
                </div>
                
                <br>
                <br>
                <div class="col-xs-2">
                    <label>cep</label>
                    <input type="text" name="cep" value="" class="form-control"/>
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
                
                <div class="form-group">
                  <label for="estado">estado</label>
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

                
                
                <div class="col-xs-4">
                    <label>municipio</label>
                    <input type="text" name="municipio" value="" class="form-control"/>
                </div>

                <div class="col-xs-6">
                    <label>pais</label>
                    <input type="text" name="pais" value="" class="form-control"/>
                </div>
                

                
                <input type="submit" name="submit_add_cliente" value="Enviar" class="btn btn-primary"/>
            </div>

<br/>
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

        //Datemask dd/mm/yyyy
        $('#datemask').inputmask('dd/mm/yyyy', {
            'placeholder': 'dd/mm/yyyy'
        })
        //Datemask2 mm/dd/yyyy
        $('#datemask2').inputmask('mm/dd/yyyy', {
            'placeholder': 'mm/dd/yyyy'
        })
        //Money Euro
        $('[data-mask]').inputmask()

        //Date picker
        $('#reservationdate').datetimepicker({
            format: 'L'
        });

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


        //Bootstrap Duallistbox
        $('.duallistbox').bootstrapDualListbox()


        $("input[data-bootstrap-switch]").each(function() {
            $(this).bootstrapSwitch('state', $(this).prop('checked'));
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



    // Setup the buttons for all transfers
    // The "add files" button doesn't need to be setup because the config
    // `clickable` has already been specified.
    document.querySelector("#actions .start").onclick = function() {
        myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED))
    }
    document.querySelector("#actions .cancel").onclick = function() {
        myDropzone.removeAllFiles(true)
    }
    // DropzoneJS Demo Code End
    </script>