<?php
class LoginController extends CI_Controller
{

    public function __construct() //define el constructor
    {
        parent::__construct(); //invoca al constructor de la clase superior
        $this->load->model('UsuariosModel'); //carga un modelo con el nombre de Usuarios“  
        $this->load->model('EmpleadosModel');
        $this->load->library('phpmailer_lib');
    }
    public function index()
    {
        if ($this->session->userdata('login')) {
            header("Location: " . base_url() . "HomeController");
        } else {
            $this->load->view('login/login');
        }
    }
    public function login()
    {

        $username = $this->input->POST('username');
        $password = $this->input->POST('password');

        if ($username === NULL || $username === "" || $password === NULL || $password === "") {

            $array_response = array(
                'response' => 'warning',
                'sms' => 'Campos del formulario vacios.',
            );

            echo json_encode($array_response);
        } else {

            $data_where = array(
                'usuario' => $username,
                'estado_id <>' => 3
            );

            $data_user = $this->UsuariosModel->getUserByNameUser($data_where);

            if ($data_user->num_rows() > 0) {
                /* Valida si el usario esta activo */
                if($data_user->row(0)->estado_id != 1 ){
                    $array_response = array(
                        'response' => 'warning',
                        'sms' => 'Usuario Bloqueado <br><br><strong>Nota: para desbloquear su usuario informe a su jefe inmediato!</strong>',
                    );
                    echo json_encode($array_response);
                    exit;
                }
                if (password_verify($password, $data_user->row(0)->contrasena)) {
                    /* print_r($data_user->result()); */
                    $data_whereEmp = array('e.id' => $data_user->row(0)->empleado_id);
                    $data_empleado = $this->EmpleadosModel->getEmpleadosByIdEmpleado($data_whereEmp);


                    $data = array(
                        'user' => $data_user->row(0)->usuario,
                        'nit' => $data_empleado->row(0)->nit,
                        'nombres' => $data_empleado->row(0)->nombres,
                        'perfil' => $data_user->row(0)->perfil_id,
                        'id_user' => $data_user->row(0)->id_user,
                        'img_user' => $data_empleado->row(0)->foto_perfil,
                        'change_password' => $data_user->row(0)->change_pass,
                        'login' => true
                    );
                    //enviamos los datos de session al navegador
                    $this->session->set_userdata($data);

                    $array_response = array(
                        'response' => 'success',
                        'sms' => 'Login exitoso!',
                        'url' => 'HomeController'
                    );

                    echo json_encode($array_response);
                } else {

                    $array_response = array(
                        'response' => 'warning',
                        'sms' => 'Contraseña incorrecta.',
                    );

                    echo json_encode($array_response);
                }
            } else {

                $array_response = array(
                    'response' => 'warning',
                    'sms' => 'Usuario incorrecto.',
                );

                echo json_encode($array_response);
            }
        }
    }

    public function logout()
    {

        $this->session->sess_destroy();
        header("Location: " . base_url());
    }

    public function restPassword()
    {
        $username = $this->input->POST('username');
        if ($username != "" && $username != NULL) {
            $data_where = array(
                'usuario' => $username
            );
            $data_user = $this->UsuariosModel->getUserByNameUser($data_where);

            if ($data_user->num_rows() > 0) {
                $data_whereEmp = array('e.id' => $data_user->row(0)->empleado_id);
                $data_empleado = $this->EmpleadosModel->getEmpleadosByIdEmpleado($data_whereEmp);

                $nombre_usuario = $data_empleado->row(0)->primer_nombre . " " . $data_empleado->row(0)->primer_apellido;
                $correo_usuario = $data_empleado->row(0)->correo;

                // Obtener una representación codificada hexadecimal para el token:
                $pass = array();
                for ($i = 0; $i < 15; $i++) {
                    switch (mt_rand(1, 2)) {
                        case '1':
                            $pass[] = chr(mt_rand(48, 57));
                            break;

                        default:
                            $pass[] = chr(mt_rand(65, 90));
                            break;
                    }
                }
                $key = implode($pass);
                $hash = password_hash($key, PASSWORD_DEFAULT);

                $data_update = array(
                    'contrasena' => $hash,
                    'change_pass' => 1,
                );

                if ($this->UsuariosModel->updateUsuario($data_where, $data_update)) {
                    if ($this->sendEmail($nombre_usuario, $correo_usuario, $key)) {
                        $data_response = array(
                            'response' => 'success',
                            'title' => 'Exito!',
                            'sms' => "Se ha enviado una contraseña temporal al correo electronico corporativo asignado al usuario: $username!",
                        );
                    } else {
                        $data_response = array(
                            'response' => 'warning',
                            'title' => 'Advertencia!',
                            'sms' => "Ha ocurrido un error al enviar una contraseña temporal al correo electronico corporativo asignado al usuario: $username!, intente nuevamente o contate con el departamento de SISTEMAS",
                        );
                    }
                } else {
                    $data_response = array(
                        'response' => 'warning',
                        'title' => 'Advertencia!',
                        'sms' => "Ha ocurrido un error al intentar restablecer la contraseña, intente nuevamente o contacter con el departamento de SISTEMAS!",
                    );
                }
            } else {
                $data_response = array(
                    'response' => 'error',
                    'title' => 'Error!',
                    'sms' => "El usuario <strong>$username</strong> ingresado no existe!",
                );
            }
        } else {
            $data_response = array(
                'response' => 'warning',
                'title' => 'Advertencia!',
                'sms' => 'Campo de usuario vacio',
            );
        }

        echo json_encode($data_response);
    }
    /* sendEmail recibe como parametro el correo del usuario! */
    public function sendEmail($username, $mail_address, $token_pass)
    {

        $data_usuario = array(
            'name_user' => $username,
            'new_password' => $token_pass,
        );

        $correo = $this->phpmailer_lib->load();
        // SMTP configuration
        $correo->IsSMTP();
        /* $correo->SMTPDebug = 1; */
        $correo->SMTPAuth = true;
        $correo->SMTPSecure = 'tls';
        $correo->Host = "mail.aftersalesassistance.com";
        $correo->Port = 587;
        $correo->IsHTML(true);
        $correo->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );
        $correo->Username = "no-reply@aftersalesassistance.com";
        $correo->Password = 'N}mT=JzE,D$g';
        $correo->SetFrom("developer@aftersalesassistance.com", "SEELDEC"); // CONFIGURAR CORREO PARA ENVIAR MENSAJES DE NO RESPUESTA! :XD
        $correo->addAddress($mail_address);
        /* $correo->addAddress('jjairo0813@gmail.com'); */
        $correo->Subject = "Restablecer contraseña";
        $correo->CharSet = 'UTF-8';

        $mensaje = $this->load->view('mails/restablecer_contrasena', $data_usuario, true);
        $correo->MsgHTML($mensaje);

        return $correo->send();
    }
}
