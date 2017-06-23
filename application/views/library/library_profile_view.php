<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>User Profile</h3>
            </div>
        </div>

        <div class="clearfix"></div>

        <?php if ($this->nativesession->get('success')): ?>
            <div  class="alert alert-success">
                <?php echo $this->nativesession->get('success'); $this->nativesession->delete('success');?>
            </div>
        <?php endif; ?>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="col-md-5 col-sm-12 col-xs-12 profile_left">
                                <div class="profile_img">
                                    <div class="teacher_profile_crop">
                                        <!-- Current avatar -->
                                            <?php
                                        if( $this->nativesession->get('is_login_library') == 'student'){ ?>
                                            <img class="img-responsive avatar-view teacher_profile_img" src="<?php echo base_url() ?>assets/img/student/<?php echo $user['photo']?>" alt="Avatar" title="Change the avatar">
                                            <?php
                                        }
                                        else if( $this->nativesession->get('is_login_library') == 'teacher'){ ?>
                                            <img class="img-responsive avatar-view teacher_profile_img" src="<?php echo base_url() ?>assets/img/teacher/profile/<?php echo $user['photo']?>" alt="Avatar" title="Change the avatar">
                                            <?php
                                        }
                                        else if( $this->nativesession->get('is_login_library') == 'librarian'){?>
                                            <img class="img-responsive avatar-view teacher_profile_img" src="<?php echo base_url() ?>assets/img/library/profile/<?php echo $user['photo']?>" alt="Avatar" title="Change the avatar">
                                            <?php
                                        }
                                        else if($this->nativesession->get('is_login_library') == 'admin'){?>
                                            <img class="img-responsive avatar-view teacher_profile_img" src="<?php echo base_url() ?>assets/img/admin/<?php echo $user['photo']?>" alt="Avatar" title="Change the avatar">
                                            <?php
                                        }
                                        ?>

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-7 col-sm-12 col-xs-12">
                                <h3><?php echo $user['firstname'].' '.$user['lastname'] ?> </h3>

                                <ul class="list-unstyled user_data">
                                    <li>
                                        ID&emsp;&emsp;:
                                        <?php
                                        if( $this->nativesession->get('is_login_library') == 'student'){
                                            echo $user['studentid']; }
                                        else if( $this->nativesession->get('is_login_library') == 'teacher'){
                                            echo $user['teacherid'];}
                                        else if( $this->nativesession->get('is_login_library') == 'librarian'){
                                            echo $user['librarianid'];}
                                        else if($this->nativesession->get('is_login_library') == 'admin'){
                                            echo $user['adminid'];
                                        }
                                        ?>

                                        <?php ?>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <?php
                        $encrypted = $this->general->encryptParaID($user['studentid'],'student');
                        ?>
                        <a class="btn btn-success set-right" href="<?php echo base_url() ?>index.php/student/student_profile_edit/<?php echo $encrypted ?>"><i class="fa fa-edit m-right-xs"></i> Edit Profile</a>
                        <br />

                    </div>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="profile_title">
                                <div class="col-md-12">
                                    <h2>Personal Information</h2>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Name</div>
                                        <div class="teacher_profile_value"><?php echo $user['firstname'].' '.$user['lastname'] ?></div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Place of Birth</div>
                                        <div class="teacher_profile_value"><?php echo $user['placeofbirth'] ?></div>
                                    </div>
                                </div>
                                <div class="col-md-6  col-sm-6 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Date of Birth</div>
                                        <div class="teacher_profile_value"><?php echo date('d F Y', strtotime($user['dateofbirth'])) ?></div>
                                    </div>
                                </div>
                                <div class="col-md-6  col-sm-6 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Gender</div>
                                        <div class="teacher_profile_value"><?php echo $user['gender'] ?></div>
                                    </div>
                                </div>
                                <div class="col-md-6  col-sm-6 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Religion</div>
                                        <div class="teacher_profile_value"><?php echo $user['religion'] ?></div>
                                    </div>
                                </div>
                                <div class="col-md-6  col-sm-6 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Phone</div>
                                        <div class="teacher_profile_value"><?php echo $user['phone'] ?></div>
                                    </div>
                                </div>
                                <div class="col-md-6  col-sm-6 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Email</div>
                                        <div class="teacher_profile_value"><?php echo $user['email'] ?></div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Address</div>
                                        <div class="teacher_profile_value"><?php echo $user['address'] ?></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="profile_title">
                                <div class="col-md-12">
                                    <h2>Academic Information</h2>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Senior High School</div>
                                        <div class="teacher_profile_value"><?php echo $user['seniorhigh'] ?></div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Junior High School</div>
                                        <div class="teacher_profile_value"><?php echo $user['juniorhigh'] ?></div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Elementary School</div>
                                        <div class="teacher_profile_value"><?php echo $user['elementary'] ?></div>
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