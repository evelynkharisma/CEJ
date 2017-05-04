<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class student extends CI_Controller {

    var $template = 'template';
    var $profilephotopath = 'assets/img/student/';
    var $materialpath = 'assets/file/teacher/material/';
    var $formpath = 'assets/file/forms/';
    var $eventimagepath = 'assets/img/texteditor/';

    function __construct() {
        parent::__construct();
        $this->general->StudentLogin();
        $this->load->model('Student_model');
    }

    public function home()
    {
        $data['title'] = 'Student SMS';
        $data['courses'] = $this->Student_model->getStudentCourses($this->nativesession->get('classid'),$this->nativesession->get('id'));
        $data['sidebar'] = 'student/student_sidebar';
        $data['student']  = $this->Student_model->getProfileDataByID($this->nativesession->get('id'));
        $data['topnavigation'] = 'student/student_topnavigation';
        $data['events'] = $this->Student_model->getAllEvents($this->nativesession->get('id'), $this->nativesession->get('classid'));
        $data['content'] = 'student/student_home_view';
        $this->load->view($this->template, $data);
    }

    public function learning_attendance()
    {
        $data['title'] = 'Student LMS';
        $data['sidebar'] = 'student/student_sidebar';
        $data['student']  = $this->Student_model->getProfileDataByID($this->nativesession->get('id'));
        $data['topnavigation'] = 'student/student_topnavigation';
        $data['attendances'] = $this->Student_model->getAttendanceList($this->nativesession->get('classid'),$this->nativesession->get('id'));
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
        $data['student']  = $this->Student_model->getProfileDataByID($this->nativesession->get('id'));
        $data['topnavigation'] = 'student/student_topnavigation';
        $data['content'] = 'includes/class_schedule_view';
        $this->load->view($this->template, $data);
    }

    public function examScheduleView()
    {
        $data['title'] = 'SMS';
        $data['sidebar'] = 'student/student_sidebar';
        $data['student']  = $this->Student_model->getProfileDataByID($this->nativesession->get('id'));
        $data['topnavigation'] = 'student/student_topnavigation';
        $data['content'] = 'includes/exam_schedule_view';
        $this->load->view($this->template, $data);
    }

    public function courseAssignmentQuiz()
    {
        $data['title'] = 'Student LMS';
        $data['sidebar'] = 'student/student_sidebar';
        $data['student']  = $this->Student_model->getProfileDataByID($this->nativesession->get('id'));
        $data['topnavigation'] = 'student/student_topnavigation';
        $data['submissions'] = $this->Student_model->getSubmission($this->nativesession->get('id'), $this->nativesession->get('classid'));
        $data['content'] = 'student/student_course_qna_view';
        $this->load->view($this->template, $data);
    }

    public function courseMaterial()
    {
        $data['title'] = 'Student LMS';
        $data['sidebar'] = 'student/student_sidebar';
        $data['student']  = $this->Student_model->getProfileDataByID($this->nativesession->get('id'));
        $data['topnavigation'] = 'student/student_topnavigation';
        $data['content'] = 'student/student_course_material_view';
        $this->load->view($this->template, $data);
    }

    public function coursePlan()
    {
        $data['title'] = 'Student LMS';
        $data['sidebar'] = 'student/student_sidebar';
        $data['student']  = $this->Student_model->getProfileDataByID($this->nativesession->get('id'));
        $data['topnavigation'] = 'student/student_topnavigation';
        $data['content'] = 'student/student_course_plan_view';
        $this->load->view($this->template, $data);
    }

    public function courseStudent()
    {
        $data['title'] = 'Student LMS';
        $data['sidebar'] = 'student/student_sidebar';
        $data['student']  = $this->Student_model->getProfileDataByID($this->nativesession->get('id'));
        $data['topnavigation'] = 'student/student_topnavigation';
        $data['content'] = 'student/student_course_student_view';
        $this->load->view($this->template, $data);
    }

    public function courseView()
    {
        $data['title'] = 'Student LMS';
        $data['sidebar'] = 'student/student_sidebar';
        $data['student']  = $this->Student_model->getProfileDataByID($this->nativesession->get('id'));
        $data['topnavigation'] = 'student/student_topnavigation';
        $data['content'] = 'student/student_course_view';
        $this->load->view($this->template, $data);
    }

    public function courseImplementation()
    {
        $data['title'] = 'Student LMS';
        $data['sidebar'] = 'student/student_sidebar';
        $data['student']  = $this->Student_model->getProfileDataByID($this->nativesession->get('id'));
        $data['topnavigation'] = 'student/student_topnavigation';
        $data['content'] = 'student/student_course_view';
        $this->load->view($this->template, $data);
    }

    public function student_profile($id)
    {
        $id = $this->general->decryptParaID($id, 'student');
        $data['title'] = 'Student LMS';
        $data['sidebar'] = 'student/student_sidebar';
        $data['student']  = $this->Student_model->getProfileDataByID($this->nativesession->get('id'));
        $data['topnavigation'] = 'student/student_topnavigation';
        $data['content'] = 'student/student_profile_view';
        $this->load->view($this->template, $data);
    }

    public function student_profile_edit($id)
    {
        $id = $this->general->decryptParaID($id, 'student');
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
        $studentid = $this->input->post('studentid');

        if ($this->input->post('password')):
            $this->form_validation->set_rules('password', 'password', 'required');
            $this->form_validation->set_rules('confirmpassword', 'confirm password', 'required|matches[password]');
        endif;

        $this->form_validation->set_error_delimiters('', '<br/>');

        if ($this->form_validation->run() == TRUE) {
            if ($_FILES['photo']['error'] != 4) {
                $config['upload_path'] = $this->profilephotopath;
                $config['allowed_types'] = "jpg|jpeg|png|JPG|JPEG|PNG";
                $config['max_size'] = 200000;
                $config['overwrite'] = TRUE;
                $config['file_name'] = $studentid;
                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('photo')) {

                    $this->nativesession->set('error', $this->upload->display_errors());
                    redirect(current_url());
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
                    if ($this->Student_model->editProfilePhoto($studentid, $filename)) {
                    } else {
                        $this->nativesession->set('error', 'Upload Photo Failed, try again !');
                        redirect(current_url());
                    }
                }
            }

            $this->Student_model->editProfile($studentid);
            $this->nativesession->set('success', 'Profile saved');
            $eid = $this->general->encryptParaID($id, 'student');
            redirect('student/student_profile/'.$eid);
        }

        $data['title'] = 'SMS';
        $data['student']  = $this->Student_model->getProfileDataByID($this->nativesession->get('id'));
//        $data['courses'] = $this->Student_model->getAllCoursesByTeacher($this->nativesession->get('id'));
//        $data['eventnotif'] = $this->Sudent_model->getAllEventsCount($this->nativesession->get('id'),$this->nativesession->get('lastlogin'));
        $data['sidebar'] = 'student/student_sidebar';
        $data['topnavigation'] = 'student/student_topnavigation';
        $data['content'] = 'student/student_profile_edit_view';
        $data['info_db'] = $this->Student_model->getProfileDataByID($id);
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