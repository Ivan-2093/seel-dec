<?php
class SolicitudController extends CI_Controller
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
            'name_page' => 'SOLICITUD CLIENTE'
        );

        $this->load->view('header', $data_vista);
        $this->load->view('solicitudes/solicitud_cliente');
    }
    public function createSolicitud()
    {
        $inputNombres = $this->input->POST('inputNombres');
        $inputEmail = $this->input->POST('inputEmail');
        $inputPhone = $this->input->POST('inputPhone');
        $comboDepto = $this->input->POST('comboDepto');
        $comboMunicipio = $this->input->POST('comboMunicipio');
        $inputAddress = $this->input->POST('inputAddress');
        $inputSolicitud = $this->input->POST('inputSolicitud');


        if ($inputNombres != "" && $inputEmail != ""  && $inputPhone != "" && $comboMunicipio != ""  && $inputSolicitud != "") {

            $array_insert = array(
                'prospecto' => $inputNombres,
                'correo' => $inputEmail,
                'telefono' => $inputPhone,
                'id_municipio' => $comboMunicipio,
                'direccion' => $inputAddress,
                'observacion' => $inputSolicitud,
                'usuario' => $this->session->userdata('user'),
                'fecha_creado' => Date('Y-m-d') . 'T' . Date('H:i:s'),
                'id_tipo_solicitud' => 2

            );

            if ($this->ProspectosModel->insertSolicitudProspecto($array_insert)) {
                $array_response = array(
                    'response' => 'success',
                    'title' => 'EXITO!',
                    'sms' => 'Se ha realizado con exito el registro de la solicitud del cliente',
                );
            } else {
                $array_response = array(
                    'response' => 'error',
                    'title' => 'ERROR!',
                    'sms' => 'Ha ocurrido un error al momento de realizar el registro de la solicitud, intente nuevamente!',
                );
            }
        } else {
            $array_response = array(
                'response' => 'warning',
                'title' => 'ADVERTENCIA!',
                'sms' => 'Se encontraron campos vacios, verifique nuevamente.',
                'campos' => $this->input->POST() //enviar los datos que se recibieron!
            );
        }

        echo json_encode($array_response);
    }

    public function gestionSolicitud()
    {
        $data_vista = array(
            'data_menus' => $this->html_menus,
            'name_page' => 'GESTIONAR SOLICITUD CLIENTE'
        );

        $this->load->view('header', $data_vista);
        $this->load->view('solicitudes/gestion_solicitud_cliente');
    }

    public function load_data_solicitudes()
    {
        $where = array();
        if (count($this->input->POST()) > 0) {
            if ($this->input->POST('date_start')) {
                $where['s.fecha_creado >='] = $this->input->POST('date_start');
            }

            if ($this->input->POST('date_end')) {
                $where['s.fecha_creado <='] = $this->input->POST('date_end');
            }

            if (($this->input->POST('inputNames'))) {
                $where['s.prospecto like'] = $this->input->POST('inputNames');
            }

            if ($this->input->POST('inputPhone')) {
                $where['s.telefono'] = $this->input->POST('inputPhone');
            }

            if ($this->input->POST('inputEmail')) {
                $where['s.correo'] = $this->input->POST('inputEmail');
            }
        }

        $tbody = '';

        $data_solicitudes = $this->ProspectosModel->getSolicitudes($where);


        if ($data_solicitudes->num_rows() > 0) {
            foreach ($data_solicitudes->result() as $row) {
                $btnTitle = "CREAR NEGOCIO";
                $icono_ik = 'ik ik-share';
                if($row->id_negocio != ""){
                    $btnTitle = "VER NEGOCIO";
                    $icono_ik = 'ik ik-eye';
                }

                $tbody .=
                '<tr>
                    <td>' . $row->id_solicitud . '</td>
                    <td>' . $row->prospecto . '</td>
                    <td>' . $row->telefono . '</td>
                    <td>' . $row->correo . '</td>
                    <td>' . $row->municipio . '</td>
                    <td>' . $row->observacion . '</td>
                    <td>' . $row->tipo_solicitud . '</td>
                    <td>' . $row->usuario . '</td>
                    <td>' . $row->fecha_creado . '</td>
                    <td class="text-center">
                        <form action="'.base_url().'NegociosController" method="post" target="_blank">
                            <input type="hidden" name="id_solicitud" value="'.$row->id_solicitud.'" />
                            <button type="submit" class="btn btn-warning btn-xs" data-toggle="tooltip" data-placement="top" title="'.$btnTitle.'">
                                <i class="'.$icono_ik.'"></i>
                            </button>
                        </form>
                    </td>
                </tr>';
            }
        }
        $array_response = array(
            'tbody' => $tbody,
        );

        echo json_encode($array_response);
    }
}
