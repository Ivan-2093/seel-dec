<?php
class PermisosModel extends CI_Model 
{
    public function getPerfiles()
    {
        return $this->db->get('perfiles');
    }
}