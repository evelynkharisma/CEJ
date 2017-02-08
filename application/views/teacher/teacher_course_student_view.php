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
                        <h2>Students</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <table class="teacher_course_implementation">
                            <thead>
                            <tr>
                                <th width="30%">Photo</th>
                                <th width="40%">Name</th>
                                <th width="30%">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>
                                    <div class="teacher_photo_crop">
                                        <img src="<?php echo base_url() ?>assets/img/teacher/eve.jpg" alt="..." class="teacher_photo_img">
                                    </div>
                                </td>
                                <td>Evelyn Kharisma</td>
                                <td>
                                    <a href="<?php echo base_url() ?>index.php/teacher/courseStudentPerformance" class="btn btn-success"><i class="fa fa-edit"></i> Performance Detail</a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="teacher_photo_crop">
                                        <img src="<?php echo base_url() ?>assets/img/teacher/eve.jpg" alt="..." class="teacher_photo_img">
                                    </div>
                                </td>
                                <td>Evelyn Kharisma</td>
                                <td>
                                    <a href="<?php echo base_url() ?>index.php/teacher/courseStudentPerformance" class="btn btn-success"><i class="fa fa-edit"></i> Performance Detail</a>
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