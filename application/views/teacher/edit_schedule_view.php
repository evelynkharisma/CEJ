<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Edit Schedule</h3>
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
                    <?php echo form_open_multipart('teacher/saveSchedule/'); ?>
                    <div class="x_content">
                        <?php
                        $a = 0;
                        for($grade=1; $grade<12; $grade++){
                            if(isset(${'g'.$grade})){
                        ?>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="profile_title">
                                    <div class="col-md-12">
                                        <h2>Grade <?php echo $grade ?></h2>
                                    </div>
                                </div>
                                <div class="col-md-12 right">
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
                                                        <td class="set-center drop" style="color: #FFF; background-color: <?php echo (isset(${'g'.$grade}[$i*$day['value']+$j]['conflict']) && ${'g'.$grade}[$i*$day['value']+$j]['conflict'] == 1)?'red':'green' ?>">
                                                            <div class="item">
<!--                                                                <input type="hidden" name="class[--><?php //echo $a ?><!--]" value="--><?php //echo $grade ?><!--" />-->
<!--                                                                <input type="hidden" name="row[--><?php //echo $a ?><!--]" value="--><?php //echo $i ?><!--" />-->
<!--                                                                <input type="hidden" name="colom[--><?php //echo $a ?><!--]" value="--><?php //echo $j ?><!--" />-->
<!--                                                                <input type="hidden" name="teacherid[--><?php //echo $a ?><!--]" value="--><?php //echo ${'g'.$grade}[$i][$j]['teacherid'] ?><!--" />-->
<!--                                                                <input type="hidden" name="courseid[--><?php //echo $a ?><!--]" value="--><?php //echo ${'g'.$grade}[$i][$j]['courseid'] ?><!--" />-->
                                                                <?php echo ${'g'.$grade}[$i*$day['value']+$j]['firstname'] ?> <?php echo ${'g'.$grade}[$i*$day['value']+$j]['lastname'] ?><br/><?php echo ${'g'.$grade}[$i*$day['value']+$j]['coursename'] ?>
                                                            </div>
                                                        </td>
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
                    <button type="submit" class="btn btn-success set-margin-top set-right"><i class="fa fa-save"></i> Save Schedule</button>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->

<script>
    jQuery.fn.swapWith = function(to) {
        return this.each(function() {
            var copy_to = $(to).clone();
            var copy_from = $(this).clone();
            $(to).replaceWith(copy_from);
            $(this).replaceWith(copy_to);

            copy_to.draggable({
                revert:true
            });

            copy_from.draggable({
                revert:true
            });
        });
    };

    $(function(){
        $('.item').draggable({
            revert:true,
            proxy:'clone'
        });
        $('.right td.drop').droppable({
            onDragEnter:function(){
                $(this).addClass('over');
            },
            onDragLeave:function(){
                $(this).removeClass('over');
            },
            onDrop:function(e,source){
                $(this).removeClass('over');
                if ($(this).children('div').length > 0 ){
                    $(this).children('div').swapWith($(source));
                } else {
                    if($(source).hasClass('assigned')){
                        $(this).append(source);
                    }
                    else{
                        var c = $(source).clone().addClass('assigned');
                        $(this).empty().append(c);
                        c.draggable({
                            revert:true
                        });
                    }
                }
            }
        });
    });
</script>