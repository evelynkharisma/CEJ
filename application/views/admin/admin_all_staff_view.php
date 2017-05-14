<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Staff Directory</h3>
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
                                <th>Photo</th>
                                <th>Name</th>
<!--                                <th>Homeroom</th>-->
                                <th>Address</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Role</th>
                                <?php
                                $privilege = $this->general->checkPrivilege($this->nativesession->get('role'), 'p0029');
                                if($privilege == 1){
                                    ?>
                                    <th>Action</th>
                                <?php } ?>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if($admins){
                                foreach ($admins as $admin){ ?>
                                    <tr>
                                        <td>
                                            <div class="teacher_photo_crop">
                                                <img src="<?php echo base_url() ?>assets/img/admin/<?php echo $admin['photo'] ?>" alt="..." class="teacher_photo_img">
                                            </div>
                                        </td>
                                        <td><?php echo ucfirst($admin['firstname']) ?> <?php echo ucfirst($admin['lastname']) ?></td>
<!--                                        <td>--><?php //echo $admin['classroom'] ?><!--</td>-->
                                        <td><?php echo $admin['address'] ?></td>
                                        <td><?php echo $admin['email'] ?></td>
                                        <td><?php echo $admin['phone'] ?></td>
                                        <td><?php echo $admin['name'] ?></td>
<!--                                        <td>--><?php //if($admin['active']) { echo  "Active";}
//                                            else { echo "Not Active"; }?><!--</td>-->
                                            <td width="30%">
                                                <?php
                                                $encrypted = $this->general->encryptParaID($admin['adminid'],'admin');

                                                $privilege = $this->general->checkPrivilege($this->nativesession->get('role'), 'p0030');
                                                if($privilege == 1){
                                                    ?>
                                                    <a href="<?php echo base_url() ?>index.php/admin/deleteAdmin/<?php echo $encrypted ?>" class="btn-success btn" onclick="return confirm('Are you sure want to delete this?');"><i class="fa fa-trash"></i> Delete</a>
                                                    <?php
                                                }
                                                $privilege = $this->general->checkPrivilege($this->nativesession->get('role'), 'p0029');
                                                if($privilege == 1){
                                                    ?>
                                                    <a href="<?php echo base_url() ?>index.php/admin/editAdmin/<?php echo $encrypted ?>" class="btn-success btn"><i class="fa fa-edit"></i> Edit</a>
                                                <?php } ?>
                                            </td>
                                        <?php } ?>
                                    </tr>
                            <?php } ?>
                            <?php if($operators){
                                foreach ($operators as $operator){ ?>
                                    <tr>
                                    <td>
                                        <div class="teacher_photo_crop">
                                            <img src="<?php echo base_url() ?>assets/img/operation/<?php echo $operator['photo'] ?>" alt="..." class="teacher_photo_img">
                                        </div>
                                    </td>
                                    <td><?php echo ucfirst($operator['firstname']) ?> <?php echo ucfirst($operator['lastname']) ?></td>
                                    <!--                                        <td>--><?php //echo $admin['classroom'] ?><!--</td>-->
                                    <td><?php echo $operator['address'] ?></td>
                                    <td><?php echo $operator['email'] ?></td>
                                    <td><?php echo $operator['phone'] ?></td>
                                    <td><?php echo $operator['name'] ?></td>
                                    <!--                                        <td>--><?php //if($admin['active']) { echo  "Active";}
                                    //                                            else { echo "Not Active"; }?><!--</td>-->
                                    <td width="30%">
                                        <?php
                                        $encrypted = $this->general->encryptParaID($admin['adminid'],'admin');
                                        $encrypted_role = $this->general->encryptParaID($admin['role'],'role');

                                        $privilege = $this->general->checkPrivilege($this->nativesession->get('role'), 'p0027');
                                        if($privilege == 1){
                                            ?>
                                            <a href="<?php echo base_url() ?>index.php/admin/deleteParent/<?php echo $encrypted?>/<?php echo $encrypted_role?>" class="btn-success btn" onclick="return confirm('Are you sure want to delete this?');"><i class="fa fa-trash"></i> Delete</a>
                                            <?php
                                        }
                                        $privilege = $this->general->checkPrivilege($this->nativesession->get('role'), 'p0032');
                                        if($privilege == 1){
                                            ?>
                                            <a href="<?php echo base_url() ?>index.php/admin/editParent/<?php echo $encrypted ?>" class="btn-success btn"><i class="fa fa-edit"></i> Edit</a>
                                        <?php } ?>
                                    </td>
                                <?php } ?>
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