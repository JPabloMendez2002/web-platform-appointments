<!-- Cita -->
<div class="modal fade" id="modalCita">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-header">
        <h4 class="modal-title"><strong>Citas Bienestar</strong> <i class="fa-duotone fa-calendars"></i></h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <div class="modal-body">
        <form id="formCreaCita">
          <div class="row">
            <div class="col-md-4 pr-1">
              <div class="form-group">
                <label>Tipo de cita *</label>
                <input type="hidden" class="form-control" name="iduser" id="iduser" value="<?= $id ?>"></input>

                <select type="text" class="form-control" name="tipocita" id="tipocita">
                  <option value="Presencial">Presencial</option>
                  <option value="Virtual">Virtual</option>
                </select>
              </div>

              <div class="form-group" id="divMail" style="display: none;">
                <label>E-Mail *</label>
                <input type="mail" value="administracion@bienestarss.com" placeholder="E-Mail del remitente" class="form-control" id="correoCita" name="correoCita">
              </div>

            </div>

            <script>
              $('#tipocita').on('click', function() {
                let valorcita = $("#tipocita").val();
                if (valorcita == 'Virtual') {
                  $("#divMail").show();
                }
              });
            </script>




            <div class="col-md-4 pr-1">
              <div class="form-group">
                <label>Sede *</label>
                <select type="text" class="form-control" name="sede" id="sede" placeholder="Sede">
                  <option value="Planta Quepos">Planta Quepos</option>
                  <option value="Rancho Chico">Rancho Chico</option>
                  <option value="Oficinas Centrales">Oficinas Centrales</option>
                  <option value="Pdv">Pdv</option>
                  <option value="Recibidor">Recibidor</option>
                  <option value="Granja Marina">Granja Marina</option>
                </select>
              </div>
            </div>

            <div class="col-md-4 pr-1">
              <div class="form-group">
                <label>Patología *</label>
                <select type="text" class="form-control" name="patologia" id="patologia">
                  <option value="CCSS">CCSS</option>
                  <option value="INS">INS</option>
                </select>
              </div>
            </div>

            <div class="col-md-4 pr-1">
              <div class="form-group">
                <label>Departmento *</label>
                <select type="text" class="form-control" name="departamento" id="departamento" placeholder="Departamento ">
                  <option value="Administrativo">Administrativo</option>
                  <option value="Operativo">Operativo</option>
                </select>
              </div>
            </div>

            <div class="col-md-4 pr-1">
              <div class="form-group">
                <label>Paciente *</label>
                <input type="text" class="form-control" name="paciente" id="paciente" placeholder="Nombre del Paciente"></input>
              </div>
            </div>

            <div class="col-md-4 pr-1">
              <div class="form-group">
                <label>Tipo de enfermedad *</label>
                <select type="text" class="form-control" name="tipoenfermedad" id="tipoenfermedad">
                  <option value="Aguda">Aguda</option>
                  <option value="Cronica">Cronica</option>
                  <option value="Memorandum">Memorandum</option>
                  <option value="Tratamiento Cronico">Tratamiento Cronico</option>
                </select>
              </div>
            </div>


            <div class="col-md-2 pr-1">
              <div class="form-group">
                <br>
              </div>
            </div>

            <div class="col-md-4 pr-1">
              <div class="form-group">
                <center><label>Fecha Cita *</label></center>
                <input type="date" id="fechaCitaAD" class="form-control" name="fechaCitaAD" min="<?php echo date('Y-m-d', strtotime('Monday')); ?>" max="<?php echo date('Y-m-d', strtotime('Friday')); ?>" required>
              </div>
            </div>

            <div class="col-md-4 pr-1">
              <div class="form-group">
                <center><label for="horaCita">Hora Cita *</label></center>
                <select id="horaCita" name="horaCita" class="form-control" required></select>
              </div>
            </div>

            <div class="col-md-2 pr-1">
              <div class="form-group">
                <br>
              </div>
            </div>
          </div>

          <script>
            var fechaInput = document.getElementById('fechaCitaAD');
            var horaSelect = document.getElementById('horaCita');

            fechaInput.addEventListener('change', function() {
              var fechaSeleccionada = new Date(this.value);
              if (fechaSeleccionada.getDay() == 3 || fechaSeleccionada.getDay() == 4) {
                var horaInicio = '08:00';
                var horaFin = '13:45';
                while (horaSelect.options.length > 0) {
                  horaSelect.options.remove(0);
                }
                var hora = new Date('2023-01-01T' + horaInicio + ':00');
                while (hora <= new Date('2023-01-01T' + horaFin + ':00')) {
                  if (!(hora.getHours() == 13 && hora.getMinutes() == 0)) {
                    horaSelect.options.add(new Option(hora.toLocaleTimeString('en-US', {
                      hour: '2-digit',
                      minute: '2-digit',
                      hour12: true
                    }), horaInicio));
                  }
                  hora.setTime(hora.getTime() + 15 * 60 * 1000);
                  horaInicio = hora.toLocaleTimeString('en-US', {
                    hour: '2-digit',
                    minute: '2-digit',
                    hour12: true
                  });
                }
              } else {
                while (horaSelect.options.length > 0) {
                  horaSelect.options.remove(0);
                }
                <?php
                $hora = strtotime('08:00');
                while ($hora <= strtotime('16:45')) {
                  if (!(date('H:i', $hora) >= '13:00' && date('H:i', $hora) < '14:00')) {
                    echo "horaSelect.options.add(new Option('" . date('h:i A', $hora) . "', '" . date('h:i A', $hora) . "'));";
                  }
                  $hora = strtotime('+15 minutes', $hora);
                }
                ?>
              }
              horaSelect.disabled = false;
              horaSelect.options[0].selected = true;
            });

            horaSelect.addEventListener('change', function() {
              fechaInput.disabled = false;
            });

            horaSelect.disabled = true;
            horaSelect.options.add(new Option('No hay fecha seleccionada', ''));
            horaSelect.options[0].selected = true;
          </script>

          <div class="col-md-12 px-1">
            <center>
              <button type="submit" name="creaCita" id="creaCita" class="btn btn-success">Guardar Cita</button>
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

<!-- Usuario nuevo -->
<div class="modal fade" id="NUsuario">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-header">
        <h3 class="-itle"><strong>Agregar Usuario</strong> <i class="fa-duotone fa-users"></i></h3>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <div class="modal-body">
        <form action="" method="POST" id="formNU">
          <div class="row">

            <div class="col-md-4 pr-1">
              <div class="form-group">
                <label>Nombre *</label>
                <input type="text" class="form-control" required="" id="name" name="name" placeholder="Nombre del Usuario"></input>
              </div>
            </div>

            <div class="col-md-4 pr-1">
              <div class="form-group">
                <label>Usuario *</label>
                <input type="text" class="form-control" required="" id="user" name="user" placeholder="Usuario para la Plataforma"></input>
              </div>
            </div>

            <div class="col-md-4 pr-1">
              <div class="form-group">
                <label>Contraseña *</label>
                <input type="password" class="form-control" required="" id="password" name="password" placeholder="Contraseña para la Plataforma"></input>
              </div>
            </div>
          </div>
          <div class="row">

            <div class="col-md-4 pr-1">
              <div class="form-group">
                <label>Email *</label>
                <input type="text" class="form-control" required="" id="mail" name="mail" placeholder="E-Mail del Usuario"></input>
              </div>
            </div>

            <div class="col-md-4 pr-1">
              <div class="form-group">
                <label>Empresa *</label>
                <input type="text" class="form-control" required="" id="company" name="company" placeholder="Empresa del Usuario"></input>
              </div>
            </div>

            <div class="col-md-4 pr-1">
              <div class="form-group">
                <label>Rol *</label>
                <select type="text" class="form-control" required="" id="access" name="access" disabled>
                  <option value="2">Usuario</option>
                </select>
              </div>
            </div>
          </div>

          <div class="row">

            <div class="col-md-12 px-1">
              <center>
                <button type="button" name="dataUsuNue" id="dataUsuNue" class="btn btn-success">Guardar Usuario</button>
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

<!----------------------------------MODAL SOPORTE------------------------------------------->
<div class="modal fade" id="modalsoporte">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <!-- Modal Header -->
      <div class="modal-header">
        <center>
          <h3 class="modal-title">Reporte
            <span>
              <i class="fa-duotone fa-file-signature"></i></span>
          </h3>
        </center>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <form>
          <input type="hidden" id="emisor" name="emisor" value="Administrador (<?= $_SESSION['user'] ?>)" />
          <strong>Escriba aqui su reporte:</strong>
          <textarea name="mensaje" id="mensaje" class="form-control" rows="5" placeholder="Escribiendo......."></textarea>
          <hr>
          <center>
            <button type="button" class="btn btn-success" id="enviaCorreoA" value="Enviar">Enviar Reporte</button>
          </center>
        </form>
      </div>
      <!--MODAL BODY-->
    </div>
  </div>
</div>
<!----------------------------------FIN MODAL SOPORTE------------------------------------------->

<!----------------------------------MODAL EDITAR USUARIOS------------------------------------------------>
<div class="modal fade" id="editarUser">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-header">
        <h3 class="title" style="text-align: center;">Editar Usuario <i class="fa-duotone fa-pen-to-square"></i></h3>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        <div class="text-center">
          <form method="POST" id="editarPerfilUser" name="editarPerfilUser">
            <div class="row">
              <div class="col">
                <h4>Nombre</h4>
                <input type="text" class="form-control Inputs" placeholder="Nombre Completo" id="nombreU" name="nombreU">
                <input type="hidden" id="idADU" name="idADU">
              </div>

              <div class="col-sm">
                <h4>Usuario</h4>
                <input type="text" class="form-control Inputs" placeholder="Nombre de Usuario" id="usuarioU" name="usuarioU">
              </div>

              <div class="col-sm">
                <h4>Empresa</h4>
                <input type="text" class="form-control Inputs" placeholder="Empresa del Usuario" id="empresaU" name="empresaU">
              </div>

            </div>
            <br>

            <div class="row">

              <div class="col-sm">
                <h4>Teléfono</h4>
                <input type="number" class="form-control Inputs" id="telefonoU" name="telefonoU" placeholder="Teléfono del Usuario">
              </div>

              <div class="col-sm">
                <h4>E-Mail</h4>
                <input type="text" class="form-control Inputs" placeholder="E-Mail del Usuario" id="correoU" name="correoU">
              </div>

            </div>
            <br>
          </form>
          <hr>
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar <i class="fa-solid fa-rectangle-xmark"></i></button>
          <button type="button" class="btn btn-success" data-bs-dismiss="modal" id="actualizaPUser" name="actualizaPUser">Guardar <i class="fa-solid fa-floppy-disk"></i></button>
        </div>
      </div>
    </div>
  </div>
</div>
<!----------------------------------MODAL EDITAR USARIOS ------------------------------------------------>

<!----------------------------------MODAL ELIMINAR USARIOS------------------------------------------------>
<div class="modal fade" id="modalEliminaUser">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="borraP">
        <div class="modal-header">
          <h3 class="title">Eliminar Usuario <i class="fa-duotone fa-triangle-exclamation"></i></h3>
        </div>

        <div class="modal-body">
          <input type="hidden" id="IdADU" name="IdADU">
          <h4>¿Seguro que desea eliminar este usuario?</h4>
          <h5 class="text-danger"><small>Esta opción no puede deshacerse</small></h5>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar <i class="fa-solid fa-rectangle-xmark"></i></button>
          <button type="button" class="btn btn-success" data-bs-dismiss="modal" id="btneliminaUSER" name="btneliminaUSER">Confirmar <i class="fa-solid fa-square-check"></i></button>
        </div>
      </form>
    </div>
  </div>
</div>
<!----------------------------------MODAL ELIMINAR USARIOS------------------------------------------------>

<!----------------------------------MODAL CANCELA CITA------------------------------------------------>
<div class="modal fade" id="eliminaCita">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="borraC">
        <div class="modal-header">
          <h3 class="title">Cancelar Cita <i class="fa-duotone fa-triangle-exclamation"></i></h3>
        </div>

        <div class="modal-body">
          <input type="hidden" id="IdCita" name="IdCita">
          <input type="hidden" id="fechaCita" name="fechaCita">
          <h4>¿Seguro que desea cancelar esta cita?</h4>
          <h5 class="text-danger"><small>Esta opción no puede deshacerse</small></h5>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar <i class="fa-solid fa-rectangle-xmark"></i></button>
          <button type="button" class="btn btn-success" data-bs-dismiss="modal" name="borraCita" id="borraCita">Confirmar <i class="fa-solid fa-square-check"></i></button>
        </div>
      </form>
    </div>
  </div>
</div>
<!----------------------------------MODAL CANCELA CITA------------------------------------------------>

<!---------------------------------------MODAL EDITAR CITA---------------------------------------------->
<div class="modal fade" id="modalEditaCita">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-header">
        <h3 class="title" style="text-align: center;">Editar Cita <i class="fa-duotone fa-pen-to-square"></i></h3>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body text-center">
        <form id="formEditaCita">
          <input type="hidden" name="IdcitaEDI" id="IdcitaEDI">
          <div class="row">
            <div class="col-md-4 pr-1">
              <div class="form-group">
                <h4>Tipo cita</h4>
                <select type="text" class="form-control" name="tipocitaEDI" id="tipocitaEDI">
                  <option value="Presencial">Presencial</option>
                  <option value="Virtual">Virtual</option>
                </select>
              </div>
            </div>

            <div class="col-md-4 pr-1">
              <div class="form-group">
                <h4>Sede</h4>
                <select type="text" class="form-control" name="sedeEDI" id="sedeEDI" placeholder="Sede">
                  <option value="Planta Quepos">Planta Quepos</option>
                  <option value="Rancho Chico">Rancho Chico</option>
                  <option value="Oficinas Centrales">Oficinas Centrales</option>
                  <option value="Pdv">Pdv</option>
                  <option value="Recibidor">Recibidor</option>
                  <option value="Granja Marina">Granja Marina</option>
                </select>
              </div>
            </div>

            <div class="col-md-4 pr-1">
              <div class="form-group">
                <h4>Patología</h4>
                <select type="text" class="form-control" name="patologiaEDI" id="patologiaEDI">
                  <option value="CCSS">CCSS</option>
                  <option value="INS">INS</option>
                </select>
              </div>
            </div>

            <div class="col-md-4 pr-1">
              <div class="form-group">
                <h4>Departmento</h4>
                <select type="text" class="form-control" name="departamentoEDI" id="departamentoEDI" placeholder="Departamento ">
                  <option value="Administrativo">Administrativo</option>
                  <option value="Operativo">Operativo</option>
                </select>
              </div>
            </div>

            <div class="col-md-4 pr-1">
              <div class="form-group">
                <h4>Paciente</h4>
                <input type="text" class="form-control" name="pacienteEDI" id="pacienteEDI" placeholder="Nombre del Paciente"></input>
              </div>
            </div>

            <div class="col-md-4 pr-1">
              <div class="form-group">
                <h4>Tipo enfermedad</h4>
                <select type="text" class="form-control" name="tipoenfermedadEDI" id="tipoenfermedadEDI">
                  <option value="Aguda">Aguda</option>
                  <option value="Cronica">Cronica</option>
                  <option value="Memorandum">Memorandum</option>
                  <option value="Tratamiento Cronico">Tratamiento Cronico</option>
                </select>
              </div>
            </div>
          </div>
        </form>

        <hr>
        <button type="button" class="btn btn-success" data-bs-dismiss="modal" id="actualizaCita" name="actualizaPUser">Guardar <i class="fa-solid fa-floppy-disk"></i></button>
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar <i class="fa-solid fa-rectangle-xmark"></i></button>
      </div>
    </div>
  </div>
</div>

<!----------------------------------MODAL MENSAJE DOC------------------------------------------->
<div class="modal fade" id="modalMensajeDoc">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <!-- Modal Header -->
      <div class="modal-header">
        <center>
          <h3 class="modal-title">Mensaje
            <span>
              <i class="fa-duotone fa-message"></i></span>
          </h3>
        </center>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <form>
          <input type="hidden" id="emisorDOC" name="emisorDOC" value="Administrador (<?= $_SESSION['name'] ?>)" />
          <strong>Escriba aqui su consulta:</strong>
          <textarea name="mensajeDOC" id="mensajeDOC" class="form-control" rows="5" placeholder="Escribiendo......."></textarea>
          <hr>
          <center>
            <button type="button" class="btn btn-success" id="enviaCorreoDOC" value="Enviar">Enviar Mensaje</button>
          </center>
        </form>
      </div>
      <!--MODAL BODY-->
    </div>
  </div>
</div>
<!----------------------------------FIN MODAL DOC------------------------------------------->