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
                        <div class="col-md-3 col-sm-3 col-xs-12 profile_left">
                            <div class="profile_img">
                                <div class="teacher_profile_crop">
                                    <!-- Current avatar -->
                                    <img class="img-responsive avatar-view teacher_profile_img" src="<?php echo base_url() ?>assets/img/teacher/eve.jpg" alt="Avatar" title="Change the avatar">
                                </div>
                            </div>
                            <h3><?php echo $info_db['firstname'].' '.$info_db['lastname'] ?> </h3>

                            <ul class="list-unstyled user_data">
                                <li><i class="fa fa-map-marker user-profile-icon"></i> <?php echo $info_db['address'] ?>
                                </li>

                                <li>
                                    <i class="fa fa-briefcase user-profile-icon"></i> <?php echo $info_db['specialist'] ?>
                                </li>

                                <li class="m-top-xs">
                                    <i class="fa fa-phone user-profile-icon"></i>
                                    <a href="http://www.kimlabs.com/profile/" target="_blank"><?php echo $info_db['phone'] ?></a>
                                </li>

                                <li class="m-top-xs">
                                    <i class="fa fa-external-link user-profile-icon"></i>
                                    <a href="http://www.kimlabs.com/profile/" target="_blank"> <?php echo $info_db['email'] ?></a>
                                </li>
                            </ul>

                            <a class="btn btn-success"><i class="fa fa-edit m-right-xs"></i>Edit Profile</a>
                            <br />

                        </div>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <div class="profile_title">
                                <div class="col-md-12">
                                    <h2>Personal Information</h2>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-6">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Name</div>
                                        <div class="teacher_profile_value"><?php echo $info_db['firstname'].' '.$info_db['lastname'] ?></div>
                                    </div>
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Place of Birth</div>
                                        <div class="teacher_profile_value"><?php echo $info_db['placeofbirth'] ?></div>
                                    </div>
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Religion</div>
                                        <div class="teacher_profile_value"><?php echo $info_db['religion'] ?></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Date of Birth</div>
                                        <div class="teacher_profile_value"><?php echo date('d F Y', strtotime($info_db['dateofbirth'])) ?></div>
                                    </div>
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Gender</div>
                                        <div class="teacher_profile_value"><?php echo $info_db['gender'] ?></div>
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
                                <div class="col-md-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Working Experiences</div>
                                        <div class="teacher_profile_value"><?php
                                            if($info_db['experience']==NULL)
                                                echo '-';
                                            else
                                                echo $info_db['experience']
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Post Graduate</div>
                                        <div class="teacher_profile_value"><?php
                                            if($info_db['postgraduate']==NULL)
                                                echo '-';
                                            else
                                                echo $info_db['postgraduate']
                                            ?>
                                        </div>
                                    </div>
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Undergraduate</div>
                                        <div class="teacher_profile_value"><?php echo $info_db['undergraduate'] ?></div>
                                    </div>
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Junior High School</div>
                                        <div class="teacher_profile_value"><?php echo $info_db['juniorhigh'] ?></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Graduate</div>
                                        <div class="teacher_profile_value"><?php
                                            if($info_db['graduate']==NULL)
                                                echo '-';
                                            else
                                                echo $info_db['graduate']
                                            ?>
                                        </div>
                                    </div>
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Senior High School</div>
                                        <div class="teacher_profile_value"><?php echo $info_db['seniorhigh'] ?></div>
                                    </div>
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Elementary School</div>
                                        <div class="teacher_profile_value"><?php echo $info_db['elementary'] ?></div>
                                    </div>
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