<!-- page content -->
<div class="print-padding" role="main">
    <div class="">
        <div class="print-title set-margin-top2">
            <div class="title_center">
                <span class="report2-title"><?php echo ($term == 1) ? 'MID YEAR (TERM 2) REPORT': 'FINAL YEAR (TERM 4) REPORT' ?><br>
                2016</span>
                <div class="set-margin-top2"></div>
                <span class="report2-title"><?php echo strtoupper($info_db['firstname']) ?> <?php echo strtoupper($info_db['lastname']) ?><br>
                YEAR <?php echo $setting['value'] ?></span>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <table class="teacher_course_student_mid table-bordered">
                                <tr>
                                    <td width="30%" class="teacher_course_student_mid_td print-size30">FORM TEACHER</td>
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
                                <table class="comment-table">
                                    <tr>
                                        <td colspan="6">
                                            <textarea name="comment" style="resize: none" class="form-control set-margin-bottom" rows="5" placeholder='Comments'><?php echo (isset($homeroomreport['comment']))? $homeroomreport['comment']:'' ?></textarea>
                                        </td>
                                    </tr>
                                </table>
                                <table width="100%" class="set-center set-margin-top2">
                                    <tr>
                                        <td width="10%"></td>
                                        <td width="30%" class="set-border-top"><span class="print-name"><?php echo $teacher['firstname'] ?> <?php echo $teacher['lastname'] ?><br><span class="set-bold">Form Teacher</span></span></td>
                                        <td width="20%"></td>
                                        <td width="30%" class="set-border-top"><span class="print-name"><?php echo $principal['firstname'] ?> <?php echo $principal['lastname'] ?><br><span class="set-bold">Principal</span></span></td>
                                        <td width="10%"></td>
                                    </tr>
                                </table>
                            </table>
                        </div>
                        </div>
                    </div>
                </div>
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <?php
                            $i = 0;
                            if($coursesList){
                                foreach ($coursesList as $course){
                                    if ( ! isset($reports[$i]['coursename'])) {
                                        $reports[$i]['coursename'] = '';
                                    }
                                    if ($course['coursename'] != $reports[$i]['coursename']) {
                                        ?>
                                        <div class="col-md-12 set-margin-top set-margin-bottom">
                                            <!--                                               <span class="alert alert-error">-->
                                            <!--                                                   --><?php //echo $course['coursename'] ?><!-- report is not yet submitted by --><?php //echo $course['firstname'] ?><!-- --><?php //echo $course['lastname'] ?>
                                            <!--                                               </span>-->
                                            <!--                                                <a href="--><?php //echo base_url() ?><!--index.php/teacher/sendEmail" class="btn btn-danger set-margin-left"><i class="fa fa-bell-o"></i> Request Report</a>-->
                                        </div>
                                        <?php
                                    }
                                    else{
                                        ?>
                                        <table class="teacher_course_student_mid table-bordered">
                                            <tr>
                                                <td width="60%"
                                                    class="teacher_course_student_mid_td  print-size30">SUBJECT: <?php echo strtoupper($reports[$i]['coursename']) ?></td>
                                                <td class="teacher_course_student_mid_td set-center">EXAM MARK</td>
                                                <td class="teacher_course_student_mid_td set-center">COURSE GRADE</td>
                                            </tr>
                                            <tr>
                                                <td class="teacher_course_student_mid_td">TEACHER: <?php echo strtoupper($reports[$i]['firstname']) ?> <?php echo strtoupper($reports[$i]['lastname']) ?></td>
                                                <td class=" set-center"><?php echo $reports[$i]['mark'] ?></td>
                                                <td class=" set-center"><?php echo $reports[$i]['grade'] ?></td>
                                            </tr>
                                            <table class="comment-table">
                                                <tr>
                                                    <td colspan="6">
                                                                    <textarea style="resize: none"
                                                                              class="form-control set-margin-bottom"
                                                                              rows="5"
                                                                              placeholder='Comments'><?php echo $reports[$i]['comment'] ?></textarea>
                                                    </td>
                                                </tr>
                                            </table>
                                        </table>
                                        <?php
                                        $i++;
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