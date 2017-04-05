<!-- page content -->
<div class="print-padding" role="main">
    <div class="">
        <div class="page-title">
            <div class="">
                <h3><?php echo $info_db['coursename'] ?></h3>
            </div>
        </div>

        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
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