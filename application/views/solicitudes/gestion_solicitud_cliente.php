<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <ul class="nav nav-pills">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">GESTION SOLICITUDES</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url() ?>SolicitudController/">CREAR SOLICITUD</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12 table-responsive">
        <div class="card p-2">
            <div class="card-body">
                <table id="tableGestionSolicitudes" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>PROSPECTO</th>
                            <th>TELEFONO</th>
                            <th>CORREO</th>
                            <th>MUNICIPIO</th>
                            <th>DIRECCIÓN</th>
                            <th>SOLICITUD</th>
                            <th>TIPO SOLICITUD</th>
                            <th>USUARIO</th>
                            <th>FECHA</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    const base_url = "<?php echo base_url() ?>";
</script>
<script type="text/javascript" src="<?php echo base_url() ?>js/solicitudes/gestion_solicitud_cliente.js"></script>
<?php $this->load->view('footer'); ?>