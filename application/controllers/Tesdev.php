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

    public function sign_pdf_esign()
{
    $base64_pdf = base64_encode(file_get_contents(FCPATH . 'assets/faskessertif/showttedir49578.pdf'));
    $url = 'https://esign-client-e-sign.apps.devocp.dc.kemkes.go.id/api/v2/sign/pdf';

    $headers = [
        'Content-Type: application/json',
        'Authorization: Basic ZXNpZ24tc2luYXIyOnMxbjRyMzM0NHg=',
        'Cookie: 7390520b357aa06ff9847f808198cffb=a49e656a382e58ab2ab7bb0672efbdb9'
    ];

    $payload = [
        "nik" => "3603287006580002",
        "passphrase" => "Ek@laskesi02",
        "signatureProperties" => [
            [
                "tampilan" => "INVISIBLE"
            ]
        ],
        "file" => [
            $base64_pdf
        ]
    ];

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Opsional, tergantung sertifikat SSL

    $response = curl_exec($ch);
    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

   if (curl_errno($ch)) {
        $error_msg = curl_error($ch);
        curl_close($ch);
        return [
            'httpcode' => $httpcode,
            'error' => $error_msg
        ];
    }

    curl_close($ch);

    return [
        'httpcode' => $httpcode,
        'response' => json_decode($response, true)
    ];
}




        public function file1()
    {

        $this->load->library('pdfgenerator');
        $this->data['title_pdf'] = 'Sertifikat';
        $file_pdf = "Lafki11";
        $paper = 'A4';
        $orientation = "landscape";
        $path = FCPATH . 'assets/faskesbg/backgroundsertifikat.jpeg';
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $this->data['img_base64'] = 'data:image/' . $type . ';base64,' . base64_encode($data);
         $html =  $this->load->view('Sertifikatfaskesnew/sertifikatkosong',$this->data,true);
         $this->pdfgenerator->generatetes($html, $file_pdf,$paper,$orientation);
         //   $this->load->view('Sertifikatfaskesnew/sertifikatkosong'$data);
    }

        public function file2()
    {

        $this->load->library('pdfgenerator');
        $this->data['title_pdf'] = 'Sertifikat';
        $file_pdf = "Lafki32";
        $paper = 'A4';
        $orientation = "landscape";
        $html =  $this->load->view('tespage',$this->data,true);


        $this->pdfgenerator->generatetes($html, $file_pdf,$paper,$orientation);

            //$this->load->view('tespage');

        
    }


    // function Folder()
    // {
    //         $path    = './assets/faskessertif'; //lokasi folder sekarang 
    //         $files = scandir($path);
    //         $files = array_diff(scandir($path), array('.', '..'));
    //         foreach($files as $nama_file)
    //         {
    //             echo "<a href='$nama_file'>$nama_file</a><br/>";
    //             echo  "<hr>";
    //         }
    //     }

    // public function index()
    // {
    //     // panggil library yang kita buat sebelumnya yang bernama pdfgenerator
    //     $this->load->library('pdfgenerator');
        
    //     // title dari pdf
    //     $this->data['title_pdf'] = 'tes';
        
    //     // filename dari pdf ketika didownload
    //     $file_pdf = 'tes';
    //     // setting paper
    //     $paper = 'A4';
    //     //orientasi paper potrait / landscape
    //     $orientation = "landscape";
        
    //     $html = $this->load->view('tespage',$this->data, true);     
        
    //     // run dompdf
    //     $this->pdfgenerator->generatetes($html, $file_pdf,$paper,$orientation);

    //     // $this->load->view('tespage');
    // }

 //        public function index()
 // {
 //            $this->data['title_pdf'] = 'tes';
 //        $this->load->library('pdfgenerator');
 //        $file_pdf = 'tes';
 //        $paper = 'A4';
 //        $orientation = "landscape";
 //        $html = $this->load->view('tespage',$this->data, true);     
 //        $this->pdfgenerator->generatetes($html, $file_pdf,$paper,$orientation);
        
 //    }

 //            public function index()
 // {
 //        $this->data['title_pdf'] = 'tes';
 //        $this->load->library('pdfgenerator');
 //        $file_pdf = 'tes';
 //        $paper = 'A4';
 //        $orientation = "potrait";
 //        $html = $this->load->view('surtug/surat',$this->data, true);     
 //        $this->pdfgenerator->generatetes($html, $file_pdf,$paper,$orientation);
        
 //    }


 //                public function index()
 // {
 //        // $this->data['title_pdf'] = 'tes';
 //        // $this->load->library('pdfgenerator');
 //        // $file_pdf = 'tes';
 //        // $paper = 'A4';
 //        // $orientation = "potrait";
 //        // $html = $this->load->view('surtug/surat',$this->data, true);     
 //        // $this->pdfgenerator->generatetes($html, $file_pdf,$paper,$orientation);

 //     echo "Sedang Ada Pemeliharaan Kembali Beberapa Saat lagi";
        
 //    }



    }
