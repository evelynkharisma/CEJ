<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class teacher extends CI_Controller {

    var $template = 'template';

    function __construct() {
        parent::__construct();
        $this->load->model('Teacher_model');
    }

    public function home()
    {
        $data['title'] = 'SMS';
        $data['sidebar'] = 'teacher/teacher_sidebar';
        $data['topnavigation'] = 'teacher/teacher_topnavigation';
        $data['content'] = 'teacher/teacher_home_view';
        $this->load->view($this->template, $data);
    }

    public function homeroom_attendance()
    {
        $data['title'] = 'SMS';
        $data['sidebar'] = 'teacher/teacher_sidebar';
        $data['topnavigation'] = 'teacher/teacher_topnavigation';
        $data['content'] = 'teacher/homeroom_attendance_view';
        $this->load->view($this->template, $data);
    }

    public function homeroomStudent()
    {
        $data['title'] = 'SMS';
        $data['sidebar'] = 'teacher/teacher_sidebar';
        $data['topnavigation'] = 'teacher/teacher_topnavigation';
        $data['content'] = 'teacher/homeroom_student_view';
        $this->load->view($this->template, $data);
    }

    public function homeroomReport()
    {
        $data['title'] = 'SMS';
        $data['sidebar'] = 'teacher/teacher_sidebar';
        $data['topnavigation'] = 'teacher/teacher_topnavigation';
        $data['content'] = 'teacher/homeroom_report_view';
        $this->load->view($this->template, $data);
    }

    public function teacher_profile()
    {
        $data['title'] = 'SMS';
        $data['sidebar'] = 'teacher/teacher_sidebar';
        $data['topnavigation'] = 'teacher/teacher_topnavigation';
        $data['content'] = 'teacher/teacher_profile_view';
        $id = $this->session->userdata('id');
        $data['info_db'] = $this->Teacher_model->getProfileDataByID($id);
        $this->load->view($this->template, $data);
    }

    public function addCourse()
    {
        $data['title'] = 'SMS';
        $data['sidebar'] = 'teacher/teacher_sidebar';
        $data['topnavigation'] = 'teacher/teacher_topnavigation';
        $data['content'] = 'teacher/teacher_add_course_view';
        $this->load->view($this->template, $data);
    }

    public function courseView()
    {
        $data['title'] = 'SMS';
        $data['sidebar'] = 'teacher/teacher_sidebar';
        $data['topnavigation'] = 'teacher/teacher_topnavigation';
        $data['content'] = 'teacher/teacher_course_view';
        $this->load->view($this->template, $data);
    }

    public function coursePlan(){
        $data['title'] = 'SMS';
        $data['sidebar'] = 'teacher/teacher_sidebar';
        $data['topnavigation'] = 'teacher/teacher_topnavigation';
        $data['content'] = 'teacher/teacher_course_plan_view';
        $this->load->view($this->template, $data);
    }

    public function courseImplementation(){
        $data['title'] = 'SMS';
        $data['sidebar'] = 'teacher/teacher_sidebar';
        $data['topnavigation'] = 'teacher/teacher_topnavigation';
        $data['content'] = 'teacher/teacher_course_implementation_view';
        $this->load->view($this->template, $data);
    }

    public function courseMaterial(){
        $data['title'] = 'SMS';
        $data['sidebar'] = 'teacher/teacher_sidebar';
        $data['topnavigation'] = 'teacher/teacher_topnavigation';
        $data['content'] = 'teacher/teacher_course_material_view';
        $this->load->view($this->template, $data);
    }

    public function courseAssignmentQuiz(){
        $data['title'] = 'SMS';
        $data['sidebar'] = 'teacher/teacher_sidebar';
        $data['topnavigation'] = 'teacher/teacher_topnavigation';
        $data['content'] = 'teacher/teacher_course_qna_view';
        $this->load->view($this->template, $data);
    }

    public function courseAssignmentQuizSubmission(){
        $data['title'] = 'SMS';
        $data['sidebar'] = 'teacher/teacher_sidebar';
        $data['topnavigation'] = 'teacher/teacher_topnavigation';
        $data['content'] = 'teacher/teacher_course_qna_submission_view';
        $this->load->view($this->template, $data);
    }

    public function courseStudent(){
        $data['title'] = 'SMS';
        $data['sidebar'] = 'teacher/teacher_sidebar';
        $data['topnavigation'] = 'teacher/teacher_topnavigation';
        $data['content'] = 'teacher/teacher_course_student_view';
        $this->load->view($this->template, $data);
    }

    public function courseStudentPerformance(){
        $data['title'] = 'SMS';
        $data['sidebar'] = 'teacher/teacher_sidebar';
        $data['topnavigation'] = 'teacher/teacher_topnavigation';
        $data['content'] = 'teacher/teacher_course_student_performance_view';
        $this->load->view($this->template, $data);
    }

    public function classScheduleView()
    {
        $data['title'] = 'SMS';
        $data['sidebar'] = 'teacher/teacher_sidebar';
        $data['topnavigation'] = 'teacher/teacher_topnavigation';
        $data['content'] = 'includes/class_schedule_view';
        $this->load->view($this->template, $data);
    }

    public function examScheduleView()
    {
        $data['title'] = 'SMS';
        $data['sidebar'] = 'teacher/teacher_sidebar';
        $data['topnavigation'] = 'teacher/teacher_topnavigation';
        $data['content'] = 'includes/exam_schedule_view';
        $this->load->view($this->template, $data);
    }

    public function addTeacher()
    {
        $data['title'] = 'SMS';
        $data['sidebar'] = 'teacher/teacher_sidebar';
        $data['topnavigation'] = 'teacher/teacher_topnavigation';
        $data['content'] = 'teacher/teacher_add_teacher_view';
        $this->load->view($this->template, $data);
    }

    public function studentView()
    {
        $data['title'] = 'SMS';
        $data['sidebar'] = 'teacher/teacher_sidebar';
        $data['topnavigation'] = 'teacher/teacher_topnavigation';
        $data['content'] = 'includes/students_view';
        $this->load->view($this->template, $data);
    }

    public function parentView()
    {
        $data['title'] = 'SMS';
        $data['sidebar'] = 'teacher/teacher_sidebar';
        $data['topnavigation'] = 'teacher/teacher_topnavigation';
        $data['content'] = 'includes/parents_view';
        $this->load->view($this->template, $data);
    }

    public function teacherView()
    {
        $data['title'] = 'SMS';
        $data['sidebar'] = 'teacher/teacher_sidebar';
        $data['topnavigation'] = 'teacher/teacher_topnavigation';
        $data['content'] = 'includes/teachers_view';
        $this->load->view($this->template, $data);
    }

    public function operationView()
    {
        $data['title'] = 'SMS';
        $data['sidebar'] = 'teacher/teacher_sidebar';
        $data['topnavigation'] = 'teacher/teacher_topnavigation';
        $data['content'] = 'includes/operations_view';
        $this->load->view($this->template, $data);
    }

    public function administratorView()
    {
        $data['title'] = 'SMS';
        $data['sidebar'] = 'teacher/teacher_sidebar';
        $data['topnavigation'] = 'teacher/teacher_topnavigation';
        $data['content'] = 'includes/administrators_view';
        $this->load->view($this->template, $data);
    }

    public function libraryView()
    {
        $data['title'] = 'SMS';
        $data['sidebar'] = 'teacher/teacher_sidebar';
        $data['topnavigation'] = 'teacher/teacher_topnavigation';
        $data['content'] = 'includes/libraries_view';
        $this->load->view($this->template, $data);
    }

    public function payment()
    {
        $data['title'] = 'SMS';
        $data['sidebar'] = 'teacher/teacher_sidebar';
        $data['topnavigation'] = 'teacher/teacher_topnavigation';
        $data['content'] = 'includes/payments_view';
        $this->load->view($this->template, $data);
    }
}