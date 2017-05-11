<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Library extends CI_Controller {

    var $template = 'template_library';

    function __construct() {
        parent::__construct();
        $this->load->model('Teacher_model');
        $this->load->model('Student_model');
        $this->load->model('Admin_model');
        $this->load->model('Library_model');
    }

    public function index()
    {
        $this->form_validation->set_rules('loginas', 'loginas', 'required');
        $this->form_validation->set_rules('username', 'username', 'required|alpha_numeric');
        $this->form_validation->set_rules('password', 'password', 'required');
        $this->form_validation->set_error_delimiters('', '<br/>');

        if ($this->form_validation->run() == TRUE) {
            $loginas = $this->input->post('loginas');
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            if($loginas == 'student'){
                $user = $this->Student_model->checkLogin($username, $password);
                if (!empty($user)) {
                    $this->nativesession->set( 'id', $user['studentid'] );
                    $this->nativesession->set( 'name', $user['firstname'].' '.$user['lastname'] );
                    $this->nativesession->set( 'classid', $user['classid'] );
                    $this->nativesession->set( 'is_login', 'TRUE' );
                    $this->nativesession->set( 'loginas', 'student' );
                    redirect('library/home');
                }
            }
            else if($loginas == 'teacher'){
                $user = $this->Teacher_model->checkLogin($username, $password);
                if (!empty($user)) {
                    $this->nativesession->set( 'id', $user['teacherid'] );
                    $this->nativesession->set( 'name', $user['firstname'].' '.$user['lastname'] );
                    $this->nativesession->set( 'photo', $user['photo'] );
                    $this->nativesession->set( 'role', $user['role'] );
                    $this->nativesession->set( 'lastlogin', $user['lastlogin'] );
                    $this->nativesession->set( 'is_login', 'TRUE' );
                    $this->nativesession->set( 'loginas', 'teacher' );;
                    redirect('library/home');
                }
            }
            else if($loginas == 'operation'){
//				$user = $this->Operation_model->checkLogin($username, $password);
//				if (!empty($user)) {
//					$sessionData['id'] = $user['id'];
//					$sessionData['email'] = $user['email'];
//					$sessionData['full_name'] = $user['full_name'];
//					$sessionData['level'] = $user['level'];
//					$sessionData['is_login'] = TRUE;
//
//					$this->session->set_userdata($sessionData);
//					$this->Operation_model->updateLastLogin($user['id']);

                redirect('library/home');
//				}
            }
            else if($loginas == 'admin'){
                $user = $this->Admin_model->checkLogin($username, $password);
                if (!empty($user)) {
                    $this->nativesession->set( 'id', $user['adminid'] );
                    $this->nativesession->set( 'name', $user['firstname'].' '.$user['lastname'] );
                    $this->nativesession->set( 'role', $user['role'] );
                    $this->nativesession->set( 'is_login', 'TRUE' );
                    $this->nativesession->set( 'loginas', 'admin' );
                    $this->nativesession->set( 'loginas', 'admin' );
                    redirect('library/home');
                }
            } else {
                $this->nativesession->set( 'is_login', 'FALSE' );
            }

            $this->nativesession->set('error', 'Login Failed!, username and password combination are wrong');
        }

        $data['title'] = 'SMS';
        $data['content'] = 'login/login_view';
        $this->load->view($this->template, $data);
    }

    public function home()
    {
        if ($this->nativesession->get('is_login')){
            if($this->nativesession->get('loginas')=='student'){
                $data['user'] = $this->Student_model->getProfileDataByID($this->nativesession->get('id'));
            }
            else  if($this->nativesession->get('loginas')=='teacher'){
                $data['user'] = $this->Teacher_model->getClassByTeacherID($this->nativesession->get('id'));
            }
            else  if($this->nativesession->get('loginas')=='operation'){

            }
            else  if($this->nativesession->get('loginas')=='admin'){
                $data['user'] = $this->Admin_model->getProfileDataByID($this->nativesession->get('id'));
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
    $data['title'] = 'Library LMS';
    $data['topnavigation'] = 'library/library_topnavigation';
    $data['content'] = 'library/library_collection_view';
    $this->load->view($this->template, $data);
}

    public function about()
    {
        $data['title'] = 'Library LMS';
//        //$data['sidebar'] = 'library/library_sidebar';
        $data['topnavigation'] = 'library/library_topnavigation';
        $data['content'] = 'library/library_about_view';
        $this->load->view($this->template, $data);
    }

    public function contact()
    {
        $data['title'] = 'Library LMS';
        $data['topnavigation'] = 'library/library_topnavigation';
        $data['content'] = 'library/library_contact_view';
        $this->load->view($this->template, $data);
    }

    public function borrowing_history ()
    {
        $data['title'] = 'Library LMS';
        $data['topnavigation'] = 'library/library_topnavigation';
        $data['content'] = 'library/library_borrowing_history_view';
        $this->load->view($this->template, $data);
    }

    public function obligation ()
    {
        $data['title'] = 'Library LMS';
        $data['topnavigation'] = 'library/library_topnavigation';
        $data['content'] = 'library/library_obligation_view';
        $this->load->view($this->template, $data);
    }

    public function profile ()
    {
        $data['title'] = 'Library LMS';
        $data['topnavigation'] = 'library/library_topnavigation';
        $data['content'] = 'library/library_profile_view';
        $this->load->view($this->template, $data);
    }

    public function login()
    {
        $data['title'] = 'Library LMS';
//        $data['topnavigation'] = 'library/library_topnavigation';
        $data['content'] = 'library/library_login_view';
        $this->load->view($this->template, $data);
    }

    public function searchCollection()
    {
        $data['title'] = 'Library LMS';
        $data['service'] = $this->Library_model->getServiceByID('p0001');
        $data['topnavigation'] = 'library/library_topnavigation';
        $data['content'] = 'library/library_service_view';
        $this->load->view($this->template, $data);
    }

    public function circulation()
    {
        $data['title'] = 'Library LMS';
        $data['service'] = $this->Library_model->getServiceByID('p0002');
        $data['topnavigation'] = 'library/library_topnavigation';
        $data['content'] = 'library/library_service_view';
        $this->load->view($this->template, $data);
    }

    public function currentAwareness()
    {
        $data['title'] = 'Library LMS';
        $data['service'] = $this->Library_model->getServiceByID('p0003');
        $data['topnavigation'] = 'library/library_topnavigation';
        $data['content'] = 'library/library_service_view';
        $this->load->view($this->template, $data);
    }

    public function requestMaterials()
    {
        $data['title'] = 'Library LMS';
        $data['service'] = $this->Library_model->getServiceByID('p0004');
        $data['topnavigation'] = 'library/library_topnavigation';
        $data['content'] = 'library/library_service_view';
        $this->load->view($this->template, $data);
    }

    public function lostAndFound()
    {
        $data['title'] = 'Library LMS';
        $data['service'] = $this->Library_model->getServiceByID('p0005');
        $data['topnavigation'] = 'library/library_topnavigation';
        $data['content'] = 'library/library_service_view';
        $this->load->view($this->template, $data);
    }

    public function facilities()
    {
        $data['title'] = 'Library LMS';
        $data['service'] = $this->Library_model->getServiceByID('p0005');
        $data['topnavigation'] = 'library/library_topnavigation';
        $data['content'] = 'library/library_service_view';
        $this->load->view($this->template, $data);
    }



    public function library_profile()
    {
        $data['title'] = 'Library LMS';
        //$data['sidebar'] = 'library/library_sidebar';
        $data['topnavigation'] = 'library/library_topnavigation';
        $data['content'] = 'library/library_profile_view';
        $this->load->view($this->template, $data);
    }



    public function library_profile_edit()
    {
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
        $this->nativesession->delete('role');
        $this->nativesession->delete('lastlogin');
        $this->nativesession->delete('is_login');
        redirect('library/home');
    }
}