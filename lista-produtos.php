<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Lista de Produtos</title>

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

  <body class="fixed-nav sticky-footer bg-dark" id="page-top">

    <?php include ('includes/menu.html') ?>

    <div class="content-wrapper">
      <div class="container-fluid">

        <!-- Breadcrumbs -->
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Meu Mercado</a></li>
          <li class="breadcrumb-item active">Lista de Produtos</li>
        </ol>

        <div class="col-md-12">
          <table id="dataTable" class="table table-bordered" width="100%" id="dataTable" cellspacing="0">
            <thead>
              <tr>
                <th>Código</th>
                <th>Nome</th>
                <th>Tipo</th>
                <th>Valor</th>
                <th>Estoque</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th>Código</th>
                <th>Nome</th>
                <th>Tipo</th>
                <th>Valor</th>
                <th>Estoque</th>
              </tr>
            </tfoot>
            <tbody>
              <tr>
                <td>1</td>
                <td>Itaipava</td>
                <td>Cerveja</td>
                <td>1,50</td>
                <td>200</td>
              </tr>

              <tr>
                <td>2</td>
                <td>Skol</td>
                <td>Cerveja</td>
                <td>1,70</td>
                <td>300</td>
              </tr>

              <tr>
                <td>3</td>
                <td>Del Vale</td>
                <td>Suco</td>
                <td>2,10</td>
                <td>100</td>
              </tr>

              <tr>
                <td>4</td>
                <td>Pepsi Cola 2L</td>
                <td>Refrigerante</td>
                <td>3,00</td>
                <td>800</td>
              </tr>

              <tr>
                <td>5</td>
                <td>Guaraná Charrua 2L</td>
                <td>Refrigerante</td>
                <td>2,50</td>
                <td>340</td>
              </tr>

              <tr>
                <td>6</td>
                <td>Bis Branco</td>
                <td>Chocolate</td>
                <td>2,70</td>
                <td>50</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <?php include ('includes/footer.html') ?>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/popper/popper.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="vendor/datatables/jquery.dataTables.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.js"></script>

    <!-- Custom scripts for this template -->
    <script src="js/sb-admin.js"></script>

    <script>
      $(document).ready(function(){
        $("#dataTable").DataTable({
          "language": {
            "url": "json/Portuguese-Brasil.json"
          }
        });
      });
    </script>
  </body>
</html>