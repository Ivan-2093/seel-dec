<?php
class HomeController extends CI_Controller
{

    public function __construct() //define el constructor
    {
        parent::__construct(); //invoca al constructor de la clase superior
        $this->load->library('session');
        $this->load->model('UsuariosModel'); 
        $this->load->model('MenusModel');
        $this->load->helper('menu_helper');
    }

    public function index()
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
                'name_page' => 'HOME'
            );

            $this->load->view('header', $data_vista);
            $this->load->view('dashboard');
            /* $this->load->view('pages/ui/icons'); */
        }
    }
}
