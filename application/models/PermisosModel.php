<?php

class PermisosModel extends CI_Model
{

    public function consulta()
    {
        $result = $this->db->list_tables();
        echo $result[9] . '<br/>';
        $fields = $this->db->list_fields($result[9]);

        foreach ($fields as $field) {
            echo $field . '<br/>';
        }
        $fields = $this->db->field_data($result[9]);

        foreach ($fields as $field) {
            echo $field->name . '<br/>';
            echo $field->type . '<br/>';
            echo $field->max_length . '<br/>';
            echo $field->primary_key . '<br/>';
        }
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
}
