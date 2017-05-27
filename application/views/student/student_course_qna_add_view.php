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
                        <h2>Submit Assignment or Quizzes</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <?php
                        $encrypted = $this->general->encryptParaID($anqID,'anq');
                        ?>
                        <?php echo form_open_multipart('student/courseAssignmentQuizSubmission/'.$encrypted); ?>
                        <input type="hidden" class="form-control set-margin-bottom" name="studentid" value="<?php echo $student['studentid']; ?>"/>
                        <input type="hidden" class="form-control set-margin-bottom" name="teacherid" value="<?php echo $teacherid; ?>"/>
                        <input type="hidden" class="form-control set-margin-bottom" name="anqid" value="<?php echo $anqID; ?>"/>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Topic</label>
                            <div class="col-md-9 col-sm-9 col-xs-12 set-margin-bottom">
                                <input type="text" class="form-control col-md-7 col-xs-12" name="topic" value="<?php echo $anqData['topic']?>" readonly/>

                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Type</label>
                            <div class="col-md-9 col-sm-9 col-xs-12 set-margin-bottom">
                                <input type="text" class="form-control col-md-7 col-xs-12" name="type" value="<?php echo $anqData['type']?>" readonly/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Due Date</label>
                            <div class="col-md-9 col-sm-9 col-xs-12 set-margin-bottom">
                                <input name="duedate" id="duedate" class="date-picker form-control col-md-7 col-xs-12" type="text" readonly/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12 set-margin-top">Choose File</label>
                            <div class="col-md-9 col-sm-9 col-xs-12 set-margin-bottom">
                                <input class="btn btn-yellow" type="file" name="userfile" />
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success set-margin-top"><i class="fa fa-upload"></i> Upload</button>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->