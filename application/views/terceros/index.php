<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <ul class="nav nav-pills">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">TERCEROS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url() ?>TercerosController/create">CREAR TERCERO</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12 table-responsive">
        <table class="table table-bordered" id="tableTerceros">
            <thead>
                <tr class="align-middle">
                    <th>TIPO DOCUMENTO</th>
                    <th>NÚMERO DE DOCUMENTO</th>
                    <th>NOMBRE</th>
                    <th>CORREO</th>
                    <th>TELEFONO CONTACTO</th>
                    <th>TELEFONO ADICIONAL</th>
                    <th>GÉNERO</th>
                    <!-- <th>PAIS</th>
                    <th>DEPARTAMENTO</th> -->
                    <th>MUNICIPIO</th>
                    <th>BARRIO</th>
                    <th>DIRECCION</th>
                    <th>EDITAR</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</div>

<script type="text/javascript">
    const base_url = "<?php echo base_url() ?>";
    const sidebar = document.getElementById("sidebar");
    const cargando = document.getElementById("cargando");
</script>
<script type="text/javascript" src="<?= base_url() ?>js/terceros/list_terceros.js"></script>
<script type="text/javascript" src="<?= base_url() ?>js/funciones_generales.js"></script>
<script src="https://kit.fontawesome.com/d316d39692.js" crossorigin="anonymous"></script>
<?php $this->load->view('footer');
