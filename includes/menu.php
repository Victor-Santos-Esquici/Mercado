<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
  <a class="navbar-brand" href="index.php">Meu Mercado</a>
  <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarResponsive">
    <ul class="navbar-nav navbar-sidenav">
      <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Produtos">
        <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponents">
          <i class="fa fa-fw fa-shopping-cart"></i>
          <span class="nav-link-text">Produtos</span>
        </a>
        <ul class="sidenav-second-level collapse" id="collapseComponents">
          <li>
            <a href="produtos.php">Gerenciar Produtos</a>
          </li>
          <li>
            <a href="tipos.php">Gerenciar Tipos</a>
          </li>
        </ul>
      </li>
    </ul>

    <ul class="navbar-nav sidenav-toggler">
      <li class="nav-item">
        <a class="nav-link text-center" id="sidenavToggler">
          <i class="fa fa-fw fa-angle-left"></i>
        </a>
      </li>
    </ul>

    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <?php
          if(isset($_SESSION['usuarioID']) != "")
          {
            echo "<a class='nav-link' href='logout.php?logout'>";
            echo  "<i class='fa fa-fw fa-sign-out'></i>";
            echo  "Logout";
            echo "</a>";
          }
          else
          {
            echo "<a class='nav-link' href='login.php'>";
            echo  "<i class='fa fa-fw fa-sign-in'></i>";
            echo  "Login";
            echo "</a>";
          }
        ?>
      </li>
    </ul>

  </div>
</nav>