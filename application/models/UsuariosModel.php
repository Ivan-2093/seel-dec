<?php
class UsuariosModel extends CI_Model 
{
    public function getTipoDocumentos(){
        return $this->db->get('tipo_documentos');
    }

    public function getGeneros(){
        return $this->db->get('generos');
    }

    public function getTerceros(){
        $this->db->join('tipo_documentos', 'terceros.id_tipo_doc = tipo_documentos.id');
        $this->db->join('generos', 'terceros.id_genero = generos.id');
        $this->db->join('municipios', 'terceros.id_municipio = municipios.id');
        $this->db->join('departamentos', 'municipios.id_dpto = departamentos.id');
        $this->db->join('paises', 'departamentos.id_pais = paises.id');
        return $this->db->get('terceros');
    }

    public function getTerceroByNumeroDoc($numero_documento){
        $this->db->where('nit',$numero_documento);
        return $this->db->get('terceros');
    }

    public function createTercero($data_insert){
        return $this->db->insert('terceros',$data_insert);
    }
}