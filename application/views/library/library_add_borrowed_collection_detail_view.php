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

            <?php echo form_open_multipart("library/addBorrowedCollectionDetail");?>
           <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="profile_title">
                        <div class="col-md-12 teacher_profile_label">
                            <h4>Collection Information</h4>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12" >
                        <div class="col-md-2 col-sm-3 col-xs-12 teacher_profile_label">Collection ID</div>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <?php echo $collectionBorrowed['lcid'];?>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12" >
                        <div class="col-md-2 col-sm-3 col-xs-12 teacher_profile_label">Title</div>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <?php echo $collectionBorrowed['title'];?>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12" >
                        <div class="col-md-2 col-sm-3 col-xs-12 teacher_profile_label">Edition</div>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <?php echo $collectionBorrowed['edition'];?>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12" >
                        <div class="col-md-2 col-sm-3 col-xs-12 teacher_profile_label">Author</div>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <?php echo $collectionBorrowed['authorName']; ?>
                        </div>
                    </div>
                </div>
               <div class="col-md-12 col-sm-12 col-xs-12">
                   <div class="profile_title">
                       <div class="col-md-12 teacher_profile_label">
                           <h4>User Information</h4>
                       </div>
                   </div>

                    <div class="col-md-12 col-sm-12 col-xs-12" style="margin-bottom: 15px">
                        <div class="col-md-2 col-sm-3 col-xs-12 teacher_profile_label">User Type</div>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <?php echo $userType ?>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12" style="margin-bottom: 15px">
                        <div class="col-md-2 col-sm-3 col-xs-12 teacher_profile_label">User ID</div>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <?php echo $userID ?>
                        </div>
                    </div>
                   <div class="col-md-12 col-sm-12 col-xs-12" style="margin-bottom: 15px">
                       <div class="col-md-2 col-sm-3 col-xs-12 teacher_profile_label">First Name</div>
                       <div class="col-md-6 col-sm-6 col-xs-12">
                           <?php echo $borrower['firstname']?>
                       </div>
                   </div>
                   <div class="col-md-12 col-sm-12 col-xs-12" style="margin-bottom: 15px">
                       <div class="col-md-2 col-sm-3 col-xs-12 teacher_profile_label">First Name</div>
                       <div class="col-md-6 col-sm-6 col-xs-12">
                           <?php echo $borrower['lastname']?>
                       </div>
                   </div>
                   <div class="col-md-12 col-sm-12 col-xs-12" style="margin-bottom: 15px">
                       <div class="col-md-2 col-sm-3 col-xs-12 teacher_profile_label">Borrowing Period</div>
                       <div class="col-md-6 col-sm-6 col-xs-12">
                           <?php echo $borrowSetting['borrowingPeriod'].' days'?>
                       </div>
                   </div>
                   <input type="hidden" name="userid" value="<?php echo $userID?>"/>
                   <input type="hidden" name="firstname" value="<?php echo $borrower['firstname']?>"/>
                   <input type="hidden" name="lastname" value="<?php echo $borrower['lastname']?>"/>
                   <input type="hidden" name="userid" value="<?php echo $userID?>"/>
                   <input type="hidden" name="collid" value="<?php echo $collectionBorrowed['lcid']?>"/>
                   <input type="hidden" name="borrowSetting" value="<?php echo $borrowSetting['borrowCategory']?>"/>
                   <input type="hidden" name="usertype" value="<?php echo $userType?>"/>

                </div>
            </div>
            <button type="submit" class="btn btn-primary set-right" href=""><i class="fa fa-save m-right-xs"></i>Save Data</button>

        </div>
        <!-- script change the active class in menu -->
        <script>
            document.getElementById("libmenu_collection").className = "active";
        </script>
