<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Edit Role </h3>
            </div>
        </div>

        <div class="clearfix"></div>
        <?php if ($this->nativesession->get('success')): ?>
            <div  class="alert alert-success">
                <?php echo $this->nativesession->get('success'); $this->nativesession->delete('success');?>
            </div>
        <?php endif; ?>
        <?php echo form_open_multipart("admin/addAssignedPrivilege/");?>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <div class="col-md-12 col-sm-12 col-xs-12 profile_left">
                            <button type="submit" class="btn btn-success set-right"><i class="fa fa-save m-right-xs"></i> Save Changes</button>
                            <br />

                        </div>
<!--                        <input type="hidden" class="form-control set-margin-bottom" name="parentid" value="--><?php //echo $privilege_assign['paid']; ?><!--"/>-->
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="profile_title">
                                <div class="col-md-12">
                                    <h2>Assign Privilege Information</h2>
                                </div>
                            </div>
                            <div class="col-md-12">

                                <!--<div class="col-md-4 col-sm-4 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Assigned Privilege ID</div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_value">
                                            <input type="text" class="form-control set-margin-bottom" name="roleid" value="<?php /*echo $privilege_assign['paid'] */?>" readonly/>
                                        </div>
                                    </div>
                                </div>-->
                                <div class="col-md-4 col-sm-4 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Role</div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_value">
                                            <select class="form-control set-margin-bottom" name="roleassigned">
                                                <?php if($roles){
                                                foreach ($roles as $role) {
                                                    ?>
                                                    <option value='<?php echo $role['roleid'] ?>'> <?php echo $role['roleid'].' - '.ucfirst($role['name']) ?></option>
                                                    <?php
                                                }}
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-4 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_label">Privilege</div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="teacher_profile_group">
                                        <div class="teacher_profile_value">
                                        <?php if($privileges){
                                            foreach ($privileges as $privilege) {
                                                ?>
                                                    <input type="checkbox" name="privileges[]" style="display: inline" value='<?php echo $privilege['privilegeid'] ?>'> <?php echo ucfirst($privilege['name']) ?> </input><br>
                                                    <?php
                                                    }
                                                }
                                                ?>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>
<!-- /page content -->