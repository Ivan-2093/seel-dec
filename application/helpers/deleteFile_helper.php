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

        /* $path_to_file = 'public/empleados/' . $inputIdTercero . '.jpg'; */
        /* echo deteleImgEmpleado($path_to_file); */ //Funcion para eliminar un archivo 
