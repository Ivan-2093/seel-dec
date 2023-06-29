<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-body">
        <ul class="nav nav-pills">
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="<?= base_url() ?>TercerosController">TERCEROS</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="<?= base_url() ?>TercerosController/create">CREAR TERCERO</a>
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
<script type="text/javascript" src="<?php echo base_url() ?>js/admin/funciones.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>js/check_inputs.js"></script>

<?php $this->load->view('footer');
