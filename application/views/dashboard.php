<div class="text-center">
    <img class="img-fluid" src="<?php base_url() ?>plantilla/img/icons/logo-seeldec.jpeg" width="auto" alt="logo_asa">
</div>


<script type="text/javascript">
    const base_url = "<?php echo base_url() ?>";
    const sidebar = document.getElementById("sidebar");
    const cargando = document.getElementById("cargando");
    const change_password = <?php echo $this->session->userdata('change_password'); ?>
</script>
<script src="<?php echo base_url() ?>js/funciones_generales.js"></script>
<?php $this->load->view('footer');
