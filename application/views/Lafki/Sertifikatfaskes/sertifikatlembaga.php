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
            /** 
            * Set the margins of the PDF to 0
            * so the background image will cover the entire page.
            **/
            @page {
                margin: 0cm 0cm;
            }

            /**
            * Define the real margins of the content of your PDF
            * Here you will fix the margins of the header and footer
            * Of your background image.
            **/
            body {
                margin-top:    180px;
                margin-bottom: 0cm;
                margin-left:   0cm;
                margin-right:  0cm;
            }

            /** 
            * Define the width, height, margins and position of the watermark.
            **/
            #watermark {
                position: fixed;
                bottom:   0px;
                left:     0px;
                /** The width and height may change 
                    according to the dimensions of your letterhead
                **/
                width:    29.7cm;
                height:   21cm;

                /** Your watermark should be behind every content**/
                z-index:  -1000;
            }
            .sertifikat-nomor {
                            top: 25%;
                            text-align: center;
                            position: fixed;
                            marging: auto;
                          }
            .sertifikat-nama {
                            top: 30%;
                            left: 14%;
                            text-align: center;
                            position: fixed;
                            width:800px;
                          }

             .sertifikat-garis {
                            top: 33%;
                            left: 14%;
                            text-align: center;
                            position: fixed;
                            width:800px;
                          }
            .sertifikat-tingkat {
                      top: 46%;
                      text-align: center;
                      position: fixed;
                      marging: auto;
                          }
            .fixed {
                      position: fixed;
                      bottom: 0;
                      right: 0;
                      width: 300px;
                      border: 3px solid #73AD21;
                    }
            .capayanimgparipurna {
                      top: 52%;
                      left : 25%;
                      position: fixed;
                      marging: auto;
                  }
            .capayanimgutama {
                    top: 55%;
                      left:35 %;
                      position: fixed;
                      marging: auto;
                  }
            .ttdlembaga {
                    top: 80%;
                      left:15 %;
                      position: fixed;
                      marging: auto;
                  }
            .ttddirjen {
                    top: 80%;
                      left:55 %;
                      position: fixed;
                      marging: auto;
                  }
          .bsd{
                    top: 53%;
                    text-align: center;
                      position: fixed;
                      marging: auto;
          }
          .berlaku{
                    top: 67%;
                    text-align: center;
                      position: fixed;
                      marging: auto;
          }
          .capayan{
                    top: 60%;
                    text-align: center;
                      position: fixed;
                      marging: auto;
          }
          .tglprn{
                    top: 72%;
                    left: 10%;
                      position: fixed;
                      marging: auto;
                  }
          .tglsertifikat{
                    top: 70%;
                    left:12%;
                      position: fixed;
                      marging: auto;
          }
          .tglsekarang{
                    top: 70%;
                    left:55%;
                      position: fixed;
                      marging: auto;
          }
          .atasnama{
                    top: 71.5%;
                    left:55%;
                      position: fixed;
                      marging: auto;
          }
          code {
                  font-family: Consolas, Monaco, Courier New, Courier, monospace;
                  font-size: 18px;
                  color:  black;
                }
          .p3 {
                 font-family: "Lucida Console", "Courier New", monospace;
                    }
          .title{
                font-family: 'bernard-mt-condensed-regular', sans-serif;
                font-size:  17px;
              }
          .desc{
                font-family: 'bernard-mt-condensed-regular', sans-serif;
                font-size:  17px;
              }
          .tingkat{
                font-family: 'bernard-mt-condensed-regular', sans-serif;
                font-size:  30px;
                font-weight: bold;
              }
        </style>
    </head>
    <body class="text-centre">

        <div id="watermark">
            <img src="https://sinar.kemkes.go.id/assets/faskesbg/backgroundsertifikat.jpeg" height="100%" width="100%" />
        </div>
        <?php foreach ($data as $s) { ?>
        <main>
          <div class="sertifikat-nomor">
            <p style="font-size: 20px; color: red ;">Nomor : <?=$s->nomor_surat ?></p>
          </div>
           <div class="sertifikat-nama">
            <?php if ($s->jenis_faskes == 'Pusat Kesehatan Masyarakat'): ?>
                <h4 class="mt-2" style="font-weight: bold; letter-spacing: -1px;" >PUSKESMAS <?= strtoupper($s->nama_faskes); ?></h4>
              <?php elseif ($s->jenis_faskes == 'Klinik'): ?>
                <h4 class="mt-2" style="font-weight: bold; letter-spacing: -1px;" ><?= strtoupper($s->nama_faskes); ?></h4>
              <?php endif; ?>
            </div>
            <div class="sertifikat-garis">
             <hr size="10" width="70%" style="background-color: black;" >
            </div>
            <table style="padding-left: 145px; padding-top:130px;">
                    <tbody>
                      <tr>
                        <td>Alamat  </td>
                        <td>:</td>
                        <td><?=$s->alamat ?></td>
                      </tr>
                      <tr>
                        <td>Kecamatan</td>
                        <td>:</td>
                        <td><?= ucwords(strtolower($s->kecamatan));?></td>
                      </tr>
                      <tr>
                        <td>Kabupaten / Kota  </td>
                        <td> : </td>
                        <td><?=ucwords(strtolower($s->provinsi)); ?></td>
                      </tr>
                      <tr>
                        <td>Provinsi  </td>
                        <td>:</td>
                        <td><?=ucwords(strtolower($s->kabkot)); ?></td>
                      </tr>
                    </tbody>
                  </table>
            <div class="sertifikat-tingkat">
            </div>
            <div class="bsd">
          <p class="desc">sebagai pengakuan bahwa Fasilitas Pelayanan Kesehatan telah memenuhi standar akreditasi dan dinyatakan lulus :</p>
          </div>
          <div class="capayan">
            <?php if ($s->capayan == 'Paripurna'): ?>
            <img src="https://sinar.kemkes.go.id/assets/faskessertif/capayan/paripurna.png" height=60 class="center">
            <?php elseif ($s->capayan == 'Utama'): ?>
            <img src="https://sinar.kemkes.go.id/assets/faskessertif/capayan/utama.png" height=60 class="center">
            <?php elseif ($s->capayan == 'Madya'): ?>
            <img src="https://sinar.kemkes.go.id/assets/faskessertif/capayan/madya.png" height=60 class="center">
            <?php elseif ($s->capayan == 'Dasar'): ?>
            <img src="https://sinar.kemkes.go.id/assets/faskessertif/capayan/dasar.png" height=60 class="center">
            <?php endif; ?>
          </div>
          <div class="berlaku">
          <p class="desc">Masa Berlaku : <?=format_indo($s->tgl_surveior) ?> s.d <?= format_indo(date('Y-m-d', strtotime('+5 year', strtotime($s->tgl_surveior))));?></p>
          </div>
          
          <?php if ($s->jenis_faskes == 'Pusat Kesehatan Masyarakat'): ?>
                <div class="tglsekarang">
                <!-- <p class="mt-4">Jakarta, <?= format_indo(date('Y-m-d'));?></p> -->
                </div>
              <?php elseif ($s->jenis_faskes == 'Klinik'): ?>
                <div class="tglsekarang">
                <!-- <p class="mt-3">Jakarta, <?= format_indo(date('Y-m-d'));?></p> -->
                </div>
                <div class="atasnama">
                <!-- <p class="mt-4">a.n. Direktur Jenderal Pelayanan Kesehatan</p> -->
                </div>
              <?php endif; ?>
          <div class="ttdlembaga">
             <img src="<?=$s->logo_ttd ?>" height=90 class="ceter">
          </div>
        </main>
      <?php } ?>
    </body>
</html>