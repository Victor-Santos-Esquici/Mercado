<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Produtos</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- Plugin CSS -->
    <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
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

    if (isset($_POST['produtoNome']))
    {
      if ($_POST['produtoID'] > 0) //edit
      {
        $produtoID = $_POST['produtoID'];
        $produtoNome = $_POST['produtoNome'];
        $produtoTipo = $_POST['produtoTipo'];
        $produtoValor = $_POST['produtoValor'];
        $produtoEstoque = $_POST['produtoEstoque'];

        $produtoValor = str_replace(",", ".", $produtoValor);

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
        $produtoNome = $_POST['produtoNome'];
        $produtoTipo = $_POST['produtoTipo'];
        $produtoValor = $_POST['produtoValor'];
        $produtoEstoque = $_POST['produtoEstoque'];

        $produtoValor = str_replace(",", ".", $produtoValor);

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

    //read
    $consulta = $conexao->prepare("SELECT produtos.ID, produtos.Nome, produtos.Tipo as TipoID, tipos.Nome AS Tipo, produtos.Valor, produtos.Estoque FROM produtos JOIN tipos on produtos.Tipo = tipos.ID");
    $consulta->execute();
    $registros = $consulta->fetchAll();

    //tipos
    $consulta = $conexao->prepare("SELECT * FROM tipos");
    $consulta->execute();
    $tipos = $consulta->fetchAll();
  ?>

  <body class="fixed-nav sticky-footer bg-dark" id="page-top">

    <?php include ('includes/menu.html'); ?>

    <div class="content-wrapper">
      <div class="container-fluid">

        <!-- Breadcrumbs -->
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Meu Mercado</a></li>
          <li class="breadcrumb-item active">Cadastrar Produtos</li>
        </ol>

        <div class="col-md-12">
          <a class="btn btn-success btnCreate" href="#editModal"><i class="fa fa-plus" aria-hidden="true"></i> Adicionar</a>
          
          <!--
          <label>Nome</label>
          <input type="radio" name="produtoPesquisa">
          <label>Tipo</label>
          <input type="radio" name="produtoPesquisa">-->
          
          <br><br>
          
          <table id="dataTable" class="table table-bordered" width="100%" id="dataTable" cellspacing="0">
            <thead>
              <tr>
                <th width="50px">Código</th>
                <th>Nome</th>
                <th>Tipo</th>
                <th>Valor</th>
                <th>Estoque</th>
                <th width="50px">Gerenciar</th>
              </tr>
            </thead>

            <tfoot>
              <tr>
                <th>Código</th>
                <th>Nome</th>
                <th>Tipo</th>
                <th>Valor</th>
                <th>Estoque</th>
                <th>Gerenciar</th>
              </tr>
            </tfoot>

            <tbody>
              <?php
                foreach ($registros as $key => $value)
                {
                  echo "<tr>";
                  echo  "<td class='produtoID' data-id='" . $value['ID'] . "'>" . $value['ID'] . "</td>";
                  echo  "<td class='produtoNome'>" . $value['Nome'] . "</td>";
                  echo  "<td class='produtoTipo' data-tipo='" . $value['TipoID'] . "'>" . $value['Tipo'] . "</td>";
                  echo  "<td class='produtoValor'>" . $value['Valor'] . "</td>";
                  echo  "<td class='produtoEstoque'>" . $value['Estoque'] . "</td>";
                  echo  "<td class='text-center'>";
                  echo    "<a href='#editModal' class='btnEdit'><i class='fa fa-pencil' aria-hidden='true'></i></a> ";
                  echo    "<a href='#deleteModal' class='btnDelete'><i class='fa fa-trash' aria-hidden='true'></i></a>";
                  echo  "</td>";
                  echo "</tr>";
                }
              ?>
            </tbody>
          </table>
        </div>
 
        <div class="remodal" data-remodal-id="editModal">
          <button data-remodal-action="close" class="remodal-close"></button>
          <form action="produtos.php#alertModal" id="produtoCadastro" class="well form-horizontal" method="post">
            <fieldset>
              <legend id="modalTitle" class="text-center">Cadastrar Produto</legend>

              <input type="hidden" name="produtoID" value="">

              <div class="form-group">
                <label class="col-md-12">Nome</label>  
                <div class="col-md-12 center-block text-center pagination-centered inputGroupContainer">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-shopping-basket" aria-hidden="true"></i></span>
                    <input name="produtoNome" placeholder="Arroz" class="form-control" type="text">
                  </div>
                </div>
              </div>

              <div class="form-group"> 
                <label class="col-md-12">Tipo</label>
                <div class="col-md-12 selectContainer">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-list-alt" aria-hidden="true"></i></span>
                    <select name="produtoTipo" class="form-control selectpicker">
                      <option value=" ">Selecione o Tipo</option>
                      <?php
                        foreach($tipos as $key => $value)
                        {
                          echo "<option value='" . $value['ID'] . "'>" . $value['Nome'] . "</option>";
                        }
                      ?>
                    </select>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label class="col-md-12">Valor</label>  
                <div class="col-md-12 center-block text-center pagination-centered inputGroupContainer">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-usd" aria-hidden="true"></i></span>
                    <input id="produtoValor" name="produtoValor" placeholder="10,00" class="form-control" type="text">
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label class="col-md-12">Estoque</label>  
                <div class="col-md-12 center-block text-center pagination-centered inputGroupContainer">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-shopping-cart" aria-hidden="true"></i></span>
                    <input name="produtoEstoque" placeholder="50" class="form-control" type="text">
                  </div>
                </div>
              </div>

              <div class="form-group">
                <div class="col-md-12 text-center">
                  <button type="submit" class="btn btn-primary">Enviar <i class="fa fa-paper-plane" aria-hidden="true"></i></button>
                </div>
              </div>
            </fieldset>
          </form>
        </div>
      </div>
    </div>

    <div class="remodal" data-remodal-id="deleteModal">
      <form action="produtos.php#alertModal" method="post">
        <input type="hidden" name="produtoID" value="">
        <button data-remodal-action="close" class="remodal-close"></button>
        <h2>Deseja deletar este produto?</h2>
        <p class="deleteProduto"></p>
        <br>
        <button data-remodal-action="cancel" class="remodal-cancel">Não</button>
        <button type="submit" class="remodal-confirm">Sim</button>
      </form>
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
    <script src="vendor/datatables/jquery.dataTables.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.js"></script>
    <script src="js/jquery.mask.min.js"></script>
    <script src="js/bootstrapValidator.min.js"></script>
    <script src="js/remodal.js"></script>

    <!-- Custom scripts for this template -->
    <script src="js/sb-admin.js"></script>

    <script>
      $(document).ready(function(){

        $("#dataTable").DataTable({
          "language": {
            "url": "json/Portuguese-Brasil.json"
          },
          "aoColumnDefs": [
            { "bSearchable": false, "aTargets": [ 0, 3, 4, 5 ] },
            { "bSortable": false, "aTargets": [ 5 ] }
          ]
        });

        $('#produtoCadastro').bootstrapValidator({
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

        $("#produtoValor").mask("00.000,00", {reverse: true});

        $(".btnCreate").click(function() {
          $("#modalTitle").text("Cadastrar Produto");

          $("input[name='produtoID']").val("");
          $("input[name='produtoNome']").val("");
          $("select[name='produtoTipo'] option").removeAttr("selected");
          $("option[value=' ']").attr("selected", "selected");
          $("input[name='produtoValor']").val("");
          $("input[name='produtoEstoque']").val("");
        });
        
        $(".btnEdit").click(function() {
          $("#modalTitle").text("Editar Produto");

          var $item = $(this).closest("tr");
          var produtoID = $($item).find(".produtoID").data("id");
          var produtoNome = $($item).find(".produtoNome").html();
          var produtoTipo = $($item).find(".produtoTipo").data("tipo");
          var produtoValor = $($item).find(".produtoValor").html();
          var produtoEstoque = $($item).find(".produtoEstoque").html();
          
          $("input[name='produtoID']").val(produtoID);
          $("input[name='produtoNome']").val(produtoNome);
          $("select[name='produtoTipo'] option").removeAttr("selected");
          $("option[value='" + produtoTipo + "']").attr("selected", "selected");
          $("select[name='produtoTipo']").val(produtoTipo);
          $("input[name='produtoValor']").val(produtoValor);
          $("input[name='produtoEstoque']").val(produtoEstoque);
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