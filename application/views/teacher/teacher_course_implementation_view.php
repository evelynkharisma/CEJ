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
                        <a href="<?php echo base_url() ?>index.php/teacher/coursePlan" class="btn btn-success">Lesson Plan</a>
                        <a href="<?php echo base_url() ?>index.php/teacher/courseImplementation" class="btn btn-success">Lesson Implementation</a>
                        <a href="<?php echo base_url() ?>index.php/teacher/courseMaterial" class="btn btn-success">Shared Materials</a>
                        <a href="<?php echo base_url() ?>index.php/teacher/courseAssignmentQuiz" class="btn btn-success">Assignments and Quizzes</a>
                        <a href="<?php echo base_url() ?>index.php/teacher/courseStudent" class="btn btn-success">Students</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Lesson Implementation</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <table class="teacher_course_implementation">
                            <thead>
                                <tr>
                                    <th width="10%" style="text-align: center">Session</th>
                                    <th width="40%">Lesson Plan</th>
                                    <th width="50%">Lesson Implementation</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td align="center">1</td>
                                    <td>Session 1 Topic</td>
                                    <td>Session 1 Lesson Implementation</td>
                                </tr>
                                <tr>
                                    <td align="center">2</td>
                                    <td>Session 2 Topic</td>
                                    <td>Session 2 Lesson Implementation</td>
                                </tr>
                                <tr>
                                    <td align="center">3</td>
                                    <td>Session 3 Topic</td>
                                    <td>
                                        <?php echo form_open('teacher/courseImplementationEdit'); ?>
                                            <textarea style="resize: none" class="form-control set-margin-bottom" rows="3" placeholder='Lesson Implementation'></textarea>
                                            <button type="submit" class="btn btn-success set-right">Save changes</button>
                                        <?php echo form_close(); ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center">4</td>
                                    <td>Session 4 Topic</td>
                                    <td>
                                        <?php echo form_open('teacher/courseImplementationEdit'); ?>
                                        <textarea style="resize: none" class="form-control set-margin-bottom" rows="3" placeholder='Lesson Implementation'></textarea>
                                        <button type="submit" class="btn btn-success set-right">Save changes</button>
                                        <?php echo form_close(); ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center">5</td>
                                    <td>Session 5 Topic</td>
                                    <td>
                                        <?php echo form_open('teacher/courseImplementationEdit'); ?>
                                        <textarea style="resize: none" class="form-control set-margin-bottom" rows="3" placeholder='Lesson Implementation'></textarea>
                                        <button type="submit" class="btn btn-success set-right">Save changes</button>
                                        <?php echo form_close(); ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->