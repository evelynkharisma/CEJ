<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <?php
        $encrypted = $this->general->encryptParaID($course['courseid'],'course');
        $encrypted_assignid = $this->general->encryptParaID($course['assignid'],'courseassigned');
        $sencrypted = $this->general->encryptParaID($student['studentid'],'student');
        ?>
        <div class="page-title">
            <div class="title_left">
                <h3><a href="<?php echo base_url() ?>index.php/student/courseView/<?php echo $encrypted ?>"><?php echo $course['coursename']?></a></h3>
            </div>
            <div class="clearfix"></div>


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


            <?php if (!empty($top2navigation)): ?>
                <?php $this->load->view($top2navigation); ?>
            <?php else: ?>
                Navigation not found !
            <?php endif; ?>

           <!-- <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <a href="<?php /*echo base_url() */?>index.php/student/courseView/<?php /*echo $encrypted */?>" class="btn btn-success">Lesson Plan</a>
                        <a href="<?php /*echo base_url() */?>index.php/student/courseImplementation/<?php /*echo $encrypted */?>" class="btn btn-success">Lesson Implementation</a>
                        <a href="<?php /*echo base_url() */?>index.php/student/courseMaterial/<?php /*echo $encrypted */?>" class="btn btn-success">Shared Materials</a>
                        <a href="<?php /*echo base_url() */?>index.php/student/courseAssignmentQuiz/<?php /*echo $encrypted */?>" class="btn btn-success">Assignments and Quizzes</a>
                        <a href="<?php /*echo base_url() */?>index.php/student/courseStudent/<?php /*echo $encrypted */?>" class="btn btn-success">Students</a>
                        <a href="<?php /*echo base_url() */?>index.php/student/coursePerformance/<?php /*echo $encrypted_assignid */?>" class="btn btn-success">My Performance</a>

                    </div>
                </div>
            </div>
        </div>-->
        <?php echo form_open('teacher/courseStudentPerformance/'.$encrypted.'/'.$sencrypted); ?>
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
                                    <img class="img-responsive avatar-view teacher_profile_img" src="<?php echo base_url() ?>assets/img/student/<?php echo $student['photo'] ?>" alt="Avatar" title="Change the avatar">
                                </div>
                            </div>

                        </div>
                        <div class="col-md-9 col-sm-9 col-xs-12">

                            <div class="col-md-12">
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Name</div>
                                        <div class="teacher_profile_value"><?php echo $student['firstname'].' '.$student['lastname'] ?></div>
                                    </div>
                                </div>
                                <div class="col-md-6  col-sm-6 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Phone</div>
                                        <div class="teacher_profile_value"><?php echo $student['phone'] ?></div>
                                    </div>
                                </div>
                                <div class="col-md-6  col-sm-6 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Email</div>
                                        <div class="teacher_profile_value"><?php echo $student['email'] ?></div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Address</div>
                                        <div class="teacher_profile_value"><?php echo $student['address'] ?></div>
                                    </div>
                                </div>
                            </div>
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
                        <div class="col-md-12 col-sm-12 col-xs-12 set-margin-top">
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
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="profile_title">
                                <div class="col-md-9">
                                    <h2>Term 1 Report</h2>
                                </div>
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
                                        <td class="set-center"><?php if ($report[0]['motivation'] == '1') { ?>
                                                <span class="option_tick"></span><?php } ?></td>
                                        <td class="set-center"><?php if ($report[0]['motivation'] == '2') { ?>
                                                <span class="option_tick"></span><?php } ?></td>
                                        <td class="set-center"><?php if ($report[0]['motivation'] == '3') { ?>
                                                <span class="option_tick"></span><?php } ?></td>
                                        <td class="set-center"><?php if ($report[0]['motivation'] == '4') { ?>
                                                <span class="option_tick"></span><?php } ?></td>
                                        <td class="set-center"><?php if ($report[0]['motivation'] == '5') { ?>
                                                <span class="option_tick"></span><?php } ?></td>
                                    </tr>
                                    <tr>
                                        <td class="teacher_course_student_mid_td">Shows initiatives and asks questions</td>
                                        <td class="set-center"><?php if ($report[0]['initiative'] == '1') { ?>
                                                <span class="option_tick"></span><?php } ?></td>
                                        <td class="set-center"><?php if ($report[0]['initiative'] == '2') { ?>
                                                <span class="option_tick"></span><?php } ?></td>
                                        <td class="set-center"><?php if ($report[0]['initiative'] == '3') { ?>
                                                <span class="option_tick"></span><?php } ?></td>
                                        <td class="set-center"><?php if ($report[0]['initiative'] == '4') { ?>
                                                <span class="option_tick"></span><?php } ?></td>
                                        <td class="set-center"><?php if ($report[0]['initiative'] == '5') { ?>
                                                <span class="option_tick"></span><?php } ?></td>
                                    </tr>
                                    <tr>
                                        <td class="teacher_course_student_mid_td">Persists despite difficulties</td>
                                        <td class="set-center"><?php if ($report[0]['persistance'] == '1') { ?>
                                                <span class="option_tick"></span><?php } ?></td>
                                        <td class="set-center"><?php if ($report[0]['persistance'] == '2') { ?>
                                                <span class="option_tick"></span><?php } ?></td>
                                        <td class="set-center"><?php if ($report[0]['persistance'] == '3') { ?>
                                                <span class="option_tick"></span><?php } ?></td>
                                        <td class="set-center"><?php if ($report[0]['persistance'] == '4') { ?>
                                                <span class="option_tick"></span><?php } ?></td>
                                        <td class="set-center"><?php if ($report[0]['persistance'] == '5') { ?>
                                                <span class="option_tick"></span><?php } ?></td>
                                    </tr>
                                    <tr>
                                        <td class="teacher_course_student_mid_td">Is well-organised and punctual</td>
                                        <td class="set-center"><?php if ($report[0]['organize'] == '1') { ?>
                                                <span class="option_tick"></span><?php } ?></td>
                                        <td class="set-center"><?php if ($report[0]['organize'] == '2') { ?>
                                                <span class="option_tick"></span><?php } ?></td>
                                        <td class="set-center"><?php if ($report[0]['organize'] == '3') { ?>
                                                <span class="option_tick"></span><?php } ?></td>
                                        <td class="set-center"><?php if ($report[0]['organize'] == '4') { ?>
                                                <span class="option_tick"></span><?php } ?></td>
                                        <td class="set-center"><?php if ($report[0]['organize'] == '5') { ?>
                                                <span class="option_tick"></span><?php } ?></td>
                                    </tr>
                                    <tr>
                                        <td class="teacher_course_student_mid_td">Completes classroom tasks</td>
                                        <td class="set-center"><?php if ($report[0]['task'] == '1') { ?>
                                                <span class="option_tick"></span><?php } ?></td>
                                        <td class="set-center"><?php if ($report[0]['task'] == '2') { ?>
                                                <span class="option_tick"></span><?php } ?></td>
                                        <td class="set-center"><?php if ($report[0]['task'] == '3') { ?>
                                                <span class="option_tick"></span><?php } ?></td>
                                        <td class="set-center"><?php if ($report[0]['task'] == '4') { ?>
                                                <span class="option_tick"></span><?php } ?></td>
                                        <td class="set-center"><?php if ($report[0]['task'] == '5') { ?>
                                                <span class="option_tick"></span><?php } ?></td>
                                    </tr>
                                    <tr>
                                        <td class="teacher_course_student_mid_td">Completes homework on time</td>
                                        <td class="set-center"><?php if ($report[0]['homework'] == '1') { ?>
                                                <span class="option_tick"></span><?php } ?></td>
                                        <td class="set-center"><?php if ($report[0]['homework'] == '2') { ?>
                                                <span class="option_tick"></span><?php } ?></td>
                                        <td class="set-center"><?php if ($report[0]['homework'] == '3') { ?>
                                                <span class="option_tick"></span><?php } ?></td>
                                        <td class="set-center"><?php if ($report[0]['homework'] == '4') { ?>
                                                <span class="option_tick"></span><?php } ?></td>
                                        <td class="set-center"><?php if ($report[0]['homework'] == '5') { ?>
                                                <span class="option_tick"></span><?php } ?></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="profile_title">
                                <div class="col-md-9">
                                    <h2>Term 2 Report</h2>
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
                                        <td class="set-center"><input type="text" class="form-control set-margin-bottom" style="border: none; background-color: transparent" name="mark" value="<?php echo set_value('mark', isset($report[0]['mark']) ? $report[0]['mark'] : ''); ?>" readonly/></td>
                                        <td class="set-center"><input type="text" class="form-control set-margin-bottom" style="border: none; background-color: transparent"name="grade" value="<?php echo set_value('grade', isset($report[0]['grade']) ? $report[0]['grade'] : ''); ?>" readonly/></td>
                                    </tr>
                                    <tr>
                                        <td colspan="6">
                                            <textarea name="comment" class="form-control set-margin-bottom"  rows="3" placeholder='Comments' readonly style="resize: none; border: 0px; background-color: transparent"><?php echo (isset($report[0]['comment']))? $report[0]['comment']:'' ?></textarea>
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
                                        <td class="set-center"><?php if ($report[1]['motivation'] == '1') { ?>
                                                <span class="option_tick"></span><?php } ?></td>
                                        <td class="set-center"><?php if ($report[1]['motivation'] == '2') { ?>
                                                <span class="option_tick"></span><?php } ?></td>
                                        <td class="set-center"><?php if ($report[1]['motivation'] == '3') { ?>
                                                <span class="option_tick"></span><?php } ?></td>
                                        <td class="set-center"><?php if ($report[1]['motivation'] == '4') { ?>
                                                <span class="option_tick"></span><?php } ?></td>
                                        <td class="set-center"><?php if ($report[1]['motivation'] == '5') { ?>
                                                <span class="option_tick"></span><?php } ?></td>
                                    </tr>
                                    <tr>
                                        <td class="teacher_course_student_mid_td">Shows initiatives and asks questions</td>
                                        <td class="set-center"><?php if ($report[1]['initiative'] == '1') { ?>
                                                <span class="option_tick"></span><?php } ?></td>
                                        <td class="set-center"><?php if ($report[1]['initiative'] == '2') { ?>
                                                <span class="option_tick"></span><?php } ?></td>
                                        <td class="set-center"><?php if ($report[1]['initiative'] == '3') { ?>
                                                <span class="option_tick"></span><?php } ?></td>
                                        <td class="set-center"><?php if ($report[1]['initiative'] == '4') { ?>
                                                <span class="option_tick"></span><?php } ?></td>
                                        <td class="set-center"><?php if ($report[1]['initiative'] == '5') { ?>
                                                <span class="option_tick"></span><?php } ?></td>
                                    </tr>
                                    <tr>
                                        <td class="teacher_course_student_mid_td">Persists despite difficulties</td>
                                        <td class="set-center"><?php if ($report[1]['persistance'] == '1') { ?>
                                                <span class="option_tick"></span><?php } ?></td>
                                        <td class="set-center"><?php if ($report[1]['persistance'] == '2') { ?>
                                                <span class="option_tick"></span><?php } ?></td>
                                        <td class="set-center"><?php if ($report[1]['persistance'] == '3') { ?>
                                                <span class="option_tick"></span><?php } ?></td>
                                        <td class="set-center"><?php if ($report[1]['persistance'] == '4') { ?>
                                                <span class="option_tick"></span><?php } ?></td>
                                        <td class="set-center"><?php if ($report[1]['persistance'] == '5') { ?>
                                                <span class="option_tick"></span><?php } ?></td>
                                    </tr>
                                    <tr>
                                        <td class="teacher_course_student_mid_td">Is well-organised and punctual</td>
                                        <td class="set-center"><?php if ($report[1]['organize'] == '1') { ?>
                                                <span class="option_tick"></span><?php } ?></td>
                                        <td class="set-center"><?php if ($report[1]['organize'] == '2') { ?>
                                                <span class="option_tick"></span><?php } ?></td>
                                        <td class="set-center"><?php if ($report[1]['organize'] == '3') { ?>
                                                <span class="option_tick"></span><?php } ?></td>
                                        <td class="set-center"><?php if ($report[1]['organize'] == '4') { ?>
                                                <span class="option_tick"></span><?php } ?></td>
                                        <td class="set-center"><?php if ($report[1]['organize'] == '5') { ?>
                                                <span class="option_tick"></span><?php } ?></td>
                                    </tr>
                                    <tr>
                                        <td class="teacher_course_student_mid_td">Completes classroom tasks</td>
                                        <td class="set-center"><?php if ($report[1]['task'] == '1') { ?>
                                                <span class="option_tick"></span><?php } ?></td>
                                        <td class="set-center"><?php if ($report[1]['task'] == '2') { ?>
                                                <span class="option_tick"></span><?php } ?></td>
                                        <td class="set-center"><?php if ($report[1]['task'] == '3') { ?>
                                                <span class="option_tick"></span><?php } ?></td>
                                        <td class="set-center"><?php if ($report[1]['task'] == '4') { ?>
                                                <span class="option_tick"></span><?php } ?></td>
                                        <td class="set-center"><?php if ($report[1]['task'] == '5') { ?>
                                                <span class="option_tick"></span><?php } ?></td>
                                    </tr>
                                    <tr><td class="teacher_course_student_mid_td">Completes homework on time</td>
                                        <td class="set-center"><?php if ($report[1]['homework'] == '1') { ?>
                                                <span class="option_tick"></span><?php } ?></td>
                                        <td class="set-center"><?php if ($report[1]['homework'] == '2') { ?>
                                                <span class="option_tick"></span><?php } ?></td>
                                        <td class="set-center"><?php if ($report[1]['homework'] == '3') { ?>
                                                <span class="option_tick"></span><?php } ?></td>
                                        <td class="set-center"><?php if ($report[1]['homework'] == '4') { ?>
                                                <span class="option_tick"></span><?php } ?></td>
                                        <td class="set-center"><?php if ($report[1]['homework'] == '5') { ?>
                                                <span class="option_tick"></span><?php } ?></td>
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
                                        <td class="set-center"><input type="text" class="form-control set-margin-bottom" style="border: none; background-color: transparent" name="fmark" value="<?php echo set_value('fmark', isset($report[1]['mark']) ? $report[1]['mark'] : ''); ?>" readonly/></td>
                                        <td class="set-center"><input type="text" class="form-control set-margin-bottom" style="border: none; background-color: transparent"name="fgrade" value="<?php echo set_value('fgrade', isset($report[1]['grade']) ? $report[1]['grade'] : ''); ?>" readonly/></td>
                                    </tr>
                                    <tr>
                                        <td colspan="6">
                                            <textarea name="fcomment"class="form-control set-margin-bottom" style="border: none;" rows="3" placeholder='Comments' readonly style="resize: none; border: 0px; background-color: transparent"><?php echo (isset($report[1]['comment']))? $report[1]['comment']:'' ?></textarea>
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
