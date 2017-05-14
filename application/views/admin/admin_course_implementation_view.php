<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3><?php echo $info_db['coursename'] ?></h3>
            </div>


        </div>

        <div class="clearfix"></div>

        <?php if ($this->nativesession->get('success')): ?>
            <div  class="alert alert-success">
                <?php echo $this->nativesession->get('success');$this->nativesession->delete('success'); ?>
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
                        <?php
                            $encrypted = $this->general->encryptParaID($info_db['assignid'],'courseassigned');
                        ?>
                        <a href="<?php echo base_url() ?>index.php/teacher/printPreviewImplementation/<?php echo $encrypted ?>" target="_blank" class="btn btn-success set-right"><i class="fa fa-eye"></i> Print Preview</a>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <table class="teacher_course_implementation">
                            <thead>
                            <tr>
                                <th width="10%" style="text-align: center">Lesson</th>
                                <th width="20%">Chapter/Unit</th>
                                <th width="20%">Learning Objective</th>
                                <th width="20%">Student Activities</th>
                                <th width="20%">Materials/Resources</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php echo form_open_multipart('admin/courseImplementation/'.$encrypted); ?>
                            <input type="hidden" class="form-control set-margin-bottom" name="assignid" value="<?php echo $info_db['assignid']; ?>"/>
                            <?php
                            if($plans){
                                $i = 0;
                                foreach($plans as $plan){ ?>
                                    <tr>
                                        <input type="hidden" class="form-control set-margin-bottom" name="lessonid[]" value="<?php echo $plan['lessonid']; ?>"/>
                                        <td align="center"><?php echo $plan['lessoncount'] ?></td>
                                        <td><input type="text" class="form-control set-margin-bottom set-margin-top" name="chapter[]" value="<?php echo set_value('chapter', isset($implementation[$i]['chapter']) && $implementation[$i]['chapter'] != null ? $implementation[$i]['chapter'] : $plan['chapter']); ?>"/></td>
                                        <td><textarea class="form-control set-margin-bottom" name="objective[]" rows="3"><?php echo isset($implementation[$i]['objective']) && $implementation[$i]['objective'] != null ? $implementation[$i]['objective'] : $plan['objective']; ?></textarea></td>
                                        <td><textarea class="form-control set-margin-bottom" name="activities[]" rows="3"><?php echo isset($implementation[$i]['activities']) && $implementation[$i]['activities'] != null ? $implementation[$i]['activities'] : $plan['activities']; ?></textarea></td>
                                        <td><textarea class="form-control set-margin-bottom" name="material[]" rows="3"><?php echo isset($implementation[$i]['material']) && $implementation[$i]['material'] != null ? $implementation[$i]['material'] : $plan['material']; ?></textarea></td>
                                    </tr>
                                <?php $i++; }}
                            else {?>
                                <tr>
                                    <td colspan="5"><?php echo 'no lesson plan found' ?></td>
                                </tr>
                            <?php } ?>
<!--                            --><?php
//                            if($plans){
//                                $i = 0;
//                                foreach($plans as $plan){ ?>
<!--                                    <tr>-->
<!--                                        <td align="center">--><?php //echo $plan['lessoncount'] ?><!--</td>-->
<!--                                        <td>--><?php //echo $plan['activities'] ?><!--</td>-->
<!--                                        <td><textarea --><?php //if(isset($implementation[$i]['implementation']) && $implementation[$i]['implementation'] != null) echo 'readonly rows="1"'; ?><!-- class="form-control set-margin-bottom" name="implementation[]">--><?php //echo isset($implementation[$i]['implementation']) ? $implementation[$i]['implementation'] : 'Lesson Implementation'; ?><!--</textarea></td>-->
<!--                                    </tr>-->
<!--                                --><?php
//                                    $i++; }}
//                            else {?>
<!--                                <tr>-->
<!--                                    <td colspan="3">--><?php //echo 'no lesson plan found' ?><!--</td>-->
<!--                                </tr>-->
<!--                            --><?php //} ?>
                            <tr>
                                <td colspan="5">
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