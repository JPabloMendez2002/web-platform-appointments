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
                </select>
              </div>
            </div>

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
                <input type="date" id="fechaCita" class="form-control" name="fechaCita" min="<?php echo date('Y-m-d', strtotime('Monday')); ?>" max="<?php echo date('Y-m-d', strtotime('Friday')); ?>" required>
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
            var fechaInput = document.getElementById('fechaCita');
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

<!----------------------------------MODAL SOPORTE------------------------------------------->
<div class="modal fade" id="modalsoporteU">
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
        <form id="formCorreoSoporte">
          <input type="hidden" id="emisor" name="emisor" value="Usuario (<?= $_SESSION['user'] ?>)" />
          <strong>Escriba aqui su reporte:</strong>
          <textarea name="mensaje" id="mensaje" class="form-control" rows="5" placeholder="Escribiendo......."></textarea>
          <hr>
          <center>
            <button type="submit" class="btn btn-success" id="enviaCorreoSoporte" value="Enviar">Enviar Reporte</button>
          </center>
        </form>
      </div>
      <!--MODAL BODY-->
    </div>
  </div>
</div>
<!----------------------------------FIN MODAL SOPORTE------------------------------------------->



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
          <input type="hidden" id="emisorDOC" name="emisorDOC" value="Usuario (<?= $_SESSION['name'] ?>)" />
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