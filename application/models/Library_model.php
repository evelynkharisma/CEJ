<?php
class Library_model extends CI_Model {

    var $table = 'librarian';
    var $library_service_table = 'library_services';
    var $library_news_table = 'library_news';
    var $library_collection_table = 'library_collection';
    var $library_collection_authors_table = 'library_collection_authors';
    var $library_collection_subjects_table = 'library_collection_subjects';
    var $library_borrowed_collection_table = 'library_borrowed';
    var $library_borrowing_setting= 'library_borrowing_setting';
    var $library_useful_link_table = 'library_useful_link';
    var $library_useful_link_content_table = 'library_useful_link_content';
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

    function checkLogin($username, $password) {
        $this->db->select('*');
        $this->db->where('librarianid', $this->security->xss_clean($username));
        $password = crypt($this->security->xss_clean($password),'$6$rounds=5000$simsthesisproject$');
        $this->db->where('password', $password);
        $query = $this->db->get($this->table, 1);
        if ($query->num_rows() == 1) {
            return $query->row_array();
        }
    }

    function getProfileDataByID($id) {
        $this->db->select('*');
        $this->db->where('librarianid', $id);
        $query = $this->db->get($this->table, 1);

        if ($query->num_rows() == 1) {
            return $query->row_array();
        }
    }




    function getCollectionLatestID()
    {
        $this->db->select('lcid');
        $this->db->order_by("lcid", "desc");
        $this->db->limit(1);
        $query = $this->db->get($this->library_collection_table, 1);

        if ($query->num_rows() == 1) {
            return $query->row_array();
        }
    }

    function getCollections() {
        $sql = 'SELECT * FROM library_collection';

        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
    }

    function getCollectionDataByID($id){
        $this->db->select('*');
        $this->db->where('lcid',$id);


        $query = $this->db->get($this->library_collection_table, 1);

        if ($query->num_rows() == 1) {
            return $query->row_array();
        }
    }

    function addCollection($id) {
        $data = array(
            'lcid' => $id,
            'titleLA' => $this->input->post('titleLA'),
            'title' => $this->input->post('title'),
            'subtitle' => $this->input->post('subtitle'),
            'edition' => $this->input->post('edition'),
            'lccn' => $this->input->post('lccn'),
            'isbn' => $this->input->post('isbn'),
            'issn' => $this->input->post('issn'),
            'materialType' => $this->input->post('materialType'),
            'subtype' => $this->input->post('subtype'),
            'authorName' => $this->input->post('authorName'),
            'date' => $this->input->post('authorDate'),
            'publicationPlace' => $this->input->post('publicationPlace'),
            'publisher' => $this->input->post('publisher'),
            'uniformTitleLA' => $this->input->post('uniformTitleLA'),
            'uniformTitle' => $this->input->post('uniformTitle'),
            'seriesUniformTitleLA' => $this->input->post('seriesUniformTitleLA'),
            'seriesUniformTitle' => $this->input->post('seriesUniformTitle'),
            'stock' => $this->input->post('availability'),
        );
        $this->db->insert($this->library_collection_table, $data);
    }

    function editCollection($id) {
        $data = array(
            'lcid' => $id,
            'titleLA' => $this->input->post('titleLA'),
            'title' => $this->input->post('title'),
            'subtitle' => $this->input->post('subtitle'),
            'edition' => $this->input->post('edition'),
            'lccn' => $this->input->post('lccn'),
            'isbn' => $this->input->post('isbn'),
            'issn' => $this->input->post('issn'),
            'materialType' => $this->input->post('materialType'),
            'subtype' => $this->input->post('subtype'),
            'authorName' => $this->input->post('authorName'),
            'date' => $this->input->post('authorDate'),
            'publicationPlace' => $this->input->post('publicationPlace'),
            'publisher' => $this->input->post('publisher'),
            'uniformTitleLA' => $this->input->post('uniformTitleLA'),
            'uniformTitle' => $this->input->post('uniformTitle'),
            'seriesUniformTitleLA' => $this->input->post('seriesUniformTitleLA'),
            'seriesUniformTitle' => $this->input->post('seriesUniformTitle'),
            'stock' => $this->input->post('availability'),
        );
        $this->db->where('lcid', $id);
        $this->db->update($this->library_collection_table, $data);
    }

    function setCollectionStock($id, $stock) {
        $data = array(
           'stock' => $stock
        );
        $this->db->where('lcid', $id);
        $this->db->update($this->library_collection_table, $data);
    }

    function deleteCollection($id) {
        $this->db->where('lcid', $id);
        $this->db->delete($this->library_collection_table);
        if ($this->db->affected_rows() != 0) {
            return TRUE;
        }
        return FALSE;
    }

    function getCollectionSubjectLatestID()
    {
        $this->db->select('lcsid');
        $this->db->order_by("lcsid", "desc");
        $this->db->limit(1);
        $query = $this->db->get($this->library_collection_subjects_table, 1);

        if ($query->num_rows() == 1) {
            return $query->row_array();
        }
    }

    function addCollectionSubject($id, $cid, $subject) {
        $data = array(
            'lcsid' => $id,
            'lcid' => $cid,
            'subject' => $subject
        );
        $this->db->insert($this->library_collection_subjects_table, $data);
    }

    function editCollectionSubject($id, $subject) {
        $data = array(
            'subject' => $subject
        );
        $this->db->where('lcsid', $id);
        $this->db->update($this->library_collection_subjects_table, $data);
    }

    function deleteCollectionSubjectBySubjectID($id) {
        $this->db->where('lcsid', $id);
        $this->db->delete($this->library_collection_subjects_table);
        if ($this->db->affected_rows() != 0) {
            return TRUE;
        }
        return FALSE;
    }

    function addCollectionAuthor($id, $lcid) {
        $data = array(
            'lcaid' => $id,
            'lcid' => $lcid,
            'name' => $this->input->post('newCoAuthorName'),
            'date' => $this->input->post('newCoAuthorDate'),
            'role' => $this->input->post('newCoAuthorRole')
        );
        $this->db->insert($this->library_collection_authors_table, $data);
    }

    function editCollectionAuthor($id) {
        $data = array(
            'name' => $this->input->post('editCoAuthorName'),
            'date' => $this->input->post('editCoAuthorDate'),
            'role' => $this->input->post('editCoAuthorRole')
        );
        $this->db->where('lcaid', $id);
        $this->db->update($this->library_collection_authors_table, $data);
    }


    function getCollectionAuthorLatestID()
    {
        $this->db->select('lcaid');
        $this->db->order_by("lcaid", "desc");
        $this->db->limit(1);
        $query = $this->db->get($this->library_collection_authors_table, 1);

        if ($query->num_rows() == 1) {
            return $query->row_array();
        }
    }

    function getCollectionAuthorByCollectionID($id){
        $sql = 'SELECT * FROM library_collection_authors WHERE lcid=\''.$id.'\'';

        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
    }

    function deleteCollectionAuthorByCollectionID($id) {
        $this->db->where('lcid', $id);
        $this->db->delete($this->library_collection_authors_table);
        if ($this->db->affected_rows() != 0) {
            return TRUE;
        }
        return FALSE;
    }

    function deleteCollectionAuthorByCollectionAuthorID($id) {
        $this->db->where('lcaid', $id);
        $this->db->delete($this->library_collection_authors_table);
        if ($this->db->affected_rows() != 0) {
            return TRUE;
        }
        return FALSE;
    }

    function getCollectionSubjectByCollectionID($lcid) {
        $sql = 'SELECT * FROM library_collection_subjects WHERE lcid=\''.$lcid.'\'';

        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
    }



    function getTotalServices(){
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

    function getServiceDataByID($id) {
        $this->db->select('*');
        $this->db->where('serviceid', $id);
        $this->db->limit(1);
        $query = $this->db->get($this->library_service_table, 1);

        if ($query->num_rows() == 1) {
            return $query->row_array();
        }
    }

    function editService($id) {
        $data = array(
            'title' => $this->input->post('title'),
            'content' => $this->input->post('content'),
        );
        $this->db->where('serviceid', $id);
        $this->db->update($this->library_service_table, $data);
    }

    function getBorrowedCollection() {
        $sql = 'SELECT * FROM library_borrowed';

        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
    }

    function getBorrowedCollectionDataByID($id){
        $this->db->select('*');
        $this->db->where('lbid',$id);


        $query = $this->db->get($this->library_borrowed_collection_table, 1);

        if ($query->num_rows() == 1) {
            return $query->row_array();
        }
    }

    function getTotalBorrowedCollection() {
        $sql = 'SELECT lbid, lcid, count(library_borrowed.lbid) as totalBorrowed FROM library_borrowed WHERE library_borrowed.status=\'Borrowed\'';

        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
    }

    function getBorrowedCollectionDataByCollectionID($id)
    {
        $sql = 'SELECT * FROM library_borrowed WHERE status=\'Borrowed\' AND lcid=\''.$id.'\'';

        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
    }

    function getBorrowingSetting() {
        $sql = 'SELECT * FROM library_borrowing_setting';

        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
    }

    function getBorrowingSettingByID($id) {
        $this->db->select('*');
        $this->db->where('borrowCategory', $id);
        $this->db->limit(1);
        $query = $this->db->get($this->library_borrowing_setting, 1);

        if ($query->num_rows() == 1) {
            return $query->row_array();
        }
    }

    function getBorrowedLatestID()
    {
        $this->db->select('lbid');
        $this->db->order_by("lbid", "desc");
        $this->db->limit(1);
        $query = $this->db->get($this->library_borrowed_collection_table, 1);

        if ($query->num_rows() == 1) {
            return $query->row_array();
        }
    }

    function addBorrowedCollection($id) {
        $data = array(
            'lbid' => $id,
            'lcid' => $this->input->post('collid'),
            'userid' => $this->input->post('userid'),
            'firstname' => $this->input->post('firstname'),
            'lastname' => $this->input->post('lastname'),
            'usertype' => $this->input->post('usertype'),
            'borrowCategory' => $this->input->post('borrowSetting'),
            'status' => 'Borrowed'
        );
        $this->db->insert($this->library_borrowed_collection_table, $data);
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

    function getAllNews(){
        $this->db->select('*');

        $query = $this->db->get($this->library_news_table);

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
    }

    function editNews($id) {
        $data = array(
            'title' => $this->input->post('title'),
            'content' => $this->input->post('content'),
        );
        $this->db->where('newsid', $id);
        $this->db->update($this->library_news_table, $data);
    }

    function deleteNews($id) {
        $this->db->where('newsid', $id);
        $this->db->delete($this->library_news_table);
        if ($this->db->affected_rows() != 0) {
            return TRUE;
        }
        return FALSE;
    }




    function getUsefulLinkCategory(){
//        $sql = 'SELECT * FROM library_useful_link ORDER BY category ASC';
//
//        $query = $this->db->query($sql);
//        if ($query->num_rows() > 0) {
//            return $query->result_array();
//        }

        $this->db->select('*');
        $this->db->order_by('category', 'ASC');

        $query = $this->db->get($this->library_useful_link_table);

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
    }

    function getUsefulLinkCategoryLatestID()
    {
        $this->db->select('category');
        $this->db->order_by("category", "desc");
        $this->db->limit(1);
        $query = $this->db->get($this->library_useful_link_table, 1);

        if ($query->num_rows() == 1) {
            return $query->row_array();
        }
    }

    function addUsefulLinkCategory($id) {
        $data = array(
            'category' => $id,
            'name' => $this->input->POST('category')
        );
        $this->db->insert($this->library_useful_link_table, $data);
    }

    function editUsefulLinkCategory($id) {
        $data = array(
            'name' => $this->input->POST('category')
        );

        $this->db->where('category', $id);
        $this->db->update($this->library_useful_link_table, $data);
    }

    function deleteUsefulLinkCategory($id) {
        $this->db->where('category', $id);
        $this->db->delete($this->library_useful_link_table);
        if ($this->db->affected_rows() != 0) {
            return TRUE;
        }
        return FALSE;
    }

    function getAllUsefulLinkContent(){
        $sql = 'SELECT library_useful_link.name, library_useful_link_content.* FROM library_useful_link_content, library_useful_link WHERE library_useful_link.category=library_useful_link_content.category ORDER BY library_useful_link.category ASC';

        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }

    }

    function getUsefulLinkContentByID($id) {
        $this->db->select('*');
        $this->db->where('category', $id);
        $this->db->order_by('category', 'ASC');

        $query = $this->db->get($this->library_useful_link_content_table);

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
    }

    function getUsefulLinkContentLatestID()
    {
        $this->db->select('linkid');
        $this->db->order_by("linkid", "desc");
        $this->db->limit(1);
        $query = $this->db->get($this->library_useful_link_content_table, 1);

        if ($query->num_rows() == 1) {
            return $query->row_array();
        }
    }

    function addUsefulLinkContent($id, $cat) {
        $data = array(
            'category' => $cat,
            'name' => $this->input->POST('title'),
            'link' => $this->input->POST('link'),
            'linkid' => $id
        );
        $this->db->insert($this->library_useful_link_content_table, $data);
    }

    function editUsefulLinkContent($id) {
        $data = array(
            'name' => $this->input->POST('title'),
            'link' => $this->input->POST('link')
        );

        $this->db->where('linkid', $id);
        $this->db->update($this->library_useful_link_content_table, $data);
    }

    function deleteUsefulLinkContent($id) {
        $this->db->where('linkid', $id);
        $this->db->delete($this->library_useful_link_content_table);
        if ($this->db->affected_rows() != 0) {
            return TRUE;
        }
        return FALSE;
    }



}

?>
