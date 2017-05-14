<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Add New Parent</h3>
            </div>
        </div>

        <div class="clearfix"></div>

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
        <?php echo form_open_multipart("admin/addParent/"); ?>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <div class="col-md-12 col-sm-12 col-xs-12 profile_left">
                            <div class="profile_img">
                                <div class="teacher_profile_crop">
                                    <!-- Current avatar -->
                                    <img class="img-responsive avatar-view teacher_profile_img" src="http://placehold.it/220x220" alt="Avatar" title="Change the avatar">
                                </div>
                            </div>
                            <input class="btn btn-success set-margin-bottom set-margin-top" type="file" name="photo" />

                            <button type="submit" class="btn btn-success set-right"><i class="fa fa-save m-right-xs"></i> Save Changes</button>
                            <br />

                        </div>

                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="profile_title">
                                <div class="col-md-12">
                                    <h2>Personal Information</h2>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <!--<div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">New Password</div>
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
                                </div>-->
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">First Name</div>
                                        <div class="teacher_profile_value">
                                            <input type="text" class="form-control set-margin-bottom" name="firstname" value="<?php echo set_value('firstname', isset($parent['firstname']) ? $parent['firstname'] : ''); ?>"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Last Name</div>
                                        <div class="teacher_profile_value">
                                            <input type="text" class="form-control set-margin-bottom" name="lastname" value="<?php echo set_value('lastname', isset($parent['lastname']) ? $parent['lastname'] : ''); ?>"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Gender</div>
                                        <div class="teacher_profile_value">
                                            <select class="form-control set-margin-bottom" name="gender">

                                                <option value='Female' >Female</option>";
                                                <option value='Male' >Male</option>";
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Phone</div>
                                        <div class="teacher_profile_value">
                                            <input type="text" class="form-control set-margin-bottom" name="phone" value="<?php echo set_value('phone', isset($parent['phone']) ? $parent['phone'] : ''); ?>"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Phone Overseas</div>
                                        <div class="teacher_profile_value">
                                            <input type="text" class="form-control set-margin-bottom" name="phoneoverseas" value="<?php echo set_value('phoneoverseas', isset($parent['phoneoverseas']) ? $parent['phoneoverseas'] : ''); ?>"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Mobile</div>
                                        <div class="teacher_profile_value">
                                            <input type="text" class="form-control set-margin-bottom" name="mobile" value="<?php echo set_value('mobile', isset($parent['mobile']) ? $parent['mobile'] : ''); ?>"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Mobile Overseas</div>
                                        <div class="teacher_profile_value">
                                            <input type="text" class="form-control set-margin-bottom" name="mobileoverseas" value="<?php echo set_value('mobile', isset($parent['mobileoverseas']) ? $parent['mobileoverseas'] : ''); ?>"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Indonesia Home Address</div>
                                        <div class="teacher_profile_value">
                                            <textarea class="form-control set-margin-bottom" name="address"><?php if(isset($_POST['address'])) {echo htmlentities ($_POST['address']); }?></textarea>
<!--                                            <textarea class="form-control set-margin-bottom" name="address">--><?php //echo isset($parent['address']) ? $parent['address'] : ''; ?><!--</textarea>-->
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Home Address Overseas</div>
                                        <div class="teacher_profile_value">
                                            <textarea class="form-control set-margin-bottom" name="addressoverseas"><?php if(isset($_POST['addressoverseas'])) {echo htmlentities ($_POST['addressoverseas']); }?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Email</div>
                                        <div class="teacher_profile_value">
                                            <input type="text" class="form-control set-margin-bottom" name="email" value="<?php echo set_value('email', isset($parent['email']) ? $parent['email'] : ''); ?>"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Passport No.</div>
                                        <div class="teacher_profile_value">
                                            <input type="text" class="form-control set-margin-bottom" name="passportno" value="<?php echo set_value('passportno', isset($parent['passportno']) ? $parent['passportno'] : ''); ?>"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Passport Country</div>
                                        <div class="teacher_profile_value">
                                            <input type="text" class="form-control set-margin-bottom" name="passportcountry" value="<?php echo set_value('passportcountry', isset($parent['passportcountry']) ? $parent['passportcountry'] : ''); ?>"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Passport Expiry Date</div>
                                        <div class="teacher_profile_value">
                                            <input type="text" class="form-control set-margin-bottom" id="pick-date" name="passportexp" value="<?php echo set_value('passportexp', isset($parent['passportexp']) ? date('Y-m-d', strtotime($parent['passportexp'])) : ''); ?>"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="profile_title">
                                <div class="col-md-12">
                                    <h2>Employement Information</h2>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Occupation</div>
                                        <div class="teacher_profile_value">
                                            <input type="text" class="form-control set-margin-bottom" name="occupation" value="<?php echo set_value('occupation', isset($parent['occupation']) ? $parent['occupation'] : ''); ?>"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Company Name</div>
                                        <div class="teacher_profile_value">
                                            <input type="text" class="form-control set-margin-bottom" name="companyname" value="<?php echo set_value('companyname', isset($parent['companyname']) ? $parent['companyname'] : ''); ?>"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Industry</div>
                                        <div class="teacher_profile_value">
                                            <input type="text" class="form-control set-margin-bottom" name="industry" value="<?php echo set_value('industry', isset($parent['industry']) ? $parent['industry'] : ''); ?>"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Phone (Office)</div>
                                        <div class="teacher_profile_value">
                                            <input type="text" class="form-control set-margin-bottom" name="phoneoffice" value="<?php echo set_value('phoneoffice', isset($parent['phoneoffice']) ? $parent['phoneoffice'] : ''); ?>"/>
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