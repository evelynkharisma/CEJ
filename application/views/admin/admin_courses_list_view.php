<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>All Courses</h3>
            </div>
            <?php
            $privilege = $this->general->checkPrivilege($this->nativesession->get('role'), 'p0013');
            if($privilege == 1){
            ?>
                <a href="<?php echo base_url() ?>index.php/admin/addCourse" class="btn btn-success set-right"><i class="fa fa-plus"></i> Add Course</a>
            <?php } ?>
        </div>

        <div class="clearfix"></div>

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
                                <th>Name</th>
                                <th>Description</th>
                                <th>Resources</th>
                                <?php
                                $privilege = $this->general->checkPrivilege($this->nativesession->get('role'), 'p0014');
                                if($privilege == 1){
                                ?>
                                <th>Action</th>
                                <?php } ?>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            if($info_dbs){
                                foreach($info_dbs as $info_db){ ?>
                                    <tr>
                                        <td><?php echo $info_db['coursename'] ?></td>
                                        <td><?php echo $info_db['coursedescription'] ?></td>
                                        <td>
                                            <?php
                                                $courseResources = explode('|', $info_db['courseresources']);
                                                foreach ($courseResources as $resource){
                                                    echo "<li>".$resource."</li>";
                                                }
                                            ?>
                                        </td>
                                    <?php
                                    $privilege = $this->general->checkPrivilege($this->nativesession->get('role'), 'p0014');
                                    if($privilege == 1){
                                        ?>
                                        <td width="30%">
                                            <?php
                                                $encrypted = $this->general->encryptParaID($info_db['courseid'],'course');
                                            ?>
                                            <a href="<?php echo base_url() ?>index.php/admin/deleteCourse/<?php echo $encrypted ?>" class="btn-success btn" onclick="return confirm('Are you sure want to delete this?');"><i class="fa fa-trash"></i> Delete</a>
                                            <a href="<?php echo base_url() ?>index.php/admin/editCourse/c<?php echo $encrypted ?>" class="btn-success btn"><i class="fa fa-edit"></i> Edit</a>
                                        </td>
                                        <?php } ?>
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