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

    $consulta = $conexao->prepare("SELECT produtos.ID, produtos.Nome, tipos.Nome as Tipo, produtos.Valor, vendas_itens.Quantidade, (produtos.Valor * vendas_itens.Quantidade) as Total FROM vendas_itens JOIN produtos on vendas_itens.ProdutoID = produtos.ID JOIN tipos on produtos.Tipo = tipos.ID WHERE vendas_itens.VendaID = ?");
    $consulta->execute(array($vendaID));
    $registrosProdutos = $consulta->fetchAll();

    $vendaData = "";
    $vendaTotal = "";

    foreach ($registrosVenda as $key => $value)
    {
      $vendaData = $value['Data'];
      $vendaTotal = $value['Total'];
    }
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

        <!--content-->
        <div class="container">
          <div class="row">
            <fieldset class="col-md-12">
              <legend class="text-center">Venda Nº <?php echo $vendaID; ?></legend>

              <div class="form-group">
                <label class="col-md-12">Data</label>  
                <div class="col-md-12 center-block text-center pagination-centered inputGroupContainer">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                    <input id="vendaData" name="vendaData" class="form-control" type="text" value="<?php echo $vendaData?>" disabled>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label class="col-md-12">Total</label>
                <div class="col-md-12 center-block text-center pagination-centered inputGroupContainer">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-dollar" aria-hidden="true"></i></span>
                    <input name="vendaTotal" class="form-control" type="text" value="<?php echo $vendaTotal?>" disabled>
                  </div>
                </div>
              </div>
            </fieldset>
          </div>
        </div>

        <div class="container">
          <div class="row">
            <fieldset class="col-md-12">
              <legend class="text-center">Produtos</legend>

              <div class="row">
                <div class="form-group col-md-3">
                  <div class="col-md-12 center-block text-center pagination-centered inputGroupContainer">
                    <div class="input-group">
                      <label class="col-md-12">Produto</label>
                    </div>
                  </div>
                </div>
                <div class="form-group col-md-3">
                  <div class="col-md-12 center-block text-center pagination-centered inputGroupContainer">
                    <div class="input-group">
                      <label class="col-md-12">Tipo</label>
                    </div>
                  </div>
                </div>
                <div class="form-group col-md-2">
                  <div class="col-md-12 center-block text-center pagination-centered inputGroupContainer">
                    <div class="input-group">
                      <label class="col-md-12">Valor</label>
                    </div>
                  </div>
                </div>
                <div class="form-group col-md-2">
                  <div class="col-md-12 center-block text-center pagination-centered inputGroupContainer">
                    <div class="input-group">
                        <label class="col-md-12">Quantidade</label>
                    </div>
                  </div>
                </div>
                <div class="form-group col-md-2">
                  <div class="col-md-12 center-block text-center pagination-centered inputGroupContainer">
                    <div class="input-group">
                      <label class="col-md-12">Total</label>
                    </div>
                  </div>
                </div>
              </div>

              <?php
                foreach ($registrosProdutos as $key => $value) {
                  echo 
                  "<div class='row'>" .
                    "<div class='form-group col-md-3'>" . 
                      "<div class='col-md-12 center-block text-center pagination-centered inputGroupContainer'>" .
                        "<div class='input-group'>" .
                          "<span class='input-group-addon'><i class='fa fa-shopping-basket' aria-hidden='true'></i></span>" .
                          "<input class='form-control' name='produtoNome' type='text' value='" . $value['Nome'] . "' disabled>" .
                        "</div>" .
                      "</div>" .
                    "</div>" .
                    "<div class='form-group col-md-3'>" .
                      "<div class='col-md-12 center-block text-center pagination-centered inputGroupContainer'>" .
                        "<div class='input-group'>" .
                          "<span class='input-group-addon'><i class='fa fa-dollar' aria-hidden='true'></i></span>" .
                          "<input class='form-control' name='produtoValor' type='text' value='" . $value['Tipo'] . "' disabled>" .
                        "</div>" .
                      "</div>" .
                    "</div>" .
                    "<div class='form-group col-md-2'>" .
                      "<div class='col-md-12 center-block text-center pagination-centered inputGroupContainer'>" .
                        "<div class='input-group'>" .
                          "<span class='input-group-addon'><i class='fa fa-dollar' aria-hidden='true'></i></span>" .
                          "<input class='form-control' name='produtoValor' type='text' value='" . $value['Valor'] . "' disabled>" .
                        "</div>" .
                      "</div>" .
                    "</div>" .
                    "<div class='form-group col-md-2'>" .
                      "<div class='col-md-12 center-block text-center pagination-centered inputGroupContainer'>" .
                        "<div class='input-group'>" .
                          "<span class='input-group-addon'><i class='fa fa-shopping-cart' aria-hidden='true'></i></span>" .
                          "<input class='form-control' name='produtoQuantidade' type='text' value='" . $value['Quantidade'] . "' disabled>" .
                        "</div>" .
                      "</div>" .
                    "</div>" .
                    "<div class='form-group col-md-2'>" .
                      "<div class='col-md-12 center-block text-center pagination-centered inputGroupContainer'>" .
                        "<div class='input-group'>" .
                          "<span class='input-group-addon'><i class='fa fa-dollar' aria-hidden='true'></i></span>" .
                          "<input class='form-control' name='produtoTotal' type='text' value='" . $value['Total'] . "' disabled>" .
                        "</div>" .
                      "</div>" .
                    "</div>" .
                  "</div>";
                }
              ?>
            </fieldset>
          </div>
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
    <script src="js/remodal.js"></script>

    <!-- Custom scripts for this template -->
    <script src="js/sb-admin.js"></script>

    <script>
      $(document).ready(function(){
        var data = new Date($("#vendaData").val());
        var dataFormatada = data.getUTCDate() + "/" + (returnDate(data.getMonth()+1)) + "/" + data.getFullYear();

        $("#vendaData").val(dataFormatada);

        function returnDate(month) {
          if (month < 10) {
            month = "0" + month;
          }

          return month;
        }
      });
    </script>
  </body>
</html>