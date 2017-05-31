<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Dashboard</h3>
      </div>
    </div>

    <div class="clearfix"></div>

    <?php if ($this->nativesession->get('error')): ?>
      <div  class="alert alert-error">
        <?php echo $this->nativesession->get('error');
        $this->nativesession->delete('error'); ?>
      </div>
    <?php endif; ?>

    <div class="row">
      <div class="col-md-6 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Today's Schedule</h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <div class="teacher_dashboard_today_schedule_container">
              <table class="teacher_dashboard_today_schedule_table">
                <?php
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
<!--    </div>-->
<!--    <div class="row">-->
      <div class="col-md-6 col-sm-12 col-xs-12">
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
                  <a class="pull-left date <?php echo isset($event['teacherid']) && $event['teacherid'] != '0' ? 'quizandassignment' : '' ?>">
                    <p class="month"><?php echo date('F', strtotime($event['date'])) ?></p>
                    <p class="day"><?php echo date('d', strtotime($event['date'])) ?></p>
                  </a>
                  <div class="media-body">
                    <a class="title" href="#"><?php echo $event['title'] ?></a>
                    <p><?php echo substr($event['description'],0,80) ?>...</p>
                    <div class="teacher_dashboard_deadline">
                      <?php
                      $evencrypted = $this->general->encryptParaID($event['eventid'],'event');
                      ?>
                      <a class="teacher_dashboard_deadline" href="<?php echo base_url() ?>index.php/teacher/eventDetail/<?php echo $evencrypted ?>">Read More</a>
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