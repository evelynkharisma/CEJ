<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Settings</h3>
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
                        <table id="attendance" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Value</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if($info_dbs){
                                foreach ($info_dbs as $s){ ?>
                                    <tr>
                                        <td><?php echo $s['name'] ?></td>
                                        <?php echo form_open('teacher/editSetting/'.$s['settingid']); ?>
                                        <td><input class="form-control" name="value" value="<?php echo set_value('value', isset($s['value']) ? $s['value'] : ''); ?>"></td>
                                        <td><button type="submit" class="btn btn-success"><i class="fa fa-edit"></i> Edit</button></td>
                                        <?php echo form_close(); ?>
                                    </tr>
                                <?php }} ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->