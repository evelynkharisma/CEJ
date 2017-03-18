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
        $data['courses'] = $this->Teacher_model->getAllCoursesByTeacher($this->session->userdata('id'));
        $data['sidebar'] = 'teacher/teacher_sidebar';
        $data['topnavigation'] = 'teacher/teacher_topnavigation';
        $data['content'] = 'teacher/teacher_home_view';
        $this->load->view($this->template, $data);
    }

    public function homeroom_attendance()
    {
        $data['title'] = 'SMS';
        $data['courses'] = $this->Teacher_model->getAllCoursesByTeacher($this->session->userdata('id'));
        $data['sidebar'] = 'teacher/teacher_sidebar';
        $data['topnavigation'] = 'teacher/teacher_topnavigation';
        $data['content'] = 'teacher/homeroom_attendance_view';
        $this->load->view($this->template, $data);
    }

    public function homeroomStudent()
    {
        $data['title'] = 'SMS';
        $data['courses'] = $this->Teacher_model->getAllCoursesByTeacher($this->session->userdata('id'));
        $data['sidebar'] = 'teacher/teacher_sidebar';
        $data['topnavigation'] = 'teacher/teacher_topnavigation';
        $data['content'] = 'teacher/homeroom_student_view';
        $this->load->view($this->template, $data);
    }

    public function homeroomReport()
    {
        $data['title'] = 'SMS';
        $data['courses'] = $this->Teacher_model->getAllCoursesByTeacher($this->session->userdata('id'));
        $data['sidebar'] = 'teacher/teacher_sidebar';
        $data['topnavigation'] = 'teacher/teacher_topnavigation';
        $data['content'] = 'teacher/homeroom_report_view';
        $this->load->view($this->template, $data);
    }

    public function teacher_profile($id)
    {
        $data['title'] = 'SMS';
        $data['courses'] = $this->Teacher_model->getAllCoursesByTeacher($this->session->userdata('id'));
        $data['sidebar'] = 'teacher/teacher_sidebar';
        $data['topnavigation'] = 'teacher/teacher_topnavigation';
        $data['content'] = 'teacher/teacher_profile_view';
        $data['info_db'] = $this->Teacher_model->getProfileDataByID($id);
        $this->load->view($this->template, $data);
    }

    public function profile_edit($id)
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
        $teacherid = $this->input->post('teacherid');
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
                $config['file_name'] = $teacherid;
                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('photo')) {

                    $this->session->set_flashdata('error', $this->upload->display_errors());
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
                    if ($this->Teacher_model->editProfilePhoto($teacherid, $filename)) {
                    } else {
                        $this->session->set_flashdata('error', 'Upload Photo Failed, try again !');
                        redirect(current_url());
                    }
                }
            }
            $this->Teacher_model->editProfile($teacherid);
            $this->session->set_flashdata('success', 'Profile saved');
            redirect('teacher/teacher_profile/'.$teacherid);
        }

        $data['title'] = 'SMS';
        $data['courses'] = $this->Teacher_model->getAllCoursesByTeacher($this->session->userdata('id'));
        $data['sidebar'] = 'teacher/teacher_sidebar';
        $data['topnavigation'] = 'teacher/teacher_topnavigation';
        $data['content'] = 'teacher/teacher_profile_edit_view';
        $data['info_db'] = $this->Teacher_model->getProfileDataByID($id);
        $this->load->view($this->template, $data);
    }

    public function addTeacher()
    {
        $this->form_validation->set_rules('password', 'password', 'required');
        $this->form_validation->set_rules('confirmpassword', 'confirm password', 'required|matches[password]');
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

        $this->form_validation->set_error_delimiters('', '<br/>');

        if ($this->form_validation->run() == TRUE) {
            $latestID = $this->Teacher_model->getLatestID();
            $latestID = $latestID['teacherid'];
            $latestID = substr($latestID, 1);
            $teacherID = 't'.str_pad((int) $latestID+1, 4, "0", STR_PAD_LEFT);
            $this->Teacher_model->addTeacher($teacherID);
            if ($_FILES['photo']['error'] != 4) {
                $config['upload_path'] = $this->profilephotopath;
                $config['allowed_types'] = "jpg|jpeg|png";
                $config['max_size'] = 200000;
                $config['overwrite'] = TRUE;
                $config['file_name'] = $teacherID;
                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('photo')) {

                    $this->session->set_flashdata('error', $this->upload->display_errors());
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
                    if ($this->Teacher_model->editProfilePhoto($teacherID, $filename)) {
                        $this->session->set_flashdata('success', 'Photo Changed');
                    } else {
                        $this->session->set_flashdata('error', 'Upload Photo Failed, try again !');
                        redirect(current_url());
                    }
                }
            }
            $this->session->set_flashdata('success', 'New Teacher Added');
            redirect('teacher/teacher_profile/'.$teacherID);
        }

        $data['title'] = 'SMS';
        $data['courses'] = $this->Teacher_model->getAllCoursesByTeacher($this->session->userdata('id'));
        $data['sidebar'] = 'teacher/teacher_sidebar';
        $data['topnavigation'] = 'teacher/teacher_topnavigation';
        $data['content'] = 'teacher/teacher_add_teacher_view';
        $this->load->view($this->template, $data);
    }

    public function addCourse()
    {
        $this->form_validation->set_rules('coursename', 'Course Name', 'required');
        $this->form_validation->set_rules('coursedescription', 'Course Description', 'required');
        $this->form_validation->set_rules('courseresources', 'Course Resources', 'required');

        $this->form_validation->set_error_delimiters('', '<br/>');

        if ($this->form_validation->run() == TRUE) {
            $latestID = $this->Teacher_model->getCourseLatestID();
            $latestID = $latestID['courseid'];
            $latestID = substr($latestID, 1);
            $courseID = 'c'.str_pad((int) $latestID+1, 4, "0", STR_PAD_LEFT);
            $this->Teacher_model->addCourse($courseID);

            $chapters = $this->input->post('chapter');
            $objective = $this->input->post('objective');
            $activities = $this->input->post('activities');
            $material = $this->input->post('material');
            $latestID = $this->Teacher_model->getPlanLatestID();
            $latestID = $latestID['lessonid'];
            for($i=0;$i<sizeof($chapters);$i++)
            {
                if($chapters[$i] != null){
                    $latestID = substr($latestID, 1);
                    $latestID = 'l'.str_pad((int) $latestID+1, 4, "0", STR_PAD_LEFT);
                    $lessoncount = $i+1;
                    $this->Teacher_model->addPlan($latestID, $lessoncount, $chapters[$i], $objective[$i], $activities[$i], $material[$i], $courseID);
                }
            }
           
            $this->session->set_flashdata('success', 'New Course Added');
            redirect('teacher/courseView/'.$courseID);
        }
        
        $data['title'] = 'SMS';
        $data['courses'] = $this->Teacher_model->getAllCoursesByTeacher($this->session->userdata('id'));
        $data['sidebar'] = 'teacher/teacher_sidebar';
        $data['topnavigation'] = 'teacher/teacher_topnavigation';
        $data['content'] = 'teacher/teacher_add_course_view';
        $this->load->view($this->template, $data);
    }

    public function editCourse($id)
    {
        $this->form_validation->set_rules('coursename', 'Course Name', 'required');
        $this->form_validation->set_rules('coursedescription', 'Course Description', 'required');
        $this->form_validation->set_rules('courseresources', 'Course Resources', 'required');
        $courseid = $this->input->post('courseid');

        $this->form_validation->set_error_delimiters('', '<br/>');

        if ($this->form_validation->run() == TRUE) {
            $this->Teacher_model->editCourse($courseid);

            $lessonid = $this->input->post('lessonid');
            $chapters = $this->input->post('chapter');
            $objective = $this->input->post('objective');
            $activities = $this->input->post('activities');
            $material = $this->input->post('material');
            for($i=0;$i<sizeof($lessonid);$i++)
            {
                $this->Teacher_model->editPlan($lessonid[$i], $chapters[$i], $objective[$i], $activities[$i], $material[$i]);
            }

            $this->session->set_flashdata('success', 'Course saved');
            redirect('teacher/courseView/'.$id);
        }

        $data['title'] = 'SMS';
        $data['courses'] = $this->Teacher_model->getAllCoursesByTeacher($this->session->userdata('id'));
        $data['sidebar'] = 'teacher/teacher_sidebar';
        $data['topnavigation'] = 'teacher/teacher_topnavigation';
        $data['content'] = 'teacher/teacher_edit_course_view';
        if(!$info = $this->Teacher_model->getCourseDataByAssignID($id)){
            $info = $this->Teacher_model->getCourseDataByID($id);
        }
        $data['info_db'] = $info;
        $courseid = $info['courseid'];
        $data['plans'] = $this->Teacher_model->getLessonPlan($courseid);
        $this->load->view($this->template, $data);
    }

    public function courseView($id)
    {
        $data['title'] = 'SMS';
        $data['courses'] = $this->Teacher_model->getAllCoursesByTeacher($this->session->userdata('id'));
        $data['sidebar'] = 'teacher/teacher_sidebar';
        $data['topnavigation'] = 'teacher/teacher_topnavigation';
        $data['top2navigation'] = 'teacher/teacher_top2navigation';
        $data['content'] = 'teacher/teacher_course_view';
        if(!$info = $this->Teacher_model->getCourseDataByAssignID($id)){
            $info = $this->Teacher_model->getCourseDataByID($id);
        }
        $data['info_db'] = $info;
        $courseid = $info['courseid'];
        $data['plans'] = $this->Teacher_model->getLessonPlan($courseid);
        $this->load->view($this->template, $data);
    }

//    public function coursePlan(){
//        $data['title'] = 'SMS';
//        $data['courses'] = $this->Teacher_model->getAllCoursesByTeacher($this->session->userdata('id'));
//        $data['sidebar'] = 'teacher/teacher_sidebar';
//        $data['topnavigation'] = 'teacher/teacher_topnavigation';
//        $data['top2navigation'] = 'teacher/teacher_top2navigation';
//        $data['content'] = 'teacher/teacher_course_plan_view';
//        $this->load->view($this->template, $data);
//    }

    public function courseImplementation($id){
        $this->form_validation->set_rules('assignid', 'assignid', 'required');

        $this->form_validation->set_error_delimiters('', '<br/>');

        if ($this->form_validation->run() == TRUE) {
            $implementation = $this->input->post('implementation');
            $latestID = $this->Teacher_model->getImplementationLatestID();
            $latestID = $latestID['implementationid'];
            for($i=0;$i<sizeof($implementation);$i++)
            {
                $latestID = substr($latestID, 1);
                $latestID = 'i'.str_pad((int) $latestID+1, 4, "0", STR_PAD_LEFT);
                $lessoncount = $i+1;
                if($result = $this->Teacher_model->checkImplementation($lessoncount, $id)){
                    $this->Teacher_model->editImplementation($result['implementationid'], $implementation[$i]);
                }
                else{
                    $this->Teacher_model->addImplementation($latestID, $lessoncount, $implementation[$i], $id);
                }
            }

            $this->session->set_flashdata('success', 'Implementation saved');
            redirect('teacher/courseImplementation/'.$id);
        }
        
        $data['title'] = 'SMS';
        $data['courses'] = $this->Teacher_model->getAllCoursesByTeacher($this->session->userdata('id'));
        $data['sidebar'] = 'teacher/teacher_sidebar';
        $data['topnavigation'] = 'teacher/teacher_topnavigation';
        $data['top2navigation'] = 'teacher/teacher_top2navigation';
        $info = $this->Teacher_model->getCourseDataByAssignID($id);
        $data['info_db'] = $info;
        $courseid = $info['courseid'];
        $data['plans'] = $this->Teacher_model->getLessonPlan($courseid);
        $data['implementation'] = $this->Teacher_model->getLessonImplementation($id);
        $data['content'] = 'teacher/teacher_course_implementation_view';
        $this->load->view($this->template, $data);
    }

    public function courseMaterial($id){
        $data['title'] = 'SMS';
        $data['courses'] = $this->Teacher_model->getAllCoursesByTeacher($this->session->userdata('id'));
        $data['sidebar'] = 'teacher/teacher_sidebar';
        $data['topnavigation'] = 'teacher/teacher_topnavigation';
        $data['top2navigation'] = 'teacher/teacher_top2navigation';
        $data['info_db'] = $this->Teacher_model->getCourseDataByAssignID($id);
        $data['materials'] = $this->Teacher_model->getMaterialsByAssignID($id);
        $data['content'] = 'teacher/teacher_course_material_view';
        $this->load->view($this->template, $data);
    }

    public function courseAssignmentQuiz(){
        $data['title'] = 'SMS';
        $data['courses'] = $this->Teacher_model->getAllCoursesByTeacher($this->session->userdata('id'));
        $data['sidebar'] = 'teacher/teacher_sidebar';
        $data['topnavigation'] = 'teacher/teacher_topnavigation';
        $data['top2navigation'] = 'teacher/teacher_top2navigation';
        $data['content'] = 'teacher/teacher_course_qna_view';
        $this->load->view($this->template, $data);
    }

    public function courseAssignmentQuizSubmission(){
        $data['title'] = 'SMS';
        $data['courses'] = $this->Teacher_model->getAllCoursesByTeacher($this->session->userdata('id'));
        $data['sidebar'] = 'teacher/teacher_sidebar';
        $data['topnavigation'] = 'teacher/teacher_topnavigation';
        $data['top2navigation'] = 'teacher/teacher_top2navigation';
        $data['content'] = 'teacher/teacher_course_qna_submission_view';
        $this->load->view($this->template, $data);
    }

    public function courseStudent(){
        $data['title'] = 'SMS';
        $data['courses'] = $this->Teacher_model->getAllCoursesByTeacher($this->session->userdata('id'));
        $data['sidebar'] = 'teacher/teacher_sidebar';
        $data['topnavigation'] = 'teacher/teacher_topnavigation';
        $data['top2navigation'] = 'teacher/teacher_top2navigation';
        $data['content'] = 'teacher/teacher_course_student_view';
        $this->load->view($this->template, $data);
    }

    public function courseStudentPerformance(){
        $data['title'] = 'SMS';
        $data['courses'] = $this->Teacher_model->getAllCoursesByTeacher($this->session->userdata('id'));
        $data['sidebar'] = 'teacher/teacher_sidebar';
        $data['topnavigation'] = 'teacher/teacher_topnavigation';
        $data['top2navigation'] = 'teacher/teacher_top2navigation';
        $data['content'] = 'teacher/teacher_course_student_performance_view';
        $this->load->view($this->template, $data);
    }

    public function classScheduleView()
    {
        $data['title'] = 'SMS';
        $data['courses'] = $this->Teacher_model->getAllCoursesByTeacher($this->session->userdata('id'));
        $data['sidebar'] = 'teacher/teacher_sidebar';
        $data['topnavigation'] = 'teacher/teacher_topnavigation';
        $data['content'] = 'includes/class_schedule_view';
        $this->load->view($this->template, $data);
    }

    public function examScheduleView()
    {
        $data['title'] = 'SMS';
        $data['courses'] = $this->Teacher_model->getAllCoursesByTeacher($this->session->userdata('id'));
        $data['sidebar'] = 'teacher/teacher_sidebar';
        $data['topnavigation'] = 'teacher/teacher_topnavigation';
        $data['content'] = 'includes/exam_schedule_view';
        $this->load->view($this->template, $data);
    }

    public function studentView()
    {
        $data['title'] = 'SMS';
        $data['courses'] = $this->Teacher_model->getAllCoursesByTeacher($this->session->userdata('id'));
        $data['sidebar'] = 'teacher/teacher_sidebar';
        $data['topnavigation'] = 'teacher/teacher_topnavigation';
        $data['content'] = 'includes/students_view';
        $this->load->view($this->template, $data);
    }

    public function parentView()
    {
        $data['title'] = 'SMS';
        $data['courses'] = $this->Teacher_model->getAllCoursesByTeacher($this->session->userdata('id'));
        $data['sidebar'] = 'teacher/teacher_sidebar';
        $data['topnavigation'] = 'teacher/teacher_topnavigation';
        $data['content'] = 'includes/parents_view';
        $this->load->view($this->template, $data);
    }

    public function teacherView()
    {
        $data['title'] = 'SMS';
        $data['courses'] = $this->Teacher_model->getAllCoursesByTeacher($this->session->userdata('id'));
        $data['sidebar'] = 'teacher/teacher_sidebar';
        $data['topnavigation'] = 'teacher/teacher_topnavigation';
        $data['content'] = 'includes/teachers_view';
        $this->load->view($this->template, $data);
    }

    public function operationView()
    {
        $data['title'] = 'SMS';
        $data['courses'] = $this->Teacher_model->getAllCoursesByTeacher($this->session->userdata('id'));
        $data['sidebar'] = 'teacher/teacher_sidebar';
        $data['topnavigation'] = 'teacher/teacher_topnavigation';
        $data['content'] = 'includes/operations_view';
        $this->load->view($this->template, $data);
    }

    public function administratorView()
    {
        $data['title'] = 'SMS';
        $data['courses'] = $this->Teacher_model->getAllCoursesByTeacher($this->session->userdata('id'));
        $data['sidebar'] = 'teacher/teacher_sidebar';
        $data['topnavigation'] = 'teacher/teacher_topnavigation';
        $data['content'] = 'includes/administrators_view';
        $this->load->view($this->template, $data);
    }

    public function libraryView()
    {
        $data['title'] = 'SMS';
        $data['courses'] = $this->Teacher_model->getAllCoursesByTeacher($this->session->userdata('id'));
        $data['sidebar'] = 'teacher/teacher_sidebar';
        $data['topnavigation'] = 'teacher/teacher_topnavigation';
        $data['content'] = 'includes/libraries_view';
        $this->load->view($this->template, $data);
    }

    public function payment()
    {
        $data['title'] = 'SMS';
        $data['courses'] = $this->Teacher_model->getAllCoursesByTeacher($this->session->userdata('id'));
        $data['sidebar'] = 'teacher/teacher_sidebar';
        $data['topnavigation'] = 'teacher/teacher_topnavigation';
        $data['content'] = 'includes/payments_view';
        $this->load->view($this->template, $data);
    }
}