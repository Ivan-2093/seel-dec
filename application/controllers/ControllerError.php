<?php
class ControllerError extends CI_Controller
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
        $this->perfil = $this->session->userdata('perfil');
        $this->load->model('MenusModel');
        $this->load->library('session');
        $this->load->model('UsuariosModel');
        $this->load->helper('menu_helper');
        $this->load->library('phpmailer_lib');

        $data_where_menus = array(
            'pm.perfil_id' => $this->perfil,
        );

        $data_menus = $this->MenusModel->getMenusByPerfil($data_where_menus);
        $this->html_menus = createMenuByPerfil($data_menus);
    }

    public function PermisoModulos()
    {
        $data_vista = array(
            'data_menus' => $this->html_menus,
            'name_page' => 'SOLICITUD CLIENTE'
        );

        $this->load->view('header', $data_vista);
        /* $this->load->view('dashboard'); */
        $this->load->view('errors/permisos_denegados_modulos');
    }
}
