<?php
class Maintenance extends CI_Controller {

        function __construct(){
                parent::__construct();          
                $this->load->model('Develop');
 
        }

        public function index()
        {
                
                $this->load->view('dev/index');
        }

}