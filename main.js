$(document).ready(function() {    
  //Inicia Sesión
  $('#btnlogin').on('click', function () {
    var usuario = $("#usuario").val();
    var contrasena = $("#contrasena").val();
    login(usuario, contrasena);
  });
  
  function login(user, pass) {
    var accion = "entrarlogin";
    $.ajax({
      url: "login.php",
      type: "POST",
      data: {
        usuario: user,
        contrasena: pass,
        accion: accion
      },
      success: function (datos) {
        $('#formLogin').find('input:text').val('');
        $('#formLogin').find('input:password').val('');
        $('#alertaLogin').html(datos);
      }
    });
  }
  
});//FIN DEL MAIN