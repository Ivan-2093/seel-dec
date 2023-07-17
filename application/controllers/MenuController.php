<?php
class MenuController extends CI_Controller
{

    public function __construct() //define el constructor
    {
        parent::__construct(); //invoca al constructor de la clase superior
        $this->load->model('MenusModel');
        $this->load->helper('menu_helper');
    }

    public function index()
    {
<<<<<<< HEAD

        $this->load->view('header');
        $this->load->view('menu/menu');
=======
        if (!$this->session->userdata('login')) {
            $this->session->sess_destroy();
            header("Location: " . base_url());
        } else {
            $perfil = $this->session->userdata('perfil');
            $data_where_menus = array(
                'pm.perfil_id' => $perfil
            );
            $data_menus = $this->MenusModel->getMenusByPerfil($data_where_menus);
            $html_menus = createMenuByPerfil($data_menus);
            $data_vista = array(
                'data_menus' => $html_menus,
                'name_page' => 'MENUS',
            );
            $this->load->view('header', $data_vista);
            $this->load->view('menu/menu');
        }
>>>>>>> e108dbc86d4fa180353853f48693b8df9c7b4b7a
    }

    public function listMenus()
    {
        if (!$this->session->userdata('login')) {
            $this->session->sess_destroy();
            header("Location: " . base_url());
        } else {
            $data_menus = $this->MenusModel->getMenus();
            $tbody = "";
            if ($data_menus->num_rows() > 0) {
                foreach ($data_menus->result() as $row) {
                    $tbody .=
                        '<tr>
                        <td>' . $row->menu . '</td>
                        <td>' . $row->icono . '</td>
                        <td class="text-center">
                            <button type="button" class="btn bg-blue btn-lg"><i class="' . $row->icono . '"></i></button>
                        </td>
                        <td class="text-center">
                            <button  type="button" id_menu="' . $row->id_menu . '" menu="' . $row->menu . '" icono="' . $row->icono . '" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top" title="EDITAR MENU" onclick="editarMenu(this)"><i class="ik ik-edit-2"></i></button>
                        </td>
                        <td class="text-center">
                            <button type="button" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="ELIMINAR MENU" onclick="deleteMenu(' . $row->id_menu . ')"><i class="ik ik-delete"></i></button>
                        </td>
                    </tr>';
                }
            }
            $array_response = array(
                'tbody' => $tbody
            );

            echo json_encode($array_response);
        }
    }

    public function editMenuById()
    {
        if (!$this->session->userdata('login')) {
            $this->session->sess_destroy();
            header("Location: " . base_url());
        } else {

            $idMenuEditar = $this->input->POST('idMenuEditar');
            $nameMenuEditar = $this->input->POST('nameMenuEditar');
            $nameIconoEditar = $this->input->POST('nameIconoEditar');

            if ($idMenuEditar != "" && $nameMenuEditar != "" && $nameIconoEditar != "") {
                $data_where_menu = array(
                    'id_menu' => $idMenuEditar
                );
                $data_edit_menu = array(
                    'menu' => $nameMenuEditar,
                    'icono' => $nameIconoEditar,
                );
                if ($this->MenusModel->updateMenuById($data_edit_menu, $data_where_menu)) {

                    $array_response = array(
                        'response' => 'success',
                        'title' => 'Exito!',
                        'message' => 'Actuaización exitosa!'
                    );
                } else {
                    $array_response = array(
                        'response' => 'error',
                        'title' => 'Error!',
                        'message' => 'Error al actualizar la información.'
                    );
                }
            } else {
                $array_response = array(
                    'response' => 'warning',
                    'title' => 'Advertencia!',
                    'message' => 'Campos vacios!'
                );
            }
            echo json_encode($array_response);
        }
    }

    public function deleteMenuById()
    {
        if (!$this->session->userdata('login')) {
            $this->session->sess_destroy();
            header("Location: " . base_url());
        } else {

            $idMenuEditar = $this->input->POST('idMenuDelete');
            if ($idMenuEditar != "") {
                $data_where_menu = array(
                    'id_menu' => $idMenuEditar
                );
                $data_where_pm = array(
                    'menu_id' => $idMenuEditar
                );

                if ($this->MenusModel->getMenuPerfilByIdMenu($data_where_pm)->num_rows() == 0 && $this->MenusModel->getSubmenusWhere($data_where_pm)->num_rows() == 0) {

                    if ($this->MenusModel->deleteMenuById($data_where_menu)) {

                        $array_response = array(
                            'response' => 'success',
                            'title' => 'Exito!',
                            'message' => 'Menu eliminado exitosamente!'
                        );
                    } else {
                        $array_response = array(
                            'response' => 'error',
                            'title' => 'Error!',
                            'message' => 'Error al eliminar el menu seleccionado!.'
                        );
                    }
                } else {
                    $array_response = array(
                        'response' => 'warning',
                        'title' => 'Advertencia!',
                        'message' => 'No se puede eliminar el menu seleccionado, verifique que no este enlazado con algun submenu o este habilitado para algun perfil de usuario.'
                    );
                }
            } else {
                $array_response = array(
                    'response' => 'warning',
                    'title' => 'Advertencia!',
                    'message' => 'No se encontro identificacion del menu seleccionado'
                );
            }
            echo json_encode($array_response);
        }
    }

    public function createMenu()
    {
        if (!$this->session->userdata('login')) {
            $this->session->sess_destroy();
            header("Location: " . base_url());
        } else {
            $nombreMenu = $this->input->POST('nombreMenu');
            $nombre_icono = $this->input->POST('nombre_icono');

            if ($nombreMenu != '' && $nombre_icono != '') {
                $data_insert = array(
                    'menu' => $nombreMenu,
                    'icono' => $nombre_icono,
                );

                $data_where = array(
                    'menu' => $nombreMenu
                );

                if ($this->MenusModel->getMenuByName($data_where)->num_rows() == 0) {
                    if ($this->MenusModel->insertMenu($data_insert)) {
                        $array_response = array(
                            'response' => 'success',
                            'title' => 'Exito!',
                            'message' => 'Menu creado exitosamente!'
                        );
                    } else {
                        $array_response = array(
                            'response' => 'error',
                            'title' => 'Error!',
                            'message' => 'Error al crear el menu!'
                        );
                    }
                } else {
                    $array_response = array(
                        'response' => 'warning',
                        'title' => 'Advertencia!',
                        'message' => 'Ya se encuentra un menu con el mismo nombre: '.$nombreMenu
                    );
                }
            } else {
                $array_response = array(
                    'response' => 'warning',
                    'title' => 'Advertencia!',
                    'message' => 'Se encontraron campos vacios!'
                );
            }
            echo json_encode($array_response);
        }
    }


    public function submenus()
    {
        if (!$this->session->userdata('login')) {
            $this->session->sess_destroy();
            header("Location: " . base_url());
        } else {
            $perfil = $this->session->userdata('perfil');
            $data_where_menus = array(
                'pm.perfil_id' => $perfil
            );
            $data_menus = $this->MenusModel->getMenusByPerfil($data_where_menus);
            $html_menus = createMenuByPerfil($data_menus);
            $data_vista = array(
                'data_menus' => $html_menus,
                'name_page' => 'SUBMENUS',
            );
            $this->load->view('header', $data_vista);
            $this->load->view('menu/submenu');
        }
    }

    public function listSubmenus()
    {
        if (!$this->session->userdata('login')) {
            $this->session->sess_destroy();
            header("Location: " . base_url());
        } else {
            $data_submenus = $this->MenusModel->getSubmenus();
            $tbody = "";
            if ($data_submenus->num_rows() > 0) {
                foreach ($data_submenus->result() as $row) {
                    $tbody .=
                        '<tr>
                        <td>' . $row->menu . '</td>
                        <td>' . $row->submenu . '</td>
                        <td>' . $row->path . '</td>
                        <td>' . $row->icono_submenu . '</td>
                        <td class="text-center">
                            <button type="button" class="btn bg-blue btn-lg"><i class="' . $row->icono_submenu . '"></i></button>
                        </td>
                        <td class="text-center">
                            <button  type="button" id_menu="' . $row->id_submenu . '" menu="' . $row->submenu . '" icono="' . $row->icono_submenu . '" ruta="'.$row->path.'" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top" title="EDITAR SUBMENU" onclick="editarSubMenu(this)"><i class="ik ik-edit-2"></i></button>
                        </td>
                        <td class="text-center">
                            <button type="button" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="ELIMINAR SUBMENU" onclick="deleteSubMenu(' . $row->id_submenu . ')"><i class="ik ik-delete"></i></button>
                        </td>
                    </tr>';
                }
            }
            $array_response = array(
                'tbody' => $tbody
            );

            echo json_encode($array_response);
        }
    }

    public function editSubMenuById()
    {
        if (!$this->session->userdata('login')) {
            $this->session->sess_destroy();
            header("Location: " . base_url());
        } else {

            $idSubMenuEditar = $this->input->POST('idSubMenuEditar');
            $nameSubMenuEditar = $this->input->POST('nameSubMenuEditar');
            $rutaSubMenuEditar = $this->input->POST('rutaSubMenuEditar');
            $nameIconoEditar = $this->input->POST('nameIconoEditar');

            if ($idSubMenuEditar != "" && $nameSubMenuEditar != "" && $rutaSubMenuEditar != "" && $nameIconoEditar != "") {
                $data_where_menu = array(
                    'id_submenu' => $idSubMenuEditar
                );
                $data_edit_menu = array(
                    'submenu' => $nameSubMenuEditar,
                    'path' => $rutaSubMenuEditar,
                    'icono' => $nameIconoEditar,
                );
                if ($this->MenusModel->updateSubmenuById($data_edit_menu, $data_where_menu)) {

                    $array_response = array(
                        'response' => 'success',
                        'title' => 'Exito!',
                        'message' => 'Actuaización exitosa!'
                    );
                } else {
                    $array_response = array(
                        'response' => 'error',
                        'title' => 'Error!',
                        'message' => 'Error al actualizar la información.'
                    );
                }
            } else {
                $array_response = array(
                    'response' => 'warning',
                    'title' => 'Advertencia!',
                    'message' => 'Campos vacios!'
                );
            }
            echo json_encode($array_response);
        }
    }

    public function deleteSubmenuById()
    {
        if (!$this->session->userdata('login')) {
            $this->session->sess_destroy();
            header("Location: " . base_url());
        } else {

            $idMenuEditar = $this->input->POST('idMenuDelete');
            if ($idMenuEditar != "") {
                $data_where_menu = array(
                    'id_menu' => $idMenuEditar
                );
                $data_where_pm = array(
                    'menu_id' => $idMenuEditar
                );
                if ($this->MenusModel->getMenuPerfilByIdMenu($data_where_pm)->num_rows() == 0) {

                    if ($this->MenusModel->deleteMenuById($data_where_menu)) {

                        $array_response = array(
                            'response' => 'success',
                            'title' => 'Exito!',
                            'message' => 'Menu eliminado exitosamente!'
                        );
                    } else {
                        $array_response = array(
                            'response' => 'error',
                            'title' => 'Error!',
                            'message' => 'Error al eliminar el menu seleccionado!.'
                        );
                    }
                } else {
                    $array_response = array(
                        'response' => 'warning',
                        'title' => 'Advertencia!',
                        'message' => 'No se puede eliminar el menu seleccionado, ya que se encuentra asigando al menos a un perfil.'
                    );
                }
            } else {
                $array_response = array(
                    'response' => 'warning',
                    'title' => 'Advertencia!',
                    'message' => 'No se encontro identificacion del menu seleccionado'
                );
            }
            echo json_encode($array_response);
        }
    }

    public function createSubmenu()
    {
        if (!$this->session->userdata('login')) {
            $this->session->sess_destroy();
            header("Location: " . base_url());
        } else {
            $nombreSubmenu = $this->input->POST('nombreSubmenu');
            $ruta_submenu = $this->input->POST('ruta_submenu');
            $nombre_icono = $this->input->POST('nombre_icono');
            $id_menuSelect = $this->input->POST('id_menuSelect');

            if ($nombreSubmenu != '' && $ruta_submenu != "" && $nombre_icono != '') {
                $data_insert = array(
                    'submenu' => $nombreSubmenu,
                    'path' => $ruta_submenu,
                    'icono' => $nombre_icono,
                    'menu_id' => $id_menuSelect
                );

                $data_where = array(
                    'submenu' => $nombreSubmenu,
                );

                if ($this->MenusModel->getSubmenusWhere($data_where)->num_rows() == 0) {
                    if ($this->MenusModel->insertSubmenu($data_insert)) {
                        $array_response = array(
                            'response' => 'success',
                            'title' => 'Exito!',
                            'message' => 'Submenu creado exitosamente!'
                        );
                    } else {
                        $array_response = array(
                            'response' => 'error',
                            'title' => 'Error!',
                            'message' => 'Error al crear el Submenu!'
                        );
                    }
                } else {
                    $array_response = array(
                        'response' => 'warning',
                        'title' => 'Advertencia!',
                        'message' => 'Ya se encuentra un Submenu con el mismo nombre: '.$nombreSubmenu
                    );
                }
            } else {
                $array_response = array(
                    'response' => 'warning',
                    'title' => 'Advertencia!',
                    'message' => 'Se encontraron campos vacios!'
                );
            }
            echo json_encode($array_response);
        }
    }

    public function htmlSelectMenus()
    {
        $DataMenus = $this->MenusModel->getMenus();
        $OptionSelectMenu = "<option value=''>SELECCIONE UN MENU</option>";
        if($DataMenus->num_rows() > 0)
        {
            foreach($DataMenus->result() as $row)
            {
                $OptionSelectMenu  .= '<option value="' . $row->id_menu . '">' . $row->menu . '</option>';
            }
        }

        $data_response = array(
            'OptionSelectMenu' => $OptionSelectMenu,
        );

        echo json_encode($data_response);

    }

}
