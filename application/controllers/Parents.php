<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class parents extends CI_Controller {

    var $template = 'template';

    function __construct() {
        parent::__construct();
        $this->load->model('Parent_model');
    }

    public function home()
    {
        $data['title'] = 'SMS';
        $data['sidebar'] = 'parents/parent_sidebar';
        $data['topnavigation'] = 'parents/parent_topnavigation';
        $data['content'] = 'parents/parent_home_view';
        $data['eventnotif'] = $this->Parent_model->getAllEventsCount($this->nativesession->get('id'),$this->nativesession->get('lastlogin'));
        $data['events'] = $this->Parent_model->getAllEvents($this->nativesession->get('id'));
        $this->load->view($this->template, $data);
    }

    public function parent_attendance()
    {
        $data['title'] = 'SMS';
        $data['sidebar'] = 'parents/parent_sidebar';
        $data['topnavigation'] = 'parents/parent_topnavigation';
        $data['content'] = 'parents/parent_attendance_view';
        $this->load->view($this->template, $data);
    }
    public function parent_reportcard_midterm()
    {
        $data['title'] = 'SMS';
        $data['sidebar'] = 'parents/parent_sidebar';
        $data['topnavigation'] = 'parents/parent_topnavigation';
        $data['content'] = 'parents/parent_reportcard_midterm_view';
        $this->load->view($this->template, $data);
    }
    public function parent_reportcard_finalterm()
    {
        $data['title'] = 'SMS';
        $data['sidebar'] = 'parents/parent_sidebar';
        $data['topnavigation'] = 'parents/parent_topnavigation';
        $data['content'] = 'parents/parent_reportcard_finalterm_view';
        $this->load->view($this->template, $data);
    }
    public function parent_course()
    {
        $data['title'] = 'SMS';
        $data['sidebar'] = 'parents/parent_sidebar';
        $data['topnavigation'] = 'parents/parent_topnavigation';
        $data['content'] = 'parents/parent_course_view';
        $this->load->view($this->template, $data);
    }
    public function coursePlan()
    {
        $data['title'] = 'SMS';
        $data['sidebar'] = 'parents/parent_sidebar';
        $data['topnavigation'] = 'parents/parent_topnavigation';
        $data['content'] = 'parents/parent_course_plan_view';
        $this->load->view($this->template, $data);
    }
    public function courseImplementation()
    {
        $data['title'] = 'SMS';
        $data['sidebar'] = 'parents/parent_sidebar';
        $data['topnavigation'] = 'parents/parent_topnavigation';
        $data['content'] = 'parents/parent_course_implementation_view';
        $this->load->view($this->template, $data);
    }
    public function courseMaterial()
    {
        $data['title'] = 'SMS';
        $data['sidebar'] = 'parents/parent_sidebar';
        $data['topnavigation'] = 'parents/parent_topnavigation';
        $data['content'] = 'parents/parent_course_material_view';
        $this->load->view($this->template, $data);
    }
    public function courseAssignmentQuiz()
    {
        $data['title'] = 'SMS';
        $data['sidebar'] = 'parents/parent_sidebar';
        $data['topnavigation'] = 'parents/parent_topnavigation';
        $data['content'] = 'parents/parent_course_assignment_quiz_view';
        $this->load->view($this->template, $data);
    }
    public function coursePerformance()
    {
        $data['title'] = 'SMS';
        $data['sidebar'] = 'parents/parent_sidebar';
        $data['topnavigation'] = 'parents/parent_topnavigation';
        $data['content'] = 'parents/parent_course_performance_view';
        $this->load->view($this->template, $data);
    }
    public function classScheduleView()
    {
        $data['title'] = 'SMS';
        $data['sidebar'] = 'parents/parent_sidebar';
        $data['topnavigation'] = 'parents/parent_topnavigation';
        $data['content'] = 'includes/class_schedule_view';
        $this->load->view($this->template, $data);
    }
    public function examScheduleView()
    {
        $data['title'] = 'SMS';
        $data['sidebar'] = 'parents/parent_sidebar';
        $data['topnavigation'] = 'parents/parent_topnavigation';
        $data['content'] = 'includes/exam_schedule_view';
        $this->load->view($this->template, $data);
    }
    public function parent_profile()
    {
        $data['title'] = 'SMS';
        $data['sidebar'] = 'parents/parent_sidebar';
        $data['topnavigation'] = 'parents/parent_topnavigation';
        $data['content'] = 'parents/parent_profile_view';
        $data['parent'] = $this->Parent_model->getProfileDataByID($this->nativesession->get('id'));
        $this->load->view($this->template, $data);
    }
    public function profile_edit($id)
    {
        $id = $this->general->decryptParaID($id, 'parent');
        if($this->nativesession->get('id') != $id){
            $this->nativesession->set('error', 'Access Denied');
            redirect('parent/home');
        }

        $this->form_validation->set_rules('firstname', 'firstname', 'required');
        $this->form_validation->set_rules('lastname', 'lastname', 'required');
        $this->form_validation->set_rules('gender', 'gender', 'required');
        $this->form_validation->set_rules('phone', 'phone', 'required');
        $this->form_validation->set_rules('phoneoverseas', 'phone overseas', 'required');
        $this->form_validation->set_rules('mobile', 'mobile', 'required');
        $this->form_validation->set_rules('mobileoverseas', 'mobile overseas', 'required');
        $this->form_validation->set_rules('email', 'email', 'required|valid_email');
        $this->form_validation->set_rules('address', 'address', 'required');
        $this->form_validation->set_rules('addressoverseas', 'address overseas', 'required');
        $this->form_validation->set_rules('passportno', 'passport no', 'required');
        $this->form_validation->set_rules('passportcountry', 'passport country', 'required');
        $this->form_validation->set_rules('passportexp', 'passport exp', 'required');
        $parentid = $this->input->post('parentid');
//        $this->form_validation->set_rules('undergraduate', 'undergraduate', 'required');
//        $this->form_validation->set_rules('graduate', 'graduate', 'required');
//        $this->form_validation->set_rules('postgraduate', 'postgraduate', 'required');
//        $this->form_validation->set_rules('experience', 'working experience', 'required');

        if ($this->input->post('password')):
            $this->form_validation->set_rules('password', 'password', 'required');
            $this->form_validation->set_rules('confirmpassword', 'confirm password', 'required|matches[password]');
        endif;

        $this->form_validation->set_error_delimiters('', '<br/>');

        if ($this->form_validation->run() == TRUE) {
            if ($_FILES['photo']['error'] != 4) {
                $config['upload_path'] = $this->profilephotopath;
                $config['allowed_types'] = "jpg|jpeg|png";
                $config['max_size'] = 200000;
                $config['overwrite'] = TRUE;
                $config['file_name'] = $parentid;
                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('photo')) {

                    $this->nativesession->set('error', $this->upload->display_errors());
                    redirect(current_url());
                } else {
                    $data = $this->upload->data();
                    $config_image = array(
                        'image_library' => 'gd2',
                        'source_image' => $this->profilephotopath.'/'.$data['orig_name'],
                        'new_image' => $this->profilephotopath.'/'.$data['orig_name'],
                        'width' => 1240,
                        'maintain_ratio' => TRUE,
                        'rotate_by_exif' => TRUE,
//                'strip_exif' => TRUE,
                    );
                    $this->load->library('image_lib', $config_image);
                    $this->image_lib->resize();

                    $filename = $data['orig_name'];
                    if ($this->Parent_model->editProfilePhoto($parentid, $filename)) {
                    } else {
                        $this->nativesession->set('error', 'Upload Photo Failed, try again !');
                        redirect(current_url());
                    }
                }
            }
            $this->Parent_model->editProfile($parentid);
            $this->nativesession->set('success', 'Profile saved');
            $eid = $this->general->encryptParaID($id, 'parent');
            redirect('parents/parent_profile/'.$eid);
        }

        $data['title'] = 'SMS';
        $data['sidebar'] = 'parents/parent_sidebar';
        $data['topnavigation'] = 'parents/parent_topnavigation';
        $data['content'] = 'parents/parent_profile_edit_view';
        $data['parent'] = $this->Parent_model->getProfileDataByID($id);
        $this->load->view($this->template, $data);
    }
    public function parent_download()
    {
        $data['title'] = 'SMS';
        $data['sidebar'] = 'parents/parent_sidebar';
        $data['topnavigation'] = 'parents/parent_topnavigation';
        $data['content'] = 'parents/parent_download_view';
        $this->load->view($this->template, $data);
    }
    public function parent_correspond()
    {
        $data['title'] = 'SMS';
        $data['sidebar'] = 'parents/parent_sidebar';
        $data['topnavigation'] = 'parents/parent_topnavigation';
        $data['content'] = 'parents/parent_correspond_view';
        $this->load->view($this->template, $data);
    }
    public function payment_status()
    {
        $data['title'] = 'SMS';
        $data['sidebar'] = 'parents/parent_sidebar';
        $data['topnavigation'] = 'parents/parent_topnavigation';
        $data['content'] = 'parents/payment_status_view';
        $this->load->view($this->template, $data);
    }
    public function payment_receipt()
    {
        $data['title'] = 'SMS';
        $data['sidebar'] = 'parents/parent_sidebar';
        $data['topnavigation'] = 'parents/parent_topnavigation';
        $data['content'] = 'parents/payment_receipt_view';
        $this->load->view($this->template, $data);
    }
    public function choose_child($id)
    {
        $id = $this->general->decryptParaID($id, 'student');
        $this->nativesession->set( 'current_child_id', $id);
        $childs = $this->Parent_model->getChild($id);
        $this->nativesession->set( 'current_child_name', $childs['firstname'].' '.$childs['lastname'] );
        redirect($_SERVER['HTTP_REFERER']);
    }
    public function logout(){
        $this->nativesession->delete('id');
        $this->nativesession->delete('name');
        $this->nativesession->delete('photo');
        $this->nativesession->delete('lastlogin');
        $this->nativesession->delete('is_login');
        redirect('');
    }
}