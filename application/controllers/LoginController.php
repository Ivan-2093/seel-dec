<?php
class LoginController extends CI_Controller
{

    public function __construct() //define el constructor
    {
        parent::__construct(); //invoca al constructor de la clase superior
        $this->load->library('session');
        $this->load->model('UsuarioModel');//carga un modelo con el nombre de Usuarios“  
    }
    public function index()
    {
        $data = array(
            'user' => 'sigalvis',
            'perfil' => 'programador',
            'id_user' => '1',
            'nit_user' => '1097304901',
            'login' => true
        );
        //enviamos los datos de session al navegador
        $this->session->set_userdata($data);

        print_r($this->session->userdata());
        $this->load->view('login/login');
    }
}
