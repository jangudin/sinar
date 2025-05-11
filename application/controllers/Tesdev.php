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

    // public function index()
    // {

    //     $this->file1();
    //     $this->file2();

        
    // }


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
         $html =  $this->load->view('tespage',$this->data,true);
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
