<!--<div class="banner about-banner-w3ls " id="home">-->
<!--    <h2>Contact</h2>-->
<!--</div>-->
<!--<div class="wthree-main-content">-->
    <div class="contact-agile" >
        <h5 class="title-w3"><?php echo $contact['title']?></h5>
        <div class="container">
            <?php $privilege = $this->general->checkPrivilege($this->nativesession->get('librole'), 'p0043');
            if($privilege == 1){?>
                <div class="row" style="margin-bottom: 3vw">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_content">
                                <?php $encrypted = $this->general->encryptParaID($contact['serviceid'], "libservice") ?>
                                <a href="<?php echo base_url() ?>index.php/library/editService/<?php echo $encrypted?>" class="btn-primary btn set-right"><i class="fa fa-edit"></i>Edit Service</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-10 col-sm-12 col-xs-12">
                    <?php echo $contact['content']?>
                </div>
            </div>
            <!--<div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div style="margin-bottom: 3vw" class="col-md-12 col-sm-12 col-xs-12">
                        <div ><h2>Contact</h2></div>
                    </div>
                    <?php /*echo form_open_multipart("library/contact"); */?>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                            <input class="form-control" type="text" name="firstname" placeholder="First Name" >
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                            <input class="form-control" type="text" name="lastname" placeholder="Last Name" >
                        </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                            <input class="form-control" type="text" name="email" placeholder="Email" >
                        </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                            <textarea class="form-control set-margin-bottom" name="message" style="border: 1px solid #ccc"><?php /*echo isset($student['address']) ? $student['address'] : ''; */?></textarea>
                        </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <a class="btn btn-success" href="<?php /*echo base_url() */?>index.php/library/contact" style="width: 100%"><i class="fa fa-send m-right-xs"></i> Send</a>
                    </div>
                    </div>
                    <?php /*echo form_close(); */?>
            </div>-->
        </div>
    </div>
<!--</div>-->