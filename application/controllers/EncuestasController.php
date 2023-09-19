<?php
class EncuestasController extends CI_Controller
{
    public $html_menus = NULL;
    public $perfil = NULL;
    public $user_id = NULL;

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('permisos_url_helper');
        validate_url_permiso_perfil($this->perfil);
        $this->load->model('MenusModel');
        $this->load->helper('menu_helper');
        $this->load->library('phpmailer_lib');

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
            'name_page' => 'ENCUESTA',
        );
        $this->load->view('header', $data_vista);

        $this->load->view('encuestas/encuesta_satisfacion');
    }

    public function saveEncuesta()
    {
        print_r($this->input->POST());
    }
}