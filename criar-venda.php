<?php
  session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Vender</title>

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

    //read
    $consulta = $conexao->prepare("SELECT * FROM produtos");
    $consulta->execute();
    $produtos = $consulta->fetchAll();
  ?>

  <body class="fixed-nav sticky-footer bg-dark" id="page-top">

    <?php include ('includes/menu.php'); ?>

    <div class="content-wrapper">
      <div class="container-fluid">

        <!-- Breadcrumbs -->
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Meu Mercado</a></li>
          <li class="breadcrumb-item"><a href="vendas.php">Vendas</a></li>
          <li class="breadcrumb-item active">Vender</li>
        </ol>

        <!-- content -->
        <div class="container">
          <div class="row">
            <fieldset class="col-md-12">
              <legend class="text-center">Vender</legend>

              <div class="form-group">
                <label class="col-md-12">Data</label>  
                <div class="col-md-12 center-block text-center pagination-centered inputGroupContainer">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                    <input name="vendaData" class="form-control" type="text" disabled>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label class="col-md-12">Total</label>
                <div class="col-md-12 center-block text-center pagination-centered inputGroupContainer">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-dollar" aria-hidden="true"></i></span>
                    <input name="vendaTotal" class="form-control" type="text" value="0" disabled>
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

              <div class="newProduct"></div>

              <div class="row">
                <div class="form-group col-md-8"> 
                  <label class="col-md-12">Produto</label>
                  <div class="col-md-12 selectContainer">
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-shopping-basket" aria-hidden="true"></i></span>
                      <select id="produtoNome" name="produtoNome" class="form-control selectpicker">
                        <option value=" ">Selecione o Produto</option>
                        <?php
                          foreach($produtos as $key => $value)
                          {
                            echo "<option value='" . $value['ID'] . "' data-valor='" . $value['Valor'] . "'>" . $value['Nome'] . "</option>";
                          }
                        ?>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="form-group col-md-3">
                  <label class="col-md-12">Quantidade</label>
                  <div class="col-md-12 center-block text-center pagination-centered inputGroupContainer">
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-shopping-cart" aria-hidden="true"></i></span>
                      <input name="vendaQuantidade" class="form-control" type="text" placeholder="0">
                    </div>
                  </div>
                </div>

                <div class="form-group col-md-1">
                  <div class="col-md-12 center-block text-center pagination-centered inputGroupContainer">
                    <div class="input-group">
                      <button type="submit" class="btn btn-primary btnAdd" style="margin-top: 32px; cursor: pointer;"><i class="fa fa-plus" aria-hidden="true"> </i></button>
                    </div>
                  </div>
                </div>
              </div>
            </fieldset>
          </div>
        </div>

        <form>
          <input type="hidden" name="produtosID">
          <div class="form-group">
            <div class="col-md-12 text-center">
              <button type="button" class="btn btn-success">Vender <i class="fa fa-paper-plane" aria-hidden="true"></i></button>
            </div>
          </div>
        </form>
      </div>
    </div>

    <div class="remodal" data-remodal-id="alertModal">
      <button data-remodal-action="close" class="remodal-close"></button>
      <h2><?php echo $alertMessage; ?></h2>
      <br>
      <button data-remodal-action="confirm" class="remodal-confirm">OK</button>
    </div>

    <?php include ('includes/footer.html'); ?>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/popper/popper.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="js/jquery.mask.min.js"></script>
    <script src="js/bootstrapValidator.min.js"></script>
    <script src="js/remodal.js"></script>

    <!-- Custom scripts for this template -->
    <script src="js/sb-admin.js"></script>

    <script>
      $(document).ready(function() {
        $(".vendaTotal").mask("00.000,00", {reverse: true});
        $(".produtoTotal").mask("00.000,00", {reverse: true});
        
        $("input[name='vendaData']").val(getToday());

        $(".input-group").on("click", ".btnAdd", function() {

          var produtoID = $("#produtoNome").val();
          var produtoNome = $("#produtoNome option:selected").text();
          var produtoValor = $("#produtoNome option:selected").data("valor");
          var produtoQuantidade = $("input[name='vendaQuantidade']").val();
          var vendaTotal = parseFloat($("input[name='vendaTotal']").val());
          var produtoTotal = (produtoValor * produtoQuantidade).toFixed(2);
          vendaTotal += produtoValor * produtoQuantidade;
          vendaTotal = Number(vendaTotal).toFixed(2);

          var produtosID = $("input[name='produtosID']").val();
          produtosID += produtoID + ",";
          $("input[name='produtosID']").val(produtosID);

          if ($(".newProduct").children().length == 0) {
            $(".newProduct").append(
              "<div class='row header'>" +
                "<div class='form-group col-md-5'>" + 
                  "<div class='col-md-12 center-block text-center pagination-centered inputGroupContainer'>" +
                    "<div class='input-group'>" +
                      "<label class='col-md-12'>Produto</label>" +
                    "</div>" + 
                  "</div>" +
                "</div>" +
                "<div class='form-group col-md-2'>" + 
                  "<div class='col-md-12 center-block text-center pagination-centered inputGroupContainer'>" +
                    "<div class='input-group'>" +
                      "<label class='col-md-12'>Valor</label>" +
                    "</div>" + 
                  "</div>" +
                "</div>" +
                "<div class='form-group col-md-2'>" + 
                  "<div class='col-md-12 center-block text-center pagination-centered inputGroupContainer'>" +
                    "<div class='input-group'>" +
                      "<label class='col-md-12'>Quantidade</label>" +
                    "</div>" + 
                  "</div>" +
                "</div>" +
                "<div class='form-group col-md-2'>" + 
                  "<div class='col-md-12 center-block text-center pagination-centered inputGroupContainer'>" +
                    "<div class='input-group'>" +
                      "<label class='col-md-12'>Total</label>" +
                    "</div>" + 
                  "</div>" +
                "</div>" +
              "</div>"
            );
          }

          $(".newProduct").append(
            "<div class='row'>" +
              "<div class='form-group col-md-5'>" + 
                "<div class='col-md-12 center-block text-center pagination-centered inputGroupContainer'>" +
                  "<div class='input-group'>" +
                    "<span class='input-group-addon'><i class='fa fa-shopping-basket' aria-hidden='true'></i></span>" +
                    "<input class='form-control' name='produtoNome' type='text' value='" + produtoNome + "' disabled>" +
                  "</div>" + 
                "</div>" +
              "</div>" +
              "<div class='form-group col-md-2'>" + 
                "<div class='col-md-12 center-block text-center pagination-centered inputGroupContainer'>" +
                  "<div class='input-group'>" +
                    "<span class='input-group-addon'><i class='fa fa-dollar' aria-hidden='true'></i></span>" +
                    "<input class='form-control' name='produtoValor' type='text' value='" + produtoValor + "' disabled>" +
                  "</div>" + 
                "</div>" +
              "</div>" +
              "<div class='form-group col-md-2'>" + 
                "<div class='col-md-12 center-block text-center pagination-centered inputGroupContainer'>" +
                  "<div class='input-group'>" +
                    "<span class='input-group-addon'><i class='fa fa-shopping-cart' aria-hidden='true'></i></span>" +
                    "<input class='form-control' name='produtoQuantidade' type='text' value='" + produtoQuantidade + "' disabled>" +
                  "</div>" + 
                "</div>" +
              "</div>" +
              "<div class='form-group col-md-2'>" + 
                "<div class='col-md-12 center-block text-center pagination-centered inputGroupContainer'>" +
                  "<div class='input-group'>" +
                    "<span class='input-group-addon'><i class='fa fa-dollar' aria-hidden='true'></i></span>" +
                    "<input class='form-control' name='produtoTotal' type='text' value='" + produtoTotal + "' disabled>" +
                  "</div>" + 
                "</div>" +
              "</div>" +
              "<div class='form-group col-md-1'>" + 
                "<div class='col-md-12 center-block text-center pagination-centered inputGroupContainer'>" +
                  "<div class='input-group'>" +
                    "<button type='button' class='btn btn-danger btnRemove' data-produto-id='" + produtoID + "' style='cursor: pointer;'><i class='fa fa-close' aria-hidden='true'> </i></button>" +
                  "</div>" + 
                "</div>" +
              "</div>" +
            "</div>"
          );

          $("#produtoNome option[value='" + produtoID + "']").remove();
          $("input[name='vendaNome']").val("");
          $("input[name='vendaQuantidade']").val("");
          $("input[name='vendaTotal']").val(vendaTotal);
          $("input[name='produtoTotal']").val
        });
        
        $(".newProduct").on("click", ".btnRemove", function() {
          var produtoID = $(this).data("produto-id");
          var produtoNome = $(this).closest(".row").find("input[name='produtoNome']").val();
          var produtoValor = $(this).closest(".row").find("input[name='produtoValor']").val();
          var produtoTotal = $(this).closest(".row").find("input[name='produtoTotal']").val();
          var vendaTotal = $("input[name='vendaTotal']").val();
          vendaTotal -= produtoTotal;
          vendaTotal = Number(vendaTotal).toFixed(2);

          /*if (vendaTotal < 0) {
            vendaTotal = 0;
          }*/
          
          $(this).closest(".row").remove();

          if ($(".newProduct").children().length == 1) {
            $(".header").remove();
          }

          var produtosID = $("input[name='produtosID']").val();
          produtosID = produtosID.replace(produtoID + ",", "");
          $("input[name='produtosID']").val(produtosID);

          $("input[name='vendaTotal']").val(vendaTotal);

          $("#produtoNome").append($("<option>", {
            'value': produtoID,
            'text': produtoNome,
            'data-valor': produtoValor
          }));

          //sort the values
          var selectList = $("#produtoNome option");

          selectList.sort(function(a,b) {
            a = a.value;
            b = b.value;
            return a-b;
          });

          $("#produtoNome").html(selectList);
        });

        function getToday() {
          var today = new Date();
          var dd = today.getDate();
          var mm = today.getMonth() + 1;
          var yyyy = today.getFullYear();

          if (dd < 10) {
              dd = '0' + dd;
          }

          if (mm < 10) {
              mm = '0' + mm;
          }

          var today = dd + '/' + mm + '/' + yyyy;
          return today;
        }
      });
    </script>
  </body>
</html>