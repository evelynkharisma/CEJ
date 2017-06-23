<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Events</h3>
            </div>
        </div>

        <div class="clearfix"></div>

        <?php if ($this->nativesession->get('success')): ?>
            <div  class="alert alert-success">
                <?php echo $this->nativesession->get('success');$this->nativesession->delete('success'); ?>
            </div>
        <?php endif; ?>

        <?php if ($this->nativesession->get('error')): ?>
            <div  class="alert alert-error">
                <?php echo $this->nativesession->get('error');$this->nativesession->delete('error'); ?>
            </div>
        <?php endif; ?>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <div class="clearfix"></div>
                    </div>
                     <iv class="x_content">
                            <?php
                            if($info_dbs){
                                foreach($info_dbs as $event){ ?>
                                    <article class="media event">
                                        <a class="pull-left date <?php echo isset($event['teacherid']) && $event['teacherid'] != '0' ? 'quizandassignment' : '' ?>">
                                            <p class="month"><?php echo date('F', strtotime($event['date'])) ?></p>
                                            <p class="day"><?php echo date('d', strtotime($event['date'])) ?></p>
                                        </a>
                                        <div class="media-body">
                                            <?php
                                                $encrypted = $this->general->encryptParaID($event['eventid'],'event');
                                            ?>
                                            <a class="title" href="#"><?php echo $event['title'] ?></a>
                                            <p><?php echo substr($event['description'],0,150) ?>...</p>
                                            <div class="teacher_dashboard_deadline">
                                                <a class="teacher_dashboard_deadline" href="<?php echo base_url() ?>index.php/student/eventDetail/<?php echo $encrypted ?>">Read More</a>
                                            </div>
                                        </div>
                                    </article>
                                <?php }}
                            else {?>
                                    <?php echo 'no event found' ?>
                            <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->