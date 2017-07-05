<!-- page content -->
<div class="right_col" role="main">
    <div class="">

        <div class="page-title">
            <div class="title_left">
                <h3>Correspond</h3>
            </div>
        </div>

        <?php
        $result = 0;
        if($mails){
            foreach($mails as $mail) {
                if($mail['status'] == 0){
                    $result += 1;
                }
            }
        }
        ?>

        <div class="clearfix"></div>

        <?php if ($this->nativesession->get('success')): ?>
            <div  class="alert alert-success">
                <?php echo $this->nativesession->get('success'); $this->nativesession->delete('success');?>
            </div>
        <?php endif; ?>
        
        <div class="row">
            <div class="col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Parent's Mail</h2>
                        <div class="clearfix"></div>
                    </div>

                    <div class="container">
                        <div class="row inbox">
                            <div class="col-md-3 col-xs-12">
                                <div class="panel panel-default">
                                    <div class="panel-body inbox-menu">
                                        <a href="<?php echo base_url() ?>index.php/parents/parent_correspond_compose"><button id="compose" class="btn btn-sm btn-success btn-block" type="button">COMPOSE</button></a>
                                        <ul>
                                            <li>
                                                <a href="<?php echo base_url() ?>index.php/parents/parent_correspond"><i class="fa fa-inbox"></i> Inbox <?php if($result!=''){?><span class="label label-danger"><?php echo $result;}?></span></a>
                                            </li>
                                            <li>
                                                <a href="<?php echo base_url() ?>index.php/parents/parent_correspond_sent"><i class="fa fa-rocket"></i> Sent</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div><!--/.col-->

                            <div class="col-md-9 col-xs-12">
                                <div class="panel panel-default">
                                    <div class="panel-body message">
                                        <table id="correspond" class="table table-hover">
                                            <thead>
                                            <tr>
                                                <th>
                                                    <div class="inbox-name">From</div>
                                                    <div class="inbox-attachment"></div>
                                                    <div class="inbox-subjects">Subject</div>
                                                    <div class="inbox-date">Date</div>
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            if($mails){
                                                foreach($mails as $mail){
                                                $encrypted = $this->general->encryptParaID($mail['correspondid'],'correspond');
                                                if(!empty($this->Parent_model->getAllCorrespondAttachmentByID($mail['correspondid']))){$attachment = 1;}else $attachment=0;
                                                ?>
                                            <tr>
                                                <td class="inbox-<?php if($mail['status']=='1'){ echo 'read'; } else{ echo'unread'; }?>">
                                                    <a href="<?php echo base_url() ?>index.php/parents/parent_correspond_detail/<?php echo $encrypted;?>">
                                                        <div class="inbox-name"><?php echo $mail['firstname'] ?> <?php echo $mail['lastname'] ?></div>
                                                        <div class="inbox-attachment<?php if($attachment==0){echo ' transparent';} ?>"><i class="fa fa-paperclip"></i></div>
                                                        <div class="inbox-subjects"><?php echo $mail['subject'] ?><small> - <?php echo $mail['text'] ?></small></div>
                                                        <div class="inbox-date"><?php $date = date_create($mail['date']); echo date_format($date, 'F d'); ?></div>
                                                    </a>
                                                </td>
                                            </tr>
                                            <?php }}
                                            else {?>
                                                <tr>
                                                    <td colspan="4"><?php echo 'no message' ?></td>
                                                </tr>
                                            <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div><!--/.col-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->
