<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-secondary">
                <form id="formFiltroInformes" class="form-horizontal">
                    <div class="row align-self-end">
                        <div class="col-lg-2 col-md-4 col-sm-6 col-12">
                            <label for="date_start">DESDE:</label>
                            <input max="<?php echo date('Y-m-d') ?>" class="form-control" type="date" name="date_start" id="date_start" value="<?php echo date('Y-m-01') ?>">
                        </div>
                        <div class="col-lg-2 col-md-4 col-sm-6 col-12">
                            <label for="date_end">HASTA:</label>
                            <input max="<?php echo date('Y-m-d') ?>" class="form-control" type="date" name="date_end" id="date_end" value="<?php echo date('Y-m-d') ?>">
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <label for="input_estado">ESTADO</label>
                            <select class="form-control" name="input_estado" id="input_estado">
                                <option value="">SELECCIONE UN ESTADO</option>
                                <option value="1">AGENDADA</option>
                                <option value="2">EN PROCESO</option>
                                <option value="3">FINALIZADA</option>
                                <option value="4">REPROGRAMADA</option>
                                <option value="5">CANCELADA</option>
                            </select>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <label for="inputNames_2">TECNICO</label>
                            <select name="input_tecnico" id="input_tecnico" class="form-control">
                                <option value="">SELECCIONE UN TECNICO</option>
                                <?php foreach ($data_tecnicos->result() as $row) { ?>
                                    <option value="<?= $row->nit ?>"><?= $row->nombre_tecnico ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-lg-2 col-md-4 col-sm-6 col-12 p-2">
                            <button type="button" id="btnGenerarFiltro" class="btn btn-success btn-lg">BUSCAR</button>
                        </div>
                        <div class="col-lg-2 col-md-4 col-sm-6 col-12 p-2">
                            <button type="button" id="btnResetFiltro" class="btn btn-warning btn-sm">LIMPIAR</button>
                        </div>
                    </div>

                </form>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-12 table-responsive">
                        <table class="table table-bordered" id="table_agenda">
                            <thead class="thead-dark">
                                <tr>
                                    <th class="text-center">ID CITA</th>
                                    <th class="text-center">FECHA AGENDADA</th>
                                    <th class="text-center">ESTADO</th>
                                    <th class="text-center">FECHA EJECUCION</th>
                                    <th class="text-center">FECHA FINAL</th>
                                    <th class="text-center">OBSERVACIONES</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    const base_url = "<?php echo base_url() ?>";
</script>
<script type="text/javascript" src="<?php echo base_url() ?>js/informes/agenda.js"></script>
<?php $this->load->view('footer'); ?>