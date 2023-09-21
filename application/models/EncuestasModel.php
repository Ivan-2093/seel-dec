<?php
class EncuestasModel extends CI_Model
{
    public function insert_encuesta_satisfacion($data)
    {
        return $this->db->insert('encuesta_satisfacion',$data);
    }

    public function correo_notificacion_encuesta($data)
    {
        return $this->db->insert('correo_notificacion_encuesta',$data);
    }

    public function load_encuesta_satisfacion($where)
    {
        $this->db->where($where);
        return $this->db->get('encuesta_satisfacion');
    }
}