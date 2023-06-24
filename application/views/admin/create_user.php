<div class="card">
  <h5 class="card-header">FORMULARIO PARA CREAR TERCEROS</h5>
  <div class="card-body">
    <div class="row">
      <div class="col-lg-6 col-md-6 col-sm-6 col-12">
        <div class="form-floating mb-3">
          <select class="form-control" id="inputTipoDoc" name="inputTipoDoc">
            <?php
            foreach ($data_tipo_doc as $tipo) {
              echo '<option value="' . $tipo->id . '">' . $tipo->descripcion . '</option>';
            }
            ?>
          </select>
          <label for="inputTipoDoc">TIPO DE DOCUMENTO:</label>
        </div>
      </div>
      <div class="col-lg-6 col-md-6 col-sm-6 col-12">
        <div class="form-floating mb-3">
          <input type="number" class="form-control">
          <label>NÚMERO DE DOCUMENTO:</label>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-6 col-md-6 col-sm-6 col-12">
        <div class="form-floating mb-3">
          <input id="inputFirstName" name="inputFirstName" type="text" class="form-control">
          <label for="inputFirstName">PRIMER NOMBRE:</label>
        </div>
      </div>
      <div class="col-lg-6 col-md-6 col-sm-6 col-12">
        <div class="form-floating mb-3">
          <input id="inputSecondName" name="inputSecondName" type="text" class="form-control">
          <label for="inputSecondName">SEGUNDO NOMBRE:</label>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-6 col-md-6 col-sm-6 col-12">
        <div class="form-floating mb-3">
          <input id="inputFirstSurName" name="inputFirstSurName" type="text" class="form-control">
          <label for="inputFirstSurName">PRIMER APELLIDO:</label>
        </div>
      </div>
      <div class="col-lg-6 col-md-6 col-sm-6 col-12">
        <div class="form-floating mb-3">
          <input id="inputSecondSurName" name="inputSecondSurName" type="text" class="form-control">
          <label for="inputSecondSurName">SEGUNDO APELLIDO:</label>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-6 col-md-6 col-sm-6 col-12">
        <div class="input-group input-group-sm mb-3">
          <span class="input-group-text" id="inputGroup-sizing-sm">GÉNERO</span>
          <select class="form-control">
            <option value="">SELECCIONE UN GÉNERO</option>
            <?php
            foreach ($data_generos as $genero) {
              echo '<option value="' . $genero->id . '">' . $genero->genero . '</option>';
            }
            ?>
          </select>
        </div>
      </div>

    </div>
    <div class="row">
      <div class="col-lg-6 col-md-6 col-sm-6 col-12">
        <div class="input-group input-group-sm mb-3">
          <span class="input-group-text" id="inputGroup-sizing-sm">CORREO</span>
          <input type="text" class="form-control">
        </div>
      </div>
      <div class="col-lg-6 col-md-6 col-sm-6 col-12">
        <div class="input-group input-group-sm mb-3">
          <span class="input-group-text" id="inputGroup-sizing-sm">TELEFONO</span>
          <input type="text" class="form-control">
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-6 col-md-6 col-sm-6 col-12">
        <div class="input-group input-group-sm mb-3">
          <span class="input-group-text" id="inputGroup-sizing-sm">PAIS</span>
          <select id="comboPais" name="comboPais" class="form-control">
            <option value="">SELECCIONE UN PAIS</option>
            <?php
            foreach ($data_paises as $pais) {
              echo '<option value="' . $pais->id . '">' . $pais->pais . '</option>';
            }
            ?>
          </select>
        </div>
      </div>
      <div class="col-lg-6 col-md-6 col-sm-6 col-12">
        <div class="input-group input-group-sm mb-3">
          <span class="input-group-text" id="inputGroup-sizing-sm">DEPARTAMENTO</span>
          <select id="comboDepto" name="comboDepto" class="form-control">
            <option value="">SELECCIONE UN DEPARTAMENTO</option>
          </select>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-6 col-md-6 col-sm-6 col-12">
        <div class="input-group input-group-sm mb-3">
          <span class="input-group-text" id="inputGroup-sizing-sm">MUNICIPIO</span>
          <select id="comboMunicipio" name="comboMunicipio" class="form-control">
            <option value="">SELECCIONE UN MUNICIPIO</option>
          </select>
        </div>
      </div>
      <div class="col-lg-6 col-md-6 col-sm-6 col-12">
        <div class="input-group input-group-sm mb-3">
          <span class="input-group-text" id="inputGroup-sizing-sm">DIRECCIÓN</span>
          <input type="text" class="form-control">
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
