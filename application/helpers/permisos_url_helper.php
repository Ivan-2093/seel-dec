<?php

function validate_url_permiso_perfil($perfil)
{
    $CI = &get_instance();
    $CI->load->model('MenusModel');
    $url_actual = $CI->uri->rsegments;
    if ($url_actual[2] === 'index') {
        $url_actual = str_replace(' ', '', $url_actual[1]);
    } else {
        $url_actual = str_replace(' ', '', $url_actual[1] . '/' . $url_actual[2]);
    }

    $data_where = array(
        'path' => $url_actual,
        'perfil_id' => $perfil
    );

    if ($CI->MenusModel->getSubmenusByPerfil($data_where)->num_rows() == 0) {
        header("Location: " . base_url() . "acceso_denegado");
    }
}
