<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3><?php echo $info_db['coursename'] ?> <a class="btn btn-success" href="<?php echo base_url() ?>index.php/teacher/editCourse/<?php echo $info_db['assignid'] ?>"><i class="fa fa-edit m-right-xs"></i> Edit Course</a></h3>
            </div>

          
        </div>

        <div class="clearfix"></div>

        <?php if ($this->session->flashdata('success')): ?>
            <div  class="alert alert-success">
                <?php echo $this->session->flashdata('success'); ?>
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
                            <tr>
                                <td align="center">1</td>
                                <td>Chapter <?php echo $info_db['lesson1chapter'] ?></td>
                                <td><?php echo $info_db['lesson1objective'] ?></td>
                                <td><?php echo $info_db['lesson1activities'] ?></td>
                                <td><?php echo $info_db['lesson1material'] ?></td>
                            </tr>
                            <tr>
                                <td align="center">2</td>
                                <td>Chapter <?php echo $info_db['lesson2chapter'] ?></td>
                                <td><?php echo $info_db['lesson2objective'] ?></td>
                                <td><?php echo $info_db['lesson2activities'] ?></td>
                                <td><?php echo $info_db['lesson2material'] ?></td>
                            </tr>
                            <tr>
                                <td align="center">3</td>
                                <td>Chapter <?php echo $info_db['lesson3chapter'] ?></td>
                                <td><?php echo $info_db['lesson3objective'] ?></td>
                                <td><?php echo $info_db['lesson3activities'] ?></td>
                                <td><?php echo $info_db['lesson3material'] ?></td>
                            </tr>
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