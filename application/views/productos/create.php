<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <ul class="nav nav-pills">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url() ?>ProductosController">PRODUCTOS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="<?= base_url() ?>ProductosController/create">CREAR PRODUCTO</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <h5 class="card-header">FORMULARIO PARA CREAR PRODUCTO</h5>
            <form id="formCreateProducto" name="formCreateProducto">
                <div class="card-body" style="background-color: #90ee9073 ;">
                    <!--
                `id_producto`, 
                `referencia`, 
                `descripcion`,
                --cortinas
                `anchos_tela_metro`,
                `unidad_medida`, 
                `factor_apertura`, 

                `costo_elite`, 
                `costo_premium`, 

                `id_tipo_p`, 
                `proveedor_id`, 
                `porce_precio`,
                --puertas y cerraduras
                `pasadores`, 
                `cerradura`, 
                `llaves`, 
                `tipo_seguridad`
                -->
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-12 mb-3">
                            <label class="d-block" for="inputIdProveedor">PROVEEDOR</label>
                            <select class="form-control js-select2-tercero" id="inputIdProveedor" name="inputIdProveedor">
                                <option value=""></option>
                                <?php
                                /* print_r($data_terceros); */
                                foreach ($data_proveedores as $proveedor) {
                                    echo '<option value="' . $proveedor->id_proveedor . '">' . $proveedor->primer_nombre . ' ' . $proveedor->segundo_nombre . ' ' . $proveedor->primer_apellido . ' ' . $proveedor->segundo_apellido . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-12 mb-3">
                            <label class="d-block" for="inputIdCategoria">CATEGORIA PRODUCTO</label>
                            <select class="form-control js-select2-categoria" id="inputIdCategoria" name="inputIdCategoria">
                                <option value=""></option>
                                <?php
                                /* print_r($data_terceros); */
                                foreach ($data_categoria as $cat) {
                                    echo '<option value="' . $cat->id_categoria . '">' . $cat->categoria . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-12 mb-3">
                            <label class="d-block" for="inputIdTipoProducto">TIPO PRODUCTO</label>
                            <select class="form-control js-select2-tipo-producto" id="inputIdTipoProducto" name="inputIdTipoProducto">
                                <option value="">No disponible</option>
                            </select>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-12 mb-3">
                            <label class="d-block" for="inputReferenciaProducto">REFERENCIA</label>
                            <input type="text" class="form-control " id="inputReferenciaProducto" name="inputReferenciaProducto" />
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-12 mb-3">
                            <label class="d-block" for="inputDescripcionProducto">DESCRIPCIÓN</label>
                            <textarea class="form-control" id="inputDescripcionProducto" name="inputReferenciaProducto" placeholder="Escriba la descripción del producto aquí!"></textarea>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button id="btnSubmitCreateProducto" name="btnSubmitCreateProducto" type="button" class="btn btn-success">CREAR</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    const base_url = "<?php echo base_url() ?>";
</script>
<script src="<?php echo base_url() ?>js/productos/create.js"></script>
<?php $this->load->view('footer');
