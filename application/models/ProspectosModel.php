<?php 
class ProspectosModel extends CI_Model
{
    public function insertSolicitudProspecto($array_insert)
    {
        return $this->db->insert('solicitudes_prospecto',$array_insert);
    }
    public function getSolicitudes()
    {
        $this->db->select('s.id_solicitud, s.prospecto, s.telefono, s.correo, m.municipio, s.direccion, s.observacion, t.primer_nombre, t.primer_apellido,ts.tipo_solicitud, s.fecha_creado');
        $this->db->from('solicitudes_prospecto as s');
        $this->db->join('municipios as m', 's.id_municipio = m.id');
        $this->db->join('departamentos as d', 'm.id_dpto = d.id');
        $this->db->join('usuarios as u', 'u.usuario = s.usuario');
        $this->db->join('empleados as e', 'u.empleado_id = e.id');
        $this->db->join('terceros as t', 'e.id_tercero = t.id');
        $this->db->join('tipo_solicitudes as ts', 's.id_tipo_solicitud = ts.id_tipo');
        return $this->db->get();
    }


}