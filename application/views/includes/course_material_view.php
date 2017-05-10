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
                            <a href="<?php echo base_url() ?>index.php/<?php echo $from ?>/courseMaterial/<?php echo $encrypted ?>" class="btn btn-success">Shared Materials</a>
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
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <table class="teacher_course_implementation">
                                <thead>
                                <tr>
                                    <th width="40%">Topic</th>
                                    <th width="25%">Type</th>
                                    <th width="25%">Upload Date</th>
                                    <th width="10%">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                if($materials) {
                                    foreach ($materials as $material) {
                                        ?>
                                        <tr>
                                            <td><?php echo $material['topic'] ?></td>
                                            <td><?php echo $material['type'] ?></td>
                                            <td><?php echo date('d F Y', strtotime($material['date'])) ?></td>
                                            <td>
                                                <a class="btn btn-success" href="<?php echo base_url() ?>assets/file/teacher/material/<?php echo $material['filename']?>"><i class="fa fa-download"></i> Download</a>
                                            </td>
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
    <!-- /page content -->