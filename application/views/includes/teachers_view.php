<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Teacher Directory</h3>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <table id="directoryView" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>Photo</th>
                                <th>Name</th>
                                <th>Homeroom</th>
                                <th>Address</th>
                                <th>Email</th>
                                <th>Phone</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if($teachers){
                                foreach ($teachers as $teacher){ ?>
                                    <tr>
                                        <td>
                                            <div class="teacher_photo_crop">
                                                <img src="<?php echo base_url() ?>assets/img/teacher/profile/<?php echo $teacher['photo'] ?>" alt="..." class="teacher_photo_img">
                                            </div>
                                        </td>
                                        <td><?php echo $teacher['firstname'] ?> <?php echo $teacher['lastname'] ?></td>
                                        <td><?php echo $teacher['classroom'] ?></td>
                                        <td><?php echo $teacher['address'] ?></td>
                                        <td><?php echo $teacher['email'] ?></td>
                                        <td><?php echo $teacher['phone'] ?></td>
                                    </tr>
                                    </tr>
                                <?php }} ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->