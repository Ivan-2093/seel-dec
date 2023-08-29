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
                  <th>ESTADO</th>
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


<div class="modal fade bd-example-modal-lg" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="editUserModal" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form id="formEditUsuario" name="formEditUsuario">
        <div class="card-header">
          <h5 class="title">EDITAR USUARIO</h5>
        </div>
        <div class="card-body">
          <div class="row">
            <div hidden class="col-lg-6 col-md-6 col-sm-6 col-12 mb-3">
              <label class="d-block" for="inputIdUser">ID USUARIO:</label>
              <input type="text" class="form-control" id="inputIdUser" name="inputIdUser" readonly>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-12 mb-3">
              <label class="d-block" for="inputNameTercero">TERCERO:</label>
              <input type="text" class="form-control" id="inputNameTercero" name="inputNameTercero" readonly>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-12 mb-3">
              <label class="d-block" for="inputNameUser">USARIO:</label>
              <input type="text" class="form-control" id="inputNameUser" name="inputNameUser" readonly>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-12 mb-3">
              <label class="d-block" for="inputIdPerfil">PERFIL:</label>
              <select class="form-control js-select2-perfil" id="inputIdPerfil" name="inputIdPerfil">
                <option value="">SELECCIONE UN PERFIL</option>
                <?php
                /* print_r($data_terceros); */
                foreach ($data_perfiles as $perfil) {
                  echo '<option value="' . $perfil->id_perfil . '">' . $perfil->perfil . '</option>';
                }
                ?>
              </select>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-12 mb-3">
              <label class="d-block" for="inputIdEstado">ESTADO:</label>
              <select class="form-control js-select2-estado" id="inputIdEstado" name="inputIdEstado">
                <option value="">SELECCIONE UN ESTADO</option>
                <?php
                /* print_r($data_terceros); */
                foreach ($data_estados as $estado) {
                  echo '<option value="' . $estado->id . '">' . $estado->estado . '</option>';
                }
                ?>
              </select>
            </div>
          </div>
        </div>
        <div class="card-footer text-right">
          <button id="btnSubmitEditUsuario" name="btnSubmitEditUsuario" type="button" class="btn btn-success">EDITAR</button>
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
