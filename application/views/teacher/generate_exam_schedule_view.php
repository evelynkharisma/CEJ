<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Exam Schedule</h3>
            </div>
            <?php echo form_open_multipart('teacher/saveExamSchedule'); ?>
            <button type="submit" class="btn btn-success set-right"><i class="fa fa-save"></i> Save Schedule</button>
            <a href="<?php echo base_url() ?>index.php/teacher/generateExam" class="btn btn-success set-right"><i class="fa fa-braille"></i> Re-Generate</a>
        </div>

        <div class="clearfix"></div>

        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_content">
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Exam Start Date</label>
                        <div class="col-md-9 col-sm-9 col-xs-12 set-margin-bottom">
                            <input name="date" id="duedate" class="date-picker form-control col-md-7 col-xs-12" type="text">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <?php
                        if($schedule){
                            $currentclass = '0';
                            for ($s=0; $s<sizeof($schedule); $s++){
                                if($schedule[$s]['classid'] != $currentclass){
                                    $currentclass = $schedule[$s]['classid'];
                                    ?>
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="profile_title">
                                            <div class="col-md-12">
                                                <h2>Class <?php echo $schedule[$s]['classid'] ?></h2>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                        <table class="teacher_course_student_mid table-bordered">
                                        <thead>
                                        <tr>
                                            <td class="teacher_course_student_mid_td set-center" width="25%">Subject</td>
<!--                                            <td class="teacher_course_student_mid_td set-center" width="25%">Date</td>-->
                                            <td class="teacher_course_student_mid_td set-center" width="25%">Invigilator</td>
                                        </tr>
                                        </thead>
                                        <tbody>
                                    <?php
                                }
                        ?>
                                        <tr>
                                            <input type="hidden" name="classid[]" value="<?php echo $schedule[$s]['classid'] ?>" />
                                            <input type="hidden" name="teacherid[]" value="<?php echo $schedule[$s]['teacherid'] ?>" />
                                            <input type="hidden" name="courseid[]" value="<?php echo $schedule[$s]['courseid'] ?>" />
                                            <input type="hidden" name="count[]" value="<?php echo $schedule[$s]['count'] ?>" />
                                            <td style="border-bottom: <?php echo (isset($schedule[$s]['count']) && $schedule[$s]['count']%2 == 0)?'solid 2px black':'' ?> "><?php echo $schedule[$s]['coursename'] ?></td>
<!--                                            <td>--><?php //echo $schedule[$s]['date'] ?><!--</td>-->
                                            <td style="border-bottom: <?php echo (isset($schedule[$s]['count']) && $schedule[$s]['count']%2 == 0)?'solid 2px black':'' ?> "><?php echo $schedule[$s]['firstname'] ?> <?php echo $schedule[$s]['lastname'] ?></td>
                                        </tr>
                                        <?php
                                            if(!isset($schedule[$s+1]['classid']) || $schedule[$s+1]['classid'] != $currentclass){
//                                                $currentclass = $schedule[$s+1]['classid'];
                                        ?>
                                        </tbody>
                                        </table>
                                        </div>
                                        </div>
                                    <?php } ?>
                        <?php }} ?>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->