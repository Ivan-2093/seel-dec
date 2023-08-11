<?php

class PermisosController extends CI_Controller
{


    public $html_menus = NULL;
    public $perfil = NULL;
    public $data_menus = NULL;

    public function __construct()
    {

        parent::__construct();

        if (!$this->session->userdata('login')) {
            $this->session->sess_destroy();
            header("Location: " . base_url());
        }

        $this->load->library('session');
        $this->load->model('UsuariosModel');
        $this->load->model('MenusModel');
        $this->load->model('PermisosModel');
        $this->load->helper('menu_helper');
        $this->load->helper('drawHtml_helper');
        $this->load->library('phpmailer_lib');
        $this->load->helper('permisos_url_helper');
        $this->perfil = $this->session->userdata('perfil');
        validate_url_permiso_perfil($this->perfil);
        $data_where_menus = array(
            'pm.perfil_id' => $this->perfil,
        );

        $data_menus = $this->MenusModel->getMenusByPerfil($data_where_menus);
        $this->html_menus = createMenuByPerfil($data_menus);
    }


    public function index()
    {
        $data_perfiles = drawOptionsSelectHtml($this->PermisosModel->getPerfiles());
        $data_vista = array(
            'data_menus' => $this->html_menus,
            'data_perfiles' => $data_perfiles,
            'name_page' => 'PERMISOS'
        );

        $this->load->view('header', $data_vista);
        /* $this->load->view('dashboard'); */
        $this->load->view('permisos/index');
    }

    public function get_permisos_perfil()
    {

        $html_permisos_perfil = '';
        $perfil_id = $this->input->post('perfil_id');
        $array_menus = $this->MenusModel->getMenus();
        if ($array_menus->num_rows() > 0) {
            foreach ($array_menus->result() as $key) {
                $data_where = array(
                    'menu_id' => $key->id_menu,
                    'perfil_id' => $perfil_id
                );

                $val_menu = $this->MenusModel->getMenuPerfilByIdMenu($data_where);
                $checked = "";
                if ($val_menu->num_rows() > 0) {
                    $checked = "checked";
                }
                $html_permisos_perfil .= '
                <section class="">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-auto">
                                <strong class="card-title">' . $key->menu . '</strong>
                            </div>
                            <div class="col-auto">
                                <input class="toggle-one" data-toggle="toggle" data-size="xs" data-on="" data-off="<i class=\'fa fa-play\'></i>" data-onstyle="success" data-offstyle="danger" id="' . $key->menu . '" ' . $checked . ' type="checkbox" onchange="check_menu(\'' . $key->menu . '\',' . $key->id_menu . ',' . $perfil_id . ',this);" >							
                            </div>
                        </div>
            
                    </div>
                    <div class="card-body">
                    <div class="row">';
                $data_where_sub = array(
                    'menu_id' => $key->id_menu,
                );
                $submenus = $this->MenusModel->getSubmenusWhere($data_where_sub);
                if ($submenus->num_rows() > 0) {
                    foreach ($submenus->result() as $sm) {

                        $data_submenu_perfil = array(
                            'perfil_id' => $perfil_id,
                            'submenu_id' => $sm->id_submenu,
                        );

                        $val_submenu = $this->MenusModel->getMenuPerfilByIdSubmenu($data_submenu_perfil);
                        $checked2 = "";
                        if ($val_submenu->num_rows() > 0) {
                            $checked2 = "checked";
                        }

                        $html_permisos_perfil .= '<div class="col-lg-2 col-md-3 col-sm-6 col-12">
                                <label>' . $sm->submenu . '</label>
                                <input class="toggle-one" id="' . $sm->submenu . '" ' . $checked2 . ' type="checkbox" data-onstyle="success" data-offstyle="danger"
                                data-toggle="toggle" onchange="check_submenu(\'' . $sm->submenu . '\',' . $sm->id_submenu . ',' . $perfil_id . ',this);" data-size="xs">
                                </div>';
                    }
                }
                $html_permisos_perfil .= '
                </div>    
                </div>
                </div>
                </section>
                ';
            }
            $data_response = array(
                'html_permisos_perfil' => $html_permisos_perfil
            );
        }


        echo json_encode($data_response);
    }

    public function update_permisos_menu_perfil ()
    {
        $menu_id = intval($this->input->POST('menu_id'));
        $perfil_id = intval($this->input->POST('perfil_id'));
        $options = intval($this->input->POST('options'));

        $array_where = array(
            'perfil_id' => $perfil_id,
            'menu_id' => $menu_id
        );

        switch (true) {
            case ($menu_id == "" || $perfil_id == ""):
                $response = 'error';
                $mensaje = 'Ha ocurrido un error al enviar la identificación del menu y el perfil de usuario';
                break;
            case ($options === 1):
                $this->PermisosModel->insertPermisoMenu($array_where);
                $response = 'success';
                $mensaje = 'Se ha asignado el permiso al menu';
                break;
            case ($options === 0):
                $this->PermisosModel->deletePermisoMenu($array_where);
                $response = 'success';
                $mensaje = 'Se ha denegado el permiso al menu';
                break;
        }

        $data_response = array(
            'response' => $response,
            'mensaje' => $mensaje,
        );

        echo json_encode($data_response);


    }

    public function update_permisos_submenu_perfil ()
    {
        $submenu_id = intval($this->input->POST('submenu_id'));
        $perfil_id = intval($this->input->POST('perfil_id'));
        $options = intval($this->input->POST('options'));

        $array_where = array(
            'perfil_id' => $perfil_id,
            'submenu_id' => $submenu_id
        );

        switch (true) {
            case ($submenu_id == "" || $perfil_id == ""):
                $response = 'error';
                $mensaje = 'Ha ocurrido un error al enviar la identificación del submenu y el perfil de usuario';
                break;
            case ($options === 1):
                $this->PermisosModel->insertPermisoSubMenu($array_where);
                $response = 'success';
                $mensaje = 'Se ha asignado el permiso al submenu';
                break;
            case ($options === 0):
                $this->PermisosModel->deletePermisoSubMenu($array_where);
                $response = 'success';
                $mensaje = 'Se ha denegado el permiso al submenu';
                break;
        }

        $data_response = array(
            'response' => $response,
            'mensaje' => $mensaje,
        );

        echo json_encode($data_response);


    }

}
