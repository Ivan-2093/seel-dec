<?php
class LoginController extends CI_Controller
{

    public function __construct() //define el constructor
    {
        parent::__construct(); //invoca al constructor de la clase superior
        $this->load->model('UsuariosModel'); //carga un modelo con el nombre de Usuarios“  
    }
    public function index()
    {        /* print_r($this->session->userdata()); */
        $this->load->view('login/login');
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
                    $data = array(
                        'user' => $data_user->row(0)->usuario,
                        'perfil' => $data_user->row(0)->perfil_id,
                        'id_user' => $data_user->row(0)->id_user,
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
}
