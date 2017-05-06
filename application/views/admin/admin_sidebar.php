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
            <li><a><i class="fa fa-home"></i> Student <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="<?php echo base_url() ?>index.php/admin/allStudents">All Students</a></li>
                    <li><a href="<?php echo base_url() ?>index.php/admin/addStudent">Add Student<span class="fa"></span></a></li>
                </ul>
            </li>
            <li><a><i class="fa fa-edit"></i> Parents <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="<?php echo base_url() ?>index.php/admin/allParents">All Parents</a></li>
                    <li><a href="<?php echo base_url() ?>index.php/admin/addParent">Add Parents<span class="fa"></span></a></li>
                </ul>
            </li>
            <li><a><i class="fa fa-id-card-o"></i> Privilege <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="<?php echo base_url() ?>index.php/admin/allRoles">All Roles</a></li>
                    <li><a href="<?php echo base_url() ?>index.php/admin/addRole">Add Role</a></li>
                    <li><a href="<?php echo base_url() ?>index.php/admin/addAssignedPrivilege">Assign Privilege</a></li>
                    <li><a href="<?php echo base_url() ?>index.php/admin/allAssignedPrivilege">Assigned Privilege</a></li>
                </ul>
            </li>
            <li><a href="<?php echo base_url()?>index.php/library/home" target="_blank"><i class="fa fa-pencil-square-o "></i> Feedbacks <span class="fa"></span></a>
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