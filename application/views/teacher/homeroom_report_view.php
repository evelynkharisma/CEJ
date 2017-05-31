<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3><?php echo $info_db['firstname'] ?> <?php echo $info_db['lastname'] ?> <?php echo ($term == 1) ? 'Term 1 Report': 'Term 3 Report' ?></h3>
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
                        <h2>Grade <?php echo $info_db['classroom'] ?></h2>
                        <?php
                            $encrypted = $this->general->encryptParaID($info_db['studentid'],'student');
                        ?>
                        <a target="_blank" href="<?php echo base_url() ?>index.php/teacher/printPreview13/<?php echo $encrypted ?>/<?php echo $term ?>" class="btn btn-success set-right"><i class="fa fa-eye"></i> Print Preview</a>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="col-md-12">
                                <table class="teacher_course_student_mid table-bordered">
                                    <?php echo form_open('teacher/homeroomReport/'.$encrypted.'/'.$term); ?>
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
                                        <td class="set-center"><input id="op1_1" type="radio" name="op1" value="1" <?php echo (isset($homeroomreport['consideration']) && $homeroomreport['consideration']=='1')?'checked':'' ?>><label for="op1_1"></label></td>
                                        <td class="set-center"><input id="op1_2" type="radio" name="op1" value="2" <?php echo (isset($homeroomreport['consideration']) && $homeroomreport['consideration']=='2')?'checked':'' ?>><label for="op1_2"></label></td>
                                        <td class="set-center"><input id="op1_3" type="radio" name="op1" value="3" <?php echo (isset($homeroomreport['consideration']) && $homeroomreport['consideration']=='3')?'checked':'' ?>><label for="op1_3"></label></td>
                                        <td class="set-center"><input id="op1_4" type="radio" name="op1" value="4" <?php echo (isset($homeroomreport['consideration']) && $homeroomreport['consideration']=='4')?'checked':'' ?>><label for="op1_4"></label></td>
                                        <td class="set-center"><input id="op1_5" type="radio" name="op1" value="5" <?php echo (isset($homeroomreport['consideration']) && $homeroomreport['consideration']=='5')?'checked':'' ?>><label for="op1_5"></label></td>
                                    </tr>
                                    <tr>
                                        <td class="">Behaves responsibly</td>
                                        <td class="set-center"><input id="op2_1" type="radio" name="op2" value="1" <?php echo (isset($homeroomreport['responsibility']) && $homeroomreport['responsibility']=='1')?'checked':'' ?>><label for="op2_1"></label></td>
                                        <td class="set-center"><input id="op2_2" type="radio" name="op2" value="2" <?php echo (isset($homeroomreport['responsibility']) && $homeroomreport['responsibility']=='2')?'checked':'' ?>><label for="op2_2"></label></td>
                                        <td class="set-center"><input id="op2_3" type="radio" name="op2" value="3" <?php echo (isset($homeroomreport['responsibility']) && $homeroomreport['responsibility']=='3')?'checked':'' ?>><label for="op2_3"></label></td>
                                        <td class="set-center"><input id="op2_4" type="radio" name="op2" value="4" <?php echo (isset($homeroomreport['responsibility']) && $homeroomreport['responsibility']=='4')?'checked':'' ?>><label for="op2_4"></label></td>
                                        <td class="set-center"><input id="op2_5" type="radio" name="op2" value="5" <?php echo (isset($homeroomreport['responsibility']) && $homeroomreport['responsibility']=='5')?'checked':'' ?>><label for="op2_5"></label></td>
                                    </tr>
                                    <tr>
                                        <td class="">Communicates effectively</td>
                                        <td class="set-center"><input id="op3_1" type="radio" name="op3" value="1" <?php echo (isset($homeroomreport['communication']) && $homeroomreport['communication']=='1')?'checked':'' ?>><label for="op3_1"></label></td>
                                        <td class="set-center"><input id="op3_2" type="radio" name="op3" value="2" <?php echo (isset($homeroomreport['communication']) && $homeroomreport['communication']=='2')?'checked':'' ?>><label for="op3_2"></label></td>
                                        <td class="set-center"><input id="op3_3" type="radio" name="op3" value="3" <?php echo (isset($homeroomreport['communication']) && $homeroomreport['communication']=='3')?'checked':'' ?>><label for="op3_3"></label></td>
                                        <td class="set-center"><input id="op3_4" type="radio" name="op3" value="4" <?php echo (isset($homeroomreport['communication']) && $homeroomreport['communication']=='4')?'checked':'' ?>><label for="op3_4"></label></td>
                                        <td class="set-center"><input id="op3_5" type="radio" name="op3" value="5" <?php echo (isset($homeroomreport['communication']) && $homeroomreport['communication']=='5')?'checked':'' ?>><label for="op3_5"></label></td>
                                    </tr>
                                    <tr>
                                        <td class="">Is punctual</td>
                                        <td class="set-center"><input id="op4_1" type="radio" name="op4" value="1" <?php echo (isset($homeroomreport['punctual']) && $homeroomreport['punctual']=='1')?'checked':'' ?>><label for="op4_1"></label></td>
                                        <td class="set-center"><input id="op4_2" type="radio" name="op4" value="2" <?php echo (isset($homeroomreport['punctual']) && $homeroomreport['punctual']=='2')?'checked':'' ?>><label for="op4_2"></label></td>
                                        <td class="set-center"><input id="op4_3" type="radio" name="op4" value="3" <?php echo (isset($homeroomreport['punctual']) && $homeroomreport['punctual']=='3')?'checked':'' ?>><label for="op4_3"></label></td>
                                        <td class="set-center"><input id="op4_4" type="radio" name="op4" value="4" <?php echo (isset($homeroomreport['punctual']) && $homeroomreport['punctual']=='4')?'checked':'' ?>><label for="op4_4"></label></td>
                                        <td class="set-center"><input id="op4_5" type="radio" name="op4" value="5" <?php echo (isset($homeroomreport['punctual']) && $homeroomreport['punctual']=='5')?'checked':'' ?>><label for="op4_5"></label></td>
                                    </tr>
                                    <tr>
                                        <td class=" set-align-right">Attendance:</td>
                                        <td colspan="5">
                                            <?php echo round($attendance) ?>%
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="set-align-right">Form Teacher:</td>
                                        <td colspan="5">
                                            <?php echo $teacher['firstname'] ?> <?php echo $teacher['lastname'] ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="6">
                                            <button type="submit" class="btn btn-success set-right"><i class="fa fa-edit"></i> Edit</button>
                                        </td>
                                    </tr>
                                </table>
                                <?php echo form_close(); ?>
                                <?php
                                    $i = 0;
                                    if($reports){
                                        foreach ($reports as $r){
//                                ?>
                                                <table class="teacher_course_student_mid table-bordered">
                                                        <tr>
                                                            <td width="50%"
                                                                class="teacher_course_student_mid_td"><?php echo strtoupper($reports[$i]['coursename']) ?></td>
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
                                                            <td class="">Shows initiatives
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
                                                            <td class="">Persists despite
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
                                                            <td class="">Is well-organised
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
                                                            <td class="">Completes
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
                                                            <td class="">Completes homework
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
                                                            <td class="set-align-right">Teacher:</td>
                                                            <td colspan="5"><?php echo $reports[$i]['firstname'] ?><?php echo $reports[$i]['lastname'] ?></td>
                                                        </tr>
                                                    </table>
                                <?php
                                                $i++;
                                            }
                                    }
                                ?>
                                <?php
                                if($coursesList){
                                    foreach ($coursesList as $course){
                                        foreach ($reports as $r){
                                            if($course['coursename'] != $r['coursename']){
                                                ?>
                                                <div class="col-md-12 set-margin-top set-margin-bottom">
                                                   <span class="alert alert-error">
                                                       <?php echo $course['coursename'] ?> report is not yet submitted by <?php echo $course['firstname'] ?> <?php echo $course['lastname'] ?>
                                                   </span>
                                                    <?php
                                                    $sencrypted = $this->general->encryptParaID($course['assignid'],'courseassigned');
                                                    ?>
                                                    <a href="<?php echo base_url() ?>index.php/teacher/sendEmailReport/<?php echo $sencrypted ?>" class="btn btn-danger set-margin-left"><i class="fa fa-bell-o"></i> Request Report</a>
                                                </div>
                                                <?php
                                            }
                                        }
                                    }
                                }
//                                if (!isset($reports[$i]['coursename'])) {
//                                                                                $reports[$i]['coursename'] = '';
//                                                                            }
//                                                                            if ($course['coursename'] != $reports[$i]['coursename']) {
//                                                                ?>
<!--                                                                            <div class="col-md-12 set-margin-top set-margin-bottom">-->
<!--                                                                               <span class="alert alert-error">-->
<!--                                                                                   --><?php //echo $course['coursename'] ?><!-- report is not yet submitted by --><?php //echo $course['firstname'] ?><!-- --><?php //echo $course['lastname'] ?>
<!--                                                                               </span>-->
<!--                                                                                --><?php
//                                                                                    $sencrypted = $this->general->encryptParaID($course['assignid'],'courseassigned');
//                                                                                ?>
<!--                                                                                <a href="--><?php //echo base_url() ?><!--index.php/teacher/sendEmailReport/--><?php //echo $sencrypted ?><!--" class="btn btn-danger set-margin-left"><i class="fa fa-bell-o"></i> Request Report</a>-->
<!--                                                                            </div>-->
<!--                                                                --><?php
//                                            }
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