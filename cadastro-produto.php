<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Cadastro de Produto</title>

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

    <style>
      legend {
          display: block;
          width: 100%;
          padding: 0;
          margin-bottom: 20px;
          font-size: 21px;
          line-height: inherit;
          color: #333;
          border: 0;
          border-bottom: 1px solid #e5e5e5;
      }      


    </style>    
  </head>

  <body class="fixed-nav sticky-footer bg-dark" id="page-top">

    <?php include ('includes/menu.html') ?>

    <div class="content-wrapper">
      <div class="container-fluid">

        <!-- Breadcrumbs -->
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Meu Mercado</a></li>
          <li class="breadcrumb-item active">Cadastrar Produtos</li>
        </ol>
 
        <div class="col-md-6">
          <form class="well form-horizontal" method="post">
            <fieldset>
              <legend class="text-center">Cadastrar Produto</legend>

              <div class="form-group">
                <label class="col-md-12">Nome</label>  
                <div class="col-md-12 center-block text-center pagination-centered inputGroupContainer">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-shopping-basket" aria-hidden="true"></i></span>
                    <input name="produto-nome" placeholder="Arroz" class="form-control" type="text">
                  </div>
                </div>
              </div>

              <div class="form-group"> 
                <label class="col-md-12">Tipo</label>
                <div class="col-md-12 selectContainer">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-list-alt" aria-hidden="true"></i></span>
                    <select name="produto-tipo" class="form-control selectpicker" >
                      <option value=" ">Selecione o Tipo</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                    </select>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label class="col-md-12">Valor</label>  
                <div class="col-md-12 center-block text-center pagination-centered inputGroupContainer">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-usd" aria-hidden="true"></i></span>
                    <input name="produto-valor" placeholder="10,00" class="form-control" type="number" step="0.1">
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label class="col-md-12">Estoque</label>  
                <div class="col-md-12 center-block text-center pagination-centered inputGroupContainer">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-shopping-cart" aria-hidden="true"></i></span>
                    <input name="produto-estoque" placeholder="50" class="form-control" type="number">
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
  </body>
</html>