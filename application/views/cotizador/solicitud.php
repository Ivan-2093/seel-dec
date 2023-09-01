<div class="row">
  <div class="col-12">
    <div class="card">
      <h5 class="card-header">DATOS DE CONTACTO</h5>
      <form id="formCreateTercero" name="formCreateTercero">
        <div class="card-body" style="background:#90ee9073;">
          <div class="row">
            <div class="col-lg-3">
              <label class="d-block" for="inputName">NOMBRE</label>
              <input type="text" class="form-control " id="inputName" name="inputName" placeholder="Nombre del cliente" />
            </div>
            <div class="col-lg-3">
              <label class="d-block" for="inputEmail">CORREO</label>
              <input type="mail" class="form-control " id="inputEmail" name="inputEmail" placeholder="Nombre del cliente" />
            </div>
            <div class="col-lg-3">
              <label class="d-block" for="inputName">NOMBRE DE CLIENTE</label>
              <input type="text" class="form-control " id="inputName" name="inputName" placeholder="Nombre del cliente" />
            </div>
            <div class="col-lg-3">
              <label class="d-block" for="inputName">NOMBRE DE CLIENTE</label>
              <input type="text" class="form-control " id="inputName" name="inputName" placeholder="Nombre del cliente" />
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-12">
    <div class="card">
      <h5 class="card-header">COTIZACIÓN</h5>
      <form id="formCreateTercero" name="formCreateTercero">
        <div class="card-body" style="background:#90ee9073;">
        </div>
        <div class="card-footer text-right">
          <button id="btnSubmitCreateTercero" name="btnSubmitCreateTercero" type="button" class="btn btn-success">CREAR</button>
        </div>
      </form>
    </div>
  </div>
</div>


<script type="text/javascript">
  const base_url = "<?php echo base_url() ?>";
</script>
<script type="text/javascript" src="<?php echo base_url() ?>js/terceros/create.js"></script>
<?php $this->load->view('footer');
