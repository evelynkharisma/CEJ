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
    var $payment_file = 'payment_file';
    var $outstanding_book = 'library_borrowed';
    var $library_collection = 'library_collection';


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

    function resetPassword($id, $token){
        $data = array(
            'password' => crypt($token,'$6$rounds=5000$simsthesisproject$')
        );
        $this->db->where('operationid', $id);
        $this->db->update($this->table, $data);
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

    function getCollectionDetail($id)
    {
        $this->db->select('*');
        $this->db->where('lcid', $id);
        $this->db->limit(1);
        $query = $this->db->get($this->library_collection, 1);

        if ($query->num_rows() == 1) {
            return $query->row_array();
        }
    }



    function notify($id){
        $data = array(
            'notify' => date('Y-m-d', now()),
        );

        $this->db->where('lbid', $id);
        $this->db->update($this->outstanding_book, $data);

        return TRUE;
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

    function getAllBorrowedBook()
    {
        $this->db->select('*');
        $this->db->where('status', 'Borrowed');

        $query = $this->db->get($this->outstanding_book);

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
    }

    function countAllBorrowedBook()
    {
        $this->db->select('*');
        $this->db->where('status', 'Borrowed');

        $query = $this->db->get($this->outstanding_book);
        $rowcount = $query->num_rows();

        return $rowcount;
    }
    
    function getAllHistoryBook()
    {
        $this->db->select('*');
        $this->db->where('status', 'Returned');

        $query = $this->db->get($this->outstanding_book);

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
    }

    function getAllNotifyBook()
    {
        $this->db->select('*');
        $this->db->where('status', 'Borrowed');
        $this->db->where('notify!=', date('Y-m-d', now()));

        $query = $this->db->get($this->outstanding_book);

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
    }


    function getPaymentFile ($id){
        $this->db->select('*');
        $this->db->where('paymentid', $id);
        $query = $this->db->get($this->payment_file);

        if ($query->num_rows() == 1) {
            return $query->row_array();
        }
    }

    function approvePayment($id) {
        $data = array(
            'status' => '1',
            'paymentdate' =>  date('Y-m-d', now()),
        );

        $this->db->where('paymentid', $id);
        $this->db->update($this->payment, $data);

        return TRUE;
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
    
    function countAllOutstandingPayment()
    {
        $this->db->select('*, SUM(payment.value) AS value, GROUP_CONCAT(payment.inquirydate) AS inquirydate');
        $this->db->join('student', 'payment.studentid = student.studentid');
        $this->db->group_by('payment.studentid');
        $this->db->order_by('student.firstname', 'asc');
        $this->db->order_by('payment.transactiontype', 'desc');
        $this->db->where('payment.status', '0');
        $this->db->where('payment.transactiontype', '1');

        $query = $this->db->get($this->payment);
        $rowcount = $query->num_rows();

        return $rowcount;
    }

    function countAllConfirmationPayment()
    {
        $this->db->select('*, SUM(payment.value) AS value, GROUP_CONCAT(payment.inquirydate) AS inquirydate');
        $this->db->join('student', 'payment.studentid = student.studentid');
        $this->db->group_by('payment.studentid');
        $this->db->order_by('student.firstname', 'asc');
        $this->db->order_by('payment.transactiontype', 'desc');
        $this->db->where('payment.status', '0');

        $query = $this->db->get($this->payment);
        $rowcount = $query->num_rows();

        return $rowcount;
    }

    function getPayment($id)
    {
        $this->db->select('*');
        $this->db->join('student', 'payment.studentid = student.studentid');
        $this->db->where('paymentid', $id);
        $query = $this->db->get($this->payment);

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
    
    function countAllResourceOriNew()
    {
        $this->db->select('*');
        $this->db->where('status', '0');

        $query = $this->db->get($this->book_request);
        $rowcount = $query->num_rows();

        return $rowcount;
    }

    function acceptBookOrder($id)
    {
        $data = array(
            'completion' => date('Y-m-d', now()),
            'status' => '1',
        );

        $this->db->where('brequestid', $id);
        $this->db->update($this->book_request, $data);

        return TRUE;
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

    function countAllResourceCopyNew()
    {
        $this->db->select('*');
        $this->db->where('status', '0');

        $query = $this->db->get($this->photocopy_request);
        $rowcount = $query->num_rows();

        return $rowcount;
    }

    function acceptCopyOrder($id)
    {
        $data = array(
            'completion' => date('Y-m-d', now()),
            'status' => '1',
        );

        $this->db->where('frequestid', $id);
        $this->db->update($this->photocopy_request, $data);

        return TRUE;
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

    function countAllStationaryNew()
    {
        $this->db->select('*');
        $this->db->where('status', '0');

        $query = $this->db->get($this->item_request);
        $rowcount = $query->num_rows();

        return $rowcount;
    }

    function acceptStationaryOrder($id)
    {
        $data = array(
            'completion' => date('Y-m-d', now()),
            'status' => '1',
        );

        $this->db->where('requestid', $id);
        $this->db->update($this->item_request, $data);

        return TRUE;
    }

    function finishStationaryOrder($id, $remains, $status)
    {  
        if($status=='1'){
            $data = array(
                'remains' => $remains,
            );
        }
        else if($status=='2'){
            $data = array(
                'completion' => date('Y-m-d', now()),
                'status' => $status,
                'remains' => $remains,
            );
        }
        
        $this->db->where('requestid', $id);
        $this->db->update($this->item_request, $data);

        return TRUE;
    }

    function getStationaryOrderByID($id)
    {
        $this->db->select('*');
        $this->db->join('items', 'items.itemid = item_request.itemid');
//        $this->db->order_by('completion', 'asc');
        $this->db->where('requestid', $id);

        $query = $this->db->get($this->item_request);

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
    }

    function getStationaryOrderByItem($id)
    {
        $this->db->select('*');
//        $this->db->join('items', 'items.itemid = item_request.itemid');
        $this->db->order_by('completion', 'desc');
        $this->db->where('itemid', $id);

        $query = $this->db->get($this->item_request);

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
    }

    function getStationaryOrderByDate($date)
    {
        $this->db->select('*');
        $this->db->join('items', 'items.itemid = item_request.itemid');
        $this->db->order_by('items.itemid', 'asc');
        $this->db->where('item_request.completion', $date);

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

    function finishBookOrder($id, $remains, $status)
    {
        if($status=='1'){
            $data = array(
                'remains' => $remains,
            );
        }
        else if($status=='2'){
            $data = array(
                'completion' => date('Y-m-d', now()),
                'status' => $status,
                'remains' => $remains,
            );
        }

        $this->db->where('brequestid', $id);
        $this->db->update($this->book_request, $data);

        return TRUE;
    }

    function getBookOrderByID($id)
    {
        $this->db->select('*');
        $this->db->where('brequestid', $id);

        $query = $this->db->get($this->book_request);

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
    }

    function getBookOrderByItem($id)
    {
        $this->db->select('*');
        $this->db->order_by('completion', 'desc');
        $this->db->where('isbn', $id);

        $query = $this->db->get($this->book_request);

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
    }

    function getBookOrderByDate($date)
    {
        $this->db->select('*');
        $this->db->order_by('isbn', 'asc');
        $this->db->where('completion', $date);

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

    function finishCopyOrder($id, $remains, $status)
    {
        if($status=='1'){
            $data = array(
                'remains' => $remains,
            );
        }
        else if($status=='2'){
            $data = array(
                'completion' => date('Y-m-d', now()),
                'status' => $status,
                'remains' => $remains,
            );
        }

        $this->db->where('frequestid', $id);
        $this->db->update($this->photocopy_request, $data);

        return TRUE;
    }

    function getCopyOrderByID($id)
    {
        $this->db->select('*');
        $this->db->where('frequestid', $id);

        $query = $this->db->get($this->photocopy_request);

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
    }

    function getCopyOrderByItem($id)
    {
        $this->db->select('*');
        $this->db->order_by('completion', 'desc');
        $this->db->where('isbn', $id);

        $query = $this->db->get($this->photocopy_request);

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
    }

    function getCopyOrderByDate($date)
    {
        $this->db->select('*');
        $this->db->order_by('isbn', 'asc');
        $this->db->where('completion', $date);

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
