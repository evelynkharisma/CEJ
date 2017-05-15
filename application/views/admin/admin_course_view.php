<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <?php
            if(isset($info_db['assignid'])){
                $encrypted = 's'.$this->general->encryptParaID($info_db['assignid'],'courseassigned');
            }
            else{
                $encrypted = 'c'.$this->general->encryptParaID($info_db['courseid'],'course');
            }

        ?>
        <div class="page-title">
            <div class="title_left">
<!--                <h3>--><?php //echo $info_db['coursename'] ?><!-- <a class="btn btn-success" href="--><?php //echo base_url() ?><!--index.php/teacher/editCourse/--><?php //echo isset($info_db['assignid']) && $info_db['assignid'] == null ? $info_db['assignid'] : $info_db['courseid'] ?><!--"><i class="fa fa-edit m-right-xs"></i> Edit Course</a></h3>-->
                <h3><?php echo $info_db['coursename'] ?></h3>
            </div>

          
        </div>

        <div class="clearfix"></div>

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
                        <a class="btn btn-success set-right" href="<?php echo base_url() ?>index.php/admin/editCourse/<?php echo $encrypted ?>"><i class="fa fa-edit m-right-xs"></i> Edit Course</a>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <?php echo $info_db['coursedescription'] ?>
                        <br><br>
                        Resources:
                        <ul>
                            <?php
                                $courseResources = explode('|', $info_db['courseresources']);
                                foreach ($courseResources as $resource):
                            ?>
                                <li><?php echo $resource ?></li>
                            <?php endforeach; ?>
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
                                    if($plans){
                                        foreach($plans as $plan){ ?>
                                        <tr>
                                            <td align="center"><?php echo $plan['lessoncount'] ?></td>
                                            <td>Chapter <?php echo $plan['chapter'] ?></td>
                                            <td><?php echo $plan['objective'] ?></td>
                                            <td><?php echo $plan['activities'] ?></td>
                                            <td><?php echo $plan['material'] ?></td>
                                        </tr>
                                <?php }}
                                    else {?>
                                        <tr>
                                            <td colspan="5"><?php echo 'no lesson plan found' ?></td>
                                        </tr>
                                    <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
<!--        <div class="row">-->
<!--            <div class="col-md-12 col-sm-12 col-xs-12">-->
<!--                <div class="x_panel">-->
<!--                    <div class="x_title">-->
<!--                        <h2>Evaluation</h2>-->
<!--                        <div class="clearfix"></div>-->
<!--                    </div>-->
<!--                    <div class="x_content">-->
<!--                        <table class="teacher_course_evaluation">-->
<!--                            <thead>-->
<!--                                <tr>-->
<!--                                    <th width="40%">Components</th>-->
<!--                                    <th width="30%">Weight</th>-->
<!--                                </tr>-->
<!--                            </thead>-->
<!--                            <tbody>-->
<!--                                <tr>-->
<!--                                    <td>Assignment</td>-->
<!--                                    <td>5 %</td>-->
<!--                                </tr>-->
<!--                                <tr>-->
<!--                                    <td>Quiz</td>-->
<!--                                    <td>15 %</td>-->
<!--                                </tr>-->
<!--                                <tr>-->
<!--                                    <td>Daily Exam</td>-->
<!--                                    <td>20 %</td>-->
<!--                                </tr>-->
<!--                                <tr>-->
<!--                                    <td>Mid Exam</td>-->
<!--                                    <td>30 %</td>-->
<!--                                </tr>-->
<!--                                <tr>-->
<!--                                    <td>Final Exam</td>-->
<!--                                    <td>30 %</td>-->
<!--                                </tr>-->
<!--                            </tbody>-->
<!--                        </table>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
    </div>
</div>
<!-- /page content -->