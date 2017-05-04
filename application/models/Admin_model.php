<?php
class Admin_model extends CI_Model {

    var $table = 'admin';
    var $parents_table = 'parents';
    var $parents_child_table = 'parent_child';
    var $course_table = 'course';
    var $course_assign_table = 'course_assign';
    var $material_table = 'material';
    var $file_table = 'file';
    var $qna_table = 'assignmentandquiz';
    var $qnascore_table = 'assignmentandquizscore';
    var $lesson_plan_table = 'lesson_plan';
    var $lesson_implementation_table = 'lesson_implementation';
    var $student_table = 'student';
    var $report_table = 'report';
    var $class_table = 'class';
    var $attendance_table = 'attendance';
    var $homeroom_table = 'homeroom';
    var $semester_table = 'semester';
    var $form_table = 'forms';
    var $event_table = 'events';
    var $setting_table = 'settings';
    var $event_image_table = 'event_images';
    var $schedule_course_table = 'schedule_course';
    var $item_table = 'items';
    var $item_request_table = 'item_request';
    var $book_request_table = 'book_request';
    var $fotocopy_request_table = 'fotocopy_request';

    function __construct() {
        parent::__construct();
    }

    function checkLogin($username, $password) {
        $this->db->select('*');
        $this->db->where('adminid', $this->security->xss_clean($username));
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

        $this->db->where('adminid', $id);
        $this->db->update($this->table, $data);

        return TRUE;
    }
    
    function changeLastLogin($id, $current){
        $data = array(
            'lastlogin' => $current,
        );

        $this->db->where('adminid', $id);
        $this->db->update($this->table, $data);

        return TRUE;
    }

    function getProfileDataByID($id) {
        $this->db->select('*');
        $this->db->where('adminid', $id);
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
                'dateofbirth' => $this->input->post('dateofbirth'),
                'placeofbirth' => $this->input->post('placeofbirth'),
                'religion' => $this->input->post('religion'),
                'elementary' => $this->input->post('elementary'),
                'juniorhigh' => $this->input->post('juniorhigh'),
                'seniorhigh' => $this->input->post('seniorhigh'),
                'undergraduate' => $this->input->post('undergraduate'),
                'graduate' => $this->input->post('graduate'),
                'postgraduate' => $this->input->post('postgraduate'),
                'experience' => $this->input->post('experience'),
                'workinghour' => $at
            );
        } else {
            $data = array(
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
                'undergraduate' => $this->input->post('undergraduate'),
                'graduate' => $this->input->post('graduate'),
                'postgraduate' => $this->input->post('postgraduate'),
                'experience' => $this->input->post('experience'),
                'workinghour' => $at
            );
        }
        $this->db->where('adminid', $id);
        $this->db->update($this->table, $data);
    }

    function getAllParents(){
        $this->db->select('*');
//        $this->db->where('active', '1');

        $query = $this->db->get($this->parents_table);

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
    }

    function getParentLatestID(){
        $this->db->select('parentid');
        $this->db->order_by("parentid", "desc");
        $this->db->limit(1);
        $query = $this->db->get($this->parents_table, 1);

        if ($query->num_rows() == 1) {
            return $query->row_array();
        }
    }

    function getAllEvents($id){
        $this->db->select('*');
//        $status_array = array($id,'0');
//        $where1 = "(teacherid='0' OR teacherid='1' OR teacherid='$id')";
        $where = "(assignid='0' OR participant LIKE '$id')";

        $this->db->where('date >=' ,date('Y-m-d', now()));
        $this->db->where($where);
//        $this->db->or_where($where2);
        $this->db->order_by('date', 'asc');

        $query = $this->db->get($this->event_table);

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
    }
/*
    function getAllEventsCount($id, $lastlogin){
        $this->db->select('*');
//        $status_array = array($id,'0','1');
        $where1 = "(teacherid='0' OR teacherid='1' OR teacherid='$id')";
        $where2 = "(teacherid='3' AND participant LIKE '%$id%')";

        $this->db->where('date >=' ,$lastlogin);
        $this->db->where('date >=' ,date('Y-m-d', now()));
        $this->db->where($where1);
        $this->db->or_where($where2);


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

    function addEvent($id, $p){
        if($p == '0'){ //all participant
            $tid = 0;
            $sid = 0;
            $p = 0;
        }
        elseif($p == '1'){
            $tid = 1; //teacher participant only
            $sid = 0;
            $p = 1;
        }
        elseif($p == '2'){
            $tid = 0;
            $sid = 2; //student participant only
            $p = 2;
        }
        else{
            $tid = 3; //special participant only
            $sid = 3; //special participant only
        }
        $data = array(
            'eventid' => $id,
            'title' => $this->input->post('title'),
            'description' => $this->input->post('description'),
            'date' => $this->input->post('duedate'),
            'teacherid' => $tid,
            'assignid' => $sid,
            'participant' => $p
        );
        $this->db->insert($this->event_table, $data);
    }

    function addEventImage($id, $img){
        $data = array(
            'eiid' => $id,
            'photo' => $img
        );
        $this->db->insert($this->event_image_table, $data);
    }

    function deleteEventImage($id){
        $this->db->where('eiid', $id);
        $this->db->delete($this->event_image_table);
        if ($this->db->affected_rows() == 1) {
            return TRUE;
        }
        return FALSE;
    }

    function editEvent($id){
        $data = array(
            'title' => $this->input->post('title'),
            'description' => $this->input->post('description'),
            'date' => $this->input->post('duedate')
        );
        $this->db->where('eventid', $id);
        $this->db->update($this->event_table, $data);
    }

    function getAllEventImages(){
        $this->db->select('*');

        $query = $this->db->get($this->event_image_table);

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
    }

    function deleteEvent($id){
        $this->db->where('eventid', $id);
        $this->db->delete($this->event_table);
        if ($this->db->affected_rows() == 1) {
            return TRUE;
        }
        return FALSE;
    }

    function addQnAEvent($id, $tid, $sid){
        $data = array(
            'eventid' => $id,
            'title' => $this->input->post('coursename').' '.$this->input->post('type'),
            'description' => 'Submit before '.date('Y-m-d', strtotime($this->input->post('duedate') . ' +1 day')),
            'date' => $this->input->post('duedate'),
            'teacherid' => $tid,
            'assignid' => $sid,
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

    function editSubmission($id){
        $data = array(
            'score' => $this->input->post('score'),
        );
        $this->db->where('anqscoreid', $id);
        $this->db->update($this->qnascore_table, $data);
    }

    function addSubmission($id){
        $data = array(
            'anqscoreid' => $id,
            'studentid' => $this->input->post('studentid'),
            'anqid' => $this->input->post('qnaid'),
            'score' => $this->input->post('score'),
            'submissiondate' => date('Y-m-d', now()),
            'file' => 'not uploaded',
        );
        $this->db->insert($this->qnascore_table, $data);
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

    function getAllItems(){
        $this->db->select('*');

        $query = $this->db->get($this->item_table);

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
    }

    function getAllRequestedByTeacher($i, $t){
        $this->db->select('*');
        $this->db->where('itemid', $i);
        $this->db->where('teacherid', $t);

        $query = $this->db->get($this->item_request_table,1);

        if ($query->num_rows() == 1) {
            return $query->row_array();
        }
    }

    function editRequestedItem($id, $n){
        $data = array(
            'number' => $n
        );
        $this->db->where('itemid', $id);
        $this->db->update($this->item_request_table, $data);
    }

    function getRequestLatestID(){
        $this->db->select('requestid');
        $this->db->order_by("requestid", "desc");
        $this->db->limit(1);
        $query = $this->db->get($this->item_request_table, 1);

        if ($query->num_rows() == 1) {
            return $query->row_array();
        }
    }

    function addRequest($id, $iid, $tid, $n){
        $data = array(
            'requestid' => $id,
            'itemid' => $iid,
            'teacherid' => $tid,
            'number' => $n,
        );
        $this->db->insert($this->item_request_table, $data);
    }

    function getAllBooksRequested($id){
        $this->db->select('*');
        $this->db->where('teacherid', $id);

        $query = $this->db->get($this->book_request_table);

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
    }

    function editBookRequest($id){
        $data = array(
            'number' => $this->input->post('value'),
        );
        $this->db->where('brequestid', $id);
        $this->db->update($this->book_request_table, $data);
    }

    function getBookRequestLatestID(){
        $this->db->select('brequestid');
        $this->db->order_by("brequestid", "desc");
        $this->db->limit(1);
        $query = $this->db->get($this->book_request_table, 1);

        if ($query->num_rows() == 1) {
            return $query->row_array();
        }
    }

    function addBookRequest($id, $tid){
        $data = array(
            'brequestid' => $id,
            'isbn' => $this->input->post('isbn'),
            'name' => $this->input->post('name'),
            'teacherid' => $tid,
            'number' => $this->input->post('value'),
        );
        $this->db->insert($this->book_request_table, $data);
    }

    function getAllFotocopyRequested($id){
        $this->db->select('*');
        $this->db->where('teacherid', $id);

        $query = $this->db->get($this->fotocopy_request_table);

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
    }

    function editFotocopyRequest($id){
        $data = array(
            'number' => $this->input->post('value'),
        );
        $this->db->where('frequestid', $id);
        $this->db->update($this->fotocopy_request_table, $data);
    }

    function getFotocopyRequestLatestID(){
        $this->db->select('frequestid');
        $this->db->order_by("frequestid", "desc");
        $this->db->limit(1);
        $query = $this->db->get($this->fotocopy_request_table, 1);

        if ($query->num_rows() == 1) {
            return $query->row_array();
        }
    }

    function addFotocopyRequest($id, $tid){
        $data = array(
            'frequestid' => $id,
            'isbn' => $this->input->post('isbn'),
            'name' => $this->input->post('name'),
            'teacherid' => $tid,
            'number' => $this->input->post('value'),
        );
        $this->db->insert($this->fotocopy_request_table, $data);
    }*/
}

?>
