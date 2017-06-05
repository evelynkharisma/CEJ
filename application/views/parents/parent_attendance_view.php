<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Attendance</h3>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="row top_tiles parent_dashboard_top_tile">
                        <?php
                        if($attendances){
                        $p = 0;
                        $a = 0;
                        $l = 0;
                        $all = 0;
                        foreach($attendances as $attendance) {
                            if($attendance['status']=='p'){$p++;}
                            elseif ($attendance['status']=='a'){$a++;}
                            else{$l++;}
                            $all++;
                        }
                        ?>

                        <div class="animated flipInY col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="tile-stats">
                                <div class="icon"><i class="fa fa-check"></i></div>
                                <div class="count"><?php echo $p?>/<?php echo $all?></div>
                                <h3 class="message_top_tile">Present</h3>
                            </div>
                        </div>
                        <div class="animated flipInY col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="tile-stats">
                                <div class="icon"><i class="fa fa-clock-o"></i></div>
                                <div class="count"><?php echo $l?>/<?php echo $all?></div>
                                <h3 class="announcement_top_tile">Late</h3>
                            </div>
                        </div>
                        <div class="animated flipInY col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="tile-stats">
                                <div class="icon"><i class="fa fa-ban"></i></div>
                                <div class="count"><?php echo $a?>/<?php echo $all?></div>
                                <h3 class="invoice_top_tile">Absent</h3>
                            </div>
                        </div>
                        <?php } ?>
                    </div>

                    <div class="x_title">
                        <h2><?php echo date('d F Y', now())?></h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <table id="attendance" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>Date</th>
                                <th>Action</th>
                                <th>Comment</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            if($attendances){
                                $i = 0;
                                foreach($attendances as $attendance) { ?>
                                    <tr>
                                        <td><?php echo date('d', strtotime($attendance['date'])).' '.date('F', strtotime($attendance['date'])).' '.date('Y', strtotime($attendance['date'])) ?></td>
                                        <td>
                                            <div class="teacher_attendance_radio">
                                                <input class="present" type="radio" id="present_<?php echo $attendance['studentid'] ?>" name="attendance[<?php echo $i ?>]" value="p" <?php echo ($attendance['status']=='p')?'checked':'' ?>>
                                                <label for="absent_<?php echo $attendance['studentid'] ?>">P</label>

                                                <input class="absent" type="radio" id="absent_<?php echo $attendance['studentid'] ?>" name="attendance[<?php echo $i ?>]" value="a" <?php echo ($attendance['status']=='a')?'checked':'' ?>>
                                                <label for="absent_<?php echo $attendance['studentid'] ?>">A</label>

                                                <input class="late" type="radio" id="late_<?php echo $attendance['studentid'] ?>" name="attendance[<?php echo $i ?>]" value="l" <?php echo ($attendance['status']=='l')?'checked':'' ?>>
                                                <label for="absent_<?php echo $attendance['studentid'] ?>">L</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                                                <input type="text" class="form-control has-feedback-left"
                                                       id="attendance_comment" value="<?php echo $attendance['description']?>" disabled>
                                                <span class="fa fa-comment form-control-feedback left"
                                                      aria-hidden="true"></span>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php
                                    $i++;}}
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="x_panel">
                    <div class="x_content">

                        <div id='calendar'></div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->