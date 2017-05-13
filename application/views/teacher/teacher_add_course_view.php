<!-- page content -->
<div class="right_col" role="main">
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
    <div class="">
        <div class="page-title">
            <?php echo form_open('teacher/addCourse'); ?>
            <div class="title_left">
                <h3>Course Name: <input type="text" class="form-control set-margin-bottom set-margin-top" name="coursename" value="<?php echo set_value('coursename', isset($info_db['coursename']) ? $info_db['coursename'] : ''); ?>"/></h3>
            </div>
        </div>

        <div class="clearfix"></div>
        
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Course Overview</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <textarea class="form-control set-margin-bottom" name="coursedescription" rows="3" placeholder="Course Description"><?php if(isset($_POST['coursedescription'])) {echo htmlentities ($_POST['coursedescription']); }?></textarea>
                        <br><br>
                        Resources:
                        <textarea class="form-control set-margin-bottom set-margin-top" name="courseresources" rows="3" placeholder="Course Resources (Separate resource using | )"><?php if(isset($_POST['courseresources'])) {echo htmlentities ($_POST['courseresources']); }?></textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Lesson Plan</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <table class="teacher_course_implementation">
                            <thead>
                            <tr>
                                <th width="20%">Chapter/Unit</th>
                                <th width="20%">Learning Objective</th>
                                <th width="20%">Student Activities</th>
                                <th width="20%">Materials/Resources</th>
                            </tr>
                            </thead>
                            <tbody id="plan_wrapper">
                            <tr>
                                <td><input type="text" class="form-control set-margin-bottom set-margin-top" name="chapter[]" placeholder="ex: 1,2,3"/></td>
                                <td><textarea class="form-control set-margin-bottom" name="objective[]" rows="3"></textarea></td>
                                <td><textarea class="form-control set-margin-bottom" name="activities[]" rows="3"></textarea></td>
                                <td><textarea class="form-control set-margin-bottom" name="material[]" rows="3"></textarea></td>
                            </tr>
                            <tr class="toAdd">
                                <td><input type="text" class="form-control set-margin-bottom set-margin-top" name="chapter[]" placeholder="ex: 1,2,3"/></td>
                                <td><textarea class="form-control set-margin-bottom" name="objective[]" rows="3"></textarea></td>
                                <td><textarea class="form-control set-margin-bottom" name="activities[]" rows="3"></textarea></td>
                                <td><textarea class="form-control set-margin-bottom" name="material[]" rows="3"></textarea></td>
                            </tr>
                            <tr class="toAdd">
                                <td><input type="text" class="form-control set-margin-bottom set-margin-top" name="chapter[]" placeholder="ex: 1,2,3"/></td>
                                <td><textarea class="form-control set-margin-bottom" name="objective[]" rows="3"></textarea></td>
                                <td><textarea class="form-control set-margin-bottom" name="activities[]" rows="3"></textarea></td>
                                <td><textarea class="form-control set-margin-bottom" name="material[]" rows="3"></textarea></td>
                            </tr>
                            <tr class="toAdd">
                                <td><input type="text" class="form-control set-margin-bottom set-margin-top" name="chapter[]" placeholder="ex: 1,2,3"/></td>
                                <td><textarea class="form-control set-margin-bottom" name="objective[]" rows="3"></textarea></td>
                                <td><textarea class="form-control set-margin-bottom" name="activities[]" rows="3"></textarea></td>
                                <td><textarea class="form-control set-margin-bottom" name="material[]" rows="3"></textarea></td>
                            </tr>
                            <tr class="toAdd">
                                <td><input type="text" class="form-control set-margin-bottom set-margin-top" name="chapter[]" placeholder="ex: 1,2,3"/></td>
                                <td><textarea class="form-control set-margin-bottom" name="objective[]" rows="3"></textarea></td>
                                <td><textarea class="form-control set-margin-bottom" name="activities[]" rows="3"></textarea></td>
                                <td><textarea class="form-control set-margin-bottom" name="material[]" rows="3"></textarea></td>
                            </tr>
                            <tr class="toAdd">
                                <td><input type="text" class="form-control set-margin-bottom set-margin-top" name="chapter[]" placeholder="ex: 1,2,3"/></td>
                                <td><textarea class="form-control set-margin-bottom" name="objective[]" rows="3"></textarea></td>
                                <td><textarea class="form-control set-margin-bottom" name="activities[]" rows="3"></textarea></td>
                                <td><textarea class="form-control set-margin-bottom" name="material[]" rows="3"></textarea></td>
                            </tr>
                            <tr class="toAdd">
                                <td><input type="text" class="form-control set-margin-bottom set-margin-top" name="chapter[]" placeholder="ex: 1,2,3"/></td>
                                <td><textarea class="form-control set-margin-bottom" name="objective[]" rows="3"></textarea></td>
                                <td><textarea class="form-control set-margin-bottom" name="activities[]" rows="3"></textarea></td>
                                <td><textarea class="form-control set-margin-bottom" name="material[]" rows="3"></textarea></td>
                            </tr>
                            <tr class="toAdd">
                                <td><input type="text" class="form-control set-margin-bottom set-margin-top" name="chapter[]" placeholder="ex: 1,2,3"/></td>
                                <td><textarea class="form-control set-margin-bottom" name="objective[]" rows="3"></textarea></td>
                                <td><textarea class="form-control set-margin-bottom" name="activities[]" rows="3"></textarea></td>
                                <td><textarea class="form-control set-margin-bottom" name="material[]" rows="3"></textarea></td>
                            </tr>
                            <tr class="toAdd">
                                <td><input type="text" class="form-control set-margin-bottom set-margin-top" name="chapter[]" placeholder="ex: 1,2,3"/></td>
                                <td><textarea class="form-control set-margin-bottom" name="objective[]" rows="3"></textarea></td>
                                <td><textarea class="form-control set-margin-bottom" name="activities[]" rows="3"></textarea></td>
                                <td><textarea class="form-control set-margin-bottom" name="material[]" rows="3"></textarea></td>
                            </tr>
                            <tr class="toAdd">
                                <td><input type="text" class="form-control set-margin-bottom set-margin-top" name="chapter[]" placeholder="ex: 1,2,3"/></td>
                                <td><textarea class="form-control set-margin-bottom" name="objective[]" rows="3"></textarea></td>
                                <td><textarea class="form-control set-margin-bottom" name="activities[]" rows="3"></textarea></td>
                                <td><textarea class="form-control set-margin-bottom" name="material[]" rows="3"></textarea></td>
                            </tr>
                            <tr class="toAdd">
                                <td><input type="text" class="form-control set-margin-bottom set-margin-top" name="chapter[]" placeholder="ex: 1,2,3"/></td>
                                <td><textarea class="form-control set-margin-bottom" name="objective[]" rows="3"></textarea></td>
                                <td><textarea class="form-control set-margin-bottom" name="activities[]" rows="3"></textarea></td>
                                <td><textarea class="form-control set-margin-bottom" name="material[]" rows="3"></textarea></td>
                            </tr>
                            <tr class="toAdd">
                                <td><input type="text" class="form-control set-margin-bottom set-margin-top" name="chapter[]" placeholder="ex: 1,2,3"/></td>
                                <td><textarea class="form-control set-margin-bottom" name="objective[]" rows="3"></textarea></td>
                                <td><textarea class="form-control set-margin-bottom" name="activities[]" rows="3"></textarea></td>
                                <td><textarea class="form-control set-margin-bottom" name="material[]" rows="3"></textarea></td>
                            </tr>
                            <tr class="toAdd">
                                <td><input type="text" class="form-control set-margin-bottom set-margin-top" name="chapter[]" placeholder="ex: 1,2,3"/></td>
                                <td><textarea class="form-control set-margin-bottom" name="objective[]" rows="3"></textarea></td>
                                <td><textarea class="form-control set-margin-bottom" name="activities[]" rows="3"></textarea></td>
                                <td><textarea class="form-control set-margin-bottom" name="material[]" rows="3"></textarea></td>
                            </tr>
                            <tr class="toAdd">
                                <td><input type="text" class="form-control set-margin-bottom set-margin-top" name="chapter[]" placeholder="ex: 1,2,3"/></td>
                                <td><textarea class="form-control set-margin-bottom" name="objective[]" rows="3"></textarea></td>
                                <td><textarea class="form-control set-margin-bottom" name="activities[]" rows="3"></textarea></td>
                                <td><textarea class="form-control set-margin-bottom" name="material[]" rows="3"></textarea></td>
                            </tr>
                            <tr class="toAdd">
                                <td><input type="text" class="form-control set-margin-bottom set-margin-top" name="chapter[]" placeholder="ex: 1,2,3"/></td>
                                <td><textarea class="form-control set-margin-bottom" name="objective[]" rows="3"></textarea></td>
                                <td><textarea class="form-control set-margin-bottom" name="activities[]" rows="3"></textarea></td>
                                <td><textarea class="form-control set-margin-bottom" name="material[]" rows="3"></textarea></td>
                            </tr>
                            <tr class="toAdd">
                                <td><input type="text" class="form-control set-margin-bottom set-margin-top" name="chapter[]" placeholder="ex: 1,2,3"/></td>
                                <td><textarea class="form-control set-margin-bottom" name="objective[]" rows="3"></textarea></td>
                                <td><textarea class="form-control set-margin-bottom" name="activities[]" rows="3"></textarea></td>
                                <td><textarea class="form-control set-margin-bottom" name="material[]" rows="3"></textarea></td>
                            </tr>
                            <tr class="toAdd">
                                <td><input type="text" class="form-control set-margin-bottom set-margin-top" name="chapter[]" placeholder="ex: 1,2,3"/></td>
                                <td><textarea class="form-control set-margin-bottom" name="objective[]" rows="3"></textarea></td>
                                <td><textarea class="form-control set-margin-bottom" name="activities[]" rows="3"></textarea></td>
                                <td><textarea class="form-control set-margin-bottom" name="material[]" rows="3"></textarea></td>
                            </tr>
                            <tr class="toAdd">
                                <td><input type="text" class="form-control set-margin-bottom set-margin-top" name="chapter[]" placeholder="ex: 1,2,3"/></td>
                                <td><textarea class="form-control set-margin-bottom" name="objective[]" rows="3"></textarea></td>
                                <td><textarea class="form-control set-margin-bottom" name="activities[]" rows="3"></textarea></td>
                                <td><textarea class="form-control set-margin-bottom" name="material[]" rows="3"></textarea></td>
                            </tr>
                            <tr class="toAdd">
                                <td><input type="text" class="form-control set-margin-bottom set-margin-top" name="chapter[]" placeholder="ex: 1,2,3"/></td>
                                <td><textarea class="form-control set-margin-bottom" name="objective[]" rows="3"></textarea></td>
                                <td><textarea class="form-control set-margin-bottom" name="activities[]" rows="3"></textarea></td>
                                <td><textarea class="form-control set-margin-bottom" name="material[]" rows="3"></textarea></td>
                            </tr>
                            <tr class="toAdd">
                                <td><input type="text" class="form-control set-margin-bottom set-margin-top" name="chapter[]" placeholder="ex: 1,2,3"/></td>
                                <td><textarea class="form-control set-margin-bottom" name="objective[]" rows="3"></textarea></td>
                                <td><textarea class="form-control set-margin-bottom" name="activities[]" rows="3"></textarea></td>
                                <td><textarea class="form-control set-margin-bottom" name="material[]" rows="3"></textarea></td>
                            </tr>
                            <tr class="toAdd">
                                <td><input type="text" class="form-control set-margin-bottom set-margin-top" name="chapter[]" placeholder="ex: 1,2,3"/></td>
                                <td><textarea class="form-control set-margin-bottom" name="objective[]" rows="3"></textarea></td>
                                <td><textarea class="form-control set-margin-bottom" name="activities[]" rows="3"></textarea></td>
                                <td><textarea class="form-control set-margin-bottom" name="material[]" rows="3"></textarea></td>
                            </tr>
                            <tr class="toAdd">
                                <td><input type="text" class="form-control set-margin-bottom set-margin-top" name="chapter[]" placeholder="ex: 1,2,3"/></td>
                                <td><textarea class="form-control set-margin-bottom" name="objective[]" rows="3"></textarea></td>
                                <td><textarea class="form-control set-margin-bottom" name="activities[]" rows="3"></textarea></td>
                                <td><textarea class="form-control set-margin-bottom" name="material[]" rows="3"></textarea></td>
                            </tr>
                            <tr class="toAdd">
                                <td><input type="text" class="form-control set-margin-bottom set-margin-top" name="chapter[]" placeholder="ex: 1,2,3"/></td>
                                <td><textarea class="form-control set-margin-bottom" name="objective[]" rows="3"></textarea></td>
                                <td><textarea class="form-control set-margin-bottom" name="activities[]" rows="3"></textarea></td>
                                <td><textarea class="form-control set-margin-bottom" name="material[]" rows="3"></textarea></td>
                            </tr>
                            <tr class="toAdd">
                                <td><input type="text" class="form-control set-margin-bottom set-margin-top" name="chapter[]" placeholder="ex: 1,2,3"/></td>
                                <td><textarea class="form-control set-margin-bottom" name="objective[]" rows="3"></textarea></td>
                                <td><textarea class="form-control set-margin-bottom" name="activities[]" rows="3"></textarea></td>
                                <td><textarea class="form-control set-margin-bottom" name="material[]" rows="3"></textarea></td>
                            </tr>
                            <tr class="toAdd">
                                <td><input type="text" class="form-control set-margin-bottom set-margin-top" name="chapter[]" placeholder="ex: 1,2,3"/></td>
                                <td><textarea class="form-control set-margin-bottom" name="objective[]" rows="3"></textarea></td>
                                <td><textarea class="form-control set-margin-bottom" name="activities[]" rows="3"></textarea></td>
                                <td><textarea class="form-control set-margin-bottom" name="material[]" rows="3"></textarea></td>
                            </tr>
                            <tr class="toAdd">
                                <td><input type="text" class="form-control set-margin-bottom set-margin-top" name="chapter[]" placeholder="ex: 1,2,3"/></td>
                                <td><textarea class="form-control set-margin-bottom" name="objective[]" rows="3"></textarea></td>
                                <td><textarea class="form-control set-margin-bottom" name="activities[]" rows="3"></textarea></td>
                                <td><textarea class="form-control set-margin-bottom" name="material[]" rows="3"></textarea></td>
                            </tr>
                            <tr class="toAdd">
                                <td><input type="text" class="form-control set-margin-bottom set-margin-top" name="chapter[]" placeholder="ex: 1,2,3"/></td>
                                <td><textarea class="form-control set-margin-bottom" name="objective[]" rows="3"></textarea></td>
                                <td><textarea class="form-control set-margin-bottom" name="activities[]" rows="3"></textarea></td>
                                <td><textarea class="form-control set-margin-bottom" name="material[]" rows="3"></textarea></td>
                            </tr>
                            <tr class="toAdd">
                                <td><input type="text" class="form-control set-margin-bottom set-margin-top" name="chapter[]" placeholder="ex: 1,2,3"/></td>
                                <td><textarea class="form-control set-margin-bottom" name="objective[]" rows="3"></textarea></td>
                                <td><textarea class="form-control set-margin-bottom" name="activities[]" rows="3"></textarea></td>
                                <td><textarea class="form-control set-margin-bottom" name="material[]" rows="3"></textarea></td>
                            </tr>
                            <tr class="toAdd">
                                <td><input type="text" class="form-control set-margin-bottom set-margin-top" name="chapter[]" placeholder="ex: 1,2,3"/></td>
                                <td><textarea class="form-control set-margin-bottom" name="objective[]" rows="3"></textarea></td>
                                <td><textarea class="form-control set-margin-bottom" name="activities[]" rows="3"></textarea></td>
                                <td><textarea class="form-control set-margin-bottom" name="material[]" rows="3"></textarea></td>
                            </tr>
                            <tr class="toAdd">
                                <td><input type="text" class="form-control set-margin-bottom set-margin-top" name="chapter[]" placeholder="ex: 1,2,3"/></td>
                                <td><textarea class="form-control set-margin-bottom" name="objective[]" rows="3"></textarea></td>
                                <td><textarea class="form-control set-margin-bottom" name="activities[]" rows="3"></textarea></td>
                                <td><textarea class="form-control set-margin-bottom" name="material[]" rows="3"></textarea></td>
                            </tr>
                            <tr class="toAdd">
                                <td><input type="text" class="form-control set-margin-bottom set-margin-top" name="chapter[]" placeholder="ex: 1,2,3"/></td>
                                <td><textarea class="form-control set-margin-bottom" name="objective[]" rows="3"></textarea></td>
                                <td><textarea class="form-control set-margin-bottom" name="activities[]" rows="3"></textarea></td>
                                <td><textarea class="form-control set-margin-bottom" name="material[]" rows="3"></textarea></td>
                            </tr>
                            <tr class="toAdd">
                                <td><input type="text" class="form-control set-margin-bottom set-margin-top" name="chapter[]" placeholder="ex: 1,2,3"/></td>
                                <td><textarea class="form-control set-margin-bottom" name="objective[]" rows="3"></textarea></td>
                                <td><textarea class="form-control set-margin-bottom" name="activities[]" rows="3"></textarea></td>
                                <td><textarea class="form-control set-margin-bottom" name="material[]" rows="3"></textarea></td>
                            </tr>
                            <tr class="toAdd">
                                <td><input type="text" class="form-control set-margin-bottom set-margin-top" name="chapter[]" placeholder="ex: 1,2,3"/></td>
                                <td><textarea class="form-control set-margin-bottom" name="objective[]" rows="3"></textarea></td>
                                <td><textarea class="form-control set-margin-bottom" name="activities[]" rows="3"></textarea></td>
                                <td><textarea class="form-control set-margin-bottom" name="material[]" rows="3"></textarea></td>
                            </tr>
                            <tr class="toAdd">
                                <td><input type="text" class="form-control set-margin-bottom set-margin-top" name="chapter[]" placeholder="ex: 1,2,3"/></td>
                                <td><textarea class="form-control set-margin-bottom" name="objective[]" rows="3"></textarea></td>
                                <td><textarea class="form-control set-margin-bottom" name="activities[]" rows="3"></textarea></td>
                                <td><textarea class="form-control set-margin-bottom" name="material[]" rows="3"></textarea></td>
                            </tr>
                            <tr class="toAdd">
                                <td><input type="text" class="form-control set-margin-bottom set-margin-top" name="chapter[]" placeholder="ex: 1,2,3"/></td>
                                <td><textarea class="form-control set-margin-bottom" name="objective[]" rows="3"></textarea></td>
                                <td><textarea class="form-control set-margin-bottom" name="activities[]" rows="3"></textarea></td>
                                <td><textarea class="form-control set-margin-bottom" name="material[]" rows="3"></textarea></td>
                            </tr>
                            <tr class="toAdd">
                                <td><input type="text" class="form-control set-margin-bottom set-margin-top" name="chapter[]" placeholder="ex: 1,2,3"/></td>
                                <td><textarea class="form-control set-margin-bottom" name="objective[]" rows="3"></textarea></td>
                                <td><textarea class="form-control set-margin-bottom" name="activities[]" rows="3"></textarea></td>
                                <td><textarea class="form-control set-margin-bottom" name="material[]" rows="3"></textarea></td>
                            </tr>
                            <tr class="toAdd">
                                <td><input type="text" class="form-control set-margin-bottom set-margin-top" name="chapter[]" placeholder="ex: 1,2,3"/></td>
                                <td><textarea class="form-control set-margin-bottom" name="objective[]" rows="3"></textarea></td>
                                <td><textarea class="form-control set-margin-bottom" name="activities[]" rows="3"></textarea></td>
                                <td><textarea class="form-control set-margin-bottom" name="material[]" rows="3"></textarea></td>
                            </tr>
                            <tr class="toAdd">
                                <td><input type="text" class="form-control set-margin-bottom set-margin-top" name="chapter[]" placeholder="ex: 1,2,3"/></td>
                                <td><textarea class="form-control set-margin-bottom" name="objective[]" rows="3"></textarea></td>
                                <td><textarea class="form-control set-margin-bottom" name="activities[]" rows="3"></textarea></td>
                                <td><textarea class="form-control set-margin-bottom" name="material[]" rows="3"></textarea></td>
                            </tr>
                            <tr class="toAdd">
                                <td><input type="text" class="form-control set-margin-bottom set-margin-top" name="chapter[]" placeholder="ex: 1,2,3"/></td>
                                <td><textarea class="form-control set-margin-bottom" name="objective[]" rows="3"></textarea></td>
                                <td><textarea class="form-control set-margin-bottom" name="activities[]" rows="3"></textarea></td>
                                <td><textarea class="form-control set-margin-bottom" name="material[]" rows="3"></textarea></td>
                            </tr>
                            <tr class="toAdd">
                                <td><input type="text" class="form-control set-margin-bottom set-margin-top" name="chapter[]" placeholder="ex: 1,2,3"/></td>
                                <td><textarea class="form-control set-margin-bottom" name="objective[]" rows="3"></textarea></td>
                                <td><textarea class="form-control set-margin-bottom" name="activities[]" rows="3"></textarea></td>
                                <td><textarea class="form-control set-margin-bottom" name="material[]" rows="3"></textarea></td>
                            </tr>
                            <a class="btn btn-success set-right addPlan"><i class="fa fa-plus m-right-xs"></i> Add Plan</a>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-success set-right"><i class="fa fa-save m-right-xs"></i> Add Course</button>
        <?php echo form_close(); ?>
    </div>
</div>
<!-- /page content -->