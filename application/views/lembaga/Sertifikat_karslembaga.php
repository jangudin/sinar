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
                            top: 27%;
                            text-align: center;
                            position: fixed;
                            marging: auto;
                          }
            .sertifikat-nama {
                            top: 31%;
                            left: 14%;
                            text-align: center;
                            position: fixed;
                            width:800px;
                          }
            .sertifikat-tingkat {
                      top: 52%;
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
            .capayanimgmadya {
                    top: 55%;
                      left:35 %;
                      position: fixed;
                      marging: auto;
                  }
          .bsd{
                    top: 63%;
                    text-align: center;
                      position: fixed;
                      marging: auto;
          }
          .tglprn{
                    top: 67%;
                    left: 39%;
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
          code {
                  font-family: Consolas, Monaco, Courier New, Courier, monospace;
                  font-size: 28px;
                  color:  black;
                }
          .p3 {
                 font-family: "Lucida Console", "Courier New", monospace;
                    }
          .title{
                font-family: 'bernard-mt-condensed-regular', sans-serif;
                font-size:  26px;
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
            <img src="https://sinar.kemkes.go.id/assets/bgsertifikat/newKARS-1.jpg" height="100%" width="100%" />
        </div>
                <?php foreach ($data as $s) { ?>
        <main>
          <div class="sertifikat-nomor">
            <code>Nomor : <?php if($s->no_sertifikat == null){ ?> <?php echo " ";?> <?php }else{ ?> <?=$s->no_sertifikat?><?php } ?></code>
          </div>
           <div class="sertifikat-nama">
            <p class="title">Diberikan Kepada :</p>
            <h1 class="mt-2" style="font-weight: bold; letter-spacing: -1px;" ><?= $s->namaRS?></h1>
            <p class="title"><?= $s->ALAMAT ?></p>
            <p class="title">Provinsi : <?= $s->propinsi_name?></p>
          </div>
         <div class="sertifikat-tingkat">
            <p class="tingkat">TINGKAT KELULUSAN :</p>
            <?php if ($s->capayan == 'Paripurna'): ?>
            <img src="https://sinar.kemkes.go.id/assets/capayan/karsparipurna.png" alt="" height=100 class="capayanimgmadya"></img>
            <?php elseif ($s->capayan == 'Utama'): ?>
            <img src="https://sinar.kemkes.go.id/assets/capayan/karsutama.png" alt="" height=100 class="capayanimgmadya"></img>
            <?php elseif ($s->capayan == 'Madya'): ?>
            <img src="https://sinar.kemkes.go.id/assets/capayan/karsmadya.png" alt="" height=100 class="capayanimgmadya"></img>
            <?php endif; ?>
          </div>
          <div class="bsd">
          <h3 class="title">Berlaku : s/d <?=tanggal_indonesia($s->tanggal_kadaluarsa_sertifikat) ?></h3>
          </div>
          <div class="tglprn">
          <p class="title">Jakarta, <?=tanggal_indonesia(date('Y-m-d'));?></p>
          </div>
          <div class="mengetahui">
          <h4 class="mt-4">Mengetahui,</h4>
          </div>
        </main>
        <?php } ?>

    </body>
</html>