<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3><?php echo $info_db['coursename'] ?></h3>
            </div>


        </div>

        <div class="clearfix"></div>

        <?php if ($this->session->flashdata('success')): ?>
            <div  class="alert alert-success">
                <?php echo $this->session->flashdata('success'); ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($top2navigation)): ?>
            <?php $this->load->view($top2navigation); ?>
        <?php else: ?>
            Navigation not found !
        <?php endif; ?>
        
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Lesson Implementation</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <table class="teacher_course_implementation">
                            <thead>
                                <tr>
                                    <th width="10%" style="text-align: center">Session</th>
                                    <th width="40%">Lesson Plan</th>
                                    <th width="50%">Lesson Implementation</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php echo form_open_multipart('teacher/courseImplementation/'.$info_db['assignid']); ?>
                            <input type="hidden" class="form-control set-margin-bottom" name="assignid" value="<?php echo $info_db['assignid']; ?>"/>
                            <?php
                            if($plans){
                                $i = 0;
                                foreach($plans as $plan){ ?>
                                    <tr>
                                        <td align="center"><?php echo $plan['lessoncount'] ?></td>
                                        <td><?php echo $plan['activities'] ?></td>
                                        <td><textarea <?php if(isset($implementation[$i]['implementation']) && $implementation[$i]['implementation'] != null) echo 'readonly rows="1"'; ?> class="form-control set-margin-bottom" name="implementation[]"><?php echo isset($implementation[$i]['implementation']) ? $implementation[$i]['implementation'] : 'Lesson Implementation'; ?></textarea></td>
                                    </tr>
                                <?php
                                    $i++; }}
                            else {?>
                                <tr>
                                    <td colspan="3"><?php echo 'no lesson plan found' ?></td>
                                </tr>
                            <?php } ?>
                            <tr>
                                <td colspan="3">
                                    <button type="submit" class="btn btn-success set-right"><i class="fa fa-save m-right-xs"></i> Save Changes</button>
                                </td>
                            </tr>
                            <?php echo form_close(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->