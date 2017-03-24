<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3><?php echo $info_db['firstname'] ?> <?php echo $info_db['lastname'] ?> <?php echo ($term == 1) ? 'Mid Term Report': 'Final Term Report' ?></h3>
            </div>


        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Grade <?php echo $info_db['classroom'] ?></h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="col-md-12">
                                <table class="teacher_course_student_mid table-bordered">
                                    <tr>
                                        <td width="50%" class="teacher_course_student_mid_td">Homeroom Teacher: <?php echo $teacher['firstname'] ?> <?php echo $teacher['lastname'] ?></td>
                                        <td class="teacher_course_student_mid_td set-center">1</td>
                                        <td class="teacher_course_student_mid_td set-center">2</td>
                                        <td class="teacher_course_student_mid_td set-center">3</td>
                                        <td class="teacher_course_student_mid_td set-center">4</td>
                                        <td class="teacher_course_student_mid_td set-center">5</td>
                                    </tr>
                                    <tr>
                                        <td class="teacher_course_student_mid_td">Shows consideration for others</td>
                                        <td class="set-center"><?php if ($homeroomreport['consideration'] == '1') { ?><span class="option_tick"></span><?php } ?></td>
                                        <td class="set-center"><?php if ($homeroomreport['consideration'] == '2') { ?><span class="option_tick"></span><?php } ?></td>
                                        <td class="set-center"><?php if ($homeroomreport['consideration'] == '3') { ?><span class="option_tick"></span><?php } ?></td>
                                        <td class="set-center"><?php if ($homeroomreport['consideration'] == '4') { ?><span class="option_tick"></span><?php } ?></td>
                                        <td class="set-center"><?php if ($homeroomreport['consideration'] == '5') { ?><span class="option_tick"></span><?php } ?></td>
                                    </tr>
                                    <tr>
                                        <td class="teacher_course_student_mid_td">Behaves responsibly</td>
                                        <td class="set-center"><?php if ($homeroomreport['responsibility'] == '1') { ?><span class="option_tick"></span><?php } ?></td>
                                        <td class="set-center"><?php if ($homeroomreport['responsibility'] == '2') { ?><span class="option_tick"></span><?php } ?></td>
                                        <td class="set-center"><?php if ($homeroomreport['responsibility'] == '3') { ?><span class="option_tick"></span><?php } ?></td>
                                        <td class="set-center"><?php if ($homeroomreport['responsibility'] == '4') { ?><span class="option_tick"></span><?php } ?></td>
                                        <td class="set-center"><?php if ($homeroomreport['responsibility'] == '5') { ?><span class="option_tick"></span><?php } ?></td>
                                    </tr>
                                    <tr>
                                        <td class="teacher_course_student_mid_td">Communicates effectively</td>
                                        <td class="set-center"><?php if ($homeroomreport['communication'] == '1') { ?><span class="option_tick"></span><?php } ?></td>
                                        <td class="set-center"><?php if ($homeroomreport['communication'] == '2') { ?><span class="option_tick"></span><?php } ?></td>
                                        <td class="set-center"><?php if ($homeroomreport['communication'] == '3') { ?><span class="option_tick"></span><?php } ?></td>
                                        <td class="set-center"><?php if ($homeroomreport['communication'] == '4') { ?><span class="option_tick"></span><?php } ?></td>
                                        <td class="set-center"><?php if ($homeroomreport['communication'] == '5') { ?><span class="option_tick"></span><?php } ?></td>
                                    </tr>
                                    <tr>
                                        <td class="teacher_course_student_mid_td">Is punctual</td>
                                        <td class="set-center"><?php if ($homeroomreport['punctual'] == '1') { ?><span class="option_tick"></span><?php } ?></td>
                                        <td class="set-center"><?php if ($homeroomreport['punctual'] == '2') { ?><span class="option_tick"></span><?php } ?></td>
                                        <td class="set-center"><?php if ($homeroomreport['punctual'] == '3') { ?><span class="option_tick"></span><?php } ?></td>
                                        <td class="set-center"><?php if ($homeroomreport['punctual'] == '4') { ?><span class="option_tick"></span><?php } ?></td>
                                        <td class="set-center"><?php if ($homeroomreport['punctual'] == '5') { ?><span class="option_tick"></span><?php } ?></td>
                                    </tr>
                                    <tr>
                                        <td class="teacher_course_student_mid_td">Attendance</td>
                                        <td colspan="5">
                                            97%
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="6">
                                            <textarea readonly style="resize: none"
                                                      class="form-control set-margin-bottom"
                                                      rows="3"
                                                      placeholder='Comments'><?php echo $homeroomreport['comment'] ?></textarea>
                                        </td>
                                    </tr>
                                </table>
                                <?php
                                    $i = 0;
                                    if($coursesList){
                                        foreach ($coursesList as $course){
                                            if ( ! isset($reports[$i]['coursename'])) {
                                                $reports[$i]['coursename'] = '';
                                            }
                                            if ($course['coursename'] != $reports[$i]['coursename']) {
                                ?>
                                               <span class="alert alert-error">
                                                   <?php echo $course['coursename'] ?> report is not yet submitted by <?php echo $course['firstname'] ?> <?php echo $course['lastname'] ?>
                                               </span>
                                                <a href="<?php echo base_url() ?>index.php/teacher/sendEmail" class="btn btn-danger set-margin-left"><i class="fa fa-bell-o"></i> Request Report</a>
                                <?php
                                            }
                                            else{
                                ?>
                                                <table class="teacher_course_student_mid table-bordered">
                                                        <tr>
                                                            <td width="50%"
                                                                class="teacher_course_student_mid_td"><?php echo $reports[$i]['coursename'] ?></td>
                                                            <td class="teacher_course_student_mid_td set-center">1</td>
                                                            <td class="teacher_course_student_mid_td set-center">2</td>
                                                            <td class="teacher_course_student_mid_td set-center">3</td>
                                                            <td class="teacher_course_student_mid_td set-center">4</td>
                                                            <td class="teacher_course_student_mid_td set-center">5</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="teacher_course_student_mid_td">Is
                                                                self-motivated
                                                            </td>
                                                            <td class="set-center"><?php if ($reports[$i]['motivation'] == '1') { ?>
                                                                    <span class="option_tick"></span><?php } ?></td>
                                                            <td class="set-center"><?php if ($reports[$i]['motivation'] == '2') { ?>
                                                                    <span class="option_tick"></span><?php } ?></td>
                                                            <td class="set-center"><?php if ($reports[$i]['motivation'] == '3') { ?>
                                                                    <span class="option_tick"></span><?php } ?></td>
                                                            <td class="set-center"><?php if ($reports[$i]['motivation'] == '4') { ?>
                                                                    <span class="option_tick"></span><?php } ?></td>
                                                            <td class="set-center"><?php if ($reports[$i]['motivation'] == '5') { ?>
                                                                    <span class="option_tick"></span><?php } ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="teacher_course_student_mid_td">Shows initiatives
                                                                and asks questions
                                                            </td>
                                                            <td class="set-center"><?php if ($reports[$i]['initiative'] == '1') { ?>
                                                                    <span class="option_tick"></span><?php } ?></td>
                                                            <td class="set-center"><?php if ($reports[$i]['initiative'] == '2') { ?>
                                                                    <span class="option_tick"></span><?php } ?></td>
                                                            <td class="set-center"><?php if ($reports[$i]['initiative'] == '3') { ?>
                                                                <span class="option_tick"></span><?php } ?></span></td>
                                                            <td class="set-center"><?php if ($reports[$i]['initiative'] == '4') { ?>
                                                                    <span class="option_tick"></span><?php } ?></td>
                                                            <td class="set-center"><?php if ($reports[$i]['initiative'] == '5') { ?>
                                                                    <span class="option_tick"></span><?php } ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="teacher_course_student_mid_td">Persists despite
                                                                difficulties
                                                            </td>
                                                            <td class="set-center"><?php if ($reports[$i]['persistance'] == '1') { ?>
                                                                    <span class="option_tick"></span><?php } ?></td>
                                                            <td class="set-center"><?php if ($reports[$i]['persistance'] == '2') { ?>
                                                                    <span class="option_tick"></span><?php } ?></td>
                                                            <td class="set-center"><?php if ($reports[$i]['persistance'] == '3') { ?>
                                                                    <span class="option_tick"></span><?php } ?></td>
                                                            <td class="set-center"><?php if ($reports[$i]['persistance'] == '4') { ?>
                                                                    <span class="option_tick"></span><?php } ?></td>
                                                            <td class="set-center"><?php if ($reports[$i]['persistance'] == '5') { ?>
                                                                    <span class="option_tick"></span><?php } ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="teacher_course_student_mid_td">Is well-organised
                                                                and punctual
                                                            </td>
                                                            <td class="set-center"><?php if ($reports[$i]['organize'] == '1') { ?>
                                                                    <span class="option_tick"></span><?php } ?></td>
                                                            <td class="set-center"><?php if ($reports[$i]['organize'] == '2') { ?>
                                                                    <span class="option_tick"></span><?php } ?></td>
                                                            <td class="set-center"><?php if ($reports[$i]['organize'] == '3') { ?>
                                                                    <span class="option_tick"></span><?php } ?></td>
                                                            <td class="set-center"><?php if ($reports[$i]['organize'] == '4') { ?>
                                                                    <span class="option_tick"></span><?php } ?></td>
                                                            <td class="set-center"><?php if ($reports[$i]['organize'] == '5') { ?>
                                                                    <span class="option_tick"></span><?php } ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="teacher_course_student_mid_td">Completes
                                                                classroom tasks
                                                            </td>
                                                            <td class="set-center"><?php if ($reports[$i]['task'] == '1') { ?>
                                                                    <span class="option_tick"></span><?php } ?></td>
                                                            <td class="set-center"><?php if ($reports[$i]['task'] == '2') { ?>
                                                                    <span class="option_tick"></span><?php } ?></td>
                                                            <td class="set-center"><?php if ($reports[$i]['task'] == '3') { ?>
                                                                    <span class="option_tick"></span><?php } ?></td>
                                                            <td class="set-center"><?php if ($reports[$i]['task'] == '4') { ?>
                                                                    <span class="option_tick"></span><?php } ?></td>
                                                            <td class="set-center"><?php if ($reports[$i]['task'] == '5') { ?>
                                                                    <span class="option_tick"></span><?php } ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="teacher_course_student_mid_td">Completes homework
                                                                on time
                                                            </td>
                                                            <td class="set-center"><?php if ($reports[$i]['homework'] == '1') { ?>
                                                                    <span class="option_tick"></span><?php } ?></td>
                                                            <td class="set-center"><?php if ($reports[$i]['homework'] == '2') { ?>
                                                                    <span class="option_tick"></span><?php } ?></td>
                                                            <td class="set-center"><?php if ($reports[$i]['homework'] == '3') { ?>
                                                                    <span class="option_tick"></span><?php } ?></td>
                                                            <td class="set-center"><?php if ($reports[$i]['homework'] == '4') { ?>
                                                                    <span class="option_tick"></span><?php } ?></td>
                                                            <td class="set-center"><?php if ($reports[$i]['homework'] == '5') { ?>
                                                                    <span class="option_tick"></span><?php } ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="teacher_course_student_mid_td">Exam Mark</td>
                                                            <td colspan="5">90</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="teacher_course_student_mid_td">Course Grade</td>
                                                            <td colspan="5">A</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="teacher_course_student_mid_td">Teacher</td>
                                                            <td colspan="5"><?php echo $reports[$i]['firstname'] ?><?php echo $reports[$i]['lastname'] ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="6">
                                                                <textarea readonly style="resize: none"
                                                                          class="form-control set-margin-bottom"
                                                                          rows="3"
                                                                          placeholder='Comments'><?php echo $reports[$i]['comment'] ?></textarea>
                                                            </td>
                                                        </tr>
                                                    </table>
                                <?php
                                                $i++;
                                            }
                                        }
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->