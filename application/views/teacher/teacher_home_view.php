<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Dashboard</h3>
      </div>
    </div>

    <div class="clearfix"></div>

    <?php if ($this->session->flashdata('error')): ?>
      <div  class="alert alert-error">
        <?php echo $this->session->flashdata('error'); ?>
      </div>
    <?php endif; ?>

    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Today's Schedule</h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <div class="teacher_dashboard_today_schedule_container">
              <table class="teacher_dashboard_today_schedule_table">
                <tr>
                  <th class="teacher_dashboard_today_schedule_period">Period 1<br>time</th>
                  <th class="teacher_dashboard_today_schedule_period">Period 2<br>time</th>
                  <th class="teacher_dashboard_today_schedule_break" rowspan="2" width="5%">Break</th>
                  <th class="teacher_dashboard_today_schedule_period">Period 3<br>time</th>
                  <th class="teacher_dashboard_today_schedule_period">Period 4<br>time</th>
                  <th class="teacher_dashboard_today_schedule_break" rowspan="2" width="5%">Lunch</th>
                  <th class="teacher_dashboard_today_schedule_period">Period 5<br>time</th>
                  <th class="teacher_dashboard_today_schedule_period">Period 6<br>time</th>
                </tr>
                <tr>
                  <td>Subject<br>Room</td>
                  <td>Subject<br>Room</td>
                  <td>Subject<br>Room</td>
                  <td>Subject<br>Room</td>
                  <td>Subject<br>Room</td>
                  <td>Subject<br>Room</td>
                </tr>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
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
                  <a class="pull-left date <?php echo isset($event['teacherid']) && $event['teacherid'] != '0' ? 'quizandassignment' : '' ?>">
                    <p class="month"><?php echo date('F', strtotime($event['date'])) ?></p>
                    <p class="day"><?php echo date('d', strtotime($event['date'])) ?></p>
                  </a>
                  <div class="media-body">
                    <a class="title" href="#"><?php echo $event['title'] ?></a>
                    <p><?php echo $event['description'] ?></p>
                    <div class="teacher_dashboard_deadline">
                      <a class="teacher_dashboard_deadline" href="<?php echo base_url() ?>index.php/teacher/eventDetail/<?php echo $event['eventid'] ?>">Read More</a>
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