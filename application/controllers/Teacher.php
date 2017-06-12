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
        $this->load->model('Student_model');
        $this->load->model('Admin_model');
        $this->load->model('Operation_model');
    }

    public function home()
    {
        $today = date('l', now());
        $today = date('N', strtotime($today))-1;

        $data['day'] = $this->Teacher_model->getSetting('s0005');
        $data['period'] = $this->Teacher_model->getSetting('s0006');
        $data['hour'] = $this->Teacher_model->getSetting('s0007');
        $data['starttime'] = $this->Teacher_model->getSetting('s0008');
        $data['breakstarttime'] = $this->Teacher_model->getSetting('s0009');
        $data['breaktime'] = $this->Teacher_model->getSetting('s0011');
        $data['lunchstarttime'] = $this->Teacher_model->getSetting('s0010');
        $data['lunchtime'] = $this->Teacher_model->getSetting('s0012');

        $data['schedule'] = $this->Teacher_model->getAllScheduleOfTeacherOfDay($this->nativesession->get('id'), $today);
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
        $class = explode('_', $class['classroom']);

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
        $class = explode('_', $class['classroom']);

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
        $class = explode('_', $class['classroom']);
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
        $class = explode('_', $class['classroom']);
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
//        $this->form_validation->set_rules('password', 'password', 'required');
//        $this->form_validation->set_rules('confirmpassword', 'confirm password', 'required|matches[password]');
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
        $data['rolechoice'] = $this->Teacher_model->getRoleCategory(1);
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
                redirect('teacher/courseView/s'.$id);
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

    public function deleteMaterial($id, $eid){
        if($this->Teacher_model->deleteMaterial($id)){
            $this->nativesession->set('success', 'Material Deleted');
        }
        else{
            $this->nativesession->set('error', 'Failed to Delete Material');
        }
        redirect('teacher/courseMaterial/'.$eid);
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


                $this->nativesession->set('success', 'New File Added');
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

    public function deleteQnA($id, $qid){
        $qid = $this->general->decryptParaID($qid, 'anq');
        if($this->Teacher_model->deleteQnA($qid)){
            $this->Teacher_model->deleteQnAScore($qid);
            $this->nativesession->set('success', 'Quiz or Assignment Deleted');
        }
        else{
            $this->nativesession->set('error', 'Failed to Delete Quiz or Assignment');
        }
        redirect('teacher/courseAssignmentQuiz/'.$id);
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

        $a = $this->Teacher_model->getSetting('s0014');
        $amin = $this->Teacher_model->getSetting('s0015');
        $b = $this->Teacher_model->getSetting('s0016');
        $bplus = $this->Teacher_model->getSetting('s0017');
        $bmin = $this->Teacher_model->getSetting('s0018');
        $c = $this->Teacher_model->getSetting('s0019');
        $cplus = $this->Teacher_model->getSetting('s0020');
        $d = $this->Teacher_model->getSetting('s0021');

        $homeworkevaluation = $this->Teacher_model->getSetting('s0022');
        $classworkevaluation = $this->Teacher_model->getSetting('s0023');
        $assessmentevaluation = $this->Teacher_model->getSetting('s0024');
        $examevaluation = $this->Teacher_model->getSetting('s0025');


        $homeworkscore = 0;
        $homework = $this->Teacher_model->getAllQnAByStudent($studentid, $assignid, 1);
        if($homework){
            foreach ($homework as $h){
                $homeworkscore = $homeworkscore + $h['score'];
            }
            $homeworkscore = $homeworkscore/sizeof($homework);
            $homeworkscore = $homeworkscore * $homeworkevaluation['value'] / 100;
        }

        $classworkscore = 0;
        $classwork = $this->Teacher_model->getAllQnAByStudent($studentid, $assignid, 2);
        if($classwork){
            foreach ($classwork as $h){
                $classworkscore = $classworkscore + $h['score'];
            }
            $classworkscore = $classworkscore/sizeof($classwork);
            $classworkscore = $classworkscore * $classworkevaluation['value'] / 100;
        }

        $assessmentscore = 0;
        $assessment = $this->Teacher_model->getAllQnAByStudent($studentid, $assignid, 3);
        if($assessment){
            foreach ($assessment as $h){
                $assessmentscore = $assessmentscore + $h['score'];
            }
            $assessmentscore = $assessmentscore/sizeof($assessment);
            $assessmentscore = $assessmentscore * $assessmentevaluation['value'] / 100;
        }

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
//            $this->form_validation->set_rules('grade', 'Mid Term Course Grade', 'required');
            $this->form_validation->set_rules('comment', 'Mid Term Comment', 'required');
            $this->form_validation->set_error_delimiters('', '<br/>');

            if ($this->form_validation->run() == TRUE) {
                if($result = $this->Teacher_model->checkReport($assignid, $studentid, 1)){
                    $examscore = $this->input->post('mark') * $examevaluation['value'] / 100;
                    $totalscore = $homeworkscore + $classworkscore + $assessmentscore + $examscore;
                    if($totalscore >= $a['value']){
                        $grade = 'A';
                    }
                    elseif($totalscore >= $amin['value'] && $totalscore < $a['value']){
                        $grade = 'A-';
                    }
                    elseif($totalscore >= $bplus['value'] && $totalscore < $amin['value']){
                        $grade = 'B+';
                    }
                    elseif($totalscore >= $b['value'] && $totalscore < $bplus['value']){
                        $grade = 'B';
                    }
                    elseif($totalscore >= $bmin['value'] && $totalscore < $b['value']){
                        $grade = 'B-';
                    }
                    elseif($totalscore >= $cplus['value'] && $totalscore < $bmin['value']){
                        $grade = 'C+';
                    }
                    elseif($totalscore >= $c['value'] && $totalscore < $cplus['value']){
                        $grade = 'C';
                    }
                    elseif($totalscore >= $d['value'] && $totalscore < $c['value']){
                        $grade = 'D';
                    }
                    elseif($totalscore < $d['value']){
                        $grade = 'E';
                    }
                    $this->Teacher_model->editMidReport($result['reportid'], $grade);
                    $this->nativesession->set('success', 'Report saved');
                }
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
//            $this->form_validation->set_rules('grade', 'Mid Term Course Grade', 'required');
            $this->form_validation->set_rules('comment', 'Mid Term Comment', 'required');
            $this->form_validation->set_error_delimiters('', '<br/>');

            if ($this->form_validation->run() == TRUE) {
                if($result = $this->Teacher_model->checkReport($assignid, $studentid, 2)){
                    $examscore = $this->input->post('fmark') * $examevaluation['value'] / 100;
                    $totalscore = $homeworkscore + $classworkscore + $assessmentscore + $examscore;
                    if($totalscore >= $a['value']){
                        $grade = 'A';
                    }
                    elseif($totalscore >= $amin['value'] && $totalscore < $a['value']){
                        $grade = 'A-';
                    }
                    elseif($totalscore >= $bplus['value'] && $totalscore < $amin['value']){
                        $grade = 'B+';
                    }
                    elseif($totalscore >= $b['value'] && $totalscore < $bplus['value']){
                        $grade = 'B';
                    }
                    elseif($totalscore >= $bmin['value'] && $totalscore < $b['value']){
                        $grade = 'B-';
                    }
                    elseif($totalscore >= $cplus['value'] && $totalscore < $bmin['value']){
                        $grade = 'C+';
                    }
                    elseif($totalscore >= $c['value'] && $totalscore < $cplus['value']){
                        $grade = 'C';
                    }
                    elseif($totalscore >= $d['value'] && $totalscore < $c['value']){
                        $grade = 'D';
                    }
                    elseif($totalscore < $d['value']){
                        $grade = 'E';
                    }
                    $this->Teacher_model->editFinalReport($result['reportid'], $grade);
                    $this->nativesession->set('success', ''.$totalscore.' '.$homeworkscore.' '.''.$classworkscore.' '.$assessmentscore.' '.$examscore.'');
                }
            }
            redirect('teacher/courseStudentPerformance/'.$eid.'/'.$esid);
        }

        $data['homework'] = $this->Teacher_model->getAllQnAByStudent($studentid, $assignid, 1);
        $data['classwork'] = $this->Teacher_model->getAllQnAByStudent($studentid, $assignid, 2);
        $data['assessment'] = $this->Teacher_model->getAllQnAByStudent($studentid, $assignid, 3);
        
        
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

    public function createSchedule()
    {
        $assign = $this->Teacher_model->getAllScheduleSetting();
        $i = 0;
        foreach ($assign as $c){
            $gradeList = explode('|', substr($c['grade'], 1, strlen($c['grade'])));
            $gradeName = '';
            foreach ($gradeList as $t){
                $grade = $this->Teacher_model->getClassByClassid($t);
                $g = $grade['classroom'];
                $gradeName = $gradeName.'|'.$g;
            }
            $assign[$i]['grade'] = $gradeName;
            $i++;
        }

//        $collaborative = $this->Teacher_model->getAllCollaborativeScheduleSetting();
//        $i = 0;
//        foreach ($collaborative as $c){
//            $teacherList = explode('|', substr($c['teacherid'], 1, strlen($c['teacherid'])));
//            $teacherName = '';
//            foreach ($teacherList as $t){
//                $teacher = $this->Teacher_model->getProfileDataByID($t);
//                $g = $teacher['firstname'].' '.$teacher['lastname'];
//                $teacherName = $teacherName.'|'.$g;
//            }
//            $collaborative[$i]['teacher'] = $teacherName;
//
//            $gradeList = explode('|', substr($c['grade'], 1, strlen($c['grade'])));
//            $gradeName = '';
//            foreach ($gradeList as $t){
//                $grade = $this->Teacher_model->getClassByClassid($t);
//                $g = $grade['classroom'];
//                $gradeName = $gradeName.'|'.$g;
//            }
//            $collaborative[$i]['grade'] = $gradeName;
//
//            $room = $this->Teacher_model->getClassByClassid($c['room']);
//            $collaborative[$i]['room'] = $room['classroom'];
//            $i++;
//        }
//        $elective = $this->Teacher_model->getAllElectiveScheduleSetting();
//        $i = 0;
//        foreach ($elective as $c){
//            $teacherList = explode('|', substr($c['teacherid'], 1, strlen($c['teacherid'])));
//            $teacherName = '';
//            foreach ($teacherList as $t){
//                $teacher = $this->Teacher_model->getProfileDataByID($t);
//                $g = $teacher['firstname'].' '.$teacher['lastname'];
//                $teacherName = $teacherName.'|'.$g;
//            }
//            $elective[$i]['teacher'] = $teacherName;
//
//            $courseList = explode('|', substr($c['courseid'], 1, strlen($c['courseid'])));
//            $courseName = '';
//            foreach ($courseList as $t){
//                $course = $this->Teacher_model->getCourseDataByID($t);
//                $g = $course['coursename'];
//                $courseName = $courseName.'|'.$g;
//            }
//            $elective[$i]['course'] = $courseName;

//            $gradeList = explode('|', substr($c['grade'], 1, strlen($c['grade'])));
//            $gradeName = '';
//            foreach ($gradeList as $t){
//                $grade = $this->Teacher_model->getClassByClassid($t);
//                $g = $grade['classroom'];
//                $gradeName = $gradeName.'|'.$g;
//            }
//            $elective[$i]['grade'] = $gradeName;
//
//            $roomList = explode('|', substr($c['room'], 1, strlen($c['room'])));
//            $roomName = '';
//            foreach ($roomList as $t){
//                $room = $this->Teacher_model->getClassByClassid($t);
//                $g = $room['classroom'];
//                $roomName = $roomName.'|'.$g;
//            }
//            $elective[$i]['room'] = $roomName;
//            $i++;
//        }
//        $special = array_merge($collaborative, $elective);
//        $data['special'] = $special;
        $data['assign'] = $assign;
        $data['title'] = 'SMS';
        $data['courses'] = $this->Teacher_model->getAllCoursesByTeacher($this->nativesession->get('id'));
        $data['eventnotif'] = $this->Teacher_model->getAllEventsCount($this->nativesession->get('id'),$this->nativesession->get('lastlogin'));
        $data['sidebar'] = 'teacher/teacher_sidebar';
        $data['topnavigation'] = 'teacher/teacher_topnavigation';
        $data['teachers'] = $this->Teacher_model->getAllTeacher();
        $data['coursesList'] = $this->Teacher_model->getAllCourses();
        $data['classes'] = $this->Teacher_model->getAllClassesOfType(0);
//        $data['room'] = $this->Teacher_model->getAllClassesOfType(1);
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
//            for($g=1; $g<14; $g++){
            $gradeList = $this->input->post('grade');
            for($i=0;$i<sizeof($gradeList);$i++)
            {
                $thisgrade = $gradeList[$i];
//                if($thisgrade == '10'){
//                    $thisgrade = 'A';
//                }
//                elseif($thisgrade == '11'){
//                    $thisgrade = 'B';
//                }
//                elseif($thisgrade == '12'){
//                    $thisgrade = 'C';
//                }
//                elseif($thisgrade == '13'){
//                    $thisgrade = 'D';
//                }
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
                        $classname = $this->Teacher_model->getClassByClassid($gradeList[$i]);
                        $periodallowed[$i]['grade'] = $classname['classroom'];
                        $periodallowed[$i]['count'] = $periodcount - $totalperiod;
//                        $i++;
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
                $grade = $grade.'|'.$g;
            }
            
            $latestID = $this->Teacher_model->getScheduleSettingLatestID();
            $latestID = $latestID['scid'];
            $latestID = substr($latestID, 1);
            $latestID = 's'.str_pad((int) $latestID+1, 4, "0", STR_PAD_LEFT);
            $this->Teacher_model->addScheduleSetting($latestID, $tid, $cid, $grade, $frequency, 0, 0);
            $this->nativesession->set('success', 'Schedule Assign saved');
            redirect('teacher/createSchedule');
        }
        else{
            $this->nativesession->set('error', 'All field required');
            redirect('teacher/createSchedule');
        }
    }

    public function addCollaborativeScheduleSetting(){
        $this->form_validation->set_rules('course', 'Course', 'required');
        $this->form_validation->set_rules('room', 'Room', 'required');
        $this->form_validation->set_rules('frequency', 'Frequency', 'required');
        $this->form_validation->set_error_delimiters('', '<br/>');

        if ($this->form_validation->run() == TRUE) {
            $teacherList = $this->input->post('teacher');
            $cid = $this->input->post('course');
            $frequency = $this->input->post('frequency');

            $i = 0;
//            for($g=1; $g<14; $g++){
            $gradeList = $this->input->post('grade');
            for($i=0;$i<sizeof($gradeList);$i++)
            {
                $thisgrade = $gradeList[$i];
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
                        $classname = $this->Teacher_model->getClassByClassid($gradeList[$i]);
                        $periodallowed[$i]['grade'] = $classname['classroom'];
                        $periodallowed[$i]['count'] = $periodcount - $totalperiod;
//                        $i++;
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

            for($i=0;$i<sizeof($teacherList);$i++)
            {
                $tid = $teacherList[$i];
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
                    $fallowed[$i]['allowed'] = $frequencyallowed;
                }
            }

            $message = '';
            if(isset($fallowed)) {
                foreach ($fallowed as $p) {
                    $message .= 'Teacher working hour not enough, '.$p['allowed'].' more frequency allowed</br>';
                }
            }

            if(isset($fallowed)){
                $this->nativesession->set('error', $message);
                redirect('teacher/createSchedule');
            }


            $gradeList = $this->input->post('grade');
            $grade = '';
            for($i=0;$i<sizeof($gradeList);$i++)
            {
                $g = $gradeList[$i];
                $grade = $grade.'|'.$g;
            }

            $teacherList = $this->input->post('teacher');
            $tid = '';
            for($i=0;$i<sizeof($teacherList);$i++)
            {
                $t = $teacherList[$i];
                $tid = $tid.'|'.$t;
            }

            $latestID = $this->Teacher_model->getScheduleSettingLatestID();
            $latestID = $latestID['scid'];
            $latestID = substr($latestID, 1);
            $latestID = 's'.str_pad((int) $latestID+1, 4, "0", STR_PAD_LEFT);
            $this->Teacher_model->addScheduleSetting($latestID, $tid, $cid, $grade, $frequency, 1, $this->input->post('room'));
            $this->nativesession->set('success', 'Schedule Assign saved');
            redirect('teacher/createSchedule');
        }
        else{
            $this->nativesession->set('error', 'All field required');
            redirect('teacher/createSchedule');
        }
    }

    public function addElectiveScheduleSetting(){
        $this->form_validation->set_rules('frequency', 'Frequency', 'required');
        $this->form_validation->set_error_delimiters('', '<br/>');

        if ($this->form_validation->run() == TRUE) {
            $teacherList = $this->input->post('teacher');
            $courseList = $this->input->post('course');
            $frequency = $this->input->post('frequency');
            $roomList = $this->input->post('room');

            if(sizeof($teacherList) == sizeof($courseList) && sizeof($courseList) == sizeof($roomList)){

                $i = 0;
    //            for($g=1; $g<14; $g++){
                $gradeList = $this->input->post('grade');
                for($i=0;$i<sizeof($gradeList);$i++)
                {
                    $thisgrade = $gradeList[$i];
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
                            $classname = $this->Teacher_model->getClassByClassid($gradeList[$i]);
                            $periodallowed[$i]['grade'] = $classname['classroom'];
                            $periodallowed[$i]['count'] = $periodcount - $totalperiod;
    //                        $i++;
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

                for($i=0;$i<sizeof($teacherList);$i++)
                {
                    $tid = $teacherList[$i];
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
                        $fallowed[$i]['allowed'] = $frequencyallowed;
                    }
                }

                $message = '';
                if(isset($fallowed)) {
                    foreach ($fallowed as $p) {
                        $message .= 'Teacher working hour not enough, '.$p['allowed'].' more frequency allowed</br>';
                    }
                }

                if(isset($fallowed)){
                    $this->nativesession->set('error', $message);
                    redirect('teacher/createSchedule');
                }


                $gradeList = $this->input->post('grade');
                $grade = '';
                for($i=0;$i<sizeof($gradeList);$i++)
                {
                    $g = $gradeList[$i];
                    $grade = $grade.'|'.$g;
                }

                $teacherList = $this->input->post('teacher');
                $tid = '';
                for($i=0;$i<sizeof($teacherList);$i++)
                {
                    $t = $teacherList[$i];
                    $tid = $tid.'|'.$t;
                }

                $cid = '';
                for($i=0;$i<sizeof($courseList);$i++)
                {
                    $c = $courseList[$i];
                    $cid = $cid.'|'.$c;
                }

                $rid = '';
                for($i=0;$i<sizeof($roomList);$i++)
                {
                    $c = $roomList[$i];
                    $rid = $rid.'|'.$c;
                }

                $latestID = $this->Teacher_model->getScheduleSettingLatestID();
                $latestID = $latestID['scid'];
                $latestID = substr($latestID, 1);
                $latestID = 's'.str_pad((int) $latestID+1, 4, "0", STR_PAD_LEFT);
                $this->Teacher_model->addScheduleSetting($latestID, $tid, $cid, $grade, $frequency, 2, $rid);
                $this->nativesession->set('success', 'Schedule Assign saved');
                redirect('teacher/createSchedule');
            }else{
                $this->nativesession->set('error', 'Number of teacher, course and room should be the same');
                redirect('teacher/createSchedule');
            }

        }
        else{
            $this->nativesession->set('error', 'All field required');
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

        $allclass = $this->Teacher_model->getAllClasses();
        $tablecount = 1;
        foreach ($allclass as $class) {
            ${"table" . $tablecount} = array('');
            ${"grade" . $class['classroom']} = $this->Teacher_model->getAllCourseForGrade($class['classid']);
            $tablecount++;
        }

        $schedule = array('');

//        $done = false;
//        $retry = true;

//        while($done == false){
//            if($retry == true){
//                $grade1 = $this->Teacher_model->getAllCourseForGrade(1);
//                $grade2 = $this->Teacher_model->getAllCourseForGrade(2);
//                $grade3 = $this->Teacher_model->getAllCourseForGrade(3);
//                $grade4 = $this->Teacher_model->getAllCourseForGrade(4);
//                $grade5 = $this->Teacher_model->getAllCourseForGrade(5);
//                $grade6 = $this->Teacher_model->getAllCourseForGrade(6);
//                $grade7 = $this->Teacher_model->getAllCourseForGrade(7);
//                $grade8 = $this->Teacher_model->getAllCourseForGrade(8);
//                $grade9 = $this->Teacher_model->getAllCourseForGrade(9);
//                $grade10 = $this->Teacher_model->getAllCourseForGrade('A');
//                $grade11 = $this->Teacher_model->getAllCourseForGrade('B');
//                $grade12 = $this->Teacher_model->getAllCourseForGrade('C');
//                $grade13 = $this->Teacher_model->getAllCourseForGrade('D');
//
//                $table1 = null;
//                $table2 = null;
//                $table3 = null;
//                $table4 = null;
//                $table5 = null;
//                $table6 = null;
//                $table7 = null;
//                $table8 = null;
//                $table9 = null;
//                $table10 = null;
//                $table11 = null;
//                $table12 = null;
//                $table13 = null;
//
//                $retry = false;
//            }
//            else{
                $currentTable = 1;
                $firstline = true;
                for($i=1; $i<sizeof($allclass)+1; $i++){
                    if(isset(${'grade'.$allclass[$i-1]['classroom']})){
                        for($a=0; $a<$period['value']; $a++){
                            for($b=0; $b<$day['value']; $b++){
                                unset($availablecourse);
                                $availablecourse = ${'grade'.$allclass[$i-1]['classroom']};
                                $availablecourseExist = false;

                                for($j=1; $j<$currentTable; $j++){
                                    $currentindex = 0;
                                    foreach ($availablecourse as $available){
                                        if(isset(${'table'.$j}[$a][$b]) && ${'table'.$j}[$a][$b]['teacherid'] == $available['teacherid']){
                                            unset($availablecourse[$currentindex]);
                                            $availablecourse = array_values($availablecourse);
                                            $availablecourseExist = true;
                                            break;
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
                                            break;
                                        }
                                        $currentindex++;
                                    }
                                }

                                $allteacher = $this->Teacher_model->getAllTeacher();
                                foreach ($allteacher as $t) {
                                    $worktimestring = substr($t['workinghour'], 1, strlen($t['workinghour']));
                                    $worktime = explode('|', $worktimestring);
                                    if(isset($worktime[$a*$day['value']+$b]) && $worktime[$a*$day['value']+$b] == '0'){
                                        $currentindex = 0;
                                        foreach ($availablecourse as $available){
                                            if($t['teacherid'] == $available['teacherid']){
                                                unset($availablecourse[$currentindex]);
                                                $availablecourse = array_values($availablecourse);
                                                $availablecourseExist = true;
                                                break;
                                            }
                                            $currentindex++;
                                        }
                                    }
                                }

                                if(isset($availablecourse[0]) && $availablecourseExist == true){
                                    $size = count($availablecourse);
                                    $index = rand(0, $size-1);

                                    ${'table'.$i}[$a][$b]['classid'] = $allclass[$i-1]['classid'];
                                    ${'table'.$i}[$a][$b]['classroom'] = $allclass[$i-1]['classroom'];
                                    ${'table'.$i}[$a][$b]['courseid'] = $availablecourse[$index]['courseid'];
                                    ${'table'.$i}[$a][$b]['teacherid'] = $availablecourse[$index]['teacherid'];
                                    ${'table'.$i}[$a][$b]['coursename'] = $availablecourse[$index]['coursename'];
                                    ${'table'.$i}[$a][$b]['teachername'] = $availablecourse[$index]['firstname'].' '.$availablecourse[$index]['lastname'];

                                    $initialcounter = 0;
                                    foreach (${'grade'.$allclass[$i-1]['classroom']} as $initial){
                                        if($initial['scid'] == $availablecourse[$index]['scid']){
                                            ${'grade'.$allclass[$i-1]['classroom']}[$initialcounter]['frequency'] = ${'grade'.$allclass[$i-1]['classroom']}[$initialcounter]['frequency'] - 1;
//                                            print_r(${'grade'.$allclass[$i-1]['classroom']}[$initialcounter]);
                                            if(${'grade'.$allclass[$i-1]['classroom']}[$initialcounter]['frequency'] == 0){
//                                                $this->nativesession->set('success', print_r($initial));
                                                unset(${'grade'.$allclass[$i-1]['classroom']}[$initialcounter]);
                                                ${'grade'.$allclass[$i-1]['classroom']} = array_values(${'grade'.$allclass[$i-1]['classroom']});
                                            }
                                        }
                                        $initialcounter++;
                                    }
                                }
                                else{
                                    $size = count(${'grade'.$allclass[$i-1]['classroom']});
                                    $index = rand(0, $size-1);

                                    ${'table'.$i}[$a][$b]['classid'] = $allclass[$i-1]['classid'];
                                    ${'table'.$i}[$a][$b]['classroom'] = $allclass[$i-1]['classroom'];
                                    ${'table'.$i}[$a][$b]['courseid'] = ${'grade'.$allclass[$i-1]['classroom']}[$index]['courseid'];
                                    ${'table'.$i}[$a][$b]['teacherid'] = ${'grade'.$allclass[$i-1]['classroom']}[$index]['teacherid'];
                                    ${'table'.$i}[$a][$b]['coursename'] = ${'grade'.$allclass[$i-1]['classroom']}[$index]['coursename'];
                                    ${'table'.$i}[$a][$b]['teachername'] = ${'grade'.$allclass[$i-1]['classroom']}[$index]['firstname'].' '.${'grade'.$allclass[$i-1]['classroom']}[$index]['lastname'];
                                    if($firstline == false){
                                        ${'table'.$i}[$a][$b]['conflict'] = 1;
                                    }
                                    ${'grade'.$allclass[$i-1]['classroom']}[$index]['frequency'] = ${'grade'.$allclass[$i-1]['classroom']}[$index]['frequency'] - 1;
                                    if(${'grade'.$allclass[$i-1]['classroom']}[$index]['frequency'] == 0){
                                        unset(${'grade'.$allclass[$i-1]['classroom']}[$index]);
                                        ${'grade'.$allclass[$i-1]['classroom']} = array_values(${'grade'.$allclass[$i-1]['classroom']});
                                    }
//                                    print_r(${'grade'.$allclass[$i-1]['classroom']}[$index]);
                                }
                            }
                            $firstline = false;
                        }
                        array_push($schedule, ${'table'.$i});
                        $currentTable++;
                    }
                }
//                $done = true;
//            }
//        }

//        $data['allclasses'] = $allclass;
        $data['schedule'] = $schedule;


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

    public function selectSchedule()
    {
        $savebutton = $this->input->post('savebutton');
        if($savebutton == 'save'){
            $this->Teacher_model->deleteAllScheduleApplied();

            $grade = $this->input->post('class');
            $row = $this->input->post('row');
            $colom = $this->input->post('colom');
            $teacherid = $this->input->post('teacherid');
            $courseid = $this->input->post('courseid');
            $latestID = $this->Teacher_model->getScheduleAppliedLatestID();
            $latestID = $latestID['scheduleid'];
            $latestSID = $this->Teacher_model->getAssignLatestID();
            $latestSID = $latestSID['assignid'];
            for($i=0;$i<sizeof($teacherid);$i++)
            {
                $latestID = substr($latestID, 1);
                $latestID = 'j'.str_pad((int) $latestID+1, 4, "0", STR_PAD_LEFT);

                $schedule[$i] = array(
                    'scheduleid' => $latestID,
                    'classid' => $grade[$i],
                    'period' => $row[$i],
                    'day' => $colom[$i],
                    'teacherid' => $teacherid[$i],
                    'courseid' => $courseid[$i],
                );

                if($result = $this->Teacher_model->checkAssignCourse($grade[$i], $teacherid[$i], $courseid[$i])){
                }
                else{
                    $latestSID = substr($latestSID, 1);
                    $latestSID = 's'.str_pad((int) $latestSID+1, 4, "0", STR_PAD_LEFT);

                    $assign = array(
                        'assignid' => $latestSID,
                        'teacherid' => $teacherid[$i],
                        'courseid' => $courseid[$i],
                        'classid' => $grade[$i],
                    );
                    $this->Teacher_model->addAssignCourses($assign);
                }
            }
            $this->Teacher_model->addScheduleApplied($schedule);
            redirect('teacher/classScheduleView/');
        }
        else{
            $this->Teacher_model->deleteAllSchedule();

            $grade = $this->input->post('class');
            $row = $this->input->post('row');
            $colom = $this->input->post('colom');
            $teacherid = $this->input->post('teacherid');
            $courseid = $this->input->post('courseid');
            $latestID = $this->Teacher_model->getScheduleLatestID();
            $latestID = $latestID['scheduleid'];
            for($i=0;$i<sizeof($teacherid);$i++)
            {
                $latestID = substr($latestID, 1);
                $latestID = 'j'.str_pad((int) $latestID+1, 4, "0", STR_PAD_LEFT);

                $schedule[$i] = array(
                    'scheduleid' => $latestID,
                    'classid' => $grade[$i],
                    'period' => $row[$i],
                    'day' => $colom[$i],
                    'teacherid' => $teacherid[$i],
                    'courseid' => $courseid[$i],
                );
            }
            $this->Teacher_model->addSchedule($schedule);
            redirect('teacher/editSchedule/');
        }
    }

    public function editSchedule()
    {
        $day = $this->Teacher_model->getSetting('s0005');
        $period = $this->Teacher_model->getSetting('s0006');

        $allclass = $this->Teacher_model->getAllClasses();
        foreach ($allclass as $class) {
            ${"grade" . $class['classid']} = $this->Teacher_model->getAllScheduleForGrade($class['classid']);
        }
        
        $schedule = array('');

        for($i=1; $i<sizeof($allclass)+1; $i++){
            if(isset(${'grade'.$allclass[$i-1]['classid']})){
                for($a=0; $a<$period['value']; $a++){
                    for($b=0; $b<$day['value']; $b++){
                        $currentgrade = ${'grade'.$allclass[$i-1]['classid']}[$a*$day['value']+$b]['classid'];
//                        $conflict1 = false;
//                        $conflict2 = false;
//                        $conflict3 = false;

                        if(isset(${'grade'.$allclass[$i-1]['classid']}[$a*$day['value']+$b])){
                            $notthisid = ${'grade'.$allclass[$i-1]['classid']}[$a*$day['value']+$b]['scheduleid'];
                            $thisteacherworkinghour = $this->Teacher_model->getWorkingHour(${'grade'.$allclass[$i-1]['classid']}[$a*$day['value']+$b]['teacherid']);
                        }
                        $othertablewithsamerowandcolom = $this->Teacher_model->getScheduleWithRowColom($a, $b, $notthisid);
                        foreach ($othertablewithsamerowandcolom as $other){
                            if(isset(${'grade'.$allclass[$i-1]['classid']}[$a*$day['value']+$b]) && ${'grade'.$allclass[$i-1]['classid']}[$a*$day['value']+$b]['teacherid'] == $other['teacherid']){
//                                $conflict1 = true;
                                ${'grade'.$allclass[$i-1]['classid']}[$a*$day['value']+$b]['conflict'] = 1;
                            }
                        }
                        unset($othertablewithsamerowandcolom);

                        $otherperiodsameday = $this->Teacher_model->getScheduleWithDayOfGrade($b, $currentgrade, $notthisid);
                        foreach ($otherperiodsameday as $other){
                            if(isset(${'grade'.$allclass[$i-1]['classid']}[$a*$day['value']+$b]) && ${'grade'.$allclass[$i-1]['classid']}[$a*$day['value']+$b]['courseid'] == $other['courseid']){
//                                $conflict2 = true;
                                ${'grade'.$allclass[$i-1]['classid']}[$a*$day['value']+$b]['conflict'] = 2;
                            }
                        }
                        unset($otherperiodsameday);

                        $worktimestring = substr($thisteacherworkinghour['workinghour'], 1, strlen($thisteacherworkinghour['workinghour']));
                        $worktime = explode('|', $worktimestring);
                        if(isset($worktime[$a*$day['value']+$b]) && $worktime[$a*$day['value']+$b] == '0'){
//                            $conflict3 = true;
                            ${'grade'.$allclass[$i-1]['classid']}[$a*$day['value']+$b]['conflict'] = 3;
                        }
                        
//                        if($conflict1 == true || $conflict2 == true || $conflict3 == true){
//                            ${'grade'.$allclass[$i-1]['classid']}[$a*$day['value']+$b]['conflict'] = 1;
//                        }
                    }
                }
                array_push($schedule, ${'grade'.$allclass[$i-1]['classid']});
            }
        }

        $data['schedule'] = $schedule;

        
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
        $data['content'] = 'teacher/edit_schedule_view';
        $this->load->view($this->template, $data);
    }

    public function classScheduleView()
    {
        $timeinterval = array();
        $period = $this->Teacher_model->getSetting('s0006');
        $hour = $this->Teacher_model->getSetting('s0007');
        $starttime = $this->Teacher_model->getSetting('s0008');
        $breakstarttime = $this->Teacher_model->getSetting('s0009');
        $breaktime = $this->Teacher_model->getSetting('s0011');
        $lunchstarttime = $this->Teacher_model->getSetting('s0010');
        $lunchtime = $this->Teacher_model->getSetting('s0012');

        $thisperiod = $starttime['value'];
        $break = false;
        $lunch = false;
        for($i=0; $i < $period['value'];){
            if($break == false && $thisperiod >= date('H:i', strtotime($breakstarttime['value']))){
                $thisperiod; //break
                $thisperiod = date('H:i', strtotime($thisperiod) + 60*$breaktime['value']);
                $break = true;
            }
            elseif ($lunch == false && $thisperiod >= date('H:i', strtotime($lunchstarttime['value']))){
                $thisperiod; //lunch
                $thisperiod = date('H:i', strtotime($thisperiod) + 60*$lunchtime['value']);
                $lunch = true;
            }
            else{
                array_push($timeinterval, $thisperiod);
                $thisperiod = date('H:i', strtotime($thisperiod) + 60*$hour['value']);
                $i++;
            }
        }

        $data['hour'] = $hour;
        $data['time'] = $timeinterval;
        $data['schedule'] = $this->Teacher_model->getAllScheduleOfTeacher($this->nativesession->get('id'));
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
        $period = array();
        $starttime = $this->Teacher_model->getSetting('s0008');
        $thisperiod = $starttime['value'];
        array_push($period, $thisperiod);
        $examtime = $this->Teacher_model->getSetting('s0013');
        $thisperiod = date('H:i', strtotime($thisperiod) + 60*$examtime['value']);
        array_push($period, $thisperiod);
        $breaktime = $this->Teacher_model->getSetting('s0011');
        $thisperiod = date('H:i', strtotime($thisperiod) + 60*$breaktime['value']);
        array_push($period, $thisperiod);
        $thisperiod = date('H:i', strtotime($thisperiod) + 60*$examtime['value']);
        array_push($period, $thisperiod);

        $data['time'] = $period;
        $data['schedule'] = $this->Teacher_model->getExamScheduleApplied();
        $data['title'] = 'SMS';
        $data['courses'] = $this->Teacher_model->getAllCoursesByTeacher($this->nativesession->get('id'));
        $data['eventnotif'] = $this->Teacher_model->getAllEventsCount($this->nativesession->get('id'),$this->nativesession->get('lastlogin'));
        $data['sidebar'] = 'teacher/teacher_sidebar';
        $data['topnavigation'] = 'teacher/teacher_topnavigation';
        $data['content'] = 'includes/exam_schedule_view';
        $this->load->view($this->template, $data);
    }

    public function generateExam()
    {
        $this->Teacher_model->deleteExamSchedule();

        $allclass = $this->Teacher_model->getAllClasses();
        $tablecount = 1;
        foreach ($allclass as $class) {
            ${"class" . $tablecount} = array('');
            ${"courses" . $class['classroom']} = $this->Teacher_model->getAllCourseForGrade($class['classid']);
            $tablecount++;
        }

        for($g=1; $g<sizeof($allclass)+1; $g++){
            if(isset(${'courses'.$allclass[$g-1]['classroom']})){
//        for($g = 0; $g<14; $g++){
//            $thisgrade = $g;
//            if($thisgrade == '10'){
//                $thisgrade = 'A';
//            }
//            elseif($thisgrade == '11'){
//                $thisgrade = 'B';
//            }
//            elseif($thisgrade == '12'){
//                $thisgrade = 'C';
//            }
//            elseif($thisgrade == '13'){
//                $thisgrade = 'D';
//            }
//
//            ${"class" . $g} = array('');
//            ${"courses" . $g} = $this->Teacher_model->getAllCourseForGrade($thisgrade);

//            if(isset(${"courses" . $g})){
                $orderlist = range(1,sizeof(${"courses" . $allclass[$g-1]['classroom']}));
                $schedule = array('');
                $scheduleindex = 0;
                foreach (${"courses" . $allclass[$g-1]['classroom']} as $c){
                    $size = count(${"courses" . $allclass[$g-1]['classroom']});
                    $index = rand(0, $size-1);

                    if($result = $this->Teacher_model->getExamScheduleOfCourse(${"courses" . $allclass[$g-1]['classroom']}[$index]['courseid'])){
                        ${"courses" . $allclass[$g-1]['classroom']}[$index]['count'] = $result['count'];
                        $delindex = array_search($result['count'], $orderlist);
                        unset($orderlist[$delindex]);
                        $orderlist = array_values($orderlist);
                    }
                    else{
                        ${"courses" . $allclass[$g-1]['classroom']}[$index]['count'] = $orderlist[0];
                        unset($orderlist[0]);
                        $orderlist = array_values($orderlist);
                    }
                    $usedteacher = array('');
                    array_push($usedteacher, ${"courses" . $allclass[$g-1]['classroom']}[$index]['teacherid']);
                    $allteacheravailable = $this->Teacher_model->getExamInvigilatorAvailable($usedteacher);
                    $sizeT = count($allteacheravailable);
                    $indexT = rand(0, $sizeT-1);
                    $schedule[$scheduleindex] = array(
                        'classid' => $allclass[$g-1]['classid'],
                        'teacherid' => $allteacheravailable[$indexT]['teacherid'],
                        'courseid' => ${"courses" . $allclass[$g-1]['classroom']}[$index]['courseid'],
                        'count' => ${"courses" . $allclass[$g-1]['classroom']}[$index]['count'],
                        'date' => date('Y-m-d', now()),
                    );
                    $scheduleindex++;

                    unset(${"courses" . $allclass[$g-1]['classroom']}[$index]);
                    ${"courses" . $allclass[$g-1]['classroom']} = array_values(${"courses" . $allclass[$g-1]['classroom']});
                }
                array_push(${"class" . $g}, $schedule);
                $this->Teacher_model->addExamSchedule($schedule);
                unset($schedule);
            }
        }
        
        $data['schedule'] = $this->Teacher_model->getExamSchedule();
        $data['title'] = 'SMS';
        $data['courses'] = $this->Teacher_model->getAllCoursesByTeacher($this->nativesession->get('id'));
        $data['eventnotif'] = $this->Teacher_model->getAllEventsCount($this->nativesession->get('id'),$this->nativesession->get('lastlogin'));
        $data['sidebar'] = 'teacher/teacher_sidebar';
        $data['topnavigation'] = 'teacher/teacher_topnavigation';
        $data['content'] = 'teacher/generate_exam_schedule_view';
        $this->load->view($this->template, $data);
    }

    public function saveExamSchedule(){
        $this->Teacher_model->deleteAllExamScheduleApplied();

        $classid = $this->input->post('classid');
        $teacherid = $this->input->post('teacherid');
        $courseid = $this->input->post('courseid');
        $count = $this->input->post('count');

        $startdate = $this->input->post('date');

        $latestID = 'e0000';
        for($i=0;$i<sizeof($classid);$i++)
        {
            $totalStudent = $this->Teacher_model->getStudentsByClassID($classid[$i]);
            $arrangement = '';
            if($totalStudent){
                $seating = range(1, sizeof($totalStudent));
                shuffle($seating);
                foreach ($seating as $s){
                    $arrangement = $arrangement.'|'.$s;
                }
            }
            $latestID = substr($latestID, 1);
            $latestID = 'e'.str_pad((int) $latestID+1, 4, "0", STR_PAD_LEFT);
            if($result = $this->Teacher_model->getExamScheduleAppliedOfCourse($courseid[$i])){
                $schedule[$i] = array(
                    'examid' => $latestID,
                    'classid' => $classid[$i],
                    'teacherid' => $teacherid[$i],
                    'courseid' => $courseid[$i],
                    'count' => $count[$i],
                    'date' => $result['date'],
                    'seat' => $arrangement
                );
            }
            else{
                $schedule[$i] = array(
                    'examid' => $latestID,
                    'classid' => $classid[$i],
                    'teacherid' => $teacherid[$i],
                    'courseid' => $courseid[$i],
                    'count' => $count[$i],
                    'date' => $startdate,
                    'seat' => $arrangement
                );
                if($count[$i]%2 == 0){
                    $startdate = date('Y-m-d', strtotime($startdate. ' +1 weekdays'));
                }
            }
            if(isset($classid[$i+1]) && $classid[$i] != $classid[$i+1]){
                $this->Teacher_model->addExamScheduleApplied($schedule);
                unset($schedule);
            }
        }
        $this->Teacher_model->addExamScheduleApplied($schedule);
        redirect('teacher/examScheduleView/');
    }

    public function seatingArrangement($id){
        $id = $this->general->decryptParaID($id, 'exam');
        $data['title'] = 'SMS';
        $data['courses'] = $this->Teacher_model->getAllCoursesByTeacher($this->nativesession->get('id'));
        $data['eventnotif'] = $this->Teacher_model->getAllEventsCount($this->nativesession->get('id'),$this->nativesession->get('lastlogin'));
        $data['sidebar'] = 'teacher/teacher_sidebar';
        $data['topnavigation'] = 'teacher/teacher_topnavigation';
        $info = $this->Teacher_model->getExamByID($id);
        $data['info_db'] = $info;
        $classid = $info['classid'];
        $data['students'] = $this->Teacher_model->getStudentsByClassID($classid);
        $data['content'] = 'teacher/teacher_exam_seating_arrangement_view';
        $this->load->view($this->template, $data);
    }

    public function studentView()
    {
        $data['students'] = $this->Student_model->getAllStudent();
        $data['title'] = 'SMS';
        $data['courses'] = $this->Teacher_model->getAllCoursesByTeacher($this->nativesession->get('id'));
        $data['eventnotif'] = $this->Teacher_model->getAllEventsCount($this->nativesession->get('id'),$this->nativesession->get('lastlogin'));
        $data['sidebar'] = 'teacher/teacher_sidebar';
        $data['topnavigation'] = 'teacher/teacher_topnavigation';
        $data['content'] = 'teacher/teacher_all_students_view';
        $this->load->view($this->template, $data);
    }

    public function deleteStudent($id){
        if($this->general->checkPrivilege($this->nativesession->get('role'), 'p0018') != 1){
            $this->nativesession->set('error', 'Access Denied');
            redirect('teacher/home');
        }
        $id = $this->general->decryptParaID($id, 'student');
        if($this->Student_model->deactivateStudent($id)){
            $this->nativesession->set('success', 'Student Deleted');
        }
        else{
            $this->nativesession->set('error', 'Failed to Delete Student');
        }
        redirect('teacher/studentView');
    }

    public function editStudent($stid){
        if($this->general->checkPrivilege($this->nativesession->get('role'), 'p0003') != 1){
            $this->nativesession->set('error', 'Access Denied');
            redirect('teacher/home');
        }
        $id = $this->general->decryptParaID($stid, 'student');
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

        $this->form_validation->set_error_delimiters('', '<br/>');

        if ($this->form_validation->run() == TRUE) {
            if ($_FILES['photo']['error'] != 4) {
                $config['upload_path'] = $this->profilestudentphotopath;
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
                        'source_image' => $this->profilestudentphotopath.'/'.$data['orig_name'],
                        'new_image' => $this->profilestudentphotopath.'/'.$data['orig_name'],
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
            redirect('teacher/studentView/');
        }

        $data['student']  = $this->Student_model->getProfileDataByID($id);
        $data['title'] = 'SMS';
        $data['courses'] = $this->Teacher_model->getAllCoursesByTeacher($this->nativesession->get('id'));
        $data['eventnotif'] = $this->Teacher_model->getAllEventsCount($this->nativesession->get('id'),$this->nativesession->get('lastlogin'));
        $data['sidebar'] = 'teacher/teacher_sidebar';
        $data['topnavigation'] = 'teacher/teacher_topnavigation';
        $data['content'] = 'teacher/teacher_edit_student_view';
        $this->load->view($this->template, $data);
    }

    public function addStudent(){
        if($this->general->checkPrivilege($this->nativesession->get('role'), 'p0002') != 1){
            $this->nativesession->set('error', 'Access Denied');
            redirect('teacher/home');
        }

        $laststudentdid = $this->Student_model->getLatestID();
        foreach ($laststudentdid as $lastid) {
            $value = $value = substr($lastid,1) + 1;
        }

        if($value < 10) {
            $newstudentid= 'm000'.$value;
        } else if ($value>=10 and $value<100) {
            $newstudentid= 'm00'.$value;
        } else if ($value>=100 and $value<1000) {
            $newstudentid = 'm0' . $value;
        } else if ($value>=1000 and $value<10000) {
            $newstudentid = 'm' . $value;
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

        $this->form_validation->set_error_delimiters('', '<br/>');

        if ($this->form_validation->run() == TRUE) {
            $this->Student_model->addStudent($newstudentid);
            if ($_FILES['photo']['error'] != 4) {
                $config['upload_path'] = $this->profilestudentphotopath;
                $config['allowed_types'] = "jpg|jpeg|png|JPG|JPEG|PNG";
                $config['max_size'] = 200000;
                $config['overwrite'] = TRUE;
                $config['file_name'] = $newstudentid;
                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('photo')) {

                    $this->nativesession->set('error', $this->upload->display_errors());
                    redirect(current_url());
                } else {
                    $data = $this->upload->data();
                    $config_image = array(
                        'image_library' => 'gd2',
                        'source_image' => $this->profilestudentphotopath.'/'.$data['orig_name'],
                        'new_image' => $this->profilestudentphotopath.'/'.$data['orig_name'],
                        'width' => 1240,
                        'maintain_ratio' => TRUE,
                        'rotate_by_exif' => TRUE,
//                'strip_exif' => TRUE,
                    );
                    $this->load->library('image_lib', $config_image);
                    $this->image_lib->resize();

                    $filename = $data['orig_name'];
                    if ($this->Student_model->editProfilePhoto($newstudentid, $filename)) {
                        $this->nativesession->set('success', 'Photo Changed');
                    } else {
                        $this->nativesession->set('error', 'Upload Photo Failed, try again !');
                        redirect(current_url());
                    }
                }
            }
            $this->nativesession->set('success', 'New Student Added');
            $eid = $this->general->encryptParaID($newstudentid, 'student');
            redirect('teacher/editStudent/'.$eid);
        }

        $data['title'] = 'SMS';
        $data['courses'] = $this->Teacher_model->getAllCoursesByTeacher($this->nativesession->get('id'));
        $data['eventnotif'] = $this->Teacher_model->getAllEventsCount($this->nativesession->get('id'),$this->nativesession->get('lastlogin'));
        $data['sidebar'] = 'teacher/teacher_sidebar';
        $data['topnavigation'] = 'teacher/teacher_topnavigation';
        $data['newstudentid'] = $newstudentid;
        $data['content'] = 'teacher/teacher_add_student_view';
        $this->load->view($this->template, $data);
    }

    public function parentView()
    {
        $parent = $this->Teacher_model->getAllParent();
        $parentcounter = 0;
        foreach ($parent as $p){
            if($child = $this->Teacher_model->getChildOfParent($p['parentid'])){
                $children = '';
                foreach ($child as $c){
                    $children = $children.'|'.$c['firstname'].' '.$c['lastname'].' '.$c['classroom'];
                }
                $parent[$parentcounter]['child'] = $children;
            }
            $parentcounter++;
        }
        $data['parent'] = $parent;
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
        $teachers = $this->Teacher_model->getAllTeacherIncludeInactive();
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
                $twh[$i]['active'] = $found['active'];
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
                $th[$j]['active'] = $teacher['active'];
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
        $data['admins'] = $this->Admin_model->getAllAdministrator();
        $data['operators'] = "";
        
        $data['title'] = 'SMS';
        $data['courses'] = $this->Teacher_model->getAllCoursesByTeacher($this->nativesession->get('id'));
        $data['eventnotif'] = $this->Teacher_model->getAllEventsCount($this->nativesession->get('id'),$this->nativesession->get('lastlogin'));
        $data['sidebar'] = 'teacher/teacher_sidebar';
        $data['topnavigation'] = 'teacher/teacher_topnavigation';
        $data['content'] = 'teacher/teacher_all_staff_view';
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

    public function classesView()
    {
        $data['classes'] = $this->Teacher_model->getAllClassesWithTeacher();
//        $data['classesnoteacher'] = $this->Teacher_model->getAllClassesWithNoTeacher();
        $data['title'] = 'SMS';
        $data['courses'] = $this->Teacher_model->getAllCoursesByTeacher($this->nativesession->get('id'));
        $data['eventnotif'] = $this->Teacher_model->getAllEventsCount($this->nativesession->get('id'),$this->nativesession->get('lastlogin'));
        $data['sidebar'] = 'teacher/teacher_sidebar';
        $data['topnavigation'] = 'teacher/teacher_topnavigation';
        $data['content'] = 'includes/classes_view';
        $this->load->view($this->template, $data);
    }

    public function addClass()
    {
        if($this->general->checkPrivilege($this->nativesession->get('role'), 'p0025') != 1){
            $this->nativesession->set('error', 'Access Denied');
            redirect('teacher/home');
        }
        $this->form_validation->set_rules('class', 'Classroom', 'required');
        $this->form_validation->set_rules('teacher', 'Homeroom Teacher', 'required');
        $this->form_validation->set_error_delimiters('', '<br/>');
        if ($this->form_validation->run() == TRUE) {
            $latestID = $this->Teacher_model->getClassLatestID();
            $latestID = $latestID['classid'];
            $latestID = substr($latestID, 1);
            $latestID = 'k'.str_pad((int) $latestID+1, 4, "0", STR_PAD_LEFT);
            $this->Teacher_model->addClass($latestID);
            
            $this->nativesession->set('success', 'Class Added');
            redirect('teacher/classesView/');
        }

        $data['teacher'] = $this->Teacher_model->getAllTeacher();
        $data['title'] = 'SMS';
        $data['courses'] = $this->Teacher_model->getAllCoursesByTeacher($this->nativesession->get('id'));
        $data['eventnotif'] = $this->Teacher_model->getAllEventsCount($this->nativesession->get('id'),$this->nativesession->get('lastlogin'));
        $data['sidebar'] = 'teacher/teacher_sidebar';
        $data['topnavigation'] = 'teacher/teacher_topnavigation';
        $data['content'] = 'teacher/add_class_view';
        $this->load->view($this->template, $data);
    }

    public function editClass($id){
        if($this->general->checkPrivilege($this->nativesession->get('role'), 'p0026') != 1){
            $this->nativesession->set('error', 'Access Denied');
            redirect('teacher/home');
        }
        $id = $this->general->decryptParaID($id, 'class');
        $this->form_validation->set_rules('class', 'Classroom', 'required');
//        if($this->input->post('type') != 1){
            $this->form_validation->set_rules('teacher', 'Homeroom Teacher', 'required');
//        }
        $this->form_validation->set_error_delimiters('', '<br/>');
        if ($this->form_validation->run() == TRUE) {
            $this->Teacher_model->editClass($id);
            $this->nativesession->set('success', 'Class Added');
            redirect('teacher/classesView/');
        }

        $class = $this->Teacher_model->getClassByClassid($id);
        if($teacher = $this->Teacher_model->getTeacherByClassid($id)){
            $class['firstname'] = $teacher['firstname'];
            $class['lastname'] = $teacher['lastname'];
        }
        $data['class'] = $class;
        $data['teacher'] = $this->Teacher_model->getAllTeacher();
        $data['title'] = 'SMS';
        $data['courses'] = $this->Teacher_model->getAllCoursesByTeacher($this->nativesession->get('id'));
        $data['eventnotif'] = $this->Teacher_model->getAllEventsCount($this->nativesession->get('id'),$this->nativesession->get('lastlogin'));
        $data['sidebar'] = 'teacher/teacher_sidebar';
        $data['topnavigation'] = 'teacher/teacher_topnavigation';
        $data['content'] = 'teacher/edit_class_view';
        $this->load->view($this->template, $data);
    }

    public function deleteClass($id){
        if($this->general->checkPrivilege($this->nativesession->get('role'), 'p0026') != 1){
            $this->nativesession->set('error', 'Access Denied');
            redirect('teacher/home');
        }
        $id = $this->general->decryptParaID($id, 'class');
        if($this->Teacher_model->deleteClass($id)){
            $this->nativesession->set('success', 'Class Deleted');
        }
        else{
            $this->nativesession->set('error', 'Failed to Delete Class');
        }
        redirect('teacher/classesView');
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

        $data['operation'] = $this->Operation_model->getProfileDataByID($this->nativesession->get('id'));
        $data['orders'] = $this->Operation_model->getAllOutstandingPayment();
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
        $data['scheduling'] = $this->Teacher_model->getAllSchedulingSettings();
        $data['grading'] = $this->Teacher_model->getAllGradingSettings();
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
                $request[$a]['status'] = $found['status'];
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
                if($result['status'] == 1) {
                    $this->nativesession->set('error', 'Request '.$result['name'].' on process cannot edit');
                }
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
        if($result = $this->Teacher_model->getBookRequest($id)){
            if($result['status'] == 1) {
                $this->nativesession->set('error', 'Request on process cannot edit');
                redirect('teacher/requestItem/');
            }
        }
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

    public function deleteBookRequest($id){
        if($this->Teacher_model->deleteBookRequest($id)){
            $this->nativesession->set('success', 'Book Request Deleted');
        }
        else{
            $this->nativesession->set('error', 'Failed to Delete Book Request');
        }
        redirect('teacher/requestItem/');
    }

    public function editFotocopyRequest($id){
        if($result = $this->Teacher_model->getFotocopyRequest($id)){
            if($result['status'] == 1) {
                $this->nativesession->set('error', 'Request on process cannot edit');
                redirect('teacher/requestItem/');
            }
        }
        $this->Teacher_model->editFotocopyRequest($id);
        $this->nativesession->set('success', 'Fotocopy Request Edited');
        redirect('teacher/requestItem/');
    }

    public function deleteFotocopyRequest($id){
        if($this->Teacher_model->deleteFotocopyRequest($id)){
            $this->nativesession->set('success', 'Fotocopy Request Deleted');
        }
        else{
            $this->nativesession->set('error', 'Failed to Delete Fotocopy Request');
        }
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

    public function sendEmailReport($sid)
    {
        $sid = $this->general->decryptParaID($sid, 'assignid');

        $reportdata = $this->Teacher_model->getStudentCourseByAssignID($sid);

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
        $this->email->to($reportdata['email']);
        $this->email->subject('Report Submission - Notification');
        $this->email->message('This is the notification for submitting report of:
            Course : '.$reportdata['coursename']);

        if($this->email->send())
            $this->nativesession->set("success","Email sent successfully.");
        else
            $this->nativesession->set("error",$this->email->print_debugger());

        redirect($_SERVER['HTTP_REFERER']);

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