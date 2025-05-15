<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Sertifikat</title>
  <style>
    @page {
      margin: 0cm;
    }

    body {
      font-family: 'Arial', sans-serif;
      margin-top: 180px;
      margin-bottom: 0cm;
      margin-left: 0cm;
      margin-right: 0cm;
      position: relative;
    }

    #watermark {
      position: fixed;
      bottom: 0;
      left: 0;
      width: 29.7cm;
      height: 21cm;
      z-index: -1000;
    }

    .sertifikat-nomor,
    .sertifikat-nama,
    .sertifikat-garis,
    .sertifikat-tingkat,
    .capayan,
    .capayanimgparipurna,
    .capayanimgutama,
    .ttdlembaga,
    .ttddirjen,
    .berlaku,
    .tglprn,
    .tglsertifikat,
    .tglsekarang,
    .atasnama {
      position: fixed;
      margin: auto;
      text-align: center;
    }

    .sertifikat-nomor {
      top: 25%;
      width: 100%;
    }

    .sertifikat-nama {
      top: 30%;
      left: 14%;
      width: 800px;
    }

    .sertifikat-garis {
      top: 33%;
      left: 14%;
      width: 800px;
    }

    .sertifikat-tingkat {
      top: 46%;
      width: 100%;
    }

    .capayan {
      top: 60%;
      width: 100%;
    }

    .berlaku {
      top: 67%;
      width: 100%;
    }

    .capayanimgparipurna,
    .capayanimgutama {
      top: 52%;
      left: 25%;
    }

    .ttdlembaga {
      top: 80%;
      left: 15%;
    }

    .ttddirjen {
      top: 80%;
      left: 55%;
    }

    .title {
      font-size: 17px;
      font-weight: bold;
    }

    .desc {
      font-size: 17px;
    }

    .tingkat {
      font-size: 30px;
      font-weight: bold;
    }
  </style>
</head>

<body>
  <div id="watermark">
    <img src="<?= $background_base64 ?>" width="100%" height="100%" />
  </div>

  <?php foreach ($data as $s) { ?>
    <div class="sertifikat-nomor">
      <p style="font-size: 20px; color: red;">Nomor : <?= htmlspecialchars($s->nomor_sertifikat ?? '123/ABC/2024') ?></p>
    </div>

    <div class="sertifikat-nama title">
      <?= htmlspecialchars($s->nama_fasyankes) ?>
    </div>

    <div class="sertifikat-garis">
      <hr>
    </div>

    <div class="sertifikat-tingkat tingkat">
      <?= htmlspecialchars(strtoupper($s->status_akreditasi)) ?>
    </div>

    <div class="capayan desc">
      Telah mengikuti pelatihan dengan hasil memuaskan
    </div>

    <div class="berlaku">
      Berlaku hingga <?= date('d F Y', strtotime('+5 years', strtotime($s->tgl_surveior))) ?>
    </div>

    <div class="capayanimgparipurna">
      <?php if (!empty($s->capayan_base64)) : ?>
        <img src="<?= $s->capayan_base64 ?>" height="60" />
      <?php endif; ?>
    </div>

    <div class="ttdlembaga">
      <p>Kepala Lembaga</p>
      <img src="<?= $ttd_kepala_base64 ?>" width="100" />
    </div>

    <div class="ttddirjen">
      <p>Dirjen Pelayanan Kesehatan</p>
      <img src="<?= $ttd_dirjen_base64 ?>" width="100" />
    </div>

  <?php } ?>
</body>

</html>
