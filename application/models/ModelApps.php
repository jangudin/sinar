<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModelApps extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Get menu and submenu data for a specific user with grouping by menu ID
     *
     * @param int $user_id User ID to filter by
     * @return array Result set array
     */
    public function getMenuAndSubMenuByUser($user_id)
    {
        $this->db->select('apps_menu.nama_menu, apps_menu.icon, apps_sub_menu.nama_sub_menu');
        $this->db->from('apps_role_akses');
        $this->db->join('apps_menu', 'apps_role_akses.id_apps_menu = apps_menu.id', 'left');
        $this->db->join('apps_sub_menu', 'apps_role_akses.id_apps_sub_menu = apps_sub_menu.id', 'left');
        $this->db->join('apps_group_akses_menu', 'apps_role_akses.id_apps_group_akses = apps_group_akses_menu.id', 'left');
        $this->db->where('apps_role_akses.id_user', $user_id);

        $this->db->group_by('apps_menu.id');

        $query = $this->db->get();
        return $query->result_array();
    }
}
