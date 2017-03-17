<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Course Name</h3>
            </div>
        </div>

        <div class="clearfix"></div>

        <?php if (!empty($top2navigation)): ?>
            <?php $this->load->view($top2navigation); ?>
        <?php else: ?>
            Navigation not found !
        <?php endif; ?>
        
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
                                <th width="10%" style="text-align: center">Lesson</th>
                                <th width="20%">Chapter/Unit</th>
                                <th width="20%">Learning Objective</th>
                                <th width="20%">Student Activities</th>
                                <th width="20%">Materials/Resources</th>
                                <th width="10%">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td align="center">1</td>
                                    <td>Chapter 1</td>
                                    <td>Chapter 1 Objectives</td>
                                    <td>Chapter 1 Activities</td>
                                    <td>Chapter 1 Materials</td>
                                    <td><a class="btn btn-success"><i class="fa fa-edit"> Edit</i></a></td>
                                </tr>
                                <tr>
                                    <td align="center">1</td>
                                    <td>Chapter 1</td>
                                    <td>Chapter 1 Objectives</td>
                                    <td>Chapter 1 Activities</td>
                                    <td>Chapter 1 Materials</td>
                                    <td><a class="btn btn-success"><i class="fa fa-edit"> Edit</i></a></td>
                                </tr>
                                <tr>
                                    <td align="center">1</td>
                                    <td>Chapter 1</td>
                                    <td>Chapter 1 Objectives</td>
                                    <td>Chapter 1 Activities</td>
                                    <td>Chapter 1 Materials</td>
                                    <td><a class="btn btn-success"><i class="fa fa-edit"> Edit</i></a></td>
                                </tr>
                                <tr>
                                    <td align="center">1</td>
                                    <td>Chapter 1</td>
                                    <td>Chapter 1 Objectives</td>
                                    <td>Chapter 1 Activities</td>
                                    <td>Chapter 1 Materials</td>
                                    <td><a class="btn btn-success"><i class="fa fa-edit"> Edit</i></a></td>
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