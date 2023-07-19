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
                'usuario' => $username
            );

            $data_user = $this->UsuariosModel->getUserByNameUser($data_where);

            if ($data_user->num_rows() > 0) {

                if (password_verify($password, $data_user->row(0)->contrasena)) {
                    /* print_r($data_user->result()); */
                    $data_whereEmp = array('e.id' => $data_user->row(0)->empleado_id);
                    $data_empleado = $this->EmpleadosModel->getEmpleadosByIdEmpleado($data_whereEmp);


                    $data = array(
                        'user' => $data_user->row(0)->usuario,
                        'nombres' => $data_empleado->row(0)->nombres,
                        'perfil' => $data_user->row(0)->perfil_id,
                        'id_user' => $data_user->row(0)->id_user,
                        'img_user' => $data_empleado->row(0)->foto_perfil,
                        'change_password' => $password == $data_empleado->row(0)->nit ? 1 : 0,
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
                $this->sendEmail($data_empleado->row(0)->correo,$data_empleado->row(0)->primer_nombre ." " . $data_empleado->row(0)->primer_apellido,$data_empleado->row(0)->nit);
            } else {
            }
        } else {
        }
    }
    /* sendEmail recibe como parametro el correo del usuario! */
    public function sendEmail($mail_address,$username,$token_pass)
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
        $correo->Username = "developer@aftersalesassistance.com";
        $correo->Password = "kA0&!7cQ(ws(";
        $correo->SetFrom("developer@aftersalesassistance.com", "SEELDEC");// CONFIGURAR CORREO PARA ENVIAR MENSAJES DE NO RESPUESTA! :XD
        $correo->addAddress($mail_address);
        /* $correo->addAddress('jjairo0813@gmail.com'); */
        $correo->Subject = "Restablecer contraseña";
        $correo->CharSet = 'UTF-8';

        $mensaje = $this->load->view('mails/restablecer_contrasena',$data_usuario,true);
        $correo->MsgHTML($mensaje);
        $correo->send();
    }
}
