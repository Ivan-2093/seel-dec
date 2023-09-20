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
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <!-- <button type="button" class="btn btn-primary" onclick="crear_cita()">Crear Cita</button> -->
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    const base_url = "<?php echo base_url() ?>";
</script>
<script type="text/javascript" src="<?php echo base_url() ?>js/agenda/etapa_4.js"></script>
<?php $this->load->view('footer');
