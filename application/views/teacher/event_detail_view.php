<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <span class="media event">
                    <a class="pull-left date <?php echo isset($event['teacherid']) && $event['teacherid'] != '0' ? 'quizandassignment' : '' ?>">
                        <p class="month"><?php echo date('F', strtotime($event['date'])) ?></p>
                        <p class="day"><?php echo date('d', strtotime($event['date'])) ?></p>
                    </a>
                </span>
                <h3><?php echo $event['title'] ?></h3>
            </div>

            <?php
            $privilege = $this->general->checkPrivilege($this->nativesession->get('role'), 'p0007');
            if($privilege == 1){
                $encrypted = $this->general->encryptParaID($event['eventid'],'event');
                ?>
                <a href="<?php echo base_url() ?>index.php/teacher/editEvent/<?php echo $encrypted ?>" class="btn-success btn set-right"><i class="fa fa-edit"></i> Edit</a>
            <?php } ?>
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <p><?php echo $event['description'] ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->