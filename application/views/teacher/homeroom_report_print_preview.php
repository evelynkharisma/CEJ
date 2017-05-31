<!-- page content -->
<div class="print-padding" role="main">
    <div class="">
        <div class="print-title set-margin-top">
            <div class="title_center">
                <span class="report-title">Interim Report - <?php echo ($term == 1) ? 'Term One': 'Term Three' ?><br>
                    <?php echo $setting['value'] ?></span>
            </div>


        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title no-border">
                        <h2 class="set-bold">Student Name: <?php echo $info_db['firstname'] ?> <?php echo $info_db['lastname'] ?></h2>
                        <?php
                        $yearlevel = explode('_', $info_db['classroom']);
                        ?>
                        <div class="set-right set-bold font-h2">Year Level: <?php echo $yearlevel[0] ?></div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="col-md-12">
                                <table width="100%" class="teacher_course_student_mid table-bordered">
                                    <tr>
                                        <td width="50%" class="teacher_course_student_mid_td print-size-td">FORM CLASS</td>
                                        <td width="10%" class="teacher_course_student_mid_td set-center">1</td>
                                        <td width="10%" class="teacher_course_student_mid_td set-center">2</td>
                                        <td width="10%" class="teacher_course_student_mid_td set-center">3</td>
                                        <td width="10%" class="teacher_course_student_mid_td set-center">4</td>
                                        <td width="10%" class="teacher_course_student_mid_td set-center">5</td>
                                    </tr>
                                    <tr>
                                        <td class="">Shows consideration for others</td>
                                        <td class="set-center"><?php if ($homeroomreport['consideration'] == '1') { ?><span class="option_tick"></span><?php } ?></td>
                                        <td class="set-center"><?php if ($homeroomreport['consideration'] == '2') { ?><span class="option_tick"></span><?php } ?></td>
                                        <td class="set-center"><?php if ($homeroomreport['consideration'] == '3') { ?><span class="option_tick"></span><?php } ?></td>
                                        <td class="set-center"><?php if ($homeroomreport['consideration'] == '4') { ?><span class="option_tick"></span><?php } ?></td>
                                        <td class="set-center"><?php if ($homeroomreport['consideration'] == '5') { ?><span class="option_tick"></span><?php } ?></td>
                                    </tr>
                                    <tr>
                                        <td class="">Behaves responsibly</td>
                                        <td class="set-center"><?php if ($homeroomreport['responsibility'] == '1') { ?><span class="option_tick"></span><?php } ?></td>
                                        <td class="set-center"><?php if ($homeroomreport['responsibility'] == '2') { ?><span class="option_tick"></span><?php } ?></td>
                                        <td class="set-center"><?php if ($homeroomreport['responsibility'] == '3') { ?><span class="option_tick"></span><?php } ?></td>
                                        <td class="set-center"><?php if ($homeroomreport['responsibility'] == '4') { ?><span class="option_tick"></span><?php } ?></td>
                                        <td class="set-center"><?php if ($homeroomreport['responsibility'] == '5') { ?><span class="option_tick"></span><?php } ?></td>
                                    </tr>
                                    <tr>
                                        <td class="">Communicates effectively</td>
                                        <td class="set-center"><?php if ($homeroomreport['communication'] == '1') { ?><span class="option_tick"></span><?php } ?></td>
                                        <td class="set-center"><?php if ($homeroomreport['communication'] == '2') { ?><span class="option_tick"></span><?php } ?></td>
                                        <td class="set-center"><?php if ($homeroomreport['communication'] == '3') { ?><span class="option_tick"></span><?php } ?></td>
                                        <td class="set-center"><?php if ($homeroomreport['communication'] == '4') { ?><span class="option_tick"></span><?php } ?></td>
                                        <td class="set-center"><?php if ($homeroomreport['communication'] == '5') { ?><span class="option_tick"></span><?php } ?></td>
                                    </tr>
                                    <tr>
                                        <td class="">Is punctual</td>
                                        <td class="set-center"><?php if ($homeroomreport['punctual'] == '1') { ?><span class="option_tick"></span><?php } ?></td>
                                        <td class="set-center"><?php if ($homeroomreport['punctual'] == '2') { ?><span class="option_tick"></span><?php } ?></td>
                                        <td class="set-center"><?php if ($homeroomreport['punctual'] == '3') { ?><span class="option_tick"></span><?php } ?></td>
                                        <td class="set-center"><?php if ($homeroomreport['punctual'] == '4') { ?><span class="option_tick"></span><?php } ?></td>
                                        <td class="set-center"><?php if ($homeroomreport['punctual'] == '5') { ?><span class="option_tick"></span><?php } ?></td>
                                    </tr>
                                    <tr>
                                        <td class=" set-align-right">Attendance:</td>
                                        <td colspan="5">
                                            <?php echo round($attendance) ?>%
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="set-align-right">Form Teacher:</td>
                                        <td colspan="5">
                                            <?php echo $teacher['firstname'] ?> <?php echo $teacher['lastname'] ?>
                                        </td>
                                    </tr>
                                </table>
                                <?php
                                $i = 0;
                                if($coursesList){
                                    foreach ($coursesList as $course){
                                        if ( ! isset($reports[$i]['coursename'])) {
                                            $reports[$i]['coursename'] = '';
                                        }
                                        if ($course['coursename'] != $reports[$i]['coursename']) {
                                            ?>
<!--                                            <span class="alert alert-error">-->
<!--                                                   --><?php //echo $course['coursename'] ?><!-- report is not yet submitted by --><?php //echo $course['firstname'] ?><!-- --><?php //echo $course['lastname'] ?>
<!--                                               </span>-->
<!--                                            <a href="--><?php //echo base_url() ?><!--index.php/teacher/sendEmail" class="btn btn-danger set-margin-left"><i class="fa fa-bell-o"></i> Request Report</a>-->
                                            <?php
                                        }
                                        else{
                                            ?>
                                            <table width="100%" class="teacher_course_student_mid table-bordered">
                                                <tr>
                                                    <td width="50%"
                                                        class="teacher_course_student_mid_td print-size-td"><?php echo $reports[$i]['coursename'] ?></td>
                                                    <td width="10%" class="teacher_course_student_mid_td set-center">1</td>
                                                    <td width="10%" class="teacher_course_student_mid_td set-center">2</td>
                                                    <td width="10%" class="teacher_course_student_mid_td set-center">3</td>
                                                    <td width="10%" class="teacher_course_student_mid_td set-center">4</td>
                                                    <td width="10%" class="teacher_course_student_mid_td set-center">5</td>
                                                </tr>
                                                <tr>
                                                    <td class="">Is
                                                        self-motivated
                                                    </td>
                                                    <td class="set-center"><?php if ($reports[$i]['motivation'] == '1') { ?>
                                                            <span class="option_tick"></span><?php } ?></td>
                                                    <td class="set-center"><?php if ($reports[$i]['motivation'] == '2') { ?>
                                                            <span class="option_tick"></span><?php } ?></td>
                                                    <td class="set-center"><?php if ($reports[$i]['motivation'] == '3') { ?>
                                                            <span class="option_tick"></span><?php } ?></td>
                                                    <td class="set-center"><?php if ($reports[$i]['motivation'] == '4') { ?>
                                                            <span class="option_tick"></span><?php } ?></td>
                                                    <td class="set-center"><?php if ($reports[$i]['motivation'] == '5') { ?>
                                                            <span class="option_tick"></span><?php } ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="">Shows initiatives
                                                        and asks questions
                                                    </td>
                                                    <td class="set-center"><?php if ($reports[$i]['initiative'] == '1') { ?>
                                                            <span class="option_tick"></span><?php } ?></td>
                                                    <td class="set-center"><?php if ($reports[$i]['initiative'] == '2') { ?>
                                                            <span class="option_tick"></span><?php } ?></td>
                                                    <td class="set-center"><?php if ($reports[$i]['initiative'] == '3') { ?>
                                                        <span class="option_tick"></span><?php } ?></span></td>
                                                    <td class="set-center"><?php if ($reports[$i]['initiative'] == '4') { ?>
                                                            <span class="option_tick"></span><?php } ?></td>
                                                    <td class="set-center"><?php if ($reports[$i]['initiative'] == '5') { ?>
                                                            <span class="option_tick"></span><?php } ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="">Persists despite
                                                        difficulties
                                                    </td>
                                                    <td class="set-center"><?php if ($reports[$i]['persistance'] == '1') { ?>
                                                            <span class="option_tick"></span><?php } ?></td>
                                                    <td class="set-center"><?php if ($reports[$i]['persistance'] == '2') { ?>
                                                            <span class="option_tick"></span><?php } ?></td>
                                                    <td class="set-center"><?php if ($reports[$i]['persistance'] == '3') { ?>
                                                            <span class="option_tick"></span><?php } ?></td>
                                                    <td class="set-center"><?php if ($reports[$i]['persistance'] == '4') { ?>
                                                            <span class="option_tick"></span><?php } ?></td>
                                                    <td class="set-center"><?php if ($reports[$i]['persistance'] == '5') { ?>
                                                            <span class="option_tick"></span><?php } ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="">Is well-organised
                                                        and punctual
                                                    </td>
                                                    <td class="set-center"><?php if ($reports[$i]['organize'] == '1') { ?>
                                                            <span class="option_tick"></span><?php } ?></td>
                                                    <td class="set-center"><?php if ($reports[$i]['organize'] == '2') { ?>
                                                            <span class="option_tick"></span><?php } ?></td>
                                                    <td class="set-center"><?php if ($reports[$i]['organize'] == '3') { ?>
                                                            <span class="option_tick"></span><?php } ?></td>
                                                    <td class="set-center"><?php if ($reports[$i]['organize'] == '4') { ?>
                                                            <span class="option_tick"></span><?php } ?></td>
                                                    <td class="set-center"><?php if ($reports[$i]['organize'] == '5') { ?>
                                                            <span class="option_tick"></span><?php } ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="">Completes
                                                        classroom tasks
                                                    </td>
                                                    <td class="set-center"><?php if ($reports[$i]['task'] == '1') { ?>
                                                            <span class="option_tick"></span><?php } ?></td>
                                                    <td class="set-center"><?php if ($reports[$i]['task'] == '2') { ?>
                                                            <span class="option_tick"></span><?php } ?></td>
                                                    <td class="set-center"><?php if ($reports[$i]['task'] == '3') { ?>
                                                            <span class="option_tick"></span><?php } ?></td>
                                                    <td class="set-center"><?php if ($reports[$i]['task'] == '4') { ?>
                                                            <span class="option_tick"></span><?php } ?></td>
                                                    <td class="set-center"><?php if ($reports[$i]['task'] == '5') { ?>
                                                            <span class="option_tick"></span><?php } ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="">Completes homework
                                                        on time
                                                    </td>
                                                    <td class="set-center"><?php if ($reports[$i]['homework'] == '1') { ?>
                                                            <span class="option_tick"></span><?php } ?></td>
                                                    <td class="set-center"><?php if ($reports[$i]['homework'] == '2') { ?>
                                                            <span class="option_tick"></span><?php } ?></td>
                                                    <td class="set-center"><?php if ($reports[$i]['homework'] == '3') { ?>
                                                            <span class="option_tick"></span><?php } ?></td>
                                                    <td class="set-center"><?php if ($reports[$i]['homework'] == '4') { ?>
                                                            <span class="option_tick"></span><?php } ?></td>
                                                    <td class="set-center"><?php if ($reports[$i]['homework'] == '5') { ?>
                                                            <span class="option_tick"></span><?php } ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="set-align-right">Teacher:</td>
                                                    <td colspan="5"><?php echo $reports[$i]['firstname'] ?><?php echo $reports[$i]['lastname'] ?></td>
                                                </tr>
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