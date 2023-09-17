<div class="row">
  <div class="col-12">
    <div class="card">
      <h5 class="card-header">DATOS DE CONTACTO</h5>
      <form id="formCreateCotizacion" name="formCreateCotizacion">
        <div class="card-body" style="background:#90ee9073;">
          <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-6 col-12">
              <div class="row">
                <div class="col-12">
                  <label class="d-block" for="inputName">NOMBRE</label>
                  <input type="text" class="form-control " id="inputName" name="inputName" placeholder="Nombre del cliente" value="<?= isset($data_solicitudes['nombres']) ? $data_solicitudes['nombres'] : ""  ?>" />
                </div>
              </div>
              <div class="row">
                <div class="col-12">
                  <label class="d-block" for="inputEmail">CORREO</label>
                  <input type="mail" class="form-control " id="inputEmail" name="inputEmail" placeholder="Correo del cliente" value="<?= isset($data_solicitudes['correo']) ? $data_solicitudes['correo'] : "" ?>" />
                </div>
              </div>
            </div>
            <div class="col-lg-8 col-md-8 col-sm-6 col-12">
              <label class="d-block" for="textAreaSolicitud">SOLICITUD</label>
              <textarea rows="4" type="text" class="form-control " id="textAreaSolicitud" name="textAreaSolicitud" placeholder="Solicitud realizada por el cliente"><?= isset($data_solicitudes['observacion']) ? $data_solicitudes['observacion'] : "" ?></textarea>
            </div>
            <div class="col-8 d-none">
              <div class="col-12">
                <label class="d-block" for="id_negocio">ID SOLICITUD</label>
                <input type="hidden" name="id_negocio" value="<?= $data_solicitudes['negocio_id'] ?>">
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
                <thead class="thead-dark">
                  <tr>
                    <th class="d-none">ID</th>
                    <th>CANTIDAD</th>
                    <th>REFERENCIA</th>
                    <th>VALOR UNIDAD</th>
                    <th>VALOR TOTAL</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody></tbody>
                <tfoot>
                  <tr class="table-success">
                    <th class="text-right" colspan="3">TOTAL</th>
                    <td class="text-right" id="totalCotizacion"></td>
                    <td></td>
                  </tr>
                </tfoot>
              </table>
            </div>
          </div>
        </div>
      </div>
      <div class="card-footer">
        <div class="row mb-1">
          <div class="col-12">
            <label for="observacion_asesor">Observación:</label>
            <textarea form="formCreateCotizacion" class="form-control" name="observacion_asesor" id="observacion_asesor" rows="4" placeholder="Escriba aquí las observaciones sobre la cotización"></textarea>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <button data-toggle="tooltip" data-placement="top" title="GUARDAR COTIZACIÓN" type="button" class="btn-success btn-lg ik ik-save" onclick="getDataTablaCotizacion()"></button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="modal_productos" tabindex="-1" role="dialog" aria-labelledby="modal_productos" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="card">
        <div class="card-header">
          <div class="row">
            <div class="col-12">
              <button type="button" class="btn btn-info p-2" id="btnActivePersianaT" name="btnActivePersianaT">CORTINAS</button>
              <button type="button" class="btn btn-info p-2" id="btnActivePuertaT" name="btnActivePuertaT">PUERTAS</button>
              <button type="button" class="btn btn-info p-2" id="btnActiveCerraduraT" name="btnActiveCerraduraT">CERRADURAS</button>
            </div>
          </div>
        </div>
        <div class="card-body">
          <div class="table-responsive" id="tablaPersianas">
            <table id="tableProductosC1" class="table table-bordered">
              <thead>
                <tr>
                  <th class="text-center">ID</th>
                  <th class="text-center">REFERENCIA</th>
                  <th class="text-center">DESCRIPCIÓN</th>
                  <!--  <th>UNIDAD DE MEDIDA</th>
                  <th>ANCHO TELA</th> 
                  <th>FACTOR APERTURA</th>-->
                  <th class="text-center">VALOR ELITE</th>
                  <th class="text-center">VALOR PREMIUM</th>
                  <th class="text-center">TIPO PRODUCTO</th>
                  <th class="text-center">OPCIÓN</th>
                </tr>
              </thead>
              <tbody>

              </tbody>
            </table>
          </div>

          <div class="table-responsive" id="tablaPuertas" hidden>
            <table id="tableProductosC2" class="table table-bordered">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>REFERENCIA</th>
                  <th>DESCRIPCIÓN</th>
                  <th>PASADORES</th>
                  <th>CERRADURA</th>
                  <th>LLAVES</th>
                  <th>TIPO SEGURIDAD</th>
                  <th>VALOR ELITE</th>
                  <th>VALOR PREMIUM</th>
                  <th>TIPO PRODUCTO</th>
                  <th>OPCIÓN</th>
                </tr>
              </thead>
              <tbody>

              </tbody>
            </table>
          </div>

          <div class="table-responsive" id="tablaCerraduras" hidden>
            <table id="tableProductosC3" class="table table-bordered">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>REFERENCIA</th>
                  <th>DESCRIPCIÓN</th>
                  <th>PASADORES</th>
                  <th>CERRADURA</th>
                  <th>LLAVES</th>
                  <th>TIPO SEGURIDAD</th>
                  <th>VALOR ELITE</th>
                  <th>VALOR PREMIUM</th>
                  <th>TIPO PRODUCTO</th>
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

<style>
  div.dataTables_wrapper div.dataTables_info {
    padding-top: 0.85em;
    white-space: normal;
  }
</style>

<script type="text/javascript">
  const base_url = "<?php echo base_url() ?>";
</script>
<script type="text/javascript" src="<?php echo base_url() ?>js/cotizador/create.js"></script>
<?php $this->load->view('footer'); ?>