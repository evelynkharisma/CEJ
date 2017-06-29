<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <?php
        $encrypted = $this->general->encryptParaID($course['courseid'],'course');
        $encrypted_assignid = $this->general->encryptParaID($course['assignid'],'courseassigned');

        ?>
        <div class="page-title">
            <div class="title_left">
                <h3><a href="<?php echo base_url() ?>index.php/student/courseView/<?php echo $encrypted ?>"><?php echo $course['coursename']?></a></h3>
            </div>
        </div>

        <div class="clearfix"></div>

<!--        <div class="row">-->
<!--            <div class="col-md-12 col-sm-12 col-xs-12">-->
<!--                <div class="x_panel">-->
<!--                    <div class="x_content">-->
<!--                        <a href="--><?php //echo base_url() ?><!--index.php/student/courseView/--><?php //echo $encrypted ?><!--" class="btn btn-success">Lesson Plan</a>-->
<!--                        <a href="--><?php //echo base_url() ?><!--index.php/student/courseImplementation/--><?php //echo $encrypted ?><!--" class="btn btn-success">Lesson Implementation</a>-->
<!--                        <a href="--><?php //echo base_url() ?><!--index.php/student/courseMaterial/--><?php //echo $encrypted ?><!--" class="btn btn-success">Shared Materials</a>-->
<!--                        <a href="--><?php //echo base_url() ?><!--index.php/student/courseAssignmentQuiz/--><?php //echo $encrypted ?><!--" class="btn btn-success">Assignments and Quizzes</a>-->
<!--                        <a href="--><?php //echo base_url() ?><!--index.php/student/courseStudent/--><?php //echo $encrypted ?><!--" class="btn btn-success">Students</a>-->
<!--                        <a href="--><?php //echo base_url() ?><!--index.php/student/coursePerformance/--><?php //echo $encrypted_assignid ?><!--" class="btn btn-success">My Performance</a>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->

        <div class="clearfix"></div>
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
        <?php if ($this->nativesession->get('success')): ?>
            <div  class="alert alert-success">
                <?php echo $this->nativesession->get('success'); $this->nativesession->delete('success');?>
            </div>
        <?php endif; ?>

        <?php if (!empty($top2navigation)): ?>
            <?php $this->load->view($top2navigation); ?>
        <?php else: ?>
            Navigation not found !
        <?php endif; ?>


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
                                <th width="20%">Student Activities</th>
                                <th width="20%">Materials/Resources</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            if($course_plan) {
                            foreach ($course_plan as $plan) {

                                ?>
                                <tr>
                                    <td align="center"><?php echo $plan['lessoncount'] ?></td>
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
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Feedback</h2>
                        <div class="clearfix"></div>
                    </div>
                    <?php if($feedback==NULL )
                    {
                        $null=1; }
                    else {
                        $null = 0; }
                    ?>
                    <?php echo form_open('student/submitFeedback/'.$encrypted.'/'.$encrypted_assignid.'/'.$null.''); ?>
                        <div class="x_content">
                            <textarea style="resize: none" class="form-control set-margin-bottom" rows="3" placeholder='Feedback' name="feedback"><?php echo $feedback?></textarea>
                        </div>

                        <button type="submit" class="btn-success btn set-right"><i class="fa fa-save"></i> Save</button>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->