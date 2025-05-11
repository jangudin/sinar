<!DOCTYPE html>
<html>
<head>
    <style>
        @page { margin: 0cm; }
        body {
            margin: 0cm;
            font-family: Arial, sans-serif;
            position: relative;
        }
        #watermark {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
        }
        #watermark img {
            width: 100%;
            height: 100%;
        }
        .nomor-sertifikat {
            position: absolute;
            top: 50px;
            left: 100px;
            font-size: 14px;
        }
        .nama-peserta {
            position: absolute;
            top: 210px;
            left: 0;
            right: 0;
            text-align: center;
            font-size: 28px;
            font-weight: bold;
        }
        .tingkat {
            position: absolute;
            top: 270px;
            left: 0;
            right: 0;
            text-align: center;
            font-size: 18px;
        }
        .bsd {
            position: absolute;
            top: 320px;
            left: 0;
            right: 0;
            text-align: center;
            font-size: 18px;
        }
        .berlaku {
            position: absolute;
            top: 360px;
            left: 100px;
            font-size: 14px;
        }
        .capayan {
            position: absolute;
            top: 400px;
            left: 100px;
            font-size: 14px;
        }
        .ttd-lembaga {
            position: absolute;
            bottom: 150px;
            left: 100px;
            font-size: 14px;
        }
        .ttd-dirjen {
            position: absolute;
            bottom: 150px;
            right: 100px;
            font-size: 14px;
        }
        .tgl-terbit {
            position: absolute;
            bottom: 100px;
            left: 100px;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div id="watermark">
        <img src="<?= base_url('assets/img/sertifikat-template.jpg') ?>" alt="Background">
    </div>

    <div class="nomor-sertifikat">Nomor: <?= $data->nomor_sertifikat ?></div>
    <div class="nama-peserta"><?= strtoupper($data->nama) ?></div>
    <div class="tingkat">Telah mengikuti pelatihan tingkat <?= $data->tingkat ?></div>
    <div class="bsd">Bidang Studi: <?= $data->bidang_studi ?></div>
    <div class="berlaku">Berlaku sampai: <?= date('d-m-Y', strtotime($data->tanggal_akhir)) ?></div>
    <div class="capayan">Capaian: <?= $data->capaian_kompetensi ?></div>
    <div class="ttd-lembaga">Kepala Lembaga <br><br><br> (Tanda Tangan)</div>
    <div class="ttd-dirjen">Dirjen GTK <br><br><br> (Tanda Tangan)</div>
    <div class="tgl-terbit">Diterbitkan: <?= date('d-m-Y', strtotime($data->tanggal_terbit)) ?></div>
</body>
</html>
