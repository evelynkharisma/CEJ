<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3><?php echo $info_db['firstname'] ?> <?php echo $info_db['lastname'] ?> <?php echo ($term == 1) ? 'Mid Term Report': 'Final Term Report' ?></h3>
            </div>


        </div>

        <div class="clearfix"></div>

        <?php if ($this->nativesession->get('success')): ?>
            <div  class="alert alert-success">
                <?php echo $this->nativesession->get('success');$this->nativesession->delete('success'); ?>
            </div>
        <?php endif; ?>
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

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Grade <?php echo $info_db['classroom'] ?></h2>
                        <?php
                            $encrypted = $this->general->encryptParaID($info_db['studentid'],'student');
                        ?>
                        <a target="_blank" href="<?php echo base_url() ?>index.php/teacher/printPreview24/<?php echo $encrypted ?>/<?php echo $term ?>" class="btn btn-success set-right"><i class="fa fa-eye"></i> Print Preview</a>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="col-md-12">
                                <table class="teacher_course_student_mid table-bordered">
                                    <?php echo form_open('teacher/homeroomReport2/'.$encrypted.'/'.$term); ?>
                                    <tr>
                                        <td width="30%" class="teacher_course_student_mid_td">FORM TEACHER</td>
                                        <td colspan="5">
                                            <?php echo $teacher['firstname'] ?> <?php echo $teacher['lastname'] ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="30%" class="teacher_course_student_mid_td">ATTENDANCE</td>
                                        <td colspan="5">
                                            <?php echo round($attendance) ?>%
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="6">
                                            <textarea name="comment" style="resize: none" class="form-control set-margin-bottom" rows="3" placeholder='Comments'><?php echo (isset($homeroomreport['comment']))? $homeroomreport['comment']:'' ?></textarea>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="6">
                                            <button type="submit" class="btn btn-success set-right"><i class="fa fa-edit"></i> Edit</button>
                                        </td>
                                    </tr>
                                </table>
                                <?php echo form_close(); ?>
                                <?php
                                    $i = 0;
                                    if($reports){
                                        foreach ($reports as $r){
//
//                                ?>
                                                <table class="teacher_course_student_mid table-bordered">
                                                        <tr>
                                                            <td width="60%"
                                                                class="teacher_course_student_mid_td">SUBJECT: <?php echo strtoupper($reports[$i]['coursename']) ?></td>
                                                            <td class="teacher_course_student_mid_td set-center">EXAM MARK</td>
                                                            <td class="teacher_course_student_mid_td set-center">COURSE GRADE</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="teacher_course_student_mid_td">TEACHER: <?php echo strtoupper($reports[$i]['firstname']) ?> <?php echo strtoupper($reports[$i]['lastname']) ?></td>
                                                            <td class=" set-center"><?php echo $reports[$i]['mark'] ?></td>
                                                            <td class=" set-center"><?php echo $reports[$i]['grade'] ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="6">
                                                                <textarea readonly style="resize: none"
                                                                          class="form-control set-margin-bottom"
                                                                          rows="3"
                                                                          placeholder='Comments'><?php echo $reports[$i]['comment'] ?></textarea>
                                                            </td>
                                                        </tr>
                                                    </table>
                                <?php
                                                $i++;
                                            }
                                    }
                                ?>
                                <?php
                                if($coursesList){
                                    foreach ($coursesList as $course){
                                        foreach ($reports as $r){
                                            if($course['coursename'] != $r['coursename']){
                                                ?>
                                                <div class="col-md-12 set-margin-top set-margin-bottom">
                                                   <span class="alert alert-error">
                                                       <?php echo $course['coursename'] ?> report is not yet submitted by <?php echo $course['firstname'] ?> <?php echo $course['lastname'] ?>
                                                   </span>
                                                    <?php
                                                    $sencrypted = $this->general->encryptParaID($course['assignid'],'courseassigned');
                                                    ?>
                                                    <a href="<?php echo base_url() ?>index.php/teacher/sendEmailReport/<?php echo $sencrypted ?>" class="btn btn-danger set-margin-left"><i class="fa fa-bell-o"></i> Request Report</a>
                                                </div>
                                                <?php
                                            }
                                        }
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
<!-- /page content -->