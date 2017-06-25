<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class student extends CI_Controller {

    var $template = 'template';
    var $profilephotopath = 'assets/img/student/';
    var $homeworkpath = 'assets/file/teacher/qna/homework/';
    var $quizpath = 'assets/file/teacher/qna/quiz/';
    var $classworkpath = 'assets/file/teacher/qna/classwork/';
    var $assignmentpath = 'assets/file/teacher/qna/assignment/';
    var $formpath = 'assets/file/forms/';
    var $eventimagepath = 'assets/img/texteditor/';

    function __construct() {
        parent::__construct();
//        $this->general->StudentLogin();
        $this->load->model('Student_model');
        $this->load->model('Teacher_model');
    }

    public function home()
    {
        $data['title'] = 'Student SMS';
        $data['courses'] = $this->Student_model->getStudentCourses($this->nativesession->get('classid'));
        $data['sidebar'] = 'student/student_sidebar';
        $data['student']  = $this->Student_model->getProfileDataByID($this->nativesession->get('id'));
        $data['grades']  = $this->Student_model->getAllGradeByStudentID($this->nativesession->get('id'));
        $data['studentGradeCourses']  = $this->Student_model->getAllClassesByStudentID($this->nativesession->get('id'));
        $data['topnavigation'] = 'student/student_topnavigation';
        $data['eventnotif'] = $this->Student_model->getAllEventsCount($this->nativesession->get('id'),$this->nativesession->get('lastlogin'));

        $data['events'] = $this->Student_model->getAllEvents($this->nativesession->get('id'), $this->nativesession->get('classid'));
        $data['content'] = 'student/student_home_view';
        $this->load->view($this->template, $data);
    }

    public function learning_attendance()
    {
        $data['title'] = 'Student LMS';
        $data['sidebar'] = 'student/student_sidebar';
        $data['student']  = $this->Student_model->getProfileDataByID($this->nativesession->get('id'));
        $data['grades']  = $this->Student_model->getAllGradeByStudentID($this->nativesession->get('id'));
        $data['studentGradeCourses']  = $this->Student_model->getAllClassesByStudentID($this->nativesession->get('id'));
        $data['topnavigation'] = 'student/student_topnavigation';
        $data['attendances'] = $this->Student_model->getAttendanceList($this->nativesession->get('classid'),$this->nativesession->get('id'));
        $data['eventnotif'] = $this->Student_model->getAllEventsCount($this->nativesession->get('id'),$this->nativesession->get('lastlogin'));

        $data['content'] = 'student/learning_attendance_view';
        $this->load->view($this->template, $data);
    }

    public function editFeedback($ecourseid, $eassignid){
        $stid = $this->general->decryptParaID($this->nativesession->get('id'), 'student');
        $assignid = $this->general->decryptParaID($eassignid, 'courseassigned');

        $this->form_validation->set_rules('feedback', 'feedback', 'required');

        $this->form_validation->set_error_delimiters('', '<br/>');
        if ($this->form_validation->run() == TRUE) {
            $this->Student_model->editFeedback($stid, $assignid);
            $this->nativesession->set('success', 'Feedback saved');
            redirect('student/courseView/' . $ecourseid);
        }
        else {
            $this->nativesession->set('error', 'All field are required');
            redirect('student/courseView/' . $ecourseid);
        }
    }

    public function submitFeedback($ecourseid, $eassignid, $null){
        $stid = $this->nativesession->get('id');
        $assignid = $this->general->decryptParaID($eassignid, 'courseassigned');

        $this->form_validation->set_rules('feedback', 'feedback', 'required');

        $this->form_validation->set_error_delimiters('', '<br/>');
        if ($this->form_validation->run() == TRUE) {
            if($null) {
                $this->Student_model->addFeedback($stid, $assignid);
            } else {
                $this->Student_model->editFeedback($stid, $assignid);
            }

            $this->nativesession->set('success', 'Feedback saved');
           redirect('student/courseView/' . $ecourseid);
        }
        else {
            $this->nativesession->set('error', 'All field are required');
            redirect('student/courseView/' . $ecourseid);
        }
    }

    public function courseView($id)
    {
        $id = $this->general->decryptParaID($id, 'course');
        $data['title'] = 'Student LMS';
        $data['sidebar'] = 'student/student_sidebar';
        $data['grades']  = $this->Student_model->getAllGradeByStudentID($this->nativesession->get('id'));
        $data['studentGradeCourses']  = $this->Student_model->getAllClassesByStudentID($this->nativesession->get('id'));
        $data['course'] = $this->Student_model->getCourseDataByID($id, $this->nativesession->get('classid'));
        $data['course_plan'] = $this->Student_model->getCoursePlanDataByID($id);
        $data['student']  = $this->Student_model->getProfileDataByID($this->nativesession->get('id'));
        $data['eventnotif'] = $this->Student_model->getAllEventsCount($this->nativesession->get('id'),$this->nativesession->get('lastlogin'));

        $assignid = $this->Student_model->getAssignidByCourse($id,$this->nativesession->get('classid'));
        $feedback = $this->Student_model->getFeedback($this->nativesession->get('id'),$assignid['assignid']);
//        $data['feedback'] = $this->Student_model->getFeedback($this->nativesession->get('id'),$assignid['assignid']);
        if($feedback==NULL) {
            $data['feedback'] = null;
        } else {
            $data['feedback'] = $feedback['feedback'];
        }

        $data['topnavigation'] = 'student/student_topnavigation';
        $data['top2navigation'] = 'student/student_top2navigation';
        $data['content'] = 'student/student_course_view';

        $this->load->view($this->template, $data);
    }

    public function coursePlan($id)
    {
        $id = $this->general->decryptParaID($id, 'course');
        $data['title'] = 'Student LMS';
        $data['sidebar'] = 'student/student_sidebar';
        $data['grades']  = $this->Student_model->getAllGradeByStudentID($this->nativesession->get('id'));
        $data['studentGradeCourses']  = $this->Student_model->getAllClassesByStudentID($this->nativesession->get('id'));
        $data['course'] = $this->Student_model->getCourseDataByID($id, $this->nativesession->get('classid'));
        $data['course_plan'] = $this->Student_model->getCoursePlanDataByID($id);
        $data['student']  = $this->Student_model->getProfileDataByID($this->nativesession->get('id'));
        $data['eventnotif'] = $this->Student_model->getAllEventsCount($this->nativesession->get('id'),$this->nativesession->get('lastlogin'));
        $data['topnavigation'] = 'student/student_topnavigation';
        $data['top2navigation'] = 'student/student_top2navigation';
        $data['content'] = 'student/student_course_plan_view';
        $this->load->view($this->template, $data);
    }

    public function courseImplementation($id)
    {
        $id = $this->general->decryptParaID($id, 'course');
        $data['title'] = 'Student LMS';
        $data['sidebar'] = 'student/student_sidebar';
        $data['grades']  = $this->Student_model->getAllGradeByStudentID($this->nativesession->get('id'));
        $data['studentGradeCourses']  = $this->Student_model->getAllClassesByStudentID($this->nativesession->get('id'));
        $data['course'] = $this->Student_model->getCourseDataByID($id, $this->nativesession->get('classid'));
        $data['course_implementation'] = $this->Student_model->getCourseImplementationData($id, $this->nativesession->get('classid'));
        $data['student']  = $this->Student_model->getProfileDataByID($this->nativesession->get('id'));
        $data['eventnotif'] = $this->Student_model->getAllEventsCount($this->nativesession->get('id'),$this->nativesession->get('lastlogin'));
        $data['topnavigation'] = 'student/student_topnavigation';
        $data['top2navigation'] = 'student/student_top2navigation';
        $data['content'] = 'student/student_course_implementation_view';
        $this->load->view($this->template, $data);
    }

    public function courseMaterial($id)
    {
        $id = $this->general->decryptParaID($id, 'course');
        $data['title'] = 'Student LMS';
        $data['sidebar'] = 'student/student_sidebar';
        $data['grades']  = $this->Student_model->getAllGradeByStudentID($this->nativesession->get('id'));
        $data['studentGradeCourses']  = $this->Student_model->getAllClassesByStudentID($this->nativesession->get('id'));
        $data['materials'] = $this->Student_model->getSharedMaterialsByCourseID($id, $this->nativesession->get('classid'));
        $data['course'] = $this->Student_model->getCourseDataByID($id, $this->nativesession->get('classid'));
        $data['student']  = $this->Student_model->getProfileDataByID($this->nativesession->get('id'));
        $data['eventnotif'] = $this->Student_model->getAllEventsCount($this->nativesession->get('id'),$this->nativesession->get('lastlogin'));
        $data['topnavigation'] = 'student/student_topnavigation';
        $data['top2navigation'] = 'student/student_top2navigation';
        $data['content'] = 'student/student_course_material_view';
        $this->load->view($this->template, $data);
    }

    public function courseAssignmentQuiz($id)
    {
        $id = $this->general->decryptParaID($id, 'course');
        $data['title'] = 'Student LMS';
        $data['sidebar'] = 'student/student_sidebar';
        $data['grades']  = $this->Student_model->getAllGradeByStudentID($this->nativesession->get('id'));
        $data['studentGradeCourses']  = $this->Student_model->getAllClassesByStudentID($this->nativesession->get('id'));
        $data['qnas'] = $this->Student_model->getAssignmentAndQuizesByCourseID($id, $this->nativesession->get('classid'));
        $data['course'] = $this->Student_model->getCourseDataByID($id, $this->nativesession->get('classid'));
        $data['student']  = $this->Student_model->getProfileDataByID($this->nativesession->get('id'));
        $data['eventnotif'] = $this->Student_model->getAllEventsCount($this->nativesession->get('id'),$this->nativesession->get('lastlogin'));
        $data['topnavigation'] = 'student/student_topnavigation';
        $data['top2navigation'] = 'student/student_top2navigation';
        $data['submissions'] = $this->Student_model->getSubmission($this->nativesession->get('id'), $this->nativesession->get('classid'));
        $data['content'] = 'student/student_course_qna_view';
        $this->load->view($this->template, $data);
    }

    public function courseStudent($id)
    {
        $id = $this->general->decryptParaID($id, 'course');

        $data['title'] = 'Student LMS';
        $data['sidebar'] = 'student/student_sidebar';
        $data['grades']  = $this->Student_model->getAllGradeByStudentID($this->nativesession->get('id'));
        $data['studentGradeCourses']  = $this->Student_model->getAllClassesByStudentID($this->nativesession->get('id'));
        $data['course'] = $this->Student_model->getCourseDataByID($id, $this->nativesession->get('classid'));
        $data['courseStudents'] = $this->Student_model->getAllStudentByClassID($this->nativesession->get('classid'));
        $data['student']  = $this->Student_model->getProfileDataByID($this->nativesession->get('id'));
        $data['eventnotif'] = $this->Student_model->getAllEventsCount($this->nativesession->get('id'),$this->nativesession->get('lastlogin'));
        $data['topnavigation'] = 'student/student_topnavigation';
        $data['top2navigation'] = 'student/student_top2navigation';
        $data['content'] = 'student/student_course_student_view';
        $this->load->view($this->template, $data);
    }

    public function courseAssignmentQuizSubmission($id)
    {
        $id = $this->general->decryptParaID($id, 'anq');
        $this->form_validation->set_rules('topic', 'topic', 'required');
        $this->form_validation->set_rules('type', 'type', 'required');
        $this->form_validation->set_rules('duedate', 'due date', 'required');

        $fileID = 'f';

        if ($this->form_validation->run() == TRUE) {

//            $type = "QUIZ";
            $type = $this->input->post('type');
            $topic = $this->input->post('topic');
//            $topic = "SD";
            $teacher = $this->input->post('teacherid');
            $studentid= $this->input->post('studentid');


            if (empty($_FILES['userfile']['name'])){
                $this->nativesession->set('error', 'File is required');
                redirect(current_url());
            }
            else{
                $latestID = $this->Student_model->getQnALatestID();
                $latestID = $latestID['anqid'];
                $latestID = substr($latestID, 1);
                $materialID = 'a'.str_pad((int) $latestID+1, 4, "0", STR_PAD_LEFT);
                if ($_FILES['userfile']['error'] != 4) {



                    if($type=='QUIZ') {
                        $config['upload_path'] = $this->quizpath;
                    } else if($type='Assignment') {
                        $config['upload_path'] = $this->assignmentpath;
                    } else if($type='Classwork') {
                        $config['upload_path'] = $this->classworkpath;
                    } else if($type='Homework') {
                        $config['upload_path'] = $this->homeworkpath;
                    }
                    $config['allowed_types'] = "doc|pdf|docx";
                    $config['max_size'] = 200000;
                    $config['overwrite'] = TRUE;
                    $config['file_name'] = $topic.'_'.$studentid;
                    $this->load->library('upload', $config);
                    echo $config['upload_path'];

                    if (!$this->upload->do_upload('userfile')) {
                        $this->nativesession->set('error', $this->upload->display_errors());
                        redirect(current_url());
//                        echo "gaal";
                    } else {
                        $data = $this->upload->data();
                        $filename = $topic.'_'.$studentid;
                        $latestID = $this->Student_model->getFileLatestID();
                        $latestID = $latestID['fileid'];
                        $latestID = substr($latestID, 1);
                        $fileID = 'f'.str_pad((int) $latestID+1, 4, "0", STR_PAD_LEFT);



                        $this->Student_model->addFile($fileID, $filename, $teacher);
                        $newfile = true;
                        $this->nativesession->set('success', 'File Uploaded');
//                        echo "berahs";

                    }
                }
                if($result = $this->Student_model->checkSubmission($id, $studentid)){
                    $this->Student_model->editSubmission($id, $studentid, $fileID);
                }
                else{

                    $nlatestID = $this->Student_model->getSubmissionLatestID();
                    echo $nlatestID[0];
                    $nlatestID = $nlatestID['anqscoreid'];
                    $nlatestID = substr($nlatestID, 1);
                    $nid = 'n'.str_pad((int) $nlatestID+1, 4, "0", STR_PAD_LEFT);

                    $this->Student_model->addSubmission($nid, $fileID);
                }
                $this->nativesession->set('success', 'File updated');
                $qid = $this->Student_model->checkSubmission($id, $studentid);
                $qid = $qid['anqid'];

//                $eid = $this->general->encryptParaID($id, 'courseassigned');
                $qid = $this->general->encryptParaID($id, 'anq');
                redirect('student/courseAssignmentQuizSubmission/'.$qid);
            }
        }

        $data['title'] = 'Student LMS';
        $data['sidebar'] = 'student/student_sidebar';
        $data['grades']  = $this->Student_model->getAllGradeByStudentID($this->nativesession->get('id'));
        $data['studentGradeCourses']  = $this->Student_model->getAllClassesByStudentID($this->nativesession->get('id'));
        $data['anqID'] =  $id;
        $data['anqData'] = $this->Student_model->getAssignmentAndQuizDataByANQID($id);
        $courseID = $this->Student_model->getAssignIDByANQID($id);
        $data['course'] = $this->Student_model->getCourseDataByAssignID($courseID['assignid']);
        $assignID = $this->Student_model->getAssignIDByANQID($id);
        $teacherID = $this->Student_model->getTeacherByAssignID($assignID['assignid']);
        $data['teacherid'] = $teacherID['teacherid'];
        $data['student']  = $this->Student_model->getProfileDataByID($this->nativesession->get('id'));
        $data['eventnotif'] = $this->Student_model->getAllEventsCount($this->nativesession->get('id'),$this->nativesession->get('lastlogin'));
        $data['topnavigation'] = 'student/student_topnavigation';
        $data['top2navigation'] = 'student/student_top2navigation';
        $data['content'] = 'student/student_course_qna_add_view';
        $this->load->view($this->template, $data);
    }

    public function learningReport($term,$grade)
    {
        $allattendance = $this->Student_model->getTotalAttendance($this->nativesession->get('id'));
        $present = $this->Student_model->getTotalPresentByStudent($this->nativesession->get('id'));
        $attendancepercentage = $present/$allattendance*100;

        $data['title'] = 'Student LMS';
        $data['sidebar'] = 'student/student_sidebar';
        $data['student']  = $this->Student_model->getProfileDataByID($this->nativesession->get('id'));
        $data['eventnotif'] = $this->Student_model->getAllEventsCount($this->nativesession->get('id'),$this->nativesession->get('lastlogin'));
        $data['grades']  = $this->Student_model->getAllGradeByStudentID($this->nativesession->get('id'));
        $data['reportGrade']  = $grade;
        $data['reportTerm']  = $term;
        $data['attendance'] = $attendancepercentage;
        $data['report']  = $this->Student_model->getStudentReport($this->nativesession->get('id'),$term,$grade);
        $data['studentCoursesOnGrade']  = $this->Student_model->getStudentCourseOnGrade($this->nativesession->get('id'),$grade);
        $data['studentGradeCourses']  = $this->Student_model->getAllClassesByStudentID($this->nativesession->get('id'));
        $data['topnavigation'] = 'student/student_topnavigation';
        $data['content'] = 'student/student_report_view';
        $this->load->view($this->template, $data);
    }

    public function learningReport2($term,$grade)
    {
        $allattendance = $this->Student_model->getTotalAttendance($this->nativesession->get('id'));
        $present = $this->Student_model->getTotalPresentByStudent($this->nativesession->get('id'));
        $attendancepercentage = $present/$allattendance*100;

        $data['title'] = 'Student LMS';
        $data['sidebar'] = 'student/student_sidebar';
        $data['student']  = $this->Student_model->getProfileDataByID($this->nativesession->get('id'));
        $data['eventnotif'] = $this->Student_model->getAllEventsCount($this->nativesession->get('id'),$this->nativesession->get('lastlogin'));
        $data['grades']  = $this->Student_model->getAllGradeByStudentID($this->nativesession->get('id'));
        $data['reportGrade']  = $grade;
        $data['reportTerm']  = $term;
        $data['attendance'] = $attendancepercentage;
        $data['report']  = $this->Student_model->getStudentReport($this->nativesession->get('id'),$term,$grade);
        $data['studentCoursesOnGrade']  = $this->Student_model->getStudentCourseOnGrade($this->nativesession->get('id'),$grade);
        $data['studentGradeCourses']  = $this->Student_model->getAllClassesByStudentID($this->nativesession->get('id'));
        $data['topnavigation'] = 'student/student_topnavigation';
        $data['content'] = 'student/student_report2_view';
        $this->load->view($this->template, $data);
    }

    public function coursePerformance($assignid){
        $assignid = $this->general->decryptParaID($assignid, 'courseassigned');
        $studentid = $this->general->decryptParaID($this->nativesession->get('id'), 'student');
        $eid = $this->general->encryptParaID($assignid, 'courseassigned');
        $esid = $this->general->encryptParaID($studentid, 'student');

        $class = $this->Student_model->getClassByStudentID($this->nativesession->get('id'));
        $class = explode('-', $class['classroom']);

        $data['homework'] = $this->Student_model->getAllQnAByStudent($this->nativesession->get('id'), 1);
        $data['classwork'] = $this->Student_model->getAllQnAByStudent($this->nativesession->get('id'), 2);
        $data['assessment'] = $this->Student_model->getAllQnAByStudent($this->nativesession->get('id'), 3);


        $data['title'] = 'Student LMS';
        $data['sidebar'] = 'student/student_sidebar';
        $data['grades']  = $this->Student_model->getAllGradeByStudentID($this->nativesession->get('id'));
        $data['studentGradeCourses']  = $this->Student_model->getAllClassesByStudentID($this->nativesession->get('id'));

        $data['course'] = $this->Student_model->getCourseDataByAssignID($assignid);
        $data['student']  = $this->Student_model->getProfileDataByID($this->nativesession->get('id'));
        $data['eventnotif'] = $this->Student_model->getAllEventsCount($this->nativesession->get('id'),$this->nativesession->get('lastlogin'));
        $data['topnavigation'] = 'student/student_topnavigation';

        $data['top2navigation'] = 'student/student_top2navigation';
//        $data['student'] = $this->Teacher_model->getStudentDataByStudentID($this->nativesession->get('id'));
        $data['report'] = $this->Student_model->getReportDataBy($assignid, $this->nativesession->get('id'));
        $data['content'] = 'student/student_course_performance_view';
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

        $data['title'] = 'Student LMS';
        $data['sidebar'] = 'student/student_sidebar';
        $data['grades']  = $this->Student_model->getAllGradeByStudentID($this->nativesession->get('id'));
        $data['studentGradeCourses']  = $this->Student_model->getAllClassesByStudentID($this->nativesession->get('id'));
        $data['student']  = $this->Student_model->getProfileDataByID($this->nativesession->get('id'));
        $data['eventnotif'] = $this->Student_model->getAllEventsCount($this->nativesession->get('id'),$this->nativesession->get('lastlogin'));
        $data['topnavigation'] = 'student/student_topnavigation';
//        $data['eventnotif'] = $this->Admin_model->getAllEventsCount($this->nativesession->get('id'),$this->nativesession->get('lastlogin'));

        $data['content'] = 'student/student_class_schedule_view';
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

        $data['title'] = 'Student LMS';
        $data['sidebar'] = 'student/student_sidebar';
        $data['grades']  = $this->Student_model->getAllGradeByStudentID($this->nativesession->get('id'));
        $data['studentGradeCourses']  = $this->Student_model->getAllClassesByStudentID($this->nativesession->get('id'));
        $data['student']  = $this->Student_model->getProfileDataByID($this->nativesession->get('id'));
        $data['topnavigation'] = 'student/student_topnavigation';
        $data['eventnotif'] = $this->Student_model->getAllEventsCount($this->nativesession->get('id'),$this->nativesession->get('lastlogin'));

        $data['classid'] =  $this->nativesession->get('classid');
        $data['content'] = 'student/student_exam_schedule_view';
        $this->load->view($this->template, $data);
    }

    public function forms()
    {
        $data['title'] = 'Student LMS';
        $data['sidebar'] = 'student/student_sidebar';
        $data['grades']  = $this->Student_model->getAllGradeByStudentID($this->nativesession->get('id'));
        $data['studentGradeCourses']  = $this->Student_model->getAllClassesByStudentID($this->nativesession->get('id'));
        $data['student']  = $this->Student_model->getProfileDataByID($this->nativesession->get('id'));
        $data['topnavigation'] = 'student/student_topnavigation';
        $data['eventnotif'] = $this->Student_model->getAllEventsCount($this->nativesession->get('id'),$this->nativesession->get('lastlogin'));

        $data['info_dbs'] = $this->Teacher_model->getAllForms();
        $data['content'] = 'student/student_forms_view';
        $this->load->view($this->template, $data);
    }

    public function student_profile($id)
    {
        $id = $this->general->decryptParaID($id, 'student');
        $data['title'] = 'Student LMS';
        $data['sidebar'] = 'student/student_sidebar';
        $data['grades']  = $this->Student_model->getAllGradeByStudentID($this->nativesession->get('id'));
        $data['studentGradeCourses']  = $this->Student_model->getAllClassesByStudentID($this->nativesession->get('id'));
        $data['student']  = $this->Student_model->getProfileDataByID($this->nativesession->get('id'));
        $data['eventnotif'] = $this->Student_model->getAllEventsCount($this->nativesession->get('id'),$this->nativesession->get('lastlogin'));
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
        $data['grades']  = $this->Student_model->getAllGradeByStudentID($this->nativesession->get('id'));
        $data['studentGradeCourses']  = $this->Student_model->getAllClassesByStudentID($this->nativesession->get('id'));
        $data['topnavigation'] = 'student/student_topnavigation';
        $data['eventnotif'] = $this->Student_model->getAllEventsCount($this->nativesession->get('id'),$this->nativesession->get('lastlogin'));
        $data['content'] = 'student/student_profile_edit_view';
        $data['info_db'] = $this->Student_model->getProfileDataByID($id);
        $this->load->view($this->template, $data);
    }

    public function events()
    {
        $data['title'] = 'SMS';
        $data['student']  = $this->Student_model->getProfileDataByID($this->nativesession->get('id'));

        $data['sidebar'] = 'student/student_sidebar';
        $data['grades']  = $this->Student_model->getAllGradeByStudentID($this->nativesession->get('id'));
        $data['studentGradeCourses']  = $this->Student_model->getAllClassesByStudentID($this->nativesession->get('id'));
        $data['topnavigation'] = 'student/student_topnavigation';
        $data['events'] = $this->Student_model->getAllEvents($this->nativesession->get('id'), $this->nativesession->get('classid'));
        $data['eventnotif'] = $this->Student_model->getAllEventsCount($this->nativesession->get('id'),$this->nativesession->get('lastlogin'));

        $data['content'] = 'student/student_event_view';
        $data['info_dbs'] = $this->Teacher_model->getAllEvents($this->nativesession->get('id'));
        $this->load->view($this->template, $data);
    }

    public function eventDetail($id)
    {
        $data['title'] = 'SMS';
        $data['student']  = $this->Student_model->getProfileDataByID($this->nativesession->get('id'));

        $data['sidebar'] = 'student/student_sidebar';
        $data['grades']  = $this->Student_model->getAllGradeByStudentID($this->nativesession->get('id'));
        $data['studentGradeCourses']  = $this->Student_model->getAllClassesByStudentID($this->nativesession->get('id'));
        $data['topnavigation'] = 'student/student_topnavigation';
        $data['events'] = $this->Student_model->getAllEvents($this->nativesession->get('id'), $this->nativesession->get('classid'));
        $data['eventnotif'] = $this->Student_model->getAllEventsCount($this->nativesession->get('id'),$this->nativesession->get('lastlogin'));
        $data['event'] = $this->Teacher_model->getEvent($id);

        $data['content'] = 'student/student_event_detail_view';
        $data['info_dbs'] = $this->Teacher_model->getAllEvents($this->nativesession->get('id'));
        $this->load->view($this->template, $data);
    }

    public function logout(){
        $this->nativesession->delete('id');
        $this->nativesession->delete('name');
        $this->nativesession->delete('photo');
//        $this->nativesession->delete('role');
        $this->nativesession->delete('lastlogin');
        $this->nativesession->delete('is_login');
        redirect('');
    }
}