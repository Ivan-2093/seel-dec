<div class="container-fluid">
    <div class="page-header">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    <i class="ik ik-menu bg-green"></i>
                    <div class="d-inline">
                        <h5>PERMISOS</h5>
                        <span>Agregar o quitar permisos</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <nav class="breadcrumb-container" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="<?= base_url() ?>"><i class="ik ik-home"></i></a>
                        </li>
                        <li class="breadcrumb-item active">
                            <a href="#">Permisos</a>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-12">
                    <label for="selectPerfilId">Perfil:</label>
                    <select style="width:200px;" id="selectPerfil" name="selectPerfil" class="form-control js-select2-perfiles">
                        <?php echo $data_perfiles ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12" id="content_permisos">

                </div>
            </div>
        </div>
    </div>
</div>



<script type="text/javascript">
    const base_url = "<?php echo base_url() ?>";
</script>
<script type="text/javascript" src="<?php echo base_url() ?>js/permisos/permisos.js"></script>
<?php $this->load->view('footer'); ?>
