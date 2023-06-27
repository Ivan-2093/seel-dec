<?php
class TercerosModel extends CI_Model 
{
    public function getTipoDocumentos(){
        return $this->db->get('tipo_documentos');
    }

    public function getGeneros(){
        return $this->db->get('generos');
    }

    public function getTerceros(){
        $this->db->select();
        $this->db->select('t.id as id_tercero');
        $this->db->from('terceros as t');
        $this->db->join('tipo_documentos as td', 't.id_tipo_doc = td.id');
        $this->db->join('generos as g', 't.id_genero = g.id');
        $this->db->join('municipios as m', 't.id_municipio = m.id');
        $this->db->join('departamentos as d', 'm.id_dpto = d.id');
        $this->db->join('paises as p', 'd.id_pais = p.id');
        return $this->db->get();
    }

    public function getTerceroByNumeroDoc($numero_documento){
        $this->db->where('nit',$numero_documento);
        return $this->db->get('terceros');
    }

    public function getTerceroById($id_tercero){
        $this->db->where('id',$id_tercero);
        return $this->db->get('terceros');
    }

    public function createTercero($data_insert){
        return $this->db->insert('terceros',$data_insert);
    }
}