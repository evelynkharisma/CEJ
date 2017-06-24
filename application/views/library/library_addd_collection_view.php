<!-- page content -->

<div class="contact-agile">
    <div class="faq">
        <div class="container">
            <div class="row" style="margin-bottom: 3vw">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <h2>Add Collection</h2>
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
                </div>
            </div>

            <?php if (!empty($top2navigation)): ?>
                <?php $this->load->view($top2navigation); ?>
            <?php else: ?>
                Navigation not found !
            <?php endif; ?>

            <?php echo form_open_multipart("library/addCollection");?>
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
                            <input class="form-control teacher_profile_value" type="text" name="titleLA" placeholder="Leading Article" value="<?php if(isset($_POST['titleLA'])){ echo $_POST['titleLA'];}?>">
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input class="form-control teacher_profile_value" type="text" name="title" value="<?php if(isset($_POST['title'])){ echo $_POST['title'];}?>">
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12" style="margin-bottom: 15px">
                        <div class="col-md-2 col-sm-3 col-xs-12 teacher_profile_label">Subtitle</div>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input class="form-control teacher_profile_value" type="text" name="subtitle" value="<?php if(isset($_POST['subtitle'])){ echo $_POST['subtitle'];}?>">
                        </div>
                    </div>
                    <!--                    <div class="col-md-12 col-sm-12 col-xs-12" style="margin-bottom: 15px">-->
                    <!--                        <div class="col-md-2 col-sm-3 col-xs-12 teacher_profile_label">Author</div>-->
                    <!--                        <div class="col-md-6 col-sm-6 col-xs-12"><input class="form-control teacher_profile_value" type="text" name="author" placeholder="Author" ></div>-->
                    <!--                    </div>-->
                    <div class="col-md-12 col-sm-12 col-xs-12" style="margin-bottom: 15px">
                        <div class="col-md-2 col-sm-3 col-xs-12 teacher_profile_label">Edition</div>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input class="form-control teacher_profile_value" type="text" name="edition" value="<?php if(isset($_POST['edition'])){ echo $_POST['edition'];}?>">
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
                            <input class="form-control teacher_profile_value" type="text" name="lccn" value="<?php if(isset($_POST['lccn'])){ echo $_POST['lccn'];}?>">
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="col-md-2 col-sm-3 col-xs-12 teacher_profile_label">ISBN</div>
                        <div class="col-md-6 col-sm-6 col-xs-12 ">
                            <input class="form-control teacher_profile_value" type="number" name="isbn" value="<?php if(isset($_POST['isbn'])){ echo $_POST['isbn'];}?>">
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="col-md-2 col-sm-3 col-xs-12 teacher_profile_label">ISSN</div>
                        <div class="col-md-6 col-sm-6 col-xs-12 ">
                            <input class="form-control teacher_profile_value" type="number" name="issn" value="<?php if(isset($_POST['issn'])){ echo $_POST['issn'];}?>">
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="col-md-2 col-sm-3 col-xs-12 teacher_profile_label">Material Type</div>
                        <div class="col-md-6 col-sm-6 col-xs-12 ">
                            <input class="form-control teacher_profile_value" type="text" name="materialType" value="<?php if(isset($_POST['materialType'])){ echo $_POST['materialType'];}?>">
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="col-md-2 col-sm-3 col-xs-12 teacher_profile_label">Subtype</div>
                        <div class="col-md-6 col-sm-6 col-xs-12 ">
                            <input class="form-control teacher_profile_value" type="text" name="subtype" value="<?php if(isset($_POST['subtype'])){ echo $_POST['subtype'];}?>">
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
                            <input class="form-control teacher_profile_value" type="text" name="authorName" value="<?php if(isset($_POST['authorName'])){ echo $_POST['authorName'];}?>">
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="col-md-2 col-sm-3 col-xs-12 teacher_profile_label">Year</div>
                        <div class="col-md-6 col-sm-6 col-xs-12 ">
                            <input class="form-control teacher_profile_value" type="number" name="authorDate" value="<?php if(isset($_POST['authorDate'])){ echo $_POST['authorDate'];}?>">
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="col-md-2 col-sm-3 col-xs-12 teacher_profile_label">Publication Place</div>
                        <div class="col-md-6 col-sm-6 col-xs-12 ">
                            <input class="form-control teacher_profile_value" type="text" name="publicationPlace" value="<?php if(isset($_POST['publicationPlace'])){ echo $_POST['publicationPlace'];}?>">
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="col-md-2 col-sm-3 col-xs-12 teacher_profile_label">Publisher</div>
                        <div class="col-md-6 col-sm-6 col-xs-12 "><input class="form-control teacher_profile_value" type="text" name="publisher"  value="<?php if(isset($_POST['publisher'])){ echo $_POST['publisher'];}?>"></div>
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
                            <input class="form-control teacher_profile_value" type="text" name="uniformTitleLA" placeholder="Leading Article" value="<?php if(isset($_POST['uniformTitleLA'])){ echo $_POST['uniformTitleLA'];}?>">
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input class="form-control teacher_profile_value" type="text" name="uniformTitle" value="<?php if(isset($_POST['uniformTitle'])){ echo $_POST['uniformTitle'];}?>">
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12" style="margin-bottom: 15px">
                        <div class="col-md-2 col-sm-3 col-xs-12 teacher_profile_label">Varying Form</div>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input class="form-control teacher_profile_value" type="text" name="varyingForm" value="<?php if(isset($_POST['varyingForm'])){ echo $_POST['varyingForm'];}?>">
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12" style="margin-bottom: 15px">
                        <div class="col-md-2 col-sm-3 col-xs-12 teacher_profile_label">Seies Uniform Title</div>
                        <div class="col-md-2 col-sm-2 col-xs-12">
                            <input class="form-control teacher_profile_value" type="text" name="seriesUniformTitleLA" placeholder="Leading Article" value="<?php if(isset($_POST['seriesUniformTitleLA'])){ echo $_POST['seriesUniformTitleLA'];}?>">
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input class="form-control teacher_profile_value" type="text" name="seriesUniformTitle" value="<?php if(isset($_POST['seriesUniformTitle'])){ echo $_POST['seriesUniformTitle'];}?>" >
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
                        <div class="col-md-6 col-sm-6 col-xs-12"><input class="form-control teacher_profile_value" type="number" name="availability" ></div>
                    </div>
                </div>

            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
    <!-- script change the active class in menu -->
    <script>
        document.getElementById("libmenu_collection").className = "active";
    </script>
