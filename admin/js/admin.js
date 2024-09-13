/*-----------------------------------------------ADMIN-----------------------------------------*/

//Actualiza Perfil
$('#actperfilADM').on('click', function () {
	var nombre = $("#nombre").val();
	var telefono = $("#telefono").val();
	var usuario = $("#usuario").val();
	var correo = $("#correo").val();
	var idADM = $("#idADM").val();
	var accion = "actualizaADM";

	if (nombre != "" && usuario != "") {
		$.ajax({
			url: "claseADM.php",
			type: "POST",
			data: {
				accion: accion,
				idADM: idADM,
				nombre: nombre,
				telefono: telefono,
				usuario: usuario,
				correo: correo
			},
			success: function () {
				Swal.fire("Exito!", "Se actualizaron los datos.", "success")
				setTimeout(function () {
					location.reload();
				}, 2000);
			}
		});
	} else {
		Swal.fire("Error!", "Los datos no pueden estar vacios.", "error")
	}
});

//Actualiza Contra
$('#cambiarcontraADM').on('click', function () {
	var contrasena = $("#contraADM1").val();
	var contrasena2 = $("#contraADM2").val();
	var idAD = $("#idAD").val();
	var accion = "actualizacontraADM";

	if (contrasena != "" && contrasena2 != "") {
		$.ajax({
			url: "claseADM.php",
			type: "POST",
			data: {
				accion: accion,
				idAD: idAD,
				contrasena: contrasena,
				contrasena2: contrasena2
			},
			success: function (x) {
				var x = JSON.parse(x);
				if (x.codigo == 1) {
					Swal.fire("Exito!", "Se actualizo la contraseña.", "success");
					$("#contraADM1").val('');
					$("#contraADM2").val('');
					setTimeout(function () {
						location.reload();
					}, 2000);
				} else if (x.codigo > 1) {
					Swal.fire('Advertencia', 'Las contraseñas ingresadas deben coinicidir.', 'warning');
					$("#contraADM1").val('');
					$("#contraADM2").val('');
				}
			}
		});
	} else {
		Swal.fire("Error!", "Las contraseñas no pueden estar vacías.", "error");
	}
});

//Envia correo SOPORTE
$('#enviaCorreoA').on('click', function () {
	var emisor = $("#emisor").val();
	var mensaje = $("#mensaje").val();
	var accion = "enviaCA";

	if (mensaje != '') {
		$.ajax({
			url: "claseADM.php",
			type: "POST",
			data: {
				accion: accion,
				emisor: emisor,
				mensaje: mensaje
			},
			success: function () {
				$('#enviar_emailA').find('textarea').val('');
				Swal.fire("Exito!", "En unos minutos un agente de Soporte solucionará el incoveniente.", "success");
				setTimeout(function () {
					location.reload();
				}, 3000);
			}
		});
	} else {
		Swal.fire("Error!", "El reporte esta vacío, por favor completelo.", "error");
	}
});

//Envia correo DOCTORA
$('#enviaCorreoDOC').on('click', function () {
	var emisorDOC = $("#emisorDOC").val();
	var mensajeDOC = $("#mensajeDOC").val();
	var accion = "enviaCADOC";

	if (mensajeDOC != '') {
		$.ajax({
			url: "claseADM.php",
			type: "POST",
			data: {
				accion: accion,
				emisorDOC: emisorDOC,
				mensajeDOC: mensajeDOC
			},
			success: function () {
				Swal.fire("Exito!", "El mensaje fue enviado correctamente.", "success");
				setTimeout(function () {
					location.reload();
				}, 3000);
			}
		});
	} else {
		Swal.fire("Error!", "El mensaje esta vacío, por favor completelo.", "error");
	}
});

//Agregar Usuario
$('#dataUsuNue').on('click', function () {
	var name = $("#name").val();
	var user = $("#user").val();
	var password = $("#password").val();
	var mail = $("#mail").val();
	var company = $("#company").val();
	var access = $("#access").val();
	var accion = "NuevoUsu";

	if (name != "") {
		$.ajax({
			url: "claseADM.php",
			type: "POST",
			data: {
				name: name,
				user: user,
				password: password,
				mail: mail,
				company: company,
				access: access,
				accion: accion

			},
			success: function (x) {

				var x = JSON.parse(x);
				if (x.codigo == 1) {
					Swal.fire("Exito!", "Se agrego el Usuario, los datos fueron enviados al correo proporcionado en el formulario anterior.", "success");
					$('#formNU').find('input:text').val('');
				} else if (x.codigo == 2) {
					Swal.fire("Error!", "No se inserto en la Base de Datos.", "error");
				}
				setTimeout(function () {
					location.reload();
				}, 3000);
			}
		});
	} else {
		Swal.fire("Error!", "El formulario no puede estar vacío.", "error");
	}
});

//Edita Cita
$('#actualizaCita').on('click', function () {
	var datos = $('#formEditaCita').serializeArray();
	datos.push({ name: 'accion', value: 'actualizaCitaAD' });

	$.ajax({
		url: "claseADM.php",
		type: "POST",
		data: datos,
		success: function (response) {
			var res = JSON.parse(response);

			if (res.response == true) {
				Swal.fire("Exito!", "Se actualizaron los datos correctamente.", "success");
				setTimeout(function () {
					location.reload();
				}, 2000);
			} else if (res.response == false) {
				Swal.fire("Error!", "No se pudieron actualizar los datos.", "error");
			}
		}
	});
});

//Edita Usuario
$('#actualizaPUser').on('click', function () {
	var datos = $('#editarPerfilUser').serializeArray();
	datos.push({ name: 'accion', value: 'actualizaPerfilUSERSAD' });

	$.ajax({
		url: "claseADM.php",
		type: "POST",
		data: datos,
		success: function (datos) {
			var x = JSON.parse(datos);

			if (x.response == true) {
				Swal.fire("Exito!", "Se actualizaron los datos correctamente.", "success");
				setTimeout(function () {
					location.reload();
				}, 2000);
			} else if (x.response == false) {
				Swal.fire("Error!", "No se pudieron actualizar los datos.", "error");
			}
		}
	});
});

//Elimina Usuario
$('#btneliminaUSER').on('click', function () {
	var IdADU = $("#IdADU").val();
	var accion = "borraUsuario1";

	if (IdADU != '') {
		$.ajax({
			url: "claseADM.php",
			type: "POST",
			data: {
				IdADU: IdADU,
				accion: accion
			},
			success: function (x) {
				var x = JSON.parse(x);

				if (x.exito == true) {
					Swal.fire("Exito!", "Se elimino el usuario correctamente.", "success");
					setTimeout(function () {
						location.reload();
					}, 2000);
				} else {
					Swal.fire("Error!", "Lo sentimos, no se elimino correctamente.", "error");
				}
			}
		});
	} else {
		Swal.fire("Error!", "No se pudo cancelar.", "error");
	}
});

		/**
		 * Crea Cita
		 */

	$('#creaCita').click(function (e) { 
		e.preventDefault();
		let paciente = $('#paciente').val();
		let fecha = $('#fechaCitaAD').val();
		if(!paciente || !fecha){
			Swal.fire('Advertencia','Debe completar los espacios requeridos.','warning');
		}else{
	
			let datosForm = $('#formCreaCita').serializeArray();
			datosForm.push({name: 'accion', value: 'creaCitaAD'});

			$.ajax({
				type: "POST",
				url: "claseADM.php",
				data: datosForm ,
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
				}
			});
		}
	});


//Cancela Cita
$('#borraCita').on('click', function () {
	var IdCita = $("#IdCita").val();
	var fechaCita = $("#fechaCita").val();
	var accion = "eliminaCitaAD";

	if (IdCita != '') {
		$.ajax({
			url: "claseADM.php",
			type: "POST",
			data: {
				IdCita: IdCita,
				fechaCita:fechaCita,
				accion: accion
			},
			success: function (x) {
				var x = JSON.parse(x);

				if (x.response == true) {
					Swal.fire("Exito!", "Se cancelo la cita correctamente.", "success");
					setTimeout(function () {
						location.reload();
					}, 2000);
				} else {
					Swal.fire("Error!", "Lo sentimos, no se cancelo correctamente.", "error");
				}
			}
		});
	} else {
		Swal.fire("Error!", "No se pudo cancelar.", "error");
	}
});