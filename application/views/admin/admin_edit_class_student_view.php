<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Edit Class <?php echo $class['classroom']?></h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <?php if ($this->nativesession->get('error')): ?>
            <div  class="alert alert-error">
                <?php echo $this->nativesession->get('error'); $this->nativesession->delete('error'); ?>
            </div>
        <?php endif; ?>
        <?php if (validation_errors()): ?>
            <div  class="alert alert-error">
                <?php echo validation_errors(); ?>
            </div>
        <?php endif; ?>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <?php
                            $encrypted = $this->general->encryptParaID($class['classid'],'class');
                        ?>
                        <?php echo form_open_multipart('admin/editClassStudent/'.$encrypted); ?>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Move To Class</label>
                            <div class="col-md-9 col-sm-9 col-xs-12 set-margin-bottom">
                                <select name="class" class="form-control set-margin-bottom set-margin-top">
                                    <?php
                                        foreach ($classes as $cl){?>
                                            <option value="<?php echo $cl['classid'];?>"><?php echo $cl['classroom']?></option>
                                        <?php }?>
                                </select>
                            </div>
                        </div>
                        <div class="x_content">
                            <table class="teacher_course_implementation">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th width="30%">Student ID</th>
                                    <th width="30%">Photo</th>
                                    <th width="40%">Name</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if($students){
                                    foreach ($students as $student){ ?>
                                        <tr>
                                            <td>
                                                <input type="checkbox" name="students[]" style="display: inline" value='<?php echo $student['studentid'] ?>' checked > </input>
                                            </td>
                                            <td>
                                                <?php echo $student['studentid']?>
                                            </td>
                                            <td>
                                                <div class="teacher_photo_crop">
                                                    <img src="<?php echo base_url() ?>assets/img/student/<?php echo $student['photo'] ?>" alt="..." class="teacher_photo_img">
                                                </div>
                                            </td>
                                            <td><?php echo $student['firstname'] ?> <?php echo $student['lastname'] ?></td>
                                            <td>
                                                <!--                                            --><?php
                                                //                                                $encrypted = $this->general->encryptParaID($info_db['assignid'],'courseassigned');
                                                //                                                $sencrypted = $this->general->encryptParaID($student['studentid'],'student');
                                                //                                            ?>
                                                <!--                                            <a href="--><?php //echo base_url() ?><!--index.php/admin/courseStudentPerformance/--><?php //echo $encrypted ?><!--/--><?php //echo $sencrypted ?><!--" class="btn btn-success"><i class="fa fa-edit"></i> Performance Detail</a>-->
                                            </td>
                                        </tr>
                                    <?php }} ?>
                                </tbody>
                            </table>
                        </div>
                        <button type="submit" class="btn btn-success set-margin-top"><i class="fa fa-save"></i> Save </button>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->