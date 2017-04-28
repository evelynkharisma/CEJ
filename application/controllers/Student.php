<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class student extends CI_Controller {

    var $template = 'template';
    var $profilephotopath = 'assets/img/teacher/profile/';
    var $materialpath = 'assets/file/teacher/material/';
    var $formpath = 'assets/file/forms/';
    var $eventimagepath = 'assets/img/texteditor/';

    function __construct() {
        parent::__construct();
//        $this->general->StudentLogin();
        $this->load->model('Student_model');
    }

    public function home()
    {
        $data['title'] = 'Student LMS';
        $data['sidebar'] = 'student/student_sidebar';
        $data['topnavigation'] = 'student/student_topnavigation';
        $data['content'] = 'student/student_home_view';
        $this->load->view($this->template, $data);
    }

    public function learning_attendance()
    {
        $data['title'] = 'Student LMS';
        $data['sidebar'] = 'student/student_sidebar';
        $data['topnavigation'] = 'student/student_topnavigation';
        $data['content'] = 'student/learning_attendance_view';
        $this->load->view($this->template, $data);
    }

    public function learning_report()
    {
        $data['title'] = 'Student LMS';
        $data['sidebar'] = 'student/student_sidebar';
        $data['topnavigation'] = 'student/student_topnavigation';
        $data['content'] = 'student/learning_report_view';
        $this->load->view($this->template, $data);
    }

    public function classScheduleView()
    {
        $data['title'] = 'SMS';
        $data['sidebar'] = 'student/student_sidebar';
        $data['topnavigation'] = 'student/student_topnavigation';
        $data['content'] = 'includes/class_schedule_view';
        $this->load->view($this->template, $data);
    }

    public function examScheduleView()
    {
        $data['title'] = 'SMS';
        $data['sidebar'] = 'student/student_sidebar';
        $data['topnavigation'] = 'student/student_topnavigation';
        $data['content'] = 'includes/exam_schedule_view';
        $this->load->view($this->template, $data);
    }

    public function courseAssignmentQuiz()
    {
        $data['title'] = 'Student LMS';
        $data['sidebar'] = 'student/student_sidebar';
        $data['topnavigation'] = 'student/student_topnavigation';
        $data['content'] = 'student/student_course_qna_view';
        $this->load->view($this->template, $data);
    }

    public function courseMaterial()
    {
        $data['title'] = 'Student LMS';
        $data['sidebar'] = 'student/student_sidebar';
        $data['topnavigation'] = 'student/student_topnavigation';
        $data['content'] = 'student/student_course_material_view';
        $this->load->view($this->template, $data);
    }

    public function coursePlan()
    {
        $data['title'] = 'Student LMS';
        $data['sidebar'] = 'student/student_sidebar';
        $data['topnavigation'] = 'student/student_topnavigation';
        $data['content'] = 'student/student_course_plan_view';
        $this->load->view($this->template, $data);
    }

    public function courseStudent()
    {
        $data['title'] = 'Student LMS';
        $data['sidebar'] = 'student/student_sidebar';
        $data['topnavigation'] = 'student/student_topnavigation';
        $data['content'] = 'student/student_course_student_view';
        $this->load->view($this->template, $data);
    }

    public function courseView()
    {
        $data['title'] = 'Student LMS';
        $data['sidebar'] = 'student/student_sidebar';
        $data['topnavigation'] = 'student/student_topnavigation';
        $data['content'] = 'student/student_course_view';
        $this->load->view($this->template, $data);
    }

    public function courseImplementation()
    {
        $data['title'] = 'Student LMS';
        $data['sidebar'] = 'student/student_sidebar';
        $data['topnavigation'] = 'student/student_topnavigation';
        $data['content'] = 'student/student_course_view';
        $this->load->view($this->template, $data);
    }

    public function student_profile()
    {
        $data['title'] = 'Student LMS';
        $data['sidebar'] = 'student/student_sidebar';
        $data['topnavigation'] = 'student/student_topnavigation';
        $data['content'] = 'student/student_profile_view';
        $this->load->view($this->template, $data);
    }



    public function student_profile_edit()
    {
        $data['title'] = 'Student LMS';
        $data['sidebar'] = 'student/student_sidebar';
        $data['topnavigation'] = 'student/student_topnavigation';
        $data['content'] = 'student/student_profile_edit_view';
        $this->load->view($this->template, $data);
    }

    public function logout(){
        $this->nativesession->delete('id');
        $this->nativesession->delete('name');
        $this->nativesession->delete('photo');
        $this->nativesession->delete('role');
        $this->nativesession->delete('lastlogin');
        $this->nativesession->delete('is_login');
        redirect('');
    }
}