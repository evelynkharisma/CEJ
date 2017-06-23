<!--<div class="banner about-banner-w3ls " id="home">
    <h2> <?php /*echo ucwords($service['title'])*/?></h2>
</div>-->
<div class="wthree-main-content">

    <!-- About-page -->
    <div class="container">

    <h5 class="title-w3"><?php echo ucwords($service['title'])?></h5>
    <!-- About-page -->
    <div class="container">
        <?php $privilege = $this->general->checkPrivilege($this->nativesession->get('librole'), 'p0043');
        if($privilege == 1){?>
            <div class="row" style="margin-bottom: 3vw">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_content">
                            <?php $encrypted = $this->general->encryptParaID($service['serviceid'], "libservice") ?>
                            <a href="<?php echo base_url() ?>index.php/library/editService/<?php echo $encrypted?>" class="btn-primary btn set-right"><i class="fa fa-edit"></i>Edit Contact</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <?php echo $service['content']?>
            </div>
        </div>
    </div>
</div>
<!-- script change the active class in menu -->
<script>
    document.getElementById("libmenu_home").className = "active";
</script>
