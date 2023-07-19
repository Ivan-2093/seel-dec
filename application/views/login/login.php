<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
	<meta name="author" content="SeelDec">
	<meta name="keywords" content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="shortcut icon" href="<?php base_url() ?>plantilla/img/icons/logo-seeldec.jpeg" />

	<link rel="canonical" href="<?php base_url() ?>" />

	<title>Login | Seguridad electronica y Decoración</title>

	<link href="<?php base_url() ?>plantilla/css/app.css" rel="stylesheet">
	<link href="<?php base_url() ?>plantilla/plugins/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="<?= base_url() ?>plantilla/plugins/icon-kit/dist/css/iconkit.min.css">
	<!-- SweetAlert2 -->
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<style type="text/css">
			.loader {
				position: fixed;
				left: 0px;
				top: 0px;
				width: -webkit-fill-available;
				height: -webkit-fill-available;
				z-index: 9999;
				background: center / contain no-repeat url('<?= base_url() ?>media/imagenes/cargando.gif'), 50% 50%, rgb(249, 249, 249);
				background-size: inherit;
				opacity: .8;
				display: none;
			}
	</style>
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
											<input oninput="this.value = this.value.toUpperCase()" class="form-control form-control" type="text" id="username" name="username" placeholder="Ingrese usuario" autocomplete="on" />
										</div>
										<div class="mb-3">
											<label for="new_pass_check">Confirme la contraseña</label>
											<div class="input-group">
												<label class="d-none" for="new_pass_check">Confirme la contraseña</label>
												<input autocomplete="password" type="password" id="password" name="password" class="form-control" placeholder="Confirma la contraseña">
												<div class="input-group-append">
													<span style="cursor: pointer;" id="verPassCheck" class="input-group-text "><i class="ik ik-eye-off"></i></span>
												</div>
											</div>
											<a href="#" class="forgot-pass mt-2" id="forgot_pass">
												Olvido su contraseña
												<i class="ik ik-help-circle"></i>
											</a>

										</div>
										<div class="text-center">
											<button id="btnIniciarSesion" name="btnIniciarSesion" type="button" value="ENTRAR" class="btn btn-lg btn-success">Iniciar sesión</button>
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
	<!-- Modal -->
	<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalCenterTitle">Restablecer contraseña!</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="mb-3">
						<label class="form-label">Usuario</label>
						<input oninput="this.value = this.value.toUpperCase()" class="form-control form-control" type="text" id="usernameRest" name="usernameRest" placeholder="Ingrese usuario" autocomplete="on" />
					</div>
				</div>
				<div class="modal-footer">
					<button id="btnRestPass" type="button" class="btn btn-primary">CONTINUAR</button>
				</div>
			</div>
		</div>
	</div>

	<script>
		const base_url = '<?php echo base_url() ?>';
	</script>
	<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
	<script>
		window.jQuery || document.write('<script src="src/js/vendor/jquery-3.3.1.min.js"><\/script>')
	</script>
	<script src="<?php base_url() ?>plantilla/plugins/bootstrap/dist/js/bootstrap.min.js"></script>
	<!-- <script src="<?php base_url() ?>plantilla/js/app.js"></script> -->
	<script src="<?php base_url() ?>js/login/funciones.js"></script>
	<script src="<?php base_url() ?>js/check_inputs.js"></script>
</body>

</html>