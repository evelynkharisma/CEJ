<?php
class Operation_model extends CI_Model {

    var $table = 'operations';
    var $event_table = 'events';
    var $parent = 'parent';
    var $student = 'student';
    var $items = 'items';
    var $item_request = 'item_request';
    var $book_request = 'book_request';
    var $photocopy_request = 'fotocopy_request';
    var $payment = 'payment';


    function __construct() {
        parent::__construct();
    }

    function checkLogin($username, $password) {
        $this->db->select('*');
        $this->db->where('operationid', $this->security->xss_clean($username));
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

        $this->db->where('operationid', $id);
        $this->db->update($this->table, $data);

        return TRUE;
    }

    function changeLastLogin($id, $current){
        $data = array(
            'lastlogin' => $current,
        );

        $this->db->where('operationid', $id);
        $this->db->update($this->table, $data);

        return TRUE;
    }

    function getProfileDataByID($id) {
        $this->db->select('*');
        $this->db->where('operationid', $id);
        $query = $this->db->get($this->table, 1);

        if ($query->num_rows() == 1) {
            return $query->row_array();
        }
    }

    function editProfile($id) {
        if ($this->input->post('password')) {
            $data = array(
//                'password' => hash('sha512', $this->input->post('password')),
                'password' => crypt($this->input->post('password'),'$6$rounds=5000$simsthesisproject$'),
                'firstname' => $this->input->post('firstname'),
                'lastname' => $this->input->post('lastname'),
                'gender' => $this->input->post('gender'),
                'phone' => $this->input->post('phone'),
                'mobile' => $this->input->post('mobile'),
                'email' => $this->input->post('email'),
                'address' => $this->input->post('address')
            );
        } else {
            $data = array(
                'firstname' => $this->input->post('firstname'),
                'lastname' => $this->input->post('lastname'),
                'gender' => $this->input->post('gender'),
                'phone' => $this->input->post('phone'),
                'mobile' => $this->input->post('mobile'),
                'email' => $this->input->post('email'),
                'address' => $this->input->post('address')
            );
        }
        $this->db->where('operationid', $id);
        $this->db->update($this->table, $data);
    }

    function editProfilePhoto($id, $filename) {
        $data = array(
            'photo' => $filename,
        );

        $this->db->where('operationid', $id);
        $this->db->update($this->table, $data);

        return TRUE;
    }

    function getLatestID()
    {
        $this->db->select('operationid');
        $this->db->order_by("operationid", "desc");
        $this->db->limit(1);
        $query = $this->db->get($this->table, 1);

        if ($query->num_rows() == 1) {
            return $query->row_array();
        }
    }

    function deleteOperation($id){
        $this->db->where('operationid', $id);
        $this->db->delete($this->table);
        if ($this->db->affected_rows() == 1) {
            return TRUE;
        }
        return FALSE;
    }

    function getAllNotify()
    {
        $this->db->select('*');
        $this->db->where('transactiontype', '0');
        $this->db->where('notify!=', date('Y-m-d', now()));

        $query = $this->db->get($this->payment);

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
    }

    function getAllOutstandingPayment()
    {
        $this->db->select('*, SUM(payment.value) AS value, GROUP_CONCAT(payment.inquirydate) AS inquirydate');
        $this->db->join('student', 'payment.studentid = student.studentid');
        $this->db->group_by('payment.studentid');
        $this->db->order_by('student.firstname', 'asc');
        $this->db->order_by('payment.transactiontype', 'desc');
        $this->db->where('payment.status', '0');

        $query = $this->db->get($this->payment);

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
    }

    function getOutstandingPayment($id)
    {
        $this->db->select('*');
        $this->db->where('paymentid', $id);
        $this->db->limit(1);
        $query = $this->db->get($this->payment, 1);

        if ($query->num_rows() == 1) {
            return $query->row_array();
        }
    }

    function getAllHistoryPayment()
    {
        $this->db->select('*, SUM(payment.value) AS value');
        $this->db->join('student', 'payment.studentid = student.studentid');
        $this->db->group_by('payment.studentid');
        $this->db->order_by('student.firstname', 'asc');
        $this->db->where('payment.status', '1');

        $query = $this->db->get($this->payment);

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
    }

    function getAllResourceOriNew()
    {
        $this->db->select('*, SUM(number) AS number');
        $this->db->group_by('isbn');
        $this->db->order_by('name', 'asc');
        $this->db->where('status', '0');

        $query = $this->db->get($this->book_request);

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
    }


    function getAllResourceCopyNew()
    {
        $this->db->select('*, SUM(number) AS number');
        $this->db->group_by('isbn');
        $this->db->order_by('name', 'asc');
        $this->db->where('status', '0');

        $query = $this->db->get($this->photocopy_request);

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
    }


    function getAllStationaryNew()
    {
        $this->db->select('*, SUM(item_request.number) AS quantity');
        $this->db->join('items', 'item_request.itemid = items.itemid');
        $this->db->group_by('item_request.itemid');
        $this->db->order_by('items.name', 'asc');
        $this->db->where('status', '0');

        $query = $this->db->get($this->item_request);

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
    }

    function getAllStationaryHistory()
    {
        $this->db->select('*, SUM(remains) AS remains');
        $this->db->group_by('completion');
        $this->db->order_by('completion, status', 'asc');
        $this->db->where('status!=', '0');

        $query = $this->db->get($this->item_request);

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
    }

    function getAllResourceOriHistory()
    {
        $this->db->select('*, SUM(remains) AS remains');
        $this->db->group_by('completion');
        $this->db->order_by('completion, status', 'asc');
        $this->db->where('status !=', '0');

        $query = $this->db->get($this->book_request);

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
    }


    function getAllResourceCopyHistory()
    {
        $this->db->select('*, SUM(remains) AS remains');
        $this->db->group_by('completion');
        $this->db->order_by('completion, status', 'asc');
        $this->db->where('status !=', '0');

        $query = $this->db->get($this->photocopy_request);

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
    }

    function getAllChildren($id){
        $this->db->select('*');
        $this->db->join('student', 'student.studentid = parent_child.studentid');
        $this->db->where('parent_child.parentid' ,$id);
        $this->db->order_by('student.firstname', 'asc');

        $query = $this->db->get($this->child_table);

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
    }

    function getStudents($id){
        $this->db->select('*');
        $this->db->where('classid' ,$id);
        $this->db->order_by('firstname', 'asc');

        $query = $this->db->get($this->student);

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
    }

    function getStudent($id){
        $this->db->select('*');
        $this->db->where('studentid' ,$id);
        $this->db->limit(1);

        $query = $this->db->get($this->student);

        if ($query->num_rows() == 1) {
            return $query->row_array();
        }
    }

    function getAllEvents(){
        $this->db->select('*');
        $this->db->where('date >=' ,date('Y-m-d', now()));
        $this->db->where('assignid','0');
        $this->db->order_by('date', 'asc');

        $query = $this->db->get($this->event_table);

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
    }

    function getAllEventsCount($id, $lastlogin){
        $this->db->select('*');
        $status_array = array($id,'0');
        $this->db->where_in('assignid', $status_array);
        $this->db->where('date >=' ,$lastlogin);
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

    function getByEmail($email) {
        $this->db->select('*');
        $this->db->where('email', $email);
        $query = $this->db->get($this->table, 1);

        if ($query->num_rows() == 1) {
            return $query->row_array();
        }
    }
}

?>
