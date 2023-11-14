<link href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.3.0/paper.css" rel="stylesheet" />
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
<button type="buttom" class="btn btn-primary" onclick="gerarPdf">Gerar  PDF</button>
<button onclick="history.back()" class="btn btn-primary">Voltar</button>
  <br>
<body class="A4">

  <section class="sheet padding-10mm">

  <center><article><h1>Relatório de Vendas</h1></article></center>
  <hr>
 
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

  </section>

</body>