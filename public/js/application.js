$(function () {

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

    $('#javascript-ajax-button').on('click', function () {

      // send an ajax-request to this URL: current-server.com/songs/ajaxGetStats
      // "url" is defined in views/_templates/footer.php
      $.ajax(url + "/songs/ajaxGetStats")
        .done(function (result) {
          // this will be executed if the ajax-call was successful
          // here we get the feedback from the ajax-call (result) and show it in #javascript-ajax-result-box
          $('#javascript-ajax-result-box').html(result);
        })
        .fail(function () {
          // this will be executed if the ajax-call had failed
        })
        .always(function () {
          // this will ALWAYS be executed, regardless if the ajax-call was success or not
        });
    });
  }

  AddItens = function () {
    desconto=$('#desconto').val();
    desconto=desconto.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
    // Salvar os dados do item no localStorage
    debugger;
    var itemData = {
    codigo: $('#codigo').val(),
    descricao: $('#descricao').val().toUpperCase(),
    unidade: $('#unidade').val(),
    quantidade: $('#quantidade').val(),
    valor: $('#valor').val(),
    desconto: desconto,
    valor_total: $('#valor_total').val()
  };
 

  var newRow = $("<tr>");
  var cols = "";
  cols += "<td>" + itemData.codigo + "</td>";
  cols += "<td>" + itemData.descricao + "</td>";
  cols += "<td>" + itemData.unidade + "</td>";
  cols += "<td>" + itemData.quantidade + "</td>";
  cols += "<td>" + itemData.valor + "</td>";
  cols += "<td>" + itemData.desconto + "</td>";
  cols += "<td>" + itemData.valor_total + "</td>";
  cols += '<td><button class="btn btn-small btn-danger" onclick="RemoveTableRow(this)" type="button"><i class="fas fa-trash-alt"></i></button></td>';
  cols += '</td>';
  newRow.append(cols);
  $("#table_vendas").append(newRow);
  localStorage.setItem('itemData', JSON.stringify(itemData));
  limpaCamposIntensVenda();
  return true;
  };
  function limpaCamposIntensVenda() {
    $('#codigo').val('');
    $('#descricao').val('');
    $('#unidade').val('');
    $('#quantidade').val('');
    $('#valor').val('');
    $('#desconto').val('');
    $('#valor_total').val('');
  }

  CalcularValorTotal = function () {
    if ($('#quantidade').val() === "" || $('#valor').val() === "") {
      return;
    }
    var quantidade = parseFloat($('#quantidade').val());
    var valor = parseFloat($('#valor').val().replace(/[^\d.,]/g, '').replace(',', '.'));
    var desconto = parseFloat($('#desconto').val() || 0);    
    var valorTotal = quantidade * valor - desconto;
    $('#valor_total').val(valorTotal.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' }));  
 }

  RemoveTableRow= function (button) {
  // Encontra a linha pai do botão clicado
  var row = $(button).closest('tr');
  // Remove a linha da tabela
  row.remove();
  localStorage.removeItem(button);
}
  finalizarVenda = function () {
    dadosVendas = [];
    itensVendas = [];
    // Obter os dados do formulário
    var formulario = $('#form_insert_venda').serializeArray();
    var formData = {};
    // Converter os dados do formulário em um objeto
    $.each(formulario, function (index, field) {
      formData[field.name] = field.value;
    });
    debugger;
    dadosVendas.push(formData);
    itemData = JSON.parse(localStorage.getItem('itemData'));
    // Enviar os dados via POST com AJAX

    dadosPost = { 
                 dados_venda: JSON.stringify(dadosVendas),
                 itens_venda: JSON.stringify({itemData}) 
                };
    console.log(dadosPost) ;
    console.log($.param(dadosPost));

    $.ajax({
      url: '/venda/finalizarVenda',
      type: 'POST',
      //contentType: 'application/json',
      contentType: 'application/x-www-form-urlencoded', // Updated content type
      data: $.param(dadosPost),
      success: function () {
        alert('Venda registrada com sucesso!');
        console.log('Dados enviados com sucesso!');
      },
      error: function () {
        // Callback de erro
        console.error('Erro ao enviar os dados!');
      }
    });
  }
  $(document).ready(function () {
    debugger;
    carregarFuncionarios();
    carregarClientes();
  });

  function carregarFuncionarios() {
    // Fazer a requisição AJAX para obter os funcionários da tabela "funcionario"
    $.ajax({
      url: '/funcionarios/obterTodosFuncionariosToCombox',
      type: 'GET',
      success: function (data) {
        var data = JSON.parse(data);
        $('#vendedor').empty();
        var option = $('<option>').attr('value', "").text("Selecione o vendedor");
        $('#vendedor').append(option);
        $.each(data['data'], function (index, funcionario) {
           var option = $('<option>').attr('value', funcionario.id).text(funcionario.nome);
          $('#vendedor').append(option);
        });
      },
      error: function () {
       
      }
    });
  }
  function carregarClientes() {
    $.ajax({
      url: '/clientes/obterTodosClientesToCombox',
      type: 'GET',
      success: function (data) {
        // Limpar as opções anteriores do combobox
       var data = JSON.parse(data);
        $('#cliente').empty();
        var option = $('<option>').attr('value', "").text("Selecione um Cliente");
        $('#cliente').append(option);
        $.each(data['data'], function (index, funcionario) {
          var option = $('<option>').attr('value', funcionario.id).text(funcionario.razao_social);
          $('#cliente').append(option);
        });
      },
      error: function () {
        //console.error('Erro ao carregar funcionários!');
      }
    });
  }

  buscarDadosDoProduto = function () {
    var codigo = $('#codigo').val();
    if (codigo.trim() === "") {
      return;
    }
    $.ajax({
      url: '/produtos/getProdutoPorcodigo/' + codigo,
      type: 'GET',
      success: function (data) {
        var produto = JSON.parse(data);
        $('#id').val(produto.data.id);
        $('#codigo').val(produto.data.codigo);
        $('#descricao').val(produto.data.descricao.toUpperCase());
        $('#unidade').val(produto.data.unidade);
        $('#valor').val(produto.data.valor);
        $('#valor').val(Number(produto.data.valor).toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' }));
      }
    });
  }


  buscarClienteId = function () {
   
    var codigo = $('#cliente').val();
    if (codigo.trim() === "") {
      return;
    }
    $.ajax({
      url: '/clientes/buscaClienteById/'+codigo,
      type: 'GET',
      success: function (data) {
        var cliente = JSON.parse(data);
        $('#cpf_cnpj').val(cliente.cnpj);
      }
    });
  }

  $(document).on('keydown', 'input', function (e) {
    if (e.which === 13) { // Verifica se a tecla pressionada é a tecla "Enter"
      e.preventDefault(); // Impede que o evento padrão do "Enter" seja disparado
      // Obtém todos os elementos focáveis em uma array
      var focaveis = $(':focusable');
      // Obtém o índice do elemento atualmente focado
      var indiceAtual = focaveis.index(this);
      // Move o foco para o próximo elemento
      if (indiceAtual < focaveis.length - 1) {
        focaveis.eq(indiceAtual + 1).focus();
      } else {
        focaveis.eq(0).focus(); // Se o último elemento for focado, move o foco para o primeiro elemento
      }
    }
  });

});