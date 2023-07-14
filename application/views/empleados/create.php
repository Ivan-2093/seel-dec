<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <ul class="nav nav-pills">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url() ?>EmpleadosController">EMPLEADOS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="<?= base_url() ?>EmpleadosController/create">CREAR EMPLEADO</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <h5 class="card-header">FORMULARIO PARA CREAR EMPLEADOS</h5>
            <form id="formCreateEmpleado" name="formCreateEmpleado">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-12 mb-3">
                            <label class="d-block" for="inputIdTercero">TERCERO</label>
                            <select class="form-control js-select2-tercero" id="inputIdTercero" name="inputIdTercero">
                                <option value=""></option>
                                <?php
                                /* print_r($data_terceros); */
                                foreach ($data_terceros as $tercero) {
                                    echo '<option value="' . $tercero->id_tercero . '">' . $tercero->primer_nombre . ' ' . $tercero->segundo_nombre . ' ' . $tercero->primer_apellido . ' ' . $tercero->segundo_apellido . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-12 mb-3">
                            <label class="d-block" for="inputEmailEmp">Correo Corporativo:</label>
                            <input id="inputEmailEmp" name="inputEmailEmp" type="mail" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-12 mb-3">
                            <label class="d-block" for="inputIdCargoEmp">CARGO EMPLEADO:</label>
                            <select class="form-control js-select2-cargo" id="inputIdCargoEmp" name="inputIdCargoEmp">
                                <option value=""></option>
                                <?php
                                /* print_r($data_terceros); */
                                foreach ($data_cargos as $cargo) {
                                    echo '<option value="' . $cargo->id . '">' . $cargo->cargo . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-12 mb-3">
                            <label class="d-block" for="inputIdSedeEmp">SEDE:</label>
                            <select class="form-control js-select2-sede" id="inputIdSedeEmp" name="inputIdSedeEmp">
                                <option value=""></option>
                                <?php
                                /* print_r($data_terceros); */
                                foreach ($data_sedes as $sede) {
                                    echo '<option value="' . $sede->id . '">' . $sede->sede . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                            <label for="inputFileImgEmp">FOTO DE PERFIL:</label>
                            <input id="inputFileImgEmp" name="inputFileImgEmp" type="file" class="form-control" aria-label="file example" accept="image/png, image/gif, image/jpeg">


                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                            <label for="inputFileImgEmp">PREVIA:</label>
                            <img src="<?= base_url() ?>plantilla/img/icons/logo-seeldec.jpeg" alt="User Avatar" class="img_prev" id="imagenPrevisualizacion" width="200px">


                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button id="btnSubmitCreateEmpleado" name="btnSubmitCreateEmpleado" type="button" class="btn btn-success">CREAR</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    const base_url = "<?php echo base_url() ?>";
</script>
<script src="<?php echo base_url() ?>js/empleados/create.js"></script>
<?php $this->load->view('footer');
