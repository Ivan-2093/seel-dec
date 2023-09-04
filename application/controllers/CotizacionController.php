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
        $where1 = array('id_categoria' => 1);
        $where2 = array('id_categoria' => 2);
        $where3 = array('id_categoria' => 3);

        $data_productosC1 = $this->ProductosModel->getProductosByWhere($where1);
        $data_productosC2 = $this->ProductosModel->getProductosByWhere($where2);
        $data_productosC3 = $this->ProductosModel->getProductosByWhere($where3);

        $tbodyC1 = '';
        $tbodyC2 = '';
        $tbodyC3 = '';

       /*  <td>' . $key->medidad . '</td>
        <td>' . $key->anchos_tela_metro . '</td>
        <td>' . $key->factor_apertura . '</td> */

        

        if ($data_productosC1->num_rows() > 0) {
            foreach ($data_productosC1->result() as $key) {

                $costo_elite = $key->costo_elite != "" ? $key->costo_elite * (($key->porce_precio / 100) + 1) : 'N/A';
                $costo_premium = $key->costo_premium != "" ? $key->costo_premium * (($key->porce_precio / 100)+1) : 'N/A';
                $tbodyC1 .= '<tr>
                <td class="text-center">' . $key->id_producto . '</td>
                <td>' . $key->referencia . '</td>
                <td>' . $key->descripcion . '</td>
                <td class="text-right">$' . number_format(($costo_elite), 0, '.', ',') . '</td>
                <td class="text-right">$' . number_format(($costo_premium), 0, '.', ',') . '</td>
                <td>' . $key->tipo . '</td>
                <td class="text-center">
                    <button data=\'["' . $key->id_producto . '","' . $key->referencia . '","' . $costo_elite . '","' . $costo_premium . '"]\' data-toggle="tooltip" data-placement="top" title="AGREGAR" type="button" class="btn btn-primary ik ik-file-plus" onclick="add_producto(this);"></button>
                </td>
                </tr>';
            }
        }

        if ($data_productosC2->num_rows() > 0) {
            foreach ($data_productosC2->result() as $key) {

                $costo_elite = $key->costo_elite != "" ? $key->costo_elite * (($key->porce_precio / 100) + 1) : 'N/A';
                $costo_premium = $key->costo_premium != "" ? $key->costo_premium * (($key->porce_precio / 100)+1) : 'N/A';
                $tbodyC2 .= '<tr>
                <td class="text-center">' . $key->id_producto . '</td>
                <td>' . $key->referencia . '</td>
                <td>' . $key->descripcion . '</td>
                <td>' . $key->pasadores . '</td>
                <td>' . $key->cerradura . '</td>
                <td>' . $key->llaves . '</td>
                <td>' . $key->tipo_seguridad . '</td>
                <td class="text-right">$' . number_format(($costo_elite), 0, '.', ',') . '</td>
                <td class="text-right">$' . number_format(($costo_premium), 0, '.', ',') . '</td>
                <td>' . $key->tipo . '</td>
                <td class="text-center"><button data-toggle="tooltip" data-placement="top" title="AGREGAR" type="button" class="btn btn-primary ik ik-file-plus" onclick="add_producto(this);"></button></td>
                </tr>';
            }
        }

        if ($data_productosC3->num_rows() > 0) {
            foreach ($data_productosC3->result() as $key) {

                $costo_elite = $key->costo_elite != "" ? $key->costo_elite * (($key->porce_precio / 100) + 1) : 'N/A';
                $costo_premium = $key->costo_premium != "" ? $key->costo_premium * (($key->porce_precio / 100)+1) : 'N/A';
                $tbodyC3 .= '<tr>
                <td class="text-center">' . $key->id_producto . '</td>
                <td>' . $key->referencia . '</td>
                <td>' . $key->descripcion . '</td>
                <td>' . $key->pasadores . '</td>
                <td>' . $key->cerradura . '</td>
                <td>' . $key->llaves . '</td>
                <td>' . $key->tipo_seguridad . '</td>
                <td class="text-right">$' . number_format(($costo_elite), 0, '.', ',') . '</td>
                <td class="text-right">$' . number_format(($costo_premium), 0, '.', ',') . '</td>
                <td>' . $key->tipo . '</td>
                <td class="text-center"><button data-toggle="tooltip" data-placement="top" title="AGREGAR" type="button" class="btn btn-primary ik ik-file-plus" onclick="add_producto(this);"></button></td>
                </tr>';
            }
        }



        $array_response = array(
            'tbodyC1' => $tbodyC1,
            'tbodyC2' => $tbodyC2,
            'tbodyC3' => $tbodyC3,
        );
        echo json_encode($array_response);
    }
}