<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class teacher extends CI_Controller {

    var $template = 'template';
    var $print_template = 'print_template';
    var $profilephotopath = 'assets/img/teacher/profile/';
    var $materialpath = 'assets/file/teacher/material/';
    var $formpath = 'assets/file/forms/';

    function __construct() {
        parent::__construct();
        $this->general->TeacherLogin();
        $this->load->model('Teacher_model');
    }

    public function home()
    {
        $data['title'] = 'SMS';
        $data['courses'] = $this->Teacher_model->getAllCoursesByTeacher($this->session->userdata('id'));
        $data['eventnotif'] = $this->Teacher_model->getAllEventsCount($this->session->userdata('id'),$this->session->userdata('lastlogin'));
        $data['sidebar'] = 'teacher/teacher_sidebar';
        $data['topnavigation'] = 'teacher/teacher_topnavigation';
        $data['events'] = $this->Teacher_model->getAllEvents($this->session->userdata('id'));
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
        $data['eventnotif'] = $this->Teacher_model->getAllEventsCount($this->session->userdata('id'),$this->session->userdata('lastlogin'));
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
        $data['eventnotif'] = $this->Teacher_model->getAllEventsCount($this->session->userdata('id'),$this->session->userdata('lastlogin'));
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
        $id = $this->general->decryptParaID($id, 'student');
        $this->form_validation->set_rules('op1', 'Consideration', 'required');
        $this->form_validation->set_rules('op2', 'Responsibility', 'required');
        $this->form_validation->set_rules('op3', 'Communication', 'required');
        $this->form_validation->set_rules('op4', 'Punctual', 'required');
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

        $allattendance = $this->Teacher_model->getTotalAttendance($id);
        $present = $this->Teacher_model->getTotalPresentByStudent($id);
        $attendancepercentage = $present/$allattendance*100;
        
        $data['title'] = 'SMS';
        $data['courses'] = $this->Teacher_model->getAllCoursesByTeacher($this->session->userdata('id'));
        $data['eventnotif'] = $this->Teacher_model->getAllEventsCount($this->session->userdata('id'),$this->session->userdata('lastlogin'));
        $data['sidebar'] = 'teacher/teacher_sidebar';
        $data['topnavigation'] = 'teacher/teacher_topnavigation';
        $info = $this->Teacher_model->getClassByStudentID($id);
        $classid = $info['classid'];
        $data['attendance'] = $attendancepercentage;
        $data['info_db'] = $info;
        $data['reports'] = $this->Teacher_model->getStudentReport($classid, $id, $term);
        $data['coursesList'] = $this->Teacher_model->getStudentCourses($classid);
        $data['term'] = $term;
        $data['homeroomreport'] = $this->Teacher_model->getHomeroomReport($id, $term);
        $data['teacher'] = $this->Teacher_model->getHomeroomTeacher($classid);
        $data['content'] = 'teacher/homeroom_report_view';
        $this->load->view($this->template, $data);
    }

    public function homeroomReport2($id, $term)
    {
        $id = $this->general->decryptParaID($id, 'student');
        $this->form_validation->set_rules('comment', 'Comment', 'required');
        $this->form_validation->set_error_delimiters('', '<br/>');

        if ($this->form_validation->run() == TRUE) {
            if($result = $this->Teacher_model->checkHomeroomReport($id, $term)){
                $this->Teacher_model->editHomeroomReport2($result['homeroomid']);
            }
            $this->session->set_flashdata('success', 'Homeroom Report saved');
            redirect('teacher/homeroomReport2/'.$id.'/'.$term);
        }

        $allattendance = $this->Teacher_model->getTotalAttendance($id);
        $present = $this->Teacher_model->getTotalPresentByStudent($id);
        $attendancepercentage = $present/$allattendance*100;

        $data['title'] = 'SMS';
        $data['courses'] = $this->Teacher_model->getAllCoursesByTeacher($this->session->userdata('id'));
        $data['eventnotif'] = $this->Teacher_model->getAllEventsCount($this->session->userdata('id'),$this->session->userdata('lastlogin'));
        $data['sidebar'] = 'teacher/teacher_sidebar';
        $data['topnavigation'] = 'teacher/teacher_topnavigation';
        $info = $this->Teacher_model->getClassByStudentID($id);
        $classid = $info['classid'];
        $data['attendance'] = $attendancepercentage;
        $data['info_db'] = $info;
        $data['reports'] = $this->Teacher_model->getStudentReport($classid, $id, $term);
        $data['coursesList'] = $this->Teacher_model->getStudentCourses($classid);
        $data['term'] = $term;
        $data['homeroomreport'] = $this->Teacher_model->getHomeroomReport($id, $term);
        $data['teacher'] = $this->Teacher_model->getHomeroomTeacher($classid);
        $data['content'] = 'teacher/homeroom_report2_view';
        $this->load->view($this->template, $data);
    }

    public function printPreview13($id, $term)
    {
        $id = $this->general->decryptParaID($id, 'student');
        $allattendance = $this->Teacher_model->getTotalAttendance($id);
        $present = $this->Teacher_model->getTotalPresentByStudent($id);
        $attendancepercentage = $present/$allattendance*100;
        
        if($term == 1){
            $sid = 's0001';
        }
        else{
            $sid = 's0003';
        }

        $data['title'] = 'SMS';
        $info = $this->Teacher_model->getClassByStudentID($id);
        $classid = $info['classid'];
        $data['info_db'] = $info;
        $data['reports'] = $this->Teacher_model->getStudentReport($classid, $id, $term);
        $data['coursesList'] = $this->Teacher_model->getStudentCourses($classid);
        $data['term'] = $term;
        $data['attendance'] = $attendancepercentage;
        $data['homeroomreport'] = $this->Teacher_model->getHomeroomReport($id, $term);
        $data['setting'] = $this->Teacher_model->getSetting($sid);
        $data['teacher'] = $this->Teacher_model->getHomeroomTeacher($classid);
        $data['content'] = 'teacher/homeroom_report_print_preview';
        $this->load->view($this->print_template, $data);
    }

    public function printPreview24($id, $term)
    {
        $id = $this->general->decryptParaID($id, 'student');
        $allattendance = $this->Teacher_model->getTotalAttendance($id);
        $present = $this->Teacher_model->getTotalPresentByStudent($id);
        $attendancepercentage = $present/$allattendance*100;

        if($term == 1){
            $sid = 's0002';
        }
        else{
            $sid = 's0004';
        }

        $data['title'] = 'SMS';
        $info = $this->Teacher_model->getClassByStudentID($id);
        $classid = $info['classid'];
        $data['info_db'] = $info;
        $data['reports'] = $this->Teacher_model->getStudentReport($classid, $id, $term);
        $data['coursesList'] = $this->Teacher_model->getStudentCourses($classid);
        $data['term'] = $term;
        $data['attendance'] = $attendancepercentage;
        $data['homeroomreport'] = $this->Teacher_model->getHomeroomReport($id, $term);
        $data['teacher'] = $this->Teacher_model->getHomeroomTeacher($classid);
        $data['principal'] = $this->Teacher_model->getPrincipal();
        $data['setting'] = $this->Teacher_model->getSetting($sid);
        $data['content'] = 'teacher/homeroom_report2_print_view';
        $this->load->view($this->print_template, $data);
    }

    public function teacher_profile($id)
    {
        $id = $this->general->decryptParaID($id, 'teacher');
        $data['de'] = $id;
        $data['title'] = 'SMS';
        $data['courses'] = $this->Teacher_model->getAllCoursesByTeacher($this->session->userdata('id'));
        $data['eventnotif'] = $this->Teacher_model->getAllEventsCount($this->session->userdata('id'),$this->session->userdata('lastlogin'));
        $data['sidebar'] = 'teacher/teacher_sidebar';
        $data['topnavigation'] = 'teacher/teacher_topnavigation';
        $data['day'] = $this->Teacher_model->getSetting('s0005');
        $data['period'] = $this->Teacher_model->getSetting('s0006');
        $data['hour'] = $this->Teacher_model->getSetting('s0007');
        $data['starttime'] = $this->Teacher_model->getSetting('s0008');
        $data['breakstarttime'] = $this->Teacher_model->getSetting('s0009');
        $data['breaktime'] = $this->Teacher_model->getSetting('s0011');
        $data['lunchstarttime'] = $this->Teacher_model->getSetting('s0010');
        $data['lunchtime'] = $this->Teacher_model->getSetting('s0012');
        $data['content'] = 'teacher/teacher_profile_view';
        $data['info_db'] = $this->Teacher_model->getProfileDataByID($id);
        $this->load->view($this->template, $data);
    }

    public function profile_edit($id)
    {
        $id = $this->general->decryptParaID($id, 'teacher');
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

            $availabletime = '';
            $workinghour = $this->input->post('workinghour');
            for($i=0;$i<sizeof($workinghour);$i++)
            {
                $availabletime = $availabletime.'|'.$workinghour[$i];
            }
            $this->Teacher_model->editProfile($teacherid, $availabletime);
            $this->session->set_flashdata('success', 'Profile saved');
            $eid = $this->general->encryptParaID($id, 'teacher');
            redirect('teacher/teacher_profile/'.$eid);
        }

        $data['title'] = 'SMS';
        $data['courses'] = $this->Teacher_model->getAllCoursesByTeacher($this->session->userdata('id'));
        $data['eventnotif'] = $this->Teacher_model->getAllEventsCount($this->session->userdata('id'),$this->session->userdata('lastlogin'));
        $data['sidebar'] = 'teacher/teacher_sidebar';
        $data['topnavigation'] = 'teacher/teacher_topnavigation';
        $data['day'] = $this->Teacher_model->getSetting('s0005');
        $data['period'] = $this->Teacher_model->getSetting('s0006');
        $data['hour'] = $this->Teacher_model->getSetting('s0007');
        $data['starttime'] = $this->Teacher_model->getSetting('s0008');
        $data['breakstarttime'] = $this->Teacher_model->getSetting('s0009');
        $data['breaktime'] = $this->Teacher_model->getSetting('s0011');
        $data['lunchstarttime'] = $this->Teacher_model->getSetting('s0010');
        $data['lunchtime'] = $this->Teacher_model->getSetting('s0012');
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
            $availabletime = '';
            $workinghour = $this->input->post('workinghour');
            for($i=0;$i<sizeof($workinghour);$i++)
            {
                $availabletime = $availabletime.'|'.$workinghour[$i];
            }

            $latestID = $this->Teacher_model->getLatestID();
            $latestID = $latestID['teacherid'];
            $latestID = substr($latestID, 1);
            $teacherID = 't'.str_pad((int) $latestID+1, 4, "0", STR_PAD_LEFT);
            $this->Teacher_model->addTeacher($teacherID, $availabletime);
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
        $data['eventnotif'] = $this->Teacher_model->getAllEventsCount($this->session->userdata('id'),$this->session->userdata('lastlogin'));
        $data['sidebar'] = 'teacher/teacher_sidebar';
        $data['topnavigation'] = 'teacher/teacher_topnavigation';
        $data['day'] = $this->Teacher_model->getSetting('s0005');
        $data['period'] = $this->Teacher_model->getSetting('s0006');
        $data['hour'] = $this->Teacher_model->getSetting('s0007');
        $data['starttime'] = $this->Teacher_model->getSetting('s0008');
        $data['breakstarttime'] = $this->Teacher_model->getSetting('s0009');
        $data['breaktime'] = $this->Teacher_model->getSetting('s0011');
        $data['lunchstarttime'] = $this->Teacher_model->getSetting('s0010');
        $data['lunchtime'] = $this->Teacher_model->getSetting('s0012');
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
        $data['eventnotif'] = $this->Teacher_model->getAllEventsCount($this->session->userdata('id'),$this->session->userdata('lastlogin'));
        $data['sidebar'] = 'teacher/teacher_sidebar';
        $data['topnavigation'] = 'teacher/teacher_topnavigation';
        $data['content'] = 'teacher/teacher_add_course_view';
        $this->load->view($this->template, $data);
    }

    public function editCourse($fid)
    {
        if(substr($fid, 0 ,1) == 's'){
            $id = $this->general->decryptParaID(substr($fid, 1), 'courseassigned');
        }
        else{
            $id = $this->general->decryptParaID(substr($fid, 1), 'course');
        }

        $this->form_validation->set_rules('coursename', 'Course Name', 'required');
        $this->form_validation->set_rules('coursedescription', 'Course Description', 'required');
        $this->form_validation->set_rules('courseresources', 'Course Resources', 'required');
        $courseid = $this->input->post('courseid');

        $this->form_validation->set_error_delimiters('', '<br/>');

        if ($this->form_validation->run() == TRUE) {
            $this->Teacher_model->editCourse($courseid);

            $lessonid = $this->input->post('lessonido');
            $chapters = $this->input->post('chaptero');
            $objective = $this->input->post('objectiveo');
            $activities = $this->input->post('activitieso');
            $material = $this->input->post('materialo');
            for($i=0;$i<sizeof($lessonid);$i++)
            {
                $lessoncount = $i+1;
                $this->Teacher_model->editPlan($lessonid[$i], $chapters[$i], $objective[$i], $activities[$i], $material[$i]);
            }
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
                    $lessoncount = $lessoncount+1;
                    $this->Teacher_model->addPlan($latestID, $lessoncount, $chapters[$i], $objective[$i], $activities[$i], $material[$i], $courseid);
                }
            }

            $this->session->set_flashdata('success', 'Course saved');
            if(substr($fid, 0 ,1) == 's'){
                $id = $this->general->encryptParaID($id, 'courseassigned');
                redirect('teacher/courseView/'.$id);
            }
            else{
                $id = $this->general->encryptParaID($id, 'course');
                redirect('teacher/allCourse');
            }

        }

        $data['title'] = 'SMS';
        $data['courses'] = $this->Teacher_model->getAllCoursesByTeacher($this->session->userdata('id'));
        $data['eventnotif'] = $this->Teacher_model->getAllEventsCount($this->session->userdata('id'),$this->session->userdata('lastlogin'));
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

    public function allCourse()
    {
        $data['title'] = 'SMS';
        $data['courses'] = $this->Teacher_model->getAllCoursesByTeacher($this->session->userdata('id'));
        $data['eventnotif'] = $this->Teacher_model->getAllEventsCount($this->session->userdata('id'),$this->session->userdata('lastlogin'));
        $data['sidebar'] = 'teacher/teacher_sidebar';
        $data['topnavigation'] = 'teacher/teacher_topnavigation';
        $data['info_dbs'] = $this->Teacher_model->getAllCourses();
        $data['content'] = 'teacher/teacher_courses_list_view';
        $this->load->view($this->template, $data);
    }

    public function deleteCourse($id){
        $id = $this->general->decryptParaID($id, 'course');
        if($this->Teacher_model->deleteCourse($id)){
            $this->session->set_flashdata('success', 'Course Deleted');
        }
        else{
            $this->session->set_flashdata('error', 'Failed to Delete Course');
        }
        redirect('teacher/allCourse');
    }

    public function courseView($id)
    {
        $id = $this->general->decryptParaID($id, 'courseassigned');
        $data['title'] = 'SMS';
        $data['courses'] = $this->Teacher_model->getAllCoursesByTeacher($this->session->userdata('id'));
        $data['eventnotif'] = $this->Teacher_model->getAllEventsCount($this->session->userdata('id'),$this->session->userdata('lastlogin'));
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

    public function courseSemester($id)
    {
        $id = $this->general->decryptParaID($id, 'courseassigned');
        $data['title'] = 'SMS';
        $data['courses'] = $this->Teacher_model->getAllCoursesByTeacher($this->session->userdata('id'));
        $data['eventnotif'] = $this->Teacher_model->getAllEventsCount($this->session->userdata('id'),$this->session->userdata('lastlogin'));
        $data['sidebar'] = 'teacher/teacher_sidebar';
        $data['topnavigation'] = 'teacher/teacher_topnavigation';
        $data['top2navigation'] = 'teacher/teacher_top2navigation';
        $data['content'] = 'teacher/teacher_course_semester_view';
        if(!$info = $this->Teacher_model->getCourseDataByAssignID($id)){
            $info = $this->Teacher_model->getCourseDataByID($id);
        }
        $data['info_db'] = $info;
        $courseid = $info['courseid'];
        $data['plans'] = $this->Teacher_model->getSemesterPlan($courseid);
        $this->load->view($this->template, $data);
    }

    public function printPreviewSemester($id)
    {
        $id = $this->general->decryptParaID($id, 'courseassigned');
        $data['title'] = 'SMS';
        $data['content'] = 'teacher/teacher_course_semester_print_view';
        if(!$info = $this->Teacher_model->getCourseDataByAssignID($id)){
            $info = $this->Teacher_model->getCourseDataByID($id);
        }
        $data['info_db'] = $info;
        $courseid = $info['courseid'];
        $data['plans'] = $this->Teacher_model->getSemesterPlan($courseid);
        $this->load->view($this->print_template, $data);
    }

    public function editSemester($id)
    {
        $id = $this->general->decryptParaID($id, 'courseassigned');
        $this->form_validation->set_rules('courseid', 'Course ID', 'required');
        $courseid = $this->input->post('courseid');

        $this->form_validation->set_error_delimiters('', '<br/>');

        if ($this->form_validation->run() == TRUE) {
            $semesterid = $this->input->post('semesterido');
            $weeks = $this->input->post('weeko');
            $topics = $this->input->post('topico');
            $outcomes = $this->input->post('outcomeo');
            $assessments = $this->input->post('assessmento');
            $resources = $this->input->post('resourceo');
            for($i=0;$i<sizeof($semesterid);$i++)
            {
                $this->Teacher_model->editSemester($semesterid[$i], $weeks[$i], $topics[$i], $outcomes[$i], $assessments[$i], $resources[$i]);
            }
            $weeks = $this->input->post('week');
            $topics = $this->input->post('topic');
            $outcomes = $this->input->post('outcome');
            $assessments = $this->input->post('assessment');
            $resources = $this->input->post('resource');
            $latestID = $this->Teacher_model->getSemesterLatestID();
            $latestID = $latestID['semesterid'];
            for($i=0;$i<sizeof($weeks);$i++)
            {
                if($weeks[$i] != null){
                    $latestID = substr($latestID, 1);
                    $latestID = 's'.str_pad((int) $latestID+1, 4, "0", STR_PAD_LEFT);
                    $this->Teacher_model->addSemester($latestID, $weeks[$i], $topics[$i], $outcomes[$i], $assessments[$i],$resources[$i], $courseid);
                }
            }

            $this->session->set_flashdata('success', 'Course saved');
            $encryptid = $this->general->encryptParaID($id, 'courseassigned');
            redirect('teacher/courseSemester/'.$encryptid);
        }

        $data['title'] = 'SMS';
        $data['courses'] = $this->Teacher_model->getAllCoursesByTeacher($this->session->userdata('id'));
        $data['eventnotif'] = $this->Teacher_model->getAllEventsCount($this->session->userdata('id'),$this->session->userdata('lastlogin'));
        $data['sidebar'] = 'teacher/teacher_sidebar';
        $data['topnavigation'] = 'teacher/teacher_topnavigation';
        $data['content'] = 'teacher/teacher_edit_semester_view';
        if(!$info = $this->Teacher_model->getCourseDataByAssignID($id)){
            $info = $this->Teacher_model->getCourseDataByID($id);
        }
        $data['info_db'] = $info;
        $courseid = $info['courseid'];
        $data['plans'] = $this->Teacher_model->getSemesterPlan($courseid);
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
        $id = $this->general->decryptParaID($id, 'courseassigned');

        $this->form_validation->set_rules('assignid', 'assignid', 'required');

        $this->form_validation->set_error_delimiters('', '<br/>');

        if ($this->form_validation->run() == TRUE) {
            $chapters = $this->input->post('chapter');
            $objective = $this->input->post('objective');
            $activities = $this->input->post('activities');
            $material = $this->input->post('material');
            $latestID = $this->Teacher_model->getImplementationLatestID();
            $latestID = $latestID['implementationid'];
            for($i=0;$i<sizeof($chapters);$i++)
            {
                $lessoncount = $i+1;
                if($result = $this->Teacher_model->checkImplementation($lessoncount, $id)){
                    $this->Teacher_model->editImplementation($result['implementationid'], $chapters[$i], $objective[$i], $activities[$i], $material[$i]);
                }
                else{
                    $latestID = substr($latestID, 1);
                    $latestID = 'i'.str_pad((int) $latestID+1, 4, "0", STR_PAD_LEFT);
                    $this->Teacher_model->addImplementation($latestID, $lessoncount, $chapters[$i], $objective[$i], $activities[$i], $material[$i], $id);
                }
            }

            $this->session->set_flashdata('success', 'Implementation saved');
            $encryptid = $this->general->encryptParaID($id, 'courseassigned');
            redirect('teacher/courseImplementation/'.$encryptid);
        }
        
        $data['title'] = 'SMS';
        $data['courses'] = $this->Teacher_model->getAllCoursesByTeacher($this->session->userdata('id'));
        $data['eventnotif'] = $this->Teacher_model->getAllEventsCount($this->session->userdata('id'),$this->session->userdata('lastlogin'));
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

    public function printPreviewImplementation($id){
        $id = $this->general->decryptParaID($id, 'courseassigned');
        $data['title'] = 'SMS';
        $info = $this->Teacher_model->getCourseDataByAssignID($id);
        $data['info_db'] = $info;
        $data['plans'] = $this->Teacher_model->getLessonImplementation($id);
        $data['content'] = 'teacher/teacher_course_implementation_print_view';
        $this->load->view($this->print_template, $data);
    }

    public function courseMaterial($id){
        $id = $this->general->decryptParaID($id, 'courseassigned');
        $data['title'] = 'SMS';
        $data['courses'] = $this->Teacher_model->getAllCoursesByTeacher($this->session->userdata('id'));
        $data['eventnotif'] = $this->Teacher_model->getAllEventsCount($this->session->userdata('id'),$this->session->userdata('lastlogin'));
        $data['sidebar'] = 'teacher/teacher_sidebar';
        $data['topnavigation'] = 'teacher/teacher_topnavigation';
        $data['top2navigation'] = 'teacher/teacher_top2navigation';
        $data['info_db'] = $this->Teacher_model->getCourseDataByAssignID($id);
        $data['materials'] = $this->Teacher_model->getMaterialsByAssignID($id);
        $data['content'] = 'teacher/teacher_course_material_view';
        $this->load->view($this->template, $data);
    }

    public function addMaterial($id){
        $id = $this->general->decryptParaID($id, 'courseassigned');
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
                $eid = $this->general->encryptParaID($id, 'courseassigned');
                redirect('teacher/courseMaterial/'.$eid);
            }
        }

        $data['title'] = 'SMS';
        $data['courses'] = $this->Teacher_model->getAllCoursesByTeacher($this->session->userdata('id'));
        $data['eventnotif'] = $this->Teacher_model->getAllEventsCount($this->session->userdata('id'),$this->session->userdata('lastlogin'));
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
        $id = $this->general->decryptParaID($id, 'courseassigned');
        $data['title'] = 'SMS';
        $data['courses'] = $this->Teacher_model->getAllCoursesByTeacher($this->session->userdata('id'));
        $data['eventnotif'] = $this->Teacher_model->getAllEventsCount($this->session->userdata('id'),$this->session->userdata('lastlogin'));
        $data['sidebar'] = 'teacher/teacher_sidebar';
        $data['topnavigation'] = 'teacher/teacher_topnavigation';
        $data['top2navigation'] = 'teacher/teacher_top2navigation';
        $data['info_db'] = $this->Teacher_model->getCourseDataByAssignID($id);
        $data['qnas'] = $this->Teacher_model->getQnAByAssignID($id);
        $data['content'] = 'teacher/teacher_course_qna_view';
        $this->load->view($this->template, $data);
    }

    public function addQnA($id){
        $id = $this->general->decryptParaID($id, 'courseassigned');
        $this->form_validation->set_rules('topic', 'topic', 'required');
        $this->form_validation->set_rules('type', 'type', 'required');
        $this->form_validation->set_rules('duedate', 'due date', 'required');
        $this->form_validation->set_error_delimiters('', '<br/>');

        if ($this->form_validation->run() == TRUE) {
            $teacherid = $this->Teacher_model->getTeacherOfAssignID($id);
            $teacherid = $teacherid['teacherid'];

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
                $latestID = $this->Teacher_model->getEventLatestID();
                $latestID = $latestID['eventid'];
                $latestID = substr($latestID, 1);
                $latestID = 'v'.str_pad((int) $latestID+1, 4, "0", STR_PAD_LEFT);
                $teacherid = $this->Teacher_model->getTeacherOfAssignID($id);
                $teacherid = $teacherid['teacherid'];
                $this->Teacher_model->addQnAEvent($latestID, $teacherid);

                $this->session->set_flashdata('success', 'New Material Added');
                $eid = $this->general->encryptParaID($id, 'courseassigned');
                redirect('teacher/courseAssignmentQuiz/'.$eid);
            }
        }

        $data['title'] = 'SMS';
        $data['courses'] = $this->Teacher_model->getAllCoursesByTeacher($this->session->userdata('id'));
        $data['eventnotif'] = $this->Teacher_model->getAllEventsCount($this->session->userdata('id'),$this->session->userdata('lastlogin'));
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

    public function courseAssignmentQuizSubmission($id, $qid){
        $id = $this->general->decryptParaID($id, 'courseassigned');
        $qid = $this->general->decryptParaID($qid, 'anq');

        $data['title'] = 'SMS';
        $data['courses'] = $this->Teacher_model->getAllCoursesByTeacher($this->session->userdata('id'));
        $data['eventnotif'] = $this->Teacher_model->getAllEventsCount($this->session->userdata('id'),$this->session->userdata('lastlogin'));
        $data['sidebar'] = 'teacher/teacher_sidebar';
        $data['topnavigation'] = 'teacher/teacher_topnavigation';
        $data['top2navigation'] = 'teacher/teacher_top2navigation';
        $info = $this->Teacher_model->getCourseDataByAssignID($id);
        $data['info_db'] = $info;
        $data['qna'] = $this->Teacher_model->getQnA($qid);
        $data['submit'] = $this->Teacher_model->getSubmission($qid);
        $classid = $info['classid'];
        $students = $this->Teacher_model->getStudentsByClassID($classid);
        $i=0;
        $latestID = $this->Teacher_model->getScoreLatestID();
        $latestID = $latestID['anqscoreid'];
        foreach ($students as $student) {
            if($found = $this->Teacher_model->checkNoSubmission($student['studentid'], $qid)){
            }
            else{
                $latestID = substr($latestID, 1);
                $latestID = 'n'.str_pad((int) $latestID+1, 4, "0", STR_PAD_LEFT);
                $notfound[$i]['anqscoreid'] = $latestID;
                $notfound[$i]['studentid'] = $student['studentid'];
                $notfound[$i]['photo'] = $student['photo'];
                $notfound[$i]['firstname'] = $student['firstname'];
                $notfound[$i]['lastname'] = $student['lastname'];
                $notfound[$i]['submissiondate'] = '-';
                $notfound[$i]['score'] = null;
                $i++;
            }
        }
        $data['nosubmit'] = $notfound;
        $data['content'] = 'teacher/teacher_course_qna_submission_view';
        $this->load->view($this->template, $data);
    }
    
    public function courseSubmissionGrading($id, $nid){
        $id = $this->general->decryptParaID($id, 'courseassigned');
        $nid = $this->general->decryptParaID($nid, 'anqscore');
        
        $this->form_validation->set_rules('score', 'Score', 'required');
        $this->form_validation->set_error_delimiters('', '<br/>');
        
        if ($this->form_validation->run() == TRUE) {
            if($result = $this->Teacher_model->checkSubmission($nid)){
                $this->Teacher_model->editSubmission($nid);
            }
            else{
                $this->Teacher_model->addSubmission($nid);
            }
            $this->session->set_flashdata('success', 'Score updated');
            $qid = $this->Teacher_model->checkSubmission($nid);
            $qid = $qid['anqid'];

            $eid = $this->general->encryptParaID($id, 'courseassigned');
            $qid = $this->general->encryptParaID($qid, 'anq');
            redirect('teacher/courseAssignmentQuizSubmission/'.$eid.'/'.$qid);
        }
    }

    public function courseStudent($id){
        $id = $this->general->decryptParaID($id, 'courseassigned');
        $data['title'] = 'SMS';
        $data['courses'] = $this->Teacher_model->getAllCoursesByTeacher($this->session->userdata('id'));
        $data['eventnotif'] = $this->Teacher_model->getAllEventsCount($this->session->userdata('id'),$this->session->userdata('lastlogin'));
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
        $assignid = $this->general->decryptParaID($assignid, 'courseassigned');
        $studentid = $this->general->decryptParaID($studentid, 'student');
        $eid = $this->general->encryptParaID($assignid, 'courseassigned');
        $esid = $this->general->encryptParaID($studentid, 'student');

        $savebutton = $this->input->post('savebutton');
        if($savebutton == 'term1'){
            $this->form_validation->set_rules('op1', 'Mid Term Is self-motivated', 'required');
            $this->form_validation->set_rules('op2', 'Mid Term Shows initiatives and asks questions', 'required');
            $this->form_validation->set_rules('op3', 'Mid Term Persists despite difficulties', 'required');
            $this->form_validation->set_rules('op4', 'Mid Term Is well-organised and punctual', 'required');
            $this->form_validation->set_rules('op5', 'Mid Term Completes classroom tasks', 'required');
            $this->form_validation->set_rules('op6', 'Mid Term Completes homework on time', 'required');
            $this->form_validation->set_error_delimiters('', '<br/>');

            if ($this->form_validation->run() == TRUE) {
                if($result = $this->Teacher_model->checkReport($assignid, $studentid, 1)){
                    $this->Teacher_model->editTerm1Report($result['reportid']);
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
            redirect('teacher/courseStudentPerformance/'.$eid.'/'.$esid);
        }
        else if($savebutton == 'term2'){
            $this->form_validation->set_rules('mark', 'Mid Term Exam Mark', 'required');
            $this->form_validation->set_rules('grade', 'Mid Term Course Grade', 'required');
            $this->form_validation->set_rules('comment', 'Mid Term Comment', 'required');
            $this->form_validation->set_error_delimiters('', '<br/>');

            if ($this->form_validation->run() == TRUE) {
                if($result = $this->Teacher_model->checkReport($assignid, $studentid, 1)){
                    $this->Teacher_model->editMidReport($result['reportid']);
                }
                $this->session->set_flashdata('success', 'Report saved');
            }
            redirect('teacher/courseStudentPerformance/'.$eid.'/'.$esid);
        }
        else if($savebutton == 'term3'){
            $this->form_validation->set_rules('opf1', 'Final Term Is self-motivated', 'required');
            $this->form_validation->set_rules('opf2', 'Final Term Shows initiatives and asks questions', 'required');
            $this->form_validation->set_rules('opf3', 'Final Term Persists despite difficulties', 'required');
            $this->form_validation->set_rules('opf4', 'Final Term Is well-organised and punctual', 'required');
            $this->form_validation->set_rules('opf5', 'Final Term Completes classroom tasks', 'required');
            $this->form_validation->set_rules('opf6', 'Final Term Completes homework on time', 'required');
            $this->form_validation->set_error_delimiters('', '<br/>');

            if ($this->form_validation->run() == TRUE) {
                if($result = $this->Teacher_model->checkReport($assignid, $studentid, 2)){
                    $this->Teacher_model->editTerm3Report($result['reportid']);
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
            redirect('teacher/courseStudentPerformance/'.$eid.'/'.$esid);
        }
        else if($savebutton == 'term4'){
            $this->form_validation->set_rules('mark', 'Mid Term Exam Mark', 'required');
            $this->form_validation->set_rules('grade', 'Mid Term Course Grade', 'required');
            $this->form_validation->set_rules('comment', 'Mid Term Comment', 'required');
            $this->form_validation->set_error_delimiters('', '<br/>');

            if ($this->form_validation->run() == TRUE) {
                if($result = $this->Teacher_model->checkReport($assignid, $studentid, 2)){
                    $this->Teacher_model->editFinalReport($result['reportid']);
                }
                $this->session->set_flashdata('success', 'Report saved');
            }
            redirect('teacher/courseStudentPerformance/'.$eid.'/'.$esid);
        }

        $data['homework'] = $this->Teacher_model->getAllQnAByStudent($studentid, 'Quiz');
        $data['classwork'] = $this->Teacher_model->getAllQnAByStudent($studentid, 'Assignment');
        
        
        $data['title'] = 'SMS';
        $data['courses'] = $this->Teacher_model->getAllCoursesByTeacher($this->session->userdata('id'));
        $data['eventnotif'] = $this->Teacher_model->getAllEventsCount($this->session->userdata('id'),$this->session->userdata('lastlogin'));
        $data['sidebar'] = 'teacher/teacher_sidebar';
        $data['topnavigation'] = 'teacher/teacher_topnavigation';
        $data['top2navigation'] = 'teacher/teacher_top2navigation';
        $data['info_db'] = $this->Teacher_model->getCourseDataByAssignID($assignid);
        $data['student'] = $this->Teacher_model->getStudentDataByStudentID($studentid);
        $data['report'] = $this->Teacher_model->getReportDataBy($assignid, $studentid);
        $data['content'] = 'teacher/teacher_course_student_performance_view';
        $this->load->view($this->template, $data);
    }

    public function performancedata($studentid){
        $homework = $this->Teacher_model->getAllQnAByStudent($studentid, 'Quiz');
        $data = array();
        foreach ($homework as $row) {
            $data[] = $row;
        }
        print json_encode($data);
    }

    public function classScheduleView()
    {
        $data['title'] = 'SMS';
        $data['courses'] = $this->Teacher_model->getAllCoursesByTeacher($this->session->userdata('id'));
        $data['eventnotif'] = $this->Teacher_model->getAllEventsCount($this->session->userdata('id'),$this->session->userdata('lastlogin'));
        $data['sidebar'] = 'teacher/teacher_sidebar';
        $data['topnavigation'] = 'teacher/teacher_topnavigation';
        $data['content'] = 'includes/class_schedule_view';
        $this->load->view($this->template, $data);
    }

    public function examScheduleView()
    {
        $data['title'] = 'SMS';
        $data['courses'] = $this->Teacher_model->getAllCoursesByTeacher($this->session->userdata('id'));
        $data['eventnotif'] = $this->Teacher_model->getAllEventsCount($this->session->userdata('id'),$this->session->userdata('lastlogin'));
        $data['sidebar'] = 'teacher/teacher_sidebar';
        $data['topnavigation'] = 'teacher/teacher_topnavigation';
        $data['content'] = 'includes/exam_schedule_view';
        $this->load->view($this->template, $data);
    }

    public function studentView()
    {
        $data['title'] = 'SMS';
        $data['courses'] = $this->Teacher_model->getAllCoursesByTeacher($this->session->userdata('id'));
        $data['eventnotif'] = $this->Teacher_model->getAllEventsCount($this->session->userdata('id'),$this->session->userdata('lastlogin'));
        $data['sidebar'] = 'teacher/teacher_sidebar';
        $data['topnavigation'] = 'teacher/teacher_topnavigation';
        $data['content'] = 'includes/students_view';
        $this->load->view($this->template, $data);
    }

    public function parentView()
    {
        $data['title'] = 'SMS';
        $data['courses'] = $this->Teacher_model->getAllCoursesByTeacher($this->session->userdata('id'));
        $data['eventnotif'] = $this->Teacher_model->getAllEventsCount($this->session->userdata('id'),$this->session->userdata('lastlogin'));
        $data['sidebar'] = 'teacher/teacher_sidebar';
        $data['topnavigation'] = 'teacher/teacher_topnavigation';
        $data['content'] = 'includes/parents_view';
        $this->load->view($this->template, $data);
    }

    public function teacherView()
    {
        $data['title'] = 'SMS';
        $data['courses'] = $this->Teacher_model->getAllCoursesByTeacher($this->session->userdata('id'));
        $data['eventnotif'] = $this->Teacher_model->getAllEventsCount($this->session->userdata('id'),$this->session->userdata('lastlogin'));
        $data['sidebar'] = 'teacher/teacher_sidebar';
        $data['topnavigation'] = 'teacher/teacher_topnavigation';
        $data['teachers'] =  $this->Teacher_model->getAllTeacher();
        $data['content'] = 'includes/teachers_view';
        $this->load->view($this->template, $data);
    }

    public function staffView()
    {
        $data['title'] = 'SMS';
        $data['courses'] = $this->Teacher_model->getAllCoursesByTeacher($this->session->userdata('id'));
        $data['eventnotif'] = $this->Teacher_model->getAllEventsCount($this->session->userdata('id'),$this->session->userdata('lastlogin'));
        $data['sidebar'] = 'teacher/teacher_sidebar';
        $data['topnavigation'] = 'teacher/teacher_topnavigation';
        $data['content'] = 'includes/staff_view';
        $this->load->view($this->template, $data);
    }

    public function libraryView()
    {
        $data['title'] = 'SMS';
        $data['courses'] = $this->Teacher_model->getAllCoursesByTeacher($this->session->userdata('id'));
        $data['eventnotif'] = $this->Teacher_model->getAllEventsCount($this->session->userdata('id'),$this->session->userdata('lastlogin'));
        $data['sidebar'] = 'teacher/teacher_sidebar';
        $data['topnavigation'] = 'teacher/teacher_topnavigation';
        $data['content'] = 'includes/libraries_view';
        $this->load->view($this->template, $data);
    }

    public function payment()
    {
        $data['title'] = 'SMS';
        $data['courses'] = $this->Teacher_model->getAllCoursesByTeacher($this->session->userdata('id'));
        $data['eventnotif'] = $this->Teacher_model->getAllEventsCount($this->session->userdata('id'),$this->session->userdata('lastlogin'));
        $data['sidebar'] = 'teacher/teacher_sidebar';
        $data['topnavigation'] = 'teacher/teacher_topnavigation';
        $data['content'] = 'includes/payments_view';
        $this->load->view($this->template, $data);
    }

    public function addEvent()
    {
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('description', 'Description', 'required');
        $this->form_validation->set_rules('duedate', 'Date', 'required');
        $this->form_validation->set_error_delimiters('', '<br/>');
        if ($this->form_validation->run() == TRUE) {
            $latestID = $this->Teacher_model->getEventLatestID();
            $latestID = $latestID['eventid'];
            $latestID = substr($latestID, 1);
            $latestID = 'v'.str_pad((int) $latestID+1, 4, "0", STR_PAD_LEFT);
            $this->Teacher_model->addEvent($latestID);

            $this->session->set_flashdata('success', 'New Event Added');
            redirect('teacher/eventList/');
        }
        $data['title'] = 'SMS';
        $data['courses'] = $this->Teacher_model->getAllCoursesByTeacher($this->session->userdata('id'));
        $data['eventnotif'] = $this->Teacher_model->getAllEventsCount($this->session->userdata('id'),$this->session->userdata('lastlogin'));
        $data['sidebar'] = 'teacher/teacher_sidebar';
        $data['topnavigation'] = 'teacher/teacher_topnavigation';
        $data['content'] = 'teacher/add_event_view';
        $this->load->view($this->template, $data);
    }
    
    public function editEvent($id){
        $id = $this->general->decryptParaID($id, 'event');
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('description', 'Description', 'required');
        $this->form_validation->set_rules('duedate', 'Date', 'required');
        $this->form_validation->set_error_delimiters('', '<br/>');
        if ($this->form_validation->run() == TRUE) {
            $this->Teacher_model->editEvent($id);

            $this->session->set_flashdata('success', 'Event Edited');
            redirect('teacher/eventList/');
        }
        $data['title'] = 'SMS';
        $data['courses'] = $this->Teacher_model->getAllCoursesByTeacher($this->session->userdata('id'));
        $data['eventnotif'] = $this->Teacher_model->getAllEventsCount($this->session->userdata('id'),$this->session->userdata('lastlogin'));
        $data['sidebar'] = 'teacher/teacher_sidebar';
        $data['topnavigation'] = 'teacher/teacher_topnavigation';
        $data['event'] = $this->Teacher_model->getEvent($id);
        $data['content'] = 'teacher/edit_event_view';
        $this->load->view($this->template, $data);
    }

    public function deleteEvent($id){
        $id = $this->general->decryptParaID($id, 'event');
        if($this->Teacher_model->deleteEvent($id)){
            $this->session->set_flashdata('success', 'Event Deleted');
        }
        else{
            $this->session->set_flashdata('error', 'Failed to Delete Event');
        }
        redirect('teacher/eventList');
    }

    public function eventList()
    {
        $data['title'] = 'SMS';
        $data['courses'] = $this->Teacher_model->getAllCoursesByTeacher($this->session->userdata('id'));
        $data['eventnotif'] = $this->Teacher_model->getAllEventsCount($this->session->userdata('id'),$this->session->userdata('lastlogin'));
        $data['sidebar'] = 'teacher/teacher_sidebar';
        $data['topnavigation'] = 'teacher/teacher_topnavigation';
        $data['info_dbs'] = $this->Teacher_model->getAllEvents($this->session->userdata('id'));
        $data['content'] = 'teacher/event_view';
        $this->load->view($this->template, $data);
    }

    public function forms()
    {
        $data['title'] = 'SMS';
        $data['courses'] = $this->Teacher_model->getAllCoursesByTeacher($this->session->userdata('id'));
        $data['eventnotif'] = $this->Teacher_model->getAllEventsCount($this->session->userdata('id'),$this->session->userdata('lastlogin'));
        $data['sidebar'] = 'teacher/teacher_sidebar';
        $data['topnavigation'] = 'teacher/teacher_topnavigation';
        $data['info_dbs'] = $this->Teacher_model->getAllForms();
        $data['content'] = 'includes/forms_view';
        $this->load->view($this->template, $data);
    }

    public function addForm()
    {
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('description', 'Description', 'required');
        $this->form_validation->set_error_delimiters('', '<br/>');
        if ($this->form_validation->run() == TRUE) {
            if (empty($_FILES['userfile']['name'])){
                $this->session->set_flashdata('error', 'File is required');
                redirect(current_url());
            }
            else{
                $latestID = $this->Teacher_model->getFormLatestID();
                $latestID = $latestID['formid'];
                $latestID = substr($latestID, 1);
                $latestID = 'f'.str_pad((int) $latestID+1, 4, "0", STR_PAD_LEFT);
                if ($_FILES['userfile']['error'] != 4) {
                    $config['upload_path'] = $this->formpath;
                    $config['allowed_types'] = "doc|pdf|docx";
                    $config['max_size'] = 200000;
                    $config['overwrite'] = TRUE;
                    $config['file_name'] = $latestID;
                    $this->load->library('upload', $config);

                    if (!$this->upload->do_upload('userfile')) {
                        $this->session->set_flashdata('error', $this->upload->display_errors());
                        redirect(current_url());
                    } else {
                        $data = $this->upload->data();
                        $filename = $data['orig_name'];
                        $this->Teacher_model->addForm($latestID, $filename);
                    }
                }
                $this->session->set_flashdata('success', 'New Form Added');
                redirect('teacher/forms/');
            }
        }
        
        $data['title'] = 'SMS';
        $data['courses'] = $this->Teacher_model->getAllCoursesByTeacher($this->session->userdata('id'));
        $data['eventnotif'] = $this->Teacher_model->getAllEventsCount($this->session->userdata('id'),$this->session->userdata('lastlogin'));
        $data['sidebar'] = 'teacher/teacher_sidebar';
        $data['topnavigation'] = 'teacher/teacher_topnavigation';
        $data['content'] = 'includes/add_form_view';
        $this->load->view($this->template, $data);
    }

    public function editForm($id){
        $id = $this->general->decryptParaID($id, 'form');
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('description', 'Description', 'required');
        $this->form_validation->set_error_delimiters('', '<br/>');
        if ($this->form_validation->run() == TRUE) {
            if (empty($_FILES['userfile']['name'])){
                $this->Teacher_model->editForm($id);
            }
            else{
                if ($_FILES['userfile']['error'] != 4) {
                    $config['upload_path'] = $this->formpath;
                    $config['allowed_types'] = "doc|pdf|docx";
                    $config['max_size'] = 200000;
                    $config['overwrite'] = TRUE;
                    $config['file_name'] = $id;
                    $this->load->library('upload', $config);

                    if (!$this->upload->do_upload('userfile')) {
                        $this->session->set_flashdata('error', $this->upload->display_errors());
                        redirect(current_url());
                    } else {
                        $data = $this->upload->data();
                        $filename = $data['orig_name'];
                        $this->Teacher_model->editFormWithFile($id, $filename);
                    }
                }
            }
            $this->session->set_flashdata('success', 'Form Edited');
            redirect('teacher/forms/');
        }

        $data['title'] = 'SMS';
        $data['courses'] = $this->Teacher_model->getAllCoursesByTeacher($this->session->userdata('id'));
        $data['eventnotif'] = $this->Teacher_model->getAllEventsCount($this->session->userdata('id'),$this->session->userdata('lastlogin'));
        $data['sidebar'] = 'teacher/teacher_sidebar';
        $data['topnavigation'] = 'teacher/teacher_topnavigation';
        $data['form'] = $this->Teacher_model->getForm($id);
        $data['content'] = 'includes/edit_form_view';
        $this->load->view($this->template, $data);
    }

    public function deleteForm($id){
        $id = $this->general->decryptParaID($id, 'form');
        if($this->Teacher_model->deleteForm($id)){
            $this->session->set_flashdata('success', 'Form Deleted');
        }
        else{
            $this->session->set_flashdata('error', 'Failed to Delete Form');
        }
        redirect('teacher/forms');
    }

    public function settings()
    {
        $data['title'] = 'SMS';
        $data['courses'] = $this->Teacher_model->getAllCoursesByTeacher($this->session->userdata('id'));
        $data['eventnotif'] = $this->Teacher_model->getAllEventsCount($this->session->userdata('id'),$this->session->userdata('lastlogin'));
        $data['sidebar'] = 'teacher/teacher_sidebar';
        $data['topnavigation'] = 'teacher/teacher_topnavigation';
        $data['info_dbs'] = $this->Teacher_model->getAllSettings();
        $data['content'] = 'teacher/teacher_settings_view';
        $this->load->view($this->template, $data);
    }
    
    public function editSetting($id){
        $this->form_validation->set_rules('value', 'Value', 'required');
        $this->form_validation->set_error_delimiters('', '<br/>');
        if ($this->form_validation->run() == TRUE) {
                $this->Teacher_model->editSetting($id);
                $this->session->set_flashdata('success', 'Setting Edited');
                redirect('teacher/settings/');
        }
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

    public function logout(){
        $this->session->sess_destroy();
        redirect('');
    }
}