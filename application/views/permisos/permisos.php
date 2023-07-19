<div class="container-fluid">
    <div class="page-header">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    <i class="ik ik-bookmark bg-green"></i>
                    <div class="d-inline">
                        <h5>PERMISOS</h5>
                        <span>Creación de menus para agregar los modulos</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <nav class="breadcrumb-container" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="<?= base_url() ?>"><i class="ik ik-home"></i></a>
                        </li>
                        <li class="breadcrumb-item active">
                            <a href="#">Menus</a>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <div class="card">
        <!-- Button trigger modal -->
        <div class="card-body">

            <table class="table table-hover table-bordered " id="tabla_permisos">
                <thead class="bg-dark">
                    <tr class="text-center">
                        <th style=" text-shadow: 2px 2px 4px #000000;" scope="col">PERFIL</th>
                        <th style=" text-shadow: 2px 2px 4px #000000;" scope="col">PERMISOS</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>
<script type="text/javascript">
    const base_url = "<?php echo base_url() ?>";
</script>
<script type="text/javascript" src="<?= base_url() ?>js/permisos/funciones_permisos.js"></script>
<?php $this->load->view('footer');
