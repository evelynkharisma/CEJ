<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>User Profile</h3>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <div class="col-md-12 col-sm-12 col-xs-12 profile_left" style="padding-bottom: 2vw">
                            <div class="col-md-8 col-sm-6 col-xs-12">
                                <div class="profile_img">
                                    <div class="teacher_profile_crop">
                                        <!-- Current avatar -->
                                        <img class="img-responsive avatar-view teacher_profile_img" src="<?php echo base_url() ?>assets/img/student/<?php echo $student['photo']?>" alt="Avatar" title="Change the avatar">
                                    </div>
                                </div>
                            </div>
                           <div class="col-md-4 col-sm-6 col-xs-12"><br>
                                <h3><?php echo ucfirst($student['firstname']).' '.ucfirst($student['lastname'])?></h3>
                                <ul class="list-unstyled user_data">
                                    </li>
                                    <li class="m-top-xs">
                                        <i class="fa fa-calendar-o user-profile-icon"></i>
                                        <a href="http://www.kimlabs.com/profile/" target="_blank"><?php echo $student['phone']?></a>
                                    </li>

                                    <li class="m-top-xs">
                                        <i class="fa fa-external-link user-profile-icon"></i>
                                        <a href="http://www.kimlabs.com/profile/" target="_blank"> <?php echo $student['email']?></a>
                                    </li>
                                </ul>
                                <a href="<?php echo base_url() ?>index.php/student/student_profile_edit" class="btn btn-success"><i class="fa fa-edit m-right-xs"></i>Edit Profile</a>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="profile_title">
                                <div class="col-md-12">
                                    <h2>Personal Information</h2>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-6">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Name</div>
                                        <div class="teacher_profile_value"><?php echo ucfirst($student['firstname']).' '.ucfirst($student['lastname'])?></div>
                                    </div>
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Place of Birth</div>
                                        <div class="teacher_profile_value"><?php echo ucfirst($student['placeofbirth'])?></div>
                                    </div>
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Religion</div>
                                        <div class="teacher_profile_value"><?php echo ucfirst($student['religion'])?></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Date of Birth</div>
                                        <div class="teacher_profile_value"><?php echo date('d', strtotime($student['dateofbirth'])).' '.date('F', strtotime($student['dateofbirth'])).' '.date('Y', strtotime($student['dateofbirth']))?></div>
                                    </div>
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Gender</div>
                                        <div class="teacher_profile_value"><?php echo ucfirst($student['gender'])?></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <div class="profile_title">
                                <div class="col-md-12">
                                    <h2>Academic Information</h2>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-6">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Elementary School</div>
                                        <div class="teacher_profile_value"><?php echo ucfirst($student['elementary'])?></div>
                                    </div>
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">High School</div>
                                        <div class="teacher_profile_value"><?php echo ucfirst($student['seniorhigh'])?></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Junior High School</div>
                                        <div class="teacher_profile_value"><?php echo ucfirst($student['juniorhigh'])?></div>
                                    </div>
<!--                                    <div class="teacher_profile_group">-->
<!--                                        <div class="teacher_profile_label">Graduate</div>-->
<!--                                        <div class="teacher_profile_value">Bina Nusantara</div>-->
<!--                                    </div>-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->