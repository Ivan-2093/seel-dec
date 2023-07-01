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
    public function getUsuarios()
    {
        $this->db->select('*,es.id as id_estado, e.id as id_empleado, ca.id as id_cargo_empleado, s.id as id_sede, t.id as id_tercero');
        $this->db->from('usuarios as u');
        $this->db->join('perfiles as p', 'u.perfil_id = p.id_perfil');
        $this->db->join('estados as es', 'u.estado_id = es.id');
        $this->db->join('empleados as e', 'u.empleado_id = e.id');
        $this->db->join('cargo_empleados as ca', 'e.id_cargo = ca.id');
        $this->db->join('sedes as s', 'e.id_sede = s.id');
        $this->db->join('terceros as t', 'e.id_tercero = t.id', 'left');
        return $this->db->get();
    }
    public function insertUsuario($data_insert)
    {
        return $this->db->insert('usuarios', $data_insert);
    }
}
