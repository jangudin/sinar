<div class="right_col" role="main">
  <div class>
    <div class="page-title">
      <div class="title_left">
        <h3>Task <small>Wahyudin</small></h3>
      </div>
      <div class="title_right">
        <div class="col-md-5 col-sm-5   form-group pull-right top_search">
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
    <div class="row" style="display: block;">
      <div class="col-md-6 col-sm-6  ">
        <div class="x_panel">
          <div class="x_title">
            <h2>API <small>From DTO</small></h2>
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
            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>nameFacility</th>
                  <th>CreatAt</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
               <?php  
               foreach ($datalist as $value) { ?>
                <tr>
                  <td><?= $value->id; ?></td>
                  <td><?= $value->nameFacility; ?></td>
                  <td><?= $value->createAt; ?></td>
                  <td><form action="<?php echo base_url('Task/simpan_vendor');?>" method="post">
                    <input type="hidden" name="id" value="<?= $value->id; ?>">
                    <input type="hidden"  name="nameFacility" value="<?= $value->nameFacility; ?>">
                    <input type="hidden"  name="createAt" value="<?= $value->createAt; ?>">
                    <input type="submit" class="btn btn-sm-primary" value="Simpan">
                  </form> 
                </td>
              </tr>
            <?php }?> 
          </tbody>
        </table>
      </div>
    </div>
  </div>
<!--   <div class="col-md-6 col-sm-6  ">
    <div class="x_panel">
      <div class="x_title">
        <h2>Database<small>YANKES</small></h2>
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
        <table id="datatable" class="table table-striped table-bordered" style="width:100%">
          <thead>
            <tr>
              <th>id</th>
              <th>dtold</th>
              <th>nameFacility</th>
              <th>createAt</th>
            </tr>
          </thead>
          <tbody id="myTable">
            <?php  
            foreach ($vendor as $v) { ?>
              <tr>
                <td><?= $v->id; ?></td>
                <td><?= $v->dtoId; ?></td>
                <td><?= $v->nameFacility; ?></td>
                <td><?= $v->createAt; ?></td>
              </tr>
            <?php }?> 
          </tbody>
        </table> 
      </div>
    </div>
  </div> -->
  <div class="clearfix"></div>
</div>
</div>
</div>