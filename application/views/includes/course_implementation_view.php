<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <?php
        $encrypted = $this->general->encryptParaID($course['courseid'],'course');
        $encrypted_assignid = $this->general->encryptParaID($course['assignid'],'courseassigned');
        ?>
        <div class="page-title">
            <div class="title_left">
                <h3><a href="<?php echo base_url() ?>index.php/<?php echo $from ?>/courseView/<?php echo $encrypted ?>"><?php echo $course['coursename']?></a></h3>

            </div>

            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_content">
                            <a href="<?php echo base_url() ?>index.php/<?php echo $from ?>/courseView/<?php echo $encrypted ?>" class="btn btn-success">Lesson Plan</a>
                            <a href="<?php echo base_url() ?>index.php/<?php echo $from ?>/courseImplementation/<?php echo $encrypted ?>" class="btn btn-success">Lesson Implementation</a>
                            <a href="<?php echo base_url() ?>index.php/<?php echo $from ?>/courseMaterial/<?php echo $encrypted ?>"  class="btn btn-success">Shared Materials</a>
                            <a href="<?php echo base_url() ?>index.php/<?php echo $from ?>/courseAssignmentQuiz/<?php echo $encrypted ?>" class="btn btn-success">Assignments and Quizzes</a>
                            <?php if($from != 'parents'){?>
                                <a href="<?php echo base_url() ?>index.php/<?php echo $from ?>/courseStudent/<?php echo $encrypted ?>" class="btn btn-success">Students</a>
                            <?php }?>
                            <a href="<?php echo base_url() ?>index.php/<?php echo $from ?>/coursePerformance/<?php echo $encrypted_assignid ?>" class="btn btn-success">Performance</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Lesson Implementation</h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <table class="teacher_course_implementation">
                                <thead>
                                <tr>
                                    <th width="10%" style="text-align: center">Lesson</th>
                                    <th width="20%">Chapter/Unit</th>
                                    <th width="20%">Learning Objective</th>
                                    <th width="20%">Activities</th>
                                    <th width="20%">Materials/Resources</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                if($course_implementation) {
                                    foreach ($course_implementation as $plan) {

                                        ?>
                                        <tr>
                                            <td align="center"><?php echo $plan['implementationcount'] ?></td>
                                            <td><?php echo $plan['chapter'] ?></td>
                                            <td><?php echo $plan['objective'] ?></td>
                                            <td><?php echo $plan['activities'] ?></td>
                                            <td><?php echo $plan['material'] ?></td>
                                        </tr>
                                        <?php
                                    }}
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>