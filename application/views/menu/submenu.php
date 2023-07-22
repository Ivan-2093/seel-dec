<div class="container-fluid">
    <div class="page-header">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    <i class="ik ik-menu bg-green"></i>
                    <div class="d-inline">
                        <h5>SUBMENUS</h5>
                        <span>Creación de submenus para agregar los modulos</span>
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
                            <a href="#">Submenus</a>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-12">
                    <button style=" text-shadow: 2px 2px 4px #000000;" type="button" class="btn btn-info" data-toggle="modal" data-target="#ModalCreateSubmenu"> Nuevo Submenu <span><i class="fas fa-plus-circle px-1"></i></span></button>
                </div>
            </div>
        </div>
        <!-- Button trigger modal -->
        <div class="card-body table-responsive">

            <table class="table table-hover table-bordered " id="tabla_submenu">
                <thead class="bg-dark">
                    <tr>
                        <th style=" text-shadow: 2px 2px 4px #000000;" scope="col">Menu</th>
                        <th style=" text-shadow: 2px 2px 4px #000000;" scope="col">Submenu</th>
                        <th style=" text-shadow: 2px 2px 4px #000000;" class="text-center" scope="col">Ruta</th>
                        <th style=" text-shadow: 2px 2px 4px #000000;" class="text-center" scope="col">Nombre icono</th>
                        <th style=" text-shadow: 2px 2px 4px #000000;" class="text-center" scope="col">Icono</th>
                        <th style=" text-shadow: 2px 2px 4px #000000;" class="text-center" scope="col">Editar</th>
                        <th style=" text-shadow: 2px 2px 4px #000000;" class="text-center" scope="col">Eliminar</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal agregar -->
<div class="modal fade" id="ModalCreateSubmenu" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title label col-lg-12 text-center font-bold" id="exampleModalLongTitle">Agregar Nuevo Submenu</h5>
            </div>
            <div class="modal-body">
                <form id="formulario_submenu">
                    <div class="form-group">
                        <label for="id_menuSelect">Menu</label>
                        <select id="id_menuSelect" name="id_menuSelect" class="form-control js-select2-id-menus">

                        </select>
                        
                    </div>
                    <div class="form-group">
                        <label for="nombreMenu">Nombre del Submenu</label>
                        <input type="text" class="form-control" name="nombreSubmenu" id="nombreSubmenu" aria-describedby="emailHelp" placeholder="Nombre">
                    </div>
                    <div class="form-group">
                        <label for="nombre_icono">Ruta</label>
                        <input type="text" class="form-control" name="ruta_submenu" id="ruta_submenu" placeholder="Controlador/function">
                    </div>
                    <div class="form-group">
                        <label for="nombre_icono">Icono del menu</label>
                        <input type="text" class="form-control" name="nombre_icono" id="nombre_icono" placeholder="Icono">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger shadow" data-dismiss="modal">Cerrar</button>
                        <button type="button" id="btnAddNewSubmenu" class="btn btn-success shadow">Guardar</button>
                    </div>
                </form>

            </div>

        </div>
    </div>
</div>

<!-- Modal editar -->

<div class="modal fade" id="modalEditarMenu" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title label col-lg-12 text-center font-bold" id="modalEditarMenuTitle">Editar Submenu: </h5>
            </div>
            <div class="modal-body table-responsive">
                <form id="formEditMenu">
                    <table class="table table-hover table-bordered " id="tabla_submenu">
                        <thead class="bg-dark">
                            <tr>
                                <th class="d-none" style=" text-shadow: 2px 2px 4px #000000;" scope="col">Id del Menu</th>
                                <th style=" text-shadow: 2px 2px 4px #000000;" scope="col">Nombre del Menu</th>
                                <th style=" text-shadow: 2px 2px 4px #000000;" scope="col">Ruta</th>
                                <th style=" text-shadow: 2px 2px 4px #000000;" scope="col">Nombre del icono</th>
                                <th style=" text-shadow: 2px 2px 4px #000000;" class="text-center" scope="col">icono</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="d-none">
                                    <input class="form-control" type="hidden" name="idSubMenuEditar" id="idSubMenuEditar">
                                </td>
                                <td>
                                    <input cajaTexto="Nombre" class="form-control" type="text" name="nameSubMenuEditar" id="nameSubMenuEditar">
                                </td>
                                <td>
                                    <input cajaTexto="Ruta" class="form-control" type="text" name="rutaSubMenuEditar" id="rutaSubMenuEditar">
                                </td>
                                <td>
                                    <input cajaTexto="Icono" class="form-control" type="text" name="nameIconoEditar" id="nameIconoEditar">
                                </td>
                                <td class="text-center">
                                    <button type="button" class="btn bg-blue btn-lg"><i id="iconoEditar" class=""></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger shadow" data-dismiss="modal">Cerrar</button>
                <button type="button" id="btnEditarSubMenu" class="btn btn-success shadow">Editar</button>
            </div>

        </div>
    </div>
</div>



<script type="text/javascript">
    const base_url = "<?php echo base_url() ?>";
</script>
<script type="text/javascript" src="<?php echo base_url() ?>js/menus/funciones_submenu.js"></script>
<?php $this->load->view('footer');
