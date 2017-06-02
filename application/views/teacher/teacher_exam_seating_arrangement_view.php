<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3><?php echo $info_db['classroom'] ?> <?php echo $info_db['coursename'] ?></h3>
            </div>


        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Invigilator: <?php echo $info_db['firstname'] ?> <?php echo $info_db['lastname'] ?></h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <table class="teacher_course_implementation">
                            <thead>
                            <tr>
                                <th width="40%">Photo</th>
                                <th width="45%">Name</th>
                                <th width="15%">Seat Position</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $seat = substr($info_db['seat'], 1, strlen($info_db['seat']));
                            $seat = explode('|', $seat);
                            $i = 0;
                            if($students){
                                foreach ($students as $student){ ?>
                                    <tr>
                                        <td>
                                            <div class="teacher_photo_crop">
                                                <img src="<?php echo base_url() ?>assets/img/student/<?php echo $student['photo'] ?>" alt="..." class="teacher_photo_img">
                                            </div>
                                        </td>
                                        <td><?php echo $student['firstname'] ?> <?php echo $student['lastname'] ?></td>
                                        <td>
                                            <?php echo $seat[$i] ?>
                                        </td>
                                    </tr>
                            <?php $i++; }} ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->