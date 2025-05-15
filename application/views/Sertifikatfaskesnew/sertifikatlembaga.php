<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Germania+One&display=swap" rel="stylesheet">
  <style>
    .nmrs {
      font-family: 'Germania One', cursive;
    }

    @page {
      margin: 0cm 0cm;
    }

    body {
      margin-top: 180px;
      margin-bottom: 0cm;
      margin-left: 0cm;
      margin-right: 0cm;
    }

    #watermark {
      position: fixed;
      bottom: 0px;
      left: 0px;
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
      .bsd,
      .berlaku,
      .tglprn,
      .tglsertifikat,
      .tglsekarang,
      .atasnama {
        position: fixed;
        margin: auto;
        left: 0;
        right: 0;
        text-align: center;
      }
    .sertifikat-nomor {
      top: 25%;
      text-align: center;
    }

    .sertifikat-nama {
      top: 30%;
      left: 14%;
      text-align: center;
      width: 800px;
    }

    .sertifikat-garis {
      top: 33%;
      left: 14%;
      text-align: center;
      width: 800px;
    }

    .sertifikat-tingkat {
      top: 46%;
      text-align: center;
    }

    .capayan {
      top: 60%;
      text-align: center;
    }

    .berlaku {
      top: 67%;
      text-align: center;
    }

    .capayanimgparipurna,
    .capayanimgutama {
      top: 52%;
      left: 25%;
      position: fixed;
    }

    /* .ttdlembaga {
      top: 100%;
      left: 0%;
    } */

    /* .ttddirjen {
      top: 80%;
      left: 55%;
    } */

    .tglprn,
    .tglsertifikat,
    .tglsekarang,
    .atasnama {
      position: fixed;
      margin: auto;
    }

    .title,
    .desc,
    .tingkat {
      font-family: 'bernard-mt-condensed-regular', sans-serif;
    }

    .title {
      font-size: 17px;
    }

    .desc {
      font-size: 17px;
    }

    .tingkat {
      font-size: 30px;
      font-weight: bold;
    }

    /* Responsiveness */
    @media (max-width: 768px) {
      .sertifikat-nama {
        width: 90%;
        left: 5%;
      }

      .sertifikat-garis {
        width: 90%;
        left: 5%;
      }

      .capayanimgparipurna,
      .capayanimgutama {
        top: 55%;
        left: 15%;
      }

      .ttd-container {
        position: fixed;
        bottom: 80px;
        left: 0;
        width: 100%;
        display: flex;
        justify-content: space-between;
        padding: 0 100px;
      }

      .ttdlembaga, .ttddirjen {
        text-align: Left;
      }
    }
  </style>
</head>

<body class="text-center">

  <div id="watermark">
    <img src="<?= $background_base64 ?>" width="100%" height="100%" />
  </div>

  <?php foreach ($data as $s) { ?>
    <main>
      <div class="sertifikat-nomor">
        <p style="font-size: 20px; color: red ;">Nomor : </p>
      </div>
      <table style="padding-left: 145px; padding-top:80px;">
        <thead>
          <tr>
            <td>
              <?php if ($s->jenis_faskes == 'Pusat Kesehatan Masyarakat'): ?>
                Puskesmas
              <?php elseif ($s->jenis_faskes == 'Klinik'): ?>
                Klinik
              <?php elseif ($s->jenis_faskes == 'Laboratorium Kesehatan'): ?>
                Labkes
              <?php elseif ($s->jenis_faskes == 'Unit Transfusi Darah'): ?>
                UTD
              <?php endif; ?>
            </td>
            <td>:</td>
            <th style="font-size: 18px;"><?= $s->nama_faskes; ?></th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Alamat </td>
            <td>:</td>
            <td width="700px"><?= $s->alamat; ?></td>
          </tr>
          <tr>
            <td>Kecamatan</td>
            <td>:</td>
            <td><?= ucwords(strtolower($s->kecamatan)); ?></td>
          </tr>
          <tr>
            <td>Kabupaten / Kota </td>
            <td> : </td>
            <td><?= ucwords(strtolower($s->kabkot)); ?></td>
          </tr>
          <tr>
            <td>Provinsi </td>
            <td>:</td>
            <td><?= $s->provinsi; ?></td>
          </tr>
        </tbody>
      </table>

      <div class="bsd">
        <p class="desc">sebagai pengakuan bahwa Fasilitas Pelayanan Kesehatan telah memenuhi standar akreditasi dan dinyatakan lulus :</p>
      </div>

      <div class="capayan">
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

      <div class="berlaku">
        <p class="desc">Masa Berlaku : <?= format_indo($s->tgl_survei) ?> s.d <?= format_indo(date('Y-m-d', strtotime('+5 year', strtotime($s->tgl_survei)))); ?></p>
      </div>

      <div class="ttd-container">
        <div class="ttdlembaga">
            <img src="<?= $s->logo ?>" height="90" style="position: absolute; bottom: 80px; left: 350px;" />
        </div>
      </div>

    </main>
  <?php } ?>
</body>
</html>