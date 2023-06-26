<?php
class EmpleadosController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('TercerosModel');
    }

    public function index()
    {
        $this->load->view('header');
        $this->load->view('empleados/index');
    }

    public function create()
    {
        $data_terceros = $this->TercerosModel->getTerceros()->result();

        $data = array(
            'data_terceros' => $data_terceros,
        );

        $this->load->view('header');
        $this->load->view('empleados/create',$data);
    }
}
