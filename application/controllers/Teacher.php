<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class teacher extends CI_Controller {

    var $template = 'template';
    var $print_template = 'print_template';
    var $profilephotopath = 'assets/img/teacher/profile/';
    var $materialpath = 'assets/file/teacher/material/';
    var $formpath = 'assets/file/forms/';
    var $eventimagepath = 'assets/img/texteditor/';

    function __construct() {
        parent::__construct();
        $this->general->TeacherLogin();
        $this->load->model('Teacher_model');
    }

    public function home()
    {
        $data['title'] = 'SMS';
        $data['courses'] = $this->Teacher_model->getAllCoursesByTeacher($this->nativesession->get('id'));
        $data['eventnotif'] = $this->Teacher_model->getAllEventsCount($this->nativesession->get('id'),$this->nativesession->get('lastlogin'));
        $data['sidebar'] = 'teacher/teacher_sidebar';
        $data['topnavigation'] = 'teacher/teacher_topnavigation';
        $data['events'] = $this->Teacher_model->getAllEvents($this->nativesession->get('id'));
        $data['content'] = 'teacher/teacher_home_view';
        $this->load->view($this->template, $data);
    }

    public function homeroom_attendance()
    {
        $info = $this->Teacher_model->getClassByTeacherID($this->nativesession->get('id'));
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
        $data['courses'] = $this->Teacher_model->getAllCoursesByTeacher($this->nativesession->get('id'));
        $data['eventnotif'] = $this->Teacher_model->getAllEventsCount($this->nativesession->get('id'),$this->nativesession->get('lastlogin'));
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
        $data['courses'] = $this->Teacher_model->getAllCoursesByTeacher($this->nativesession->get('id'));
        $data['eventnotif'] = $this->Teacher_model->getAllEventsCount($this->nativesession->get('id'),$this->nativesession->get('lastlogin'));
        $data['sidebar'] = 'teacher/teacher_sidebar';
        $data['topnavigation'] = 'teacher/teacher_topnavigation';
        $info = $this->Teacher_model->getClassByTeacherID($this->nativesession->get('id'));
        $classid = $info['classid'];
        $data['info_db'] = $info;
        $data['students'] = $this->Teacher_model->getStudentsByClassID($classid);
        $data['content'] = 'teacher/homeroom_student_view';
        $this->load->view($this->template, $data);
    }

    public function homeroomReport($id, $term)
    {
        $id = $this->general->decryptParaID($id, 'student');
        $class = $this->Teacher_model->getClassByStudentID($id);
        $class = explode('-', $class['classroom']);

        $this->form_validation->set_rules('op1', 'Consideration', 'required');
        $this->form_validation->set_rules('op2', 'Responsibility', 'required');
        $this->form_validation->set_rules('op3', 'Communication', 'required');
        $this->form_validation->set_rules('op4', 'Punctual', 'required');
        $this->form_validation->set_error_delimiters('', '<br/>');

        if ($this->form_validation->run() == TRUE) {
            if($result = $this->Teacher_model->checkHomeroomReport($id, $term, $class[0])){
                $this->Teacher_model->editHomeroomReport($result['homeroomid']);
            }
            else{
                $latestID = $this->Teacher_model->getHomeroomReportLatestID();
                $latestID = $latestID['homeroomid'];
                $latestID = substr($latestID, 1);
                $latestID = 'h'.str_pad((int) $latestID+1, 4, "0", STR_PAD_LEFT);
                
                $this->Teacher_model->addHomeroomReport($latestID, $id, $term, $class[0]);
            }
            $this->nativesession->set('success', 'Homeroom Report saved');
            $eid = $this->general->encryptParaID($id, 'student');
            redirect('teacher/homeroomReport/'.$eid.'/'.$term);
        }

        $allattendance = $this->Teacher_model->getTotalAttendance($id);
        $present = $this->Teacher_model->getTotalPresentByStudent($id);
        $attendancepercentage = $present/$allattendance*100;
        
        $data['title'] = 'SMS';
        $data['courses'] = $this->Teacher_model->getAllCoursesByTeacher($this->nativesession->get('id'));
        $data['eventnotif'] = $this->Teacher_model->getAllEventsCount($this->nativesession->get('id'),$this->nativesession->get('lastlogin'));
        $data['sidebar'] = 'teacher/teacher_sidebar';
        $data['topnavigation'] = 'teacher/teacher_topnavigation';
        $info = $this->Teacher_model->getClassByStudentID($id);
        $classid = $info['classid'];
        $data['attendance'] = $attendancepercentage;
        $data['info_db'] = $info;
        $data['reports'] = $this->Teacher_model->getStudentReport($classid, $id, $term, $class[0]);
        $data['coursesList'] = $this->Teacher_model->getStudentCourses($classid);
        $data['term'] = $term;
        $data['homeroomreport'] = $this->Teacher_model->getHomeroomReport($id, $term, $class[0]);
        $data['teacher'] = $this->Teacher_model->getHomeroomTeacher($classid);
        $data['content'] = 'teacher/homeroom_report_view';
        $this->load->view($this->template, $data);
    }

    public function homeroomReport2($id, $term)
    {
        $id = $this->general->decryptParaID($id, 'student');
        $class = $this->Teacher_model->getClassByStudentID($id);
        $class = explode('-', $class['classroom']);

        $this->form_validation->set_rules('comment', 'Comment', 'required');
        $this->form_validation->set_error_delimiters('', '<br/>');

        if ($this->form_validation->run() == TRUE) {
            if($result = $this->Teacher_model->checkHomeroomReport($id, $term, $class[0])){
                $this->Teacher_model->editHomeroomReport2($result['homeroomid']);
            }
            $this->nativesession->set('success', 'Homeroom Report saved');
            $eid = $this->general->encryptParaID($id, 'student');
            redirect('teacher/homeroomReport2/'.$eid.'/'.$term);
        }

        $allattendance = $this->Teacher_model->getTotalAttendance($id);
        $present = $this->Teacher_model->getTotalPresentByStudent($id);
        $attendancepercentage = $present/$allattendance*100;

        $data['title'] = 'SMS';
        $data['courses'] = $this->Teacher_model->getAllCoursesByTeacher($this->nativesession->get('id'));
        $data['eventnotif'] = $this->Teacher_model->getAllEventsCount($this->nativesession->get('id'),$this->nativesession->get('lastlogin'));
        $data['sidebar'] = 'teacher/teacher_sidebar';
        $data['topnavigation'] = 'teacher/teacher_topnavigation';
        $info = $this->Teacher_model->getClassByStudentID($id);
        $classid = $info['classid'];
        $data['attendance'] = $attendancepercentage;
        $data['info_db'] = $info;
        $data['reports'] = $this->Teacher_model->getStudentReport($classid, $id, $term, $class[0]);
        $data['coursesList'] = $this->Teacher_model->getStudentCourses($classid);
        $data['term'] = $term;
        $data['homeroomreport'] = $this->Teacher_model->getHomeroomReport($id, $term, $class[0]);
        $data['teacher'] = $this->Teacher_model->getHomeroomTeacher($classid);
        $data['content'] = 'teacher/homeroom_report2_view';
        $this->load->view($this->template, $data);
    }

    public function printPreview13($id, $term)
    {
        $id = $this->general->decryptParaID($id, 'student');
        $class = $this->Teacher_model->getClassByStudentID($id);
        $class = explode('-', $class['classroom']);
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
        $data['reports'] = $this->Teacher_model->getStudentReport($classid, $id, $term, $class[0]);
        $data['coursesList'] = $this->Teacher_model->getStudentCourses($classid);
        $data['term'] = $term;
        $data['attendance'] = $attendancepercentage;
        $data['homeroomreport'] = $this->Teacher_model->getHomeroomReport($id, $term, $class[0]);
        $data['setting'] = $this->Teacher_model->getSetting($sid);
        $data['teacher'] = $this->Teacher_model->getHomeroomTeacher($classid);
        $data['content'] = 'teacher/homeroom_report_print_preview';
        $this->load->view($this->print_template, $data);
    }

    public function printPreview24($id, $term)
    {
        $id = $this->general->decryptParaID($id, 'student');
        $class = $this->Teacher_model->getClassByStudentID($id);
        $class = explode('-', $class['classroom']);
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
        $data['reports'] = $this->Teacher_model->getStudentReport($classid, $id, $term, $class[0]);
        $data['coursesList'] = $this->Teacher_model->getStudentCourses($classid);
        $data['term'] = $term;
        $data['attendance'] = $attendancepercentage;
        $data['homeroomreport'] = $this->Teacher_model->getHomeroomReport($id, $term, $class[0]);
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
        $data['courses'] = $this->Teacher_model->getAllCoursesByTeacher($this->nativesession->get('id'));
        $data['eventnotif'] = $this->Teacher_model->getAllEventsCount($this->nativesession->get('id'),$this->nativesession->get('lastlogin'));
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
        if($this->nativesession->get('id') != $id){
            $this->nativesession->set('error', 'Access Denied');
            redirect('teacher/home');
        }

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
                    if ($this->Teacher_model->editProfilePhoto($teacherid, $filename)) {
                    } else {
                        $this->nativesession->set('error', 'Upload Photo Failed, try again !');
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
            $this->nativesession->set('success', 'Profile saved');
            $eid = $this->general->encryptParaID($id, 'teacher');
            redirect('teacher/teacher_profile/'.$eid);
        }

        $data['title'] = 'SMS';
        $data['courses'] = $this->Teacher_model->getAllCoursesByTeacher($this->nativesession->get('id'));
        $data['eventnotif'] = $this->Teacher_model->getAllEventsCount($this->nativesession->get('id'),$this->nativesession->get('lastlogin'));
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
        if($this->general->checkPrivilege($this->nativesession->get('role'), 'p0004') != 1){
            $this->nativesession->set('error', 'Access Denied');
            redirect('teacher/home');
        }
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
                    if ($this->Teacher_model->editProfilePhoto($teacherID, $filename)) {
                        $this->nativesession->set('success', 'Photo Changed');
                    } else {
                        $this->nativesession->set('error', 'Upload Photo Failed, try again !');
                        redirect(current_url());
                    }
                }
            }
            $this->nativesession->set('success', 'New Teacher Added');
            redirect('teacher/teacher_profile/'.$teacherID);
        }

        $data['title'] = 'SMS';
        $data['courses'] = $this->Teacher_model->getAllCoursesByTeacher($this->nativesession->get('id'));
        $data['eventnotif'] = $this->Teacher_model->getAllEventsCount($this->nativesession->get('id'),$this->nativesession->get('lastlogin'));
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

    public function editTeacher($id)
    {
        if($this->general->checkPrivilege($this->nativesession->get('role'), 'p0005') != 1){
            $this->nativesession->set('error', 'Access Denied');
            redirect('teacher/home');
        }
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
                    if ($this->Teacher_model->editProfilePhoto($teacherid, $filename)) {
                    } else {
                        $this->nativesession->set('error', 'Upload Photo Failed, try again !');
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
            $this->Teacher_model->editRole($teacherid);
            $this->Teacher_model->editProfile($teacherid, $availabletime);
            $this->nativesession->set('success', 'Profile saved');
            redirect('teacher/teacherView');
        }

        $data['title'] = 'SMS';
        $data['courses'] = $this->Teacher_model->getAllCoursesByTeacher($this->nativesession->get('id'));
        $data['eventnotif'] = $this->Teacher_model->getAllEventsCount($this->nativesession->get('id'),$this->nativesession->get('lastlogin'));
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
        $data['rolechoice'] = $this->Teacher_model->getRoleCategory(1);
        $data['content'] = 'teacher/teacher_edit_view';
        $data['info_db'] = $this->Teacher_model->getProfileDataByID($id);
        $this->load->view($this->template, $data);
    }

    public function deleteTeacher($id){
        if($this->general->checkPrivilege($this->nativesession->get('role'), 'p0005') != 1){
            $this->nativesession->set('error', 'Access Denied');
            redirect('teacher/home');
        }
        $id = $this->general->decryptParaID($id, 'teacher');
        if($this->Teacher_model->deleteTeacher($id)){
            $this->nativesession->set('success', 'Teacher Deleted');
        }
        else{
            $this->nativesession->set('error', 'Failed to Delete Teacher');
        }
        redirect('teacher/teacherView');
    }

    public function addCourse()
    {
        if($this->general->checkPrivilege($this->nativesession->get('role'), 'p0013') != 1){
            $this->nativesession->set('error', 'Access Denied');
            redirect('teacher/home');
        }
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
           
            $this->nativesession->set('success', 'New Course Added');
            $id = $this->general->encryptParaID($courseID, 'course');
            redirect('teacher/courseView/c'.$id);
        }
        
        $data['title'] = 'SMS';
        $data['courses'] = $this->Teacher_model->getAllCoursesByTeacher($this->nativesession->get('id'));
        $data['eventnotif'] = $this->Teacher_model->getAllEventsCount($this->nativesession->get('id'),$this->nativesession->get('lastlogin'));
        $data['sidebar'] = 'teacher/teacher_sidebar';
        $data['topnavigation'] = 'teacher/teacher_topnavigation';
        $data['content'] = 'teacher/teacher_add_course_view';
        $this->load->view($this->template, $data);
    }

    public function editCourse($fid)
    {
        if($this->general->checkPrivilege($this->nativesession->get('role'), 'p0014') != 1){
            $this->nativesession->set('error', 'Access Denied');
            redirect('teacher/home');
        }
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

            $this->nativesession->set('success', 'Course saved');
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
        $data['courses'] = $this->Teacher_model->getAllCoursesByTeacher($this->nativesession->get('id'));
        $data['eventnotif'] = $this->Teacher_model->getAllEventsCount($this->nativesession->get('id'),$this->nativesession->get('lastlogin'));
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
        $data['courses'] = $this->Teacher_model->getAllCoursesByTeacher($this->nativesession->get('id'));
        $data['eventnotif'] = $this->Teacher_model->getAllEventsCount($this->nativesession->get('id'),$this->nativesession->get('lastlogin'));
        $data['sidebar'] = 'teacher/teacher_sidebar';
        $data['topnavigation'] = 'teacher/teacher_topnavigation';
        $data['info_dbs'] = $this->Teacher_model->getAllCourses();
        $data['content'] = 'teacher/teacher_courses_list_view';
        $this->load->view($this->template, $data);
    }

    public function deleteCourse($id){
        if($this->general->checkPrivilege($this->nativesession->get('role'), 'p0014') != 1){
            $this->nativesession->set('error', 'Access Denied');
            redirect('teacher/home');
        }
        $id = $this->general->decryptParaID($id, 'course');
        if($this->Teacher_model->deleteCourse($id)){
            $this->nativesession->set('success', 'Course Deleted');
        }
        else{
            $this->nativesession->set('error', 'Failed to Delete Course');
        }
        redirect('teacher/allCourse');
    }

    public function courseView($fid)
    {
        if(substr($fid, 0 ,1) == 's'){
            $id = $this->general->decryptParaID(substr($fid, 1), 'courseassigned');
        }
        else{
            $id = $this->general->decryptParaID(substr($fid, 1), 'course');
        }

        $data['title'] = 'SMS';
        $data['courses'] = $this->Teacher_model->getAllCoursesByTeacher($this->nativesession->get('id'));
        $data['eventnotif'] = $this->Teacher_model->getAllEventsCount($this->nativesession->get('id'),$this->nativesession->get('lastlogin'));
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
        $data['courses'] = $this->Teacher_model->getAllCoursesByTeacher($this->nativesession->get('id'));
        $data['eventnotif'] = $this->Teacher_model->getAllEventsCount($this->nativesession->get('id'),$this->nativesession->get('lastlogin'));
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
        if($this->general->checkPrivilege($this->nativesession->get('role'), 'p0014') != 1){
            $this->nativesession->set('error', 'Access Denied');
            redirect('teacher/home');
        }
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

            $this->nativesession->set('success', 'Course saved');
            $encryptid = $this->general->encryptParaID($id, 'courseassigned');
            redirect('teacher/courseSemester/'.$encryptid);
        }

        $data['title'] = 'SMS';
        $data['courses'] = $this->Teacher_model->getAllCoursesByTeacher($this->nativesession->get('id'));
        $data['eventnotif'] = $this->Teacher_model->getAllEventsCount($this->nativesession->get('id'),$this->nativesession->get('lastlogin'));
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
//        $data['courses'] = $this->Teacher_model->getAllCoursesByTeacher($this->nativesession->get('id'));
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

            $this->nativesession->set('success', 'Implementation saved');
            $encryptid = $this->general->encryptParaID($id, 'courseassigned');
            redirect('teacher/courseImplementation/'.$encryptid);
        }
        
        $data['title'] = 'SMS';
        $data['courses'] = $this->Teacher_model->getAllCoursesByTeacher($this->nativesession->get('id'));
        $data['eventnotif'] = $this->Teacher_model->getAllEventsCount($this->nativesession->get('id'),$this->nativesession->get('lastlogin'));
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
        $data['courses'] = $this->Teacher_model->getAllCoursesByTeacher($this->nativesession->get('id'));
        $data['eventnotif'] = $this->Teacher_model->getAllEventsCount($this->nativesession->get('id'),$this->nativesession->get('lastlogin'));
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
                $this->nativesession->set('error', 'Existing file or New file is required');
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
                        $this->nativesession->set('error', $this->upload->display_errors());
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
                        $this->nativesession->set('success', 'File Uploaded');

                    }
                }
                if(isset($newfile) && $newfile == true){
                    $this->Teacher_model->addMaterial($materialID, $id, $fileID);
                }
                else{
                    $fileID = $this->input->post('existingfile');
                    $this->Teacher_model->addMaterial($materialID, $id, $fileID);
                }
                $this->nativesession->set('success', 'New Material Added');
                $eid = $this->general->encryptParaID($id, 'courseassigned');
                redirect('teacher/courseMaterial/'.$eid);
            }
        }

        $data['title'] = 'SMS';
        $data['courses'] = $this->Teacher_model->getAllCoursesByTeacher($this->nativesession->get('id'));
        $data['eventnotif'] = $this->Teacher_model->getAllEventsCount($this->nativesession->get('id'),$this->nativesession->get('lastlogin'));
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
        $data['courses'] = $this->Teacher_model->getAllCoursesByTeacher($this->nativesession->get('id'));
        $data['eventnotif'] = $this->Teacher_model->getAllEventsCount($this->nativesession->get('id'),$this->nativesession->get('lastlogin'));
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
                $this->nativesession->set('error', 'Existing file or New file is required');
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
                        $this->nativesession->set('error', $this->upload->display_errors());
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
                        $this->nativesession->set('success', 'File Uploaded');

                    }
                }
                if(isset($newfile) && $newfile == true){
                    $this->Teacher_model->addQnA($materialID, $id, $fileID);
                }
                else{
                    $fileID = $this->input->post('existingfile');
                    $this->Teacher_model->addQnA($materialID, $id, $fileID);
                }

                if($this->input->post('type') == 'Quiz' || $this->input->post('type') == 'Assignment'){
                    $latestID = $this->Teacher_model->getEventLatestID();
                    $latestID = $latestID['eventid'];
                    $latestID = substr($latestID, 1);
                    $latestID = 'v'.str_pad((int) $latestID+1, 4, "0", STR_PAD_LEFT);
                    $teacherid = $this->Teacher_model->getTeacherOfAssignID($id);
                    $teacherid = $teacherid['teacherid'];
                    $this->Teacher_model->addQnAEvent($latestID, $teacherid, $id);
                }


                $this->nativesession->set('success', 'New Material Added');
                $eid = $this->general->encryptParaID($id, 'courseassigned');
                redirect('teacher/courseAssignmentQuiz/'.$eid);
            }
        }

        $data['title'] = 'SMS';
        $data['courses'] = $this->Teacher_model->getAllCoursesByTeacher($this->nativesession->get('id'));
        $data['eventnotif'] = $this->Teacher_model->getAllEventsCount($this->nativesession->get('id'),$this->nativesession->get('lastlogin'));
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
        $data['courses'] = $this->Teacher_model->getAllCoursesByTeacher($this->nativesession->get('id'));
        $data['eventnotif'] = $this->Teacher_model->getAllEventsCount($this->nativesession->get('id'),$this->nativesession->get('lastlogin'));
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
            $this->nativesession->set('success', 'Score updated');
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
        $data['courses'] = $this->Teacher_model->getAllCoursesByTeacher($this->nativesession->get('id'));
        $data['eventnotif'] = $this->Teacher_model->getAllEventsCount($this->nativesession->get('id'),$this->nativesession->get('lastlogin'));
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

        $class = $this->Teacher_model->getClassByStudentID($studentid);
        $class = explode('-', $class['classroom']);

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
                    $this->Teacher_model->addMidReport($latestID, $assignid, $studentid, $class[0]);
                }
                $this->nativesession->set('success', 'Report saved');
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
                $this->nativesession->set('success', 'Report saved');
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
                    $this->Teacher_model->addFinalReport($latestID, $assignid, $studentid, $class[0]);
                }
                $this->nativesession->set('success', 'Report saved');
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
                $this->nativesession->set('success', 'Report saved');
            }
            redirect('teacher/courseStudentPerformance/'.$eid.'/'.$esid);
        }

        $data['homework'] = $this->Teacher_model->getAllQnAByStudent($studentid, 1);
        $data['classwork'] = $this->Teacher_model->getAllQnAByStudent($studentid, 2);
        $data['assessment'] = $this->Teacher_model->getAllQnAByStudent($studentid, 3);
        
        
        $data['title'] = 'SMS';
        $data['courses'] = $this->Teacher_model->getAllCoursesByTeacher($this->nativesession->get('id'));
        $data['eventnotif'] = $this->Teacher_model->getAllEventsCount($this->nativesession->get('id'),$this->nativesession->get('lastlogin'));
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

    public function createSchedule()
    {
        $data['title'] = 'SMS';
        $data['courses'] = $this->Teacher_model->getAllCoursesByTeacher($this->nativesession->get('id'));
        $data['eventnotif'] = $this->Teacher_model->getAllEventsCount($this->nativesession->get('id'),$this->nativesession->get('lastlogin'));
        $data['sidebar'] = 'teacher/teacher_sidebar';
        $data['topnavigation'] = 'teacher/teacher_topnavigation';
        $data['teachers'] = $this->Teacher_model->getAllTeacher();
        $data['coursesList'] = $this->Teacher_model->getAllCourses();
        $data['assign'] = $this->Teacher_model->getAllScheduleSetting();
        $data['content'] = 'teacher/create_schedule_view';
        $this->load->view($this->template, $data);
    }

    public function addScheduleSetting(){
        $this->form_validation->set_rules('teacher', 'Teacher', 'required');
        $this->form_validation->set_rules('course', 'Course', 'required');
        $this->form_validation->set_rules('frequency', 'Frequency', 'required');
        $this->form_validation->set_error_delimiters('', '<br/>');

        if ($this->form_validation->run() == TRUE) {
            $tid = $this->input->post('teacher');
            $cid = $this->input->post('course');
            $frequency = $this->input->post('frequency');

            $i = 0;
            for($g=1; $g<14; $g++){
                $thisgrade = $g;
                if($thisgrade == '10'){
                    $thisgrade = 'A';
                }
                elseif($thisgrade == '11'){
                    $thisgrade = 'B';
                }
                elseif($thisgrade == '12'){
                    $thisgrade = 'C';
                }
                elseif($thisgrade == '13'){
                    $thisgrade = 'D';
                }
                $allschedule = $this->Teacher_model->getAllFrequencyForGrade($thisgrade);
                
                $totalperiod = 0;
                if($allschedule){
                    foreach ($allschedule as $s){
                        $totalperiod = $totalperiod + $s['frequency'];
                    }

                    $addedperiod = $totalperiod + $frequency;

                    $day = $this->Teacher_model->getSetting('s0005');
                    $period = $this->Teacher_model->getSetting('s0006');
                    $periodcount = $day['value']*$period['value'];


                    if($addedperiod > $periodcount){
                        $periodallowed[$i]['grade'] = $g;
                        $periodallowed[$i]['count'] = $periodcount - $totalperiod;
                        $i++;
                    }
                }
            }

            $message = '';
            if(isset($periodallowed)) {
                foreach ($periodallowed as $p) {
                    $message .= 'Total period for grade ' . $p['grade'] . ' exceed limit, ' . $p['count'] . ' more period allowed</br>';
                }
            }

            if(isset($periodallowed)){
                $this->nativesession->set('error', $message);
                redirect('teacher/createSchedule');
            }

            $workinghour = $this->Teacher_model->getWorkingHour($tid);
            $workinghourList = explode('|', $workinghour['workinghour']);
            $workinghourcount = 0;
            foreach ($workinghourList as $w){
                $workinghourcount = $workinghourcount + $w;
            }

            $teachingfrequency = $this->Teacher_model->getTeachingFrequency($tid);
            $frequencycount = 0;
            foreach ($teachingfrequency as $f){
                $frequencycount = $frequencycount + $f['frequency'];
            }
            $addedfrequencycount = $frequencycount + $frequency;
            $frequencyallowed = $workinghourcount - $frequencycount;

            if($addedfrequencycount > $workinghourcount){
                $this->nativesession->set('error', 'Teacher working hour not enough, '.$frequencyallowed.' more frequency allowed');
                redirect('teacher/createSchedule');
            }

            $gradeList = $this->input->post('grade');
//            $grade = implode("|", $gradeList);
            $grade = '';
            for($i=0;$i<sizeof($gradeList);$i++)
            {
                $g = $gradeList[$i];
                if($g == '10'){
                    $g = 'A';
                }
                elseif($g == '11'){
                    $g = 'B';
                }
                elseif($g == '12'){
                    $g = 'C';
                }
                elseif($g == '13'){
                    $g = 'D';
                }
                $grade = $grade.'|'.$g;
            }
            
            $latestID = $this->Teacher_model->getScheduleSettingLatestID();
            $latestID = $latestID['scid'];
            $latestID = substr($latestID, 1);
            $latestID = 's'.str_pad((int) $latestID+1, 4, "0", STR_PAD_LEFT);
            $this->Teacher_model->addScheduleSetting($latestID, $tid, $cid, $grade, $frequency);
            $this->nativesession->set('success', 'Schedule Assign saved');
            redirect('teacher/createSchedule');
        }
    }

    public function deleteScheduleSetting($id){
        $id = $this->general->decryptParaID($id, 'schedulesetting');
        if($this->Teacher_model->deleteScheduleSetting($id)){
            $this->nativesession->set('success', 'Schedule Setting Deleted');
        }
        else{
            $this->nativesession->set('error', 'Failed to Delete Schedule Setting');
        }
        redirect('teacher/createSchedule');
    }

    public function generateSchedule()
    {
        $day = $this->Teacher_model->getSetting('s0005');
        $period = $this->Teacher_model->getSetting('s0006');

        $done = false;
        $retry = true;

        while($done == false){
            if($retry == true){
                $grade1 = $this->Teacher_model->getAllCourseForGrade(1);
                $grade2 = $this->Teacher_model->getAllCourseForGrade(2);
                $grade3 = $this->Teacher_model->getAllCourseForGrade(3);
                $grade4 = $this->Teacher_model->getAllCourseForGrade(4);
                $grade5 = $this->Teacher_model->getAllCourseForGrade(5);
                $grade6 = $this->Teacher_model->getAllCourseForGrade(6);
                $grade7 = $this->Teacher_model->getAllCourseForGrade(7);
                $grade8 = $this->Teacher_model->getAllCourseForGrade(8);
                $grade9 = $this->Teacher_model->getAllCourseForGrade(9);
                $grade10 = $this->Teacher_model->getAllCourseForGrade('A');
                $grade11 = $this->Teacher_model->getAllCourseForGrade('B');
                $grade12 = $this->Teacher_model->getAllCourseForGrade('C');
                $grade13 = $this->Teacher_model->getAllCourseForGrade('D');

                $table1 = null;
                $table2 = null;
                $table3 = null;
                $table4 = null;
                $table5 = null;
                $table6 = null;
                $table7 = null;
                $table8 = null;
                $table9 = null;
                $table10 = null;
                $table11 = null;
                $table12 = null;
                $table13 = null;

                $retry = false;
            }
            else{
                for($i=1; $i<14; $i++){
                    if(isset(${'grade'.$i})){
                        for($a=0; $a<$period['value']; $a++){
                            for($b=0; $b<$day['value']; $b++){
                                $availablecourse = ${'grade'.$i};
                                $availablecourseExist = false;

                                for($j=1; $j<$i; $j++){
                                    $currentindex = 0;
                                    foreach ($availablecourse as $available){
                                        if(isset(${'table'.$j}[$a][$b]) && ${'table'.$j}[$a][$b]['teacherid'] == $available['teacherid']){
                                            unset($availablecourse[$currentindex]);
                                            $availablecourse = array_values($availablecourse);
                                            $availablecourseExist = true;
                                        }
                                        $currentindex++;
                                    }
                                }

                                for($c=0; $c<$a; $c++){
                                    $currentindex = 0;
                                    foreach ($availablecourse as $available){
                                        if(isset(${'table'.$i}[$c][$b]) && ${'table'.$i}[$c][$b]['courseid'] == $available['courseid']){
                                            unset($availablecourse[$currentindex]);
                                            $availablecourse = array_values($availablecourse);
                                            $availablecourseExist = true;
                                        }
                                        $currentindex++;
                                    }
                                }

                                $allteacher = $this->Teacher_model->getAllTeacher();
                                foreach ($allteacher as $t) {
                                    $worktimestring = substr($t['workinghour'], 1, strlen($t['workinghour']));
                                    $worktime = explode('|', $worktimestring);
                                    if(isset($worktime[$a*$day['value']*$b]) && $worktime[$a*$day['value']*$b] == '0'){
                                        $currentindex = 0;
                                        foreach ($availablecourse as $available){
                                            if($t['teacherid'] == $available['teacherid']){
                                                unset($availablecourse[$currentindex]);
                                                $availablecourse = array_values($availablecourse);
                                                $availablecourseExist = true;
                                            }
                                            $currentindex++;
                                        }
                                    }
                                }

                                if(isset($availablecourse[0]) && $availablecourseExist == true){
                                    $size = count($availablecourse);
                                    $index = rand(0, $size-1);

                                    ${'table'.$i}[$a][$b]['courseid'] = $availablecourse[$index]['courseid'];
                                    ${'table'.$i}[$a][$b]['teacherid'] = $availablecourse[$index]['teacherid'];
                                    ${'table'.$i}[$a][$b]['coursename'] = $availablecourse[$index]['coursename'];
                                    ${'table'.$i}[$a][$b]['teachername'] = $availablecourse[$index]['firstname'].' '.$availablecourse[$index]['lastname'];

                                    foreach (${'grade'.$i} as $initial){
                                        if($initial['scid'] == $availablecourse[$index]['scid']){
                                            $initial['frequency'] = $initial['frequency'] - 1;
                                            if($initial['frequency'] == 0){
                                                unset($initial);
                                                ${'grade'.$i} = array_values(${'grade'.$i});
                                            }
                                        }
                                    }
                                }
                                else{
                                    $size = count(${'grade'.$i});
                                    $index = rand(0, $size-1);

                                    ${'table'.$i}[$a][$b]['courseid'] = ${'grade'.$i}[$index]['courseid'];
                                    ${'table'.$i}[$a][$b]['teacherid'] = ${'grade'.$i}[$index]['teacherid'];
                                    ${'table'.$i}[$a][$b]['coursename'] = ${'grade'.$i}[$index]['coursename'];
                                    ${'table'.$i}[$a][$b]['teachername'] = ${'grade'.$i}[$index]['firstname'].' '.${'grade'.$i}[$index]['lastname'];
                                    ${'table'.$i}[$a][$b]['conflict'] = 1;
                                    ${'grade'.$i}[$index]['frequency'] = ${'grade'.$i}[$index]['frequency'] - 1;
                                    if(${'grade'.$i}[$index]['frequency'] == 0){
                                        unset(${'grade'.$i}[$index]);
                                        ${'grade'.$i} = array_values(${'grade'.$i});
                                    }
                                }
                            }
                        }
                    }
                }
                $done = true;
            }
        }

        $data['g1'] = $table1;
        $data['g2'] = $table2;
        $data['g3'] = $table3;
        $data['g4'] = $table4;
        $data['g5'] = $table5;
        $data['g6'] = $table6;
        $data['g7'] = $table7;
        $data['g8'] = $table8;
        $data['g9'] = $table9;
        $data['g10'] = $table10;
        $data['g11'] = $table11;
        $data['g12'] = $table12;
        $data['g13'] = $table13;


        $data['day'] = $this->Teacher_model->getSetting('s0005');
        $data['period'] = $this->Teacher_model->getSetting('s0006');
        $data['hour'] = $this->Teacher_model->getSetting('s0007');
        $data['starttime'] = $this->Teacher_model->getSetting('s0008');
        $data['breakstarttime'] = $this->Teacher_model->getSetting('s0009');
        $data['breaktime'] = $this->Teacher_model->getSetting('s0011');
        $data['lunchstarttime'] = $this->Teacher_model->getSetting('s0010');
        $data['lunchtime'] = $this->Teacher_model->getSetting('s0012');

        $data['title'] = 'SMS';
        $data['courses'] = $this->Teacher_model->getAllCoursesByTeacher($this->nativesession->get('id'));
        $data['eventnotif'] = $this->Teacher_model->getAllEventsCount($this->nativesession->get('id'),$this->nativesession->get('lastlogin'));
        $data['sidebar'] = 'teacher/teacher_sidebar';
        $data['topnavigation'] = 'teacher/teacher_topnavigation';
        $data['content'] = 'teacher/generate_schedule_view';
        $this->load->view($this->template, $data);
    }

    public function classScheduleView()
    {
        $data['title'] = 'SMS';
        $data['courses'] = $this->Teacher_model->getAllCoursesByTeacher($this->nativesession->get('id'));
        $data['eventnotif'] = $this->Teacher_model->getAllEventsCount($this->nativesession->get('id'),$this->nativesession->get('lastlogin'));
        $data['sidebar'] = 'teacher/teacher_sidebar';
        $data['topnavigation'] = 'teacher/teacher_topnavigation';
        $data['content'] = 'includes/class_schedule_view';
        $this->load->view($this->template, $data);
    }

    public function examScheduleView()
    {
        $data['title'] = 'SMS';
        $data['courses'] = $this->Teacher_model->getAllCoursesByTeacher($this->nativesession->get('id'));
        $data['eventnotif'] = $this->Teacher_model->getAllEventsCount($this->nativesession->get('id'),$this->nativesession->get('lastlogin'));
        $data['sidebar'] = 'teacher/teacher_sidebar';
        $data['topnavigation'] = 'teacher/teacher_topnavigation';
        $data['content'] = 'includes/exam_schedule_view';
        $this->load->view($this->template, $data);
    }

    public function studentView()
    {
        $data['title'] = 'SMS';
        $data['courses'] = $this->Teacher_model->getAllCoursesByTeacher($this->nativesession->get('id'));
        $data['eventnotif'] = $this->Teacher_model->getAllEventsCount($this->nativesession->get('id'),$this->nativesession->get('lastlogin'));
        $data['sidebar'] = 'teacher/teacher_sidebar';
        $data['topnavigation'] = 'teacher/teacher_topnavigation';
        $data['content'] = 'includes/students_view';
        $this->load->view($this->template, $data);
    }

    public function parentView()
    {
        $data['title'] = 'SMS';
        $data['courses'] = $this->Teacher_model->getAllCoursesByTeacher($this->nativesession->get('id'));
        $data['eventnotif'] = $this->Teacher_model->getAllEventsCount($this->nativesession->get('id'),$this->nativesession->get('lastlogin'));
        $data['sidebar'] = 'teacher/teacher_sidebar';
        $data['topnavigation'] = 'teacher/teacher_topnavigation';
        $data['content'] = 'includes/parents_view';
        $this->load->view($this->template, $data);
    }

    public function teacherView()
    {
        $data['title'] = 'SMS';
        $data['courses'] = $this->Teacher_model->getAllCoursesByTeacher($this->nativesession->get('id'));
        $data['eventnotif'] = $this->Teacher_model->getAllEventsCount($this->nativesession->get('id'),$this->nativesession->get('lastlogin'));
        $data['sidebar'] = 'teacher/teacher_sidebar';
        $data['topnavigation'] = 'teacher/teacher_topnavigation';
        $teachers = $this->Teacher_model->getAllTeacher();
        $i = 0;
        $j = 0;
        foreach ($teachers as $teacher) {
            if($found = $this->Teacher_model->checkTeacherHomeroom($teacher['teacherid'])){
                $twh[$i]['teacherid'] = $teacher['teacherid'];
                $twh[$i]['photo'] = $teacher['photo'];
                $twh[$i]['firstname'] = $teacher['firstname'];
                $twh[$i]['lastname'] = $teacher['lastname'];
                $twh[$i]['phone'] = $teacher['phone'];
                $twh[$i]['email'] = $teacher['email'];
                $twh[$i]['address'] = $teacher['address'];
                $twh[$i]['classroom'] = $found['classroom'];
                $i++;
            }
            else{
                $th[$j]['teacherid'] = $teacher['teacherid'];
                $th[$j]['photo'] = $teacher['photo'];
                $th[$j]['firstname'] = $teacher['firstname'];
                $th[$j]['lastname'] = $teacher['lastname'];
                $th[$j]['phone'] = $teacher['phone'];
                $th[$j]['email'] = $teacher['email'];
                $th[$j]['address'] = $teacher['address'];
                $j++;
            }
        }

        $data['teachers'] = $twh;
        $data['teachersWithoutHomeroom'] =  $th;
        $data['content'] = 'includes/teachers_view';
        $this->load->view($this->template, $data);
    }

    public function staffView()
    {
        $data['title'] = 'SMS';
        $data['courses'] = $this->Teacher_model->getAllCoursesByTeacher($this->nativesession->get('id'));
        $data['eventnotif'] = $this->Teacher_model->getAllEventsCount($this->nativesession->get('id'),$this->nativesession->get('lastlogin'));
        $data['sidebar'] = 'teacher/teacher_sidebar';
        $data['topnavigation'] = 'teacher/teacher_topnavigation';
        $data['content'] = 'includes/staff_view';
        $this->load->view($this->template, $data);
    }

    public function libraryView()
    {
        $data['title'] = 'SMS';
        $data['courses'] = $this->Teacher_model->getAllCoursesByTeacher($this->nativesession->get('id'));
        $data['eventnotif'] = $this->Teacher_model->getAllEventsCount($this->nativesession->get('id'),$this->nativesession->get('lastlogin'));
        $data['sidebar'] = 'teacher/teacher_sidebar';
        $data['topnavigation'] = 'teacher/teacher_topnavigation';
        $data['content'] = 'includes/libraries_view';
        $this->load->view($this->template, $data);
    }

    public function payment()
    {
        if($this->general->checkPrivilege($this->nativesession->get('role'), 'p0001') != 1){
            $this->nativesession->set('error', 'Access Denied');
            redirect('teacher/home');
        }
        $data['title'] = 'SMS';
        $data['courses'] = $this->Teacher_model->getAllCoursesByTeacher($this->nativesession->get('id'));
        $data['eventnotif'] = $this->Teacher_model->getAllEventsCount($this->nativesession->get('id'),$this->nativesession->get('lastlogin'));
        $data['sidebar'] = 'teacher/teacher_sidebar';
        $data['topnavigation'] = 'teacher/teacher_topnavigation';
        $data['content'] = 'includes/payments_view';
        $this->load->view($this->template, $data);
    }

    public function addEvent()
    {
        if($this->general->checkPrivilege($this->nativesession->get('role'), 'p0006') != 1){
            $this->nativesession->set('error', 'Access Denied');
            redirect('teacher/home');
        }
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('description', 'Description', 'required');
        $this->form_validation->set_rules('duedate', 'Date', 'required');
//        $this->form_validation->set_rules('participant[]', 'Participant', 'required');
        $this->form_validation->set_error_delimiters('', '<br/>');
        if ($this->form_validation->run() == TRUE) {
            $latestID = $this->Teacher_model->getEventLatestID();
            $latestID = $latestID['eventid'];
            $latestID = substr($latestID, 1);
            $latestID = 'v'.str_pad((int) $latestID+1, 4, "0", STR_PAD_LEFT);
            $participantList = $this->input->post('participant');
            $participant = '';
            for($i=0;$i<sizeof($participantList);$i++)
            {
                if($participantList[$i] == '0'){
                    $this->Teacher_model->addEvent($latestID, 0);
                    $notall = false;
                    break;
                }
                elseif($participantList[$i] == '1'){
                    $this->Teacher_model->addEvent($latestID, 1);
                    $notall = false;
                    break;
                }
                elseif($participantList[$i] == '3'){
                    $this->Teacher_model->addEvent($latestID, 2);
                    $notall = false;
                    break;
                }
                else{
                    $participant = $participant.'|'.$participantList[$i];
                    $notall = true;
                }
            }
            if($notall == true){
                $this->Teacher_model->addEvent($latestID, $participant);
                $this->nativesession->set('success', 'New Event Added '.$participant);
                redirect('teacher/eventList/');
            }

            $this->nativesession->set('success', 'New Event Added '.$participant);
            redirect('teacher/eventList/');
        }
        $data['title'] = 'SMS';
        $data['courses'] = $this->Teacher_model->getAllCoursesByTeacher($this->nativesession->get('id'));
        $data['eventnotif'] = $this->Teacher_model->getAllEventsCount($this->nativesession->get('id'),$this->nativesession->get('lastlogin'));
        $data['sidebar'] = 'teacher/teacher_sidebar';
        $data['topnavigation'] = 'teacher/teacher_topnavigation';
        $data['teachers'] = $this->Teacher_model->getAllTeacher();
        $data['students'] = $this->Teacher_model->getAllStudent();
        $data['images'] = $this->Teacher_model->getAllEventImages();
        $data['content'] = 'teacher/add_event_view';
        $this->load->view($this->template, $data);
    }

    public function addEventImage($id = null)
    {
        if (empty($_FILES['userfile']['name'])){
            $this->nativesession->set('error', 'Image is required');
            if($id == null){
                redirect('teacher/addEvent');
            }
            redirect('teacher/editEvent/'.$id);
        }
        else{
            $latestID = $this->Teacher_model->getEventImageLatestID();
            $latestID = $latestID['eiid'];
            $latestID = substr($latestID, 1);
            $latestID = 'i'.str_pad((int) $latestID+1, 4, "0", STR_PAD_LEFT);
            if ($_FILES['userfile']['error'] != 4) {
                $config['upload_path'] = $this->eventimagepath;
                $config['allowed_types'] = "jpeg|jpg|png";
                $config['max_size'] = 200000;
                $config['overwrite'] = TRUE;
                $config['file_name'] = $latestID;
                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('userfile')) {
                    $this->nativesession->set('error', $this->upload->display_errors());
                    if($id == null){
                        redirect('teacher/addEvent');
                    }
                    redirect('teacher/editEvent/'.$id);
                } else {
                    if($data = $this->upload->data()){
                        $filename = $data['orig_name'];
                        $this->Teacher_model->addEventImage($latestID, $filename);
                        $this->nativesession->set('success', 'New Event Image Added');
                        if($id == null){
                            redirect('teacher/addEvent');
                        }
                        redirect('teacher/editEvent/'.$id);
                    }
                }
            }
        }
    }

    public function deleteEventImage($id, $eid = null){
        $id = $this->general->decryptParaID($id, 'eventimage');
        if($this->Teacher_model->deleteEventImage($id)){
            $this->nativesession->set('success', 'Event Image Deleted');
        }
        else{
            $this->nativesession->set('error', 'Failed to Delete Event Image');
        }
        if($eid == null){
            redirect('teacher/addEvent');
        }
        redirect('teacher/editEvent/'.$eid);
    }
    
    public function editEvent($id){
        if($this->general->checkPrivilege($this->nativesession->get('role'), 'p0007') != 1){
            $this->nativesession->set('error', 'Access Denied');
            redirect('teacher/home');
        }
        $id = $this->general->decryptParaID($id, 'event');
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('description', 'Description', 'required');
        $this->form_validation->set_rules('duedate', 'Date', 'required');
        $this->form_validation->set_error_delimiters('', '<br/>');
        if ($this->form_validation->run() == TRUE) {
            $this->Teacher_model->editEvent($id);

            $this->nativesession->set('success', 'Event Edited');
            redirect('teacher/eventList/');
        }
        $data['title'] = 'SMS';
        $data['courses'] = $this->Teacher_model->getAllCoursesByTeacher($this->nativesession->get('id'));
        $data['eventnotif'] = $this->Teacher_model->getAllEventsCount($this->nativesession->get('id'),$this->nativesession->get('lastlogin'));
        $data['sidebar'] = 'teacher/teacher_sidebar';
        $data['topnavigation'] = 'teacher/teacher_topnavigation';
        $data['event'] = $this->Teacher_model->getEvent($id);
        $data['images'] = $this->Teacher_model->getAllEventImages();
        $data['content'] = 'teacher/edit_event_view';
        $this->load->view($this->template, $data);
    }

    public function deleteEvent($id){
        if($this->general->checkPrivilege($this->nativesession->get('role'), 'p0007') != 1){
            $this->nativesession->set('error', 'Access Denied');
            redirect('teacher/home');
        }
        $id = $this->general->decryptParaID($id, 'event');
        if($this->Teacher_model->deleteEvent($id)){
            $this->nativesession->set('success', 'Event Deleted');
        }
        else{
            $this->nativesession->set('error', 'Failed to Delete Event');
        }
        redirect('teacher/eventList');
    }

    public function eventList()
    {
        $data['title'] = 'SMS';
        $data['courses'] = $this->Teacher_model->getAllCoursesByTeacher($this->nativesession->get('id'));
        $data['eventnotif'] = $this->Teacher_model->getAllEventsCount($this->nativesession->get('id'),$this->nativesession->get('lastlogin'));
        $data['sidebar'] = 'teacher/teacher_sidebar';
        $data['topnavigation'] = 'teacher/teacher_topnavigation';
        if($this->general->checkPrivilege($this->nativesession->get('role'), 'p0007') == 1){
            $data['info_dbs'] = $this->Teacher_model->getAllEventNoRestriction();
        }
        else{
            $data['info_dbs'] = $this->Teacher_model->getAllEvents($this->nativesession->get('id'));
        }
        $data['content'] = 'teacher/event_view';
        $this->load->view($this->template, $data);
    }

    public function eventDetail($id){
        $id = $this->general->decryptParaID($id, 'event');
        
        $data['title'] = 'SMS';
        $data['courses'] = $this->Teacher_model->getAllCoursesByTeacher($this->nativesession->get('id'));
        $data['eventnotif'] = $this->Teacher_model->getAllEventsCount($this->nativesession->get('id'),$this->nativesession->get('lastlogin'));
        $data['sidebar'] = 'teacher/teacher_sidebar';
        $data['topnavigation'] = 'teacher/teacher_topnavigation';
        $data['event'] = $this->Teacher_model->getEvent($id);
        $data['content'] = 'teacher/event_detail_view';
        $this->load->view($this->template, $data);
    }

    public function forms()
    {
        $data['title'] = 'SMS';
        $data['courses'] = $this->Teacher_model->getAllCoursesByTeacher($this->nativesession->get('id'));
        $data['eventnotif'] = $this->Teacher_model->getAllEventsCount($this->nativesession->get('id'),$this->nativesession->get('lastlogin'));
        $data['sidebar'] = 'teacher/teacher_sidebar';
        $data['topnavigation'] = 'teacher/teacher_topnavigation';
        $data['info_dbs'] = $this->Teacher_model->getAllForms();
        $data['content'] = 'includes/forms_view';
        $this->load->view($this->template, $data);
    }

    public function addForm()
    {
        if($this->general->checkPrivilege($this->nativesession->get('role'), 'p0011') != 1){
            $this->nativesession->set('error', 'Access Denied');
            redirect('teacher/home');
        }
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('description', 'Description', 'required');
        $this->form_validation->set_error_delimiters('', '<br/>');
        if ($this->form_validation->run() == TRUE) {
            if (empty($_FILES['userfile']['name'])){
                $this->nativesession->set('error', 'File is required');
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
                        $this->nativesession->set('error', $this->upload->display_errors());
                        redirect(current_url());
                    } else {
                        $data = $this->upload->data();
                        $filename = $data['orig_name'];
                        $this->Teacher_model->addForm($latestID, $filename);
                    }
                }
                $this->nativesession->set('success', 'New Form Added');
                redirect('teacher/forms/');
            }
        }
        
        $data['title'] = 'SMS';
        $data['courses'] = $this->Teacher_model->getAllCoursesByTeacher($this->nativesession->get('id'));
        $data['eventnotif'] = $this->Teacher_model->getAllEventsCount($this->nativesession->get('id'),$this->nativesession->get('lastlogin'));
        $data['sidebar'] = 'teacher/teacher_sidebar';
        $data['topnavigation'] = 'teacher/teacher_topnavigation';
        $data['content'] = 'includes/add_form_view';
        $this->load->view($this->template, $data);
    }

    public function editForm($id){
        if($this->general->checkPrivilege($this->nativesession->get('role'), 'p0012') != 1){
            $this->nativesession->set('error', 'Access Denied');
            redirect('teacher/home');
        }
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
                        $this->nativesession->set('error', $this->upload->display_errors());
                        redirect(current_url());
                    } else {
                        $data = $this->upload->data();
                        $filename = $data['orig_name'];
                        $this->Teacher_model->editFormWithFile($id, $filename);
                    }
                }
            }
            $this->nativesession->set('success', 'Form Edited');
            redirect('teacher/forms/');
        }

        $data['title'] = 'SMS';
        $data['courses'] = $this->Teacher_model->getAllCoursesByTeacher($this->nativesession->get('id'));
        $data['eventnotif'] = $this->Teacher_model->getAllEventsCount($this->nativesession->get('id'),$this->nativesession->get('lastlogin'));
        $data['sidebar'] = 'teacher/teacher_sidebar';
        $data['topnavigation'] = 'teacher/teacher_topnavigation';
        $data['form'] = $this->Teacher_model->getForm($id);
        $data['content'] = 'includes/edit_form_view';
        $this->load->view($this->template, $data);
    }

    public function deleteForm($id){
        if($this->general->checkPrivilege($this->nativesession->get('role'), 'p0012') != 1){
            $this->nativesession->set('error', 'Access Denied');
            redirect('teacher/home');
        }
        $id = $this->general->decryptParaID($id, 'form');
        if($this->Teacher_model->deleteForm($id)){
            $this->nativesession->set('success', 'Form Deleted');
        }
        else{
            $this->nativesession->set('error', 'Failed to Delete Form');
        }
        redirect('teacher/forms');
    }

    public function settings()
    {
        if($this->general->checkPrivilege($this->nativesession->get('role'), 'p0009') != 1){
            $this->nativesession->set('error', 'Access Denied');
            redirect('teacher/home');
        }
        $data['title'] = 'SMS';
        $data['courses'] = $this->Teacher_model->getAllCoursesByTeacher($this->nativesession->get('id'));
        $data['eventnotif'] = $this->Teacher_model->getAllEventsCount($this->nativesession->get('id'),$this->nativesession->get('lastlogin'));
        $data['sidebar'] = 'teacher/teacher_sidebar';
        $data['topnavigation'] = 'teacher/teacher_topnavigation';
        $data['info_dbs'] = $this->Teacher_model->getAllSettings();
        $data['content'] = 'teacher/teacher_settings_view';
        $this->load->view($this->template, $data);
    }

    public function requestItem()
    {
        $id = $this->nativesession->get('id');

//        $savebutton = $this->input->post('savebutton');
//        if($savebutton == 'itemrequest'){
//            $itemid = $this->input->post('itemid');
//            $number = $this->input->post('value');
//            for($i=0;$i<sizeof($itemid);$i++)
//            {
//                if($result = $this->Teacher_model->getAllRequestedByTeacher($itemid[$i], $id)){
//                    $this->Teacher_model->editRequestedItem($result['itemid'], $number[$i]);
//                }
//                else{
//                    $latestID = $this->Teacher_model->getRequestLatestID();
//                    $latestID = $latestID['requestid'];
//                    $latestID = substr($latestID, 1);
//                    $latestID = 'r'.str_pad((int) $latestID+1, 4, "0", STR_PAD_LEFT);
//                    $this->Teacher_model->addRequest($latestID, $itemid[$i], $id, $number[$i]);
//                }
//            }
//            $this->nativesession->set('success', 'Request Submitted');
//            redirect('teacher/requestItem/');
//        }

        $itemlist = $this->Teacher_model->getAllItems();
        $a = 0;
        $j = 0;
        foreach ($itemlist as $i){
            if($found = $this->Teacher_model->getAllRequestedByTeacher($i['itemid'], $id)){
                $request[$a]['itemid'] = $i['itemid'];
                $request[$a]['name'] = $i['name'];
                $request[$a]['value'] = $found['number'];
                $a++;
            }
            else{
                $items[$j]['itemid'] = $i['itemid'];
                $items[$j]['name'] = $i['name'];
                $j++;
            }
        }
        if(isset($items)){
            $data['items'] = $items;
        }
        if(isset($request)){
            $data['request'] = $request;
        }
        $data['requestbook'] = $this->Teacher_model->getAllBooksRequested($id);
        $data['requestfotocopy'] = $this->Teacher_model->getAllFotocopyRequested($id);
        $data['title'] = 'SMS';
        $data['courses'] = $this->Teacher_model->getAllCoursesByTeacher($this->nativesession->get('id'));
        $data['eventnotif'] = $this->Teacher_model->getAllEventsCount($this->nativesession->get('id'),$this->nativesession->get('lastlogin'));
        $data['sidebar'] = 'teacher/teacher_sidebar';
        $data['topnavigation'] = 'teacher/teacher_topnavigation';
        $data['content'] = 'teacher/teacher_request_item_view';
        $this->load->view($this->template, $data);
    }

    public function addRequestItem()
    {
        $id = $this->nativesession->get('id');
        
        $itemid = $this->input->post('itemid');
        $number = $this->input->post('value');
        for($i=0;$i<sizeof($itemid);$i++)
        {
            if($result = $this->Teacher_model->getAllRequestedByTeacher($itemid[$i], $id)){
                $this->Teacher_model->editRequestedItem($result['itemid'], $number[$i]);
            }
            else{
                if($number[$i] != null || $number[$i] != 0){
                    $latestID = $this->Teacher_model->getRequestLatestID();
                    $latestID = $latestID['requestid'];
                    $latestID = substr($latestID, 1);
                    $latestID = 'r'.str_pad((int) $latestID+1, 4, "0", STR_PAD_LEFT);
                    $this->Teacher_model->addRequest($latestID, $itemid[$i], $id, $number[$i]);
                }
            }
        }
        $this->nativesession->set('success', 'Request Submitted');
        redirect('teacher/requestItem/');
    }

    public function editBookRequest($id){
            $this->Teacher_model->editBookRequest($id);
            $this->nativesession->set('success', 'Book Request Edited');
            redirect('teacher/requestItem/');
    }

    public function addBookRequest()
    {
        $id = $this->nativesession->get('id');
        
        $this->form_validation->set_rules('isbn', 'ISBN', 'required');
        $this->form_validation->set_rules('name', 'Title', 'required');
        $this->form_validation->set_rules('value', 'Number', 'required');
        $this->form_validation->set_error_delimiters('', '<br/>');
        if ($this->form_validation->run() == TRUE) {
            $latestID = $this->Teacher_model->getBookRequestLatestID();
            $latestID = $latestID['brequestid'];
            $latestID = substr($latestID, 1);
            $latestID = 'b'.str_pad((int) $latestID+1, 4, "0", STR_PAD_LEFT);
            
            $this->Teacher_model->addBookRequest($latestID, $id);
                
            $this->nativesession->set('success', 'New Book Request Added');
            redirect('teacher/requestItem/');
        }else{
            redirect('teacher/requestItem/');
        }
    }

    public function editFotocopyRequest($id){
        $this->Teacher_model->editFotocopyRequest($id);
        $this->nativesession->set('success', 'Fotocopy Request Edited');
        redirect('teacher/requestItem/');
    }

    public function addFotocopyRequest()
    {
        $id = $this->nativesession->get('id');

        $this->form_validation->set_rules('isbn', 'ISBN', 'required');
        $this->form_validation->set_rules('name', 'Title', 'required');
        $this->form_validation->set_rules('value', 'Number', 'required');
        $this->form_validation->set_error_delimiters('', '<br/>');
        if ($this->form_validation->run() == TRUE) {
            $latestID = $this->Teacher_model->getFotocopyRequestLatestID();
            $latestID = $latestID['frequestid'];
            $latestID = substr($latestID, 1);
            $latestID = 'f'.str_pad((int) $latestID+1, 4, "0", STR_PAD_LEFT);

            $this->Teacher_model->addFotocopyRequest($latestID, $id);

            $this->nativesession->set('success', 'New Fotocopy Request Added');
            redirect('teacher/requestItem/');
        }else{
            redirect('teacher/requestItem/');
        }
    }
    
    public function editSetting($id){
        if($this->general->checkPrivilege($this->nativesession->get('role'), 'p0010') != 1){
            $this->nativesession->set('error', 'Access Denied');
            redirect('teacher/home');
        }
        $this->form_validation->set_rules('value', 'Value', 'required');
        $this->form_validation->set_error_delimiters('', '<br/>');
        if ($this->form_validation->run() == TRUE) {
                $this->Teacher_model->editSetting($id);
                $this->nativesession->set('success', 'Setting Edited');
                redirect('teacher/settings/');
        }
    }

    public function sendQnAEmailToAll($id, $qid){
        $id = $this->general->decryptParaID($id, 'courseassigned');
        $qid = $this->general->decryptParaID($qid, 'anq');

        $info = $this->Teacher_model->getCourseDataByAssignID($id);
        $qnainfo = $this->Teacher_model->getQnA($qid);
        $students = $this->Teacher_model->getStudentsByClassID($info['classid']);
        $emaillist = array();
        foreach ($students as $student) {
            if($found = $this->Teacher_model->checkNoSubmission($student['studentid'], $qid)){
            }
            else{
                array_push($emaillist, $student['email']);
            }
        }

        $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_port' => 465,
            'smtp_user' => 'healthybonefamily@gmail.com',
            'smtp_pass' => 'healthybonefamilycb4',
        );

        $this->load->library('email', $config);
        $this->email->set_newline('\r\n');
        $this->email->from('healthybonefamily@gmail.com', 'SMS');
        $this->email->to($emaillist);
        $this->email->subject($info['coursename'].' '.$qnainfo['type'].' Notification');
        $this->email->message('This is the notification for:
        Course : '.$info['coursename'].'
        Type : '.$qnainfo['type'].'
        Due Date : '.$qnainfo['duedate'].'');

        if($this->email->send())
            $this->nativesession->set("success","Email sent successfully.");
        else
            $this->nativesession->set("error",$this->email->print_debugger());

        $eid = $this->general->encryptParaID($id, 'courseassigned');
        $qid = $this->general->encryptParaID($qid, 'anq');
        redirect('teacher/courseAssignmentQuizSubmission/'.$eid.'/'.$qid);

        return TRUE;
    }

    public function sendQnAEmail($sid, $qid)
    {
        $sid = $this->general->decryptParaID($sid, 'student');
        $qid = $this->general->decryptParaID($qid, 'anq');


        $qnainfo = $this->Teacher_model->getQnA($qid);
        $assign = $this->Teacher_model->getAssignDataByQuizID($qid);
        $info = $this->Teacher_model->getCourseDataByAssignID($assign['assignid']);
        $student = $this->Teacher_model->getStudentDataByStudentID($sid);

        $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_port' => 465,
            'smtp_user' => 'healthybonefamily@gmail.com',
            'smtp_pass' => 'healthybonefamilycb4',
        );
        
          $this->load->library('email', $config);
          $this->email->set_newline('\r\n');
          $this->email->from('healthybonefamily@gmail.com', 'SMS');
          $this->email->to($student['email']);
            $this->email->subject($info['coursename'].' '.$qnainfo['type'].' Notification');
            $this->email->message('This is the notification for:
            Course : '.$info['coursename'].'
            Type : '.$qnainfo['type'].'
            Due Date : '.$qnainfo['duedate'].'');

            if($this->email->send())
                $this->nativesession->set("success","Email sent successfully.");
            else
                $this->nativesession->set("error",$this->email->print_debugger());

            $eid = $this->general->encryptParaID($assign['assignid'], 'courseassigned');
            $qid = $this->general->encryptParaID($qid, 'anq');
            redirect('teacher/courseAssignmentQuizSubmission/'.$eid.'/'.$qid);

        return TRUE;

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