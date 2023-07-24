<?php

class PermisosController extends CI_Controller
{

    public function index()
    {
        $this->load->model('PermisosModel');
        print_r($this->PermisosModel->consulta());
    }

    public function alter()
    {
        $this->load->model('PermisosModel');
        print_r($this->PermisosModel->altertable());
    }

    public function eliminar()
    {
        $this->load->model('PermisosModel');
        print_r($this->PermisosModel->dropcolunm());
    }
    public function backup()
    {
        // Load the DB utility class
        $this->load->dbutil();

        // Backup your entire database and assign it to a variable
        $backup = $this->dbutil->backup();

        // Load the file helper and write the file to your server
        $this->load->helper('file');
        write_file('/path/to/mybackup.gz', $backup);

        // Load the download helper and send the file to your desktop
        $this->load->helper('download');
        force_download('mybackup.gz', $backup);
    }
    public function perfiles()
    {
        $this->load->model('PermisosModel');
        print_r($this->PermisosModel->perfiles_menus());
    }
}
