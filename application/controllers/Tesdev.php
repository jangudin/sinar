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

     public function login_faskes()
    {
        $url = 'https://api-yankes.kemkes.go.id/faskes/login';
        $postData = json_encode([
            'userName' => 'kotakelektronik@gmail.com',
            'password' => '123'
        ]);

        $headers = [
            'Content-Type: application/json',
            'Cookie: refreshToken=eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6NSwidXNlcl9uYW1lIjoia290YWtlbGVrdHJvbmlrQGdtYWlsLmNvbSIsImxldmVsX2lkIjoyLCJpYXQiOjE3NDcxODU5MTQsImV4cCI6MTc0NzI3MjMxNH0.AzYmuBjdC4EQp6dDCVfHKwLiyPhjXSzuBuCuY9NNcQM'
        ];

        $ch = curl_init();

        curl_setopt_array($ch, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $postData,
            CURLOPT_HTTPHEADER => $headers,
        ));

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            echo 'Curl Error: ' . curl_error($ch);
        } else {
            echo "<pre>";
            var_dump(json_decode($response, true));
            echo "</pre>";
        }

        curl_close($ch);
    }

    function cekurl()
    {
        $url = base_url('')."assets/faskesbg/backgroundsertifikat.jpeg";
        var_dump($url);        
    }

    public function index()
    {
        // panggil library yang kita buat sebelumnya yang bernama pdfgenerator
        $this->load->library('pdfgenerator');
        
        // title dari pdf
        $this->data['title_pdf'] = 'Laporan Penjualan Toko Kita';
        
        // filename dari pdf ketika didownload
        $file_pdf = 'laporan_penjualan_toko_kita';
        // setting paper
        $paper = 'A4';
        //orientasi paper potrait / landscape
        $orientation = "landscape";
        
		$html = $this->load->view('tespage',$this->data, true);	    
        
        // run dompdf
        $this->pdfgenerator->generatetes($html, $file_pdf,$paper,$orientation);
    }
}