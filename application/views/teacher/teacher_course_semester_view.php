<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3><?php echo $info_db['coursename'] ?> <a class="btn btn-success set-right" href="<?php echo base_url() ?>index.php/teacher/editSemester/<?php echo $info_db['assignid'] ?>"><i class="fa fa-edit m-right-xs"></i> Edit Semester Plan</a></h3>
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
                        <h2>Semester Plan</h2>
                        <a href="<?php echo base_url() ?>index.php/teacher/printPreviewSemester/<?php echo $info_db['assignid'] ?>" target="_blank" class="btn btn-success set-right"><i class="fa fa-eye"></i> Print Preview</a>
                        
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <table class="teacher_course_implementation">
                            <thead>
                            <tr>
                                <th width="10%" style="text-align: center">Week</th>
                                <th width="20%">Topic</th>
                                <th width="20%">Outcome</th>
                                <th width="20%">Assessment</th>
                                <th width="20%">Resource</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            if($plans){
                                foreach($plans as $plan){ ?>
                                    <tr>
                                        <td align="center"><?php echo $plan['week'] ?></td>
                                        <td>Chapter <?php echo $plan['topic'] ?></td>
                                        <td><?php echo $plan['outcome'] ?></td>
                                        <td><?php echo $plan['assessment'] ?></td>
                                        <td><?php echo $plan['resources'] ?></td>
                                    </tr>
                                <?php }}
                            else {?>
                                <tr>
                                    <td colspan="5"><?php echo 'no lesson plan found' ?></td>
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