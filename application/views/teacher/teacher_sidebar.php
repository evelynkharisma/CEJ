<div class="navbar nav_title" style="border: 0;">
    <a href="<?php echo base_url() ?>index.php/teacher/home" class="site_title"><i class="fa fa-scribd"></i> <span>SMS</span></a>
</div>

<div class="clearfix"></div>

<!-- menu profile quick info -->
<div class="profile clearfix">
    <div class="profile_pic">
        <div class="teacher_sidebar_crop">
            <img src="<?php echo base_url() ?>assets/img/teacher/profile/<?php echo $this->session->userdata('photo') ?>" alt="..." class="img-circle teacher_sidebar_photo">
        </div>
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
                    <li><a href="<?php echo base_url() ?>index.php/teacher/homeroomStudent">Students</a></li>
                </ul>
            </li>
            <li><a><i class="fa fa-edit"></i> Courses <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="<?php echo base_url() ?>index.php/teacher/addCourse">Add Course</a>
                    <li>
                        <?php
                            foreach ($courses as $course){
                                $grade = explode('-', $course['classroom']);
                                $grade = $grade[0];
                                switch ($grade){
                                    case 1:
                                        $grade1[] = $course;
                                        break;

                                    case 2:
                                        $grade2[] = $course;
                                        break;

                                    case 3:
                                        $grade3[] = $course;
                                        break;

                                    case 4:
                                        $grade4[] = $course;
                                        break;

                                    case 5:
                                        $grade5[] = $course;
                                        break;

                                    case 6:
                                        $grade61[] = $course;
                                        break;

                                    case 7:
                                        $grade7[] = $course;
                                        break;

                                    case 8:
                                        $grade8[] = $course;
                                        break;

                                    case 9:
                                        $grade9[] = $course;
                                        break;

                                    case 10:
                                        $grade10[] = $course;
                                        break;

                                    case 11:
                                        $grade11[] = $course;
                                        break;

                                    case 12:
                                        $grade12[] = $course;
                                        break;

                                    case 13:
                                        $grade13[] = $course;
                                        break;
                                }
                            }
                        ?>
                        <?php
                            for($i=1; $i<14; $i++){
                                if (isset(${'grade'.$i}) && ${'grade'.$i} != null): ?>
                                <a>Grade <?php echo $i; ?><span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <?php foreach (${'grade'.$i} as $row){?>
                                        <li>
                                            <a href="<?php echo base_url() ?>index.php/teacher/courseView/<?php echo $row['assignid'] ?>"><?php echo $row['classroom'] ?> <?php echo $row['coursename'] ?></a>
                                        </li>
                                    <?php } ?>
                                </ul>
                                <?php endif; ?>
                        <?php  } ?>
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
                    <li><a href="<?php echo base_url() ?>index.php/teacher/teacherView">Teachers</a></li>
                    <li><a href="<?php echo base_url() ?>index.php/teacher/studentView">Students</a></li>
                    <li><a href="<?php echo base_url() ?>index.php/teacher/parentView">Parents</a></li>
                    <li><a href="<?php echo base_url() ?>index.php/teacher/staffView">Staff</a></li>
                    <li><a href="<?php echo base_url() ?>index.php/teacher/libraryView">Libraries</a></li>
                </ul>
            </li>
            <li><a href="<?php echo base_url() ?>index.php/teacher/payment"><i class="fa fa-usd"></i>Payments</span></a></li>
            <li><a><i class="fa fa-bell"></i> Events <span class="badge bg-green"><?php echo $eventnotif ?></span> <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="<?php echo base_url() ?>index.php/teacher/addEvent">Add Event</a></li>
                    <li><a href="<?php echo base_url() ?>index.php/teacher/eventList">Events List</a></li>
                </ul>
            </li>
            <li><a href="<?php echo base_url() ?>index.php/teacher/forms"><i class="fa fa-sticky-note-o"></i>Forms</span></a></li>
            <li><a href="<?php echo base_url() ?>index.php/teacher/settings"><i class="fa fa-gear"></i>Settings</span></a></li>
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