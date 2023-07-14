<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
	<meta name="author" content="AdminKit">
	<meta name="keywords" content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="shortcut icon" href="<?php base_url() ?>plantilla/img/icons/logo-seeldec.jpeg" />

	<link rel="canonical" href="https://demo-basic.adminkit.io/pages-sign-in.html" />

	<title>Login | Seguridad electronica y Decoración</title>

	<link href="<?php base_url() ?>plantilla/css/app.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
	<!-- SweetAlert2 -->
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
	<main class="d-flex w-100">
		<div class="container d-flex flex-column">
			<div class="loader" id="cargando"></div>
			<div class="row vh-100">
				<div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
					<div class="d-table-cell align-middle">

						<div class="text-center mt-4">
							<h1 class="h2">SEGURIDAD ELECTRONICA Y DECORACIÓN</h1>
							<p class="lead">

							</p>
						</div>

						<div class="card">
							<div class="card-body">
								<div class="m-sm-4">
									<div class="text-center">
										<img src="<?php base_url() ?>plantilla/img/icons/logo-seeldec.jpeg" alt="Charles Hall" class="img-fluid rounded-circle" width="132" height="132" />
									</div>
									<form id="formUser" name="formUser">
										<div class="mb-3">
											<label class="form-label">Usuario</label>
											<input class="form-control form-control-lg" type="text" id="username" name="username" placeholder="Ingrese usuario" autocomplete="on" />
										</div>
										<div class="mb-3">
											<label class="form-label">Password</label>
											<input class="form-control form-control-lg" type="password" id="password" name="password" placeholder="Ingrese contraseña" autocomplete="on" />
											<small>
												<a href="">Olvido su contraseña</a>
											</small>
										</div>
										<div class="text-center mt-3">
											<button id="btnIniciarSesion" name="btnIniciarSesion" type="button" class="btn btn-lg btn-primary">Iniciar sesión</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

	</main>
	<script>
		const base_url = '<?php echo base_url() ?>';
	</script>
	<script src="<?php base_url() ?>plantilla/js/app.js"></script>
	<script src="<?php base_url() ?>js/login/funciones.js"></script>
	<script src="<?php base_url() ?>js/check_inputs.js"></script>
</body>

</html>