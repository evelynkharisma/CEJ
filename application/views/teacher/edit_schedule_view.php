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
                    <?php
                    $attributes = array('id' => 'checkform');
                    echo form_open_multipart('teacher/selectSchedule/', $attributes); ?>
                    <div class="x_content">
                        <?php
                        for($grade=1; $grade<sizeof($schedule)+1; $grade++){
                            if(isset($schedule[$grade])){
                                $classid = $schedule[$grade][0]['classid'];
                                $classroom = $this->general->getClassroom($classid);
                        ?>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="profile_title">
                                    <div class="col-md-12">
                                        <h2>Class <?php echo $classroom['classroom'] ?></h2>
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
                                                        <td id="cell-<?php echo $grade ?>-<?php echo $i ?>-<?php echo $j ?>" class="assigned set-center drop <?php  if(isset($schedule[$grade][$i*$day['value']+$j]['conflict'])){if($schedule[$grade][$i*$day['value']+$j]['conflict'] == 1){echo 'conflict1';}elseif($schedule[$grade][$i*$day['value']+$j]['conflict'] == 2){echo 'conflict2';}elseif($schedule[$grade][$i*$day['value']+$j]['conflict'] == 3){echo 'conflict3';}} ?> not-conflicted" style="color: #FFF;">
                                                            <div class="item" id="item-<?php echo $grade ?>-<?php echo $i ?>-<?php echo $j ?>">
                                                                <input type="hidden" name="class[]" value="<?php echo $schedule[$grade][$i*$day['value']+$j]['classid'] ?>" />
                                                                <input type="hidden" name="row[]" value="<?php echo $i ?>" />
                                                                <input type="hidden" name="colom[]" value="<?php echo $j ?>" />
                                                                <input type="hidden" name="teacherid[]" value="<?php echo $schedule[$grade][$i*$day['value']+$j]['teacherid'] ?>" />
                                                                <input type="hidden" name="courseid[]" value="<?php echo $schedule[$grade][$i*$day['value']+$j]['courseid'] ?>" />
                                                                <?php echo $schedule[$grade][$i*$day['value']+$j]['firstname'] ?> <?php echo $schedule[$grade][$i*$day['value']+$j]['lastname'] ?><br/><?php echo $schedule[$grade][$i*$day['value']+$j]['coursename'] ?>
                                                            </div>
                                                        </td>
                                                        <?php } ?>
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
                    <button type="submit" name="savebutton" value="save" class="btn btn-success set-margin-top set-right"><i class="fa fa-save"></i> Save Schedule</button>
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
//            proxy:'clone',
//            onStartDrag:function(){
//                $(this).addClass('dragging');
//            },
        });
        $('.right td.drop').droppable({
            onDrop:function(e,source){

                if ($(this).children('div').length > 0 ){
                    $(this).children('div').swapWith($(source));
                }

                document.getElementById("checkform").submit();

//                var t = this.id;
//                t = t.substring(5, t.length);
//                var s = source.id;
//                s = s.substring(5, s.length);
//                document.getElementById("item-"+s).setAttribute("id", "item-"+t);
//                document.getElementById("item-"+t).setAttribute("id", "item-"+s);

//                $.ajax({
//                    url:'general/checkConflict',
//                    type: 'post',
//                    data: { "target": t},
//                    success: function(response) {
//                        if (response == 1) {
//                            if($('#cell'+t).hasClass('conflicted')){
//                            }
//                            else{
//                                $('#cell'+t).removeClass('not-conflicted')
//                                $('#cell'+t).addClass('conflicted')
//                            }
//                        } else {
//                            if($('#cell'+t).hasClass('not-conflicted')){
//                            }
//                            else{
//                                $('#cell'+t).removeClass('conflicted')
//                                $('#cell'+t).addClass('not-conflicted')
//                            }
//                        }
//                    }
//                });
//            }


//                var cellIndex  = this.cellIndex + 1;
//
//                var rowIndex = this.parentNode.rowIndex + 1;
//
//                alert("cell: " + source + " / row: " + rowIndex );
            }
        });
    });
</script>