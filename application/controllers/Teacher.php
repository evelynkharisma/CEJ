<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class teacher extends CI_Controller {

    var $template = 'template';
    var $profilephotopath = 'assets/img/teacher/profile/';
    var $materialpath = 'assets/file/teacher/material/';

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
        $info = $this->Teacher_model->getClassByTeacherID($this->session->userdata('id'));
        $classid = $info['classid'];

        $datebutton = $this->input->post('datebutton');
        if($datebutton == 'setdate'){
            $setdate = $this->input->post('datechoosen');
            $data['setdate'] = $setdate;
        }
        else{
            $setdate = date('Y-m-d', now());
            $data['setdate'] = $setdate;
        }

        $savebutton = $this->input->post('savebutton');
        if($savebutton == 'true'){
            $studentids = $this->input->post('studentid');
            $status = $this->input->post('attendance');
            $comments = $this->input->post('comment');
            $latestID = $this->Teacher_model->getAttendanceLatestID();
            $latestID = $latestID['attendanceid'];
            for($i=0;$i<sizeof($studentids);$i++)
            {
                if($result = $this->Teacher_model->checkAttendance($classid, $studentids[$i], $setdate)){
                    $this->Teacher_model->editAttendance($result['attendanceid'], $status[$i], $comments[$i]);
                }
                else{
                    $latestID = substr($latestID, 1);
                    $latestID = 'e'.str_pad((int) $latestID+1, 4, "0", STR_PAD_LEFT);
                    $this->Teacher_model->addAttendance($latestID, $classid, $studentids[$i], $status[$i], $comments[$i]);
                }
            }
        }

        $data['title'] = 'SMS';
        $data['courses'] = $this->Teacher_model->getAllCoursesByTeacher($this->session->userdata('id'));
        $data['sidebar'] = 'teacher/teacher_sidebar';
        $data['topnavigation'] = 'teacher/teacher_topnavigation';
        $data['info_db'] = $info;
        if($attendancedata = $this->Teacher_model->getStudentsAttendanceByClassID($classid, $setdate)){
            $data['students'] = $attendancedata;
        }
        else{
            $data['students'] = $this->Teacher_model->getStudentsAttendanceList($classid);
        }
        $data['content'] = 'teacher/homeroom_attendance_view';
        $this->load->view($this->template, $data);
    }

    public function homeroomStudent()
    {
        $data['title'] = 'SMS';
        $data['courses'] = $this->Teacher_model->getAllCoursesByTeacher($this->session->userdata('id'));
        $data['sidebar'] = 'teacher/teacher_sidebar';
        $data['topnavigation'] = 'teacher/teacher_topnavigation';
        $info = $this->Teacher_model->getClassByTeacherID($this->session->userdata('id'));
        $classid = $info['classid'];
        $data['info_db'] = $info;
        $data['students'] = $this->Teacher_model->getStudentsByClassID($classid);
        $data['content'] = 'teacher/homeroom_student_view';
        $this->load->view($this->template, $data);
    }

    public function homeroomReport($id, $term)
    {
        $this->form_validation->set_rules('op1', 'Consideration', 'required');
        $this->form_validation->set_rules('op2', 'Responsibility', 'required');
        $this->form_validation->set_rules('op3', 'Communication', 'required');
        $this->form_validation->set_rules('op4', 'Punctual', 'required');
        $this->form_validation->set_rules('comment', 'Comment', 'required');
        $this->form_validation->set_error_delimiters('', '<br/>');

        if ($this->form_validation->run() == TRUE) {
            if($result = $this->Teacher_model->checkHomeroomReport($id, $term)){
                $this->Teacher_model->editHomeroomReport($result['homeroomid']);
            }
            else{
                $latestID = $this->Teacher_model->getHomeroomReportLatestID();
                $latestID = $latestID['homeroomid'];
                $latestID = substr($latestID, 1);
                $latestID = 'h'.str_pad((int) $latestID+1, 4, "0", STR_PAD_LEFT);
                $this->Teacher_model->addHomeroomReport($latestID, $id, $term);
            }
            $this->session->set_flashdata('success', 'Homeroom Report saved');
            redirect('teacher/homeroomReport/'.$id.'/'.$term);
        }
        
        $data['title'] = 'SMS';
        $data['courses'] = $this->Teacher_model->getAllCoursesByTeacher($this->session->userdata('id'));
        $data['sidebar'] = 'teacher/teacher_sidebar';
        $data['topnavigation'] = 'teacher/teacher_topnavigation';
        $info = $this->Teacher_model->getClassByStudentID($id);
        $classid = $info['classid'];
        $data['info_db'] = $info;
        $data['reports'] = $this->Teacher_model->getStudentReport($classid, $id, $term);
        $data['coursesList'] = $this->Teacher_model->getStudentCourses($classid);
        $data['term'] = $term;
        $data['homeroomreport'] = $this->Teacher_model->getHomeroomReport($id, $term);
        $data['teacher'] = $this->Teacher_model->getHomeroomTeacher($classid);
        $data['content'] = 'teacher/homeroom_report_view';
        $this->load->view($this->template, $data);
    }

    public function printPreview($id, $term)
    {
        $data['title'] = 'SMS';
        $data['courses'] = $this->Teacher_model->getAllCoursesByTeacher($this->session->userdata('id'));
        $data['sidebar'] = 'teacher/teacher_sidebar';
        $data['topnavigation'] = 'teacher/teacher_topnavigation';
        $info = $this->Teacher_model->getClassByStudentID($id);
        $classid = $info['classid'];
        $data['info_db'] = $info;
        $data['reports'] = $this->Teacher_model->getStudentReport($classid, $id, $term);
        $data['coursesList'] = $this->Teacher_model->getStudentCourses($classid);
        $data['term'] = $term;
        $data['homeroomreport'] = $this->Teacher_model->getHomeroomReport($id, $term);
        $data['teacher'] = $this->Teacher_model->getHomeroomTeacher($classid);
        $data['content'] = 'teacher/homeroom_report_print_preview';
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
                $lessoncount = $i+1;
                if($result = $this->Teacher_model->checkImplementation($lessoncount, $id)){
                    $this->Teacher_model->editImplementation($result['implementationid'], $implementation[$i]);
                }
                else{
                    $latestID = substr($latestID, 1);
                    $latestID = 'i'.str_pad((int) $latestID+1, 4, "0", STR_PAD_LEFT);
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

    public function addMaterial($id){
        $this->form_validation->set_rules('topic', 'topic', 'required');
        $this->form_validation->set_rules('type', 'type', 'required');
        $this->form_validation->set_error_delimiters('', '<br/>');
        if ($this->form_validation->run() == TRUE) {
            if ($this->input->post('existingfile')==null && empty($_FILES['userfile']['name'])){
                $this->session->set_flashdata('error', 'Existing file or New file is required');
                redirect(current_url());
            }
            else{
                $latestID = $this->Teacher_model->getMaterialLatestID();
                $latestID = $latestID['materialid'];
                $latestID = substr($latestID, 1);
                $materialID = 'm'.str_pad((int) $latestID+1, 4, "0", STR_PAD_LEFT);
                if ($_FILES['userfile']['error'] != 4) {
                    $config['upload_path'] = $this->materialpath;
                    $config['allowed_types'] = "doc|pdf|docx";
                    $config['max_size'] = 200000;
                    $config['overwrite'] = TRUE;
                    $this->load->library('upload', $config);

                    if (!$this->upload->do_upload('userfile')) {
                        $this->session->set_flashdata('error', $this->upload->display_errors());
                        redirect(current_url());
                    } else {
                        $data = $this->upload->data();
                        $filename = $data['orig_name'];
                        $latestID = $this->Teacher_model->getFileLatestID();
                        $latestID = $latestID['fileid'];
                        $latestID = substr($latestID, 1);
                        $fileID = 'f'.str_pad((int) $latestID+1, 4, "0", STR_PAD_LEFT);
                        $teacherid = $this->Teacher_model->getTeacherOfAssignID($id);
                        $teacherid = $teacherid['teacherid'];

                        $this->Teacher_model->addFile($fileID, $filename, $teacherid);
                        $newfile = true;
                        $this->session->set_flashdata('success', 'File Uploaded');

                    }
                }
                if(isset($newfile) && $newfile == true){
                    $this->Teacher_model->addMaterial($materialID, $id, $fileID);
                }
                else{
                    $fileID = $this->input->post('existingfile');
                    $this->Teacher_model->addMaterial($materialID, $id, $fileID);
                }
                $this->session->set_flashdata('success', 'New Material Added');
                redirect('teacher/courseMaterial/'.$id);
            }
        }

        $data['title'] = 'SMS';
        $data['courses'] = $this->Teacher_model->getAllCoursesByTeacher($this->session->userdata('id'));
        $data['sidebar'] = 'teacher/teacher_sidebar';
        $data['topnavigation'] = 'teacher/teacher_topnavigation';
        $data['top2navigation'] = 'teacher/teacher_top2navigation';
        $info = $this->Teacher_model->getCourseDataByAssignID($id);
        $data['info_db'] = $info;
        $courseid = $info['courseid'];
        $data['lessons'] = $this->Teacher_model->getLessonPlan($courseid);
        $data['files'] = $this->Teacher_model->getFilesByAssignID($id);
        $data['content'] = 'teacher/teacher_course_material_add_view';
        $this->load->view($this->template, $data);
    }

    public function courseAssignmentQuiz($id){
        $data['title'] = 'SMS';
        $data['courses'] = $this->Teacher_model->getAllCoursesByTeacher($this->session->userdata('id'));
        $data['sidebar'] = 'teacher/teacher_sidebar';
        $data['topnavigation'] = 'teacher/teacher_topnavigation';
        $data['top2navigation'] = 'teacher/teacher_top2navigation';
        $data['info_db'] = $this->Teacher_model->getCourseDataByAssignID($id);
        $data['qnas'] = $this->Teacher_model->getQnAByAssignID($id);
        $data['content'] = 'teacher/teacher_course_qna_view';
        $this->load->view($this->template, $data);
    }

    public function addQnA($id){
        $this->form_validation->set_rules('topic', 'topic', 'required');
        $this->form_validation->set_rules('type', 'type', 'required');
        $this->form_validation->set_rules('duedate', 'due date', 'required');
        $this->form_validation->set_error_delimiters('', '<br/>');
        if ($this->form_validation->run() == TRUE) {
            if ($this->input->post('existingfile')==null && empty($_FILES['userfile']['name'])){
                $this->session->set_flashdata('error', 'Existing file or New file is required');
                redirect(current_url());
            }
            else{
                $latestID = $this->Teacher_model->getQnALatestID();
                $latestID = $latestID['anqid'];
                $latestID = substr($latestID, 1);
                $materialID = 'a'.str_pad((int) $latestID+1, 4, "0", STR_PAD_LEFT);
                if ($_FILES['userfile']['error'] != 4) {
                    $config['upload_path'] = $this->materialpath;
                    $config['allowed_types'] = "doc|pdf|docx";
                    $config['max_size'] = 200000;
                    $config['overwrite'] = TRUE;
                    $this->load->library('upload', $config);

                    if (!$this->upload->do_upload('userfile')) {
                        $this->session->set_flashdata('error', $this->upload->display_errors());
                        redirect(current_url());
                    } else {
                        $data = $this->upload->data();
                        $filename = $data['orig_name'];
                        $latestID = $this->Teacher_model->getFileLatestID();
                        $latestID = $latestID['fileid'];
                        $latestID = substr($latestID, 1);
                        $fileID = 'f'.str_pad((int) $latestID+1, 4, "0", STR_PAD_LEFT);
                        $teacherid = $this->Teacher_model->getTeacherOfAssignID($id);
                        $teacherid = $teacherid['teacherid'];

                        $this->Teacher_model->addFile($fileID, $filename, $teacherid);
                        $newfile = true;
                        $this->session->set_flashdata('success', 'File Uploaded');

                    }
                }
                if(isset($newfile) && $newfile == true){
                    $this->Teacher_model->addQnA($materialID, $id, $fileID);
                }
                else{
                    $fileID = $this->input->post('existingfile');
                    $this->Teacher_model->addQnA($materialID, $id, $fileID);
                }
                $this->session->set_flashdata('success', 'New Material Added');
                redirect('teacher/courseAssignmentQuiz/'.$id);
            }
        }

        $data['title'] = 'SMS';
        $data['courses'] = $this->Teacher_model->getAllCoursesByTeacher($this->session->userdata('id'));
        $data['sidebar'] = 'teacher/teacher_sidebar';
        $data['topnavigation'] = 'teacher/teacher_topnavigation';
        $data['top2navigation'] = 'teacher/teacher_top2navigation';
        $info = $this->Teacher_model->getCourseDataByAssignID($id);
        $data['info_db'] = $info;
        $courseid = $info['courseid'];
        $data['lessons'] = $this->Teacher_model->getLessonPlan($courseid);
        $data['files'] = $this->Teacher_model->getFilesByAssignID($id);
        $data['content'] = 'teacher/teacher_course_qna_add_view';
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

    public function courseStudent($id){
        $data['title'] = 'SMS';
        $data['courses'] = $this->Teacher_model->getAllCoursesByTeacher($this->session->userdata('id'));
        $data['sidebar'] = 'teacher/teacher_sidebar';
        $data['topnavigation'] = 'teacher/teacher_topnavigation';
        $data['top2navigation'] = 'teacher/teacher_top2navigation';
        $info = $this->Teacher_model->getCourseDataByAssignID($id);
        $data['info_db'] = $info;
        $classid = $info['classid'];
        $data['students'] = $this->Teacher_model->getStudentsByClassID($classid);
        $data['content'] = 'teacher/teacher_course_student_view';
        $this->load->view($this->template, $data);
    }

    public function courseStudentPerformance($assignid, $studentid){
        $savebutton = $this->input->post('savebutton');
        if($savebutton == 'midreport'){
            $this->form_validation->set_rules('op1', 'Mid Term Is self-motivated', 'required');
            $this->form_validation->set_rules('op2', 'Mid Term Shows initiatives and asks questions', 'required');
            $this->form_validation->set_rules('op3', 'Mid Term Persists despite difficulties', 'required');
            $this->form_validation->set_rules('op4', 'Mid Term Is well-organised and punctual', 'required');
            $this->form_validation->set_rules('op5', 'Mid Term Completes classroom tasks', 'required');
            $this->form_validation->set_rules('op6', 'Mid Term Completes homework on time', 'required');
            $this->form_validation->set_rules('comment', 'Mid Term Comment', 'required');
            $this->form_validation->set_error_delimiters('', '<br/>');

            if ($this->form_validation->run() == TRUE) {
                if($result = $this->Teacher_model->checkReport($assignid, $studentid, 1)){
                    $this->Teacher_model->editMidReport($result['reportid']);
                }
                else{
                    $latestID = $this->Teacher_model->getReportLatestID();
                    $latestID = $latestID['reportid'];
                    $latestID = substr($latestID, 1);
                    $latestID = 'r'.str_pad((int) $latestID+1, 4, "0", STR_PAD_LEFT);
                    $this->Teacher_model->addMidReport($latestID, $assignid, $studentid);
                }
                $this->session->set_flashdata('success', 'Report saved');
            }
            redirect('teacher/courseStudentPerformance/'.$assignid.'/'.$studentid);
        }
        else if($savebutton == 'finalreport'){
            $this->form_validation->set_rules('opf1', 'Final Term Is self-motivated', 'required');
            $this->form_validation->set_rules('opf2', 'Final Term Shows initiatives and asks questions', 'required');
            $this->form_validation->set_rules('opf3', 'Final Term Persists despite difficulties', 'required');
            $this->form_validation->set_rules('opf4', 'Final Term Is well-organised and punctual', 'required');
            $this->form_validation->set_rules('opf5', 'Final Term Completes classroom tasks', 'required');
            $this->form_validation->set_rules('opf6', 'Final Term Completes homework on time', 'required');
            $this->form_validation->set_rules('fcomment', 'Final Term Comment', 'required');
            $this->form_validation->set_error_delimiters('', '<br/>');

            if ($this->form_validation->run() == TRUE) {
                if($result = $this->Teacher_model->checkReport($assignid, $studentid, 2)){
                    $this->Teacher_model->editFinalReport($result['reportid']);
                }
                else{
                    $latestID = $this->Teacher_model->getReportLatestID();
                    $latestID = $latestID['reportid'];
                    $latestID = substr($latestID, 1);
                    $latestID = 'r'.str_pad((int) $latestID+1, 4, "0", STR_PAD_LEFT);
                    $this->Teacher_model->addFinalReport($latestID, $assignid, $studentid);
                }
                $this->session->set_flashdata('success', 'Report saved');
            }
            redirect('teacher/courseStudentPerformance/'.$assignid.'/'.$studentid);
        }
        
        $data['title'] = 'SMS';
        $data['courses'] = $this->Teacher_model->getAllCoursesByTeacher($this->session->userdata('id'));
        $data['sidebar'] = 'teacher/teacher_sidebar';
        $data['topnavigation'] = 'teacher/teacher_topnavigation';
        $data['top2navigation'] = 'teacher/teacher_top2navigation';
        $data['info_db'] = $this->Teacher_model->getCourseDataByAssignID($assignid);
        $data['student'] = $this->Teacher_model->getStudentDataByStudentID($studentid);
        $data['report'] = $this->Teacher_model->getReportDataBy($assignid, $studentid);
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
        $data['teachers'] =  $this->Teacher_model->getAllTeacher();
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

    public function sendEmail()
    {
        $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_port' => 465,
            'smtp_user' => 'healthybonefamily@gmail.com',
            'smtp_pass' => 'healthybonefamilycb4',
        );
        
          $this->load->library('email', $config);
          $this->email->set_newline('\r\n');
          $this->email->from('healthybonefamily@gmail.com', 'your Name');
          $this->email->to('kharismaeve@yahoo.com');
          $this->email->subject(' Your Subject here..');
          $this->email->message('Your Message here..');

        if($this->email->send())
            $this->session->set_flashdata("success","Email sent successfully.");
        else
            $this->session->set_flashdata("error",$this->email->print_debugger());
        redirect('teacher/courseAssignmentQuiz/s0001');

        return TRUE;

    }
}