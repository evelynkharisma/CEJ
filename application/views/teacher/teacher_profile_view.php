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
                                        <img class="img-responsive avatar-view teacher_profile_img" src="<?php echo base_url() ?>assets/img/teacher/profile/<?php echo $info_db['photo'] ?>" alt="Avatar" title="Change the avatar">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-7 col-sm-12 col-xs-12">
                                <h3><?php echo $info_db['firstname'].' '.$info_db['lastname'] ?> </h3>

                                <ul class="list-unstyled user_data">
                                    <li>
                                         ID&emsp;&emsp;: <?php echo $info_db['teacherid']; ?>
                                    </li>
                                    <li>
                                         Role&emsp;: <?php echo ucwords($info_db['name']); ?>
                                    </li>
                                </ul>
                            </div>
                            <div class="clearfix"></div>

                            <?php
                                $encrypted = $this->general->encryptParaID($info_db['teacherid'],'teacher');
                            ?>
                            <a class="btn btn-success set-right" href="<?php echo base_url() ?>index.php/teacher/profile_edit/<?php echo $encrypted ?>"><i class="fa fa-edit m-right-xs"></i> Edit Profile</a>
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
                                        <div class="teacher_profile_value"><?php echo $info_db['firstname'].' '.$info_db['lastname'] ?></div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Place of Birth</div>
                                        <div class="teacher_profile_value"><?php echo $info_db['placeofbirth'] ?></div>
                                    </div>
                                </div>
                                <div class="col-md-6  col-sm-6 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Date of Birth</div>
                                        <div class="teacher_profile_value"><?php echo date('d F Y', strtotime($info_db['dateofbirth'])) ?></div>
                                    </div>
                                </div>
                                <div class="col-md-6  col-sm-6 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Gender</div>
                                        <div class="teacher_profile_value"><?php echo $info_db['gender'] ?></div>
                                    </div>
                                </div>
                                <div class="col-md-6  col-sm-6 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Religion</div>
                                        <div class="teacher_profile_value"><?php echo $info_db['religion'] ?></div>
                                    </div>
                                </div>
                                <div class="col-md-6  col-sm-6 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Phone</div>
                                        <div class="teacher_profile_value"><?php echo $info_db['phone'] ?></div>
                                    </div>
                                </div>
                                <div class="col-md-6  col-sm-6 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Email</div>
                                        <div class="teacher_profile_value"><?php echo $info_db['email'] ?></div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Address</div>
                                        <div class="teacher_profile_value"><?php echo $info_db['address'] ?></div>
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
                                            if($info_db['experience']==NULL)
                                                echo '-';
                                            else
                                                echo $info_db['experience']
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Post Graduate</div>
                                        <div class="teacher_profile_value"><?php
                                            if($info_db['postgraduate']==NULL)
                                                echo '-';
                                            else
                                                echo $info_db['postgraduate']
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Graduate</div>
                                        <div class="teacher_profile_value"><?php
                                            if($info_db['graduate']==NULL)
                                                echo '-';
                                            else
                                                echo $info_db['graduate']
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Undergraduate</div>
                                        <div class="teacher_profile_value"><?php echo $info_db['undergraduate'] ?></div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Senior High School</div>
                                        <div class="teacher_profile_value"><?php echo $info_db['seniorhigh'] ?></div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Junior High School</div>
                                        <div class="teacher_profile_value"><?php echo $info_db['juniorhigh'] ?></div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Elementary School</div>
                                        <div class="teacher_profile_value"><?php echo $info_db['elementary'] ?></div>
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
                                            <td class="teacher_course_student_mid_td set-center">
                                                <?php echo $today; ?>
                                            </td>
                                        <?php } ?>
                                    </tr>
                                    <?php
                                    $thisperiod = $starttime['value'];
                                    $break = false;
                                    $lunch = false;
                                    $worktime = substr($info_db['workinghour'], 1, strlen($info_db['workinghour']));
                                    $available = explode('|', $worktime);
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
                                                    <td class="set-center"><div class="<?php echo (isset($available[$a]) && $available[$a]=='1')?'workavailable':'worknotavailable' ?>"></div> </td>
                                                    <?php $a++; } ?>
                                            </tr>
                                            <?php
                                            $thisperiod = date('H:i', strtotime($thisperiod) + 60*$hour['value']);
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
    </div>
</div>
<!-- /page content -->