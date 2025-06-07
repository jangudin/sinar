<div class="right_col" role="main">
    <div class="page-title">
        <div class="title_left">
            <h3><?= $title ?></h3>
        </div>
        
        <!-- Breadcrumbs -->
        <div class="breadcrumbs">
            <?php foreach($breadcrumbs as $crumb): ?>
                <?php if($crumb['url'] != '#'): ?>
                    <a href="<?= base_url($crumb['url']) ?>"><?= $crumb['label'] ?></a> /
                <?php else: ?>
                    <?= $crumb['label'] ?>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="x_panel">
                <div class="x_content">
                    <?php if($this->session->flashdata('error')): ?>
                        <div class="alert alert-danger">
                            <?= $this->session->flashdata('error') ?>
                        </div>
                    <?php endif; ?>

                    <!-- Data Details -->
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-striped">
                                <tr>
                                    <th width="200">Field Name</th>
                                    <td><?= $item->field_name ?? 'N/A' ?></td>
                                </tr>
                                <!-- Add more fields as needed -->
                            </table>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <a href="<?= base_url('V2/Data') ?>" class="btn btn-secondary">
                                <i class="fa fa-arrow-left"></i> Back
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>