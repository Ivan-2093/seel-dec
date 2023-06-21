<div class="card">
  <h5 class="card-header">FORMULARIO PARA CREAR TERCEROS</h5>
  <div class="card-body">
    <div class="row">
      <div class="col-auto">
        <div class="input-group input-group-sm mb-3">
          <span class="input-group-text" id="inputGroup-sizing-sm">TIPO DE DOCUMENTO</span>
          <select class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
            <?php
            foreach ($data_tipo_doc as $tipo) {
              echo '<option value="' . $tipo->id . '">' . $tipo->descripcion . '</option>';
            }
            ?>
          </select>
        </div>
      </div>
      <div class="col-auto">
        <div class="input-group input-group-sm mb-3">
          <span class="input-group-text" id="inputGroup-sizing-sm">NÚMERO DE DOCUMENTO</span>
          <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-auto">
        <div class="input-group input-group-sm mb-3">
          <span class="input-group-text" id="inputGroup-sizing-sm">PRIMER NOMBRE</span>
          <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
        </div>
      </div>
      <div class="col-auto">
        <div class="input-group input-group-sm mb-3">
          <span class="input-group-text" id="inputGroup-sizing-sm">SEGUNDO NOMBRE</span>
          <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
        </div>
      </div>
      <div class="col-auto">
        <div class="input-group input-group-sm mb-3">
          <span class="input-group-text" id="inputGroup-sizing-sm">PRIMER APELLIDO</span>
          <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
        </div>
      </div>
      <div class="col-auto">
        <div class="input-group input-group-sm mb-3">
          <span class="input-group-text" id="inputGroup-sizing-sm">SEGUNDO APELLIDO</span>
          <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-auto">
        <div class="input-group input-group-sm mb-3">
          <span class="input-group-text" id="inputGroup-sizing-sm">CORREO</span>
          <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
        </div>
      </div>
      <div class="col-auto">
        <div class="input-group input-group-sm mb-3">
          <span class="input-group-text" id="inputGroup-sizing-sm">TELEFONO</span>
          <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
        </div>
      </div>
      <div class="col-auto">
        <div class="input-group input-group-sm mb-3">
          <span class="input-group-text" id="inputGroup-sizing-sm">DIRECCIÓN</span>
          <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-auto">
        <div class="input-group input-group-sm mb-3">
          <span class="input-group-text" id="inputGroup-sizing-sm">PAIS</span>
          <select id="comboPais" name="comboPais" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
            <option value="">SELECCIONE UN PAIS</option>
            <?php
            foreach ($data_paises as $pais) {
              echo '<option value="' . $pais->id . '">' . $pais->pais . '</option>';
            }
            ?>
          </select>
        </div>
      </div>
      <div class="col-auto">
        <div class="input-group input-group-sm mb-3">
          <span class="input-group-text" id="inputGroup-sizing-sm">DEPARTAMENTO</span>
          <select class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
            <option value="">SELECCIONE UN DEPARTAMENTO</option>
          </select>
        </div>
      </div>
      <div class="col-auto">
        <div class="input-group input-group-sm mb-3">
          <span class="input-group-text" id="inputGroup-sizing-sm">MUNICIPIO</span>
          <select class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
            <option value="">SELECCIONE UN MUNICIPIO</option>
          </select>
        </div>
      </div>

    </div>
  </div>
</div>

<script type="text/javascript">
  const base_url = "<?php echo base_url() ?>";
</script>
<script src="<?php base_url() ?>js/admin/funciones.js"></script>
<?php $this->load->view('footer');
