<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once APPPATH . '../vendor/autoload.php';
use Mpdf\Mpdf;
class Mpdf_library
{
    protected $mpdf;

    public function __construct()
    {
        $this->mpdf = new Mpdf();
    }

    public function load($html,$filename='document.pdf',$output='I')
    {
        $this->mpdf->WriteHTML($html);
        $this->mpdf->Output($filename, $output);
    }
}