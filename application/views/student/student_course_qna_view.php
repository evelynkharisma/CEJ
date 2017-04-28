<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Course Name</h3>
            </div>


        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <a href="<?php echo base_url() ?>index.php/student/coursePlan" class="btn btn-success">Lesson Plan</a>
                        <a href="<?php echo base_url() ?>index.php/student/courseImplementation" class="btn btn-success">Lesson Implementation</a>
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
                        <h2>Assignment and Quizzes</h2>
<!--                        <a data-toggle="modal" data-target="#upload" class="btn btn-success set-right"><i class="fa fa-upload"></i> Upload</a>-->

                        <div id="upload" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">

                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                                        </button>
                                        <h4 class="modal-title" id="myModalLabel">Upload Assignment or Quiz</h4>
                                    </div>
                                    <div class="modal-body">
                                        <?php echo form_open_multipart('student/courseMaterialUpload'); ?>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Topic</label>
                                            <div class="col-md-9 col-sm-9 col-xs-12 set-margin-bottom">
                                                <select class="form-control">
                                                    <option>Topic 1</option>
                                                    <option>Topic 2</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Type</label>
                                            <div class="col-md-9 col-sm-9 col-xs-12 set-margin-bottom">
                                                <select class="form-control">
                                                    <option>Assignment</option>
                                                    <option>Quiz</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Due Date</label>
                                            <div class="col-md-9 col-sm-9 col-xs-12 set-margin-bottom">
                                                <input id="duedate" class="date-picker form-control col-md-7 col-xs-12" required="required" type="text">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">File</label>
                                            <div class="col-md-9 col-sm-9 col-xs-12 set-margin-bottom">
                                                <input class="btn btn-yellow" type="file" name="userfile" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-success"><i class="fa fa-upload"></i> Upload</button>
                                    </div>
                                    <?php echo form_close(); ?>
                                </div>
                            </div>
                        </div>

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
                                if($submissions){
                                foreach($submissions as $submission) { ?>
                                    <tr>
                                        <td><?php echo $submission['topic']?></td>
                                        <td><?php echo $submission['type']?></td>
                                        <td><?php echo date('d', strtotime($submission['uploaddate'])).' '.date('F', strtotime($submission['uploaddate'])).' '.date('Y', strtotime($submission['uploaddate']))?></td>
                                        <td><?php echo date('d', strtotime($submission['duedate'])).' '.date('F', strtotime($submission['duedate'])).' '.date('Y', strtotime($submission['duedate']))?></td>
                                        <td>
                                        <a href="<?php echo base_url() ?>index.php/student/courseAssignmentQuizSubmission" class="btn btn-yellow"><i class="fa fa-child"></i> Submission</a>
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