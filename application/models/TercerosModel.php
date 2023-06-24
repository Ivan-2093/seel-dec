<?php
class TercerosModel extends CI_Model 
{
    public function getTipoDocumentos(){
        return $this->db->get('tipo_documentos');
    }

    public function getGeneros(){
        return $this->db->get('generos');
    }
}