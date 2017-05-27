<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Download</h3>
            </div>
            <?php
            $privilege = $this->general->checkPrivilege($this->nativesession->get('role'), 'p0011');
            if($privilege == 1){
            ?>
            <a href="<?php echo base_url() ?>index.php/admin/addForm" class="btn btn-success set-right"><i class="fa fa-upload"></i> Upload</a>
            <?php } ?>
        </div>

        <div class="clearfix"></div>

        <?php if ($this->nativesession->get('success')): ?>
            <div  class="alert alert-success">
                <?php echo $this->nativesession->get('success');$this->nativesession->delete('success'); ?>
            </div>
        <?php endif; ?>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <table id="directoryView" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            if($info_dbs){
                                foreach($info_dbs as $info_db){ ?>
                                    <tr>
                                        <td><?php echo $info_db['title'] ?></td>
                                        <td><?php echo $info_db['description'] ?></td>
                                        <td width="30%">
                                            <?php
                                                $encrypted = $this->general->encryptParaID($info_db['formid'],'form');
                                            ?>
                                            <a download href="<?php echo base_url() ?>assets/file/forms/<?php echo $info_db['formname'] ?>" class="btn btn-success"><i class="fa fa-download"></i> Download</a>
                                    <?php
                                    $privilege = $this->general->checkPrivilege($this->nativesession->get('role'), 'p0012');
                                    if($privilege == 1){
                                        ?>
                                            <a href="<?php echo base_url() ?>index.php/admin/deleteForm/<?php echo $encrypted ?>" class="btn-success btn" onclick="return confirm('Are you sure want to delete this?');"><i class="fa fa-trash"></i> Delete</a>
                                            <a href="<?php echo base_url() ?>index.php/admin/editForm/<?php echo $encrypted ?>" class="btn-success btn"><i class="fa fa-edit"></i> Edit</a>
                                        <?php } ?>
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