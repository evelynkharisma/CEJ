<?php
class Teacher_model extends CI_Model {

    var $table = 'teacher';
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


}

?>
