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
        "file" => ["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"]
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
