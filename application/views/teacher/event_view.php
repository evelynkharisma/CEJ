<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="">
                <h3>Events <a href="<?php echo base_url() ?>index.php/teacher/addEvent" class="btn btn-success set-right"><i class="fa fa-upload"></i> Upload</a></h3>
            </div>
        </div>

        <div class="clearfix"></div>

        <?php if ($this->session->flashdata('success')): ?>
            <div  class="alert alert-success">
                <?php echo $this->session->flashdata('success'); ?>
            </div>
        <?php endif; ?>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <table id="directoryView" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Date</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            if($info_dbs){
                                foreach($info_dbs as $info_db){ ?>
                                    <tr>
                                        <td><?php echo $info_db['title'] ?></td>
                                        <td><?php echo $info_db['description'] ?></td>
                                        <td><?php echo $info_db['date'] ?></td>
                                    </tr>
                                <?php }}
                            else {?>
                                <tr>
                                    <td colspan="3"><?php echo 'no event found' ?></td>
                                </tr>
                            <?php } ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->