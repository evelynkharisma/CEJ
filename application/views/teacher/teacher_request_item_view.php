<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Request Item</h3>
            </div>
        </div>

        <div class="clearfix"></div>

        <?php if ($this->nativesession->get('success')): ?>
            <div  class="alert alert-success">
                <?php echo $this->nativesession->get('success');$this->nativesession->delete('success'); ?>
            </div>
        <?php endif; ?>
        <?php if ($this->nativesession->get('error')): ?>
            <div  class="alert alert-error">
                <?php echo $this->nativesession->get('error');$this->nativesession->delete('error'); ?>
            </div>
        <?php endif; ?>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Items</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <?php echo form_open('teacher/addRequestItem/'); ?>
                        <table id="attendance" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Request</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if(isset($items)){
                                foreach ($items as $s){ ?>
                                    <tr>
                                        <input type="hidden" class="form-control set-margin-bottom" name="itemid[]" value="<?php echo $s['itemid']; ?>"/>
                                        <td><?php echo $s['name'] ?></td>
                                        <td><input class="form-control" name="value[]" value="<?php echo set_value('value', isset($s['value']) ? $s['value'] : ''); ?>"></td>
                                    </tr>
                                <?php }} ?>
                            <?php if(isset($request)){
                                foreach ($request as $s){ ?>
                                    <tr>
                                        <input type="hidden" class="form-control set-margin-bottom" name="itemid[]" value="<?php echo $s['itemid']; ?>"/>
                                        <td><?php echo $s['name'] ?></td>
                                        <td><input <?php echo (isset($s['status']) && $s['status'] == 1 ? 'readonly' : '') ?> class="form-control" name="value[]" value="<?php echo set_value('value', isset($s['value']) ? $s['value'] : ''); ?>"></td>
                                    </tr>
                                <?php }} ?>
                            </tbody>
                        </table>
                        <button type="submit"  class="btn btn-success set-right"><i class="fa fa-shopping-cart"></i> Request</button>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Books</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <table id="attendance" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>ISBN</th>
                                <th>Title</th>
                                <th>Number</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if(isset($requestbook)){
                                foreach ($requestbook as $s){ ?>
                                    <tr>
                                        <?php echo form_open('teacher/editBookRequest/'.$s['brequestid']); ?>
                                        <td><?php echo $s['isbn'] ?></td>
                                        <td><?php echo $s['name'] ?></td>
                                        <td><input class="form-control" name="value" value="<?php echo set_value('value', isset($s['number']) ? $s['number'] : ''); ?>"></td>
                                        <td><button <?php echo (isset($s['status']) && $s['status'] == 1 ? 'disabled' : '') ?> type="submit" class="btn btn-success"><i class="fa fa-edit"></i> Edit</button>
                                            <a href="<?php echo base_url() ?>index.php/teacher/deleteBookRequest/<?php echo $s['brequestid'] ?>" class="btn-success btn <?php echo (isset($s['status']) && $s['status'] == 1 ? 'disabled' : '') ?>" onclick="return confirm('Are you sure want to delete this?');"><i class="fa fa-trash"></i> Delete</a>
                                        </td>
                                        <?php echo form_close(); ?>
                                    </tr>
                                <?php }} ?>
                                    <tr>
                                        <?php echo form_open('teacher/addBookRequest/'); ?>
                                        <td><input class="form-control" name="isbn"></td>
                                        <td><input class="form-control" name="name"></td>
                                        <td><input class="form-control" name="value"></td>
                                        <td><button type="submit" class="btn btn-success"><i class="fa fa-plus"></i> Add</button></td>
                                        <?php echo form_close(); ?>
                                    </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Fotocopy</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <table id="attendance" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>ISBN</th>
                                <th>Title</th>
                                <th>Number of Copy</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if(isset($requestfotocopy)){
                                foreach ($requestfotocopy as $s){ ?>
                                    <tr>
                                        <?php echo form_open('teacher/editFotocopyRequest/'.$s['frequestid']); ?>
                                        <td><?php echo $s['isbn'] ?></td>
                                        <td><?php echo $s['name'] ?></td>
                                        <td><input class="form-control" name="value" value="<?php echo set_value('value', isset($s['number']) ? $s['number'] : ''); ?>"></td>
                                        <td><button <?php echo (isset($s['status']) && $s['status'] == 1 ? 'disabled' : '') ?> type="submit" class="btn btn-success"><i class="fa fa-edit"></i> Edit</button>
                                            <a href="<?php echo base_url() ?>index.php/teacher/deleteFotocopyRequest/<?php echo $s['frequestid'] ?>" class="btn-success btn <?php echo (isset($s['status']) && $s['status'] == 1 ? 'disabled' : '') ?>" onclick="return confirm('Are you sure want to delete this?');"><i class="fa fa-trash"></i> Delete</a>
                                        </td>
                                        <?php echo form_close(); ?>
                                    </tr>
                                <?php }} ?>
                            <tr>
                                <?php echo form_open('teacher/addFotocopyRequest/'); ?>
                                <td><input class="form-control" name="isbn"></td>
                                <td><input class="form-control" name="name"></td>
                                <td><input class="form-control" name="value"></td>
                                <td><button type="submit" class="btn btn-success"><i class="fa fa-plus"></i> Add</button></td>
                                <?php echo form_close(); ?>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->
<script>
    $('.disabled').click(function(e){
        e.preventDefault();
    })
</script>