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
            <?php echo form_open_multipart("library/editCollection/".$encrypted);?>
            <button type="submit" class="btn btn-primary set-right" href=""><i class="fa fa-save m-right-xs"></i> Save Collection</button>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="profile_title">
                        <div class="col-md-12 teacher_profile_label">
                            <h4>Title Information</h4>
                        </div>
                    </div>

                    <div class="col-md-12 col-sm-12 col-xs-12" style="margin-bottom: 15px">
                        <div class="col-md-2 col-sm-3 col-xs-12 teacher_profile_label">Title</div>
                        <div class="col-md-2 col-sm-2 col-xs-12">
                            <input class="form-control teacher_profile_value" type="text" name="titleLA" placeholder="Leading Article" value="<?php echo set_value('titleLA', isset($collection['titleLA']) ?$collection['titleLA'] : ''); ?>">
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input class="form-control teacher_profile_value" type="text" name="title" value="<?php echo set_value('title', isset($collection['title']) ?$collection['title'] : ''); ?>">
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12" style="margin-bottom: 15px">
                        <div class="col-md-2 col-sm-3 col-xs-12 teacher_profile_label">Subtitle</div>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input class="form-control teacher_profile_value" type="text" name="subtitle" value="<?php echo set_value('subtitle', isset($collection['subtitle']) ?$collection['subtitle'] : ''); ?>">
                        </div>
                    </div>
                    <!--                    <div class="col-md-12 col-sm-12 col-xs-12" style="margin-bottom: 15px">-->
                    <!--                        <div class="col-md-2 col-sm-3 col-xs-12 teacher_profile_label">Author</div>-->
                    <!--                        <div class="col-md-6 col-sm-6 col-xs-12"><input class="form-control teacher_profile_value" type="text" name="author" placeholder="Author" ></div>-->
                    <!--                    </div>-->
                    <div class="col-md-12 col-sm-12 col-xs-12" style="margin-bottom: 15px">
                        <div class="col-md-2 col-sm-3 col-xs-12 teacher_profile_label">Edition</div>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input class="form-control teacher_profile_value" type="text" name="edition" value="<?php echo set_value('edition', isset($collection['edition']) ?$collection['edition'] : ''); ?>">
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="profile_title">
                        <div class="col-md-12 teacher_profile_label">
                            <h4>Standard Numbers</h4>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="col-md-2 col-sm-3 col-xs-12 teacher_profile_label">LCCN</div>
                        <div class="col-md-6 col-sm-6 col-xs-12 ">
                            <input class="form-control teacher_profile_value" type="text" name="lccn" value="<?php echo set_value('lccn', isset($collection['lccn']) ?$collection['lccn'] : ''); ?>">
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="col-md-2 col-sm-3 col-xs-12 teacher_profile_label">ISBN</div>
                        <div class="col-md-6 col-sm-6 col-xs-12 ">
                            <input class="form-control teacher_profile_value" type="number" name="isbn" value="<?php echo set_value('isbn', isset($collection['isbn']) ?$collection['isbn'] : ''); ?>">
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="col-md-2 col-sm-3 col-xs-12 teacher_profile_label">ISSN</div>
                        <div class="col-md-6 col-sm-6 col-xs-12 ">
                            <input class="form-control teacher_profile_value" type="number" name="issn" value="<?php echo set_value('issn', isset($collection['issn']) ?$collection['issn'] : ''); ?>">
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="col-md-2 col-sm-3 col-xs-12 teacher_profile_label">Material Type</div>
                        <div class="col-md-6 col-sm-6 col-xs-12 ">
                            <input class="form-control teacher_profile_value" type="text" name="materialType" value="<?php echo set_value('materialType', isset($collection['materialType']) ?$collection['materialType'] : ''); ?>">
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="col-md-2 col-sm-3 col-xs-12 teacher_profile_label">Subtype</div>
                        <div class="col-md-6 col-sm-6 col-xs-12 ">
                            <input class="form-control teacher_profile_value" type="text" name="subtype" value="<?php echo set_value('subtype', isset($collection['subtype']) ?$collection['subtype'] : ''); ?>">
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="profile_title">
                        <div class="col-md-12 teacher_profile_label">
                            <h4>Author and Publisher</h4>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="col-md-2 col-sm-3 col-xs-12 teacher_profile_label">Name</div>
                        <div class="col-md-6 col-sm-6 col-xs-12 ">
                            <input class="form-control teacher_profile_value" type="text" name="authorName" value="<?php echo set_value('authorName', isset($collection['authorName']) ?$collection['authorName'] : ''); ?>">
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="col-md-2 col-sm-3 col-xs-12 teacher_profile_label">Year</div>
                        <div class="col-md-6 col-sm-6 col-xs-12 ">
                            <input class="form-control teacher_profile_value" type="number" name="authorDate" value="<?php echo set_value('authorDate', isset($collection['date']) ?$collection['date'] : ''); ?>">
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="col-md-2 col-sm-3 col-xs-12 teacher_profile_label">Publication Place</div>
                        <div class="col-md-6 col-sm-6 col-xs-12 ">
                            <input class="form-control teacher_profile_value" type="text" name="publicationPlace" value="<?php echo set_value('publicationPlace', isset($collection['publicationPlace']) ?$collection['publicationPlace'] : ''); ?>">
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="col-md-2 col-sm-3 col-xs-12 teacher_profile_label">Publisher</div>
                        <div class="col-md-6 col-sm-6 col-xs-12 ">
                            <input class="form-control teacher_profile_value" type="text" name="publisher"  value="<?php echo set_value('publisher', isset($collection['publisher']) ?$collection['publisher'] : ''); ?>">
                        </div>
                    </div>
                </div>
                <!-- <div class="col-md-12 col-sm-12 col-xs-12">
                     <div class="profile_title">
                         <div class="col-md-12 teacher_profile_label">
                             <h4 >Subject</h4>
                         </div>
                     </div>
                     <div class="col-md-12 col-sm-12 col-xs-12"><a class="btn btn-danger set-right removeSubject" ><i class="fa fa-minus m-right-xs"></i> Remove Subject</a>
                         <a class="btn btn-primary set-right addSubject" style="margin-right: 1vw"><i class="fa fa-plus m-right-xs"></i> Add Subject</a>
                     </div>
                     <div class="col-md-12 col-sm-12 col-xs-12 subjectToAdd">
                         <div class="col-md-2 col-sm-3 col-xs-12 teacher_profile_label">Subject</div>
                         <div class="col-md-6 col-sm-6 col-xs-12 "><input class="form-control teacher_profile_value" type="text" name="subject[]" ></div>
                     </div>
                     <div class="col-md-12 col-sm-12 col-xs-12 subjectToAdd">
                         <div class="col-md-2 col-sm-3 col-xs-12 teacher_profile_label">Subject</div>
                         <div class="col-md-6 col-sm-6 col-xs-12 "><input class="form-control teacher_profile_value" type="text" name="subject[]"></div>
                     </div>
                     <div class="col-md-12 col-sm-12 col-xs-12 subjectToAdd">
                         <div class="col-md-2 col-sm-3 col-xs-12 teacher_profile_label">Subject</div>
                         <div class="col-md-6 col-sm-6 col-xs-12 "><input class="form-control teacher_profile_value" type="text" name="subject[]"></div>
                     </div>

                 </div>-->
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="profile_title">
                        <div class="col-md-12 teacher_profile_label">
                            <h4>Alternate Title</h4>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12" style="margin-bottom: 15px">
                        <div class="col-md-2 col-sm-3 col-xs-12 teacher_profile_label">Uniform Title</div>
                        <div class="col-md-2 col-sm-2 col-xs-12">
                            <input class="form-control teacher_profile_value" type="text" name="uniformTitleLA" placeholder="Leading Article" value="<?php echo set_value('uniformTitleLA', isset($collection['uniformTitleLA']) ?$collection['uniformTitleLA'] : ''); ?>">
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input class="form-control teacher_profile_value" type="text" name="uniformTitle" value="<?php echo set_value('uniformTitle', isset($collection['uniformTitle']) ?$collection['uniformTitle'] : ''); ?>">
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12" style="margin-bottom: 15px">
                        <div class="col-md-2 col-sm-3 col-xs-12 teacher_profile_label">Varying Form</div>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input class="form-control teacher_profile_value" type="text" name="varyingForm" value="<?php echo set_value('uniformTitle', isset($collection['uniformTitle']) ?$collection['uniformTitle'] : ''); ?>">
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12" style="margin-bottom: 15px">
                        <div class="col-md-2 col-sm-3 col-xs-12 teacher_profile_label">Series Uniform Title</div>
                        <div class="col-md-2 col-sm-2 col-xs-12">
                            <input class="form-control teacher_profile_value" type="text" name="seriesUniformTitleLA" placeholder="Leading Article" value="<?php echo set_value('seriesUniformTitleLA', isset($collection['seriesUniformTitleLA']) ?$collection['seriesUniformTitleLA'] : ''); ?>">
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input class="form-control teacher_profile_value" type="text" name="seriesUniformTitle" value="<?php echo set_value('seriesUniformTitle', isset($collection['seriesUniformTitle']) ?$collection['seriesUniformTitle'] : ''); ?>">
                        </div>
                    </div>
                </div>
                <!--   <div class="col-md-12 col-sm-12 col-xs-12">
                       <div class="profile_title">
                           <div class="col-md-12 teacher_profile_label">
                               <h4>Co-authors, Ilustrators, Editor, etc</h4>
                           </div>
                       </div>
                       <div class="col-md-12 col-sm-12 col-xs-12" style="margin-bottom: 2vw"><a class="btn btn-danger set-right removeCoAuthor" ><i class="fa fa-minus m-right-xs"></i> Remove Co-author</a>
                           <a class="btn btn-primary set-right addCoAuthor" style="margin-right: 1vw"><i class="fa fa-plus m-right-xs"></i> Add Co-author</a>
                       </div>
                       <div class="col-md-12 col-sm-12 col-xs-12 coAuthorToAdd">
                           <div class="col-md-12 col-sm-12 col-xs-12">
                               <div class="col-md-1 col-sm-1 col-xs-1 teacher_profile_label">1</div>
                               <div class="col-md-2 col-sm-3 col-xs-11 teacher_profile_label">Name</div>
                               <div class="col-md-6 col-sm-6 col-xs-12"><input class="form-control teacher_profile_value" type="text" name="coAuthorName[]" ></div>
                           </div>
                           <div class="col-md-12 col-sm-12 col-xs-12">
                               <div class="col-md-1 col-sm-1 col-xs-1 teacher_profile_label"></div>
                               <div class="col-md-2 col-sm-3 col-xs-11 teacher_profile_label">Date</div>
                               <div class="col-md-6 col-sm-6 col-xs-12"><input class="form-control teacher_profile_value" type="date" name="coAuthorDate[]" ></div>
                           </div>
                           <div class="col-md-12 col-sm-12 col-xs-12">
                               <div class="col-md-1 col-sm-1 col-xs-1 teacher_profile_label"></div>
                               <div class="col-md-2 col-sm-3 col-xs-11 teacher_profile_label">Role</div>
                               <div class="col-md-6 col-sm-6 col-xs-12"><input class="form-control teacher_profile_value" type="text" name="coAuthorRole[]" ></div>
                           </div>
                       </div>
                       <div class="col-md-12 col-sm-12 col-xs-12 coAuthorToAdd">
                           <div class="col-md-12 col-sm-12 col-xs-12">
                               <div class="col-md-1 col-sm-1 col-xs-1 teacher_profile_label">2</div>
                               <div class="col-md-2 col-sm-3 col-xs-11 teacher_profile_label">Name</div>
                               <div class="col-md-6 col-sm-6 col-xs-12"><input class="form-control teacher_profile_value" type="text" name="coAuthorName[]" ></div>
                           </div>
                           <div class="col-md-12 col-sm-12 col-xs-12">
                               <div class="col-md-1 col-sm-1 col-xs-1 teacher_profile_label"></div>
                               <div class="col-md-2 col-sm-3 col-xs-11 teacher_profile_label">Date</div>
                               <div class="col-md-6 col-sm-6 col-xs-12"><input class="form-control teacher_profile_value" type="date" name="coAuthorDate[]" ></div>
                           </div>
                           <div class="col-md-12 col-sm-12 col-xs-12">
                               <div class="col-md-1 col-sm-1 col-xs-1 teacher_profile_label"></div>
                               <div class="col-md-2 col-sm-3 col-xs-11 teacher_profile_label">Role</div>
                               <div class="col-md-6 col-sm-6 col-xs-12"><input class="form-control teacher_profile_value" type="text" name="coAuthorRole[]" ></div>
                           </div>
                       </div>
                       <div class="col-md-12 col-sm-12 col-xs-12 coAuthorToAdd">
                           <div class="col-md-12 col-sm-12 col-xs-12">
                               <div class="col-md-1 col-sm-1 col-xs-1 teacher_profile_label">3</div>
                               <div class="col-md-2 col-sm-3 col-xs-11 teacher_profile_label">Name</div>
                               <div class="col-md-6 col-sm-6 col-xs-12"><input class="form-control teacher_profile_value" type="text" name="coAuthorName[]" ></div>
                           </div>
                           <div class="col-md-12 col-sm-12 col-xs-12">
                               <div class="col-md-1 col-sm-1 col-xs-1 teacher_profile_label"></div>
                               <div class="col-md-2 col-sm-3 col-xs-11 teacher_profile_label">Date</div>
                               <div class="col-md-6 col-sm-6 col-xs-12"><input class="form-control teacher_profile_value" type="date" name="coAuthorDate[]" ></div>
                           </div>
                           <div class="col-md-12 col-sm-12 col-xs-12">
                               <div class="col-md-1 col-sm-1 col-xs-1 teacher_profile_label"></div>
                               <div class="col-md-2 col-sm-3 col-xs-11 teacher_profile_label">Role</div>
                               <div class="col-md-6 col-sm-6 col-xs-12"><input class="form-control teacher_profile_value" type="text" name="coAuthorRole[]" ></div>
                           </div>
                       </div>
                   </div>-->
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="profile_title">
                        <div class="col-md-12 teacher_profile_label">
                            <h4>Availabitity</h4>
                        </div>
                    </div>

                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="col-md-2 col-sm-3 col-xs-11 teacher_profile_label">Availability</div>
                        <div class="col-md-6 col-sm-6 col-xs-12"><input class="form-control teacher_profile_value" type="number" name="availability" value="<?php echo set_value('availability', isset($collection['stock']) ?$collection['stock'] : ''); ?>">
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
