<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Course Name</h3>
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
                        <h2>Assignment Judul Submission</h2><a class="btn btn-danger set-right"><i class="fa fa-bell-o"></i> Notify All</a>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <table id="attendance" class="teacher_course_implementation">
                            <thead>
                            <tr>
                                <th width="15%">Photo</th>
                                <th width="25%">Name</th>
                                <th width="20%">Submission Date</th>
                                <th width="20%">Grading</th>
                                <th width="20%">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="teacher_photo_crop">
                                            <img src="<?php echo base_url() ?>assets/img/teacher/eve.jpg" alt="..." class="teacher_photo_img">
                                        </div>
                                    </td>
                                    <td>Evelyn Kharisma</td>
                                    <td>Tanggal Submission</td>
                                    <td>
                                        <?php echo form_open('teacher/courseSubmissionGrading'); ?>
                                            <button type="submit" class="btn btn-success set-right"><i class="fa fa-check"></i></button>
                                            <input style="width:70%;" class="form-control" placeholder='Score'>
                                        <?php echo form_close(); ?>
                                    </td>
                                    <td>
                                        <a class="btn btn-success"><i class="fa fa-download"></i> Download</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="teacher_photo_crop">
                                            <img src="<?php echo base_url() ?>assets/img/teacher/eve.jpg" alt="..." class="teacher_photo_img">
                                        </div>
                                    </td>
                                    <td>Evelyn Kharisma</td>
                                    <td>-</td>
                                    <td>
                                        <?php echo form_open('teacher/courseSubmissionGrading'); ?>
                                        <button type="submit" class="btn btn-success set-right"><i class="fa fa-check"></i></button>
                                        <input style="width:70%;" class="form-control" placeholder='Score'>
                                        <?php echo form_close(); ?>
                                    </td>
                                    <td>
                                        <a class="btn btn-danger"><i class="fa fa-bell-o"></i> Notify</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->