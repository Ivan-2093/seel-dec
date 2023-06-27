<?php
class SedesModel extends CI_Model{
    public function getSedes(){
        return $this->db->get('sedes');
    }
}