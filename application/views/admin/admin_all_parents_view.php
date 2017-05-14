<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Parent Directory</h3>
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
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Children</th>
                                <th>Address</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Status</th>
                                <?php
                                $privilege = $this->general->checkPrivilege($this->nativesession->get('role'), 'p0016');
                                if($privilege == 1){
                                    ?>
                                    <th>Action</th>
                                <?php } ?>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if($parents){
                                foreach ($parents as $parent){ ?>
                                    <tr>
                                        <td>
                                            <div class="teacher_photo_crop">
                                                <img src="<?php echo base_url() ?>assets/img/parents/profile/<?php echo $parent['photo'] ?>" alt="..." class="teacher_photo_img">
                                            </div>
                                        </td>
                                        <td><?php echo ucfirst($parent['firstname']) ?> <?php echo ucfirst($parent['lastname']) ?></td>
                                        <td><?php
                                            if($parentschilds) {
                                                foreach($parentschilds as $parentschild) {
                                                    if($parentschild['parentid']==$parent['parentid']){
                                                        echo $parentschild['firstname'].'<br>';
                                                    }
                                                }
                                            }
                                            ?></td>
                                        <td><?php echo $parent['address'] ?></td>
                                        <td><?php echo $parent['email'] ?></td>
                                        <td><?php echo $parent['phone'] ?></td>
                                        <td><?php if($parent['active']) { echo  "Active";}
                                            else { echo "Not Active"; }?></td>

                                        <td width="30%">
                                            <?php
                                            $encrypted = $this->general->encryptParaID($parent['parentid'],'parent');

                                            $privilege = $this->general->checkPrivilege($this->nativesession->get('role'), 'p0016');
                                            if($privilege == 1){
                                                ?>
                                                <a href="<?php echo base_url() ?>index.php/admin/deleteParent/<?php echo $encrypted ?>" class="btn-success btn" onclick="return confirm('Are you sure want to deactivate this?');"><i class="fa fa-trash"></i> Deacivate</a>
                                                <?php
                                            }
                                            $privilege = $this->general->checkPrivilege($this->nativesession->get('role'), 'p0016');
                                            if($privilege == 1){
                                                ?>
                                                <a href="<?php echo base_url() ?>index.php/admin/editParent/<?php echo $encrypted ?>" class="btn-success btn"><i class="fa fa-edit"></i> Edit</a>
                                            <?php } ?>
                                        </td>

                                    </tr>
                                <?php }} ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->