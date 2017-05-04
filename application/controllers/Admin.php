<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class admin extends CI_Controller {

    var $template = 'template';
    var $profilephotopath = 'assets/img/admin/';
    var $profilestudentphotopath = 'assets/img/student/';
    var $profileparentphotopath = 'assets/img/parents/profile/';
    var $eventimagepath = 'assets/img/texteditor/';

    function __construct() {
        parent::__construct();
        $this->general->AdminLogin();
        $this->load->model('Admin_model');
        $this->load->model('Student_model');
        $this->load->model('Parent_model');
    }

    public function home()
    {
        $data['title'] = 'School Administrator SMS';
        $data['admin'] = $this->Admin_model->getProfileDataByID($this->nativesession->get('id'));
        $data['sidebar'] = 'admin/admin_sidebar';
        $data['topnavigation'] = 'admin/admin_topnavigation';
        $data['events'] = $this->Admin_model->getAllEvents($this->nativesession->get('id'));
        $data['content'] = 'admin/admin_home_view';
        $this->load->view($this->template, $data);
    }

    public function allStudents() {
        $data['title'] = 'SIMS';
        $data['admin'] = $this->Admin_model->getProfileDataByID($this->nativesession->get('id'));
        $data['students'] = $this->Student_model->getAllStudent();
        $data['topnavigation'] = 'admin/admin_topnavigation';
        $data['sidebar'] = 'admin/admin_sidebar';
        $data['content'] = 'admin/admin_all_students_view';
        $this->load->view($this->template, $data);
    }

    public function deleteStudent($id){
        if($this->general->checkPrivilege($this->nativesession->get('role'), 'p0018') != 1){
            $this->nativesession->set('error', 'Access Denied');
            redirect('admin/home');
        }
        $id = $this->general->decryptParaID($id, 'student');
        if($this->Student_model->deactivateStudent($id)){
            $this->nativesession->set('success', 'Student Deleted');
        }
//        else{
//            $this->nativesession->set('error', 'Failed to Delete Student');
//        }
        redirect('admin/allStudents');
    }

    public function editStudent($stid){
        if($this->general->checkPrivilege($this->nativesession->get('role'), 'p0003') != 1){
            $this->nativesession->set('error', 'Access Denied');
            redirect('admin/home');
        }
        $id = $this->general->decryptParaID($stid, 'student');
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
        $studentid = $this->input->post('studentid');

        $this->form_validation->set_error_delimiters('', '<br/>');

        if ($this->form_validation->run() == TRUE) {
            if ($_FILES['photo']['error'] != 4) {
                $config['upload_path'] = $this->profilestudentphotopath;
                $config['allowed_types'] = "jpg|jpeg|png|JPG|JPEG|PNG";
                $config['max_size'] = 200000;
                $config['overwrite'] = TRUE;
                $config['file_name'] = $studentid;
                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('photo')) {
                    $this->nativesession->set('error', $this->upload->display_errors());
                    redirect(current_url());
                } else {
                    $data = $this->upload->data();
                    $config_image = array(
                        'image_library' => 'gd2',
                        'source_image' => $this->profilestudentphotopath.'/'.$data['orig_name'],
                        'new_image' => $this->profilestudentphotopath.'/'.$data['orig_name'],
                        'width' => 1240,
                        'maintain_ratio' => TRUE,
                        'rotate_by_exif' => TRUE,
//                'strip_exif' => TRUE,
                    );
                    $this->load->library('image_lib', $config_image);
                    $this->image_lib->resize();

                    $filename = $data['orig_name'];
                    if ($this->Student_model->editProfilePhoto($studentid, $filename)) {
                    } else {
                        $this->nativesession->set('error', 'Upload Photo Failed, try again !');
                        redirect(current_url());
                    }
                }
            }

            $this->Student_model->editProfile($studentid);
            $this->nativesession->set('success', 'Profile saved');
            $eid = $this->general->encryptParaID($id, 'student');
            redirect('admin/editStudent/'.$eid);
        }

        $data['title'] = 'SMS';
        $data['student']  = $this->Student_model->getProfileDataByID($id);
        $data['admin'] = $this->Admin_model->getProfileDataByID($this->nativesession->get('id'));
        $data['sidebar'] = 'admin/admin_sidebar';
        $data['topnavigation'] = 'admin/admin_topnavigation';
        $data['content'] = 'admin/admin_edit_student_view';
        $this->load->view($this->template, $data);
    }

    public function addStudent(){
        if($this->general->checkPrivilege($this->nativesession->get('role'), 'p0002') != 1){
            $this->nativesession->set('error', 'Access Denied');
            redirect('admin/home');
        }

        $laststudentdid = $this->Student_model->getLatestID();
        foreach ($laststudentdid as $lastid) {
            $value = $value = substr($lastid,1) + 1;
        }

        if($value < 10) {
            $newstudentid= 'm000'.$value;
        } else if ($value>=10 and $value<100) {
            $newstudentid= 'm00'.$value;
        } else if ($value>=100 and $value<1000) {
            $newstudentid = 'm0' . $value;
        } else if ($value>=1000 and $value<10000) {
            $newstudentid = 'm' . $value;
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

        $this->form_validation->set_error_delimiters('', '<br/>');

        if ($this->form_validation->run() == TRUE) {
            $this->Student_model->addStudent($newstudentid);
            if ($_FILES['photo']['error'] != 4) {
                $config['upload_path'] = $this->profilestudentphotopath;
                $config['allowed_types'] = "jpg|jpeg|png|JPG|JPEG|PNG";
                $config['max_size'] = 200000;
                $config['overwrite'] = TRUE;
                $config['file_name'] = $newstudentid;
                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('photo')) {

                    $this->nativesession->set('error', $this->upload->display_errors());
                    redirect(current_url());
                } else {
                    $data = $this->upload->data();
                    $config_image = array(
                        'image_library' => 'gd2',
                        'source_image' => $this->profilestudentphotopath.'/'.$data['orig_name'],
                        'new_image' => $this->profilestudentphotopath.'/'.$data['orig_name'],
                        'width' => 1240,
                        'maintain_ratio' => TRUE,
                        'rotate_by_exif' => TRUE,
//                'strip_exif' => TRUE,
                    );
                    $this->load->library('image_lib', $config_image);
                    $this->image_lib->resize();

                    $filename = $data['orig_name'];
                    if ($this->Student_model->editProfilePhoto($newstudentid, $filename)) {
                        $this->nativesession->set('success', 'Photo Changed');
                    } else {
                        $this->nativesession->set('error', 'Upload Photo Failed, try again !');
                        redirect(current_url());
                    }
                }
            }
            $this->nativesession->set('success', 'New Student Added');
            $eid = $this->general->encryptParaID($newstudentid, 'student');
            redirect('admin/editStudent/'.$eid);
        }

        $data['title'] = 'School Administrator SMS';
        $data['admin'] = $this->Admin_model->getProfileDataByID($this->nativesession->get('id'));
        $data['sidebar'] = 'admin/admin_sidebar';
        $data['topnavigation'] = 'admin/admin_topnavigation';
        $data['newstudentid'] = $newstudentid;
        $data['content'] = 'admin/admin_add_student_view';
        $this->load->view($this->template, $data);
    }

    public function allParents() {
        $data['title'] = 'SIMS';
        $data['admin'] = $this->Admin_model->getProfileDataByID($this->nativesession->get('id'));
        $data['parents'] = $this->Admin_model->getAllParents();
        $data['topnavigation'] = 'admin/admin_topnavigation';
        $data['sidebar'] = 'admin/admin_sidebar';
        $data['content'] = 'admin/admin_all_parents_view';
        $this->load->view($this->template, $data);
    }

    public function editParent($stid){
        if($this->general->checkPrivilege($this->nativesession->get('role'), 'p0016') != 1){
            $this->nativesession->set('error', 'Access Denied');
            redirect('admin/home');
        }
        $id = $this->general->decryptParaID($stid, 'parent');
        $this->form_validation->set_rules('firstname', 'firstname', 'required');
        $this->form_validation->set_rules('lastname', 'lastname', 'required');
        $this->form_validation->set_rules('gender', 'gender', 'required');
        $this->form_validation->set_rules('phone', 'phone', 'required');
        $this->form_validation->set_rules('email', 'email', 'required|valid_email');
        $this->form_validation->set_rules('address', 'address', 'required');
//        $this->form_validation->set_rules('dateofbirth', 'date of birth', 'required');
//        $this->form_validation->set_rules('placeofbirth', 'place of birth', 'required');
//        $this->form_validation->set_rules('religion', 'religion', 'required');
        $parentid = $this->input->post('parentid');

        $this->form_validation->set_error_delimiters('', '<br/>');

        if ($this->form_validation->run() == TRUE) {
            if ($_FILES['photo']['error'] != 4) {
                $config['upload_path'] = $this->profileparentphotopath;
                $config['allowed_types'] = "jpg|jpeg|png|JPG|JPEG|PNG";
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
                        'source_image' => $this->profileparentphotopath.'/'.$data['orig_name'],
                        'new_image' => $this->profileparentphotopath.'/'.$data['orig_name'],
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
            redirect('admin/editParent/'.$eid);
        }

        $data['title'] = 'SMS';
        $data['parent']  = $this->Parent_model->getProfileDataByID($id);
        $data['admin'] = $this->Admin_model->getProfileDataByID($this->nativesession->get('id'));
        $data['sidebar'] = 'admin/admin_sidebar';
        $data['topnavigation'] = 'admin/admin_topnavigation';
        $data['content'] = 'admin/admin_edit_parents_view';
        $this->load->view($this->template, $data);
    }

    public function addParent(){
        if($this->general->checkPrivilege($this->nativesession->get('role'), 'p0015') != 1){
            $this->nativesession->set('error', 'Access Denied');
            redirect('admin/home');
        }

        $lastparentdid = $this->Admin_model->getParentLatestID();
        foreach ($lastparentdid as $lastid) {
            $value = $value = substr($lastid,1) + 1;
        }

        if($value < 10) {
            $newsparentid= 'p000'.$value;
        } else if ($value>=10 and $value<100) {
            $newsparentid= 'p00'.$value;
        } else if ($value>=100 and $value<1000) {
            $newsparentid = 'p0' . $value;
        } else if ($value>=1000 and $value<10000) {
            $newsparentid = 'p' . $value;
        }

        $this->form_validation->set_rules('firstname', 'firstname', 'required');
        $this->form_validation->set_rules('lastname', 'lastname', 'required');
        $this->form_validation->set_rules('gender', 'gender', 'required');
        $this->form_validation->set_rules('phone', 'phone', 'required');
        $this->form_validation->set_rules('email', 'email', 'required|valid_email');
        $this->form_validation->set_rules('address', 'address', 'required');
//        $this->form_validation->set_rules('dateofbirth', 'date of birth', 'required');
//        $this->form_validation->set_rules('placeofbirth', 'place of birth', 'required');
//        $this->form_validation->set_rules('religion', 'religion', 'required');

        $this->form_validation->set_error_delimiters('', '<br/>');

        if ($this->form_validation->run() == TRUE) {
            $this->Parent_model->addParent($newsparentid);
            if ($_FILES['photo']['error'] != 4) {
                $config['upload_path'] = $this->profileparentphotopath;
                $config['allowed_types'] = "jpg|jpeg|png|JPG|JPEG|PNG";
                $config['max_size'] = 200000;
                $config['overwrite'] = TRUE;
                $config['file_name'] = $newsparentid;
                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('photo')) {

                    $this->nativesession->set('error', $this->upload->display_errors());
                    redirect(current_url());
                } else {
                    $data = $this->upload->data();
                    $config_image = array(
                        'image_library' => 'gd2',
                        'source_image' => $this->profileparentphotopath.'/'.$data['orig_name'],
                        'new_image' => $this->profileparentphotopath.'/'.$data['orig_name'],
                        'width' => 1240,
                        'maintain_ratio' => TRUE,
                        'rotate_by_exif' => TRUE,
//                'strip_exif' => TRUE,
                    );
                    $this->load->library('image_lib', $config_image);
                    $this->image_lib->resize();

                    $filename = $data['orig_name'];
                    if ($this->Parent_model->editProfilePhoto($newsparentid, $filename)) {
                        $this->nativesession->set('success', 'Photo Changed');
                    } else {
                        $this->nativesession->set('error', 'Upload Photo Failed, try again !');
                        redirect(current_url());
                    }
                }
            }
            $this->nativesession->set('success', 'New Parent Added');
            $eid = $this->general->encryptParaID($newsparentid, 'parent');
            redirect('admin/editParent/'.$eid);
        }

        $data['title'] = 'School Administrator SMS';
        $data['admin'] = $this->Admin_model->getProfileDataByID($this->nativesession->get('id'));
        $data['sidebar'] = 'admin/admin_sidebar';
        $data['topnavigation'] = 'admin/admin_topnavigation';
        $data['newparentid'] = $newsparentid;
        $data['content'] = 'admin/admin_add_parent_view';
        $this->load->view($this->template, $data);
    }
//    public function student_profile($id)
//    {
//        $id = $this->general->decryptParaID($id, 'student');
//        $data['title'] = 'Student LMS';
//        $data['sidebar'] = 'student/student_sidebar';
//        $data['student']  = $this->Student_model->getProfileDataByID($this->nativesession->get('id'));
//        $data['topnavigation'] = 'student/student_topnavigation';
//        $data['content'] = 'student/student_profile_view';
//        $this->load->view($this->template, $data);
//    }


    public function logout(){
        $this->nativesession->delete('id');
        $this->nativesession->delete('name');
        $this->nativesession->delete('photo');
        $this->nativesession->delete('role');
        $this->nativesession->delete('lastlogin');
        $this->nativesession->delete('is_login');
        redirect('');
    }
}