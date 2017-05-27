<!--<div class="banner about-banner-w3ls " id="home">-->
<!--    <h2>Collection</h2>-->
<!--</div>-->
<div class="contact-agile">
    <div class="faq">
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

        <div class="container">
            <div class="row" style="margin-bottom: 3vw">
                <div class="col-md-12 col-sm-12 col-xs-12"><h2>Collection</h2>
                </div>
            </div>

            <?php if (!empty($top2navigation)): ?>
                <?php $this->load->view($top2navigation); ?>
            <?php else: ?>
                Navigation not found !
            <?php endif; ?>

            <?php echo form_open_multipart("library/collection/");?>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="container">
                        <div class="col-md-2 col-sm-3 col-xs-12"><b>Find</b></div>
                        <div class="col-md-10 col-sm-9 col-xs-12">
                            <div class="col-md-2 col-sm-2 col-xs-12" style="padding: 0; margin-bottom: 15px; margin-right: 10px">
                                <select class="form-control" name="searchbase">
                                    <option value="author" selected>Author</option>
                                    <option value="isbn">ISBN</option>
                                    <option value="publisher">Publisher</option>
                                    <option value="title">Title</option>
                                </select>
                            </div>
                            <div class="col-md-9 col-sm-9 col-xs-12" style="padding: 0">
                                <input class="form-control" type="text" name="keyword" placeholder="keyword" >
                            </div>

                        </div>
                    </div>
                    <div class="container" style="margin-bottom: 15px">
                        <div class="col-md-2 col-sm-3 col-xs-12"><b>Type</b></div>
                        <div class="col-md-10 col-sm-9 col-xs-12">
                            <div class="col-md-2 col-sm-4 col-xs-12" style="padding: 0">
                                <select class="form-control" name="type">
                                    <option value="" selected>All Type</option>
                                    <option value="book">Book</option>
                                    <option value="journal">Journal</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="container" style="margin-bottom: 15px">
                        <div class="col-md-2 col-sm-3 col-xs-12"><b>Format</b></div>
                        <div class="col-md-10 col-sm-9 col-xs-12">
                            <div class="col-md-2 col-sm-4 col-xs-12" style="padding: 0">
                                <select class="form-control" name="format">
                                    <option  value="" selected>Any Format</option>
                                    <option value="book">Book</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="container" style="margin-bottom: 15px">
                        <div class="col-md-2 col-sm-3 col-xs-12"><b>Reading Level</b></div>
                        <div class="col-md-10 col-sm-4 col-xs-12">
                            <!--                        <div style="margin-left: -15px">-->
                            <div class="col-md-1 col-sm-12 col-xs-12" style="padding: 0">
                                From
                            </div>

                            <div class="col-md-2 col-sm-12 col-xs-12" style="padding: 0;  margin-right: 10px">
                                <input class="form-control" type="number" name="read_from" >
                            </div>
                            <div class="col-md-1 col-sm-12 col-xs-12" style="padding: 0;">to
                            </div>
                            <div class="col-md-2 col-sm-12 col-xs-12" style="padding: 0">
                                <input class="form-control" type="number" name="read_to" >
                            </div>
                            <!--                        </div>-->
                        </div>
                    </div>
                    <div class="container" style="margin-bottom: 15px">
                        <div class="col-md-2 col-sm-3 col-xs-12"><b>Interest Level</b></div>
                        <div class="col-md-10 col-sm-4 col-xs-12">
                            <div class="col-md-1 col-sm-12 col-xs-12" style="padding: 0">
                                From
                            </div>
                            <div class="col-md-2 col-sm-12 col-xs-12" style="padding: 0; margin-right: 10px">
                                <select class="form-control" name="interest_from">
                                    <option value="">Unlimited</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>
                                </select>
                                </select>
                            </div>
                            <div class="col-md-1 col-sm-12 col-xs-12" style="padding: 0">
                                to
                            </div>
                            <div class="col-md-2 col-sm-12 col-xs-12" style="padding: 0">
                                <select class="form-control" name="interest_to">
                                    <option value="">Unlimited</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="container" style="margin-bottom: 15px">
                        <div class="col-md-2 col-sm-3 col-xs-12"></div>
                        <div class="col-md-2 col-sm-2 col-xs-12">
                            <a class="btn btn-primary set-right" style="width: 100%" href="<?php echo base_url() ?>index.php/library"><i class="fa fa-search m-right-xs"></i> Search</a>
<!--                            <button type="submit" class="btn btn-primary set-right" >Search</button>-->
                        </div>
                    </div>
                </div>
                <?php echo form_close(); ?>

            </div>
    </div>
</div>

<!-- script change the active class in menu -->
<script>
    document.getElementById("libmenu_collection").className = "active";
</script>
