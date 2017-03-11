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
}

?>
