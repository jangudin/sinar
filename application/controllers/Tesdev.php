<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tesdev extends CI_Controller {
    function __construct(){
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        ini_set('max_execution_time', '300');
        $this->load->model('Dashboard_tte');
        $this->load->library('encryption');
        $this->load->helper('tanggal_indonesia');
    }

    public function cek_status_user()
    {
        $url = 'http://esign-e-sign.apps.prdocp.dc.kemkes.go.id/api/user/status/3674061009780016';
        $authorization = 'Basic ZXNpZ24tc2luYXIyOnMxbjRyMzM0NHg=';

        // Inisialisasi cURL
        $ch = curl_init($url);

        // Set opsi cURL
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Authorization: $authorization"
        ]);

        // Eksekusi cURL
        $response = curl_exec($ch);

        // Cek error
        if (curl_errno($ch)) {
            echo 'Curl error: ' . curl_error($ch);
        } else {
            // Decode dan tampilkan hasil
            echo "<pre>";
            var_dump(json_decode($response, true));
            echo "</pre>";
        }

        // Tutup koneksi cURL
        curl_close($ch);
    }
    }
