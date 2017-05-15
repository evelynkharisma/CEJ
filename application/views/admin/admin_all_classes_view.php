<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Class Directory</h3>
            </div>
            <?php
            $privilege = $this->general->checkPrivilege($this->nativesession->get('role'), 'p0025');
            if($privilege == 1){
                ?>
                <a href="<?php echo base_url() ?>index.php/admin/addClass" class="btn btn-success set-right"><i class="fa fa-plus"></i> Add Class</a>
            <?php } ?>
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
                                <th>Classid</th>
                                <th>Room</th>
                                <th>Homeroom</th>
                                <th>Capacity</th>
                                <?php
                                $privilege = $this->general->checkPrivilege($this->nativesession->get('role'), 'p0026');
                                if($privilege == 1){
                                ?>
                                <th>Action</th>
                                <?php } ?>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if($classTeacher){
                                foreach ($classTeacher as $c){ ?>
                                    <tr>
                                        <td><?php echo $c['classid'] ?></td>
                                        <td><?php echo $c['classroom'] ?></td>
                                        <td><?php echo $c['firstname'] ?> <?php echo $c['lastname'] ?></td>
                                        <td><?php echo $c['capacity'] ?> </td>
                                        <?php
                                        $privilege = $this->general->checkPrivilege($this->nativesession->get('role'), 'p0026');
                                        if($privilege == 1){
                                        ?>
                                        <td width="30%">
                                            <?php
                                            $encrypted = $this->general->encryptParaID($c['classid'],'class');
                                            ?>
                                            <a href="<?php echo base_url() ?>index.php/admin/editClass/<?php echo $encrypted ?>" class="btn-success btn"><i class="fa fa-edit"></i> Edit</a>
                                            <a href="<?php echo base_url() ?>index.php/admin/classStudents/<?php echo $encrypted ?>" class="btn-success btn"><i class="fa fa-eye"></i> View Students</a>
                                        </td>
                                        <?php } ?>
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