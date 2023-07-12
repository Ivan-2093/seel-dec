<?php
class MenusModel extends CI_Model 
{
    public function getMenusByPerfil($data_where)
    {
        $this->db->select('*');
        $this->db->from('menus as m');
        $this->db->join('perfiles_menus as pm', 'm.id_menu = pm.menu_id');
        $this->db->where($data_where);
        return $this->db->get();
    }

    public function getSubmenusByPerfil($data_where)
    {
        $this->db->select('*');
        $this->db->from('submenus as sm');
        $this->db->join('perfiles_submenus as psm','sm.id_submenu=psm.submenu_id');
        $this->db->where($data_where);
        return $this->db->get();
    }

}