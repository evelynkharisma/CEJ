<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Evelyn Kharisma Mid Term Report</h3>
            </div>


        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Year 16/17</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="col-md-12">
                                <table class="teacher_course_student_mid table-bordered">
                                    <?php echo form_open('teacher/homeroomEvaluation'); ?>
                                    <tr>
                                        <td width="50%" class="teacher_course_student_mid_td">Homeroom Teacher: Teacher Name</td>
                                        <td class="teacher_course_student_mid_td set-center">1</td>
                                        <td class="teacher_course_student_mid_td set-center">2</td>
                                        <td class="teacher_course_student_mid_td set-center">3</td>
                                        <td class="teacher_course_student_mid_td set-center">4</td>
                                        <td class="teacher_course_student_mid_td set-center">5</td>
                                    </tr>
                                    <tr>
                                        <td class="teacher_course_student_mid_td">Shows consideration for others</td>
                                        <td class="set-center"><input id="op1_1" type="radio" name="op1" value="1"><label for="op1_1"></label></td>
                                        <td class="set-center"><input id="op1_2" type="radio" name="op1" value="2"><label for="op1_2"></label></td>
                                        <td class="set-center"><input id="op1_3" type="radio" name="op1" value="3"><label for="op1_3"></label></td>
                                        <td class="set-center"><input id="op1_4" type="radio" name="op1" value="4"><label for="op1_4"></label></td>
                                        <td class="set-center"><input id="op1_5" type="radio" name="op1" value="5"><label for="op1_5"></label></td>
                                    </tr>
                                    <tr>
                                        <td class="teacher_course_student_mid_td">Behaves responsibly</td>
                                        <td class="set-center"><input id="op2_1" type="radio" name="op2" value="1"><label for="op2_1"></label></td>
                                        <td class="set-center"><input id="op2_2" type="radio" name="op2" value="2"><label for="op2_2"></label></td>
                                        <td class="set-center"><input id="op2_3" type="radio" name="op2" value="3"><label for="op2_3"></label></td>
                                        <td class="set-center"><input id="op2_4" type="radio" name="op2" value="4"><label for="op2_4"></label></td>
                                        <td class="set-center"><input id="op2_5" type="radio" name="op2" value="5"><label for="op2_5"></label></td>
                                    </tr>
                                    <tr>
                                        <td class="teacher_course_student_mid_td">Communicates effectively</td>
                                        <td class="set-center"><input id="op3_1" type="radio" name="op3" value="1"><label for="op3_1"></label></td>
                                        <td class="set-center"><input id="op3_2" type="radio" name="op3" value="2"><label for="op3_2"></label></td>
                                        <td class="set-center"><input id="op3_3" type="radio" name="op3" value="3"><label for="op3_3"></label></td>
                                        <td class="set-center"><input id="op3_4" type="radio" name="op3" value="4"><label for="op3_4"></label></td>
                                        <td class="set-center"><input id="op3_5" type="radio" name="op3" value="5"><label for="op3_5"></label></td>
                                    </tr>
                                    <tr>
                                        <td class="teacher_course_student_mid_td">Is punctual</td>
                                        <td class="set-center"><input id="op4_1" type="radio" name="op4" value="1"><label for="op4_1"></label></td>
                                        <td class="set-center"><input id="op4_2" type="radio" name="op4" value="2"><label for="op4_2"></label></td>
                                        <td class="set-center"><input id="op4_3" type="radio" name="op4" value="3"><label for="op4_3"></label></td>
                                        <td class="set-center"><input id="op4_4" type="radio" name="op4" value="4"><label for="op4_4"></label></td>
                                        <td class="set-center"><input id="op4_5" type="radio" name="op4" value="5"><label for="op4_5"></label></td>
                                    </tr>
                                    <tr>
                                        <td class="teacher_course_student_mid_td">Attendance</td>
                                        <td colspan="5">
                                            97%
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="6">
                                            <textarea style="resize: none" class="form-control set-margin-bottom" rows="3" placeholder='Comments'></textarea>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="6">
                                            <button type="submit" class="btn btn-success set-right"><i class="fa fa-edit"></i> Edit</button>
                                        </td>
                                    </tr>
                                </table>
                                <?php echo form_close(); ?>
                                <table class="teacher_course_student_mid table-bordered">
                                    <tr>
                                        <td width="50%" class="teacher_course_student_mid_td">Course</td>
                                        <td class="teacher_course_student_mid_td set-center">1</td>
                                        <td class="teacher_course_student_mid_td set-center">2</td>
                                        <td class="teacher_course_student_mid_td set-center">3</td>
                                        <td class="teacher_course_student_mid_td set-center">4</td>
                                        <td class="teacher_course_student_mid_td set-center">5</td>
                                    </tr>
                                    <tr>
                                        <td class="teacher_course_student_mid_td">Is self-motivated</td>
                                        <td class="set-center"><span class="option_tick"></span></td>
                                        <td class="set-center"></td>
                                        <td class="set-center"></td>
                                        <td class="set-center"></td>
                                        <td class="set-center"></td>
                                    </tr>
                                    <tr>
                                        <td class="teacher_course_student_mid_td">Shows initiatives and asks questions</td>
                                        <td class="set-center"></td>
                                        <td class="set-center"></td>
                                        <td class="set-center"><span class="option_tick"></span></td>
                                        <td class="set-center"></td>
                                        <td class="set-center"></td>
                                    </tr>
                                    <tr>
                                        <td class="teacher_course_student_mid_td">Persists despite difficulties</td>
                                        <td class="set-center"></td>
                                        <td class="set-center"></td>
                                        <td class="set-center"><span class="option_tick"></span></td>
                                        <td class="set-center"></td>
                                        <td class="set-center"></td>
                                    </tr>
                                    <tr>
                                        <td class="teacher_course_student_mid_td">Is well-organised and punctual</td>
                                        <td class="set-center"></td>
                                        <td class="set-center"></td>
                                        <td class="set-center"></td>
                                        <td class="set-center"></td>
                                        <td class="set-center"><span class="option_tick"></span></td>
                                    </tr>
                                    <tr>
                                        <td class="teacher_course_student_mid_td">Completes classroom tasks</td>
                                        <td class="set-center"></td>
                                        <td class="set-center"><span class="option_tick"></span></td>
                                        <td class="set-center"></td>
                                        <td class="set-center"></td>
                                        <td class="set-center"></td>
                                    </tr>
                                    <tr>
                                        <td class="teacher_course_student_mid_td">Completes homework on time</td>
                                        <td class="set-center"><span class="option_tick"></span></td>
                                        <td class="set-center"></td>
                                        <td class="set-center"></td>
                                        <td class="set-center"></td>
                                        <td class="set-center"></td>
                                    </tr>
                                    <tr>
                                        <td class="teacher_course_student_mid_td">Exam Mark</td>
                                        <td colspan="5">90</td>
                                    </tr>
                                    <tr>
                                        <td class="teacher_course_student_mid_td">Course Grade</td>
                                        <td colspan="5">A</td>
                                    </tr>
                                    <tr>
                                        <td class="teacher_course_student_mid_td">Teacher</td>
                                        <td colspan="5">Teacher Name</td>
                                    </tr>
                                    <tr>
                                        <td colspan="6">
                                            <textarea readonly style="resize: none" class="form-control set-margin-bottom" rows="3" placeholder='Comments'></textarea>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->