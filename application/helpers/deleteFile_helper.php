<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}


function deteleImgEmpleado($path_to_file)
{
    if (unlink($path_to_file)) {
        $array_response = array(
            'response' => 'success',
            'sms' => 'Archivo eliminado correctamente'
        );
    } else {
        $array_response = array(
            'response' => 'error',
            'sms' => 'Error al eliminar el archivo'
        );
    }

    return json_encode($array_response);
}

function deleteFile($path_to_file)
{
    if (file_exists($path_to_file)) {
        if(unlink($path_to_file)){
            $result = 1;
        }else {
            $result = 2;
        }
    } else {
        $result = 3 . "/" . $path_to_file;
    }
}
