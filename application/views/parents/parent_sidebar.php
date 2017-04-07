<div class="navbar nav_title" style="border: 0;">
    <a href="<?php echo base_url() ?>index.php/parents/home" class="site_title"><i class="fa fa-scribd"></i> <span>SMS</span></a>
</div>

<div class="clearfix"></div>

<!-- menu profile quick info -->
<div class="profile clearfix">
    <div class="profile_pic">
        <img src="<?php echo base_url() ?>assets/img/parents/chels.jpg" alt="..." class="img-circle profile_img">
    </div>
    <div class="profile_info">
        <span>Welcome,</span>
        <h2>Chelsy Lim</h2>
    </div>
</div>
<!-- /menu profile quick info -->

<br />


<!-- sidebar menu -->
<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
    <div class="menu_section">
        <ul class="nav side-menu">
            <li class="parent_sidebar_child"><a><i class="fa fa-child"></i> Child 1 <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="#">Child 1</a></li>
                    <li><a href="#">Child 2</a></li>
                </ul>
            </li>
            <li><a href="<?php echo base_url() ?>index.php/parents/parent_attendance"><i class="fa fa-check"></i> Attendance </a></li>
<!--            <li><a href="--><?php //echo base_url() ?><!--index.php/parents/child_attendance"><i class="fa fa-dashboard"></i> Performance </a></li>-->
            <li><a><i class="fa fa-file-text-o"></i> Report Card <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="<?php echo base_url() ?>index.php/parents/parent_reportcard_midterm">Mid Term Report</a></li>
                    <li><a href="<?php echo base_url() ?>index.php/parents/parent_reportcard_finalterm">Final Term Report</a></li>
                </ul>
            </li>
            <li><a><i class="fa fa-book"></i> Course <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="<?php echo base_url() ?>index.php/parents/parent_course">Mathematic</a></li>
                    <li><a href="<?php echo base_url() ?>index.php/parents/parent_course">English</a></li>
                    <li><a href="<?php echo base_url() ?>index.php/parents/parent_course">Science</a></li>
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
            <li><a href="<?php echo base_url() ?>index.php/parents/parent_download"><i class="fa fa-download"></i> Download</a></li>
            <li><a href="<?php echo base_url() ?>index.php/parents/parent_correspond"><i class="fa fa-envelope"></i> Correspond</a></li>


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