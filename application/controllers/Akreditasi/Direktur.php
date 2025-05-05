<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Direktur extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        
        // Load the session library
        $this->load->library('session');
        // Load the model if needed (for users or authentication purposes)
    }

    // Method to load the login page
    public function index()
    {
        // Check if user is already logged in
        if ($this->session->userdata('logged_in')) {
            // If user is logged in, redirect to the dashboard
            redirect('Akreditasi/direktur/dashboard');
        } else {
            // Else, show the login page
            $this->load->view('login_view');
        }
    }

    // Method to load the dashboard page
    public function dashboard()
    {
        // Check if user is logged in
        if ($this->session->userdata('logged_in')) {
            // Get the user data from session
            $data['user_name'] = $this->session->userdata('user_name');
            // Load the admin dashboard view and pass the data to it
            $this->load->view('akreditasi/template/index', $data);
        } else {
            // If not logged in, redirect to login page
            redirect('direktur');
        }
    }
}
