<!DOCTYPE html>
<html>
<head>
<title>Sertifikat</title>
<!-- Start : Style -->
<style type="text/css">
#boxsatu, #boxdua, #boxtiga, #boxempat, #boxlima{
    position: absolute;
    height: 100px;
}
#boxsatu{
    height: 100%;
    left: 0px;
    top: 0px;
    background-color:;
    z-index: 1;
}
#boxdua{
    width: 1000px;
    left: 400px;
    top: 250px;
    background-color:;
    z-index: 2;
}
#boxtiga{

    width:;
    left: 180px;
    top: 280px;
    background-color:;
    z-index: 3;
}
#boxempat{
    width: ;
    left: 1000px;
    left: 220px;
    top: 200px;
    background-color:;
    align-content:  center  ;
    z-index: 2;
}
#boxlima{
    width: 100px;
    left: 250px;
    top: 0px;
    background-color:cyan;
    z-index: 1;
}
#table1 {
                border-collapse: collapse;
        width: 100%;
    } 

    #table {
        font-family: "Arial", Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
    } 
    table.center {
        margin-left: auto; 
        margin-right: auto;
    }
    #table td,
    #table th {
        border: 1px solid #ddd;
        padding: 4px;
    }

    #table tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    #table tr:hover {
        background-color: #ddd;
    }

    #table th {
        padding-top: 1px;
        padding-bottom: 1px;
  padding-left: 1px;
  padding-right: 1px;
        text-align: left;
        background-color: #4CAF50;
        color: white;
    }
    .box {
        width: 300px;
        height: 200px;
        background: transparent;
        display: inline-block;
        margin-left: 20px;
    }
</style>
<!-- End : Style -->
</head>
<body>
    <!-- Start : Tampilan Semua Box -->
    <div id="allbox">
        <!-- Start : Tampilkan Box -->
        <div id="boxsatu"><img src="<?php echo base_url('assets/bgsertifikat/LARSDHP-kosong.png')?>" height="1540"></div>
        <!-- End : Tampilan Box -->
    </div>
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <table id='table1' >
        <tr>
            <td style="width:50%; vertical-align:top; text-align:centre; font-size: 35px;">
            <img width="350px" src="<?php echo base_url('assets/temp/Lars.jpeg')?>"/>
        </td>
        <td style="width:50%;vertical-align:top; text-align:centre; font-size: 18px;">

                <img width="350px" src="<?php echo base_url('assets/temp/Lars.jpeg')?>"/>
            </td>
        </tr>
    </table>
    <table class="center" style="text-align: center;">
        <tr>
        <td style="font-weight: bold; font-size:35px">SERTIFIKAT AKREDITASI RUMAH SAKIT</td>
        </tr>
        <tr>
        <td style="font-size:35px;">Nomor : 21092022/IX/1022</td>
        </tr>
    </table>
<br><br><br><br><br><br>
    <table class="center" style="text-align: center;">
    <?php foreach ($data as $s) { ?>
        <tr style="margin-bottom: 10px;">
            <td style="font-size:35px">Diberikan Kepada</td>
        </tr>
        <tr>
            <td style="font-weight: bold; font-size:35px"><?=$s->namaRS ?></td>
        </tr>
        <tr>
            <td style="font-size:35px;">Alamat : <?=$s->ALAMAT ?></td>
        </tr>
    <?php } ?>
    </table><br><br><br><br><br><br>
    <table class="center" style="text-align: center;">
        <tr style="margin-bottom: 10px;">
            <td style="font-size:35px">Tingkat Kelulusan</td>
        </tr>
        <tr>
            <td style="font-weight: bold; font-size:35px">PRATAMA</td>
        </tr>
        <tr>
            <td style="font-size:35px;">Berlaku : 21 September 2022 - 27 September 2027</td>
        </tr>
    </table><br><br><br><br><br><br><br><br><br><br>





    <table id='table1' >
        <tr>
            <td style="width:50%; vertical-align:top; text-align:centre; font-size: 35px;">
                <span>  Mengetahui,</span>
                    <!-- <br>Direktur Jendral Pelayanan Kesehatan
                    <br>Kementrian Kesehatan RI
                    <br>
                    <br>
                    <br>
                    <br>
                </span>
                <br>
                <span style="font-weight: bold;">
                   drg. Murti Utami, MPH, QGIA, CGCAE -->
                </span> 
                <br/>
                <br/>

        </td>
        <td style="width:50%;vertical-align:top; text-align:centre; font-size: 18px;">
                <!-- <span>            
                    <br>Ketua Eksekutif Komisi Akreditasi Rumah Sakit
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                
                </span>
                <br>
                <span style="font-weight: bold;">
                Dr. dr. Sutoto, M.Kes, FISQua
                </span> -->
                <br/>
                <br/>
                <img width="350px" src="<?php echo base_url('assets/tte/Lars.png')?>"/>
            </td>
        </tr> 
    </table>
    <!-- End : Tampilan Semua Box -->
</body>

</html>
