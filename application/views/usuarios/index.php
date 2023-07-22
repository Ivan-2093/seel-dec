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
                <tr>
                  <th>ID</th>
                  <th>USUARIO</th>
                  <th>DOCUMENTO</th>
                  <th>NOMBRE</th>
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

    <script type="text/javascript">
    const base_url = "<?php echo base_url() ?>";
    
    
</script>
<script type="text/javascript" src="<?php echo base_url()?>js/usuarios/list.js"></script>
<?php $this->load->view('footer');
