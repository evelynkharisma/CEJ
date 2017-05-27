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
                        <a href="<?php /*echo base_url() */?>index.php/student/coursePlan/<?php /*echo $encrypted */?>" class="btn btn-success">Lesson Plan</a>
                        <a href="<?php /*echo base_url() */?>index.php/student/courseImplementation/<?php /*echo $encrypted */?>" class="btn btn-success">Lesson Implementation</a>
                        <a href="<?php /*echo base_url() */?>index.php/student/courseMaterial/<?php /*echo $encrypted */?>" class="btn btn-success">Shared Materials</a>
                        <a href="<?php /*echo base_url() */?>index.php/student/courseAssignmentQuiz/<?php /*echo $encrypted */?>" class="btn btn-success">Assignments and Quizzes</a>
                        <a href="<?php /*echo base_url() */?>index.php/student/courseStudent/<?php /*echo $encrypted */?>" class="btn btn-success">Students</a>
                        <a href="<?php /*echo base_url() */?>index.php/student/coursePerformance/<?php /*echo $encrypted_assignid */?>" class="btn btn-success">My Performance</a>
                    </div>
                </div>
            </div>
        </div>-->
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Assignment and Quizzes</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <table class="teacher_course_implementation">
                            <thead>
                            <tr>
                                <th width="25%">Topic</th>
                                <th width="15%">Type</th>
                                <th width="15%">Upload Date</th>
                                <th width="15%">Due Date</th>
                                <th width="30%">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                                if($qnas){
                                foreach($qnas as  $qna) {
                                    $encrypted_anq = $this->general->encryptParaID($qna['anqid'],'anq');
                                    ?>
                                    <tr>
                                        <td><?php echo $qna['topic']?></td>
                                        <td><?php echo $qna['type']?></td>
                                        <td><?php echo date('d', strtotime($qna['uploaddate'])).' '.date('F', strtotime($qna['uploaddate'])).' '.date('Y', strtotime($qna['uploaddate']))?></td>
                                        <td><?php echo date('d', strtotime($qna['duedate'])).' '.date('F', strtotime($qna['duedate'])).' '.date('Y', strtotime($qna['duedate']))?></td>
                                        <td>
                                            <a class="btn btn-success" href="<?php echo base_url() ?>assets/file/teacher/material/<?php echo $qna['filename']?>"><i class="fa fa-download"></i> Download</a>
                                        <a href="<?php echo base_url() ?>index.php/student/courseAssignmentQuizSubmission/<?php echo $encrypted_anq?>" class="btn btn-yellow"><i class="fa fa-child"></i> Submission</a>
                                        </td>
                                    </tr>
                            <?php }}?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->