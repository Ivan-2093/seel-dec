<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body bg-secondary">
                <form id="formFiltroSolicitudes" class="form-horizontal">
                    <div class="row">
                        <div class="col-lg-2 col-md-4 col-sm-6 col-12">
                            <label for="date_start">DESDE:</label>
                            <input max="<?php echo date('Y-m-d') ?>" class="form-control" type="date" name="date_start" id="date_start" value="<?php echo date('Y-m-01') ?>">
                        </div>
                        <div class="col-lg-2 col-md-4 col-sm-6 col-12">
                            <label for="date_end">HASTA:</label>
                            <input max="<?php echo date('Y-m-d') ?>" class="form-control" type="date" name="date_end" id="date_end" value="<?php echo date('Y-m-d') ?>">
                        </div>
                        <div class="col-lg-2 col-md-4 col-sm-6 col-12">
                            <label for="inputNames">NOMBRES:</label>
                            <input class="form-control" type="text" name="inputNames" id="inputNames">
                        </div>
                        <div class="col-lg-2 col-md-4 col-sm-6 col-12">
                            <label for="inputPhone">TELEFONO:</label>
                            <input class="form-control" type="tel" name="inputPhone" id="inputPhone">
                        </div>
                        <div class="col-lg-2 col-md-4 col-sm-6 col-12">
                            <label for="inputEmail">CORREO:</label>
                            <input class="form-control" type="mail" name="inputEmail" id="inputEmail">
                        </div>
                        <div class="col-lg-2 col-md-4 col-sm-6 col-12">
                            <button type="button" id="btnGenerarFiltro" class="btn btn-success btn-large">BUSCAR</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="table-responsive-xl">
            <table id="tableGestionSolicitudes" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>PROSPECTO</th>
                        <th>TELEFONO</th>
                        <th>CORREO</th>
                        <th>MUNICIPIO</th>
                        <th>SOLICITUD</th>
                        <th>TIPO SOLICITUD</th>
                        <th>USUARIO</th>
                        <th>FECHA</th>
                        <th>OPCIONES</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
</div>


<script type="text/javascript">
    const base_url = "<?php echo base_url() ?>";
</script>
<script type="text/javascript" src="<?php echo base_url() ?>js/solicitudes/gestion_solicitud_cliente.js"></script>
<?php $this->load->view('footer'); ?>