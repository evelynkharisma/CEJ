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
                            <tr>
                                <td align="center">1</td>
                                <td><input type="text" class="form-control set-margin-bottom set-margin-top" name="lesson1chapter" value="<?php echo set_value('lesson1chapter', isset($info_db['lesson1chapter']) ? $info_db['lesson1chapter'] : 'ex: 1,2,3-4'); ?>"/></td>
                                <td><textarea class="form-control set-margin-bottom" name="lesson1objective" rows="3"><?php echo isset($info_db['lesson1objective']) ? $info_db['lesson1objective'] : ''; ?></textarea></td>
                                <td><textarea class="form-control set-margin-bottom" name="lesson1activities" rows="3"><?php echo isset($info_db['lesson1activities']) ? $info_db['lesson1activities'] : ''; ?></textarea></td>
                                <td><textarea class="form-control set-margin-bottom" name="lesson1material" rows="3"><?php echo isset($info_db['lesson1material']) ? $info_db['lesson1material'] : ''; ?></textarea></td>
                            </tr>
                            <tr>
                                <td align="center">2</td>
                                <td><input type="text" class="form-control set-margin-bottom set-margin-top" name="lesson2chapter" value="<?php echo set_value('lesson2chapter', isset($info_db['lesson2chapter']) ? $info_db['lesson2chapter'] : ''); ?>"/></td>
                                <td><textarea class="form-control set-margin-bottom" name="lesson2objective" rows="3"><?php echo isset($info_db['lesson2objective']) ? $info_db['lesson2objective'] : ''; ?></textarea></td>
                                <td><textarea class="form-control set-margin-bottom" name="lesson2activities" rows="3"><?php echo isset($info_db['lesson2activities']) ? $info_db['lesson2activities'] : ''; ?></textarea></td>
                                <td><textarea class="form-control set-margin-bottom" name="lesson2material" rows="3"><?php echo isset($info_db['lesson2material']) ? $info_db['lesson2material'] : ''; ?></textarea></td>
                            </tr>
                            <tr>
                                <td align="center">3</td>
                                <td><input type="text" class="form-control set-margin-bottom set-margin-top" name="lesson3chapter" value="<?php echo set_value('lesson3chapter', isset($info_db['lesson3chapter']) ? $info_db['lesson3chapter'] : ''); ?>"/></td>
                                <td><textarea class="form-control set-margin-bottom" name="lesson3objective" rows="3"><?php echo isset($info_db['lesson3objective']) ? $info_db['lesson3objective'] : ''; ?></textarea></td>
                                <td><textarea class="form-control set-margin-bottom" name="lesson3activities" rows="3"><?php echo isset($info_db['lesson3activities']) ? $info_db['lesson3activities'] : ''; ?></textarea></td>
                                <td><textarea class="form-control set-margin-bottom" name="lesson3material" rows="3"><?php echo isset($info_db['lesson3material']) ? $info_db['lesson3material'] : ''; ?></textarea></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-success set-right"><i class="fa fa-save m-right-xs"></i> Add Course</button>
        <?php echo form_close(); ?>
    </div>
</div>
<!-- /page content -->