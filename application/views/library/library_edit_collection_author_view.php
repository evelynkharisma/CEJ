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
                <div class="col-md-12 col-sm-12 col-xs-12 teacher_profile_label"><h2>Edit Collection Data</h2>
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
            <?php
            $encrypted = $this->general->encryptParaID($collection['lcid'],'collection');
            ?>
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div id="upload" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header ">
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                                </button>
                                <div class="col-md-12 col-sm-12 col-xs-12 teacher_profile_label"><h2>Add Collection Co-Author</h2>
                                </div>
                            </div>
                            <div class="modal-body">
                                <?php echo form_open_multipart('library/addCollectionAuthor/'.$encrypted); ?>
                                <div class="form-group">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="col-md-2 col-sm-3 col-xs-11 teacher_profile_label">Name</div>
                                        <div class="col-md-10 col-sm-9 col-xs-12"><input class="form-control teacher_profile_value" type="text" name="newCoAuthorName"></div>
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="col-md-2 col-sm-3 col-xs-11 teacher_profile_label">Date</div>
                                        <div class="col-md-10 col-sm-9 col-xs-12"><input class="form-control teacher_profile_value" type="date" name="newCoAuthorDate" value="<?php echo date("Y-m-d")?>"></div>
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-xs-12 teacher_profile_label">
                                        <div class="col-md-2 col-sm-3 col-xs-11 teacher_profile_label">Role</div>
                                        <div class="col-md-10 col-sm-9 col-xs-12"><input class="form-control teacher_profile_value" type="text" name="newCoAuthorRole"></div>
                                    </div>
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
            <a data-toggle="modal" data-target="#upload" class="btn btn-primary set-right" ><i class="fa fa-plus"></i> Add Co-Author</a>


            <div class="row">
               <div class="col-md-12 col-sm-12 col-xs-12">
                   <div class="profile_title">
                       <div class="col-md-12 teacher_profile_label">
                           <h4>Co-Authors, Ilustrators, Editor, etc</h4>
                       </div>
                   </div>
                   <?php
                   $i=1;
                   if($collectionAuthors) {
                       foreach ($collectionAuthors as $collectionAuthor) {
                    ?>
                           <div class="col-md-12 col-sm-12 col-xs-12" style="border-bottom: 1px solid lightgrey; margin-bottom: 1vw; padding-bottom: 1vw">
                               <?php
                               $encrypted = $this->general->encryptParaID($collectionAuthor['lcid'],'collection');
                               $encryptedA = $this->general->encryptParaID($collectionAuthor['lcaid'],'collectionauthor');
                               ?>

                               <a class="btn btn-primary set-right" onclick="return confirm('Are you sure want to delete this?');" href="<?php echo base_url() ?>index.php/library/deleteCollectionAuthor/<?php echo $encryptedA?>/<?php echo $encrypted?>"<"><i class="fa fa-minus m-right-xs"></i> Delete</a>
                               <a data-toggle="modal" data-target="#edit<?php echo $collectionAuthor['lcaid']?>" class="btn btn-primary set-right" style="margin-right: 0.5vw" ><i class="fa fa-edit"></i> Edit</a>

                               <div class="col-md-12 col-sm-12 col-xs-12">

                                   <div class="col-md-2 col-sm-3 col-xs-11 teacher_profile_label">Name</div>
                                   <div class="col-md-6 col-sm-6 col-xs-12"><?php echo $collectionAuthor['name']?>
                                       </div>
                               </div>
                               <div class="col-md-12 col-sm-12 col-xs-12">
<!--                                   <div class="col-md-1 col-sm-1 col-xs-1 teacher_profile_label"></div>-->
                                   <div class="col-md-2 col-sm-3 col-xs-11 teacher_profile_label">Date</div>
                                   <div class="col-md-6 col-sm-6 col-xs-12">
                                       <?php echo date('d F Y', strtotime($collectionAuthor['date'])) ?>
<!--                                       <input class="form-control teacher_profile_value" type="date" name="coAuthorDate[]" value="--><?php //echo $collectionAuthor['date']?><!--">-->
                                   </div>

                               </div>
                               <div class="col-md-12 col-sm-12 col-xs-12">
<!--                                   <div class="col-md-1 col-sm-1 col-xs-1 teacher_profile_label"></div>-->
                                   <div class="col-md-2 col-sm-3 col-xs-11 teacher_profile_label">Role</div>
                                   <div class="col-md-6 col-sm-6 col-xs-12">
                                       <?php
                                       if($collectionAuthor['role']==1) {
                                           echo "Co-Author";
                                       }
                                       else if($collectionAuthor['role']==2) {
                                           echo "Editor";
                                       }
                                       else  if($collectionAuthor['role']==3) {
                                           echo "Illustrator";
                                       }
                                       ?>
<!--                                       <input class="form-control teacher_profile_value" type="text" name="coAuthorRole[]" value="--><?php //echo $collectionAuthor['role']?><!--">-->
                                   </div>
                               </div>
                           </div>
                           <div class="col-md-12 col-sm-12 col-xs-12" >
                               <div id="edit<?php echo $collectionAuthor['lcaid']?>" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
                                   <div class="modal-dialog modal-lg">
                                       <div class="modal-content">

                                           <div class="modal-header ">
                                               <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                                               </button>
                                               <div class="col-md-12 col-sm-12 col-xs-12 teacher_profile_label"><h2>Edit Collection Co-Author</h2>
                                               </div>
                                           </div>
                                           <div class="modal-body">
                                               <?php echo form_open_multipart('library/editCollectionAuthor/'.$encryptedA.'/'.$encrypted); ?>
                                               <div class="form-group">
                                                   <div class="col-md-12 col-sm-12 col-xs-12">
                                                       <div class="col-md-2 col-sm-3 col-xs-11 teacher_profile_label">Name</div>
                                                       <div class="col-md-10 col-sm-9 col-xs-12">
                                                           <input class="form-control teacher_profile_value" type="text" name="editCoAuthorName" value="<?php echo set_value('editCoAuthorName', isset($collectionAuthor['name']) ? $collectionAuthor['name'] : ''); ?>">
                                                       </div>
                                                   </div>
                                                   <div class="col-md-12 col-sm-12 col-xs-12">
                                                       <div class="col-md-2 col-sm-3 col-xs-11 teacher_profile_label">Date</div>
                                                       <div class="col-md-10 col-sm-9 col-xs-12">
                                                           <input class="form-control teacher_profile_value" type="date" name="editCoAuthorDate" value="<?php echo set_value('editCoAuthorDate', isset($collectionAuthor['date']) ? $collectionAuthor['date'] : ''); ?>">
                                                       </div>
                                                   </div>
                                                   <div class="col-md-12 col-sm-12 col-xs-12 teacher_profile_label">
                                                       <div class="col-md-2 col-sm-3 col-xs-11 teacher_profile_label">Role</div>
                                                       <div class="col-md-10 col-sm-9 col-xs-12">
                                                           <input class="form-control teacher_profile_value" type="text" name="editCoAuthorRole" value="<?php echo set_value('editCoAuthorRole', isset($collectionAuthor['role']) ? $collectionAuthor['role'] : ''); ?>">
                                                       </div>
                                                   </div>
                                               </div>
                                           </div>
                                           <div class="modal-footer" style="border: none">
                                               <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                                           </div>
                                           <?php echo form_close(); ?>
                                       </div>
                                   </div>
                               </div>
                           </div>
                   <?php
                       $i++;
                       }
                   }?>
               </div>
            </div>
        </div>
    </div>
</div>
        <!-- script change the active class in menu -->
        <script>
            document.getElementById("libmenu_collection").className = "active";
        </script>
