<?php
class InformesModel extends CI_Model
{
    public function get_tecnicos()
    {
        $this->db->select('concat(t.primer_nombre," ",t.segundo_nombre," ",t.primer_apellido," ",t.segundo_apellido) as nombre_tecnico, t.nit');
        $this->db->from('usuarios as u');
        $this->db->join('empleados as emp', 'u.empleado_id = emp.id');
        $this->db->join('terceros as t', 'emp.id_tercero = t.id');
        $this->db->where('u.perfil_id', 3);
        return $this->db->get();
    }

    public function get_asesores()
    {
        $this->db->select('concat(t.primer_nombre," ",t.segundo_nombre," ",t.primer_apellido," ",t.segundo_apellido) as nombre_asesor, u.id_user');
        $this->db->from('usuarios as u');
        $this->db->join('empleados as emp', 'u.empleado_id = emp.id');
        $this->db->join('terceros as t', 'emp.id_tercero = t.id');
        $this->db->where('u.perfil_id', 2);
        return $this->db->get();
    }

    public function get_citas_all($array_where)
    {
        $this->db->where($array_where);
        $this->db->order_by('fecha_cita', 'desc');
        return $this->db->get('agenda_citas');
    }
}
