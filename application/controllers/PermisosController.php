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

        $this->perfil = $this->session->userdata('perfil');
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

        $array_menus = $this->MenusModel->getMenus();
        foreach ($array_menus->result() as $key) {
            $data_where = array(
                'menu_id' => $key->id_menu,
                'perfil_id' => $this->perfil
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
							<input class="toggle-one" id="' . $key->menu . '" ' . $checked . ' type="checkbox" data-width="30" data-height="20"
							data-onstyle="success" onchange="check_menu(\'' . $key->menu . '\',' . $key->id_menu . ',' . $this->perfil . ');"  data-toggle="toggle" data-size="xs">							
						</div>
					</div>
		
				</div>
				<div class="card-body">';
            $data_where_sub = array(
                'menu_id' => $key->id_menu,
            );
            $submenus = $this->MenusModel->getSubmenusWhere($data_where_sub);
            foreach ($submenus->result() as $sm) {

                $data_submenu_perfil = array(
                    'perfil_id' => $this->perfil,
                    'submenu_id' => $sm->id_submenu,
                );

                $val_submenu = $this->MenusModel->getMenuPerfilByIdSubmenu($data_submenu_perfil);
                $checked2 = "";
                if ($val_submenu->num_rows() > 0) {
                    $checked2 = "checked";
                }


                $html_permisos_perfil .= '
							<input class="toggle-one" id="' . $sm->submenu . '" ' . $checked2 . ' type="checkbox" data-width="20" data-height="20"
							data-toggle="toggle" onchange="check_submenu(\'' . $sm->submenu . '\',' . $sm->id_submenu . ',' . $this->perfil . ');" data-size="xs">
							<label>' . $sm->submenu . '</label>';
            }
            $html_permisos_perfil .= '
				</div>
			</div>
		    </section>
			';
        }
        $data_response = array(
            'html_permisos_perfil' => $html_permisos_perfil
        );
        echo json_encode($data_response);

    }
}
