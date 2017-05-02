<?php if(isset($info_db['assignid']) && $info_db['assignid'] != null){ ?>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_content">
                <?php
                    $encrypted = $this->general->encryptParaID($info_db['assignid'],'courseassigned');
                ?>
                <a href="<?php echo base_url() ?>index.php/teacher/courseSemester/<?php echo $encrypted ?>" class="btn btn-success">Semester Plan</a>
                <a href="<?php echo base_url() ?>index.php/teacher/courseView/s<?php echo $encrypted ?>" class="btn btn-success">Lesson Plan</a>
                <a href="<?php echo base_url() ?>index.php/teacher/courseImplementation/<?php echo $encrypted ?>" class="btn btn-success">Lesson Implementation</a>
                <a href="<?php echo base_url() ?>index.php/teacher/courseMaterial/<?php echo $encrypted ?>" class="btn btn-success">Shared Materials</a>
                <a href="<?php echo base_url() ?>index.php/teacher/courseAssignmentQuiz/<?php echo $encrypted ?>" class="btn btn-success">Assignments and Quizzes</a>
                <a href="<?php echo base_url() ?>index.php/teacher/courseStudent/<?php echo $encrypted ?>" class="btn btn-success">Students</a>
            </div>
        </div>
    </div>
</div>
<?php } ?>