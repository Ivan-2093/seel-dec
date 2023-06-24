<div class="card" style="max-width: 70rem;">
  <h5 class=" card-header text-center">FORMULARIO PARA CREAR TERCEROS</h5>
  <form class="card-body">
    <div class="row">
      <div class="col-lg-3 col-md-3 col-sm-3 col-12">
        <div class="mb-3 text-center">
          <label for="inputTipoDoc">TIPO DE DOCUMENTO:</label>
          <select class="form-control text-center" id="inputTipoDoc" name="inputTipoDoc">
            <?php
            foreach ($data_tipo_doc as $tipo) {
              echo '<option value="' . $tipo->id . '">' . $tipo->descripcion . '</option>';
            }
            ?>
          </select>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-3 col-md-3 col-sm-3 col-12">
        <div class="mb-3 text-center">
          <label for="inputFirstName">PRIMER NOMBRE:</label>
          <input id="inputFirstName" name="inputFirstName" type="text" class="form-control">
        </div>
      </div>
  </form>
</div>
<script type="text/javascript">
  const base_url = "<?php echo base_url() ?>";
</script>
<script src="<?php base_url() ?>js/admin/funciones.js"></script>
<?php $this->load->view('footer');
