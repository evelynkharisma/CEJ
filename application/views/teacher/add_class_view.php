<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Add Class</h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <?php if ($this->nativesession->get('error')): ?>
            <div  class="alert alert-error">
                <?php echo $this->nativesession->get('error'); $this->nativesession->delete('error'); ?>
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
                        <?php echo form_open_multipart('teacher/addClass'); ?>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Classroom</label>
                            <div class="col-md-9 col-sm-9 col-xs-12 set-margin-bottom">
                                <input type="text" class="form-control set-margin-bottom set-margin-top" name="class" placeholder="ex: 1_A" value="<?php echo set_value('class', isset($class['class']) ? $class['class'] : ''); ?>"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Homeroom</label>
                            <div class="col-md-9 col-sm-9 col-xs-12 set-margin-bottom">
                                <select name="teacher" class="chosen-select form-control set-margin-bottom set-margin-top">
                                    <option disabled selected="selected">Homeroom</option>
<!--                                    <option value="none">None (Collaborative/Elective)</option>-->
                                    <?php foreach ($teacher as $t){?>
                                        <option value="<?php echo $t['teacherid']; ?>"><?php echo $t['firstname']; ?> <?php echo $t['lastname']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12 set-margin-top">Capacity</label>
                            <div class="col-md-9 col-sm-9 col-xs-12 set-margin-bottom">
                                <input type="text" class="form-control set-margin-bottom set-margin-top" name="capacity" placeholder="Capacity" value="<?php echo set_value('capacity', isset($class['capacity']) ? $class['capacity'] : '30'); ?>"/>
                            </div>
                        </div>
<!--                        <div class="form-group">-->
<!--                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Collaborative/Elective Class</label>-->
<!--                            <div class="col-md-9 col-sm-9 col-xs-12 set-margin-bottom">-->
<!--                                <input type="checkbox" class="form-control set-margin-bottom set-margin-top" name="type" id="type" value="1" --><?php //echo (isset($class['type']) && $class['type']==1)?'checked':'' ?><!--/><label for="type"></label>-->
<!--                            </div>-->
<!--                        </div>-->
                        <button type="submit" class="btn btn-success set-margin-top"><i class="fa fa-plus"></i> Add Class</button>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->