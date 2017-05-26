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
                                    <img class="img-responsive avatar-view teacher_profile_img" src="<?php echo base_url() ?>assets/img/operation/profile/<?php echo $operation['photo'] ?>" alt="Avatar" title="Change the avatar">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-7 col-sm-12 col-xs-12 profile_left">
                            <h3><?php echo $operation['firstname'].' '.$operation['lastname'] ?> </h3>

                            <ul class="list-unstyled user_data">
                                <li>
                                    ID&emsp;&emsp;: <?php echo $operation['operationid'] ?>
                                </li>
                            </ul>
                        </div>
                        <div class="clearfix"></div>

                        <?php
                        $encrypted = $this->general->encryptParaID($operation['operationid'],'operation');
                        ?>
                        <a class="btn btn-success set-right" href="<?php echo base_url() ?>index.php/operation/profile_edit/<?php echo $encrypted ?>"><i class="fa fa-edit m-right-xs"></i> Edit Profile</a>
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
                                    <div class="teacher_profile_value"><?php echo $operation['firstname'].' '.$operation['lastname'] ?></div>
                                </div>
                            </div>
                            <div class="col-md-6  col-sm-6 col-xs-12">
                                <div class="teacher_profile_group">
                                    <div class="teacher_profile_label">Gender</div>
                                    <div class="teacher_profile_value"><?php echo $operation['gender'] ?></div>
                                </div>
                            </div>
                            <div class="col-md-6  col-sm-6 col-xs-12">
                                <div class="teacher_profile_group">
                                    <div class="teacher_profile_label">Phone</div>
                                    <div class="teacher_profile_value"><?php echo $operation['phone'] ?></div>
                                </div>
                            </div>
                            <div class="col-md-6  col-sm-6 col-xs-12">
                                <div class="teacher_profile_group">
                                    <div class="teacher_profile_label">Mobile</div>
                                    <div class="teacher_profile_value"><?php echo $operation['mobile'] ?></div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="teacher_profile_group">
                                    <div class="teacher_profile_label">Address</div>
                                    <div class="teacher_profile_value"><?php echo $operation['address'] ?></div>
                                </div>
                            </div>
                            <div class="col-md-6  col-sm-6 col-xs-12">
                                <div class="teacher_profile_group">
                                    <div class="teacher_profile_label">Email</div>
                                    <div class="teacher_profile_value"><?php echo $operation['email'] ?></div>
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