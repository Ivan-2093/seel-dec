<?php
class HomeController extends CI_Controller
{

    public function __construct() //define el constructor
    {
        parent::__construct(); //invoca al constructor de la clase superior
        /*  */$this->load->library('session');
        $this->load->model('UsuariosModel'); //carga un modelo con el nombre de Usuarios“  
    }

    public function index()
    {
        if (!$this->session->userdata('login')) {
            $this->session->sess_destroy();
            header("Location: " . base_url());
        } else {
            $this->load->view('header');
            $this->load->view('dashboard');
        }
    }
}
