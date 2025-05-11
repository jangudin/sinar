<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModelApps extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Get menu and submenu data based on user ID
     * 
     * @param int $user_id User's ID (to filter access)
     * @return array Menu and submenu accessible by the user
     */
   public function getMenuAndSubMenuByUser ($user_id)
{
        $this->db->select('
            apps_menu.id as menu_id,
            apps_menu.nama_menu,
            apps_menu.icon,
            apps_sub_menu.id as sub_id,
            apps_sub_menu.nama_sub_menu
        ');
        $this->db->from('apps_role_akses');
        $this->db->join('apps_menu', 'apps_role_akses.id_apps_menu = apps_menu.id', 'left');
        $this->db->join('apps_sub_menu', 'apps_role_akses.id_apps_sub_menu = apps_sub_menu.id', 'left');
        $this->db->where('apps_role_akses.id_user', $user_id);
        $query = $this->db->get();

        $result = $query->result_array();

        // Grouping
        $menu_data = [];
        foreach ($result as $row) {
            $menu_id = $row['menu_id'];
            if (!isset($menu_data[$menu_id])) {
                $menu_data[$menu_id] = [
                    'nama_menu' => $row['nama_menu'],
                    'icon' => $row['icon'],
                    'sub_menu' => []
                ];
            }

            if (!empty($row['sub_id'])) {
                $menu_data[$menu_id]['sub_menu'][] = $row['nama_sub_menu'];
            }
        }

        return $menu_data;
    }

}
