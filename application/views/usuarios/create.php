<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-body">
        <ul class="nav nav-pills">
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="<?= base_url() ?>UsuariosController">USUARIOS</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="<?= base_url() ?>UsuariosController/create">CREAR USUARIO</a>
          </li>
        </ul>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-12">
    <div class="card">
      <h5 class="card-header">FORMULARIO PARA CREAR USUARIOS</h5>
      <form id="formCreateUsuario" name="formCreateUsuario">
        <div class="card-body">
          <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-12 mb-3">
              <label class="d-block" for="inputIdEmpleado">TERCERO:</label>
              <select class="form-control js-select2-tercero" id="inputIdEmpleado" name="inputIdEmpleado">
                <option value=""></option>
                <?php
                /* print_r($data_terceros); */
                foreach ($data_empleados as $empleado) {
                  echo '<option value="' . $empleado->id_empleado . '">' . $empleado->primer_nombre . ' ' . $empleado->segundo_nombre . ' ' . $empleado->primer_apellido . ' ' . $empleado->segundo_apellido . '</option>';
                }
                ?>
              </select>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-12 mb-3">
              <label class="d-block" for="inputIdPerfil">PERFIL:</label>
              <select class="form-control js-select2-perfil" id="inputIdPerfil" name="inputIdPerfil">
                <option value=""></option>
                <?php
                /* print_r($data_terceros); */
                foreach ($data_perfiles as $perfil) {
                  echo '<option value="' . $perfil->id_perfil . '">' . $perfil->perfil . '</option>';
                }
                ?>
              </select>
            </div>
          </div>
        </div>
        <div class="card-footer text-right">
          <button id="btnSubmitCreateUsuario" name="btnSubmitCreateUsuario" type="button" class="btn btn-success">CREAR</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script type="text/javascript">
  const base_url = "<?php echo base_url() ?>";
</script>
<script type="text/javascript" src="<?php echo base_url() ?>js/usuarios/funciones.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>js/check_inputs.js"></script>


<?php $this->load->view('footer');
