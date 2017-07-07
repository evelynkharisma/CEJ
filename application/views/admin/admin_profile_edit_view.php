<!-- page content -->
<!-- page content -->
<div class="right_col" role="main">

    <div class="faq">
        <div class="container">
            <div class="row" style="margin-bottom: 3vw">
                <div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 1vw">
                    <!--                <h2>Borrowed Collection</h2>-->
                    <?php if ($this->nativesession->get('error')): ?>
                        <div  class="alert alert-error">
                            <?php echo $this->nativesession->get('error');$this->nativesession->delete('error'); ?>
                        </div>
                    <?php endif; ?>
                    <?php if (validation_errors()): ?>
                        <div  class="alert alert-error">
                            <?php echo validation_errors(); ?>
                        </div>
                    <?php endif; ?>
                    <?php if ($this->nativesession->get('success')): ?>
                        <div  class="alert alert-success">
                            <?php echo $this->nativesession->get('success'); $this->nativesession->delete('success');?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="row" style="margin-bottom: 3vw">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <h2>Edit Profile</h2>
                </div>
            </div>

            <div class="clearfix"></div>
        <?php

        $adminid  = $admin['adminid'];
        $encrypted = $this->general->encryptParaID($admin['adminid'],'admin');
        ?>
        <?php echo form_open_multipart("admin/profileEdit/".$encrypted); ?>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="col-md-5 col-sm-12 col-xs-12 profile_left">
                                <div class="profile_img">
                                    <div class="teacher_profile_crop">
                                        <img class="img-responsive avatar-view teacher_profile_img" src="<?php echo base_url() ?>assets/img/admin/<?php echo $admin['photo']?>" alt="Avatar" title="Change the avatar">
                                    </div>
                                </div>
                                <input class="btn btn-primary set-margin-bottom set-margin-top" type="file" name="photo" />
                            </div>
                            <div class="col-md-7 col-sm-12 col-xs-12">
                                <h3><?php echo $admin['firstname'].' '.$admin['lastname'] ?> </h3>

                                <ul class="list-unstyled user_data">
                                    <li>
                                        ID&emsp;&emsp;: <?php echo $adminid; ?>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary set-right"><i class="fa fa-save m-right-xs"></i> Save Changes</button>
                        <br />

                    </div>
<!--                        <input type="hidden" class="form-control set-margin-bottom" name="studentid" value="--><?php //echo $admin['studentid']; ?><!--"/>-->
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="profile_title">
                                <div class="col-md-12">
                                    <h2>Personal Information</h2>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Password</div>
                                        <div class="teacher_profile_value">
                                            <input type="password" class="form-control set-margin-bottom" name="password"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Confirm Password</div>
                                        <div class="teacher_profile_value">
                                            <input type="password" class="form-control set-margin-bottom" name="confirmpassword"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">First Name</div>
                                        <div class="teacher_profile_value">
                                            <input type="text" class="form-control set-margin-bottom" name="firstname" value="<?php echo set_value('firstname', isset($admin['firstname']) ? $admin['firstname'] : ''); ?>"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Last Name</div>
                                        <div class="teacher_profile_value">
                                            <input type="text" class="form-control set-margin-bottom" name="lastname" value="<?php echo set_value('lastname', isset($admin['lastname']) ? $admin['lastname'] : ''); ?>"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Place of Birth</div>
                                        <div class="teacher_profile_value">
                                            <input type="text" class="form-control set-margin-bottom" name="placeofbirth" value="<?php echo set_value('placeofbirth', isset($admin['placeofbirth']) ? $admin['placeofbirth'] : ''); ?>"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Date of Birth</div>
                                        <div class="teacher_profile_value">
                                            <input type="text" class="form-control set-margin-bottom" id="pick-date" name="dateofbirth" value="<?php echo set_value('dateofbirth', isset($admin['dateofbirth']) ? date('Y-m-d', strtotime($admin['dateofbirth'])) : ''); ?>"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Gender</div>
                                        <div class="teacher_profile_value">
                                            <select class="form-control set-margin-bottom" name="gender">
                                                <option selected value="<?php echo $admin['gender'] ?>"><?php echo $admin['gender'] ?></option>
                                                <?php if(strcmp($admin['gender'],'Male')==0):
                                                    echo "<option value='Female' >Female</option>";
                                                endif;
                                                ?>
                                                <?php if(strcmp($admin['gender'],'Female')==0):
                                                    echo "<option value='Male' >Male</option>";
                                                endif;
                                                ?>
                                            </select>
                                            <!--                                            <input type="text" class="form-control set-margin-bottom" name="gender" value="--><?php //echo set_value('gender', isset($info_db['gender']) ? $info_db['gender'] : ''); ?><!--"/>-->
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Religion</div>
                                        <div class="teacher_profile_value">
                                            <select class="form-control set-margin-bottom" name="religion">
                                                <option selected value="<?php echo $admin['religion']; ?>"><?php echo $admin['religion'] ?></option>
                                                <?php if(strcmp($admin['religion'],'Buddhist')!=0):
                                                    echo "<option value='Buddhist' >Buddhist</option>";
                                                endif;
                                                ?>
                                                <?php if(strcmp($admin['religion'],'Christian')!=0):
                                                    echo "<option value='Christian' >Christian</option>";
                                                endif;
                                                ?>
                                                <?php if(strcmp($admin['religion'],'Hindu')!=0):
                                                    echo "<option value='Hindu' >Hindu</option>";
                                                endif;
                                                ?>
                                                <?php if(strcmp($admin['religion'],'Muslim')!=0):
                                                    echo "<option value='Muslim' >Muslim</option>";
                                                endif;
                                                ?>
                                            </select>
                                            <!--                                            <input type="text" class="form-control set-margin-bottom" name="religion" value="--><?php //echo set_value('religion', isset($info_db['religion']) ? $info_db['religion'] : ''); ?><!--"/>-->
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Phone</div>
                                        <div class="teacher_profile_value">
                                            <input type="text" class="form-control set-margin-bottom" name="phone" value="<?php echo set_value('phone', isset($admin['phone']) ? $admin['phone'] : ''); ?>"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Email</div>
                                        <div class="teacher_profile_value">
                                            <input type="text" class="form-control set-margin-bottom" name="email" value="<?php echo set_value('email', isset($admin['email']) ? $admin['email'] : ''); ?>"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Address</div>
                                        <div class="teacher_profile_value">
                                            <textarea class="form-control set-margin-bottom" name="address"><?php echo isset($admin['address']) ? $admin['address'] : ''; ?></textarea>
                                        </div>
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
                                        <div class="teacher_profile_value">
                                            <textarea class="form-control" name="experience"><?php echo isset($admin['experience']) ? $admin['experience'] : ''; ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Post Graduate</div>
                                        <div class="teacher_profile_value">
                                            <input type="text" class="form-control" name="postgraduate" value="<?php echo set_value('postgraduate', isset($admin['postgraduate']) ? $admin['postgraduate'] : ''); ?>"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Graduate</div>
                                        <div class="teacher_profile_value">
                                            <input type="text" class="form-control" name="graduate" value="<?php echo set_value('graduate', isset($admin['graduate']) ? $admin['graduate'] : ''); ?>"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Undergraduate</div>
                                        <div class="teacher_profile_value">
                                            <input type="text" class="form-control" name="undergraduate" value="<?php echo set_value('undergraduate', isset($admin['undergraduate']) ? $admin['undergraduate'] : ''); ?>"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Senior High School</div>
                                        <div class="teacher_profile_value">
                                            <input type="text" class="form-control" name="seniorhigh" value="<?php echo set_value('seniorhigh', isset($admin['seniorhigh']) ? $admin['seniorhigh'] : ''); ?>"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Junior High School</div>
                                        <div class="teacher_profile_value">
                                            <input type="text" class="form-control" name="juniorhigh" value="<?php echo set_value('juniorhigh', isset($admin['juniorhigh']) ? $admin['juniorhigh'] : ''); ?>"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Elementary School</div>
                                        <div class="teacher_profile_value">
                                            <input type="text" class="form-control" name="elementary" value="<?php echo set_value('elementary', isset($admin['elementary']) ? $admin['elementary'] : ''); ?>"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>
<!-- /page content -->