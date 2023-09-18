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
}