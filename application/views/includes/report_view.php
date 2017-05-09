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
                        <a href="<?php echo base_url() ?>index.php/<?php echo $from ?>/learningReport2/4/<?php echo $reportGrade?>" class="btn btn-success set-right"><i class="fa fa-eye"></i> Term 4</a>
                        <a href="<?php echo base_url() ?>index.php/<?php echo $from ?>/learningReport/3/<?php echo $reportGrade?>" class="btn btn-success set-right"><i class="fa fa-eye"></i> Term 3</a>
                        <a href="<?php echo base_url() ?>index.php/<?php echo $from ?>/learningReport2/2/<?php echo $reportGrade?>" class="btn btn-success set-right"><i class="fa fa-eye"></i> Term 2</a>
                        <a href="<?php echo base_url() ?>index.php/<?php echo $from ?>/learningReport/1/<?php echo $reportGrade?>" class="btn btn-success set-right"><i class="fa fa-eye"></i> Term 1</a>


                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <table class="teacher_course_student_mid table-bordered">
                                    <?php echo form_open('<?php echo $from ?>/learningReport/'.$reportTerm.'/'.$reportGrade); ?>
                                    <tr>
                                        <td width="50%" class="teacher_course_student_mid_td">FORM CLASS</td>
                                        <td class="teacher_course_student_mid_td set-center">1</td>
                                        <td class="teacher_course_student_mid_td set-center">2</td>
                                        <td class="teacher_course_student_mid_td set-center">3</td>
                                        <td class="teacher_course_student_mid_td set-center">4</td>
                                        <td class="teacher_course_student_mid_td set-center">5</td>
                                    </tr>
                                    <tr>
                                        <td class="">Shows consideration for others</td>

                                        <td class="set-center"><?php if ($report['0']['term'] == '1') { ?>
                                                <span class="option_tick"></span><?php } ?></td>
                                        <td class="set-center"><?php if ($report['0']['term'] == '2') { ?>
                                                <span class="option_tick"></span><?php } ?></td>
                                        <td class="set-center"><?php if ($report['0']['term'] == '3') { ?>
                                                <span class="option_tick"></span><?php } ?></td>
                                        <td class="set-center"><?php if ($report['0']['term'] == '4') { ?>
                                                <span class="option_tick"></span><?php } ?></td>
                                        <td class="set-center"><?php if ($report['0']['term'] == '5') { ?>
                                                <span class="option_tick"></span><?php } ?></td>
                                    </tr>
                                    <tr>
                                        <td class="">Behaves responsibly</td>
                                        <td class="set-center"><?php if ($report['0']['responsibility'] == '1') { ?>
                                                <span class="option_tick"></span><?php } ?></td>
                                        <td class="set-center"><?php if ($report['0']['responsibility'] == '2') { ?>
                                                <span class="option_tick"></span><?php } ?></td>
                                        <td class="set-center"><?php if ($report['0']['responsibility'] == '3') { ?>
                                                <span class="option_tick"></span><?php } ?></td>
                                        <td class="set-center"><?php if ($report['0']['responsibility'] == '4') { ?>
                                                <span class="option_tick"></span><?php } ?></td>
                                        <td class="set-center"><?php if ($report['0']['responsibility'] == '5') { ?>
                                                <span class="option_tick"></span><?php } ?></td>
                                    <tr>
                                        <td class="">Communicates effectively</td>
                                        <td class="set-center"><?php if ($report['0']['communication'] == '1') { ?>
                                                <span class="option_tick"></span><?php } ?></td>
                                        <td class="set-center"><?php if ($report['0']['communication'] == '2') { ?>
                                                <span class="option_tick"></span><?php } ?></td>
                                        <td class="set-center"><?php if ($report['0']['communication'] == '3') { ?>
                                                <span class="option_tick"></span><?php } ?></td>
                                        <td class="set-center"><?php if ($report['0']['communication'] == '4') { ?>
                                                <span class="option_tick"></span><?php } ?></td>
                                        <td class="set-center"><?php if ($report['0']['communication'] == '5') { ?>
                                                <span class="option_tick"></span><?php } ?></td>

                                    </tr>
                                    <tr>
                                        <td class="">Is punctual</td>
                                        <td class="set-center"><?php if ($report['0']['punctual'] == '1') { ?>
                                                <span class="option_tick"></span><?php } ?></td>
                                        <td class="set-center"><?php if ($report['0']['punctual'] == '2') { ?>
                                                <span class="option_tick"></span><?php } ?></td>
                                        <td class="set-center"><?php if ($report['0']['punctual'] == '3') { ?>
                                                <span class="option_tick"></span><?php } ?></td>
                                        <td class="set-center"><?php if ($report['0']['punctual'] == '4') { ?>
                                                <span class="option_tick"></span><?php } ?></td>
                                        <td class="set-center"><?php if ($report['0']['punctual'] == '5') { ?>
                                                <span class="option_tick"></span><?php } ?></td>
                                    </tr>
                                    <tr>
                                        <td class=" set-align-right">Attendance:</td>
                                        <td colspan="5"><?php echo round($attendance) ?>%</td>
                                    </tr>
                                    <tr>
                                        <td class="set-align-right">Form Teacher:</td>
                                        <td colspan="5"><?php echo ucfirst($report[0]['teacherfirstname']).' '.ucfirst($report[0]['teacherlastname'])?></td>
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
                                                        <td width="50%"
                                                            class="teacher_course_student_mid_td"><?php echo strtoupper($studentCourseOnGrade['coursename'])?></td>
                                                        <td class="teacher_course_student_mid_td set-center">1</td>
                                                        <td class="teacher_course_student_mid_td set-center">2</td>
                                                        <td class="teacher_course_student_mid_td set-center">3</td>
                                                        <td class="teacher_course_student_mid_td set-center">4</td>
                                                        <td class="teacher_course_student_mid_td set-center">5</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="">
                                                            Is self-motivated
                                                        </td>
                                                        <td class="set-center"><?php if ($report[$i]['motivation'] == '1') { ?>
                                                                <span class="option_tick"></span><?php } ?></td>
                                                        <td class="set-center"><?php if ($report[$i]['motivation'] == '2') { ?>
                                                                <span class="option_tick"></span><?php } ?></td>
                                                        <td class="set-center"><?php if ($report[$i]['motivation'] == '3') { ?>
                                                                <span class="option_tick"></span><?php } ?></td>
                                                        <td class="set-center"><?php if ($report[$i]['motivation'] == '4') { ?>
                                                                <span class="option_tick"></span><?php } ?></td>
                                                        <td class="set-center"><?php if ($report[$i]['motivation'] == '5') { ?>
                                                                <span class="option_tick"></span><?php } ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="">Shows initiatives and asks questions
                                                        </td>
                                                        <td class="set-center"><?php if ($report[$i]['initiative'] == '1') { ?>
                                                                <span class="option_tick"></span><?php } ?></td>
                                                        <td class="set-center"><?php if ($report[$i]['initiative'] == '2') { ?>
                                                                <span class="option_tick"></span><?php } ?></td>
                                                        <td class="set-center"><?php if ($report[$i]['initiative'] == '3') { ?>
                                                                <span class="option_tick"></span><?php } ?></td>
                                                        <td class="set-center"><?php if ($report[$i]['initiative'] == '4') { ?>
                                                                <span class="option_tick"></span><?php } ?></td>
                                                        <td class="set-center"><?php if ($report[$i]['initiative'] == '5') { ?>
                                                                <span class="option_tick"></span><?php } ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="">Persists despite
                                                            difficulties
                                                        </td>
                                                        <td class="set-center"><?php if ($report[$i]['persistance'] == '1') { ?>
                                                                <span class="option_tick"></span><?php } ?></td>
                                                        <td class="set-center"><?php if ($report[$i]['persistance'] == '2') { ?>
                                                                <span class="option_tick"></span><?php } ?></td>
                                                        <td class="set-center"><?php if ($report[$i]['persistance'] == '3') { ?>
                                                                <span class="option_tick"></span><?php } ?></td>
                                                        <td class="set-center"><?php if ($report[$i]['persistance'] == '4') { ?>
                                                                <span class="option_tick"></span><?php } ?></td>
                                                        <td class="set-center"><?php if ($report[$i]['persistance'] == '5') { ?>
                                                                <span class="option_tick"></span><?php } ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="">Is well-organised
                                                            and punctual
                                                        </td>
                                                        <td class="set-center"><?php if ($report[$i]['organize'] == '1') { ?>
                                                                <span class="option_tick"></span><?php } ?></td>
                                                        <td class="set-center"><?php if ($report[$i]['organize'] == '2') { ?>
                                                                <span class="option_tick"></span><?php } ?></td>
                                                        <td class="set-center"><?php if ($report[$i]['organize'] == '3') { ?>
                                                                <span class="option_tick"></span><?php } ?></td>
                                                        <td class="set-center"><?php if ($report[$i]['organize'] == '4') { ?>
                                                                <span class="option_tick"></span><?php } ?></td>
                                                        <td class="set-center"><?php if ($report[$i]['organize'] == '5') { ?>
                                                                <span class="option_tick"></span><?php } ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="">Completes
                                                            classroom tasks
                                                        </td>
                                                        <td class="set-center"><?php if ($report[$i]['task'] == '1') { ?>
                                                                <span class="option_tick"></span><?php } ?></td>
                                                        <td class="set-center"><?php if ($report[$i]['task'] == '2') { ?>
                                                                <span class="option_tick"></span><?php } ?></td>
                                                        <td class="set-center"><?php if ($report[$i]['task'] == '3') { ?>
                                                                <span class="option_tick"></span><?php } ?></td>
                                                        <td class="set-center"><?php if ($report[$i]['task'] == '4') { ?>
                                                                <span class="option_tick"></span><?php } ?></td>
                                                        <td class="set-center"><?php if ($report[$i]['task'] == '5') { ?>
                                                                <span class="option_tick"></span><?php } ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="">Completes homework
                                                            on time
                                                        </td>
                                                        <td class="set-center"><?php if ($report[$i]['homework'] == '1') { ?>
                                                                <span class="option_tick"></span><?php } ?></td>
                                                        <td class="set-center"><?php if ($report[$i]['homework'] == '2') { ?>
                                                                <span class="option_tick"></span><?php } ?></td>
                                                        <td class="set-center"><?php if ($report[$i]['homework'] == '3') { ?>
                                                                <span class="option_tick"></span><?php } ?></td>
                                                        <td class="set-center"><?php if ($report[$i]['homework'] == '4') { ?>
                                                                <span class="option_tick"></span><?php } ?></td>
                                                        <td class="set-center"><?php if ($report[$i]['homework'] == '5') { ?>
                                                                <span class="option_tick"></span><?php } ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="set-align-right">Teacher:</td>
                                                        <td colspan="5"><?php echo ucfirst($studentCourseOnGrade['teacherfirstname']).' '.ucfirst($studentCourseOnGrade['teacherlastname'])?></td>
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
                                                    <td width="50%"
                                                        class="teacher_course_student_mid_td"><?php echo strtoupper($studentCourseOnGrade['coursename'])?></td>
                                                    <td class="teacher_course_student_mid_td set-center">1</td>
                                                    <td class="teacher_course_student_mid_td set-center">2</td>
                                                    <td class="teacher_course_student_mid_td set-center">3</td>
                                                    <td class="teacher_course_student_mid_td set-center">4</td>
                                                    <td class="teacher_course_student_mid_td set-center">5</td>
                                                </tr>
                                                <tr>
                                                    <td class="">
                                                        Is self-motivated
                                                    </td>
                                                    <td class="set-center"></td>
                                                    <td class="set-center"></td>
                                                    <td class="set-center"></td>
                                                    <td class="set-center"></td>
                                                    <td class="set-center"></td>
                                                </tr>
                                                <tr>
                                                    <td class="">Shows initiatives and asks questions
                                                    </td>
                                                    <td class="set-center"></td>
                                                    <td class="set-center"></td>
                                                    <td class="set-center"></td>
                                                    <td class="set-center"></td>
                                                    <td class="set-center"></td>
                                                </tr>
                                                <tr>
                                                    <td class="">Persists despite
                                                        difficulties
                                                    </td>
                                                    <td class="set-center"></td>
                                                    <td class="set-center"></td>
                                                    <td class="set-center"></td>
                                                    <td class="set-center"></td>
                                                    <td class="set-center"></td>
                                                </tr>
                                                <tr>
                                                    <td class="">Is well-organised
                                                        and punctual
                                                    </td>
                                                    <td class="set-center"></td>
                                                    <td class="set-center"></td>
                                                    <td class="set-center"></td>
                                                    <td class="set-center"></td>
                                                    <td class="set-center"></td>
                                                </tr>
                                                <tr>
                                                    <td class="">Completes
                                                        classroom tasks
                                                    </td>
                                                    <td class="set-center"></td>
                                                    <td class="set-center"></td>
                                                    <td class="set-center"></td>
                                                    <td class="set-center"></td>
                                                    <td class="set-center"></td>
                                                </tr>
                                                <tr>
                                                    <td class="">Completes homework
                                                        on time
                                                    </td>
                                                    <td class="set-center"></td>
                                                    <td class="set-center"></td>
                                                    <td class="set-center"></td>
                                                    <td class="set-center"></td>
                                                    <td class="set-center"></td>
                                                </tr>
                                                <tr>
                                                    <td class="set-align-right">Teacher:</td>
                                                    <td colspan="5"><?php echo ucfirst($studentCourseOnGrade['teacherfirstname']).' '.ucfirst($studentCourseOnGrade['teacherlastname'])?></td>
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