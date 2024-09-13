<?php
session_start();

if (isset($_SESSION['user'])) {
  $_SESSION['nav'] = basename(__FILE__, ".php");
?>

  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Inicio</title>
    <?php include_once('./links.php'); ?>
  </head>

  <body class="">
    <?php include_once('modals.php'); ?>
    <div class="wrapper ">
      <?php include_once('./nav.php'); ?>

      <div class="main-panel" id="main-panel">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-transparent  bg-primary  navbar-absolute">
          <div class="container-fluid">
            <div class="navbar-wrapper">
              <div class="navbar-toggle">
                <button type="button" class="navbar-toggler">
                  <span class="navbar-toggler-bar bar1"></span>
                  <span class="navbar-toggler-bar bar2"></span>
                  <span class="navbar-toggler-bar bar3"></span>
                </button>
              </div>
              <a class="navbar-brand" href="inicio.php">Inicio</a>
            </div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-bar navbar-kebab"></span>
              <span class="navbar-toggler-bar navbar-kebab"></span>
              <span class="navbar-toggler-bar navbar-kebab"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navigation">
              <ul class="navbar-nav">
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="now-ui-icons users_single-02"></i>
                  </a>
                  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="perfil.php">Perfil</a>
                    <a class="dropdown-item" href="salir.php">Cerrar Sesión</a>
                  </div>
                </li>
              </ul>
            </div>
          </div>
        </nav>
        <!-- End Navbar -->
        <div class="panel-header panel-header-sm"></div>

        <div class="content">

          <div class="row">
            <div class="col-lg-5 col-md-6">
              <div class="card  card-chart">
                <div class="card-header ">
                  <h5 class="card-category">Personal</h5>
                  <h3 class="title" style="text-align: center;">Médicos</h3>
              <h4 class="card-title" style="text-align: center;">Nuestros médicos enfocados en medicina empresarial y privada son garantía de un servicio de alta calidad.</h4>
                </div>

                <div class="card-body ">
                  <center>
                    <img src="../assets/img/DOC.png" alt="Card image" style="width:400px">
                    <h5 class="title">Contacto</h5>
                    <p>Si tienes alguna duda o consulta puedes contactarme através de los siguientes links:</p>
                    <a href="https://wa.link/rsgv66" target="_blank">
                      <img src="../assets/img/whatsgif.gif" class="rounded-circle" width="60px" height="60px " />
                    </a>

                    <a data-bs-toggle="modal" data-bs-target="#modalMensajeDoc">
                      <img src="../assets/img/ggoo.gif" class="rounded-circle" width="60px" height="60px " />
                    </a>
                    <h5 class="title" style="text-align: center;">IMPORTANTE!</h5>
                    <strong><em>El horario de atención es de LUNES a VIERNES </em></strong>
                  </center>
                </div>
              </div>
            </div>

            <div class="col-lg-7 col-md-6">
              <div class="card">
                <div class="card-header">
                  <h5 class="card-category">Importante</h5>
                  <h3 class="title" style="text-align: center;">Protocólo de Ingreso</h3>
                  <h4 class="card-title" style="text-align: center;"> Tomar en cuenta las siguientes medidas:</h4>
                </div>

                <div class="card-body">
                  <center>
                    <img src="../assets/img/protocolo.png" alt="" style="width:400px">
                  </center>
                </div>
              </div>

              <div class="col-lg-12">
                <div class="card">
                  <div class="card-header" style="background-color: #FFFFFF;">
                    <h2 class="title" style="text-align: center;">Soporte Técnico <i class="fa-duotone fa-screwdriver-wrench"></i></h2>
                  </div>

                  <center>
                    <h5>Para reportar una inconveniencia solamente presione el siguiente botón.</h5>
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalsoporteU">Contactar</button>
                  </center>
                </div>
              </div>
            </div>
          </div>
        </div>

        <?php include_once('../footer.php'); ?>

      </div>
    </div>

    <!--Core JS Files -->
    <script src="../assets/js/core/jquery.min.js"></script>
    <script src="../assets/js/core/popper.min.js"></script>
    <script src="../assets/js/core/bootstrap.min.js"></script>
    <script src="../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
    <script src="../assets/js/plugins/chartjs.min.js"></script>
    <script src="../assets/js/now-ui-dashboard.min.js?v=1.5.0" type="text/javascript"></script>
    <script src="../assets/demo/demo.js"></script>
    <script src="js/user.js"></script>

  </body>

  </html>

<?php
} else {
  header("location:../index.php");
}
?>