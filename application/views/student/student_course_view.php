<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <?php
        $encrypted = $this->general->encryptParaID($course['courseid'],'course');
        ?>
        <div class="page-title">
            <div class="title_left">
                <h3><a href="<?php echo base_url() ?>index.php/student/courseView/<?php echo $encrypted ?>"><?php echo $course['coursename']?></a></h3>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <a href="<?php echo base_url() ?>index.php/student/coursePlan/<?php echo $encrypted ?>" class="btn btn-success">Lesson Plan</a>
                        <a href="<?php echo base_url() ?>index.php/student/courseImplementation/<?php echo $encrypted ?>" class="btn btn-success">Lesson Implementation</a>
                        <a href="<?php echo base_url() ?>index.php/student/courseMaterial" class="btn btn-success">Shared Materials</a>
                        <a href="<?php echo base_url() ?>index.php/student/courseAssignmentQuiz" class="btn btn-success">Assignments and Quizzes</a>
                        <a href="<?php echo base_url() ?>index.php/student/courseStudent" class="btn btn-success">Students</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Course Overview</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                      <?php echo $course['coursedescription'];?>
                        <br><br>
                        Resources:
                        <ul>
                        <?php
                        $token = strtok($course['courseresources'], "|");
                        while ($token !== false)
                        {
                            ?>
                            <li><?php echo $token;
                                $token = strtok("|");
                            ?></li>
                            <?php
                        }?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
<!--        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Evaluation</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <table class="teacher_course_evaluation">
                            <thead>
                            <tr>
                                <th width="40%">Components</th>
                                <th width="30%">Weight</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>Assignment</td>
                                <td>5 %</td>
                            </tr>
                            <tr>
                                <td>Quiz</td>
                                <td>15 %</td>
                            </tr>
                            <tr>
                                <td>Daily Exam</td>
                                <td>20 %</td>
                            </tr>
                            <tr>
                                <td>Mid Exam</td>
                                <td>30 %</td>
                            </tr>
                            <tr>
                                <td>Final Exam</td>
                                <td>30 %</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>-->
    </div>
</div>
<!-- /page content -->