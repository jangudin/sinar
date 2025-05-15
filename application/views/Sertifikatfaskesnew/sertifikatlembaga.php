<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Sertifikat Akreditasi</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <style>
    body {
      margin: 0;
      font-family: sans-serif;
    }

    @page {
      margin: 0cm;
    }

    #watermark {
      position: fixed;
      top: 0;
      left: 0;
      width: 29.7cm;
      height: 21cm;
      z-index: -1000;
    }

    .container {
      position: relative;
      width: 100%;
      height: 100%;
      text-align: center;
    }

    .title {
      margin-top: 150px;
      font-size: 24px;
      font-weight: bold;
      color: red;
    }

    .info-table {
      margin: 50px auto 20px;
      width: 80%;
      font-size: 16px;
      text-align: left;
    }

    .info-table td {
      padding: 4px;
    }

    .desc {
      font-size: 16px;
      margin-top: 20px;
    }

    .capayan-img {
      margin-top: 20px;
    }

    .masa-berlaku {
      margin-top: 30px;
      font-size: 16px;
    }

    .logo-lembaga {
      margin-top: 50px;
    }

  </style>
</head>

<body>

  <!-- Background Sertifikat -->
  <div id="watermark">
    <img src="<?= $background_base64 ?>" width="100%" height="100%" />
  </div>

  <?php foreach ($data as $s): ?>
    <div class="container">

      <!-- Nomor Sertifikat -->
      <div class="title">
        Nomor Sertifikat
      </div>

      <!-- Informasi Faskes -->
      <table class="info-table">
        <tr>
          <td>Fasyankes</td>
          <td>:</td>
          <td><?= $s->nama_faskes ?></td>
        </tr>
        <tr>
          <td>Jenis</td>
          <td>:</td>
          <td><?= $s->jenis_faskes ?></td>
        </tr>
        <tr>
          <td>Alamat</td>
          <td>:</td>
          <td><?= $s->alamat ?></td>
        </tr>
        <tr>
          <td>Kecamatan</td>
          <td>:</td>
          <td><?= ucwords(strtolower($s->kecamatan)) ?></td>
        </tr>
        <tr>
          <td>Kab/Kota</td>
          <td>:</td>
          <td><?= ucwords(strtolower($s->kabkot)) ?></td>
        </tr>
        <tr>
          <td>Provinsi</td>
          <td>:</td>
          <td><?= $s->provinsi ?></td>
        </tr>
      </table>

      <!-- Deskripsi -->
      <div class="desc">
        sebagai pengakuan bahwa Fasilitas Pelayanan Kesehatan telah memenuhi standar akreditasi dan dinyatakan lulus:
      </div>

      <!-- Capayan Gambar -->
      <div class="capayan-img">
        <?php if ($s->status_akreditasi == 'Paripurna'): ?>
          <img src="<?= $capayan_paripurna ?>" height="60" />
        <?php elseif ($s->status_akreditasi == 'Utama'): ?>
          <img src="<?= $capayan_utama ?>" height="60" />
        <?php elseif ($s->status_akreditasi == 'Madya'): ?>
          <img src="<?= $capayan_madya ?>" height="60" />
        <?php elseif ($s->status_akreditasi == 'Dasar'): ?>
          <img src="<?= $capayan_dasar ?>" height="60" />
        <?php endif; ?>
      </div>

      <!-- Masa Berlaku -->
      <div class="masa-berlaku">
        Masa Berlaku: <?= format_indo($s->tgl_surveior) ?> s.d <?= format_indo(date('Y-m-d', strtotime('+5 year', strtotime($s->tgl_surveior)))) ?>
      </div>

      <!-- Logo -->
      <div class="logo-lembaga">
        <img src="<?= $s->logo ?>" height="90" />
      </div>

    </div>
    <div style="page-break-after: always;"></div>
  <?php endforeach; ?>

</body>
</html>