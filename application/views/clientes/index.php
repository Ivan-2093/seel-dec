<div class="row">
  <div class="col-auto">
    <div class="card">
      <div class="card-body">
        <ul class="nav nav-pills">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="<?= base_url() ?>ClientesController">CLIENTES</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= base_url() ?>ClientesController/create">CREAR CLIENTE</a>
          </li>
        </ul>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-12 table-responsive">
    <table id="tableClientes" class="table table-bordered">
      <thead>
        <tr>
          <th>NÚMERO DE DOCUMENTO</th>
          <th>NOMBRE</th>
          <th>CORREO</th>
          <th>TELEFONO CONTACTO</th>
          <th>TELEFONO ADICIONAL</th>
        </tr>
      </thead>
      <tbody>

      </tbody>
    </table>
  </div>
</div>

<script type="text/javascript">
  const base_url = "<?php echo base_url() ?>";
</script>
<script type="text/javascript" src="<?= base_url() ?>js/clientes/list.js"></script>
<script type="text/javascript" src="<?= base_url() ?>js/funciones_img.js"></script>

<?php $this->load->view('footer');
