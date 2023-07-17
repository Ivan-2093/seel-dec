<div class="row">
  <div class="col-auto">
    <div class="card">
      <div class="card-body">
        <ul class="nav nav-pills">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="<?= base_url() ?>EmpleadosController">EMPLEADOS</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= base_url() ?>EmpleadosController/create">CREAR EMPLEADO</a>
          </li>
        </ul>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-12 table-responsive">
    <table id="tableEmpleados" class="table table-bordered">
      <thead>
        <tr>
          <th class="text-center">FOTO</th>
          <!-- <th class="text_center">ID</th> -->
          <th class="text-center">DOCUMENTO</th>
          <th class="text-center">NOMBRES</th>
          <th class="text-center">CARGO</th>
          <th class="text-center">SEDE</th>
          <th class="text-center">EMAIL</th>
          <th class="text-center">OPCIONES</th>
        </tr>
      </thead>
      <tbody>

      </tbody>
    </table>
  </div>
</div>

<!-- Modal Editar Empleado -->
<div class="modal fade" id="modalEditEmpleado" tabindex="-1" role="dialog" aria-labelledby="modalEditEmpleado" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalEditEmpleadoLabel">Editar Empleado: </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="container-fluid">
          <form id="formEditarEmpleado" name="formEditarEmpleado" enctype="multipart/form-data">
            <div class="card-body" style="background-color: #90ee9073 ;">
              <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-12 mb-3">
                  <label class="d-block" for="inputIdTercero">TERCERO</label>
                  <select disabled class="form-control js-select2-tercero" id="inputIdTercero" name="inputIdTercero">
                    <option value=""></option>
                    <?php
                    /* print_r($data_terceros); */
                    foreach ($data_terceros as $tercero) {
                      echo '<option value="' . $tercero->id_tercero . '">' . $tercero->primer_nombre . ' ' . $tercero->segundo_nombre . ' ' . $tercero->primer_apellido . ' ' . $tercero->segundo_apellido . '</option>';
                    }
                    ?>
                  </select>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-12 mb-3">
                  <label class="d-block" for="inputEmailEmp">Correo Corporativo:</label>
                  <input id="inputEmailEmp" name="inputEmailEmp" type="mail" class="form-control" placeholder="ejemplo@seeldec.com">
                </div>
              </div>
              <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-12 mb-3">
                  <label class="d-block" for="inputIdCargoEmp">CARGO EMPLEADO:</label>
                  <select class="form-control js-select2-cargo" id="inputIdCargoEmp" name="inputIdCargoEmp">
                    <option value=""></option>
                    <?php
                    /* print_r($data_terceros); */
                    foreach ($data_cargos as $cargo) {
                      echo '<option value="' . $cargo->id . '">' . $cargo->cargo . '</option>';
                    }
                    ?>
                  </select>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-12 mb-3">
                  <label class="d-block" for="inputIdSedeEmp">SEDE:</label>
                  <select class="form-control js-select2-sede" id="inputIdSedeEmp" name="inputIdSedeEmp">
                    <option value=""></option>
                    <?php
                    foreach ($data_sedes as $sede) {
                      echo '<option value="' . $sede->id . '">' . $sede->sede . '</option>';
                    }
                    ?>
                  </select>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                  <label for="inputFileImgEmp">FOTO DE PERFIL:</label>
                  <input id="inputFileImgEmp" name="inputFileImgEmp" type="file" class="form-control" aria-label="file example" accept="image/png, image/gif, image/jpeg">


                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                  <label for="inputFileImgEmp">PREVIA:</label>
                  <img src="<?= base_url() ?>plantilla/img/icons/logo-seeldec.jpeg" alt="User Avatar" class="img_prev" id="imagenPrevisualizacion" width="200px">


                </div>
              </div>
            </div>
            <div class="card-footer text-right">
              <input type="hidden" id="inputIdTerceroHidden" name="inputIdTerceroHidden" value="">
              <button id="btnSubmitEditEmpleado" name="btnSubmitEditEmpleado" type="button" class="btn btn-success">ACTUALIZAR</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  const base_url = "<?php echo base_url() ?>";
</script>
<script type="text/javascript" src="<?= base_url() ?>js/empleados/list.js"></script>
<?php $this->load->view('footer');
