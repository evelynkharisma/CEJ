<!-- page content -->

                                                                                                                                                                                                                <div class="contact-agile">
<div class="faq">
    <div class="container">
        <div class="row" style="margin-bottom: 3vw">
            <div class="col-md-12 col-sm-12 col-xs-12">
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

                <h2>Useful Link</h2>
            </div>
        </div>

        <div class="col-md-12 col-sm-12 col-xs-12">
            <div id="upload" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header ">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                            </button>
                            <div class="col-md-12 col-sm-12 col-xs-12 teacher_profile_label"><h2>Add Useful Link Category</h2>
                            </div>
                        </div>
                        <div class="modal-body">
                            <?php echo form_open_multipart('library/addUsefulLinkCategory'); ?>
                            <div class="form-group">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="col-md-2 col-sm-3 col-xs-11 teacher_profile_label">Category</div>
                                    <div class="col-md-10 col-sm-9 col-xs-12"><input class="form-control teacher_profile_value" type="text" name="category"></div>
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
        <a data-toggle="modal" data-target="#upload" class="btn btn-primary set-right" style="margin-bottom: 1vw"><i class="fa fa-plus"></i> Add Useful Link Category</a>


        <div class="row" >
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="container">
                    <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                            <tr>
<!--                                <th width="11%">Number</th>-->
                                <th width="5%">No</th>
                                <th width="65%">Category</th>
                                <th width="30%">Action</th>

                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            if($infodb) {
                                $i=1;
                                foreach ($infodb as $n) {
                            ?>
                                    <tr>
<!--                                        <td>--><?php //echo $n['lcid'] ?><!--</td>-->
                                        <td><?php echo $i ?></td>
                                        <td><?php echo $n['name'] ?></td>
                                        <td>
                                            <a href="<?php echo base_url() ?>index.php/library/usefulLinkContent/<?php echo $n['category'] ?>" class="btn-primary btn" ><i class="fa fa-eye"></i> View Content</a>
                                            <a data-toggle="modal" data-target="#edit<?php echo $n['category']?>" class="btn btn-primary"><i class="fa fa-edit"></i> Edit</a>
                                            <a href="<?php echo base_url() ?>index.php/library/deleteUsefulLinkCategory/<?php echo $n['category']?>" class="btn-primary btn" onclick="return confirm('Are you sure want to delete this?');"><i class="fa fa-trash"></i> Delete</a>
                                        </td>
                                    </tr>
                                    <div class="col-md-12 col-sm-12 col-xs-12" >
                                        <div id="edit<?php echo $n['category']?>" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">

                                                    <div class="modal-header ">
                                                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                                                        </button>
                                                        <div class="col-md-12 col-sm-12 col-xs-12 teacher_profile_label"><h2>Edit Useful Link Category</h2>
                                                        </div>
                                                    </div>
                                                    <div class="modal-body">
                                                        <?php echo form_open_multipart('library/editUsefulLinkCategory/'.$n['category']); ?>
                                                        <div class="form-group">
                                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                                <div class="col-md-2 col-sm-3 col-xs-11 teacher_profile_label">Category</div>
                                                                <div class="col-md-10 col-sm-9 col-xs-12">
                                                                    <input class="form-control teacher_profile_value" type="text" name="category" value="<?php echo set_value('category', isset($n['name']) ? $n['name'] : ''); ?>">
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
<!-- /page content -->