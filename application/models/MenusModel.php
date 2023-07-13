<?php
class MenusModel extends CI_Model
{

    public function getMenus()
    {
        return $this->db->get('menus');
    }

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
        $this->db->join('perfiles_submenus as psm', 'sm.id_submenu=psm.submenu_id');
        $this->db->where($data_where);
        return $this->db->get();
    }

    public function updateMenuById($data_update, $data_where)
    {
        return $this->db->update('menus', $data_update, $data_where);
    }

    public function deleteMenuById($data_where)
    {
        return $this->db->delete('menus', $data_where);
    }

    public function getMenuPerfilByIdMenu($data_where)
    {
        return $this->db->get_where('perfiles_menus', $data_where);
    }

    public function insertMenu($data_insert)
    {
        return $this->db->insert('menus', $data_insert);
    }

    public function getMenuByName($data_where)
    {
        return $this->db->get_where('menus', $data_where);
    }
}
