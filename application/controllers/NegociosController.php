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
        $this->load->model('ClientesModel');
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
                $cliente = $data_solicitud->row(0)->prospecto;
                $id_tercero = "";
                if ($data_solicitud->row(0)->cliente_id != NULL  && $data_solicitud->row(0)->cliente_id != "") {
                    $where_cliente = array('id_cliente' => $data_solicitud->row(0)->cliente_id);
                    $data_cliente = $this->ClientesModel->getClientes($where_cliente)->row(0);
                    $cliente = $data_cliente->primer_nombre . ' ' . $data_cliente->segundo_nombre . ' ' . $data_cliente->primer_apellido . ' ' . $data_cliente->segundo_apellido;
                    $id_tercero = $data_cliente->id_tercero;
                }

                $data_negocio = array(
                    'id_negocio' => $data_solicitud->row(0)->id_negocio,
                    'id_tercero' => $id_tercero,
                    'cliente' => $cliente,
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
                    'id_tercero' => "",
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

        $data_etapas_negocio = $this->NegociosModel->get_etapas_negocio();
        $html_flujo = "";
        if ($data_etapas_negocio->num_rows() > 0) {
            foreach ($data_etapas_negocio->result() as $row) {
                $data_where = array('negocio_id' => $id_negocio, 'etapa_id' => $row->id_etapa);
                $check_etapa = '<i class="font-weight-bold ik ik-alert-octagon"></i>';
                $opcion = 0;
                if ($this->NegociosModel->checkEtapa($data_where)->num_rows() > 0) {
                    $check_etapa = '<i class="font-weight-bold ik ik-check"></i>';
                    $opcion = 1;
                }

                $html_flujo .=
                    '<span>
                    <button class="btn btn-link text-primary font-weight-bold" modal="' . preg_replace('/[\s]/', "_", $row->etapa) . '" onclick="obtenerData(' . $row->id_etapa . ',' . $opcion . ');">
                        ' . $row->id_etapa . ' ' . $row->etapa . ' ' . $check_etapa . '
                    </button>
                    </span>
                    <br>';
            }
        }


        $html_flujo .= '<div style="border-bottom: 2px dashed #999999; margin: 20px 0;"></div> ';
        echo json_encode(array('html_flujo' => $html_flujo));
    }
    /******************************************************************************   HISTORIAL ETAPAS :::: ETAPA 1 AGREGAR CLIENTE  **********************************************************************/
    public function addCliente()
    {
        //Validar si el negocio existe! :XD
        $id_negocio = $this->input->POST('id_negocio');
        if (!isset($id_negocio) && $id_negocio == "" || $id_negocio == NULL) {
            header("Location: " . base_url() . "SolicitudController/gestionSolicitud");
            exit();
        }
        $where_negocio = array('id_negocio' => $id_negocio);
        if ($this->NegociosModel->getNegocio($where_negocio)->num_rows() == 0) {
            header("Location: " . base_url() . "SolicitudController/gestionSolicitud");
            exit();
        }

        $array_response = array();

        //Validar si existe el cliente
        $inputIdCliente = $this->input->POST('inputIdCliente');
        if ($inputIdCliente != NULL && $inputIdCliente != "") {
            if ($this->ClientesModel->getClienteByIdCliente($inputIdCliente)->num_rows() > 0) {
                $data_array_negocio_update = array(
                    'cliente_id' => $inputIdCliente,
                );

                if ($this->NegociosModel->updateNegocio($data_array_negocio_update, $where_negocio) > 0) {

                    $data_array_negocio_historial_etapas = array(
                        'negocio_id' => $id_negocio,
                        'etapa_id' => 1, //Registro de cliente
                        'user_id' => $this->user_id,
                        'fecha' => Date('Y-m-d') . 'T' . Date('H:i:s')
                    );

                    $this->NegociosModel->insertHistorialEtapa($data_array_negocio_historial_etapas);

                    $array_response['response'] = 'success';
                    $array_response['title'] = 'Exito!';
                    $array_response['html'] = 'Se ha registrado el cliente al negocio con exito!';

                    echo json_encode($array_response);
                    exit;
                }
            }
        }
        //Validar si el tercero existe! :XD
        $inputIdTercero = $this->input->POST('inputIdTercero');
        if (!isset($inputIdTercero) && $inputIdTercero == "" || $inputIdTercero == NULL) {
            header("Location: " . base_url() . "SolicitudController/gestionSolicitud");
            exit();
        }

        $inputTipoDoc = $this->input->POST('inputTipoDoc');
        $inputNumeroDoc = $this->input->POST('inputNumeroDoc');
        $inputFirstName = $this->input->POST('inputFirstName');
        $inputSecondName = $this->input->POST('inputSecondName');
        $inputFirstSurName = $this->input->POST('inputFirstSurName');
        $inputSecondSurName = $this->input->POST('inputSecondSurName');
        $inputIdGenero = $this->input->POST('inputIdGenero');
        $inputEmail = $this->input->POST('inputEmail');
        $inputTelefono_1 = $this->input->POST('inputTelefono_1');
        $inputTelefono_2 = $this->input->POST('inputTelefono_2');
        $comboPais = $this->input->POST('comboPais');
        $comboDepto = $this->input->POST('comboDepto');
        $comboMunicipio = $this->input->POST('comboMunicipio');
        $inputBarrio = $this->input->POST('inputBarrio');
        $inputDireccion = $this->input->POST('inputDireccion');

        if ($this->TercerosModel->getTerceroById($inputIdTercero)->num_rows() == 0) {
            //Crear Tercero XD
            $array_inputs = array(
                'id_tipo_doc' => $inputTipoDoc,
                'nit' => $inputNumeroDoc,
                'primer_nombre' => $inputFirstName,
                'segundo_nombre' => $inputSecondName,
                'primer_apellido' => $inputFirstSurName,
                'segundo_apellido' => $inputSecondSurName,
                'id_genero' => $inputIdGenero,
                'email' => $inputEmail,
                'telefono_1' => $inputTelefono_1,
                'telefono_2' => $inputTelefono_2,
                'id_municipio' => $comboMunicipio,
                'barrio' => $inputBarrio,
                'direccion' => $inputDireccion,
            );

            if ($this->TercerosModel->createTercero($array_inputs)) {
                $id_tercero_created = $this->db->insert_id();

                $data_cliente_insert = array(
                    'id_tercero' => $id_tercero_created,
                    'usuario_registro' => $this->user_id,
                    'fecha_registro' => Date('Y-m-d') . 'T' . Date('H:i:s')
                );

                if ($this->ClientesModel->insertCliente($data_cliente_insert)) {

                    $data_array_negocio_update = array(
                        'cliente_id' => $this->db->insert_id(),
                    );

                    if ($this->NegociosModel->updateNegocio($data_array_negocio_update, $where_negocio) > 0) {

                        $data_array_negocio_historial_etapas = array(
                            'negocio_id' => $id_negocio,
                            'etapa_id' => 1, //Registro de cliente
                            'user_id' => $this->user_id,
                            'fecha' => Date('Y-m-d') . 'T' . Date('H:i:s')
                        );

                        $this->NegociosModel->insertHistorialEtapa($data_array_negocio_historial_etapas);

                        $array_response['response'] = 'success';
                        $array_response['title'] = 'Exito!';
                        $array_response['html'] = 'Se ha registrado el cliente al negocio con exito!';

                        echo json_encode($array_response);
                        exit;
                    } else {
                        $array_response['response'] = 'error';
                        $array_response['title'] = 'Error';
                        $array_response['html'] = 'Ha ocurrido un error al intentar agregar el cliente al negocio!';
                        echo json_encode($array_response);
                        exit();
                    }
                }
            } else {

                $array_response['response'] = 'error';
                $array_response['title'] = 'Error';
                $array_response['html'] = 'Ha ocurrido un error al intentar crear el tercero!';
                echo json_encode($array_response);
                exit();
            }
        } else {

            $data_cliente_insert = array(
                'id_tercero' => $inputIdTercero,
                'usuario_registro' => $this->user_id,
                'fecha_registro' => Date('Y-m-d') . 'T' . Date('H:i:s')
            );

            if ($this->ClientesModel->insertCliente($data_cliente_insert)) {
                $data_array_negocio_update = array(
                    'cliente_id' => $this->db->insert_id(),
                );

                if ($this->NegociosModel->updateNegocio($data_array_negocio_update, $where_negocio) > 0) {

                    $data_array_negocio_historial_etapas = array(
                        'negocio_id' => $id_negocio,
                        'etapa_id' => 1, //Registro de cliente
                        'user_id' => $this->user_id,
                        'fecha' => Date('Y-m-d') . 'T' . Date('H:i:s')
                    );

                    $this->NegociosModel->insertHistorialEtapa($data_array_negocio_historial_etapas);

                    $array_response['response'] = 'success';
                    $array_response['title'] = 'Exito!';
                    $array_response['html'] = 'Se ha agregado el cliente al negocio!';

                    echo json_encode($array_response);
                    exit;
                }
            } else {
                $array_response['response'] = 'success';
                $array_response['title'] = 'Exito!';
                $array_response['html'] = 'Ha ocurrido un error al intentar agregar el cliente al negocio!';

                echo json_encode($array_response);
                exit;
            }
        }
    }

    public function save_solicitud_cliente()
    {
        $text_solicitud_cliente = $this->input->POST('text_solicitud_cliente');
        $id_negocio = $this->input->POST('id_negocio');

        //Validar si el negocio existe! :XD
        $where_negocio = array('id_negocio' => $id_negocio);
        if ($this->NegociosModel->getNegocio($where_negocio)->num_rows() == 0) {
            header("Location: " . base_url() . "SolicitudController/gestionSolicitud");
            exit();
        }
        //Validar si la soclicitud viene vacia
        if ($text_solicitud_cliente == "" || $text_solicitud_cliente == NULL || strlen($text_solicitud_cliente) < 20) {
            $array_response = array(
                'response' => 'error',
                'title' => 'Advertencia',
                'html' => '<strong>La solicitud se encuentra vacia o es menor a 20 caracteres!</strong>'
            );
            echo json_encode($array_response);
            exit;
        }

        $array_insert_solicitud = array(
            'negocio_id' => $id_negocio,
            'observacion' => $text_solicitud_cliente,
            'fecha_registro' => Date('Y-m-d') . 'T' . Date('H:i:s'),
            'user_crea' => $this->user_id,
        );

        if ($this->NegociosModel->insertSolicitudCliente($array_insert_solicitud)) {
            $data_array_negocio_historial_etapas = array(
                'negocio_id' => $id_negocio,
                'etapa_id' => 2, //Registro solicitud cliente XD
                'user_id' => $this->user_id,
                'fecha' => Date('Y-m-d') . 'T' . Date('H:i:s')
            );

            $this->NegociosModel->insertHistorialEtapa($data_array_negocio_historial_etapas);

            $array_response = array(
                'response' => 'success',
                'title' => 'Exito',
                'html' => '<strong>Se ha creado con exito la solicitud del cliente!</strong>'
            );
        } else {
            $array_response = array(
                'response' => 'error',
                'title' => 'Error!',
                'html' => '<strong>Ha ocurrido un error al intentar crear la solicitud del cliente!</strong>'
            );
        }

        echo json_encode($array_response);
        exit;
    }

    public function load_solicitud_cliente()
    {
        $id_negocio = $this->input->POST('id_negocio');

        //Validar si el negocio existe! :XD
        $where_negocio = array('id_negocio' => $id_negocio);
        if ($this->NegociosModel->getNegocio($where_negocio)->num_rows() == 0) {
            header("Location: " . base_url() . "SolicitudController/gestionSolicitud");
            exit();
        }

        $array_where = array('negocio_id' => $id_negocio);
        $data_solicitud = $this->NegociosModel->get_negocios_solicitud_cliente($array_where);
        if ($data_solicitud->num_rows() > 0) {
            $array_response = array(
                'response' => 'success',
                'title' => 'Exito!',
                'html' => '<strong>Se ha cargado con exito la solicitud del cliente</strong>',
                'observacion' => $data_solicitud->row(0)->observacion
            );
        } else {
            $array_response = array(
                'response' => 'error',
                'title' => 'Error!',
                'html' => '<strong>Ha ocurrido un error al intentar cargar la solicitud del cliente!</strong>'
            );
        }

        echo json_encode($array_response);
        exit;
    }
}
