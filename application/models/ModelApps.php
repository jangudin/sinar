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
    $this->db->select('apps_menu.nama_menu, apps_menu.icon, apps_sub_menu.nama_sub_menu, apps_role_akses.id_apps_menu, apps_role_akses.id_apps_sub_menu');
    $this->db->from('apps_role_akses');
    $this->db->join('apps_menu', 'apps_role_akses.id_apps_menu = apps_menu.id', 'left');
    $this->db->join('apps_sub_menu', 'apps_role_akses.id_apps_sub_menu = apps_sub_menu.id', 'left');
    $this->db->where('apps_role_akses.id_user', $user_id);

    $query = $this->db->get();
    $result = $query->result_array();

    // Grouping menu and sub-menu
    $menu_data = [];
    foreach ($result as $row) {
        $menu_name = $row['nama_menu'];
        $sub_menu_name = $row['nama_sub_menu'];
        $menu_id = $row['id_apps_menu'];

        // Check if the menu already exists in the array
        if (!isset($menu_data[$menu_id])) {
            $menu_data[$menu_id] = [
                'nama_menu' => $menu_name,
                'icon' => $row['icon'],
                'sub_menus' => []
            ];
        }

        // If there is a sub-menu, add it to the menu
        if ($sub_menu_name) {
            $menu_data[$menu_id]['sub_menus'][] = [
                'nama_sub_menu' => $sub_menu_name,
                'id_apps_sub_menu' => $row['id_apps_sub_menu'],
                'icon' => $row['icon'] // Anda bisa menyesuaikan jika ada icon untuk sub-menu
            ];
        }
    }

    return array_values($menu_data); // Return the grouped menu data
}

}
