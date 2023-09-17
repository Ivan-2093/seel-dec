<?php $img_user = $this->session->userdata('img_user') ?>
<!doctype html>
<html class="no-js" lang="es">

<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title><?= $name_page ?> - SEELDEC </title>
	<meta name="description" content="">
	<meta name="keywords" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="shortcut icon" href="<?php echo base_url() ?>plantilla/img/icons/favicon.ico" />

	<link href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,400,600,700,800" rel="stylesheet">

	<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
	<link rel="stylesheet" href="<?= base_url() ?>plantilla/plugins/bootstrap/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?= base_url() ?>plantilla/plugins/fontawesome-free/css/all.min.css">
	<link rel="stylesheet" href="<?= base_url() ?>plantilla/plugins/icon-kit/dist/css/iconkit.min.css">
	<link rel="stylesheet" href="<?= base_url() ?>plantilla/plugins/ionicons/dist/css/ionicons.min.css">
	<link rel="stylesheet" href="<?= base_url() ?>plantilla/plugins/perfect-scrollbar/css/perfect-scrollbar.css">
	<link rel="stylesheet" href="<?= base_url() ?>plantilla/plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" href="<?= base_url() ?>plantilla/plugins/jvectormap/jquery-jvectormap.css">
	<link rel="stylesheet" href="<?= base_url() ?>plantilla/plugins/tempusdominus-bootstrap-4/build/css/tempusdominus-bootstrap-4.min.css">
	<link rel="stylesheet" href="<?= base_url() ?>plantilla/plugins/weather-icons/css/weather-icons.min.css">
	<link rel="stylesheet" href="<?= base_url() ?>plantilla/plugins/c3/c3.min.css">
	<link rel="stylesheet" href="<?= base_url() ?>plantilla/plugins/owl.carousel/dist/assets/owl.carousel.min.css">
	<link rel="stylesheet" href="<?= base_url() ?>plantilla/plugins/owl.carousel/dist/assets/owl.theme.default.min.css">
	<link rel="stylesheet" href="<?= base_url() ?>plantilla/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.css">
	<link rel="stylesheet" href="<?= base_url() ?>plantilla/plugins/mohithg-switchery/dist/switchery.min.css">
	<link rel="stylesheet" href="<?= base_url() ?>plantilla/dist/css/theme.min.css">
	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css"><!-- datetimepicker -->
	<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
	<link rel="stylesheet" href="<?= base_url() ?>plantilla/dist/css/sliderEncuesta.css">
	<script src="<?= base_url() ?>plantilla/src/js/vendor/modernizr-2.8.3.min.js"></script>
	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
	<link rel="stylesheet" href="<?= base_url() ?>plantilla/plugins/Wizard-JS-main/styles/css/main.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url() ?>calendar/lib/main.css">
	<script src="<?= base_url() ?>calendar/lib/main.min.js"></script>
	<script src="<?= base_url() ?>calendar/lib/es.js"></script>
	<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
	<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
	<script>
		window.jQuery || document.write('<script src="src/js/vendor/jquery-3.3.1.min.js"><\/script>')
	</script>
	<?php $this->load->helper('estilos_helper'); ?>
</head>

<body data-editor="ClassicEditor">
	<!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

	<div class="wrapper">
		<header class="header-top" header-theme="light">
			<div class="container-fluid">
				<div class="d-flex justify-content-between">
					<div class="top-menu d-flex align-items-center">
						<button type="button" class="btn-icon mobile-nav-toggle d-lg-none"><span></span></button>
						<button type="button" id="navbar-fullscreen" class="nav-link"><i class="ik ik-maximize"></i></button>
					</div>
					<?php $this->load->view('navbar'); ?>
				</div>
			</div>
		</header>

		<div class="page-wrap">
			<?php $this->load->view('menu'); ?>
			<div class="main-content">
				<div class="loader" id="cargando"></div>
				<div class="container-fluid">