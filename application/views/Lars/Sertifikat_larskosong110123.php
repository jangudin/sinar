<!DOCTYPE html>
<html>
<head>
<title>Sertifikat</title>
<!-- Start : Style -->
<style type="text/css">
@page { margin: 0px; 
}
body { margin: 0px; }
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
    <div id="allbox">
        <div id="boxsatu"><img src="https://sinar.kemkes.go.id/assets/sertifikat/lars.png" height="1587" width="1122"></div>
    </div>

    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
        <?php foreach ($data as $s) { ?>
    <table class="center" style="text-align: center;">
        <tr>
        <td style="font-size:30px;">Nomor : <?php if($s->no_sertifikat == null){ ?> <?php echo " ";?> <?php }else{ ?> <?=$s->no_sertifikat?><?php } ?></td>
        </tr>
    </table>
<br><br><br><br><br>
    <table class="center" style="text-align: center;">

        <tr style="margin-bottom: 10px;">
            <td style="font-size:35px">Diberikan Kepada</td>
        </tr>
        <tr>
            <td style="font-weight: bold; font-size:35px"><?= $s->namaRS?></td>
        </tr>
        <tr>
            <td style="font-size:25px;">Alamat : <?= $s->ALAMAT ?></td>
        </tr>
       
    </table><br><br><br><br><br><br>
    <table class="center" style="text-align: center;">
        <tr style="margin-bottom: 10px;">s
            <td style="font-size:35px">Tingkat Kelulusan</td>
        </tr>
        <tr>
            <td style="font-weight: bold; font-size:35px"><?= $s->capayan ?></td>
        </tr>
        <tr>
            <td style="font-size:35px;">Berlaku :<?= date('d-m-Y', strtotime($s->tanggal_terbit_sertifikat)) ?> - <?= date('d-m-Y', strtotime($s->tanggal_kadaluarsa_sertifikat)) ?></td>
        </tr>
    </table><br><br><br>
    <br />
    <br />
    <br />    <br />
    <br />
    <table  class="center" style="text-align: center;">
        <tr>
        <td style="font-size:35px; margin-top:20px;">Jakarta, <?php echo date('d-m-Y'); ?></td>
        </tr>
    </table><br>
     <?php } ?>





    <table id='table1' >
        <tr>
            <td style="width:50%; vertical-align:top; text-align:centre; font-size: 35px;">
                <span>  Mengetahui,</span>
                <br>
        </td>
        <td style="width:50%; vertical-align:top; font-size: 18px; text-align:centre;">
                <br/>
                <br/>
            </td>
        </tr> 
    </table>
</body>
</html>
