<!--<div class="banner about-banner-w3ls " id="home">-->
<!--    <h2>Collection</h2>-->
<!--</div>-->
<div class="contact-agile">
    <div class="faq">


        <div class="container">

            <?php if (!empty($top2navigation)): ?>
                <?php $this->load->view($top2navigation); ?>
            <?php else: ?>
                Navigation not found !
            <?php endif; ?>


            <div class="row" style="margin-bottom: 3vw">
                <div class="col-md-12 col-sm-12 col-xs-12 teacher_profile_label"><h2>Add Borrowing Collection</h2>
                </div>
            </div>


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

            <?php echo form_open_multipart("library/addBorrowedCollection");?>
           <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <!--<div class="profile_title">
                        <div class="col-md-12 teacher_profile_label">
                            <h4>Title Information</h4>
                        </div>
                    </div>-->
                    <div class="col-md-12 col-sm-12 col-xs-12" >
                        <div class="col-md-2 col-sm-3 col-xs-12 teacher_profile_label">Collection ID</div>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input class="form-control teacher_profile_value" type="text" name="collID" value="<?php echo set_value('collID', isset($collectionBorrowed['lcid']) ?$collectionBorrowed['lcid'] : ''); ?>">
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12" style="margin-bottom: 15px">
                        <div class="col-md-2 col-sm-3 col-xs-12 teacher_profile_label">User Type</div>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select class="form-control" name="usertype">
                                <option value='Student' >Student</option>
                                <option value='Teacher' >Teacher</option>
                                <option value='Admnistrator' >Admnistrator</option>
                                <option value='Operator' >Operator</option>
                                <option value='Librarian' >Librarian</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="col-md-2 col-sm-3 col-xs-12 teacher_profile_label">User ID</div>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input class="form-control teacher_profile_value" type="text" name="userID" value="<?php echo set_value('userID', isset($collectionBorrowed['userid']) ?$collectionBorrowed['userid'] : ''); ?>">
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12" style="margin-bottom: 15px">
                        <div class="col-md-2 col-sm-3 col-xs-12 teacher_profile_label">Borrowing Period</div>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select class="form-control" name="borrSetting">
                                <?php if($borrowSetting) {
                                    foreach ($borrowSetting as $bs) {
                                        ?>
                                        <option value="<?php echo $bs['borrowCategory']?>" ><?php echo $bs['borrowingPeriod']?> days</option>";
                                <?php
                                    }
                                }
                                    ?>
                            </select>
                        </div>
                    </div>

                </div>
            </div>
            <button type="submit" class="btn btn-primary set-right" href=""><i class="fa fa-eye m-right-xs"></i>View Detail</button>

        </div>
        <!-- script change the active class in menu -->
        <script>
            document.getElementById("libmenu_collection").className = "active";
        </script>
