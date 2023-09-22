<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-secondary">
                <form id="formFiltroNegocios" class="form-horizontal">
                    <div class="row align-self-end">
                        <div class="col-lg-2 col-md-4 col-sm-6 col-12">
                            <label for="date_start">DESDE:</label>
                            <input max="<?php echo date('Y-m-d') ?>" class="form-control" type="date" name="date_start" id="date_start" value="<?php echo date('Y-m-01') ?>">
                        </div>
                        <div class="col-lg-2 col-md-4 col-sm-6 col-12">
                            <label for="date_end">HASTA:</label>
                            <input max="<?php echo date('Y-m-d') ?>" class="form-control" type="date" name="date_end" id="date_end" value="<?php echo date('Y-m-d') ?>">
                        </div>
                        <div class="col-lg-2 col-md-4 col-sm-6 col-12">
                            <label for="inputNit">N° DOCUMENTO:</label>
                            <input class="form-control" type="number" name="inputNit" id="inputNit">
                        </div>
                        <div class="col-lg-2 col-md-4 col-sm-6 col-12">
                            <label for="inputNames_1">PRIMER NOMBRE:</label>
                            <input class="form-control" type="text" name="inputNames_1" id="inputNames_1">
                        </div>
                        <div class="col-lg-2 col-md-4 col-sm-6 col-12">
                            <label for="inputNames_2">PRIMER APELLIDO:</label>
                            <input class="form-control" type="text" name="inputNames_2" id="inputNames_2">
                        </div>
                        <div class="col-lg-2 col-md-4 col-sm-6 col-12">
                            <label for="input_asesor">ASESOR</label>
                            <select class="form-control" name="input_asesor" id="input_asesor">
                                
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
                        <table class="table table-bordered" id="table_negocios">
                            <thead class="thead-dark">
                                <tr>
                                    <th class="text-center">ID NEGOCIO</th>
                                    <th class="text-center">N° DOCUMENTO</th>
                                    <th class="text-center">CLIENTE</th>
                                    <th class="text-center">ASESOR</th>
                                    <th class="text-center">FECHA REGISTRO</th>
                                    <th class="text-center">FLUJO DE TRABAJO</th>
                                    <th class="text-center">ESTADO</th>
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
        <script type="text/javascript" src="<?php echo base_url() ?>js/negocios/all_negocios.js"></script>
        <?php $this->load->view('footer'); ?>