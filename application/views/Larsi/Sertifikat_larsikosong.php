<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <style>
        @page {
            margin: 0;
            size: A3 portrait;
        }
        
        body {
            margin: 0;
            padding: 0;
            height: 42cm;
            background-color: #fff;
        }
        
        #watermark {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
        }
        
        main {
            width: 100%;
            text-align: center;
            padding-top: 430px;
            position: relative;
            z-index: 1;
        }
        
        .sertifikat-nomor {
            width: 100%;
            text-align: center;
            margin-bottom: 60px; /* Increased spacing */
        }
        
        .sertifikat-nama {
            width: 800px;
            margin: 0 auto 70px; /* Increased bottom margin */
        }
        
        .sertifikat-tingkat {
            width: 100%;
            text-align: center;
            margin-bottom: 20px; /* Reduced spacing to move closer to capayan */
            margin-top: 60px; /* Added top margin to move down */
        }
        
        .capayan-container {
            width: 100%;
            text-align: center;
            margin-bottom: 40px; /* Reduced spacing */
        }
        
        .capayan-container img {
            display: block;
            width: 370px;
            height: 120px;
            margin: 0 auto;
        }
        
        .bsd {
            width: 100%;
            text-align: center;
            margin-bottom: 40px; /* Reduced spacing */
            margin-top: -20px; /* Negative margin to move up closer to capayan */
        }
        
        .mengetahui {
            width: 100%;
            text-align: left; /* Align left instead of center */
            margin-top: 20px;
            padding-left: 14%; /* Move left using padding instead of margin */
        }
        
        /* Typography */
        h1, h2, h3, h4 {
            margin: 10px 0;
            font-weight: normal; /* Make all headings normal weight by default */
        }
        
        h1 { 
            font-size: 35px; 
        }
        
        h2 { 
            font-size: 24px;
        }
        
        h3 { 
            font-size: 20px;
        }
        
        h4 { 
            font-size: 18px;
        }
        
        /* Only make hospital name bold */
        .sertifikat-nama h1 {
            font-weight: bold;
        }
        
        /* Force single page */
        @media print {
            .page-break {
                display: none;
            }
        }
    </style>
</head>

<body>
    <?php 
    // Pre-process image data
    $background_image = base64_encode(file_get_contents(FCPATH . 'assets/sertifikat/larsi.png'));
    
    // Pre-process capayan images
    $capayan_images = [];
    $capayan_types = ['Utama' => 'UtamaLarsi', 'Madya' => 'MadyaLarsi', 'Paripurna' => 'ParipurnaLarsi'];
    foreach ($capayan_types as $key => $value) {
        $img_path = FCPATH . "assets/capayan/{$value}.png";
        if (file_exists($img_path)) {
            $capayan_images[$key] = base64_encode(file_get_contents($img_path));
        }
    }
    ?>

    <?php foreach ($data as $s): ?>
    <!-- Background image -->
    <div id="watermark">
        <img src="data:image/png;base64,<?= $background_image ?>" 
             style="width: 100%; height: 100%; object-fit: cover;">
    </div>

    <main>
        <div class="sertifikat-nomor">
            <h2>Nomor : <?= $s->no_sertifikat ?? " " ?></h2>
        </div>
        
        <div class="sertifikat-nama">
            <h2>Diberikan Kepada :</h2>
            <h1 style="font-weight: bold;"><?= htmlspecialchars($s->namaRS) ?></h1>
            <h2>Alamat : </h2>
            <h2><?= htmlspecialchars($s->ALAMAT) ?></h2>
        </div>
        
        <div class="sertifikat-tingkat">
            <h2>Tingkat Kelulusan</h2>
        </div>
        
        <div class="capayan-container">
            <?php if (isset($capayan_types[$s->capayan]) && isset($capayan_images[$s->capayan])): ?>
                <img src="data:image/png;base64,<?= $capayan_images[$s->capayan] ?>" 
                     alt="<?= htmlspecialchars($s->capayan) ?>">
            <?php endif; ?>
        </div>
        
        <div class="bsd">
            <h2>Berlaku Sampai : <?= tanggal_indonesia($s->tanggal_kadaluarsa_sertifikat) ?></h2>
            <h2>Jakarta, <?= tanggal_indonesia(date('Y-m-d')) ?></h2>
        </div>
        
        <div class="mengetahui">
            <h4>Mengetahui,</h4>
        </div>
    </main>
    <?php endforeach; ?>
</body>
</html>