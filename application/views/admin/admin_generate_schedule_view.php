<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Generated Schedule</h3>
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
                    <?php echo form_open_multipart('admin/selectSchedule/'); ?>
                    <div class="x_content">
                        <?php
                        $a = 0;
                        for($grade=1; $grade<sizeof($schedule[1])+1; $grade++){
                            if(isset($schedule[$grade])){
                        ?>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="profile_title">
                                    <div class="col-md-12">
                                        <h2>Class <?php echo $schedule[$grade][0][0]['classroom'] ?></h2>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <table class="teacher_course_student_mid table-bordered">
                                        <tr>
                                            <td width="10%" class="teacher_course_student_mid_td">
                                                Period
                                            </td>
                                            <?php
                                            $today = "Sunday";
                                            for($j=0; $j < $day['value']; $j++){
                                                $today = date('D',strtotime($today.'+1 day'));
                                                ?>
                                                <td width="18%" class="teacher_course_student_mid_td  set-center">
                                                    <?php echo $today; ?>
                                                </td>
                                            <?php } ?>
                                        </tr>
                                        <?php
                                        $thisperiod = $starttime['value'];
                                        $break = false;
                                        $lunch = false;

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
                                                        <input type="hidden" name="class[<?php echo $a ?>]" value="<?php echo $schedule[$grade][$i][$j]['classid'] ?>" />
                                                        <input type="hidden" name="row[<?php echo $a ?>]" value="<?php echo $i ?>" />
                                                        <input type="hidden" name="colom[<?php echo $a ?>]" value="<?php echo $j ?>" />
                                                        <input type="hidden" name="teacherid[<?php echo $a ?>]" value="<?php echo $schedule[$grade][$i][$j]['teacherid'] ?>" />
                                                        <input type="hidden" name="courseid[<?php echo $a ?>]" value="<?php echo $schedule[$grade][$i][$j]['courseid'] ?>" />
                                                        <td style="color: #FFF; background-color: <?php echo (isset($schedule[$grade][$i][$j]['conflict']) && $schedule[$grade][$i][$j]['conflict'] == 1)?'red':'green' ?>" class="set-center"><div><?php echo $schedule[$grade][$i][$j]['teachername'] ?> <br/><?php echo $schedule[$grade][$i][$j]['coursename'] ?></div> </td>
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
                    <?php }} ?>
                    </div>
                    <button type="submit" class="btn btn-success set-margin-top set-right"><i class="fa fa-save"></i> Save Schedule</button>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->