<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class teacher extends CI_Controller {

    var $template = 'template';
    var $profilephotopath = 'assets/img/teacher/profile/';

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

    public function profile_edit()
    {
        $this->form_validation->set_rules('firstname', 'firstname', 'required');
        $this->form_validation->set_rules('lastname', 'lastname', 'required');
        $this->form_validation->set_rules('gender', 'gender', 'required');
        $this->form_validation->set_rules('phone', 'phone', 'required');
        $this->form_validation->set_rules('email', 'email', 'required|valid_email');
        $this->form_validation->set_rules('address', 'address', 'required');
        $this->form_validation->set_rules('dateofbirth', 'date of birth', 'required');
        $this->form_validation->set_rules('placeofbirth', 'place of birth', 'required');
        $this->form_validation->set_rules('religion', 'religion', 'required');
        $this->form_validation->set_rules('elementary', 'elementary', 'required');
        $this->form_validation->set_rules('juniorhigh', 'junior high', 'required');
        $this->form_validation->set_rules('seniorhigh', 'senior high', 'required');
//        $this->form_validation->set_rules('undergraduate', 'undergraduate', 'required');
//        $this->form_validation->set_rules('graduate', 'graduate', 'required');
//        $this->form_validation->set_rules('postgraduate', 'postgraduate', 'required');
//        $this->form_validation->set_rules('experience', 'working experience', 'required');

        if ($this->input->post('password')):
            $this->form_validation->set_rules('password', 'password', 'required');
            $this->form_validation->set_rules('confirmpassword', 'confirm password', 'required|matches[password]');
        endif;

        $this->form_validation->set_error_delimiters('', '<br/>');

        if ($this->form_validation->run() == TRUE) {
            if ($_FILES['photo']['error'] != 4) {
                $config['upload_path'] = $this->profilephotopath;
                $config['allowed_types'] = "jpg|jpeg|png";
                $config['max_size'] = 200000;
                $config['overwrite'] = TRUE;
                $config['file_name'] = $this->session->userdata('id');
                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('photo')) {

                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect('teacher/profile_edit');
                } else {
                    $data = $this->upload->data();
                    $config_image = array(
                        'image_library' => 'gd2',
                        'source_image' => $this->profilephotopath.'/'.$data['orig_name'],
                        'new_image' => $this->profilephotopath.'/'.$data['orig_name'],
                        'width' => 1240,
                        'maintain_ratio' => TRUE,
                        'rotate_by_exif' => TRUE,
//                'strip_exif' => TRUE,
                    );
                    $this->load->library('image_lib', $config_image);
                    $this->image_lib->resize();

                    $filename = $data['orig_name'];
                    if ($this->Teacher_model->editProfilePhoto($this->session->userdata('id'), $filename)) {
                        $this->session->set_flashdata('success', 'Photo Changed');
                    } else {
                        $this->session->set_flashdata('error', 'Upload Photo Failed, try again !');
                        redirect('teacher/profile_edit');
                    }
                }
            }

        }

        if ($this->form_validation->run() == TRUE) {
            $this->Teacher_model->editProfile($this->session->userdata('id'));
            $this->session->set_flashdata('success', 'Profile saved');
            redirect('teacher/teacher_profile');
        }

        $data['title'] = 'SMS';
        $data['sidebar'] = 'teacher/teacher_sidebar';
        $data['topnavigation'] = 'teacher/teacher_topnavigation';
        $data['content'] = 'teacher/teacher_profile_edit_view';
        $data['info_db'] = $this->Teacher_model->getProfileDataByID($this->session->userdata('id'));
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