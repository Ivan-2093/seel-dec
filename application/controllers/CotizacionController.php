<?php
class CotizacionController extends CI_Controller
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
        $this->load->helper('permisos_url_helper');
        $this->perfil = $this->session->userdata('perfil');
        validate_url_permiso_perfil($this->perfil);
        $this->load->model('MenusModel');
        $this->load->library('session');
        $this->load->model('UsuariosModel');
        $this->load->model('ProspectosModel');
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

        $id_solicitud = $this->input->post('id_solicitud');
        if ($id_solicitud == "") {

        } else {
            header('Refresh:5; url=' . base_url() . "CotizacionController/load_cotizador/" . $id_solicitud);
            die;
        }
    }

    public function load_cotizador($id_solicitud = "")
    {
        $data_vista = array(
            'data_menus' => $this->html_menus,
            'name_page' => 'HOME'
        );

        $this->load->view('header', $data_vista);
        $this->load->view('dashboard');
    }
}
