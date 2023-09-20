<?php
class NegociosModel extends CI_Model
{
    public function get_etapas_negocio()
    {
        return $this->db->get('etapas_negocio');
    }

    public function create_negocios($data_insert)
    {
        $this->db->insert('negocios', $data_insert);
        return $this->db->insert_id();
    }

    public function getNegocio($where)
    {
        $this->db->where($where);
        return $this->db->get('negocios');
    }

    public function checkEtapa($where)
    {
        $this->db->where($where);
        return $this->db->get('negocios_historial_etapas ');
    }

    public function updateNegocio($data_update, $data_where)
    {
        $this->db->update('negocios', $data_update, $data_where);
        return $this->db->affected_rows();
    }

    public function insertHistorialEtapa($data)
    {
        return $this->db->insert('negocios_historial_etapas', $data);
    }

    public function insertSolicitudCliente($data)
    {
        return $this->db->insert('negocios_solicitud_cliente', $data);
    }

    public function get_negocios_solicitud_cliente($where)
    {
        $this->db->where($where);
        return $this->db->get('negocios_solicitud_cliente');
    }

    public function getNegociosAll($data_where)
    {
        $this->db->select('n.id_negocio,t.id as id_tercero_cli,
        cli.id_cliente,
        t.nit as nit_cliente,
        concat (t.primer_nombre," ",t.segundo_nombre," ", t.primer_apellido," ",t.segundo_apellido) as nombre_cliente,
        concat (t_emp.primer_nombre," ",t_emp.segundo_nombre," ", t_emp.primer_apellido," ",t_emp.segundo_apellido) as nombre_asesor,
        n.fecha_registro,
        s.prospecto,
        n.solicitud_id
        ');
        $this->db->from('negocios as n');
        $this->db->join('solicitudes_prospecto as s', 's.id_solicitud = n.solicitud_id');
        $this->db->join('tipo_solicitudes as ts', 's.id_tipo_solicitud = ts.id_tipo');
        $this->db->join('clientes as cli', 'n.cliente_id = cli.id_cliente','left');
        $this->db->join('terceros as t', 'cli.id_tercero = t.id','left');
        $this->db->join('municipios as m', 't.id_municipio = m.id','left');
        $this->db->join('departamentos as d', 'm.id_dpto = d.id','left');
        $this->db->join('usuarios as u', 'n.user_crea= u.id_user');
        $this->db->join('empleados as e', 'u.empleado_id = e.id');
        $this->db->join('terceros as t_emp', 'e.id_tercero = t_emp.id','left');
        $this->db->where($data_where);
        return $this->db->get();
    }


}