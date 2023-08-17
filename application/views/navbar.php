<div class="top-menu d-flex align-items-center">
	<div class="dropdown">
		<a class="dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img class="avatar" src="<?php echo base_url() ?>media/imagenes/empleados/<?php echo $this->session->userdata('img_user') ?>" alt=""></a>
		<div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
			<a class="dropdown-item" href="<?php echo base_url() ?>LoginController/logout"><i class="ik ik-power dropdown-icon"></i> Cerrar sessión</a>
		</div>
	</div>

</div>