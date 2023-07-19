<?php

class PermisosModel extends CI_Model
{

    public function get_perfiles()
    {
        return $this->db->get('perfiles');
    }

    public function getmenus()
    {
        return $this->db->get('menus');
    }



























    public function consulta()
    {
        $result = $this->db->list_tables();
        //print_r($result);
        //echo $result[8] = perfiles. '<br/>' . $result[9] = perfiles_menus . '<br/>' . $result[10] = perfiles_submenus . '<br/>';
        echo $result[8] . '<br/>';
        $fields = $this->db->list_fields($result[10]);
        echo '<br/>';
        foreach ($fields as $row) {
            echo $row . '<br/>';
        }
        echo '<br/>';
        $fields = $this->db->field_data($result[10]);

        foreach ($fields as $field) {
            echo $field->name . '<br/>';
            echo $field->type . '<br/>';
            echo $field->max_length . '<br/>';
            echo $field->primary_key . '<br/>';
        }
        $consulta = $this->db->query('select * from perfiles_submenus')->result();
        print_r($consulta);
        /*   foreach ($consulta as $row) {
            echo $row->usuario;
        } */
    }

    public function altertable()
    {
        $query = $this->db->query("alter table perfiles_menus add column enyimber varchar(50) ");
        return ($query);
    }

    public function dropcolunm()
    {
        $query = $this->db->query("alter table perfiles_menus drop column enyimber ");
        return ($query);
    }
    public function perfiles_menus()
    {
        $consulta = $this->db->get('perfiles_menus');
        foreach ($consulta->result() as $row) {
            echo $row->id_p_m;
            echo $row->perfil_id;
            echo $row->menu_id . '<br/>';
        }
    }
}
