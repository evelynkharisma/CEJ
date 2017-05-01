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
                        <?php for($grade=1; $grade<14; $grade++){
                            if(isset(${'g'.$grade})){
                        ?>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="profile_title">
                                    <div class="col-md-12">
                                        <h2>Grade <?php echo $grade ?></h2>
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
                                                <td class="teacher_course_student_mid_td  set-center">
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
                                                        <td class="set-center">a</div> </td>
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
                    <?php }} ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->