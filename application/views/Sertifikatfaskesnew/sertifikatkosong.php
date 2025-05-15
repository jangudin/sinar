<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Sertifikat</title>
  <style>
    @page {
      margin: 0cm;
    }

    body {
      font-family: 'Arial', sans-serif;
      margin-top: 180px;
      margin-bottom: 0;
      margin-left: 0;
      margin-right: 0;
      position: relative;
    }

    #watermark {
      position: absolute;
      bottom: 0;
      left: 0;
      width: 100%;
      height: 100%;
      z-index: -1000;
    }

    .sertifikat-nomor,
    .sertifikat-nama,
    .sertifikat-garis,
    .sertifikat-tingkat,
    .capayan,
    .berlaku,
    .capayanimg,
    .ttdlembaga,
    .ttddirjen {
      position: absolute;
      margin: auto;
      text-align: center;
      width: 100%;
    }

    .sertifikat-nomor { top: 25%; }
    .sertifikat-nama { top: 30%; font-size: 24px; font-weight: bold; }
    .sertifikat-garis { top: 33%; }
    .sertifikat-tingkat { top: 46%; font-size: 28px; font-weight: bold; }
    .capayan { top: 60%; font-size: 20px; }
    .berlaku { top: 67%; font-size: 18px; }

    .capayanimg { top: 52%; }
    .ttdlembaga { top: 80%; left: 15%; text-align: left; }
    .ttddirjen { top: 80%; left: 60%; text-align: left; }
  </style>
</head>
<body>
  <div id="watermark">
    <img src="<?= base_url('assets/faskesbg/backgroundsertifikat.jpeg') ?>" width="100%" height="100%">
  </div>

  <?php foreach ($data as $s): ?>
    <div class="sertifikat-nomor">Nomor: <?= $s->nomor_sertifikat ?? '....' ?></div>
    <div class="sertifikat-nama"><?= strtoupper($s->nama_fasyankes) ?></div>
    <div class="sertifikat-garis"><hr></div>
    <div class="sertifikat-tingkat">TINGKAT <?= strtoupper($s->status_akreditasi) ?></div>
    <div class="capayan">Telah memenuhi standar akreditasi</div>
    <div class="berlaku">Berlaku: <?= format_indo($s->tgl_surveior) ?> s.d <?= format_indo(date('Y-m-d', strtotime('+5 years', strtotime($s->tgl_surveior)))) ?></div>

    <div class="capayanimg">
      <?php if ($s->status_akreditasi == 'Paripurna'): ?>
        <img src="<?= base_url('assets/faskessertif/capayan/paripurna.png') ?>" height="60">
      <?php elseif ($s->status_akreditasi == 'Utama'): ?>
        <img src="<?= base_url('assets/faskessertif/capayan/utama.png') ?>" height="60">
      <?php elseif ($s->status_akreditasi == 'Madya'): ?>
        <img src="<?= base_url('assets/faskessertif/capayan/madya.png') ?>" height="60">
      <?php elseif ($s->status_akreditasi == 'Dasar'): ?>
        <img src="<?= base_url('assets/faskessertif/capayan/dasar.png') ?>" height="60">
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
  <?php endforeach; ?>
</body>
</html>
