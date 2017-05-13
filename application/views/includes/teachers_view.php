<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Teacher Directory</h3>
            </div>
        </div>

        <div class="clearfix"></div>

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
                                <th>Homeroom</th>
                                <th>Address</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Status</th>
                                <?php
                                $privilege = $this->general->checkPrivilege($this->nativesession->get('role'), 'p0005');
                                if($privilege == 1){
                                ?>
                                <th>Action</th>
                                <?php } ?>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if($teachers){
                                foreach ($teachers as $teacher){ ?>
                                    <tr>
                                        <td>
                                            <div class="teacher_photo_crop">
                                                <img src="<?php echo base_url() ?>assets/img/teacher/profile/<?php echo $teacher['photo'] ?>" alt="..." class="teacher_photo_img">
                                            </div>
                                        </td>
                                        <td><?php echo $teacher['firstname'] ?> <?php echo $teacher['lastname'] ?></td>
                                        <td><?php echo $teacher['classroom'] ?></td>
                                        <td><?php echo $teacher['address'] ?></td>
                                        <td><?php echo $teacher['email'] ?></td>
                                        <td><?php echo $teacher['phone'] ?></td>
                                        <td><?php echo (isset($teacher['active']) && $teacher['active'] == 1) ? 'Active' : 'Inactive' ?></td>
                                        <?php
                                        $privilege = $this->general->checkPrivilege($this->nativesession->get('role'), 'p0005');
                                        if($privilege == 1){
                                        ?>
                                        <td width="30%">
                                            <?php
                                            $encrypted = $this->general->encryptParaID($teacher['teacherid'],'teacher');
                                            ?>
                                                <a href="<?php echo base_url() ?>index.php/teacher/deleteTeacher/<?php echo $encrypted ?>" class="btn-success btn" onclick="return confirm('Are you sure want to delete this?');"><i class="fa fa-trash"></i> Delete</a>
                                                <a href="<?php echo base_url() ?>index.php/teacher/editTeacher/<?php echo $encrypted ?>" class="btn-success btn"><i class="fa fa-edit"></i> Edit</a>
                                        </td>
                                        <?php } ?>
                                    </tr>
                                <?php }} ?>
                            <?php if($teachersWithoutHomeroom){
                                foreach ($teachersWithoutHomeroom as $teacher){ ?>
                                    <tr>
                                        <td>
                                            <div class="teacher_photo_crop">
                                                <img src="<?php echo base_url() ?>assets/img/teacher/profile/<?php echo $teacher['photo'] ?>" alt="..." class="teacher_photo_img">
                                            </div>
                                        </td>
                                        <td><?php echo $teacher['firstname'] ?> <?php echo $teacher['lastname'] ?></td>
                                        <td>-</td>
                                        <td><?php echo $teacher['address'] ?></td>
                                        <td><?php echo $teacher['email'] ?></td>
                                        <td><?php echo $teacher['phone'] ?></td>
                                        <td><?php echo (isset($teacher['active']) && $teacher['active'] == 1) ? 'Active' : 'Inactive' ?></td>
                                        <?php
                                        $privilege = $this->general->checkPrivilege($this->nativesession->get('role'), 'p0005');
                                        if($privilege == 1){
                                            ?>
                                            <td width="30%">
                                                <?php
                                                $encrypted = $this->general->encryptParaID($teacher['teacherid'],'teacher');
                                                ?>
                                                <a href="<?php echo base_url() ?>index.php/teacher/deleteTeacher/<?php echo $encrypted ?>" class="btn-success btn" onclick="return confirm('Are you sure want to delete this?');"><i class="fa fa-trash"></i> Delete</a>
                                                <a href="<?php echo base_url() ?>index.php/teacher/editTeacher/<?php echo $encrypted ?>" class="btn-success btn"><i class="fa fa-edit"></i> Edit</a>
                                            </td>
                                        <?php } ?>
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