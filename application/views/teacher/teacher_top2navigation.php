<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_content">
                <a href="<?php echo base_url() ?>index.php/teacher/courseView/<?php echo $info_db['assignid'] ?>" class="btn btn-success">Lesson Plan</a>
                <a href="<?php echo base_url() ?>index.php/teacher/courseImplementation/<?php echo $info_db['assignid'] ?>" class="btn btn-success">Lesson Implementation</a>
                <a href="<?php echo base_url() ?>index.php/teacher/courseMaterial/<?php echo $info_db['assignid'] ?>" class="btn btn-success">Shared Materials</a>
                <a href="<?php echo base_url() ?>index.php/teacher/courseAssignmentQuiz/<?php echo $info_db['assignid'] ?>" class="btn btn-success">Assignments and Quizzes</a>
                <a href="<?php echo base_url() ?>index.php/teacher/courseStudent/<?php echo $info_db['assignid'] ?>" class="btn btn-success">Students</a>
            </div>
        </div>
    </div>
</div>