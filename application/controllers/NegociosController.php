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
            'name_page' => 'NEGOCIO'
        );

        $id_solicitud = $this->input->POST('id_solicitud');

        switch (true) {
            case isset($id_solicitud):
                $where_solicitud = array('id_solicitud' => $id_solicitud);
                $data_solicitud = $this->ProspectosModel->getSolcitudByWhere($where_solicitud)->row(0);   
            case (isset($data_solicitud)):
                $where_negocio = array('solicitud_id' => $id_solicitud);
                $info_negocio = $this->NegociosModel->getNegocio($where_negocio);
                
            case (isset($info_negocio)):
                if($info_negocio->num_rows > 0){
                    $data_negocio = array(
                        'id_negocio' => $info_negocio->row(0)->id_negocio,
                        'cliente' => $info_negocio->row(0)->cliente_id != "" ? $info_negocio->row(0)->cliente_id : $data_solicitud->prospecto,
                        'fecha_registro' => $info_negocio->row(0)->fecha_registro
                    );
                    break;     
                }
                else{

                }
                           
            case !isset($info_negocio):

                $data_insert = array(
                    'solicitud_id' => $id_solicitud,
                    'fecha_registro' => Date('Y-m-d') . 'T' . Date('H:i:s'),
                    'user_crea' => $this->user_id,
                    'estado' => 0
                );

                $id_negocio = $this->NegociosModel->create_negocios($data_insert);

            case isset($id_negocio):
                $data_negocio = array(
                    'id_negocio' => $id_negocio,
                    'cliente' => $data_solicitud->prospecto,
                    'fecha_registro' => Date('Y-m-d') . 'T' . Date('H:i:s')
                );
                break;
            default:
                header("Location: " . base_url() . "SolicitudController/gestionSolicitud");
                exit();
                break;
        }

       

        $data_vista['data_negocio'] = $data_negocio;

        $this->load->view('header', $data_vista);
        $this->load->view('negocios/flujo_trabajo');
    }

    public function load_flujo_trabajo()
    {

        $data_etapas_negocio = $this->NegociosModel->get_etapas_negocio();
        $html_flujo = "";
        if ($data_etapas_negocio->num_rows() > 0) {
            foreach ($data_etapas_negocio->result() as $row) {
                $html_flujo .=
                    '<span>
                    <a class="btn btn-link text-primary font-weight-bold" href="#' . preg_replace('/[\s]/', "_", $row->etapa) . '" data-toggle="modal" onclick="obtenerData(' . $row->id_etapa . ');">
                        ' . $row->id_etapa . ' ' . $row->etapa . '
                    </a>
                </span>
                <br>';
            }
        }


        $html_flujo .= '<div style="border-bottom: 2px dashed #999999; margin: 20px 0;"></div> ';


        echo json_encode(array('html_flujo' => $html_flujo));
    }
}
