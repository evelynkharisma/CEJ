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
                                        <img class="img-responsive avatar-view teacher_profile_img" src="<?php echo base_url() ?>assets/img/admin/<?php echo $admin['photo']?>" alt="Avatar" title="Change the avatar">

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-7 col-sm-12 col-xs-12">
                                <h3><?php echo $admin['firstname'].' '.$admin['lastname'] ?> </h3>

                                <ul class="list-unstyled user_data">
                                    <li>
                                        ID&emsp;&emsp;:
                                        <?php
                                        if( $this->nativesession->get('loginas') == 'student'){
                                            echo $admin['studentid'];
                                            $encrypted = $this->general->encryptParaID($admin['studentid'],'student');
                                        }
                                        else if( $this->nativesession->get('loginas') == 'teacher'){
                                            echo $admin['teacherid'];
                                            $encrypted = $this->general->encryptParaID($admin['teacherid'],'teacher');
                                        }
                                        else if( $this->nativesession->get('loginas') == 'librarian'){
                                            echo $admin['librarianid'];
                                            $encrypted = $this->general->encryptParaID($admin['librarianid'],'librarian');
                                        }
                                        else if($this->nativesession->get('loginas') == 'admin'){
                                            echo $admin['adminid'];
                                            $encrypted = $this->general->encryptParaID($admin['adminid'],'admin');
                                        }
                                        ?>

                                        <?php ?>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <?php

                        ?>
                        <a class="btn btn-primary set-right" href="<?php echo base_url() ?>index.php/admin/profileEdit/<?php echo $encrypted ?>"><i class="fa fa-edit m-right-xs"></i> Edit Profile</a>
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
                                    <div class="teacher_profile_value"><?php echo $admin['firstname'].' '.$admin['lastname'] ?></div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="teacher_profile_group">
                                    <div class="teacher_profile_label">Place of Birth</div>
                                    <div class="teacher_profile_value"><?php echo $admin['placeofbirth'] ?></div>
                                </div>
                            </div>
                            <div class="col-md-6  col-sm-6 col-xs-12">
                                <div class="teacher_profile_group">
                                    <div class="teacher_profile_label">Date of Birth</div>
                                    <div class="teacher_profile_value"><?php echo date('d F Y', strtotime($admin['dateofbirth'])) ?></div>
                                </div>
                            </div>
                            <div class="col-md-6  col-sm-6 col-xs-12">
                                <div class="teacher_profile_group">
                                    <div class="teacher_profile_label">Gender</div>
                                    <div class="teacher_profile_value"><?php echo $admin['gender'] ?></div>
                                </div>
                            </div>
                            <div class="col-md-6  col-sm-6 col-xs-12">
                                <div class="teacher_profile_group">
                                    <div class="teacher_profile_label">Religion</div>
                                    <div class="teacher_profile_value"><?php echo $admin['religion'] ?></div>
                                </div>
                            </div>
                            <div class="col-md-6  col-sm-6 col-xs-12">
                                <div class="teacher_profile_group">
                                    <div class="teacher_profile_label">Phone</div>
                                    <div class="teacher_profile_value"><?php echo $admin['phone'] ?></div>
                                </div>
                            </div>
                            <div class="col-md-6  col-sm-6 col-xs-12">
                                <div class="teacher_profile_group">
                                    <div class="teacher_profile_label">Email</div>
                                    <div class="teacher_profile_value"><?php echo $admin['email'] ?></div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="teacher_profile_group">
                                    <div class="teacher_profile_label">Address</div>
                                    <div class="teacher_profile_value"><?php echo $admin['address'] ?></div>
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
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="teacher_profile_group">
                                    <div class="teacher_profile_label">Working Experiences</div>
                                    <div class="teacher_profile_value"><?php
                                        if($admin['experience']==NULL)
                                            echo '-';
                                        else
                                            echo $admin['experience']
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="teacher_profile_group">
                                    <div class="teacher_profile_label">Post Graduate</div>
                                    <div class="teacher_profile_value"><?php
                                        if($admin['postgraduate']==NULL)
                                            echo '-';
                                        else
                                            echo $admin['postgraduate']
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="teacher_profile_group">
                                    <div class="teacher_profile_label">Graduate</div>
                                    <div class="teacher_profile_value"><?php
                                        if($admin['graduate']==NULL)
                                            echo '-';
                                        else
                                            echo $admin['graduate']
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="teacher_profile_group">
                                    <div class="teacher_profile_label">Undergraduate</div>
                                    <div class="teacher_profile_value"><?php echo $admin['undergraduate'] ?></div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="teacher_profile_group">
                                    <div class="teacher_profile_label">Senior High School</div>
                                    <div class="teacher_profile_value"><?php echo $admin['seniorhigh'] ?></div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="teacher_profile_group">
                                    <div class="teacher_profile_label">Junior High School</div>
                                    <div class="teacher_profile_value"><?php echo $admin['juniorhigh'] ?></div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="teacher_profile_group">
                                    <div class="teacher_profile_label">Elementary School</div>
                                    <div class="teacher_profile_value"><?php echo $admin['elementary'] ?></div>
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