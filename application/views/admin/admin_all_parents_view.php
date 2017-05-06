<!-- page content -->

<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Parents</h3>
            </div>
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
        <?php echo form_open('admin/allParents'); ?>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <div class="col-md-8 col-sm-8 col-xs-12">
                            <h2>All Parents</h2>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <table id="attendance" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th width="10%">No</th>
                                <th>Parents ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if($parents){
                                $i = 1;
                                foreach ($parents as $parent){
                                    $encrypted = $this->general->encryptParaID($parent['parentid'],'parent');
                                    ?>
                                    <tr>
                                        <td><?php echo $i ?></td>
                                        <td><?php echo $parent['parentid'] ?></td>
                                        <td><?php echo $parent['firstname'] ?> <?php echo $parent['lastname'] ?></td>
                                        <td><?php echo $parent['email'] ?></td>
                                        <td>
                                            <?php
                                            $encrypted = $this->general->encryptParaID($parent['parentid'],'parent');
                                            ?>
<!--                                            <a href="--><?php //echo base_url() ?><!--index.php/admin/deleteParent/--><?php //echo $encrypted ?><!--" class="btn-success btn" onclick="return confirm('Are you sure want to delete this?');"><i class="fa fa-trash"></i> Delete</a>-->
                                            <a href="<?php echo base_url() ?>index.php/admin/deleteParent/<?php echo $encrypted ?>" class="btn-success btn" onclick="return confirm('Are you sure want to delete this?');"><i class="fa fa-trash"></i> Delete</a>
                                            <a href="<?php echo base_url() ?>index.php/admin/editParent/<?php echo $encrypted ?>" class="btn-success btn"><i class="fa fa-edit"></i> Edit</a>
                                        </td>
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
/*                                if($parents){
                                    $no=1;
                                    foreach($parents as $parent){ */?>
                                        <tr>
                                            <td><?php /*echo $no*/?></td>
                                            <td><?php /*echo $parent['studentid']*/?></td>
                                            <td><?php /*echo ucfirst($parent['firstname']).' '.ucfirst($parent['lastname'])*/?></td>
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