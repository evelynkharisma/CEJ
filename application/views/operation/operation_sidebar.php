<div class="navbar nav_title" style="border: 0;">
    <a href="<?php echo base_url() ?>index.php/operation/home" class="site_title"><i class="fa fa-scribd"></i> <span>SMS</span></a>
</div>

<div class="clearfix"></div>

<!-- menu profile quick info -->
<div class="profile clearfix">
    <div class="profile_pic">
        <img src="<?php echo base_url() ?>assets/img/teacher/eve.jpg" alt="..." class="img-circle profile_img">
    </div>
    <div class="profile_info">
        <span>Welcome,</span>
        <h2>Evelyn Kharisma</h2>
    </div>
</div>
<!-- /menu profile quick info -->

<br />


<!-- sidebar menu -->
<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
    <div class="menu_section">
        <ul class="nav side-menu">
            <li><a><i class="fa fa-home"></i> Homeroom <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="<?php echo base_url() ?>index.php/teacher/homeroom_attendance">Attendance</a></li>
                    <li><a>Report<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="<?php echo base_url() ?>index.php/teacher/homeroomStudent">Mid Term Report</a>
                            </li>
                            <li><a href="<?php echo base_url() ?>index.php/teacher/homeroomStudent">Final Term Report</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li><a><i class="fa fa-edit"></i> Courses <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="<?php echo base_url() ?>index.php/teacher/addCourse">Add Course</a>
                    <li><a href="#level1_1">Grade 10</a>
                    <li><a>Grade 11<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="<?php echo base_url() ?>index.php/teacher/courseView">Course 1</a>
                            </li>
                        </ul>
                    </li>
                    <li><a href="#level1_2">Grade 12</a>
                    </li>
                </ul>
            </li>
            <li><a><i class="fa fa-table"></i> Schedule <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="<?php echo base_url() ?>index.php/teacher/classScheduleView">Class Schedule</a></li>
                    <li><a href="<?php echo base_url() ?>index.php/teacher/examScheduleView">Exam Schedule</a></li>
                </ul>
            </li>
            <li><a><i class="fa fa-address-book-o"></i> Directories <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="<?php echo base_url() ?>index.php/teacher/addTeacher">Add Teacher</a></li>
                    <li><a href="<?php echo base_url() ?>index.php/teacher/studentView">Students</a></li>
                    <li><a href="<?php echo base_url() ?>index.php/teacher/parentView">Parents</a></li>
                    <li><a>Staffs<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="<?php echo base_url() ?>index.php/teacher/teacherView">Teachers</a>
                            </li>
                            <li><a href="<?php echo base_url() ?>index.php/teacher/operationView">Operations</a>
                            </li>
                            <li><a href="<?php echo base_url() ?>index.php/teacher/AdministratorView">Administrators</a>
                            </li>
                        </ul>
                    </li>
                    <li><a href="<?php echo base_url() ?>index.php/teacher/libraryView">Libraries</a></li>
                </ul>
            </li>
            <li><a href="<?php echo base_url() ?>index.php/teacher/payment"><i class="fa fa-usd"></i>Payments</span></a></li>
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