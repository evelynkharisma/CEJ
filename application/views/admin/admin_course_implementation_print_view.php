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
                        <table class="teacher_course_implementation table-bordered">
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
                            <?php
                            if($plans){
                                $i = 0;
                                foreach($plans as $plan){ ?>
                                    <tr>
                                        <td align="center"><?php echo $plan['implementationcount'] ?></td>
                                        <td>Chapter <?php echo $plan['chapter'] ?></td>
                                        <td><?php echo $plan['objective'] ?></td>
                                        <td><?php echo $plan['activities'] ?></td>
                                        <td><?php echo $plan['material'] ?></td>
                                    </tr>
                                <?php  }}
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