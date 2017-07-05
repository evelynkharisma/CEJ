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
        $encrypted = null;
        $userid = null;
        if( $this->nativesession->get('loginas') == 'librarian'){
            $userid = $user['librarianid'];
            $encrypted = $this->general->encryptParaID($user['librarianid'],'librarian');
        }
        else if($this->nativesession->get('loginas') == 'admin'){
            $userid  = $user['adminid'];
            $encrypted = $this->general->encryptParaID($user['adminid'],'admin');
        }
        ?>
        <?php echo form_open_multipart("library/profileEdit/".$encrypted); ?>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="col-md-5 col-sm-12 col-xs-12 profile_left">
                                <div class="profile_img">
                                    <div class="teacher_profile_crop">
                                        <?php
                                        if( $this->nativesession->get('loginas') == 'librarian'){?>
                                            <img class="img-responsive avatar-view teacher_profile_img" src="<?php echo base_url() ?>assets/img/library/profile/<?php echo $user['photo']?>" alt="Avatar" title="Change the avatar">
                                            <?php
                                        }
                                        else if($this->nativesession->get('loginas') == 'admin'){?>
                                            <img class="img-responsive avatar-view teacher_profile_img" src="<?php echo base_url() ?>assets/img/admin/<?php echo $user['photo']?>" alt="Avatar" title="Change the avatar">
                                            <?php
                                        }
                                        ?>

                                    </div>
                                </div>
                                <input class="btn btn-primary set-margin-bottom set-margin-top" type="file" name="photo" />
                            </div>
                            <div class="col-md-7 col-sm-12 col-xs-12">
                                <h3><?php echo $user['firstname'].' '.$user['lastname'] ?> </h3>

                                <ul class="list-unstyled user_data">
                                    <li>
                                        ID&emsp;&emsp;: <?php echo $userid; ?>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary set-right"><i class="fa fa-save m-right-xs"></i> Save Changes</button>
                        <br />

                    </div>
<!--                        <input type="hidden" class="form-control set-margin-bottom" name="studentid" value="--><?php //echo $user['studentid']; ?><!--"/>-->
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
                                            <input type="text" class="form-control set-margin-bottom" name="firstname" value="<?php echo set_value('firstname', isset($user['firstname']) ? $user['firstname'] : ''); ?>"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Last Name</div>
                                        <div class="teacher_profile_value">
                                            <input type="text" class="form-control set-margin-bottom" name="lastname" value="<?php echo set_value('lastname', isset($user['lastname']) ? $user['lastname'] : ''); ?>"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Place of Birth</div>
                                        <div class="teacher_profile_value">
                                            <input type="text" class="form-control set-margin-bottom" name="placeofbirth" value="<?php echo set_value('placeofbirth', isset($user['placeofbirth']) ? $user['placeofbirth'] : ''); ?>"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Date of Birth</div>
                                        <div class="teacher_profile_value">
                                            <input type="text" class="form-control set-margin-bottom" id="pick-date" name="dateofbirth" value="<?php echo set_value('dateofbirth', isset($user['dateofbirth']) ? date('Y-m-d', strtotime($user['dateofbirth'])) : ''); ?>"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Gender</div>
                                        <div class="teacher_profile_value">
                                            <select class="form-control set-margin-bottom" name="gender">
                                                <option selected value="<?php echo $user['gender'] ?>"><?php echo $user['gender'] ?></option>
                                                <?php if(strcmp($user['gender'],'Male')==0):
                                                    echo "<option value='Female' >Female</option>";
                                                endif;
                                                ?>
                                                <?php if(strcmp($user['gender'],'Female')==0):
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
                                                <option selected value="<?php echo $user['religion']; ?>"><?php echo $user['religion'] ?></option>
                                                <?php if(strcmp($user['religion'],'Buddhist')!=0):
                                                    echo "<option value='Buddhist' >Buddhist</option>";
                                                endif;
                                                ?>
                                                <?php if(strcmp($user['religion'],'Christian')!=0):
                                                    echo "<option value='Christian' >Christian</option>";
                                                endif;
                                                ?>
                                                <?php if(strcmp($user['religion'],'Hindu')!=0):
                                                    echo "<option value='Hindu' >Hindu</option>";
                                                endif;
                                                ?>
                                                <?php if(strcmp($user['religion'],'Muslim')!=0):
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
                                            <input type="text" class="form-control set-margin-bottom" name="phone" value="<?php echo set_value('phone', isset($user['phone']) ? $user['phone'] : ''); ?>"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Email</div>
                                        <div class="teacher_profile_value">
                                            <input type="text" class="form-control set-margin-bottom" name="email" value="<?php echo set_value('email', isset($user['email']) ? $user['email'] : ''); ?>"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Address</div>
                                        <div class="teacher_profile_value">
                                            <textarea class="form-control set-margin-bottom" name="address"><?php echo isset($user['address']) ? $user['address'] : ''; ?></textarea>
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
                                            <textarea class="form-control" name="experience"><?php echo isset($user['experience']) ? $user['experience'] : ''; ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Post Graduate</div>
                                        <div class="teacher_profile_value">
                                            <input type="text" class="form-control" name="postgraduate" value="<?php echo set_value('postgraduate', isset($user['postgraduate']) ? $user['postgraduate'] : ''); ?>"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Graduate</div>
                                        <div class="teacher_profile_value">
                                            <input type="text" class="form-control" name="graduate" value="<?php echo set_value('graduate', isset($user['graduate']) ? $user['graduate'] : ''); ?>"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Undergraduate</div>
                                        <div class="teacher_profile_value">
                                            <input type="text" class="form-control" name="undergraduate" value="<?php echo set_value('undergraduate', isset($user['undergraduate']) ? $user['undergraduate'] : ''); ?>"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Senior High School</div>
                                        <div class="teacher_profile_value">
                                            <input type="text" class="form-control" name="seniorhigh" value="<?php echo set_value('seniorhigh', isset($user['seniorhigh']) ? $user['seniorhigh'] : ''); ?>"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Junior High School</div>
                                        <div class="teacher_profile_value">
                                            <input type="text" class="form-control" name="juniorhigh" value="<?php echo set_value('juniorhigh', isset($user['juniorhigh']) ? $user['juniorhigh'] : ''); ?>"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Elementary School</div>
                                        <div class="teacher_profile_value">
                                            <input type="text" class="form-control" name="elementary" value="<?php echo set_value('elementary', isset($user['elementary']) ? $user['elementary'] : ''); ?>"/>
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