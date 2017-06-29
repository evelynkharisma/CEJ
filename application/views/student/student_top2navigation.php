<?php if(isset($course['assignid']) && $course['assignid'] != null){ ?>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_content">
                <?php
                $encrypted = $this->general->encryptParaID($course['courseid'],'course');
                $encrypted_assignid = $this->general->encryptParaID($course['assignid'],'courseassigned');
                ?>
                <a href="<?php echo base_url() ?>index.php/student/courseView/<?php echo $encrypted ?>" class="btn btn-success">Lesson Plan</a>
                <a href="<?php echo base_url() ?>index.php/student/courseImplementation/<?php echo $encrypted ?>" class="btn btn-success">Lesson Implementation</a>
                <a href="<?php echo base_url() ?>index.php/student/courseMaterial/<?php echo $encrypted ?>" class="btn btn-success">Shared Materials</a>
                <a href="<?php echo base_url() ?>index.php/student/courseAssignmentQuiz/<?php echo $encrypted ?>" class="btn btn-success">Assignments and Quizzes</a>
                <a href="<?php echo base_url() ?>index.php/student/courseStudent/<?php echo $encrypted ?>" class="btn btn-success">Students</a>
                <a href="<?php echo base_url() ?>index.php/student/coursePerformance/<?php echo $encrypted_assignid ?>" class="btn btn-success">My Performance</a>
            </div>
        </div>
    </div>
</div>
<?php } ?>