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

<body style="margin: 10px; margin-top:5px;">
    <?php 
    foreach ($data as $p) { ?>
    <div style="margin-bottom:10px;">
        <img src="data:image/png;base64,<?= $row->kop ?>" width="720" class="center"/>
    </div>
        
    <p style='text-align: center; margin-top: 1px;'>
        <b>SURAT TUGAS</b><br>NOMOR : <?=$p->no_surattugas ?>
    </p>
        Dengan ini kami selaku Ketua LPA <?=$p->nama_lpa ?>, menugaskan kepada:<br>
        <table id='table'>
            <thead style='text-align:center; font-size: 100%; margin-top:5px;'>
                <tr>
                    <td>NO</td>
                    <td>NAMA</td>
                    <td>NO HP </td>
                    <td>DOMISILI</td>
                    <td>BIDANG</td>
                    <td>JABATAN</td>
                </tr>
            </thead>
            <tbody>
                <tr style="font-size: 100%;">
                    <td>1</td>
                        <td><?=$p->surveior_satu ?></td>
                        <td style='text-align:center;'><?=$p->no_hp_satu ?></td>
                        <td style='text-align:center;'><?=$p->prov ?></td>
                        <td style='text-align:center;'><?=$p->bidang_surveior_satu ?></td>
                        <td style='text-align:center;'><?php 
                        if($p->jabatan_surveior_id_satu == 1){
                          echo "Ketua";
                        }elseif($p->jabatan_surveior_id_satu == 2){
                          echo "Anggota";
                        }
                      ?> </td>
                </tr>
                <tr style="font-size: 100%;">
                    <td>2</td>
                      <td><?=$p->surveior_dua ?></td>
                      <td style='text-align:center;'><?=$p->no_hp_dua ?></td>
                      <td style='text-align:center;'><?=$p->prov2 ?></td>
                      <td style='text-align:center;'><?=$p->bidang_surveior_dua ?></td>
                      <td style='text-align:center;'><?php 
                        if($p->jabatan_surveior_id_dua == 1){
                          echo "Ketua";
                        }elseif($p->jabatan_surveior_id_dua == 2){
                          echo "Anggota";
                        }
                      ?></td>
                </tr>
            </tbody>
        </table>
           Untuk melaksanakan survei akreditasi, yang akan dilaksanakan pada :
           <table style="margin-left:23px; margin-bottom:15;">
            <tr>
                <td>Nama Fasyankes</td>
                <td style="margin-left:5px;">:</td>
                <td><?=$p->nama_fasyankes ?></td>
            </tr>
            <tr>
                <td>Jenis</td>
                <td style="margin-left:5px;">:</td>
                <td><?= $jns ?></td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td style="margin-left:5px;">:</td>
                <td><?=$p->alamat ?></td>
            </tr>
            <tr>
                <td>Metode survei</td>
                <td style="margin-left:5px;">:</td>
                <td><?php 
                        if($p->msi == 2){
                          echo "Luring";
                        }elseif($p->msi == 3){
                          echo "Hybrid";
                        }
                      ?></td>
            </tr>
            <tr>
                <td>Tanggal survei</td>
                <td style="margin-left:5px;">:</td>
                <td><?php 
                 foreach ($survei as $s) { ?><?=format_indo(date($s->tanggal_survei));?>&nbsp;&nbsp;<?php } ?></td>
            </tr>
             <?php foreach ($nar as $n) { ?>
            <tr>
                <td>Narahubung</td>
                <td style="margin-left:5px;">:</td>
                <td><?=$n->nama_narahubung?></td>
            </tr>
            <tr>
                <td>No Hp</td>
                <td style="margin-left:5px;">:</td>
                <td><?=$n->no_telepon_narahubung?></td>
            </tr>
            <?php } ?>
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
        <td style="vertical-align: top;">3. </td>
        <td>Mengirimkan laporan survei kepada Ketua LPA melalui aplikasi SINAF paling lambat 2 (dua) hari setelah pelaksanaan survei</td>
    </tr>
</table>
Agar yang bersangkutan melaksanakan tugas dengan baik dan penuh tanggung jawab.
<?php } ?>
</body>
</html>
