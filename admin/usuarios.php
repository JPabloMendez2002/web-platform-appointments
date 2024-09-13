<?php
include_once('claseADM.php');

if (isset($_SESSION['admin'])) {
  $_SESSION['nav'] = basename(__FILE__, ".php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Usuarios
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
        <div class="col-md-12">
          <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="title">Usuarios Actuales</h5>
              <button type="button" class="btn btn-success" data-toggle="modal" data-target="#NUsuario">Agregar Usuario</button>
            </div>
            <div class="card-body">
              <div class="table-responsive text-center">
                <table class="table">
                  <thead class=" text-primary">
                    <tr>
                      <th>Nombre</th>
                      <th>Usuario</th>
                      <th>Empresa</th>
                      <th>E-Mail</th>
                      <th>Teléfono</th>
                      <th>Rol</th>
                      <th>Herramientas</th>
                    </tr>
                  </thead>

                  <tbody>
                    <?php
                    $datos = $ObjADM->muestraUsuarios();
                    if(!empty($datos)){
                      foreach ($datos as $rows => $row) {
                      ?>
                        <tr>

                          <td><?= $row['name']; ?></td>
                          <td><?= $row['user']; ?></td>
                          <td><?= $row['company']; ?></td>
                          <td><?= $row['mail']; ?></td>
                          <td><?= $row['phone']; ?></td>
                          <td><?php if ($row['access'] == 1) {
                                echo "Adminstrador";
                              } else {
                                echo "Usuario";
                              } ?></td>
                          <td>
                            <button type="button" class="editar btn btn-warning" data-id="<?= $row['id']; ?>" data-nombre="<?= $row['name']; ?>" data-usuario="<?= $row['user']; ?>" data-telefono="<?= $row['phone']; ?>" data-correo="<?= $row['mail']; ?>" data-empresa="<?= $row['company']; ?>" data-bs-toggle="modal" data-bs-target="#editarUser"><i class="fa-solid fa-pen-to-square"></i></button>
                            <button type="button" class="delete btn btn-danger" data-id="<?= $row['id']; ?>" data-bs-toggle="modal" data-bs-target="#modalEliminaUser"><i class="fa-solid fa-trash-can"></i></button>
                          </td>
                        </tr>
                      <?php
                      }
                    }
                    ?>
                    
                    <script>
                      //Envia Datos Usuarios
                      $(document).on("click", ".editar", function() {
                        var id = $(this).attr("data-id");
                        var nombre = $(this).attr("data-nombre");
                        var usuario = $(this).attr("data-usuario");
                        var telefono = $(this).attr("data-telefono");
                        var correo = $(this).attr("data-correo");
                        var empresa = $(this).attr("data-empresa");


                        $('#idADU').val(id);
                        $('#nombreU').val(nombre);
                        $('#usuarioU').val(usuario);
                        $('#telefonoU').val(telefono);
                        $('#correoU').val(correo);
                        $('#empresaU').val(empresa);
                      });

                      //ElIMINA USUARIOS
                      $(document).on("click", ".delete", function() {
                        var id = $(this).attr("data-id");
                        $('#IdADU').val(id);
                      });
                    </script>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php include_once '../footer.php'; ?>
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