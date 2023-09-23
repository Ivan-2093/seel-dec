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
                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <label for="input_tipo">TIPO SOLICITUD:</label>
                            <select class="form-control" name="input_tipo" id="input_tipo">
                                <option value="">SELECCIONE UN TIPO</option>
                                <option value="1">CORREO ELECTRONICO</option>
                                <option value="2">LLAMADA</option>
                            </select>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <label for="input_negocio">NEGOCIO:</label>
                            <select class="form-control" name="input_negocio" id="input_negocio">
                                <option value="">SELECCIONE UNA OPCIÓN</option>
                                <option value="SI">SI</option>
                                <option value="NO">NO</option>
                            </select>
                        </div>
                        <div class="col-lg-2 col-md-4 col-sm-6 col-12">
                            <button type="button" id="btnGenerarFiltro" class="btn btn-success btn-large">BUSCAR</button>
                        </div>
                        <div class="col-lg-2 col-md-4 col-sm-6 col-12 p-2">
                            <button type="button" id="btnResetFiltro" class="btn btn-warning btn-sm">LIMPIAR</button>
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
                        <th>TIPO SOLICITUD</th>
                        <th>USUARIO</th>
                        <th>FECHA</th>
                        <th>NEGOCIO</th>
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
<script type="text/javascript" src="<?php echo base_url() ?>js/informes/solicitudes.js"></script>
<?php $this->load->view('footer'); ?>