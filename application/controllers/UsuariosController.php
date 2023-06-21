<?php
class UsuariosController extends CI_Controller
{
    public function __construct() {      
        parent::__construct();
        $this->load->model('UsuarioModel');     
    }

    public function index(){

        $data_tipo_doc = $this->UsuarioModel->getTipoDocumentos()->result();
        $data_paises = $this->UsuarioModel->getPaises()->result();

        $data = array(
            'data_tipo_doc' => $data_tipo_doc,
            'data_paises' => $data_paises
        );

        

        $this->load->view('header');
        $this->load->view('admin/create_user',$data);
    }

    public function deptosByIdPais(){
        $id_pais = $this->input->POST('id_pais');
        $data_deptos = $this->UsuarioModel->getDeptoByIdPais($id_pais)->result();
        $data_response = array(
            'data_deptos' => $data_deptos
        );
        echo json_encode( $data_response );
    }


}
