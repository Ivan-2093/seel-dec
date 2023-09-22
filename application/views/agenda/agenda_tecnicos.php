<div class="text-center">
    <div class="container" style=" width: 100%;">
        <div class="row">
            <div class="col-md-6">
                <h3>Agenda de citas</h3>
            </div>
        </div>
        <div class="row" style="width: 100%;">
            <div id="calendar" style=" width: 100%;"></div>
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
            <div class="modal-footer" id="info_agenda_footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal Finalizar agenda-->
<div class="modal fade" id="modal_finalizar_agenda" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
            <input type="hidden" id="id_cita_finalizar" name="id_cita_finalizar" value="">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Finalizar Instalación</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div clas="row">
                        <div class="col-12">
                            <label>Observación:</label>
                            <textarea id="obs_fin_cita" name="obs_fin_cita" class="form-control" placeholder="Agregue aquí una observación relacionada con la instalación"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button onclick="fnFinalizarCita();" type="button" class="btn btn-success">Guardar</button>
                </div>
            </div>
    </div>
</div>
<!-- Modal Reporgramar agenda-->
<div class="modal fade" id="modal_reprogamar_agenda" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
            <input type="hidden" id="id_cita_repro" name="id_cita_repro" value="">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Finalizar Instalación</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                <div clas="row">
                        <div class="col-12">
                            <label>Antigua fecha:</label>
                            <input class="form-control" disabled type="date" id="fec_cita_repro" name="fec_cita_repro" value="">
                        </div>
                    </div>
                    <div clas="row">
                        <div class="col-12">
                            <label>Nueva fecha:</label>
                            <input type="date" name="new_date_cita" id="new_date_cita" class="form-control" min="<?=Date('Y-m-d')?>"/>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button onclick="reprogamarCita();" type="button" class="btn btn-success">Guardar</button>
                </div>
            </div>
    </div>
</div>

<script type="text/javascript">
    const base_url = "<?php echo base_url() ?>";
</script>
<?php if ($this->perfil == 1) { ?>
    <script type="text/javascript" src="<?php echo base_url() ?>js/agenda/agenda_tecnicos.js"></script>
<?php } else { ?>
    <script type="text/javascript" src="<?php echo base_url() ?>js/agenda/agenda.js"></script>
<?php } ?>
<?php $this->load->view('footer');
