<?php
include_once('claseADM.php');

if (isset($_SESSION['admin'])) {
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
  <?php include_once 'links.php'; ?>
</head>

<body class="user-profile">
  <?php include_once 'modals.php'; ?>
  <div class="wrapper">
    <?php include_once 'nav.php'; ?>
    <div class="panel-header panel-header-sm"></div>
    <div class="content">
      <div class="row">
        <?php
        $row = $ObjADM->muestraPerfilADM($id);
        foreach ($row as $datos => $row) {
        ?>
          <div class="col-md-8">
            <div class="card">
              <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="title">Perfil</h5>
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#ACTPASS"><i class='fas fa-key' style='font-size:14px'></i></button>
              </div>
              <div class="card-body">
                <form>
                  <div class="row">
                    <div class="col-md-4 pr-1">
                      <div class="form-group">
                        <label>Compañia</label>
                        <input type="text" class="form-control" disabled="" placeholder="Compañia" value="<?= $row['company']; ?>"></input>
                        <input type="hidden" class="form-control" name="idADM" id="idADM" value="<?= $row['id']; ?>"></input>
                      </div>
                    </div>
                    <div class="col-md-3 px-1">
                      <div class="form-group">
                        <label>Usuario</label>
                        <input type="text" class="form-control" name="usuario" id="usuario" placeholder="Usuario" disabled value="<?= $row['user']; ?>"></input>
                      </div>
                    </div>
                    <div class="col-md-4 px-1">
                      <div class="form-group">
                        <label>E-Mail</label>
                        <input type="email" name="correo" id="correo" class="form-control" placeholder="E-Mail" value="<?= $row['mail']; ?>"></input>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4 pr-1">
                      <div class="form-group">
                        <label>Nombre</label>
                        <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre" value="<?= $row['name']; ?>"></input>
                      </div>
                    </div>
                    <div class="col-md-3 px-1">
                      <div class="form-group">
                        <label>Teléfono</label>
                        <input type="number" class="form-control" name="telefono" id="telefono" placeholder="Teléfono" value="<?= $row['phone']; ?>"></input>
                      </div>
                    </div>
                    <div class="col-md-4 px-1">
                      <div class="form-group">
                        <label>Rol</label>
                        <input type="text" class="form-control" name="rol" disabled="" placeholder="Rol" value="Administrador"></input>
                        <input type="hidden" class="form-control" name="acceso" id="acceso" value="<?= $row['access']; ?>"></input>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12 px-1">
                      <center>
                        <button type="button" name="actperfilADM" id="actperfilADM" class="btn btn-success">Guardar</button>
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
                  <img class="avatar border-gray" src="
                <?php if (empty($row['photo'])) {
                  echo "photos/default-avatar.png";
                } else {
                  echo $row['photo'];
                }
                ?>">
                  <h5 class="title"><?php echo $row['name'];
                                    ?></h5>
                  <p class="description">
                  <?php echo $row['user'];
                }

                  ?>
                  </p>
                  <div class="card-header d-flex justify-content-between align-items-center">
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#ACTPHOTO"><i class='fas fa-camera' style='font-size:14px'></i></button>
                  </div>
                </div>
              </div>
            </div>
          </div>
      </div>
    </div>
    <?php
    include_once '../footer.php';
    ?>
  </div>

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
                  <input type="password" class="form-control" name="contraADM1" id="contraADM1">
                  <input type="hidden" name="idADM" id="idAD" value="<?= $row['id']; ?>">
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label>Confirmar Contreseña</label>
                  <input type="password" class="form-control" name="contraADM2" id="contraADM2">
                </div>
              </div>
              <div class="col-md-12 px-1">
                <center>
                  <button type="button" name="cambiarcontraADM" id="cambiarcontraADM" class="btn btn-success">Guardar</button>
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
          <form action="claseADM.php" method="POST" enctype="multipart/form-data">
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

  <!--Core JS Files-->
  <script src="../assets/js/core/jquery.min.js"></script>
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <script src="../assets/js/plugins/chartjs.min.js"></script>
  <script src="../assets/js/now-ui-dashboard.min.js?v=1.5.0" type="text/javascript"></script>
  <script src="../assets/demo/demo.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <script src="js/admin.js"></script>
  
</body>
</html>

<?php
} else {
  header("location:../index.php");
}
?>