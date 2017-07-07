<!-- page content -->

<div class="faq">
    <div class="container">
        <div class="row" style="margin-bottom: 3vw">
            <div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 1vw">
<!--                <h2>Borrowed Collection</h2>-->
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

        <div class="row" style="margin-bottom: 3vw">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <h2>Home Slides</h2>
            </div>
        </div>

        <div class="col-md-12 col-sm-12 col-xs-12">
            <div id="upload" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header ">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                            </button>
                            <div class="col-md-12 col-sm-12 col-xs-12 teacher_profile_label"><h2>Upload Home Slide Image</h2>
                            </div>
                        </div>
                        <div class="modal-body">
                            <?php echo form_open_multipart('library/addHomeSlide'); ?>
                            <div class="form-group">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="col-md-5 col-sm-4 col-xs-12 teacher_profile_label">File</div>
                                    <div class="col-md-7 col-sm-8 col-xs-12">
                                        <input class="btn btn-yellow" type="file" name="userfile" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer" style="border: none; margin-top: 1vw">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                        </div>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
            <div class="clearfix">

            </div>
        </div>
        <a data-toggle="modal" data-target="#upload" class="btn btn-primary" style="margin-bottom: 2vw" ><i class="fa fa-upload"></i> Upload</a>


<!--        <a href="--><?php //echo base_url() ?><!--index.php/library/addBorrowingSetting" class="btn btn-primary lib-top-btn" style="margin-bottom: 2vw">Add Borrowing Setting</a>-->

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="container">
                    <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                            <tr>
<!--                                <th width="11%">Number</th>-->
                                <th width="5%">No</th>
                                <th width="15%">Image</th>
                                <th width="15%">Name</th>
                                <th width="15%">Action</th>

                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            if($infodb) {
                                $i = 1;
                                foreach ($infodb as $info) {
                            ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td>
                                            <img width="200" src="<?php echo base_url() ?>assets/img/library/slide/<?php echo $info['name']?>"
                                        </td>
                                        <td><?php echo $info['name'] ?></td>
                                        <td>
                                            <a data-toggle="modal" data-target="#edit<?php echo $info['id']?>" class="btn btn-primary" ><i class="fa fa-edit"></i> Edit</a>
                                            <a href="<?php echo base_url() ?>index.php/library/deleteFineSetting/<?php echo $info['id']?>" class="btn-primary btn" onclick="return confirm('Are you sure want to delete this?');"><i class="fa fa-trash"></i> Delete</a>
                                        </td>
                                    </tr>

                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div id="edit<?php echo $info['id']?>" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header ">
                                                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                                                        </button>
                                                        <div class="col-md-12 col-sm-12 col-xs-12 teacher_profile_label"><h2>Edit Home Slide Image</h2>
                                                        </div>
                                                    </div>
                                                    <div class="modal-body" style="margin-bottom: 2vw">
                                                        <?php echo form_open_multipart('library/editHomeSlide/'.$info['id']); ?>
                                                        <div class="form-group">
                                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                                <div class="col-md-5 col-sm-4 col-xs-12 teacher_profile_label">Image</div>
                                                                <div class="col-md-7 col-sm-8 col-xs-12">
                                                                    <?php echo $info['name']?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                                <div class="col-md-5 col-sm-4 col-xs-12 teacher_profile_label">File</div>
                                                                <div class="col-md-7 col-sm-8 col-xs-12">
                                                                    <input class="btn btn-yellow" type="file" name="userfile" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer" style="border: none; margin-top: 1vw">
                                                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                                                    </div>
                                                    <?php echo form_close(); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="clearfix">

                                        </div>
                                    </div>

                            <?php
                                    $i++;
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
<script>
    $(document).ready(function(){
        $('#example').dataTable();
    });
</script>
<script>
    document.getElementById("libmenu_home").className = "active";
</script>
<!-- /page content -->