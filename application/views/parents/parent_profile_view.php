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
                        <div class="col-md-5 col-sm-12 col-xs-12 profile_left">
                            <div class="profile_img">
                                <div class="teacher_profile_crop">
                                    <!-- Current avatar -->
                                    <img class="img-responsive avatar-view teacher_profile_img" src="<?php echo base_url() ?>assets/img/parents/profile/<?php echo $parent['photo'] ?>" alt="Avatar" title="Change the avatar">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-7 col-sm-12 col-xs-12 profile_left">
                            <h3><?php echo $parent['firstname'].' '.$parent['lastname'] ?> </h3>

                            <ul class="list-unstyled user_data">
                                <li>
                                    ID&emsp;&emsp;: <?php echo $parent['parentid'] ?>
                                </li>
                            </ul>
                        </div>
                        <div class="clearfix"></div>

                        <?php
                        $encrypted = $this->general->encryptParaID($parent['parentid'],'parent');
                        ?>
                        <a class="btn btn-success set-right" href="<?php echo base_url() ?>index.php/parents/profile_edit/<?php echo $encrypted ?>"><i class="fa fa-edit m-right-xs"></i> Edit Profile</a>
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
                                        <div class="teacher_profile_value"><?php echo $parent['firstname'].' '.$parent['lastname'] ?></div>
                                    </div>
                                </div>
                                <div class="col-md-6  col-sm-6 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Gender</div>
                                        <div class="teacher_profile_value"><?php echo $parent['gender'] ?></div>
                                    </div>
                                </div>
                                <div class="col-md-6  col-sm-6 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Phone</div>
                                        <div class="teacher_profile_value"><?php echo $parent['phone'] ?></div>
                                    </div>
                                </div>
                                <div class="col-md-6  col-sm-6 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Phone Overseas</div>
                                        <div class="teacher_profile_value"><?php echo $parent['phoneoverseas'] ?></div>
                                    </div>
                                </div>
                                <div class="col-md-6  col-sm-6 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Mobile</div>
                                        <div class="teacher_profile_value"><?php echo $parent['mobile'] ?></div>
                                    </div>
                                </div>
                                <div class="col-md-6  col-sm-6 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Mobile Overseas</div>
                                        <div class="teacher_profile_value"><?php echo $parent['mobileoverseas'] ?></div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Indonesia Home Address</div>
                                        <div class="teacher_profile_value"><?php echo $parent['address'] ?></div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Home Address Overseas</div>
                                        <div class="teacher_profile_value"><?php echo $parent['addressoverseas'] ?></div>
                                    </div>
                                </div>
                                <div class="col-md-6  col-sm-6 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Email</div>
                                        <div class="teacher_profile_value"><?php echo $parent['email'] ?></div>
                                    </div>
                                </div>
                                <div class="col-md-6  col-sm-6 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Passport No.</div>
                                        <div class="teacher_profile_value"><?php echo $parent['passportno'] ?></div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Passport Country</div>
                                        <div class="teacher_profile_value"><?php echo $parent['passportcountry'] ?></div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Passport Expiry Date</div>
                                        <div class="teacher_profile_value"><?php echo $parent['passportexp'] ?></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="profile_title">
                                <div class="col-md-12">
                                    <h2>Employment Information</h2>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Occupation</div>
                                        <div class="teacher_profile_value"><?php
                                            if($parent['occupation']==NULL)
                                                echo '-';
                                            else
                                                echo $parent['occupation']
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Company Name</div>
                                        <div class="teacher_profile_value"><?php
                                            if($parent['companyname']==NULL)
                                                echo '-';
                                            else
                                                echo $parent['companyname']
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Industry</div>
                                        <div class="teacher_profile_value"><?php
                                            if($parent['industry']==NULL)
                                                echo '-';
                                            else
                                                echo $parent['industry']
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Phone (Office)</div>
                                        <div class="teacher_profile_value"><?php
                                            if($parent['phoneoffice']==NULL)
                                                echo '-';
                                            else
                                                echo $parent['phoneoffice']
                                            ?>
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
</div>
<!-- /page content -->