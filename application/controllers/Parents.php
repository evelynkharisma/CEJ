<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class parents extends CI_Controller {

    var $template = 'template';

    public function home()
    {
        $data['title'] = 'SMS';
        $data['sidebar'] = 'parents/parent_sidebar';
        $data['topnavigation'] = 'parents/parent_topnavigation';
        $data['content'] = 'parents/parent_home_view';
        $this->load->view($this->template, $data);
    }
    public function parent_attendance()
    {
        $data['title'] = 'SMS';
        $data['sidebar'] = 'parents/parent_sidebar';
        $data['topnavigation'] = 'parents/parent_topnavigation';
        $data['content'] = 'parents/parent_attendance_view';
        $this->load->view($this->template, $data);
    }
    public function parent_reportcard_midterm()
    {
        $data['title'] = 'SMS';
        $data['sidebar'] = 'parents/parent_sidebar';
        $data['topnavigation'] = 'parents/parent_topnavigation';
        $data['content'] = 'parents/parent_reportcard_midterm_view';
        $this->load->view($this->template, $data);
    }
    public function parent_reportcard_finalterm()
    {
        $data['title'] = 'SMS';
        $data['sidebar'] = 'parents/parent_sidebar';
        $data['topnavigation'] = 'parents/parent_topnavigation';
        $data['content'] = 'parents/parent_reportcard_finalterm_view';
        $this->load->view($this->template, $data);
    }
    public function parent_course()
    {
        $data['title'] = 'SMS';
        $data['sidebar'] = 'parents/parent_sidebar';
        $data['topnavigation'] = 'parents/parent_topnavigation';
        $data['content'] = 'parents/parent_course_view';
        $this->load->view($this->template, $data);
    }
    public function coursePlan()
    {
        $data['title'] = 'SMS';
        $data['sidebar'] = 'parents/parent_sidebar';
        $data['topnavigation'] = 'parents/parent_topnavigation';
        $data['content'] = 'parents/parent_course_plan_view';
        $this->load->view($this->template, $data);
    }
    public function courseImplementation()
    {
        $data['title'] = 'SMS';
        $data['sidebar'] = 'parents/parent_sidebar';
        $data['topnavigation'] = 'parents/parent_topnavigation';
        $data['content'] = 'parents/parent_course_implementation_view';
        $this->load->view($this->template, $data);
    }
    public function courseMaterial()
    {
        $data['title'] = 'SMS';
        $data['sidebar'] = 'parents/parent_sidebar';
        $data['topnavigation'] = 'parents/parent_topnavigation';
        $data['content'] = 'parents/parent_course_material_view';
        $this->load->view($this->template, $data);
    }
    public function courseAssignmentQuiz()
    {
        $data['title'] = 'SMS';
        $data['sidebar'] = 'parents/parent_sidebar';
        $data['topnavigation'] = 'parents/parent_topnavigation';
        $data['content'] = 'parents/parent_course_assignment_quiz_view';
        $this->load->view($this->template, $data);
    }
    public function coursePerformance()
    {
        $data['title'] = 'SMS';
        $data['sidebar'] = 'parents/parent_sidebar';
        $data['topnavigation'] = 'parents/parent_topnavigation';
        $data['content'] = 'parents/parent_course_performance_view';
        $this->load->view($this->template, $data);
    }

//    public function homeroomStudent()
//    {
//        $data['title'] = 'SMS';
//        $data['sidebar'] = 'parents/parent_sidebar';
//        $data['topnavigation'] = 'parents/parent_topnavigation';
//        $data['content'] = 'parents/homeroom_student_view';
//        $this->load->view($this->template, $data);
//    }
//
//    public function homeroomReport()
//    {
//        $data['title'] = 'SMS';
//        $data['sidebar'] = 'parents/parent_sidebar';
//        $data['topnavigation'] = 'parents/parent_topnavigation';
//        $data['content'] = 'parents/homeroom_report_view';
//        $this->load->view($this->template, $data);
//    }
//
    public function parent_profile()
    {
        $data['title'] = 'SMS';
        $data['sidebar'] = 'parents/parent_sidebar';
        $data['topnavigation'] = 'parents/parent_topnavigation';
        $data['content'] = 'parents/parent_profile_view';
        $this->load->view($this->template, $data);
    }
    public function parent_correspond()
    {
        $data['title'] = 'SMS';
        $data['sidebar'] = 'parents/parent_sidebar';
        $data['topnavigation'] = 'parents/parent_topnavigation';
        $data['content'] = 'parents/parent_correspond_view';
        $this->load->view($this->template, $data);
    }
//
//    public function addCourse()
//    {
//        $data['title'] = 'SMS';
//        $data['sidebar'] = 'parents/parent_sidebar';
//        $data['topnavigation'] = 'parents/parent_topnavigation';
//        $data['content'] = 'parents/parent_add_course_view';
//        $this->load->view($this->template, $data);
//    }
//
//    public function courseView()
//    {
//        $data['title'] = 'SMS';
//        $data['sidebar'] = 'parents/parent_sidebar';
//        $data['topnavigation'] = 'parents/parent_topnavigation';
//        $data['content'] = 'parents/parent_course_view';
//        $this->load->view($this->template, $data);
//    }
//
//    public function coursePlan(){
//        $data['title'] = 'SMS';
//        $data['sidebar'] = 'parents/parent_sidebar';
//        $data['topnavigation'] = 'parents/parent_topnavigation';
//        $data['content'] = 'parents/parent_course_plan_view';
//        $this->load->view($this->template, $data);
//    }
//
//    public function courseImplementation(){
//        $data['title'] = 'SMS';
//        $data['sidebar'] = 'parents/parent_sidebar';
//        $data['topnavigation'] = 'parents/parent_topnavigation';
//        $data['content'] = 'parents/parent_course_implementation_view';
//        $this->load->view($this->template, $data);
//    }
//
//    public function courseMaterial(){
//        $data['title'] = 'SMS';
//        $data['sidebar'] = 'parents/parent_sidebar';
//        $data['topnavigation'] = 'parents/parent_topnavigation';
//        $data['content'] = 'parents/parent_course_material_view';
//        $this->load->view($this->template, $data);
//    }
//
//    public function courseAssignmentQuiz(){
//        $data['title'] = 'SMS';
//        $data['sidebar'] = 'parents/parent_sidebar';
//        $data['topnavigation'] = 'parents/parent_topnavigation';
//        $data['content'] = 'parents/parent_course_qna_view';
//        $this->load->view($this->template, $data);
//    }
//
//    public function courseAssignmentQuizSubmission(){
//        $data['title'] = 'SMS';
//        $data['sidebar'] = 'parents/parent_sidebar';
//        $data['topnavigation'] = 'parents/parent_topnavigation';
//        $data['content'] = 'parents/parent_course_qna_submission_view';
//        $this->load->view($this->template, $data);
//    }
//
//    public function courseStudent(){
//        $data['title'] = 'SMS';
//        $data['sidebar'] = 'parents/parent_sidebar';
//        $data['topnavigation'] = 'parents/parent_topnavigation';
//        $data['content'] = 'parents/parent_course_student_view';
//        $this->load->view($this->template, $data);
//    }
//
//    public function courseStudentPerformance(){
//        $data['title'] = 'SMS';
//        $data['sidebar'] = 'parents/parent_sidebar';
//        $data['topnavigation'] = 'parents/parent_topnavigation';
//        $data['content'] = 'parents/parent_course_student_performance_view';
//        $this->load->view($this->template, $data);
//    }
//
//    public function classScheduleView()
//    {
//        $data['title'] = 'SMS';
//        $data['sidebar'] = 'parents/parent_sidebar';
//        $data['topnavigation'] = 'parents/parent_topnavigation';
//        $data['content'] = 'includes/class_schedule_view';
//        $this->load->view($this->template, $data);
//    }
//
//    public function examScheduleView()
//    {
//        $data['title'] = 'SMS';
//        $data['sidebar'] = 'parents/parent_sidebar';
//        $data['topnavigation'] = 'parents/parent_topnavigation';
//        $data['content'] = 'includes/exam_schedule_view';
//        $this->load->view($this->template, $data);
//    }
//
//    public function addparent()
//    {
//        $data['title'] = 'SMS';
//        $data['sidebar'] = 'parents/parent_sidebar';
//        $data['topnavigation'] = 'parents/parent_topnavigation';
//        $data['content'] = 'parents/parent_add_parent_view';
//        $this->load->view($this->template, $data);
//    }
//
//    public function studentView()
//    {
//        $data['title'] = 'SMS';
//        $data['sidebar'] = 'parents/parent_sidebar';
//        $data['topnavigation'] = 'parents/parent_topnavigation';
//        $data['content'] = 'includes/students_view';
//        $this->load->view($this->template, $data);
//    }
//
//    public function parentView()
//    {
//        $data['title'] = 'SMS';
//        $data['sidebar'] = 'parents/parent_sidebar';
//        $data['topnavigation'] = 'parents/parent_topnavigation';
//        $data['content'] = 'includes/parents_view';
//        $this->load->view($this->template, $data);
//    }
//
//    public function parentView()
//    {
//        $data['title'] = 'SMS';
//        $data['sidebar'] = 'parents/parent_sidebar';
//        $data['topnavigation'] = 'parents/parent_topnavigation';
//        $data['content'] = 'includes/parents_view';
//        $this->load->view($this->template, $data);
//    }
//
//    public function operationView()
//    {
//        $data['title'] = 'SMS';
//        $data['sidebar'] = 'parents/parent_sidebar';
//        $data['topnavigation'] = 'parents/parent_topnavigation';
//        $data['content'] = 'includes/operations_view';
//        $this->load->view($this->template, $data);
//    }
//
//    public function administratorView()
//    {
//        $data['title'] = 'SMS';
//        $data['sidebar'] = 'parents/parent_sidebar';
//        $data['topnavigation'] = 'parents/parent_topnavigation';
//        $data['content'] = 'includes/administrators_view';
//        $this->load->view($this->template, $data);
//    }
//
//    public function libraryView()
//    {
//        $data['title'] = 'SMS';
//        $data['sidebar'] = 'parents/parent_sidebar';
//        $data['topnavigation'] = 'parents/parent_topnavigation';
//        $data['content'] = 'includes/libraries_view';
//        $this->load->view($this->template, $data);
//    }
//
//    public function payment()
//    {
//        $data['title'] = 'SMS';
//        $data['sidebar'] = 'parents/parent_sidebar';
//        $data['topnavigation'] = 'parents/parent_topnavigation';
//        $data['content'] = 'includes/payments_view';
//        $this->load->view($this->template, $data);
//    }
}