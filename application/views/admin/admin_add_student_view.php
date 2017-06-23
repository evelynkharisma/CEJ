<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Add Student</h3>
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
        <?php echo form_open_multipart("admin/addStudent/"); ?>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <div class="col-md-12 col-sm-12 col-xs-12 profile_left">
                            <div class="profile_img">
                                <div class="teacher_profile_crop">
                                    <!-- Current avatar -->
                                    <img class="img-responsive avatar-view teacher_profile_img" src="<?php echo base_url() ?>assets/img/student/default.png" alt="Avatar" title="Change the avatar">
                                </div>
                            </div>
                            <input class="btn btn-success set-margin-bottom set-margin-top" type="file" name="photo" />

                            <ul class="list-unstyled user_data">
                                <li>
<!--                                    <i class="fa fa-briefcase user-profile-icon"></i> --><?php //echo $student['studentid']; ?>
                                </li>
                            </ul>

                            <button type="submit" class="btn btn-success set-right"><i class="fa fa-save m-right-xs"></i> Save Changes</button>

                            <br />

                        </div>
<!--                        <input type="hidden" class="form-control set-margin-bottom" name="studentid" value="--><?php //echo $student['studentid']; ?><!--"/>-->
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
                                        <div class="teacher_profile_label">Family Name</div>
                                        <div class="teacher_profile_value">
                                            <input type="text" class="form-control set-margin-bottom" name="familyname" value="<?php echo set_value('familyname', isset($student['familyname']) ? $student['familyname'] : ''); ?>"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">First Name</div>
                                        <div class="teacher_profile_value">
                                            <input type="text" class="form-control set-margin-bottom" name="firstname" value="<?php echo set_value('firstname', isset($student['firstname']) ? $student['firstname'] : ''); ?>"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Last Name</div>
                                        <div class="teacher_profile_value">
                                            <input type="text" class="form-control set-margin-bottom" name="lastname" value="<?php echo set_value('lastname', isset($student['lastname']) ? $student['lastname'] : ''); ?>"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Gender</div>
                                        <div class="teacher_profile_value">
                                            <select class="form-control set-margin-bottom" name="gender">
                                                <option value='Female' >Female</option>
                                                <option value='Male' >Male</option>
                                            </select>
                                            <!--                                            <input type="text" class="form-control set-margin-bottom" name="gender" value="--><?php //echo set_value('gender', isset($info_db['gender']) ? $info_db['gender'] : ''); ?><!--"/>-->
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Date of Birth</div>
                                        <div class="teacher_profile_value">
                                            <input type="text" class="form-control set-margin-bottom" id="pick-date" name="dateofbirth" value="<?php echo set_value('dateofbirth', isset($student['dateofbirth']) ? date('Y-m-d', strtotime($student['dateofbirth'])) : ''); ?>"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Country of Birth</div>
                                        <div class="teacher_profile_value">
                                            <input type="text" class="form-control set-margin-bottom" name="placeofbirth" value="<?php echo set_value('placeofbirth', isset($student['placeofbirth']) ? $student['placeofbirth'] : ''); ?>"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Religion</div>
                                        <div class="teacher_profile_value">
                                            <select class="form-control set-margin-bottom" name="religion">
                                                <option value='Buddhist' >Buddhist</option>
                                                <option value='Christian' >Christian</option>
                                                <option value='Hindu' >Hindu</option>
                                                <option value='Muslim' >Muslim</option>
                                            </select>
                                            <!--                                            <input type="text" class="form-control set-margin-bottom" name="religion" value="--><?php //echo set_value('religion', isset($info_db['religion']) ? $info_db['religion'] : ''); ?><!--"/>-->
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Phone</div>
                                        <div class="teacher_profile_value">
                                            <input type="text" class="form-control set-margin-bottom" name="phone" value="<?php echo set_value('phone', isset($student['phone']) ? $student['phone'] : ''); ?>"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Email</div>
                                        <div class="teacher_profile_value">
                                            <input type="text" class="form-control set-margin-bottom" name="email" value="<?php echo set_value('email', isset($student['email']) ? $student['email'] : ''); ?>"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Nationality</div>
                                        <div class="teacher_profile_value">
                                            <input type="text" class="form-control set-margin-bottom" name="nationality" value="<?php echo set_value('nationality', isset($student['nationality']) ? $student['nationality'] : ''); ?>"/>
                                        </div>
                                    </div>'
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Ethnic</div>
                                        <div class="teacher_profile_value">
                                            <input type="text" class="form-control set-margin-bottom" name="ethnic" value="<?php echo set_value('ethnic', isset($student['ethnic']) ? $student['ethnic'] : ''); ?>"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Citizenship</div>
                                        <div class="teacher_profile_value">
                                            <input type="text" class="form-control set-margin-bottom" name="citizenship" value="<?php echo set_value('citizenship', isset($student['citizenship']) ? $student['citizenship'] : ''); ?>"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Passport Country</div>
                                        <div class="teacher_profile_value">
                                            <input type="text" class="form-control set-margin-bottom" name="passportcountry" value="<?php echo set_value('passportcountry', isset($student['passportcountry']) ? $student['passportcountry'] : ''); ?>"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Passport Expired Date</div>
                                        <div class="teacher_profile_value">
                                            <input type="text" class="form-control set-margin-bottom" id="pick-date" name="passportexpired" value="<?php echo set_value('passportexpired', isset($student['passportexpired']) ? date('Y-m-d', strtotime($student['passportexpired'])) : ''); ?>"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Identity Card Type</div>
                                        <div class="teacher_profile_value">
                                            <select class="form-control set-margin-bottom" name="idcardtype">
                                                <option value='KTP' >KTP</option>
                                                <option value='Passport' >Passport</option>
                                                <option value='KITAS' >KITAS</option>
                                            </select>
                                            <!--                                            <input type="text" class="form-control set-margin-bottom" name="religion" value="--><?php //echo set_value('religion', isset($info_db['religion']) ? $info_db['religion'] : ''); ?><!--"/>-->
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Address</div>
                                        <div class="teacher_profile_value">
                                            <textarea class="form-control set-margin-bottom" name="address"><?php if(isset($_POST['address'])) {echo htmlentities ($_POST['address']); }?></textarea>
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
                            <div class="col-md-12 col-sm-12 col-sm-xs-12">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label"><b>Contact Detail for the Most Recent School Attended</b></div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">School Name</div>
                                        <div class="teacher_profile_value">
                                            <input type="text" class="form-control" name="rcname" value="<?php echo set_value('rcname', isset($studentRecentSchool['school']) ? $studentRecentSchool['school'] : ''); ?>"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Contact Person</div>
                                        <div class="teacher_profile_value">
                                            <input type="text" class="form-control" name="rccontact" value="<?php echo set_value('rccontact', isset($studentRecentSchool['contactperson']) ? $studentRecentSchool['contactperson'] : ''); ?>"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Position</div>
                                        <div class="teacher_profile_value">
                                            <input type="text" class="form-control" name="rcposition" value="<?php echo set_value('rcposition', isset($studentRecentSchool['position']) ? $studentRecentSchool['position'] : ''); ?>"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Email</div>
                                        <div class="teacher_profile_value">
                                            <input type="text" class="form-control" name="rcemail" value="<?php echo set_value('rcemail', isset($studentRecentSchool['email']) ? $studentRecentSchool['email'] : ''); ?>"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Phone</div>
                                        <div class="teacher_profile_value">
                                            <input type="text" class="form-control" name="rcphone" value="<?php echo set_value('rcphone ', isset($studentRecentSchool['phone']) ? $studentRecentSchool['phone'] : ''); ?>"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Why is your child leaving his/her current educational setting?</div>
                                        <div class="teacher_profile_value">
                                            <textarea class="form-control set-margin-bottom" name="rcreason"><?php if(isset($_POST['rcreason'])) {echo htmlentities ($_POST['rcreason']); }?></textarea>
                                        </div>
                                    </div>
                                </div>

                            </div>
<!--                            <div class="col-md-12 col-sm-12 col-sm-xs-12">-->
<!--                                <div class="col-md-12 col-sm-12 col-xs-12">-->
<!--                                    <a class="btn btn-danger set-right removePlan"><i class="fa fa-minus m-right-xs"></i> Remove Educational Detail</a>-->
<!--                                    <a class="btn btn-success set-right addPlan"><i class="fa fa-plus m-right-xs"></i> Add Educational Detail</a>-->
<!--                                    <div class="teacher_profile_group toAdd" style="margin-bottom: 2vw ">-->
<!--                                        <div class="teacher_profile_value ">-->
<!--                                            <div class="teacher_profile_label"><h4><b>Previous School Detail</b></h4></div>-->
<!--                                            <table class="teacher_course_implementation" style="border-bottom: 1px solid lightgrey; border-top: 1px solid lightgrey">-->
<!--                                                <tr>-->
<!--                                                    <td><div class="teacher_profile_label">School Name</div></td>-->
<!--                                                    <td><input type="text" class="form-control set-margin-bottom set-margin-top" name="sname[]"/></td>-->
<!--                                                </tr>-->
<!--                                                <tr>-->
<!--                                                    <td><div class="teacher_profile_label">Country</div></td>-->
<!--                                                    <td><input class="form-control set-margin-bottom" name="scountry[]" type="text"></input></td>-->
<!--                                                </tr>-->
<!--                                                <tr>-->
<!--                                                    <td><div class="teacher_profile_label">Start Date</div></td>-->
<!--                                                    <td><input class="form-control set-margin-bottom" name="sstart[]" id="pick-date"></input></td>-->
<!--                                                </tr>-->
<!--                                                <tr>-->
<!--                                                    <td><div class="teacher_profile_label">End Date</div></td>-->
<!--                                                    <td><input class="form-control set-margin-bottom" name="send[]" id="pick-date"></input></td>-->
<!--                                                </tr>-->
<!--                                                <tr>-->
<!--                                                    <td><div class="teacher_profile_label">Highest Grade Completed</div></td>-->
<!--                                                    <td><input class="form-control set-margin-bottom" name="sgrade[]" type="text"></input></td>-->
<!--                                                </tr>-->
<!--                                                <tr>-->
<!--                                                    <td><div class="teacher_profile_label">Language of Istruction</div></td>-->
<!--                                                    <td><input class="form-control set-margin-bottom" name="slanguage[]" type="text"></input></td>-->
<!--                                                </tr>-->
<!--                                            </table>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                    <div class="teacher_profile_group toAdd" style="margin-bottom: 2vw ">-->
<!--                                        <div class="teacher_profile_value ">-->
<!--                                            <div class="teacher_profile_label"><h4><b>Previous School Detail</b></h4></div>-->
<!--                                            <table class="teacher_course_implementation" style="border-bottom: 1px solid lightgrey; border-top: 1px solid lightgrey">-->
<!--                                                <tr>-->
<!--                                                    <td><div class="teacher_profile_label">School Name</div></td>-->
<!--                                                    <td><input type="text" class="form-control set-margin-bottom set-margin-top" name="sname[]"/></td>-->
<!--                                                </tr>-->
<!--                                                <tr>-->
<!--                                                    <td><div class="teacher_profile_label">Country</div></td>-->
<!--                                                    <td><input class="form-control set-margin-bottom" name="scountry[]" type="text"></input></td>-->
<!--                                                </tr>-->
<!--                                                <tr>-->
<!--                                                    <td><div class="teacher_profile_label">Start Date</div></td>-->
<!--                                                    <td><input class="form-control set-margin-bottom" name="sstart[]" id="pick-date"></input></td>-->
<!--                                                </tr>-->
<!--                                                <tr>-->
<!--                                                    <td><div class="teacher_profile_label">End Date</div></td>-->
<!--                                                    <td><input class="form-control set-margin-bottom" name="send[]" id="pick-date"></input></td>-->
<!--                                                </tr>-->
<!--                                                <tr>-->
<!--                                                    <td><div class="teacher_profile_label">Highest Grade Completed</div></td>-->
<!--                                                    <td><input class="form-control set-margin-bottom" name="sgrade[]" type="text"></input></td>-->
<!--                                                </tr>-->
<!--                                                <tr>-->
<!--                                                    <td><div class="teacher_profile_label">Language of Istruction</div></td>-->
<!--                                                    <td><input class="form-control set-margin-bottom" name="slanguage[]" type="text"></input></td>-->
<!--                                                </tr>-->
<!--                                            </table>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                    <div class="teacher_profile_group toAdd" style="margin-bottom: 2vw ">-->
<!--                                        <div class="teacher_profile_value ">-->
<!--                                            <div class="teacher_profile_label"><h4><b>Previous School Detail</b></h4></div>-->
<!--                                            <table class="teacher_course_implementation" style="border-bottom: 1px solid lightgrey; border-top: 1px solid lightgrey">-->
<!--                                                <tr>-->
<!--                                                    <td><div class="teacher_profile_label">School Name</div></td>-->
<!--                                                    <td><input type="text" class="form-control set-margin-bottom set-margin-top" name="sname[]"/></td>-->
<!--                                                </tr>-->
<!--                                                <tr>-->
<!--                                                    <td><div class="teacher_profile_label">Country</div></td>-->
<!--                                                    <td><input class="form-control set-margin-bottom" name="scountry[]" type="text"></input></td>-->
<!--                                                </tr>-->
<!--                                                <tr>-->
<!--                                                    <td><div class="teacher_profile_label">Start Date</div></td>-->
<!--                                                    <td><input class="form-control set-margin-bottom" name="sstart[]" id="pick-date"></input></td>-->
<!--                                                </tr>-->
<!--                                                <tr>-->
<!--                                                    <td><div class="teacher_profile_label">End Date</div></td>-->
<!--                                                    <td><input class="form-control set-margin-bottom" name="send[]" id="pick-date"></input></td>-->
<!--                                                </tr>-->
<!--                                                <tr>-->
<!--                                                    <td><div class="teacher_profile_label">Highest Grade Completed</div></td>-->
<!--                                                    <td><input class="form-control set-margin-bottom" name="sgrade[]" type="text"></input></td>-->
<!--                                                </tr>-->
<!--                                                <tr>-->
<!--                                                    <td><div class="teacher_profile_label">Language of Istruction</div></td>-->
<!--                                                    <td><input class="form-control set-margin-bottom" name="slanguage[]" type="text"></input></td>-->
<!--                                                </tr>-->
<!--                                            </table>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                    <div class="teacher_profile_group toAdd" style="margin-bottom: 2vw ">-->
<!--                                        <div class="teacher_profile_value ">-->
<!--                                            <div class="teacher_profile_label"><h4><b>Previous School Detail</b></h4></div>-->
<!--                                            <table class="teacher_course_implementation" style="border-bottom: 1px solid lightgrey; border-top: 1px solid lightgrey">-->
<!--                                                <tr>-->
<!--                                                    <td><div class="teacher_profile_label">School Name</div></td>-->
<!--                                                    <td><input type="text" class="form-control set-margin-bottom set-margin-top" name="sname[]"/></td>-->
<!--                                                </tr>-->
<!--                                                <tr>-->
<!--                                                    <td><div class="teacher_profile_label">Country</div></td>-->
<!--                                                    <td><input class="form-control set-margin-bottom" name="scountry[]" type="text"></input></td>-->
<!--                                                </tr>-->
<!--                                                <tr>-->
<!--                                                    <td><div class="teacher_profile_label">Start Date</div></td>-->
<!--                                                    <td><input class="form-control set-margin-bottom" name="sstart[]" id="pick-date"></input></td>-->
<!--                                                </tr>-->
<!--                                                <tr>-->
<!--                                                    <td><div class="teacher_profile_label">End Date</div></td>-->
<!--                                                    <td><input class="form-control set-margin-bottom" name="send[]" id="pick-date"></input></td>-->
<!--                                                </tr>-->
<!--                                                <tr>-->
<!--                                                    <td><div class="teacher_profile_label">Highest Grade Completed</div></td>-->
<!--                                                    <td><input class="form-control set-margin-bottom" name="sgrade[]" type="text"></input></td>-->
<!--                                                </tr>-->
<!--                                                <tr>-->
<!--                                                    <td><div class="teacher_profile_label">Language of Istruction</div></td>-->
<!--                                                    <td><input class="form-control set-margin-bottom" name="slanguage[]" type="text"></input></td>-->
<!--                                                </tr>-->
<!--                                            </table>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!---->
<!--                                </div>-->
<!--                            </div>-->
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="profile_title">
                                <div class="col-md-12">
                                    <h2>Student Information</h2>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Have your child have or ever been assessed with learning difficulties?</div>
                                        <div class="teacher_profile_value col-xs-12" style="padding: 0">
                                            <select class="form-control set-margin-bottom" name="cdlearningdiff">
                                                <option value='1' >Yes</option>
                                                <option value='0' >No</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Nature of difficulty</div>
                                        <div class="teacher_profile_value">
                                            <textarea class="form-control set-margin-bottom" name="cdlearningdiffnature" placeholder="If no, then fill with 'None'"><?php if(isset($_POST['cdlearningdiffnature'])) {echo htmlentities ($_POST['cdlearningdiffnature']); }?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Has your child ever benefited from academic support or received remedial help?</div>
                                        <div class="teacher_profile_value col-xs-12 col-sm-6 col-md-6   " style="padding: 0">
                                            <select class="form-control set-margin-bottom" name="cdacademicsuport">
                                                <option value='1' >Yes</option>
                                                <option value='0' >No</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Nature of support or remedial help</div>
                                        <div class="teacher_profile_value">
                                            <textarea class="form-control set-margin-bottom" name="cdacademicsuportnature" placeholder="If no, then fill with 'None'"><?php if(isset($_POST['cdacademicsuportnature'])) {echo htmlentities ($_POST['cdacademicsuportnature']); }?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Has your child/ward ever been assessed as gifted/talented</div>
                                        <div class="teacher_profile_value col-xs-12" style="padding: 0">
                                            <select class="form-control set-margin-bottom" name="cdtalented">
                                                <option value='1' >Yes</option>
                                                <option value='0' >No</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">If yes, please provide details</div>
                                        <div class="teacher_profile_value">
                                            <textarea class="form-control set-margin-bottom" name="cdtalenteddetail" placeholder="If no, then fill with 'None'"><?php if(isset($_POST['cdtalenteddetail'])) {echo htmlentities ($_POST['cdtalenteddetail']); }?></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="profile_title">
                                <div class="col-md-12">
                                    <h2>Student Information -  Language</h2>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">What is your child's first/native language?</div>
                                        <div class="teacher_profile_value col-xs-12" style="padding: 0">
                                            <input type="text" class="form-control set-margin-bottom" name="cdnativelang" value="<?php echo set_value('cdnativelang', isset($studentChildDevelopment['nativelanguage']) ? $studentChildDevelopment['nativelanguage'] : ''); ?>"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Second Language</div>
                                        <div class="teacher_profile_value col-xs-12" style="padding: 0">
                                            <input type="text" class="form-control set-margin-bottom" name="cdsecondlang" value="<?php echo set_value('cdsecondlang', isset($studentChildDevelopment['secondlanguage']) ? $studentChildDevelopment['secondlanguage'] : ''); ?>"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">English Proficiency (non-native English speaker only) </div>
                                        <div class="teacher_profile_value col-xs-12" style="padding: 0">
                                            <select class="form-control set-margin-bottom" name="cdenglishproficiency">
                                                <option value='0' >Low</option>
                                                <option value='1' >Medium</option>
                                                <option value='2' >High</option>
                                                <option value='3' >Native</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">How long has your child been learning English?</div>
                                        <div class="teacher_profile_value col-xs-12" style="padding: 0">
                                            <input type="text" class="form-control set-margin-bottom" name="cdlearningenglish" value="<?php echo set_value('cdlearningenglish', isset($studentChildDevelopment['learningenglish']) ? $studentChildDevelopment['learningenglish'] : ''); ?>"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Which language is spoken at home?</div>
                                        <div class="teacher_profile_value col-xs-12" style="padding: 0">
                                            <input type="text" class="form-control set-margin-bottom" name="cdlangathome" value="<?php echo set_value('cdlangathome', isset($studentChildDevelopment['langathome']) ? $studentChildDevelopment['langathome'] : ''); ?>"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">In which other language(s)is your child proficient?</div>
                                        <div class="teacher_profile_value col-xs-12" style="padding: 0">
                                            <input type="text" class="form-control set-margin-bottom" name="cdlangproficient" value="<?php echo set_value('cdlangproficient', isset($studentChildDevelopment['langproficient']) ? $studentChildDevelopment['langproficient'] : ''); ?>"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Previous countries of residence</div>
                                        <div class="teacher_profile_value col-xs-12" style="padding: 0">
                                            <input type="text" class="form-control set-margin-bottom" name="cdprevcountry" value="<?php echo set_value('cdprevcountry', isset($studentChildDevelopment['prevcountry']) ? $studentChildDevelopment['prevcountry'] : ''); ?>"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Has your ever studied a language other than English at school?</div>
                                        <div class="teacher_profile_value"  >
                                            <select class="form-control set-margin-bottom " name="cdstudiedotherlang">
                                                <option value='1' >Yes</option>
                                                <option value='0' >No</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Has your child experienced any difficulties in acquiring language?</div>
                                        <div class="teacher_profile_value" >
                                            <select class="form-control set-margin-bottom " name="cddifficultvocab">
                                                <option value='1' >Yes</option>
                                                <option value='0' >No</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Does your child receieve additional support with his/her first language?</div>
                                        <div class="teacher_profile_value " >
                                            <select class="form-control set-margin-bottom " name="cdfirstlangSupport">
                                                <option value='1' >Yes</option>
                                                <option value='0' >No</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">If yes to any of the above, please provide details</div>
                                        <div class="teacher_profile_value " >
                                            <textarea class="form-control set-margin-bottom" name="cdvocabEnglishSupportDetail" placeholder="If no, then fill with 'None'"><?php if(isset($_POST['cdvocabEnglishSupportDetail'])) {echo htmlentities ($_POST['cdvocabEnglishSupportDetail']); }?></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="profile_title">
                                <div class="col-md-12">
                                    <h2>Health Record</h2>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Does your child have any medical conditions or allergies, which may ifluence his/her participation in the classroom or in sport?</div>
                                        <div class="teacher_profile_value col-sm-6 col-md-6 col-xs-12" style="margin-left:-15px;" >
                                            <select class="form-control set-margin-bottom " name="hrallegies">
                                                <option value='1' >Yes</option>
                                                <option value='0' >No</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Please state the nature of the condition(s) below</div>
                                        <div class="teacher_profile_value">
                                            <textarea class="form-control set-margin-bottom" name="hrallegiesdetail" placeholder="If no, then fill with 'None'"><?php if(isset($_POST['hrallegiesdetail'])) {echo htmlentities ($_POST['hrallegiesdetail']); }?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Does your child/ward require any medication?</div>
                                        <div class="teacher_profile_value">
                                            <select class="form-control set-margin-bottom" name="hrmedication">
                                                <option value='1' >Yes</option>
                                                <option value='0' >No</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Please list the details of the medication below</div>
                                        <div class="teacher_profile_value">
                                            <textarea class="form-control set-margin-bottom" name="hrmedicationdetail" placeholder="If no, then fill with 'None'"><?php if(isset($_POST['hrallegiesdetail'])) {echo htmlentities ($_POST['hrallegiesdetail']); }?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Has your child had any psychological assessment/treatment?</div>
                                        <div class="teacher_profile_value" style="padding: 0">
                                            <select class="form-control set-margin-bottom" name="hrpsychologicalAssessment">
                                                <option value='1' >Yes</option>
                                                <option value='0' >No</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Nature of assessment</div>
                                        <div class="teacher_profile_value">
                                            <textarea class="form-control set-margin-bottom" name="hrpsychologicalAssessmentdetail" placeholder="If no, then fill with 'None'"><?php if(isset($_POST['hrpsychologicalAssessmentdetail'])) {echo htmlentities ($_POST['hrpsychologicalAssessmentdetail']); }?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-612 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Does your child have any hearing or speech difficulty?</div>
                                        <div class="teacher_profile_value" style="padding: 0">
                                            <select class="form-control set-margin-bottom" name="hrhearingSpeechDifficulty">
                                                <option value='1' >Yes</option>
                                                <option value='0' >No</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Nature of dificulty</div>
                                        <div class="teacher_profile_value">
                                            <textarea class="form-control set-margin-bottom" name="hrhearingSpeechDifficultydetail" placeholder="If no, then fill with 'None'"><?php if(isset($_POST['hrhearingSpeechDifficultydetail'])) {echo htmlentities ($_POST['hrhearingSpeechDifficultydetail']); }?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Does your child have any behavioural difficulty?</div>
                                        <div class="teacher_profile_value" style="padding: 0">
                                            <select class="form-control set-margin-bottom" name="hrbehaviouralDifficulty">
                                                <option value='1' >Yes</option>
                                                <option value='0' >No</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Nature of behaviour</div>
                                        <div class="teacher_profile_value">
                                            <textarea class="form-control set-margin-bottom" name="hrbehaviouralDifficultydetail" placeholder="If no, then fill with 'None'"><?php if(isset($_POST['hrbehaviouralDifficultydetail'])) {echo htmlentities ($_POST['hrbehaviouralDifficultydetail']); }?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Others (please specify)</div>
                                        <div class="teacher_profile_value">
                                            <textarea class="form-control set-margin-bottom" name="hrother" placeholder="If no, then fill with 'None'"><?php if(isset($_POST['hrother'])) {echo htmlentities ($_POST['hrother']); }?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Please include any other comments/information that will enable teachers to understand your child/ward better</div>
                                        <div class="teacher_profile_value">
                                            <textarea class="form-control set-margin-bottom" name="hrotherinformation" placeholder="If no, then fill with 'None'"><?php if(isset($_POST['hrotherinformation'])) {echo htmlentities ($_POST['hrotherinformation']); }?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label" style="border-top: 1px solid lightgrey;"><h4><b>General Health</b></h4>Are there any issues we should be aware of relating to your chid?</div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Eyesight</div>
                                        <div class="teacher_profile_value" style="padding: 0">
                                            <select class="form-control set-margin-bottom" name="hreyesight">
                                                <option value='1' >Yes</option>
                                                <option value='0' >No</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Hearing</div>
                                        <div class="teacher_profile_value" style="padding: 0">
                                            <select class="form-control set-margin-bottom" name="hrhearing">
                                                <option value='1' >Yes</option>
                                                <option value='0' >No</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Food Allergies</div>
                                        <div class="teacher_profile_value" style="padding: 0">
                                            <select class="form-control set-margin-bottom" name="hrfoodallergies">
                                                <option value='1' >Yes</option>
                                                <option value='0' >No</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Other</div>
                                        <div class="teacher_profile_value" style="padding: 0">
                                            <input type="text" class="form-control" name="hrissueexplanation" value="<?php echo set_value('hrissueexplanation ', isset($studentHealthRecord['issuesexplanation']) ? $studentHealthRecord['issuesexplanation'] : ''); ?>"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12" >
                                    <div class="teacher_profile_group" >
                                        <div class="teacher_profile_label" style="border-top: 1px solid lightgrey;"><h4><b>Doctor Information</b></h4></div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Name</div>
                                        <div class="teacher_profile_value" style="padding: 0">
                                            <input type="text" class="form-control set-margin-bottom" name="hrdocname" value="<?php echo set_value('hrdocname', isset($studentHealthRecord['docname']) ? $studentHealthRecord['docname'] : ''); ?>"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Phone</div>
                                        <div class="teacher_profile_value" style="padding: 0">
                                            <input type="text" class="form-control set-margin-bottom" name="hrdocphone" value="<?php echo set_value('hrdocphone', isset($studentHealthRecord['docphone']) ? $studentHealthRecord['docphone'] : ''); ?>"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12" >
                                    <div class="teacher_profile_group" >
                                        <div class="teacher_profile_label" style="border-top: 1px solid lightgrey;"><h4><b>Emergency Contact</b></h4></div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Name</div>
                                        <div class="teacher_profile_value" style="padding: 0">
                                            <input type="text" class="form-control set-margin-bottom" name="hrecname" value="<?php echo set_value('hrecname', isset($studentHealthRecord['ecname']) ? $studentHealthRecord['ecname'] : ''); ?>"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Phone</div>
                                        <div class="teacher_profile_value" style="padding: 0">
                                            <input type="text" class="form-control set-margin-bottom" name="hrecphone" value="<?php echo set_value('hrecphone', isset($studentHealthRecord['ecphone']) ? $studentHealthRecord['ecphone'] : ''); ?>"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Relationship</div>
                                        <div class="teacher_profile_value" style="padding: 0">
                                            <input type="text" class="form-control set-margin-bottom" name="hrecrelationship" value="<?php echo set_value('hrecrelationship', isset($studentHealthRecord['ecrelationship']) ? $studentHealthRecord['ecrelationship'] : ''); ?>"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12" >
                                    <div class="teacher_profile_group" >
                                        <div class="teacher_profile_label" style="border-top: 1px solid lightgrey;"><h4><b>Vaccination</b></h4>Has she/he had the following vaccinations?</div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Hepatitis B</div>
                                        <div class="teacher_profile_value" style="padding: 0">
                                            <select class="form-control set-margin-bottom" name="vchepatitisb">
                                                <option value='1' >Yes</option>
                                                <option value='0' >No</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Year</div>
                                        <div class="teacher_profile_value" style="padding: 0">
                                            <select class="form-control set-margin-bottom" name="vchepatitisbyear">
                                                <option value='0' >No</option>
                                                <?php
                                                for($i=0;$i<25;$i++) {?>
                                                <option value='<?php echo date("Y") - $i ?>'><?php echo date("Y") - $i ?></option>
<?php                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Measles, Mumps Rubella</div>
                                        <div class="teacher_profile_value" style="padding: 0">
                                            <select class="form-control set-margin-bottom" name="vcmeasles">
                                                <option value='1' >Yes</option>
                                                <option value='0' >No</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Year</div>
                                        <div class="teacher_profile_value" style="padding: 0">
                                            <select class="form-control set-margin-bottom" name="vcmeaslesyear">
                                                <option value='0' >No</option>
                                                <?php
                                                for($i=0;$i<25;$i++) {?>
                                                <option value='<?php echo date("Y") - $i ?>'><?php echo date("Y") - $i ?></option>
<?php                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Polio</div>
                                        <div class="teacher_profile_value" style="padding: 0">
                                            <select class="form-control set-margin-bottom" name="vcpolio">
                                                <option value='1' >Yes</option>
                                                <option value='0' >No</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="teacher_profile_group">
                                    <div class="teacher_profile_label">Year</div>
                                    <div class="teacher_profile_value" style="padding: 0">
                                        <select class="form-control set-margin-bottom" name="vcpolioyear">
                                            <option value='0' >No</option>
                                            <?php
                                            for($i=0;$i<25;$i++) {?>
                                                <option value='<?php echo date("Y") - $i ?>'><?php echo date("Y") - $i ?></option>
                                            <?php                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Tetanus</div>
                                        <div class="teacher_profile_value" style="padding: 0">
                                            <select class="form-control set-margin-bottom" name="vctetanus">
                                                <option value='1' >Yes</option>
                                                <option value='0' >No</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Year</div>
                                        <div class="teacher_profile_value" style="padding: 0">
                                            <select class="form-control set-margin-bottom" name="vctetanusyear">
                                                <option value='0' >No</option>
                                                <?php
                                                for($i=0;$i<25;$i++) {?>
                                                <option value='<?php echo date("Y") - $i ?>'><?php echo date("Y") - $i ?></option>
<?php                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">HiB</div>
                                        <div class="teacher_profile_value" style="padding: 0">
                                            <select class="form-control set-margin-bottom" name="vchib">
                                                <option value='1' >Yes</option>
                                                <option value='0' >No</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Year</div>
                                        <div class="teacher_profile_value" style="padding: 0">
                                            <select class="form-control set-margin-bottom" name="vchibyear">
                                                <option value='0' >No</option>
                                                <?php
                                                for($i=0;$i<25;$i++) {?>
                                                <option value='<?php echo date("Y") - $i ?>'><?php echo date("Y") - $i ?></option>
<?php                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">MenzB</div>
                                        <div class="teacher_profile_value" style="padding: 0">
                                            <select class="form-control set-margin-bottom" name="vcmenzb">
                                                <option value='1' >Yes</option>
                                                <option value='0' >No</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Year</div>
                                        <div class="teacher_profile_value" style="padding: 0">
                                            <select class="form-control set-margin-bottom" name="vcmenzbyear">
                                                <option value='0' >No</option>
                                                <?php
                                                for($i=0;$i<25;$i++) {?>
                                                <option value='<?php echo date("Y") - $i ?>'><?php echo date("Y") - $i ?></option>
<?php                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">T.B</div>
                                        <div class="teacher_profile_value" style="padding: 0">
                                            <select class="form-control set-margin-bottom" name="vctb">
                                                <option value='1' >Yes</option>
                                                <option value='0' >No</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Year</div>
                                        <div class="teacher_profile_value" style="padding: 0">
                                            <select class="form-control set-margin-bottom" name="vctbyear">
                                                <option value='0' >No</option>
                                                <?php
                                                for($i=0;$i<25;$i++) {?>
                                                <option value='<?php echo date("Y") - $i ?>'><?php echo date("Y") - $i ?></option>
<?php                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12" >
                                    <div class="teacher_profile_group" >
                                        <div class="teacher_profile_label" style="border-top: 1px solid lightgrey;"><h4><b>Medical Problem</b></h4>Has this student ever suffered from: </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <?php
                                        $hprob = array("Asthma", "Diabetes", "Allergy", "ADHD/ADD", "Epilepsy", "Past head injury", "Rheumatic fever", "Hepatitis B");
                                        $i = 1;
                                        for ($i=1;$i<9;$i++) {
                                            ?>
                                            <div>

                                                <input type="hidden" name="mp<?php echo $i?>problem" value="<?php echo $hprob[$i-1]?>"/>
                                                <div class="col-sm-1 col-md-1 col-xs-1"><?php echo $i ?></div>
                                                <div class="col-sm-5 col-md-5 col-xs-5">Medical problem
                                                    : <?php echo $hprob[$i-1] ?></div>
                                                <div class="col-sm-6 col-md-6 col-xs-12">
                                                    <select class="form-control set-margin-bottom" name="mp<?php echo $i ?>">
                                                        <option value='1' >Yes</option>
                                                        <option value='0' >No</option>
                                                    </select>
                                                    <!--<select class="form-control set-margin-bottom" name="mp<?php /*echo strtolower(str_replace(' ', '', $problem['healthproblem'])) */ ?>">
                                                        <option selected
                                                                value="<?php /*echo $problem['status']; */ ?>"><?php /*if ($problem['status'] == 0) {
                                                                echo "No";
                                                            } else {
                                                                echo "Yes";
                                                            } */ ?></option>
                                                        <?php /*if ($problem['status'] != 1):
                                                            echo "<option value='1' >Yes</option>";
                                                        endif;
                                                        if ($problem['status'] != 0):
                                                            echo "<option value='0' >No</option>";
                                                        endif;
                                                        */ ?>
                                                    </select>-->
                                                </div>
                                                <div class="col-sm-1 col-md-1 col-xs-1"></div>
                                                <div class="col-sm-5 col-md-5 col-xs-5">Severity</div>
                                                <div class="col-sm-6 col-md-6 col-xs-12">
                                                    <select class="form-control set-margin-bottom" name="mp<?php echo $i ?>severity">
                                                        <option value='0'>None</option>
                                                        <option value='1'>Mid</option>
                                                        <option value='2'>Moderate</option>
                                                        <option value='3'>Severe</option>
                                                    </select>
                                                </div>
                                                <div class="col-sm-1 col-md-1 col-xs-1"></div>
                                                <div class="col-sm-5 col-md-5 col-xs-5">Medication</div>
                                                <div class="col-sm-6 col-md-6 col-xs-12">
                                                    <input type="text"
                                                           class="form-control set-margin-bottom"
                                                           name="mp<?php echo $i ?>medication"
                                                           value="<?php echo set_value('mp'.$i.'medication', isset($problem['medication']) ? $problem['medication'] : ''); ?>"/>
                                                </div>
                                                <div class="col-sm-1 col-md-1 col-xs-1"></div>
                                                <div class="col-sm-5 col-md-5 col-xs-5">Action Plan</div>
                                                <div class="col-sm-6 col-md-6 col-xs-12">
                                                    <input type="text"
                                                           class="form-control set-margin-bottom"
                                                           name="mp<?php echo $i ?>action"
                                                           value="<?php echo set_value('mp'.$i.'action', isset($problem['action']) ? $problem['action'] : ''); ?>"/>
                                                </div>
                                            </div>
                                        <?php
                                        }
                                        ?>
                                        <div>
                                            <input type="hidden" name="mp9" value="1"/>
                                                <div class="col-sm-1 col-md-1 col-xs-1"><?php echo $i ?></div>
                                                <div class="col-sm-5 col-md-5 col-xs-5">Medical problem</div>
                                                <div class="col-sm-6 col-md-6 col-xs-12">
                                                    <input type="text" class="form-control set-margin-bottom"
                                                           name="mp<?php echo $i ?>problem"
                                                           value="<?php echo set_value('mp'.$i.'problem', isset($probother['healthproblem']) ? $probother['healthproblem'] : 'None'); ?>"/>
                                                </div>
                                                <div class="col-sm-1 col-md-1 col-xs-1"></div>
                                                <div class="col-sm-5 col-md-5 col-xs-5">Severity</div>
                                                <div class="col-sm-6 col-md-6 col-xs-12">
                                                    <select class="form-control set-margin-bottom"
                                                            name="mp9severity">
                                                        <option value='0'>None</option>
                                                        <option value='1'>Mid</option>
                                                        <option value='2'>Moderate</option>
                                                        <option value='3'>Severe</option>
                                                    </select>
                                                </div>
                                                <div class="col-sm-1 col-md-1 col-xs-1"></div>
                                                <div class="col-sm-5 col-md-5 col-xs-5">Medication</div>
                                                <div class="col-sm-6 col-md-6 col-xs-12">
                                                    <input type="text" class="form-control set-margin-bottom"
                                                           name="mp9medication"
                                                           value="<?php echo set_value('mp9medication', isset($probother['medication']) ? $probother['medication'] : ''); ?>"/>
                                                </div>
                                                <div class="col-sm-1 col-md-1 col-xs-1"></div>
                                                <div class="col-sm-5 col-md-5 col-xs-5">Action Plan</div>
                                                <div class="col-sm-6 col-md-6 col-xs-12">
                                                    <input type="text" class="form-control set-margin-bottom"
                                                           name="mp9action"
                                                           value="<?php echo set_value('mp9action', isset($probother['action']) ? $probother['action'] : ''); ?>"/>
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
        <?php echo form_close(); ?>
    </div>
</div>
<!-- /page content -->
