<style>
  @page {
    size: A4
  }
  /* Table header styles */
  #table-cliente thead {
    background-color: #ddd;
    font-weight: bold;
  }
  
  /* Table cell styles */
  #table-cliente td, #table-cliente th {
    padding: 8px;
    border: 0px solid #ddd;
  }
  
  /* Table stripe row styles */
  #table-cliente tbody tr:nth-child(even) {
    background-color: #f2f2f2;
  }
  #table-cliente{
    width: 100%;
    border-collapse: collapse;
    text-align: left;
  }
</style>

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
  
</form>
<div class="row">
<div class='col-md-12'>
<table id="table-cliente" class="table-striped">
            <thead style="background-color: #ddd; font-weight: bold;">
            <tr>
                <td>Codigo</td>
                <td>Data da Venda</td>
                <td>Cliente</td>
                <td>Vendedor</td>
                <td>Itens</td>
                <td>status</td>
                <td>Valor Total</td>
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
    </div>
  </div>
</div>