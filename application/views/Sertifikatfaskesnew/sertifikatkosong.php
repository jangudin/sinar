<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Sertifikat</title>
  <style>
    @page { margin: 0cm; }
    body {
      font-family: 'Arial', sans-serif;
      margin-top: 180px;
      position: relative;
    }
    #watermark {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      z-index: -1000;
    }
    .sertifikat-nomor, .sertifikat-nama, .sertifikat-garis, .sertifikat-tingkat,
    .capayan, .capayanimgparipurna, .ttdlembaga, .ttddirjen, .berlaku {
      position: absolute;
      width: 100%;
      text-align: center;
    }
    .sertifikat-nomor { top: 25%; }
    .sertifikat-nama { top: 30%; }
    .sertifikat-garis { top: 33%; }
    .sertifikat-tingkat { top: 46%; font-size: 30px; font-weight: bold; }
    .capayan { top: 60%; font-size: 17px; }
    .berlaku { top: 67%; font-size: 17px; }
    .capayanimgparipurna {
      top: 52%;
      left: 25%;
      width: 100px;
      height: auto;
    }
    .ttdlembaga { top: 80%; left: 15%; }
    .ttddirjen { top: 80%; left: 55%; }
  </style>
</head>
<body>

<div id="watermark">
  <img src="<?= FCPATH ?>assets/faskesbg/backgroundsertifikat.jpeg" width="100%" height="100%">
</div>

<?php foreach ($data as $s): ?>
<main>
  <div class="sertifikat-nomor">
    Nomor: <?= $s->nomor_sertifikat ?? '123/ABC/2024'; ?>
  </div>

  <div class="sertifikat-nama">
    <h2><?= $s->nama_fasyankes; ?></h2>
  </div>

  <div class="sertifikat-garis"><hr></div>

  <div class="sertifikat-tingkat"><?= strtoupper($s->status_akreditasi); ?></div>

  <div class="capayan">
    Fasilitas pelayanan kesehatan ini telah memenuhi standar akreditasi
  </div>

  <div class="berlaku">
    Berlaku: <?= format_indo($s->tgl_surveior); ?> s.d <?= format_indo(date('Y-m-d', strtotime('+5 years', strtotime($s->tgl_surveior)))); ?>
  </div>

  <div class="capayanimgparipurna">
    <?php if ($s->img_capayan): ?>
      <img src="<?= $s->img_capayan ?>" width="100">
    <?php endif; ?>
  </div>

  <div class="ttdlembaga">
    <p>Kepala Lembaga</p>
    <img src="<?= base_url('assets/ttd/kepala.png') ?>" width="100">
  </div>

  <div class="ttddirjen">
    <p>Dirjen Pelayanan Kesehatan</p>
    <img src="<?= base_url('assets/ttd/dirjen.png') ?>" width="100">
  </div>
</main>
<?php endforeach; ?>

</body>
</html>