<?php
  session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Meu Mercado - Login</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- Plugin CSS -->
    <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/png" href="img/shopping-icon.png"/>
  </head>

  <?php
    if (isset($_SESSION['usuarioID']) != "")
    {
      header("Location: index.php");
    }

    $loginError = 0;

    if (isset($_POST['usuarioLogin']) && isset($_POST['usuarioSenha'])) 
    {
      include('includes/dbconnect.php');

      $usuarioLogin = $_POST['usuarioLogin'];
      $usuarioSenha = $_POST['usuarioSenha'];

      $consulta = $conexao->prepare("SELECT ID, Login, Senha FROM usuarios WHERE Login = ? AND Senha = ?");
      $consulta->execute(array($usuarioLogin, $usuarioSenha));
      $registros = $consulta->fetchAll();

      if (!empty($registros))
      {
        foreach ($registros as $key => $value)
        {
          if ($usuarioLogin == $value["Login"] && $usuarioSenha == $value["Senha"])
          {
            $_SESSION['usuarioID'] = $value['ID'];
            $_SESSION['usuarioLogin'] = $value['Login'];
            header("Location: index.php");
          }
          else
          {
            $loginError++;
          }
        }
      }
      else
      {
        $loginError++;
      }
    }
  ?>

  <body class="bg-dark">
    <div class="container">

      <div class="card card-login mx-auto mt-5">
        <div class="card-header">Login</div>

        <div class="card-body">
          <?php
            if ($loginError > 0)
            {
              echo "<p class='text-center' style='color: red;'>Login ou senha inválidos</p>";
            }
          ?>
          <form action="login.php" id="login" method="post">
            <div class="form-group">
              <label class="col-md-12" for="usuarioLogin">Usuário</label> 
              <div class="col-md-12 center-block text-center pagination-centered inputGroupContainer">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span>
                  <input type="text" id="usuarioLogin" name="usuarioLogin" class="form-control" placeholder="João">
                </div>
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-12" for="usuarioSenha">Senha</label>
              <div class="col-md-12 center-block text-center pagination-centered inputGroupContainer">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-key" aria-hidden="true"></i></span>
                  <input type="password" id="usuarioSenha" name="usuarioSenha" class="form-control" placeholder="123">
                </div>
              </div>
            </div>

            <button type="submit" class="btn btn-primary btn-block">Login</button>
          </form>

          <div class="text-center">
            <a class="d-block small mt-3" href="index.php">Voltar</a>
          </div>
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/popper/popper.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="js/bootstrapValidator.min.js"></script>

    <!-- Custom scripts for this template -->
    <script>
      $('#login').bootstrapValidator({
        // To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
        feedbackIcons: {
          valid: 'fa fa-check',
          invalid: 'fa fa-times',
          validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
          usuarioLogin: {
            validators: {
              notEmpty: {
                message: 'Preencha o seu login.'
              }
            }
          },
          usuarioSenha: {
            validators: {
              notEmpty: {
                message: 'Preencha a sua senha.'
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
    </script>
  </body>

</html>