<?php
class InformesController extends CI_Controller
{

    public $html_menus = NULL;
    public $perfil = NULL;
    public $user_id = NULL;

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('login')) {
            $this->session->sess_destroy();
            header("Location: " . base_url());
        }
        $this->load->helper('permisos_url_helper');
        $this->perfil = $this->session->userdata('perfil');
        $this->user_id = $this->session->userdata('id_user');
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

    public function informe_solicitudes()
    {

        $data_vista = array(
            'data_menus' => $this->html_menus,
            'name_page' => 'INFORME SOLICITUDES',
        );
        $this->load->view('header', $data_vista);
        $this->load->view('informes/solicitudes');
    }
    public function informe_negocios()
    {

        $data_vista = array(
            'data_menus' => $this->html_menus,
            'name_page' => 'INFORME NEGOCIOS',
        );
        $this->load->view('header', $data_vista);
        $this->load->view('informes/negocios');
    }
    public function informe_agenda()
    {

        $data_vista = array(
            'data_menus' => $this->html_menus,
            'name_page' => 'INFORME AGENDA',
        );
        $this->load->view('header', $data_vista);
        $this->load->view('informes/agenda');
    }
    public function informe_productos()
    {

        $data_vista = array(
            'data_menus' => $this->html_menus,
            'name_page' => 'INFORME PRODUCTOS',
        );
        $this->load->view('header', $data_vista);
        $this->load->view('informes/productos');
    }
}
