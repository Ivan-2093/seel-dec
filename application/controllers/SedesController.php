<?php
class SedesController extends CI_Controller {
    public function __construct() {      
        parent::__construct();
        $this->load->model('SedesModel');   
    }

    public function index() {
        $this->load->view('header');
        $this->load->view('footer');
    }

}