<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Sertifikat Akreditasi Faskes</title>
  <link href="https://fonts.googleapis.com/css2?family=Germania+One&display=swap" rel="stylesheet">
  <style>
    @page {
      margin: 0cm;
    }

    body {
      margin: 180px 0 0 0;
      font-family: sans-serif;
    }

    #watermark {
      position: fixed;
      bottom: 0;
      left: 0;
      width: 29.7cm;
      height: 21cm;
      z-index: -1000;
    }

    .text-center {
      text-align: center;
    }

    .sertifikat-nomor,
    .sertifikat-tingkat,
    .capayan,
    .berlaku,
    .bsd {
      position: fixed;
      width: 100%;
      text-align: center;
    }

    .sertifikat-nomor { top: 25%; }
    .bsd { top: 53%; }
    .capayan { top: 60%; }
    .berlaku { top: 67%; }
    .sertifikat-tingkat { top: 46%; }

    .ttdlembaga {
      position: fixed;
      top: 80%;
      left: 15%;
    }

    .ttddirjen {
      position: fixed;
      top: 80%;
      left: 55%;
    }

    table {
      position: relative;
      margin-top: 100px;
      margin-left: 145px;
      font-size: 16px;
    }

    .desc {
      font-size: 17px;
      font-family: 'bernard-mt-condensed-regular', sans-serif;
    }

    .tingkat {
      font-size: 30px;
      font-weight: bold;
      font-family: 'bernard-mt-condensed-regular', sans-serif;
    }

    img {
      max-width: 100%;
    }
  </style>
</head>

<body>

  <div id="watermark">
    <img src="<?= $background_base64 ?>" alt="Background" width="100%" height="100%">
  </div>

  <?php foreach ($data as $s): ?>
    <main>

      <div class="sertifikat-nomor">
        <p style="font-size: 20px; color: red;">Nomor: <?= $s->nomor_surat ?? '-' ?></p>
      </div>

      <table>
        <tr>
          <td>
            <?php if ($s->jenis_fasyankes_nama == 'Pusat Kesehatan Masyarakat'): ?>
              Puskesmas
            <?php elseif ($s->jenis_fasyankes_nama == 'Klinik'): ?>
              Klinik
            <?php elseif ($s->jenis_fasyankes_nama == 'Laboratorium Kesehatan'): ?>
              Labkes
            <?php elseif ($s->jenis_fasyankes_nama == 'Unit Transfusi Darah'): ?>
              UTD
            <?php endif; ?>
          </td>
          <td>:</td>
          <td><strong><?= $s->nama_fasyankes ?></strong></td>
        </tr>
        <tr>
          <td>Alamat</td>
          <td>:</td>
          <td><?= $s->alamat ?></td>
        </tr>
        <tr>
          <td>Kecamatan</td>
          <td>:</td>
          <td><?= ucwords(strtolower($s->nama_camat)) ?></td>
        </tr>
        <tr>
          <td>Kabupaten / Kota</td>
          <td>:</td>
          <td><?= ucwords(strtolower($s->nama_kota)) ?></td>
        </tr>
        <tr>
          <td>Provinsi</td>
          <td>:</td>
          <td><?= $s->nama_prop ?></td>
        </tr>
      </table>

      <div class="bsd">
        <p class="desc">sebagai pengakuan bahwa Fasilitas Pelayanan Kesehatan telah memenuhi standar akreditasi dan dinyatakan lulus:</p>
      </div>

      <div class="capayan">
        <?php if ($s->status_akreditasi == 'Paripurna'): ?>
          <img src="<?= $capayan_paripurna ?>" height="60" alt="Paripurna">
        <?php elseif ($s->status_akreditasi == 'Utama'): ?>
          <img src="<?= $capayan_utama ?>" height="60" alt="Utama">
        <?php elseif ($s->status_akreditasi == 'Madya'): ?>
          <img src="<?= $capayan_madya ?>" height="60" alt="Madya">
        <?php elseif ($s->status_akreditasi == 'Dasar'): ?>
          <img src="<?= $capayan_dasar ?>" height="60" alt="Dasar">
        <?php endif; ?>
      </div>

      <div class="berlaku">
        <p class="desc">Masa Berlaku: <?= format_indo($s->tgl_surveior) ?> s.d <?= format_indo(date('Y-m-d', strtotime('+5 years', strtotime($s->tgl_surveior)))) ?></p>
      </div>

      <div class="ttdlembaga">
        <img src="<?= $s->logo ?>" height="90" alt="Logo Lembaga">
      </div>

      <div class="ttddirjen">
        <img src="<?= $ttd_dirjen ?>" height="90" alt="TTD Dirjen">
      </div>

    </main>
  <?php endforeach; ?>

</body>
</html>
