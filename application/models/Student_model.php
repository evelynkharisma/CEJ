<?php
class Student_model extends CI_Model {

    var $table = 'student';
    var $course_table = 'course';
    var $course_assign_table = 'course_assign';
    var $attendance_table = 'attendance';
//    var $material_table = 'material';
    var $file_table = 'file';
    var $qna_table = 'assignmentandquiz';
    var $qnascore_table = 'assignmentandquizscore';
    var $lesson_plan_table = 'lesson_plan';
//    var $lesson_implementation_table = 'lesson_implementation';
    var $student_table = 'student';
    var $report_table = 'report';
//    var $class_table = 'class';
//    var $homeroom_table = 'homeroom';
//    var $semester_table = 'semester';
//    var $form_table = 'forms';
    var $event_table = 'events';
//    var $setting_table = 'settings';
    var $event_image_table = 'event_images';
    var $feedback_table = 'feedback';

    function __construct() {
        parent::__construct();
    }

    function checkLogin($username, $password) {
        $this->db->select('*');
        $this->db->where('studentid', $this->security->xss_clean($username));
//        $password = hash('sha512', $password);
        $password = crypt($this->security->xss_clean($password),'$6$rounds=5000$simsthesisproject$');
        $this->db->where('password', $password);
        $query = $this->db->get($this->table, 1);
//        echo $password;

        if ($query->num_rows() == 1) {
            return $query->row_array();
        }
    }

    function setCurrentLogin($id){
        $data = array(
            'currentlogin' => date('Y-m-d', now()),
        );

        $this->db->where('studentid', $id);
        $this->db->update($this->table, $data);

        return TRUE;
    }

    function changeLastLogin($id, $current){
        $data = array(
            'lastlogin' => $current,
        );

        $this->db->where('studentid', $id);
        $this->db->update($this->table, $data);

        return TRUE;
    }

    function getProfileDataByID($id) {
        $this->db->select('*');
        $this->db->where('studentid', $id);
        $query = $this->db->get($this->table, 1);

        if ($query->num_rows() == 1) {
            return $query->row_array();
        }
    }

    function editProfile($id) {
        if ($this->input->post('password')) {
            $data = array(
//                'password' => hash('sha512', $this->input->post('password')),
                'password' => crypt($this->input->post('password'),'$6$rounds=5000$simsthesisproject$'),
                'familyname' => $this->input->post('familyname'),
                'firstname' => $this->input->post('firstname'),
                'lastname' => $this->input->post('lastname'),
                'gender' => $this->input->post('gender'),
                'dateofbirth' => $this->input->post('dateofbirth'),
                'placeofbirth' => $this->input->post('placeofbirth'),
                'nationality' => $this->input->post('nationality'),
                'ethnic' => $this->input->post('ethnic'),
                'citizenship' => $this->input->post('citizenship'),
                'passportcountry' => $this->input->post('passportcountry'),
                'passportexpired' => $this->input->post('passportexpired'),
                'idcardtype' => $this->input->post('idcardtype'),
                'email' => $this->input->post('email'),
                'phone' => $this->input->post('phone'),
                'address' => $this->input->post('address'),
                'religion' => $this->input->post('religion'),
            );
        } else {
            $data = array(
//                'password' => crypt($this->input->post('password'),'$6$rounds=5000$simsthesisproject$'),
                'familyname' => $this->input->post('familyname'),
                'firstname' => $this->input->post('firstname'),
                'lastname' => $this->input->post('lastname'),
                'gender' => $this->input->post('gender'),
                'dateofbirth' => $this->input->post('dateofbirth'),
                'placeofbirth' => $this->input->post('placeofbirth'),
                'nationality' => $this->input->post('nationality'),
                'ethnic' => $this->input->post('ethnic'),
                'citizenship' => $this->input->post('citizenship'),
                'passportcountry' => $this->input->post('passportcountry'),
                'passportexpired' => $this->input->post('passportexpired'),
                'idcardtype' => $this->input->post('idcardtype'),
                'email' => $this->input->post('email'),
                'phone' => $this->input->post('phone'),
                'address' => $this->input->post('address'),
                'religion' => $this->input->post('religion'),

            );
        }
        $this->db->where('studentid', $id);
        $this->db->update($this->table, $data);
    }

    function editProfilePhoto($id, $filename) {
        $data = array(
            'photo' => $filename,
        );

        $this->db->where('studentid', $id);
        $this->db->update($this->table, $data);

        return TRUE;
    }

    function getLatestID(){
        $this->db->select('studentid');
        $this->db->order_by("studentid", "desc");
        $this->db->limit(1);
        $query = $this->db->get($this->table, 1);

        if ($query->num_rows() == 1) {
            return $query->row_array();
        }
    }

    function activateStudent($id){
        $data = array(
            'active' => '1',
        );
        $this->db->where('studentid', $id);
        $this->db->update($this->table, $data);
        if ($this->db->affected_rows() == 1) {
            return TRUE;
        }
        return FALSE;
    }

    function deactivateStudent($id){
        $data = array(
            'active' => '0',
        );
        $this->db->where('studentid', $id);
        $this->db->update($this->table, $data);
        if ($this->db->affected_rows() == 1) {
            return TRUE;
        }
        return FALSE;
    }

    function getAllEventsCount($id, $lastlogin){
        $this->db->select('*');
//        $status_array = array($id,'0','1');
        $where1 = "(participant='0' OR participant='4' OR participant LIKE '%$id%')";

        $this->db->where('date >=' ,$lastlogin);
        $this->db->where('date >=' ,date('Y-m-d', now()));
        $this->db->where($where1);
//        $this->db->or_where($where2);


        $this->db->order_by('date', 'desc');

        $query = $this->db->get($this->event_table);

        return $query->num_rows();
    }

    function getStudentCourses($classid){

        $this->db->select('*');
        $this->db->from('course course');
        $this->db->where('classid',$classid);
        $this->db->where('course_assign.courseid=course.courseid');

        $query = $this->db->get($this->course_assign_table);

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
    }

    function getCourseDataByID($id, $classid){
        $this->db->select('*');
        $this->db->join('course', 'course.courseid = course_assign.courseid');
        $this->db->where('course.courseid', $id);
        $this->db->where('course_assign.classid', $classid);
        $query = $this->db->get($this->course_assign_table, 1);

        if ($query->num_rows() == 1) {
            return $query->row_array();
        }
    }

    function getCoursePlanDataByID($id){
        $sql = 'SELECT * FROM `lesson_plan` WHERE courseid=\''.$id.'\' ORDER BY lessoncount';

        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
    }

    function getCourseImplementationData($id, $class){
        $sql = 'SELECT * FROM lesson_implementation WHERE assignid= (SELECT assignid FROM course_assign WHERE courseid=\''.$id.'\' AND classid=\''.$class.'\' ) ORDER BY implementationcount';

        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
    }

    function getSharedMaterialsByCourseID($courseid, $class){
        $sql = 'SELECT material.materialid, material.assignid, material.topic, material.type, material.date, material.fileid, file.filename, file.teacherid FROM material, file WHERE assignid=(SELECT assignid FROM `course_assign` WHERE classid=\''.$class.'\' AND courseid=\''.$courseid.'\') AND file.fileid=material.fileid ORDER BY date ASC';

        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
    }

    function getAssignmentAndQuizesByCourseID($courseid, $class){
        $sql = 'SELECT * FROM assignmentandquiz, file WHERE assignid=(SELECT assignid FROM `course_assign`WHERE classid=\''.$class.'\' AND courseid=\''.$courseid.'\') AND (type=\'Assignment\' OR type=\'QUIZ\') AND duedate>now()  AND file.fileid=assignmentandquiz.fileid ORDER BY duedate ASC';

        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
    }

    function getAllStudentByClassID($classid){
        $sql = 'SELECT * FROM student WHERE classid=\''.$classid.'\'';

        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
    }

    function getAssignIDByANQID($id) {
        $this->db->select('assignid');
        $this->db->where("anqid", $id);
        $this->db->limit(1);
        $query = $this->db->get($this->qna_table, 1);

        if ($query->num_rows() == 1) {
            return $query->row_array();
        }
    }

    function getAssignmentAndQuizDataByANQID($id) {
        $this->db->select('*');
        $this->db->where("anqid", $id);
        $this->db->limit(1);
        $query = $this->db->get($this->qna_table, 1);

        if ($query->num_rows() == 1) {
            return $query->row_array();
        }
    }

    function getCourseDataByAssignID($id) {
        $this->db->select('*');
        $this->db->join('course', 'course.courseid = course_assign.courseid');
        $this->db->where('course_assign.assignid', $id);
        $query = $this->db->get($this->course_assign_table, 1);

        if ($query->num_rows() == 1) {
            return $query->row_array();
        }
    }

    function getQnALatestID(){
        $this->db->select('anqid');
        $this->db->order_by("anqid", "desc");
        $this->db->limit(1);
        $query = $this->db->get($this->qna_table, 1);

        if ($query->num_rows() == 1) {
            return $query->row_array();
        }
    }

    function getFileLatestID(){
        $this->db->select('fileid');
        $this->db->order_by("fileid", "desc");
        $this->db->limit(1);
        $query = $this->db->get($this->file_table, 1);

        if ($query->num_rows() == 1) {
            return $query->row_array();
        }
    }

    function addFile($id, $filename, $tid){
        $data = array(
            'fileid' => $id,
            'filename' => $filename,
            'teacherid' => $tid,
            'date' => date('Y-m-d', now()),
        );
        $this->db->insert($this->file_table, $data);
    }

    function getTeacherByAssignID($id) {
        $this->db->select('teacherid');
        $this->db->where('assignid', $id);
        $query = $this->db->get($this->course_assign_table, 1);

        if ($query->num_rows() == 1) {
            return $query->row_array();
        }
    }

    function checkSubmission($anqid, $studentid){
        $this->db->select('*');
        $this->db->where('anqid', $anqid);
        $this->db->where('studentid', $studentid);
        $query = $this->db->get($this->qnascore_table, 1);

        if ($query->num_rows() == 1) {
            return $query->row_array();
        }
    }

    function editSubmission($anqid, $studentid, $fileid){
        $data = array(
            'file' => $fileid,
        );
        $this->db->where('anqid', $anqid);
        $this->db->where('studentid', $studentid);
        $this->db->update($this->qnascore_table, $data);
    }

    function addSubmission($nid, $fileID){
        $data = array(
            'anqscoreid' => $nid,
            'studentid' => $this->input->post('studentid'),
            'anqid' => $this->input->post('anqid'),
            'submissiondate' => date('Y-m-d', now()),
            'file' => $fileID
        );
        $this->db->insert($this->qnascore_table, $data);
    }

    function getSubmissionLatestID(){
        $this->db->select('anqscoreid');
        $this->db->order_by("anqscoreid", "desc");
        $this->db->limit(1);
        $query = $this->db->get($this->qnascore_table, 1);

        if ($query->num_rows() == 1) {
            return $query->row_array();
        }
    }

    function getAllClassesByStudentID($id) {
        $sql = 'SELECT previous_class.classid, class.classroom, course_assign.courseid, course_assign.assignid, course_assign.classid, course.coursename, course.coursedescription, course.courseresources FROM previous_class, class, course_assign, course WHERE previous_class.studentid=\''.$id.'\' AND class.classid=previous_class.classid AND course_assign.classid=class.classid AND course.courseid=course_assign.courseid ORDER BY previous_class.periode';

        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
    }

    function getAllGradeByStudentID($id) {
        $sql = 'SELECT class.classroom FROM `previous_class`, class WHERE studentid=\''.$id.'\' AND class.classid=previous_class.classid';

        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
    }

    function getTotalAttendance($id){
        $this->db->select('*');
        $this->db->where('studentid', $id);

        $query = $this->db->get($this->attendance_table);

        return $query->num_rows();
    }

    function getTotalPresentByStudent($id){
        $this->db->select('*');
        $this->db->where('studentid', $id);
        $this->db->where('status', 'p');

        $query = $this->db->get($this->attendance_table);

        return $query->num_rows();
    }

    function getStudentReport($studentid,$term,$grade){
        $sql = 'SELECT report.*, homeroom.*, class.classroom, course.coursename, teacher.firstname as teacherfirstname, teacher.lastname as teacherlastname, course.courseid FROM report, student, class, teacher, homeroom, course, course_assign WHERE report.studentid=\''.$studentid.'\' AND student.studentid=report.studentid AND homeroom.studentid=report.studentid AND student.classid=class.classid AND teacher.teacherid=class.teacherid AND report.term=\''.$term.'\' AND homeroom.term=report.term AND report.class=\''.$grade.'\' AND homeroom.class=report.class AND course.courseid=course_assign.courseid AND course_assign.assignid=report.assignid';

        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
    }

    function getStudentCourseOnGrade($studentid,$grade){
        $sql = 'SELECT course.*, course_assign.classid, teacher.firstname as teacherfirstname, teacher.lastname as teacherlastname, course.courseid FROM previous_class , course, course_assign, class, teacher WHERE previous_class.studentid=\''.$studentid.'\' AND previous_class.classid=course_assign.classid AND course_assign.courseid=course.courseid AND class.classroom LIKE \''.$grade.'%\' AND class.classid=previous_class.classid AND teacher.teacherid=course_assign.teacherid';

        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
    }

    function getAllQnAByStudent($studentid, $type){
        if($type == 1){
            $type_array = array('Homework');
        }
        elseif ($type == 2){
            $type_array = array('Classwork');
        }
        else{
            $type_array = array('Quiz','Assignment');
        }
        $this->db->select('*');
        $this->db->join('assignmentandquiz', 'assignmentandquiz.anqid = assignmentandquizscore.anqid');
        $this->db->order_by('submissiondate', 'asc');
        $this->db->where('assignmentandquizscore.studentid', $studentid);
        $this->db->where_in('assignmentandquiz.type', $type_array);

        $query = $this->db->get($this->qnascore_table);

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
    }

    function getReportDataBy($assignid, $studentid) {
        $this->db->select('*');
        $this->db->where('assignid', $assignid);
        $this->db->where('studentid', $studentid);
        $this->db->order_by('term', 'asc');

        $query = $this->db->get($this->report_table);

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
    }

    function getClassByStudentID($id){
        $this->db->select('*');
        $this->db->join('class', 'class.classid = student.classid');
        $this->db->where('studentid', $id);
        $query = $this->db->get($this->student_table, 1);

        if ($query->num_rows() == 1) {
            return $query->row_array();
        }
    }

    function getAttendanceList($classid, $studentid){
          $this->db->select('*');
          $this->db->where('classid', $classid);
          $this->db->where('studentid', $studentid);
          $this->db->order_by('date', 'asc');

          $query = $this->db->get($this->attendance_table);

          if ($query->num_rows() > 0) {
              return $query->result_array();
          }
      }

    function addStudent($id){
        $dbrth = $this->input->post('dateofbirth');
        $dob= strtotime($dbrth);
        $pass = 'xyz'.date('Ymd', $dob);
        $data = array(
            'studentid' => $id,
            'password' => crypt($pass,'$6$rounds=5000$simsthesisproject$'),
            'familyname' => $this->input->post('familyname'),
            'firstname' => $this->input->post('firstname'),
            'lastname' => $this->input->post('lastname'),
            'gender' => $this->input->post('gender'),
            'dateofbirth' => $this->input->post('dateofbirth'),
            'placeofbirth' => $this->input->post('placeofbirth'),
            'nationality' => $this->input->post('nationality'),
            'ethnic' => $this->input->post('ethnic'),
            'citizenship' => $this->input->post('citizenship'),
            'passportcountry' => $this->input->post('passportcountry'),
            'passportexpired' => $this->input->post('passportexpired'),
            'idcardtype' => $this->input->post('idcardtype'),
            'email' => $this->input->post('email'),
            'phone' => $this->input->post('phone'),
            'address' => $this->input->post('address'),
            'religion' => $this->input->post('religion'),
            'active' => '1'
        );
        $this->db->insert($this->table, $data);
    }

    function getStudentAssignid($classid, $studentid) {
          $this->db->select('assignid');
          $this->db->from('student');
          $this->db->from('course_assign');
          $this->db->where('student.studentid', $studentid);
          $this->db->where('course_assign.classid', $classid);

          $query = $this->db->get();

          if ($query->num_rows() > 0) {
              return $query->result_array();
          }
      }

    function getAssignidByCourse($courseid, $classid) {
        $this->db->select('assignid');
        $this->db->where('courseid', $courseid);
        $this->db->where('classid', $classid);
        $this->db->limit(1);
        $query = $this->db->get($this->course_assign_table, 1);

        if ($query->num_rows() == 1) {
            return $query->row_array();
        }
    }

    function getAllStudent(){
        $this->db->select('student.*');
//        $this->db->select('class.classroom');
//        $this->db->join('class class', 'class.classid=student.classid');

        $query = $this->db->get($this->table);

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
    }

    function getAllEvents($id, $classid){
          $sql = 'SELECT * FROM events WHERE  events.date>now() AND events.assignid=\'0\' OR events.assignid IN (SELECT course_assign.assignid FROM course_assign, student WHERE course_assign.classid=student.classid AND student.studentid=\''.$id.'\') ORDER BY date';

          $query = $this->db->query($sql);
          if ($query->num_rows() > 0) {
              return $query->result_array();
          }
      }

    function getSubmission($id, $classid){
//          $this->db->select('*');
//          $this->db->join('student', 'student.studentid = assignmentandquizscore.studentid');
//          $this->db->order_by('submissiondate', 'desc');
//          $this->db->where('anqid', $id);
//          $query = $this->db->get($this->qnascore_table);

          $sql = 'SELECT * FROM assignmentandquizscore, assignmentandquiz WHERE assignmentandquizscore.anqid IN (SELECT anqid FROM assignmentandquiz WHERE assignid IN (SELECT course_assign.assignid FROM course_assign, student WHERE course_assign.classid=student.classid AND student.studentid=\''.$id.'\')) AND assignmentandquizscore.studentid=\''.$id.'\' AND assignmentandquiz.anqid=assignmentandquizscore.anqid';

          $query = $this->db->query($sql);
          if ($query->num_rows() > 0) {
              return $query->result_array();
          }
      }

    function getFeedback($stid, $assignid){
        $this->db->select('*');
        $this->db->where('studentid', $stid);
        $this->db->where('assignid', $assignid);
        $this->db->limit(1);
        $query = $this->db->get($this->feedback_table, 1);

        if ($query->num_rows() == 1) {
            return $query->row_array();
        }
    }

    function editFeedback($stid, $assignid) {
        $data = array(
            'feedback' => $this->input->post('feedback'),
        );

        $this->db->where('assignid', $assignid);
        $this->db->where('studentid', $stid);
        $this->db->update($this->feedback_table, $data);
    }

    function addFeedback($stid, $assignid) {
        $data = array(
            'feedback' => $this->input->post('feedback'),
            'studentid' => $stid,
            'assignid' => $assignid
        );

        $this->db->insert($this->feedback_table, $data);
    }
}

?>
