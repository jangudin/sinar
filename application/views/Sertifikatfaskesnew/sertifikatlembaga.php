<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <style>
    @page { margin: 0cm; }
    body {
      margin-top: 180px;
      margin-left: 0;
      margin-right: 0;
      margin-bottom: 0;
      font-family: 'Bernard MT Condensed', sans-serif;
    }
    #watermark {
      position: fixed;
      bottom: 0;
      left: 0;
      width: 29.7cm;
      height: 21cm;
      z-index: -1000;
    }
    .fixed-block {
      position: fixed;
      width: 800px;
      text-align: center;
      margin: auto;
      left: 50%;
      transform: translateX(-50%);
    }
    .sertifikat-nomor { top: 25%; font-size: 20px; color: red; font-family: 'Germania One', cursive; }
    table {
      padding-left: 145px;
      padding-top: 80px;
      width: 100%;
      max-width: 900px;
      margin: 0 auto;
      border-collapse: collapse;
    }
    table thead td, table thead th { font-size: 18px; text-align: left; padding: 4px 8px; }
    table tbody td { padding: 2px 8px; vertical-align: top; }
    .bsd { top: 53%; font-size: 17px; }
    .berlaku { top: 67%; font-size: 17px; }
    .capayan { top: 60%; }
    .ttdlembaga { position: fixed; top: 80%; left: 15%; }
    .ceter { display: block; margin: 0 auto; }
  </style>
</head>
<body class="text-center">

<div id="watermark">
  <img src="<?= FCPATH ?>/faskesbg/backgroundsertifikat.jpeg" height="100%" width="100%" alt="Background Sertifikat" />
</div>

<?php foreach ($data as $s) : ?>
  <main>
    <div class="fixed-block sertifikat-nomor">
      Nomor: <?= htmlspecialchars($s->nomor_surat) ?>
    </div>

    <table>
      <thead>
        <tr>
          <td>
            <?php 
              if ($s->jenis_faskes == 'Pusat Kesehatan Masyarakat') echo 'Puskesmas';
              elseif ($s->jenis_faskes == 'Klinik') echo 'Klinik';
              elseif ($s->jenis_faskes == 'Laboratorium Kesehatan') echo 'Labkes';
              elseif ($s->jenis_faskes == 'Unit Transfusi Darah') echo 'UTD';
            ?>
          </td>
          <td>:</td>
          <th><?= htmlspecialchars($s->nama_faskes) ?></th>
        </tr>
      </thead>
      <tbody>
        <tr><td>Alamat</td><td>:</td><td width="700px"><?= htmlspecialchars($s->alamat) ?></td></tr>
        <tr><td>Kecamatan</td><td>:</td><td><?= ucwords(strtolower(htmlspecialchars($s->kecamatan))) ?></td></tr>
        <tr><td>Kabupaten / Kota</td><td>:</td><td><?= ucwords(strtolower(htmlspecialchars($s->kabkot))) ?></td></tr>
        <tr><td>Provinsi</td><td>:</td><td><?= ucwords(strtolower(htmlspecialchars($s->provinsi))) ?></td></tr>
      </tbody>
    </table>

    <div class="fixed-block bsd">
      sebagai pengakuan bahwa Fasilitas Pelayanan Kesehatan telah memenuhi standar akreditasi dan dinyatakan lulus :
    </div>

    <div class="fixed-block capayan">
      <?php if ($s->status_akreditasi == 'Paripurna'): ?>
        <img src="<?= $capayan_paripurna ?>" height="60" alt="Capayan Paripurna" />
      <?php elseif ($s->status_akreditasi == 'Utama'): ?>
        <img src="<?= $capayan_utama ?>" height="60" alt="Capayan Utama" />
      <?php elseif ($s->status_akreditasi == 'Madya'): ?>
        <img src="<?= $capayan_madya ?>" height="60" alt="Capayan Madya" />
      <?php elseif ($s->status_akreditasi == 'Dasar'): ?>
        <img src="<?= $capayan_dasar ?>" height="60" alt="Capayan Dasar" />
      <?php endif; ?>
    </div>

    <div class="fixed-block berlaku">
      Masa Berlaku : <?= format_indo($s->tgl_survei) ?> s.d <?= format_indo(date('Y-m-d', strtotime('+5 year', strtotime($s->tgl_survei)))) ?>
    </div>

    <div class="ttdlembaga">
      <img src="<?= $s->logo ?>" height="90" alt="Logo Lembaga" class="ceter" />
    </div>
  </main>
<?php endforeach; ?>

</body>
</html>
