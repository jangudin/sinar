<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModelApps extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function getMenuAndSubMenuByUser($user_id)
{
    $this->db->select('apps_menu.nama_menu, apps_menu.icon, apps_sub_menu.nama_sub_menu');
    $this->db->from('apps_role_akses');
    $this->db->join('apps_menu', 'apps_role_akses.id_apps_menu = apps_menu.id', 'left');
    $this->db->join('apps_sub_menu', 'apps_role_akses.id_apps_sub_menu = apps_sub_menu.id', 'left');
    $this->db->join('apps_group_akses_menu', 'apps_role_akses.id_apps_group_akses = apps_group_akses_menu.id', 'left');
    $this->db->where('apps_role_akses.id_user', $user_id);

    $query = $this->db->get();
    return $query->result_array();
}

}
