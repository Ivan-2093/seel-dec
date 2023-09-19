<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <ul class="nav nav-pills">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url() ?>ClientesController">CLIENTES</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="<?= base_url() ?>ClientesController/create">CREAR CLIENTE</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form id="formFiltroSolicitudes" class="form-horizontal">
                    <div class="row ">
                        <div class="col-lg-2 col-md-4 col-sm-6 col-12">
                            <label for="inputNumeroDoc">N° DOCUMENTO:</label>
                            <input class="form-control" type="number" name="inputNumeroDoc" id="inputNumeroDoc">
                        </div>
                        <div class="col-lg-2 col-md-4 col-sm-6 col-12">
                            <label for="inputNames_1">PRIMER NOMBRE:</label>
                            <input class="form-control" type="text" name="inputNames_1" id="inputNames_1">
                        </div>
                        <div class="col-lg-2 col-md-4 col-sm-6 col-12">
                            <label for="inputNames_2">SEGUNDO NOMBRE:</label>
                            <input class="form-control" type="text" name="inputNames_2" id="inputNames_2">
                        </div>
                        <div class="col-lg-2 col-md-4 col-sm-6 col-12">
                            <label for="inputNames_3">PRIMER APELLIDO:</label>
                            <input class="form-control" type="text" name="inputNames_3" id="inputNames_3">
                        </div>
                        <div class="col-lg-2 col-md-4 col-sm-6 col-12">
                            <label for="inputNames_4">SEGUNDO APELLIDO:</label>
                            <input class="form-control" type="text" name="inputNames_4" id="inputNames_4">
                        </div>
                        <div class="col-lg-2 col-md-4 col-sm-6 col-12">
                            <label for="inputPhone">TELEFONO 1:</label>
                            <input class="form-control" type="tel" name="inputPhone" id="inputPhone">
                        </div>
                        <div class="col-lg-2 col-md-4 col-sm-6 col-12">
                            <label for="inputPhone">TELEFONO 2:</label>
                            <input class="form-control" type="tel" name="inputPhone1" id="inputPhone1">
                        </div>
                        <div class="col-lg-2 col-md-4 col-sm-6 col-12">
                            <label for="inputEmail">CORREO:</label>
                            <input class="form-control" type="mail" name="inputEmail" id="inputEmail">
                        </div>
                        <div class="col-lg-2 col-md-4 col-sm-6 col-12 align-self-end">
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
        <div class="card">
            <h5 class="card-header">TABLA DE TERCEROS PARA CREAR CLIENTES</h5>
                <div class="card-body" style="background-color: #90ee9073 ;">
                    <div class="row">
                        <div class="col-12 table-responsive">
                            <table id="tableTerceros" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-center">DOCUMENTO</th>
                                        <th class="text-center">NOMBRES</th>
                                        <th class="text-center">EMAIL</th>
                                        <th class="text-center">TELEFONO 1</th>
                                        <th class="text-center">TELEFONO 2</th>
                                        <th class="text-center">MUNICIPIO</th>
                                        <th class="text-center">DIRECCIÓN</th>
                                        <th class="text-center">OPCIONES</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    const base_url = "<?php echo base_url() ?>";
</script>
<script src="<?php echo base_url() ?>js/clientes/create.js"></script>
<?php $this->load->view('footer');
