<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class parents extends CI_Controller {

    var $template = 'template';
    var $profilephotopath = 'assets/img/parents/profile/';
    var $correspondpath = 'assets/file/correspond/';
    var $transferpath = 'assets/file/payment/';

    function __construct() {
        parent::__construct();
        $this->load->model('Parent_model');
        $this->load->model('Teacher_model');
        $this->load->model('Student_model');
    }

    public function home()
    {
        $data['title'] = 'SMS';
        $data['sidebar'] = 'parents/parent_sidebar';
        $data['topnavigation'] = 'parents/parent_topnavigation';
        $data['content'] = 'parents/parent_home_view';
        $data['eventnotif'] = $this->Parent_model->getAllEventsCount($this->nativesession->get('id'),$this->nativesession->get('lastlogin'));
        $data['events'] = $this->Parent_model->getAllEvents($this->nativesession->get('id'));
        $data['parent'] = $this->Parent_model->getProfileDataByID($this->nativesession->get('id'));
        $data['inbox'] = $this->Parent_model->getAllInbox($this->nativesession->get('id'));


        $student  = $this->Student_model->getProfileDataByID($this->nativesession->get('current_child_id'));
        $data['student'] = $student;
        $this->nativesession->set( 'classid', $student['classid'] );
        $data['grades']  = $this->Student_model->getAllGradeByStudentID($this->nativesession->get('current_child_id'));
        $data['studentGradeCourses']  = $this->Student_model->getAllClassesByStudentID($this->nativesession->get('current_child_id'));
        $data['courses'] = $this->Student_model->getStudentCourses($this->nativesession->get('classid'));
                
        $this->load->view($this->template, $data);
    }

    public function parent_attendance()
    {
        $data['title'] = 'SMS';
        $data['sidebar'] = 'parents/parent_sidebar';
        $data['topnavigation'] = 'parents/parent_topnavigation';
        $data['content'] = 'parents/parent_attendance_view';
        $data['eventnotif'] = $this->Parent_model->getAllEventsCount($this->nativesession->get('id'),$this->nativesession->get('lastlogin'));
        $data['events'] = $this->Parent_model->getAllEvents($this->nativesession->get('id'));
        $data['parent'] = $this->Parent_model->getProfileDataByID($this->nativesession->get('id'));
        $data['inbox'] = $this->Parent_model->getAllInbox($this->nativesession->get('id'));

        $student  = $this->Student_model->getProfileDataByID($this->nativesession->get('current_child_id'));
        $data['student'] = $student;
        $this->nativesession->set( 'classid', $student['classid'] );
        $data['grades']  = $this->Student_model->getAllGradeByStudentID($this->nativesession->get('current_child_id'));
        $data['studentGradeCourses']  = $this->Student_model->getAllClassesByStudentID($this->nativesession->get('current_child_id'));
        $data['courses'] = $this->Student_model->getStudentCourses($this->nativesession->get('classid'));
        $data['attendances'] = $this->Student_model->getAttendanceList($this->nativesession->get('classid'),$this->nativesession->get('current_child_id'));

        $this->load->view($this->template, $data);
    }
    public function parent_profile()
    {
        $data['title'] = 'SMS';
        $data['sidebar'] = 'parents/parent_sidebar';
        $data['topnavigation'] = 'parents/parent_topnavigation';
        $data['content'] = 'parents/parent_profile_view';
        $data['eventnotif'] = $this->Parent_model->getAllEventsCount($this->nativesession->get('id'),$this->nativesession->get('lastlogin'));
        $data['events'] = $this->Parent_model->getAllEvents($this->nativesession->get('id'));
        $data['parent'] = $this->Parent_model->getProfileDataByID($this->nativesession->get('id'));
        $data['inbox'] = $this->Parent_model->getAllInbox($this->nativesession->get('id'));

        $student  = $this->Student_model->getProfileDataByID($this->nativesession->get('current_child_id'));
        $data['student'] = $student;
        $this->nativesession->set( 'classid', $student['classid'] );
        $data['grades']  = $this->Student_model->getAllGradeByStudentID($this->nativesession->get('current_child_id'));
        $data['studentGradeCourses']  = $this->Student_model->getAllClassesByStudentID($this->nativesession->get('current_child_id'));
        $data['courses'] = $this->Student_model->getStudentCourses($this->nativesession->get('classid'));

        $this->load->view($this->template, $data);
    }
    public function profile_edit($id)
    {
        $id = $this->general->decryptParaID($id, 'parent');
        if($this->nativesession->get('id') != $id){
            $this->nativesession->set('error', 'Access Denied');
            redirect('parent/home');
        }

        $this->form_validation->set_rules('firstname', 'firstname', 'required');
        $this->form_validation->set_rules('lastname', 'lastname', 'required');
        $this->form_validation->set_rules('gender', 'gender', 'required');
        $this->form_validation->set_rules('phone', 'phone', 'required');
        $this->form_validation->set_rules('phoneoverseas', 'phone overseas', 'required');
        $this->form_validation->set_rules('mobile', 'mobile', 'required');
        $this->form_validation->set_rules('mobileoverseas', 'mobile overseas', 'required');
        $this->form_validation->set_rules('email', 'email', 'required|valid_email');
        $this->form_validation->set_rules('address', 'address', 'required');
        $this->form_validation->set_rules('addressoverseas', 'address overseas', 'required');
        $this->form_validation->set_rules('passportno', 'passport no', 'required');
        $this->form_validation->set_rules('passportcountry', 'passport country', 'required');
        $this->form_validation->set_rules('passportexp', 'passport exp', 'required');
        $parentid = $this->input->post('parentid');
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
                $config['file_name'] = $parentid;
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
                        'width' => 512,
                        'height' => 512,
                        'maintain_ratio' => TRUE,
                        'rotate_by_exif' => TRUE
//                'strip_exif' => TRUE,
                    );
                    $this->load->library('image_lib', $config_image);
                    $this->image_lib->resize();

                    $filename = $data['orig_name'];
                    if ($this->Parent_model->editProfilePhoto($parentid, $filename)) {
                    } else {
                        $this->nativesession->set('error', 'Upload Photo Failed, try again !');
                        redirect(current_url());
                    }
                }
            }
            $this->Parent_model->editProfile($parentid);
            $this->nativesession->set('success', 'Profile saved');
            $eid = $this->general->encryptParaID($id, 'parent');
            redirect('parents/parent_profile/'.$eid);
        }

        $data['title'] = 'SMS';
        $data['sidebar'] = 'parents/parent_sidebar';
        $data['topnavigation'] = 'parents/parent_topnavigation';
        $data['content'] = 'parents/parent_profile_edit_view';
        $data['eventnotif'] = $this->Parent_model->getAllEventsCount($this->nativesession->get('id'),$this->nativesession->get('lastlogin'));
        $data['events'] = $this->Parent_model->getAllEvents($this->nativesession->get('id'));
        $data['parent'] = $this->Parent_model->getProfileDataByID($this->nativesession->get('id'));
        $data['inbox'] = $this->Parent_model->getAllInbox($this->nativesession->get('id'));

        $student  = $this->Student_model->getProfileDataByID($this->nativesession->get('current_child_id'));
        $data['student'] = $student;
        $this->nativesession->set( 'classid', $student['classid'] );
        $data['grades']  = $this->Student_model->getAllGradeByStudentID($this->nativesession->get('current_child_id'));
        $data['studentGradeCourses']  = $this->Student_model->getAllClassesByStudentID($this->nativesession->get('current_child_id'));
        $data['courses'] = $this->Student_model->getStudentCourses($this->nativesession->get('classid'));

        $this->load->view($this->template, $data);
    }
    public function choose_child($id)
    {
        $id = $this->general->decryptParaID($id, 'student');
        $this->nativesession->set( 'current_child_id', $id);
        $childs = $this->Parent_model->getChild($id);
        $this->nativesession->set( 'current_child_name', $childs['firstname'].' '.$childs['lastname'] );
        redirect($_SERVER['HTTP_REFERER']);
    }
    public function learningReport($term,$grade)
    {
        $allattendance = $this->Student_model->getTotalAttendance($this->nativesession->get('current_child_id'));
        $present = $this->Student_model->getTotalPresentByStudent($this->nativesession->get('current_child_id'));
        $attendancepercentage = $present/$allattendance*100;

        $data['title'] = 'SMS';
        $data['sidebar'] = 'parents/parent_sidebar';
        $data['topnavigation'] = 'parents/parent_topnavigation';
        $data['inbox'] = $this->Parent_model->getAllInbox($this->nativesession->get('id'));

        $data['reportGrade']  = $grade;
        $data['reportTerm']  = $term;
        $data['attendance'] = $attendancepercentage;
        $data['student']  = $this->Student_model->getProfileDataByID($this->nativesession->get('current_child_id'));
        $data['grades']  = $this->Student_model->getAllGradeByStudentID($this->nativesession->get('current_child_id'));
        $data['report']  = $this->Student_model->getStudentReport($this->nativesession->get('current_child_id'),$term,$grade);
        $data['studentCoursesOnGrade']  = $this->Student_model->getStudentCourseOnGrade($this->nativesession->get('current_child_id'),$grade);
        $data['studentGradeCourses']  = $this->Student_model->getAllClassesByStudentID($this->nativesession->get('current_child_id'));

        $data['eventnotif'] = $this->Parent_model->getAllEventsCount($this->nativesession->get('id'),$this->nativesession->get('lastlogin'));
        $data['events'] = $this->Parent_model->getAllEvents($this->nativesession->get('id'));
        $data['parent'] = $this->Parent_model->getProfileDataByID($this->nativesession->get('id'));

        $data['from'] = 'Parents';
        $data['content'] = 'includes/report_view';
        $this->load->view($this->template, $data);
    }
    public function learningReport2($term,$grade)
    {
        $allattendance = $this->Student_model->getTotalAttendance($this->nativesession->get('current_child_id'));
        $present = $this->Student_model->getTotalPresentByStudent($this->nativesession->get('current_child_id'));
        $attendancepercentage = $present/$allattendance*100;

        $data['title'] = 'SMS';
        $data['sidebar'] = 'parents/parent_sidebar';
        $data['topnavigation'] = 'parents/parent_topnavigation';
        $data['inbox'] = $this->Parent_model->getAllInbox($this->nativesession->get('id'));

        $data['reportGrade']  = $grade;
        $data['reportTerm']  = $term;
        $data['attendance'] = $attendancepercentage;
        $data['student']  = $this->Student_model->getProfileDataByID($this->nativesession->get('current_child_id'));
        $data['grades']  = $this->Student_model->getAllGradeByStudentID($this->nativesession->get('current_child_id'));
        $data['report']  = $this->Student_model->getStudentReport($this->nativesession->get('current_child_id'),$term,$grade);
        $data['studentCoursesOnGrade']  = $this->Student_model->getStudentCourseOnGrade($this->nativesession->get('current_child_id'),$grade);
        $data['studentGradeCourses']  = $this->Student_model->getAllClassesByStudentID($this->nativesession->get('current_child_id'));

        $data['eventnotif'] = $this->Parent_model->getAllEventsCount($this->nativesession->get('id'),$this->nativesession->get('lastlogin'));
        $data['events'] = $this->Parent_model->getAllEvents($this->nativesession->get('id'));
        $data['parent'] = $this->Parent_model->getProfileDataByID($this->nativesession->get('id'));

        $data['from'] = 'Parents';
        $data['content'] = 'includes/report2_view';
        $this->load->view($this->template, $data);
    }
    public function courseView($id)
    {
        $id = $this->general->decryptParaID($id, 'course');
        $data['title'] = 'SMS';
        $data['sidebar'] = 'parents/parent_sidebar';
        $data['topnavigation'] = 'parents/parent_topnavigation';
        $data['inbox'] = $this->Parent_model->getAllInbox($this->nativesession->get('id'));

        $student  = $this->Student_model->getProfileDataByID($this->nativesession->get('current_child_id'));
        $data['student'] = $student;
        $this->nativesession->set( 'classid', $student['classid'] );
        $data['course'] = $this->Student_model->getCourseDataByID($id, $this->nativesession->get('classid'));
        $data['grades']  = $this->Student_model->getAllGradeByStudentID($this->nativesession->get('current_child_id'));
        $data['studentGradeCourses']  = $this->Student_model->getAllClassesByStudentID($this->nativesession->get('current_child_id'));
        $data['course_plan'] = $this->Student_model->getCoursePlanDataByID($id);

        $data['from'] = 'parents';
        $data['content'] = 'includes/course_view';
        $this->load->view($this->template, $data);
    }
    public function courseImplementation($id)
    {
        $id = $this->general->decryptParaID($id, 'course');
        $data['title'] = 'SMS';
        $data['sidebar'] = 'parents/parent_sidebar';
        $data['topnavigation'] = 'parents/parent_topnavigation';
        $data['inbox'] = $this->Parent_model->getAllInbox($this->nativesession->get('id'));

        $student  = $this->Student_model->getProfileDataByID($this->nativesession->get('current_child_id'));
        $data['student'] = $student;
        $this->nativesession->set( 'classid', $student['classid'] );
        $data['course'] = $this->Student_model->getCourseDataByID($id, $this->nativesession->get('classid'));
        $data['grades']  = $this->Student_model->getAllGradeByStudentID($this->nativesession->get('current_child_id'));
        $data['studentGradeCourses']  = $this->Student_model->getAllClassesByStudentID($this->nativesession->get('current_child_id'));
        $data['course_implementation'] = $this->Student_model->getCourseImplementationData($id, $this->nativesession->get('classid'));

        $data['from'] = 'parents';
        $data['content'] = 'includes/course_implementation_view';
        $this->load->view($this->template, $data);
    }
    public function courseMaterial($id)
    {
        $id = $this->general->decryptParaID($id, 'course');
        $data['title'] = 'SMS';
        $data['sidebar'] = 'parents/parent_sidebar';
        $data['topnavigation'] = 'parents/parent_topnavigation';
        $data['inbox'] = $this->Parent_model->getAllInbox($this->nativesession->get('id'));

        $student  = $this->Student_model->getProfileDataByID($this->nativesession->get('current_child_id'));
        $data['student'] = $student;
        $this->nativesession->set( 'classid', $student['classid'] );
        $data['course'] = $this->Student_model->getCourseDataByID($id, $this->nativesession->get('classid'));
        $data['grades']  = $this->Student_model->getAllGradeByStudentID($this->nativesession->get('current_child_id'));
        $data['studentGradeCourses']  = $this->Student_model->getAllClassesByStudentID($this->nativesession->get('current_child_id'));
        $data['materials'] = $this->Student_model->getSharedMaterialsByCourseID($id, $this->nativesession->get('classid'));

        $data['from'] = 'parents';
        $data['content'] = 'includes/course_material_view';
        $this->load->view($this->template, $data);
    }
    public function courseAssignmentQuiz($id)
    {
        $id = $this->general->decryptParaID($id, 'course');
        $data['title'] = 'SMS';
        $data['sidebar'] = 'parents/parent_sidebar';
        $data['topnavigation'] = 'parents/parent_topnavigation';
        $data['inbox'] = $this->Parent_model->getAllInbox($this->nativesession->get('id'));

        $student  = $this->Student_model->getProfileDataByID($this->nativesession->get('current_child_id'));
        $data['student'] = $student;
        $this->nativesession->set( 'classid', $student['classid'] );
        $data['course'] = $this->Student_model->getCourseDataByID($id, $this->nativesession->get('classid'));
        $data['grades']  = $this->Student_model->getAllGradeByStudentID($this->nativesession->get('current_child_id'));
        $data['studentGradeCourses']  = $this->Student_model->getAllClassesByStudentID($this->nativesession->get('current_child_id'));
        $data['qnas'] = $this->Student_model->getAssignmentAndQuizesByCourseID($id, $this->nativesession->get('classid'));
        $data['submissions'] = $this->Student_model->getSubmission($this->nativesession->get('current_child_id'), $this->nativesession->get('classid'));

        $data['from'] = 'parents';
        $data['content'] = 'includes/course_qna_view';
        $this->load->view($this->template, $data);
    }
    public function coursePerformance($assignid){
        $data['title'] = 'SMS';
        $data['sidebar'] = 'parents/parent_sidebar';
        $data['topnavigation'] = 'parents/parent_topnavigation';
        $data['inbox'] = $this->Parent_model->getAllInbox($this->nativesession->get('id'));

        $assignid = $this->general->decryptParaID($assignid, 'courseassigned');
        $studentid = $this->general->decryptParaID($this->nativesession->get('current_child_id'), 'student');
        $class = $this->Student_model->getClassByStudentID($this->nativesession->get('current_child_id'));
        $class = explode('-', $class['classroom']);
        $eid = $this->general->encryptParaID($assignid, 'courseassigned');
        $esid = $this->general->encryptParaID($studentid, 'student');

        $data['homework'] = $this->Student_model->getAllQnAByStudent($this->nativesession->get('current_child_id'), 1);
        $data['classwork'] = $this->Student_model->getAllQnAByStudent($this->nativesession->get('current_child_id'), 2);
        $data['assessment'] = $this->Student_model->getAllQnAByStudent($this->nativesession->get('current_child_id'), 3);

        $data['grades']  = $this->Student_model->getAllGradeByStudentID($this->nativesession->get('current_child_id'));
        $data['studentGradeCourses']  = $this->Student_model->getAllClassesByStudentID($this->nativesession->get('current_child_id'));

        $data['course'] = $this->Student_model->getCourseDataByAssignID($assignid);
        $data['student']  = $this->Student_model->getProfileDataByID($this->nativesession->get('current_child_id'));
        $data['report'] = $this->Student_model->getReportDataBy($assignid, $this->nativesession->get('current_child_id'));

        $data['from'] = 'parents';
        $data['content'] = 'includes/course_performance_view';
        $this->load->view($this->template, $data);
    }
    public function forms()
    {
        $data['title'] = 'SMS';
        $data['sidebar'] = 'parents/parent_sidebar';
        $data['topnavigation'] = 'parents/parent_topnavigation';
        $data['info_dbs'] = $this->Parent_model->getAllForms();
        $data['inbox'] = $this->Parent_model->getAllInbox($this->nativesession->get('id'));

        $data['eventnotif'] = $this->Parent_model->getAllEventsCount($this->nativesession->get('id'),$this->nativesession->get('lastlogin'));
        $data['events'] = $this->Parent_model->getAllEvents($this->nativesession->get('id'));
        $data['parent'] = $this->Parent_model->getProfileDataByID($this->nativesession->get('id'));

        $student  = $this->Student_model->getProfileDataByID($this->nativesession->get('current_child_id'));
        $data['student'] = $student;
        $this->nativesession->set( 'classid', $student['classid'] );
        $data['grades']  = $this->Student_model->getAllGradeByStudentID($this->nativesession->get('current_child_id'));
        $data['studentGradeCourses']  = $this->Student_model->getAllClassesByStudentID($this->nativesession->get('current_child_id'));
        $data['courses'] = $this->Student_model->getStudentCourses($this->nativesession->get('classid'));

        $data['content'] = 'includes/forms_view';
        $this->load->view($this->template, $data);
    }
    public function eventDetail($id){
        $id = $this->general->decryptParaID($id, 'event');
        $data['inbox'] = $this->Parent_model->getAllInbox($this->nativesession->get('id'));

        $data['title'] = 'SMS';
        $data['sidebar'] = 'parents/parent_sidebar';
        $data['topnavigation'] = 'parents/parent_topnavigation';
        $data['eventnotif'] = $this->Parent_model->getAllEventsCount($this->nativesession->get('id'),$this->nativesession->get('lastlogin'));
        $data['event'] = $this->Parent_model->getEvent($id);
        $data['parent'] = $this->Parent_model->getProfileDataByID($this->nativesession->get('id'));

        $student  = $this->Student_model->getProfileDataByID($this->nativesession->get('current_child_id'));
        $data['student'] = $student;
        $this->nativesession->set( 'classid', $student['classid'] );
        $data['grades']  = $this->Student_model->getAllGradeByStudentID($this->nativesession->get('current_child_id'));
        $data['studentGradeCourses']  = $this->Student_model->getAllClassesByStudentID($this->nativesession->get('current_child_id'));
        $data['courses'] = $this->Student_model->getStudentCourses($this->nativesession->get('classid'));
        
        $data['content'] = 'teacher/event_detail_view';
        $this->load->view($this->template, $data);
    }
    public function classScheduleView()
    {
        $data['title'] = 'SMS';
        $data['sidebar'] = 'parents/parent_sidebar';
        $data['topnavigation'] = 'parents/parent_topnavigation';
        $data['eventnotif'] = $this->Parent_model->getAllEventsCount($this->nativesession->get('id'),$this->nativesession->get('lastlogin'));
        $data['events'] = $this->Parent_model->getAllEvents($this->nativesession->get('id'));
        $data['parent'] = $this->Parent_model->getProfileDataByID($this->nativesession->get('id'));
        $data['inbox'] = $this->Parent_model->getAllInbox($this->nativesession->get('id'));


        $student  = $this->Student_model->getProfileDataByID($this->nativesession->get('current_child_id'));
        $data['student'] = $student;
        $this->nativesession->set( 'classid', $student['classid'] );
        $id = $this->nativesession->get('classid');
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
        $data['schedule'] = $this->Teacher_model->getAllScheduleForGrade($id);
        $data['grades']  = $this->Student_model->getAllGradeByStudentID($this->nativesession->get('current_child_id'));
        $data['studentGradeCourses']  = $this->Student_model->getAllClassesByStudentID($this->nativesession->get('current_child_id'));
        $data['courses'] = $this->Student_model->getStudentCourses($this->nativesession->get('classid'));

        $data['content'] = 'student/student_class_schedule_view';
        $this->load->view($this->template, $data);
    }
    public function examScheduleView()
    {
        $data['title'] = 'SMS';
        $data['sidebar'] = 'parents/parent_sidebar';
        $data['topnavigation'] = 'parents/parent_topnavigation';
        $data['eventnotif'] = $this->Parent_model->getAllEventsCount($this->nativesession->get('id'),$this->nativesession->get('lastlogin'));
        $data['events'] = $this->Parent_model->getAllEvents($this->nativesession->get('id'));
        $data['parent'] = $this->Parent_model->getProfileDataByID($this->nativesession->get('id'));
        $data['inbox'] = $this->Parent_model->getAllInbox($this->nativesession->get('id'));

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

        $student  = $this->Student_model->getProfileDataByID($this->nativesession->get('current_child_id'));
        $data['student'] = $student;
        $this->nativesession->set( 'classid', $student['classid'] );
        $data['grades']  = $this->Student_model->getAllGradeByStudentID($this->nativesession->get('current_child_id'));
        $data['studentGradeCourses']  = $this->Student_model->getAllClassesByStudentID($this->nativesession->get('current_child_id'));
        $data['courses'] = $this->Student_model->getStudentCourses($this->nativesession->get('classid'));
        $data['classid'] =  $this->nativesession->get('classid');

        $data['content'] = 'student/student_exam_schedule_view';
        $this->load->view($this->template, $data);
    }
    public function parent_correspond()
    {
        $data['title'] = 'SMS';
        $data['sidebar'] = 'parents/parent_sidebar';
        $data['topnavigation'] = 'parents/parent_topnavigation';
        $data['eventnotif'] = $this->Parent_model->getAllEventsCount($this->nativesession->get('id'),$this->nativesession->get('lastlogin'));
        $data['events'] = $this->Parent_model->getAllEvents($this->nativesession->get('id'));
        $data['parent'] = $this->Parent_model->getProfileDataByID($this->nativesession->get('id'));
        $data['mails'] = $this->Parent_model->getAllInbox($this->nativesession->get('id'));
        $data['inbox'] = $this->Parent_model->getAllInbox($this->nativesession->get('id'));
        
        $student  = $this->Student_model->getProfileDataByID($this->nativesession->get('current_child_id'));
        $data['student'] = $student;
        $this->nativesession->set( 'classid', $student['classid'] );
        $data['grades']  = $this->Student_model->getAllGradeByStudentID($this->nativesession->get('current_child_id'));
        $data['studentGradeCourses']  = $this->Student_model->getAllClassesByStudentID($this->nativesession->get('current_child_id'));
        $data['courses'] = $this->Student_model->getStudentCourses($this->nativesession->get('classid'));

        $data['content'] = 'parents/parent_correspond_view';
        $this->load->view($this->template, $data);
    }

    /**
     * @param $id
     */
    public function parent_correspond_detail($id)
    {
        $id = $this->general->decryptParaID($id, 'correspond');
        $data['title'] = 'SMS';
        $data['sidebar'] = 'parents/parent_sidebar';
        $data['topnavigation'] = 'parents/parent_topnavigation';
        $data['eventnotif'] = $this->Parent_model->getAllEventsCount($this->nativesession->get('id'),$this->nativesession->get('lastlogin'));
        $data['events'] = $this->Parent_model->getAllEvents($this->nativesession->get('id'));
        $data['parent'] = $this->Parent_model->getProfileDataByID($this->nativesession->get('id'));
        $data['inbox'] = $this->Parent_model->getAllInbox($this->nativesession->get('id'));
        $mail = $this->Parent_model->getMailDetail($id);
        $data['mail'] = $mail;
        
        if($mail['receiver']==$this->nativesession->get('id')){
            $this->Parent_model->markAsRead($id);
        }
        
        
        $explodesend = str_split($mail['sender'],1);
        $explodesend = $explodesend[0];
        switch ($explodesend){
            case 't':
                $data['sender'] = $this->Teacher_model->getProfileDataByID($mail['sender']);
                break;

            case 'p':
                $data['sender'] = $this->Parent_model->getProfileDataByID($mail['sender']);
                break;
        }
        $explodereceive = str_split($mail['receiver'],1);
        $explodereceive = $explodereceive[0];
        switch ($explodereceive){
            case 't':
                $data['receiver'] = $this->Teacher_model->getProfileDataByID($mail['receiver']);
                break;

            case 'p':
                $data['receiver'] = $this->Parent_model->getProfileDataByID($mail['receiver']);
                break;
        }

        $student  = $this->Student_model->getProfileDataByID($this->nativesession->get('current_child_id'));
        $data['student'] = $student;
        $this->nativesession->set( 'classid', $student['classid'] );
        $data['grades']  = $this->Student_model->getAllGradeByStudentID($this->nativesession->get('current_child_id'));
        $data['studentGradeCourses']  = $this->Student_model->getAllClassesByStudentID($this->nativesession->get('current_child_id'));
        $data['courses'] = $this->Student_model->getStudentCourses($this->nativesession->get('classid'));

        $data['content'] = 'parents/parent_correspond_detail_view';
        $this->load->view($this->template, $data);
    }
    public function parent_correspond_compose()
    {
        $data['title'] = 'SMS';
        $data['sidebar'] = 'parents/parent_sidebar';
        $data['topnavigation'] = 'parents/parent_topnavigation';
        $data['eventnotif'] = $this->Parent_model->getAllEventsCount($this->nativesession->get('id'),$this->nativesession->get('lastlogin'));
        $data['events'] = $this->Parent_model->getAllEvents($this->nativesession->get('id'));
        $data['parent'] = $this->Parent_model->getProfileDataByID($this->nativesession->get('id'));
        $data['inbox'] = $this->Parent_model->getAllInbox($this->nativesession->get('id'));
        $data['teacherList'] = $this->Teacher_model->getAllTeacher();

        $data['subject'] = '';
        $data['receiver'] = '';
        $data['text'] = '';
        $data['reply'] = '0';


        $this->form_validation->set_rules('receiver', 'Receiver', 'required');
        $this->form_validation->set_rules('subject', 'Subject', 'required');
        $this->form_validation->set_rules('text', 'Text', 'required');
        $this->form_validation->set_error_delimiters('', '<br/>');

        if ($this->form_validation->run() == TRUE) {
            $latestID = $this->Parent_model->getCorrespondLatestID();
            $latestID = $latestID['correspondid'];
            $latestID = substr($latestID, 1);
            $correspondID = 'c'.str_pad((int) $latestID+1, 6, "0", STR_PAD_LEFT);

            if (!empty($_FILES['images']['name'][0])) {
                if ($this->upload_files($correspondID, $_FILES['images']) === FALSE) {
                    $data['error'] = $this->nativesession->set('error', $this->upload->display_errors());
                    redirect(current_url());
                }
            }

            if (!isset($data['error'])) {
                $this->Parent_model->addCorrespond($correspondID, $this->nativesession->get('id'));
                $this->nativesession->set('success', 'Message successfully sent');
                redirect('parents/parent_correspond');
            }
        }
        if(!empty($_POST)){
            $data['subject'] = $this->input->post('subject');
            $data['receiver'] = $this->input->post('receiver');
            $data['text'] = $this->input->post('text');
        }

        $student  = $this->Student_model->getProfileDataByID($this->nativesession->get('current_child_id'));
        $data['student'] = $student;
        $this->nativesession->set( 'classid', $student['classid'] );
        $data['grades']  = $this->Student_model->getAllGradeByStudentID($this->nativesession->get('current_child_id'));
        $data['studentGradeCourses']  = $this->Student_model->getAllClassesByStudentID($this->nativesession->get('current_child_id'));
        $data['courses'] = $this->Student_model->getStudentCourses($this->nativesession->get('classid'));

        $data['content'] = 'parents/parent_correspond_compose_view';
        $this->load->view($this->template, $data);
    }
    public function parent_correspond_reply()
    {
        $id = $this->nativesession->get('tempID');
        $id = $this->general->decryptParaID($id, 'correspond');
        $data['title'] = 'SMS';
        $data['sidebar'] = 'parents/parent_sidebar';
        $data['topnavigation'] = 'parents/parent_topnavigation';
        $data['eventnotif'] = $this->Parent_model->getAllEventsCount($this->nativesession->get('id'),$this->nativesession->get('lastlogin'));
        $data['events'] = $this->Parent_model->getAllEvents($this->nativesession->get('id'));
        $data['parent'] = $this->Parent_model->getProfileDataByID($this->nativesession->get('id'));
        $data['inbox'] = $this->Parent_model->getAllInbox($this->nativesession->get('id'));
        $data['teacherList'] = $this->Teacher_model->getAllTeacher();
        $mail = $this->Parent_model->getMailDetail($id);

        $data['subject'] = 'RE: '.$mail['subject'];
        $data['receiver'] = $mail['sender'];
        $data['text'] = PHP_EOL.PHP_EOL.'--------------PREVIOUS MESSAGE--------------'.PHP_EOL.$mail['text'];
        $data['reply'] = '1';


        $this->form_validation->set_rules('receiver', 'Receiver', 'required');
        $this->form_validation->set_rules('subject', 'Subject', 'required');
        $this->form_validation->set_rules('text', 'Text', 'required');
        $this->form_validation->set_error_delimiters('', '<br/>');

        if ($this->form_validation->run() == TRUE) {
            $latestID = $this->Parent_model->getCorrespondLatestID();
            $latestID = $latestID['correspondid'];
            $latestID = substr($latestID, 1);
            $correspondID = 'c'.str_pad((int) $latestID+1, 6, "0", STR_PAD_LEFT);

            if (!empty($_FILES['images']['name'][0])) {
                if ($this->upload_files($correspondID, $_FILES['images']) === FALSE) {
                    $data['error'] = $this->nativesession->set('error', $this->upload->display_errors());
                    redirect(current_url());
                }
            }

            if (!isset($data['error'])) {
                $this->Parent_model->addCorrespond($correspondID, $this->nativesession->get('id'));
                $this->nativesession->set('success', 'Message successfully sent');
                redirect('parents/parent_correspond');
            }
        }
        if(!empty($_POST)){
            $data['subject'] = $this->input->post('subject');
            $data['receiver'] = $this->input->post('receiver');
            $data['text'] = $this->input->post('text');
        }

        $student  = $this->Student_model->getProfileDataByID($this->nativesession->get('current_child_id'));
        $data['student'] = $student;
        $this->nativesession->set( 'classid', $student['classid'] );
        $data['grades']  = $this->Student_model->getAllGradeByStudentID($this->nativesession->get('current_child_id'));
        $data['studentGradeCourses']  = $this->Student_model->getAllClassesByStudentID($this->nativesession->get('current_child_id'));
        $data['courses'] = $this->Student_model->getStudentCourses($this->nativesession->get('classid'));

        $data['content'] = 'parents/parent_correspond_compose_view';
        $this->load->view($this->template, $data);
    }
    public function parent_correspond_forward()
    {
        $id = $this->nativesession->get('tempID');
        $id = $this->general->decryptParaID($id, 'correspond');
        $data['title'] = 'SMS';
        $data['sidebar'] = 'parents/parent_sidebar';
        $data['topnavigation'] = 'parents/parent_topnavigation';
        $data['eventnotif'] = $this->Parent_model->getAllEventsCount($this->nativesession->get('id'),$this->nativesession->get('lastlogin'));
        $data['events'] = $this->Parent_model->getAllEvents($this->nativesession->get('id'));
        $data['parent'] = $this->Parent_model->getProfileDataByID($this->nativesession->get('id'));
        $data['inbox'] = $this->Parent_model->getAllInbox($this->nativesession->get('id'));
        $data['teacherList'] = $this->Teacher_model->getAllTeacher();
        $mail = $this->Parent_model->getMailDetail($id);

        $data['subject'] = $mail['subject'];
        $data['receiver'] = '';
        $data['text'] = $mail['text'];
        $data['reply'] = '2';


        $this->form_validation->set_rules('receiver', 'Receiver', 'required');
        $this->form_validation->set_rules('subject', 'Subject', 'required');
        $this->form_validation->set_rules('text', 'Text', 'required');
        $this->form_validation->set_error_delimiters('', '<br/>');

        if ($this->form_validation->run() == TRUE) {
            $latestID = $this->Parent_model->getCorrespondLatestID();
            $latestID = $latestID['correspondid'];
            $latestID = substr($latestID, 1);
            $correspondID = 'c'.str_pad((int) $latestID+1, 6, "0", STR_PAD_LEFT);

            if (!empty($_FILES['images']['name'][0])) {
                if ($this->upload_files($correspondID, $_FILES['images']) === FALSE) {
                    $data['error'] = $this->nativesession->set('error', $this->upload->display_errors());
                    redirect(current_url());
                }
            }

            if (!isset($data['error'])) {
                $this->Parent_model->addCorrespond($correspondID, $this->nativesession->get('id'));
                $this->nativesession->set('success', 'Message successfully sent');
                redirect('parents/parent_correspond');
            }
        }

        if(!empty($_POST)){
            $data['subject'] = $this->input->post('subject');
            $data['receiver'] = $this->input->post('receiver');
            $data['text'] = $this->input->post('text');
        }
        $student  = $this->Student_model->getProfileDataByID($this->nativesession->get('current_child_id'));
        $data['student'] = $student;
        $this->nativesession->set( 'classid', $student['classid'] );
        $data['grades']  = $this->Student_model->getAllGradeByStudentID($this->nativesession->get('current_child_id'));
        $data['studentGradeCourses']  = $this->Student_model->getAllClassesByStudentID($this->nativesession->get('current_child_id'));
        $data['courses'] = $this->Student_model->getStudentCourses($this->nativesession->get('classid'));

        $data['content'] = 'parents/parent_correspond_compose_view';
        $this->load->view($this->template, $data);
    }
    private function upload_files($id, $files)
    {
        if (!file_exists($this->correspondpath.$id)) {
            mkdir($this->correspondpath.$id, 0777, true);
        }
        $pathID = $this->correspondpath.$id;
        $config = array(
            'upload_path'   => $pathID,
            'allowed_types' => 'doc|docx|pdf|ppt|pptx|xlsx|xls|jpg|jpeg|png|gdoc|gsheet|gslides',
            'overwrite'     => 1,
            'max_size'      => 200000,
        );

        $this->load->library('upload', $config);
        foreach ($files['name'] as $key => $image) {
            $_FILES['images[]']['name']= $files['name'][$key];
            $_FILES['images[]']['type']= $files['type'][$key];
            $_FILES['images[]']['tmp_name']= $files['tmp_name'][$key];
            $_FILES['images[]']['error']= $files['error'][$key];
            $_FILES['images[]']['size']= $files['size'][$key];

            $fileName = $image;

            $images[] = $fileName;
            $config['file_name'] = $fileName;

            $this->upload->initialize($config);

            if ($this->upload->do_upload('images[]')) {
                $data = $this->upload->data();
                $filename = $data['orig_name'];
                $this->Parent_model->addCorrespondAttachment($id, $filename);
            } else {
                return false;
            }
        }

        return true;
    }
    public function downloadAll($correspondid){
        $this->load->library('zip');

        $mail = $this->Parent_model->getMailDetail($correspondid);
        $path = 'assets/file/correspond/'.$correspondid.'/';

//        $this->zip->add_dir($mail['subject'].'.zip'); // Creates a directory called "myfolder"
        $this->zip->read_dir($path, false);

// Download the file to your desktop. Name it "my_backup.zip"
        $this->zip->download($mail['subject'].'.zip');
    }
    public function parent_correspond_sent()
    {
        $data['title'] = 'SMS';
        $data['sidebar'] = 'parents/parent_sidebar';
        $data['topnavigation'] = 'parents/parent_topnavigation';
        $data['eventnotif'] = $this->Parent_model->getAllEventsCount($this->nativesession->get('id'),$this->nativesession->get('lastlogin'));
        $data['events'] = $this->Parent_model->getAllEvents($this->nativesession->get('id'));
        $data['parent'] = $this->Parent_model->getProfileDataByID($this->nativesession->get('id'));
        $data['mails'] = $this->Parent_model->getAllSent($this->nativesession->get('id'));
        $data['inbox'] = $this->Parent_model->getAllInbox($this->nativesession->get('id'));

        $student  = $this->Student_model->getProfileDataByID($this->nativesession->get('current_child_id'));
        $data['student'] = $student;
        $this->nativesession->set( 'classid', $student['classid'] );
        $data['grades']  = $this->Student_model->getAllGradeByStudentID($this->nativesession->get('current_child_id'));
        $data['studentGradeCourses']  = $this->Student_model->getAllClassesByStudentID($this->nativesession->get('current_child_id'));
        $data['courses'] = $this->Student_model->getStudentCourses($this->nativesession->get('classid'));

        $data['content'] = 'parents/parent_correspond_sent_view';
        $this->load->view($this->template, $data);
    }
    public function add_correspond()
    {
        $this->form_validation->set_rules('receiver', 'Receiver', 'required');
        $this->form_validation->set_rules('subject', 'Subject', 'required');
        $this->form_validation->set_rules('text', 'Text', 'required');
        $this->form_validation->set_error_delimiters('', '<br/>');

        if ($this->form_validation->run() == TRUE) {
            $latestID = $this->Parent_model->getCorrespondLatestID();
            $latestID = $latestID['correspondid'];
            $latestID = substr($latestID, 1);
            $correspondID = 'c'.str_pad((int) $latestID+1, 6, "0", STR_PAD_LEFT);
            if ($_FILES['userfile']['error'] != 4) {
                $config['upload_path'] = $this->correspondpath;
                $config['allowed_types'] = "doc|docx|pdf|ppt|pptx|xlsx|xls|jpg|jpeg|png|gdoc|gsheet|gslides";
                $config['max_size'] = 200000;
                $config['overwrite'] = TRUE;
                $config['file_name'] = $correspondID;
                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('attachment')) {
                    $this->nativesession->set('error', $this->upload->display_errors());
                    redirect(current_url());
                } else {
                    $data = $this->upload->data();
                    $filename = $data['orig_name'];
                    if ($this->Parent_model->addCorrespond($correspondID, $this->nativesession->get('id'), $filename)) {
                    } else {
                        $this->nativesession->set('error', 'There is a problem, please check the required field. If there are attachment, make sure the file has proper file type.');
                        redirect(current_url());
                    }
                }
            }
            redirect('parents/parent_correspond');
        }
    }

    private function uploadTransferReceipt($name)
    {
        if ($_FILES['userfile']['error'] != 4) {
            $config['upload_path'] = $this->transferpath;
            $config['allowed_types'] = "jpg|jpeg|png";
            $config['max_size'] = 200000;
            $config['overwrite'] = TRUE;
            $config['file_name'] = $name;
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('userfile')) {

                $this->nativesession->set('error', $this->upload->display_errors());
                redirect(current_url());
            } else {
                $data = $this->upload->data();
                $config_image = array(
                    'image_library' => 'gd2',
                    'source_image' => $this->transferpath . '/' . $data['orig_name'],
                    'new_image' => $this->transferpath . '/' . $data['orig_name'],
                    'maintain_ratio' => TRUE,
                    'rotate_by_exif' => TRUE
                    //                'strip_exif' => TRUE,
                );
                $this->load->library('image_lib', $config_image);
                $this->image_lib->resize();

                $filename = $data['orig_name'];
                $payments = $this->Parent_model->getPaymentStatus($this->nativesession->get('id'));
                foreach($payments as $paymentss) {
                    $this->Parent_model->addTransferReceipt($paymentss['paymentid'], $filename);
                    $this->Parent_model->setTransferTransaction($paymentss['paymentid']);
                }
            }
        }
        $this->nativesession->set('success', 'Successfully Uploaded, confirmation will be sent to your email');
        redirect('parents/payment_status');
    }
    public function payment_status()
    {
        $data['title'] = 'SMS';
        $data['sidebar'] = 'parents/parent_sidebar';
        $data['topnavigation'] = 'parents/parent_topnavigation';
        $data['eventnotif'] = $this->Parent_model->getAllEventsCount($this->nativesession->get('id'),$this->nativesession->get('lastlogin'));
        $data['events'] = $this->Parent_model->getAllEvents($this->nativesession->get('id'));
        $data['parent'] = $this->Parent_model->getProfileDataByID($this->nativesession->get('id'));
        $data['inbox'] = $this->Parent_model->getAllInbox($this->nativesession->get('id'));

        $payments = $this->Parent_model->getPaymentStatus($this->nativesession->get('id'));
        $data['payments'] = $payments;
        $name = '';
        if($payments){
            foreach($payments as $paymentss) {
                $name = $name.$paymentss['paymentid'];
            }
            if(!empty($_POST)) {
                $this->uploadTransferReceipt($name);
            }
        }

        $student  = $this->Student_model->getProfileDataByID($this->nativesession->get('current_child_id'));
        $data['student'] = $student;
        $this->nativesession->set( 'classid', $student['classid'] );
        $data['grades']  = $this->Student_model->getAllGradeByStudentID($this->nativesession->get('current_child_id'));
        $data['studentGradeCourses']  = $this->Student_model->getAllClassesByStudentID($this->nativesession->get('current_child_id'));
        $data['courses'] = $this->Student_model->getStudentCourses($this->nativesession->get('classid'));
        $data['content'] = 'parents/payment_status_view';
        $this->load->view($this->template, $data);
    }
    public function payment_receipt()
    {
        $data['title'] = 'SMS';
        $data['sidebar'] = 'parents/parent_sidebar';
        $data['topnavigation'] = 'parents/parent_topnavigation';
        $data['eventnotif'] = $this->Parent_model->getAllEventsCount($this->nativesession->get('id'),$this->nativesession->get('lastlogin'));
        $data['events'] = $this->Parent_model->getAllEvents($this->nativesession->get('id'));
        $data['parent'] = $this->Parent_model->getProfileDataByID($this->nativesession->get('id'));
        $data['inbox'] = $this->Parent_model->getAllInbox($this->nativesession->get('id'));

        $data['payments'] = $this->Parent_model->getPaymentHistory($this->nativesession->get('id'));

        $student  = $this->Student_model->getProfileDataByID($this->nativesession->get('current_child_id'));
        $data['student'] = $student;
        $this->nativesession->set( 'classid', $student['classid'] );
        $data['grades']  = $this->Student_model->getAllGradeByStudentID($this->nativesession->get('current_child_id'));
        $data['studentGradeCourses']  = $this->Student_model->getAllClassesByStudentID($this->nativesession->get('current_child_id'));
        $data['courses'] = $this->Student_model->getStudentCourses($this->nativesession->get('classid'));
        $data['content'] = 'parents/payment_receipt_view';
        $this->load->view($this->template, $data);
    }
    public function logout(){
        $this->nativesession->delete('id');
        $this->nativesession->delete('name');
        $this->nativesession->delete('photo');
        $this->nativesession->delete('lastlogin');
        $this->nativesession->delete('is_login');
        $this->nativesession->delete('current_child_id');
        $this->nativesession->delete('current_child_name');
        redirect('');
    }
}