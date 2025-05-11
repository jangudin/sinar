<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Pastikan untuk memuat autoloader Composer
require_once FCPATH . 'vendor/autoload.php';

// Impor kelas Dompdf dan Options
use Dompdf\Dompdf;
use Dompdf\Options;

class Tesdev extends CI_Controller {
    
    // Konstruktor controller
    function __construct(){
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        ini_set('max_execution_time', '300');
        $this->load->model('Dashboard_tte');
        $this->load->library('encryption');
        $this->load->helper('tanggal_indonesia');
    }

    // Fungsi untuk generate PDF
    public function index()
    {
        // Set opsi DOMPDF
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true); // Aktifkan PHP untuk gambar

        // Membuat instance DOMPDF
        $dompdf = new Dompdf($options);

        // Data untuk tampilan
        $data = [
            'title' => 'Contoh PDF dengan Gambar dari URL',
            'image_url' => 'http://192.168.67.143/sinar/assets/faskesbg/backgroundsertifikat.jpeg' // Gambar dari URL eksternal
        ];

        // Load tampilan HTML ke DOMPDF
        // Menggunakan CodeIgniter 3 load->view untuk mendapatkan HTML dari view
        $html = $this->load->view('tespage', $data, true); // Parameter 'true' untuk mengembalikan HTML sebagai string

        // Load HTML ke DOMPDF
        $dompdf->loadHtml($html);

        // Render PDF (termasuk pemrosesan gambar)
        $dompdf->render();

        // Output file PDF ke browser
        $dompdf->stream("contoh_pdf_dengan_gambar_dari_url.pdf", ["Attachment" => 0]); // 0 untuk membuka di browser, 1 untuk mendownload
    }


        public function file1()
    {

        $this->load->library('pdfgenerator');
        $this->data['title_pdf'] = 'Sertifikat';
        $file_pdf = "Lafki11";
        $paper = 'A4';
        $orientation = "landscape";
        $html =  $this->load->view('Sertifikatfaskesnew/sertifikatkosong',$this->data,true);
        $this->pdfgenerator->generatetes($html, $file_pdf,$paper,$orientation);

         //   $this->load->view('Sertifikatfaskesnew/sertifikatkosong');

        
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
