<!-- MODAL PARA CAMBIAR DE CONTRASEÑA -->
<div class="modal fade" id="modal_change_pass" tabindex="-1" role="dialog" aria-labelledby="modal_change_pass" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_change_pass">Es necesario que cambies tu contraseña</h5>
            </div>
            <div class="modal-body">
                <form id="form_change_pass">
                    <div class="row">
                        <div class="col-sm-6 col-12">
                            <label for="new_pass">Nueva contraseña</label>
                            <div class="input-group mb-3">
                                <input hidden type="text" name="username" autocomplete="username" value="a_b">
                                <input autocomplete="new-password" type="password" id="new_pass" name="new_pass" class="form-control" placeholder="Ingrese nueva contraseña">
                                <div class="input-group-append">
                                    <span style="cursor: pointer;" id="verPassNew" class="input-group-text "><i class="ik ik-eye-off"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-12">
                            <label for="new_pass_check">Confirme la contraseña</label>
                            <div class="input-group mb-3">
                                <input disabled autocomplete="new-password" type="password" id="new_pass_check" name="new_pass_check" class="form-control" placeholder="Confirma la contraseña">
                                <div class="input-group-append">
                                    <span style="cursor: pointer;" id="verPassCheck" class="input-group-text "><i class="ik ik-eye-off"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <a href="<?php base_url() ?>LoginController/logout" class="btn btn-secondary">Cerrar</a>

                <button type="button" id="btnChangePass" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
</div>
<footer class="footer">
    <div class="w-100 clearfix">
        <span class="text-center text-sm-left d-md-inline-block">Copyright © <?php echo date('Y') ?> SeelDec Todos los derechos reservados.</span>
        <span class="float-none float-sm-right mt-1 mt-sm-0 text-center">Power by Sergio Galvis & Jhon Silva</span>
    </div>
</footer>
</div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script>
    window.jQuery || document.write('<script src="src/js/vendor/jquery-3.3.1.min.js"><\/script>')
</script>
<script src="<?= base_url() ?>plantilla/plugins/popper.js/dist/umd/popper.min.js"></script>
<script src="<?= base_url() ?>plantilla/plugins/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>

<script src="<?= base_url() ?>plantilla/plugins/perfect-scrollbar/dist/perfect-scrollbar.min.js"></script>
<script src="<?= base_url() ?>plantilla/plugins/screenfull/dist/screenfull.js"></script>
<script src="<?= base_url() ?>plantilla/plugins/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>plantilla/plugins/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url() ?>plantilla/plugins/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url() ?>plantilla/plugins/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
<script src="<?= base_url() ?>plantilla/plugins/jvectormap/jquery-jvectormap.min.js"></script>
<script src="<?= base_url() ?>plantilla/plugins/jvectormap/test/assets/jquery-jvectormap-world-mill-en.js"></script>
<script src="<?= base_url() ?>plantilla/plugins/moment/moment.js"></script>
<script src="<?= base_url() ?>plantilla/plugins/tempusdominus-bootstrap-4/build/js/tempusdominus-bootstrap-4.min.js"></script>
<script src="<?= base_url() ?>plantilla/plugins/d3/dist/d3.min.js"></script>
<!-- <script src="<?= base_url() ?>plantilla/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script> -->
<script src="<?= base_url() ?>plantilla/plugins/jquery.repeater/jquery.repeater.min.js"></script>
<!-- <script src="<?= base_url() ?>plantilla/plugins/mohithg-switchery/dist/switchery.min.js"></script> -->
<script src="<?= base_url() ?>plantilla/plugins/Wizard-JS-main/src/wizard.js"></script>
<script src="<?= base_url() ?>plantilla/plugins/c3/c3.min.js"></script>
<script src="<?= base_url() ?>plantilla/plugins/amcharts/amcharts.js"></script>
<script src="<?= base_url() ?>plantilla/plugins/amcharts/serial.js"></script>
<script src="<?= base_url() ?>plantilla/plugins/amcharts/themes/light.js"></script>
<script src="<?= base_url() ?>plantilla/plugins/amcharts/animate.min.js"></script>
<script src="<?= base_url() ?>plantilla/js/tables.js"></script>
<script src="<?= base_url() ?>plantilla/js/form-advanced.js"></script>
<script src="<?= base_url() ?>plantilla/js/widgets.js"></script>
<script src="<?= base_url() ?>plantilla/js/charts.js"></script>
<script src="<?= base_url() ?>plantilla/dist/js/theme.min.js"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.38.0/js/tempusdominus-bootstrap-4.min.js" crossorigin="anonymous"></script> -->
<script src="<?= base_url() ?>plantilla/js/es.js"></script>



<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<!-- Toastr -->
<!-- <script src="<?= base_url() ?>plugins/toastr/toastr.min.js"></script> -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<!--GRAFICAS-->
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!--TO EXCEL-->
<script src="//cdn.rawgit.com/rainabba/jquery-table2excel/1.1.0/dist/jquery.table2excel.min.js"></script>
<!-- datetimepicker -->
<script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>


<script type="text/javascript">
    const change_password = <?php echo $this->session->userdata('change_password'); ?>;
</script>
<script src="<?php echo base_url() ?>js/funciones_generales.js"></script>
<script src="<?php echo base_url() ?>js/check_inputs.js"></script>

</body>

</html>