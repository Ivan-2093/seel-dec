<div class="row">
  <div class="col-auto">
    <div class="card">
      <div class="card-body">
        <ul class="nav nav-pills">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="<?= base_url() ?>ProductosController">PRODUCTOS</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= base_url() ?>ProductosController/create">CREAR PRODUCTO</a>
          </li>
        </ul>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-12">
    <table style="width:100% ;" id="tableClientes" class="table table-bordered">
      <thead>
        <!-- `id_producto`, `referencia`, `descripcion`, `anchos_tela_metro`, `unidad_medida`, `factor_apertura`, `costo_elite`, `costo_premium`, `id_tipo_p`, `proveedor_id`, `porce_precio`, `pasadores`, `cerradura`, `llaves`, `tipo_seguridad` -->
        <tr>
          <th>ID</th>
          <th>REFERENCIA</th>
          <th>DESCRIPCIÓIN</th>
          <th>COSTO ELITE</th>
          <th>COSTO PREMIUM</th>
          <th>% DE PRECIO</th>
          <th>TIPO PRODUCTO</th>
          <th>CATEGORIA</th>
          <th>PROVEEDOR</th>
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
<script type="text/javascript" src="<?= base_url() ?>js/productos/list.js"></script>
<script type="text/javascript" src="<?= base_url() ?>js/funciones_img.js"></script>

<?php $this->load->view('footer');
