<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Feedback</h3>
                <h3><?php
                    if($allcourses){
                        foreach ($allcourses as $allcourse) {
                        if(strcmp($allcourse['assignid'], $courseassign)==0) {
                            echo $allcourse['coursename'];
                        }
                    }?></h3>
            </div>
        </div>

        <div class="clearfix"></div>

        <?php
        } if ($this->nativesession->get('success')): ?>
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
                                <th width="5%s">No</th>
                                <th>Feedback</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            if($info_dbs){
                                $i=1;
                                foreach($info_dbs as $info_db){ ?>
                                    <tr>
                                        <td><?php echo $i?></td>
                                        <td><?php echo $info_db['feedback'] ?></td>
                                    </tr>
                                <?php $i++;}}
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