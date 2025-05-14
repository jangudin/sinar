<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// panggil autoload dompdf nya
// require_once 'dompdf-master/autoload.inc.php';
require 'vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;
class Pdfgenerator {

         public function generatetes($html, $filename='', $paper = '', $orientation = '', $stream=TRUE)
    {   

        ob_start();
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper($paper, $orientation);
        $dompdf->render();
        ob_end_clean();
        $outPut = $dompdf->output();
       //  file_put_contents('assets/faskessertif/'.$filename.'.pdf',$outPut);
        if ($stream) {
            $dompdf->stream($filename.".pdf", array("Attachment" => 0));
        } else {
            return $dompdf->output();
        }
    }

    public function surattugas($html, $filename='', $paper = '', $orientation = '', $stream=TRUE)
    {   
        $options = new Options();
        $options->set('isRemoteEnabled', TRUE);
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper($paper, $orientation);
        $dompdf->render();
        $outPut = $dompdf->output();
        file_put_contents('assets/surtug/'.$filename.'.pdf',$outPut);
        // if ($stream) {
        //     $dompdf->stream($filename.".pdf", array("Attachment" => 0));
        // } else {
        //     return $dompdf->output();
        // }
    }

         public function generatesurtug($html, $filename='', $paper = '', $orientation = '', $stream=TRUE)
    {   
        $options = new Options();
        $options->set('isRemoteEnabled', TRUE);
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper($paper, $orientation);
        $dompdf->render();
        $outPut = $dompdf->output();
        file_put_contents('assets/surtugrs/surtug/'.$filename.'.pdf',$outPut);
        // if ($stream) {
        //     $dompdf->stream($filename.".pdf", array("Attachment" => 0));
        // } else {
        //     return $dompdf->output();
        // }
    }

             public function generatesurtugtt($html, $filename='', $paper = '', $orientation = '', $stream=TRUE)
    {   
        $options = new Options();
        $options->set('isRemoteEnabled', TRUE);
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper($paper, $orientation);
        $dompdf->render();
        $outPut = $dompdf->output();
        file_put_contents('assets/surtugrs/surtugtt/'.$filename.'.pdf',$outPut);
        // if ($stream) {
        //     $dompdf->stream($filename.".pdf", array("Attachment" => 0));
        // } else {
        //     return $dompdf->output();
        // }
    }

    public function generatefaskes($html, $filename = '', $paper = 'A4', $orientation = 'portrait')
    {
        $this->generatef($html, $filename, $paper, $orientation, 'assets/faskessertif/');
    }

    public function generatefaskesdirjen($html, $filename = '', $paper = 'A4', $orientation = 'portrait')
    {
        $this->generatef($html, $filename, $paper, $orientation, 'assets/faskessertif/');
    }

    private function generatef($html, $filename, $paper, $orientation, $path)
    {
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper($paper, $orientation);
        $dompdf->render();

        $output = $dompdf->output();

        $fullpath = FCPATH . $path . $filename . '.pdf';
        if (!is_dir(dirname($fullpath))) {
            mkdir(dirname($fullpath), 0755, true);
        }

        file_put_contents($fullpath, $output);

        if (!file_exists($fullpath)) {
            log_message('error', 'File PDF gagal disimpan: ' . $fullpath);
        }
    }


         public function generatetpmd($html, $filename='', $paper = '', $orientation = '', $stream=TRUE)
    {   
        $options = new Options();
        $options->set('isRemoteEnabled', TRUE);
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper($paper, $orientation);
        $dompdf->render();
        $outPut = $dompdf->output();
        file_put_contents('assets/TPMD/'.$filename.'.pdf',$outPut);
        // if ($stream) {
        //     $dompdf->stream($filename.".pdf", array("Attachment" => 0));
        // } else {
        //     return $dompdf->output();
        // }
    }

         public function generatefaskesdir($html, $filename='', $paper = '', $orientation = '', $stream=TRUE)
    {   
        $options = new Options();
        $options->set('isRemoteEnabled', TRUE);
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper($paper, $orientation);
        $dompdf->render();
        $outPut = $dompdf->output();
       // file_put_contents('assets/faskessertif/'.$filename.'.pdf',$outPut);
        if ($stream) {
            $dompdf->stream($filename.".pdf", array("Attachment" => 0));
        } else {
            return $dompdf->output();
        }
    }

    public function generate_kars($html, $filename='', $paper = '', $orientation = '', $stream=TRUE)
    {   
        $options = new Options();
        $options->set('isRemoteEnabled', TRUE);
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper($paper, $orientation);
        $dompdf->render();
        $outPut = $dompdf->output();
        file_put_contents('assets/generate/kars/'.$filename.'.pdf',$outPut);
        // if ($stream) {
        //     $dompdf->stream($filename.".pdf", array("Attachment" => 0));
        // } else {
        //     return $dompdf->output();
        // }
    }

        public function generate($html, $filename='', $paper = '', $orientation = '', $stream=TRUE)
    {   
        $options = new Options();
        $options->set('isRemoteEnabled', TRUE);
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper($paper, $orientation);
        $dompdf->render();
        $outPut = $dompdf->output();
        file_put_contents('assets/generate/lafki/'.$filename.'.pdf',$outPut);
        // if ($stream) {
        //     $dompdf->stream($filename.".pdf", array("Attachment" => 0));
        // } else {
        //     return $dompdf->output();
        // }
    }

            public function Lam($html, $filename='', $paper = '', $orientation = '', $stream=TRUE)
    {   
        $options = new Options();
        $options->set('isRemoteEnabled', TRUE);
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper($paper, $orientation);
        $dompdf->render();
        $outPut = $dompdf->output();
        file_put_contents('assets/generate/lam/'.$filename.'.pdf',$outPut);
        // if ($stream) {
        //     $dompdf->stream($filename.".pdf", array("Attachment" => 0));
        // } else {
        //     return $dompdf->output();
        // }
    }

    public function Lamlembaga($html, $filename='', $paper = '', $orientation = '', $stream=TRUE)
    {   
        $options = new Options();
        $options->set('isRemoteEnabled', TRUE);
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper($paper, $orientation);
        $dompdf->render();
        $outPut = $dompdf->output();
        file_put_contents('assets/generate/lam/'.$filename.'.pdf',$outPut);
        // if ($stream) {
        //     $dompdf->stream($filename.".pdf", array("Attachment" => 0));
        // } else {
        //     return $dompdf->output();
        // }
    }
                public function Lamdirjen($html, $filename='', $paper = '', $orientation = '', $stream=TRUE)
    {   
        $options = new Options();
        $options->set('isRemoteEnabled', TRUE);
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper($paper, $orientation);
        $dompdf->render();
        $outPut = $dompdf->output();
        file_put_contents('assets/generate/lam/'.$filename.'.pdf',$outPut);
        // if ($stream) {
        //     $dompdf->stream($filename.".pdf", array("Attachment" => 0));
        // } else {
        //     return $dompdf->output();
        // }
    }


        public function generatelam($html, $filename='', $paper = '', $orientation = '', $stream=TRUE)
    {   
        $options = new Options();
        $options->set('isRemoteEnabled', TRUE);
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper($paper, $orientation);
        $dompdf->render();
        $outPut = $dompdf->output();
        file_put_contents('assets/generate/lafki/'.$filename.'.pdf',$outPut);
        // if ($stream) {
        //     $dompdf->stream($filename.".pdf", array("Attachment" => 0));
        // } else {
        //     return $dompdf->output();
        // }
    }


        public function generatelembaga($html, $filename='', $paper = '', $orientation = '', $stream=TRUE)
    {   
        $options = new Options();
        $options->set('isRemoteEnabled', TRUE);
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper($paper, $orientation);
        $dompdf->render();
        $outPut = $dompdf->output();
        file_put_contents('assets/generate/lafki/'.$filename.'.pdf',$outPut);
        // if ($stream) {
        //     $dompdf->stream($filename.".pdf", array("Attachment" => 0));
        // } else {
        //     return $dompdf->output();
        // }
    }


        public function generatedirjen($html, $filename='', $paper = '', $orientation = '', $stream=TRUE)
    {   
        $options = new Options();
        $options->set('isRemoteEnabled', TRUE);
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper($paper, $orientation);
        $dompdf->render();
        $outPut = $dompdf->output();
        file_put_contents('assets/generate/lafki/'.$filename.'.pdf',$outPut);
        // if ($stream) {
        //     $dompdf->stream($filename.".pdf", array("Attachment" => 0));
        // } else {
        //     return $dompdf->output();
        // }
    }

            public function generatelasi($html, $filename='', $paper = '', $orientation = '', $stream=TRUE)
    {   
        $options = new Options();
        $options->set('isRemoteEnabled', TRUE);
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper($paper, $orientation);
        $dompdf->render();
        $outPut = $dompdf->output();
        file_put_contents('assets/generate/larsi/'.$filename.'.pdf',$outPut);
        // if ($stream) {
        //     $dompdf->stream($filename.".pdf", array("Attachment" => 0));
        // } else {
        //     return $dompdf->output();
        // }
    }

                public function generatelasilembaga($html, $filename='', $paper = '', $orientation = '', $stream=TRUE)
    {   
        $options = new Options();
        $options->set('isRemoteEnabled', TRUE);
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper($paper, $orientation);
        $dompdf->render();
        $outPut = $dompdf->output();
        file_put_contents('assets/generate/larsi/'.$filename.'.pdf',$outPut);
        // if ($stream) {
        //     $dompdf->stream($filename.".pdf", array("Attachment" => 0));
        // } else {
        //     return $dompdf->output();
        // }
    }

                public function generatelasidirjen($html, $filename='', $paper = '', $orientation = '', $stream=TRUE)
    {   
        $options = new Options();
        $options->set('isRemoteEnabled', TRUE);
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper($paper, $orientation);
        $dompdf->render();
        $outPut = $dompdf->output();
        file_put_contents('assets/generate/larsi/'.$filename.'.pdf',$outPut);
        // if ($stream) {
        //     $dompdf->stream($filename.".pdf", array("Attachment" => 0));
        // } else {
        //     return $dompdf->output();
        // }
    }


    public function generatelars($html, $filename='', $paper = '', $orientation = '', $stream=TRUE)
    {   
        $options = new Options();
        $options->set('isRemoteEnabled', TRUE);
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper($paper, $orientation);
        $dompdf->render();
        $outPut = $dompdf->output();
        file_put_contents('assets/generate/lars/'.$filename.'.pdf',$outPut);
        // if ($stream) {
        //     $dompdf->stream($filename.".pdf", array("Attachment" => 0));
        // } else {
        //     return $dompdf->output();
        // }
    }

                public function generatelarslembaga($html, $filename='', $paper = '', $orientation = '', $stream=TRUE)
    {   
        $options = new Options();
        $options->set('isRemoteEnabled', TRUE);
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper($paper, $orientation);
        $dompdf->render();
        $outPut = $dompdf->output();
        file_put_contents('assets/generate/lars/'.$filename.'.pdf',$outPut);
        // if ($stream) {
        //     $dompdf->stream($filename.".pdf", array("Attachment" => 0));
        // } else {
        //     return $dompdf->output();
        // }
    }

                public function generatelarsdirjen($html, $filename='', $paper = '', $orientation = '', $stream=TRUE)
    {   
        $options = new Options();
        $options->set('isRemoteEnabled', TRUE);
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper($paper, $orientation);
        $dompdf->render();
        $outPut = $dompdf->output();
        file_put_contents('assets/generate/lars/'.$filename.'.pdf',$outPut);
        // if ($stream) {
        //     $dompdf->stream($filename.".pdf", array("Attachment" => 0));
        // } else {
        //     return $dompdf->output();
        // }
    }

    public function generatelarsdhp($html, $filename='', $paper = '', $orientation = '', $stream=TRUE)
    {   
        $options = new Options();
        $options->set('isRemoteEnabled', TRUE);
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper($paper, $orientation);
        $dompdf->render();
        $outPut = $dompdf->output();
        file_put_contents('assets/generate/larsdhp/'.$filename.'.pdf',$outPut);
        // if ($stream) {
        //     $dompdf->stream($filename.".pdf", array("Attachment" => 0));
        // } else {
        //     return $dompdf->output();
        // }
    }

        public function generatelarsdhplembaga($html, $filename='', $paper = '', $orientation = '', $stream=TRUE)
    {   
        $options = new Options();
        $options->set('isRemoteEnabled', TRUE);
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper($paper, $orientation);
        $dompdf->render();
        $outPut = $dompdf->output();
        file_put_contents('assets/generate/larsdhp/'.$filename.'.pdf',$outPut);
        // if ($stream) {
        //     $dompdf->stream($filename.".pdf", array("Attachment" => 0));
        // } else {
        //     return $dompdf->output();
        // }

    }

                public function generatelarsdhpdirjen($html, $filename='', $paper = '', $orientation = '', $stream=TRUE)
    {   
        $options = new Options();
        $options->set('isRemoteEnabled', TRUE);
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper($paper, $orientation);
        $dompdf->render();
        $outPut = $dompdf->output();
        file_put_contents('assets/generate/larsdhp/'.$filename.'.pdf',$outPut);
        // if ($stream) {
        //     $dompdf->stream($filename.".pdf", array("Attachment" => 0));
        // } else {
        //     return $dompdf->output();
        // }
    }


        public function generatelafki($html, $filename='', $paper = '', $orientation = '', $stream=TRUE)
    {   
        $options = new Options();
        $options->set('isRemoteEnabled', TRUE);
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper($paper, $orientation);
        $dompdf->render();
        $outPut = $dompdf->output();
        file_put_contents('assets/generate/lafki/'.$filename.'.pdf',$outPut);
        // if ($stream) {
        //     $dompdf->stream($filename.".pdf", array("Attachment" => 0));
        // } else {
        //     return $dompdf->output();
        // }
    }

        public function generatelafkilembaga($html, $filename='', $paper = '', $orientation = '', $stream=TRUE)
    {   
        $options = new Options();
        $options->set('isRemoteEnabled', TRUE);
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper($paper, $orientation);
        $dompdf->render();
        $outPut = $dompdf->output();
        file_put_contents('assets/generate/lafki/'.$filename.'.pdf',$outPut);
        // if ($stream) {
        //     $dompdf->stream($filename.".pdf", array("Attachment" => 0));
        // } else {
        //     return $dompdf->output();
        // }

    }

                public function generatelafkidirjen($html, $filename='', $paper = '', $orientation = '', $stream=TRUE)
    {   
        $options = new Options();
        $options->set('isRemoteEnabled', TRUE);
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper($paper, $orientation);
        $dompdf->render();
        $outPut = $dompdf->output();
        file_put_contents('assets/generate/lafki/'.$filename.'.pdf',$outPut);
        // if ($stream) {
        //     $dompdf->stream($filename.".pdf", array("Attachment" => 0));
        // } else {
        //     return $dompdf->output();
        // }
    }
}