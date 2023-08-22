<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <ul class="nav nav-pills">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url() ?>ProveedoresController">PROVEEDORES</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="<?= base_url() ?>ProveedoresController/create">CREAR PROVEEDOR</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <h5 class="card-header">FORMULARIO PARA CREAR PROVEEDOR</h5>
            <form id="formCreateProveedor" name="formCreateProveedor">
                <div class="card-body" style="background-color: #90ee9073 ;">
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
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button id="btnSubmitCreateProveedor" name="btnSubmitCreateProveedor" type="button" class="btn btn-success">CREAR</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    const base_url = "<?php echo base_url() ?>";
</script>
<script src="<?php echo base_url() ?>js/proveedores/create.js"></script>
<?php $this->load->view('footer');
