<?php
class UsuariosController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('UsuariosModel');
        $this->load->model('EmpleadosModel');
    }

    public function index()
    {
        $this->load->view('header');
        $this->load->view('usuarios/index');
    }

    public function create()
    {
        $data_perfiles = $this->UsuariosModel->getPerfiles()->result();
        $data_empleados = $this->EmpleadosModel->getEmpleados()->result();

        $data = array(
            'data_empleados' => $data_empleados,
            'data_perfiles' => $data_perfiles
        );

        $this->load->view('header');
        $this->load->view('usuarios/create', $data);
    }

    public function createUsuario()
    {
        //Obtenemos los datos enviados a traves de POST
        $inputIdEmpleado = $this->input->POST('inputIdEmpleado');
        $inputIdPerfil = $this->input->POST('inputIdPerfil');

        //Creamos arrays para el where de las Query de CodeIgneier
        $data_where_empleado = array(
            'e.id' => $inputIdEmpleado
        );
        $data_where_usuario = array(
            'empleado_id' => $inputIdEmpleado
        );

        //Obtenemos información con el ID del empleado seleccionado para crear el usuario
        $data_empleado = $this->EmpleadosModel->getEmpleadosByIdEmpleado($data_where_empleado);
        //Validamos si el ID del empleado existe
        if ($data_empleado->num_rows() > 0) {
            //Obtenemos información de la tabla Usuarios con el ID del empleado
            $data_usuario = $this->UsuariosModel->getUsuariosByIdEmpleado($data_where_usuario);
            //Validamos si el ID del empleado no existe como Usuario
            if ($data_usuario->num_rows() == 0) {
                $empleado = $data_empleado->row(0);
                $username = $empleado->primer_nombre[0] . $empleado->segundo_nombre[0] . $empleado->primer_apellido . $empleado->segundo_apellido[0];
                $password = $empleado->nit;
                $hash = password_hash($password, PASSWORD_DEFAULT);

                $data_insert = array(
                    'empleado_id' => $empleado->id_empleado,
                    'usuario' => $username,
                    'contrasena' => $hash,
                    'estado_id' => 1,
                    'fecha_create' => date('Y-m-d H:i:s'),
                );

                if ($this->UsuariosModel->insertUsuario($data_insert)) {
                    $array_response = array(
                        'response' => 'success',
                        'message' => 'Usuario registrado con exito',
                    );
                } else {
                    $array_response = array(
                        'response' => 'warning',
                        'message' => 'Ha ocurrido un error, intente nuevamente',
                    );
                }
            } else {
                $array_response = array(
                    'response' => 'warning',
                    'message' => 'El Usuario que esta tratando de registrar ya se encuentra registrado',
                );
            }
        } else {
            $array_response = array(
                'response' => 'error',
                'message' => 'El Usuario que esta tratando de registrar no se encuentra en la base de datos como empleado',
            );
        }

        echo json_encode($array_response);
    }
}
