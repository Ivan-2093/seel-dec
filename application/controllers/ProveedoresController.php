<?php
class ProveedoresController extends CI_Controller
{

    public $html_menus = NULL;
    public $perfil = NULL;

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('login')) {
            $this->session->sess_destroy();
            header("Location: " . base_url());
        }
        $this->load->helper('permisos_url_helper');
        $this->perfil = $this->session->userdata('perfil');
        validate_url_permiso_perfil($this->perfil);
        $this->load->model('MenusModel');
        $this->load->library('session');
        $this->load->model('UsuariosModel');
        $this->load->model('TercerosModel');
        $this->load->model('ProveedoresModel');
        $this->load->helper('menu_helper');
        $this->load->library('phpmailer_lib');

        $data_where_menus = array(
            'pm.perfil_id' => $this->perfil,
        );

        $data_menus = $this->MenusModel->getMenusByPerfil($data_where_menus);
        $this->html_menus = createMenuByPerfil($data_menus);
    }

    public function index()
    {
        $data_vista = array(
            'data_menus' => $this->html_menus,
            'name_page' => 'PROVEEDORES'
        );
        $this->load->view('header', $data_vista);
        $this->load->view('proveedores/index');
    }

    public function load_proveedores()
    {
        $data_proveedores = $this->ProveedoresModel->getProveedores();
        $tbody = '';
        if ($data_proveedores->num_rows() > 0) {
            foreach ($data_proveedores->result() as $key) {
                $tbody .= '<tr>
                <td>' . $key->nit . '</td>
                <td>' . $key->primer_nombre . ' ' . $key->segundo_nombre . ' ' . $key->primer_apellido . ' ' . $key->segundo_apellido . '</td>
                <td>' . $key->email . '</td>
                <td>' . $key->telefono_1 . '</td>
                <td>' . $key->telefono_2 . '</td>
                </tr>';
            }
        }
        $array_response = array(
            'tbody' => $tbody
        );
        echo json_encode($array_response);
    }

    public function create()
    {
        $data_terceros = $this->TercerosModel->getTerceros()->result();

        $data_vista = array(
            'data_menus' => $this->html_menus,
            'data_terceros' => $data_terceros,
            'name_page' => 'CREAR PROVEEDOR'
        );
        $this->load->view('header', $data_vista);
        $this->load->view('proveedores/create');
    }
    public function createProveedor()
    {
        $id_tercero = $this->input->POST('inputIdTercero');
        $data_tercero = $this->TercerosModel->getTerceroById($id_tercero);
        $data_proveedor = $this->ProveedoresModel->getProveedorById($id_tercero);
        if ($data_tercero->num_rows() > 0) {
            if($data_proveedor->num_rows() > 0) {
                $array_response = array(
                    'response' => 'warning',
                    'title' => 'Advertencia!',
                    'html' => 'El tercero <strong>' . $data_tercero->row(0)->primer_nombre . ' ' . $data_tercero->row(0)->primer_apellido . '</strong> ya se encuentra registrado en la base de datos como proveedor.',
                );
            }else{
                $array_insert = array(
                    'id_tercero' => $id_tercero,
                    'fecha_registro' => Date('Y-m-d') . 'T' . Date('H:i:s'),
                    'usuario_registro' => $this->session->userdata('user'),
                );
    
                if ($this->ProveedoresModel->insertProveedor($array_insert)) {
                    $array_response = array(
                        'response' => 'success',
                        'title' => 'Exito!',
                        'html' => 'Se ha realizado con exito el registro del proveedor: <strong>' . $data_tercero->row(0)->primer_nombre . ' ' . $data_tercero->row(0)->primer_apellido . '</strong>',
                    );
                } else {
                    $array_response = array(
                        'response' => 'error',
                        'title' => 'Error!',
                        'html' => 'No se ha realizado el registro del tercero: <strong>' . $data_tercero->row(0)->primer_nombre . ' ' . $data_tercero->row(0)->primer_apellido . '</strong><br> <strong>Intente nuevamente...</strong>',
                    );
                }
            }            
        } else {
            $array_response = array(
                'response' => 'error',
                'title' => 'Error!',
                'html' => 'El tercero seleccionado no existe en la base de datos...',
            );
        }

        echo json_encode($array_response);
    }
}
