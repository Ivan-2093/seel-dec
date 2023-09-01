<div class="row">
  <div class="col-12">
    <div class="card">
      <h5 class="card-header">DATOS DE CONTACTO</h5>
      <form id="formCreateTercero" name="formCreateTercero">
        <div class="card-body" style="background:#90ee9073;">
          <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-6 col-12">
              <div class="row">
                <div class="col-12">
                  <label class="d-block" for="inputName">NOMBRE</label>
                  <input type="text" class="form-control " id="inputName" name="inputName" placeholder="Nombre del cliente" value="<?= isset($data_solicitudes->prospecto) ? $data_solicitudes->prospecto : ""  ?>" />
                </div>
              </div>
              <div class="row">
                <div class="col-12">
                  <label class="d-block" for="inputEmail">CORREO</label>
                  <input type="mail" class="form-control " id="inputEmail" name="inputEmail" placeholder="Correo del cliente" value="<?= isset($data_solicitudes->correo) ? $data_solicitudes->correo : "" ?>" />
                </div>
              </div>
            </div>
            <div class="col-lg-8 col-md-8 col-sm-6 col-12">

              <label class="d-block" for="textAreaSolicitud">SOLICITUD</label>
              <textarea rows="4" type="text" class="form-control " id="textAreaSolicitud" name="textAreaSolicitud" placeholder="Solicitud realizada por el cliente"><?= isset($data_solicitudes->observacion) ? $data_solicitudes->observacion : "" ?></textarea>

            </div>
            <div class="col-8 d-none">
              <div class="col-12">
                <label class="d-block" for="idSolicitud">ID SOLICITUD</label>
                <input type="hidden" name="idSolicitud" value="<?= $data_solicitudes->id_solicitud ?>">
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <div class="row">
          <div class="col-12">
            <button type="button" class="btn btn-info" id="bntLoadProducts" name="bntLoadProducts">VER PRODUCTOS</button>
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
          <div class="col-12">
            <div class="table-responsive-xl">
              <table id="tabla_cotizacion" class="table table-bordered">
                <thead>
                  <tr>
                    <th>CANTIDAD</th>
                    <th>REFERENCIA</th>
                    <th>VALOR UNIDAD</th>
                    <th>VALOR TOTAL</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th>1</th>
                    <th>PANEL JAPONES</th>
                    <th>2700000</th>
                    <th>2700000</th>
                  </tr>
                </tbody>
                <tfoot>
                  <tr class="table-dark">
                    <th class="text-right" colspan="3">TOTAL</th>
                    <td>2700000</td>
                  </tr>
                </tfoot>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="modal fade bd-example-modal-xl" id="modal_productos" tabindex="-1" role="dialog" aria-labelledby="modal_productos" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="card">
        <div class="card-body">
          <div class="row">
            <div class="col-12">
              <table style="width:100% ;" id="tableProductos" class="table table-bordered">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>REFERENCIA</th>
                    <th>VALOR ELITE</th>
                    <th>VALOR PREMIUM</th>
                    <th>TIPO PRODUCTO</th>
                    <th>CATEGORIA</th>
                    <th>OPCIÓN</th>
                  </tr>
                </thead>
                <tbody>

                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<script type="text/javascript">
  const base_url = "<?php echo base_url() ?>";
</script>
<script type="text/javascript" src="<?php echo base_url() ?>js/cotizador/create.js"></script>
<?php $this->load->view('footer');
