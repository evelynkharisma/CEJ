<?php
class Teacher_model extends CI_Model {

    var $table = 'teacher';
    var $course_table = 'course';
    var $course_assign_table = 'course_assign';
    var $material_table = 'material';
    var $file_table = 'file';
    var $qna_table = 'assignmentandquiz';
    var $lesson_plan_table = 'lesson_plan';
    var $lesson_implementation_table = 'lesson_implementation';
    var $student_table = 'student';
    var $report_table = 'report';
    var $class_table = 'class';
    var $attendance_table = 'attendance';
    var $homeroom_table = 'homeroom';
    var $role= array(
        2 => 'Teacher',
        1 => 'Head of School',
        0 => 'Principal'
    );

    function __construct() {
        parent::__construct();
    }

    function checkLogin($username, $password) {
        $this->db->select('*');
        $this->db->where('teacherid', $username);
        $password = hash('sha512', $password);
        $this->db->where('password', $password);
        $query = $this->db->get($this->table, 1);

        if ($query->num_rows() == 1) {
            return $query->row_array();
        }
    }

    function getProfileDataByID($id) {
        $this->db->select('*');
        $this->db->where('teacherid', $id);
        $query = $this->db->get($this->table, 1);

        if ($query->num_rows() == 1) {
            return $query->row_array();
        }
    }

    function editProfile($id) {
        if ($this->input->post('password')) {
            $data = array(
                'password' => hash('sha512', $this->input->post('password')),
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
                'experience' => $this->input->post('experience')
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
                'experience' => $this->input->post('experience')
            );
        }
        $this->db->where('teacherid', $id);
        $this->db->update($this->table, $data);
    }

    function editProfilePhoto($id, $filename) {
        $data = array(
            'photo' => $filename,
        );

        $this->db->where('teacherid', $id);
        $this->db->update($this->table, $data);

        return TRUE;
    }

    function getLatestID(){
        $this->db->select('teacherid');
        $this->db->order_by("teacherid", "desc");
        $this->db->limit(1);
        $query = $this->db->get($this->table, 1);

        if ($query->num_rows() == 1) {
            return $query->row_array();
        }
    }

    function addTeacher($id){
        $data = array(
            'teacherid' => $id,
            'password' => hash('sha512', $this->input->post('password')),
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
            'role' => '2'
        );
        $this->db->insert($this->table, $data);
    }

    function getCourseLatestID(){
        $this->db->select('courseid');
        $this->db->order_by("courseid", "desc");
        $this->db->limit(1);
        $query = $this->db->get($this->course_table, 1);

        if ($query->num_rows() == 1) {
            return $query->row_array();
        }
    }

    function addCourse($id){
        $data = array(
            'courseid' => $id,
            'coursename' => $this->input->post('coursename'),
            'coursedescription' => $this->input->post('coursedescription'),
            'courseresources' => $this->input->post('courseresources'),
        );
        $this->db->insert($this->course_table, $data);
    }

    function getCourseDataByID($id) {
        $this->db->select('*');
        $this->db->where('courseid', $id);
        $query = $this->db->get($this->course_table, 1);

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

    function getLessonPlan($id) {
        $this->db->select('*');
        $this->db->where('courseid', $id);
        $this->db->order_by('lessoncount', 'asc');
        $query = $this->db->get($this->lesson_plan_table);

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
    }

    function editCourse($id){
        $data = array(
            'courseid' => $id,
            'coursename' => $this->input->post('coursename'),
            'coursedescription' => $this->input->post('coursedescription'),
            'courseresources' => $this->input->post('courseresources'),
        );
        $this->db->where('courseid', $id);
        $this->db->update($this->course_table, $data);
    }

    function editPlan($id, $ch, $obj, $act, $mat){
        $data = array(
            'chapter' => $ch,
            'objective' => $obj,
            'activities' => $act,
            'material' => $mat,
        );
        $this->db->where('lessonid', $id);
        $this->db->update($this->lesson_plan_table, $data);
    }

    function getPlanLatestID(){
        $this->db->select('lessonid');
        $this->db->order_by("lessonid", "desc");
        $this->db->limit(1);
        $query = $this->db->get($this->lesson_plan_table, 1);

        if ($query->num_rows() == 1) {
            return $query->row_array();
        }
    }

    function addPlan($id, $count, $ch, $obj, $act, $mat, $cid){
        $data = array(
            'lessonid' => $id,
            'lessoncount' => $count,
            'chapter' => $ch,
            'objective' => $obj,
            'activities' => $act,
            'material' => $mat,
            'courseid' => $cid,
        );
        $this->db->insert($this->lesson_plan_table, $data);
    }

    function getLessonImplementation($id) {
        $this->db->select('*');
        $this->db->where('assignid', $id);
        $this->db->order_by('implementation', 'desc');
        $query = $this->db->get($this->lesson_implementation_table);

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
    }

    function getImplementationLatestID(){
        $this->db->select('implementationid');
        $this->db->order_by("implementationid", "desc");
        $this->db->limit(1);
        $query = $this->db->get($this->lesson_implementation_table, 1);

        if ($query->num_rows() == 1) {
            return $query->row_array();
        }
    }

    function addImplementation($id, $count, $imp, $sid){
        $data = array(
            'implementationid' => $id,
            'implementationcount' => $count,
            'implementation' => $imp,
            'assignid' => $sid,
        );
        $this->db->insert($this->lesson_implementation_table, $data);
    }

    function checkImplementation($count, $id) {
        $this->db->select('*');
        $this->db->where('assignid', $id);
        $this->db->where('implementationcount', $count);
        $query = $this->db->get($this->lesson_implementation_table, 1);

        if ($query->num_rows() == 1) {
            return $query->row_array();
        }
    }

    function editImplementation($id, $imp){
        $data = array(
            'implementation' => $imp,
        );
        $this->db->where('implementationid', $id);
        $this->db->update($this->lesson_implementation_table, $data);
    }

    function getAllCoursesByTeacher($id){
        $this->db->select('*');
        $this->db->join('class', 'class.classid = course_assign.classid');
        $this->db->join('course', 'course.courseid = course_assign.courseid');
        $this->db->where('course_assign.teacherid', $id);
        $this->db->order_by('classroom', 'asc');

        $query = $this->db->get($this->course_assign_table);

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
    }

    function editCourseImplementation($id){
        $data = array(
            'lesson1implementation' => $this->input->post('lesson1implementation'),
            'lesson2implementation' => $this->input->post('lesson2implementation'),
            'lesson3implementation' => $this->input->post('lesson3implementation'),
        );
        $this->db->where('assignid', $id);
        $this->db->update($this->course_assign_table, $data);
    }

//    function addMaterial($assignid){
//        $data = array(
//            'courseid' => $id,
//            'coursename' => $this->input->post('coursename'),
//            'coursedescription' => $this->input->post('coursedescription'),
//            'courseresources' => $this->input->post('courseresources'),
//            'lesson1chapter' => $this->input->post('lesson1chapter'),
//            'lesson1objective' => $this->input->post('lesson1objective'),
//            'lesson1activities' => $this->input->post('lesson1activities'),
//            'lesson1material' => $this->input->post('lesson1material'),
//            'lesson2chapter' => $this->input->post('lesson2chapter'),
//            'lesson2objective' => $this->input->post('lesson2objective'),
//            'lesson2activities' => $this->input->post('lesson2activities'),
//            'lesson2material' => $this->input->post('lesson2material'),
//            'lesson3chapter' => $this->input->post('lesson3chapter'),
//            'lesson3objective' => $this->input->post('lesson3objective'),
//            'lesson3activities' => $this->input->post('lesson3activities'),
//            'lesson3material' => $this->input->post('lesson3material'),
//        );
//        $this->db->insert($this->course_table, $data);
//    }

    function getMaterialsByAssignID($assignid){
        $this->db->select('*');
        $this->db->join('file', 'file.fileid = material.fileid');
        $this->db->where('material.assignid', $assignid);
        $this->db->order_by('material.date', 'desc');

        $query = $this->db->get($this->material_table);

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
    }

    function getFilesByAssignID($assignid){
        $this->db->select('*');
        $this->db->join('file', 'file.teacherid = course_assign.teacherid');
        $this->db->where('course_assign.assignid', $assignid);
        $this->db->order_by('file.date', 'desc');

        $query = $this->db->get($this->course_assign_table);

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
    }

    function getMaterialLatestID(){
        $this->db->select('materialid');
        $this->db->order_by("materialid", "desc");
        $this->db->limit(1);
        $query = $this->db->get($this->material_table, 1);

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

    function getTeacherOfAssignID($id) {
        $this->db->select('teacherid');
        $this->db->where('assignid', $id);
        $query = $this->db->get($this->course_assign_table, 1);

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

    function addMaterial($mid, $sid, $fid){
        $data = array(
            'materialid' => $mid,
            'assignid' => $sid,
            'topic' => $this->input->post('topic'),
            'type' => $this->input->post('type'),
            'date' => date('Y-m-d', now()),
            'fileid' => $fid,
        );
        $this->db->insert($this->material_table, $data);
    }

    function getQnAByAssignID($assignid){
        $this->db->select('*');
        $this->db->join('file', 'file.fileid = assignmentandquiz.fileid');
        $this->db->where('assignmentandquiz.assignid', $assignid);
        $this->db->order_by('assignmentandquiz.duedate', 'desc');

        $query = $this->db->get($this->qna_table);

        if ($query->num_rows() > 0) {
            return $query->result_array();
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

    function addQnA($anqid, $sid, $fid){
        $data = array(
            'anqid' => $anqid,
            'assignid' => $sid,
            'topic' => $this->input->post('topic'),
            'type' => $this->input->post('type'),
            'uploaddate' => date('Y-m-d', now()),
            'duedate' => $this->input->post('duedate'),
            'fileid' => $fid,
        );
        $this->db->insert($this->qna_table, $data);
    }

    function getStudentsByClassID($classid){
        $this->db->select('*');
        $this->db->where('classid', $classid);
        $this->db->order_by('firstname', 'asc');

        $query = $this->db->get($this->student_table);

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
    }

    function getStudentDataByStudentID($id){
        $this->db->select('*');
        $this->db->join('class', 'class.classid = student.classid');
        $this->db->where('student.studentid', $id);
        $query = $this->db->get($this->student_table, 1);

        if ($query->num_rows() == 1) {
            return $query->row_array();
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

    function checkReport($assignid, $studentid, $term) {
        $this->db->select('*');
        $this->db->where('assignid', $assignid);
        $this->db->where('studentid', $studentid);
        $this->db->where('term', $term);
        $query = $this->db->get($this->report_table, 1);

        if ($query->num_rows() == 1) {
            return $query->row_array();
        }
    }

    function getReportLatestID(){
        $this->db->select('reportid');
        $this->db->order_by("reportid", "desc");
        $this->db->limit(1);
        $query = $this->db->get($this->report_table, 1);

        if ($query->num_rows() == 1) {
            return $query->row_array();
        }
    }

    function addMidReport($latestID, $assignid, $studentid){
        $data = array(
            'reportid' => $latestID,
            'assignid' => $assignid,
            'studentid' => $studentid,
            'date' => date('Y-m-d', now()),
            'term' => '1',
            'motivation' => $this->input->post('op1'),
            'initiative' => $this->input->post('op2'),
            'persistance' => $this->input->post('op3'),
            'organize' => $this->input->post('op4'),
            'task' => $this->input->post('op5'),
            'homework' => $this->input->post('op6'),
            'comment' => $this->input->post('comment'),
        );
        $this->db->insert($this->report_table, $data);
    }

    function editMidReport($id){
        $data = array(
            'motivation' => $this->input->post('op1'),
            'initiative' => $this->input->post('op2'),
            'persistance' => $this->input->post('op3'),
            'organize' => $this->input->post('op4'),
            'task' => $this->input->post('op5'),
            'homework' => $this->input->post('op6'),
            'comment' => $this->input->post('comment'),
        );
        $this->db->where('reportid', $id);
        $this->db->update($this->report_table, $data);
    }

    function addFinalReport($latestID, $assignid, $studentid){
        $data = array(
            'reportid' => $latestID,
            'assignid' => $assignid,
            'studentid' => $studentid,
            'date' => date('Y-m-d', now()),
            'term' => '2',
            'motivation' => $this->input->post('opf1'),
            'initiative' => $this->input->post('opf2'),
            'persistance' => $this->input->post('opf3'),
            'organize' => $this->input->post('opf4'),
            'task' => $this->input->post('opf5'),
            'homework' => $this->input->post('opf6'),
            'comment' => $this->input->post('fcomment'),
        );
        $this->db->insert($this->report_table, $data);
    }

    function editFinalReport($id){
        $data = array(
            'motivation' => $this->input->post('opf1'),
            'initiative' => $this->input->post('opf2'),
            'persistance' => $this->input->post('opf3'),
            'organize' => $this->input->post('opf4'),
            'task' => $this->input->post('opf5'),
            'homework' => $this->input->post('opf6'),
            'comment' => $this->input->post('fcomment'),
        );
        $this->db->where('reportid', $id);
        $this->db->update($this->report_table, $data);
    }

    function getClassByTeacherID($id){
        $this->db->select('*');
        $this->db->where('teacherid', $id);
        $query = $this->db->get($this->class_table, 1);

        if ($query->num_rows() == 1) {
            return $query->row_array();
        }
    }

    function getStudentsAttendanceByClassID($classid, $date){
        $this->db->select('*');
        $this->db->join('attendance', 'attendance.studentid = student.studentid');
        $this->db->where('student.classid', $classid);
        $this->db->where('attendance.date', $date);
        $this->db->order_by('firstname', 'asc');

        $query = $this->db->get($this->student_table);

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
    }

    function getStudentsAttendanceList($classid){
        $this->db->select('*');
        $this->db->where('classid', $classid);
        $this->db->order_by('firstname', 'asc');

        $query = $this->db->get($this->student_table);

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
    }

    function getAttendanceLatestID(){
        $this->db->select('attendanceid');
        $this->db->order_by("attendanceid", "desc");
        $this->db->limit(1);
        $query = $this->db->get($this->attendance_table, 1);

        if ($query->num_rows() == 1) {
            return $query->row_array();
        }
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

    function editAttendance($attendanceid, $status, $comment){
        $data = array(
            'status' => $status,
            'description' => $comment,
        );
        $this->db->where('attendanceid', $attendanceid);
        $this->db->update($this->attendance_table, $data);
    }

    function addAttendance($aid, $cid, $sid, $status, $desc){
        $data = array(
            'attendanceid' => $aid,
            'classid' => $cid,
            'studentid' => $sid,
            'status' => $status,
            'description' => $desc,
            'date' => date('Y-m-d', now()),
        );
        $this->db->insert($this->attendance_table, $data);
    }

    function getAllTeacher(){
        $this->db->select('*');
        $this->db->join('class', 'class.teacherid = teacher.teacherid');
        $this->db->order_by('teacher.firstname', 'asc');

        $query = $this->db->get($this->table);

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

    function getStudentReport($classid, $id, $term){
        $this->db->select('*');
        $this->db->join('course', 'course.courseid = course_assign.courseid');
        $this->db->join('teacher', 'teacher.teacherid = course_assign.teacherid');
        $this->db->join('report', 'report.assignid = course_assign.assignid');
        $this->db->where('course_assign.classid', $classid);
        $this->db->where('report.studentid', $id);
        $this->db->where('report.term', $term);
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

    function checkHomeroomReport($studentid, $term) {
        $this->db->select('*');
        $this->db->where('studentid', $studentid);
        $this->db->where('term', $term);
        $query = $this->db->get($this->homeroom_table, 1);

        if ($query->num_rows() == 1) {
            return $query->row_array();
        }
    }

    function getHomeroomReportLatestID(){
        $this->db->select('homeroomid');
        $this->db->order_by("homeroomid", "desc");
        $this->db->limit(1);
        $query = $this->db->get($this->homeroom_table, 1);

        if ($query->num_rows() == 1) {
            return $query->row_array();
        }
    }

    function addHomeroomReport($latestID, $studentid, $term){
        $data = array(
            'homeroomid' => $latestID,
            'studentid' => $studentid,
            'date' => date('Y-m-d', now()),
            'term' => $term,
            'consideration' => $this->input->post('op1'),
            'responsibility' => $this->input->post('op2'),
            'communication' => $this->input->post('op3'),
            'punctual' => $this->input->post('op4'),
            'comment' => $this->input->post('comment'),
        );
        $this->db->insert($this->homeroom_table, $data);
    }

    function editHomeroomReport($id){
        $data = array(
            'consideration' => $this->input->post('op1'),
            'responsibility' => $this->input->post('op2'),
            'communication' => $this->input->post('op3'),
            'punctual' => $this->input->post('op4'),
            'comment' => $this->input->post('comment'),
        );
        $this->db->where('homeroomid', $id);
        $this->db->update($this->homeroom_table, $data);
    }

    function getHomeroomReport($studentid, $term) {
        $this->db->select('*');
        $this->db->where('studentid', $studentid);
        $this->db->where('term', $term);

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
}

?>
