<?php
class UsuarioModel extends CI_Model 
{
    public function getUsuarioByUserName(){
        return $this->db->get('municipios');
    }

    public function getTipoDocumentos(){
        return $this->db->get('tipo_documentos');
    }

    public function getPaises(){
        return $this->db->get('paises');
    }

    public function getDeptoByIdPais($id_pais){
        $this->db->where('id_pais',$id_pais);
        return $this->db->get('departamentos');
    }

    public function getMunicipioByIdDepto($id_dpto){
        $this->db->where('id_dpto',$id_dpto);
        return $this->db->get('municipios');
    }
}