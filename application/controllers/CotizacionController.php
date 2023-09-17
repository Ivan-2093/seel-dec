<?php
defined('BASEPATH') or exit('No direct script access allowed');

use Mpdf\Writer\BackgroundWriter;
use PhpOffice\PhpSpreadsheet\Worksheet\PageMargins;

class CotizacionController extends CI_Controller
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
        $this->load->helper('permisos_url_helper');
        $this->perfil = $this->session->userdata('perfil');
        validate_url_permiso_perfil($this->perfil);
        $this->load->model('MenusModel');
        $this->load->library('session');
        $this->load->model('UsuariosModel');
        $this->load->model('ProspectosModel');
        $this->load->model('ProductosModel');
        $this->load->model('CotizacionModel');
        $this->load->helper('menu_helper');
        $this->load->library('phpmailer_lib');

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
            'name_page' => 'COTIZADOR'
        );

        $id_negocio = $this->input->post('id_negocio');

        if ($id_negocio != "") {
          /*   $where = array('id_negocio' => $id_negocio);
            $data_vista['data_solicitudes'] = $data_solicitudes->row(0); */
        }

        $this->load->view('header', $data_vista);
        $this->load->view('cotizador/solicitud');
    }

    public function load_productos()
    {
        $where1 = array('id_categoria' => 1);
        $where2 = array('id_categoria' => 2);
        $where3 = array('id_categoria' => 3);

        $data_productosC1 = $this->ProductosModel->getProductosByWhere($where1);
        $data_productosC2 = $this->ProductosModel->getProductosByWhere($where2);
        $data_productosC3 = $this->ProductosModel->getProductosByWhere($where3);

        $tbodyC1 = '';
        $tbodyC2 = '';
        $tbodyC3 = '';

        /*  <td>' . $key->medidad . '</td>
        <td>' . $key->anchos_tela_metro . '</td>
        <td>' . $key->factor_apertura . '</td> */



        if ($data_productosC1->num_rows() > 0) {
            foreach ($data_productosC1->result() as $key) {

                $referencia = str_replace(',', '.', $key->referencia);
                $referencia = str_replace('"', ' pulgada', $referencia);
                $referencia = preg_replace("[\n|\r|\n\r]", "", $referencia);
                $costo_elite = $key->costo_elite != "" ? $key->costo_elite * (($key->porce_precio / 100) + 1) : 'N/A';
                $costo_premium = $key->costo_premium != "" ? $key->costo_premium * (($key->porce_precio / 100) + 1) : 'N/A';
                $tbodyC1 .= '<tr>
                <td class="text-center">' . $key->id_producto . '</td>
                <td>' . $referencia . '</td>
                <td>' . $key->descripcion . '</td>
                <td class="text-right">$' . number_format(($costo_elite), 0, '.', ',') . '</td>
                <td class="text-right">$' . number_format(($costo_premium), 0, '.', ',') . '</td>
                <td>' . $key->tipo . '</td>
                <td class="text-center">
                    <button data=\'["' . $key->id_producto . '","' . $referencia . '","' . $costo_elite . '","' . $costo_premium . '"]\' data-toggle="tooltip" data-placement="top" title="AGREGAR" type="button" class="btn btn-primary ik ik-file-plus" onclick="add_producto(this);"></button>
                </td>
                </tr>';
            }
        }

        if ($data_productosC2->num_rows() > 0) {
            foreach ($data_productosC2->result() as $key) {
                $referencia = str_replace(',', '.', $key->referencia);
                $referencia = str_replace('"', ' pulgada', $referencia);
                $referencia = preg_replace("[\n|\r|\n\r]", "", $referencia);
                $costo_elite = $key->costo_elite != "" ? $key->costo_elite * (($key->porce_precio / 100) + 1) : 'N/A';
                $costo_premium = $key->costo_premium != "" ? $key->costo_premium * (($key->porce_precio / 100) + 1) : 'N/A';
                $tbodyC2 .= '<tr>
                <td class="text-center">' . $key->id_producto . '</td>
                <td>' . $referencia . '</td>
                <td>' . $key->descripcion . '</td>
                <td>' . $key->pasadores . '</td>
                <td>' . $key->cerradura . '</td>
                <td>' . $key->llaves . '</td>
                <td>' . $key->tipo_seguridad . '</td>
                <td class="text-right">$' . number_format(($costo_elite), 0, '.', ',') . '</td>
                <td class="text-right">$' . number_format(($costo_premium), 0, '.', ',') . '</td>
                <td>' . $key->tipo . '</td>
                <td class="text-center"><button data=\'["' . $key->id_producto . '","' . $referencia . '","' . $costo_elite . '","' . $costo_premium . '"]\' data-toggle="tooltip" data-placement="top" title="AGREGAR" type="button" class="btn btn-primary ik ik-file-plus" onclick="add_producto(this);"></button></td>
                </tr>';
            }
        }

        if ($data_productosC3->num_rows() > 0) {
            foreach ($data_productosC3->result() as $key) {
                $referencia = str_replace(',', '.', $key->referencia);
                $referencia = str_replace('"', ' pulgada', $referencia);
                $referencia = preg_replace("[\n|\r|\n\r]", "", $referencia);
                $costo_elite = $key->costo_elite != "" ? $key->costo_elite * (($key->porce_precio / 100) + 1) : 'N/A';
                $costo_premium = $key->costo_premium != "" ? $key->costo_premium * (($key->porce_precio / 100) + 1) : 'N/A';
                $tbodyC3 .= '<tr>
                <td class="text-center">' . $key->id_producto . '</td>
                <td>' . $referencia . '</td>
                <td>' . $key->descripcion . '</td>
                <td>' . $key->pasadores . '</td>
                <td>' . $key->cerradura . '</td>
                <td>' . $key->llaves . '</td>
                <td>' . $key->tipo_seguridad . '</td>
                <td class="text-right">$' . number_format(($costo_elite), 0, '.', ',') . '</td>
                <td class="text-right">$' . number_format(($costo_premium), 0, '.', ',') . '</td>
                <td>' . $key->tipo . '</td>
                <td class="text-center"><button data=\'["' . $key->id_producto . '","' . $referencia . '","' . $costo_elite . '","' . $costo_premium . '"]\' data-toggle="tooltip" data-placement="top" title="AGREGAR" type="button" class="btn btn-primary ik ik-file-plus" onclick="add_producto(this);"></button></td>
                </tr>';
            }
        }



        $array_response = array(
            'tbodyC1' => $tbodyC1,
            'tbodyC2' => $tbodyC2,
            'tbodyC3' => $tbodyC3,
        );
        echo json_encode($array_response);
    }

    public function saveInfoCotizacion()
    {
        $idSolicitud = $this->input->POST('idSolicitud');
        $cantidadFilas = $this->input->POST('cantidadFilas');

        if ($idSolicitud != "") {
            $array_where_pros = array(
                'id_solicitud' => $idSolicitud
            );
            $solicitud_prospecto = $this->ProspectosModel->getSolcitudByWhere($array_where_pros);

            if ($solicitud_prospecto->num_rows() > 0) {
                $array_insert_cotizacion = array(
                    'solicitud_id' => $idSolicitud,
                    'usuario_id' => $this->session->userdata('id_user'),
                    'fecha_registro' => Date('Y-m-d') . 'T' . Date('H:i:s')
                );

                if ($this->CotizacionModel->insert_cotizacion($array_insert_cotizacion)) {

                    $id_cotizacion = $this->db->insert_id();

                    $dataFilas = [];
                    $insert_detalle = 0;
                    for ($i = 0; $i < $cantidadFilas; $i++) {

                        $dataFilas[$i] = $this->input->POST('fila' . $i);
                        $fila = explode(",", $dataFilas[$i]);

                        $array_insert_detalle = array(
                            'cotizacion_id' => $id_cotizacion,
                            'producto_id' => $fila[0],
                            'cant_producto' => $fila[1],
                            'precio_producto' => $fila[3]
                        );

                        if ($this->CotizacionModel->insert_cotizacion_detalle($array_insert_detalle)) {
                            $insert_detalle++;
                        }
                    }

                    $sendEmail = $this->sendEmailCotizacion($id_cotizacion);

                    if($id_cotizacion == $sendEmail){
                        $array_response = array(
                            'response' => 'success',
                            'title' => 'Exito!',
                            'html' => 'Se ha realizado con exito el registro de la cotización',
                        );
                        echo json_encode($array_response);
                        exit;
                    }

                   
                } else {
                    $array_response = array(
                        'response' => 'error',
                        'title' => 'Error!',
                        'html' => 'Ha ocurrido un error al intentar realizar el registro de la cotización',
                    );
                    echo json_encode($array_response);
                    exit;
                }
            } else {
                $array_response = array(
                    'response' => 'warning',
                    'title' => 'Advertencia!',
                    'html' => 'La solicitud del cliente no se encuentra registrada en la base de datos',
                );
                echo json_encode($array_response);
                exit;
            }
        } else {
            $array_response = array(
                'response' => 'warning',
                'title' => 'Advertencia!',
                'html' => 'No se ha encontrado la identificacion de la solicitud del cliente.',
            );
            echo json_encode($array_response);
            exit;
        }
    }

    public function sendEmailCotizacion($id_cotizacion = null)
    {

        if (isset($id_cotizacion) && $id_cotizacion != "") {
            $array_where = array('id_cotizacion' => $id_cotizacion);
            $array_where_detalle = array('cotizacion_id' => $id_cotizacion);

            $data_cotizacion = $this->CotizacionModel->get_cotizacion_by_where($array_where);

            if ($data_cotizacion->num_rows() == 0) {
                echo 'No se ha encontrado información con la identificación de la cotización';
                exit();
            }

            $data_cotizacion_detalle = $this->CotizacionModel->get_cotizacion_detalle_by_where($array_where_detalle);

            $pdfEmail = $this->createPdfCotizacion($data_cotizacion, $data_cotizacion_detalle);


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
            // CONFIGURAR CORREO PARA ENVIAR MENSAJES DE NO RESPUESTA! :XD
            $correo->SetFrom($data_cotizacion->row(0)->email_emp, "SEELDEC");
            $correo->addAddress($data_cotizacion->row(0)->email_emp);
            $correo->addAddress($data_cotizacion->row(0)->correo_cli);
            /* $correo->addAddress('jjairo0813@gmail.com'); */
            $correo->Subject = "Cotización";
            $correo->CharSet = 'UTF-8';

            $correo->AddStringAttachment($pdfEmail, 'Cotizacion.pdf', 'base64', 'pdf');

            $data_usuario = array(
                'name_user' => $data_cotizacion->row(0)->prospecto,
                'page' => 'Cotización'
            );

            $mensaje = $this->load->view('mails/cotizacion', $data_usuario, true);


            $correo->MsgHTML($mensaje);


            if (!$correo->Send()) {
                echo 'Hubo un error: ' . $correo->ErrorInfo;
            } else {

                $array_insert_correo = array(
                    'cotizacion_id' => $id_cotizacion,
                    'usuario_id' => $this->session->userdata('id_user'),
                    'fecha_envio' => Date('Y-m-d') . 'T' . Date('H:i:s')
                );

                $this->CotizacionModel->insert_correo_noti_cotizacion($array_insert_correo);

                return $id_cotizacion;
            }
        }
    }
    public function createPdfCotizacion($data_cotizacion, $data_cotizacion_detalle)
    {
        if ($data_cotizacion->num_rows() > 0) {

            //Parametros
            $data = array(
                'dataCotizacion' => $data_cotizacion,
                'dataCotizacionDetalle' => $data_cotizacion_detalle,
            );

            // Cargar libreria de PDF
            $mpdfConfig = array(
                'mode' => 'utf-8',
                'format' => 'A4',    // format - A4, for example, default ''
                //'default_font_size' => 0,     // font size - default 0
                //'default_font' => 'Helveltica',    // default font family
                'margin_left' => 5,      // 15 margin_left
                'margin_right' => 5,      // 15 margin right
                'margin_top' =>  30,   // 16 margin top
                'margin_bottom' => 22,    // margin bottom contra el footer
                'margin_header' => 5,     // 9 margin header-
                'margin_footer' => 3,     // 9 margin footer
                'orientation' => 'P'    // L - landscape, P - portrait
            );
            $mpdf = new \Mpdf\Mpdf($mpdfConfig);


            $html_header =
                '<table>
                <tr>
                    <td>
                        <img src="plantilla/img/icons/logo-seeldec.jpeg" height="80px"/>
                    </td>
                    <td style="text-align: center">
                        <table>
                            <tr>
                                <td>SEGURIDAD ELECTRONICA Y DECORACIÓN</td>
                            </tr>
                            <tr>
                                <td>NIT: 28070225-1</td>
                            </tr>
                            <tr>
                                <td></td>
                            </tr>
                        </table>
                    </td>
                    <td></td>
                </tr>
                <tr><td style="text-align: center" colspan="3">COTIZACIÓN</td></tr>
            </table>';

            $html_footer = '<p style="text-align:justify; font-size:12px"><b>*</b><i>Validez de la oferta 10 días.</i></p>
            <table width="100%">
                                    <tr>
                                        <td width="33%"></td>
                                        <td width="33%" align="center">{PAGENO}/{nbpg}</td>
                                        <td width="33%" style="text-align: right;"></td>
                                    </tr>
            </table>';


            $mpdf->SetHTMLHeader($html_header);
            $mpdf->SetHTMLFooter($html_footer);

            $stylesheet = file_get_contents('application/views/cotizador/styles.css');

            $html = $this->load->view('cotizador/ficha_tecnica', $data, true);

            $mpdf->SetWatermarkImage('plantilla/img/icons/logo-seeldec.jpeg', 0.1, 'F');
            $mpdf->showWatermarkImage = true;

            $mpdf->WriteHTML($stylesheet, 1);
            $mpdf->WriteHTML($html, 2);
            $pdfEmail = $mpdf->Output('Cotizacion.pdf', 'S');
            /* $mpdf->Output('Cotizacion.pdf', 'I'); */

            return $pdfEmail;
        }
    }
}
