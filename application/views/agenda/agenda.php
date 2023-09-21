<input type="hidden" name="id_neg" id="id_neg" value="<?php echo $id_neg; ?>">
<input type="hidden" name="user_id" id="user_id" value="<?php echo $user_id; ?>">
<div class="text-center">
    <div class="container" style=" width: 100%;">
        <div class="row">
            <div class="col-md-6">
                <h3>Agenda de citas</h3>
            </div>
            <div class="col-md-6">
                <a href="#" class="btn btn-success" onclick="open_modal_crear();"> Nueva cita </a>
            </div>
        </div>
        <div class="row" style="width: 100%;">
            <div id="calendar" style=" width: 100%;"></div>
        </div>
    </div>
</div>

<!-- Modal Agenda-->
<div class="modal fade" id="modal_agenda" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agenda de citas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="POST" id="form_agenda">
                    <input type="hidden" name="negocio_id" id="negocio_id">
                    <input type="hidden" name="fecha_registro" id="fecha_registro">
                    <input type="hidden" name=" estado" id="estado">
                    <input type="hidden" name="user_crea" id="user_crea">
                    <div class="form-row">
                        <div class="col">
                            <label for="fecha_cita">Fecha cita(*)</label>
                            <input min="<?= DATE('Y-m-d') ?>" type="date" name="fecha_cita" id="fecha_cita" class="form-control" required>
                        </div>
                        <br>
                        <div class="col">
                            <label for="Tecnico encargado"> Seleccione un tecnico</label>
                            <select name="tecnico" id="tecnico" class="form-control" required>
                                <option value="">Seleccine un Tecnico</option>
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="form-row">
                        <div class="col">
                            <label for="detalles_cita">Escriba los detalles de la cita</label>
                            <textarea name="detalles_cita" id="detalles_cita" cols="30" rows="10" class="form-control"
                                required></textarea>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" onclick="crear_cita()">Crear Cita</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Info agenda-->
<div class="modal fade" id="modal_info_agenda" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
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


<script type="text/javascript">
    const base_url = "<?php echo base_url() ?>";
</script>
<script type="text/javascript" src="<?php echo base_url() ?>js/agenda/etapa_4.js"></script>
<?php $this->load->view('footer');