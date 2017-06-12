<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Create Schedule</h3>
            </div>
            <a href="<?php echo base_url() ?>index.php/teacher/generateSchedule" class="btn btn-success set-right"><i class="fa fa-braille"></i> Generate</a>
        </div>
        <div class="clearfix"></div>
        <?php if ($this->nativesession->get('error')): ?>
            <div  class="alert alert-error">
                <?php echo $this->nativesession->get('error');$this->nativesession->delete('error'); ?>
            </div>
        <?php endif; ?>
        <?php if ($this->nativesession->get('success')): ?>
            <div  class="alert alert-success">
                <?php echo $this->nativesession->get('success');$this->nativesession->delete('success'); ?>
            </div>
        <?php endif; ?>
        <?php if (validation_errors()): ?>
            <div  class="alert alert-error">
                <?php echo validation_errors(); ?>
            </div>
        <?php endif; ?>

        <div class="row">

            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <?php echo form_open_multipart('teacher/addScheduleSetting'); ?>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Teacher</label>
                            <div class="col-md-9 col-sm-9 col-xs-12 set-margin-bottom">
                                <select id="teacher" name="teacher" class="form-control">
                                    <option disabled selected="selected">Teacher</option>
                                    <?php if($teachers){
                                        foreach ($teachers as $t){?>
                                            <option value="<?php echo $t['teacherid']; ?>"><?php echo $t['firstname']; ?> <?php echo $t['lastname']; ?></option>
                                        <?php }} ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Course</label>
                            <div class="col-md-9 col-sm-9 col-xs-12 set-margin-bottom">
                                <select id="course" name="course" class="form-control">
                                    <option disabled selected="selected">Course</option>
                                    <?php if($coursesList){
                                        foreach ($coursesList as $c){?>
                                            <option value="<?php echo $c['courseid']; ?>"><?php echo $c['coursename']; ?></option>
                                        <?php }} ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Class</label>
                            <div class="col-md-9 col-sm-9 col-xs-12 set-margin-bottom set-margin-top">
                                <select  data-placeholder="Class" name="grade[]" class="chosen-select form-control set-margin-bottom set-margin-top" multiple tabindex="6">
                                    <option value=""></option>
                                    <?php if($classes){
                                        foreach ($classes as $t){
                                            ?>
                                            <option value="<?php echo $t['classid'] ?>"><?php echo $t['classroom'] ?></option>
                                            <?php
                                        }
                                    }?>
                                </select>
                            </div>
                            <!--                            <div class="col-md-9 col-sm-9 col-xs-12 set-margin-bottom">-->
                            <!--                                --><?php
                            //                                 for($i=0; $i<13; $i++){
                            //                                ?>
                            <!--                                <input class="grade" type='checkbox' name='grade[]' value='--><?php //echo $i+1 ?><!--' id="check_--><?php //echo $i ?><!--" checked/><label style="width: auto; height: auto; padding: 10px; color: white; margin-right: 10px" for="check_--><?php //echo $i ?><!--">--><?php //echo $i+1 ?><!--</label>-->
                            <!--                                --><?php //} ?>
                            <!--                            </div>-->
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Frequency</label>
                            <div class="col-md-9 col-sm-9 col-xs-12 set-margin-bottom">
                                <input type="text" class="form-control set-margin-bottom set-margin-top" name="frequency" placeholder="Frequency"/>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success set-margin-top"><i class="fa fa-plus"></i> Add</button>
                        <!--                        <a id="loaddata" class="btn btn-success set-margin-top"><i class="fa fa-plus"></i> Add</a>-->
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>List of Course Assigned</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <table id="directoryView" class="table table-striped table-bordered ">
                            <thead>
                            <tr>
                                <th>Teacher</th>
                                <th>Course</th>
                                <th>Grade</th>
                                <th>Frequency</th>
                                <th>Room</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody class="">
                            <div id="display_info"></div>
                            <?php
                            if($assign){
                                foreach($assign as $info_db){ ?>
                                    <tr>
                                        <td>
                                            <?php echo $info_db['firstname'] ?> <?php echo $info_db['lastname'] ?>
                                        </td>
                                        <td><?php echo $info_db['coursename'] ?></td>
                                        <td><?php echo $info_db['grade'] ?></td>
                                        <td><?php echo $info_db['frequency'] ?></td>
                                        <td>Classroom</td>
                                        <td width="20%">
                                            <?php
                                            $encrypted = $this->general->encryptParaID($info_db['scid'],'schedulesetting');
                                            ?>
                                            <a href="<?php echo base_url() ?>index.php/teacher/deleteScheduleSetting/<?php echo $encrypted ?>" class="btn-success btn" onclick="return confirm('Are you sure want to delete this?');"><i class="fa fa-trash"></i> Delete</a>
                                        </td>
                                    </tr>
                                <?php }}

//                            else {?>
<!--                                <tr>-->
<!--                                    <td colspan="3">--><?php //echo 'no schedule course found' ?><!--</td>-->
<!--                                </tr>-->
<!--                            --><?php //} ?>
<!--                            --><?php
//                            if($special){
//                            foreach($special as $info_db){ ?>
<!--                            <tr>-->
<!--                                <td>-->
<!--                                    --><?php //echo $info_db['teacher'] ?>
<!--                                </td>-->
<!--                                <td>--><?php //echo $info_db['coursename'] ?><!--</td>-->
<!--                                <td>--><?php //echo $info_db['grade'] ?><!--</td>-->
<!--                                <td>--><?php //echo $info_db['frequency'] ?><!--</td>-->
<!--                                <td>--><?php //if($info_db['type'] == 1){echo 'Collaborative in room '.$info_db['room'];}else{echo 'Elective in room '.$info_db['room'];} ?><!--</td>-->
<!--                                <td width="20%">-->
<!--                                    --><?php
//                                    $encrypted = $this->general->encryptParaID($info_db['scid'],'schedulesetting');
//                                    ?>
<!--                                    <a href="--><?php //echo base_url() ?><!--index.php/teacher/deleteScheduleSetting/--><?php //echo $encrypted ?><!--" class="btn-success btn" onclick="return confirm('Are you sure want to delete this?');"><i class="fa fa-trash"></i> Delete</a>-->
<!--                                </td>-->
<!--                            </tr>-->
<!--                            --><?php //}}?>


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->
