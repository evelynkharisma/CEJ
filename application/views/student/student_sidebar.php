<div class="navbar nav_title" style="border: 0;">
    <a href="<?php echo base_url() ?>index.php/student/home" class="site_title"><i class="fa fa-scribd"></i> <span>SMS</span></a>
</div>

<div class="clearfix"></div>

<!-- menu profile quick info -->
<div class="profile clearfix">
    <div class="profile_pic">
        <div class="teacher_sidebar_crop">
            <img src="<?php echo base_url() ?>assets/img/student/<?php echo $student['photo']?>" alt="..."  class="img-circle teacher_sidebar_photo">
        </div>
    </div>
    <div class="profile_info">
        <span>Welcome,</span>
        <h2><?php echo ucfirst($student['firstname']).' '.ucfirst($student['lastname'])?></h2>
    </div>
</div>
<!-- /menu profile quick info -->

<br />


<!-- sidebar menu -->
<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
    <div class="menu_section">
        <ul class="nav side-menu">
            <li><a><i class="fa fa-home"></i> Learning <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="<?php echo base_url() ?>index.php/student/learning_attendance">Attendance</a></li>
                    <li><a>Report<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <?php
                            if($grades) {
                            foreach ($grades as $grade) {
                                $grade_only = $token = strtok($grade['classroom'], "-");
                                ?>
                                <li><a href="<?php echo base_url() ?>index.php/student/learningReport/1/<?php echo $grade_only?>">Grade <?php echo $grade_only; ?></a>
                            <?php
                            }
                            }?>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li><a><i class="fa fa-edit"></i> Courses <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <?php
                    if($grades) {
                    foreach($grades as $grade) {
                        $grade_only = $token = strtok($grade['classroom'], "-");
                    ?>
                        <li><a href="#level1_1">Grade <?php echo $grade_only;
                                if ($studentGradeCourses) {
                            ?>
                                    <span class="fa fa-chevron-down"></span>
                              <?php
                                }?></a>
                            <?php
                            if($studentGradeCourses) {?>
                                <ul class="nav child_menu">
                                <?php
                                foreach ($studentGradeCourses as $studentGradeCourse) {
                                    if($studentGradeCourse['classroom']==$grade['classroom']) {
                                        $course_encrypted = $this->general->encryptParaID($studentGradeCourse['courseid'],'course');
                                        ?>
                                    <li><a href="<?php echo base_url() ?>index.php/student/courseView/<?php echo $course_encrypted?>"><?php echo $studentGradeCourse['classroom'].' '.$studentGradeCourse['coursename']?></a></li>
                                <?php
                                    }
                                }?>
                                </ul>
                                <?php
                            }
                            ?>

                    <?php
                    }}
                    ?>
                    </li>
                </ul>
            </li>
            <li><a><i class="fa fa-table"></i> Schedule <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="<?php echo base_url() ?>index.php/student/classScheduleView">Class Schedule</a></li>
                    <li><a href="<?php echo base_url() ?>index.php/student/examScheduleView">Exam Schedule</a></li>
                </ul>
            </li>
            <li><a href="<?php echo base_url() ?>index.php/student/events"><i class="fa fa-bell"></i> Events <span class="badge bg-green"><?php echo $eventnotif ?></span> </a>
            </li>
            <li><a href="<?php echo base_url() ?>index.php/student/forms"><i class="fa fa-download"></i>Download</span></a></li>
            <li><a href="<?php echo base_url()?>index.php/library/home" target="_blank"><i class="fa fa-book"></i> Library <span class="fa"></span></a>
            </li>
        </ul>
    </div>

</div>
<!-- /sidebar menu -->

<!-- /menu footer buttons -->
<div class="sidebar-footer hidden-small">
    <a data-toggle="tooltip" data-placement="top" title="Settings">
        <span class=" fa fa-cog" aria-hidden="true"></span>
    </a>
    <a data-toggle="tooltip" data-placement="top" title="Settings">
        <span class=" fa fa-cog" aria-hidden="true"></span>
    </a>
    <a data-toggle="tooltip" data-placement="top" title="Settings">
        <span class=" fa fa-cog" aria-hidden="true"></span>
    </a>
    <a data-toggle="tooltip" data-placement="top" title="Logout">
        <span class=" fa fa-power-off" aria-hidden="true"></span>
    </a>
</div>
<!-- /menu footer buttons -->