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

    public function getUserByNameUser($data_where)
    {
        return $this->db->get_where('usuarios', $data_where);
    }

    public function updateUsuario($data_where, $data_update)
    {
        return $this->db->update('usuarios', $data_update, $data_where);
    }

    public function getEstadosUsuario()
    {
        return $this->db->get('estados');
    }

    public function getAsesoresActivos()
    {
        $sql = "SELECT 
            CONCAT (t.primer_nombre,' ',t.segundo_nombre,' ',t.primer_apellido,' ',t.segundo_apellido) as nombres,
            u.id_user
            FROM terceros t 
            INNER JOIN empleados e ON e.id_tercero = t.id
            INNER JOIN perfiles p ON p.id_perfil = e.id_cargo
            INNER JOIN usuarios u ON u.empleado_id = e.id
            WHERE u.perfil_id = 2 AND u.estado_id = 1";
        return $this->db->query($sql);
    }
}
