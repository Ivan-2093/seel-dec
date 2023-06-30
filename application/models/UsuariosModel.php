<?php
class UsuariosModel extends CI_Model
{
    public function getPerfiles()
    {
        return $this->db->get('perfiles');
    }
    public function getUsuariosByIdEmpleado($data_where)
    {
        return $this->db->get_where('usuarios', $data_where);
    }
    public function insertUsuario($data_insert)
    {
        return $this->db->insert('usuarios', $data_insert);
    }
}
