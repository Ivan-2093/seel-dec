<?php 
class ProspectosModel extends CI_Model
{
    public function insertSolicitudProspecto($array_insert)
    {
        return $this->db->insert('solicitudes_prospecto',$array_insert);
    }
    public function getSolicitudes($data_where)
    {
        $this->db->select('s.id_solicitud, s.prospecto, s.telefono, s.correo, m.municipio, s.direccion, s.observacion, u.usuario ,ts.tipo_solicitud, s.fecha_creado, n.id_negocio, n.cliente_id, n.fecha_registro');
        $this->db->from('solicitudes_prospecto as s');
        $this->db->join('municipios as m', 's.id_municipio = m.id');
        $this->db->join('departamentos as d', 'm.id_dpto = d.id');
        $this->db->join('usuarios as u', 'u.usuario = s.usuario');
        $this->db->join('empleados as e', 'u.empleado_id = e.id');
        $this->db->join('terceros as t', 'e.id_tercero = t.id');
        $this->db->join('tipo_solicitudes as ts', 's.id_tipo_solicitud = ts.id_tipo');
        $this->db->join('negocios as n', 's.id_solicitud = n.solicitud_id','left');
        $this->db->where('n.estado is null');
        $this->db->where($data_where);
        return $this->db->get();
    }
    public function getSolicitudesByWhere($data_where)
    {
        $this->db->select('s.id_solicitud, s.prospecto, s.telefono, s.correo, m.municipio, s.direccion, s.observacion, u.usuario ,ts.tipo_solicitud, s.fecha_creado, n.id_negocio, n.cliente_id, n.fecha_registro');
        $this->db->from('solicitudes_prospecto as s');
        $this->db->join('municipios as m', 's.id_municipio = m.id');
        $this->db->join('departamentos as d', 'm.id_dpto = d.id');
        $this->db->join('usuarios as u', 'u.usuario = s.usuario');
        $this->db->join('empleados as e', 'u.empleado_id = e.id');
        $this->db->join('terceros as t', 'e.id_tercero = t.id');
        $this->db->join('tipo_solicitudes as ts', 's.id_tipo_solicitud = ts.id_tipo');
        $this->db->join('negocios as n', 's.id_solicitud = n.solicitud_id','left');
        $this->db->where($data_where);
        return $this->db->get();
    }

    public function getSolcitudByWhere($data_where)
    {
        $this->db->where($data_where);
        return $this->db->get('solicitudes_prospecto');
    }


}
