<?php
class UsuariosController extends CI_Controller
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

        $this->load->model('UsuariosModel');
        $this->load->model('EmpleadosModel');
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

        $data_vista = array(
            'data_menus' => $this->html_menus,
            'name_page' => 'USUARIOS',
        );
        $this->load->view('header', $data_vista);
        $this->load->view('usuarios/index');
    }

    public function create()
    {

        $data_perfiles = $this->UsuariosModel->getPerfiles()->result();
        $data_empleados = $this->EmpleadosModel->getEmpleados()->result();
        $data_vista = array(
            'data_menus' =>  $this->html_menus,
            'name_page' => 'CREAR USUARIO',
            'data_empleados' => $data_empleados,
            'data_perfiles' => $data_perfiles
        );
        $this->load->view('header', $data_vista);
        $this->load->view('usuarios/create');
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

                $data_where = array(
                    'usuario' => $username
                );
                $data_user = $this->UsuariosModel->getUserByNameUser($data_where);

                $username = $data_user->num_rows() == 0 ? $username : $username . $data_user->num_rows();

                $password = $empleado->nit;
                $hash = password_hash($password, PASSWORD_DEFAULT);

                $data_insert = array(
                    'empleado_id' => $empleado->id_empleado,
                    'usuario' => $username,
                    'contrasena' => $hash,
                    'change_pass' => 1,
                    'estado_id' => 1,
                    'fecha_create' => date('Y-m-d H:i:s'),
                    'perfil_id' => $inputIdPerfil
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

    public function loadUsuarios()
    {
        $data_usuarios = $this->UsuariosModel->getUsuarios();

        $tbody = '';
        if ($data_usuarios->num_rows() > 0) {
            foreach ($data_usuarios->result() as $usuario) {
                $tbody .= '<tr>
                <td>' . $usuario->id_user . '</td>
                <td>' . $usuario->usuario . '</td>
                <td>' . $usuario->nit . '</td>
                <td>' . $usuario->primer_nombre . ' ' . $usuario->segundo_nombre . ' ' . $usuario->primer_apellido . ' ' . $usuario->segundo_apellido . '</td>
                <td>' . $usuario->estado . '</td>
                <td></td>
                </tr>';
            }
        }

        $array_response = array(
            'tbody' => $tbody
        );

        echo json_encode($array_response);
    }

    public function changePassword()
    {
        $user = $this->session->userdata('user');
        $nit = $this->session->userdata('nit');
        $new_pass = $this->input->POST('new_pass');
        $new_pass_check = $this->input->POST('new_pass_check');

        switch (true) {
            case ($user == "" && $new_pass == "" && $new_pass_check == ""):
                $array_response = array(
                    'title' => 'Advertencia!',
                    'message' => 'Los campos estan vacios!',
                    'response' => 'warning',
                );
                break;
            case ($new_pass != $new_pass_check):
                $array_response = array(
                    'title' => 'Advertencia!',
                    'message' => 'Las contraseñas no coincidieron!',
                    'response' => 'warning',
                );
                break;
            case ($new_pass === $nit):
                $array_response = array(
                    'title' => 'Advertencia!',
                    'message' => 'La contraseña no puede ser su número de documento de identidad!',
                    'response' => 'warning',
                );
                break;
            default:
                $hash = password_hash($new_pass, PASSWORD_DEFAULT);

                $data_where = array(
                    'usuario' => $user,
                );
                $data_update = array(
                    'contrasena' => $hash,
                    'change_pass' => 0,
                );

                if ($this->UsuariosModel->updateUsuario($data_where, $data_update)) {
                    $array_response = array(
                        'title' => 'Exito!',
                        'message' => 'Contraseña actualizada correctamente!',
                        'response' => 'success',
                    );
                    $this->session->set_userdata('change_password', 0);
                } else {
                    $array_response = array(
                        'title' => 'Error!',
                        'message' => 'Ha ocurrio un error al realizar la actualización de la contraseña!',
                        'response' => 'error',
                    );
                }
                break;
        }

        echo json_encode($array_response);
    }
}
