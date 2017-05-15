<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Edit Student Information</h3>
            </div>
        </div>

        <div class="clearfix"></div>
        <?php if ($this->nativesession->get('success')): ?>
            <div  class="alert alert-success">
                <?php echo $this->nativesession->get('success'); $this->nativesession->delete('success');?>
            </div>
        <?php endif; ?>
        <?php
        $encrypted = $this->general->encryptParaID($student['studentid'],'student');
        ?>
        <?php echo form_open_multipart("admin/editStudent/".$encrypted); ?>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <div class="col-md-12 col-sm-12 col-xs-12 profile_left">
                            <div class="profile_img">
                                <div class="teacher_profile_crop">
                                    <!-- Current avatar -->
                                    <img class="img-responsive avatar-view teacher_profile_img" src="<?php echo base_url() ?>assets/img/student/<?php echo $student['photo']?>" alt="Avatar" title="Change the avatar">
                                </div>
                            </div>
                            <input class="btn btn-success set-margin-bottom set-margin-top" type="file" name="photo" />

                            <ul class="list-unstyled user_data">
                                <li>
                                    <i class="fa fa-briefcase user-profile-icon"></i> <?php echo $student['studentid']; ?>
                                </li>
                            </ul>

                            <button type="submit" class="btn btn-success set-right"><i class="fa fa-save m-right-xs"></i> Save Changes</button>
                            <br />

                        </div>
                        <input type="hidden" class="form-control set-margin-bottom" name="studentid" value="<?php echo $student['studentid']; ?>"/>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="profile_title">
                                <div class="col-md-12">
                                    <h2>Personal Information</h2>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-6 col-sm-6 col-xs-12">
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
                                </div>
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
                                                <option value='Female' <?php if(strcmp($student['gender'],'Female')) ?> >Female</option>";
                                                <option value='Male' >Male</option>";
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
                                                <option selected value="<?php echo $student['religion']; ?>"><?php echo $student['religion'] ?></option>
                                                <?php if(strcmp($student['religion'],'Buddhist')!=0):
                                                    echo "<option value='Buddhist' >Buddhist</option>";
                                                endif;
                                                ?>
                                                <?php if(strcmp($student['religion'],'Christian')!=0):
                                                    echo "<option value='Christian' >Christian</option>";
                                                endif;
                                                ?>
                                                <?php if(strcmp($student['religion'],'Hindu')!=0):
                                                    echo "<option value='Hindu' >Hindu</option>";
                                                endif;
                                                ?>
                                                <?php if(strcmp($student['religion'],'Muslim')!=0):
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
                                    </div>
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
                                                <?php if(strcmp($student['idcardtype'],'KTP')!=0):
                                                    echo "<option value='KTP' >KTP</option>";
                                                endif;
                                                ?>
                                                <?php if(strcmp($student['idcardtype'],'Passport')!=0):
                                                    echo "<option value='Passport' >Passport</option>";
                                                endif;
                                                ?>
                                                <?php if(strcmp($student['idcardtype'],'KITAS')!=0):
                                                    echo "<KITAS value='KITAS' >Hindu</KITAS>";
                                                endif;
                                                ?>
                                            </select>
                                            <!--                                            <input type="text" class="form-control set-margin-bottom" name="religion" value="--><?php //echo set_value('religion', isset($info_db['religion']) ? $info_db['religion'] : ''); ?><!--"/>-->
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Address</div>
                                        <div class="teacher_profile_value">
                                            <textarea class="form-control set-margin-bottom" name="address"><?php echo isset($student['address']) ? $student['address'] : ''; ?></textarea>
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
                                        <div class="teacher_profile_label"><b>Contact Detail for the Most Recent School Attended</b></div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">School Name</div>
                                        <div class="teacher_profile_value">
                                            <input type="text" class="form-control" name="rcname" value="<?php echo set_value('rcname', isset($student['name']) ? $student['name'] : ''); ?>"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Contact Person</div>
                                        <div class="teacher_profile_value">
                                            <input type="text" class="form-control" name="rccontact" value="<?php echo set_value('rccontact', isset($student['elementary']) ? $student['elementary'] : ''); ?>"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Position</div>
                                        <div class="teacher_profile_value">
                                            <input type="text" class="form-control" name="rcposition" value="<?php echo set_value('rcposition', isset($student['elementary']) ? $student['elementary'] : ''); ?>"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Email</div>
                                        <div class="teacher_profile_value">
                                            <input type="text" class="form-control" name="rcemail" value="<?php echo set_value('rcemail', isset($student['elementary']) ? $student['elementary'] : ''); ?>"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Phone</div>
                                        <div class="teacher_profile_value">
                                            <input type="text" class="form-control" name="rcphone" value="<?php echo set_value('rcphone ', isset($student['elementary']) ? $student['elementary'] : ''); ?>"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Why is your child leaving his/her current educational setting?</div>
                                        <div class="teacher_profile_value">
                                            <textarea class="form-control set-margin-bottom" name="rcreason"><?php echo isset($student['rcreason']) ? $student['rcreason'] : ''; ?></textarea>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-12">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_value">
                                            <table class="teacher_course_implementation">
                                                <thead>
                                                <tr>
                                                    <th width="25%">School Name</th>
                                                    <th width="15%">Country</th>
                                                    <th width="15%">Start Date</th>
                                                    <th width="15%">End Date</th>
                                                    <th width="15%">Highest Grade Completed</th>
                                                    <th width="15%">Language of Istruction</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php
                                                /* if($plans){
                                                     foreach($plans as $plan){ */?><!--
                                            <tr>
                                                <input type="hidden" class="form-control set-margin-bottom" name="semesterido[]" value="<?php /*echo $plan['semesterid']; */?>"/>
                                                <td><input type="text" class="form-control set-margin-bottom set-margin-top" name="weeko[]" value="<?php /*echo set_value('week', isset($plan['week']) ? $plan['week'] : 'ex: 1,2,3-4'); */?>"/></td>
                                                <td><textarea class="form-control set-margin-bottom" name="topico[]" rows="3"><?php /*echo isset($plan['topic']) ? $plan['topic'] : ''; */?></textarea></td>
                                                <td><textarea class="form-control set-margin-bottom" name="outcomeo[]" rows="3"><?php /*echo isset($plan['outcome']) ? $plan['outcome'] : ''; */?></textarea></td>
                                                <td><textarea class="form-control set-margin-bottom" name="assessmento[]" rows="3"><?php /*echo isset($plan['assessment']) ? $plan['assessment'] : ''; */?></textarea></td>
                                                <td><textarea class="form-control set-margin-bottom" name="resourceo[]" rows="3"><?php /*echo isset($plan['resources']) ? $plan['resources'] : ''; */?></textarea></td>
                                            </tr>
                                        <?php /*}}
                                    else {*/?>
                                        <tr>
                                            <td colspan="5"><?php /*echo 'no lesson plan found' */?></td>
                                        </tr>
                                    --><?php /*} */?>
                                                <tr class="toAdd">
                                                    <td><input type="text" class="form-control set-margin-bottom set-margin-top" name="sname[]"/></td>
                                                    <td><input class="form-control set-margin-bottom" name="scountry[]" type="text"></input></td>
                                                    <td><input class="form-control set-margin-bottom" name="sstart[]" id="pick-date"></input></td>
                                                    <td><input class="form-control set-margin-bottom" name="send[]" id="pick-date"></input></td>
                                                    <td><input class="form-control set-margin-bottom" name="sgrade[]" type="text"></input></td>
                                                    <td><input class="form-control set-margin-bottom" name="slanguage[]" type="text"></input></td>
                                                </tr>
                                                <tr class="toAdd">
                                                    <td><input type="text" class="form-control set-margin-bottom set-margin-top" name="sname[]"/></td>
                                                    <td><input class="form-control set-margin-bottom" name="scountry[]" type="text"></input></td>
                                                    <td><input class="form-control set-margin-bottom" name="sstart[]" id="pick-date"></input></td>
                                                    <td><input class="form-control set-margin-bottom" name="send[]" id="pick-date"></input></td>
                                                    <td><input class="form-control set-margin-bottom" name="sgrade[]" type="text"></input></td>
                                                    <td><input class="form-control set-margin-bottom" name="slanguage[]" type="text"></input></td>
                                                </tr>
                                                <tr class="toAdd">
                                                    <td><input type="text" class="form-control set-margin-bottom set-margin-top" name="sname[]"/></td>
                                                    <td><input class="form-control set-margin-bottom" name="scountry[]" type="text"></input></td>
                                                    <td><input class="form-control set-margin-bottom" name="sstart[]" id="pick-date"></input></td>
                                                    <td><input class="form-control set-margin-bottom" name="send[]" id="pick-date"></input></td>
                                                    <td><input class="form-control set-margin-bottom" name="sgrade[]" type="text"></input></td>
                                                    <td><input class="form-control set-margin-bottom" name="slanguage[]" type="text"></input></td>
                                                </tr>
                                                <tr class="toAdd">
                                                    <td><input type="text" class="form-control set-margin-bottom set-margin-top" name="sname[]"/></td>
                                                    <td><input class="form-control set-margin-bottom" name="scountry[]" type="text"></input></td>
                                                    <td><input class="form-control set-margin-bottom" name="sstart[]" id="pick-date"></input></td>
                                                    <td><input class="form-control set-margin-bottom" name="send[]" id="pick-date"></input></td>
                                                    <td><input class="form-control set-margin-bottom" name="sgrade[]" type="text"></input></td>
                                                    <td><input class="form-control set-margin-bottom" name="slanguage[]" type="text"></input></td>
                                                </tr>
                                                <tr class="toAdd">
                                                    <td><input type="text" class="form-control set-margin-bottom set-margin-top" name="sname[]"/></td>
                                                    <td><input class="form-control set-margin-bottom" name="scountry[]" type="text"></input></td>
                                                    <td><input class="form-control set-margin-bottom" name="sstart[]" id="pick-date"></input></td>
                                                    <td><input class="form-control set-margin-bottom" name="send[]" id="pick-date"></input></td>
                                                    <td><input class="form-control set-margin-bottom" name="sgrade[]" type="text"></input></td>
                                                    <td><input class="form-control set-margin-bottom" name="slanguage[]" type="text"></input></td>
                                                </tr>
                                                <tr class="toAdd">
                                                    <td><input type="text" class="form-control set-margin-bottom set-margin-top" name="sname[]"/></td>
                                                    <td><input class="form-control set-margin-bottom" name="scountry[]" type="text"></input></td>
                                                    <td><input class="form-control set-margin-bottom" name="sstart[]" id="pick-date"></input></td>
                                                    <td><input class="form-control set-margin-bottom" name="send[]" id="pick-date"></input></td>
                                                    <td><input class="form-control set-margin-bottom" name="sgrade[]" type="text"></input></td>
                                                    <td><input class="form-control set-margin-bottom" name="slanguage[]" type="text"></input></td>
                                                </tr>
                                                <tr class="toAdd">
                                                    <td><input type="text" class="form-control set-margin-bottom set-margin-top" name="sname[]"/></td>
                                                    <td><input class="form-control set-margin-bottom" name="scountry[]" type="text"></input></td>
                                                    <td><input class="form-control set-margin-bottom" name="sstart[]" id="pick-date"></input></td>
                                                    <td><input class="form-control set-margin-bottom" name="send[]" id="pick-date"></input></td>
                                                    <td><input class="form-control set-margin-bottom" name="sgrade[]" type="text"></input></td>
                                                    <td><input class="form-control set-margin-bottom" name="slanguage[]" type="text"></input></td>
                                                </tr>
                                                <tr class="toAdd">
                                                    <td><input type="text" class="form-control set-margin-bottom set-margin-top" name="sname[]"/></td>
                                                    <td><input class="form-control set-margin-bottom" name="scountry[]" type="text"></input></td>
                                                    <td><input class="form-control set-margin-bottom" name="sstart[]" id="pick-date"></input></td>
                                                    <td><input class="form-control set-margin-bottom" name="send[]" id="pick-date"></input></td>
                                                    <td><input class="form-control set-margin-bottom" name="sgrade[]" type="text"></input></td>
                                                    <td><input class="form-control set-margin-bottom" name="slanguage[]" type="text"></input></td>
                                                </tr>
                                                <tr class="toAdd">
                                                    <td><input type="text" class="form-control set-margin-bottom set-margin-top" name="sname[]"/></td>
                                                    <td><input class="form-control set-margin-bottom" name="scountry[]" type="text"></input></td>
                                                    <td><input class="form-control set-margin-bottom" name="sstart[]" id="pick-date"></input></td>
                                                    <td><input class="form-control set-margin-bottom" name="send[]" id="pick-date"></input></td>
                                                    <td><input class="form-control set-margin-bottom" name="sgrade[]" type="text"></input></td>
                                                    <td><input class="form-control set-margin-bottom" name="slanguage[]" type="text"></input></td>
                                                </tr>
                                                <tr class="toAdd">
                                                    <td><input type="text" class="form-control set-margin-bottom set-margin-top" name="sname[]"/></td>
                                                    <td><input class="form-control set-margin-bottom" name="scountry[]" type="text"></input></td>
                                                    <td><input class="form-control set-margin-bottom" name="sstart[]" id="pick-date"></input></td>
                                                    <td><input class="form-control set-margin-bottom" name="send[]" id="pick-date"></input></td>
                                                    <td><input class="form-control set-margin-bottom" name="sgrade[]" type="text"></input></td>
                                                    <td><input class="form-control set-margin-bottom" name="slanguage[]" type="text"></input></td>
                                                </tr>
                                                <tr class="toAdd">
                                                    <td><input type="text" class="form-control set-margin-bottom set-margin-top" name="sname[]"/></td>
                                                    <td><input class="form-control set-margin-bottom" name="scountry[]" type="text"></input></td>
                                                    <td><input class="form-control set-margin-bottom" name="sstart[]" id="pick-date"></input></td>
                                                    <td><input class="form-control set-margin-bottom" name="send[]" id="pick-date"></input></td>
                                                    <td><input class="form-control set-margin-bottom" name="sgrade[]" type="text"></input></td>
                                                    <td><input class="form-control set-margin-bottom" name="slanguage[]" type="text"></input></td>
                                                </tr>
                                                <tr class="toAdd">
                                                    <td><input type="text" class="form-control set-margin-bottom set-margin-top" name="sname[]"/></td>
                                                    <td><input class="form-control set-margin-bottom" name="scountry[]" type="text"></input></td>
                                                    <td><input class="form-control set-margin-bottom" name="sstart[]" id="pick-date"></input></td>
                                                    <td><input class="form-control set-margin-bottom" name="send[]" id="pick-date"></input></td>
                                                    <td><input class="form-control set-margin-bottom" name="sgrade[]" type="text"></input></td>
                                                    <td><input class="form-control set-margin-bottom" name="slanguage[]" type="text"></input></td>
                                                </tr>
                                                <tr class="toAdd">
                                                    <td><input type="text" class="form-control set-margin-bottom set-margin-top" name="sname[]"/></td>
                                                    <td><input class="form-control set-margin-bottom" name="scountry[]" type="text"></input></td>
                                                    <td><input class="form-control set-margin-bottom" name="sstart[]" id="pick-date"></input></td>
                                                    <td><input class="form-control set-margin-bottom" name="send[]" id="pick-date"></input></td>
                                                    <td><input class="form-control set-margin-bottom" name="sgrade[]" type="text"></input></td>
                                                    <td><input class="form-control set-margin-bottom" name="slanguage[]" type="text"></input></td>
                                                </tr>
                                                <tr class="toAdd">
                                                    <td><input type="text" class="form-control set-margin-bottom set-margin-top" name="sname[]"/></td>
                                                    <td><input class="form-control set-margin-bottom" name="scountry[]" type="text"></input></td>
                                                    <td><input class="form-control set-margin-bottom" name="sstart[]" id="pick-date"></input></td>
                                                    <td><input class="form-control set-margin-bottom" name="send[]" id="pick-date"></input></td>
                                                    <td><input class="form-control set-margin-bottom" name="sgrade[]" type="text"></input></td>
                                                    <td><input class="form-control set-margin-bottom" name="slanguage[]" type="text"></input></td>
                                                </tr>
                                                <tr class="toAdd">
                                                    <td><input type="text" class="form-control set-margin-bottom set-margin-top" name="sname[]"/></td>
                                                    <td><input class="form-control set-margin-bottom" name="scountry[]" type="text"></input></td>
                                                    <td><input class="form-control set-margin-bottom" name="sstart[]" id="pick-date"></input></td>
                                                    <td><input class="form-control set-margin-bottom" name="send[]" id="pick-date"></input></td>
                                                    <td><input class="form-control set-margin-bottom" name="sgrade[]" type="text"></input></td>
                                                    <td><input class="form-control set-margin-bottom" name="slanguage[]" type="text"></input></td>
                                                </tr>
                                                <tr class="toAdd">
                                                    <td><input type="text" class="form-control set-margin-bottom set-margin-top" name="sname[]"/></td>
                                                    <td><input class="form-control set-margin-bottom" name="scountry[]" type="text"></input></td>
                                                    <td><input class="form-control set-margin-bottom" name="sstart[]" id="pick-date"></input></td>
                                                    <td><input class="form-control set-margin-bottom" name="send[]" id="pick-date"></input></td>
                                                    <td><input class="form-control set-margin-bottom" name="sgrade[]" type="text"></input></td>
                                                    <td><input class="form-control set-margin-bottom" name="slanguage[]" type="text"></input></td>
                                                </tr>
                                                <tr class="toAdd">
                                                    <td><input type="text" class="form-control set-margin-bottom set-margin-top" name="sname[]"/></td>
                                                    <td><input class="form-control set-margin-bottom" name="scountry[]" type="text"></input></td>
                                                    <td><input class="form-control set-margin-bottom" name="sstart[]" id="pick-date"></input></td>
                                                    <td><input class="form-control set-margin-bottom" name="send[]" id="pick-date"></input></td>
                                                    <td><input class="form-control set-margin-bottom" name="sgrade[]" type="text"></input></td>
                                                    <td><input class="form-control set-margin-bottom" name="slanguage[]" type="text"></input></td>
                                                </tr>
                                                <tr class="toAdd">
                                                    <td><input type="text" class="form-control set-margin-bottom set-margin-top" name="sname[]"/></td>
                                                    <td><input class="form-control set-margin-bottom" name="scountry[]" type="text"></input></td>
                                                    <td><input class="form-control set-margin-bottom" name="sstart[]" id="pick-date"></input></td>
                                                    <td><input class="form-control set-margin-bottom" name="send[]" id="pick-date"></input></td>
                                                    <td><input class="form-control set-margin-bottom" name="sgrade[]" type="text"></input></td>
                                                    <td><input class="form-control set-margin-bottom" name="slanguage[]" type="text"></input></td>
                                                </tr>
                                                <tr class="toAdd">
                                                    <td><input type="text" class="form-control set-margin-bottom set-margin-top" name="sname[]"/></td>
                                                    <td><input class="form-control set-margin-bottom" name="scountry[]" type="text"></input></td>
                                                    <td><input class="form-control set-margin-bottom" name="sstart[]" id="pick-date"></input></td>
                                                    <td><input class="form-control set-margin-bottom" name="send[]" id="pick-date"></input></td>
                                                    <td><input class="form-control set-margin-bottom" name="sgrade[]" type="text"></input></td>
                                                    <td><input class="form-control set-margin-bottom" name="slanguage[]" type="text"></input></td>
                                                </tr>
                                                <tr class="toAdd">
                                                    <td><input type="text" class="form-control set-margin-bottom set-margin-top" name="sname[]"/></td>
                                                    <td><input class="form-control set-margin-bottom" name="scountry[]" type="text"></input></td>
                                                    <td><input class="form-control set-margin-bottom" name="sstart[]" id="pick-date"></input></td>
                                                    <td><input class="form-control set-margin-bottom" name="send[]" id="pick-date"></input></td>
                                                    <td><input class="form-control set-margin-bottom" name="sgrade[]" type="text"></input></td>
                                                    <td><input class="form-control set-margin-bottom" name="slanguage[]" type="text"></input></td>
                                                </tr>
                                                <tr class="toAdd">
                                                    <td><input type="text" class="form-control set-margin-bottom set-margin-top" name="sname[]"/></td>
                                                    <td><input class="form-control set-margin-bottom" name="scountry[]" type="text"></input></td>
                                                    <td><input class="form-control set-margin-bottom" name="sstart[]" id="pick-date"></input></td>
                                                    <td><input class="form-control set-margin-bottom" name="send[]" id="pick-date"></input></td>
                                                    <td><input class="form-control set-margin-bottom" name="sgrade[]" type="text"></input></td>
                                                    <td><input class="form-control set-margin-bottom" name="slanguage[]" type="text"></input></td>
                                                </tr>
                                                <tr class="toAdd">
                                                    <td><input type="text" class="form-control set-margin-bottom set-margin-top" name="sname[]"/></td>
                                                    <td><input class="form-control set-margin-bottom" name="scountry[]" type="text"></input></td>
                                                    <td><input class="form-control set-margin-bottom" name="sstart[]" id="pick-date"></input></td>
                                                    <td><input class="form-control set-margin-bottom" name="send[]" id="pick-date"></input></td>
                                                    <td><input class="form-control set-margin-bottom" name="sgrade[]" type="text"></input></td>
                                                    <td><input class="form-control set-margin-bottom" name="slanguage[]" type="text"></input></td>
                                                </tr>
                                                <tr class="toAdd">
                                                    <td><input type="text" class="form-control set-margin-bottom set-margin-top" name="sname[]"/></td>
                                                    <td><input class="form-control set-margin-bottom" name="scountry[]" type="text"></input></td>
                                                    <td><input class="form-control set-margin-bottom" name="sstart[]" id="pick-date"></input></td>
                                                    <td><input class="form-control set-margin-bottom" name="send[]" id="pick-date"></input></td>
                                                    <td><input class="form-control set-margin-bottom" name="sgrade[]" type="text"></input></td>
                                                    <td><input class="form-control set-margin-bottom" name="slanguage[]" type="text"></input></td>
                                                </tr>
                                                <tr class="toAdd">
                                                    <td><input type="text" class="form-control set-margin-bottom set-margin-top" name="sname[]"/></td>
                                                    <td><input class="form-control set-margin-bottom" name="scountry[]" type="text"></input></td>
                                                    <td><input class="form-control set-margin-bottom" name="sstart[]" id="pick-date"></input></td>
                                                    <td><input class="form-control set-margin-bottom" name="send[]" id="pick-date"></input></td>
                                                    <td><input class="form-control set-margin-bottom" name="sgrade[]" type="text"></input></td>
                                                    <td><input class="form-control set-margin-bottom" name="slanguage[]" type="text"></input></td>
                                                </tr>
                                                <tr class="toAdd">
                                                    <td><input type="text" class="form-control set-margin-bottom set-margin-top" name="sname[]"/></td>
                                                    <td><input class="form-control set-margin-bottom" name="scountry[]" type="text"></input></td>
                                                    <td><input class="form-control set-margin-bottom" name="sstart[]" id="pick-date"></input></td>
                                                    <td><input class="form-control set-margin-bottom" name="send[]" id="pick-date"></input></td>
                                                    <td><input class="form-control set-margin-bottom" name="sgrade[]" type="text"></input></td>
                                                    <td><input class="form-control set-margin-bottom" name="slanguage[]" type="text"></input></td>
                                                </tr>
                                                <a class="btn btn-success set-right addPlan"><i class="fa fa-plus m-right-xs"></i> Add Educational Detail</a>
                                                <a class="btn btn-error set-right removePlan"><i class="fa fa-minus m-right-xs"></i> Add Educational Detail</a>
                                                </tbody>
                                            </table>
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
                                        <div class="teacher_profile_value col-sm-6 col-md-6 col-xs-12" style="padding: 0">
                                            <select class="form-control set-margin-bottom" name="hrallegies">
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
                                            <textarea class="form-control set-margin-bottom" name="hrallegiesdetail"><?php echo isset($student['rcreason']) ? $student['rcreason'] : ''; ?></textarea>
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
                                            <textarea class="form-control set-margin-bottom" name="hrmedicationdetail"><?php echo isset($student['rcreason']) ? $student['rcreason'] : ''; ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Has your child had any psychological assessment/treatment?</div>
                                        <div class="teacher_profile_value col-sm-6 col-md-6" style="padding: 0">
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
                                            <textarea class="form-control set-margin-bottom" name="hrpsychologicalAssessmentdetail"><?php echo isset($student['rcreason']) ? $student['rcreason'] : ''; ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Does your child have any hearig or speech difficulty?</div>
                                        <div class="teacher_profile_value col-sm-6 col-md-6" style="padding: 0">
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
                                            <textarea class="form-control set-margin-bottom" name="hrhearingSpeechDifficultydetail"><?php echo isset($student['rcreason']) ? $student['rcreason'] : ''; ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Does your child have any behavioural difficulty?</div>
                                        <div class="teacher_profile_value col-sm-6 col-md-6" style="padding: 0">
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
                                            <textarea class="form-control set-margin-bottom" name="hrbehaviouralDifficultydetail"><?php echo isset($student['rcreason']) ? $student['rcreason'] : ''; ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Others (please specify)</div>
                                        <div class="teacher_profile_value">
                                                <textarea class="form-control set-margin-bottom" name="hrother"><?php echo isset($student['rcreason']) ? $student['rcreason'] : ''; ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Please include any other comments/information that will enable teachers to understand your child/ward better</div>
                                        <div class="teacher_profile_value">
                                            <textarea class="form-control set-margin-bottom" name="hrotherinformation"><?php echo isset($student['rcreason']) ? $student['rcreason'] : ''; ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label"><h4><b>General Health</b></h4>Are there any issues we should be aware of relating to your chid?</div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Eyesight</div>
                                        <div class="teacher_profile_value col-sm-6 col-md-6" style="padding: 0">
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
                                        <div class="teacher_profile_value col-sm-6 col-md-6" style="padding: 0">
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
                                        <div class="teacher_profile_value col-sm-6 col-md-6" style="padding: 0">
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
                                        <div class="teacher_profile_value col-sm-6 col-md-6" style="padding: 0">
                                            <input type="text" class="form-control" name="hr" value="<?php echo set_value('rcphone ', isset($student['elementary']) ? $student['elementary'] : ''); ?>"/>
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