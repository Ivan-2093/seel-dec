<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h1 class="title">NEGOCIO</h1>
                <div class="row">
                    <div class="col-md-1">
                        <img id="imgTemperatura" src="http://localhost/seel-dec/plantilla/img/icons/logo-seeldec.jpeg" width="auto" height="60">
                    </div>
                    <div class="col-md-9">
                        <p class="m-0 p-0 font-weight-bold"><?= $data_negocio['cliente'] ?>
                            <button type="button" class="btn btn-primary ml-5 btn-sm" data-toggle="modal" data-target="#prospecto" onclick="obtenerCombos(<?= $data_negocio['id_negocio'] ?>);">
                                <i class="ik ik-edit"></i>
                            </button>
                        </p>
                        <p class="m-0 p-0"></p>

                        
                        <p class="m-0 p-0">Negocio-<?= $data_negocio['id_negocio'] ?></p>
                    </div>
                    <div class="col-md-2">
                        <div class="row align-items-start">
                            <p><?= $data_negocio['fecha_registro'] ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12" id="flujo_trabajo">
                        <h4 class="mb-5">Flujo de trabajo:</h4>
                    </div>
                </div>
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
<script type="text/javascript" src="<?php echo base_url() ?>js/negocios/flujo_trabajo.js"></script>
<?php $this->load->view('footer'); ?>