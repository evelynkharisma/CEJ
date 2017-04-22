<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Events</h3>
            </div>
            <?php
            $privilege = $this->general->checkPrivilege($this->session->userdata('role'), 'p0006');
            if($privilege == 1){
                ?>
                <a href="<?php echo base_url() ?>index.php/teacher/addEvent" class="btn btn-success set-right"><i class="fa fa-upload"></i> Upload</a>
            <?php } ?>
        </div>

        <div class="clearfix"></div>

        <?php if ($this->session->flashdata('success')): ?>
            <div  class="alert alert-success">
                <?php echo $this->session->flashdata('success'); ?>
            </div>
        <?php endif; ?>

        <?php if ($this->session->flashdata('error')): ?>
            <div  class="alert alert-error">
                <?php echo $this->session->flashdata('error'); ?>
            </div>
        <?php endif; ?>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
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
                                    <?php
                                        $privilege = $this->general->checkPrivilege($this->session->userdata('role'), 'p0007');
                                        if($privilege == 1){
                                    ?>
                                            <a href="<?php echo base_url() ?>index.php/teacher/deleteEvent/<?php echo $encrypted ?>" class="btn-success btn set-right" onclick="return confirm('Are you sure want to delete this?');"><i class="fa fa-trash"></i> Delete</a>
                                            <a href="<?php echo base_url() ?>index.php/teacher/editEvent/<?php echo $encrypted ?>" class="btn-success btn set-right"><i class="fa fa-edit"></i> Edit</a>
                                    <?php } ?>
                                            <p><?php echo substr($event['description'],0,150) ?>...</p>
                                            <div class="teacher_dashboard_deadline">
                                                <a class="teacher_dashboard_deadline" href="<?php echo base_url() ?>index.php/teacher/eventDetail/<?php echo $encrypted ?>">Read More</a>
                                            </div>
                                        </div>
                                    </article>
                                <?php }}
                            else {?>
                                <tr>
                                    <td colspan="3"><?php echo 'no event found' ?></td>
                                </tr>
                            <?php } ?>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->