<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Exam Schedule</h3>
            </div>

        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <?php
                        if($schedule) {
                            $found = 0;
                            foreach ($schedule as $sc) {
                                if ($sc['classid'] == $classid) {
                                    if ($found == 0) {
                                        ?>
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="profile_title">
                                            <div class="col-md-12">
                                                <h2>Class <?php echo $sc['classid'] ?></h2>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                        <table class="teacher_course_student_mid table-bordered">
                                        <thead>
                                        <tr>
                                            <td class="teacher_course_student_mid_td set-center" width="25%">Subject
                                            </td>
                                            <td class="teacher_course_student_mid_td set-center" width="25%">Date</td>
                                            <td class="teacher_course_student_mid_td set-center" width="25%">Time</td>
                                            <td class="teacher_course_student_mid_td set-center" width="25%">
                                                Invigilator
                                            </td>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $found = 1;
                                    } else {
                                        ?>
                                        <tr>
                                            <td style="border-bottom: <?php echo (isset($sc['count']) && $sc['count'] % 2 == 0) ? 'solid 2px black' : '' ?> "><?php echo $sc['coursename'] ?></td>
                                            <td style="border-bottom: <?php echo (isset($sc['count']) && $sc['count'] % 2 == 0) ? 'solid 2px black' : '' ?> "><?php echo $sc['date'] ?></td>
                                            <td style="border-bottom: <?php echo (isset($sc['count']) && $sc['count'] % 2 == 0) ? 'solid 2px black' : '' ?> ">
                                                <?php if ($sc['count'] % 2 == 1) {
                                                    echo $time[0] . ' - ' . $time[1];
                                                } else {
                                                    echo $time[2] . ' - ' . $time[3];
                                                } ?>
                                            </td>
                                            <td style="border-bottom: <?php echo (isset($sch['count']) && $sc['count'] % 2 == 0) ? 'solid 2px black' : '' ?> "><?php echo $sc['firstname'] ?><?php echo $sc['lastname'] ?></td>
                                        </tr>
                                        <?php
                                        if (!isset($sc['classid']) || $sc['classid'] != $classid) { ?>
                                            </tbody>
                                            </table>
                                            </div>
                                            </div>
                                        <?php }
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
<!-- /page content -->