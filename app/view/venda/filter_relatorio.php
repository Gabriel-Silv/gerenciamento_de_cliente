<style>
  @page {
    size: A4 landscape;
  }

  #table-cliente thead {
    background-color: #ddd;
    font-weight: bold;
  }
  
  #table-cliente td, #table-cliente th {
    padding: 3px;
    border: 0px solid #ddd;
  }
  
  #table-cliente tbody tr:nth-child(even) {
    background-color: #f2f2f2;
  }
  #table-cliente{
    width: 100%;
    border-collapse: collapse;
    text-align: left;
  }
</style>

<form method="POST" action="<?php echo URL; ?>venda/filterRelatorioVendas">
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
<div class="col-md-2" >
  <label for="status" class="form-label">Status:</label>
  <select name="status" id="status" class="form-select form-control">
    <option value="">Status</option>
    <option value="Pendente">Pendente</option>
    <option value="Cancelada">Cancelada</option>
    <option value="Finalizada">Finalizada</option>

  </select>
</div>
<div class="col-md-6" >
  <label for="vendedor" class="form-label">Vendedor:</label>
  <select name="vendedor" id="vendedor" class="form-select form-control">
    <option value="">Selecione um Vendedor</option>
    
  </select>
</div>
  <div class="col-md-4  " >
  <label for="cliente" class="form-label">Cliente:</label>
  <select name="cliente" id="cliente" class="form-select form-control">
    <option value="">Selecione um Cliente</option>

    
  </select>
  <br>
  </div>

   </div>

<div class="row">
<div class='col-md-12'>
<link href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.3.0/paper.css" rel="stylesheet" />
<button type="submit" class="btn btn-primary">Filtrar</button>


<button onclick="history.back()" class="btn btn-primary">Voltar</button>
  <br>
 
<body class="A4">

  <section class="sheet padding-10mm">
  <style>
  @page {
    size: A4 landscape;
  }

  #table-cliente thead {
    background-color: #ddd;
    font-weight: bold;
  }
  
 
  #table-cliente td, #table-cliente th {
    padding: 3px;
    border: 0px solid #ddd;
  }
  
  
  #table-cliente tbody tr:nth-child(even) {
    background-color: #f2f2f2;
  }
  #table-cliente{
    width: 100%;
    border-collapse: collapse;
    text-align: left;
  }
</style>

  <center><article><h1>Relatório de Vendas</h1></article></center>
  <hr>
  
  <table id="table-cliente" class="">
            <thead style="">
            <tr>
                <th>Cod.</th>
                <th>Data</th>
                <th style='width:200px;'>Cliente</th>
                <th>Vendedor</th>
                <th>Itens</th>
                <th>status</th>
                <th>Valor Total</th>
            </tr>
            </thead>
            <tbody>
            <?php 
            $total_geral =0;
            $quantidade=0;
            foreach ($vendas as $venda):
              $total_geral = $total_geral+ $venda->total_venda;
              $quantidade=$quantidade+$venda->quantidade;
              ?>
            <tr>
              <td><center><?= isset($venda->codigo) ? htmlspecialchars($venda->codigo, ENT_QUOTES, 'UTF-8') : ''; ?></center></td>
              <td><?= isset($venda->data_venda) ? htmlspecialchars($venda->data_venda, ENT_QUOTES, 'UTF-8') : ''; ?></td>
              <td><?= isset($venda->razao_social) ? htmlspecialchars($venda->razao_social, ENT_QUOTES, 'UTF-8') : ''; ?></td>
              <td><?= isset($venda->nome_vendedor) ? htmlspecialchars($venda->nome_vendedor, ENT_QUOTES, 'UTF-8') : ''; ?></td>
              <td><center><?= isset($venda->quantidade) ? htmlspecialchars($venda->quantidade, ENT_QUOTES, 'UTF-8') : ''; ?></center></td>
              <td><?= isset($venda->status_venda) ? htmlspecialchars($venda->status_venda, ENT_QUOTES, 'UTF-8') : ''; ?></td>
              <td><?= isset($venda->total_venda) ? htmlspecialchars(number_format($venda->total_venda, 2, '.', ',') , ENT_QUOTES, 'UTF-8') : ''; ?></td>
    
       <?php endforeach; ?>
        <tr style="background-color: #ddd;">
        <td  colspan="4">
            <b>TOTAL VENDA</b>
        </td>
        <td>
        <b><center><?php echo $quantidade?></center></b>
        </td>
        <td  collspan="1">
          </td>
          <td  collspan="1">
            <b><?php echo number_format($total_geral, 2, '.', ','); ?></b>
          </td>
        </tr>
        </tbody>
        </table>
        <br>
  <br>
        
  <br>
  <br>
<br>
        
  </section>
  </form>
  <button type="button" onclick="gerarPdf()" class="btn btn-primary">Gerar PDF</button>
</div>