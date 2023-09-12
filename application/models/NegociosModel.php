<?php 
class NegociosModel extends CI_Model
{
    public function get_etapas_negocio()
    {
        return $this->db->get('etapas_negocio');
    }

    public function create_negocios($data_insert)
    {
        $this->db->insert('negocios',$data_insert);
        return $this->db->insert_id();
    }

    public function getNegocio($where)
    {
        $this->db->where($where);
        return $this->db->get('negocios');
    }


}