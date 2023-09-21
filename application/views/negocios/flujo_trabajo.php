<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h1 class="title">NEGOCIO</h1>
                <div class="row">
                    <div class="col-md-1">
                        <img id="imgTemperatura" src="<?= base_url() ?>plantilla/img/icons/logo-seeldec.jpeg" width="auto" height="60">
                    </div>
                    <div class="col-md-9">
                        <p class="m-0 p-0 font-weight-bold">
                            <?= $data_negocio['cliente'] ?>
                        </p>
                        <p class="m-0 p-0"></p>
                        <p class="m-0 p-0">Negocio #
                            <?= $data_negocio['id_negocio'] ?>
                        </p>
                        <input hidden type="hidden" name="id_negocio" id="id_negocio" value="<?= $data_negocio['id_negocio'] ?>" />
                        <input hidden type="hidden" name="id_tercero_n" id="id_tercero_n" value="<?= $data_negocio['id_tercero'] ?>" />
                    </div>
                    <div class="col-md-2">
                        <div class="row align-items-start">
                            <p>
                                <?= $data_negocio['fecha_registro'] ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <h4 class="mb-5">Flujo de trabajo:</h4>
                    <div class="col-md-12" id="flujo_trabajo">

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- MODAL PARA CREAR EL TERCERO COMO CLIENTE XD -->
<div class="modal fade bd-example-modal-lg" id="Información_Cliente" tabindex="-1" role="dialog" aria-labelledby="Información_Cliente" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">INFORMACIÓN DEL CLIENTE</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body" style="background:#90ee9073;">
                                <form id="formCreateTercero" name="formCreateTercero">
                                    <input hidden id="inputIdTercero" name="inputIdTercero" type="hidden" class="form-control">
                                    <input hidden id="inputIdCliente" name="inputIdCliente" type="hidden" class="form-control">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                            <div class="form-floating mb-3">
                                                <select class="form-control" id="inputTipoDoc" name="inputTipoDoc">
                                                    <?php
                                                    foreach ($data_tipo_doc as $tipo) {
                                                        echo '<option value="' . $tipo->id . '">' . $tipo->descripcion . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                                <label for="inputTipoDoc">TIPO DE DOCUMENTO:</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                            <div class="form-floating mb-3">
                                                <input id="inputNumeroDoc" name="inputNumeroDoc" type="number" class="form-control">
                                                <label for="inputNumeroDoc">NÚMERO DE DOCUMENTO:</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                            <div class="form-floating mb-3">
                                                <input id="inputFirstName" name="inputFirstName" type="text" class="form-control" oninput="this.value = this.value.toUpperCase()" pattern="[a-zA-Z]+" title="No se admiten caracteres especiales">
                                                <label for="inputFirstName">PRIMER NOMBRE:</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                            <div class="form-floating mb-3">
                                                <input id="inputSecondName" name="inputSecondName" type="text" class="form-control" oninput="this.value = this.value.toUpperCase()" pattern="[a-zA-Z]+" title="No se admiten caracteres especiales">
                                                <label for="inputSecondName">SEGUNDO NOMBRE:</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                            <div class="form-floating mb-3">
                                                <input id="inputFirstSurName" name="inputFirstSurName" type="text" class="form-control" oninput="this.value = this.value.toUpperCase()" pattern="[a-zA-Z]+" title="No se admiten caracteres especiales">
                                                <label for="inputFirstSurName">PRIMER APELLIDO:</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                            <div class="form-floating mb-3">
                                                <input id="inputSecondSurName" name="inputSecondSurName" type="text" class="form-control" oninput="this.value = this.value.toUpperCase()" pattern="[a-zA-Z]+" title="No se admiten caracteres especiales">
                                                <label for="inputSecondSurName">SEGUNDO APELLIDO:</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                            <div class="form-floating mb-3">
                                                <select id="inputIdGenero" name="inputIdGenero" class="form-control">
                                                    <option value="">SELECCIONE UN GÉNERO</option>
                                                    <?php
                                                    foreach ($data_generos as $genero) {
                                                        echo '<option value="' . $genero->id . '">' . $genero->genero . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                                <label for="inputIdGenero">GÉNERO:</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                            <div class="form-floating mb-3">
                                                <input type="mail" id="inputEmail" name="inputEmail" class="form-control" oninput="this.value = this.value.toUpperCase()">
                                                <label for="inputEmail">CORREO:</ñ>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                            <div class="form-floating mb-3">
                                                <input id="inputTelefono_1" name="inputTelefono_1" type="tel" class="form-control" pattern="[0-9]+10" title="No se admiten caracteres especiales">
                                                <label for="inputTelefono_1">TELEFONO PERSONAL:</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                            <div class="form-floating mb-3">
                                                <input id="inputTelefono_2" name="inputTelefono_2" type="tel" class="form-control" pattern="[0-9]+10" title="No se admiten caracteres especiales">
                                                <label for="inputTelefono_2">TELEFONO DE CONTACTO:</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                            <div class="form-floating mb-3">
                                                <select id="comboPais" name="comboPais" class="form-control">
                                                    <option value="">SELECCIONE UN PAIS</option>
                                                    <?php
                                                    foreach ($data_paises as $pais) {
                                                        echo '<option value="' . $pais->id . '">' . $pais->pais . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                                <label for="comboPais">PAIS:</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                            <div class="form-floating mb-3">
                                                <select id="comboDepto" name="comboDepto" class="form-control">
                                                    <option value="">SELECCIONE UN DEPARTAMENTO</option>
                                                </select>
                                                <label for="comboDepto">DEPARTAMENTO:</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                            <div class="form-floating mb-3">
                                                <select id="comboMunicipio" name="comboMunicipio" class="form-control">
                                                    <option value="">SELECCIONE UN MUNICIPIO</option>
                                                </select>
                                                <label for="comboMunicipio">MUNICIPIO:</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                            <div class="form-floating mb-3">
                                                <input id="inputBarrio" name="inputBarrio" type="text" class="form-control" oninput="this.value = this.value.toUpperCase()">
                                                <label for="inputBarrio">BARRIO:</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                            <div class="form-floating mb-3">
                                                <input id="inputDireccion" name="inputDireccion" type="text" class="form-control" oninput="this.value = this.value.toUpperCase()">
                                                <label for="inputDireccion">DIRECCIÓN:</label>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="card-footer text-right">
                                <button id="btnSubmitReset" name="btnSubmitReset" type="button" class="btn btn-warning">LIMPIAR</button>
                                <button id="btnSubmitCreateTercero" name="btnSubmitCreateTercero" type="button" class="btn btn-success">AGREGAR</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- MODAL PARA AGREGAR UNA SOLICITUD MÁS DETALLADA -->
<div class="modal fade bd-example-modal-lg" id="Solicitud_Cliente" tabindex="-1" role="dialog" aria-labelledby="Solicitud_Cliente" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">SOLICITUD DEL CLIENTE</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body" style="background:#90ee9073;">
                                <form id="formCreateSolicitudCliente" name="formCreateSolicitudCliente">
                                    <div class="row">
                                        <div class="col-12">
                                            <label for="text_solicitud_cliente">SOLICITUD: <span style="color:red;">*</span></label>
                                            <textarea maxlength="2000" rows="5" id="text_solicitud_cliente" name="text_solicitud_cliente" placeholder="Escriba aquí detalladamente la solicitud del cliente" class="form-control"></textarea>
                                            <strong>Cantidad de caracteres: </strong><span style="color:red;" id="cant_caracteres">2000</span>
                                        </div>
                                    </div>

                                </form>
                            </div>
                            <div class="card-footer">
                                <button id="btnSubmitCreateSolicitud" name="btnSubmitCreateSolicitud" type="button" class="btn btn-success">GUARDAR</button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- MODAL PARA CREAR O VER COTIZACIONES -->
<div class="modal fade bd-example-modal-lg" id="cotizaciones_negocio" tabindex="-1" role="dialog" aria-labelledby="cotizaciones_negocio" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">COTIZACIONES DEL NEGOCIO</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body" style="background:#90ee9073;">
                                <div class="row">
                                    <div class="col-12" id="htmlCotizaciones">

                                    </div>
                                </div>

                            </div>
                            <div class="card-footer">
                                <button id="btnSubmitCreateCotizacion" name="btnSubmitCreateCotizacion" type="button" class="btn btn-success">NUEVA COTIZACIÓN</button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>

<!-- Modal Info agenda-->
<div class="modal fade" id="modal_info_agenda" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agenda de citas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="info_agenda">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal Terminación del Negocio-->
<div class="modal fade" id="modal_terminar_negocio" tabindex="-1" role="dialog" aria-labelledby="modal_terminar_negocio" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_terminar_negocio_title">Terminación del Negocio</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form_terminacion">
                <div class="modal-body">

                    <div class="row">
                        <div class="col-12">
                            <label for="id_tipo_terminancion">Tipo terminación:</label>
                            <select class="form-control" name="id_tipo_terminancion" id="id_tipo_terminancion" required>
                                <option value="">Seleccione un tipo</option>
                                <option value="1">Finalizado no efectivo</option>
                                <option value="2">Finalizado efectivo</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <label for="obs_termina">Observación:</label>
                            <textarea class="form-control" name="obs_termina" id="obs_termina" rows="4" required></textarea>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button id="btnSaveTerminacion" type="button" class="btn btn-success">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- MODAL DATA ENCUESTA -->
<div class="modal fade" id="modal_data_encuesta" tabindex="-1" role="dialog" aria-labelledby="modal_data_encuesta" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_data_encuesta_title">Encuesta realizada por el cliente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-row m-1 p-1 rounded border border-info" style="align-items: center;">
                    <div class="col-sm-6 col-12">
                        <label for="pregunta_encuesta">En terminos generales cuál es su grado de satisfacción con el servicio prestado de SEELDEC S.A?:</label>
                    </div>
                    <div class="col-sm-6 col-12" align="center">
                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                            <label class="btn btn-outline-danger btn-lg">
                                <input type="radio" name="pregunta1" id="option1" autocomplete="off" value="6" style="font-size: 20px;"> <span style="font-size: 10px;">0-6</span> <i class="far fa-frown"></i>
                            </label>
                            <label class="btn btn-outline-warning btn-lg">
                                <input type="radio" name="pregunta1" id="option1" autocomplete="off" value="8"> <span style="font-size: 10px;">7-8</span> <i class="far fa-meh"></i>
                            </label>
                            <label class="btn btn-outline-success btn-lg">
                                <input type="radio" name="pregunta1" id="option1" autocomplete="off" value="10"> <span style="font-size: 10px;">9-10</span> <i class="far fa-smile"></i>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-row m-1 p-1 rounded border border-info" style="align-items: center;">
                    <div class="col-sm-6 col-12">
                        <label for="pregunta_encuesta">Se le realizó la explicación sobre la instalación realizada:</label>
                    </div>
                    <div class="col-sm-6 col-12" align="center">
                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                            <label class="btn btn-outline-secondary btn-lg">
                                <input required type="radio" name="pregunta2" id="option4" autocomplete="off" value="NO"> <i class="far fa-thumbs-down"></i>
                            </label>
                            <label class="btn btn-outline-primary btn-lg">
                                <input required type="radio" name="pregunta2" id="option4" autocomplete="off" value="SI"> <i class="far fa-thumbs-up"></i>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-row m-1 p-1 rounded border border-info" style="align-items: center;">
                    <div class="col-sm-6 col-12">
                        <label for="pregunta_encuesta">Se cumplieron los compromisos pactados (Tiempo Proceso):</label>
                    </div>
                    <div class="col-sm-6 col-12" align="center">
                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                            <label class="btn btn-outline-secondary btn-lg">
                                <input required type="radio" name="pregunta3" id="option5" autocomplete="off" value="NO"> <i class="far fa-thumbs-down"></i>
                            </label>
                            <label class="btn btn-outline-primary btn-lg">
                                <input required type="radio" name="pregunta3" id="option5" autocomplete="off" value="SI"> <i class="far fa-thumbs-up"></i>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-row m-1 p-1 rounded border border-info" style="align-items: center;">
                    <div class="col-sm-6 col-12">
                        <label for="pregunta_encuesta">Para nosotros es importante conocer su opinión:</label>
                    </div>
                    <div class="col-sm-6 col-12" align="center">
                        <textarea required rows="5" id="opinion" name="opinion" placeholder="Escriba aquí su opinión acerca del servicio prestado" class="form-control form-control-sm"></textarea>
                    </div>
                </div>        
            </div>
        </div>
    </div>
</div>



<script type="text/javascript">
    const base_url = "<?php echo base_url() ?>";
</script>
<script type="text/javascript" src="<?php echo base_url() ?>js/negocios/flujo_trabajo.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>js/negocios/etapa_1.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>js/negocios/etapa_2.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>js/negocios/etapa_3.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>js/negocios/etapa_4.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>js/negocios/etapa_5.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>js/negocios/etapa_6.js"></script>

<?php $this->load->view('footer'); ?>