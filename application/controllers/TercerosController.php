<?php
class TercerosController extends CI_Controller
{
    public function __construct() {      
        parent::__construct();
        $this->load->model('TercerosModel');
        $this->load->model('PaisesModel');     
    }

    public function index(){

        $data_tipo_doc = $this->TercerosModel->getTipoDocumentos()->result();
        $data_paises = $this->PaisesModel->getPaises()->result();
        $data_generos = $this->TercerosModel->getGeneros()->result();

        $data = array(
            'data_tipo_doc' => $data_tipo_doc,
            'data_paises' => $data_paises,
            'data_generos' => $data_generos
        );

        

        $this->load->view('header');
        $this->load->view('admin/create_user',$data);
    }

    public function deptosByIdPais(){
        $id_pais = $this->input->POST('id_pais');
        $data_deptos = $this->PaisesModel->getDeptoByIdPais($id_pais)->result();
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
        $data_municipios = $this->PaisesModel->getMunicipioByIdDepto($id_depto)->result();
        $select = '<option value="">SELECCIONE UN MUNICIPIO</option>';
        foreach ($data_municipios as $muinicipio){
            $select .= '<option value="'.$muinicipio->id.'">'.$muinicipio->municipio.'</option>';
        }


        $data_response = array(
            'data_municipios' => $select
        );
        echo json_encode( $data_response );
    }

    public function createTercero(){
        $tipoDoc = $this->input->POST('tipoDoc');
        $numeroDoc = $this->input->POST('numeroDoc');
        $firtsName = $this->input->POST('firtsName');
        $secondName = $this->input->POST('secondName');
        $firstSurName = $this->input->POST('firstSurName');
        $secondSurName = $this->input->POST('secondSurName');
        $idGenero = $this->input->POST('idGenero');
        $mail = $this->input->POST('mail');
        $telefone_1 = $this->input->POST('telefone_1');
        $telefone_2 = $this->input->POST('telefone_2');
        $idPais = $this->input->POST('idPais');
        $idDepto = $this->input->POST('idDepto');
        $idMunicipio = $this->input->POST('idMunicipio');
        $direccion = $this->input->POST('direccion');


        print_r($this->input->POST());die;

    }


}
