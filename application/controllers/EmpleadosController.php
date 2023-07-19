<?php
class EmpleadosController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('TercerosModel');
        $this->load->model('EmpleadosModel');
        $this->load->model('SedesModel');
        $this->load->helper('deleteFile_helper');
        $this->load->model('MenusModel');
        $this->load->helper('menu_helper');
    }

    public function index()
    {
        if (!$this->session->userdata('login')) {
            $this->session->sess_destroy();
            header("Location: " . base_url());
        } else {
            $perfil = $this->session->userdata('perfil');
            $data_where_menus = array(
                'pm.perfil_id' => $perfil
            );
            $data_menus = $this->MenusModel->getMenusByPerfil($data_where_menus);
            $html_menus = createMenuByPerfil($data_menus);
            $data_terceros = $this->TercerosModel->getTerceros()->result();
            $data_cargos = $this->EmpleadosModel->getCargoEmpleados()->result();
            $data_sedes = $this->SedesModel->getSedes()->result();
            $data_vista = array(
                'data_menus' => $html_menus,
                'data_terceros' => $data_terceros,
                'data_cargos' => $data_cargos,
                'data_sedes' => $data_sedes,
                'name_page' => 'EMPLEADOS'
            );
            $this->load->view('header', $data_vista);
            $this->load->view('empleados/index');
        }
    }

    public function loadTableEmpleados()
    {
        if (!$this->session->userdata('login')) {
            $this->session->sess_destroy();
            header("Location: " . base_url());
        } else {
            $data_empleados = $this->EmpleadosModel->getEmpleados();
            $tbody = '';
            if ($data_empleados->num_rows() > 0) {
                /*   [id] => 1
                [id_tercero] => 1
                [id_cargo] => 1
                [id_sede] => 1
                [email] => SERGIOIVANGALVISESTEBAN@GMAIL.COM
                [foto_perfil] => 1097304901.jpg
                [id_tipo_doc] => 1
                [nit] => 1097304901
                [primer_nombre] => SERGIO
                [segundo_nombre] => IVAN
                [primer_apellido] => GALVIS
                [segundo_apellido] => ESTEBAN
                [telefono_1] => 3017493524
                [telefono_2] => 3017493524
                [id_genero] => 2
                [id_municipio] => 119
                [direccion] => JUNIN 1
                [barrio] => CRA 4 #6N-49 SMART JUNIN TORRE
                [cargo] => DEVELOPER
                [sede] => PRINCIPAL
                [id_empleado] => 3
                [correo] => programadorSenior@seeldec.co */
                foreach ($data_empleados->result() as $row) {
                    /* <td class="text-center">' . $row->id_empleado . '</td> */
                    $tbody .= '<tr>
                <td class="text-center"><img width="100px" src="' . base_url() . 'media/imagenes/empleados/' . $row->foto_perfil . '"></td>
                <td class="text-center">' . $row->nit . '</td>
                <td>' . $row->primer_nombre . " " . $row->segundo_nombre . " " . $row->primer_apellido . " " . $row->segundo_apellido . '</td>
                <td class="text-center">' . $row->cargo . '</td>
                <td class="text-center">' . $row->sede . '</td>             
                <td class="text-center">' . $row->correo . '</td>
                <td class="text-center">
                    <button data=\'["' . $row->id_tercero . '","' . $row->id_cargo . '","' . $row->id_sede . '","' . $row->correo . '","' . $row->foto_perfil . '","' . $row->id_empleado . '"]\' type="button" class="btn btn-warning btn-sm ik ik-edit" data-toggle="tooltip" data-placement="top" title="Editar Empleados" onclick="editarEmpleado(this);"></button>
                </td>
                </tr>';
                }
            }
            $array_response = array(
                'tbody' => $tbody
            );
            echo json_encode($array_response);
        }
    }

    public function create()
    {
        if (!$this->session->userdata('login')) {
            $this->session->sess_destroy();
            header("Location: " . base_url());
        } else {
            $perfil = $this->session->userdata('perfil');
            $data_where_menus = array(
                'pm.perfil_id' => $perfil
            );
            $data_menus = $this->MenusModel->getMenusByPerfil($data_where_menus);
            $html_menus = createMenuByPerfil($data_menus);
            $data_terceros = $this->TercerosModel->getTerceros()->result();
            $data_cargos = $this->EmpleadosModel->getCargoEmpleados()->result();
            $data_sedes = $this->SedesModel->getSedes()->result();
            $data_vista = array(
                'data_menus' => $html_menus,
                'data_terceros' => $data_terceros,
                'data_cargos' => $data_cargos,
                'data_sedes' => $data_sedes,
                'name_page' => 'CREAR EMPLEADO'
            );
            $this->load->view('header', $data_vista);
            $this->load->view('empleados/create');
        }
    }



    public function createEmpleado()
    {
        if (!$this->session->userdata('login')) {
            $this->session->sess_destroy();
            header("Location: " . base_url());
        } else {
            $inputIdTercero = $this->input->POST('inputIdTercero');
            $inputIdCargoEmp = $this->input->POST('inputIdCargoEmp');
            $inputIdSedeEmp = $this->input->POST('inputIdSedeEmp');
            /* $inputFileImgEmp = $this->input->POST('inputFileImgEmp'); */
            $inputEmailEmp = $this->input->POST('inputEmailEmp');
            $data_tercero = $this->TercerosModel->getTerceroById($inputIdTercero);
            $data_empleado = $this->EmpleadosModel->getEmpleadosByIdTercero($inputIdTercero);
            switch (true) {
                case $data_tercero->num_rows() == 0:
                    $array_response = array(
                        'response' => 'warning',
                        'sms' => 'El empleado que esta intentando crear no se encuentra registrado en la base de datos'
                    );
                    break;
                case $data_empleado->num_rows() > 0:
                    $array_response = array(
                        'response' => 'warning',
                        'sms' => 'El empleado que esta intentando crear ya se encuentra registrado en la base de datos'
                    );
                    break;
                default:
                    $name_file = $data_tercero->row(0)->nit;
                    /* SCRIPT PARA GUARDAR LA IMAGEN DE PERFIL DEL EMPLEADO */
                    $config['upload_path'] = './media/imagenes/empleados';
                    $config['allowed_types'] = 'jpeg|jpg|png|gif';
                    $config['max_size'] = '10240000000';
                    $config['file_name'] = $name_file;
                    $this->load->library('upload', $config);
                    if (!$this->upload->do_upload('inputFileImgEmp')) {
                        $error = array('error' => $this->upload->display_errors());

                        $array_response = array(
                            'response' => 'error',
                            'sms' => $error
                        );
                    } else {
                        $data = array('upload_data' => $this->upload->data());

                        $data_insert = array(
                            'id_tercero' => $inputIdTercero,
                            'id_cargo' => $inputIdCargoEmp,
                            'id_sede' => $inputIdSedeEmp,
                            'foto_perfil' =>  $data['upload_data']['file_name'],
                            'email' => $inputEmailEmp
                        );

                        if ($this->EmpleadosModel->createEmpleado($data_insert)) {
                            $array_response = array(
                                'response' => 'success',
                                'sms' => 'Empleado creado correctamente'
                            );
                        } else {
                            $array_response = array(
                                'response' => 'error',
                                'sms' => 'Ha ocurrido un error, intente nuevamente!'
                            );
                        }
                    }
                    break;
            }
            echo json_encode($array_response);
        }
    }

    public function editEmpleado()
    {

        if (!$this->session->userdata('login')) {
            $this->session->sess_destroy();
            header("Location: " . base_url());
        } else {
            $inputIdTercero = $this->input->POST('inputIdTerceroHidden');
            $inputIdCargoEmp = $this->input->POST('inputIdCargoEmp');
            $inputIdSedeEmp = $this->input->POST('inputIdSedeEmp');
            $inputEmailEmp = $this->input->POST('inputEmailEmp');
            $data_tercero = $this->TercerosModel->getTerceroById($inputIdTercero);
            $data_empleado = $this->EmpleadosModel->getEmpleadosByIdTercero($inputIdTercero);
            switch (true) {
                case $data_tercero->num_rows() == 0:
                    $array_response = array(
                        'response' => 'warning',
                        'sms' => 'El empleado que esta intentando editar no se encuentra registrado en la base de datos de Terceros'
                    );
                    break;
                case $data_empleado->num_rows() == 0:
                    $array_response = array(
                        'response' => 'warning',
                        'sms' => 'El empleado que esta intentando editar no se encuentra registrado en la base de datos como Empleado'
                    );
                    break;
                default:
                    $foto_perfil = $data_empleado->row(0)->foto_perfil != "" ? $data_empleado->row(0)->foto_perfil : NULL;
                     /* SCRIPT PARA GUARDAR LA IMAGEN DE PERFIL DEL EMPLEADO */
                     $config['upload_path'] = './media/imagenes/empleados';
                     $config['allowed_types'] = 'jpeg|jpg|png|gif';
                     $config['max_size'] = '10240000000';
                     $config['overwrite'] = TRUE;
                     $config['file_name'] = $foto_perfil;
                     
                     $this->load->library('upload', $config);
                    if ($this->upload->do_upload('inputFileImgEmp')) {
                        $path_delete = "media/imagenes/empleados/$foto_perfil";
                        /* deleteFile($path_delete); */
                        $data = array('upload_data' => $this->upload->data());

                        $foto_perfil = $data['upload_data']['file_name'] != "" ? $data['upload_data']['file_name'] : NULL;
                    }
                    clearstatcache();
                    /* echo $foto_perfil;die; */

                    $data_insert = array(
                        'id_tercero' => $inputIdTercero,
                        'id_cargo' => $inputIdCargoEmp,
                        'id_sede' => $inputIdSedeEmp,
                        'foto_perfil' =>  $foto_perfil,
                        'email' => $inputEmailEmp
                    );
                    $data_where = array(
                        'id_tercero' => $inputIdTercero
                    );
                    if ($this->EmpleadosModel->updateEmpleado($data_insert, $data_where)) {
                        $array_response = array(
                            'response' => 'success',
                            'sms' => 'Datos del empleado actualizados correctamente'
                        );
                    } else {
                        $array_response = array(
                            'response' => 'error',
                            'sms' => 'Ha ocurrido un error, intente nuevamente!'
                        );
                    }

                    break;
            }
            echo json_encode($array_response);
        }
    }
}
