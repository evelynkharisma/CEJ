<!-- page content -->
<script type="text/javascript">
    function PrintDiv() {
        var divToPrint = document.getElementById('divToPrint');
        var popupWin = window.open('', '_blank', 'width=800,height=800');
        popupWin.document.open();
        popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
        popupWin.document.close();
    }
</script>
<div class="right_col" role="main">
    <div class="">

        <div class="page-title">
            <div class="title_left">
                <h3>Correspond</h3>
            </div>
        </div>

        <?php
        $result = 0;
        if($inbox){
            foreach($inbox as $inbox) {
                if($inbox['status'] == 0){
                    $result += 1;
                }
            }
        }
        ?>

        <div class="clearfix"></div>

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

                            <div class="col-md-9 col-xs-12" id="divToPrint">
                                <div class="inbox-body">
                                    <div class="mail_heading row">
                                        <div class="col-md-8">
                                            <div class="btn-group"><?php $encrypted = $this->general->encryptParaID($mail['correspondid'],'correspond');
                                                $this->nativesession->set('tempID', $encrypted);
                                                ?>
                                                <a href="<?php echo base_url() ?>index.php/parents/parent_correspond_reply"><button class="btn btn-sm btn-primary" type="button"><i class="fa fa-reply"></i> Reply</button></a>
                                                <a href="<?php echo base_url() ?>index.php/parents/parent_correspond_forward"><button class="btn btn-sm btn-default" type="button" data-placement="top" data-toggle="tooltip" data-original-title="Forward"><i class="fa fa-share"></i> Share</button></a>
                                                <a href=""><button class="btn btn-sm btn-default" type="button" data-placement="top" data-toggle="tooltip" data-original-title="Print" onclick="PrintDiv();"><i class="fa fa-print"> Print</i></button></a>
                                            </div>
                                        </div>
                                        <div class="col-md-4 text-right">
                                            <p class="date parent_date"><?php $date = date_create($mail['date']); echo date_format($date, 'g:i A d M Y'); ?></p>
                                        </div>
                                        <div class="col-md-12">
                                            <h4> <?php echo $mail['subject']; ?></h4>
                                        </div>
                                    </div>
                                    <div class="sender-info">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <strong><?php echo $sender['firstname'] ?> <?php echo $sender['lastname'] ?></strong> to
                                                <strong><?php echo $receiver['firstname'] ?> <?php echo $receiver['lastname'] ?></strong>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="view-mail"><br>
                                        <p><?php echo htmlspecialchars_decode(nl2br($mail['text']))?></p>
                                    </div>
                                    <?php
                                    $attachments = $this->Parent_model->getAllCorrespondAttachmentByID($mail['correspondid']);
                                    $total = $this->Parent_model->totalCorrespondAttachment($mail['correspondid']);
                                    if($attachments){?>

                                        <div class="attachment parent_attachment">
                                                <?php $directory = 'assets/file/correspond/'.$mail['correspondid']?>
                                                <span><i class="fa fa-paperclip"></i> <?php echo $total['count']?> attachments — </span>
                                                <a href='<?php echo base_url() ?>index.php/parents/downloadAll/<?php echo $mail['correspondid']?>'>Download all attachments</a>
                                            <ul>
                                    <?php foreach($attachments as $attachment){?>
                                                <li><?php $file = 'assets/file/correspond/'.$attachment['correspondid'].'/'.$attachment['attachment'];
                                                    $type = pathinfo($file, PATHINFO_EXTENSION);
                                                    ?>

                                                        <img src="<?php echo base_url() ?><?php if($type=='pdf'){ echo 'assets/icon/pdf.png';} else if($type=='docx'OR'doc'OR'gdoc'){ echo 'assets/icon/word.png';} else if($type=='xlsx'OR'xls'OR'gsheet'){ echo 'assets/icon/excel.png';} else if($type=='pptx'OR'gslides'OR'ppt'){ echo 'assets/icon/ppt.png';} else if($type=='jpg'OR'jpeg'OR'png'){ echo 'assets/file/correspond/'.$attachment['attachment'];} else { echo 'assets/icon/unknown.png';}?>" alt="img">



                                                    <div class="file-name">
                                                        <?php echo $attachment['attachment']?>
                                                    </div>
                                                    <span><?php
                                                        $filesize = filesize($file);
                                                        $filesize = round($filesize / 1024); // kilobytes with two digits
                                                        echo $filesize.'KB';
                                                        ?></span>


                                                    <div class="links">
<!--                                                        <a href="#">View</a> --->
                                                        <a download href="<?php echo $file ?>">Download</a>
                                                    </div>
                                                </li>
                                    <?php }?>
                                            </ul>
                                        </div>
                                    <?php }?>
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
