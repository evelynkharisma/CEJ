<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3><?php echo $info_db['coursename'] ?></h3>
            </div>


        </div>

        <div class="clearfix"></div>

        <?php if (!empty($top2navigation)): ?>
            <?php $this->load->view($top2navigation); ?>
        <?php else: ?>
            Navigation not found !
        <?php endif; ?>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Add Material</h2>
                        <div class="clearfix"></div>
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
                    </div>
                    <div class="x_content">
                        <?php
                            $encrypted = $this->general->encryptParaID($info_db['assignid'],'courseassigned');
                        ?>
                        <?php echo form_open_multipart('admin/addMaterial/'.$encrypted); ?>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Topic</label>
                            <div class="col-md-9 col-sm-9 col-xs-12 set-margin-bottom">
                                <select name="topic" class="form-control">
                                    <option disabled selected="selected">Topic</option>
                                    <?php foreach ($lessons as $lesson){?>
                                        <option value="<?php echo $lesson['activities']; ?>"><?php echo $lesson['activities']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Type</label>
                            <div class="col-md-9 col-sm-9 col-xs-12 set-margin-bottom">
                                <select name="type" class="form-control">
                                    <option disabled selected="selected">Type</option>
                                    <option value="Main Material">Main Material</option>
                                    <option value="Supporting Material">Supporting Material</option>
                                    <option value="References">References</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Existing File</label>
                            <div class="col-md-9 col-sm-9 col-xs-12 set-margin-bottom">
                                <select name="existingfile" class="form-control">
                                    <option disabled selected="selected">Files</option>
                                    <?php foreach ($files as $file){?>
                                        <option value="<?php echo $file['fileid']; ?>"><?php echo $file['filename']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <label class="set-margin-bottom control-label col-md-12 col-sm-12 col-xs-12">OR</label>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12 set-margin-top">New File</label>
                            <div class="col-md-9 col-sm-9 col-xs-12 set-margin-bottom">
                                <input class="btn btn-yellow" type="file" name="userfile" />
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success set-margin-top"><i class="fa fa-upload"></i> Upload</button>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->