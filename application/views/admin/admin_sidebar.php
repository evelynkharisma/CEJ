<div class="navbar nav_title" style="border: 0;">
    <a href="<?php echo base_url() ?>index.php/admin/home" class="site_title"><i class="fa fa-scribd"></i> <span>SMS</span></a>
</div>

<div class="clearfix"></div>

<!-- menu profile quick info -->
<div class="profile clearfix">
    <div class="profile_pic">
        <img src="<?php echo base_url() ?>assets/img/admin/<?php echo $admin['photo']?>" alt="..." class="img-circle profile_img">
    </div>
    <div class="profile_info">
        <span>Welcome,</span>
        <h2><?php echo ucfirst($admin['firstname']).' '.ucfirst($admin['lastname'])?></h2>
    </div>
</div>
<!-- /menu profile quick info -->

<br />


<!-- sidebar menu -->
<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
    <div class="menu_section">
        <ul class="nav side-menu">
            <li><a><i class="fa fa-address-book-o"></i> Directories <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <?php
                    $privilege = $this->general->checkPrivilege($this->nativesession->get('role'), 'p0015');
                    if($privilege == 1){
                        ?>
                        <li><a href="<?php echo base_url() ?>index.php/admin/addParent">Add Parent</a></li>
                    <?php }

                    $privilege = $this->general->checkPrivilege($this->nativesession->get('role'), 'p0028');
                    if($privilege == 1){
                        ?>
                        <li><a href="<?php echo base_url() ?>index.php/admin/addStaff ">Add Staff</a></li>
                    <?php }

                    $privilege = $this->general->checkPrivilege($this->nativesession->get('role'), 'p0002');
                    if($privilege == 1){
                        ?>
                        <li><a href="<?php echo base_url() ?>index.php/admin/addStudent">Add Student</a></li>
                    <?php }

                    $privilege = $this->general->checkPrivilege($this->nativesession->get('role'), 'p0004');
                    if($privilege == 1){
                        ?>
                        <li><a href="<?php echo base_url() ?>index.php/admin/addTeacher">Add Teacher</a></li>
                    <?php }



                     ?>
                    <li><a href="<?php echo base_url() ?>index.php/admin/parentView">Parents</a></li>
                    <li><a href="<?php echo base_url() ?>index.php/admin/staffView">Staff</a></li>
                    <li><a href="<?php echo base_url() ?>index.php/admin/studentView">Students</a></li>
                    <li><a href="<?php echo base_url() ?>index.php/admin/teacherView">Teachers</a></li>
                    <li><a href="<?php echo base_url() ?>index.php/teacher/libraryView">Libraries</a></li>
                </ul>
            </li>
            <li><a><i class="fa fa-check"></i>Attendance <span class="fa fa-chevron-down"></span></a></i>
                <ul class="nav child_menu">
                    <?php
                    if($classes) {
                    foreach ($classes as $class) {
                        $encrypted = $this->general->encryptParaID($class['classid'],'class');
                    ?>
                    <li><a href="<?php echo base_url() ?>index.php/admin/attendanceClassView/<?php echo $encrypted?>"?>Grade <?php echo $class['classroom']; ?></a>
                        <?php
                        }
                        }?>
                    </li>
                </ul>
            </li>
            <li><a><i class="fa fa-book"></i> Courses <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="<?php echo base_url() ?>index.php/admin/feedback">Feedback</a></li>
                    <?php
                    $privilege = $this->general->checkPrivilege($this->nativesession->get('role'), 'p0013');
                    if($privilege == 1){
                        ?>
                        <li><a href="<?php echo base_url() ?>index.php/admin/addCourse">Add Course</a></li>
                    <?php } ?>
                    <li><a href="<?php echo base_url() ?>index.php/admin/allCourse">All Courses</a></li>
                    <?php if($allcourses){ ?>
                        <?php
                        foreach ($allcourses as $course){
                            $grade = explode('_', $course['classroom']);
//                                $grade = $grade[0];
                            switch ($grade[0]){
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
                                    $grade6[] = $course;
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
                            if (isset(${'grade'.$i}) && ${'grade'.$i} != null):  ?>
                                <li>
                                <a>Grade <?php echo $i; ?><span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <?php foreach (${'grade'.$i} as $row){?>
                                        <li>
                                            <?php
                                            $encrypted = $this->general->encryptParaID($row['assignid'],'courseassigned');
                                            ?>
                                            <a href="<?php echo base_url() ?>index.php/admin/courseView/s<?php echo $encrypted ?>"><?php echo $row['classroom'] ?> <?php echo $row['coursename'] ?></a>
                                        </li>
                                    <?php } ?>
                                </ul>
                            <?php endif; ?>
                            </li>
                        <?php  } ?>
                    <?php } ?>
                </ul>
            </li>
            <li><a><i class="fa fa-table"></i> Schedule <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <?php
                    $privilege = $this->general->checkPrivilege($this->nativesession->get('role'), 'p0008');
                    if($privilege == 1){
                        ?>
                        <li><a href="<?php echo base_url() ?>index.php/admin/createSchedule">Create Schedule</a></li>
                        <li><a href="<?php echo base_url() ?>index.php/admin/editSchedule">Edit Schedule</a></li>
                    <?php } ?>
                    <li><a>Class Schedule <span class="fa fa-chevron-down"></a>
                        <?php if($classes){
                            ?>
                            <ul class="nav child_menu">
                                <?php
                                foreach ($classes as $class) {
                                    ?>

                                    <li>
                                        <?php
                                        $encrypted = $this->general->encryptParaID($class['classid'],'class');
                                        ?>
                                        <a href="<?php echo base_url() ?>index.php/admin/classScheduleView/<?php echo $encrypted ?>">Grade <?php echo $class['classroom'] ?></a>
                                    </li>
                                <?php } ?>
                            </ul>
                        <?php } ?>
                    </li>
                    <li><a>Teacher Schedule <span class="fa fa-chevron-down"></a>
                        <?php if($allteacher){
                            ?>
                            <ul class="nav child_menu">
                                <?php
                        foreach ($allteacher as $teacher) {
                            ?>

                                <li>
                                    <?php
                                    $encrypted = $this->general->encryptParaID($teacher['teacherid'],'teacher');
                                    ?>
                                    <a href="<?php echo base_url() ?>index.php/admin/teacherClassScheduleView/<?php echo $encrypted ?>"><?php echo $teacher['firstname'] ?></a>
                                </li>
                        <?php } ?>
                            </ul>
                        <?php } ?>
                    </li>
                    <li><a href="<?php echo base_url() ?>index.php/admin/examScheduleView">Exam Schedule</a></li>
                </ul>
            </li>
            <li><a href="<?php echo base_url() ?>index.php/admin/classesView"><i class="fa fa-table"></i> Classes </a></li>
            <li><a href="<?php echo base_url() ?>index.php/admin/payment"><i class="fa fa-usd"></i>Payments</span></a></li>
            <li><a><i class="fa fa-bell"></i> Events <span class="badge bg-green"><?php echo $eventnotif ?></span> <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <?php
                    $privilege = $this->general->checkPrivilege($this->nativesession->get('role'), 'p0006');
                    if($privilege == 1){
                        ?>
                        <li><a href="<?php echo base_url() ?>index.php/admin/addEvent">Add Event</a></li>
                    <?php } ?>
                    <li><a href="<?php echo base_url() ?>index.php/admin/eventList">Events List</a></li>
                </ul>
            </li>
           <!-- <li><a><i class="fa fa-home"></i> Student <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="<?php /*echo base_url() */?>index.php/admin/studentView">Students</a></li>
                    <li><a href="<?php /*echo base_url() */?>index.php/admin/addStudent">Add Student<span class="fa"></span></a></li>
                </ul>
            </li>
            <li><a><i class="fa fa-edit"></i> Parents <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="<?php /*echo base_url() */?>index.php/admin/allParents">Parents</a></li>
                    <li><a href="<?php /*echo base_url() */?>index.php/admin/addParent">Add Parents<span class="fa"></span></a></li>
                </ul>
            </li>-->
            <li><a><i class="fa fa-id-card-o"></i> Privilege <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="<?php echo base_url() ?>index.php/admin/allRoles">Roles</a></li>
                    <li><a href="<?php echo base_url() ?>index.php/admin/addRole">Add Role</a></li>
                    <li><a href="<?php echo base_url() ?>index.php/admin/addAssignedPrivilege">Assign Privilege</a></li>
                    <li><a href="<?php echo base_url() ?>index.php/admin/allAssignedPrivilege">Assigned Privilege</a></li>
                </ul>
            </li>
            <li><a href="<?php echo base_url() ?>index.php/admin/forms"><i class="fa fa-download"></i>Download</span></a></li>
            <?php
            $privilege = $this->general->checkPrivilege($this->nativesession->get('role'), 'p0009');
            if($privilege == 1){
                ?>
                <li><a href="<?php echo base_url() ?>index.php/admin/settings"><i class="fa fa-gear"></i>Settings</span></a></li>
            <?php } ?>
            <li><a href="<?php echo base_url() ?>index.php/admin/requestItem"><i class="fa fa-shopping-cart"></i>Request Items</span></a></li>
            <li><a href="<?php echo base_url()?>index.php/admin/home" target="_blank"><i class="fa fa-pencil-square-o "></i> Feedbacks <span class="fa"></span></a>
            </li>
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