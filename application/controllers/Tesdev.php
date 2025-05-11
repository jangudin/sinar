<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tesdev extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        // Memuat TCPDF library
        $this->load->library('tcpdf');
    }

    public function generate_pdf()
    {
        // Membuat instance dari TCPDF
        $pdf = new TCPDF();
        
        // Set beberapa parameter untuk PDF
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Your Name');
        $pdf->SetTitle('Sample PDF using TCPDF');
        $pdf->SetSubject('TCPDF Example');
        
        // Menambahkan halaman baru
        $pdf->AddPage();

        // Mengatur font
        $pdf->SetFont('helvetica', '', 12);
        
        // Menulis teks ke dalam PDF
        $pdf->Cell(0, 10, 'Hello, this is a simple PDF generated using TCPDF in CodeIgniter.', 0, 1, 'C');
        
        // Menambahkan gambar (URL eksternal atau file lokal)
        $pdf->Image('http://192.168.67.143/sinar/assets/faskesbg/backgroundsertifikat.jpeg', 10, 20, 50, 50, 'jpeg');
        
        // Output PDF ke browser
        $pdf->Output('example.pdf', 'I');
    }
}
