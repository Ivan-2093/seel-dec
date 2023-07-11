<div class="row">
  <div class="col-12">
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
          <th>ID</th>
          <th>DOCUMENTO</th>
          <th>NOMBRES</th>
          <th>CARGO</th>
          <th>SEDE</th>
          <th>EMAIL</th>
          <th>FOTO</th>
        </tr>
      </thead>
      <tbody>

      </tbody>
    </table>
  </div>
</div>

<script type="text/javascript">
  const base_url = "<?php echo base_url() ?>";
  const sidebar = document.getElementById("sidebar");
  const cargando = document.getElementById("cargando");
</script>
<script type="text/javascript" src="<?= base_url() ?>js/empleados/list.js"></script>
<script type="text/javascript" src="<?= base_url() ?>js/funciones_generales.js"></script>
<?php $this->load->view('footer');
