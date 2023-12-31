<?php
class PermisosModel extends CI_Model
{
    public function getPerfiles()
    {
        return $this->db->get('perfiles');
    }

    public function insertPermisoMenu($data_where)
    {
        return $this->db->insert('perfiles_menus', $data_where);
    }
    public function deletePermisoMenu($data_where)
    {
        return $this->db->delete('perfiles_menus', $data_where);
    }

    public function insertPermisoSubMenu($data_where)
    {
        return $this->db->insert('perfiles_submenus', $data_where);
    }
    public function deletePermisoSubMenu($data_where)
    {
        return $this->db->delete('perfiles_submenus', $data_where);
    }
}
