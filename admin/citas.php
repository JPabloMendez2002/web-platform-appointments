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
      Citas Reservadas
    </title>
    <?php include_once 'links.php'; ?>
  </head>

  <body>
    <?php include_once 'modals.php'; ?>
    <div class="wrapper ">
      <?php include_once 'nav.php'; ?>

      <div class="panel-header panel-header-sm"></div>
      <div class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="title">Citas Pendientes</h5>
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalCita">Agendar Cita</button>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table text-md-center">
                    <thead class=" text-primary">
                      <tr>
                        <th>ID</th>
                        <th>Consultorio</th>
                        <th>Departamento</th>
                        <th>Paciente</th>
                        <th>Patologia</th>
                        <th>Tipo Cita</th>
                        <th>Tipo Enfermedad</th>
                        <th>Fecha Cita</th>
                        <th>Hora Cita</th>
                        <th>Herramientas</th>
                      </tr>
                    </thead>

                    <tbody>
                      <?php
                      $datos = $ObjADM->muestraCitasAD();
                      if (!empty($datos)) {
                        foreach ($datos as $rows => $row) {
                      ?>
                          <tr>
                            <td><?= $row['id']; ?></td>
                            <td><?= $row['sede']; ?></td>
                            <td><?= $row['departamento']; ?></td>
                            <td><?= $row['paciente']; ?></td>
                            <td><?= $row['patologia']; ?></td>
                            <td><?= $row['tipoCita']; ?></td>
                            <td><?= $row['tipoEnfermedad']; ?></td>
                            <td><?= $row['fecha']; ?></td>
                            <td><?= $row['hora']; ?></td>
                            <td>
                              <!-- <button type="button" class="editar btn btn-warning" data-id="<?= $row['id']; ?>" data-fecha="<?= $row['fecha'] ?>" data-sede="<?= $row['sede']; ?>" data-departamento="<?= $row['departamento']; ?>" data-paciente="<?= $row['paciente']; ?>" data-tipoEnfermedad="<?= $row['tipoEnfermedad']; ?>" data-patologia="<?= $row['patologia']; ?>" data-tipoCita="<?= $row['tipoCita']; ?>" data-bs-toggle="modal" data-bs-target="#modalEditaCita"><i class="fa-solid fa-pen-to-square"></i></button> -->
                              <button type="button" class="delete btn btn-danger" data-id="<?= $row['id'] ?>" data-fecha="<?= $row['fecha'] ?>" data-bs-toggle="modal" data-bs-target="#eliminaCita"><i class="fa-solid fa-rectangle-xmark"></i></button>
                            </td>
                          </tr>

                          <script>
                            //Envia Datos Citas
                            $(document).on("click", ".editar", function() {
                        
                              var id = $(this).attr("data-id");
                              var sede = $(this).attr("data-sede");
                              var departamento = $(this).attr("data-departamento");
                              var paciente = $(this).attr("data-paciente");
                              var tipoEnfermedad = $(this).attr("data-tipoEnfermedad");
                              var patologia = $(this).attr("data-patologia");
                              var tipoCita = $(this).attr("data-tipoCita");
                              var fecha = $(this).attr("data-fecha");

                              $('#IdcitaEDI').val(id);
                              $('#tipoenfermedadEDI').val(tipoEnfermedad);
                              $('#patologiaEDI').val(patologia);
                              $('#tipocitaEDI').val(tipoCita);
                              $('#pacienteEDI').val(paciente);
                              $('#departamentoEDI').val(departamento);
                              $('#sedeEDI').val(sede);
                              $('#fechaEDI').val(fecha);
                            });

                            //ElIMINA Cita
                            $(document).on("click", ".delete", function() {
                              var id = $(this).attr("data-id");
                              var fecha = $(this).attr('data-fecha');
                              $('#IdCita').val(id);
                              $('#fechaCita').val(fecha);
                            });
                          </script>
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
    <script src="js/admin.js"></script>

  </body>

  </html>

<?php
} else {
  header("location:../index.php");
}
?>