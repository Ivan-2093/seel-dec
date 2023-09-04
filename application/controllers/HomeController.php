<?php
class HomeController extends CI_Controller
{

    
    public $html_menus = NULL;
    public $perfil = NULL;

    public function __construct()
    {

        parent::__construct();

        if (!$this->session->userdata('login')) {
            $this->session->sess_destroy();
            header("Location: " . base_url());
        }

        /* validar si el perfil tiene acceso al modulo o menu a ingresar! */

        $this->load->library('session');
        $this->load->model('UsuariosModel');
        $this->load->model('MenusModel');
        $this->load->helper('menu_helper');
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
            $data_vista = array(
                'data_menus' => $this->html_menus,
                'name_page' => 'HOME'
            );

            $this->load->view('header', $data_vista);
            /* $this->load->view('dashboard'); */
            $this->load->view('pages/ui/icons');
    }
}
