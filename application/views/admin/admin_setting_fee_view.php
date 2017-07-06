<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Setting Fee</h3>
            </div>
        </div>

        <div class="clearfix"></div>
        <?php if ($this->nativesession->get('error')): ?>
            <div  class="alert alert-error">
                <?php echo $this->nativesession->get('error');$this->nativesession->delete('error'); ?>
            </div>
        <?php endif; ?>
        <?php if (validation_errors()): ?>
            <div  class="alert alert-error">
                <?php echo validation_errors(); ?>
            </div>
        <?php endif; ?>
        <?php if ($this->nativesession->get('success')): ?>
            <div  class="alert alert-success">
                <?php echo $this->nativesession->get('success'); $this->nativesession->delete('success');?>
            </div>
        <?php endif; ?>

        <div class="col-md-12 col-sm-12 col-xs-12">
            <div id="upload" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header ">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                            </button>
                            <div class="col-md-12 col-sm-12 col-xs-12 teacher_profile_label"><h2>Add Student Educational</h2>
                            </div>
                        </div>
                        <div class="modal-body">
                            <?php echo form_open_multipart('admin/addSettingFee'); ?>
                            <div class="form-group">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="col-md-2 col-sm-3 col-xs-11 edu_label">Grade</div>
                                    <div class="col-md-10 col-sm-9 col-xs-12"><input class="form-control edu_value" type="text" name="grade"></div>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="col-md-2 col-sm-3 col-xs-11 edu_label">Year</div>
                                    <div class="col-md-10 col-sm-9 col-xs-12"><input class="form-control edu_value" type="number" name="year" ></div>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="col-md-2 col-sm-3 col-xs-11 edu_label">Value</div>
                                    <div class="col-md-10 col-sm-9 col-xs-12"><input class="form-control edu_value" type="text" name="value"></div>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12 edu_label">
                                    <div class="col-md-2 col-sm-3 col-xs-11 edu_label">Type</div>
                                    <div class="col-md-10 col-sm-9 col-xs-12"><input class="form-control edu_value" type="text" name="type"></div>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12 edu_label">
                                    <div class="col-md-2 col-sm-3 col-xs-11 edu_label">Description</div>
                                    <div class="col-md-10 col-sm-9 col-xs-12"><input class="form-control edu_value" type="text" name="description"></div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer" style="border: none">
                            <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Save</button>
                        </div>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
            <div class="clearfix">

            </div>
        </div>
        <a data-toggle="modal" data-target="#upload" class="btn btn-success set-right" ><i class="fa fa-plus"></i> Add Setting Fee</a>
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
                                <th>Grade</th>
                                <th>Year</th>
                                <th>Value</th>
                                <th>Type</th>
                                <th>Description</th>
                                <?php
                                $privilege = $this->general->checkPrivilege($this->nativesession->get('role'), 'p0003');
                                if($privilege == 1){
                                    ?>
                                    <th>Action</th>
                                <?php } ?>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if($info_db){
                                foreach ($info_db as $ib){ ?>
                                    <tr>
                                        <td><?php echo $ib['grade'] ?></td>
                                        <td><?php echo $ib['year'] ?></td>
                                        <td><?php echo $ib['value'] ?></td>
                                        <td><?php echo $ib['type'] ?></td>
                                        <td><?php echo $ib['description'] ?></td>
                                        <!--<td><?php
/*                                            if($classes) {
                                                foreach ($classes as $class) {
                                                    if(strcmp($class['classid'], $student['classid'])==0){
                                                        echo $class['classroom'];
                                                    }
                                                }

                                            } */?>
                                        </td>-->

                                        <?php
                                        $privilege = $this->general->checkPrivilege($this->nativesession->get('role'), 'p0046');
                                        if($privilege == 1){
                                            ?>
                                            <td width="30%">
                                                <?php
                                                $encrypted = $this->general->encryptParaID($ib['settingid'],'settingfee');
                                                ?>
                                                <a data-toggle="modal" data-target="#edit<?php echo $ib['settingid']?>" class="btn btn-success" style="margin-right: 0.5vw"><i class="fa fa-edit"></i> Edit</a>
                                                <a href="<?php echo base_url() ?>index.php/admin/deleteSettingFee/<?php echo $encrypted ?>" class="btn-success btn" onclick="return confirm('Are you sure want to delete this?');"><i class="fa fa-trash"></i> Delete</a>
                                            </td>

                                            <div class="col-md-12 col-sm-12 col-xs-12" >
                                                <div id="edit<?php echo $ib['settingid']?>" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header ">
                                                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                                                                </button>
                                                                <div class="col-md-12 col-sm-12 col-xs-12 teacher_profile_label"><h2>Edit Student Educational</h2>
                                                                </div>
                                                            </div>
                                                            <div class="modal-body">

                                                                <?php echo form_open_multipart('admin/editSettingFee/'.$encrypted); ?>
                                                                <div class="form-group">
                                                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                                                        <div class="col-md-2 col-sm-3 col-xs-11 edu_label">Grade</div>
                                                                        <div class="col-md-10 col-sm-9 col-xs-12"><input class="form-control edu_value" type="text" name="grade" value="<?php echo set_value('grade', isset($ib['grade']) ? $ib['grade'] : ''); ?>"></div>
                                                                    </div>
                                                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                                                        <div class="col-md-2 col-sm-3 col-xs-11 edu_label">Year</div>
                                                                        <div class="col-md-10 col-sm-9 col-xs-12"><input class="form-control edu_value" type="number" name="year" value="<?php echo set_value('year', isset($ib['year']) ? $ib['year'] : ''); ?>"></div>
                                                                    </div>
                                                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                                                        <div class="col-md-2 col-sm-3 col-xs-11 edu_label">Value</div>
                                                                        <div class="col-md-10 col-sm-9 col-xs-12"><input class="form-control edu_value" type="text" name="value" value="<?php echo set_value('type', isset($ib['type']) ? $ib['type'] : ''); ?>"></div>
                                                                    </div>
                                                                    <div class="col-md-12 col-sm-12 col-xs-12 edu_label">
                                                                        <div class="col-md-2 col-sm-3 col-xs-11 edu_label">Type</div>
                                                                        <div class="col-md-10 col-sm-9 col-xs-12"><input class="form-control edu_value" type="text" name="type" value="<?php echo set_value('type', isset($ib['type']) ? $ib['type'] : ''); ?>"></div>
                                                                    </div>
                                                                    <div class="col-md-12 col-sm-12 col-xs-12 edu_label">
                                                                        <div class="col-md-2 col-sm-3 col-xs-11 edu_label">Description</div>
                                                                        <div class="col-md-10 col-sm-9 col-xs-12"><input class="form-control edu_value" type="text" name="description" value="<?php echo set_value('description', isset($ib['description']) ? $ib['description'] : ''); ?>"></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer" style="border: none">
                                                                <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Save</button>
                                                            </div>
                                                            <?php echo form_close(); ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        <?php } ?>
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