<?php
class HomeController extends CI_Controller
{

    public function __construct() //define el constructor
    {
        parent::__construct(); //invoca al constructor de la clase superior
        /* $this->load->library('session'); */
        $this->load->model('UsuarioModel');//carga un modelo con el nombre de Usuarios“  
    }

    public function index()
    {

        $this->load->view('header');
        $this->load->view('dashboard');
        
    }
}
