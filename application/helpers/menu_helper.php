<?php

function createMenuByPerfil($data_menus)
{
    $CI = &get_instance();
    $CI->load->model('MenusModel');
    $menu_html = '';
    if ($data_menus->num_rows() > 0) {
        foreach ($data_menus->result() as $row) {
            $data_where_submenu = array(
                'psm.perfil_id' => $row->perfil_id,
                'sm.menu_id' => $row->menu_id
            );
            $data_submenus = $CI->MenusModel->getSubmenusByPerfil($data_where_submenu);

            $menu_html .= '<div class="nav-item has-sub">
                       <a href="javascript:void(0)"><i class="' . $row->icono . '"></i><span>' . $row->menu . '</span></a>';

                $menu_html .= createSubmenuByMenuByPerfil($data_submenus);

            $menu_html .= '</div>';
        }

        return $menu_html;
    }
}

function createSubmenuByMenuByPerfil($data_submenus)
    {
        $submenu_html = "";
        if ($data_submenus->num_rows() > 0) {
            $submenu_html .= '<div class="submenu-content">';
            foreach ($data_submenus->result() as $row2) {
                $submenu_html .= '<a href="' . base_url() . $row2->path . '" class="menu-item"><i class="' . $row2->icono . '"></i>' . $row2->submenu . '</a>';
            }
            $submenu_html .= '</div>';
        }

        return $submenu_html;
    }
