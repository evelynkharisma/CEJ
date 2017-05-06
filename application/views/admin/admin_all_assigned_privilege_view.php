<!-- page content -->

<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Assigned Privileges</h3>
            </div>
        </div>

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
        <?php if ($this->nativesession->get('success')): ?>
            <div  class="alert alert-success">
                <?php echo $this->nativesession->get('success'); $this->nativesession->delete('success');?>
            </div>
        <?php endif; ?>
        <?php echo form_open('admin/allAssignedPrivilege');?>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <div class="col-md-8 col-sm-8 col-xs-12">
                            <h2>All Assigned Privileges</h2>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <table id="attendance" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th width="10%">No</th>
                                <th>Role ID</th>
                                <th>Role</th>
<!--                                <th>Privilege</th>-->
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if($assigned_roles){
                                $i = 1;
                                foreach ($assigned_roles as $assigned_role) {
                                    ?>
                                    <tr>
                                        <td><?php echo $i ?></td>
                                        <td><?php echo $assigned_role['roleid'] ?></td>
                                        <td><?php echo ucfirst($assigned_role['name']) ?></td>
<!--                                        <td>--><?php //echo ucfirst($privilege['privilegename']) ?><!--</td>-->
                                        <td>
                                            <?php
                                            $encrypted = $this->general->encryptParaID($assigned_role['roleid'],'role');
                                            ?>
                                            <a href="<?php echo base_url() ?>index.php/admin/deleteAssignedPrivilege/<?php echo $encrypted ?>" class="btn-success btn" onclick="return confirm('Are you sure want to delete this?');"><i class="fa fa-trash"></i> Delete</a>
                                            <a href="<?php echo base_url() ?>index.php/admin/editAssignedPrivilege/<?php echo $encrypted ?>" class="btn-success btn"><i class="fa fa-edit"></i> Edit</a>
                                        </td>
                                    </tr>
                                    <?php $i++; }} ?>
                            </tbody>
                        </table>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>