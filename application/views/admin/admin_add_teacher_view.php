<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Add New Teacher</h3>
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

        <?php echo form_open_multipart('admin/addTeacher'); ?>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <div class="col-md-12 col-sm-12 col-xs-12 ">
                            <div class="col-md-5 col-sm-12 col-xs-12 profile_left">
                                <div class="profile_img">
                                    <div class="teacher_profile_crop">
                                        <!-- Current avatar -->
                                        <img class="img-responsive avatar-view teacher_profile_img" src="http://placehold.it/220x220" alt="Avatar" title="Change the avatar">
                                    </div>
                                </div>
                                <input class="btn btn-success set-margin-bottom set-margin-top" type="file" name="photo" />
                            </div>

                            <div class="col-md-7 col-sm-12 col-xs-12">
                                <ul class="list-unstyled user_data">
                                    <li>
                                        <select class="form-control set-margin-bottom" name="role">
                                            <option selected value="">Role</option>
                                            <?php foreach ($rolechoice as $c){?>
                                                <option value="<?php echo $c['roleid']; ?>"><?php echo ucwords($c['name']); ?></option>
                                            <?php } ?>
                                        </select>
                                    </li>
                                </ul>
                            </div>
                            <div class="clearfix"></div>

                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <button type="submit" class="btn btn-success set-right"><i class="fa fa-save m-right-xs"></i> Add Teacher</button>
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="profile_title">
                                <div class="col-md-12">
                                    <h2>Personal Information</h2>
                                </div>
                            </div>
                            <div class="col-md-12">
<!--                                <div class="col-md-6 col-sm-6 col-xs-12">-->
<!--                                    <div class="teacher_profile_group">-->
<!--                                        <div class="teacher_profile_label">Password</div>-->
<!--                                        <div class="teacher_profile_value">-->
<!--                                            <input type="password" class="form-control set-margin-bottom" name="password"/>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                                <div class="col-md-6 col-sm-6 col-xs-12">-->
<!--                                    <div class="teacher_profile_group">-->
<!--                                        <div class="teacher_profile_label">Confirm Password</div>-->
<!--                                        <div class="teacher_profile_value">-->
<!--                                            <input type="password" class="form-control set-margin-bottom" name="confirmpassword"/>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                </div>-->
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">First Name</div>
                                        <div class="teacher_profile_value">
                                            <input type="text" class="form-control set-margin-bottom" name="firstname" value="<?php echo set_value('firstname', isset($info_db['firstname']) ? $info_db['firstname'] : ''); ?>"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Last Name</div>
                                        <div class="teacher_profile_value">
                                            <input type="text" class="form-control set-margin-bottom" name="lastname" value="<?php echo set_value('lastname', isset($info_db['lastname']) ? $info_db['lastname'] : ''); ?>"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Place of Birth</div>
                                        <div class="teacher_profile_value">
                                            <input type="text" class="form-control set-margin-bottom" name="placeofbirth" value="<?php echo set_value('placeofbirth', isset($info_db['placeofbirth']) ? $info_db['placeofbirth'] : ''); ?>"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Date of Birth</div>
                                        <div class="teacher_profile_value">
                                            <input type="text" class="form-control set-margin-bottom" id="pick-date" name="dateofbirth" value="<?php echo set_value('dateofbirth', isset($info_db['dateofbirth']) ? date('Y-m-d', strtotime($info_db['dateofbirth'])) : ''); ?>"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Gender</div>
                                        <div class="teacher_profile_value">
                                            <select class="form-control set-margin-bottom" name="gender">
                                                <option value="Female">Female</option>
                                                <option value="Male">Male</option>
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
                                            <input type="text" class="form-control set-margin-bottom" name="phone" value="<?php echo set_value('phone', isset($info_db['phone']) ? $info_db['phone'] : ''); ?>"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Email</div>
                                        <div class="teacher_profile_value">
                                            <input type="text" class="form-control set-margin-bottom" name="email" value="<?php echo set_value('email', isset($info_db['email']) ? $info_db['email'] : ''); ?>"/>
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
                            <div class="col-md-12">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Working Experiences</div>
                                        <div class="teacher_profile_value">
                                            <textarea class="form-control set-margin-bottom" name="experience"><?php if(isset($_POST['experience'])) {echo htmlentities ($_POST['experience']); }?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Post Graduate</div>
                                        <div class="teacher_profile_value">
                                            <input type="text" class="form-control" name="postgraduate" value="<?php echo set_value('postgraduate', isset($info_db['postgraduate']) ? $info_db['postgraduate'] : ''); ?>"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Graduate</div>
                                        <div class="teacher_profile_value">
                                            <input type="text" class="form-control" name="graduate" value="<?php echo set_value('graduate', isset($info_db['graduate']) ? $info_db['graduate'] : ''); ?>"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Undergraduate</div>
                                        <div class="teacher_profile_value">
                                            <input type="text" class="form-control" name="undergraduate" value="<?php echo set_value('undergraduate', isset($info_db['undergraduate']) ? $info_db['undergraduate'] : ''); ?>"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Senior High School</div>
                                        <div class="teacher_profile_value">
                                            <input type="text" class="form-control" name="seniorhigh" value="<?php echo set_value('seniorhigh', isset($info_db['seniorhigh']) ? $info_db['seniorhigh'] : ''); ?>"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Junior High School</div>
                                        <div class="teacher_profile_value">
                                            <input type="text" class="form-control" name="juniorhigh" value="<?php echo set_value('juniorhigh', isset($info_db['juniorhigh']) ? $info_db['juniorhigh'] : ''); ?>"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Elementary School</div>
                                        <div class="teacher_profile_value">
                                            <input type="text" class="form-control" name="elementary" value="<?php echo set_value('elementary', isset($info_db['elementary']) ? $info_db['elementary'] : ''); ?>"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="profile_title">
                                <div class="col-md-12">
                                    <h2>Working Hour</h2>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <table class="teacher_course_student_mid table-bordered">
                                    <tr>
                                        <td class="teacher_course_student_mid_td">
                                            Period
                                        </td>
                                        <?php
                                            $today = "Sunday";
                                            for($j=0; $j < $day['value']; $j++){
                                            $today = date('D',strtotime($today.'+1 day'));
                                        ?>
                                            <td class="teacher_course_student_mid_td">
                                                <?php echo $today; ?>
                                            </td>
                                        <?php } ?>
                                    </tr>
                                    <?php
                                        $thisperiod = $starttime['value'];
                                        $break = false;
                                        $lunch = false;
                                        $a = 0;
                                        for($i=0; $i < $period['value'];){
                                            if($break == false && $thisperiod >= date('H:i', strtotime($breakstarttime['value']))){
                                            ?>
                                                <td class="teacher_course_student_mid_td">
                                                    <?php echo $thisperiod; ?>
                                                </td>
                                                <td class="teacher_course_student_mid_td set-center" colspan="<?php echo $day['value']; ?>">Break</td>
                                            <?php
                                                $thisperiod = date('H:i', strtotime($thisperiod) + 60*$breaktime['value']);
                                                $break = true;
                                            }
                                            elseif ($lunch == false && $thisperiod >= date('H:i', strtotime($lunchstarttime['value']))){ ?>
                                                <td class="teacher_course_student_mid_td">
                                                    <?php echo $thisperiod; ?>
                                                </td>
                                                <td class="teacher_course_student_mid_td set-center" colspan="<?php echo $day['value']; ?>">Lunch</td>
                                            <?php
                                                $thisperiod = date('H:i', strtotime($thisperiod) + 60*$lunchtime['value']);
                                                $lunch = true;
                                            }
                                            else{ ?>
                                            <tr>
                                                <td>
                                                    <?php echo $thisperiod; ?>
                                                </td>
                                                <?php for($j=0; $j < $day['value']; $j++){ ?>
                                                    <input type="hidden" name="workinghour[<?php echo $a ?>]" value="0" />
                                                    <td class="set-center"><input type='checkbox' name='workinghour[<?php echo $a ?>]' value='1' id="check_<?php echo $i.'_'.$j; ?>" checked/><label for="check_<?php echo $i.'_'.$j; ?>"></label> </td>
                                                <?php $a++; } ?>
                                            </tr>
                                            <?php
                                            $thisperiod = date('H:i', strtotime($thisperiod) + 60*60);
                                            $i++;
                                        }
                                    } ?>
                                    <td class="teacher_course_student_mid_td">
                                        <?php echo $thisperiod; ?>
                                    </td>
                                    <td class="teacher_course_student_mid_td set-center" colspan="<?php echo $day['value']; ?>">End</td>

                                </table>
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