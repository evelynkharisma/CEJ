<!-- page content -->
<div class="right_col" role="main">
    <div class="parent">
        <div class="page-title">
            <div class="title_left">
                <h3>Dashboard</h3>
            </div>
        </div>

        <div class="clearfix"></div>

<!--        <div class="row">-->
<!--            <div class="col-md-12 col-sm-12 col-xs-12">-->
<!--                <div class="x_panel">-->
<!--                    <div class="row top_tiles parent_dashboard_top_tile">-->
<!--                        <div class="animated flipInY col-lg-4 col-md-4 col-sm-4 col-xs-12">-->
<!--                            <a href="--><?php //echo base_url() ?><!--index.php/parents/parent_announcement">-->
<!--                                <div class="tile-stats">-->
<!--                                    <div class="icon"><i class="fa fa-bullhorn"></i></div>-->
<!--                                    <div class="count">0</div>-->
<!--                                    <h3 class="announcement_top_tile">Announcement</h3>-->
<!--                                </div>-->
<!--                            </a>-->
<!--                        </div>-->
<!--                        <div class="animated flipInY col-lg-4 col-md-4 col-sm-4 col-xs-12">-->
<!--                            <a href="--><?php //echo base_url() ?><!--index.php/parents/parent_correspond">-->
<!--                                <div class="tile-stats">-->
<!--                                    <div class="icon"><i class="fa fa-comment-o"></i></div>-->
<!--                                    <div class="count">0</div>-->
<!--                                    <h3 class="message_top_tile">Message</h3>-->
<!--                                </div>-->
<!--                            </a>-->
<!--                        </div>-->
<!--                        <div class="animated flipInY col-lg-4 col-md-4 col-sm-4 col-xs-12">-->
<!--                            <a href="--><?php //echo base_url() ?><!--index.php/parents/payment_status">-->
<!--                                <div class="tile-stats">-->
<!--                                    <div class="icon"><i class="fa fa-credit-card"></i></div>-->
<!--                                    <div class="count">0</div>-->
<!--                                    <h3 class="invoice_top_tile">Invoice</h3>-->
<!--                                </div>-->
<!--                            </a>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
        <div class="row">
            <?php
            $childs = $this->Parent_model->getAllChildren($this->nativesession->get('id'));
            foreach($childs as $child) {
                ?>
                <div class="col-md-6 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div>
                            <div class="x_title">
                                <div class="media event">
                                    <a class="pull-left border-aero profile_thumb">
                                        <i class="fa fa-user aero"></i>
                                    </a>
                                    <div class="media-body parent_dashboard_child">
                                        <a class="title" href="#"><?php echo $child['firstname']?> <?php echo $child['lastname']?></a>
                                        <p><strong>Present</strong></p>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <div class="teacher_dashboard_today_schedule_container">
                                    <table class="teacher_dashboard_today_schedule_table">
                                        <?php
                                        $schedule = $this->Teacher_model->getAllScheduleOfTeacherOfDay($child['classid'], $today);
                                        $thisperiod = $starttime['value'];
                                        $break = false;
                                        $lunch = false;
                                        $a = 0;
                                        $j = 0;
                                        for($i=0; $i < $period['value'];){
                                            if($break == false && $thisperiod >= date('H:i', strtotime($breakstarttime['value']))){
                                                ?>
                                                <td class="teacher_dashboard_today_schedule_break set-center">
                                                    <?php echo $thisperiod; ?>
                                                </td>
                                                <td class="teacher_dashboard_today_schedule_break set-center" colspan="">Break</td>
                                                <?php
                                                $thisperiod = date('H:i', strtotime($thisperiod) + 60*$breaktime['value']);
                                                $break = true;
                                            }
                                            elseif ($lunch == false && $thisperiod >= date('H:i', strtotime($lunchstarttime['value']))){ ?>
                                                <td class="teacher_dashboard_today_schedule_break set-center">
                                                    <?php echo $thisperiod; ?>
                                                </td>
                                                <td class="teacher_dashboard_today_schedule_break set-center" colspan="">Lunch</td>
                                                <?php
                                                $thisperiod = date('H:i', strtotime($thisperiod) + 60*$lunchtime['value']);
                                                $lunch = true;
                                            }
                                            else{ ?>
                                                <tr>
                                                    <th class="teacher_dashboard_today_schedule_period">Period <?php echo $i+1; ?><br><?php echo $thisperiod; ?></th>
                                                    <?php if(isset($schedule[$j]) && $schedule[$j]['period'] == $i){ ?>
                                                        <td><?php echo $schedule[$j]['coursename']; ?><br><?php echo $schedule[$j]['classroom']; ?></td>
                                                        <?php $j++; }else{ ?>
                                                        <td>&nbsp<br>&nbsp</td>
                                                    <?php } ?>
                                                </tr>
                                                <?php
                                                $thisperiod = date('H:i', strtotime($thisperiod) + 60*$hour['value']);
                                                $i++;
                                            }
                                        } ?>

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }?>
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Upcoming Event or Deadline</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <?php
                        if($events){
                            foreach($events as $event){ ?>
                                <article class="media event">
                                    <a class="pull-left date <?php echo $event['assignid'] != '0' ? 'quizandassignment' : '' ?>">
                                        <p class="month"><?php echo date('F', strtotime($event['date'])) ?></p>
                                        <p class="day"><?php echo date('d', strtotime($event['date'])) ?></p>
                                    </a>
                                    <div class="media-body">
                                        <?php
                                        $encrypted = $this->general->encryptParaID($event['eventid'],'event');
                                        ?>
                                        <a class="title" href="#"><?php echo $event['title'] ?></a>
                                        <p><?php echo substr($event['description'],0,80) ?>...</p>
                                        <div class="teacher_dashboard_deadline">
                                            <a class="teacher_dashboard_deadline" href="<?php echo base_url() ?>index.php/parents/eventDetail/<?php echo $encrypted ?>">Read More</a>
                                        </div>
                                    </div>
                                </article>
                            <?php }}
                        else {?>
                            <tr>
                                <td colspan="3"><?php echo 'no event found' ?></td>
                            </tr>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->