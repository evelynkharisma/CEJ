<div class="navbar nav_title" style="border: 0;">
    <a href="<?php echo base_url() ?>index.php/parents/home" class="site_title"><i class="fa fa-scribd"></i> <span>SMS</span></a>
</div>

<div class="clearfix"></div>

<?php
$result = 0;
if($inbox){
    foreach($inbox as $inbox) {
        if($inbox['status'] == 0){
            $result += 1;
        }
    }
}
?>

<!-- menu profile quick info -->
<div class="profile clearfix">
    <div class="profile_pic">
        <img src="<?php echo base_url() ?>assets/img/parents/profile/<?php echo $this->nativesession->get('photo') ?>" alt="..." class="img-circle profile_img">
    </div>
    <div class="profile_info">
        <span>Welcome,</span>
        <h2><?php echo $this->nativesession->get('name') ?></h2>
    </div>
</div>
<!-- /menu profile quick info -->

<br />


<!-- sidebar menu -->
<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
    <div class="menu_section">
        <ul class="nav side-menu">
            <li class="parent_sidebar_child"><a><i class="fa fa-child"></i> <?php $current_child = $this->nativesession->get('current_child_name'); if($current_child!=''){echo $current_child;} else{ echo "No Child";} ?> <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <?php
                    $childs = $this->Parent_model->getAllChildren($this->nativesession->get('id'));
                    foreach($childs as $child){
                        $encrypted = $this->general->encryptParaID($child['studentid'],'student');?>
                        <li><a href="<?php echo base_url() ?>index.php/parents/choose_child/<?php echo $encrypted?>"><?php echo $child['firstname']?> <?php echo $child['lastname']?></a></li>
                    <?php }
                    ?>
                </ul>
            </li>
            <li><a href="<?php echo base_url() ?>index.php/parents/parent_attendance"><i class="fa fa-check"></i> Attendance </a></li>
<!--            <li><a href="--><?php //echo base_url() ?><!--index.php/parents/child_attendance"><i class="fa fa-dashboard"></i> Performance </a></li>-->
            <li><a><i class="fa fa-file-text-o"></i> Report Card <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <?php
                    if($grades) {
                    foreach ($grades as $grade) {
                    $grade_only = $token = strtok($grade['classroom'], "-");
                    ?>
                    <li><a href="<?php echo base_url() ?>index.php/parents/learningReport/1/<?php echo $grade_only?>">Grade <?php echo $grade_only; ?></a>
                        <?php
                        }
                        }?>
                    </li>
                </ul>
            </li>
            <li><a><i class="fa fa-book"></i> Course <span class="fa fa-chevron-down"></span></a>
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
                                        <li><a href="<?php echo base_url() ?>index.php/parents/courseView/<?php echo $course_encrypted?>"><?php echo $studentGradeCourse['classroom'].' '.$studentGradeCourse['coursename']?></a></li>
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
            <li><a><i class="fa fa-calendar"></i> Schedule <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="<?php echo base_url() ?>index.php/parents/classScheduleView">Class Schedule</a></li>
                    <li><a href="<?php echo base_url() ?>index.php/parents/examScheduleView">Exam Schedule</a></li>
                </ul>
            </li>
            <li><a><i class="fa fa-usd"></i> Payment <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="<?php echo base_url() ?>index.php/parents/payment_status">Payment Status</a></li>
                    <li><a href="<?php echo base_url() ?>index.php/parents/payment_receipt">Payment Receipt</a></li>
                </ul>
            </li>
<!--            <li><a href="--><?php //echo base_url() ?><!--index.php/parents/eventList"><i class="fa fa-bell"></i> Events</a></li>-->
            <li><a href="<?php echo base_url() ?>index.php/parents/forms"><i class="fa fa-download"></i> Download</a></li>
            <li><a href="<?php echo base_url() ?>index.php/parents/parent_correspond"><i class="fa fa-envelope"></i> Correspond  <?php if($result!=''){?><span class="badge bg-green"><?php echo $result ;}?></span></a></li>


<!--            <li>-->
<!--                <ul class="nav child_menu">-->
<!--                    <li><a href="--><?php //echo base_url() ?><!--index.php/parents/child_attendance">Attendance</a></li>-->
<!--                    <li><a href="--><?php //echo base_url() ?><!--index.php/parents/child_attendance">Performance</a></li>-->
<!--                    <li><a>Report Card<span class="fa fa-chevron-down"></span></a>-->
<!--                        <ul class="nav child_menu">-->
<!--                            <li><a href="--><?php //echo base_url() ?><!--index.php/parents/child_attendance">Mid Term Report</a></li>-->
<!--                            <li><a href="--><?php //echo base_url() ?><!--index.php/parents/child_attendance">Final Term Report</a></li>-->
<!--                        </ul>-->
<!--                    </li>-->
<!--                    <li><a>Course<span class="fa fa-chevron-down"></span></a>-->
<!--                        <ul class="nav child_menu">-->
<!--                            <li><a href="--><?php //echo base_url() ?><!--index.php/parents/child_attendance">Homework</a></li>-->
<!--                            <li><a href="--><?php //echo base_url() ?><!--index.php/parents/child_attendance">Quiz</a></li>-->
<!--                            <li><a href="--><?php //echo base_url() ?><!--index.php/parents/child_attendance">Project</a></li>-->
<!--                        </ul>-->
<!--                    </li>-->
<!--                    <li><a>Grade<span class="fa fa-chevron-down"></span></a>-->
<!--                        <ul class="nav child_menu">-->
<!--                            <li><a>Mid Term<span class="fa fa-chevron-down"></span></a>-->
<!--                                <ul class="nav child_menu">-->
<!--                                    <li><a href="--><?php //echo base_url() ?><!--index.php/parents/child_attendance">Grade</a></li>-->
<!--                                    <li><a href="--><?php //echo base_url() ?><!--index.php/parents/child_attendance">Teacher's Feedback</a></li>-->
<!--                                </ul>-->
<!--                            <li><a>Final Term<span class="fa fa-chevron-down"></span></a>-->
<!--                                <ul class="nav child_menu">-->
<!--                                    <li><a href="--><?php //echo base_url() ?><!--index.php/parents/child_attendance">Grade</a></li>-->
<!--                                    <li><a href="--><?php //echo base_url() ?><!--index.php/parents/child_attendance">Teacher's Feedback</a></li>-->
<!--                                </ul>-->
<!--                            </li>-->
<!--                        </ul>-->
<!--                    </li>-->
<!--                </ul>-->
<!--            </li>-->
<!--            <li><a><i class="fa fa-child"></i> Child 2 <span class="fa fa-chevron-down"></span></a>-->
<!--                <ul class="nav child_menu">-->
<!--                    <li><a href="--><?php //echo base_url() ?><!--index.php/parents/child_attendance">Attendance</a></li>-->
<!--                    <li><a href="--><?php //echo base_url() ?><!--index.php/parents/child_attendance">Performance</a></li>-->
<!--                    <li><a>Task<span class="fa fa-chevron-down"></span></a>-->
<!--                        <ul class="nav child_menu">-->
<!--                            <li><a href="--><?php //echo base_url() ?><!--index.php/parents/child_attendance">Homework</a></li>-->
<!--                            <li><a href="--><?php //echo base_url() ?><!--index.php/parents/child_attendance">Quiz</a></li>-->
<!--                            <li><a href="--><?php //echo base_url() ?><!--index.php/parents/child_attendance">Project</a></li>-->
<!--                        </ul>-->
<!--                    </li>-->
<!--                    <li><a>Report Card<span class="fa fa-chevron-down"></span></a>-->
<!--                        <ul class="nav child_menu">-->
<!--                            <li><a href="--><?php //echo base_url() ?><!--index.php/parents/child_attendance">Mid Term Report</a></li>-->
<!--                            <li><a href="--><?php //echo base_url() ?><!--index.php/parents/child_attendance">Final Term Report</a></li>-->
<!--                        </ul>-->
<!--                    </li>-->
<!--                    <li><a>Grade<span class="fa fa-chevron-down"></span></a>-->
<!--                        <ul class="nav child_menu">-->
<!--                            <li><a>Mid Term<span class="fa fa-chevron-down"></span></a>-->
<!--                                <ul class="nav child_menu">-->
<!--                                    <li><a href="--><?php //echo base_url() ?><!--index.php/parents/child_attendance">Grade</a></li>-->
<!--                                    <li><a href="--><?php //echo base_url() ?><!--index.php/parents/child_attendance">Teacher's Feedback</a></li>-->
<!--                                </ul>-->
<!--                            <li><a>Final Term<span class="fa fa-chevron-down"></span></a>-->
<!--                                <ul class="nav child_menu">-->
<!--                                    <li><a href="--><?php //echo base_url() ?><!--index.php/parents/child_attendance">Grade</a></li>-->
<!--                                    <li><a href="--><?php //echo base_url() ?><!--index.php/parents/child_attendance">Teacher's Feedback</a></li>-->
<!--                                </ul>-->
<!--                            </li>-->
<!--                        </ul>-->
<!--                    </li>-->
<!--                </ul>-->
<!--            </li>-->
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