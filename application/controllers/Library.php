<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Library extends CI_Controller
{

    var $template = 'template_library';
    var $profileadminphotopath = 'assets/img/admin/';
    var $profilelibrarianphotopath = 'assets/img/library/profile/';
    var $libraryslidepath = 'assets/img/library/slide/';


    function __construct()
    {
        parent::__construct();
        $this->load->model('Teacher_model');
        $this->load->model('Student_model');
        $this->load->model('Admin_model');
        $this->load->model('Library_model');
    }

    public function login()
    {
        $this->form_validation->set_rules('loginas', 'loginas', 'required');
        $this->form_validation->set_rules('username', 'username', 'required|alpha_numeric');
        $this->form_validation->set_rules('password', 'password', 'required');
        $this->form_validation->set_error_delimiters('', '<br/>');

        if ($this->form_validation->run() == TRUE) {
            $loginas = $this->input->post('loginas');
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            if ($loginas == 'student') {
                $user = $this->Student_model->checkLogin($username, $password);
                if (!empty($user)) {
                    $this->nativesession->set('libid', $user['studentid']);
                    $this->nativesession->set('libname', $user['firstname'] . ' ' . $user['lastname']);
                    $this->nativesession->set('libclassid', $user['classid']);
                    $this->nativesession->set('is_login_library', 'TRUE');
                    $this->nativesession->set('loginas', 'student');
                    redirect('library/home');
                }
            } else if ($loginas == 'teacher') {
                $user = $this->Teacher_model->checkLogin($username, $password);
                if (!empty($user)) {
                    $this->nativesession->set('libid', $user['teacherid']);
                    $this->nativesession->set('libname', $user['firstname'] . ' ' . $user['lastname']);
                    $this->nativesession->set('libphoto', $user['photo']);
                    $this->nativesession->set('librole', $user['role']);
                    $this->nativesession->set('lastlogin', $user['lastlogin']);
                    $this->nativesession->set('is_login_library', 'TRUE');
                    $this->nativesession->set('loginas', 'teacher');;
                    redirect('library/home');
                }
            } else if ($loginas == 'librarian') {
                $user = $this->Library_model->checkLogin($username, $password);
                if (!empty($user)) {
                    $this->nativesession->set('libid', $user['librarianid']);
                    $this->nativesession->set('libname', $user['firstname'] . ' ' . $user['lastname']);
                    $this->nativesession->set('libphoto', $user['photo']);
                    $this->nativesession->set('librole', $user['role']);
                    $this->nativesession->set('lastlogin', $user['lastlogin']);
                    $this->nativesession->set('is_login_library', 'TRUE');
                    $this->nativesession->set('loginas', 'librarian');;
                    redirect('library/home');
                }
            } else if ($loginas == 'admin') {
                $user = $this->Admin_model->checkLogin($username, $password);
                if (!empty($user)) {
                    $this->nativesession->set('libid', $user['adminid']);
                    $this->nativesession->set('libname', $user['firstname'] . ' ' . $user['lastname']);
                    $this->nativesession->set('librole', $user['role']);
                    $this->nativesession->set('lastlogin', $user['lastlogin']);
                    $this->nativesession->set('is_login_library', 'TRUE');
                    $this->nativesession->set('loginas', 'admin');;
                    redirect('library/home');
                }
            } else {
                $this->nativesession->set('is_login_library', 'FALSE');
            }

            $this->nativesession->set('error', 'Login Failed!, username and password combination are wrong');
            redirect(current_url());
        }

        $data['title'] = 'SMS';
        $data['content'] = 'library/library_login_view';
        $this->load->view($this->template, $data);
    }

    public function home()
    {
        if ($this->nativesession->get('is_login_library')) {
            if ($this->nativesession->get('loginas') == 'student') {
                $data['user'] = $this->Student_model->getProfileDataByID($this->nativesession->get('libid'));
            } else if ($this->nativesession->get('loginas') == 'teacher') {
                $data['user'] = $this->Teacher_model->getClassByTeacherID($this->nativesession->get('libid'));
            } else if ($this->nativesession->get('loginas') == 'operation') {

            } else if ($this->nativesession->get('loginas') == 'admin') {
                $data['user'] = $this->Admin_model->getProfileDataByID($this->nativesession->get('libid'));
            } else if ($this->nativesession->get('loginas') == 'librarian') {
                $data['user'] = $this->Library_model->getProfileDataByID($this->nativesession->get('libid'));
            }
        } else {

        }
        $data['title'] = 'Library LMS';
        $data['services'] = $this->Library_model->getTotalServices();
        $data['news'] = $this->Library_model->getRecentNews();
        $data['useful_link_categories'] = $this->Library_model->getUsefulLinkCategory();
        $data['useful_links'] = $this->Library_model->getAllUsefulLinkContent();
        $data['topnavigation'] = 'library/library_topnavigation';
        $data['content'] = 'library/library_home_view';
        $this->load->view($this->template, $data);
    }

    public function collection()
    {
        if ($this->nativesession->get('is_login_library')) {
            if ($this->nativesession->get('loginas') == 'student') {
                $data['user'] = $this->Student_model->getProfileDataByID($this->nativesession->get('libid'));
            } else if ($this->nativesession->get('loginas') == 'teacher') {
                   $data['user'] = $this->Teacher_model->getClassByTeacherID($this->nativesession->get('libid'));
            } else if ($this->nativesession->get('loginas') == 'operation') {

            } else if ($this->nativesession->get('loginas') == 'admin') {
                $data['user'] = $this->Admin_model->getProfileDataByID($this->nativesession->get('libid'));
            } else if ($this->nativesession->get('loginas') == 'librarian') {
                $data['user'] = $this->Library_model->getProfileDataByID($this->nativesession->get('libid'));
            }
        } else {

        }

        $data['title'] = 'Library LMS';
        $data['topnavigation'] = 'library/library_topnavigation';
        $data['top2navigation'] = 'library/library_top2navigation';

        $data['content'] = 'library/library_collection_view';
        $this->load->view($this->template, $data);
    }

    public function about()
    {
        if ($this->nativesession->get('is_login_library')) {
            if ($this->nativesession->get('loginas') == 'student') {
                $data['user'] = $this->Student_model->getProfileDataByID($this->nativesession->get('libid'));
            } else if ($this->nativesession->get('loginas') == 'teacher') {
                $data['user'] = $this->Teacher_model->getClassByTeacherID($this->nativesession->get('libid'));
            } else if ($this->nativesession->get('loginas') == 'operation') {

            } else if ($this->nativesession->get('loginas') == 'admin') {
                $data['user'] = $this->Admin_model->getProfileDataByID($this->nativesession->get('libid'));
            } else if ($this->nativesession->get('loginas') == 'librarian') {
                $data['user'] = $this->Library_model->getProfileDataByID($this->nativesession->get('libid'));
            }
        } else {

        }

        $data['title'] = 'Library LMS';
        $data['about'] = $this->Library_model->getServiceByID('p0007');
        $data['topnavigation'] = 'library/library_topnavigation';
        $data['content'] = 'library/library_about_view';
        $this->load->view($this->template, $data);
    }

    public function contact()
    {
        if ($this->nativesession->get('is_login_library')) {
            if ($this->nativesession->get('loginas') == 'student') {
                $data['user'] = $this->Student_model->getProfileDataByID($this->nativesession->get('libid'));
            } else if ($this->nativesession->get('loginas') == 'teacher') {
                $data['user'] = $this->Teacher_model->getClassByTeacherID($this->nativesession->get('libid'));
            } else if ($this->nativesession->get('loginas') == 'operation') {

            } else if ($this->nativesession->get('loginas') == 'admin') {
                $data['user'] = $this->Admin_model->getProfileDataByID($this->nativesession->get('libid'));
            } else if ($this->nativesession->get('loginas') == 'librarian') {
                $data['user'] = $this->Library_model->getProfileDataByID($this->nativesession->get('libid'));
            }
        } else {

        }
        $data['title'] = 'Library LMS';
        $data['contact'] = $this->Library_model->getServiceByID('p0008');
        $data['topnavigation'] = 'library/library_topnavigation';
        $data['content'] = 'library/library_contact_view';
        $this->load->view($this->template, $data);
    }

    public function borrowing_history()
    {
        if ($this->nativesession->get('is_login_library')) {
            if ($this->nativesession->get('loginas') == 'student') {
                $data['user'] = $this->Student_model->getProfileDataByID($this->nativesession->get('libid'));
            } else if ($this->nativesession->get('loginas') == 'teacher') {
                $data['user'] = $this->Teacher_model->getClassByTeacherID($this->nativesession->get('libid'));
            } else if ($this->nativesession->get('loginas') == 'operation') {

            } else if ($this->nativesession->get('loginas') == 'admin') {
                $data['user'] = $this->Admin_model->getProfileDataByID($this->nativesession->get('libid'));
            } else if ($this->nativesession->get('loginas') == 'librarian') {
                $data['user'] = $this->Library_model->getProfileDataByID($this->nativesession->get('libid'));
            }
        } else {
            redirect('library/home');
        }

        $data['borrowed'] = $this->Library_model->getBorrowedCollectionDataByUserID($this->nativesession->get('libid'));
        $data['collections'] = $this->Library_model->getCollections();

        $data['title'] = 'Library LMS';
        $data['topnavigation'] = 'library/library_topnavigation';
        $data['content'] = 'library/library_borrowing_history_view';
        $this->load->view($this->template, $data);
    }

    public function obligation()
    {
        if ($this->nativesession->get('is_login_library')) {
            if ($this->nativesession->get('loginas') == 'student') {
                $data['user'] = $this->Student_model->getProfileDataByID($this->nativesession->get('libid'));
            } else if ($this->nativesession->get('loginas') == 'teacher') {
                $data['user'] = $this->Teacher_model->getClassByTeacherID($this->nativesession->get('libid'));
            } else if ($this->nativesession->get('loginas') == 'operation') {

            } else if ($this->nativesession->get('loginas') == 'admin') {
                $data['user'] = $this->Admin_model->getProfileDataByID($this->nativesession->get('libid'));
            } else if ($this->nativesession->get('loginas') == 'librarian') {
                $data['user'] = $this->Library_model->getProfileDataByID($this->nativesession->get('libid'));
            }
        } else {

        }

        $data['collections'] = $this->Library_model->getCollections();
        $data['borrowSetting'] =  $this->Library_model->getBorrowingSetting();
        $data['borrowed'] = $this->Library_model->getBorrowedCollectionDataByUserID($this->nativesession->get('libid'));
        $data['fines'] = $this->Library_model->getFineSetting();

        $data['title'] = 'Library LMS';
        $data['topnavigation'] = 'library/library_topnavigation';
        $data['content'] = 'library/library_obligation_view';
        $this->load->view($this->template, $data);
    }

    public function profile()
    {
        if ($this->nativesession->get('is_login_library')) {
            if ($this->nativesession->get('loginas') == 'student') {
                $data['user'] = $this->Student_model->getProfileDataByID($this->nativesession->get('libid'));
            } else if ($this->nativesession->get('loginas') == 'teacher') {
                $data['user'] = $this->Teacher_model->getClassByTeacherID($this->nativesession->get('libid'));
            } else if ($this->nativesession->get('loginas') == 'operation') {

            } else if ($this->nativesession->get('loginas') == 'admin') {
                $data['user'] = $this->Admin_model->getProfileDataByID($this->nativesession->get('libid'));
            } else if ($this->nativesession->get('loginas') == 'librarian') {
                $data['user'] = $this->Library_model->getProfileDataByID($this->nativesession->get('libid'));
            }
        } else {

        }

        $data['title'] = 'Library LMS';
        $data['topnavigation'] = 'library/library_topnavigation';
        $data['content'] = 'library/library_profile_view';
        $this->load->view($this->template, $data);
    }




    public function allCollection()
    {
        if ($this->nativesession->get('is_login_library')) {
            if ($this->nativesession->get('loginas') == 'student') {
                $data['user'] = $this->Student_model->getProfileDataByID($this->nativesession->get('libid'));
            } else if ($this->nativesession->get('loginas') == 'teacher') {
                $data['user'] = $this->Teacher_model->getClassByTeacherID($this->nativesession->get('libid'));
            } else if ($this->nativesession->get('loginas') == 'operation') {

            } else if ($this->nativesession->get('loginas') == 'admin') {
                $data['user'] = $this->Admin_model->getProfileDataByID($this->nativesession->get('libid'));
            } else if ($this->nativesession->get('loginas') == 'librarian') {
                $data['user'] = $this->Library_model->getProfileDataByID($this->nativesession->get('libid'));
            }
        } else {

        }

        $data['title'] = 'Library LMS';
        $data['topnavigation'] = 'library/library_topnavigation';
        $data['top2navigation'] = 'library/library_top2navigation';

        $data['totalborrowed'] = $this->Library_model->getTotalBorrowedCollection();
        $data['collections'] = $this->Library_model->getCollections();
        $data['content'] = 'library/library_all_collection_view';
        $this->load->view($this->template, $data);
    }

    public function addCollection()
    {
        if ($this->nativesession->get('is_login_library')) {
            if ($this->nativesession->get('loginas') == 'admin') {
                $data['user'] = $this->Admin_model->getProfileDataByID($this->nativesession->get('libid'));
            } else if ($this->nativesession->get('loginas') == 'librarian') {
                $data['user'] = $this->Library_model->getProfileDataByID($this->nativesession->get('libid'));
            } else {
                $this->nativesession->set('error', 'Access Denied');
                redirect('library/home');
            }
        } else {
            redirect('library/allCollection');
        }


        $this->form_validation->set_rules('titleLA', 'Title Leading Article', 'required');
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('subtitle', 'Subtitle', 'required');
        $this->form_validation->set_rules('edition', 'Edition', 'required');
        $this->form_validation->set_rules('lccn', 'LCCN', 'required');
        $this->form_validation->set_rules('isbn', 'ISBN', 'required');
        $this->form_validation->set_rules('issn', 'ISSN', 'required');
        $this->form_validation->set_rules('materialType', 'Material Type', 'required');
        $this->form_validation->set_rules('subtype', 'Subtype', 'required');
        $this->form_validation->set_rules('authorName', 'Author Name', 'required');
        $this->form_validation->set_rules('authorDate', 'Author Date', 'required');
        $this->form_validation->set_rules('uniformTitleLA', 'Uniform Title Leading Article', 'required');
        $this->form_validation->set_rules('uniformTitle', 'Uniform Title', 'required');
        $this->form_validation->set_rules('varyingForm', 'Varying Form', 'required');
        $this->form_validation->set_rules('seriesUniformTitleLA', 'Series Uniform Title Leading Article', 'required');
        $this->form_validation->set_rules('seriesUniformTitle', 'Series Uniform Title', 'required');
        $this->form_validation->set_rules('publicationPlace', 'Publication Place', 'required');
        $this->form_validation->set_rules('publisher', 'Publisher', 'required');
        $this->form_validation->set_rules('availability', 'Availability', 'required');

        $this->form_validation->set_error_delimiters('', '<br/>');
        if ($this->form_validation->run() == TRUE) {
            $lastestid = $this->Library_model->getCollectionLatestID();
            if ($lastestid) {
                foreach ($lastestid as $lastid) {
                    $value = $value = substr($lastid, 1) + 1;
                }
                echo $value;

                if ($value < 10) {
                    $newid = 'c00000' . $value;
                } else if ($value >= 10 and $value < 100) {
                    $newid = 'c0000' . $value;
                } else if ($value >= 100 and $value < 1000) {
                    $newid = 'c000' . $value;
                } else if ($value >= 1000 and $value < 10000) {
                    $newid = 'c00' . $value;
                } else if ($value >= 10000 and $value < 100000) {
                    $newid = 'c0' . $value;
                } else if ($value >= 100000 and $value < 1000000) {
                    $newid = 'c' . $value;
                }
                echo $newid;
            } else {
                $newid = 'c000001';
            }

            $this->Library_model->addCollection($newid);

            /*$subjects = $this->input->POST('subject');
            for($i=0;$i<sizeof($subjects);$i++)
            {
                $latestSID =  $this->Library_model->getCollectionSubjectLatestID();
                if($latestSID) {
                    foreach ($latestSID as $lastSID) {
                        $value = $value = substr($lastSID, 1) + 1;
                    }

                    if ($value < 10) {
                        $lastSubID = 's00000' . $value;
                    } else if ($value >= 10 and $value < 100) {
                        $lastSubID = 's0000' . $value;
                    } else if ($value >= 100 and $value < 1000) {
                        $lastSubID = 's000' . $value;
                    } else if ($value >= 1000 and $value < 10000) {
                        $lastSubID = 's00' . $value;
                    } else if ($value >= 10000 and $value < 100000) {
                        $lastSubID = 's0' . $value;
                    } else if ($value >= 100000 and $value < 1000000) {
                        $lastSubID = 's' . $value;
                    }
                } else {
                    $lastSubID = 's000001';
                }

                if($subjects[$i] != null){
                    $this->Library_model->addCollectionSubject($lastSubID, $newid, $subjects[$i]);
                }
            }

            $coauthors = $this->input->post('coAuthorName');
            $coauthorsDate = $this->input->post('coAuthorDate');
            $coauthorsRole = $this->input->post('coAuthorRole');
            for($i=0;$i<sizeof($coauthors);$i++)
            {
                $latestCID =  $this->Library_model->getCollectionAuthorLatestID();
                if($latestCID) {
                    foreach ($latestCID as $lastCID) {
                        $lastCoID = 'c'.str_pad((int) $lastCID+1, 6, "0", STR_PAD_LEFT);
                    }
                } else {
                    $lastCoID = 'c000001';
                }

                if($coauthors[$i] != null){
                    $this->Library_model->addCollectionAuthor($lastCoID, $newid, $coauthors[$i], $coauthorsDate[$i], $coauthorsRole[$i]);
                }
            }*/

            $this->nativesession->set('success', 'Collection saved');
            redirect('library/allCollection');
        }


        $data['title'] = 'Library LMS';
        $data['topnavigation'] = 'library/library_topnavigation';
        $data['top2navigation'] = 'library/library_top2navigation';

        $data['content'] = 'library/library_add_collection_view';
        $this->load->view($this->template, $data);
    }

    public function editCollection($colid)
    {
        if ($this->nativesession->get('is_login_library')) {
            if ($this->nativesession->get('loginas') == 'admin') {
                $data['user'] = $this->Admin_model->getProfileDataByID($this->nativesession->get('libid'));
            } else if ($this->nativesession->get('loginas') == 'librarian') {
                $data['user'] = $this->Library_model->getProfileDataByID($this->nativesession->get('libid'));
            } else {
                $this->nativesession->set('error', 'Access Denied');
                redirect('library/home');
            }
        } else {
            redirect('library/home');
        }

        $lcid = $this->general->decryptParaID($colid, 'collection');

        $this->form_validation->set_rules('titleLA', 'Title Leading Article', 'required');
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('subtitle', 'Subtitle', 'required');
        $this->form_validation->set_rules('edition', 'Edition', 'required');
        $this->form_validation->set_rules('lccn', 'LCCN', 'required');
        $this->form_validation->set_rules('isbn', 'ISBN', 'required');
        $this->form_validation->set_rules('issn', 'ISSN', 'required');
        $this->form_validation->set_rules('materialType', 'Material Type', 'required');
        $this->form_validation->set_rules('subtype', 'Subtype', 'required');
        $this->form_validation->set_rules('authorName', 'Author Name', 'required');
        $this->form_validation->set_rules('authorDate', 'Author Date', 'required');
        $this->form_validation->set_rules('uniformTitleLA', 'Uniform Title Leading Article', 'required');
        $this->form_validation->set_rules('uniformTitle', 'Uniform Title', 'required');
        $this->form_validation->set_rules('varyingForm', 'Varying Form', 'required');
        $this->form_validation->set_rules('seriesUniformTitleLA', 'Series Uniform Title Leading Article', 'required');
        $this->form_validation->set_rules('seriesUniformTitle', 'Series Uniform Title', 'required');
        $this->form_validation->set_rules('publicationPlace', 'Publication Place', 'required');
        $this->form_validation->set_rules('publisher', 'Publisher', 'required');
        $this->form_validation->set_rules('availability', 'Availability', 'required');

        $this->form_validation->set_error_delimiters('', '<br/>');
        if ($this->form_validation->run() == TRUE) {
            $this->Library_model->editCollection($lcid);

            $this->nativesession->set('success', 'Collection saved');
            redirect('library/editCollection/' . $colid);
        }


        $data['title'] = 'Library LMS';
        $data['topnavigation'] = 'library/library_topnavigation';
        $data['top2navigation'] = 'library/library_top2navigation';

        $data['collection'] = $this->Library_model->getCollectionDataByID($lcid);
        $data['content'] = 'library/library_edit_collection_view';
        $this->load->view($this->template, $data);
    }

    public function deleteCollection($lcid)
    {
        if ($this->general->checkPrivilege($this->nativesession->get('librole'), 'p0036') != 1) {
            $this->nativesession->set('error', 'Access Denied');
            redirect('library/home');
        }
        $id = $this->general->decryptParaID($lcid, 'collection');
        if ($this->Library_model->deleteCollection($id)) {
            $this->nativesession->set('success', 'Collection Deleted');
        } else {
            $this->nativesession->set('error', 'Failed to Delete Collection');
        }
        redirect('library/allCollection');
    }


    public function addCollectionAuthor($colid){
        if ($this->nativesession->get('is_login_library')) {
            if ($this->nativesession->get('loginas') == 'admin') {
                $data['user'] = $this->Admin_model->getProfileDataByID($this->nativesession->get('libid'));
            } else if ($this->nativesession->get('loginas') == 'librarian') {
                $data['user'] = $this->Library_model->getProfileDataByID($this->nativesession->get('libid'));
            } else {
                $this->nativesession->set('error', 'Access Denied');
                redirect('library/home');
            }
        } else {
            redirect('library/home');
        }


        $this->form_validation->set_rules('newCoAuthorName', 'Name', 'required');
        $this->form_validation->set_rules('newCoAuthorDate', 'Date', 'required');
        $this->form_validation->set_rules('newCoAuthorRole', 'Role', 'required');

        $this->form_validation->set_error_delimiters('', '<br/>');

        if ($this->form_validation->run() == TRUE) {
            $lastestid = $this->Library_model->getCollectionAuthorLatestID();
            if ($lastestid) {
                foreach ($lastestid as $lastid) {
                    $value = $value = substr($lastid, 1) + 1;
                }

                if ($value < 10) {
                    $newid = 'a00000' . $value;
                } else if ($value >= 10 and $value < 100) {
                    $newid = 'a0000' . $value;
                } else if ($value >= 100 and $value < 1000) {
                    $newid = 'a000' . $value;
                } else if ($value >= 1000 and $value < 10000) {
                    $newid = 'a00' . $value;
                } else if ($value >= 10000 and $value < 100000) {
                    $newid = 'a0' . $value;
                } else if ($value >= 100000 and $value < 1000000) {
                    $newid = 'a' . $value;
                }
            } else {
                $newid = 'a000001';
            }

            $lcid = $this->general->decryptParaID($colid, 'collection');

            $this->Library_model->addCollectionAuthor($newid, $lcid);

            $this->nativesession->set('success', 'Collection subject saved');
            $encrypted = $this->general->encryptParaID($colid, 'collection');


            $data['title'] = 'Library LMS';
            $data['topnavigation'] = 'library/library_topnavigation';
            $data['top2navigation'] = 'library/library_top2navigation';

            $data['collection'] = $this->Library_model->getCollectionDataByID($lcid);
            $data['collectionAuthors'] = $this->Library_model->getCollectionAuthorByCollectionID($lcid);
            $data['content'] = 'library/library_edit_collection_author_view';
            $this->load->view($this->template, $data);

        }
        else {
            $this->nativesession->set('error', 'All field are required');
            redirect('library/collectionAuthor/' . $colid);
        }
    }

    public function collectionAuthor($colid)
    {
        if ($this->nativesession->get('is_login_library')) {
            if ($this->nativesession->get('loginas') == 'admin') {
                $data['user'] = $this->Admin_model->getProfileDataByID($this->nativesession->get('libid'));
            } else if ($this->nativesession->get('loginas') == 'librarian') {
                $data['user'] = $this->Library_model->getProfileDataByID($this->nativesession->get('libid'));
            } else {
                $this->nativesession->set('error', 'Access Denied');
                redirect('library/home');
            }
        } else {
            redirect('library/home');
        }


        $lcid = $this->general->decryptParaID($colid, 'collection');


        $data['title'] = 'Library LMS';
        $data['topnavigation'] = 'library/library_topnavigation';
        $data['top2navigation'] = 'library/library_top2navigation';

        $data['collection'] = $this->Library_model->getCollectionDataByID($lcid);
        $data['collectionAuthors'] = $this->Library_model->getCollectionAuthorByCollectionID($lcid);
        $data['content'] = 'library/library_edit_collection_author_view';
        $this->load->view($this->template, $data);
    }

    public function editCollectionAuthor($colaid, $colid) {
        if ($this->nativesession->get('is_login_library')) {
            if ($this->nativesession->get('loginas') == 'admin') {
                $data['user'] = $this->Admin_model->getProfileDataByID($this->nativesession->get('libid'));
            } else if ($this->nativesession->get('loginas') == 'librarian') {
                $data['user'] = $this->Library_model->getProfileDataByID($this->nativesession->get('libid'));
            } else {
                $this->nativesession->set('error', 'Access Denied');
                redirect('library/home');
            }
        } else {
            redirect('library/home');
        }


        $this->form_validation->set_rules('editCoAuthorName', 'Name', 'required');
        $this->form_validation->set_rules('editCoAuthorDate', 'Date', 'required');
        $this->form_validation->set_rules('editCoAuthorRole', 'Role', 'required');

        $this->form_validation->set_error_delimiters('', '<br/>');
        if ($this->form_validation->run() == TRUE) {

            $lcaid = $this->general->decryptParaID($colaid, 'collectionauthor');

            $this->Library_model->editCollectionAuthor($lcaid);

            $this->nativesession->set('success', 'Collection author saved');
            redirect('library/collectionAuthor/' . $colid);
        } else {
            $this->nativesession->set('error', 'All field are required');
            redirect('library/collectionAuthor/' . $colid);
        }
    }

    public function deleteCollectionAuthor($lcaid, $lcid)
    {
        if ($this->general->checkPrivilege($this->nativesession->get('librole'), 'p0040') != 1) {
            $this->nativesession->set('error', 'Access Denied');
            redirect('library/home');
        }
        $id = $this->general->decryptParaID($lcaid, 'collectionauthor');
        if ($this->Library_model->deleteCollectionAuthorByCollectionAuthorID($id)) {
            $this->nativesession->set('success', 'Author Deleted');
        } else {
            $this->nativesession->set('error', 'Failed to Delete Author');
        }
        redirect('library/collectionAuthor/' . $lcid);
    }

    public function addCollectionSubject($colid)
    {
        if ($this->nativesession->get('is_login_library')) {
            if ($this->nativesession->get('loginas') == 'admin') {
                $data['user'] = $this->Admin_model->getProfileDataByID($this->nativesession->get('libid'));
            } else if ($this->nativesession->get('loginas') == 'librarian') {
                $data['user'] = $this->Library_model->getProfileDataByID($this->nativesession->get('libid'));
            } else {
                $this->nativesession->set('error', 'Access Denied');
                redirect('library/home');
            }
        } else {
            redirect('library/home');
        }


        $this->form_validation->set_rules('newsubject', 'Subject', 'required');

        $this->form_validation->set_error_delimiters('', '<br/>');
        if ($this->form_validation->run() == TRUE) {
            $lastestid = $this->Library_model->getCollectionSubjectLatestID();
            if ($lastestid) {
                foreach ($lastestid as $lastid) {
                    $value = $value = substr($lastid, 1) + 1;
                }

                if ($value < 10) {
                    $newid = 's00000' . $value;
                } else if ($value >= 10 and $value < 100) {
                    $newid = 's0000' . $value;
                } else if ($value >= 100 and $value < 1000) {
                    $newid = 's000' . $value;
                } else if ($value >= 1000 and $value < 10000) {
                    $newid = 's00' . $value;
                } else if ($value >= 10000 and $value < 100000) {
                    $newid = 's0' . $value;
                } else if ($value >= 100000 and $value < 1000000) {
                    $newid = 's' . $value;
                }
            } else {
                $newid = 's000001';
            }

            $lcid = $this->general->decryptParaID($colid, 'collection');
            $subject = $this->input->post('newsubject');

            $this->Library_model->addCollectionSubject($newid, $lcid, $subject);

            $this->nativesession->set('success', 'Collection subject saved');
            $encrypted = $this->general->encryptParaID($colid, 'collection');


            $data['title'] = 'Library LMS';
            $data['topnavigation'] = 'library/library_topnavigation';
            $data['top2navigation'] = 'library/library_top2navigation';

            $data['collection'] = $this->Library_model->getCollectionDataByID($lcid);
            $data['collectionSubjects'] = $this->Library_model->getCollectionSubjectByCollectionID($lcid);
            $data['content'] = 'library/library_edit_collection_subject_view';
            $this->load->view($this->template, $data);
        }
        else {
            $this->nativesession->set('error', 'All field are required');
            redirect('library/collectionSubject/' . $colid);
        }
    }

    public function collectionSubject($colid){
        if ($this->nativesession->get('is_login_library')) {
            if ($this->nativesession->get('loginas') == 'admin') {
                $data['user'] = $this->Admin_model->getProfileDataByID($this->nativesession->get('libid'));
            } else if ($this->nativesession->get('loginas') == 'librarian') {
                $data['user'] = $this->Library_model->getProfileDataByID($this->nativesession->get('libid'));
            } else {
                $this->nativesession->set('error', 'Access Denied');
                redirect('library/home');
            }
        } else {
            redirect('library/home');
        }
        $lcid = $this->general->decryptParaID($colid, 'collection');
        $data['title'] = 'Library LMS';
        $data['topnavigation'] = 'library/library_topnavigation';
        $data['top2navigation'] = 'library/library_top2navigation';

        $data['collection'] = $this->Library_model->getCollectionDataByID($lcid);
        $data['collectionSubjects'] = $this->Library_model->getCollectionSubjectByCollectionID($lcid);
        $data['content'] = 'library/library_edit_collection_subject_view';
        $this->load->view($this->template, $data);

    }

    public function editCollectionSubject($colsid, $colid) {
        if ($this->nativesession->get('is_login_library')) {
            if ($this->nativesession->get('loginas') == 'admin') {
                $data['user'] = $this->Admin_model->getProfileDataByID($this->nativesession->get('libid'));
            } else if ($this->nativesession->get('loginas') == 'librarian') {
                $data['user'] = $this->Library_model->getProfileDataByID($this->nativesession->get('libid'));
            } else {
                $this->nativesession->set('error', 'Access Denied');
                redirect('library/home');
            }
        } else {
            redirect('library/home');
        }


        $this->form_validation->set_rules('editSubject', 'Subject', 'required');

        $this->form_validation->set_error_delimiters('', '<br/>');
        if ($this->form_validation->run() == TRUE) {
            $lastestid = $this->Library_model->getCollectionSubjectLatestID();


            $lcsid = $this->general->decryptParaID($colsid, 'collectionsubject');
            $subject = $this->input->post('editSubject');

            $this->Library_model->editCollectionSubject($lcsid, $subject);

            $this->nativesession->set('success', 'Collection subject saved');
            $encrypted = $this->general->encryptParaID($colid, 'collection');
            redirect('library/collectionSubject/'.$colid);
        } else {
            $this->nativesession->set('error', 'All field are required');
            redirect('library/collectionSubject/' . $colid);
        }
    }

    public function deleteCollectionSubject($lcsid, $lcid) {
        if($this->general->checkPrivilege($this->nativesession->get('librole'), 'p0042') != 1){
            $this->nativesession->set('error', 'Access Denied');
            redirect('library/home');
        }
        $id = $this->general->decryptParaID($lcsid, 'collectionsubject');
        if($this->Library_model->deleteCollectionSubjectBySubjectID($id)){
            $this->nativesession->set('success', 'Subject Deleted');
        }
        else{
            $this->nativesession->set('error', 'Failed to Delete Subject');
        }
        redirect('library/collectionSubject/'.$lcid);
    }




    /* public function login()
     {
         $data['title'] = 'Library LMS';
         $data['content'] = 'library/library_login_view';
         $this->load->view($this->template, $data);
     }*/

    public function searchCollection()
    {
        if ($this->nativesession->get('is_login_library')){
            if($this->nativesession->get('loginas')=='student'){
                $data['user'] = $this->Student_model->getProfileDataByID($this->nativesession->get('libid'));
            }
            else  if($this->nativesession->get('loginas')=='teacher'){
                $data['user'] = $this->Teacher_model->getClassByTeacherID($this->nativesession->get('libid'));
            }
            else  if($this->nativesession->get('loginas')=='operation'){

            }
            else  if($this->nativesession->get('loginas')=='admin'){
                $data['user'] = $this->Admin_model->getProfileDataByID($this->nativesession->get('libid'));
            }
            else  if($this->nativesession->get('loginas')=='librarian'){
                $data['user'] = $this->Library_model->getProfileDataByID($this->nativesession->get('libid'));
            }
        } else {

        }

        $data['title'] = 'Library LMS';
        $data['service'] = $this->Library_model->getServiceByID('p0001');
        $data['topnavigation'] = 'library/library_topnavigation';
        $data['content'] = 'library/library_service_view';
        $this->load->view($this->template, $data);
    }

    public function circulation()
    {
        if ($this->nativesession->get('is_login_library')){
            if($this->nativesession->get('loginas')=='student'){
                $data['user'] = $this->Student_model->getProfileDataByID($this->nativesession->get('libid'));
            }
            else  if($this->nativesession->get('loginas')=='teacher'){
                $data['user'] = $this->Teacher_model->getClassByTeacherID($this->nativesession->get('libid'));
            }
            else  if($this->nativesession->get('loginas')=='operation'){

            }
            else  if($this->nativesession->get('loginas')=='admin'){
                $data['user'] = $this->Admin_model->getProfileDataByID($this->nativesession->get('libid'));
            }
            else  if($this->nativesession->get('loginas')=='librarian'){
                $data['user'] = $this->Library_model->getProfileDataByID($this->nativesession->get('libid'));
            }
        } else {

        }

        $data['title'] = 'Library LMS';
        $data['service'] = $this->Library_model->getServiceByID('p0002');
        $data['topnavigation'] = 'library/library_topnavigation';
        $data['content'] = 'library/library_service_view';
        $this->load->view($this->template, $data);
    }

    public function currentAwareness()
    {
        if ($this->nativesession->get('is_login_library')){
            if($this->nativesession->get('loginas')=='student'){
                $data['user'] = $this->Student_model->getProfileDataByID($this->nativesession->get('libid'));
            }
            else  if($this->nativesession->get('loginas')=='teacher'){
                $data['user'] = $this->Teacher_model->getClassByTeacherID($this->nativesession->get('libid'));
            }
            else  if($this->nativesession->get('loginas')=='operation'){

            }
            else  if($this->nativesession->get('loginas')=='admin'){
                $data['user'] = $this->Admin_model->getProfileDataByID($this->nativesession->get('libid'));
            }
            else  if($this->nativesession->get('loginas')=='librarian'){
                $data['user'] = $this->Library_model->getProfileDataByID($this->nativesession->get('libid'));
            }
        } else {

        }

        $data['title'] = 'Library LMS';
        $data['service'] = $this->Library_model->getServiceByID('p0003');
        $data['topnavigation'] = 'library/library_topnavigation';
        $data['content'] = 'library/library_service_view';
        $this->load->view($this->template, $data);
    }

    public function requestMaterials()
    {
        if ($this->nativesession->get('is_login_library')){
            if($this->nativesession->get('loginas')=='student'){
                $data['user'] = $this->Student_model->getProfileDataByID($this->nativesession->get('libid'));
            }
            else  if($this->nativesession->get('loginas')=='teacher'){
                $data['user'] = $this->Teacher_model->getClassByTeacherID($this->nativesession->get('libid'));
            }
            else  if($this->nativesession->get('loginas')=='operation'){

            }
            else  if($this->nativesession->get('loginas')=='admin'){
                $data['user'] = $this->Admin_model->getProfileDataByID($this->nativesession->get('libid'));
            }
            else  if($this->nativesession->get('loginas')=='librarian'){
                $data['user'] = $this->Library_model->getProfileDataByID($this->nativesession->get('libid'));
            }
        } else {

        }

        $data['title'] = 'Library LMS';
        $data['service'] = $this->Library_model->getServiceByID('p0004');
        $data['topnavigation'] = 'library/library_topnavigation';
        $data['content'] = 'library/library_service_view';
        $this->load->view($this->template, $data);
    }

    public function lostAndFound()
    {
        if ($this->nativesession->get('is_login_library')){
            if($this->nativesession->get('loginas')=='student'){
                $data['user'] = $this->Student_model->getProfileDataByID($this->nativesession->get('libid'));
            }
            else  if($this->nativesession->get('loginas')=='teacher'){
                $data['user'] = $this->Teacher_model->getClassByTeacherID($this->nativesession->get('libid'));
            }
            else  if($this->nativesession->get('loginas')=='operation'){

            }
            else  if($this->nativesession->get('loginas')=='admin'){
                $data['user'] = $this->Admin_model->getProfileDataByID($this->nativesession->get('libid'));
            }
            else  if($this->nativesession->get('loginas')=='librarian'){
                $data['user'] = $this->Library_model->getProfileDataByID($this->nativesession->get('libid'));
            }
        } else {

        }

        $data['title'] = 'Library LMS';
        $data['service'] = $this->Library_model->getServiceByID('p0005');
        $data['topnavigation'] = 'library/library_topnavigation';
        $data['content'] = 'library/library_service_view';
        $this->load->view($this->template, $data);
    }

    public function facilities()
    {
        if ($this->nativesession->get('is_login_library')){
            if($this->nativesession->get('loginas')=='student'){
                $data['user'] = $this->Student_model->getProfileDataByID($this->nativesession->get('libid'));
            }
            else  if($this->nativesession->get('loginas')=='teacher'){
                $data['user'] = $this->Teacher_model->getClassByTeacherID($this->nativesession->get('libid'));
            }
            else  if($this->nativesession->get('loginas')=='operation'){

            }
            else  if($this->nativesession->get('loginas')=='admin'){
                $data['user'] = $this->Admin_model->getProfileDataByID($this->nativesession->get('libid'));
            }
            else  if($this->nativesession->get('loginas')=='librarian'){
                $data['user'] = $this->Library_model->getProfileDataByID($this->nativesession->get('libid'));
            }
        } else {

        }

        $data['title'] = 'Library LMS';
        $data['service'] = $this->Library_model->getServiceByID('p0005');
        $data['topnavigation'] = 'library/library_topnavigation';
        $data['content'] = 'library/library_service_view';
        $this->load->view($this->template, $data);
    }

    public function library_profile()
    {
        if ($this->nativesession->get('is_login_library')){
            if($this->nativesession->get('loginas')=='student'){
                $data['user'] = $this->Student_model->getProfileDataByID($this->nativesession->get('libid'));
            }
            else  if($this->nativesession->get('loginas')=='teacher'){
                $data['user'] = $this->Teacher_model->getClassByTeacherID($this->nativesession->get('libid'));
            }
            else  if($this->nativesession->get('loginas')=='operation'){

            }
            else  if($this->nativesession->get('loginas')=='admin'){
                $data['user'] = $this->Admin_model->getProfileDataByID($this->nativesession->get('libid'));
            }
            else  if($this->nativesession->get('loginas')=='librarian'){
                $data['user'] = $this->Library_model->getProfileDataByID($this->nativesession->get('libid'));
            }
        } else {

        }

        $data['title'] = 'Library LMS';
        //$data['sidebar'] = 'library/library_sidebar';
        $data['topnavigation'] = 'library/library_topnavigation';
        $data['content'] = 'library/library_profile_view';
        $this->load->view($this->template, $data);
    }


    public function editService($id) {
        if ($this->nativesession->get('is_login_library')) {
            if ($this->nativesession->get('loginas') == 'admin') {
                $data['user'] = $this->Admin_model->getProfileDataByID($this->nativesession->get('libid'));
            } else if ($this->nativesession->get('loginas') == 'librarian') {
                $data['user'] = $this->Library_model->getProfileDataByID($this->nativesession->get('libid'));
            } else {
                $this->nativesession->set('error', 'Access Denied');
                redirect('library/home');
            }
        } else {
            redirect('library/home');
        }


        $this->form_validation->set_rules('content', 'Subject', 'required');
        $lsid = $this->general->decryptParaID($id, 'libservice');

        $this->form_validation->set_error_delimiters('', '<br/>');
        if ($this->form_validation->run() == TRUE) {

            $subject = $this->input->post('title');

            $this->Library_model->editService($lsid);

            if(strcmp($lsid,'p0007')==0) {
                $suc = "About";
            } else if(strcmp($lsid,'p0008')==0) {
                $suc = "Contact";
            } else {
                $suc = "Service";
            }
            $this->nativesession->set('success', $suc.' subject saved');

            redirect('library/editService/'.$id);
        }

        $data['title'] = 'Library LMS';
        $data['topnavigation'] = 'library/library_topnavigation';
        $data['top2navigation'] = 'library/library_top2navigation';

        $data['eserviceID'] = $id;
        $data['serviceID'] = $lsid;
        $data['service'] = $this->Library_model->getServiceDataByID($lsid);
        $data['content'] = 'library/library_service_edit_view';
        $this->load->view($this->template, $data);
    }


    public function allBorrowedCollection()
    {
        if ($this->nativesession->get('is_login_library')) {
            if ($this->nativesession->get('loginas') == 'student') {
                $data['user'] = $this->Student_model->getProfileDataByID($this->nativesession->get('libid'));
            } else if ($this->nativesession->get('loginas') == 'teacher') {
                $data['user'] = $this->Teacher_model->getClassByTeacherID($this->nativesession->get('libid'));
            } else if ($this->nativesession->get('loginas') == 'operation') {

            } else if ($this->nativesession->get('loginas') == 'admin') {
                $data['user'] = $this->Admin_model->getProfileDataByID($this->nativesession->get('libid'));
            } else if ($this->nativesession->get('loginas') == 'librarian') {
                $data['user'] = $this->Library_model->getProfileDataByID($this->nativesession->get('libid'));
            }
        } else {

        }

        $data['title'] = 'Library LMS';
        $data['topnavigation'] = 'library/library_topnavigation';
        $data['top2navigation'] = 'library/library_top2navigation_borrowing';
        $data['top2subnavigation'] = 'library/library_top2navigation_subborrowing';

        $data['borrowSetting'] =  $this->Library_model->getBorrowingSetting();
        $data['borrowed'] = $this->Library_model->getBorrowedCollection();
        $data['content'] = 'library/library_all_borrowed_collection_view';
        $this->load->view($this->template, $data);
    }

    public function editBorrowedCollection($elbid)
    {
        if ($this->nativesession->get('is_login_library')) {
            if ($this->nativesession->get('loginas') == 'admin') {
                $data['user'] = $this->Admin_model->getProfileDataByID($this->nativesession->get('libid'));
            } else if ($this->nativesession->get('loginas') == 'librarian') {
                $data['user'] = $this->Library_model->getProfileDataByID($this->nativesession->get('libid'));
            } else {
                $this->nativesession->set('error', 'Access Denied');
                redirect('library/home');
            }
        } else {
            redirect('library/home');
        }

        $lbid = $this->general->decryptParaID($elbid, 'libborrowed');
        $borrowed = $this->Library_model->getBorrowedCollectionDataByID($lbid);
        $collData = $this->Library_model->getCollectionDataByID($borrowed['lcid']);

        $this->form_validation->set_error_delimiters('', '<br/>');

        $this->form_validation->set_rules('userid', 'user ID', 'required');
        $this->form_validation->set_rules('collid', 'collection ID', 'required');
        $this->form_validation->set_rules('usertype', 'user type', 'required');
        $this->form_validation->set_rules('borrowSetting', 'borrowing period', 'required');


        $data['title'] = 'Library LMS';
        $data['topnavigation'] = 'library/library_topnavigation';
        $data['top2navigation'] = 'library/library_top2navigation_borrowing';

        $data['borrowedCollectionData'] = $borrowed;
//        echo serialize($borrowed);
        $data['borrowedIDEncrypted'] = $elbid;
        $data['borrowedID'] = $lbid;
        $data['fines'] = $this->Library_model->getFineDataByType($collData['materialType']);


        $data['collectionBorrowed'] = $collData;
        $data['borrowSetting'] =  $this->Library_model->getBorrowingSettingByID($borrowed['borrowCategory']);
        $data['content'] = 'library/library_edit_borrowed_collection_view';
        $this->load->view($this->template, $data);
    }

    public function collectionBorrowed($colid)
    {
        if ($this->nativesession->get('is_login_library')) {
            if ($this->nativesession->get('loginas') == 'student') {
                $data['user'] = $this->Student_model->getProfileDataByID($this->nativesession->get('libid'));
            } else if ($this->nativesession->get('loginas') == 'teacher') {
                $data['user'] = $this->Teacher_model->getClassByTeacherID($this->nativesession->get('libid'));
            } else if ($this->nativesession->get('loginas') == 'operation') {

            } else if ($this->nativesession->get('loginas') == 'admin') {
                $data['user'] = $this->Admin_model->getProfileDataByID($this->nativesession->get('libid'));
            } else if ($this->nativesession->get('loginas') == 'librarian') {
                $data['user'] = $this->Library_model->getProfileDataByID($this->nativesession->get('libid'));
            }
        } else {

        }
        $lcid = $this->general->decryptParaID($colid, 'collection');

        $data['title'] = 'Library LMS';
        $data['topnavigation'] = 'library/library_topnavigation';
        $data['top2navigation'] = 'library/library_top2navigation';

        $data['totalborrowed'] = $this->Library_model->getTotalBorrowedCollection();
        $data['colBorrowed'] = $this->Library_model->getBorrowedCollectionDataByCollectionID($lcid);
        $data['collections'] = $this->Library_model->getCollections();
        $data['parents'] = $this->Admin_model->getAllParents();
        $data['admins'] = $this->Admin_model->getAllAdministrator();
        $data['teachers'] = $this->Teacher_model->getAllTeacher();
        $data['librarians'] = $this->Admin_model->getAllLibrarian();
        $data['student'] = $this->Student_model->getAllStudent();
        $data['operations'] = $this->Admin_model->getAllOperations();


        $data['content'] = 'library/library_all_collection_borrower_view';
        $this->load->view($this->template, $data);
    }

    public function addBorrowedCollection()
    {
        if ($this->nativesession->get('is_login_library')) {
            if ($this->nativesession->get('loginas') == 'admin') {
                $data['user'] = $this->Admin_model->getProfileDataByID($this->nativesession->get('libid'));
            } else if ($this->nativesession->get('loginas') == 'librarian') {
                $data['user'] = $this->Library_model->getProfileDataByID($this->nativesession->get('libid'));
            } else {
                $this->nativesession->set('error', 'Access Denied');
                redirect('library/home');
            }
        } else {
            redirect('library/home');
        }


        $this->form_validation->set_rules('collID', 'collection ID', 'required');
        $this->form_validation->set_rules('userID', 'user ID', 'required');
        $this->form_validation->set_rules('usertype', 'user type', 'required');
        $this->form_validation->set_rules('borrSetting', 'borrowing period', 'required');


        $this->form_validation->set_error_delimiters('', '<br/>');
        $userData = NULL;
        $collectionData = NULL;
        if ($this->form_validation->run() == TRUE) {

            $type = $this->input->post('usertype');
            $userid = $this->input->post('userID');
            $collid = $this->input->post('collID');
            $borrowSetting = $this->input->post('borrSetting');

            $found = 0;
            $foundCol = 0;

            if(strcmp($type, "Student")==0) {
                $users = $this->Student_model->getAllStudent();
                if($users) {
                    foreach ($users as $user) {
                        if(strcmp($user['studentid'], $userid)==0) {
                            $found=1;
                            $userData = $user;
                        }
                    }
                }
            } else if(strcmp($type, "Teacher")==0) {
                $users = $this->Teacher_model->getAllTeacher();
                if($users) {
                    foreach ($users as $user) {
                        if(strcmp($user['teacherid'], $userid)==0) {
                            $found=1;
                            $userData = $user;
                        }
                    }
                }
            } else if(strcmp($type, "Administrator")==0) {
                $users = $this->Admin_model->getAllAdministrator();
                if($users) {
                    foreach ($users as $user) {
                        if(strcmp($user['adminid'], $userid)==0) {
                            $found=1;
                            $userData = $user;
                        }
                    }
                }
            } else if(strcmp($type, "Operator")==0) {
                $users = $this->Admin_model->getAllOperations();
                if($users) {
                    foreach ($users as $user) {
                        if(strcmp($user['operationid'], $userid)==0) {
                            $found=1;
                            $userData = $user;
                        }
                    }
                }
            } else if(strcmp($type, "Librarian")==0) {
                $users = $this->Admin_model->getAllLibrarian();
                if($users) {
                    foreach ($users as $user) {
                        if(strcmp($user['librarianid'], $userid)==0) {
                            $found=1;
                            $userData = $user;
                        }
                    }
                }
            }


            $coll = $this->Library_model->getCollectionDataByID($collid);
            if($coll) {
                if(strcmp($coll['lcid'], $collid)==0) {
                    $foundCol=1;
                    $collectionData = $coll;
                }
            }

//            echo serialize($collectionData);
            if(!$found or !$foundCol) {
                $this->nativesession->set('error', 'Data is invalid, please input valid data');

//                redirect('library/editBorrowedCollection/'.$elbid);
            } else if(!$collectionData['stock']>0) {
                $this->nativesession->set('error', 'There is no collection available');
            } else {
                $this->nativesession->set('collData',$collectionData);
                $this->nativesession->set('userData',$user);
                $this->nativesession->set('userType',$type);
                $this->nativesession->set('userID',$userid);
                $this->nativesession->set('borrowSetting',$borrowSetting);
                $this->nativesession->set('collStock',$collectionData['stock']);


                redirect('library/addBorrowedCollectionDetail');
            }
        }


        $data['title'] = 'Library LMS';
        $data['topnavigation'] = 'library/library_topnavigation';
        $data['top2navigation'] = 'library/library_top2navigation_borrowing';

        $data['borrower'] = $userData;
        $data['borrowSetting'] =  $this->Library_model->getBorrowingSetting();
//        $data['collectionBorrowed'] = $this->Library_model->getBorrowedCollectionDataByID();
        $data['content'] = 'library/library_add_borrowed_collection_view';
        $this->load->view($this->template, $data);
    }

    public function addBorrowedCollectionDetail()
    {
        if ($this->nativesession->get('is_login_library')) {
            if ($this->nativesession->get('loginas') == 'admin') {
                $data['user'] = $this->Admin_model->getProfileDataByID($this->nativesession->get('libid'));
            } else if ($this->nativesession->get('loginas') == 'librarian') {
                $data['user'] = $this->Library_model->getProfileDataByID($this->nativesession->get('libid'));
            } else {
                $this->nativesession->set('error', 'Access Denied');
                redirect('library/home');
            }
        } else {
            redirect('library/home');
        }

        $this->form_validation->set_error_delimiters('', '<br/>');
        $collData = $this->nativesession->get('collData');
        $userData = $this->nativesession->get('userData');
        $userid = $this->nativesession->get('userID');
        $usertype = $this->nativesession->get('userType');
        $borrowSetting = $this->nativesession->get('borrowSetting');
        $collStock = $this->nativesession->get('collStock');


        $this->form_validation->set_rules('userid', 'user ID', 'required');
        $this->form_validation->set_rules('collid', 'collection ID', 'required');
        $this->form_validation->set_rules('usertype', 'user type', 'required');
        $this->form_validation->set_rules('borrowSetting', 'borrowing period', 'required');


        if ($this->form_validation->run() == TRUE) {
            $latestid = $this->Library_model->getBorrowedLatestID();
            if ($latestid) {
                foreach ($latestid as $lastid) {
                    $value = substr($lastid, 1) + 1;
                }
//                echo $value;

                if ($value < 10) {
                    $newid = 'b00000' . $value;
                } else if ($value >= 10 and $value < 100) {
                    $newid = 'b0000' . $value;
                } else if ($value >= 100 and $value < 1000) {
                    $newid = 'b000' . $value;
                } else if ($value >= 1000 and $value < 10000) {
                    $newid = 'b00' . $value;
                } else if ($value >= 10000 and $value < 100000) {
                    $newid = 'b0' . $value;
                } else {
                    $newid = 'b' . $value;
                }
                echo $newid;
            } else {
                $newid = 'b000001';
            }


            $this->Library_model->addBorrowedCollection($newid, date("Y-m-d"));
            $currStock = $collStock -1;
            $this->Library_model->setCollectionStock($collData['lcid'],$currStock);

            $this->nativesession->set('success', 'Borrowed collection saved');
            redirect("library/allBorrowedCollection");

        }


        $data['title'] = 'Library LMS';
        $data['topnavigation'] = 'library/library_topnavigation';
        $data['top2navigation'] = 'library/library_top2navigation';

        $data['borrower'] = $userData;
        $data['collectionBorrowed'] = $collData;
        $data['userID'] = $userid;
        $data['borrowSetting'] =  $this->Library_model->getBorrowingSettingByID($borrowSetting);
        $data['userType'] = $usertype;
        $data['content'] = 'library/library_add_borrowed_collection_detail_view';
        $this->load->view($this->template, $data);
    }

    public function returnBorrowed($elbid)
    {
        if ($this->nativesession->get('is_login_library')) {
            if ($this->nativesession->get('loginas') == 'admin') {
                $data['user'] = $this->Admin_model->getProfileDataByID($this->nativesession->get('libid'));
            } else if ($this->nativesession->get('loginas') == 'librarian') {
                $data['user'] = $this->Library_model->getProfileDataByID($this->nativesession->get('libid'));
            } else {
                $this->nativesession->set('error', 'Access Denied');
                redirect('library/home');
            }
        } else {
            redirect('library/home');
        }

        $lbid = $this->general->decryptParaID($elbid, 'libborrowed');
        echo $this->input->post('lcid')."asa";

        $this->form_validation->set_rules('fine', 'fine', 'required');
        $this->form_validation->set_error_delimiters('', '<br/>');
        if ($this->form_validation->run() == TRUE) {
            $this->Library_model->editBorrowedCollectionStatus($lbid, "Returned", date("Y-m-d"));



            $coll = $this->Library_model->getCollectionDataByID($this->input->post('lcid'));
            $foundCol= 0;
            $collData = null;

            if($coll) {
                if (strcmp($coll['lcid'], $this->input->post('lcid')) == 0) {
                        $foundCol = 1;
                        $collData = $coll;
                }
            }


//            echo $collData['stock']."sblm <br>";
            $currStock = $collData['stock'] + 1;
//            echo $currStock."ssdh";
            $this->Library_model->setCollectionStock($collData['lcid'],$currStock);
            $this->nativesession->set('success', 'Borrowed collection saved');
            redirect("library/allBorrowedCollection");

        }


        $data['title'] = 'Library LMS';
        $data['topnavigation'] = 'library/library_topnavigation';
        $data['top2navigation'] = 'library/library_top2navigation';


        $data['borrowedIDEncrypted'] = $elbid;
        $data['borrowedID'] = $lbid;
        $data['fines'] = $this->Library_model->getFineDataByType($collData['materialType']);
        $data['collectionBorrowed'] = $collData;
//        $data['borrowSetting'] =  $this->Library_model->getBorrowingSettingByID($borrowed['borrowCategory']);
        $data['content'] = 'library/library_edit_borrowed_collection_view';
        $this->load->view($this->template, $data);
    }

    public function deleteBorrowedCollection($id)
    {
        $lbid = $this->general->decryptParaID($id, 'libborrowed');
        if ($this->Library_model->deleteBorrowedCollection($lbid)) {
            $this->nativesession->set('success', 'Borrowed Collection Deleted');
        } else {
            $this->nativesession->set('error', 'Failed to Delete Borrowed Collection');
        }
        redirect('library/allBorrowedCollection');
    }

    public function outstandingCollection()
    {
        if ($this->nativesession->get('is_login_library')) {
            if ($this->nativesession->get('loginas') == 'student') {
                $data['user'] = $this->Student_model->getProfileDataByID($this->nativesession->get('libid'));
            } else if ($this->nativesession->get('loginas') == 'teacher') {
                $data['user'] = $this->Teacher_model->getClassByTeacherID($this->nativesession->get('libid'));
            } else if ($this->nativesession->get('loginas') == 'operation') {

            } else if ($this->nativesession->get('loginas') == 'admin') {
                $data['user'] = $this->Admin_model->getProfileDataByID($this->nativesession->get('libid'));
            } else if ($this->nativesession->get('loginas') == 'librarian') {
                $data['user'] = $this->Library_model->getProfileDataByID($this->nativesession->get('libid'));
            }
        } else {

        }

        $data['title'] = 'Library LMS';
        $data['topnavigation'] = 'library/library_topnavigation';
        $data['top2navigation'] = 'library/library_top2navigation_borrowing';
        $data['top2subnavigation'] = 'library/library_top2navigation_subborrowing';

        $data['borrowSetting'] =  $this->Library_model->getBorrowingSetting();
        $data['borrowed'] = $this->Library_model->getBorrowedCollection();
        $data['content'] = 'library/library_outstanding_collection_view';
        $this->load->view($this->template, $data);
    }




    public function allBorrowingSetting()
    {
        if ($this->nativesession->get('is_login_library')) {
            if ($this->nativesession->get('loginas') == 'student') {
                $data['user'] = $this->Student_model->getProfileDataByID($this->nativesession->get('libid'));
            } else if ($this->nativesession->get('loginas') == 'teacher') {
                $data['user'] = $this->Teacher_model->getClassByTeacherID($this->nativesession->get('libid'));
            } else if ($this->nativesession->get('loginas') == 'operation') {

            } else if ($this->nativesession->get('loginas') == 'admin') {
                $data['user'] = $this->Admin_model->getProfileDataByID($this->nativesession->get('libid'));
            } else if ($this->nativesession->get('loginas') == 'librarian') {
                $data['user'] = $this->Library_model->getProfileDataByID($this->nativesession->get('libid'));
            }
        } else {

        }

        $data['title'] = 'Library LMS';
        $data['topnavigation'] = 'library/library_topnavigation';
        $data['top2navigation'] = 'library/library_top2navigation_borrowing';


        $data['infodb'] = $this->Library_model->getBorrowingSetting();
        $data['content'] = 'library/library_all_borrowing_setting_view';
        $this->load->view($this->template, $data);
    }

    public function editBorrowingSetting($id)
    {
        if ($this->nativesession->get('is_login_library')) {
            if ($this->nativesession->get('loginas') == 'admin') {
                $data['user'] = $this->Admin_model->getProfileDataByID($this->nativesession->get('libid'));
            } else if ($this->nativesession->get('loginas') == 'librarian') {
                $data['user'] = $this->Library_model->getProfileDataByID($this->nativesession->get('libid'));
            } else {
                $this->nativesession->set('error', 'Access Denied');
                redirect('library/home');
            }
        } else {
            redirect('library/home');
        }

         $this->form_validation->set_error_delimiters('', '<br/>');

        $this->form_validation->set_rules('borrowingPeriod', 'borrowing period', 'required');

        if ($this->form_validation->run() == TRUE) {

            $this->Library_model->editBorrowingSetting($id);

            $this->nativesession->set('success', 'Borrowing setting saved');
            redirect('library/allBorrowingSetting');
        } else {
            $this->nativesession->set('error', 'All field are required');
            redirect('library/allBorrowingSetting');
        }
    }

    public function addBorrowingSetting(){
        if ($this->nativesession->get('is_login_library')) {
            if ($this->nativesession->get('loginas') == 'admin') {
                $data['user'] = $this->Admin_model->getProfileDataByID($this->nativesession->get('libid'));
            } else if ($this->nativesession->get('loginas') == 'librarian') {
                $data['user'] = $this->Library_model->getProfileDataByID($this->nativesession->get('libid'));
            } else {
                $this->nativesession->set('error', 'Access Denied');
                redirect('library/home');
            }
        } else {
            redirect('library/home');
        }


        $this->form_validation->set_rules('borrowingPeriod', 'borrowing period', 'required');

        $this->form_validation->set_error_delimiters('', '<br/>');

        if ($this->form_validation->run() == TRUE) {
            $lastestid = $this->Library_model->getBorrowingSettingLatestID();
            if ($lastestid) {
//                foreach ($lastestid as $lastid) {
                    $newid=$lastestid['borrowCategory']+1;
//                }

            } else {
                $newid = '1';
            }

            $this->Library_model->addBorrowingSetting($newid);

            $this->nativesession->set('success', 'Borrowing Setting saved');
            redirect("library/allBorrowingSetting");

        }
        else {
            $this->nativesession->set('error', 'All field are required');
            redirect('library/allBorrowingSetting');
        }
    }

    public function deleteBorrowingSetting($id)
    {
        if ($this->Library_model->deleteBorrowingSetting($id)) {
            $this->nativesession->set('success', 'Borrowing Setting Deleted');
        } else {
            $this->nativesession->set('error', 'Failed to Delete Borrowing Setting');
        }
        redirect('library/allBorrowingSetting');
    }



    public function allFineSetting()
    {
        if ($this->nativesession->get('is_login_library')) {
            if ($this->nativesession->get('loginas') == 'student') {
                $data['user'] = $this->Student_model->getProfileDataByID($this->nativesession->get('libid'));
            } else if ($this->nativesession->get('loginas') == 'teacher') {
                $data['user'] = $this->Teacher_model->getClassByTeacherID($this->nativesession->get('libid'));
            } else if ($this->nativesession->get('loginas') == 'operation') {

            } else if ($this->nativesession->get('loginas') == 'admin') {
                $data['user'] = $this->Admin_model->getProfileDataByID($this->nativesession->get('libid'));
            } else if ($this->nativesession->get('loginas') == 'librarian') {
                $data['user'] = $this->Library_model->getProfileDataByID($this->nativesession->get('libid'));
            }
        } else {

        }

        $data['title'] = 'Library LMS';
        $data['topnavigation'] = 'library/library_topnavigation';
        $data['top2navigation'] = 'library/library_top2navigation_borrowing';


        $data['infodb'] = $this->Library_model->getFineSetting();
        $data['content'] = 'library/library_all_fine_setting_view';
        $this->load->view($this->template, $data);
    }

    public function editFineSetting($id)
    {
        if ($this->nativesession->get('is_login_library')) {
            if ($this->nativesession->get('loginas') == 'admin') {
                $data['user'] = $this->Admin_model->getProfileDataByID($this->nativesession->get('libid'));
            } else if ($this->nativesession->get('loginas') == 'librarian') {
                $data['user'] = $this->Library_model->getProfileDataByID($this->nativesession->get('libid'));
            } else {
                $this->nativesession->set('error', 'Access Denied');
                redirect('library/home');
            }
        } else {
            redirect('library/home');
        }

        $this->form_validation->set_error_delimiters('', '<br/>');

        $this->form_validation->set_rules('type', 'type', 'required');
        $this->form_validation->set_rules('fine', 'fine', 'required');

        if ($this->form_validation->run() == TRUE) {

            $this->Library_model->editFineSetting($id);

            $this->nativesession->set('success', 'Fine setting saved');
            redirect('library/allFineSetting');
        } else {
            $this->nativesession->set('error', 'All field are required');
            redirect('library/allFineSetting');
        }
    }

    public function addFineSetting(){
        if ($this->nativesession->get('is_login_library')) {
            if ($this->nativesession->get('loginas') == 'admin') {
                $data['user'] = $this->Admin_model->getProfileDataByID($this->nativesession->get('libid'));
            } else if ($this->nativesession->get('loginas') == 'librarian') {
                $data['user'] = $this->Library_model->getProfileDataByID($this->nativesession->get('libid'));
            } else {
                $this->nativesession->set('error', 'Access Denied');
                redirect('library/home');
            }
        } else {
            redirect('library/home');
        }


        $this->form_validation->set_rules('type', 'type', 'required');
        $this->form_validation->set_rules('fine', 'fine', 'required');

        $this->form_validation->set_error_delimiters('', '<br/>');

        if ($this->form_validation->run() == TRUE) {
            $lastestid = $this->Library_model->getFineSettingLatestID();
            if ($lastestid) {
//                foreach ($lastestid as $lastid) {
                $newid=$lastestid['id']+1;
//                }

            } else {
                $newid = '1';
            }

            $this->Library_model->addFineSetting($newid);

            $this->nativesession->set('success', 'Fine Setting saved');
            redirect("library/allFineSetting");

        }
        else {
            $this->nativesession->set('error', 'All field are required');
            redirect('library/allFineSetting');
        }
    }

    public function deleteFineSetting($id)
    {
        if ($this->Library_model->deleteFineSetting($id)) {
            $this->nativesession->set('success', 'Fine Setting Deleted');
        } else {
            $this->nativesession->set('error', 'Failed to Delete Fine Setting');
        }
        redirect('library/allFineSetting');
    }


    public function homeSlides()
    {
        if ($this->nativesession->get('is_login_library')) {
            if ($this->nativesession->get('loginas') == 'student') {
                $data['user'] = $this->Student_model->getProfileDataByID($this->nativesession->get('libid'));
            } else if ($this->nativesession->get('loginas') == 'teacher') {
                $data['user'] = $this->Teacher_model->getClassByTeacherID($this->nativesession->get('libid'));
            } else if ($this->nativesession->get('loginas') == 'operation') {

            } else if ($this->nativesession->get('loginas') == 'admin') {
                $data['user'] = $this->Admin_model->getProfileDataByID($this->nativesession->get('libid'));
            } else if ($this->nativesession->get('loginas') == 'librarian') {
                $data['user'] = $this->Library_model->getProfileDataByID($this->nativesession->get('libid'));
            }
        } else {

        }

        $data['title'] = 'Library LMS';
        $data['topnavigation'] = 'library/library_topnavigation';

        $data['infodb'] = $this->Library_model->getHomeSlides();
        $data['content'] = 'library/library_all_slides_view';
        $this->load->view($this->template, $data);
    }

    public function addHomeSlide()
    {
        if (empty($_FILES['userfile']['name'])){
            $this->nativesession->set('error', 'Image is required');
        }
        else{
            $latestID = $this->Library_model->getHomeSlideLatestID();
            $latestID = $latestID['id']+1;
            if ($_FILES['userfile']['error'] != 4) {
                $config['upload_path'] = $this->libraryslidepath;
                $config['allowed_types'] = "jpeg|jpg|png|JPEG|JPG|PNG";
                $config['max_size'] = 200000;
                $config['overwrite'] = TRUE;
                $config['file_name'] = $latestID;
                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('userfile')) {
                    $this->nativesession->set('error', $this->upload->display_errors());
                    redirect('library/homeSlides');
                } else {
                    if($data = $this->upload->data()){
                        $filename = $data['orig_name'];
                        $this->Library_model->addHomeSlideImage($latestID, $filename);
                        $this->nativesession->set('success', 'Library Home Slide Image Added');
                        redirect('library/homeSlides');
                    }
                }
            }
        }
    }

    public function editHomeSlide($id)
    {
        if (empty($_FILES['userfile']['name'])){
            $this->nativesession->set('error', 'Image is required');
        }
        else{
            if ($_FILES['userfile']['error'] != 4) {
                $config['upload_path'] = $this->libraryslidepath;
                $config['allowed_types'] = "jpeg|jpg|png|JPEG|JPG|PNG";
                $config['max_size'] = 200000;
                $config['overwrite'] = TRUE;
                $config['file_name'] = $id;
                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('userfile')) {
                    $this->nativesession->set('error', $this->upload->display_errors());
                    redirect('library/homeSlides');
                } else {
                    if($data = $this->upload->data()){
                        $filename = $data['orig_name'];
                        $this->Library_model->editHomeSlideImage($id, $filename);
                        $this->nativesession->set('success', 'Library Home Slide Image Save');
                        redirect('library/homeSlides');
                    }
                }
            }
        }
    }



    public function allNews()
    {
        if ($this->nativesession->get('is_login_library')) {
            if ($this->nativesession->get('loginas') == 'student') {
                $data['user'] = $this->Student_model->getProfileDataByID($this->nativesession->get('libid'));
            } else if ($this->nativesession->get('loginas') == 'teacher') {
                $data['user'] = $this->Teacher_model->getClassByTeacherID($this->nativesession->get('libid'));
            } else if ($this->nativesession->get('loginas') == 'operation') {

            } else if ($this->nativesession->get('loginas') == 'admin') {
                $data['user'] = $this->Admin_model->getProfileDataByID($this->nativesession->get('libid'));
            } else if ($this->nativesession->get('loginas') == 'librarian') {
                $data['user'] = $this->Library_model->getProfileDataByID($this->nativesession->get('libid'));
            }
        } else {

        }

        $data['title'] = 'Library LMS';
        $data['topnavigation'] = 'library/library_topnavigation';
//        $data['top2navigation'] = 'library/library_top2navigation';

        $data['totalborrowed'] = $this->Library_model->getTotalBorrowedCollection();
        $data['news'] = $this->Library_model->getAllNews();
        $data['content'] = 'library/library_all_news_view';
        $this->load->view($this->template, $data);
    }

    public function editNews($id) {
        if ($this->nativesession->get('is_login_library')) {
            if ($this->nativesession->get('loginas') == 'admin') {
                $data['user'] = $this->Admin_model->getProfileDataByID($this->nativesession->get('libid'));
            } else if ($this->nativesession->get('loginas') == 'librarian') {
                $data['user'] = $this->Library_model->getProfileDataByID($this->nativesession->get('libid'));
            } else {
                $this->nativesession->set('error', 'Access Denied');
                redirect('library/home');
            }
        } else {
            redirect('library/home');
        }


        $this->form_validation->set_rules('title', 'title', 'required');
        $this->form_validation->set_rules('content', 'content', 'required');

        $lnid = $this->general->decryptParaID($id, 'libnews');

        $this->form_validation->set_error_delimiters('', '<br/>');
        if ($this->form_validation->run() == TRUE) {

            $subject = $this->input->post('title');

            $this->Library_model->editNews($lnid);
            $this->nativesession->set('success', 'News saved');

            redirect('library/editNews/'.$id);
        }

        $data['title'] = 'Library LMS';
        $data['topnavigation'] = 'library/library_topnavigation';
        $data['top2navigation'] = 'library/library_top2navigation';

        $data['eNewsID'] = $id;
        $data['newsID'] = $lnid;
        $data['news'] = $this->Library_model->getNewsByID($lnid);
        $data['content'] = 'library/library_edit_news_view';
        $this->load->view($this->template, $data);
    }

    public function deleteNews($id)
    {
        $id = $this->general->decryptParaID($id, 'libnews');
        if ($this->Library_model->deleteNews($id)) {
            $this->nativesession->set('success', 'News Deleted');
        } else {
            $this->nativesession->set('error', 'Failed to Delete News');
        }
        redirect('library/allNews/');
    }

    public function addNews() {
        if ($this->nativesession->get('is_login_library')) {
            if ($this->nativesession->get('loginas') == 'admin') {
                $data['user'] = $this->Admin_model->getProfileDataByID($this->nativesession->get('libid'));
            } else if ($this->nativesession->get('loginas') == 'librarian') {
                $data['user'] = $this->Library_model->getProfileDataByID($this->nativesession->get('libid'));
            } else {
                $this->nativesession->set('error', 'Access Denied');
                redirect('library/home');
            }
        } else {
            redirect('library/home');
        }


        $this->form_validation->set_rules('title', 'title', 'required');
        $this->form_validation->set_rules('content', 'content', 'required');


        $this->form_validation->set_error_delimiters('', '<br/>');
        if ($this->form_validation->run() == TRUE) {

            $latestid = $this->Library_model->getNewsLatestID();
            if ($latestid) {
                foreach ($latestid as $lastid) {
                    $value = substr($lastid, 1) + 1;
                }
//                echo $value;
                if ($value < 10) {
                    $newid = 'b000' . $value;
                } else if ($value >= 10 and $value < 100) {
                    $newid = 'b00' . $value;
                } else if ($value >= 100 and $value < 1000) {
                    $newid = 'b0' . $value;
                } else {
                    $newid = 'b' . $value;
                }
//                echo $newid;
            } else {
                $newid = 'b0001';
            }


            $this->Library_model->addNews($newid, date("Y-m-d"));
            $this->nativesession->set('success', 'News saved');

            redirect('library/allNews');
        }

        $data['title'] = 'Library LMS';
        $data['topnavigation'] = 'library/library_topnavigation';
        $data['top2navigation'] = 'library/library_top2navigation';

        $data['content'] = 'library/library_add_news_view';
        $this->load->view($this->template, $data);
    }




    public function allUsefulLink()
    {
        if ($this->nativesession->get('is_login_library')) {
            if ($this->nativesession->get('loginas') == 'student') {
                $data['user'] = $this->Student_model->getProfileDataByID($this->nativesession->get('libid'));
            } else if ($this->nativesession->get('loginas') == 'teacher') {
                $data['user'] = $this->Teacher_model->getClassByTeacherID($this->nativesession->get('libid'));
            } else if ($this->nativesession->get('loginas') == 'operation') {

            } else if ($this->nativesession->get('loginas') == 'admin') {
                $data['user'] = $this->Admin_model->getProfileDataByID($this->nativesession->get('libid'));
            } else if ($this->nativesession->get('loginas') == 'librarian') {
                $data['user'] = $this->Library_model->getProfileDataByID($this->nativesession->get('libid'));
            }
        } else {

        }

        $data['title'] = 'Library LMS';
        $data['topnavigation'] = 'library/library_topnavigation';
//        $data['top2navigation'] = 'library/library_top2navigation';

        $data['infodb'] = $this->Library_model->getUsefulLinkCategory();
        $data['content'] = 'library/library_all_useful_link_cat_view';
        $this->load->view($this->template, $data);
    }

    public function addUsefulLinkCategory(){
        if ($this->nativesession->get('is_login_library')) {
            if ($this->nativesession->get('loginas') == 'admin') {
                $data['user'] = $this->Admin_model->getProfileDataByID($this->nativesession->get('libid'));
            } else if ($this->nativesession->get('loginas') == 'librarian') {
                $data['user'] = $this->Library_model->getProfileDataByID($this->nativesession->get('libid'));
            } else {
                $this->nativesession->set('error', 'Access Denied');
                redirect('library/home');
            }
        } else {
            redirect('library/home');
        }


        $this->form_validation->set_rules('category', 'category', 'required');

        $this->form_validation->set_error_delimiters('', '<br/>');

        if ($this->form_validation->run() == TRUE) {
            $lastestid = $this->Library_model->getUsefulLinkCategoryLatestID();
            if ($lastestid) {
                foreach ($lastestid as $lastid) {
                    $newid=$lastid['category']+1;
                }

            } else {
                $newid = '1';
            }

            $this->Library_model->addUsefulLinkCategory($newid);

            $this->nativesession->set('success', 'Useful link category saved');
            redirect("library/allUsefulLink");

        }
        else {
            $this->nativesession->set('error', 'All field are required');
            redirect('library/allUsefulLink');
        }
    }

    public function editUsefulLinkCategory($id) {
        if ($this->nativesession->get('is_login_library')) {
            if ($this->nativesession->get('loginas') == 'admin') {
                $data['user'] = $this->Admin_model->getProfileDataByID($this->nativesession->get('libid'));
            } else if ($this->nativesession->get('loginas') == 'librarian') {
                $data['user'] = $this->Library_model->getProfileDataByID($this->nativesession->get('libid'));
            } else {
                $this->nativesession->set('error', 'Access Denied');
                redirect('library/home');
            }
        } else {
            redirect('library/home');
        }


        $this->form_validation->set_rules('category', 'category', 'required');

        $this->form_validation->set_error_delimiters('', '<br/>');
        if ($this->form_validation->run() == TRUE) {

            $this->Library_model->editUsefulLinkCategory($id);

            $this->nativesession->set('success', 'Useful link saved');
            redirect('library/allUsefulLink');
        } else {
            $this->nativesession->set('error', 'All field are required');
            redirect('library/allUsefulLink');
        }
    }

    public function deleteUsefulLinkCategory($id)
    {
        if ($this->Library_model->deleteUsefulLinkCategory($id)) {
            $this->nativesession->set('success', 'Useful Link Category Deleted');
        } else {
            $this->nativesession->set('error', 'Failed to Delete Useful Link Category ');
        }
        redirect('library/allUsefulLink');
    }

    public function usefulLinkContent($id)
    {
        if ($this->nativesession->get('is_login_library')) {
            if ($this->nativesession->get('loginas') == 'student') {
                $data['user'] = $this->Student_model->getProfileDataByID($this->nativesession->get('libid'));
            } else if ($this->nativesession->get('loginas') == 'teacher') {
                $data['user'] = $this->Teacher_model->getClassByTeacherID($this->nativesession->get('libid'));
            } else if ($this->nativesession->get('loginas') == 'operation') {

            } else if ($this->nativesession->get('loginas') == 'admin') {
                $data['user'] = $this->Admin_model->getProfileDataByID($this->nativesession->get('libid'));
            } else if ($this->nativesession->get('loginas') == 'librarian') {
                $data['user'] = $this->Library_model->getProfileDataByID($this->nativesession->get('libid'));
            }
        } else {

        }

        $data['title'] = 'Library LMS';
        $data['topnavigation'] = 'library/library_topnavigation';
//        $data['top2navigation'] = 'library/library_top2navigation';

        $data['category'] = $this->Library_model->getUsefulLinkCategory();
        $data['curcategory'] = $id;
        $data['infodb'] = $this->Library_model->getUsefulLinkContentByID($id);
        $data['content'] = 'library/library_useful_link_content_view';
        $this->load->view($this->template, $data);
    }

    public function addUsefulLinkContent($id){
        if ($this->nativesession->get('is_login_library')) {
            if ($this->nativesession->get('loginas') == 'admin') {
                $data['user'] = $this->Admin_model->getProfileDataByID($this->nativesession->get('libid'));
            } else if ($this->nativesession->get('loginas') == 'librarian') {
                $data['user'] = $this->Library_model->getProfileDataByID($this->nativesession->get('libid'));
            } else {
                $this->nativesession->set('error', 'Access Denied');
                redirect('library/home');
            }
        } else {
            redirect('library/home');
        }


        $this->form_validation->set_rules('title', 'title', 'required');
        $this->form_validation->set_rules('link', 'link', 'required');

        $this->form_validation->set_error_delimiters('', '<br/>');

        if ($this->form_validation->run() == TRUE) {
            $latestid = $this->Library_model->getUsefulLinkContentLatestID();
                if ($latestid) {
                    foreach ($latestid as $lastid) {
                        $value = substr($lastid, 1) + 1;
                    }
//                echo $value;

                    if ($value < 10) {
                        $newid = 'l000' . $value;
                    } else if ($value >= 10 and $value < 100) {
                        $newid = 'l00' . $value;
                    } else if ($value >= 100 and $value < 1000) {
                        $newid = 'l0' . $value;
                    } else {
                        $newid = 'l' . $value;
                    }
                    echo $newid;
            } else {
                $newid = 'l0001';
            }

            $this->Library_model->addUsefulLinkContent($newid, $id);

            $this->nativesession->set('success', 'Useful link content saved');
            redirect("library/usefulLinkContent/".$id);

        }
        else {
            $this->nativesession->set('error', 'All field are required');
            redirect('library/usefulLinkContent/'.$id);
        }
    }

    public function editUsefulLinkContent($id, $cat) {
        if ($this->nativesession->get('is_login_library')) {
            if ($this->nativesession->get('loginas') == 'admin') {
                $data['user'] = $this->Admin_model->getProfileDataByID($this->nativesession->get('libid'));
            } else if ($this->nativesession->get('loginas') == 'librarian') {
                $data['user'] = $this->Library_model->getProfileDataByID($this->nativesession->get('libid'));
            } else {
                $this->nativesession->set('error', 'Access Denied');
                redirect('library/home');
            }
        } else {
            redirect('library/home');
        }


        $this->form_validation->set_rules('title', 'title', 'required');
        $this->form_validation->set_rules('link', 'link', 'required');

        $this->form_validation->set_error_delimiters('', '<br/>');
        if ($this->form_validation->run() == TRUE) {

            $this->Library_model->editUsefulLinkContent($id);

            $this->nativesession->set('success', 'Useful link saved');
            redirect('library/usefulLinkContent/'.$cat);
        } else {
            $this->nativesession->set('error', 'All field are required');
            redirect('library/usefulLinkContent/'.$cat);
        }
    }

    public function deleteUsefulLinkContent($id, $cat)
    {
        if ($this->Library_model->deleteUsefulLinkContent($id)) {
            $this->nativesession->set('success', 'Useful Link Content Deleted');
        } else {
            $this->nativesession->set('error', 'Failed to Delete Useful Link Content');
        }
        redirect('library/usefulLinkContent/'.$cat);
    }



    public function profileEdit($id)
    {
        $userid=null;
        $userdata = 0;
        if( $this->nativesession->get('loginas') == 'librarian'){
            $userid = $this->general->decryptParaID($id, 'librarian');
            $userdata  = $this->Library_model->getProfileDataByID($userid);
        }
        else if($this->nativesession->get('loginas') == 'admin'){
            $userid = $this->general->decryptParaID($id, 'admin');
            $userdata = $this->Admin_model->getProfileDataByID($userid);
        }


        $this->form_validation->set_rules('firstname', 'firstname', 'required');
        $this->form_validation->set_rules('lastname', 'lastname', 'required');
        $this->form_validation->set_rules('gender', 'gender', 'required');
        $this->form_validation->set_rules('phone', 'phone', 'required');
        $this->form_validation->set_rules('email', 'email', 'required|valid_email');
        $this->form_validation->set_rules('address', 'address', 'required');
        $this->form_validation->set_rules('dateofbirth', 'date of birth', 'required');
        $this->form_validation->set_rules('placeofbirth', 'place of birth', 'required');
        $this->form_validation->set_rules('religion', 'religion', 'required');
        $this->form_validation->set_rules('elementary', 'elementary', 'required');
        $this->form_validation->set_rules('juniorhigh', 'junior high', 'required');
        $this->form_validation->set_rules('seniorhigh', 'senior high', 'required');
        $this->form_validation->set_rules('undergraduate', 'undergraduate', 'required');
//        $this->form_validation->set_rules('graduate', 'graduate', 'required');
//        $this->form_validation->set_rules('postgraduate', 'postgraduate', 'required');
//        $this->form_validation->set_rules('experience', 'working experience', 'required');


        if ($this->input->post('password')):
            $this->form_validation->set_rules('password', 'password', 'required');
            $this->form_validation->set_rules('confirmpassword', 'confirm password', 'required|matches[password]');
        endif;

        $this->form_validation->set_error_delimiters('', '<br/>');

        if ($this->form_validation->run() == TRUE) {
//            echo "mask";
            if ($_FILES['photo']['error'] != 4) {
                $path = null;
                if( $this->nativesession->get('loginas') == 'librarian'){
                    $path = $this->profilelibrarianphotopath;
                }
                else if($this->nativesession->get('loginas') == 'admin'){
                    $path = $this->profileadminphotopath;
                }

                $config['upload_path'] = $path;
                $config['allowed_types'] = "jpg|jpeg|png";
                $config['max_size'] = 200000;
                $config['overwrite'] = TRUE;
                $config['file_name'] = $userid;
                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('photo')) {

                    $this->nativesession->set('error', $this->upload->display_errors());
                    redirect(current_url());
                } else {
                    $data = $this->upload->data();
                    $config_image = array(
                        'image_library' => 'gd2',
                        'source_image' => $path . '/' . $data['orig_name'],
                        'new_image' => $path . '/' . $data['orig_name'],
                        'width' => 1240,
                        'maintain_ratio' => TRUE,
                        'rotate_by_exif' => TRUE,
//                'strip_exif' => TRUE,
                    );
                    $this->load->library('image_lib', $config_image);
                    $this->image_lib->resize();

                    $filename = $data['orig_name'];
                    if( $this->nativesession->get('loginas') == 'librarian'){
                        $this->Library_model->editProfile($userid);
                        if ($this->Library_model->editProfilePhoto($userid, $filename)) {
                        } else {
                            $this->nativesession->set('error', 'Upload Photo Failed, try again !');
                            redirect(current_url());
                        }


                    }
                     else if($this->nativesession->get('loginas') == 'admin'){
                        $this->Admin_model->editProfile($userid);
                        echo $this->input->POST('firstname');
                        if ($this->Admin_model->editProfilePhoto($userid, $filename)) {
                        } else {
                            $this->nativesession->set('error', 'Upload Photo Failed, try again !');
                            redirect(current_url());
                        }

                    }
                }
            }

            if( $this->nativesession->get('loginas') == 'librarian'){
                $this->Library_model->editProfile($userid);
            }
            else if($this->nativesession->get('loginas') == 'admin'){
                $this->Admin_model->editProfile($userid);
            }
            $this->nativesession->set('success', 'Profile saved');
                        redirect('library/profile');
        }


        $data['user'] = $userdata;
        $data['title'] = 'Library LMS';
        $data['topnavigation'] = 'library/library_topnavigation';
        $data['content'] = 'library/library_profile_edit_view';
        $this->load->view($this->template, $data);
    }

    public function logout(){
        $this->nativesession->delete('id');
        $this->nativesession->delete('name');
        $this->nativesession->delete('photo');
        $this->nativesession->delete('librole');
        $this->nativesession->delete('lastlogin');
        $this->nativesession->delete('is_login_library');
        redirect('library/home');
    }
}