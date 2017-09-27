<?php
  session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Tipos</title>

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

    if (isset($_POST['tipoNome']))
    {
      if ($_POST['tipoID'] > 0) //edit
      {
        if (!isset($_SESSION['usuarioID']) != "")
        {
          header("Location: index.php#alertModal");
        }

        $tipoID = $_POST['tipoID'];
        $tipoNome = $_POST['tipoNome'];

        $consulta = $conexao->prepare("UPDATE tipos SET Nome = ?  WHERE ID = ?");
        $consulta->execute(array($tipoNome, $tipoID));
        $resultado = $consulta->rowCount();
        
        if ($resultado == 0)
        {
          $alertMessage = "Falha ao atualizar o tipo.";
        }
        else
        {
          $alertMessage = "Tipo atualizado com sucesso!";
        }
      }
      else //insert
      {
        if (!isset($_SESSION['usuarioID']) != "")
        {
          header("Location: index.php#alertModal");
        }

        $tipoNome = $_POST['tipoNome'];

        $consulta = $conexao->prepare("INSERT INTO tipos (Nome) VALUES (?)");
        $consulta->execute(array($tipoNome));
        $resultado = $consulta->rowCount();

        if ($resultado == 0)
        {
          $alertMessage = "Falha ao inserir o novo tipo.";
        }
        else
        {
          $alertMessage = "Tipo inserido com sucesso!";
        }
      }
    }
    elseif (isset($_POST['tipoID'])) //delete
    {
      if (!isset($_SESSION['usuarioID']) != "")
      {
        header("Location: index.php#alertModal");
      }
        
      $tipoID = $_POST['tipoID'];

      $consulta = $conexao->prepare("DELETE FROM tipos WHERE ID = ?");
      $consulta->execute(array($tipoID));
      $resultado = $consulta->rowCount();

      if ($resultado == 0)
      {
        $alertMessage = "Falha ao deletar o tipo!";
      }
      else
      {
        $alertMessage = "Tipo deletado com sucesso!";
      }
    }

    //read
    $consulta = $conexao->prepare("SELECT ID, Nome FROM tipos");
    $consulta->execute();
    $registros = $consulta->fetchAll();

    //tipos
    $consulta = $conexao->prepare("SELECT * FROM tipos");
    $consulta->execute();
    $tipos = $consulta->fetchAll();
  ?>

  <body class="fixed-nav sticky-footer bg-dark" id="page-top">

    <?php include ('includes/menu.php'); ?>

    <div class="content-wrapper">
      <div class="container-fluid">

        <!-- Breadcrumbs -->
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Meu Mercado</a></li>
          <li class="breadcrumb-item active">Gerenciar Tipos</li>
        </ol>

        <div class="col-md-12">
          <div class="col-md-8">
            <div class="row">
              <form action="tipos.php#alertModal" id="tipoCadastro" class="well form-horizontal" method="post">
                <fieldset>
                  <input type="hidden" name="tipoID" value="">
                  <div class="form-group">
                    <label class="col-md-12">Novo Tipo:</label>  
                    <div class="col-md-12 center-block text-center pagination-centered inputGroupContainer">
                      
                      <div class="container">
                        <div class="row">

                          <div class="col-xs-6">
                            <div class="input-group">
                              <span class="input-group-addon"><i class="fa fa-list-alt" aria-hidden="true"></i></span>
                              <input name="tipoNome" placeholder="Bebida" class="form-control" type="text" <?php echo (isset($_SESSION['usuarioID']) != "" ? "" : "disabled"); ?>>
                            </div>
                          </div>

                          <div class="col-xs-6">
                            <div class="col-md-12 text-center">
                              <button class="btn btn-success btn-sm" style="margin-top: 3px;" <?php echo (isset($_SESSION['usuarioID']) != "" ? "type='submit'" : "type='button' data-toggle='tooltip' title='Você precisa estar logado para cadastrar.'"); ?>>
                                <span><i class="fa fa-plus" aria-hidden="true"></i> Adicionar</span>
                              </button>    
                            </div> 
                          </div>

                        </div>
                      </div>

                    </div>
                  </div>
                </fieldset>
              </form>
            </div>
          </div>
         
          <table id="dataTable" class="table table-bordered" width="100%" id="dataTable" cellspacing="0">
            <thead>
              <tr>
                <th width="50px">Código</th>
                <th>Nome</th>
                <th width="50px">Gerenciar</th>
              </tr>
            </thead>

            <tfoot>
              <tr>
                <th>Código</th>
                <th>Nome</th>
                <th>Gerenciar</th>
              </tr>
            </tfoot>

            <tbody>
              <?php
                foreach ($registros as $key => $value)
                {
                  echo "<tr>";
                  echo  "<td class='tipoID' data-id='" . $value['ID'] . "'>" . $value['ID'] . "</td>";
                  echo  "<td class='tipoNome'>" . $value['Nome'] . "</td>";
                  echo  "<td class='text-center'>";
                  echo    "<a " . (isset($_SESSION['usuarioID']) != "" ? "href='#editModal'" : "href='login.php' data-toggle='tooltip' data-placement='left' title='Você precisa estar logado para editar.'") . " class='btnEdit'><i class='fa fa-pencil' aria-hidden='true'></i></a> ";
                  echo    "<a " . (isset($_SESSION['usuarioID']) != "" ? "href='#deleteModal'" : "href='login.php' data-toggle='tooltip' data-placement='left' title='Você precisa estar logado para deletar.'") . " class='btnDelete'><i class='fa fa-trash' aria-hidden='true'></i></a>";
                  echo  "</td>";
                  echo "</tr>";
                }
              ?>
            </tbody>
          </table>
          <br>
        </div>
 
        <div class="remodal" data-remodal-id="editModal">
          <button data-remodal-action="close" class="remodal-close"></button>
          <form action="tipos.php#alertModal" id="tipoCadastro" class="well form-horizontal" method="post">
            <fieldset>
              <legend id="modalTitle" class="text-center">Editar Tipo</legend>

              <input type="hidden" name="tipoID" value="">

              <div class="form-group">
                <label class="col-md-12">Nome</label>  
                <div class="col-md-12 center-block text-center pagination-centered inputGroupContainer">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-shopping-basket" aria-hidden="true"></i></span>
                    <input name="tipoNome" placeholder="Bebida" class="form-control" type="text">
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
      <form action="tipos.php#alertModal" method="post">
        <input type="hidden" name="tipoID" value="">
        <button data-remodal-action="close" class="remodal-close"></button>
        <h2>Deseja deletar este tipo?</h2>
        <p class="deleteTipo"></p>
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
            { "bSearchable": false, "aTargets": [ 2 ] },
            { "bSortable": false, "aTargets": [ 2 ] }
          ]
        });

        $('#tipoCadastro button[type="button"]').click(function() {
          window.location.href = "login.php";
        });

        $('#tipoCadastro').bootstrapValidator({
          // To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
          feedbackIcons: {
            valid: 'fa fa-check',
            invalid: 'fa fa-times',
            validating: 'glyphicon glyphicon-refresh'
          },
          fields: {
            tipoNome: {
              validators: {
                stringLength: {
                  message: 'O nome deve conter no mínimo 2 caracteres.',
                  min: 2,
                },
                notEmpty: {
                  message: 'Preencha o nome do tipo.'
                }
              }
            }
          }
        })
        .on('success.form.bv', function(e) {
          $('#success_message').slideDown({ opacity: "show" }, "slow") // Do something ...
            $('#tipoCadastro').data('bootstrapValidator').resetForm();

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
        
        $(".btnEdit").click(function() {
          $("#modalTitle").text("Editar Tipo");

          var $item = $(this).closest("tr");
          var tipoID = $($item).find(".tipoID").data("id");
          var tipoNome = $($item).find(".tipoNome").html();
          
          $("input[name='tipoID']").val(tipoID);
          $("input[name='tipoNome']").val(tipoNome);
        });
        
        $(".btnDelete").click(function() {
          var $item = $(this).closest("tr");
          var tipoID = $($item).find(".tipoID").data("id");
          var tipoNome = $($item).find(".tipoNome").html();
          $("input[name='tipoID']").val(tipoID);
          $(".deleteTipo").empty().append(tipoNome);
        });
      });
    </script>
  </body>
</html>