<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-body">
        <ul class="nav nav-pills">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="<?= base_url() ?>UsuariosController">USUARIOS</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= base_url() ?>UsuariosController/create">CREAR USUARIO</a>
          </li>
        </ul>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-12">
    <div class="card">
      <h5 class="card-header">LISTA DE USUARIOS</h5>
      <div class="card-body">
        <div class="row">
          <div class="col-12 table-responsive">
            <table id="tableUsuarios" class="table table-bordered">
              <thead>
                <tr class="text-center">
                  <th>ID</th>
                  <th>USUARIO</th>
                  <th>DOCUMENTO</th>
                  <th>NOMBRE</th>
                  <th>PERFIL</th>
                  <th>OPCIONES</th>
                </tr>
              </thead>
              <tbody></tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form id="formCreateUsuario" name="formCreateUsuario">
        <div class="card-body">
          <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-12 mb-3">
              <label class="d-block" for="inputIdEmpleado">TERCERO:</label>
              <input type="text" class="form-control">
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
<script type="text/javascript" src="<?php echo base_url() ?>js/usuarios/list.js"></script>
<?php $this->load->view('footer');
