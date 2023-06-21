<?php
class UsuarioModel extends CI_Model 
{
    public function getUsuarioByUserName(){
        return $this->db->get('usuarios');
    }
}