<?php
class Teacher_model extends CI_Model {

    var $table = 'teacher';
    var $course_table = 'course';
    var $course_assign_table = 'course_assign';
    var $material_table = 'material';
    var $lesson_plan_table = 'lesson_plan';
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
}

?>
