<?php
class TercerosController extends CI_Controller
{
    public function __construct() {      
        parent::__construct();
        $this->load->model('TercerosModel');
        $this->load->model('PaisesModel');     
    }

    public function index(){
        $this->load->view('header');
        $this->load->view('admin/index_user');
    }

    public function create(){

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

        $array_inputs = array(
            'id_tipo_doc' => $this->input->POST('inputTipoDoc'),
            'nit' => $this->input->POST('inputNumeroDoc'),
            'primer_nombre' => $this->input->POST('inputFirstName'),
            'segundo_nombre' => $this->input->POST('inputSecondName'),
            'primer_apellido' => $this->input->POST('inputFirstSurName'),
            'segundo_apellido' => $this->input->POST('inputSecondSurName'),
            'id_genero' => $this->input->POST('inputIdGenero'),
            'email' => $this->input->POST('inputEmail'),
            'telefono_1' => $this->input->POST('inputTelefono_1'),
            'telefono_2' => $this->input->POST('inputTelefono_2'),
            'id_municipio' => $this->input->POST('comboMunicipio'),
            'direccion' => $this->input->POST('inputDireccion'),
        );
        if($this->TercerosModel->getTerceroByNumeroDoc($array_inputs['nit'])->num_rows() == 0){
            if($this->TercerosModel->createTercero($array_inputs)){
                $array_response = array(
                    'response' => 'success'
                );
            }else {
                $array_response = array(
                    'response' => 'error'
                );
            }
        }else {
            $array_response = array(
                'response' => 'warning'
            );
        }
        

        echo json_encode($array_response);

    }

    public function loadTerceros(){
        $data_terceros = $this->TercerosModel->getTerceros();
        /* print_r($data_terceros->result()); */
        $tbody = '';
        foreach($data_terceros->result() as $key){
            $tbody.= '<tr>
                <td>'.$key->descripcion.'</td>
                <td>'.$key->nit.'</td>
                <td>'.$key->primer_nombre .' '. $key->segundo_nombre .' '. $key->primer_apellido .' '. $key->segundo_apellido .'</td>
                <td>'.$key->email.'</td>
                <td>'.$key->telefono_1.'</td>
                <td>'.$key->telefono_2.'</td>
                <td>'.$key->genero.'</td>
                <td>'.$key->municipio.'</td>
                <td>'.$key->barrio.'</td>
                <td>'.$key->direccion.'</td>
            </tr>';
        }

        $array_response = array(
            'tbody' => $tbody
        );

        echo json_encode($array_response);

    }


}
