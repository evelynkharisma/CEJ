<!--<div class="banner about-banner-w3ls " id="home">
    <h2> <?php /*echo ucwords($service['title'])*/?></h2>
</div>-->
<div class="wthree-main-content">

    <!-- About-page -->
    <div class="container">
        <?php if ($this->nativesession->get('error')): ?>
            <div  class="alert alert-error">
                <?php echo $this->nativesession->get('error');$this->nativesession->delete('error'); ?>
            </div>
        <?php endif; ?>
        <?php if (validation_errors()): ?>
            <div  class="alert alert-error">
                <?php echo validation_errors(); ?>
            </div>
        <?php endif; ?>
        <?php if ($this->nativesession->get('success')): ?>
            <div  class="alert alert-success">
                <?php echo $this->nativesession->get('success'); $this->nativesession->delete('success');?>
            </div>
        <?php endif; ?>

        <h5 class="title-w3">Edit News</h5>
        <?php echo form_open_multipart("library/editNews/".$eNewsID); ?>
        <?php $privilege = $this->general->checkPrivilege($this->nativesession->get('librole'), 'p0043');
        if($privilege == 1){?>
            <div class="row" style="margin-bottom: 3vw">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_content">
                            <button type="submit" class="btn btn-primary set-right" href=""><i class="fa fa-edit"></i>Edit News</button>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>


        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="container" style="margin-bottom: 15px">
                        <div class="col-md-2 col-sm-3 col-xs-12"><b>Title</b></div>
                        <div class="col-md-10 col-sm-9 col-xs-12">
                            <input class="form-control" type="text" name="title" placeholder="aaa" value="<?php echo set_value('title', isset($news['title']) ? $news['title'] : ''); ?>" >
                        </div>
                </div>
                    <div class="container" style="margin-bottom: 15px">
                        <div class="col-md-2 col-sm-3 col-xs-12"><b>Content</b></div>
                        <div class="col-md-10 col-sm-9 col-xs-12">
                            <textarea id="long-text" class="form-control set-margin-bottom" name="content" rows="10" placeholder="Description"><?php echo isset($news['content']) ? htmlspecialchars($news['content']) : ''; ?></textarea>
                        </div>
                    </div>

            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>
<!-- script change the active class in menu -->
<script>
    document.getElementById("libmenu_home").className = "active";
</script>
