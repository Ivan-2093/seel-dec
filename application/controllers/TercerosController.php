<?php
class TercerosController extends CI_Controller
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

        $this->load->model('TercerosModel');
        $this->load->model('PaisesModel');
        $this->load->model('MenusModel');
        $this->load->helper('menu_helper');
        $this->load->library('phpmailer_lib');
        $this->load->helper('permisos_url_helper');
        $this->perfil = $this->session->userdata('perfil');
        validate_url_permiso_perfil($this->perfil);
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
        $data = array(
            'data_menus' => $this->html_menus,
            'data_tipo_doc' => $data_tipo_doc,
            'data_paises' => $data_paises,
            'data_generos' => $data_generos,
            'name_page' => 'TERCEROS',
        );
        $this->load->view('header', $data);
        $this->load->view('terceros/index');
    }

    public function create()
    {
        $data_tipo_doc = $this->TercerosModel->getTipoDocumentos()->result();
        $data_paises = $this->PaisesModel->getPaises()->result();
        $data_generos = $this->TercerosModel->getGeneros()->result();
        $data = array(
            'data_menus' => $this->html_menus,
            'data_tipo_doc' => $data_tipo_doc,
            'data_paises' => $data_paises,
            'data_generos' => $data_generos,
            'name_page' => 'CREAR TERCERO',
        );
        $this->load->view('header', $data);
        $this->load->view('terceros/create');
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

    public function createTercero()
    {
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
            'barrio' => $this->input->POST('inputBarrio'),
            'direccion' => $this->input->POST('inputDireccion'),
        );
        if ($this->TercerosModel->getTerceroByNumeroDoc($array_inputs['nit'])->num_rows() == 0) {
            if ($this->TercerosModel->createTercero($array_inputs)) {
                $array_response = array(
                    'response' => 'success'
                );
            } else {
                $array_response = array(
                    'response' => 'error'
                );
            }
        } else {
            $array_response = array(
                'response' => 'warning'
            );
        }


        echo json_encode($array_response);
    }

    public function loadTerceros()
    {
        $data_terceros = $this->TercerosModel->getTerceros();
        $tbody = '';
        foreach ($data_terceros->result() as $key) {
            $tbody .= '<tr>
                <td>' . $key->nit . '</td>
                <td>' . $key->primer_nombre . ' ' . $key->segundo_nombre . ' ' . $key->primer_apellido . ' ' . $key->segundo_apellido . '</td>
                <td>' . $key->email . '</td>
                <td>' . $key->telefono_1 . '</td>
                <td>' . $key->telefono_2 . '</td>
                <td><button data=\'["' . $key->id_tipo_doc . '","' . $key->descripcion . '","' . $key->nit . '","' . $key->primer_nombre . '","' . $key->segundo_nombre . '","' . $key->primer_apellido . '","' . $key->segundo_apellido . '","' . $key->email . '","' . $key->telefono_1 . '","' . $key->telefono_2 . '","' . $key->id_genero . '","' . $key->id_pais . '","' . $key->id_dpto . '","' . $key->id_municipio . '","' . $key->barrio . '","' . $key->direccion . '","' . $key->id_tercero . '"]\' class="btn btn-warning ik ik-edit" data-toggle="tooltip" data-placement="top" title="EDITAR TERCERO" onclick="editTercero(this)"></button></td>
            </tr>';
        }

        $array_response = array(
            'tbody' => $tbody
        );

        echo json_encode($array_response);
    }

    public function editTercero()
    {

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
            'barrio' => $this->input->POST('inputBarrio'),
            'direccion' => $this->input->POST('inputDireccion'),
        );
        if ($this->TercerosModel->getTerceroByNumeroDoc($array_inputs['nit'])->num_rows() > 0) {
            $data_where = array(
                'id' => $this->input->POST('inputIdTercero'),
            );
            if ($this->TercerosModel->editTercero($array_inputs, $data_where)) {
                $array_response = array(
                    'response' => 'success'
                );
            } else {
                $array_response = array(
                    'response' => 'error'
                );
            }
        } else {
            $array_response = array(
                'response' => 'warning'
            );
        }
        echo json_encode($array_response);
    }
}
