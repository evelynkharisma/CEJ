<!-- page content -->

<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Students</h3>
            </div>
            <?php
            $privilege = $this->general->checkPrivilege($this->nativesession->get('role'), 'p0002');
            if($privilege == 1){
                ?>
                <a href="<?php echo base_url() ?>index.php/teacher/addStudent" class="btn btn-success set-right"><i class="fa fa-plus"></i> Add Student</a>
            <?php } ?>
        </div>

        <div class="clearfix"></div>
        <?php if ($this->nativesession->get('error')): ?>
            <div  class="alert alert-error">
                <?php echo $this->nativesession->get('error');$this->nativesession->delete('error'); ?>
            </div>
        <?php endif; ?>
        <?php if (validation_errors()): ?>
            <div  class="alert alert-error">
                <?php echo validation_errors(); ?>
            </div>
        <?php endif; ?>
        <?php if ($this->nativesession->get('success')): ?>
            <div  class="alert alert-success">
                <?php echo $this->nativesession->get('success'); $this->nativesession->delete('success');?>
            </div>
        <?php endif; ?>
        <?php echo form_open('teacher/studentView'); ?>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <div class="col-md-8 col-sm-8 col-xs-12">
                            <h2>All Student</h2>
                        </div>
<!--                        <div class="col-md-4 col-sm-4 col-xs-12">-->
<!--                            --><?php
////                            if()){
//                                ?>
<!--                                <div class="col-md-8 col-sm-8 col-xs-12">-->
<!--                                    <input type="text" id="pick-class" class="form-control set-margin-bottom set-right" name="classchoosen" value="--><?php //echo date('Y-m-d', now()) ?><!--"/>-->
<!--                                </div>-->
<!--                                <div class="col-md-4 col-sm-4 col-xs-12">-->
<!--                                    <button type="submit" name="datebutton" value="setdate" class="btn btn-success set-right"><i class="fa fa-search"></i> Search</button>-->
<!--                                </div>-->
<!--                                --><?php
////                            }else{
////                                ?>
<!--<!--                                <button type="submit" name="datebutton" value="today" class="btn btn-success set-right"><i class="fa fa-search"></i> Go to Today</button>-->
<!--<!--                                --><?php
////                            }
//                            ?>
<!--                        </div>-->
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <table id="attendance" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th width="10%">No</th>
                                <th>Photo</th>
                                <th>Student ID</th>
                                <th>Name</th>
                                <th>Class</th>
                                <?php $privilege = $this->general->checkPrivilege($this->nativesession->get('role'), 'p0003');
                                    if($privilege == 1){
                                    ?>
                                <th>Action</th>
                                <?php } ?>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if($students){
                                $i = 1;
                                foreach ($students as $student){
                                    $encrypted = $this->general->encryptParaID($student['studentid'],'student');
                                    ?>
                                    <tr>
                                        <td><?php echo $i ?></td>
                                        <td>
                                            <div class="teacher_photo_crop">
                                                <img src="<?php echo base_url() ?>assets/img/student/<?php echo $student['photo'] ?>" alt="..." class="teacher_photo_img">
                                            </div>
                                        </td>
                                        <td><?php echo $student['studentid'] ?></td>
                                        <td><?php echo $student['firstname'] ?> <?php echo $student['lastname'] ?></td>
                                        <td><?php echo $student['classroom'] ?></td>
                                    <?php $privilege = $this->general->checkPrivilege($this->nativesession->get('role'), 'p0003');
                                    if($privilege == 1){
                                        ?>
                                        <td>
                                            <?php
                                            $encrypted = $this->general->encryptParaID($student['studentid'],'student');
                                            ?>
                                            <a href="<?php echo base_url() ?>index.php/teacher/deleteStudent/<?php echo $encrypted ?>" class="btn-success btn" onclick="return confirm('Are you sure want to delete this?');"><i class="fa fa-trash"></i> Delete</a>
                                            <a href="<?php echo base_url() ?>index.php/teacher/editStudent/<?php echo $encrypted ?>" class="btn-success btn"><i class="fa fa-edit"></i> Edit</a>
                                        </td>
                                    <?php } ?>
                                    </tr>
                                    <?php $i++; }} ?>
                            </tbody>
                        </table>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->

<!--<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Students</h3>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">

            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>All Student</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <form style="float: right;">
                            <table>
                            <tr>
                                <td style="padding-right: 1vw">Search</td>
                                <td style="padding-right: 1vw"><input type="text" placeholder="keywords"> </td>
                                <td style="padding-right: 1vw">Grade</td>
                                <td style="padding-right: 1vw"><select>
                                        <option>All grades</option>
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                        <option>5</option>
                                        <option>6</option>
                                        <option>7</option>
                                    </select></td>
                                <td style="padding-right: 1vw">Batch</td>
                                <td style="padding-right: 1vw"><select>
                                        <option>All batches</option>
                                        <option>2005</option>
                                        <option>2006</option>
                                        <option>2007</option>
                                        <option>2008</option>
                                        <option>2009</option>
                                        <option>2010</option>
                                        <option>2011</option>
                                    </select>
                                </td>
                                <td>
                                    <button type="submit" class="btn btn-success set-right"><i class="fa fa-search  m-right-xs"></i> Find</button>
                                </td>
                            </tr>
                        </table>
                        </form>

                    </div>
                    <div class="x_content">
                        <div class="teacher_dashboard_today_schedule_container">
                            <table class="teacher_dashboard_today_schedule_table">
                                <tr>
                                    <td width="10%">Number</td>
                                    <td>Student ID</td>
                                    <td>Name</td>
                                    <td>Action</td>
                                </tr>
                                <?php
/*                                if($students){
                                    $no=1;
                                    foreach($students as $student){ */?>
                                        <tr>
                                            <td><?php /*echo $no*/?></td>
                                            <td><?php /*echo $student['studentid']*/?></td>
                                            <td><?php /*echo ucfirst($student['firstname']).' '.ucfirst($student['lastname'])*/?></td>
                                            <td>Action</td>
                                        </tr>

                                    <?php /*}}*/?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>-->