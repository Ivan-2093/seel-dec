<?php 
class AgendaController extends CI_Controller
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
        $this->load->model('AgendaModel');
        $this->load->model('ProspectosModel');
        $this->load->model('TercerosModel');
        $this->load->model('ClientesModel');
        $this->load->model('PaisesModel');
        $this->load->model('CotizacionModel');
        $this->load->helper('menu_helper');
        $this->load->library('phpmailer_lib');

        $data_where_menus = array(
            'pm.perfil_id' => $this->perfil,
        );

        $data_menus = $this->MenusModel->getMenusByPerfil($data_where_menus);
        $this->html_menus = createMenuByPerfil($data_menus);
    }
    /* ******************************************************** AGENDAMIENTO ************************************************************** */
    function get_tecnicos()
    {
        $response = array(
            "status" => false,
            "message" => 'Error al ejecutar la consulta',
            "data" => null
        );
        try {
            $data = $this->AgendaModel->get_tecnicos();
            if ($data["status"]) {
                $response["status"] = true;
                $response["data"] = $data["data"];
                $response["message"] = "Consulta ejecutada exitosamente";
            } else {
                throw new Exception("Error Processing Request");
            }
        } catch (Exception $th) {
            $response["message"] = $th->getMessage();
        }
        echo json_encode($response);
    }

    function get_info_cita()
    {
        $response = array(
            "status" => false,
            "message" => 'Error al ejecutar la consulta',
            "data" => null
        );
        try {
            $datos= file_get_contents('php://input');
            $datos = json_decode($datos);
            if(!isset($_POST["id_cita"]) || empty($_POST["id_cita"])){
                throw new Exception("No hay datos el la peticion");
            }
            $data = $this->AgendaModel->get_citas($_POST["id_cita"]);
            if ($data["status"]) {
                $response["status"] = true;
                $response["data"] = $data["data"];
                $response["message"] = "Consulta ejecutada exitosamente";
            } else {
                throw new Exception("Error Processing Request");
            }
        } catch (Exception $th) {
            $response["message"] = $th->getMessage();
        }
        echo json_encode($response);
    }

    function get_citas()
    {
        $response = array(
            "status" => false,
            "message" => 'Error al ejecutar la consulta',
            "data" => null
        );
        try {
            $data = $this->AgendaModel->get_citas();
            $arr_calendar[] = array();
            if ($data["status"]) {
                foreach ($data["data"] as $key) {
                    $color = "";
                    switch ($key->estado) {
                        case '1':
                            $color = "#7FA8FF";
                            break;
                        case '2':
                            $color = "##FF7F7F";
                            break;
                        case '3':
                            $color = "##7FEFFF";
                            break;
                        case '4':
                            $color = "#00CB47";
                            break;

                        default:
                            $color = "#CB00B9";
                            break;
                    }
                    $arr_calendar[] = array(
                        'id_cita' => $key->id_cita,
                        'title' => $key->primer_nombre_cliente.' '.$key->primer_apellido_cliente,
                        'start' => $key->fecha_cita,
                        'end' => $key->fecha_cita,
                        'descripcion' => $key->detalles_cita,
                        'color' => $color
                    );
                }
                $response["status"] = true;
                $response["data"] = $arr_calendar;
                $response["message"] = "Consulta ejecutada exitosamente";
            } else {
                throw new Exception("Error Processing Request");
            }
        } catch (Exception $th) {
            $response["message"] = $th->getMessage();
        }
        echo json_encode($response);
    }

    public function agenda_citas()
    {
        if (empty($_GET['id_neg']) || !isset($_GET['id_neg'])) {
            header("Location: " . base_url() . "NegociosController/");
            exit();
        }
        $data_vista = array(
            'data_menus' => $this->html_menus,
            'name_page' => 'Agenda citas',
            'id_neg' => $_GET['id_neg'],
            'user_id' => $this->user_id
        );

        $this->load->view('header', $data_vista);
        /* $this->load->view('dashboard'); */
        $this->load->view('agenda/agenda');
    }

    /*
    ESTADOS CITA:
    AGENDADA - 1
    CANCELADA - 2
    REPROGRAMADA - 3
    CUMPLIDA - 4
    */

    function crear_cita()
    {
        $response = array(
            "status" => false,
            "message" => 'Error al insertar el registro',
        );
        try {
            if (!isset($_POST) || empty($_POST)) {
                throw new Exception("No se han enviado datos en la peticion");
            }
            if ($this->AgendaModel->insert_cita($_POST)) {
                $response["status"] = true;
                $response["message"] = "Cita creada exitosamente";
                
                $data_array_negocio_historial_etapas = array(
                    'negocio_id' => $this->input->post('negocio_id'),
                    'etapa_id' => 4,//Agendamiento de Cita! X:D
                    'user_id' => $this->user_id,
                    'fecha' => Date('Y-m-d') . 'T' . Date('H:i:s')
                );
    
                $this->NegociosModel->insertHistorialEtapa($data_array_negocio_historial_etapas);

            } else {
                throw new Exception("Error al hacer el insert en la base de datos");
            }
        } catch (Exception $th) {
            $response["message"] = $th->getMessage();
        }
        echo json_encode($response);
    }

}