<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Library extends CI_Controller
{

    var $template = 'template_library';


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
        $data['services'] = $this->Library_model->getAllServices();
        $data['news'] = $this->Library_model->getRecentNews();
        $data['useful_link_categories'] = $this->Library_model->getUsefulLinkCategory();
        $data['useful_links'] = $this->Library_model->getAllUsefulLink();
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

        }
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
            $encrypted = $this->general->encryptParaID($newid, 'collection');
            redirect('library/editCollection/' . $encrypted);
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
        $data['top2navigation'] = 'library/library_top2navigation';


        $data['borrowed'] = $this->Library_model->getBorrowedCollection();
        $data['content'] = 'library/library_all_borrowed_collection_view';
        $this->load->view($this->template, $data);
    }

    public function editBorrowedCollection($lbid)
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

        $lcid = $this->general->decryptParaID($lbid, 'libborrowed');

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

        $data['collection'] = $this->Library_model->getBorrowedCollectionDataByID($lcid);
        $data['content'] = 'library/library_edit_borrowed_collection_view';
        $this->load->view($this->template, $data);
    }


    public function library_profile_edit()
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