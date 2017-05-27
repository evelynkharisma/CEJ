<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Add Event</h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <?php if ($this->nativesession->get('error')): ?>
            <div  class="alert alert-error">
                <?php echo $this->nativesession->get('error'); ?>
            </div>
        <?php endif; ?>
        <?php if ($this->nativesession->get('success')): ?>
            <div  class="alert alert-success">
                <?php echo $this->nativesession->get('success');$this->nativesession->delete('success'); ?>
            </div>
        <?php endif; ?>
        <?php if (validation_errors()): ?>
            <div  class="alert alert-error">
                <?php echo validation_errors(); ?>
            </div>
        <?php endif; ?>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <?php echo form_open_multipart('admin/addEvent'); ?>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Title</label>
                            <div class="col-md-9 col-sm-9 col-xs-12 set-margin-bottom">
                                <input type="text" class="form-control set-margin-bottom set-margin-top" name="title" placeholder="Title"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Description</label>
                            <div class="col-md-9 col-sm-9 col-xs-12 set-margin-bottom">
                                <textarea id="long-text" class="form-control set-margin-bottom" name="description" rows="3" placeholder="Description"><?php if(isset($_POST['description'])) {echo htmlentities ($_POST['description']); }?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Date</label>
                            <div class="col-md-9 col-sm-9 col-xs-12 set-margin-bottom">
                                <input name="duedate" id="duedate" class="date-picker form-control col-md-7 col-xs-12" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12 set-margin-top">Participant</label>
                            <div class="col-md-9 col-sm-9 col-xs-12 set-margin-bottom set-margin-top">
                                <select  data-placeholder="Participant" name="participant[]" class="chosen-select form-control set-margin-bottom set-margin-top" multiple tabindex="6">
                                    <option value=""></option>
                                    <option value="0">All School Member</option>
                                    <optgroup label="Teacher">
                                        <option value="1">All Teacher</option>
                                        <?php if($teachers){
                                            foreach ($teachers as $t){
                                                ?>
                                                <option value="<?php echo $t['teacherid'] ?>"><?php echo $t['firstname'] ?> <?php echo $t['lastname'] ?></option>
                                        <?php
                                            }
                                        }?>
                                    </optgroup>
                                    <optgroup label="Student">
                                        <option value="2">All Student</option>
                                        <?php if($students){
                                            foreach ($students as $s){
                                                ?>
                                                <option value="<?php echo $s['studentid'] ?>"><?php echo $s['firstname'] ?> <?php echo $s['lastname'] ?></option>
                                                <?php
                                            }
                                        }?>
                                    </optgroup>
                                </select>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success set-margin-top"><i class="fa fa-upload"></i> Upload</button>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>List of Images</h2>
                        <!--                        <a target="_blank" href="--><?php //echo base_url() ?><!--index.php/teacher/addEventImage" class="btn btn-success set-right"><i class="fa fa-upload"></i> Upload</a>-->
                        <a data-toggle="modal" data-target="#upload" class="btn btn-success set-right"><i class="fa fa-upload"></i> Upload</a>

                        <div id="upload" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">

                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                                        </button>
                                        <h4 class="modal-title" id="myModalLabel">Upload Event Image</h4>
                                    </div>
                                    <div class="modal-body">
                                        <?php echo form_open_multipart('admin/addEventImage/'); ?>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">File</label>
                                            <div class="col-md-9 col-sm-9 col-xs-12 set-margin-bottom">
                                                <input class="btn btn-yellow" type="file" name="userfile" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-success"><i class="fa fa-upload"></i> Upload</button>
                                    </div>
                                    <?php echo form_close(); ?>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <table id="directoryView" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>Image</th>
                                <th>Link</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            if($images){
                                foreach($images as $info_db){ ?>
                                    <tr>
                                        <td>
                                            <div class="teacher_photo_crop">
                                                <img src="<?php echo base_url() ?>assets/img/texteditor/<?php echo $info_db['photo'] ?>" alt="..." class="teacher_photo_img">
                                            </div>
                                        </td>
                                        <td><?php echo base_url() ?>assets/img/texteditor/<?php echo $info_db['photo'] ?></td>
                                        <td width="30%">
                                            <?php
                                            $iencrypted = $this->general->encryptParaID($info_db['eiid'],'eventimage');
                                            ?>
                                            <a href="<?php echo base_url() ?>index.php/admin/deleteEventImage/<?php echo $iencrypted ?>" class="btn-success btn" onclick="return confirm('Are you sure want to delete this?');"><i class="fa fa-trash"></i> Delete</a>
                                        </td>
                                    </tr>
                                <?php }}
                            else {?>
                                <tr>
                                    <td colspan="3"><?php echo 'no forms found' ?></td>
                                </tr>
                            <?php } ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->