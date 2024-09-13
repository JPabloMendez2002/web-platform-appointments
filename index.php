<!DOCTYPE html>

<html lang="en">

<head>
	<title>Iniciar Sesión</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta charset="utf-8">

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.1.1/css/all.css" />
	<link rel="stylesheet" type="text/css" href="assets/css/login.css" />

	<!-- Favicons -->
	<link href="assets/img/icono.png" rel="icon">
	<link href="assets/img/icono.png" rel="apple-touch-icon">

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-6 text-center mb-5">
					<h2 class="heading-section">Bienestar Sistema</h2>
				</div>
			</div>
			<div class="row justify-content-center">
				<br>
				<div class="col-md-12 col-lg-10">
					<div class="wrap d-md-flex">
						<div class="img" style="background-image: url(./assets/img/LogoBienestar.svg);"></div>
						<div class="login-wrap p-4 p-md-5">
							<div class="d-flex">
								<div class="w-100">
									<h3 class="mb-4">Inicio Sesión <span><i class="fa-solid fa-user"></i></span> <i class="fa-solid fa-badge-check"></i></h3>
								</div>
							</div>
							<form class="signin-form" id="formLogin">
								<div class="form-group mb-3">
									<div class="input-group">
										<span class="input-group-text"><i class="fa-solid fa-circle-user"></i></span>
										<input type="text" class="form-control" placeholder="Usuario" name="usuario" id="usuario">
									</div>
								</div>
								<div class="form-group mb-3">
									<div class="input-group">
										<span class="input-group-text"><i class="fa-solid fa-unlock-keyhole"></i></span>
										<input type="password" class="form-control" placeholder="Contraseña" name="contrasena" id="contrasena">
									</div>
								</div>
								<div class="form-group text-center">
									<button type="button" id="btnlogin" class="form-control btn btn-primary">Ingresar <i class="fa-solid fa-right-to-bracket"></i></button>
									<hr>
									<div id="alertaLogin">

									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
						<br>
			</div>
		</div>
	</section>
	<hr>

	<footer id="footer">
		<div class="container py-4">
			<center>
				<div class="copyright">
					&copy; Copyright
					<strong><span>SpesTechnical</span></strong>. All Rights Reserved
				</div>
				<div class="credits">
					Desarrollado por
					<a href="https://spestechnical.com/">SpesTechnical</a>
				</div>
			</center>
		</div>
	</footer>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"> </script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
	<script src="main.js"></script>

</body>

</html>