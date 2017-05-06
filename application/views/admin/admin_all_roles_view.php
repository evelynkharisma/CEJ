<!-- page content -->

<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Roles</h3>
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
        <?php echo form_open('admin/allRoles'); ?>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <div class="col-md-8 col-sm-8 col-xs-12">
                            <h2>All Student</h2>
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
                                <th>Name</th>
                                <th>Category</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if($roles){
                                $i = 1;
                                foreach ($roles as $role) {
                                    ?>
                                    <tr>
                                        <td><?php echo $i ?></td>
                                        <td><?php echo $role['roleid'] ?></td>
                                        <td><?php echo ucfirst($role['name']) ?></td>
                                        <td><?php if ($role['category']=='1') {
                                                echo 'Teacher';
                                            } else if ($role['category']=='2') {
                                                echo 'Student';
                                            } else if ($role['category']=='3') {
                                                echo 'Administrator';
                                            } else if ($role['category']=='4') {
                                                echo 'Librarian';
                                            } else if ($role['category']=='5') {
                                                echo 'Parents';
                                            }
                                            ?></td>
                                        <td>
                                            <?php
                                            $encrypted = $this->general->encryptParaID($role['roleid'],'role');
                                            ?>
                                            <a href="<?php echo base_url() ?>index.php/admin/deleteRole/<?php echo $encrypted ?>" class="btn-success btn" onclick="return confirm('Are you sure want to delete this?');"><i class="fa fa-trash"></i> Delete</a>
                                            <a href="<?php echo base_url() ?>index.php/admin/editRole/<?php echo $encrypted ?>" class="btn-success btn"><i class="fa fa-edit"></i> Edit</a>
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