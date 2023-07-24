<?php

class PermisosController extends CI_Controller
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

}
