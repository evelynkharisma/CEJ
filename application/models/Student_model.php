<?php
class Student_model extends CI_Model {

    var $table = 'student';
    var $course_table = 'course';
    var $course_assign_table = 'course_assign';
    var $attendance_table = 'attendance';
//    var $material_table = 'material';
//    var $file_table = 'file';
//    var $qna_table = 'assignmentandquiz';
//    var $qnascore_table = 'assignmentandquizscore';
//    var $lesson_plan_table = 'lesson_plan';
//    var $lesson_implementation_table = 'lesson_implementation';
//    var $student_table = 'student';
//    var $report_table = 'report';
//    var $class_table = 'class';
//    var $homeroom_table = 'homeroom';
//    var $semester_table = 'semester';
//    var $form_table = 'forms';
    var $event_table = 'events';
//    var $setting_table = 'settings';
    var $event_image_table = 'event_images';

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
                'firstname' => $this->input->post('firstname'),
                'lastname' => $this->input->post('lastname'),
                'gender' => $this->input->post('gender'),
                'phone' => $this->input->post('phone'),
                'email' => $this->input->post('email'),
                'address' => $this->input->post('address'),
                'dateofbirth' => $this->input->post('dateofbirth'),
                'placeofbirth' => $this->input->post('placeofbirth'),
                'religion' => $this->input->post('religion'),
                'elementary' => $this->input->post('elementary'),
                'juniorhigh' => $this->input->post('juniorhigh'),
                'seniorhigh' => $this->input->post('seniorhigh'),

            );
        } else {
            $data = array(
//                'password' => crypt($this->input->post('password'),'$6$rounds=5000$simsthesisproject$'),
                'firstname' => $this->input->post('firstname'),
                'lastname' => $this->input->post('lastname'),
                'gender' => $this->input->post('gender'),
                'phone' => $this->input->post('phone'),
                'email' => $this->input->post('email'),
                'address' => $this->input->post('address'),
                'dateofbirth' => $this->input->post('dateofbirth'),
                'placeofbirth' => $this->input->post('placeofbirth'),
                'religion' => $this->input->post('religion'),
                'elementary' => $this->input->post('elementary'),
                'juniorhigh' => $this->input->post('juniorhigh'),
                'seniorhigh' => $this->input->post('seniorhigh'),

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

    function getStudentCourses($classid, $studentid){

        $this->db->select('*');
        $this->db->from('course course');
        $this->db->join('course_assign course_assign', 'course.courseid=course_assign.courseid');
        $this->db->where('course_assign.classid',$classid);

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result_array();
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
        $data = array(
            'studentid' => $id,
//            'password' => crypt($this->input->post('password'),'$6$rounds=5000$simsthesisproject$'),
            'firstname' => $this->input->post('firstname'),
            'lastname' => $this->input->post('lastname'),
            'gender' => $this->input->post('gender'),
            'phone' => $this->input->post('phone'),
            'email' => $this->input->post('email'),
            'address' => $this->input->post('address'),
            'dateofbirth' => $this->input->post('dateofbirth'),
            'placeofbirth' => $this->input->post('placeofbirth'),
            'religion' => $this->input->post('religion'),
            'elementary' => $this->input->post('elementary'),
            'juniorhigh' => $this->input->post('juniorhigh'),
            'seniorhigh' => $this->input->post('seniorhigh'),
            'role' => 'r0004',
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

    function getAllStudent(){
        $this->db->select('*');
        $this->db->where('active', '1');

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
}

?>
