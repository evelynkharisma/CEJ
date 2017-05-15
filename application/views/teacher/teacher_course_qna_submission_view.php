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
            <div  class="alert alert-success">
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
                            $notifencrypted = $this->general->encryptParaID($info_db['assignid'],'courseassigned');
                            $notifqencrypted = $this->general->encryptParaID($qna['anqid'],'anq');
                        ?>
                        <h2><?php echo $qna['topic'] ?> <?php echo $qna['type'] ?> Submission</h2><a href="<?php echo base_url() ?>index.php/teacher/sendQnAEmailToAll/<?php echo $notifencrypted ?>/<?php echo $notifqencrypted ?>" class="btn btn-danger set-right"><i class="fa fa-bell-o"></i> Notify All</a>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <table id="attendance" class="teacher_course_implementation">
                            <thead>
                            <tr>
                                <th width="15%">Photo</th>
                                <th width="25%">Name</th>
                                <th width="20%">Submission Date</th>
                                <th width="20%">Grading</th>
                                <th width="20%">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php
                                    if($submit){
                                    foreach($submit as $s){ ?>
                                        <tr>
                                            <td>
                                                <div class="teacher_photo_crop">
                                                    <img src="<?php echo base_url() ?>assets/img/student/<?php echo $s['photo'] ?>" alt="..." class="teacher_photo_img">
                                                </div>
                                            </td>
                                            <td><?php echo $s['firstname'] ?> <?php echo $s['lastname'] ?></td>
                                            <td><?php echo $s['submissiondate'] ?></td>
                                            <td>
                                                <?php
                                                $encrypted = $this->general->encryptParaID($info_db['assignid'],'courseassigned');
                                                $qencrypted = $this->general->encryptParaID($s['anqscoreid'],'anqscore');
                                                $sencrypted = $this->general->encryptParaID($s['studentid'],'student');
                                                ?>
                                                <?php echo form_open('teacher/courseSubmissionGrading/'.$encrypted.'/'.$qencrypted); ?>
                                                    <button type="submit" class="btn btn-success set-right"><i class="fa fa-check"></i></button>
                                                    <input style="width:70%;" class="form-control" placeholder='Score' name="score" value="<?php echo set_value('score', isset($s['score']) ? $s['score'] : ''); ?>">
                                                <?php echo form_close(); ?>
                                            <td><a download href="<?php echo base_url() ?>assets/file/student/submission/<?php echo $s['file'] ?>" class="btn btn-success"><i class="fa fa-download"></i> Download</a></td>
                                        </tr>
                                <?php }} ?>
                                <?php
                                if($nosubmit){
                                foreach($nosubmit as $s){ ?>
                                    <tr>
                                        <td>
                                            <div class="teacher_photo_crop">
                                                <img src="<?php echo base_url() ?>assets/img/student/<?php echo $s['photo'] ?>" alt="..." class="teacher_photo_img">
                                            </div>
                                        </td>
                                        <td><?php echo $s['firstname'] ?> <?php echo $s['lastname'] ?></td>
                                        <td><?php echo $s['submissiondate'] ?></td>
                                        <td>
                                            <?php
                                                $encrypted = $this->general->encryptParaID($info_db['assignid'],'courseassigned');
                                                $qencrypted = $this->general->encryptParaID($s['anqscoreid'],'anqscore');
                                                $sencrypted = $this->general->encryptParaID($s['studentid'],'student');
                                            ?>
                                            <?php echo form_open('teacher/courseSubmissionGrading/'.$encrypted.'/'.$qencrypted); ?>
                                            <input type="hidden" class="form-control set-margin-bottom" name="studentid" value="<?php echo $s['studentid']; ?>"/>
                                            <input type="hidden" class="form-control set-margin-bottom" name="qnaid" value="<?php echo $qna['anqid']; ?>"/>
                                            <button type="submit" class="btn btn-success set-right"><i class="fa fa-check"></i></button>
                                            <input style="width:70%;" class="form-control" placeholder='Score' name="score" value="<?php echo set_value('score', isset($s['score']) ? $s['score'] : ''); ?>">
                                            <?php echo form_close(); ?>
                                        <td><a href="<?php echo base_url() ?>index.php/teacher/sendQnAEmail/<?php echo $sencrypted ?>/<?php echo $notifqencrypted ?>" class="btn btn-danger"><i class="fa fa-bell-o"></i> Notify</a></td>
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