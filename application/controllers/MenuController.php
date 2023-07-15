<?php
class MenuController extends CI_Controller
{

    public function __construct() //define el constructor
    {
        parent::__construct(); //invoca al constructor de la clase superior
    }

    public function index()
    {

        $this->load->view('header');
        $this->load->view('menu/menu');
    }
}
