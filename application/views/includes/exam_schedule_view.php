<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Exam Schedule</h3>
            </div>
            <a href="<?php echo base_url() ?>index.php/teacher/generateExam" class="btn btn-success set-right"><i class="fa fa-braille"></i> Generate</a>
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <?php
                        if($schedule){
                            $currentclass = '';
                            for ($s=0; $s<sizeof($schedule); $s++){
                                if($schedule[$s]['classid'] != $currentclass){
                                    $currentclass = $schedule[$s]['classid'];
                                    ?>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="profile_title">
                                        <div class="col-md-12">
                                            <h2>Grade <?php echo $schedule[$s]['classid'] ?></h2>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                    <table class="teacher_course_student_mid table-bordered">
                                    <thead>
                                    <tr>
                                        <td class="teacher_course_student_mid_td set-center" width="25%">Subject</td>
                                        <td class="teacher_course_student_mid_td set-center" width="25%">Date</td>
                                        <td class="teacher_course_student_mid_td set-center" width="25%">Invigilator</td>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                }
                                ?>
                                <tr>
                                    <td style="border-bottom: <?php echo (isset($schedule[$s]['count']) && $schedule[$s]['count']%2 == 0)?'solid 2px black':'' ?> "><?php echo $schedule[$s]['coursename'] ?></td>
                                    <td style="border-bottom: <?php echo (isset($schedule[$s]['count']) && $schedule[$s]['count']%2 == 0)?'solid 2px black':'' ?> "><?php echo $schedule[$s]['date'] ?></td>
                                    <td style="border-bottom: <?php echo (isset($schedule[$s]['count']) && $schedule[$s]['count']%2 == 0)?'solid 2px black':'' ?> "><?php echo $schedule[$s]['firstname'] ?> <?php echo $schedule[$s]['lastname'] ?></td>
                                </tr>
                                <?php
                                if(!isset($schedule[$s+1]['classid']) || $schedule[$s+1]['classid'] != $currentclass){
//
                                    ?>
                                    </tbody>
                                    </table>
                                    </div>
                                    </div>
                                <?php } ?>
                            <?php }} ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->