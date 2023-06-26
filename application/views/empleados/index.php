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
  <div class="col-12">
   
  </div>
</div>

<script type="text/javascript">
    const base_url = "<?php echo base_url() ?>";
</script>
<?php $this->load->view('footer');
