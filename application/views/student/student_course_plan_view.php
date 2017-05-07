<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Course Name</h3>
            </div>
        </div>

        <div class="clearfix"></div>
        <?php
        $encrypted = $this->general->encryptParaID($course['courseid'],'course');
        ?>
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
                        <h2>Lesson Plan</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <table class="teacher_course_implementation">
                            <thead>
                            <tr>
                                <th width="10%" style="text-align: center">Lesson</th>
                                <th width="20%">Chapter/Unit</th>
                                <th width="20%">Learning Objective</th>
                                <th width="20%">Materials/Resources</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php

                            foreach ($course_plan as $plan) {

                            ?>
                                <tr>
                                    <td align="center"><?php echo $plan['lessoncount'] ?></td>
                                    <td><?php echo $plan['chapter'] ?></td>
                                    <td><?php echo $plan['objective'] ?></td>
                                    <td><?php echo $plan['material'] ?></td>
                                </tr>
                            <?php
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->