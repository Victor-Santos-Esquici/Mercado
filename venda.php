<?php
  session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Venda</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- Plugin CSS -->
    <link href="css/remodal.css" rel="stylesheet" type="text/css">
    <link href="css/remodal-default-theme.css" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/png" href="img/shopping-icon.png"/>  
  </head>

  <?php
    include ("includes/dbconnect.php");
    $alertMessage = "";
    $vendaID = $_GET['id'];

    //read

    $consulta = $conexao->prepare("SELECT vendas.Data, sum(produtos.Valor * vendas_itens.Quantidade) as Total FROM vendas JOIN vendas_itens on vendas.ID = vendas_itens.VendaID JOIN produtos on vendas_itens.ProdutoID = produtos.ID WHERE vendas.ID = ? GROUP BY vendas_itens.VendaID");
    $consulta->execute(array($vendaID));
    $registrosVenda = $consulta->fetchAll();

    $consulta = $conexao->prepare("SELECT produtos.ID, produtos.Nome, tipos.Nome as TipoNome, produtos.Valor, vendas_itens.Quantidade FROM vendas_itens JOIN produtos on vendas_itens.ProdutoID = produtos.ID JOIN tipos on produtos.Tipo = tipos.ID WHERE vendas_itens.VendaID = ?");
    $consulta->execute(array($vendaID));
    $registrosProdutos = $consulta->fetchAll();
  ?>

  <body class="fixed-nav sticky-footer bg-dark" id="page-top">

    <?php include ('includes/menu.php'); ?>

    <div class="content-wrapper">
      <div class="container-fluid">

        <!-- Breadcrumbs -->
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Meu Mercado</a></li>
          <li class="breadcrumb-item"><a href="vendas.php">Vendas</a></li>
          <li class="breadcrumb-item active">Venda</li>
        </ol>

        <div class="col-md-12">

          <!--content-->
          <div class="panel panel-default">
            <h2>Venda Nº <?php echo $vendaID;?></h2>
            <hr>
              <?php
                foreach ($registrosVenda as $key => $value)
                {
                  echo "<p>Data: <span id='vendaData'>" . $value['Data'] . "</span></p>";
                  echo "<p>Total: R$ <span id='vendaValor'>" . $value['Total'] . "</span></p>";
                }
              ?>

              <h3>Produtos</h3>

              <table border="1">
                <thead>
                  <tr>
                    <td>Código</td>
                    <td>Nome</td>
                    <td>Tipo</td>
                    <td>Valor</td>
                    <td>Quantidade</td>
                  </tr>
                </thead>

                <tbody>
                  <?php
                    foreach ($registrosProdutos as $key => $value) 
                    {
                      echo "<tr>";
                      echo  "<td>" . $value['ID'] . "</td>";
                      echo  "<td>" . $value['Nome'] . "</td>";
                      echo  "<td>" . $value['TipoNome'] . "</td>";
                      echo  "<td class='vendaValor'>" . $value['Valor'] . "</td>";
                      echo  "<td>" . $value['Quantidade'] . "</td>";
                      echo "</tr>";
                    }
                  ?>
                </tbody>
              </table>
            </div>
          <br>
        </div>
      </div>
    </div>

    <?php include ('includes/footer.html'); ?>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/popper/popper.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="vendor/datatables/jquery.dataTables.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.js"></script>
    <script src="js/jquery.mask.min.js"></script>
    <script src="js/remodal.js"></script>

    <!-- Custom scripts for this template -->
    <script src="js/sb-admin.js"></script>

    <script>
      $(document).ready(function(){
        var data = new Date($("#vendaData")[0].innerHTML);
        var dataFormatada = data.getUTCDate() + "/" + (returnDate(data.getMonth()+1)) + "/" + data.getFullYear();

        $("#vendaData")[0].innerHTML = dataFormatada;

        $("#vendaValor").mask("00.000,00", {reverse: true});
        $(".vendaValor").mask("00.000,00", {reverse: true});

        function returnDate(month) {
          if (month < 10) {
            month = "0" + month;
          }

          return month;
        }

        $(".btnDelete").click(function() {
          var $item = $(this).closest("tr");
          var produtoID = $($item).find(".produtoID").data("id");
          var produtoNome = $($item).find(".produtoNome").html();
          $("input[name='produtoID']").val(produtoID);
          $(".deleteProduto").empty().append(produtoNome);
        });
      });
    </script>
  </body>
</html>