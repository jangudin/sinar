<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat_tugas</title>
    <style>
       #table1 {
        font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
    } 

    #table {
        margin: 20px 0px 20px 0px;
        border-collapse: collapse;
        width: 100%;
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

    .page-break {
        page-break-after: always;
    }



    .tab1 {
        tab-size: 2;
    }

    .tab2 {
        tab-size: 4;
    }

    .tab4 {
        tab-size: 8;
    }
    .margin-top {
        margin-top: inherit;
        background-color: lime;
      }
    <style>
    div {
      border: 1px solid black;
      padding: 10px;
      width: 200px;
      height: 200px;
      text-align: justify;
  }
</style>
</style>
</head>

<body style="margin: 5px; margin-top:2px;">
    <div style="margin-bottom: 20px;">
        <img src="<?= $lpa->link_kop ?? '-' ?>" width="752" class="center"/>
    </div>
    <p style='text-align: center; margin-top: 5px;'>
        <b>SURAT TUGAS</b><br>NOMOR :  <?= $content->no_surat_tugas ?? '-' ?>
    </p>
        Dengan ini kami selaku Ketua LPA <?= $lpa->nama_lpa ?? '-' ?>, menugaskan kepada:<br>
        <table id='table'>
            <thead style='text-align:center; font-size: 100%; margin-top:5px;'>
                <tr>
                    <td>NO</td>
                    <td>NAMA</td>
                    <td>NO HP </td>
                    <td>DOMISILI</td>
                    <td>JABATAN</td>
                </tr>
            </thead>


             <tbody>
                <tr style="font-size: 100%;">
                    <td>1</td>
                        <td><?= $content->nama_surveior_satu ?? '-' ?></td>
                        <td style='text-align:center;'><?= $content->no_hp1 ?? '-' ?></td>
                        <td style='text-align:center;'><?= $content->prv1 ?? '-' ?></td>
                        <td style='text-align:center;'><?= ($content->jabatan_surveior_satu ?? '-') == 1 ? 'ketua' : (($content->jabatan_surveior_satu ?? '-') == 2 ? 'anggota' : '-') ?></td>
                </tr>
                <tr style="font-size: 100%;">
                    <td>2</td>
                        <td><?= $content->nama_surveior_dua ?? '-' ?></td>
                        <td style='text-align:center;'><?= $content->no_hp2 ?? '-' ?></td>
                        <td style='text-align:center;'><?= $content->prv2 ?? '-' ?></td>
                        <td style='text-align:center;'><?= ($content->jabatan_surveior_dua ?? '-') == 1 ? 'ketua' : (($content->jabatan_surveior_dua ?? '-') == 2 ? 'anggota' : '-') ?></td>
                </tr>
            </tbody> 
            </table>
           Untuk melaksanakan survei akreditasi, yang akan dilaksanakan pada :
           <table style="margin-left:23px; margin-bottom:15;">
            <tr>
                <td>Nama Fasyankes</td>
                <td style="margin-left:5px;">:</td>
                <td><?= $rs->RUMAH_SAKIT ?? '-' ?></td>
            </tr>
            <tr>
                <td>Jenis</td>
                <td style="margin-left:5px;">:</td>
                <td>Rumah Sakit</td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td style="margin-left:5px;">:</td>
                <td><?= $rs->ALAMAT ?? '-' ?></td>
            </tr>
            <tr>
                <td>Metode survei</td>
                <td style="margin-left:5px;">:</td>
                <td>Luring</td>
            </tr>
            <tr>
                <td>Tanggal survei</td>
                <td style="margin-left:5px;">:</td>
                <td><?= $content->tanggal_survei_1 ?? '-' ?>,<?=$content->tanggal_survei_2?? '-' ?>,<?=$content->tanggal_survei_3?? '-' ?>,<?=$content->tanggal_survei_4?? '-' ?> </td>
            </tr>
            <tr>
                <td>Narahubung</td>
                <td style="margin-left:5px;">:</td>
                <td><?= $content->narahubung_rs ?? '-' ?></td>
            </tr>
            <tr>
                <td>No Hp</td>
                <td style="margin-left:5px;">:</td>
                <td><?= $content->no_hp_narahubung ?? '-' ?></td>
            </tr>
        </table>

 Dengan ketentuan sebagai berikut :
 <table style="margin-left:20px;">
    <tr>
        <td style="vertical-align: top;">1. </td>
        <td>Melaksanakan survei dengan mengacu pada Standar dan Instrumen Survei Akreditasi masing-masing fasilitas pelayanan kesehatan serta sesuai dengan Petunjuk Teknik Pelaksanaan Survei Akreditasi yang ditetapkan Kementerian Kesehatan.</td>
    </tr>
    <tr>
        <td>2. </td>
        <td>Wajib mematuhi kode etik surveior.</td>
    </tr>
    <tr>
        <!-- <td style="vertical-align: top;">3. </td> -->
        <!-- <td>Mengirimkan laporan survei kepada Ketua LPA melalui aplikasi SINAF paling lambat 2 (dua) hari setelah pelaksanaan survei</td> -->
    </tr>
</table>
Agar yang bersangkutan melaksanakan tugas dengan baik dan penuh tanggung jawab.

</body>
</html>
