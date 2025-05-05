<?php
class PdfDownload extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data = $this->load->view('tespage');
        $html = $data;

        $filename = "newpdffile";

        $this->load->library('Pdf');

        $dompdf = new Pdf();

        $dompdf->loadHtml($html);

            // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream($filename,array("Attachment"=>0));

    }

}