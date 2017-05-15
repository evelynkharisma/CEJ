<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3><?php echo $info_db['coursename'] ?></h3>
            </div>


        </div>

        <div class="clearfix"></div>

        <?php if (!empty($top2navigation)): ?>
            <?php $this->load->view($top2navigation); ?>
        <?php else: ?>
            Navigation not found !
        <?php endif; ?>
        
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Students</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <table class="teacher_course_implementation">
                            <thead>
                            <tr>
                                <th width="30%">Photo</th>
                                <th width="40%">Name</th>
                                <th width="30%">Action</th>
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
                                        <td><?php echo $student['firstname'] ?> <?php echo $student['lastname'] ?></td>
                                        <td>
                                            <?php
                                                $encrypted = $this->general->encryptParaID($info_db['assignid'],'courseassigned');
                                                $sencrypted = $this->general->encryptParaID($student['studentid'],'student');
                                            ?>
                                            <a href="<?php echo base_url() ?>index.php/admin/courseStudentPerformance/<?php echo $encrypted ?>/<?php echo $sencrypted ?>" class="btn btn-success"><i class="fa fa-edit"></i> Performance Detail</a>
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