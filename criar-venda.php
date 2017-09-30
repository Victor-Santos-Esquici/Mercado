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

    /*
    if (isset($_POST['produtoNome']))
    {
      if ($_POST['produtoID'] > 0) //edit
      {
        if (!isset($_SESSION['usuarioID']) != "")
        {
          header("Location: index.php#alertModal");
        }

        $produtoID = $_POST['produtoID'];
        $produtoNome = $_POST['produtoNome'];
        $produtoTipo = $_POST['produtoTipo'];
        $produtoValor = $_POST['produtoValor'];
        $produtoEstoque = $_POST['produtoEstoque'];

        $produtoValor = str_replace(".", "", $produtoValor);
        $produtoValor = str_replace(",", ".", $produtoValor);
        print_r($produtoValor);

        $consulta = $conexao->prepare("UPDATE produtos SET Nome = ?, Tipo = ?, Valor = ?, Estoque = ? WHERE ID = ?");
        $consulta->execute(array($produtoNome, $produtoTipo, $produtoValor, $produtoEstoque, $produtoID));
        $resultado = $consulta->rowCount();
        
        if ($resultado == 0)
        {
          $alertMessage = "Falha ao atualizar o registro.";
        }
        else
        {
          $alertMessage = "Registro atualizado com sucesso!";
        }
      }
      else //insert
      {
        if (!isset($_SESSION['usuarioID']) != "")
        {
          header("Location: index.php#alertModal");
        }

        $produtoNome = $_POST['produtoNome'];
        $produtoTipo = $_POST['produtoTipo'];
        $produtoValor = $_POST['produtoValor'];
        $produtoEstoque = $_POST['produtoEstoque'];

        $produtoValor = str_replace(".", "", $produtoValor);
        $produtoValor = str_replace(",", ".", $produtoValor);
        $produtoEstoque = str_replace(".", "", $produtoEstoque);

        $consulta = $conexao->prepare("INSERT INTO produtos (Nome, Tipo, Valor, Estoque) VALUES (?,?,?,?)");
        $consulta->execute(array($produtoNome, $produtoTipo, $produtoValor, $produtoEstoque));
        $resultado = $consulta->rowCount();

        if ($resultado == 0)
        {
          $alertMessage = "Falha ao inserir o novo registro.";
        }
        else
        {
          $alertMessage = "Registro inserido com sucesso!";
        }
      }
    }
    elseif (isset($_POST['produtoID'])) //delete
    {
      if (!isset($_SESSION['usuarioID']) != "")
      {
        header("Location: index.php#alertModal");
      }
      
      $produtoID = $_POST['produtoID'];

      $consulta = $conexao->prepare("DELETE FROM produtos WHERE ID = ?");
      $consulta->execute(array($produtoID));
      $resultado = $consulta->rowCount();

      if ($resultado == 0)
      {
        $alertMessage = "Falha ao deletar o registro!";
      }
      else
      {
        $alertMessage = "Registro deletado com sucesso!";
      }
    }
    */
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

          <fieldset>
            <legend id="modalTitle" class="text-center">Vender</legend>

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

        <!--<form action="criar-venda.php" id="vendaCadastro" class="well form-horizontal" method="post">-->
          <fieldset>
            <legend id="modalTitle" class="text-center">Produtos</legend>

              <div class="container">
                <div class="newProduct">
                </div>
                <div class="row">
                  <div class="form-group">
                    <label class="col-md-12">Nome</label>
                    <div class="col-md-12 center-block text-center pagination-centered inputGroupContainer">
                      <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-shopping-basket" aria-hidden="true"></i></span>
                        <input name="vendaNome" placeholder="Arroz" class="form-control" type="text">
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-md-12">Quantidade</label>
                    <div class="col-md-12 center-block text-center pagination-centered inputGroupContainer">
                      <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-shopping-cart" aria-hidden="true"></i></span>
                        <input name="vendaQuantidade" class="form-control" type="text" placeholder="0">
                      </div>
                    </div>
                  </div>
                </div>
              </div>

            <div class="form-group">
              <div class="col-md-12">
                <button type="submit" class="btn btn-primary btnAdd"><i class="fa fa-plus" aria-hidden="true"> Adicionar</i></button>
              </div>
            </div>

            <form>
              <input type="hidden" name="produtosID">
              <div class="form-group">
                <div class="col-md-12 text-center">
                  <button type="button" class="btn btn-success">Enviar <i class="fa fa-paper-plane" aria-hidden="true"></i></button>
                </div>
              </div>
            </form>

          </fieldset>
        <!--</form>-->
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

        var today = new Date();
        var dd = today.getDate();
        var mm = today.getMonth() + 1; //January is 0!

        var yyyy = today.getFullYear();

        if (dd < 10) {
            dd='0'+dd;
        }

        if (mm < 10) {
            mm='0'+mm;
        }

        var today = dd + '/' + mm + '/' + yyyy;
        
        $("input[name='vendaData']").val(today);

        /*$('#produtoCadastro').bootstrapValidator({
          // To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
          feedbackIcons: {
            valid: 'fa fa-check',
            invalid: 'fa fa-times',
            validating: 'glyphicon glyphicon-refresh'
          },
          fields: {
            produtoNome: {
              validators: {
                stringLength: {
                  message: 'O nome deve conter no mínimo 2 caracteres.',
                  min: 2,
                },
                notEmpty: {
                  message: 'Preencha o nome do produto.'
                }
              }
            },
            produtoTipo: {
              validators: {
                notEmpty: {
                  message: 'Selecione um tipo.'
                }
              }
            },
            produtoValor: {
              validators: {
                notEmpty: {
                  message: 'Preencha o valor do produto.'
                }
              }
            },
            produtoEstoque: {
              validators: {
                notEmpty: {
                  message: 'Preencha o estoque do produto.'
                }
              }
            }
          }
        })
        .on('success.form.bv', function(e) {
          $('#success_message').slideDown({ opacity: "show" }, "slow") // Do something ...
            $('#produtoCadastro').data('bootstrapValidator').resetForm();

          // Prevent form submission
          e.preventDefault();

          // Get the form instance
          var $form = $(e.target);

          // Get the BootstrapValidator instance
          var bv = $form.data('bootstrapValidator');

          // Use Ajax to submit form data
          $.post($form.attr('action'), $form.serialize(), function(result) {
            console.log(result);
          }, 'json');
        });

        //inputs
        $("#produtoValor").mask("00.000,00", {reverse: true});
        $("#produtoEstoque").mask("000.000", {reverse: true});
        
        //fields
        $(".produtoValor").mask("00.000,00", {reverse: true});
        $(".produtoEstoque").mask("000.000", {reverse: true});*/


        $(".btnAdd").click(function() {

          var produtoNome = $("input[name='vendaNome']").val();
          var produtoQuantidade = $("input[name='vendaQuantidade']").val();

          $(".newProduct").append(
            "<div class='row'>" +
              "<div class='form-group'>" + 
                "<div class='col-md-12 center-block text-center pagination-centered inputGroupContainer'>" +
                  "<div class='input-group'>" +
                    "<span class='input-group-addon'><i class='fa fa-shopping-basket' aria-hidden='true'></i></span>" +
                    "<input class='form-control' type='text' value='" + produtoNome + "' disabled>" +
                  "</div>" + 
                "</div>" +
              "</div>" +
              "<div class='form-group'>" + 
                "<div class='col-md-12 center-block text-center pagination-centered inputGroupContainer'>" +
                  "<div class='input-group'>" +
                    "<span class='input-group-addon'><i class='fa fa-shopping-cart' aria-hidden='true'></i></span>" +
                    "<input class='form-control' type='text' value='" + produtoQuantidade + "' disabled>" +
                  "</div>" + 
                "</div>" +
              "</div>" +
              "<div class='form-group'>" + 
                "<div class='col-md-12 center-block text-center pagination-centered inputGroupContainer'>" +
                  "<div class='input-group'>" +
                    "<span class='input-group-addon'><i class='fa fa-close' aria-hidden='true'></i></span>" +
                  "</div>" + 
                "</div>" +
              "</div>" +
            "</div>"
          );
          
          var produtosID = $("input[name='produtosID']").val();
          produtosID += "1,";

          $("input[name='produtosID']").val(produtosID);

          $("input[name='vendaNome']").val("");
          $("input[name='vendaQuantidade']").val("");
        });
        
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