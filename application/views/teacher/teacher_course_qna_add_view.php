<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3><?php echo $info_db['coursename'] ?></h3>
            </div>


        </div>

        <div class="clearfix"></div>

        <?php if (!empty($top2navigation)): ?>
            <?php $this->load->view($top2navigation); ?>
        <?php else: ?>
            Navigation not found !
        <?php endif; ?>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Add Assignment or Quiz</h2>
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
                    </div>
                    <div class="x_content">
                        <?php
                            $encrypted = $this->general->encryptParaID($info_db['assignid'],'courseassigned');
                        ?>
                        <?php echo form_open_multipart('teacher/addQnA/'.$encrypted); ?>
                        <input type="hidden" class="form-control set-margin-bottom" name="coursename" value="<?php echo $info_db['coursename']; ?>"/>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Topic</label>
                            <div class="col-md-9 col-sm-9 col-xs-12 set-margin-bottom">
                                <select name="topic" class="form-control">
<!--                                    <option disabled selected="selected">Topic</option>-->
                                    <option selected value="<?php if(isset($_POST['topic'])) {echo htmlentities ($_POST['topic']); }?>"><?php if(isset($_POST['topic'])) {echo htmlentities ($_POST['topic']); }else{echo 'Topic';}?></option>
                                    <?php foreach ($lessons as $lesson){?>
                                        <option value="<?php echo $lesson['activities']; ?>"><?php echo $lesson['activities']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Type</label>
                            <div class="col-md-9 col-sm-9 col-xs-12 set-margin-bottom">
                                <select name="type" class="form-control">
<!--                                    <option disabled selected="selected">Type</option>-->
                                    <option selected value="<?php if(isset($_POST['type'])) {echo htmlentities ($_POST['type']); }?>"><?php if(isset($_POST['type'])) {echo htmlentities ($_POST['type']); }else{echo 'Type';}?></option>
                                    <option value="Assignment">Assignment</option>
                                    <option value="Quiz">Quiz</option>
                                    <option value="Classwork">Classwork</option>
                                    <option value="Homework">Homework</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Due Date</label>
                            <div class="col-md-9 col-sm-9 col-xs-12 set-margin-bottom">
                                <input name="duedate" id="duedate" class="date-picker form-control col-md-7 col-xs-12" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Existing File</label>
                            <div class="col-md-9 col-sm-9 col-xs-12 set-margin-bottom">
                                <select name="existingfile" class="form-control">
<!--                                    <option disabled selected="selected">Files</option>-->
                                    <option selected value="<?php if(isset($_POST['existingfile'])) {echo htmlentities ($_POST['existingfile']); }?>"><?php if(isset($_POST['existingfile'])) {echo htmlentities ($_POST['existingfile']); }else{echo 'File';}?></option>
                                    <option value="None">No File (For classwork and homework)</option>
                                    <?php foreach ($files as $file){?>
                                        <option value="<?php echo $file['fileid']; ?>"><?php echo $file['filename']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <label class="set-margin-bottom control-label col-md-12 col-sm-12 col-xs-12">OR</label>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12 set-margin-top">New File</label>
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