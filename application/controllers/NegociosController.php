<?php
class NegociosController extends CI_Controller
{


    public $html_menus = NULL;
    public $perfil = NULL;
    public $user_id = NULL;

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('login')) {
            $this->session->sess_destroy();
            header("Location: " . base_url());
        }
        $this->load->helper('permisos_url_helper');
        $this->perfil = $this->session->userdata('perfil');
        $this->user_id = $this->session->userdata('id_user');
        validate_url_permiso_perfil($this->perfil);
        $this->load->model('MenusModel');
        $this->load->library('session');
        $this->load->model('NegociosModel');
        $this->load->model('ProspectosModel');
        $this->load->model('TercerosModel');
        $this->load->model('PaisesModel');
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

        $data_tipo_doc = $this->TercerosModel->getTipoDocumentos()->result();
        $data_paises = $this->PaisesModel->getPaises()->result();
        $data_generos = $this->TercerosModel->getGeneros()->result();

        $data_vista = array(
            'data_menus' => $this->html_menus,
            'name_page' => 'NEGOCIO',
            'data_tipo_doc' => $data_tipo_doc,
            'data_paises' => $data_paises,
            'data_generos' => $data_generos,
        );

        $id_solicitud = $this->input->POST('id_solicitud');


        if (!isset($id_solicitud) && $id_solicitud == "") {
            header("Location: " . base_url() . "SolicitudController/gestionSolicitud");
            exit();
        }
        //Consultamos id_solicitud que existe en la base de datos
        $where_solicitud = array('id_solicitud' => $id_solicitud);
        $data_solicitud = $this->ProspectosModel->getSolicitudes($where_solicitud);
        //Consultamos si el id_solicitud ya existe como negocio que existe en la base de datos
        if ($data_solicitud->num_rows() > 0) {
            if ($data_solicitud->row(0)->id_negocio != "" && $data_solicitud->row(0)->id_negocio != NULL) {
                $data_negocio = array(
                    'id_negocio' => $data_solicitud->row(0)->id_negocio,
                    'cliente' => $data_solicitud->row(0)->cliente_id != NULL ? $data_solicitud->row(0)->cliente_id : $data_solicitud->row(0)->prospecto,
                    'fecha_registro' => $data_solicitud->row(0)->fecha_registro
                );
            } else {
                $data_insert = array(
                    'solicitud_id' => $id_solicitud,
                    'fecha_registro' => Date('Y-m-d') . 'T' . Date('H:i:s'),
                    'user_crea' => $this->user_id,
                    'estado' => 0
                );

                $id_negocio = $this->NegociosModel->create_negocios($data_insert);

                $data_negocio = array(
                    'id_negocio' => $id_negocio,
                    'cliente' => $data_solicitud->row()->prospecto,
                    'fecha_registro' => Date('Y-m-d') . 'T' . Date('H:i:s')
                );
            }
        } else {
            header("Location: " . base_url() . "SolicitudController/gestionSolicitud");
            exit();
        }

        $data_vista['data_negocio'] = $data_negocio;

        $this->load->view('header', $data_vista);
        $this->load->view('negocios/flujo_trabajo');
    }

    public function load_flujo_trabajo()
    {

        $id_negocio = $this->input->post('id_negocio');
        $data_where = array('negocio_id' => $id_negocio);
        $data_etapas_negocio = $this->NegociosModel->get_etapas_negocio();
        $html_flujo = "";
        if ($data_etapas_negocio->num_rows() > 0) {
            foreach ($data_etapas_negocio->result() as $row) {
                $check_etapa='<i class="font-weight-bold ik ik-alert-octagon"></i>';
                $opcion = 0;
                if($this->NegociosModel->checkEtapa($data_where)->num_rows() > 0 ){
                    $check_etapa = '<i class="font-weight-bold ik ik-check"></i>';
                    $opcion = 1;
                }

                $html_flujo .=
                    '<span>
                    <button class="btn btn-link text-primary font-weight-bold" modal="' . preg_replace('/[\s]/', "_", $row->etapa) . '" onclick="obtenerData('.$row->id_etapa.','.$opcion.');">
                        ' . $row->id_etapa . ' ' . $row->etapa . ' ' . $check_etapa . '
                    </button>
                    </span>
                    <br>';
            }
        }


        $html_flujo .= '<div style="border-bottom: 2px dashed #999999; margin: 20px 0;"></div> ';
        echo json_encode(array('html_flujo' => $html_flujo));
    }
}
