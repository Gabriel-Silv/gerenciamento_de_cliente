<form method="POST" action="<?php echo URL; ?>venda/relatoriovendas">
  <h1>Relatorio de Vendas Filtro</h1>
 <div class="row">
<div class="col-md-6" >
  <label for="data" class="form-label">Data Inicial:</label>
  <input type="date" name="data_inicial" id="data_inicial" class="form-control">
</div>
<div class="col-md-6" >
  <label for="data" class="form-label">Data Final:</label>
  <input type="date" name="data_final" id="data_final" class="form-control">
</div>
<div class="col-md-6" >
  <label for="vendedor" class="form-label">Vendedor:</label>
  <select name="vendedor" id="vendedor" class="form-select form-control">
    <option value="">Selecione um Vendedor</option>
    <!-- Adicione mais opções de vendedores conforme necessário -->
  </select>
  </div>
  <div class="col-md-6" >
  <label for="cliente" class="form-label">Cliente:</label>
  <select name="cliente" id="cliente" class="form-select form-control">
    <option value="">Selecione um Cliente</option>
</div>
    <!-- Adicione mais opções de clientes conforme necessário -->
  </select>

  <br>

  <button type="submit" class="btn btn-primary">Visualizar relatório</button>
  <button type="submit" class="btn btn-primary">Gerar PDF</button>
</form>
</div>