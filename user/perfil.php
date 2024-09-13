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
    Perfil
  </title>
  <?php include_once('./links.php'); ?>
</head>

<body class="user-profile">
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
          <div class="col-md-8">
            <div class="card">
              <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="title">Perfil</h5>
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#ACTPASS"><i class='fas fa-key' style='font-size:14px'></i></button>
              </div>
              <div class="card-body">
                <?php
                $userClass = new User();
                $datos = $userClass->muestraPerfilC($id);
                foreach ($datos as $row) { ?>
                  <form>
                    <div class="row">
                      <div class="col-md-4 pr-1">
                        <div class="form-group">
                          <label>Compañia</label>
                          <input type="text" class="form-control" disabled name="company" id="company" placeholder="Compañia" value="<?= $row['company']; ?>">
                          <input type="hidden" class="form-control" name="id" id="id" value="<?= $row['id']; ?>"></input>
                        </div>
                      </div>

                      <div class="col-md-3 px-1">
                        <div class="form-group">
                          <label>Usuario</label>
                          <input type="text" class="form-control" name="user" id="user" placeholder="Usuario" disabled value="<?= $row['user']; ?>"></input>
                        </div>
                      </div>

                      <div class="col-md-4 px-1">
                        <div class="form-group">
                          <label>Correo electronico</label>
                          <input type="text" name="mail" id="mail" class="form-control" placeholder="Correo" value="<?= $row['mail']; ?>"></input>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-4 pr-1">
                        <div class="form-group">
                          <label>Nombre</label>
                          <input type="text" class="form-control" name="name" id="name" placeholder="Nombre" value="<?= $row['name']; ?>"></input>
                        </div>
                      </div>

                      <div class="col-md-3 px-1">
                        <div class="form-group">
                          <label> Teléfono</label>
                          <input type="number" class="form-control" name="phone" id="phone" placeholder="Teléfono" value="<?= $row['phone']; ?>"></input>
                        </div>
                      </div>

                      <div class="col-md-4 px-1">
                        <div class="form-group">
                          <label> Rol</label>
                          <input type="text" class="form-control" name="rol" disabled="" placeholder="Rol" value="Usuario"></input>
                          <input type="hidden" class="form-control" name="access" value="2"></input>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-12 px-1">
                        <center>
                          <button type="submit" name="dataPerfil" id="dataPerfil" class="btn btn-success">Guardar</button>
                        </center>
                      </div>
                    </div>
                  </form>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card card-user">
              <div class="image">
                <img src="../assets/img/hero.png">
              </div>
              <div class="card-body">
                <div class="author">
                  <img class="avatar border-gray" src="<?php if (empty($row['photo'])) {
                                                          echo "photos/default-avatar.png";
                                                        } else {
                                                          echo $row['photo'];
                                                        } ?>">
                  <h5 class="title"><?= $row['name']; ?></h5>
                  <p class="description">
                    <?= $row['user']; ?>
                  </p>
                  <div class="card-header d-flex justify-content-between align-items-center">
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#ACTPHOTO"><i class='fas fa-camera' style='font-size:14px'></i></button>
                  </div>
                <?php } ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Modals Perfil -->

      <!-- Actualizar Contraseña-->
      <div class="modal fade" id="ACTPASS">
        <div class="modal-dialog modal-md">
          <div class="modal-content">

            <div class="modal-header">
              <h4 class="modal-title"><strong>Actualizar Contraseña</strong> <i class="fa-duotone fa-key"></i></h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
              <form>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Contraseña nueva</label>
                      <input type="password" class="form-control" required="" id="pass" name="pass">
                      <input type="hidden" name="id" value="<?= $_SESSION['id']; ?>">
                    </div>
                  </div>

                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Confirmar Contraseña</label>
                      <input type="password" class="form-control" required id="cpass" name="cpass">
                    </div>
                  </div>

                  <div class="col-md-12 px-1">
                    <center>
                      <button type="submit" name="actPass" id="actPass" class="btn btn-success" data-dismiss="modal">Actualizar</button>
                    </center>
                  </div>
                </div>
              </form>
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
            </div>

          </div>
        </div>
      </div>

      <!-- Actualizar Foto -->
      <div class="modal fade" id="ACTPHOTO">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">

            <div class="modal-header">
              <h4 class="title">
                Actualizar Foto <i class="fa-duotone fa-image"></i>
              </h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
              <form action="claseUSER.php" method="POST" enctype="multipart/form-data">
                <center>
                  <input type="hidden" id="accion" name="accion" value="actFotoUser">
                  <input type="hidden" id="idUser" name="idUser" value="<?= $_SESSION['id']; ?>">
                  <input type="hidden" name="MAX_FILE_SIZE" value="100000" />Seleccione una foto:
                  <br>
                  <br>
                  <input name="photo" id="photo" type="file" /><br />
                  <br />
                </center>

                <div class="col-md-12 px-1">
                  <center>
                    <button type="submit" name="uploadPhoto" id="uploadPhoto" class="btn btn-success">Guardar</button>
                  </center>
                </div>
              </form>
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
            </div>

          </div>
        </div>
      </div>

      <?php include_once('../footer.php');?>

    </div>
  </div>

  <!--   Core JS Files   -->
  <script src="../assets/js/core/jquery.min.js"></script>
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <script src="../assets/js/plugins/chartjs.min.js"></script>
  <script src="../assets/js/now-ui-dashboard.min.js?v=1.5.0" type="text/javascript"></script>
  <script src="../assets/demo/demo.js"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
  <script src="js/user.js"></script>

</body>
</html>

<?php
} else {
  header("location:../index.php");
}
?>