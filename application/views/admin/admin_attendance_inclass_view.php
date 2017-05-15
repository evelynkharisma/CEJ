<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Grade <?php echo $classroom['classroom']; ?></h3>
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
        <?php
        $encrypted = $this->general->encryptParaID($classid, 'class');
        ?>
        <?php echo form_open('admin/attendanceClassView/'.$encrypted); ?>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <div class="col-md-8 col-sm-8 col-xs-12">
                            <h2><?php echo $setdate ?></h2>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <?php
                            if($setdate == date('Y-m-d', now())){
                                ?>
                                <div class="col-md-8 col-sm-8 col-xs-12">
                                    <input type="text" id="pick-date" class="form-control set-margin-bottom set-right" name="datechoosen" value="<?php echo date('Y-m-d', now()) ?>"/>
                                </div>
                                <div class="col-md-4 col-sm-4 col-xs-12">
                                    <button type="submit" name="datebutton" value="setdate" class="btn btn-success set-right"><i class="fa fa-search"></i> Search</button>
                                </div>
                                <?php
                            }else{
                                ?>
                                <button type="submit" name="datebutton" value="today" class="btn btn-success set-right"><i class="fa fa-search"></i> Go to Today</button>
                                <?php
                            }
                            ?>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <table id="attendance" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Action</th>
                                <th>Comment</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if($students){
                                $i = 0;
                                foreach ($students as $student){ ?>
                                    <tr>
                                        <input type="hidden" class="form-control set-margin-bottom" name="studentid[]" value="<?php echo $student['studentid']; ?>"/>
                                        <td><?php echo $student['firstname'] ?> <?php echo $student['lastname'] ?></td>
                                        <td>
                                            <div class="teacher_attendance_radio">
                                                <input class="present" type="radio" id="present_<?php echo $student['studentid'] ?>" name="attendance[<?php echo $i ?>]" value="p"  <?php echo (isset($student['status']) && $student['status']=='p') || (!isset($student['status'])) ?'checked':'' ?>>
                                                <label for="present_<?php echo $student['studentid'] ?>">P</label>

                                                <input class="absent" type="radio" id="absent_<?php echo $student['studentid'] ?>" name="attendance[<?php echo $i ?>]" value="a" <?php echo (isset($student['status']) && $student['status']=='a')?'checked':'' ?>>
                                                <label for="absent_<?php echo $student['studentid'] ?>">A</label>

                                                <input class="late" type="radio" id="late_<?php echo $student['studentid'] ?>" name="attendance[<?php echo $i ?>]" value="l" <?php echo (isset($student['status']) && $student['status']=='l')?'checked':'' ?>>
                                                <label for="late_<?php echo $student['studentid'] ?>">L</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                                                <input name="comment[<?php echo $i ?>]" type="text" class="form-control has-feedback-left" id="attendance_comment" placeholder="Comment" value="<?php echo (isset($student['description']))? $student['description']:'' ?>">
                                                <span class="fa fa-comment form-control-feedback left" aria-hidden="true"></span>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php $i++; }} ?>
                            </tbody>
                        </table>
                        <button type="submit" name="savebutton" value="true" class="btn btn-success set-right"><i class="fa fa-save"></i> Save</button>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->