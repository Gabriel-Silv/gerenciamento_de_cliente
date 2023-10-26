$(function() {

    // just a super-simple JS demo

    var demoHeaderBox;

    // simple demo to show create something via javascript on the page
    if ($('#javascript-header-demo-box').length !== 0) {
    	demoHeaderBox = $('#javascript-header-demo-box');
    	demoHeaderBox
    		.hide()
    		.text('Hello from JavaScript! This line has been added by public/js/application.js')
    		.css('color', 'green')
    		.fadeIn('slow');
    }

    // if #javascript-ajax-button exists
    if ($('#javascript-ajax-button').length !== 0) {

        $('#javascript-ajax-button').on('click', function(){

            // send an ajax-request to this URL: current-server.com/songs/ajaxGetStats
            // "url" is defined in views/_templates/footer.php
            $.ajax(url + "/songs/ajaxGetStats")
                .done(function(result) {
                    // this will be executed if the ajax-call was successful
                    // here we get the feedback from the ajax-call (result) and show it in #javascript-ajax-result-box
                    $('#javascript-ajax-result-box').html(result);
                })
                .fail(function() {
                    // this will be executed if the ajax-call had failed
                })
                .always(function() {
                    // this will ALWAYS be executed, regardless if the ajax-call was success or not
                });
        });
    }

    AddItens= function () {
        debugger;
        var newRow = $("<tr>");
        var cols = "";                                  
        cols += "<td>" +$('#codigo').val() + "</td>";
        cols+= "<td>" +$('#descricao').val() + "</td>";
        cols += "<td>" +$('#unidade').val() + "</td>";
        cols += "<td>" +$('#quantidade').val() + "</td>";
        cols += "<td>" +$('#valor').val() + "</td>";
        cols += "<td>" +$('#desconto').val() + "</td>";
        cols += "<td>" +$('#valor_total').val() + "</td>";
        cols += '<button class="btn btn-large btn-danger" onclick="RemoveTableRow(this)" type="button">Remover</button>';
        cols += '</td>';
        newRow.append(cols);
        $("#table_vendas").append(newRow);
        var dadosItens = [];

      var intensVendas = { 
                id_venda:    $(this).find('.id_venda').text() , 
                descricao:   $(this).find('.descricao').text(),
                unidade:    $(this).find('.unidade').text(),
                quantidade:  $(this).find('.quantidade').text(),
                valor:       $(this).find('.valor').text(),
                desconto:    $(this).find('.desconto').text(),
                valor_total: $(this).find('.valor_total').text(),
           };
      dadosItens.push(intensVendas);
        return false;
};

    CalcularValorTotal=  function(){
        debugger;
        $('#valor_total').val($('#quantidade').val() * $('#valor').val() - $('#desconto').val());
    }

    finalizarVenda = function () {
        dadosVendas = [];
        itensVendas = [];
         // Obter os dados do formulário
    var formulario = $('#form_insert_venda').serializeArray();
    var formData = {};
    // Converter os dados do formulário em um objeto
    $.each(formulario, function(index, field) {
    formData[field.name] = field.value;
   });
        dadosVendas.push(formData);
        $('#form_insert_venda tr').each(function() {
          var linhaDados = [];
          $(this).find('td').each(function() {
            linhaDados.push($(this).text());
          });
          itensVendas.push(linhaDados);
        });
        debugger;
        dadosPost=  {"dados_vendas":JSON.stringify(dadosVendas),"itens_vendas":JSON.stringify(itensVendas)};
        console.log(dadosPost);
        // Enviar os dados via POST com AJAX
        $.ajax({
          url: '/venda/add',
          type: 'POST',
          contentType: 'application/json',
          data: dadosPost,
          success: function() {
            // Callback de sucesso
            console.log('Dados enviados com sucesso!');
          },
          error: function() {
            // Callback de erro
            console.error('Erro ao enviar os dados!');
          }
        });
      }
    
})


