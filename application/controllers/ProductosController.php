<?php
class ProductosController extends CI_Controller
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
        $this->load->model('ProductosModel');
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
            'name_page' => 'PRODUCTOS'
        );
        $this->load->view('header', $data_vista);
        $this->load->view('productos/index');
    }

    public function load_productos()
    {
        $data_productos = $this->ProductosModel->getProductos();
        $tbody = '';
        if ($data_productos->num_rows() > 0) {
            foreach ($data_productos->result() as $key) {
                $tbody .= '<tr>
                <td>' . $key->id_producto . '</td>
                <td>' . $key->referencia . '</td>
                <td>' . $key->descripcion . '</td>
                <td>' . $key->costo_elite . '</td>
                <td>' . $key->costo_premium . '</td>
                <td>' . $key->porce_precio . '%</td>
                <td>' . $key->tipo . '</td>
                <td>' . $key->categoria . '</td>
                <td>' . $key->primer_nombre . ' ' . $key->segundo_nombre . ' ' . $key->primer_apellido . ' ' . $key->segundo_apellido . '</td>
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
        $data_proveedores = $this->ProveedoresModel->getProveedores()->result();
        $data_categoria = $this->ProductosModel->getTipoCategoria()->result();
        $data_medidas = $this->ProductosModel->getTipoMedida()->result();

        $data_vista = array(
            'data_menus' => $this->html_menus,
            'data_proveedores' => $data_proveedores,
            'data_categoria' => $data_categoria,
            'data_medidas' => $data_medidas,
            'name_page' => 'CREAR CLIENTE'
        );
        $this->load->view('header', $data_vista);
        $this->load->view('productos/create');
    }
    public function createCliente()
    {
        $id_tercero = $this->input->POST('inputIdTercero');
        $data_tercero = $this->TercerosModel->getTerceroById($id_tercero);
        $data_cliente = $this->ClientesModel->getClienteById($id_tercero);
        if ($data_tercero->num_rows() > 0) {
            if ($data_cliente->num_rows() > 0) {
                $array_response = array(
                    'response' => 'warning',
                    'title' => 'Advertencia!',
                    'html' => 'El tercero <strong>' . $data_tercero->row(0)->primer_nombre . ' ' . $data_tercero->row(0)->primer_apellido . '</strong> ya se encuentra registrado en la base de datos como cliente.',
                );
            } else {
                $array_insert = array(
                    'id_tercero' => $id_tercero,
                    'fecha_registro' => Date('Y-m-d') . 'T' . Date('H:i:s'),
                    'usuario_registro' => $this->session->userdata('user'),
                );

                if ($this->ClientesModel->insertCliente($array_insert)) {
                    $array_response = array(
                        'response' => 'success',
                        'title' => 'Exito!',
                        'html' => 'Se ha realizado con exito el registro del cliente: <strong>' . $data_tercero->row(0)->primer_nombre . ' ' . $data_tercero->row(0)->primer_apellido . '</strong>',
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

    public function load_tipo_producto_by_categoria()
    {
        $id_categoria = $this->input->post('id_categoria');

        $array_where = array(
            'id_categoria_c' => $id_categoria
        );
        $data_tipo_producto = $this->ProductosModel->getTipoProductoWhere($array_where);
        if ($data_tipo_producto->num_rows() > 0) {
            $array_response = array(
                'html_select' => $this->paint_select_tipo_producto($data_tipo_producto),
            );
        } else {
            $array_response = array(
                'html_select' => '',
            );
        }

        echo json_encode($array_response);
    }

    public function paint_select_tipo_producto($data_tipo_producto)
    {
        $seletc_html = '<option value="">Seleccione un tipo</option>';
        foreach ($data_tipo_producto->result() as $key) {
            $seletc_html .= '<option value="' . $key->id_tipo . '">' . $key->tipo . '</option>';
        }
        return $seletc_html;
    }
}
