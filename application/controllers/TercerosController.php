<?php
class TercerosController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('TercerosModel');
        $this->load->model('PaisesModel');
    }

    public function index()
    {

        $data_tipo_doc = $this->TercerosModel->getTipoDocumentos()->result();
        $data_paises = $this->PaisesModel->getPaises()->result();
        $data_generos = $this->TercerosModel->getGeneros()->result();

        $data = array(
            'data_tipo_doc' => $data_tipo_doc,
            'data_paises' => $data_paises,
            'data_generos' => $data_generos
        );



        $this->load->view('header');
        $this->load->view('admin/create_user2', $data);
    }

    public function deptosByIdPais()
    {
        $id_pais = $this->input->POST('id_pais');
        $data_deptos = $this->PaisesModel->getDeptoByIdPais($id_pais)->result();
        $select = '<option value="">SELECCIONE UN DEPARTAMENTO</option>';
        foreach ($data_deptos as $depto) {
            $select .= '<option value="' . $depto->id . '">' . $depto->departamento . '</option>';
        }


        $data_response = array(
            'data_deptos' => $select
        );
        echo json_encode($data_response);
    }


    public function municipiosByIdDepto()
    {
        $id_depto = $this->input->POST('id_depto');
        $data_municipios = $this->PaisesModel->getMunicipioByIdDepto($id_depto)->result();
        $select = '<option value="">SELECCIONE UN MUNICIPIO</option>';
        foreach ($data_municipios as $muinicipio) {
            $select .= '<option value="' . $muinicipio->id . '">' . $muinicipio->municipio . '</option>';
        }


        $data_response = array(
            'data_municipios' => $select
        );
        echo json_encode($data_response);
    }


}