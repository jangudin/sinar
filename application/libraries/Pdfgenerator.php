<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// panggil autoload dompdf nya
require_once 'dompdf-master/autoload.inc.php';
use Dompdf\Dompdf;
use Dompdf\Options;
class Pdfgenerator {

         public function generatetes($html, $filename='', $paper = '', $orientation = '', $stream=TRUE)
    {   
        $options = new Options();
        $options->set('isRemoteEnabled', TRUE);
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper($paper, $orientation);
        $dompdf->render();
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

     public function generatefaskes($html, $filename='', $paper = '', $orientation = '', $stream=TRUE)
{
    $options = new Options();
    $options->set('isRemoteEnabled', TRUE);      // Aktifkan remote resources (gambar eksternal)
    $options->set('isHtml5ParserEnabled', TRUE); // Pastikan HTML5 parsing diaktifkan
    $options->set('isPhpEnabled', TRUE);         // Aktifkan PHP dalam HTML (untuk konten dinamis)

    // Opsional: Aktifkan logging untuk debug
    $options->set('logOutputFile', '/path/to/dompdf.log');

    $dompdf = new Dompdf($options);
    $dompdf->loadHtml($html);
    $dompdf->setPaper($paper, $orientation);
    $dompdf->render();
    
    // Output PDF ke file
    $outPut = $dompdf->output();
    file_put_contents('assets/faskessertif/'.$filename.'.pdf',$outPut);
}

    public function generatefaskes($html, $filename = '', $paper = '', $orientation = '', $stream = TRUE)
{   
    // Define options for DOMPDF
    $options = new Options();
    $options->set('isRemoteEnabled', TRUE);  // Enable remote resources (images from URLs)
    $options->set('isHtml5ParserEnabled', TRUE); // Enable HTML5 parser for modern HTML content
    $dompdf = new Dompdf($options);

    // Replace local image paths with absolute URLs if needed
    $html = $this->replaceLocalImagePaths($html);

    // Load HTML content
    $dompdf->loadHtml($html);

    // Set paper size and orientation
    $dompdf->setPaper($paper, $orientation);

    // Render the PDF (first pass)
    $dompdf->render();

    // Get the PDF output
    $output = $dompdf->output();

    // Define file path to save the generated PDF
    $filePath = 'assets/faskessertif/' . $filename . '.pdf';

    // Ensure the directory exists and is writable
    if (!is_dir('assets/faskessertif/')) {
        mkdir('assets/faskessertif/', 0777, true);  // Create the directory if it doesn't exist
    }
    if (!is_writable('assets/faskessertif/')) {
        throw new Exception("Directory is not writable: assets/faskessertif/");
    }

    // Save the generated PDF to the file system
    file_put_contents($filePath, $output);

    // If $stream is TRUE, stream the PDF to the browser
    if ($stream) {
        // Stream the generated PDF to the browser
        $dompdf->stream($filename . ".pdf", array("Attachment" => 0));  // 0: Display in browser, 1: Force download
    } else {
        // Return the raw PDF output if needed elsewhere
        return $output;
    }
}

    private function replaceLocalImagePaths($html)
    {
        $baseUrl = 'http://192.168.67.143';  // Use the internal server base URL
        $html = preg_replace_callback('/src=["\'](\/sinar\/assets\/faskesbg\/[^\s]+)["\']/i', function($matches) use ($baseUrl) {
            return 'src="' . $baseUrl . $matches[1] . '"';  // Convert relative path to absolute URL
        }, $html);

        return $html;
    }

         public function generatefaskesdirjen($html, $filename='', $paper = '', $orientation = '', $stream=TRUE)
    {   
        $options = new Options();
        $options->set('isRemoteEnabled', TRUE);
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper($paper, $orientation);
        $dompdf->render();
        $outPut = $dompdf->output();
        file_put_contents('assets/faskessertif/'.$filename.'.pdf',$outPut);
        // if ($stream) {
        //     $dompdf->stream($filename.".pdf", array("Attachment" => 0));
        // } else {
        //     return $dompdf->output();
        // }
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

    $path = __DIR__ . '/assets/TPMD/';
    if (!is_dir($path)) {
        mkdir($path, 0755, true);
    }
    $file = $path . $filename . '.pdf';
    file_put_contents($file, $outPut);
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