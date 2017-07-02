<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Edit Student Information</h3>
            </div>
        </div>

        <div class="clearfix"></div>
        <?php if ($this->nativesession->get('success')): ?>
            <div  class="alert alert-success">
                <?php echo $this->nativesession->get('success'); $this->nativesession->delete('success');?>
            </div>
        <?php endif; ?>
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
        <?php
        $encrypted = $this->general->encryptParaID($student['studentid'],'student');
        ?>

        <div class="col-md-12 col-sm-12 col-xs-12">
            <div id="upload" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header ">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                            </button>
                            <div class="col-md-12 col-sm-12 col-xs-12 teacher_profile_label"><h2>Add Student Educational</h2>
                            </div>
                        </div>
                        <div class="modal-body">
                            <?php echo form_open_multipart('admin/addStudentEducational/'.$encrypted); ?>
                            <div class="form-group">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="col-md-2 col-sm-3 col-xs-11 edu_label">School Name</div>
                                    <div class="col-md-10 col-sm-9 col-xs-12"><input class="form-control edu_value" type="text" name="school"></div>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="col-md-2 col-sm-3 col-xs-11 edu_label">Start Date</div>
                                    <div class="col-md-10 col-sm-9 col-xs-12"><input class="form-control edu_value" type="date" name="start" value="<?php echo date("Y-m-d")?>"></div>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="col-md-2 col-sm-3 col-xs-11 edu_label">Finish Date</div>
                                    <div class="col-md-10 col-sm-9 col-xs-12"><input class="form-control edu_value" type="date" name="end" value="<?php echo date("Y-m-d")?>"></div>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12 edu_label">
                                    <div class="col-md-2 col-sm-3 col-xs-11 edu_label">Highest Grade</div>
                                    <div class="col-md-10 col-sm-9 col-xs-12"><input class="form-control edu_value" type="text" name="highest"></div>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12 edu_label">
                                    <div class="col-md-2 col-sm-3 col-xs-11 edu_label">Language</div>
                                    <div class="col-md-10 col-sm-9 col-xs-12"><input class="form-control edu_value" type="text" name="language"></div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer" style="border: none">
                            <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Save</button>
                        </div>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
            <div class="clearfix">

            </div>
        </div>


            <div class="row">
                <div class="x_panel">
                    <div class="x_content">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="col-md-5 col-sm-12 col-xs-12 profile_left">
                                <div class="profile_img">
                                    <div class="teacher_profile_crop">
                                        <!-- Current avatar -->
                                        <img class="img-responsive avatar-view teacher_profile_img" src="<?php echo base_url() ?>assets/img/student/<?php echo $student['photo']?>" alt="Avatar" title="Change the avatar">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-7 col-sm-12 col-xs-12">
                                <h3><?php echo $student['firstname'].' '.$student['lastname'] ?> </h3>

                                <ul class="list-unstyled user_data">
                                    <li>
                                        ID&emsp;&emsp;: <?php echo $student['studentid']; ?>
                                    </li>

                                </ul>
                            </div>
                            <div class="clearfix"></div>

                            <?php
                            $encrypted = $this->general->encryptParaID($student['studentid'],'student');
                            ?>

                        </div>
                    </div>
                </div>
                <a data-toggle="modal" data-target="#upload" class="btn btn-success set-right" ><i class="fa fa-plus"></i> Add Educational</a>
            </div>
                <div class="row">
<!--                    <div class="col-md-1"></div>-->
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="profile_title">
                            <div class="col-md-12 teacher_profile_label">
                                <h4>Student Educational Informatoin</h4>
                            </div>
                        </div>
                        <?php
                        $i=1;
                        if($studentEducational) {
                            foreach ($studentEducational as $edu) {
                                ?>
                                <div class="col-md-12 col-sm-12 col-xs-12" style="border-bottom: 1px solid lightgrey; margin-top: 1vw; padding-bottom: 1vw">
                                    <?php
                                    $encryptedSE = $this->general->encryptParaID($edu['seid'],'studenteducational');

                                    ?>

                                    <a class="btn btn-success set-right" onclick="return confirm('Are you sure want to delete this?');" href="<?php echo base_url() ?>index.php/admin/deleteStudentEducational/<?php echo $encryptedSE?>/<?php echo $encrypted?>"<"><i class="fa fa-trash m-right-xs"></i> Delete</a>
                                    <a data-toggle="modal" data-target="#edit<?php echo $edu['seid']?>" class="btn btn-success set-right" style="margin-right: 0.5vw"><i class="fa fa-edit"></i> Edit</a>

                                    <div class="col-md-12 col-sm-12 col-xs-12">

                                        <div class="col-md-2 col-sm-3 col-xs-11 teacher_profile_label">Name</div>
                                        <div class="col-md-6 col-sm-6 col-xs-12"><?php echo $edu['school']?>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <!--                                   <div class="col-md-1 col-sm-1 col-xs-1 teacher_profile_label"></div>-->
                                        <div class="col-md-2 col-sm-3 col-xs-11 teacher_profile_label">Start Date</div>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <?php echo date('d F Y', strtotime($edu['start'])) ?>
                                            <!--                                       <input class="form-control teacher_profile_value" type="date" name="coAuthorDate[]" value="--><?php //echo $collectionAuthor['date']?><!--">-->
                                        </div>

                                    </div>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <!--                                   <div class="col-md-1 col-sm-1 col-xs-1 teacher_profile_label"></div>-->
                                        <div class="col-md-2 col-sm-3 col-xs-11 teacher_profile_label">Finish Date</div>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <?php echo date('d F Y', strtotime($edu['end'])) ?>
                                            <!--                                       <input class="form-control teacher_profile_value" type="date" name="coAuthorDate[]" value="--><?php //echo $collectionAuthor['date']?><!--">-->
                                        </div>

                                    </div>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <!--                                   <div class="col-md-1 col-sm-1 col-xs-1 teacher_profile_label"></div>-->
                                        <div class="col-md-2 col-sm-3 col-xs-11 teacher_profile_label">Highest grade</div>
                                        <div class="col-md-6 col-sm-6 col-xs-12"><?php echo $edu['highestgrade']?>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12" >
                                    <div id="edit<?php echo $edu['seid']?>" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header ">
                                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                                                    </button>
                                                    <div class="col-md-12 col-sm-12 col-xs-12 teacher_profile_label"><h2>Edit Student Educational</h2>
                                                    </div>
                                                </div>
                                                <div class="modal-body">
                                                    <?php echo form_open_multipart('admin/editStudentEducational/'.$edu['seid']); ?>
                                                    <div class="form-group">
                                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                                            <div class="col-md-2 col-sm-3 col-xs-11 edu_label">School Name</div>
                                                            <div class="col-md-10 col-sm-9 col-xs-12"><input class="form-control edu_value" type="text" name="school" value="<?php echo set_value('school', isset($edu['school']) ? $edu['school'] : ''); ?>"></div>
                                                        </div>
                                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                                            <div class="col-md-2 col-sm-3 col-xs-11 edu_label">Start Date</div>
                                                            <div class="col-md-10 col-sm-9 col-xs-12"><input class="form-control edu_value" type="date" name="start" value="<?php echo set_value('start', isset($edu['start']) ? $edu['start'] : ''); ?>"></div>
                                                        </div>
                                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                                            <div class="col-md-2 col-sm-3 col-xs-11 edu_label">Finish Date</div>
                                                            <div class="col-md-10 col-sm-9 col-xs-12"><input class="form-control edu_value" type="date" name="end" value="<?php echo set_value('end', isset($edu['end']) ? $edu['end'] : ''); ?>"></div>
                                                        </div>
                                                        <div class="col-md-12 col-sm-12 col-xs-12 edu_label">
                                                            <div class="col-md-2 col-sm-3 col-xs-11 edu_label">Highest Grade</div>
                                                            <div class="col-md-10 col-sm-9 col-xs-12"><input class="form-control edu_value" type="text" name="highest" value="<?php echo set_value('highest', isset($edu['highestgrade']) ? $edu['highestgrade'] : ''); ?>"></div>
                                                        </div>
                                                        <div class="col-md-12 col-sm-12 col-xs-12 edu_label">
                                                            <div class="col-md-2 col-sm-3 col-xs-11 edu_label">Language</div>
                                                            <div class="col-md-10 col-sm-9 col-xs-12"><input class="form-control edu_value" type="text" name="language" value="<?php echo set_value('language', isset($edu['language']) ? $edu['language'] : ''); ?>"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer" style="border: none">
                                                    <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Save</button>
                                                </div>
                                                <?php echo form_close(); ?>
                                            </div>
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
        <?php echo form_close(); ?>
    </div>
</div>
<!-- /page content -->