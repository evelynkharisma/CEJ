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
                <div class="col-md-12 col-sm-12 col-xs-12 teacher_profile_label"><h2>Borrowed Collection</h2>
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

            <?php echo form_open_multipart("library/editBorrowedCollectionDetail/".$borrowedIDEncrypted);?>
           <div class="row">
               <div class="col-md-12 col-sm-12 col-xs-12">
                   <div class="profile_title">
                       <div class="col-md-12 teacher_profile_label">
                           <h4>Borrowing Information</h4>
                       </div>
                   </div>

                   <div class="col-md-12 col-sm-12 col-xs-12" style="margin-bottom: 15px">
                       <div class="col-md-2 col-sm-3 col-xs-12 teacher_profile_label">Borrowed Date</div>
                       <div class="col-md-6 col-sm-6 col-xs-12">
                           <?php echo date('d M Y', strtotime($borrowedCollectionData['borrowed_date'])) ?>
                       </div>
                   </div>
                   <div class="col-md-12 col-sm-12 col-xs-12" style="margin-bottom: 15px">
                       <div class="col-md-2 col-sm-3 col-xs-12 teacher_profile_label">Borrowing Period</div>
                       <div class="col-md-6 col-sm-6 col-xs-12">
                           <?php echo $borrowSetting['borrowingPeriod'].' days'?>
                       </div>
                   </div>
                   <input type="hidden" name="lbid" value="<?php echo $borrowedID?>"/>

               </div>
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
                            <?php echo $borrowedCollectionData['usertype'] ?>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12" style="margin-bottom: 15px">
                        <div class="col-md-2 col-sm-3 col-xs-12 teacher_profile_label">User ID</div>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <?php echo $borrowedCollectionData['userid'] ?>
                        </div>
                    </div>
                   <div class="col-md-12 col-sm-12 col-xs-12" style="margin-bottom: 15px">
                       <div class="col-md-2 col-sm-3 col-xs-12 teacher_profile_label">First Name</div>
                       <div class="col-md-6 col-sm-6 col-xs-12">
                           <?php echo $borrowedCollectionData['firstname']?>
                       </div>
                   </div>
                   <div class="col-md-12 col-sm-12 col-xs-12" style="margin-bottom: 15px">
                       <div class="col-md-2 col-sm-3 col-xs-12 teacher_profile_label">First Name</div>
                       <div class="col-md-6 col-sm-6 col-xs-12">
                           <?php echo $borrowedCollectionData['lastname']?>
                       </div>
                   </div>

                  </div>
            </div>
<!--            <a class="btn btn-danger set-right" href=""><i class="fa fa-times m-right-xs"></i>Collection Lost</a>-->
            <a data-toggle="modal" data-target="#upload" class="btn btn-primary set-right" ><i class="fa fa-book"></i> Return Collection</a>

        </div>
        <?php echo form_close(); ?>

        <div class="col-md-12 col-sm-12 col-xs-12">
            <div id="upload" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header ">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                            </button>
                            <div class="col-md-12 col-sm-12 col-xs-12 teacher_profile_label"><h2>Return Borrowed Collection</h2>
                            </div>
                        </div>
                        <?php
                        $encrypted = $this->general->encryptParaID($borrowedID,'libborrowed');

                        ?>
                        <div class="modal-body">
                            <?php echo form_open_multipart('library/returnBorrowed/'.$encrypted); ?>

                            <input type="hidden" name="lcid" value="<?php echo $collectionBorrowed['lcid']?>"/>
                            <div class="form-group">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="col-md-4 col-sm-4 col-xs-11 teacher_profile_label">Borrowed Date</div>
                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                        <?php echo date('d M Y', strtotime($borrowedCollectionData['borrowed_date'])) ?>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="col-md-4 col-sm-4 col-xs-11 teacher_profile_label">Borrowing Period</div>
                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                        <?php echo $borrowSetting['borrowingPeriod'].' days'?>
                                    </div>
                                </div>

                                <?php
                                $date1=date_create($borrowedCollectionData['borrowed_date']);
                                $date2=date_create(date("Y-m-d"));
                                $diff=date_diff($date1,$date2);
                                $late = $diff->format("%a");
                                ?>

                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="col-md-4 col-sm-4 col-xs-11 teacher_profile_label">Borrowing Period</div>
                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                        <?php echo $late.' day(s)'?>
                                    </div>
                                </div>

                                <?php
                                $fine = $fines['fine'] *$late;

                                ?>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="col-md-4 col-sm-4 col-xs-11 teacher_profile_label">Fine</div>
                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                        <?php echo 'IDR '.$fine?>
                                    </div>
                                </div>
                                <input type="hidden" name="fine" value="<?php echo $fine?>"/>

                            </div>
                        </div>
                        <div class="modal-footer" style="border: none">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                        </div>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
            <div class="clearfix">

            </div>
        </div>

        <!-- script change the active class in menu -->
        <script>
            document.getElementById("libmenu_borrowing").className = "active";
        </script>
