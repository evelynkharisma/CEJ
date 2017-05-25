<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Parent Directory</h3>
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
                                <th width="15%">Name</th>
                                <th width="25%">Address</th>
                                <th width="15%">Email</th>
                                <th width="10%">Phone</th>
                                <th>Children</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            if($parent){
                                foreach ($parent as $p){ ?>
                                    <tr>
                                        <td>
                                            <div class="teacher_photo_crop">
                                                <img src="<?php echo base_url() ?>assets/img/parents/profile/<?php echo $p['photo'] ?>" alt="..." class="teacher_photo_img">
                                            </div>
                                        </td>
                                        <td><?php echo $p['firstname'] ?> <?php echo $p['lastname'] ?></td>
                                        <td><?php echo $p['address'] ?></td>
                                        <td><?php echo $p['email'] ?></td>
                                        <td><?php echo $p['phone'] ?></td>
                                        <td><?php
                                            if(isset($p['child'])){
                                            $child = substr($p['child'], 1, strlen($p['child']));
                                            $child = explode('|', $child);
                                            foreach ($child as $c){ ?>
                                                <li><?php echo $c ?></li>
                                            <?php }}else echo 'no child registered' ?>
                                        </td>
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