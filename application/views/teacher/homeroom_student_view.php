<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Student List</h3>
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
                        <table id="attendance" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>Photo</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if($students){
                                foreach ($students as $student){ ?>
                                    <tr>
                                        <td>
                                            <div class="teacher_photo_crop">
                                                <img src="<?php echo base_url() ?>assets/img/student/<?php echo $student['photo'] ?>" alt="..." class="teacher_photo_img">
                                            </div>
                                        </td>
                                        <td><?php echo $student['firstname'] ?></td>
                                        <td><?php echo $student['lastname'] ?></td>
                                        <td>
                                            <?php
                                                $encrypted = $this->general->encryptParaID($student['studentid'],'student');
                                            ?>
                                            <a href="<?php echo base_url() ?>index.php/teacher/homeroomReport/<?php echo $encrypted ?>/1" class="btn btn-success"><i class="fa fa-eye"></i> Term 1</a>
                                            <a href="<?php echo base_url() ?>index.php/teacher/homeroomReport2/<?php echo $encrypted ?>/1" class="btn btn-success"><i class="fa fa-eye"></i> Term 2</a>
                                            <a href="<?php echo base_url() ?>index.php/teacher/homeroomReport/<?php echo $encrypted ?>/2" class="btn btn-success"><i class="fa fa-eye"></i> Term 3</a>
                                            <a href="<?php echo base_url() ?>index.php/teacher/homeroomReport2/<?php echo $encrypted ?>/2" class="btn btn-success"><i class="fa fa-eye"></i> Term 4</a>
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