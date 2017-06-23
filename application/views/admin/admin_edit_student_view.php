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
        <?php
        $encrypted = $this->general->encryptParaID($student['studentid'],'student');
        ?>
        <?php echo form_open_multipart("admin/editStudent/".$encrypted); ?>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">

                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="col-md-5 col-sm-12 col-xs-12 profile_left">
                                <div class="profile_img">
                                    <div class="teacher_profile_crop">
                                        <!-- Current avatar -->
                                    <img class="img-responsive avatar-view teacher_profile_img" src="<?php echo base_url() ?>assets/img/student/<?php echo $student['photo']?>" alt="Avatar" title="Change the avatar">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-7 col-sm-12 col-xs-12">
                                <h3><?php echo $student['firstname'].' '.$student['lastname'] ?> </h3>

                                <ul class="list-unstyled user_data">
                                    <li>
                                        ID&emsp;&emsp;: <?php echo $student['studentid']; ?>
                                    </li>

                                </ul>
                            </div>
                            <div class="clearfix"></div>

                            <?php
                            $encrypted = $this->general->encryptParaID($student['studentid'],'student');
                            ?>

                        </div>

                        <input class="btn btn-success set-margin-bottom set-margin-top" type="file" name="photo" />

                        <button type="submit" class="btn btn-success set-right"><i class="fa fa-save m-right-xs"></i> Save Changes</button>
                        <a href="<?php echo base_url() ?>index.php/admin/studentEducational/<?php echo $encrypted?>" class="btn btn-success set-right"><i class="fa fa-home m-right-xs"></i> Educational Information</a>
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
                                                <option selected value="<?php echo $student['gender']; ?>"><?php echo $student['gender'] ?></option>
                                                <?php if(strcmp($student['gender'],'Female')!=0):
                                                    echo "<option value='Female' >Female</option>";
                                                endif;
                                                ?>
                                                <?php if(strcmp($student['gender'],'Male')!=0):
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
                                                <option selected value="<?php echo $student['idcardtype']; ?>"><?php echo $student['idcardtype'] ?></option>
                                                <?php if(strcmp($student['idcardtype'],'KTP')!=0):
                                                    echo "<option value='KTP' >KTP</option>";
                                                endif;
                                                if(strcmp($student['idcardtype'],'Passport')!=0):
                                                    echo "<option value='Passport' >Passport</option>";
                                                endif;
                                                if(strcmp($student['idcardtype'],'KITAS')!=0):
                                                    echo "<option value='KITAS' >KITAS</option>";
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
                                        <div class="teacher_profile_label">Why is your child leaving his/her current educational school?</div>
                                        <div class="teacher_profile_value">
                                            <textarea class="form-control set-margin-bottom" name="rcreason"><?php echo isset($studentRecentSchool['reason']) ? $studentRecentSchool['reason'] : ''; ?></textarea>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <!--<div class="col-md-12 col-sm-12 col-sm-xs-12">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <a class="btn btn-danger set-right removePlan"><i class="fa fa-minus m-right-xs"></i> Remove Educational Detail</a>
                                    <a class="btn btn-success set-right addPlan"><i class="fa fa-plus m-right-xs"></i> Add Educational Detail</a>
                                    <div class="teacher_profile_group toAdd" style="margin-bottom: 2vw ">
                                        <div class="teacher_profile_value ">
                                            <div class="teacher_profile_label"><h4><b>Previous School Detail</b></h4></div>
                                            <table class="teacher_course_implementation" style="border-bottom: 1px solid lightgrey; border-top: 1px solid lightgrey">
                                                <tr>
                                                    <td><div class="teacher_profile_label">School Name</div></td>
                                                    <td><input type="text" class="form-control set-margin-bottom set-margin-top" name="sname[]"/></td>
                                                </tr>
                                                <tr>
                                                    <td><div class="teacher_profile_label">Country</div></td>
                                                    <td><input class="form-control set-margin-bottom" name="scountry[]" type="text"></input></td>
                                                </tr>
                                                <tr>
                                                    <td><div class="teacher_profile_label">Start Date</div></td>
                                                    <td><input class="form-control set-margin-bottom" name="sstart[]" id="pick-date"></input></td>
                                                </tr>
                                                <tr>
                                                    <td><div class="teacher_profile_label">End Date</div></td>
                                                    <td><input class="form-control set-margin-bottom" name="send[]" id="pick-date"></input></td>
                                                </tr>
                                                <tr>
                                                    <td><div class="teacher_profile_label">Highest Grade Completed</div></td>
                                                    <td><input class="form-control set-margin-bottom" name="sgrade[]" type="text"></input></td>
                                                </tr>
                                                <tr>
                                                    <td><div class="teacher_profile_label">Language of Istruction</div></td>
                                                    <td><input class="form-control set-margin-bottom" name="slanguage[]" type="text"></input></td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="teacher_profile_group toAdd" style="margin-bottom: 2vw ">
                                        <div class="teacher_profile_value ">
                                            <div class="teacher_profile_label"><h4><b>Previous School Detail</b></h4></div>
                                            <table class="teacher_course_implementation" style="border-bottom: 1px solid lightgrey; border-top: 1px solid lightgrey">
                                                <tr>
                                                    <td><div class="teacher_profile_label">School Name</div></td>
                                                    <td><input type="text" class="form-control set-margin-bottom set-margin-top" name="sname[]"/></td>
                                                </tr>
                                                <tr>
                                                    <td><div class="teacher_profile_label">Country</div></td>
                                                    <td><input class="form-control set-margin-bottom" name="scountry[]" type="text"></input></td>
                                                </tr>
                                                <tr>
                                                    <td><div class="teacher_profile_label">Start Date</div></td>
                                                    <td><input class="form-control set-margin-bottom" name="sstart[]" id="pick-date"></input></td>
                                                </tr>
                                                <tr>
                                                    <td><div class="teacher_profile_label">End Date</div></td>
                                                    <td><input class="form-control set-margin-bottom" name="send[]" id="pick-date"></input></td>
                                                </tr>
                                                <tr>
                                                    <td><div class="teacher_profile_label">Highest Grade Completed</div></td>
                                                    <td><input class="form-control set-margin-bottom" name="sgrade[]" type="text"></input></td>
                                                </tr>
                                                <tr>
                                                    <td><div class="teacher_profile_label">Language of Istruction</div></td>
                                                    <td><input class="form-control set-margin-bottom" name="slanguage[]" type="text"></input></td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="teacher_profile_group toAdd" style="margin-bottom: 2vw ">
                                        <div class="teacher_profile_value ">
                                            <div class="teacher_profile_label"><h4><b>Previous School Detail</b></h4></div>
                                            <table class="teacher_course_implementation" style="border-bottom: 1px solid lightgrey; border-top: 1px solid lightgrey">
                                                <tr>
                                                    <td><div class="teacher_profile_label">School Name</div></td>
                                                    <td><input type="text" class="form-control set-margin-bottom set-margin-top" name="sname[]"/></td>
                                                </tr>
                                                <tr>
                                                    <td><div class="teacher_profile_label">Country</div></td>
                                                    <td><input class="form-control set-margin-bottom" name="scountry[]" type="text"></input></td>
                                                </tr>
                                                <tr>
                                                    <td><div class="teacher_profile_label">Start Date</div></td>
                                                    <td><input class="form-control set-margin-bottom" name="sstart[]" id="pick-date"></input></td>
                                                </tr>
                                                <tr>
                                                    <td><div class="teacher_profile_label">End Date</div></td>
                                                    <td><input class="form-control set-margin-bottom" name="send[]" id="pick-date"></input></td>
                                                </tr>
                                                <tr>
                                                    <td><div class="teacher_profile_label">Highest Grade Completed</div></td>
                                                    <td><input class="form-control set-margin-bottom" name="sgrade[]" type="text"></input></td>
                                                </tr>
                                                <tr>
                                                    <td><div class="teacher_profile_label">Language of Istruction</div></td>
                                                    <td><input class="form-control set-margin-bottom" name="slanguage[]" type="text"></input></td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="teacher_profile_group toAdd" style="margin-bottom: 2vw ">
                                        <div class="teacher_profile_value ">
                                            <div class="teacher_profile_label"><h4><b>Previous School Detail</b></h4></div>
                                            <table class="teacher_course_implementation" style="border-bottom: 1px solid lightgrey; border-top: 1px solid lightgrey">
                                                <tr>
                                                    <td><div class="teacher_profile_label">School Name</div></td>
                                                    <td><input type="text" class="form-control set-margin-bottom set-margin-top" name="sname[]"/></td>
                                                </tr>
                                                <tr>
                                                    <td><div class="teacher_profile_label">Country</div></td>
                                                    <td><input class="form-control set-margin-bottom" name="scountry[]" type="text"></input></td>
                                                </tr>
                                                <tr>
                                                    <td><div class="teacher_profile_label">Start Date</div></td>
                                                    <td><input class="form-control set-margin-bottom" name="sstart[]" id="pick-date"></input></td>
                                                </tr>
                                                <tr>
                                                    <td><div class="teacher_profile_label">End Date</div></td>
                                                    <td><input class="form-control set-margin-bottom" name="send[]" id="pick-date"></input></td>
                                                </tr>
                                                <tr>
                                                    <td><div class="teacher_profile_label">Highest Grade Completed</div></td>
                                                    <td><input class="form-control set-margin-bottom" name="sgrade[]" type="text"></input></td>
                                                </tr>
                                                <tr>
                                                    <td><div class="teacher_profile_label">Language of Istruction</div></td>
                                                    <td><input class="form-control set-margin-bottom" name="slanguage[]" type="text"></input></td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>

                                </div>
                            </div>-->
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
                                                <option selected value="<?php echo $studentChildDevelopment['learningdifficulties']; ?>"><?php if($studentChildDevelopment['learningdifficulties']==0){echo "No";} else {echo "Yes";} ?></option>

                                                <?php if($studentChildDevelopment['learningdifficulties']!=1):
                                                    echo "<option value='1' >Yes</option>";
                                                endif;
                                                if($studentChildDevelopment['learningdifficulties']!=0):
                                                    echo "<option value='0' >No</option>";
                                                endif;
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Nature of difficulty</div>
                                        <div class="teacher_profile_value">
                                            <textarea class="form-control set-margin-bottom" name="cdlearningdiffnature" placeholder="If no, then fill with 'None'"><?php echo isset($studentChildDevelopment['learningdificultiesdetail']) ? $studentChildDevelopment['learningdificultiesdetail'] : ''; ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Has your child ever benefited from academic support or received remedial help?</div>
                                        <div class="teacher_profile_value col-xs-12 col-sm-6 col-md-6   " style="padding: 0">
                                            <select class="form-control set-margin-bottom" name="cdacademicsuport">
                                                <option selected value="<?php echo $studentChildDevelopment['academicsuport']; ?>"><?php if($studentChildDevelopment['academicsuport']==0){echo "No";} else {echo "Yes";} ?></option>
                                                <?php if($studentChildDevelopment['academicsuport']!=1):
                                                    echo "<option value='1' >Yes</option>";
                                                endif;
                                                if($studentChildDevelopment['academicsuport']!=0):
                                                    echo "<option value='0' >No</option>";
                                                endif;
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Nature of support or remedial help</div>
                                        <div class="teacher_profile_value">

                                            <textarea class="form-control set-margin-bottom" name="cdacademicsuportnature"><?php echo isset($studentChildDevelopment['academicsuportdetail']) ? $studentChildDevelopment['academicsuportdetail'] : ''; ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Has your child/ward ever been assessed as gifted/talented</div>
                                        <div class="teacher_profile_value col-xs-12" style="padding: 0">
                                            <select class="form-control set-margin-bottom" name="cdtalented">
                                                <option selected value="<?php echo $studentChildDevelopment['talented']; ?>"><?php if($studentChildDevelopment['talented']==0){echo "No";} else {echo "Yes";} ?></option>
                                                <?php if($studentChildDevelopment['talented']!=1):
                                                    echo "<option value='1' >Yes</option>";
                                                endif;
                                                if($studentChildDevelopment['talented']!=0):
                                                    echo "<option value='0' >No</option>";
                                                endif;
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">If yes, please provide details</div>
                                        <div class="teacher_profile_value">
                                            <textarea class="form-control set-margin-bottom" name="cdtalenteddetail"><?php echo isset($studentChildDevelopment['talenteddetail']) ? $studentChildDevelopment['talenteddetail'] : ''; ?></textarea>
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
                                                <option selected value="<?php echo $studentChildDevelopment['englishproficiency']; ?>"><?php if($studentChildDevelopment['englishproficiency']==0){echo "Low";}
                                                    elseif($studentChildDevelopment['englishproficiency']==1) {echo "Medium";}
                                                    elseif($studentChildDevelopment['englishproficiency']==2) {echo "High";}
                                                    elseif($studentChildDevelopment['englishproficiency']==3) {echo "Native";}?></option>
                                                <?php if($studentChildDevelopment['englishproficiency']!=0):
                                                    echo "<option value='0' >Low</option>";
                                                endif;
                                                if($studentChildDevelopment['englishproficiency']!=1):
                                                    echo "<option value='1' >Medium</option>";
                                                endif;
                                                if($studentChildDevelopment['englishproficiency']!=2):
                                                    echo "<option value='2' >High</option>";
                                                endif;
                                                if($studentChildDevelopment['englishproficiency']!=3):
                                                    echo "<option value='3' >Native</option>";
                                                endif;
                                                ?>
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
                                                <option selected value="<?php echo $studentChildDevelopment['studiedotherlang']; ?>"><?php if($studentChildDevelopment['studiedotherlang']==0){echo "No";} else {echo "Yes";} ?></option>
                                                <?php if($studentChildDevelopment['studiedotherlang']!=1):
                                                    echo "<option value='1' >Yes</option>";
                                                endif;
                                                if($studentChildDevelopment['studiedotherlang']!=0):
                                                    echo "<option value='0' >No</option>";
                                                endif;
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Has your child experienced any difficulties in acquiring language?</div>
                                        <div class="teacher_profile_value" >
                                            <select class="form-control set-margin-bottom " name="cddifficultvocab">
                                                <option selected value="<?php echo $studentChildDevelopment['difficultvocab']; ?>"><?php if($studentChildDevelopment['difficultvocab']==0){echo "No";} else {echo "Yes";} ?></option>
                                                <?php if($studentChildDevelopment['difficultvocab']!=1):
                                                    echo "<option value='1' >Yes</option>";
                                                endif;
                                                if($studentChildDevelopment['difficultvocab']!=0):
                                                    echo "<option value='0' >No</option>";
                                                endif;
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Does your child receieve additional support with his/her first language?</div>
                                        <div class="teacher_profile_value " >
                                            <select class="form-control set-margin-bottom " name="cdfirstlangSupport">
                                                <option selected value="<?php echo $studentChildDevelopment['firstlangSupport']; ?>"><?php if($studentChildDevelopment['firstlangSupport']==0){echo "No";} else {echo "Yes";} ?></option>
                                                <?php if($studentChildDevelopment['firstlangSupport']!=1):
                                                    echo "<option value='1' >Yes</option>";
                                                endif;
                                                if($studentChildDevelopment['firstlangSupport']!=0):
                                                    echo "<option value='0' >No</option>";
                                                endif;
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">If yes to any of the above, please provide details</div>
                                        <div class="teacher_profile_value " >
                                            <textarea class="form-control set-margin-bottom" name="cdvocabEnglishSupportDetail"><?php echo isset($studentChildDevelopment['vocabEnglishSupportDetail']) ? $studentChildDevelopment['vocabEnglishSupportDetail'] : ''; ?></textarea>
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
                                                    <option selected value="<?php echo $studentHealthRecord['allergies']; ?>"><?php if($studentHealthRecord['allergies']==0){echo "No";} else {echo "Yes";} ?></option>
                                                    <?php if($studentHealthRecord['allergies']!=1):
                                                        echo "<option value='1' >Yes</option>";
                                                    endif;
                                                    if($studentHealthRecord['allergies']!=0):
                                                        echo "<option value='0' >No</option>";
                                                    endif;
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="teacher_profile_group">
                                            <div class="teacher_profile_label">Please state the nature of the condition(s) below</div>
                                            <div class="teacher_profile_value">
                                                <textarea class="form-control set-margin-bottom" name="hrallegiesdetail"><?php echo isset($studentHealthRecord['allergiesdetail']) ? $studentHealthRecord['allergiesdetail'] : ''; ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="teacher_profile_group">
                                            <div class="teacher_profile_label">Does your child/ward require any medication?</div>
                                            <div class="teacher_profile_value">
                                                <select class="form-control set-margin-bottom" name="hrmedication">
                                                    <option selected value="<?php echo $studentHealthRecord['medication']; ?>"><?php if($studentHealthRecord['medication']==0){echo "No";} else {echo "Yes";} ?></option>
                                                    <?php if($studentHealthRecord['medication']!=1):
                                                        echo "<option value='1' >Yes</option>";
                                                    endif;
                                                    if($studentHealthRecord['medication']!=0):
                                                        echo "<option value='0' >No</option>";
                                                    endif;
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="teacher_profile_group">
                                            <div class="teacher_profile_label">Please list the details of the medication below</div>
                                            <div class="teacher_profile_value">
                                                <textarea class="form-control set-margin-bottom" name="hrmedicationdetail"><?php echo isset($studentHealthRecord['medicationdetail']) ? $studentHealthRecord['medicationdetail'] : ''; ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="teacher_profile_group">
                                            <div class="teacher_profile_label">Has your child had any psychological assessment/treatment?</div>
                                            <div class="teacher_profile_value" style="padding: 0">
                                                <select class="form-control set-margin-bottom" name="hrpsychologicalAssessment">
                                                    <option selected value="<?php echo $studentHealthRecord['psychologicalAssessment']; ?>"><?php if($studentHealthRecord['psychologicalAssessment']==0){echo "No";} else {echo "Yes";} ?></option>
                                                    <?php if($studentHealthRecord['psychologicalAssessment']!=1):
                                                        echo "<option value='1' >Yes</option>";
                                                    endif;
                                                    if($studentHealthRecord['psychologicalAssessment']!=0):
                                                        echo "<option value='0' >No</option>";
                                                    endif;
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="teacher_profile_group">
                                            <div class="teacher_profile_label">Nature of assessment</div>
                                            <div class="teacher_profile_value">
                                                <textarea class="form-control set-margin-bottom" name="hrpsychologicalAssessmentdetail"><?php echo isset($studentHealthRecord['psychologicalAssessmentDetail']) ? $studentHealthRecord['psychologicalAssessmentDetail'] : ''; ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-612 col-xs-12">
                                        <div class="teacher_profile_group">
                                            <div class="teacher_profile_label">Does your child have any hearing or speech difficulty?</div>
                                            <div class="teacher_profile_value" style="padding: 0">
                                                <select class="form-control set-margin-bottom" name="hrhearingSpeechDifficulty">
                                                    <option selected value="<?php echo $studentHealthRecord['hearingSpeechDifficulty']; ?>"><?php if($studentHealthRecord['hearingSpeechDifficulty']==0){echo "No";} else {echo "Yes";} ?></option>
                                                    <?php if($studentHealthRecord['hearingSpeechDifficulty']!=1):
                                                        echo "<option value='1' >Yes</option>";
                                                    endif;
                                                    if($studentHealthRecord['hearingSpeechDifficulty']!=0):
                                                        echo "<option value='0' >No</option>";
                                                    endif;
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="teacher_profile_group">
                                            <div class="teacher_profile_label">Nature of dificulty</div>
                                            <div class="teacher_profile_value">
                                                <textarea class="form-control set-margin-bottom" name="hrhearingSpeechDifficultydetail"><?php echo isset($studentHealthRecord['hearingSpeechDifficultyDetail']) ? $studentHealthRecord['hearingSpeechDifficultyDetail'] : ''; ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="teacher_profile_group">
                                            <div class="teacher_profile_label">Does your child have any behavioural difficulty?</div>
                                            <div class="teacher_profile_value" style="padding: 0">
                                                <select class="form-control set-margin-bottom" name="hrbehaviouralDifficulty">
                                                    <option selected value="<?php echo $studentHealthRecord['behaviouralDifficulty']; ?>"><?php if($studentHealthRecord['behaviouralDifficulty']==0){echo "No";} else {echo "Yes";} ?></option>
                                                    <?php if($studentHealthRecord['behaviouralDifficulty']!=1):
                                                        echo "<option value='1' >Yes</option>";
                                                    endif;
                                                    if($studentHealthRecord['behaviouralDifficulty']!=0):
                                                        echo "<option value='0' >No</option>";
                                                    endif;
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="teacher_profile_group">
                                            <div class="teacher_profile_label">Nature of behaviour</div>
                                            <div class="teacher_profile_value">
                                                <textarea class="form-control set-margin-bottom" name="hrbehaviouralDifficultydetail"><?php echo isset($studentHealthRecord['behaviouralDifficultyDetail']) ? $studentHealthRecord['behaviouralDifficultyDetail'] : ''; ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="teacher_profile_group">
                                            <div class="teacher_profile_label">Others (please specify)</div>
                                            <div class="teacher_profile_value">
                                                <textarea class="form-control set-margin-bottom" name="hrother"><?php echo isset($studentHealthRecord['others']) ? $studentHealthRecord['others'] : ''; ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="teacher_profile_group">
                                            <div class="teacher_profile_label">Please include any other comments/information that will enable teachers to understand your child/ward better</div>
                                            <div class="teacher_profile_value">
                                                <textarea class="form-control set-margin-bottom" name="hrotherinformation"><?php echo isset($studentHealthRecord['otherinformation']) ? $studentHealthRecord['otherinformation'] : ''; ?></textarea>
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
                                                    <option selected value="<?php echo $studentHealthRecord['eyesight']; ?>"><?php if($studentHealthRecord['eyesight']==0){echo "No";} else {echo "Yes";} ?></option>
                                                    <?php if($studentHealthRecord['eyesight']!=1):
                                                        echo "<option value='1' >Yes</option>";
                                                    endif;
                                                    if($studentHealthRecord['eyesight']!=0):
                                                        echo "<option value='0' >No</option>";
                                                    endif;
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="teacher_profile_group">
                                            <div class="teacher_profile_label">Hearing</div>
                                            <div class="teacher_profile_value" style="padding: 0">
                                                <select class="form-control set-margin-bottom" name="hrhearing">
                                                    <option selected value="<?php echo $studentHealthRecord['hearing']; ?>"><?php if($studentHealthRecord['hearing']==0){echo "No";} else {echo "Yes";} ?></option>
                                                    <?php if($studentHealthRecord['hearing']!=1):
                                                        echo "<option value='1' >Yes</option>";
                                                    endif;
                                                    if($studentHealthRecord['hearing']!=0):
                                                        echo "<option value='0' >No</option>";
                                                    endif;
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="teacher_profile_group">
                                            <div class="teacher_profile_label">Food Allergies</div>
                                            <div class="teacher_profile_value" style="padding: 0">
                                                <select class="form-control set-margin-bottom" name="hrfoodallergies">
                                                    <option selected value="<?php echo $studentHealthRecord['foodallergies']; ?>"><?php if($studentHealthRecord['foodallergies']==0){echo "No";} else {echo "Yes";} ?></option>
                                                    <?php if($studentHealthRecord['foodallergies']!=1):
                                                        echo "<option value='1' >Yes</option>";
                                                    endif;
                                                    if($studentHealthRecord['foodallergies']!=0):
                                                        echo "<option value='0' >No</option>";
                                                    endif;
                                                    ?>
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
                                                    <option selected value="<?php echo $studentVaccination['hepatitisb']; ?>"><?php if($studentVaccination['hepatitisb']==0){echo "No";} else {echo "Yes";} ?></option>
                                                    <?php if($studentVaccination['hepatitisb']!=1):
                                                        echo "<option value='1' >Yes</option>";
                                                    endif;
                                                    if($studentVaccination['hepatitisb']!=0):
                                                        echo "<option value='0' >No</option>";
                                                    endif;
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="teacher_profile_group">
                                            <div class="teacher_profile_label">Year</div>
                                            <div class="teacher_profile_value" style="padding: 0">
                                                <select class="form-control set-margin-bottom" name="vchepatitisbyear">
                                                    <option selected value="<?php echo $studentVaccination['hepatitisbYear']; ?>"><?php if($studentVaccination['hepatitisbYear']==0){echo "No";} else {echo $studentVaccination['hepatitisbYear'];} ?></option>
                                                    <?php if($studentVaccination['hepatitisbYear']!=0):
                                                        echo "<option value='0' >No</option>";
                                                    endif;
                                                    if($studentVaccination['foodallergies']!=0):
                                                        echo "<option value='0' >No</option>";
                                                    endif;
                                                    ?>
                                                    <?php
                                                    for($i=0;$i<25;$i++) {
                                                        if ($studentVaccination['hepatitisbYear'] != date("Y") - $i):?>
                                                            <option value='<?php echo date("Y") - $i ?>'><?php echo date("Y") - $i ?></option>
                                                            <?php
                                                        endif;
                                                    }
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
                                                    <option selected value="<?php echo $studentVaccination['measlesMumpsRubella']; ?>"><?php if($studentVaccination['measlesMumpsRubella']==0){echo "No";} else {echo "Yes";} ?></option>
                                                    <?php if($studentVaccination['measlesMumpsRubella']!=1):
                                                        echo "<option value='1' >Yes</option>";
                                                    endif;
                                                    if($studentVaccination['measlesMumpsRubella']!=0):
                                                        echo "<option value='0' >No</option>";
                                                    endif;
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="teacher_profile_group">
                                            <div class="teacher_profile_label">Year</div>
                                            <div class="teacher_profile_value" style="padding: 0">
                                                <select class="form-control set-margin-bottom" name="vcmeaslesyear">
                                                    <option selected value="<?php echo $studentVaccination['measlesMumpsRubellaYear']; ?>"><?php if($studentVaccination['measlesMumpsRubellaYear']==0){echo "No";} else {echo $studentVaccination['hepatitisbYear'];} ?></option>
                                                    <?php if($studentVaccination['measlesMumpsRubellaYear']!=0):
                                                        echo "<option value='0' >No</option>";
                                                    endif;
                                                    if($studentVaccination['measlesMumpsRubellaYear']!=0):
                                                        echo "<option value='0' >No</option>";
                                                    endif;
                                                    ?>
                                                    <?php
                                                    for($i=0;$i<25;$i++) {
                                                        if ($studentVaccination['measlesMumpsRubellaYear'] != date("Y") - $i):?>
                                                            <option value='<?php echo date("Y") - $i ?>'><?php echo date("Y") - $i ?></option>
                                                            <?php
                                                        endif;
                                                    }
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
                                                    <option selected value="<?php echo $studentVaccination['polio']; ?>"><?php if($studentVaccination['polio']==0){echo "No";} else {echo "Yes";} ?></option>
                                                    <?php if($studentVaccination['polio']!=1):
                                                        echo "<option value='1' >Yes</option>";
                                                    endif;
                                                    if($studentVaccination['polio']!=0):
                                                        echo "<option value='0' >No</option>";
                                                    endif;
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="teacher_profile_group">
                                            <div class="teacher_profile_label">Year</div>
                                            <div class="teacher_profile_value" style="padding: 0">
                                                <select class="form-control set-margin-bottom" name="vcpolioyear">
                                                    <option selected value="<?php echo $studentVaccination['polioYear']; ?>"><?php if($studentVaccination['polioYear']==0){echo "No";} else {echo $studentVaccination['hepatitisbYear'];} ?></option>
                                                    <?php if($studentVaccination['polioYear']!=0):
                                                        echo "<option value='0' >No</option>";
                                                    endif;
                                                    if($studentVaccination['polioYear']!=0):
                                                        echo "<option value='0' >No</option>";
                                                    endif;
                                                    ?>
                                                    <?php
                                                    for($i=0;$i<25;$i++) {
                                                        if ($studentVaccination['polioYear'] != date("Y") - $i):?>
                                                            <option value='<?php echo date("Y") - $i ?>'><?php echo date("Y") - $i ?></option>
                                                            <?php
                                                        endif;
                                                    }
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
                                                    <option selected value="<?php echo $studentVaccination['tetanus']; ?>"><?php if($studentVaccination['tetanus']==0){echo "No";} else {echo "Yes";} ?></option>
                                                    <?php if($studentVaccination['tetanus']!=1):
                                                        echo "<option value='1' >Yes</option>";
                                                    endif;
                                                    if($studentVaccination['tetanus']!=0):
                                                        echo "<option value='0' >No</option>";
                                                    endif;
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="teacher_profile_group">
                                            <div class="teacher_profile_label">Year</div>
                                            <div class="teacher_profile_value" style="padding: 0">
                                                <select class="form-control set-margin-bottom" name="vctetanusyear">
                                                    <option selected value="<?php echo $studentVaccination['tetanusYear']; ?>"><?php if($studentVaccination['tetanusYear']==0){echo "No";} else {echo $studentVaccination['hepatitisbYear'];} ?></option>
                                                    <?php if($studentVaccination['tetanusYear']!=0):
                                                        echo "<option value='0' >No</option>";
                                                    endif;
                                                    if($studentVaccination['tetanusYear']!=0):
                                                        echo "<option value='0' >No</option>";
                                                    endif;
                                                    ?>
                                                    <?php
                                                    for($i=0;$i<25;$i++) {
                                                        if ($studentVaccination['tetanusYear'] != date("Y") - $i):?>
                                                            <option value='<?php echo date("Y") - $i ?>'><?php echo date("Y") - $i ?></option>
                                                            <?php
                                                        endif;
                                                    }
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
                                                    <option selected value="<?php echo $studentVaccination['hib']; ?>"><?php if($studentVaccination['hib']==0){echo "No";} else {echo "Yes";} ?></option>
                                                    <?php if($studentVaccination['hib']!=1):
                                                        echo "<option value='1' >Yes</option>";
                                                    endif;
                                                    if($studentVaccination['hib']!=0):
                                                        echo "<option value='0' >No</option>";
                                                    endif;
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="teacher_profile_group">
                                            <div class="teacher_profile_label">Year</div>
                                            <div class="teacher_profile_value" style="padding: 0">
                                                <select class="form-control set-margin-bottom" name="vchibyear">
                                                    <option selected value="<?php echo $studentVaccination['hibYear']; ?>"><?php if($studentVaccination['hibYear']==0){echo "No";} else {echo $studentVaccination['hepatitisbYear'];} ?></option>
                                                    <?php if($studentVaccination['hibYear']!=0):
                                                        echo "<option value='0' >No</option>";
                                                    endif;
                                                    if($studentVaccination['hibYear']!=0):
                                                        echo "<option value='0' >No</option>";
                                                    endif;
                                                    ?>
                                                    <?php
                                                    for($i=0;$i<25;$i++) {
                                                        if ($studentVaccination['hibYear'] != date("Y") - $i):?>
                                                            <option value='<?php echo date("Y") - $i ?>'><?php echo date("Y") - $i ?></option>
                                                            <?php
                                                        endif;
                                                    }
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
                                                    <option selected value="<?php echo $studentVaccination['menzb']; ?>"><?php if($studentVaccination['menzb']==0){echo "No";} else {echo "Yes";} ?></option>
                                                    <?php if($studentVaccination['menzb']!=1):
                                                        echo "<option value='1' >Yes</option>";
                                                    endif;
                                                    if($studentVaccination['menzb']!=0):
                                                        echo "<option value='0' >No</option>";
                                                    endif;
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="teacher_profile_group">
                                            <div class="teacher_profile_label">Year</div>
                                            <div class="teacher_profile_value" style="padding: 0">
                                                <select class="form-control set-margin-bottom" name="vcmenzbyear">
                                                    <option selected value="<?php echo $studentVaccination['menzbYear']; ?>"><?php if($studentVaccination['menzbYear']==0){echo "No";} else {echo $studentVaccination['hepatitisbYear'];} ?></option>
                                                    <?php if($studentVaccination['menzbYear']!=0):
                                                        echo "<option value='0' >No</option>";
                                                    endif;
                                                    if($studentVaccination['menzbYear']!=0):
                                                        echo "<option value='0' >No</option>";
                                                    endif;
                                                    ?>
                                                    <?php
                                                    for($i=0;$i<25;$i++) {
                                                        if ($studentVaccination['menzbYear'] != date("Y") - $i):?>
                                                            <option value='<?php echo date("Y") - $i ?>'><?php echo date("Y") - $i ?></option>
                                                            <?php
                                                        endif;
                                                    }
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
                                                    <option selected value="<?php echo $studentVaccination['tb']; ?>"><?php if($studentVaccination['tb']==0){echo "No";} else {echo "Yes";} ?></option>
                                                    <?php if($studentVaccination['tb']!=1):
                                                        echo "<option value='1' >Yes</option>";
                                                    endif;
                                                    if($studentVaccination['tb']!=0):
                                                        echo "<option value='0' >No</option>";
                                                    endif;
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="teacher_profile_group">
                                            <div class="teacher_profile_label">Year</div>
                                            <div class="teacher_profile_value" style="padding: 0">
                                                <select class="form-control set-margin-bottom" name="vctbyear">
                                                    <option selected value="<?php echo $studentVaccination['tbYear']; ?>"><?php if($studentVaccination['tbYear']==0){echo "No";} else {echo $studentVaccination['hepatitisbYear'];} ?></option>
                                                    <?php if($studentVaccination['tbYear']!=0):
                                                        echo "<option value='0' >No</option>";
                                                    endif;
                                                    if($studentVaccination['tbYear']!=0):
                                                        echo "<option value='0' >No</option>";
                                                    endif;
                                                    ?>
                                                    <?php
                                                    for($i=0;$i<25;$i++) {
                                                        if ($studentVaccination['tbYear'] != date("Y") - $i):?>
                                                            <option value='<?php echo date("Y") - $i ?>'><?php echo date("Y") - $i ?></option>
                                                            <?php
                                                        endif;
                                                    }
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
                                            $i = 1;
                                            $probother;
                                            if($studentMedicalProblem) {
                                                foreach ($studentMedicalProblem as $problem) {
                                                    if (!(strcmp($problem['healthproblem'], "Asthma")) or !(strcmp($problem['healthproblem'], "Diabetes")) or !(strcmp($problem['healthproblem'], "Allergy")) or !(strcmp($problem['healthproblem'], "ADHD/ADD")) or !(strcmp($problem['healthproblem'], "Epilepsy")) or !(strcmp($problem['healthproblem'], "Past head injury")) or !(strcmp($problem['healthproblem'], "Hepatitis B")) or !(strcmp($problem['healthproblem'], "Rheumatic fever"))) {
                                                        ?>
                                                        <div>

                                                            <div class="col-sm-1 col-md-1 col-xs-1"><?php echo $i ?></div>
                                                            <input type="hidden" value="<?php echo $problem['hpid'] ?>"
                                                                   name="mp<?php echo $i ?>id"/>
                                                            <input type="hidden"
                                                                   value="<?php echo $problem['healthproblem'] ?>"
                                                                   name="mp<?php echo $i ?>problem"/>
                                                            <div class="col-sm-5 col-md-5 col-xs-5">Medical problem
                                                                : <?php echo $problem['healthproblem'] ?></div>
                                                            <div class="col-sm-6 col-md-6 col-xs-12">
                                                                <select class="form-control set-margin-bottom"
                                                                        name="mp<?php echo $i ?>">
                                                                    <option selected
                                                                            value="<?php echo $problem['status']; ?>"><?php if ($problem['status'] == 0) {
                                                                            echo "No";
                                                                        } else {
                                                                            echo "Yes";
                                                                        } ?></option>
                                                                    <?php if ($problem['status'] != 1):
                                                                        echo "<option value='1' >Yes</option>";
                                                                    endif;
                                                                    if ($problem['status'] != 0):
                                                                        echo "<option value='0' >No</option>";
                                                                    endif;
                                                                    ?>
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
                                                                <select class="form-control set-margin-bottom"
                                                                        name="mp<?php echo $i ?>severity">
                                                                    <option selected
                                                                            value="<?php echo $problem['severity']; ?>"><?php if ($problem['severity'] == 0) {
                                                                            echo "None";
                                                                        } else if ($problem['severity'] == 1) {
                                                                            echo "Mid";
                                                                        } else if ($problem['severity'] == 2) {
                                                                            echo "Moderate";
                                                                        } else {
                                                                            echo "Severe";
                                                                        } ?></option>
                                                                    <?php if ($problem['severity'] != 0):
                                                                        echo "<option value='0' >None</option>";
                                                                    endif;
                                                                    if ($problem['severity'] != 1):
                                                                        echo "<option value='1' >Mid</option>";
                                                                    endif;
                                                                    if ($problem['severity'] != 2):
                                                                        echo "<option value='2'>Moderate</option>";
                                                                    endif;
                                                                    if ($problem['severity'] != 3):
                                                                        echo "<option value='3'>Severe</option>";
                                                                    endif;
                                                                    ?>
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
                                                        <?php $i++;
                                                    } else {
                                                        $probother = $problem;
                                                    }
                                                }
                                                ?>
                                                <div>
                                                    <div class="col-sm-1 col-md-1 col-xs-1"><?php echo $i ?></div>
                                                    <input type="hidden" value="<?php echo $problem['hpid'] ?>"
                                                           name="mp<?php echo $i ?>id"/>
                                                    <input type="hidden" value="1"
                                                           name="mp<?php echo $i ?>"/>

                                                    <div class="col-sm-5 col-md-5 col-xs-5">Medical problem</div>
                                                    <div class="col-sm-6 col-md-6 col-xs-12">
                                                        <input type="text" class="form-control set-margin-bottom"
                                                               name="mp<?php echo $i ?>problem"
                                                               value="<?php echo set_value('mp'.$i.'problem', isset($probother['healthproblem']) ? $probother['healthproblem'] : ''); ?>"/>
                                                    </div>
                                                    <div class="col-sm-1 col-md-1 col-xs-1"></div>
                                                    <div class="col-sm-5 col-md-5 col-xs-5">Severity</div>
                                                    <div class="col-sm-6 col-md-6 col-xs-12">
                                                        <select class="form-control set-margin-bottom"
                                                                name="mp9severity">
                                                            <option selected
                                                                    value="<?php echo $probother['severity']; ?>"><?php if ($probother['severity'] == 0) {
                                                                    echo "None";
                                                                } else if ($problem['severity'] == 1) {
                                                                    echo "Mid";
                                                                } else if ($problem['severity'] == 2) {
                                                                    echo "Moderate";
                                                                } else {
                                                                    echo "Severe";
                                                                } ?></option>
                                                            <?php if ($probother['severity'] != 0):
                                                                echo "<option value='0' >None</option>";
                                                            endif;
                                                            if ($probother['severity'] != 1):
                                                                echo "<option value='Mid'>Mid</option>";
                                                            endif;
                                                            if ($probother['severity'] != 2):
                                                                echo "<option value='2'>Moderate</option>";
                                                            endif;
                                                            if ($probother['severity'] != 3):
                                                                echo "<option value='3'>Severe</option>";
                                                            endif;
                                                            ?>
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
                                            <?php
                                            }

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
        <?php echo form_close(); ?>
    </div>
</div>
<!-- /page content -->