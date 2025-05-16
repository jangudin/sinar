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
        <div id="boxsatu"><img src="<?= $background_base64 ?>" height="1585"></div>
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
    <br />
    <br />
    <br />
        <?php foreach ($data as $s) { ?>
    <table class="center" style="text-align: center;">
        <tr>
        <td style="font-size:30px;">Nomor : <?php if($s->no_sertifikat == null){ ?> <?php echo " ";?> <?php }else{ ?> <?=$s->no_sertifikat?><?php } ?></td>
        </tr>
    </table>
<br><br><br><br>
    <table class="center" style="text-align: center;">

        <tr style="margin-bottom: 10px;">
            <td style="font-size:35px">Diberikan Kepada</td>
        </tr>
        <tr>
            <td style="font-weight: bold; font-size:35px"><?= $s->namaRS ?></td>
        </tr>
        <tr>
            <td style="font-size:20px;">Alamat : </td>
        </tr>
        <tr>
            <td style="font-size:18px;"><?= $s->ALAMAT ?></td>
        </tr>
       
    </table><br><br><br><br><br>
    <table class="center" style="text-align: center;">
        <tr style="margin-bottom: 10px;">
            <td style="font-size:35px">Tingkat Kelulusan</td>
        </tr>
        <tr>
            <td style="font-weight: bold; font-size:35px"><?= $s->capayan ?></td>
        </tr>
        <tr>
            <td style="font-size:35px;">Berlaku Sampai : <?=tanggal_indonesia($s->tanggal_kadaluarsa_sertifikat)?></td>
        </tr>
        <tr><td style="font-size:30px; margin-top:20px;">Jakarta, <?=tanggal_indonesia(date('Y-m-d'));?></td></tr>
    </table><br><br><br><br><br><br />
    <br />
    <br />
    <br />    <br />
    <br />
     <?php } ?>
</body>
</html>
