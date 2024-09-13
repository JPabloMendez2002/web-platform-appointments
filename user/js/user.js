$(document).ready(function () {
  /**
   * Crea Cita
   */

  $("#creaCita").click(function (e) {
    e.preventDefault();
    let paciente = $("#paciente").val();
    let fecha = $("#fechaCita").val();
    let patologia = $("#patologia").val();

    if (!paciente || !fecha) {
      Swal.fire(
        "Advertencia",
        "Debe completar los espacios requeridos.",
        "warning"
      );
    } else {
      if (patologia == "INS") {
        Swal.fire(
          "Advertencia",
          "Primero debe comunicarse con salud ocupacional.",
          "warning"
        );
        return;
      } else {
        let datosForm = $("#formCreaCita").serializeArray();
        datosForm.push({ name: "accion", value: "creaCitaU" });

        $.ajax({
          type: "POST",
          url: "claseUSER.php",
          data: datosForm,
          success: function (codigo) {
            let res = JSON.parse(codigo);
            console.log(res.codigo)
            if (res.codigo == 1) {
              Swal.fire(
                "Éxito!",
                "La cita fue reservada correctamente.",
                "success"
              );
              setTimeout(function () {
                window.location.href = "citas.php";
              }, 2000);
            } else if (res.codigo == 2){
              Swal.fire("Error!", "Ya existe una cita reservada para esa fecha y hora seleccionada.", "error");
            }
          },
        });
      }
    }
  });

  /**
   * Actualizar Datos Perfil
   */

  $("#dataPerfil").click(function (e) {
    e.preventDefault();

    let accion = "actPerfilUser";
    let id = $("#id").val();
    let company = $("#company").val();
    let user = $("#user").val();
    let mail = $("#mail").val();
    let name = $("#name").val();
    let phone = $("#phone").val();
    if (name != "" && user != "") {
      $.ajax({
        type: "POST",
        url: "claseUSER.php",
        data: {
          accion,
          id,
          company,
          user,
          mail,
          name,
          phone,
        },
        success: function (response) {
          let res = JSON.parse(response);
          if (res.response == true) {
            Swal.fire(
              "Éxito!",
              "Se actualizaron los datos correctamente.",
              "success"
            );
          } else {
            Swal.fire("Error!", "Se presento un error.", "error");
          }
        },
      });
    } else {
      Swal.fire("Error!", "Los datos no pueden estar vacios.", "error");
    }
  });

  /**
   * Actualizar Pass
   */

  $("#actPass").click(function (e) {
    e.preventDefault();

    let accion = "actPassUser";
    let id = $("#id").val();
    let pass = $("#pass").val();
    let cpass = $("#cpass").val();
    if (pass != "" && cpass != "") {
      if (pass == cpass) {
        $.ajax({
          type: "POST",
          url: "claseUSER.php",
          data: {
            accion,
            id,
            pass,
          },
          success: function (response) {
            let res = JSON.parse(response);

            if (res.response == true) {
              Swal.fire(
                "Éxito!",
                "Se actualizaron los datos correctamente.",
                "success"
              );
              setTimeout(function () {
                location.reload();
              }, 2000);
            } else {
              Swal.fire("Error!", "Se presento un error.", "error");
            }
          },
        });
      } else {
        Swal.fire(
          "Advertencia",
          "Las contraseñas ingresadas deben coinicidir.",
          "warning"
        );
      }
    } else {
      Swal.fire("Error!", "Las contraseñas no pueden estar vacías.", "error");
    }
  });

  /**
   * Correo Soporte
   */

  $("#enviaCorreoSoporte").on("click", function (e) {
    e.preventDefault();

    var emisor = $("#emisor").val();
    var mensaje = $("#mensaje").val();
    var accion = "enviaCorreoSoporte";

    if (mensaje != "") {
      $.ajax({
        url: "claseUSER.php",
        type: "POST",
        data: {
          accion,
          emisor,
          mensaje,
        },
        success: function () {
          $("#formCorreoSoporte").find("textarea").val("");
          Swal.fire(
            "Exito!",
            "En unos minutos un agente de Soporte solucionará el incoveniente.",
            "success"
          );
          setTimeout(function () {
            location.reload();
          }, 2000);
        },
      });
    } else {
      swal(
        "Advertencia",
        "El reporte esta vacío, por favor complételo.",
        "warning"
      );
    }
  });

  //Envia correo DOCTORA
  $("#enviaCorreoDOC").on("click", function () {
    var emisorDOC = $("#emisorDOC").val();
    var mensajeDOC = $("#mensajeDOC").val();
    var accion = "enviaCADOC";

    if (mensajeDOC != "") {
      $.ajax({
        url: "claseUSER.php",
        type: "POST",
        data: {
          accion: accion,
          emisorDOC: emisorDOC,
          mensajeDOC: mensajeDOC,
        },
        success: function () {
          Swal.fire(
            "Exito!",
            "El mensaje fue enviado correctamente.",
            "success"
          );
          setTimeout(function () {
            location.reload();
          }, 3000);
        },
      });
    } else {
      Swal.fire(
        "Error!",
        "El mensaje esta vacío, por favor completelo.",
        "error"
      );
    }
  });

});

