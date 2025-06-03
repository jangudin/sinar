<!doctype html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Germania+One&display=swap" rel="stylesheet">
  <style>
    .nmrs {
      font-family: 'Germania One', cursive;
    }
  </style>
  <style>
    @page {
        margin: 0cm 0cm;
        size: A4 landscape;
    }

    body {
        margin: 0;
        padding: 0;
        font-family: 'bernard-mt-condensed-regular', sans-serif;
        position: relative;
        height: 21cm;
        width: 29.7cm;
    }

    #watermark {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: -1000;
    }

    #watermark img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    main {
        position: relative;
        z-index: 1;
        padding: 2cm 1.5cm;
    }

    .fixed-container {
        position: relative;
        width: 100%;
        height: 100%;
    }

    /* Header Section */
    .sertifikat-nomor {
        text-align: center;
        margin-bottom: 0.5cm;
    }

    .sertifikat-nomor p {
        font-size: 20px;
        color: red;
        margin: 0;
    }

    .sertifikat-pm {
        text-align: center;
        margin-bottom: 1cm;
    }

    .sertifikat-pm p {
        font-size: 25px;
        font-weight: bold;
        margin: 0;
    }

    /* Content Section */
    .sertifikat-nama {
        text-align: center;
        margin: 1cm auto;
        width: 800px;
    }

    .sertifikat-nama p {
        font-size: 25px;
        font-weight: bold;
        letter-spacing: -1px;
        margin: 0;
    }

    .alamat-table {
        width: 80%;
        margin: 1cm auto;
        font-size: 18px;
    }

    .alamat-table td {
        padding: 0.2cm 0;
    }

    /* Status Section */
    .bsd {
        text-align: center;
        margin: 1cm auto;
    }

    .desc {
        font-size: 17px;
        margin: 0.5cm 0;
    }

    .capayan {
        text-align: center;
        margin: 1cm auto;
    }

    .capayan img {
        max-height: 260px;
        display: block;
        margin: 0 auto;
    }

    .berlaku {
        text-align: center;
        margin: 1cm auto;
    }

    /* Typography */
    .title {
        font-size: 17px;
    }

    .tingkat {
        font-size: 30px;
        font-weight: bold;
    }

    /* Print Settings */
    @media print {
        body {
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        
        #watermark {
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
    }
</style>
</head>
<body class="text-centre">

  <div id="watermark">
    <img src="http://192.168.67.143/sinar/assets/faskesbg/backgroundsertifikat.jpeg" height="100%" width="100%" />
  </div>
  <?php foreach ($data as $s) { ?>
    <main>
      <div class="sertifikat-nomor">
        <p style="font-size: 20px; color: red ;">Nomor : </p><br>
      </div>
            <div class="sertifikat-pm">
              <br>
             <p style="font-size: 25px; font-weight: bold;">PRAKTIK MANDIRI DOKTER/DOKTER GIGI</p>
            </div>
      <div class="sertifikat-nama">
                <p class="mt-2" style="font-size: 25px; font-weight: bold; letter-spacing: -1px;" ><?=$s->nama_pm; ?></p>
            </div>

            <br>
            <br>
      <table class="alamat-table">
        <thead>
          <tr>
            <td>
          </td>
          <td></td>
          <th style="font-size: 18px;"></th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>Alamat  </td>
          <td>:</td>
          <td width="700px"><?=$s->alamat_faskes;?></td>
        </tr>
        <tr>
          <td>Kecamatan</td>
          <td>:</td>
          <td><?= ucwords(strtolower($s->nama_camat));?></td>
        </tr> 
        <tr>
          <td>Kabupaten / Kota  </td>
          <td> : </td>
          <td><?=ucwords(strtolower($s->nama_kota_temp1)); ?></td>
        </tr>
        <tr>
          <td>Provinsi  </td>
          <td>:</td>
          <td><?=$s->nama_prop; ?></td>
        </tr>
      </tbody>
    </table>
    <div class="sertifikat-tingkat">
    </div>
    <div class="bsd">
      <p class="desc">sebagai pengakuan bahwa Fasilitas Pelayanan Kesehatan telah memenuhi standar akreditasi dan dinyatakan :</p>
    </div>
    <div class="capayan">
<!--       <?php if ($s->status_akreditasi == 'Paripurna'): ?>
        <img src="https://sinar.kemkes.go.id/assets/faskessertif/capayan/paripurna.png" height=60 class="center">
      <?php elseif ($s->status_akreditasi == 'Utama'): ?>
        <img src="https://sinar.kemkes.go.id/assets/faskessertif/capayan/utama.png" height=60 class="center">
      <?php elseif ($s->status_akreditasi == 'Madya'): ?>
        <img src="https://sinar.kemkes.go.id/assets/faskessertif/capayan/madya.png" height=60 class="center">
      <?php elseif ($s->status_akreditasi == 'Dasar'): ?>
        <img src="https://sinar.kemkes.go.id/assets/faskessertif/capayan/dasar.png" height=60 class="center">
      <?php endif; ?> -->
              <img src="https://sinar.kemkes.go.id/assets/faskessertif/capayan/terakreditasi.png" height=260 class="center">
    </div>
    <div class="berlaku">
      <p class="desc">Masa Berlaku : <?= format_indo(date('Y-m-d', strtotime($tgls))); ?> s.d <?= format_indo(date('Y-m-d', strtotime('+5 year', strtotime($tgls))));?></p>
    </div>


  </main>
<?php } ?>
</body>
</html>