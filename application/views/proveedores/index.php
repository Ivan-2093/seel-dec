<div class="row">
  <div class="col-auto">
    <div class="card">
      <div class="card-body">
        <ul class="nav nav-pills">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="<?= base_url() ?>ProveedoresController">PROVEEDORES</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= base_url() ?>ProveedoresController/create">CREAR PROVEEDOR</a>
          </li>
        </ul>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-12 table-responsive">
    <table id="tableProveedores" class="table table-bordered">
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
<script type="text/javascript" src="<?= base_url() ?>js/proveedores/list.js"></script>
<script type="text/javascript" src="<?= base_url() ?>js/funciones_img.js"></script>

<?php $this->load->view('footer');
