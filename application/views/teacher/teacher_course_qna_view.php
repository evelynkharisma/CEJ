<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3><?php echo $info_db['coursename'] ?></h3>
            </div>


        </div>

        <div class="clearfix"></div>

        <?php if ($this->nativesession->get('success')): ?>
            <div  class="alert alert-success">
                <?php echo $this->nativesession->get('success');$this->nativesession->delete('success'); ?>
            </div>
        <?php endif; ?>
        <?php if ($this->nativesession->get('error')): ?>
            <div  class="alert alert-error">
                <?php echo $this->nativesession->get('error');$this->nativesession->delete('error'); ?>
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
                        <?php
                            $encrypted = $this->general->encryptParaID($info_db['assignid'],'courseassigned');
                        ?>
                        <h2>Assignment and Quizzes</h2><a href="<?php echo base_url() ?>index.php/teacher/addQnA/<?php echo $encrypted ?>" class="btn btn-success set-right"><i class="fa fa-upload"></i> Upload</a>
<!--                        <a data-toggle="modal" data-target="#upload" class="btn btn-success set-right"><i class="fa fa-upload"></i> Upload</a>-->
<!---->
<!--                        <div id="upload" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">-->
<!--                            <div class="modal-dialog modal-lg">-->
<!--                                <div class="modal-content">-->
<!---->
<!--                                    <div class="modal-header">-->
<!--                                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>-->
<!--                                        </button>-->
<!--                                        <h4 class="modal-title" id="myModalLabel">Upload Assignment or Quiz</h4>-->
<!--                                    </div>-->
<!--                                    <div class="modal-body">-->
<!--                                        --><?php //echo form_open_multipart('teacher/courseMaterialUpload'); ?>
<!--                                        <div class="form-group">-->
<!--                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Topic</label>-->
<!--                                            <div class="col-md-9 col-sm-9 col-xs-12 set-margin-bottom">-->
<!--                                                <select class="form-control">-->
<!--                                                    <option>Topic 1</option>-->
<!--                                                    <option>Topic 2</option>-->
<!--                                                </select>-->
<!--                                            </div>-->
<!--                                        </div>-->
<!--                                        <div class="form-group">-->
<!--                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Type</label>-->
<!--                                            <div class="col-md-9 col-sm-9 col-xs-12 set-margin-bottom">-->
<!--                                                <select class="form-control">-->
<!--                                                    <option>Assignment</option>-->
<!--                                                    <option>Quiz</option>-->
<!--                                                </select>-->
<!--                                            </div>-->
<!--                                        </div>-->
<!--                                        <div class="form-group">-->
<!--                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Due Date</label>-->
<!--                                            <div class="col-md-9 col-sm-9 col-xs-12 set-margin-bottom">-->
<!--                                                <input id="duedate" class="date-picker form-control col-md-7 col-xs-12" required="required" type="text">-->
<!--                                            </div>-->
<!--                                        </div>-->
<!--                                        <div class="form-group">-->
<!--                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">File</label>-->
<!--                                            <div class="col-md-9 col-sm-9 col-xs-12 set-margin-bottom">-->
<!--                                                <input class="btn btn-yellow" type="file" name="userfile" />-->
<!--                                            </div>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                    <div class="modal-footer">-->
<!--                                        <button type="submit" class="btn btn-success"><i class="fa fa-upload"></i> Upload</button>-->
<!--                                    </div>-->
<!--                                    --><?php //echo form_close(); ?>
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->

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
                                <?php if($qnas){
                                foreach($qnas as $qna){ ?>
                                    <tr>
                                        <td><?php echo $qna['topic'] ?></td>
                                        <td><?php echo $qna['type'] ?></td>
                                        <td><?php echo $qna['date'] ?></td>
                                        <td><?php echo $qna['duedate'] ?></td>
                                        <td>
                                            <?php
                                                $qencrypted = $this->general->encryptParaID($qna['anqid'],'anq');
                                            ?>
                                            <a download href="<?php echo base_url() ?>assets/file/teacher/material/<?php echo $qna['filename'] ?>" class="btn btn-success"><i class="fa fa-download"></i> Download</a>
                                            <a href="<?php echo base_url() ?>index.php/teacher/courseAssignmentQuizSubmission/<?php echo $encrypted ?>/<?php echo $qencrypted ?>" class="btn btn-yellow"><i class="fa fa-child"></i> Submission</a>
                                            <a href="<?php echo base_url() ?>index.php/teacher/sendQnAEmailToAll/<?php echo $encrypted ?>/<?php echo $qencrypted ?>" class="btn btn-danger"><i class="fa fa-bell-o"></i> Notify</a>
                                            <a href="<?php echo base_url() ?>index.php/teacher/deleteQnA/<?php echo $encrypted ?>/<?php echo $qencrypted ?>" class="btn-success btn" onclick="return confirm('Are you sure want to delete this?');"><i class="fa fa-trash"></i> Delete</a>
                                        </td>
                                    </tr>
                                <?php } }?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->