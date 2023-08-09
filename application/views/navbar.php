<div class="top-menu d-flex align-items-center">
	<div class="dropdown">
		<a class="dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img class="avatar" src="<?php echo base_url() ?>media/imagenes/empleados/<?php echo $this->session->userdata('img_user') ?>" alt=""></a>
		<div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
			<a class="dropdown-item" href="profile.html"><i class="ik ik-user dropdown-icon"></i> Profile</a>
			<a class="dropdown-item" href="#"><i class="ik ik-settings dropdown-icon"></i> Settings</a>
			<a class="dropdown-item" href="#"><span class="float-right"><span class="badge badge-primary">6</span></span><i class="ik-mail dropdown-icon"></i> Inbox</a>
			<a class="dropdown-item" href="#"><i class="ik ik-navigation dropdown-icon"></i> Message</a>
			<a class="dropdown-item" href="<?php echo base_url() ?>LoginController/logout"><i class="ik ik-power dropdown-icon"></i> Cerrar sessión</a>
		</div>
	</div>

</div>