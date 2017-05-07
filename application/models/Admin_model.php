<?php
class Admin_model extends CI_Model {

    var $table = 'admin';
    var $parents_table = 'parents';
    var $parents_child_table = 'parent_child';
    var $roles_table = 'roles';
    var $privileges_table = 'privileges';
    var $privilege_assigned_table = 'privilege_assigned';
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
        $this->db->where('active', '1');

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

    function activateParent($id){
        $data = array(
            'active' => '1',
        );
        $this->db->where('parentid', $id);
        $this->db->update($this->parents_table, $data);
        if ($this->db->affected_rows() == 1) {
            return TRUE;
        }
        return FALSE;
    }

    function deactivateParent($id){
        $data = array(
            'active' => '0',
        );
        $this->db->where('parentid', $id);
        $this->db->update($this->parents_table, $data);
        if ($this->db->affected_rows() == 1) {
            return TRUE;
        }
        return FALSE;
    }

    function getAllRoles(){
        $this->db->select('*');
//        $this->db->order_by("name","asc");
        $query = $this->db->get($this->roles_table);

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
    }

    function getRoleDataByID($id){
        $this->db->select('*');
        $this->db->where('roles.roleid',$id);


        $query = $this->db->get($this->roles_table, 1);

        if ($query->num_rows() == 1) {
            return $query->row_array();
        }
    }

    function getRoleLatestID(){
        $this->db->select('roleid');
        $this->db->order_by("roleid", "desc");
        $this->db->limit(1);
        $query = $this->db->get($this->roles_table, 1);

        if ($query->num_rows() == 1) {
            return $query->row_array();
        }
    }

    function deleteRole($id) {
        $this->db->where('roleid', $id);
        $this->db->delete($this->roles_table);
        if ($this->db->affected_rows() == 1) {
            return TRUE;
        }
        return FALSE;
    }

    function editRole($id) {
        $data = array(
            'name' => $this->input->post('rolename'),
            'category' => $this->input->post('rolecategory'));
        $this->db->where('roleid', $id);
        $this->db->update($this->roles_table, $data);
    }

    function addRole($id){
        $data = array(
            'roleid' => $id,
            'name' => $this->input->post('rolename'),
            'category' => $this->input->post('rolecategory'),
        );
        $this->db->insert($this->roles_table, $data);
    }

    function getAllPrivileges(){
        $this->db->select('*');
        $this->db->order_by("name", "asc");
        $query = $this->db->get($this->privileges_table);

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
    }

    function getAssignedRole(){
        /*$sql = 'SELECT privilege_assigned.paid as paid, privilege_assigned.roleid as roleid, roles.name as rolename, PRIVILEGES.privilegeid as privilegeid, privileges.name as privilegename FROM privilege_assigned, PRIVILEGES, roles WHERE privileges.privilegeid=privilege_assigned.privilegeid AND privilege_assigned.roleid=roles.roleid';*/

        $sql = 'SELECT DISTINCT * FROM roles Where roleid IN (SELECT roleid FROM privilege_assigned)';

        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
    }

    function getNotAssignedRole(){
          $sql = 'SELECT DISTINCT * FROM roles Where roleid NOT IN (SELECT roleid FROM privilege_assigned)';

        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
    }

    function getAssignedLatestID(){
        $this->db->select('paid');
        $this->db->order_by("paid", "desc");
        $this->db->limit(1);
        $query = $this->db->get($this->privilege_assigned_table, 1);

        if ($query->num_rows() == 1) {
            return $query->row_array();
        }
    }

    function getAssignedPrivilegeDataByRole($id)
    {
        $sql = 'SELECT *FROM privilege_assigned, privileges WHERE privilege_assigned.privilegeid=privileges.privilegeid AND privilege_assigned.roleid=\''.$id.'\'';

        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
    }

    function deleteAssignedPrivilegeOfRole($id) {
        $this->db->where('roleid', $id);
        $this->db->delete($this->privilege_assigned_table);
        if ($this->db->affected_rows() != 0) {
            return TRUE;
        }
        return FALSE;
    }

    function addAssignedPrivilege($id,$role,$privilege ) {
        $data = array(
            'paid' => $id,
            'roleid' => $role,
            'privilegeid' => $privilege,
            'status' => '1');
        $this->db->insert($this->privilege_assigned_table, $data);
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

}

?>
