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
        $select = '<option value="">SELECCIONE UN DEPARTAMENTO</option>';
        foreach ($data_deptos as $depto){
            $select .= '<option value="'.$depto->id.'">'.$depto->departamento.'</option>';
        }


        $data_response = array(
            'data_deptos' => $select
        );
        echo json_encode( $data_response );
    }


    public function municipiosByIdDepto(){
        $id_depto = $this->input->POST('id_depto');
        $data_municipios = $this->UsuarioModel->getMunicipioByIdDepto($id_depto)->result();
        $select = '<option value="">SELECCIONE UN MUNICIPIO</option>';
        foreach ($data_municipios as $muinicipio){
            $select .= '<option value="'.$muinicipio->id.'">'.$muinicipio->municipio.'</option>';
        }


        $data_response = array(
            'data_municipios' => $select
        );
        echo json_encode( $data_response );
    }


}
