<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <?php
                $encrypted = $this->general->encryptParaID($info_db['assignid'],'courseassigned');
            ?>
            <?php echo form_open_multipart('teacher/editSemester/'.$encrypted); ?>
            <div class="title_left">
                <input type="hidden" class="form-control set-margin-bottom" name="courseid" value="<?php echo $info_db['courseid']; ?>"/>
            </div>


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

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Semester Plan</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <table class="teacher_course_implementation">
                            <thead>
                            <tr>
                                <th width="10%">Weeks</th>
                                <th width="20%">Topic</th>
                                <th width="20%">Outcome</th>
                                <th width="20%">Assessment</th>
                                <th width="20%">Resources</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                                if($plans){
                                    foreach($plans as $plan){ ?>
                                        <tr>
                                            <input type="hidden" class="form-control set-margin-bottom" name="semesterido[]" value="<?php echo $plan['semesterid']; ?>"/>
                                            <td><input type="text" class="form-control set-margin-bottom set-margin-top" name="weeko[]" value="<?php echo set_value('week', isset($plan['week']) ? $plan['week'] : 'ex: 1,2,3-4'); ?>"/></td>
                                            <td><textarea class="form-control set-margin-bottom" name="topico[]" rows="3"><?php echo isset($plan['topic']) ? $plan['topic'] : ''; ?></textarea></td>
                                            <td><textarea class="form-control set-margin-bottom" name="outcomeo[]" rows="3"><?php echo isset($plan['outcome']) ? $plan['outcome'] : ''; ?></textarea></td>
                                            <td><textarea class="form-control set-margin-bottom" name="assessmento[]" rows="3"><?php echo isset($plan['assessment']) ? $plan['assessment'] : ''; ?></textarea></td>
                                            <td><textarea class="form-control set-margin-bottom" name="resourceo[]" rows="3"><?php echo isset($plan['resources']) ? $plan['resources'] : ''; ?></textarea></td>
                                        </tr>
                            <?php }}
                                else {?>
                                    <tr>
                                        <td colspan="5"><?php echo 'no lesson plan found' ?></td>
                                    </tr>
                                <?php } ?>
                            <tr class="toAdd">
                                <td><input type="text" class="form-control set-margin-bottom set-margin-top" name="week[]" placeholder="ex: 1,2,3"/></td>
                                <td><textarea class="form-control set-margin-bottom" name="topic[]" rows="3"></textarea></td>
                                <td><textarea class="form-control set-margin-bottom" name="outcome[]" rows="3"></textarea></td>
                                <td><textarea class="form-control set-margin-bottom" name="assessment[]" rows="3"></textarea></td>
                                <td><textarea class="form-control set-margin-bottom" name="resource[]" rows="3"></textarea></td>
                            </tr>
                            <tr class="toAdd">
                                <td><input type="text" class="form-control set-margin-bottom set-margin-top" name="week[]" placeholder="ex: 1,2,3"/></td>
                                <td><textarea class="form-control set-margin-bottom" name="topic[]" rows="3"></textarea></td>
                                <td><textarea class="form-control set-margin-bottom" name="outcome[]" rows="3"></textarea></td>
                                <td><textarea class="form-control set-margin-bottom" name="assessment[]" rows="3"></textarea></td>
                                <td><textarea class="form-control set-margin-bottom" name="resource[]" rows="3"></textarea></td>
                            </tr>
                            <tr class="toAdd">
                                <td><input type="text" class="form-control set-margin-bottom set-margin-top" name="week[]" placeholder="ex: 1,2,3"/></td>
                                <td><textarea class="form-control set-margin-bottom" name="topic[]" rows="3"></textarea></td>
                                <td><textarea class="form-control set-margin-bottom" name="outcome[]" rows="3"></textarea></td>
                                <td><textarea class="form-control set-margin-bottom" name="assessment[]" rows="3"></textarea></td>
                                <td><textarea class="form-control set-margin-bottom" name="resource[]" rows="3"></textarea></td>
                            </tr>
                            <tr class="toAdd">
                                <td><input type="text" class="form-control set-margin-bottom set-margin-top" name="week[]" placeholder="ex: 1,2,3"/></td>
                                <td><textarea class="form-control set-margin-bottom" name="topic[]" rows="3"></textarea></td>
                                <td><textarea class="form-control set-margin-bottom" name="outcome[]" rows="3"></textarea></td>
                                <td><textarea class="form-control set-margin-bottom" name="assessment[]" rows="3"></textarea></td>
                                <td><textarea class="form-control set-margin-bottom" name="resource[]" rows="3"></textarea></td>
                            </tr>
                            <tr class="toAdd">
                                <td><input type="text" class="form-control set-margin-bottom set-margin-top" name="week[]" placeholder="ex: 1,2,3"/></td>
                                <td><textarea class="form-control set-margin-bottom" name="topic[]" rows="3"></textarea></td>
                                <td><textarea class="form-control set-margin-bottom" name="outcome[]" rows="3"></textarea></td>
                                <td><textarea class="form-control set-margin-bottom" name="assessment[]" rows="3"></textarea></td>
                                <td><textarea class="form-control set-margin-bottom" name="resource[]" rows="3"></textarea></td>
                            </tr>
                            <tr class="toAdd">
                                <td><input type="text" class="form-control set-margin-bottom set-margin-top" name="week[]" placeholder="ex: 1,2,3"/></td>
                                <td><textarea class="form-control set-margin-bottom" name="topic[]" rows="3"></textarea></td>
                                <td><textarea class="form-control set-margin-bottom" name="outcome[]" rows="3"></textarea></td>
                                <td><textarea class="form-control set-margin-bottom" name="assessment[]" rows="3"></textarea></td>
                                <td><textarea class="form-control set-margin-bottom" name="resource[]" rows="3"></textarea></td>
                            </tr>
                            <tr class="toAdd">
                                <td><input type="text" class="form-control set-margin-bottom set-margin-top" name="week[]" placeholder="ex: 1,2,3"/></td>
                                <td><textarea class="form-control set-margin-bottom" name="topic[]" rows="3"></textarea></td>
                                <td><textarea class="form-control set-margin-bottom" name="outcome[]" rows="3"></textarea></td>
                                <td><textarea class="form-control set-margin-bottom" name="assessment[]" rows="3"></textarea></td>
                                <td><textarea class="form-control set-margin-bottom" name="resource[]" rows="3"></textarea></td>
                            </tr>
                            <tr class="toAdd">
                                <td><input type="text" class="form-control set-margin-bottom set-margin-top" name="week[]" placeholder="ex: 1,2,3"/></td>
                                <td><textarea class="form-control set-margin-bottom" name="topic[]" rows="3"></textarea></td>
                                <td><textarea class="form-control set-margin-bottom" name="outcome[]" rows="3"></textarea></td>
                                <td><textarea class="form-control set-margin-bottom" name="assessment[]" rows="3"></textarea></td>
                                <td><textarea class="form-control set-margin-bottom" name="resource[]" rows="3"></textarea></td>
                            </tr>
                            <tr class="toAdd">
                                <td><input type="text" class="form-control set-margin-bottom set-margin-top" name="week[]" placeholder="ex: 1,2,3"/></td>
                                <td><textarea class="form-control set-margin-bottom" name="topic[]" rows="3"></textarea></td>
                                <td><textarea class="form-control set-margin-bottom" name="outcome[]" rows="3"></textarea></td>
                                <td><textarea class="form-control set-margin-bottom" name="assessment[]" rows="3"></textarea></td>
                                <td><textarea class="form-control set-margin-bottom" name="resource[]" rows="3"></textarea></td>
                            </tr>
                            <tr class="toAdd">
                                <td><input type="text" class="form-control set-margin-bottom set-margin-top" name="week[]" placeholder="ex: 1,2,3"/></td>
                                <td><textarea class="form-control set-margin-bottom" name="topic[]" rows="3"></textarea></td>
                                <td><textarea class="form-control set-margin-bottom" name="outcome[]" rows="3"></textarea></td>
                                <td><textarea class="form-control set-margin-bottom" name="assessment[]" rows="3"></textarea></td>
                                <td><textarea class="form-control set-margin-bottom" name="resource[]" rows="3"></textarea></td>
                            </tr>
                            <tr class="toAdd">
                                <td><input type="text" class="form-control set-margin-bottom set-margin-top" name="week[]" placeholder="ex: 1,2,3"/></td>
                                <td><textarea class="form-control set-margin-bottom" name="topic[]" rows="3"></textarea></td>
                                <td><textarea class="form-control set-margin-bottom" name="outcome[]" rows="3"></textarea></td>
                                <td><textarea class="form-control set-margin-bottom" name="assessment[]" rows="3"></textarea></td>
                                <td><textarea class="form-control set-margin-bottom" name="resource[]" rows="3"></textarea></td>
                            </tr>
                            <tr class="toAdd">
                                <td><input type="text" class="form-control set-margin-bottom set-margin-top" name="week[]" placeholder="ex: 1,2,3"/></td>
                                <td><textarea class="form-control set-margin-bottom" name="topic[]" rows="3"></textarea></td>
                                <td><textarea class="form-control set-margin-bottom" name="outcome[]" rows="3"></textarea></td>
                                <td><textarea class="form-control set-margin-bottom" name="assessment[]" rows="3"></textarea></td>
                                <td><textarea class="form-control set-margin-bottom" name="resource[]" rows="3"></textarea></td>
                            </tr>
                            <tr class="toAdd">
                                <td><input type="text" class="form-control set-margin-bottom set-margin-top" name="week[]" placeholder="ex: 1,2,3"/></td>
                                <td><textarea class="form-control set-margin-bottom" name="topic[]" rows="3"></textarea></td>
                                <td><textarea class="form-control set-margin-bottom" name="outcome[]" rows="3"></textarea></td>
                                <td><textarea class="form-control set-margin-bottom" name="assessment[]" rows="3"></textarea></td>
                                <td><textarea class="form-control set-margin-bottom" name="resource[]" rows="3"></textarea></td>
                            </tr>
                            <tr class="toAdd">
                                <td><input type="text" class="form-control set-margin-bottom set-margin-top" name="week[]" placeholder="ex: 1,2,3"/></td>
                                <td><textarea class="form-control set-margin-bottom" name="topic[]" rows="3"></textarea></td>
                                <td><textarea class="form-control set-margin-bottom" name="outcome[]" rows="3"></textarea></td>
                                <td><textarea class="form-control set-margin-bottom" name="assessment[]" rows="3"></textarea></td>
                                <td><textarea class="form-control set-margin-bottom" name="resource[]" rows="3"></textarea></td>
                            </tr>
                            <tr class="toAdd">
                                <td><input type="text" class="form-control set-margin-bottom set-margin-top" name="week[]" placeholder="ex: 1,2,3"/></td>
                                <td><textarea class="form-control set-margin-bottom" name="topic[]" rows="3"></textarea></td>
                                <td><textarea class="form-control set-margin-bottom" name="outcome[]" rows="3"></textarea></td>
                                <td><textarea class="form-control set-margin-bottom" name="assessment[]" rows="3"></textarea></td>
                                <td><textarea class="form-control set-margin-bottom" name="resource[]" rows="3"></textarea></td>
                            </tr>
                            <tr class="toAdd">
                                <td><input type="text" class="form-control set-margin-bottom set-margin-top" name="week[]" placeholder="ex: 1,2,3"/></td>
                                <td><textarea class="form-control set-margin-bottom" name="topic[]" rows="3"></textarea></td>
                                <td><textarea class="form-control set-margin-bottom" name="outcome[]" rows="3"></textarea></td>
                                <td><textarea class="form-control set-margin-bottom" name="assessment[]" rows="3"></textarea></td>
                                <td><textarea class="form-control set-margin-bottom" name="resource[]" rows="3"></textarea></td>
                            </tr>
                            <tr class="toAdd">
                                <td><input type="text" class="form-control set-margin-bottom set-margin-top" name="week[]" placeholder="ex: 1,2,3"/></td>
                                <td><textarea class="form-control set-margin-bottom" name="topic[]" rows="3"></textarea></td>
                                <td><textarea class="form-control set-margin-bottom" name="outcome[]" rows="3"></textarea></td>
                                <td><textarea class="form-control set-margin-bottom" name="assessment[]" rows="3"></textarea></td>
                                <td><textarea class="form-control set-margin-bottom" name="resource[]" rows="3"></textarea></td>
                            </tr>
                            <tr class="toAdd">
                                <td><input type="text" class="form-control set-margin-bottom set-margin-top" name="week[]" placeholder="ex: 1,2,3"/></td>
                                <td><textarea class="form-control set-margin-bottom" name="topic[]" rows="3"></textarea></td>
                                <td><textarea class="form-control set-margin-bottom" name="outcome[]" rows="3"></textarea></td>
                                <td><textarea class="form-control set-margin-bottom" name="assessment[]" rows="3"></textarea></td>
                                <td><textarea class="form-control set-margin-bottom" name="resource[]" rows="3"></textarea></td>
                            </tr>
                            <tr class="toAdd">
                                <td><input type="text" class="form-control set-margin-bottom set-margin-top" name="week[]" placeholder="ex: 1,2,3"/></td>
                                <td><textarea class="form-control set-margin-bottom" name="topic[]" rows="3"></textarea></td>
                                <td><textarea class="form-control set-margin-bottom" name="outcome[]" rows="3"></textarea></td>
                                <td><textarea class="form-control set-margin-bottom" name="assessment[]" rows="3"></textarea></td>
                                <td><textarea class="form-control set-margin-bottom" name="resource[]" rows="3"></textarea></td>
                            </tr>
                            <tr class="toAdd">
                                <td><input type="text" class="form-control set-margin-bottom set-margin-top" name="week[]" placeholder="ex: 1,2,3"/></td>
                                <td><textarea class="form-control set-margin-bottom" name="topic[]" rows="3"></textarea></td>
                                <td><textarea class="form-control set-margin-bottom" name="outcome[]" rows="3"></textarea></td>
                                <td><textarea class="form-control set-margin-bottom" name="assessment[]" rows="3"></textarea></td>
                                <td><textarea class="form-control set-margin-bottom" name="resource[]" rows="3"></textarea></td>
                            </tr>
                            <a class="btn btn-success set-right addPlan"><i class="fa fa-plus m-right-xs"></i> Add Plan</a>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-success set-right"><i class="fa fa-save m-right-xs"></i> Save Changes</button>
        <?php echo form_close(); ?>
    </div>
</div>
<!-- /page content -->