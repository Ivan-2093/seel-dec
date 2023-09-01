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
                    <th>NÚMERO DE DOCUMENTO</th>
                    <th>NOMBRE</th>
                    <th>CORREO</th>
                    <th>TELEFONO CONTACTO</th>
                    <th>TELEFONO ADICIONAL</th>
                    <th>EDITAR</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</div>

<!-- Modal Editar Tercero -->
<div class="modal fade" id="modalEditTercero" tabindex="-1" role="dialog" aria-labelledby="modalEditTercero" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditTerceroLabel">Editar Tercero: </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">

                    <form id="formEditTercero" name="formEditTercero">
                        <div class="card-body" style="background:#90ee9073;">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="form-floating mb-3">
                                        <select class="form-control select2Tipo" id="inputTipoDoc" name="inputTipoDoc">
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
                                        <input id="inputNumeroDoc" name="inputNumeroDoc" type="number" class="form-control">
                                        <label for="inputNumeroDoc">NÚMERO DE DOCUMENTO:</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="form-floating mb-3">
                                        <input id="inputFirstName" name="inputFirstName" type="text" class="form-control" oninput="this.value = this.value.toUpperCase()" pattern="[a-zA-Z]+" title="No se admiten caracteres especiales">
                                        <label for="inputFirstName">PRIMER NOMBRE:</label>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="form-floating mb-3">
                                        <input id="inputSecondName" name="inputSecondName" type="text" class="form-control" oninput="this.value = this.value.toUpperCase()" pattern="[a-zA-Z]+" title="No se admiten caracteres especiales">
                                        <label for="inputSecondName">SEGUNDO NOMBRE:</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="form-floating mb-3">
                                        <input id="inputFirstSurName" name="inputFirstSurName" type="text" class="form-control" oninput="this.value = this.value.toUpperCase()" pattern="[a-zA-Z]+" title="No se admiten caracteres especiales">
                                        <label for="inputFirstSurName">PRIMER APELLIDO:</label>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="form-floating mb-3">
                                        <input id="inputSecondSurName" name="inputSecondSurName" type="text" class="form-control" oninput="this.value = this.value.toUpperCase()" pattern="[a-zA-Z]+" title="No se admiten caracteres especiales">
                                        <label for="inputSecondSurName">SEGUNDO APELLIDO:</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="form-floating mb-3">
                                        <select id="inputIdGenero" name="inputIdGenero" class="form-control select2Genero">
                                            <option value="">SELECCIONE UN GÉNERO</option>
                                            <?php
                                            foreach ($data_generos as $genero) {
                                                echo '<option value="' . $genero->id . '">' . $genero->genero . '</option>';
                                            }
                                            ?>
                                        </select>
                                        <label for="inputIdGenero">GÉNERO:</label>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="form-floating mb-3">
                                        <input type="mail" id="inputEmail" name="inputEmail" class="form-control" oninput="this.value = this.value.toUpperCase()">
                                        <label for="inputEmail">CORREO:</ñ>
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="form-floating mb-3">
                                        <input id="inputTelefono_1" name="inputTelefono_1" type="tel" class="form-control" pattern="[0-9]+10" title="No se admiten caracteres especiales">
                                        <label for="inputTelefono_1">TELEFONO PERSONAL:</label>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="form-floating mb-3">
                                        <input id="inputTelefono_2" name="inputTelefono_2" type="tel" class="form-control" pattern="[0-9]+10" title="No se admiten caracteres especiales">
                                        <label for="inputTelefono_2">TELEFONO DE CONTACTO:</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="form-floating mb-3">
                                        <select id="comboPais" name="comboPais" class="form-control select2Pais">
                                            <option value="">SELECCIONE UN PAIS</option>
                                            <?php
                                            foreach ($data_paises as $pais) {
                                                echo '<option value="' . $pais->id . '">' . $pais->pais . '</option>';
                                            }
                                            ?>
                                        </select>
                                        <label for="comboPais">PAIS:</label>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="form-floating mb-3">
                                        <input hidden type="hidden" id="comboDeptoBan" class="form-control" value=""/>
                                        <select id="comboDepto" name="comboDepto" class="form-control select2Depto">

                                        </select>
                                        <label for="comboDepto">DEPARTAMENTO:</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="form-floating mb-3">
                                        <input hidden type="hidden" id="comboMunicipioBan" class="form-control" value=""/>
                                        <select id="comboMunicipio" name="comboMunicipio" class="form-control select2Municipio">
                                            
                                        </select>
                                        <label for="comboMunicipio">MUNICIPIO:</label>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="form-floating mb-3">
                                        <input id="inputBarrio" name="inputBarrio" type="text" class="form-control" oninput="this.value = this.value.toUpperCase()">
                                        <label for="inputBarrio">BARRIO:</label>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="form-floating mb-3">
                                        <input id="inputDireccion" name="inputDireccion" type="text" class="form-control" oninput="this.value = this.value.toUpperCase()">
                                        <label for="inputDireccion">DIRECCIÓN:</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button id="btnSubmitEditTercero" name="btnSubmitEditTercero" type="button" class="btn btn-success">GUARDAR</button>
                            <input id="inputIdTercero" name="inputIdTercero" type="hidden" hidden>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    const base_url = "<?php echo base_url() ?>";
</script>
<script type="text/javascript" src="<?= base_url() ?>js/terceros/list_terceros.js"></script>
<?php $this->load->view('footer');
