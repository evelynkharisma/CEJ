<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3><?php echo ucfirst($student['firstname']).' '.ucfirst($student['lastname'])?></h3>
            </div>
        </div>

        <div class="clearfix"></div>

        <?php if ($this->nativesession->get('success')): ?>
            <div  class="alert alert-success">
                <?php echo $this->nativesession->get('success');$this->nativesession->delete('success'); ?>
            </div>
        <?php endif; ?>
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

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Grade <?php echo $reportGrade?> - Term <?php echo $reportTerm?></h2>
                        <?php
                            //                            $encrypted = $this->general->encryptParaID($info_db['studentid'],'student');
                        ?>
                        <a href="" class="btn btn-success set-right"><i class="fa fa-eye"></i> Term 4</a>
                        <a href="<?php echo base_url() ?>index.php/student/learningReport/3/<?php echo $reportGrade?>" class="btn btn-success set-right"><i class="fa fa-eye"></i> Term 3</a>
                        <a href="" class="btn btn-success set-right"><i class="fa fa-eye"></i> Term 2</a>
                        <a href="<?php echo base_url() ?>index.php/student/learningReport/1/<?php echo $reportGrade?>" class="btn btn-success set-right"><i class="fa fa-eye"></i> Term 1</a>


                    <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="col-md-12">
                                <table class="teacher_course_student_mid table-bordered">
                                    <?php echo form_open('student/learningReport2/'.$reportTerm.'/'.$reportGrade); ?>
                                    <tr>
                                        <td width="30%" class="teacher_course_student_mid_td">FORM TEACHER</td>
                                        <td colspan="5"><?php echo ucfirst($report[0]['teacherfirstname']).' '.ucfirst($report[0]['teacherlastname'])?></td>
                                    </tr>
                                    <tr>
                                        <td width="30%" class="teacher_course_student_mid_td">ATTENDANCE</td>
                                        <td colspan="5">
                                            <?php echo round($attendance) ?>%
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="6">
                                            <textarea readonly name="comment" style="resize: none" class="form-control set-margin-bottom" rows="3" placeholder='Comments'><?php echo $report[0]['comment'] ?></textarea>
                                        </td>
                                    </tr>

                                </table>
                                <?php echo form_close(); ?>
                                <?php
                                $j = 0;
                                if($studentCoursesOnGrade){
                                    foreach ($studentCoursesOnGrade as $studentCourseOnGrade){
                                        $found = 0;
                                        for($i=0; $i<sizeof($report); $i++) {
                                            if($report[$i]['courseid']==$studentCourseOnGrade['courseid']) {
                                                ?>
                                                <table class="teacher_course_student_mid table-bordered">
                                                    <tr>
                                                        <td width="60%"
                                                            class="teacher_course_student_mid_td">SUBJECT: <?php echo strtoupper($report[$i]['coursename']) ?></td>
                                                        <td class="teacher_course_student_mid_td set-center">EXAM MARK</td>
                                                        <td class="teacher_course_student_mid_td set-center">COURSE GRADE</td>
                                                    </tr>
                                                    <td class="teacher_course_student_mid_td">TEACHER: <?php echo strtoupper($report[$i]['teacherfirstname']) ?> <?php echo strtoupper($report[$i]['teacherlastname']) ?></td>
                                                    <td class=" set-center"><?php echo $report[$i]['mark'] ?></td>
                                                    <td class=" set-center"><?php echo $report[$i]['grade'] ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="6">
                                                            <textarea readonly style="resize: none"
                                                                      class="form-control set-margin-bottom"
                                                                      rows="3"
                                                                      placeholder='Comments'><?php echo $report[$i]['comment'] ?></textarea>
                                                        </td>
                                                    </tr>
                                                </table>
                                                <?php
                                                $i=sizeof($report);
                                                $found = 1;
                                            }
                                        }

                                        if($found==0) {
                                            ?>
                                            <table class="teacher_course_student_mid table-bordered">
                                                <tr>
                                                    <td width="60%"
                                                        class="teacher_course_student_mid_td">SUBJECT: <?php echo strtoupper($studentCourseOnGrade['coursename']) ?></td>
                                                    <td class="teacher_course_student_mid_td set-center">EXAM MARK</td>
                                                    <td class="teacher_course_student_mid_td set-center">COURSE GRADE</td>
                                                </tr>
                                                <td class="teacher_course_student_mid_td">TEACHER: <?php echo strtoupper($studentCourseOnGrade['teacherfirstname']).' '.strtoupper($studentCourseOnGrade['teacherlastname'])?></td>
                                                <td class=" set-center"></td>
                                                <td class=" set-center"></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="6">
                                                            <textarea readonly style="resize: none"
                                                                      class="form-control set-margin-bottom"
                                                                      rows="3"
                                                                      placeholder='Comments'></textarea>
                                                    </td>
                                                </tr>
                                            </table>
                                            <?php
                                        }

                                        $j++;

                                    }
                                }?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->