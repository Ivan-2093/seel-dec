<?php
class UsuariosController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('UsuariosModel');
    }

    public function index()
    {
        $this->load->view('header');
        $this->load->view('usuarios/index');
    }

    public function create()
    {
        $this->load->view('header');
        $this->load->view('usuarios/create');
    }
}
