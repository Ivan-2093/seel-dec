<?php
class CotizacionController extends CI_Controller
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
        $this->load->model('ProspectosModel');
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
            'name_page' => 'COTIZADOR'
        );

        $id_solicitud = $this->input->post('id_solicitud');

        if ($id_solicitud != "") {
            $where = array('id_solicitud' => $id_solicitud);
            $data_solicitudes = $this->ProspectosModel->getSolicitudes($where);
            $data_vista['data_solicitudes'] = $data_solicitudes->row(0);
        }

        $this->load->view('header', $data_vista);
        $this->load->view('cotizador/solicitud');
    }

    public function load_productos()
    {
        $data_productos = $this->ProductosModel->getProductos();
        $tbody = '';
        if ($data_productos->num_rows() > 0) {
            foreach ($data_productos->result() as $key) {
                $tbody .= '<tr>
                <td class="text-center">' . $key->id_producto . '</td>
                <td>' . $key->referencia . '</td>
                <td class="text-right">$' . number_format(($key->costo_elite * ($key->porce_precio / 100)), 0, '.', ',') . '</td>
                <td class="text-right">$' . number_format(($key->costo_premium * ($key->porce_precio / 100)), 0, '.', ',') . '</td>
                <td>' . $key->tipo . '</td>
                <td class="text-center">' . $key->categoria . '</td>
                <td class="text-center"><button type="button" class="btn btn-warning ik ik-edit" onclick="editar_producto(' . $key->id_producto . ');"></button></td>
                </tr>';
            }
        }
        $array_response = array(
            'tbody' => $tbody
        );
        echo json_encode($array_response);
    }
}