<?php
require('claseUSER.php');

if (isset($_SESSION['user'])) {
  $id = $_SESSION['id'];
  $_SESSION['nav'] = basename(__FILE__, ".php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Historial Citas
  </title>
  <?php include_once './links.php'; ?>
</head>

<body class="">
  <div class="wrapper ">
    <?php include_once('./nav.php');
    include_once('modals.php'); ?>

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
      <div class="panel-header panel-header-sm">
      </div>
      <div class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="title">Historial de Citas</h5>
              </div>
              <div class="card-body">
                <div class="table-responsive text-center">
                  <table class="table">
                    <thead class="text-primary">
                      <tr>
                        <th>ID</th>
                        <th>Sede</th>
                        <th>Departamento</th>
                        <th>Tipo Cita</th>
                        <th>Paciente</th>
                        <th>Patologia</th>
                        <th>Tipo Enfermedad</th>
                        <th>Fecha Cita</th>
                        <th>Hora Cita</th>
                        <th>Asistencia</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $userClass = new User();
                      $datos = $userClass->muestraHistorialCitas($id);
                      if (!empty($datos)) {
                        foreach ($datos as $row) {
                      ?>
                        <tr>
                          <td><?= $row['id']; ?></td>
                          <td><?= $row['sede']; ?></td>
                          <td><?= $row['departamento']; ?></td>
                          <td><?= $row['tipoCita']; ?></td>
                          <td><?= $row['paciente']; ?></td>
                          <td><?= $row['patologia']; ?></td>
                          <td><?= $row['tipoEnfermedad']; ?></td>
                          <td><?= $row['fecha']; ?></td>
                          <td><?= $row['hora']; ?></td>
                          <td><?php
														if ($row['estado'] == 0) {
															echo '
														<input type="checkbox" class="estados" disabled >';
														}else if($row['estado'] == 1){
															echo '<input type="checkbox" class="estados" checked disabled>';
														}else if($row['estado'] == 2){
                              echo '<button type="button" class="btn btn-danger" disabled>Cancelada</button>';
                            }
														?></td>
                        </tr>
                      <?php
                        }
                      }
                      ?>
      
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <?php include_once('../footer.php'); ?>

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
  <script src="js/user.js"></script>
</body>
</html>

<?php
} else {
  header("location:../index.php");
}
?>