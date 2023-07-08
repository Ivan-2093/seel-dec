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
    }

    public function index()
    {
        if (!$this->session->userdata('login')) {
            $this->session->sess_destroy();
            header("Location: " . base_url());
        } else {
            $this->load->view('header');
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
                foreach ($data_empleados->result() as $row) {
                    $tbody .= '<tr>
                <td class="text-center">' . $row->id_empleado . '</td>
                <td class="text-center">' . $row->nit . '</td>
                <td class="text-center">' . $row->primer_nombre . " " . $row->segundo_nombre . " " . $row->primer_apellido . " " . $row->segundo_apellido . '</td>
                <td class="text-center">' . $row->sede . '</td>
                <td class="text-center">' . $row->cargo . '</td>             
                <td class="text-center">' . $row->correo . '</td>
                <td class="text-center"><img width="200px" src="' . base_url() . 'public/empleados/' . $row->foto_perfil . '"></td>
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
            $data_terceros = $this->TercerosModel->getTerceros()->result();
            $data_cargos = $this->EmpleadosModel->getCargoEmpleados()->result();
            $data_sedes = $this->SedesModel->getSedes()->result();

            $data = array(
                'data_terceros' => $data_terceros,
                'data_cargos' => $data_cargos,
                'data_sedes' => $data_sedes,
            );

            $this->load->view('header');
            $this->load->view('empleados/create', $data);
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
                    $config['upload_path'] = './public/empleados';
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

                        /* var_dump($this->EmpleadosModel->createEmpleado($data_insert));  die; */

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
}
