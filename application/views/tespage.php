<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    .capayanimgparipurna,
    .capayanimgutama,
    .ttdlembaga,
    .ttddirjen,
    .berlaku,
    .tglprn,
    .tglsertifikat,
    .tglsekarang,
    .atasnama {
      position: absolute;
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
    <img src="https://sinar.kemkes.go.id/assets/faskesbg/backgroundsertifikat.jpeg" width="100%" height="100%">
  </div>

  <div class="sertifikat-nomor">Nomor: 123/ABC/2024</div>
  <div class="sertifikat-nama title">Nama Lengkap Peserta</div>
  <div class="sertifikat-garis"><hr></div>
  <div class="sertifikat-tingkat tingkat">TINGKAT PARIPURNA</div>
  <div class="capayan desc">Telah mengikuti pelatihan dengan hasil memuaskan</div>
  <div class="berlaku">Berlaku hingga 31 Desember 2025</div>
  <div class="capayanimgparipurna">
    <img src="https://sinar.kemkes.go.id/assets/faskesbg/paripurna.png" width="100">
  </div>
  <div class="ttdlembaga">
    <p>Kepala Lembaga</p>
    <img src="https://sinar.kemkes.go.id/assets/ttd/kepala.png" width="100">
  </div>
  <div class="ttddirjen">
    <p>Dirjen Pelayanan Kesehatan</p>
    <img src="https://sinar.kemkes.go.id/assets/ttd/dirjen.png" width="100">
  </div>
</body>
</html>
