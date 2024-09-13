<?php
session_start();

if (isset($_SESSION['suadmin'])) {
  $_SESSION['nav'] = basename(__FILE__, ".php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Inicio
  </title>
  <?php include_once 'links.php'; ?>
</head>

<body>
  <?php include_once 'modals.php'; ?>
  <div class="wrapper">
    <?php include_once 'nav.php'; ?>

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
                <strong><em>El horario de atención es únicamente de LUNES a VIERNES de 8am a 8pm.</em></strong>
              </center>
            </div>
          </div>
        </div>

        <div class="col-lg-7 col-md-6">
          <div class="card">
            <div class="card-header">
              <h5 class="card-category">Considerar</h5>
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
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalsoporte">Contactar</button>
              </center>

            </div>
          </div>
        </div>
        <?php include_once '../footer.php'; ?>
      </div>
    </div>
    <!--Core JS Files-->
    <script src="../assets/js/core/jquery.min.js"></script>
    <script src="../assets/js/core/popper.min.js"></script>
    <script src="../assets/js/core/bootstrap.min.js"></script>
    <script src="../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
    <script src="../assets/js/plugins/chartjs.min.js"></script>
    <script src="../assets/js/now-ui-dashboard.min.js?v=1.5.0" type="text/javascript"></script>
    <script src="../assets/demo/demo.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="js/suadmin.js"></script>
</body>

</html>

<?php
} else {
  header("location:../index.php");
}
?>