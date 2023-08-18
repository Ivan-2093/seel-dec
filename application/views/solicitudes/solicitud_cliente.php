<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <ul class="nav nav-pills">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">CREAR SOLICITUD</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url() ?>SolicitudController/gestionSolicitud">GESTION SOLICITUDES</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-12">
                <form id="formCreateSolicitudCliente" name="formCreateSolicitudCliente">
                    <div class="card-body" style="background:#90ee9073;">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-floating mb-3">
                                    <label for="inputNombres">NOMBRE:</label>
                                    <input id="inputNombres" name="inputNombres" type="text" class="form-control" oninput="this.value = this.value.toUpperCase()" pattern="[a-zA-Z]+" title="No se admiten caracteres especiales">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-floating mb-3">
                                    <label for="inputEmail">CORREO:</label>
                                    <input id="inputEmail" name="inputEmail" type="mail" class="form-control" oninput="this.value = this.value.toUpperCase()" pattern="[a-zA-Z]+" title="No se admiten caracteres especiales">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-floating mb-3">
                                    <label for="inputPhone">TELEFONO:</label>
                                    <input id="inputPhone" name="inputPhone" type="tel" class="form-control" oninput="this.value = this.value.toUpperCase()" pattern="[a-zA-Z]+" title="No se admiten caracteres especiales">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-floating mb-3">
                                    <label for="comboDepto">DEPARTAMENTO:</label>
                                    <select id="comboDepto" name="comboDepto" class="form-control">
                                        <option value="">SELECCIONE UN DEPARTAMENTO</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-floating mb-3">
                                    <label for="comboMunicipio">MUNICIPIO:</label>
                                    <select id="comboMunicipio" name="comboMunicipio" class="form-control">
                                        <option value="">SELECCIONE UN MUNICIPIO</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-floating mb-3">
                                    <label for="inputAddress">DIRECCIÓN:</label>
                                    <input id="inputAddress" name="inputAddress" type="text" class="form-control" oninput="this.value = this.value.toUpperCase()" pattern="[a-zA-Z]+" title="No se admiten caracteres especiales">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="form-floating mb-3">
                                    <label for="inputSolicitud">SOLICITUD O OBSERVACIONES:</label>
                                    <textarea rows="10" id="inputSolicitud" name="inputSolicitud" type="text" class="form-control" oninput="this.value = this.value.toUpperCase()" pattern="[a-zA-Z]+" title="No se admiten caracteres especiales"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button id="btnSubmitCreateSolicitud" name="btnSubmitCreateSolicitud" type="button" class="btn btn-success">CREAR</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    const base_url = "<?php echo base_url() ?>";
</script>
<script type="text/javascript" src="<?php echo base_url() ?>js/solicitudes/solicitud_cliente.js"></script>
<?php $this->load->view('footer'); ?>