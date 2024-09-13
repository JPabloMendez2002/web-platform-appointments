<?php
require('claseADM.php');

if (isset($_SESSION['admin'])) {
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
                    $datos = $ObjADM->muestraHCitas();

                    if(!empty($datos)){
                      foreach ($datos as $rows => $row) {
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
                            <input type="checkbox" class="estados"  data-id="' . $row['id'] . '" data-fecha="' . $row['fecha'] . '" >';
                              } else if ($row['estado'] == 1) {
                                echo '<input type="checkbox" class="estados" checked disabled>';
                              } else if ($row['estado'] == 2) {
                                echo '<button type="button" class="btn btn-danger" disabled>Cancelada</button>';
                              }
                              ?></td>
                        </tr>
                      <?php
                      }
                    }
                    ?>

                    <script>
                      //CHECK ASISTIO/NO
                      $(document).on("click", ".estados", function() {
                        var checkbox = $(this);
                        if (checkbox.is(":checked")) {
                          Swal.fire({
                              title: "Advertencia!",
                              text: "Esta acción confirmará la asistencia del paciente a esta cita.",
                              icon: "warning",
                              showCancelButton: true,
                              confirmButtonColor: '#28A745',
                              cancelButtonColor: '#DC3545',
                              cancelButtonText: 'Cancelar',
                              confirmButtonText: 'Confirmar',
                              reverseButtons: true

                            })
                            .then((confirmaCita) => {
                              if (confirmaCita.isConfirmed) {
                                var checkboxmarcado = $(this).attr("data-id");
                                var fecha = $(this).attr("data-fecha");
                                var accion = 'CONFIRMARAD';

                                $.ajax({
                                  type: "POST",
                               	  url: "claseADM.php",
                                  data: {
                                    checkboxmarcado: checkboxmarcado,
                                    fecha: fecha,
                                    accion: accion
                                  },
                                  success: function(respuesta) {
                                    var x = JSON.parse(respuesta);
                                    if (x.response == 1) {
                                      Swal.fire("Exito!", "Se confirmo la asistencia de esta cita.", "success");
                                      setTimeout(function() {
                                        location.reload()
                                      }, 2000)
                                    } else if (x.response == 0) {
                                      Swal.fire("Error!", "Lo sentimos, se generó un error.", "error");
                                    }
                                  }
                                });
                              } else if (

                                confirmaCita.dismiss === Swal.DismissReason.cancel
                              ) {
                                Swal.fire(
                                  'Información', 'Acción cancelada.', 'info'
                                )
                                setTimeout(function() {
                                  location.reload()
                                }, 1000)
                              }
                            });

                        }
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

    <?php include_once('../footer.php'); ?>

  </div>

  <!--Core JS Files-->
  <script src="../assets/js/core/jquery.min.js"></script>
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <script src="../assets/js/plugins/chartjs.min.js"></script>
  <script src="../assets/js/now-ui-dashboard.min.js?v=1.5.0" type="text/javascript"></script>
  <script src="../assets/demo/demo.js"></script>
  <script src="js/admin.js"></script>
  
</body>
</html>

<?php
} else {
  header("location:../index.php");
}
?>