<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3><?php echo $info_db['coursename'] ?></h3>
            </div>


        </div>

        <div class="clearfix"></div>

        <?php if (!empty($top2navigation)): ?>
            <?php $this->load->view($top2navigation); ?>
        <?php else: ?>
            Navigation not found !
        <?php endif; ?>

        <?php if ($this->nativesession->get('success')): ?>
            <div  class="alert alert-success">
                <?php echo $this->nativesession->get('success'); $this->nativesession->delete('success');?>
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
        <?php
            $encrypted = $this->general->encryptParaID($info_db['assignid'],'courseassigned');
            $sencrypted = $this->general->encryptParaID($student['studentid'],'student');
        ?>
        <?php echo form_open('teacher/courseStudentPerformance/'.$encrypted.'/'.$sencrypted); ?>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Students Performance</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="col-md-6 col-sm-3 col-xs-12 profile_left">
                            <div class="profile_img">
                                <div class="teacher_profile_crop">
                                    <!-- Current avatar -->
                                    <img class="img-responsive avatar-view teacher_profile_img" src="<?php echo base_url() ?>assets/img/student/<?php echo $student['photo'] ?>" alt="Avatar" title="Change the avatar">
                                </div>
                                <h3><?php echo $student['firstname'].' '.$student['lastname'] ?></h3>
                            </div>

                        </div>
                        <div class="col-md-6 col-sm-9 col-xs-12">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="x_panel">
                                    <div class="x_title">
                                        <h2>Assessment</h2>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="x_content">
                                        <canvas id="lineChart3"></canvas>
                                    </div>
                                </div>
                            </div>

<!--                            <div class="col-md-12">-->
<!--                                <div class="col-md-6 col-sm-6 col-xs-12">-->
<!--                                    <div class="teacher_profile_group">-->
<!--                                        <div class="teacher_profile_label">Name</div>-->
<!--                                        <div class="teacher_profile_value">--><?php //echo $student['firstname'].' '.$student['lastname'] ?><!--</div>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                                <div class="col-md-6  col-sm-6 col-xs-12">-->
<!--                                    <div class="teacher_profile_group">-->
<!--                                        <div class="teacher_profile_label">Phone</div>-->
<!--                                        <div class="teacher_profile_value">--><?php //echo $student['phone'] ?><!--</div>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                                <div class="col-md-6  col-sm-6 col-xs-12">-->
<!--                                    <div class="teacher_profile_group">-->
<!--                                        <div class="teacher_profile_label">Email</div>-->
<!--                                        <div class="teacher_profile_value">--><?php //echo $student['email'] ?><!--</div>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                                <div class="col-md-6 col-sm-6 col-xs-12">-->
<!--                                    <div class="teacher_profile_group">-->
<!--                                        <div class="teacher_profile_label">Address</div>-->
<!--                                        <div class="teacher_profile_value">--><?php //echo $student['address'] ?><!--</div>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </div>-->
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12 set-margin-top">
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="x_panel">
                                    <div class="x_title">
                                        <h2>Class Work</h2>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="x_content">
                                        <canvas id="lineChart"></canvas>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="x_panel">
                                    <div class="x_title">
                                        <h2>Homework</h2>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="x_content">
                                        <canvas id="lineChart2"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
<!--                        <div class="col-md-12 col-sm-12 col-xs-12 set-margin-top">-->
<!--                            <div class="col-md-12 col-sm-12 col-xs-12">-->
<!--                                <div class="x_panel">-->
<!--                                    <div class="x_title">-->
<!--                                        <h2>Assessment</h2>-->
<!--                                        <div class="clearfix"></div>-->
<!--                                    </div>-->
<!--                                    <div class="x_content">-->
<!--                                        <canvas id="lineChart3"></canvas>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="profile_title">
                                <div class="col-md-9">
                                    <h2>Term 1 Report</h2>
                                </div>
                                <div class="col-md-3">
                                    <button type="submit" name="savebutton" value="term1" class="btn btn-success set-right"><i class="fa fa-edit"></i> Edit</button>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <table class="teacher_course_student_mid table-bordered">
                                    <tr>
                                        <td width="50%" class="teacher_course_student_mid_td"></td>
                                        <td class="teacher_course_student_mid_td set-center">1</td>
                                        <td class="teacher_course_student_mid_td set-center">2</td>
                                        <td class="teacher_course_student_mid_td set-center">3</td>
                                        <td class="teacher_course_student_mid_td set-center">4</td>
                                        <td class="teacher_course_student_mid_td set-center">5</td>
                                    </tr>
                                    <tr>
                                        <td class="teacher_course_student_mid_td">Is self-motivated</td>
                                        <td class="set-center"><input id="op1_1" type="radio" name="op1" value="1" <?php echo (isset($report[0]['motivation']) && $report[0]['motivation']=='1')?'checked':'' ?>><label for="op1_1"></label></td>
                                        <td class="set-center"><input id="op1_2" type="radio" name="op1" value="2" <?php echo (isset($report[0]['motivation']) && $report[0]['motivation']=='2')?'checked':'' ?>><label for="op1_2"></label></td>
                                        <td class="set-center"><input id="op1_3" type="radio" name="op1" value="3" <?php echo (isset($report[0]['motivation']) && $report[0]['motivation']=='3')?'checked':'' ?>><label for="op1_3"></label></td>
                                        <td class="set-center"><input id="op1_4" type="radio" name="op1" value="4" <?php echo (isset($report[0]['motivation']) && $report[0]['motivation']=='4')?'checked':'' ?>><label for="op1_4"></label></td>
                                        <td class="set-center"><input id="op1_5" type="radio" name="op1" value="5" <?php echo (isset($report[0]['motivation']) && $report[0]['motivation']=='5')?'checked':'' ?>><label for="op1_5"></label></td>
                                    </tr>
                                    <tr>
                                        <td class="teacher_course_student_mid_td">Shows initiatives and asks questions</td>
                                        <td class="set-center"><input id="op2_1" type="radio" name="op2" value="1" <?php echo (isset($report[0]['initiative']) && $report[0]['initiative']=='1')?'checked':'' ?>><label for="op2_1"></label></td>
                                        <td class="set-center"><input id="op2_2" type="radio" name="op2" value="2" <?php echo (isset($report[0]['initiative']) && $report[0]['initiative']=='2')?'checked':'' ?>><label for="op2_2"></label></td>
                                        <td class="set-center"><input id="op2_3" type="radio" name="op2" value="3" <?php echo (isset($report[0]['initiative']) && $report[0]['initiative']=='3')?'checked':'' ?>><label for="op2_3"></label></td>
                                        <td class="set-center"><input id="op2_4" type="radio" name="op2" value="4" <?php echo (isset($report[0]['initiative']) && $report[0]['initiative']=='4')?'checked':'' ?>><label for="op2_4"></label></td>
                                        <td class="set-center"><input id="op2_5" type="radio" name="op2" value="5" <?php echo (isset($report[0]['initiative']) && $report[0]['initiative']=='5')?'checked':'' ?>><label for="op2_5"></label></td>
                                    </tr>
                                    <tr>
                                        <td class="teacher_course_student_mid_td">Persists despite difficulties</td>
                                        <td class="set-center"><input id="op3_1" type="radio" name="op3" value="1" <?php echo (isset($report[0]['persistance']) && $report[0]['persistance']=='1')?'checked':'' ?>><label for="op3_1"></label></td>
                                        <td class="set-center"><input id="op3_2" type="radio" name="op3" value="2" <?php echo (isset($report[0]['persistance']) && $report[0]['persistance']=='2')?'checked':'' ?>><label for="op3_2"></label></td>
                                        <td class="set-center"><input id="op3_3" type="radio" name="op3" value="3" <?php echo (isset($report[0]['persistance']) && $report[0]['persistance']=='3')?'checked':'' ?>><label for="op3_3"></label></td>
                                        <td class="set-center"><input id="op3_4" type="radio" name="op3" value="4" <?php echo (isset($report[0]['persistance']) && $report[0]['persistance']=='4')?'checked':'' ?>><label for="op3_4"></label></td>
                                        <td class="set-center"><input id="op3_5" type="radio" name="op3" value="5" <?php echo (isset($report[0]['persistance']) && $report[0]['persistance']=='5')?'checked':'' ?>><label for="op3_5"></label></td>
                                    </tr>
                                    <tr>
                                        <td class="teacher_course_student_mid_td">Is well-organised and punctual</td>
                                        <td class="set-center"><input id="op4_1" type="radio" name="op4" value="1" <?php echo (isset($report[0]['organize']) && $report[0]['organize']=='1')?'checked':'' ?>><label for="op4_1"></label></td>
                                        <td class="set-center"><input id="op4_2" type="radio" name="op4" value="2" <?php echo (isset($report[0]['organize']) && $report[0]['organize']=='2')?'checked':'' ?>><label for="op4_2"></label></td>
                                        <td class="set-center"><input id="op4_3" type="radio" name="op4" value="3" <?php echo (isset($report[0]['organize']) && $report[0]['organize']=='3')?'checked':'' ?>><label for="op4_3"></label></td>
                                        <td class="set-center"><input id="op4_4" type="radio" name="op4" value="4" <?php echo (isset($report[0]['organize']) && $report[0]['organize']=='4')?'checked':'' ?>><label for="op4_4"></label></td>
                                        <td class="set-center"><input id="op4_5" type="radio" name="op4" value="5" <?php echo (isset($report[0]['organize']) && $report[0]['organize']=='5')?'checked':'' ?>><label for="op4_5"></label></td>
                                    </tr>
                                    <tr>
                                        <td class="teacher_course_student_mid_td">Completes classroom tasks</td>
                                        <td class="set-center"><input id="op5_1" type="radio" name="op5" value="1" <?php echo (isset($report[0]['task']) && $report[0]['task']=='1')?'checked':'' ?>><label for="op5_1"></label></td>
                                        <td class="set-center"><input id="op5_2" type="radio" name="op5" value="2" <?php echo (isset($report[0]['task']) && $report[0]['task']=='2')?'checked':'' ?>><label for="op5_2"></label></td>
                                        <td class="set-center"><input id="op5_3" type="radio" name="op5" value="3" <?php echo (isset($report[0]['task']) && $report[0]['task']=='3')?'checked':'' ?>><label for="op5_3"></label></td>
                                        <td class="set-center"><input id="op5_4" type="radio" name="op5" value="4" <?php echo (isset($report[0]['task']) && $report[0]['task']=='4')?'checked':'' ?>><label for="op5_4"></label></td>
                                        <td class="set-center"><input id="op5_5" type="radio" name="op5" value="5" <?php echo (isset($report[0]['task']) && $report[0]['task']=='5')?'checked':'' ?>><label for="op5_5"></label></td>
                                    </tr>
                                    <tr>
                                        <td class="teacher_course_student_mid_td">Completes homework on time</td>
                                        <td class="set-center"><input id="op6_1" type="radio" name="op6" value="1" <?php echo (isset($report[0]['homework']) && $report[0]['homework']=='1')?'checked':'' ?>><label for="op6_1"></label></td>
                                        <td class="set-center"><input id="op6_2" type="radio" name="op6" value="2" <?php echo (isset($report[0]['homework']) && $report[0]['homework']=='2')?'checked':'' ?>><label for="op6_2"></label></td>
                                        <td class="set-center"><input id="op6_3" type="radio" name="op6" value="3" <?php echo (isset($report[0]['homework']) && $report[0]['homework']=='3')?'checked':'' ?>><label for="op6_3"></label></td>
                                        <td class="set-center"><input id="op6_4" type="radio" name="op6" value="4" <?php echo (isset($report[0]['homework']) && $report[0]['homework']=='4')?'checked':'' ?>><label for="op6_4"></label></td>
                                        <td class="set-center"><input id="op6_5" type="radio" name="op6" value="5" <?php echo (isset($report[0]['homework']) && $report[0]['homework']=='5')?'checked':'' ?>><label for="op6_5"></label></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="profile_title">
                                <div class="col-md-9">
                                    <h2>Term 2 Report</h2>
                                </div>
                                <div class="col-md-3">
                                    <button type="submit" name="savebutton" value="term2" class="btn btn-success set-right"><i class="fa fa-edit"></i> Edit</button>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <table class="teacher_course_student_mid table-bordered">
                                    <tr>
                                        <td width="50%" class="teacher_course_student_mid_td"></td>
                                        <td class="teacher_course_student_mid_td set-center">EXAM MARK</td>
                                        <td class="teacher_course_student_mid_td set-center">COURSE GRADE</td>
                                    </tr>
                                    <tr>
                                        <td width="50%" class="teacher_course_student_mid_td"></td>
                                        <td class="set-center"><input type="text" class="form-control set-margin-bottom" name="mark" value="<?php echo set_value('mark', isset($report[0]['mark']) ? $report[0]['mark'] : ''); ?>"/></td>
                                        <td class="set-center"><input readonly type="text" class="form-control set-margin-bottom" name="grade" value="<?php echo set_value('grade', isset($report[0]['grade']) ? $report[0]['grade'] : ''); ?>"/></td>
                                    </tr>
                                    <tr>
                                        <td colspan="6">
                                            <textarea name="comment" style="resize: none" class="form-control set-margin-bottom" rows="3" placeholder='Comments'><?php echo (isset($report[0]['comment']))? $report[0]['comment']:'' ?></textarea>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="profile_title">
                                <div class="col-md-9">
                                    <h2>Term 3 Report</h2>
                                </div>
                                <div class="col-md-3">
                                    <button type="submit" name="savebutton" value="term3" class="btn btn-success set-right"><i class="fa fa-edit"></i> Edit</button>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <table class="teacher_course_student_mid table-bordered">
                                    <tr>
                                        <td width="50%" class="teacher_course_student_mid_td"></td>
                                        <td class="teacher_course_student_mid_td set-center">1</td>
                                        <td class="teacher_course_student_mid_td set-center">2</td>
                                        <td class="teacher_course_student_mid_td set-center">3</td>
                                        <td class="teacher_course_student_mid_td set-center">4</td>
                                        <td class="teacher_course_student_mid_td set-center">5</td>
                                    </tr>
                                    <tr>
                                        <td class="teacher_course_student_mid_td">Is self-motivated</td>
                                        <td class="set-center"><input id="op21_1" type="radio" name="opf1" value="1" <?php echo (isset($report[1]['motivation']) && $report[1]['motivation']=='1')?'checked':'' ?>><label for="op21_1"></label></td>
                                        <td class="set-center"><input id="op21_2" type="radio" name="opf1" value="2" <?php echo (isset($report[1]['motivation']) && $report[1]['motivation']=='2')?'checked':'' ?>><label for="op21_2"></label></td>
                                        <td class="set-center"><input id="op21_3" type="radio" name="opf1" value="3" <?php echo (isset($report[1]['motivation']) && $report[1]['motivation']=='3')?'checked':'' ?>><label for="op21_3"></label></td>
                                        <td class="set-center"><input id="op21_4" type="radio" name="opf1" value="4" <?php echo (isset($report[1]['motivation']) && $report[1]['motivation']=='4')?'checked':'' ?>><label for="op21_4"></label></td>
                                        <td class="set-center"><input id="op21_5" type="radio" name="opf1" value="5" <?php echo (isset($report[1]['motivation']) && $report[1]['motivation']=='5')?'checked':'' ?>><label for="op21_5"></label></td>
                                    </tr>
                                    <tr>
                                        <td class="teacher_course_student_mid_td">Shows initiatives and asks questions</td>
                                        <td class="set-center"><input id="op22_1" type="radio" name="opf2" value="1" <?php echo (isset($report[1]['initiative']) && $report[1]['initiative']=='1')?'checked':'' ?>><label for="op22_1"></label></td>
                                        <td class="set-center"><input id="op22_2" type="radio" name="opf2" value="2" <?php echo (isset($report[1]['initiative']) && $report[1]['initiative']=='2')?'checked':'' ?>><label for="op22_2"></label></td>
                                        <td class="set-center"><input id="op22_3" type="radio" name="opf2" value="3" <?php echo (isset($report[1]['initiative']) && $report[1]['initiative']=='3')?'checked':'' ?>><label for="op22_3"></label></td>
                                        <td class="set-center"><input id="op22_4" type="radio" name="opf2" value="4" <?php echo (isset($report[1]['initiative']) && $report[1]['initiative']=='4')?'checked':'' ?>><label for="op22_4"></label></td>
                                        <td class="set-center"><input id="op22_5" type="radio" name="opf2" value="5" <?php echo (isset($report[1]['initiative']) && $report[1]['initiative']=='5')?'checked':'' ?>><label for="op22_5"></label></td>
                                    </tr>
                                    <tr>
                                        <td class="teacher_course_student_mid_td">Persists despite difficulties</td>
                                        <td class="set-center"><input id="op23_1" type="radio" name="opf3" value="1" <?php echo (isset($report[1]['persistance']) && $report[1]['persistance']=='1')?'checked':'' ?>><label for="op23_1"></label></td>
                                        <td class="set-center"><input id="op23_2" type="radio" name="opf3" value="2" <?php echo (isset($report[1]['persistance']) && $report[1]['persistance']=='2')?'checked':'' ?>><label for="op23_2"></label></td>
                                        <td class="set-center"><input id="op23_3" type="radio" name="opf3" value="3" <?php echo (isset($report[1]['persistance']) && $report[1]['persistance']=='3')?'checked':'' ?>><label for="op23_3"></label></td>
                                        <td class="set-center"><input id="op23_4" type="radio" name="opf3" value="4" <?php echo (isset($report[1]['persistance']) && $report[1]['persistance']=='4')?'checked':'' ?>><label for="op23_4"></label></td>
                                        <td class="set-center"><input id="op23_5" type="radio" name="opf3" value="5" <?php echo (isset($report[1]['persistance']) && $report[1]['persistance']=='5')?'checked':'' ?>><label for="op23_5"></label></td>
                                    </tr>
                                    <tr>
                                        <td class="teacher_course_student_mid_td">Is well-organised and punctual</td>
                                        <td class="set-center"><input id="op24_1" type="radio" name="opf4" value="1" <?php echo (isset($report[1]['organize']) && $report[1]['organize']=='1')?'checked':'' ?>><label for="op24_1"></label></td>
                                        <td class="set-center"><input id="op24_2" type="radio" name="opf4" value="2" <?php echo (isset($report[1]['organize']) && $report[1]['organize']=='2')?'checked':'' ?>><label for="op24_2"></label></td>
                                        <td class="set-center"><input id="op24_3" type="radio" name="opf4" value="3" <?php echo (isset($report[1]['organize']) && $report[1]['organize']=='3')?'checked':'' ?>><label for="op24_3"></label></td>
                                        <td class="set-center"><input id="op24_4" type="radio" name="opf4" value="4" <?php echo (isset($report[1]['organize']) && $report[1]['organize']=='4')?'checked':'' ?>><label for="op24_4"></label></td>
                                        <td class="set-center"><input id="op24_5" type="radio" name="opf4" value="5" <?php echo (isset($report[1]['organize']) && $report[1]['organize']=='5')?'checked':'' ?>><label for="op24_5"></label></td>
                                    </tr>
                                    <tr>
                                        <td class="teacher_course_student_mid_td">Completes classroom tasks</td>
                                        <td class="set-center"><input id="op25_1" type="radio" name="opf5" value="1" <?php echo (isset($report[1]['task']) && $report[1]['task']=='1')?'checked':'' ?>><label for="op25_1"></label></td>
                                        <td class="set-center"><input id="op25_2" type="radio" name="opf5" value="2" <?php echo (isset($report[1]['task']) && $report[1]['task']=='2')?'checked':'' ?>><label for="op25_2"></label></td>
                                        <td class="set-center"><input id="op25_3" type="radio" name="opf5" value="3" <?php echo (isset($report[1]['task']) && $report[1]['task']=='3')?'checked':'' ?>><label for="op25_3"></label></td>
                                        <td class="set-center"><input id="op25_4" type="radio" name="opf5" value="4" <?php echo (isset($report[1]['task']) && $report[1]['task']=='4')?'checked':'' ?>><label for="op25_4"></label></td>
                                        <td class="set-center"><input id="op25_5" type="radio" name="opf5" value="5" <?php echo (isset($report[1]['task']) && $report[1]['task']=='5')?'checked':'' ?>><label for="op25_5"></label></td>
                                    </tr>
                                    <tr>
                                        <td class="teacher_course_student_mid_td">Completes homework on time</td>
                                        <td class="set-center"><input id="op26_1" type="radio" name="opf6" value="1" <?php echo (isset($report[1]['homework']) && $report[1]['homework']=='1')?'checked':'' ?>><label for="op26_1"></label></td>
                                        <td class="set-center"><input id="op26_2" type="radio" name="opf6" value="2" <?php echo (isset($report[1]['homework']) && $report[1]['homework']=='2')?'checked':'' ?>><label for="op26_2"></label></td>
                                        <td class="set-center"><input id="op26_3" type="radio" name="opf6" value="3" <?php echo (isset($report[1]['homework']) && $report[1]['homework']=='3')?'checked':'' ?>><label for="op26_3"></label></td>
                                        <td class="set-center"><input id="op26_4" type="radio" name="opf6" value="4" <?php echo (isset($report[1]['homework']) && $report[1]['homework']=='4')?'checked':'' ?>><label for="op26_4"></label></td>
                                        <td class="set-center"><input id="op26_5" type="radio" name="opf6" value="5" <?php echo (isset($report[1]['homework']) && $report[1]['homework']=='5')?'checked':'' ?>><label for="op26_5"></label></td>
                                    </tr>
                                </table>
                                <?php echo form_close(); ?>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="profile_title">
                                <div class="col-md-9">
                                    <h2>Term 4 Report</h2>
                                </div>
                                <div class="col-md-3">
                                    <button type="submit" name="savebutton" value="term4" class="btn btn-success set-right"><i class="fa fa-edit"></i> Edit</button>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <table class="teacher_course_student_mid table-bordered">
                                    <tr>
                                        <td width="50%" class="teacher_course_student_mid_td"></td>
                                        <td class="teacher_course_student_mid_td set-center">EXAM MARK</td>
                                        <td class="teacher_course_student_mid_td set-center">COURSE GRADE</td>
                                    </tr>
                                    <tr>
                                        <td width="50%" class="teacher_course_student_mid_td"></td>
                                        <td class="set-center"><input type="text" class="form-control set-margin-bottom" name="fmark" value="<?php echo set_value('fmark', isset($report[1]['mark']) ? $report[1]['mark'] : ''); ?>"/></td>
                                        <td class="set-center"><input readonly type="text" class="form-control set-margin-bottom" name="fgrade" value="<?php echo set_value('fgrade', isset($report[1]['grade']) ? $report[1]['grade'] : ''); ?>"/></td>
                                    </tr>
                                    <tr>
                                        <td colspan="6">
                                            <textarea name="fcomment" style="resize: none" class="form-control set-margin-bottom" rows="3" placeholder='Comments'><?php echo (isset($report[1]['comment']))? $report[1]['comment']:'' ?></textarea>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->
<script src="<?php echo base_url() ?>assets/js/Chart.min.js"></script>

<script>

    var  months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];

    <?php if($homework){ ?>
    var submissiondate = [];
    var score = [];

    <?php foreach ($homework as $h){
        ?>
        var d = new Date("<?php echo $h['submissiondate']?>");
        var format = d.getDate()+' '+months[d.getMonth()];
        submissiondate.push(format);
        score.push(<?php echo $h['score']?>);
    <?php
    }?>

    Chart.defaults.global.legend = {
        enabled: false
    };

    // Line chart
    var ctx = document.getElementById("lineChart");
    var lineChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: submissiondate,
            datasets: [{
                label: "Score",
                backgroundColor: "rgba(38, 185, 154, 0.31)",
                borderColor: "rgba(38, 185, 154, 0.7)",
                pointBorderColor: "rgba(38, 185, 154, 0.7)",
                pointBackgroundColor: "rgba(38, 185, 154, 0.7)",
                pointHoverBackgroundColor: "#fff",
                pointHoverBorderColor: "rgba(220,220,220,1)",
                pointBorderWidth: 1,
                data: score
            }]
        },
    });

    <?php } ?>

    <?php if($classwork){ ?>
    var submissiondate2 = [];
    var score2 = [];

    <?php foreach ($classwork as $c){
    ?>
        var d = new Date("<?php echo $c['submissiondate']?>");
        var format = d.getDate()+' '+months[d.getMonth()];
        submissiondate2.push(format);
        score2.push(<?php echo $c['score']?>);
    <?php
    }?>

    var ct2 = document.getElementById("lineChart2");
    var lineChart = new Chart(ct2, {
        type: 'line',
        data: {
            labels: submissiondate2,
            datasets: [{
                label: "Score",
                backgroundColor: "rgba(3, 88, 106, 0.3)",
                borderColor: "rgba(3, 88, 106, 0.70)",
                pointBorderColor: "rgba(3, 88, 106, 0.70)",
                pointBackgroundColor: "rgba(3, 88, 106, 0.70)",
                pointHoverBackgroundColor: "#fff",
                pointHoverBorderColor: "rgba(151,187,205,1)",
                pointBorderWidth: 1,
                data: score2
            }]
        },
    });

    <?php } ?>

    <?php if($assessment){ ?>
    var submissiondate3 = [];
    var score3 = [];

    <?php foreach ($assessment as $c){
    ?>
    var d = new Date("<?php echo $c['submissiondate']?>");
    var format = d.getDate()+' '+months[d.getMonth()];
    submissiondate3.push(format);
    score3.push(<?php echo $c['score']?>);
    <?php
    }?>

    var ct3 = document.getElementById("lineChart3");
    var lineChart = new Chart(ct3, {
        type: 'line',
        data: {
            labels: submissiondate3,
            datasets: [{
                label: "Score",
                backgroundColor: "rgba(3, 88, 106, 0.3)",
                borderColor: "rgba(3, 88, 106, 0.70)",
                pointBorderColor: "rgba(3, 88, 106, 0.70)",
                pointBackgroundColor: "rgba(3, 88, 106, 0.70)",
                pointHoverBackgroundColor: "#fff",
                pointHoverBorderColor: "rgba(151,187,205,1)",
                pointBorderWidth: 1,
                data: score3
            }]
        },
    });
    <?php } ?>

</script>
