<div class="right_col" role="main">

  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Surat Tugas</h3>
      </div>

      <div class="title_right">
        <div class="col-md-5 col-sm-5  form-group pull-right top_search">
          <div class="input-group">
            <input type="text" class="form-control" placeholder="Search for...">
            <span class="input-group-btn">
              <button class="btn btn-default" type="button">Go!</button>
            </span>
          </div>
        </div>
      </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
          <div class="x_title">
            <h2>Surat Tugas</h2>
            <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                  <a class="dropdown-item" href="#">Settings 1</a>
                  <a class="dropdown-item" href="#">Settings 2</a>
                </div>
              </li>
              <li><a class="close-link"><i class="fa fa-close"></i></a>
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <?php echo $this->session->flashdata('msg');?>
            <div class="col-md-7 col-sm-7 ">
              <?php foreach ($data as $s) { ?>
                <?php if ($s->status_tte == 1): ?>
              <iframe
              src="https://sinar.kemkes.go.id/assets/surtugrs/surtugtte/finalstttd<?=$s->id?>.pdf"
              frameBorder="0"
              scrolling="auto"
              height="900px"
              width="100%"
              ></iframe>
              <?php else: ?> 
                <iframe
              src="https://sinar.kemkes.go.id/assets/surtugrs/surtug/st<?=$s->id?>.pdf"
              frameBorder="0"
              scrolling="auto"
              height="900px"
              width="100%"
              ></iframe>
              <?php endif ; ?>
            </div>

              <?php } ?>


            <div class="col-md-5 col-sm-5 " style="border:0px solid #e5e5e5;">

              <h3 class="prod_title">TTE Surat Tugas</h3>

              <p>Input Nomor Induk dan Pashprase yg telah terdaftar di balai Sertifikat Elektronik (BSRE)</p>
              <br />

              <form class="form-label-left input_mask" action="<?= base_url('Lembaga/ttesurtugrs') ?>" method="post">
                    <div class="form-group row">
                      <label class="col-form-label col-md-3 col-sm-3 ">Nomor Induk (NIK)</label>
                      <div class="col-md-9 col-sm-9 ">
                        <input type="text" class="form-control" name="nik" placeholder="NIK">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-form-label col-md-3 col-sm-3 ">Pashprase</label>
                      <div class="col-md-9 col-sm-9 ">
                        <input type="password" name="passphrase" class="form-control" placeholder="Pashprase">
                        <input type="hidden" name="id" value="<?=$id?>" class="form-control">
                      </div>
                    </div>
                    <div class="ln_solid"></div>
                    <div class="form-group row">
                      <div class="col-md-9 col-sm-9">
                        <button type="submit" class="btn btn-success"><i class="fa fa-edit"></i> TTE Surat Tugas</button>
                      </div>
                    </div>

                  </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>