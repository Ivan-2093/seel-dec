<?php
class InformesController extends CI_Controller
{

    public $html_menus = NULL;
    public $perfil = NULL;
    public $user_id = NULL;

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('login')) {
            $this->session->sess_destroy();
            header("Location: " . base_url());
        }
        $this->load->helper('permisos_url_helper');
        $this->perfil = $this->session->userdata('perfil');
        $this->user_id = $this->session->userdata('id_user');
        validate_url_permiso_perfil($this->perfil);
        $this->load->model('MenusModel');
        $this->load->model('InformesModel');
        $this->load->helper('menu_helper');
        $this->load->library('phpmailer_lib');

        $data_where_menus = array(
            'pm.perfil_id' => $this->perfil,
        );

        $data_menus = $this->MenusModel->getMenusByPerfil($data_where_menus);
        $this->html_menus = createMenuByPerfil($data_menus);
    }
    public function informe_agenda()
    {

        $data_tecnicos = $this->InformesModel->get_tecnicos();

        $data_vista = array(
            'data_menus' => $this->html_menus,
            'name_page' => 'INFORME AGENDA',
            'data_tecnicos' => $data_tecnicos
        );
        $this->load->view('header', $data_vista);
        $this->load->view('informes/agenda');
    }

    public function informe_solicitudes()
    {

        $data_vista = array(
            'data_menus' => $this->html_menus,
            'name_page' => 'INFORME SOLICITUDES',
        );
        $this->load->view('header', $data_vista);
        $this->load->view('informes/solicitudes');
    }
    public function informe_negocios()
    {

        $data_vista = array(
            'data_menus' => $this->html_menus,
            'name_page' => 'INFORME NEGOCIOS',
        );
        $this->load->view('header', $data_vista);
        $this->load->view('informes/negocios');
    }

    public function informe_productos()
    {

        $data_vista = array(
            'data_menus' => $this->html_menus,
            'name_page' => 'INFORME PRODUCTOS',
        );
        $this->load->view('header', $data_vista);
        $this->load->view('informes/productos');
    }

    /* ***************************  LOAD DATA INFORME *************************************** */

    public function load_informe_agenda()
    {
        $where = array();
        //Filtros
        if (count($this->input->POST()) > 0) {
            if ($this->input->POST('date_start')) {
                $where['fecha_cita >='] = $this->input->POST('date_start');
            }

            if ($this->input->POST('date_end')) {
                $where['fecha_cita >='] = $this->input->POST('date_end');
            }

            if (($this->input->POST('input_estado'))) {
                $where['estado'] = $this->input->POST('input_estado');
            }

            if ($this->input->POST('input_tecnico')) {
                $where['tecnico'] = $this->input->POST('input_tecnico');
            }
        }

        $data_citas = $this->InformesModel->get_citas_all($where);
        /* print_r($this->db->last_query()); */
        $tbody = '';
        if ($data_citas->num_rows() > 0) {
            foreach ($data_citas->result() as $row) {

                switch ($row->estado) {
                    case 1:
                        $estado_cita = 'AGENDADA';
                        break;
                    case 2:
                        $estado_cita = 'EN PROCESO';
                        break;
                    case 3:
                        $estado_cita = 'FINALIZADA';
                        break;
                    case 4:
                        $estado_cita = 'REPROGRAMADA';
                        break;
                    case 4:
                        $estado_cita = 'CANCELADA';
                        break;
                    default:
                        $estado_cita = '--';
                        break;
                }

                $tbody .=
                    '<tr>
                    <td class="text-center">' . $row->id_cita . '</td>
                    <td class="text-center">' . $row->fecha_cita . '</td>
                    <td class="text-center">' . $estado_cita . '</td>
                    <td class="text-center">' . ($row->fecha_ejecucion != "" ? $row->fecha_ejecucion : '--')  . '</td>
                    <td class="text-center">' . ($row->fecha_final != "" ? $row->fecha_final : '--')  . '</td>
                    <td class="text-center">' . ($row->observacion != "" ? $row->observacion : '--')  . '</td>
                </tr>';
            }
        }

        $array_response = array('tbody' => $tbody);

        echo json_encode($array_response);
    

    }
}
