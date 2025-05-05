<?php
class LoginDev extends CI_Controller {

        function __construct(){
                parent::__construct();          
                $this->load->model('Develop');
 
        }

        public function index()
        {
                $this->load->view('dev/login');
        }

        function aksi_login(){
                $username = $this->input->post('username');
                $password = $this->input->post('password');
                $where = array(
                        'email' => $username,
                        'password' => md5($password)
                        );
                $cek = $this->Develop->cek_login("pengguna",$where)->num_rows();
                if($cek > 0){
 
                        $data_session = array(
                                'nama' => $username,
                                'status' => "login"
                                );
 
                        $this->session->set_userdata($data_session);
 
                        redirect(base_url("dev/maintenance"));
 
                }else{
                        echo $cek;
                }
        }
}