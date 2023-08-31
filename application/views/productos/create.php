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
                            <input type="text" class="form-control " id="inputReferenciaProducto" name="inputReferenciaProducto" placeholder="Referencia del producto" />
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-12 mb-3">
                            <label class="d-block" for="inputDescripcionProducto">DESCRIPCIÓN</label>
                            <textarea class="form-control" id="inputDescripcionProducto" name="inputDescripcionProducto" placeholder="Escriba la descripción del producto aquí!"></textarea>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6 col-12 mb-3">
                        <label class="d-block" for="inputCostoElite">COSTO ELITE</label>
                            <div class="input-group">
                                <span class="input-group-prepend"><label class="input-group-text">$</label></span>
                                <input value="0" onfocus="borrarCeros(this)" type="text" class="form-control " id="inputCostoElite" name="inputCostoElite" placeholder="Costo Elite del producto" />
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6 col-12 mb-3">
                            <label class="d-block" for="inputCostoPremium">COSTO PREMIUM</label>
                            <div class="input-group">
                                <span class="input-group-prepend"><label class="input-group-text">$</label></span>
                                <input value="0" onfocus="borrarCeros(this)" type="text" class="form-control " id="inputCostoPremium" name="inputCostoPremium" placeholder="Costo Premium del producto" />
                            </div>
                            
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6 col-12 mb-3">
                            <label class="d-block" for="inputPerPrecio">PORCENTAJE PRECIO</label>
                            <input type="number" class="form-control " id="inputPerPrecio" name="inputPerPrecio" placeholder="Porcentage precio del producto" />
                        </div>
                    </div>
                    <div class="row" id="isDeco" hidden>
                        <div class="col-lg-4 col-md-4 col-sm-6 col-12 mb-3">
                            <label class="d-block" for="inputAnchoTela">ANCHO DE TELA</label>
                            <input type="text" class="form-control " id="inputAnchoTela" name="inputAnchoTela" placeholder="Ancho de Tela" />
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6 col-12 mb-3">
                            <label class="d-block" for="inputUndMedida">UNIDAD DE MEDIDA</label>
                            <select class="form-control js-select2-medida" id="inputUndMedida" name="inputUndMedida">
                                <option value=""></option>
                                <?php
                                /* print_r($data_terceros); */
                                foreach ($data_medidas as $medida) {
                                    echo '<option value="' . $medida->id_medida . '">' . $medida->medidad . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6 col-12 mb-3">
                            <label class="d-block" for="inputFactorApertura">FACTOR APERTURA</label>
                            <input type="text" class="form-control " id="inputFactorApertura" name="inputFactorApertura" />
                        </div>
                    </div>
                    <div class="row" id="isSegurity" hidden>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-12 mb-3">
                            <label class="d-block" for="inputPasadores">PASADORES</label>
                            <input type="number" class="form-control " id="inputPasadores" name="inputPasadores" />
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-12 mb-3">
                            <label class="d-block" for="inputCerradura">CERRADURA</label>
                            <textarea type="text" class="form-control " id="inputCerradura" name="inputCerradura"></textarea>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-12 mb-3">
                            <label class="d-block" for="inputLlaves">LLAVES</label>
                            <textarea type="text" class="form-control " id="inputLlaves" name="inputLlaves"></textarea>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-12 mb-3">
                            <label class="d-block" for="inputTipoSegurity">TIPO DE SEGURIDAD</label>
                            <textarea type="text" class="form-control " id="inputTipoSegurity" name="inputTipoSegurity"></textarea>
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
