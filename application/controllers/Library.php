<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Library extends CI_Controller {

    var $template = 'template_library';


    public function index()
    {
        $this->form_validation->set_rules('username', 'username', 'required|alpha_numeric');
        $this->form_validation->set_rules('password', 'password', 'required');
        $this->form_validation->set_error_delimiters('', '<br/>');

        if ($this->form_validation->run() == TRUE) {
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            $user = $this->Teacher_model->checkLogin($username, $password);
                if (!empty($user)) {
                    $sessionData['id'] = $user['teacherid'];
                    $sessionData['photo'] = $user['photo'];
                    $sessionData['role'] = $user['role'];
                    $sessionData['lastlogin'] = $user['lastlogin'];
                    $sessionData['is_login'] = TRUE;

                    $this->session->set_userdata($sessionData);
//					$this->Teacher_model->updateLastLogin($user['id']);

                    redirect('teacher/home');
                }

            $this->session->set_flashdata('error', 'Login Failed!, username and password combination are wrong');
        }

        $data['title'] = 'SMS';
        $data['content'] = 'login/login_view';
        $this->load->view($this->template, $data);
    }

    public function home()
    {
        $data['title'] = 'Library LMS';
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


    public function login()
    {
        $data['title'] = 'Library LMS';
//        $data['topnavigation'] = 'library/library_topnavigation';
        $data['content'] = 'library/library_login_view';
        $this->load->view($this->template, $data);
    }

    public function learning_report()
    {
        $data['title'] = 'Library LMS';
        //$data['sidebar'] = 'library/library_sidebar';
        $data['topnavigation'] = 'library/library_topnavigation';
        $data['content'] = 'library/learning_report_view';
        $this->load->view($this->template, $data);
    }

    public function classScheduleView()
    {
        $data['title'] = 'SMS';
        //$data['sidebar'] = 'library/library_sidebar';
        $data['topnavigation'] = 'library/library_topnavigation';
        $data['content'] = 'includes/class_schedule_view';
        $this->load->view($this->template, $data);
    }

    public function examScheduleView()
    {
        $data['title'] = 'SMS';
        //$data['sidebar'] = 'library/library_sidebar';
        $data['topnavigation'] = 'library/library_topnavigation';
        $data['content'] = 'includes/exam_schedule_view';
        $this->load->view($this->template, $data);
    }

    public function courseAssignmentQuiz()
    {
        $data['title'] = 'Library LMS';
        //$data['sidebar'] = 'library/library_sidebar';
        $data['topnavigation'] = 'library/library_topnavigation';
        $data['content'] = 'library/library_course_qna_view';
        $this->load->view($this->template, $data);
    }

    public function courseMaterial()
    {
        $data['title'] = 'Library LMS';
        //$data['sidebar'] = 'library/library_sidebar';
        $data['topnavigation'] = 'library/library_topnavigation';
        $data['content'] = 'library/library_course_material_view';
        $this->load->view($this->template, $data);
    }

    public function coursePlan()
    {
        $data['title'] = 'Library LMS';
        //$data['sidebar'] = 'library/library_sidebar';
        $data['topnavigation'] = 'library/library_topnavigation';
        $data['content'] = 'library/library_course_plan_view';
        $this->load->view($this->template, $data);
    }

    public function courseLibrary()
    {
        $data['title'] = 'Library LMS';
        //$data['sidebar'] = 'library/library_sidebar';
        $data['topnavigation'] = 'library/library_topnavigation';
        $data['content'] = 'library/library_course_library_view';
        $this->load->view($this->template, $data);
    }

    public function courseView()
    {
        $data['title'] = 'Library LMS';
        //$data['sidebar'] = 'library/library_sidebar';
        $data['topnavigation'] = 'library/library_topnavigation';
        $data['content'] = 'library/library_course_view';
        $this->load->view($this->template, $data);
    }

    public function courseImplementation()
    {
        $data['title'] = 'Library LMS';
        //$data['sidebar'] = 'library/library_sidebar';
        $data['topnavigation'] = 'library/library_topnavigation';
        $data['content'] = 'library/library_course_view';
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
}