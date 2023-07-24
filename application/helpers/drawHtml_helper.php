<?php

function drawOptionsSelectHtml($data)
{

    $OptionSelectMenu = "<option value=''>SELECCIONE UN PERFIL</option>";
    if ($data->num_rows() > 0) {
        foreach ($data->result() as $row) {
            $OptionSelectMenu  .= '<option value="' . $row->id_perfil . '">' . $row->perfil . '</option>';
        }
    }

    return $OptionSelectMenu;
}
