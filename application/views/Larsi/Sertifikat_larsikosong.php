<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <!-- CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Germania+One&display=swap" rel="stylesheet">
    <style>
        /* Page Setup */
        @page {
            margin: 0cm 0cm;
        }
        
        body {
            margin-top: 180px;
            margin-bottom: 0;
            margin-left: 0;
            margin-right: 0;
        }
        
        /* Watermark */
        #watermark {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 29.7cm;
            height: 42cm;
            z-index: -1000;
        }
        
        /* Certificate Components */
        .sertifikat-nomor {
            position: absolute;
            width: 100%;
            text-align: center;
            top: 300px;
        }
        
        .sertifikat-nama {
            position: fixed;
            top: 33%;
            left: 15%;
            width: 800px;
            text-align: center;
        }
        
        .sertifikat-tingkat {
            position: fixed;
            width: 100%;
            text-align: center;
            top: 51%;
            left: 0;
            right: 0;
            margin: 0 auto;
        }
        
        .capayan-container {
            position: fixed;
            width: 100%;
            text-align: center;
            top: 55%;
            left: 0;
            right: 0;
        }
        
        .bsd {
            position: fixed;
            width: 100%;
            text-align: center;
            top: 63%;
            left: 0;
            right: 0;
            margin: 0 auto;
        }
        
        .mengetahui {
            position: fixed;
            top: 72%;
            left: 14%;
        }
        
        /* Typography */
        .sertifikat-nomor h2,
        .sertifikat-tingkat h2,
        .bsd h3 {
            font-size: 24px;
            margin: 0;
            padding: 0;
            font-weight: normal;
        }
        
        .nmrs {
            font-family: 'Germania One', cursive;
        }
        
        /* Images */
        .capayanimgparipurna,
        .capayanimgutama,
        .capayanimgmadya {
            display: block;
            margin: 0 auto;
            max-width: 370px;
            height: 120px;
        }
    </style>
</head>

<body class="text-center">
    <?php foreach ($data as $s): ?>
    <div id="watermark">
        <img src="https://sinar.kemkes.go.id/assets/sertifikat/larsi.png" height="100%" width="100%" alt="Background">
    </div>
    
    <main>
        <div class="sertifikat-nomor">
            <h2 class="mt-5">
                Nomor : <?= $s->no_sertifikat ?? " " ?>
            </h2>
        </div>
        
        <div class="sertifikat-nama">
            <h3 class="mt-1">Diberikan Kepada :</h3>
            <h1 class="mt-3 font-weight-bold"><?= $s->namaRS ?></h1>
            <h3 class="mt-5">Alamat : </h3>
            <h4 class="mt-1 mb-2"><?= $s->ALAMAT ?></h4>
        </div>
        
        <div class="sertifikat-tingkat">
            <h2 class="mt-4 mb-5">Tingkat Kelulusan</h2>
        </div>
        
        <div class="capayan-container">
            <?php 
            $capayan_types = [
                'Utama' => 'UtamaLarsi',
                'Madya' => 'MadyaLarsi',
                'Paripurna' => 'ParipurnaLarsi'
            ];
            
            if (isset($capayan_types[$s->capayan])): 
            ?>
                <img src="https://sinar.kemkes.go.id/assets/capayan/<?= $capayan_types[$s->capayan] ?>.png" 
                     alt="<?= $s->capayan ?>" 
                     class="capayanimgmadya">
            <?php endif; ?>
        </div>
        
        <div class="bsd">
            <h3 class="mt-4 mb-5">Berlaku Sampai : <?= tanggal_indonesia($s->tanggal_kadaluarsa_sertifikat) ?></h3>
            <h3 class="mt-4 mb-5">Jakarta, <?= tanggal_indonesia(date('Y-m-d')) ?></h3>
        </div>
        
        <div class="mengetahui">
            <h4 class="mt-4">Mengetahui,</h4>
        </div>
    </main>
    <?php endforeach; ?>
</body>
</html>