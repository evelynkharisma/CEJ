<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Feedback</h3>
            </div>
        </div>

        <div class="clearfix"></div>

        <?php if ($this->nativesession->get('success')): ?>
            <div  class="alert alert-success">
                <?php echo $this->nativesession->get('success'); $this->nativesession->delete('success');?>
            </div>
        <?php endif; ?>

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
                                <th>Teacher</th>
                                <th>Class</th>
                                <th>Course</th>
                                <?php
                                $privilege = $this->general->checkPrivilege($this->nativesession->get('role'), 'p0014');
                                if($privilege == 1){
                                ?>
                                <th>Action</th>
                                <?php } ?>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            if($info_dbs){
                                foreach($info_dbs as $info_db){ ?>
                                    <tr>
                                        <td><?php echo ucwords($info_db['teacherfirstname'].' '.$info_db['teacherlastname']) ?></td>
                                        <td><?php echo $info_db['classroom'] ?></td>
                                        <td><?php echo $info_db['coursename'] ?></td>
                                        <td width="20%">
                                            <?php
                                                $encrypted = $this->general->encryptParaID($info_db['assignid'],'courseassigned');
                                            ?>
                                            <a href="<?php echo base_url() ?>index.php/admin/viewFeedback/<?php echo $encrypted ?>" class="btn-success btn"><i class="fa fa-eye"></i>View feedback</a>
                                        </td>
                                    </tr>
                                <?php }}
                            else {?>
                                <tr>
                                    <td colspan="3"><?php echo 'no forms found' ?></td>
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