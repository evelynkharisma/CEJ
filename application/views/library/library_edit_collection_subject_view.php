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


            <div class="row" style="margin-bottom: 1vw">
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
                                <div class="col-md-12 col-sm-12 col-xs-12 teacher_profile_label"><h2>Add Collection Subject</h2>
                                </div>
                            </div>
                            <div class="modal-body">
                                <?php echo form_open_multipart('library/addCollectionSubject/'.$encrypted); ?>
                                <div class="form-group">
                                    <div class="col-md-3 col-sm-3 col-xs-12 teacher_profile_label">Subject</div>
                                    <div class="col-md-9 col-sm-9 col-xs-12 set-margin-bottom">
                                        <input class="form-control" type="text" name="newsubject" />
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
            <a data-toggle="modal" data-target="#upload" class="btn btn-primary set-right" ><i class="fa fa-plus"></i> Add Subject</a>
<!--            <button type="submit" class="btn btn-primary set-right" name="submit" style="margin-right: 1vw" ><i class="fa fa-save m-right-xs"></i> Save Changes</button>-->

            <div class="row">
               <div class="col-md-12 col-sm-12 col-xs-12">
                   <div class="profile_title">
                       <div class="col-md-12 teacher_profile_label">
                           <h4>Collection Subject</h4>
                       </div>
                   </div>

                   <div class="container">
                       <div class="col-md-1"></div>
                       <div class="col-md-10 col-sm-12 col-xs-12">
                       <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                           <thead>
                           <tr>
                               <!--                                <th width="11%">Number</th>-->
                               <th width="70%">Subject</th>
                               <th >Action</th>

                           </tr>
                           </thead>
                           <tbody>
                           <?php
                           if($collectionSubjects) {
                               foreach ($collectionSubjects as $collectionSubject) {
                                   ?>
                                   <tr>
                                       <!--                                        <td>--><?php //echo $collection['lcid'] ?><!--</td>-->
                                       <td><?php echo $collectionSubject['subject'] ?></td>
                                       <td>
                                           <?php
                                           $encrypted = $this->general->encryptParaID($collectionSubject['lcid'],'collection');
                                           $encryptedS = $this->general->encryptParaID($collectionSubject['lcsid'],'collectionsubject');
                                           ?>
<!--                                           <a href="--><?php //echo base_url() ?><!--index.php/library/editCollection/--><?php //echo $encrypted ?><!--" class="btn-primary btn" ><i class="fa fa-edit"></i> Edit</a>-->
                                           <a data-toggle="modal" data-target="#edit<?php echo $collectionSubject['lcsid']?>" class="btn btn-primary" ><i class="fa fa-edit"></i> Edit</a>
                                           <a href="<?php echo base_url() ?>index.php/library/deleteCollectionSubject/<?php echo $encryptedS?>/<?php echo $encrypted?>" class="btn-primary btn" onclick="return confirm('Are you sure want to delete this?');"><i class="fa fa-trash"></i> Delete</a>
                                       </td>
                                   </tr>

                                   <div class="col-md-12 col-sm-12 col-xs-12" >
                                       <div id="edit<?php echo $collectionSubject['lcsid']?>" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
                                           <div class="modal-dialog modal-lg">
                                               <div class="modal-content">

                                                   <div class="modal-header ">
                                                       <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                                                       </button>
                                                       <div class="col-md-12 col-sm-12 col-xs-12 teacher_profile_label"><h2>Edit Collection Subject</h2>
                                                       </div>
                                                   </div>
                                                   <div class="modal-body">
                                                           <?php echo form_open_multipart('library/editCollectionSubject/'.$encryptedS.'/'.$encrypted); ?>
                                                       <div class="form-group">
                                                           <div class="col-md-3 col-sm-3 col-xs-12 teacher_profile_label">Subject</div>
                                                           <div class="col-md-9 col-sm-9 col-xs-12 set-margin-bottom">
                                                               <input class="form-control teacher_profile_value" type="text" name="editSubject" value="<?php echo set_value('edition', isset($collectionSubject['subject']) ? $collectionSubject['subject'] : ''); ?>">
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
<!--                                   <a  class="btn btn-primary set-right" ><i class="fa fa-plus"></i> Add Subject</a>-->
                                   <?php
                               }

                           }
                           ?>
                           </tbody>
                       </table>
                       </div>
                   </div>

                  </div>
            </div>
        </div>
    </div>
</div>
        <!-- script change the active class in menu -->
        <script>
            document.getElementById("libmenu_collection").className = "active";
        </script>
