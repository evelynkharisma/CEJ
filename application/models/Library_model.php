<?php
class Library_model extends CI_Model {

    var $library_service_table = 'library_services';
    var $library_news_table = 'library_news';
//    var $course_table = 'course';
//    var $course_assign_table = 'course_assign';
//    var $attendance_table = 'attendance';
//    var $material_table = 'material';
//    var $file_table = 'file';
//    var $qna_table = 'assignmentandquiz';
//    var $qnascore_table = 'assignmentandquizscore';
//    var $lesson_plan_table = 'lesson_plan';
//    var $lesson_implementation_table = 'lesson_implementation';
//    var $student_table = 'student';
//    var $report_table = 'report';
//    var $class_table = 'class';
//    var $homeroom_table = 'homeroom';
//    var $semester_table = 'semester';
//    var $form_table = 'forms';
//    var $event_table = 'events';
//    var $setting_table = 'settings';
//    var $event_image_table = 'event_images';

    function __construct() {
        parent::__construct();
    }

    function getAllServices(){
        $this->db->select('*');

        $query = $this->db->get($this->library_service_table);

        return $query->num_rows();
    }

    function getServiceByID($id) {
        $this->db->select('*');
        $this->db->where('serviceid', $id);
        $this->db->limit(1);
        $query = $this->db->get($this->library_service_table, 1);

        if ($query->num_rows() == 1) {
            return $query->row_array();
        }
    }

    function getAllNews(){
        $this->db->select('*');

        $query = $this->db->get($this->library_news_table);

        return $query->num_rows();
    }

    function getNewsByID($id) {
        $this->db->select('*');
        $this->db->where('newsid', $id);
        $this->db->limit(1);
        $query = $this->db->get($this->library_news_table, 1);

        if ($query->num_rows() == 1) {
            return $query->row_array();
        }
    }

    function getRecentNews() {
        $sql = 'SELECT * FROM `library_news` ORDER BY `date` ASC LIMIT 5';

        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
    }

    function getAllUsefulLink(){
        $sql = 'SELECT library_useful_link.name, library_useful_link_content.* FROM library_useful_link_content, library_useful_link WHERE library_useful_link.category=library_useful_link_content.category ORDER BY library_useful_link.category ASC';

        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }

    }

    function getUsefulLinkCategory(){
        $sql = 'SELECT * FROM library_useful_link ORDER BY category ASC';

        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }

    }
}

?>
