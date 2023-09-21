<?php
class EncuestasController extends CI_Controller
{
    public $html_menus = NULL;
    public $perfil = NULL;
    public $user_id = NULL;

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('permisos_url_helper');
        validate_url_permiso_perfil($this->perfil);
        $this->load->model('MenusModel');
        $this->load->model('NegociosModel');
        $this->load->model('EncuestasModel');
        $this->load->helper('menu_helper');
        $this->load->library('phpmailer_lib');
        $this->load->library('encrypt');

        $data_where_menus = array(
            'pm.perfil_id' => $this->perfil,
        );

        $data_menus = $this->MenusModel->getMenusByPerfil($data_where_menus);
        $this->html_menus = createMenuByPerfil($data_menus);
    }

    public function index()
    {

        $id_negocio_encrypt = $this->input->post('id_negocio');

        $id_negocio = $this->encrypt->decode($id_negocio_encrypt);

        if ($id_negocio != "" && $id_negocio != NULL) {
            $where_negocio = array('id_negocio' => $id_negocio);
            if ($this->EncuestasModel->load_encuesta_satisfacion($where_negocio)->num_rows() == 0) {
                $where_negocio = array('n.id_negocio' => $id_negocio);
                $data_negocio = $this->NegociosModel->getNegociosAll($where_negocio);
                //Pendiente validación si la encuesta ya se ha realizado antes! :XD
                if ($data_negocio->num_rows() > 0) {
                    $data_vista = array(
                        'data_menus' => $this->html_menus,
                        'name_page' => 'ENCUESTA',
                        'id_negocio' => $id_negocio_encrypt
                    );
                    $this->load->view('header', $data_vista);

                    $this->load->view('encuestas/encuesta_satisfacion');
                } else {
                    echo 'Esta encuesta no se encuentra disponible!';
                }
            } else {
                echo 'Esta encuesta ya se ha realizado!';
            }
        } else {
            echo 'Esta encuesta no se encuentra disponible!';
        }
    }

    public function saveEncuesta()
    {
        $id_negocio = $this->input->post('id_negocio');
        $id_negocio_decrypt = $this->encrypt->decode($id_negocio);
        $array_response = array(
            'response' => 'error',
            'title' => 'Error',
            'Html' => 'Se ha generado un error, intente más tarde!'
        );
        $where_negocio = array('id_negocio' => $id_negocio_decrypt);
        if ($this->EncuestasModel->load_encuesta_satisfacion($where_negocio)->num_rows() == 0) {

            $pregunta1 = $this->input->post('pregunta1');
            $pregunta4 = $this->input->post('pregunta4');
            $pregunta5 = $this->input->post('pregunta5');
            $pregunta7 = $this->input->post('pregunta7');


            $data_insert = array(
                'id_negocio' => $id_negocio_decrypt,
                'pregunta_1' => $pregunta1,
                'pregunta_2' => $pregunta4,
                'pregunta_3' => $pregunta5,
                'opinion' => $pregunta7,
                'fecha_registro' => Date('Y-m-d') . 'T' . Date('H:i:s')
            );

            if ($this->EncuestasModel->insert_encuesta_satisfacion($data_insert)) {
                $array_response['response'] = 'success';
                $array_response['title'] = 'Exito';
                $array_response['Html'] = '<strong>¡Muchas gracias por tomarse el tiempo para completar la encuesta!</strong>';
            }
        } else {
            $array_response['response'] = 'warning';
            $array_response['title'] = 'Exito!';
            $array_response['Html'] = '<strong>¡Ya hemos registrado tus respuestas, muchas gracias!</strong>';
        }

        echo json_encode($array_response);
    }
}
