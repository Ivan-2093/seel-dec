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
            $where_cita = array();

            $datos = file_get_contents('php://input');
            $datos = json_decode($datos);
            if (!isset($_POST["id_cita"]) || empty($_POST["id_cita"])) {
                throw new Exception("No hay datos el la peticion");
            }
            $data = $this->AgendaModel->get_citas($_POST["id_cita"], $where_cita);
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
            $where_cita = array();
            $data = $this->AgendaModel->get_citas($cita = "", $where_cita);
            $arr_calendar[] = array();
            if ($data["status"]) {
                foreach ($data["data"] as $key) {
                    $color = "";
                    switch ($key->estado) {
                        case '1':
                            $color = "#3498DB";
                            break;
                        case '2':
                            $color = "#F4D03F";
                            break;
                        case '3':
                            $color = "#283747";
                            break;
                        case '4':
                            $color = "#9B59B6";
                            break;
                        case '5':
                            $color = "#00CB47";
                            break;
                        default:
                            $color = "#CB00B9";
                            break;
                    }
                    $arr_calendar[] = array(
                        'id_cita' => $key->id_cita,
                        'title' => $key->primer_nombre_cliente . ' ' . $key->primer_apellido_cliente,
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
            header("Location: " . base_url() . "NegociosController/all");
            exit();
        }
        $data_vista = array(
            'data_menus' => $this->html_menus,
            'name_page' => 'Agenda citas',
            'id_neg' => $_GET['id_neg'],
            'user_id' => $this->user_id
        );

        $this->load->view('header', $data_vista);
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
                    'etapa_id' => 4, //Agendamiento de Cita! X:D
                    'user_id' => $this->user_id,
                    'fecha' => Date('Y-m-d') . 'T' . Date('H:i:s')
                );

                $this->SendEmailNotificacionAgenda($this->input->post('negocio_id'));

                $this->NegociosModel->insertHistorialEtapa($data_array_negocio_historial_etapas);
            } else {
                throw new Exception("Error al hacer el insert en la base de datos");
            }
        } catch (Exception $th) {
            $response["message"] = $th->getMessage();
        }
        echo json_encode($response);
    }


    public function SendEmailNotificacionAgenda($id_negocio)
    {
        if (isset($id_negocio) && $id_negocio != "") {
            $array_where_negocio = array('n.id_negocio' => $id_negocio);

            /* $data_negocio = $this->NegociosModel->getNegociosAll($array_where_negocio); */
            $data_cita = $this->AgendaModel->get_citas($id_cita = "", $array_where_negocio);
            if (count($data_cita) > 0) {

                /* print_r($data_cita['data'][0]);die; */


                $correo = $this->phpmailer_lib->load();
                $correo->IsSMTP();
                $correo->SMTPAuth = true;
                $correo->SMTPSecure = 'tls';
                $correo->Host = "mail.aftersalesassistance.com";
                $correo->Port = 587;
                $correo->IsHTML(true);
                $correo->SMTPOptions = array(
                    'ssl' => array(
                        'verify_peer' => false,
                        'verify_peer_name' => false,
                        'allow_self_signed' => true
                    )
                );
                $correo->Username = "no-reply@aftersalesassistance.com";
                $correo->Password = 'N}mT=JzE,D$g';
                // CONFIGURAR CORREO PARA ENVIAR MENSAJES DE NO RESPUESTA! :XD
                $correo->SetFrom($data_cita['data'][0]->email_asesor, "SEELDEC");//Correo asesor
                $correo->addAddress($data_cita['data'][0]->email_cliente);
                $correo->addAddress($data_cita['data'][0]->email_asesor); //Correo Asesor
                $correo->addBCC($data_cita['data'][0]->email_tecnico);//Correo tecnico
                
                $correo->Subject = "Agendamiento de Servicio Instalación";
                $correo->CharSet = 'UTF-8';

                $data_usuario = array(
                    'page' => 'Agendamiento',
                    'nombre_cliente' => $data_cita['data'][0]->primer_nombre_cliente . " " . $data_cita['data'][0]->primer_apellido_cliente,
                    'fecha_cita' => $data_cita['data'][0]->fecha_cita,
                    'nombre_tecnico' => $data_cita['data'][0]->primer_nombre_tecnico . " " . $data_cita['data'][0]->primer_apellido_tecnico,
                    'nit_tecnico' => $data_cita['data'][0]->nit_tecnico
                );

                $mensaje = $this->load->view('mails/cita_instalacion', $data_usuario, true);


                $correo->MsgHTML($mensaje);


                if ($correo->Send()) {

                    $array_insert_correo = array(
                        'cita_id' => $data_cita['data'][0]->id_cita,
                        'usuario_id' => $this->session->userdata('id_user'),
                        'fecha_envio' => Date('Y-m-d') . 'T' . Date('H:i:s')
                    );

                    $this->AgendaModel->insert_correo_noti_agenda($array_insert_correo);
                }
            }
        }
    }

    /**************************************************************  <<AGENDA TECNICOS>>   ****************************************************************************/

    public function agenda()
    {
        $data_vista = array(
            'data_menus' => $this->html_menus,
            'name_page' => 'AGENDA',
        );

        $this->load->view('header', $data_vista);
        $this->load->view('agenda/agenda_tecnicos');
    }


    function get_citas_tecnicos()
    {
        $response = array(
            "status" => false,
            "message" => 'Error al ejecutar la consulta',
            "data" => null
        );
        try {

            $where_cita = array();
            if ($this->perfil == 3) {
                $where_cita['tecnico'] = $this->session->userdata('nit');
            }


            $data = $this->AgendaModel->get_citas($cita = "", $where_cita);
            $arr_calendar[] = array();
            if ($data["status"]) {
                foreach ($data["data"] as $key) {
                    $color = "";
                    switch ($key->estado) {
                        case '1':
                            $color = "#3498DB";
                            break;
                        case '2':
                            $color = "#F4D03F";
                            break;
                        case '3':
                            $color = "#283747";
                            break;
                        case '4':
                            $color = "#9B59B6";
                            break;
                        case '5':
                            $color = "#00CB47";
                            break;
                        default:
                            $color = "#CB00B9";
                            break;
                    }
                    $arr_calendar[] = array(
                        'id_cita' => $key->id_cita,
                        'title' => $key->primer_nombre_cliente . ' ' . $key->primer_apellido_cliente,
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

    public function check_estado_cita()
    {
        print_r($this->input->GET_POST());
    }
}
