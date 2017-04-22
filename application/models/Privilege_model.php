<?php
class Privilege_model extends CI_Model {

    var $privilege_table = 'privileges';
    var $role_table = 'roles';
    var $privilege_assigned_table = 'privilege_assigned';
    var $category_table = 'role_category';

    function __construct() {
        parent::__construct();
    }

    function checkPrivilege($role, $privilege) {
        $this->db->select('status');
        $this->db->where('roleid', $role);
        $this->db->where('privilegeid', $privilege);
        $query = $this->db->get($this->privilege_assigned_table, 1);

        if ($query->num_rows() == 1) {
            return $query->row_array();
        }
    }
}

?>
