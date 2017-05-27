<!--<div class="banner about-banner-w3ls " id="home">-->
<!--    <h2>Contact</h2>-->
<!--</div>-->
<!--<div class="wthree-main-content">-->
    <div class="contact-agile" >
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div style="margin-bottom: 3vw" class="col-md-12 col-sm-12 col-xs-12">
                        <div ><h2>Contact</h2></div>
                    </div>
                    <?php echo form_open_multipart("library/contact"); ?>
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
                            <textarea class="form-control set-margin-bottom" name="message" style="border: 1px solid #ccc"><?php echo isset($student['address']) ? $student['address'] : ''; ?></textarea>
                        </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <a class="btn btn-success" href="<?php echo base_url() ?>index.php/library/contact" style="width: 100%"><i class="fa fa-send m-right-xs"></i> Send</a>
                    </div>
                    </div>
                    <?php echo form_close(); ?>
            </div>
        </div>
    </div>
<!--</div>-->