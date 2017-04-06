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
    public function classScheduleView()
    {
        $data['title'] = 'SMS';
        $data['sidebar'] = 'parents/parent_sidebar';
        $data['topnavigation'] = 'parents/parent_topnavigation';
        $data['content'] = 'includes/class_schedule_view';
        $this->load->view($this->template, $data);
    }
    public function examScheduleView()
    {
        $data['title'] = 'SMS';
        $data['sidebar'] = 'parents/parent_sidebar';
        $data['topnavigation'] = 'parents/parent_topnavigation';
        $data['content'] = 'includes/exam_schedule_view';
        $this->load->view($this->template, $data);
    }
    public function parent_profile()
    {
        $data['title'] = 'SMS';
        $data['sidebar'] = 'parents/parent_sidebar';
        $data['topnavigation'] = 'parents/parent_topnavigation';
        $data['content'] = 'parents/parent_profile_view';
        $this->load->view($this->template, $data);
    }
    public function parent_download()
    {
        $data['title'] = 'SMS';
        $data['sidebar'] = 'parents/parent_sidebar';
        $data['topnavigation'] = 'parents/parent_topnavigation';
        $data['content'] = 'parents/parent_download_view';
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
    public function payment_status()
    {
        $data['title'] = 'SMS';
        $data['sidebar'] = 'parents/parent_sidebar';
        $data['topnavigation'] = 'parents/parent_topnavigation';
        $data['content'] = 'parents/payment_status_view';
        $this->load->view($this->template, $data);
    }
    public function payment_receipt()
    {
        $data['title'] = 'SMS';
        $data['sidebar'] = 'parents/parent_sidebar';
        $data['topnavigation'] = 'parents/parent_topnavigation';
        $data['content'] = 'parents/payment_receipt_view';
        $this->load->view($this->template, $data);
    }
}