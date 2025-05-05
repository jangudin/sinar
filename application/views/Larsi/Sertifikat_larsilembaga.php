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
                height:   42cm;

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
                            top: 33%;
                            left: 15%;
                            text-align: center;
                            position: fixed;
                            width:800px;
                          }
            .sertifikat-tingkat {
                      top: 51%;
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
                    top: 55%;
                      left:33 %;
                      position: fixed;
                      marging: auto;
                  }
            .capayanimgutama {
                    top: 55%;
                      left:33 %;
                      position: fixed;
                      marging: auto;
                  }
            .capayanimgmadya {
                    top: 55%;
                      left:33 %;
                      position: fixed;
                      marging: auto;
                  }
          .bsd{
                    top: 63%;
                    text-align: center;
                      position: fixed;
                      marging: auto;
          }
          .tglsertifikat{
                    top: 70%;
                    left:12%;
                      position: fixed;
                      marging: auto;
          }
          .mengetahui{
                    top: 72%;
                    left:14%;
                      position: fixed;
                      marging: auto;
          }
        </style>
    </head>
    <body class="text-centre">
      <?php foreach ($data as $s) { ?>
        <div id="watermark">
            <img src="https://sinar.kemkes.go.id/assets/sertifikat/larsilembaga.jpg" height="100%" width="100%" />
        </div>
        <main>
          <div class="sertifikat-nomor">
            <h2 class="mt-5">Nomor : <?php if($s->no_sertifikat == null){ ?> <?php echo " ";?> <?php }else{ ?> <?=$s->no_sertifikat?><?php } ?></h2>
          </div>
           <div class="sertifikat-nama">
            <h3 class="mt-1">Diberikan Kepada :</h3>
            <h1 class="mt-3" style="font-weight: bold;" ><?= $s->namaRS?></h1>
            <h3 class="mt-5">Alamat : </h3>
            <h4 class="mt-1 mb-2"><?= $s->ALAMAT ?></h4>
          </div>
       <div class="sertifikat-tingkat">
            <h2 class="mt-4 mb-5">Tingkat Kelulusan</h2>
          </div>

          <div>
        <?php if ($s->capayan == 'Utama'): ?>
            <img src="https://sinar.kemkes.go.id/assets/capayan/UtamaLarsi.png" alt=""height=120 width=370 class="capayanimgutama"></img>
        <?php elseif ($s->capayan == 'Madya'): ?>
            <img src="https://sinar.kemkes.go.id/assets/capayan/MadyaLarsi.png" alt=""height=120 width=370 class="capayanimgmadya"></img>
        <?php elseif ($s->capayan == 'Paripurna'): ?>
            <img src="https://sinar.kemkes.go.id/assets/capayan/ParipurnaLarsi.png" alt=""height=120 width=370 class="capayanimgparipurna"></img>
        <?php endif; ?>

          </div>
          <div class="bsd">
          <h3 class="mt-4 mb-5">Berlaku Sampai : <?=tanggal_indonesia($s->tanggal_kadaluarsa_sertifikat)?></h3>
          <h3 class="mt-4 mb-5">Jakarta, <?=tanggal_indonesia(date('Y-m-d'));?></h3>
          </div>
          <div class="mengetahui">
          <h4 class="mt-4">Mengetahui,</h4>
          </div>
        </main>
        <?php } ?>
    </body>
</html>