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
            background: url('data:image/png;base64,<?= base64_encode(file_get_contents(FCPATH . 'assets/sertifikat/larsi.png')) ?>') no-repeat center;
            background-size: 100% 100%;
            page-break-after: avoid;
        }
        
        main {
            position: relative;
            width: 100%;
            height: 100vh;
            padding-top: 100px;
            page-break-inside: avoid;
        }
        
        .sertifikat-nomor {
            position: relative;
            width: 100%;
            text-align: center;
            margin-top: 200px;
        }
        
        .sertifikat-nama {
            width: 800px;
            margin: 30px auto;
            text-align: center;
        }
        
        .sertifikat-tingkat {
            width: 100%;
            text-align: center;
            margin: 20px auto;
        }
        
        .capayan-container {
            position: relative;
            width: 100%;
            text-align: center;
            margin: 20px auto;
        }

        .capayan-container img {
            display: block;
            margin: 15px auto;
            width: 370px;
            height: 120px;
        }
        
        .bsd {
            width: 100%;
            text-align: center;
            margin: 25px auto;
        }
        
        .mengetahui {
            margin-left: 14%;
            margin-top: 20px;
        }
        
        /* Typography */
        h1, h2, h3, h4 {
            margin: 8px 0;
            padding: 0;
        }
    </style>
</head>

<body>
    <?php foreach ($data as $s): ?>
    <main>
        <div class="sertifikat-nomor">
            <h2>Nomor : <?= $s->no_sertifikat ?? " " ?></h2>
        </div>
        
        <div class="sertifikat-nama">
            <h3>Diberikan Kepada :</h3>
            <h1 style="font-weight: bold;"><?= htmlspecialchars($s->namaRS) ?></h1>
            <h3>Alamat : </h3>
            <h4><?= htmlspecialchars($s->ALAMAT) ?></h4>
        </div>
        
        <div class="sertifikat-tingkat">
            <h2>Tingkat Kelulusan</h2>
        </div>
        
        <div class="capayan-container">
            <?php 
            $capayan_type = [
                'Utama' => 'UtamaLarsi',
                'Madya' => 'MadyaLarsi',
                'Paripurna' => 'ParipurnaLarsi'
            ];
            if (isset($capayan_type[$s->capayan])): 
                $img_path = FCPATH . "assets/capayan/{$capayan_type[$s->capayan]}.png";
                if (file_exists($img_path)):
            ?>
                <img src="data:image/png;base64,<?= base64_encode(file_get_contents($img_path)) ?>" 
                     alt="<?= htmlspecialchars($s->capayan) ?>">
            <?php 
                endif;
            endif; 
            ?>
        </div>
        
        <div class="bsd">
            <h3>Berlaku Sampai : <?= tanggal_indonesia($s->tanggal_kadaluarsa_sertifikat) ?></h3>
            <h3>Jakarta, <?= tanggal_indonesia(date('Y-m-d')) ?></h3>
        </div>
        
        <div class="mengetahui">
            <h4>Mengetahui,</h4>
        </div>
    </main>
    <?php endforeach; ?>
</body>
</html>