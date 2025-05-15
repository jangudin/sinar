<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Sertifikat</title>
  <style>
    @page { margin: 0cm; }
    body {
      margin: 180px 0 0 0;
      font-family: 'Arial', sans-serif;
    }

    #watermark {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      z-index: -1000;
    }

    .text-center { text-align: center; }
    .sertifikat-nama, .sertifikat-tingkat, .berlaku {
      margin-top: 20px;
      font-size: 20px;
    }

    .capayan-img {
      margin: 30px auto;
      width: 100px;
    }

    .ttd {
      position: absolute;
      bottom: 100px;
      width: 100%;
      display: flex;
      justify-content: space-around;
    }

    .ttd p {
      margin-bottom: 5px;
    }

    .ttd img {
      width: 100px;
    }
  </style>
</head>
<body>
  <div id="watermark">
    <img src="file://<?= FCPATH ?>assets/faskesbg/backgroundsertifikat.jpeg" width="100%" height="100%">
  </div>

  <?php foreach ($data as $s): ?>
    <div class="text-center sertifikat-nama"><?= $s->nama_fasyankes ?></div>
    <div class="text-center sertifikat-tingkat"><strong><?= strtoupper($s->status_akreditasi) ?></strong></div>
    <div class="text-center berlaku">
      Masa Berlaku: <?= format_indo($s->tgl_surveior) ?> s.d <?= format_indo(date('Y-m-d', strtotime('+5 year', strtotime($s->tgl_surveior)))) ?>
    </div>

    <?php if (!empty($s->img_capayan)): ?>
      <div class="text-center capayan-img">
        <img src="file://<?= $s->img_capayan ?>" alt="Capayan">
      </div>
    <?php endif; ?>

    <div class="ttd">
      <div class="text-center">
        <p>Kepala Lembaga</p>
        <img src="file://<?= FCPATH ?>assets/ttd/kepala.png">
      </div>
      <div class="text-center">
        <p>Dirjen Pelayanan Kesehatan</p>
        <img src="file://<?= FCPATH ?>assets/ttd/dirjen.png">
      </div>
    </div>
  <?php endforeach; ?>
</body>
</html>