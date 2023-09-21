<div class="container-fluid xs">
    <div class="card" id="card-encuesta" style="font-size: 18px;">
        <div class="card-body">
            <h2 class="text-center">Encuesta de satisfacción SEELDEC S.A</h2>
            <p class="text-center">A continuación elija el estado que represente su nivel de satisfacción con el servicio</p>
            <div class="container">
                <form id="form_encuesta" name="form_encuesta">
                    <input type="hidden" name="id_negocio" id="id_negocio" value="<?= $id_negocio ?>" />
                    <div class="form-row m-1 p-1 rounded border border-info" style="align-items: center;">
                        <div class="col-sm-6 col-12">
                            <label for="pregunta_encuesta">En terminos generales cuál es su grado de satisfacción con el servicio prestado de SEELDEC S.A?:</label>
                        </div>
                        <div class="col-sm-6 col-12" align="center">
                            <div style="display: contents;" class="btn-group btn-group-toggle" data-toggle="buttons">
                                <label class="btn btn-outline-danger btn-lg">
                                    <input required type="radio" name="pregunta1" id="option1" autocomplete="off" value="6" style="font-size: 20px;"> <span style="font-size: 10px;">0-6</span> <i class="far fa-frown"></i>
                                </label>
                                <label class="btn btn-outline-warning btn-lg">
                                    <input required type="radio" name="pregunta1" id="option1" autocomplete="off" value="8"> <span style="font-size: 10px;">7-8</span> <i class="far fa-meh"></i>
                                </label>
                                <label class="btn btn-outline-success btn-lg">
                                    <input required type="radio" name="pregunta1" id="option1" autocomplete="off" value="10"> <span style="font-size: 10px;">9-10</span> <i class="far fa-smile"></i>
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
                                    <input required type="radio" name="pregunta4" id="option4" autocomplete="off" value="NO"> <i class="far fa-thumbs-down"></i>
                                </label>
                                <label class="btn btn-outline-primary btn-lg">
                                    <input required type="radio" name="pregunta4" id="option4" autocomplete="off" value="SI"> <i class="far fa-thumbs-up"></i>
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
                                    <input required type="radio" name="pregunta5" id="option5" autocomplete="off" value="NO"> <i class="far fa-thumbs-down"></i>
                                </label>
                                <label class="btn btn-outline-primary btn-lg">
                                    <input required type="radio" name="pregunta5" id="option5" autocomplete="off" value="SI"> <i class="far fa-thumbs-up"></i>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-row m-1 p-1 rounded border border-info" style="align-items: center;">
                        <div class="col-sm-6 col-12">
                            <label for="pregunta_encuesta">Para nosotros es importante conocer su opinión:</label>
                        </div>
                        <div class="col-sm-6 col-12" align="center">
                            <textarea required rows="5" id="option_7" name="pregunta7" placeholder="Escriba aquí su opinión acerca del servicio prestado" class="form-control form-control-sm"></textarea>
                        </div>
                    </div>
                    <hr>
                    <div class="form-row">
                        <div class="col">
                            <div align="center">
                                <button type="button" id="btn_env_encuesta" class="btn btn-warning btn-lg">Enviar Respuestas</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    const base_url = "<?php echo base_url() ?>";
</script>
<script type="text/javascript" src="<?php echo base_url() ?>js/encuestas/encuesta_satisfacion.js"></script>
<?php $this->load->view('footer'); ?>