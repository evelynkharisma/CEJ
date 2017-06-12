<?php
class Teacher_model extends CI_Model {

    var $table = 'teacher';
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
    var $roles_table = 'roles';
    var $schedule_table = 'schedule';
    var $schedule_applied_table = 'schedule_applied';
    var $schedule_exam_table = 'schedule_exam';
    var $schedule_exam_applied_table = 'schedule_exam_applied';
    var $parent_table = 'parents';
    var $parent_child_table = 'parent_child';

    function __construct() {
        parent::__construct();
    }

    function checkLogin($username, $password) {
        $this->db->select('*');
        $this->db->where('teacherid', $this->security->xss_clean($username));
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

        $this->db->where('teacherid', $id);
        $this->db->update($this->table, $data);

        return TRUE;
    }
    
    function changeLastLogin($id, $current){
        $data = array(
            'lastlogin' => $current,
        );

        $this->db->where('teacherid', $id);
        $this->db->update($this->table, $data);

        return TRUE;
    }

    function getProfileDataByID($id) {
        $this->db->select('*');
        $this->db->join('roles', 'roles.roleid = teacher.role');
        $this->db->where('teacherid', $id);
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

    function addTeacher($id, $at){
        $date_array = explode("-",$this->input->post('dateofbirth'));
        $day = $date_array[2];
        $month = $date_array[1];
        $year = $date_array[0];
        $pass = 'SMS'.$day.''.$month.''.$year;
        $data = array(
            'teacherid' => $id,
//            'password' => hash('sha512', $this->input->post('password')),
            'password' => crypt($pass,'$6$rounds=5000$simsthesisproject$'),
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
            'role' => 'r0001',
            'workinghour' => $at,
            'active' => 1,
        );
        $this->db->insert($this->table, $data);
    }

    function deleteTeacher($id){
        $data = array(
            'active' => 0,
        );

        $this->db->where('teacherid', $id);
        $this->db->update($this->table, $data);

        return TRUE;
//        $this->db->where('teacherid', $id);
//        $this->db->delete($this->table);
//        if ($this->db->affected_rows() == 1) {
//            return TRUE;
//        }
//        return FALSE;
    }

    function getAllCourses(){
        $this->db->select('*');
        $this->db->order_by('coursename', 'asc');

        $query = $this->db->get($this->course_table);

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
    }

    function getAllScheduleSetting(){
        $this->db->select('*');
        $this->db->join('teacher', 'teacher.teacherid = schedule_course.teacherid');
        $this->db->join('course', 'course.courseid = schedule_course.courseid');

        $query = $this->db->get($this->schedule_course_table);

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
    }

    function getAllCollaborativeScheduleSetting(){
        $this->db->select('*');
        $this->db->join('course', 'course.courseid = schedule_course.courseid');
        $this->db->where('schedule_course.type', 1);

        $query = $this->db->get($this->schedule_course_table);

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
    }

    function getAllElectiveScheduleSetting(){
        $this->db->select('*');
        $this->db->where('schedule_course.type', 2);

        $query = $this->db->get($this->schedule_course_table);

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
    }

    function getScheduleSettingLatestID(){
        $this->db->select('scid');
        $this->db->order_by("scid", "desc");
        $this->db->limit(1);
        $query = $this->db->get($this->schedule_course_table, 1);

        if ($query->num_rows() == 1) {
            return $query->row_array();
        }
    }

    function addScheduleSetting($id, $t, $c, $grade, $f, $tp, $r){
        $data = array(
            'scid' => $id,
            'teacherid' => $t,
            'courseid' => $c,
            'grade' => $grade,
            'frequency' => $f,
            'type' => $tp,
            'room' => $r
        );
        $this->db->insert($this->schedule_course_table, $data);
    }

    function deleteScheduleSetting($id){
        $this->db->where('scid', $id);
        $this->db->delete($this->schedule_course_table);
        if ($this->db->affected_rows() == 1) {
            return TRUE;
        }
        return FALSE;
    }

    function deleteCourse($id){
        $this->db->where('courseid', $id);
        $this->db->delete($this->course_table);
        if ($this->db->affected_rows() == 1) {
            return TRUE;
        }
        return FALSE;
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

    function getAssignDataByQuizID($id) {
        $this->db->select('*');
        $this->db->join('course_assign', 'course_assign.assignid = assignmentandquiz.assignid');
        $this->db->where('assignmentandquiz.anqid', $id);
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
        $this->db->order_by('implementationcount', 'asc');
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

    function addImplementation($id, $count, $ch, $obj, $act, $mat, $sid){
        $data = array(
            'implementationid' => $id,
            'implementationcount' => $count,
            'chapter' => $ch,
            'objective' => $obj,
            'activities' => $act,
            'material' => $mat,
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

    function editImplementation($id, $ch, $obj, $act, $mat){
        $data = array(
            'chapter' => $ch,
            'objective' => $obj,
            'activities' => $act,
            'material' => $mat,
        );
        $this->db->where('implementationid', $id);
        $this->db->update($this->lesson_implementation_table, $data);
    }

    

    function getAllCoursesByTeacher($id){
        $this->db->select('course_assign.*, class.classroom, course.coursename');

        $this->db->join('class', 'class.classid = course_assign.classid');
        $this->db->join('course', 'course.courseid = course_assign.courseid');
        $this->db->like('course_assign.teacherid', $id);
        $this->db->order_by('class.classroom', 'asc');

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

    function getByEmail($email) {
        $this->db->select('*');
        $this->db->where('email', $email);
        $query = $this->db->get($this->table, 1);

        if ($query->num_rows() == 1) {
            return $query->row_array();
        }
    }

    function resetPassword($id, $token){
        $data = array(
            'password' => crypt($token,'$6$rounds=5000$simsthesisproject$')
        );
        $this->db->where('teacherid', $id);
        $this->db->update($this->table, $data);
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

    function deleteMaterial($id){
        $this->db->where('materialid', $id);
        $this->db->delete($this->material_table);
        if ($this->db->affected_rows() == 1) {
            return TRUE;
        }
        return FALSE;
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

    function deleteQnA($id){
        $this->db->where('anqid', $id);
        $this->db->delete($this->qna_table);
        if ($this->db->affected_rows() == 1) {
            return TRUE;
        }
        return FALSE;
    }

    function deleteQnAScore($id){
        $this->db->where('anqid', $id);
        $this->db->delete($this->qnascore_table);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        }
        return FALSE;
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

    function addMidReport($latestID, $assignid, $studentid, $class){
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
            'class' => $class
        );
        $this->db->insert($this->report_table, $data);
    }

    function editTerm1Report($id){
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

    function editMidReport($id, $grade){
        $data = array(
            'mark' => $this->input->post('mark'),
            'grade' => $grade,
            'comment' => $this->input->post('comment'),
        );
        $this->db->where('reportid', $id);
        $this->db->update($this->report_table, $data);
    }

    function addFinalReport($latestID, $assignid, $studentid, $class){
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
            'class' => $class
        );
        $this->db->insert($this->report_table, $data);
    }

    function editTerm3Report($id){
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

    function editFinalReport($id, $grade){
        $data = array(
            'mark' => $this->input->post('fmark'),
            'grade' => $grade,
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

    function getClassByClassid($id){
        $this->db->select('*');
        $this->db->where('classid', $id);
        $query = $this->db->get($this->class_table, 1);

        if ($query->num_rows() == 1) {
            return $query->row_array();
        }
    }

    function getTeacherByClassid($id){
        $this->db->select('*');
        $this->db->join('teacher', 'teacher.teacherid = class.teacherid');
        $this->db->where('classid', $id);
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

    function getAllStudent(){
        $this->db->select('*');

        $query = $this->db->get($this->student_table);

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
    }
    
    function getAllTeacher(){
        $this->db->select('*');
        $this->db->where('active', 1);
        $this->db->order_by('firstname', 'asc');

        $query = $this->db->get($this->table);

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
    }

    function getAllTeacherIncludeInactive(){
        $this->db->select('*');

        $query = $this->db->get($this->table);

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
    }

    function checkTeacherHomeroom($teacherid){
        $this->db->select('*');
        $this->db->join('class', 'class.teacherid = teacher.teacherid');
        $this->db->where('teacher.teacherid', $teacherid);

        $query = $this->db->get($this->table);

        if ($query->num_rows() == 1) {
            return $query->row_array();
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

    function getStudentCourseByAssignID($sid){
        $this->db->select('*');
        $this->db->join('course', 'course.courseid = course_assign.courseid');
        $this->db->join('teacher', 'teacher.teacherid = course_assign.teacherid');
        $this->db->where('course_assign.assignid', $sid);

        $query = $this->db->get($this->course_assign_table, 1);

        if ($query->num_rows() == 1) {
            return $query->row_array();
        }
    }

    function checkHomeroomReport($studentid, $term, $class) {
        $this->db->select('*');
        $this->db->where('studentid', $studentid);
        $this->db->where('term', $term);
        $this->db->where('class', $class);
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

    function addHomeroomReport($latestID, $studentid, $term, $class){
        $data = array(
            'homeroomid' => $latestID,
            'studentid' => $studentid,
            'date' => date('Y-m-d', now()),
            'term' => $term,
            'consideration' => $this->input->post('op1'),
            'responsibility' => $this->input->post('op2'),
            'communication' => $this->input->post('op3'),
            'punctual' => $this->input->post('op4'),
            'class' => $class
        );
        $this->db->insert($this->homeroom_table, $data);
    }

    function editHomeroomReport($id){
        $data = array(
            'consideration' => $this->input->post('op1'),
            'responsibility' => $this->input->post('op2'),
            'communication' => $this->input->post('op3'),
            'punctual' => $this->input->post('op4')
        );
        $this->db->where('homeroomid', $id);
        $this->db->update($this->homeroom_table, $data);
    }
    function editHomeroomReport2($id){
        $data = array(
            'comment' => $this->input->post('comment')
        );
        $this->db->where('homeroomid', $id);
        $this->db->update($this->homeroom_table, $data);
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
        $this->db->where('status !=', 'a');

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

    function getSemesterLatestID(){
        $this->db->select('semesterid');
        $this->db->order_by("semesterid", "desc");
        $this->db->limit(1);
        $query = $this->db->get($this->semester_table, 1);

        if ($query->num_rows() == 1) {
            return $query->row_array();
        }
    }

    function addSemester($id, $w, $t, $o, $a, $r, $cid){
        $data = array(
            'semesterid' => $id,
            'week' => $w,
            'topic' => $t,
            'outcome' => $o,
            'assessment' => $a,
            'resources' => $r,
            'courseid' => $cid,
        );
        $this->db->insert($this->semester_table, $data);
    }

    function editSemester($id, $w, $t, $o, $a, $r){
        $data = array(
            'week' => $w,
            'topic' => $t,
            'outcome' => $o,
            'assessment' => $a,
            'resources' => $r,
        );
        $this->db->where('semesterid', $id);
        $this->db->update($this->semester_table, $data);
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

    function addForm($id, $f){
        $data = array(
            'formid' => $id,
            'title' => $this->input->post('title'),
            'description' => $this->input->post('description'),
            'formname' => $f,
        );
        $this->db->insert($this->form_table, $data);
    }

    function editForm($id){
        $data = array(
            'title' => $this->input->post('title'),
            'description' => $this->input->post('description')
        );
        $this->db->where('formid', $id);
        $this->db->update($this->form_table, $data);
    }

    function editFormWithFile($id, $f){
        $data = array(
            'title' => $this->input->post('title'),
            'description' => $this->input->post('description'),
            'formname' => $f,
        );
        $this->db->where('formid', $id);
        $this->db->update($this->form_table, $data);
    }


    function deleteForm($id){
        $this->db->where('formid', $id);
        $this->db->delete($this->form_table);
        if ($this->db->affected_rows() == 1) {
            return TRUE;
        }
        return FALSE;
    }

    function getAllEventNoRestriction(){
        $this->db->select('*');

        $this->db->where('date >=' ,date('Y-m-d', now()));
        
        $this->db->order_by('date', 'asc');

        $query = $this->db->get($this->event_table);

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
    }

    function getAllEvents($id){
        $this->db->select('*');
//        $status_array = array($id,'0');
        $where1 = "(teacherid='0' OR teacherid='1' OR teacherid='$id')";
        $where2 = "(teacherid='3' AND participant LIKE '%$id%')";

        $this->db->where('date >=' ,date('Y-m-d', now()));
        $this->db->where($where1);
        $this->db->or_where($where2);
        $this->db->where('date >=' ,date('Y-m-d', now()));
        $this->db->order_by('date', 'asc');

        $query = $this->db->get($this->event_table);

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
    }

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

    function getAllSchedulingSettings(){
        $this->db->select('*');
        $type_array = array('s0005', 's0006', 's0007', 's0008', 's0009', 's0010', 's0011', 's0012', 's0013');
        $this->db->where_in('settingid', $type_array);

        $query = $this->db->get($this->setting_table);

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
    }

    function getAllGradingSettings(){
        $this->db->select('*');
        $type_array = array('s0001', 's0002', 's0003', 's0004', 's0014', 's0015', 's0016', 's0017', 's0018', 's0019', 's0020', 's0021', 's0022', 's0023', 's0024', 's0025');
        $this->db->where_in('settingid', $type_array);

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

    function getAllQnAByStudent($studentid, $assignid, $type){
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
        $this->db->where('assignmentandquiz.assignid', $assignid);
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
        $this->db->join('items', 'items.itemid = item_request.itemid');
        $this->db->where('item_request.itemid', $i);
        $this->db->where('teacherid', $t);
        $this->db->where('status <' , 2);

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
        $this->db->where('status <' , 2);

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

    function deleteBookRequest($id){
        $this->db->where('brequestid', $id);
        $this->db->delete($this->book_request_table);
        if ($this->db->affected_rows() == 1) {
            return TRUE;
        }
        return FALSE;
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

    function getBookRequest($id){
        $this->db->select('*');
        $this->db->where("brequestid", $id);
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
        $this->db->where('status <' , 2);

        $query = $this->db->get($this->fotocopy_request_table);

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
    }

    function getFotocopyRequest($id){
        $this->db->select('*');
        $this->db->where("frequestid", $id);
        $query = $this->db->get($this->fotocopy_request_table, 1);

        if ($query->num_rows() == 1) {
            return $query->row_array();
        }
    }

    function editFotocopyRequest($id){
        $data = array(
            'number' => $this->input->post('value'),
        );
        $this->db->where('frequestid', $id);
        $this->db->update($this->fotocopy_request_table, $data);
    }

    function deleteFotocopyRequest($id){
        $this->db->where('frequestid', $id);
        $this->db->delete($this->fotocopy_request_table);
        if ($this->db->affected_rows() == 1) {
            return TRUE;
        }
        return FALSE;
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
    }
    
    function getWorkingHour($tid){
        $this->db->select('workinghour');
        $this->db->where('teacherid', $tid);
        $query = $this->db->get($this->table, 1);

        if ($query->num_rows() == 1) {
            return $query->row_array();
        }
    }

    function getTeachingFrequency($tid){
        $this->db->select('frequency');
        $this->db->where('teacherid', $tid);
        $query = $this->db->get($this->schedule_course_table);

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
    }

    function getAllFrequencyForGrade($grade){
        $this->db->select('frequency');
        $this->db->like('grade', $grade);
        $query = $this->db->get($this->schedule_course_table);

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
    }

    function getAllCourseForGrade($grade){
        $this->db->select('*');
        $this->db->join('teacher', 'teacher.teacherid = schedule_course.teacherid');
        $this->db->join('course', 'course.courseid = schedule_course.courseid');
        $this->db->like('grade', $grade);
        $query = $this->db->get($this->schedule_course_table);

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
    }

    function getRoleCategory($c){
        $this->db->select('*');
        $this->db->where('category', $c);
        $query = $this->db->get($this->roles_table);

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
    }

    function editRole($tid){
        $data = array(
            'role' => $this->input->post('role'),
        );
        $this->db->where('teacherid', $tid);
        $this->db->update($this->table, $data);
    }

    function getScheduleLatestID(){
        $this->db->select('scheduleid');
        $this->db->order_by("scheduleid", "desc");
        $this->db->limit(1);
        $query = $this->db->get($this->schedule_table, 1);

        if ($query->num_rows() == 1) {
            return $query->row_array();
        }
    }

    function addSchedule($schedulearray){
        $this->db->insert_batch($this->schedule_table, $schedulearray);
    }

    function getAllScheduleForGrade($grade){
        $this->db->select('*');
        $this->db->join('teacher', 'teacher.teacherid = schedule.teacherid');
        $this->db->join('course', 'course.courseid = schedule.courseid');
        $this->db->where('classid', $grade);
        $this->db->order_by("scheduleid", "asc");
        $query = $this->db->get($this->schedule_table);

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
    }

    function getAllScheduleOfTeacher($tid){
        $this->db->select('*');
//        $this->db->join('teacher', 'teacher.teacherid = schedule.teacherid');
        $this->db->join('course', 'course.courseid = schedule.courseid');
        $this->db->where('schedule.teacherid', $tid);
        $query = $this->db->get($this->schedule_table);

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
    }

    function getAllScheduleOfTeacherOfDay($tid, $d){
        $this->db->select('*');
        $this->db->join('class', 'class.classid = schedule.classid');
        $this->db->join('course', 'course.courseid = schedule.courseid');
        $this->db->where('schedule.teacherid', $tid);
        $this->db->where('schedule.day', $d);
        $this->db->order_by('schedule.period', 'asc');
        $query = $this->db->get($this->schedule_table);

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
    }

    function getScheduleWithRowColom($r, $c, $not){
        $this->db->select('*');
        $this->db->where('period', $r);
        $this->db->where('day', $c);
        $this->db->where_not_in('scheduleid', $not);
        $query = $this->db->get($this->schedule_table);

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
    }

    function getScheduleWithDayOfGrade($c, $g, $not){
        $this->db->select('*');
        $this->db->where('classid', $g);
        $this->db->where('day', $c);
        $this->db->where_not_in('scheduleid',$not);
        $query = $this->db->get($this->schedule_table);

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
    }

    function getScheduleID($c, $r, $d){
        $this->db->select('*');
        $this->db->where('classid', $c);
        $this->db->where('period', $r);
        $this->db->where('day', $d);
        $query = $this->db->get($this->schedule_table, 1);

        if ($query->num_rows() == 1) {
            return $query->row_array();
        }
    }

    function deleteAllSchedule(){
        $this->db->empty_table($this->schedule_table);
    }

    function getScheduleAppliedLatestID(){
        $this->db->select('scheduleid');
        $this->db->order_by("scheduleid", "desc");
        $this->db->limit(1);
        $query = $this->db->get($this->schedule_applied_table, 1);

        if ($query->num_rows() == 1) {
            return $query->row_array();
        }
    }

    function addScheduleApplied($schedulearray){
        $this->db->insert_batch($this->schedule_applied_table, $schedulearray);
    }

    function deleteAllScheduleApplied(){
        $this->db->empty_table($this->schedule_applied_table);
    }

    function getExamScheduleOfCourse($c){
        $this->db->select('*');
        $this->db->where('courseid', $c);
        $query = $this->db->get($this->schedule_exam_table, 1);

        if ($query->num_rows() == 1) {
            return $query->row_array();
        }
    }

    function addExamSchedule($schedulearray){
        $this->db->insert_batch($this->schedule_exam_table, $schedulearray);
    }

    function deleteExamSchedule(){
        $this->db->empty_table($this->schedule_exam_table);
    }

    function getExamSchedule(){
        $order = "CAST(classid AS UNSIGNED), classid";

        $this->db->select('*');
        $this->db->join('teacher', 'teacher.teacherid = schedule_exam.teacherid');
        $this->db->join('course', 'course.courseid = schedule_exam.courseid');
        $this->db->order_by($order);
        $this->db->order_by("count", "asc");
        $query = $this->db->get($this->schedule_exam_table);

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
    }

    function getExamInvigilatorAvailable($not){
        $this->db->select('*');
        $this->db->where_not_in('teacherid',$not);
        $query = $this->db->get($this->table);

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
    }

    function addExamScheduleApplied($schedulearray){
        $this->db->insert_batch($this->schedule_exam_applied_table, $schedulearray);
    }

    function deleteAllExamScheduleApplied(){
        $this->db->empty_table($this->schedule_exam_applied_table);
    }

    function getExamScheduleAppliedOfCourse($c){
        $this->db->select('*');
        $this->db->where('courseid', $c);
        $query = $this->db->get($this->schedule_exam_applied_table, 1);

        if ($query->num_rows() == 1) {
            return $query->row_array();
        }
    }

    function getExamScheduleApplied(){
        $order = "CAST(classid AS UNSIGNED), classid";

        $this->db->select('*');
        $this->db->join('teacher', 'teacher.teacherid = schedule_exam_applied.teacherid');
        $this->db->join('course', 'course.courseid = schedule_exam_applied.courseid');
        $this->db->order_by($order);
        $this->db->order_by("count", "asc");
        $query = $this->db->get($this->schedule_exam_applied_table);

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
    }

    function getExamByID($id){
        $this->db->select('*');
        $this->db->join('class', 'class.classid = schedule_exam_applied.classid');
        $this->db->join('course', 'course.courseid = schedule_exam_applied.courseid');
        $this->db->join('teacher', 'teacher.teacherid = schedule_exam_applied.teacherid');
        $this->db->where('schedule_exam_applied.examid', $id);
        $query = $this->db->get($this->schedule_exam_applied_table, 1);

        if ($query->num_rows() == 1) {
            return $query->row_array();
        }
    }
    
    function getAllClasses(){
        $this->db->select('*');
//        $this->db->order_by('classroom', 'asc');

        $query = $this->db->get($this->class_table);

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
    }

    function getAllClassesOfType($t){
        $this->db->select('*');
        $this->db->where('type', $t);

        $query = $this->db->get($this->class_table);

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
    }

    function getAllClassesWithTeacher(){
        $this->db->select('*');
        $this->db->join('teacher', 'teacher.teacherid = class.teacherid');

        $query = $this->db->get($this->class_table);

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
    }

    function getAllClassesWithNoTeacher(){
        $this->db->select('*');
        $this->db->join('teacher', 'teacher.teacherid = class.teacherid', 'left');
        $this->db->where('teacher.teacherid', null);

        $query = $this->db->get($this->class_table);

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
    }

    function getAssignLatestID(){
        $this->db->select('assignid');
        $this->db->order_by("assignid", "desc");
        $this->db->limit(1);
        $query = $this->db->get($this->course_assign_table, 1);

        if ($query->num_rows() == 1) {
            return $query->row_array();
        }
    }

    function addAssignCourses($schedulearray){
        $this->db->insert($this->course_assign_table, $schedulearray);
    }

    function checkAssignCourse($clid, $tid, $cid) {
        $this->db->select('*');
        $this->db->where('classid', $clid);
        $this->db->where('teacherid', $tid);
        $this->db->where('courseid', $cid);
        $query = $this->db->get($this->course_assign_table, 1);

        if ($query->num_rows() == 1) {
            return $query->row_array();
        }
    }

    function getClassLatestID(){
        $this->db->select('classid');
        $this->db->order_by("classid", "desc");
        $this->db->limit(1);
        $query = $this->db->get($this->class_table, 1);

        if ($query->num_rows() == 1) {
            return $query->row_array();
        }
    }

    function addClass($id){
        $data = array(
            'classid' => $id,
            'classroom' => $this->input->post('class'),
            'teacherid' => $this->input->post('teacher'),
            'periode' =>  date('Y-m-d', now()),
            'capacity' =>  $this->input->post('capacity'),
//            'type' =>  $this->input->post('type'),
            'type' =>  0,
        );
        $this->db->insert($this->class_table, $data);
    }

    function editClass($id){
        $data = array(
            'classroom' => $this->input->post('class'),
            'teacherid' => $this->input->post('teacher'),
            'capacity' =>  $this->input->post('capacity'),
        );
        $this->db->where('classid', $id);
        $this->db->update($this->class_table, $data);
    }

    function deleteClass($id){
        $this->db->where('classid', $id);
        $this->db->delete($this->class_table);
        if ($this->db->affected_rows() == 1) {
            return TRUE;
        }
        return FALSE;
    }

    function getAllParent(){
        $this->db->select('*');
//        $this->db->join('parent_child', 'parent_child.parentid = parents.parentid');
//        $this->db->join('student', 'student.studentid = parent_child.studentid');
//        $this->db->join('class', 'class.classid = student.classid');

        $query = $this->db->get($this->parent_table);

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
    }

    function getChildOfParent($pid){
        $this->db->select('*');
        $this->db->join('student', 'student.studentid = parent_child.studentid');
        $this->db->join('class', 'class.classid = student.classid');
        $this->db->where('parent_child.parentid', $pid);

        $query = $this->db->get($this->parent_child_table);

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
    }
}

?>
