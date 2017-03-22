<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Grade <?php echo $info_db['classroom'] ?></h3>
            </div>
        </div>

        <div class="clearfix"></div>

        <?php echo form_open('teacher/homeroom_attendance'); ?>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2><?php echo date('d F Y', now()) ?></h2>
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
                                                <input class="present" type="radio" id="present_<?php echo $student['studentid'] ?>" name="attendance[<?php echo $i ?>]" value="p"  <?php echo (isset($student['status']) && $student['status']=='p')?'checked':'' ?>>
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