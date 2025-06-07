<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_model extends CI_Model {
    
    public function get_belum_tte() {
        $this->db->select('*');
        $this->db->from('tbl_data');
        $this->db->where('status_tte', 0); // Assuming 0 means belum TTE
        $this->db->order_by('created_at', 'DESC');
        
        return $this->db->get()->result();
    }
}