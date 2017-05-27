<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Course Name</h3>
            </div>


        </div>

        <div class="clearfix"></div>

        <?php if (!empty($top2navigation)): ?>
            <?php $this->load->view($top2navigation); ?>
        <?php else: ?>
            Navigation not found !
        <?php endif; ?>
        <!--<div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <a href="<?php /*echo base_url() */?>index.php/student/coursePlan" class="btn btn-success">Lesson Plan</a>
                        <a href="<?php /*echo base_url() */?>index.php/student/courseImplementation" class="btn btn-success">Lesson Implementation</a>
                        <a href="<?php /*echo base_url() */?>index.php/student/courseMaterial" class="btn btn-success">Shared Materials</a>
                        <a href="<?php /*echo base_url() */?>index.php/student/courseAssignmentQuiz" class="btn btn-success">Assignments and Quizzes</a>
                        <a href="<?php /*echo base_url() */?>index.php/student/courseStudent" class="btn btn-success">Students</a>
                    </div>
                </div>
            </div>
        </div>-->
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Students Performance</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="col-md-3 col-sm-3 col-xs-12 profile_left">
                            <div class="profile_img">
                                <div class="teacher_profile_crop">
                                    <!-- Current avatar -->
                                    <img class="img-responsive avatar-view student_profile_img" src="<?php echo base_url() ?>assets/img/student/eve.jpg" alt="Avatar" title="Change the avatar">
                                </div>
                            </div>
                            <h3>Janis Giovani</h3>

                            <ul class="list-unstyled user_data">
                                <li><i class="fa fa-map-marker user-profile-icon"></i> Jakarta
                                </li>

                                <li>
                                    <i class="fa fa-briefcase user-profile-icon"></i> Grade 12-C
                                </li>

                                <li class="m-top-xs">
                                    <i class="fa fa-phone user-profile-icon"></i>
                                    <a href="http://www.kimlabs.com/profile/" target="_blank"> 083827303093</a>
                                </li>

                                <li class="m-top-xs">
                                    <i class="fa fa-external-link user-profile-icon"></i>
                                    <a href="http://www.kimlabs.com/profile/" target="_blank"> janisgtan@gmail.com</a>
                                </li>
                            </ul>

                            <a class="btn btn-success"><i class="fa fa-edit m-right-xs"></i>Edit Performance</a>
                            <br />

                        </div>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <div class="profile_title">
                                <div class="col-md-9">
                                    <h2>Daily Performance</h2>
                                </div>
                                <div class="col-md-3">
                                    <a class="btn btn-success set-right"><i class="fa fa-edit"></i> Edit</a>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-6">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Assignment</div>
                                        <span class="chart" data-percent="86">
                                              <span class="percent"></span>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Quiz</div>
                                        <span class="chart" data-percent="86">
                                              <span class="percent"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <div class="profile_title">
                                <div class="col-md-9">
                                    <h2>Exam</h2>
                                </div>
                                <div class="col-md-3">
                                    <a class="btn btn-success set-right"><i class="fa fa-edit"></i> Edit</a>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-6">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Daily Exam 1</div>
                                        <div class="teacher_profile_value">80</div>
                                    </div>
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Mid Exam</div>
                                        <div class="teacher_profile_value">80</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Daily Exam 2</div>
                                        <div class="teacher_profile_value">80</div>
                                    </div>
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Final Exam</div>
                                        <div class="teacher_profile_value">80</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="profile_title">
                                <div class="col-md-9">
                                    <h2>Mid Term Report</h2>
                                </div>
                                <div class="col-md-3">
                                    <?php echo form_open('student/courseStudentMidReport'); ?>
                                    <button type="submit" class="btn btn-success set-right"><i class="fa fa-edit"></i> Edit</button>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <table class="teacher_course_student_mid table-bordered">
                                    <tr>
                                        <td width="50%" class="teacher_course_student_mid_td">Course Name</td>
                                        <td class="teacher_course_student_mid_td set-center">1</td>
                                        <td class="teacher_course_student_mid_td set-center">2</td>
                                        <td class="teacher_course_student_mid_td set-center">3</td>
                                        <td class="teacher_course_student_mid_td set-center">4</td>
                                        <td class="teacher_course_student_mid_td set-center">5</td>
                                    </tr>
                                    <tr>
                                        <td class="teacher_course_student_mid_td">Is self-motivated</td>
                                        <td class="set-center"><input id="op1_1" type="radio" name="op1" value="1"><label for="op1_1"></label></td>
                                        <td class="set-center"><input id="op1_2" type="radio" name="op1" value="2"><label for="op1_2"></label></td>
                                        <td class="set-center"><input id="op1_3" type="radio" name="op1" value="3"><label for="op1_3"></label></td>
                                        <td class="set-center"><input id="op1_4" type="radio" name="op1" value="4"><label for="op1_4"></label></td>
                                        <td class="set-center"><input id="op1_5" type="radio" name="op1" value="5"><label for="op1_5"></label></td>
                                    </tr>
                                    <tr>
                                        <td class="teacher_course_student_mid_td">Shows initiatives and asks questions</td>
                                        <td class="set-center"><input id="op2_1" type="radio" name="op2" value="1"><label for="op2_1"></label></td>
                                        <td class="set-center"><input id="op2_2" type="radio" name="op2" value="2"><label for="op2_2"></label></td>
                                        <td class="set-center"><input id="op2_3" type="radio" name="op2" value="3"><label for="op2_3"></label></td>
                                        <td class="set-center"><input id="op2_4" type="radio" name="op2" value="4"><label for="op2_4"></label></td>
                                        <td class="set-center"><input id="op2_5" type="radio" name="op2" value="5"><label for="op2_5"></label></td>
                                    </tr>
                                    <tr>
                                        <td class="teacher_course_student_mid_td">Persists despite difficulties</td>
                                        <td class="set-center"><input id="op3_1" type="radio" name="op3" value="1"><label for="op3_1"></label></td>
                                        <td class="set-center"><input id="op3_2" type="radio" name="op3" value="2"><label for="op3_2"></label></td>
                                        <td class="set-center"><input id="op3_3" type="radio" name="op3" value="3"><label for="op3_3"></label></td>
                                        <td class="set-center"><input id="op3_4" type="radio" name="op3" value="4"><label for="op3_4"></label></td>
                                        <td class="set-center"><input id="op3_5" type="radio" name="op3" value="5"><label for="op3_5"></label></td>
                                    </tr>
                                    <tr>
                                        <td class="teacher_course_student_mid_td">Is well-organised and punctual</td>
                                        <td class="set-center"><input id="op4_1" type="radio" name="op4" value="1"><label for="op4_1"></label></td>
                                        <td class="set-center"><input id="op4_2" type="radio" name="op4" value="2"><label for="op4_2"></label></td>
                                        <td class="set-center"><input id="op4_3" type="radio" name="op4" value="3"><label for="op4_3"></label></td>
                                        <td class="set-center"><input id="op4_4" type="radio" name="op4" value="4"><label for="op4_4"></label></td>
                                        <td class="set-center"><input id="op4_5" type="radio" name="op4" value="5"><label for="op4_5"></label></td>
                                    </tr>
                                    <tr>
                                        <td class="teacher_course_student_mid_td">Completes classroom tasks</td>
                                        <td class="set-center"><input id="op5_1" type="radio" name="op5" value="1"><label for="op5_1"></label></td>
                                        <td class="set-center"><input id="op5_2" type="radio" name="op5" value="2"><label for="op5_2"></label></td>
                                        <td class="set-center"><input id="op5_3" type="radio" name="op5" value="3"><label for="op5_3"></label></td>
                                        <td class="set-center"><input id="op5_4" type="radio" name="op5" value="4"><label for="op5_4"></label></td>
                                        <td class="set-center"><input id="op5_5" type="radio" name="op5" value="5"><label for="op5_5"></label></td>
                                    </tr>
                                    <tr>
                                        <td class="teacher_course_student_mid_td">Completes homework on time</td>
                                        <td class="set-center"><input id="op6_1" type="radio" name="op6" value="1"><label for="op6_1"></label></td>
                                        <td class="set-center"><input id="op6_2" type="radio" name="op6" value="2"><label for="op6_2"></label></td>
                                        <td class="set-center"><input id="op6_3" type="radio" name="op6" value="3"><label for="op6_3"></label></td>
                                        <td class="set-center"><input id="op6_4" type="radio" name="op6" value="4"><label for="op6_4"></label></td>
                                        <td class="set-center"><input id="op6_5" type="radio" name="op6" value="5"><label for="op6_5"></label></td>
                                    </tr>
                                    <tr>
                                        <td colspan="6">
                                            <textarea style="resize: none" class="form-control set-margin-bottom" rows="3" placeholder='Comments'></textarea>
                                        </td>
                                    </tr>
                                </table>
                                <?php echo form_close(); ?>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="profile_title">
                                <div class="col-md-9">
                                    <h2>Final Term Report</h2>
                                </div>
                                <div class="col-md-3">
                                    <?php echo form_open('student/courseStudentMidReport'); ?>
                                    <button type="submit" class="btn btn-success set-right"><i class="fa fa-edit"></i> Edit</button>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <table class="teacher_course_student_mid table-bordered">
                                    <tr>
                                        <td width="50%" class="teacher_course_student_mid_td">Course Name</td>
                                        <td class="teacher_course_student_mid_td set-center">1</td>
                                        <td class="teacher_course_student_mid_td set-center">2</td>
                                        <td class="teacher_course_student_mid_td set-center">3</td>
                                        <td class="teacher_course_student_mid_td set-center">4</td>
                                        <td class="teacher_course_student_mid_td set-center">5</td>
                                    </tr>
                                    <tr>
                                        <td class="teacher_course_student_mid_td">Is self-motivated</td>
                                        <td class="set-center"><input id="op21_1" type="radio" name="op1" value="1"><label for="op21_1"></label></td>
                                        <td class="set-center"><input id="op21_2" type="radio" name="op1" value="2"><label for="op21_2"></label></td>
                                        <td class="set-center"><input id="op21_3" type="radio" name="op1" value="3"><label for="op21_3"></label></td>
                                        <td class="set-center"><input id="op21_4" type="radio" name="op1" value="4"><label for="op21_4"></label></td>
                                        <td class="set-center"><input id="op21_5" type="radio" name="op1" value="5"><label for="op21_5"></label></td>
                                    </tr>
                                    <tr>
                                        <td class="teacher_course_student_mid_td">Shows initiatives and asks questions</td>
                                        <td class="set-center"><input id="op22_1" type="radio" name="op2" value="1"><label for="op22_1"></label></td>
                                        <td class="set-center"><input id="op22_2" type="radio" name="op2" value="2"><label for="op22_2"></label></td>
                                        <td class="set-center"><input id="op22_3" type="radio" name="op2" value="3"><label for="op22_3"></label></td>
                                        <td class="set-center"><input id="op22_4" type="radio" name="op2" value="4"><label for="op22_4"></label></td>
                                        <td class="set-center"><input id="op22_5" type="radio" name="op2" value="5"><label for="op22_5"></label></td>
                                    </tr>
                                    <tr>
                                        <td class="teacher_course_student_mid_td">Persists despite difficulties</td>
                                        <td class="set-center"><input id="op23_1" type="radio" name="op3" value="1"><label for="op23_1"></label></td>
                                        <td class="set-center"><input id="op23_2" type="radio" name="op3" value="2"><label for="op23_2"></label></td>
                                        <td class="set-center"><input id="op23_3" type="radio" name="op3" value="3"><label for="op23_3"></label></td>
                                        <td class="set-center"><input id="op23_4" type="radio" name="op3" value="4"><label for="op23_4"></label></td>
                                        <td class="set-center"><input id="op23_5" type="radio" name="op3" value="5"><label for="op23_5"></label></td>
                                    </tr>
                                    <tr>
                                        <td class="teacher_course_student_mid_td">Is well-organised and punctual</td>
                                        <td class="set-center"><input id="op24_1" type="radio" name="op4" value="1"><label for="op24_1"></label></td>
                                        <td class="set-center"><input id="op24_2" type="radio" name="op4" value="2"><label for="op24_2"></label></td>
                                        <td class="set-center"><input id="op24_3" type="radio" name="op4" value="3"><label for="op24_3"></label></td>
                                        <td class="set-center"><input id="op24_4" type="radio" name="op4" value="4"><label for="op24_4"></label></td>
                                        <td class="set-center"><input id="op24_5" type="radio" name="op4" value="5"><label for="op24_5"></label></td>
                                    </tr>
                                    <tr>
                                        <td class="teacher_course_student_mid_td">Completes classroom tasks</td>
                                        <td class="set-center"><input id="op25_1" type="radio" name="op5" value="1"><label for="op25_1"></label></td>
                                        <td class="set-center"><input id="op25_2" type="radio" name="op5" value="2"><label for="op25_2"></label></td>
                                        <td class="set-center"><input id="op25_3" type="radio" name="op5" value="3"><label for="op25_3"></label></td>
                                        <td class="set-center"><input id="op25_4" type="radio" name="op5" value="4"><label for="op25_4"></label></td>
                                        <td class="set-center"><input id="op25_5" type="radio" name="op5" value="5"><label for="op25_5"></label></td>
                                    </tr>
                                    <tr>
                                        <td class="teacher_course_student_mid_td">Completes homework on time</td>
                                        <td class="set-center"><input id="op26_1" type="radio" name="op6" value="1"><label for="op26_1"></label></td>
                                        <td class="set-center"><input id="op26_2" type="radio" name="op6" value="2"><label for="op26_2"></label></td>
                                        <td class="set-center"><input id="op26_3" type="radio" name="op6" value="3"><label for="op26_3"></label></td>
                                        <td class="set-center"><input id="op26_4" type="radio" name="op6" value="4"><label for="op26_4"></label></td>
                                        <td class="set-center"><input id="op26_5" type="radio" name="op6" value="5"><label for="op26_5"></label></td>
                                    </tr>
                                    <tr>
                                        <td colspan="6">
                                            <textarea style="resize: none" class="form-control set-margin-bottom" rows="3" placeholder='Comments'></textarea>
                                        </td>
                                    </tr>
                                </table>
                                <?php echo form_close(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->