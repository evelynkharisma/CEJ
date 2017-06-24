<!--<div class="banner about-banner-w3ls " id="home">-->
<!--    <h2>About</h2>-->
<!--</div>-->
<div class="wthree-main-content">
    <!-- About-page -->
    <div class="container">
<!--        <div class="head-top-w3ls"><i class="fa fa-graduation-cap" aria-hidden="true"></i></div>-->
        <h5 class="title-w3"><?php echo $about['title']?></h5>
        <div class="container">
            <?php $privilege = $this->general->checkPrivilege($this->nativesession->get('librole'), 'p0043');
            if($privilege == 1){?>
                <div class="row" style="margin-bottom: 3vw">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_content">
                                <?php $encrypted = $this->general->encryptParaID($about['serviceid'], "libservice") ?>
                                <a href="<?php echo base_url() ?>index.php/library/editService/<?php echo $encrypted?>" class="btn-primary btn set-right"><i class="fa fa-edit"></i>Edit Service</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-10 col-sm-12 col-xs-12">
                    <?php echo $about['content']?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- script change the active class in menu -->
<script>
    document.getElementById("libmenu_about").className = "active";
</script>
