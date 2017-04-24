<?php
class Parent_model extends CI_Model {

    var $table = 'parents';
    var $event_table = 'events';

    function __construct() {
        parent::__construct();
    }

    function checkLogin($username, $password) {
        $this->db->select('*');
        $this->db->where('parentid', $this->security->xss_clean($username));
//        $password = hash('sha512', $password);
        $password = crypt($this->security->xss_clean($password),'$6$rounds=5000$simsthesisproject$');
        $this->db->where('password', $password);
        $query = $this->db->get($this->table, 1);

        if ($query->num_rows() == 1) {
            return $query->row_array();
        }
    }

    function setCurrentLogin($id){
        $data = array(
            'currentlogin' => date('Y-m-d', now()),
        );

        $this->db->where('parentid', $id);
        $this->db->update($this->table, $data);

        return TRUE;
    }

    function changeLastLogin($id, $current){
        $data = array(
            'lastlogin' => $current,
        );

        $this->db->where('parentid', $id);
        $this->db->update($this->table, $data);

        return TRUE;
    }

    function getProfileDataByID($id) {
        $this->db->select('*');
        $this->db->where('parentid', $id);
        $query = $this->db->get($this->table, 1);

        if ($query->num_rows() == 1) {
            return $query->row_array();
        }
    }

    function editProfile($id, $at) {
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
//                'dateofbirth' => $this->input->post('dateofbirth'),
//                'placeofbirth' => $this->input->post('placeofbirth'),
//                'religion' => $this->input->post('religion'),
//                'elementary' => $this->input->post('elementary'),
//                'juniorhigh' => $this->input->post('juniorhigh'),
//                'seniorhigh' => $this->input->post('seniorhigh'),
//                'undergraduate' => $this->input->post('undergraduate'),
//                'graduate' => $this->input->post('graduate'),
//                'postgraduate' => $this->input->post('postgraduate'),
//                'experience' => $this->input->post('experience'),
//                'workinghour' => $at
            );
        } else {
            $data = array(
                'firstname' => $this->input->post('firstname'),
                'lastname' => $this->input->post('lastname'),
                'gender' => $this->input->post('gender'),
                'phone' => $this->input->post('phone'),
                'email' => $this->input->post('email'),
                'address' => $this->input->post('address'),
//                'dateofbirth' => $this->input->post('dateofbirth'),
//                'placeofbirth' => $this->input->post('placeofbirth'),
//                'religion' => $this->input->post('religion'),
//                'elementary' => $this->input->post('elementary'),
//                'juniorhigh' => $this->input->post('juniorhigh'),
//                'seniorhigh' => $this->input->post('seniorhigh'),
//                'undergraduate' => $this->input->post('undergraduate'),
//                'graduate' => $this->input->post('graduate'),
//                'postgraduate' => $this->input->post('postgraduate'),
//                'experience' => $this->input->post('experience'),
//                'workinghour' => $at
            );
        }
        $this->db->where('parentid', $id);
        $this->db->update($this->table, $data);
    }

    function editProfilePhoto($id, $filename) {
        $data = array(
            'photo' => $filename,
        );

        $this->db->where('parentid', $id);
        $this->db->update($this->table, $data);

        return TRUE;
    }

    function getLatestID(){
        $this->db->select('parentid');
        $this->db->order_by("parentid", "desc");
        $this->db->limit(1);
        $query = $this->db->get($this->table, 1);

        if ($query->num_rows() == 1) {
            return $query->row_array();
        }
    }

    function addParent($id, $at){
        $data = array(
            'parentid' => $id,
//            'password' => hash('sha512', $this->input->post('password')),
            'password' => crypt($this->input->post('password'),'$6$rounds=5000$simsthesisproject$'),
            'firstname' => $this->input->post('firstname'),
            'lastname' => $this->input->post('lastname'),
            'gender' => $this->input->post('gender'),
            'phone' => $this->input->post('phone'),
            'email' => $this->input->post('email'),
            'address' => $this->input->post('address'),
//            'dateofbirth' => $this->input->post('dateofbirth'),
//            'placeofbirth' => $this->input->post('placeofbirth'),
//            'religion' => $this->input->post('religion'),
//            'elementary' => $this->input->post('elementary'),
//            'juniorhigh' => $this->input->post('juniorhigh'),
//            'seniorhigh' => $this->input->post('seniorhigh'),
//            'undergraduate' => $this->input->post('undergraduate'),
//            'graduate' => $this->input->post('graduate'),
//            'postgraduate' => $this->input->post('postgraduate'),
//            'experience' => $this->input->post('experience'),
//            'role' => 'r0001',
//            'workinghour' => $at
        );
        $this->db->insert($this->table, $data);
    }

    function deleteParent($id){
        $this->db->where('parentid', $id);
        $this->db->delete($this->table);
        if ($this->db->affected_rows() == 1) {
            return TRUE;
        }
        return FALSE;
    }

    function checkAttendance($classid, $studentid, $setdate){
        $this->db->select('*');
        $this->db->where('classid', $classid);
        $this->db->where('studentid', $studentid);
        $this->db->where('date', $setdate);
        $query = $this->db->get($this->attendance_table, 1);

        if ($query->num_rows() == 1) {
            return $query->row_array();
        }
    }

    function getStudentReport($classid, $id, $term, $class){
        $this->db->select('*');
        $this->db->join('course', 'course.courseid = course_assign.courseid');
        $this->db->join('teacher', 'teacher.teacherid = course_assign.teacherid');
        $this->db->join('report', 'report.assignid = course_assign.assignid');
        $this->db->where('course_assign.classid', $classid);
        $this->db->where('report.studentid', $id);
        $this->db->where('report.term', $term);
        $this->db->where('report.class', $class);
        $this->db->order_by('course.coursename', 'asc');

        $query = $this->db->get($this->course_assign_table);

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
    }

    function getStudentCourses($classid){
        $this->db->select('*');
        $this->db->join('course', 'course.courseid = course_assign.courseid');
        $this->db->join('teacher', 'teacher.teacherid = course_assign.teacherid');
        $this->db->where('course_assign.classid', $classid);
        $this->db->order_by('course.coursename', 'asc');

        $query = $this->db->get($this->course_assign_table);

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
    }
    function getHomeroomReport($studentid, $term, $class) {
        $this->db->select('*');
        $this->db->where('studentid', $studentid);
        $this->db->where('term', $term);
        $this->db->where('class', $class);

        $query = $this->db->get($this->homeroom_table, 1);

        if ($query->num_rows() == 1) {
            return $query->row_array();
        }
    }

    function getHomeroomTeacher($classid) {
        $this->db->select('*');
        $this->db->join('teacher', 'teacher.teacherid = class.teacherid');
        $this->db->where('classid', $classid);

        $query = $this->db->get($this->class_table, 1);

        if ($query->num_rows() == 1) {
            return $query->row_array();
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

    function getSemesterPlan($id) {
        $this->db->select('*');
        $this->db->where('courseid', $id);
        $query = $this->db->get($this->semester_table);

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
    }

    function getAllForms(){
        $this->db->select('*');

        $query = $this->db->get($this->form_table);

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
    }

    function getForm($id){
        $this->db->select('*');
        $this->db->where('formid' ,$id);

        $query = $this->db->get($this->form_table);

        if ($query->num_rows() == 1) {
            return $query->row_array();
        }
    }

    function getFormLatestID(){
        $this->db->select('formid');
        $this->db->order_by("formid", "desc");
        $this->db->limit(1);
        $query = $this->db->get($this->form_table, 1);

        if ($query->num_rows() == 1) {
            return $query->row_array();
        }
    }

    function deleteForm($id){
        $this->db->where('formid', $id);
        $this->db->delete($this->form_table);
        if ($this->db->affected_rows() == 1) {
            return TRUE;
        }
        return FALSE;
    }

    function getAllEvents($id){
        $this->db->select('*');
        $status_array = array($id,'0');
        $this->db->where_in('teacherid', $status_array);
        $this->db->where('date >=' ,date('Y-m-d', now()));
        $this->db->order_by('date', 'asc');

        $query = $this->db->get($this->event_table);

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
    }

    function getAllEventsCount($id, $lastlogin){
        $this->db->select('*');
        $status_array = array($id,'0');
        $this->db->where_in('teacherid', $status_array);
        $this->db->where('date >=' ,date('Y-m-d', $lastlogin));
        $this->db->where('date >=' ,date('Y-m-d', now()));
        $this->db->order_by('date', 'desc');

        $query = $this->db->get($this->event_table);

        return $query->num_rows();
    }

    function getEvent($id){
        $this->db->select('*');
        $this->db->where('eventid' ,$id);

        $query = $this->db->get($this->event_table);

        if ($query->num_rows() == 1) {
            return $query->row_array();
        }
    }

    function getEventLatestID(){
        $this->db->select('eventid');
        $this->db->order_by("eventid", "desc");
        $this->db->limit(1);
        $query = $this->db->get($this->event_table, 1);

        if ($query->num_rows() == 1) {
            return $query->row_array();
        }
    }

    function getEventImageLatestID(){
        $this->db->select('eiid');
        $this->db->order_by("eiid", "desc");
        $this->db->limit(1);
        $query = $this->db->get($this->event_image_table, 1);

        if ($query->num_rows() == 1) {
            return $query->row_array();
        }
    }

    function getAllEventImages(){
        $this->db->select('*');

        $query = $this->db->get($this->event_image_table);

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
    }

    function addQnAEvent($id, $tid){
        $data = array(
            'eventid' => $id,
            'title' => $this->input->post('coursename').' '.$this->input->post('type'),
            'description' => 'Submit before '.date('Y-m-d', strtotime($this->input->post('duedate') . ' +1 day')),
            'date' => $this->input->post('duedate'),
            'teacherid' => $tid,
        );
        $this->db->insert($this->event_table, $data);
    }

    function getSubmission($id){
        $this->db->select('*');
        $this->db->join('student', 'student.studentid = assignmentandquizscore.studentid');
        $this->db->order_by('submissiondate', 'desc');
        $this->db->where('anqid', $id);

        $query = $this->db->get($this->qnascore_table);

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
    }

    function checkNoSubmission($sid, $qid){
        $this->db->select('*');
        $this->db->where('studentid', $sid);
        $this->db->where('anqid', $qid);
        $query = $this->db->get($this->qnascore_table, 1);

        if ($query->num_rows() == 1) {
            return $query->row_array();
        }
    }

    function checkSubmission($nid){
        $this->db->select('*');
        $this->db->where('anqscoreid', $nid);
        $query = $this->db->get($this->qnascore_table, 1);

        if ($query->num_rows() == 1) {
            return $query->row_array();
        }
    }

    function getQnA($qid){
        $this->db->select('*');
        $this->db->join('file', 'file.fileid = assignmentandquiz.fileid');
        $this->db->where('assignmentandquiz.anqid', $qid);

        $query = $this->db->get($this->qna_table, 1);

        if ($query->num_rows() == 1) {
            return $query->row_array();
        }
    }

    function getScoreLatestID(){
        $this->db->select('anqscoreid');
        $this->db->order_by("anqscoreid", "desc");
        $this->db->limit(1);
        $query = $this->db->get($this->qnascore_table, 1);

        if ($query->num_rows() == 1) {
            return $query->row_array();
        }
    }

    function getPrincipal() {
        $this->db->select('*');
        $this->db->where('role', 'r0002');
        $query = $this->db->get($this->table, 1);

        if ($query->num_rows() == 1) {
            return $query->row_array();
        }
    }

    function getAllSettings(){
        $this->db->select('*');

        $query = $this->db->get($this->setting_table);

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
    }

    function editSetting($id){
        $data = array(
            'value' => $this->input->post('value'),
        );
        $this->db->where('settingid', $id);
        $this->db->update($this->setting_table, $data);
    }

    function getSetting($id) {
        $this->db->select('*');
        $this->db->where('settingid', $id);
        $query = $this->db->get($this->setting_table, 1);

        if ($query->num_rows() == 1) {
            return $query->row_array();
        }
    }

    function getAllQnAByStudent($studentid, $type){
        $this->db->select('*');
        $this->db->join('assignmentandquiz', 'assignmentandquiz.anqid = assignmentandquizscore.anqid');
        $this->db->order_by('submissiondate', 'asc');
        $this->db->where('assignmentandquizscore.studentid', $studentid);
        $this->db->where('assignmentandquiz.type', $type);

        $query = $this->db->get($this->qnascore_table);

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
    }
}

?>
