<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TesPage extends CI_Controller {

    public function index()
    {
    	$arrayName = array('content' => 'head', );
        $this->load->view('template/temp');
    }
}