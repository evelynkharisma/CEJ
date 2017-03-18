<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <?php echo form_open_multipart('teacher/editCourse/'.$info_db['courseid']); ?>
            <div class="title_left">
                <input type="hidden" class="form-control set-margin-bottom" name="courseid" value="<?php echo $info_db['courseid']; ?>"/>
                <h3>Course Name: <input type="text" class="form-control set-margin-bottom set-margin-top" name="coursename" value="<?php echo set_value('coursename', isset($info_db['coursename']) ? $info_db['coursename'] : ''); ?>"/></h3>
            </div>


        </div>

        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Course Overview</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <textarea class="form-control set-margin-bottom" name="coursedescription" rows="3"><?php echo isset($info_db['coursedescription']) ? $info_db['coursedescription'] : 'Course Description'; ?></textarea>
                        <br><br>
                        Resources:
                        <textarea class="form-control set-margin-bottom set-margin-top" name="courseresources" rows="3"><?php echo isset($info_db['courseresources']) ? $info_db['courseresources'] : 'Course Resources (Separate resource using | )'; ?></textarea>
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
                                            <input type="hidden" class="form-control set-margin-bottom" name="lessonid[]" value="<?php echo $plan['lessonid']; ?>"/>
                                            <td align="center"><?php echo $plan['lessoncount'] ?></td>
                                            <td><input type="text" class="form-control set-margin-bottom set-margin-top" name="chapter[]" value="<?php echo set_value('chapter', isset($plan['chapter']) ? $plan['chapter'] : 'ex: 1,2,3-4'); ?>"/></td>
                                            <td><textarea class="form-control set-margin-bottom" name="objective[]" rows="3"><?php echo isset($plan['objective']) ? $plan['objective'] : ''; ?></textarea></td>
                                            <td><textarea class="form-control set-margin-bottom" name="activities[]" rows="3"><?php echo isset($plan['activities']) ? $plan['activities'] : ''; ?></textarea></td>
                                            <td><textarea class="form-control set-margin-bottom" name="material[]" rows="3"><?php echo isset($plan['material']) ? $plan['material'] : ''; ?></textarea></td>
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
        <button type="submit" class="btn btn-success set-right"><i class="fa fa-save m-right-xs"></i> Save Changes</button>
        <?php echo form_close(); ?>
    </div>
</div>
<!-- /page content -->