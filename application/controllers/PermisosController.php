<?php

class PermisosController extends CI_Controller
{

    public function __construct() //define el constructor
    {
        parent::__construct(); //invoca al constructor de la clase superior
        $this->load->library('session');
        $this->load->model('UsuariosModel');
        $this->load->model('MenusModel');
        $this->load->model('PermisosModel');
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
            /* $this->load->view('dashboard'); */
            $this->load->view('permisos/permisos');
        }
    }

    public function loadTablePerfiles()
    {
        if (!$this->session->userdata('login')) {
            $this->session->sess_destroy();
            header("Location: " . base_url());
        } else {
            $perfiles = $this->PermisosModel->get_perfiles();
            $tbody = '';
            if ($perfiles->num_rows() > 0) {
                foreach ($perfiles->result() as $perfil) {
                    $tbody .=
                        "<tr class = 'text-center'> 
                    <td>{$perfil->perfil}</td>
                    <td><button class='btn btn-warning ik ik-eye' onclick = 'verpermisos($perfil->id_perfil)'></button></td>
                    </tr>";
                }
            }
            $array_response = array(
                'tbody' => $tbody
            );
            echo json_encode($array_response);
        }
    }

    public function loadTableMenu()
    {
        $id_perfil = $this->input->post('idperfil');
        $data_where = array(
            'perfil_id' => $id_perfil,
        );
        $datamenus = $this->PermisosModel->getmenus();
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
    public function listar()
    {
        $this->load->model('PermisosModel');
        print_r($this->PermisosModel->perfiles_menus());
    }
}
