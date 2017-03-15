<?php
class Teacher_model extends CI_Model {

    var $table = 'teacher';
    var $course_table = 'course';
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
            'lesson1chapter' => $this->input->post('lesson1chapter'),
            'lesson1objective' => $this->input->post('lesson1objective'),
            'lesson1activities' => $this->input->post('lesson1activities'),
            'lesson1material' => $this->input->post('lesson1material'),
            'lesson2chapter' => $this->input->post('lesson2chapter'),
            'lesson2objective' => $this->input->post('lesson2objective'),
            'lesson2activities' => $this->input->post('lesson2activities'),
            'lesson2material' => $this->input->post('lesson2material'),
            'lesson3chapter' => $this->input->post('lesson3chapter'),
            'lesson3objective' => $this->input->post('lesson3objective'),
            'lesson3activities' => $this->input->post('lesson3activities'),
            'lesson3material' => $this->input->post('lesson3material'),
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

    function editCourse($id){
        $data = array(
            'courseid' => $id,
            'coursename' => $this->input->post('coursename'),
            'coursedescription' => $this->input->post('coursedescription'),
            'courseresources' => $this->input->post('courseresources'),
            'lesson1chapter' => $this->input->post('lesson1chapter'),
            'lesson1objective' => $this->input->post('lesson1objective'),
            'lesson1activities' => $this->input->post('lesson1activities'),
            'lesson1material' => $this->input->post('lesson1material'),
            'lesson2chapter' => $this->input->post('lesson2chapter'),
            'lesson2objective' => $this->input->post('lesson2objective'),
            'lesson2activities' => $this->input->post('lesson2activities'),
            'lesson2material' => $this->input->post('lesson2material'),
            'lesson3chapter' => $this->input->post('lesson3chapter'),
            'lesson3objective' => $this->input->post('lesson3objective'),
            'lesson3activities' => $this->input->post('lesson3activities'),
            'lesson3material' => $this->input->post('lesson3material'),
        );
        $this->db->where('courseid', $id);
        $this->db->update($this->course_table, $data);
    }
}

?>
