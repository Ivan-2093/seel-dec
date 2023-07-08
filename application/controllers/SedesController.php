<?php
class SedesController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('SedesModel');
    }

    public function index()
    {
        if (!$this->session->userdata('login')) {
            $this->session->sess_destroy();
            header("Location: " . base_url());
        } else {
            $this->load->view('header');
            $this->load->view('footer');
        }
    }
}
