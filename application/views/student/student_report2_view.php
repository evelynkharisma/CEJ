<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3><?php echo ucfirst($student['firstname']).' '.ucfirst($student['lastname'])?></h3>
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
                        <h2>Grade <?php echo $reportGrade?> - Term <?php echo $reportTerm?></h2>
                        <?php
                            //                            $encrypted = $this->general->encryptParaID($info_db['studentid'],'student');
                        ?>
                        <a href="" class="btn btn-success set-right"><i class="fa fa-eye"></i> Term 4</a>
                        <a href="<?php echo base_url() ?>index.php/student/learningReport/3/<?php echo $reportGrade?>" class="btn btn-success set-right"><i class="fa fa-eye"></i> Term 3</a>
                        <a href="" class="btn btn-success set-right"><i class="fa fa-eye"></i> Term 2</a>
                        <a href="<?php echo base_url() ?>index.php/student/learningReport/1/<?php echo $reportGrade?>" class="btn btn-success set-right"><i class="fa fa-eye"></i> Term 1</a>


                    <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="col-md-12">
                                <table class="teacher_course_student_mid table-bordered">
                                    <?php echo form_open('student/learningReport2/'.$reportTerm.'/'.$reportGrade); ?>
                                    <tr>
                                        <td width="30%" class="teacher_course_student_mid_td">FORM TEACHER</td>
                                        <td colspan="5"><?php echo ucfirst($report[0]['teacherfirstname']).' '.ucfirst($report[0]['teacherlastname'])?></td>
                                    </tr>
                                    <tr>
                                        <td width="30%" class="teacher_course_student_mid_td">ATTENDANCE</td>
                                        <td colspan="5">
                                            <?php echo round($attendance) ?>%
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="6">
                                            <textarea name="comment" style="resize: none" class="form-control set-margin-bottom" rows="3" placeholder='Comments'><?php echo $report[0]['comment'] ?></textarea>
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
                                /*if($coursesList){
                                    foreach ($coursesList as $course){
                                        if ( ! isset($reports[$i]['coursename'])) {
                                            $reports[$i]['coursename'] = '';
                                        }
                                        if ($course['coursename'] != $reports[$i]['coursename']) {
                                            */?><!--
                                            <div class="col-md-12 set-margin-top set-margin-bottom">
                                               <span class="alert alert-error">
                                                   <?php /*echo $course['coursename'] */?> report is not yet submitted by <?php /*echo $course['firstname'] */?> <?php /*echo $course['lastname'] */?>
                                               </span>
                                                <a href="<?php /*echo base_url() */?>index.php/teacher/sendEmail" class="btn btn-danger set-margin-left"><i class="fa fa-bell-o"></i> Request Report</a>
                                            </div>
                                            <?php
/*                                        }
                                        else{
                                            */?>
                                            <table class="teacher_course_student_mid table-bordered">
                                                <tr>
                                                    <td width="60%"
                                                        class="teacher_course_student_mid_td">SUBJECT: <?php /*echo strtoupper($reports[$i]['coursename']) */?></td>
                                                    <td class="teacher_course_student_mid_td set-center">EXAM MARK</td>
                                                    <td class="teacher_course_student_mid_td set-center">COURSE GRADE</td>
                                                </tr>
                                                <tr>
                                                    <td class="teacher_course_student_mid_td">TEACHER: <?php /*echo strtoupper($reports[$i]['firstname']) */?> <?php /*echo strtoupper($reports[$i]['lastname']) */?></td>
                                                    <td class=" set-center"><?php /*echo $reports[$i]['mark'] */?></td>
                                                    <td class=" set-center"><?php /*echo $reports[$i]['grade'] */?></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="6">
                                                                <textarea readonly style="resize: none"
                                                                          class="form-control set-margin-bottom"
                                                                          rows="3"
                                                                          placeholder='Comments'><?php /*echo $reports[$i]['comment'] */?></textarea>
                                                    </td>
                                                </tr>
                                            </table>
                                            --><?php
/*                                            $i++;
                                        }
                                    }
                                }*/
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