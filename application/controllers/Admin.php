<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class admin extends CI_Controller {

    var $template = 'template';
    var $print_template = 'print_template';
    var $profilephotopath = 'assets/img/admin/';
    var $profilestudentphotopath = 'assets/img/student/';
    var $profileparentphotopath = 'assets/img/parents/profile/';
    var $profileadminphotopath = 'assets/img/admin/';
    var $profileteacherphotopath = 'assets/img/teacher/profile/';
    var $eventimagepath = 'assets/img/texteditor/';
    var $materialpath = 'assets/file/teacher/material/';

    function __construct() {
        parent::__construct();
        $this->general->AdminLogin();
        $this->load->model('Admin_model');
        $this->load->model('Student_model');
        $this->load->model('Parent_model');
        $this->load->model('Teacher_model');
    }

    public function home()
    {
        $data['title'] = 'School Administrator SMS';
        $data['admin'] = $this->Admin_model->getProfileDataByID($this->nativesession->get('id'));
        $data['classes']  = $this->Admin_model->getAllClass();
        $data['allcourses']  = $this->Admin_model->getAllCourses();
        $data['sidebar'] = 'admin/admin_sidebar';
        $data['topnavigation'] = 'admin/admin_topnavigation';
        $data['events'] = $this->Admin_model->getAllEvents($this->nativesession->get('id'));
        $data['content'] = 'admin/admin_home_view';
        $this->load->view($this->template, $data);
    }

    public function studentView()
    {
        $data['title'] = 'SMS';
        $data['admin'] = $this->Admin_model->getProfileDataByID($this->nativesession->get('id'));
        $data['classes']  = $this->Admin_model->getAllClass();
        $data['allcourses']  = $this->Admin_model->getAllCourses();
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
        else{
            $this->nativesession->set('error', 'Failed to Delete Student');
        }
        redirect('admin/studentView');
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

        if ($this->input->post('password')):
            $this->form_validation->set_rules('password', 'password', 'required');
            $this->form_validation->set_rules('confirmpassword', 'confirm password', 'required|matches[password]');
        endif;

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
        $data['allcourses']  = $this->Admin_model->getAllCourses();
        $data['classes']  = $this->Admin_model->getAllClass();
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
        $data['allcourses']  = $this->Admin_model->getAllCourses();
        $data['classes']  = $this->Admin_model->getAllClass();
        $data['sidebar'] = 'admin/admin_sidebar';
        $data['topnavigation'] = 'admin/admin_topnavigation';
        $data['newstudentid'] = $newstudentid;
        $data['content'] = 'admin/admin_add_student_view';
        $this->load->view($this->template, $data);
    }

    public function parentView() {
        $data['title'] = 'SIMS';
        $data['admin'] = $this->Admin_model->getProfileDataByID($this->nativesession->get('id'));
        $data['parents'] = $this->Admin_model->getAllParents();
        $data['parentschilds'] = $this->Admin_model->getAllParentsChild();
        $data['topnavigation'] = 'admin/admin_topnavigation';
        $data['allcourses']  = $this->Admin_model->getAllCourses();
        $data['classes']  = $this->Admin_model->getAllClass();
        $data['sidebar'] = 'admin/admin_sidebar';
        $data['content'] = 'admin/admin_all_parents_view';
        $this->load->view($this->template, $data);
    }

    public function deleteParent($id){
        if($this->general->checkPrivilege($this->nativesession->get('role'), 'p0016') != 1){
            $this->nativesession->set('error', 'Access Denied');
            redirect('admin/home');
        }
        $id = $this->general->decryptParaID($id, 'parent');
        if($this->Admin_model->deactivateParent($id)){
            $this->nativesession->set('success', 'Parent Deleted');
        }
        else{
            $this->nativesession->set('error', 'Failed to Delete Parent');
        }
        redirect('admin/parentView');
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


        if ($this->input->post('password')):
            $this->form_validation->set_rules('password', 'password', 'required');
            $this->form_validation->set_rules('confirmpassword', 'confirm password', 'required|matches[password]');
        endif;

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
        $data['allcourses']  = $this->Admin_model->getAllCourses();
        $data['classes']  = $this->Admin_model->getAllClass();
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
//        $this->form_validation->set_rules('phoneoverseas', 'phoneoverseas', 'required');
        $this->form_validation->set_rules('mobile', 'mobile', 'required');
//        $this->form_validation->set_rules('mobileoverseas', 'mobileoverseas', 'required');
        $this->form_validation->set_rules('address', 'address', 'required');
        $this->form_validation->set_rules('addressoverseas', 'addressoverseas', 'required');
        $this->form_validation->set_rules('email', 'email', 'required|valid_email');
        $this->form_validation->set_rules('passportno', 'passportno', 'required');
        $this->form_validation->set_rules('passportcountry', 'passportcountry', 'required');
        $this->form_validation->set_rules('passportexp', 'passportexp', 'required');
        $this->form_validation->set_rules('occupation', 'occupation', 'required');
        $this->form_validation->set_rules('companyname', 'companyname', 'required');
        $this->form_validation->set_rules('industry', 'industry', 'required');
        $this->form_validation->set_rules('phoneoffice', 'phoneoffice', 'required');

        $this->form_validation->set_error_delimiters('', '<br/>');

        if ($this->form_validation->run() == TRUE) {
            $this->Admin_model->addParent($newsparentid);
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
        $data['allcourses']  = $this->Admin_model->getAllCourses();
        $data['classes']  = $this->Admin_model->getAllClass();
        $data['sidebar'] = 'admin/admin_sidebar';
        $data['topnavigation'] = 'admin/admin_topnavigation';
        $data['newparentid'] = $newsparentid;
        $data['content'] = 'admin/admin_add_parentt_view';
        $this->load->view($this->template, $data);
    }

    public function allRoles() {
        $data['title'] = 'SIMS';
        $data['admin'] = $this->Admin_model->getProfileDataByID($this->nativesession->get('id'));
        $data['roles'] = $this->Admin_model->getAllRoles();
        $data['topnavigation'] = 'admin/admin_topnavigation';
        $data['allcourses']  = $this->Admin_model->getAllCourses();
        $data['classes']  = $this->Admin_model->getAllClass();
        $data['sidebar'] = 'admin/admin_sidebar';
        $data['content'] = 'admin/admin_all_roles_view';
        $this->load->view($this->template, $data);
    }

    public function deleteRole($id){
        if($this->general->checkPrivilege($this->nativesession->get('role'), 'p0023') != 1){
            $this->nativesession->set('error', 'Access Denied');
            redirect('admin/home');
        }
        $id = $this->general->decryptParaID($id, 'role');
        if($this->Admin_model->deleteRole($id)){
            $this->nativesession->set('success', 'Role Deleted');
        }
        else{
            $this->nativesession->set('error', 'Failed to Delete Role');
        }
        redirect('admin/allRoles');
    }

    public function editRole($stid){
        if($this->general->checkPrivilege($this->nativesession->get('role'), 'p0020') != 1){
            $this->nativesession->set('error', 'Access Denied');
            redirect('admin/home');
        }
        $id = $this->general->decryptParaID($stid, 'role');

        $this->form_validation->set_rules('rolename', 'rolename', 'required');
        $this->form_validation->set_rules('rolecategory', 'rolecategory', 'required');

        $roleid= $this->input->post('roleid');

        $this->form_validation->set_error_delimiters('', '<br/>');

        if ($this->form_validation->run() == TRUE) {
            $this->Admin_model->editRole($roleid);
            $this->nativesession->set('success', 'Role saved');
            $eid = $this->general->encryptParaID($id, 'role');
            redirect('admin/editRole/'.$eid);
        }

        $data['title'] = 'SMS';
        $data['role']  = $this->Admin_model->getRoleDataByID($id);
        $data['admin'] = $this->Admin_model->getProfileDataByID($this->nativesession->get('id'));
        $data['allcourses']  = $this->Admin_model->getAllCourses();
        $data['classes']  = $this->Admin_model->getAllClass();
        $data['sidebar'] = 'admin/admin_sidebar';
        $data['topnavigation'] = 'admin/admin_topnavigation';
        $data['content'] = 'admin/admin_edit_role_view';
        $this->load->view($this->template, $data);
    }

    public function addRole(){
        if($this->general->checkPrivilege($this->nativesession->get('role'), 'p0019') != 1){
            $this->nativesession->set('error', 'Access Denied');
            redirect('admin/home');
        }

        $lastroleid = $this->Admin_model->getRoleLatestID();
        foreach ($lastroleid as $lastid) {
            $value = $value = substr($lastid,1) + 1;
        }

        if($value < 10) {
            $newroleid = 'r000'.$value;
        } else if ($value>=10 and $value<100) {
            $newroleid = 'r00'.$value;
        } else if ($value>=100 and $value<1000) {
            $newroleid = 'r0' . $value;
        } else if ($value>=1000 and $value<10000) {
            $newroleid = 'r' . $value;
        }

        $this->form_validation->set_rules('rolename', 'rolename', 'required');
        $this->form_validation->set_rules('rolecategory', 'rolecategory', 'required');

        $this->form_validation->set_error_delimiters('', '<br/>');

        if ($this->form_validation->run() == TRUE) {
            $this->Admin_model->addRole($newroleid);

            $this->nativesession->set('success', 'New Role Added');
            $eid = $this->general->encryptParaID($newroleid, 'parent');
            redirect('admin/editRole/'.$eid);
        }

        $data['title'] = 'School Administrator SMS';
        $data['admin'] = $this->Admin_model->getProfileDataByID($this->nativesession->get('id'));
        $data['allcourses']  = $this->Admin_model->getAllCourses();
        $data['classes']  = $this->Admin_model->getAllClass();
        $data['sidebar'] = 'admin/admin_sidebar';
        $data['topnavigation'] = 'admin/admin_topnavigation';
        $data['newroleid'] = $newroleid;
        $data['content'] = 'admin/admin_add_role_view';
        $this->load->view($this->template, $data);
    }

    public function allAssignedPrivilege() {
        $data['title'] = 'SIMS';
        $data['admin'] = $this->Admin_model->getProfileDataByID($this->nativesession->get('id'));
        $data['assigned_roles'] = $this->Admin_model->getAssignedRole();
        $data['topnavigation'] = 'admin/admin_topnavigation';
        $data['allcourses']  = $this->Admin_model->getAllCourses();
        $data['classes']  = $this->Admin_model->getAllClass();
        $data['sidebar'] = 'admin/admin_sidebar';
        $data['content'] = 'admin/admin_all_assigned_privilege_view';
        $this->load->view($this->template, $data);
    }

    public function editAssignedPrivilege($stid){
        if($this->general->checkPrivilege($this->nativesession->get('role'), 'p0022') != 1){
            $this->nativesession->set('error', 'Access Denied');
            redirect('admin/home');
        }
        $id = $this->general->decryptParaID($stid, 'role');

        $this->form_validation->set_rules('roleassigned', 'roleassigned', 'required');
        $privilege_assigned= $this->input->post('privileges');

//
        $this->form_validation->set_error_delimiters('', '<br/>');

        if ($this->form_validation->run() == TRUE) {
            $this->Admin_model->deleteAssignedPrivilegeOfRole($id);

            for ($i=0; $i<sizeof($privilege_assigned); $i++) {

                $lastestid = $this->Admin_model->getAssignedLatestID();
                foreach ($lastestid as $lastid) {
                    $value = $value = substr($lastid,1) + 1;
                }

                if($value < 10) {
                    $newid = 'a000'.$value;
                } else if ($value>=10 and $value<100) {
                    $newid = 'a00'.$value;
                } else if ($value>=100 and $value<1000) {
                    $newid = 'a0' . $value;
                } else if ($value>=1000 and $value<10000) {
                    $newid = 'a' . $value;
                }

                $this->Admin_model->addAssignedPrivilege($newid ,$this->input->post('roleassigned'), $privilege_assigned[$i] );
            }

            $this->nativesession->set('success', 'Assigned Privilege saved');
            $eid = $this->general->encryptParaID($id, 'role');
            redirect('admin/editAssignedPrivilege/'.$eid);
        }

        $data['title'] = 'SMS';
        $data['assigned_role']  = $id;
        $data['privilege_assigned']  = $this->Admin_model->getAssignedPrivilegeDataByRole($id);
        $data['privileges']  = $this->Admin_model->getAllPrivileges();
        $data['roles']  = $this->Admin_model->getAllRoles();
        $data['admin'] = $this->Admin_model->getProfileDataByID($this->nativesession->get('id'));
        $data['allcourses']  = $this->Admin_model->getAllCourses();
        $data['classes']  = $this->Admin_model->getAllClass();
        $data['sidebar'] = 'admin/admin_sidebar';
        $data['topnavigation'] = 'admin/admin_topnavigation';
        $data['content'] = 'admin/admin_edit_assigned_privilege_view';
        $this->load->view($this->template, $data);
    }

    public function addAssignedPrivilege(){
        if($this->general->checkPrivilege($this->nativesession->get('role'), 'p0022') != 1){
            $this->nativesession->set('error', 'Access Denied');
            redirect('admin/home');
        }

        $this->form_validation->set_rules('roleassigned', 'roleassigned', 'required');
        $privilege_assigned= $this->input->post('privileges');

//
        $this->form_validation->set_error_delimiters('', '<br/>');

        if ($this->form_validation->run() == TRUE) {
            $roleAssigned = $this->input->post('roleassigned');
            for ($i=0; $i<sizeof($privilege_assigned); $i++) {

                $lastestid = $this->Admin_model->getAssignedLatestID();
                foreach ($lastestid as $lastid) {
                    $value = $value = substr($lastid,1) + 1;
                }

                if($value < 10) {
                    $newid = 'a000'.$value;
                } else if ($value>=10 and $value<100) {
                    $newid = 'a00'.$value;
                } else if ($value>=100 and $value<1000) {
                    $newid = 'a0' . $value;
                } else if ($value>=1000 and $value<10000) {
                    $newid = 'a' . $value;
                }

                $this->Admin_model->addAssignedPrivilege($newid ,$roleAssigned, $privilege_assigned[$i] );
            }

            $this->nativesession->set('success', 'Assigned Privilege saved');
            $eid = $this->general->encryptParaID($roleAssigned, 'role');
            redirect('admin/editAssignedPrivilege/'.$eid);
        }

        $data['title'] = 'SMS';
//        $data['assigned_role']  = $id;
//        $data['privilege_assigned']  = $this->Admin_model->getAssignedPrivilegeDataByRole($id);
        $data['privileges']  = $this->Admin_model->getAllPrivileges();
        $data['roles']  = $this->Admin_model->getNotAssignedRole();
        $data['admin'] = $this->Admin_model->getProfileDataByID($this->nativesession->get('id'));
        $data['allcourses']  = $this->Admin_model->getAllCourses();
        $data['classes']  = $this->Admin_model->getAllClass();
        $data['sidebar'] = 'admin/admin_sidebar';
        $data['topnavigation'] = 'admin/admin_topnavigation';
        $data['content'] = 'admin/admin_add_assigned_privilege_view';
        $this->load->view($this->template, $data);
    }

    public function deleteAssignedPrivilege($id){
        if($this->general->checkPrivilege($this->nativesession->get('role'), 'p0024') != 1){
            $this->nativesession->set('error', 'Access Denied');
            redirect('admin/home');
        }
        $id = $this->general->decryptParaID($id, 'role');
        if($this->Admin_model->deleteAssignedPrivilegeOfRole($id)){
            $this->nativesession->set('success', ' Assigned Privilege Deleted');
        }
        else{
            $this->nativesession->set('error', 'Failed to Delete Assigned Privilege');
        }
        redirect('admin/allAssignedPrivilege');
    }

    public function staffView() {
        $data['title'] = 'SIMS';
        $data['admin'] = $this->Admin_model->getProfileDataByID($this->nativesession->get('id'));
        $data['admins'] = $this->Admin_model->getAllAdministrator();
        $data['operators'] = "";
        $data['topnavigation'] = 'admin/admin_topnavigation';
        $data['allcourses']  = $this->Admin_model->getAllCourses();
        $data['classes']  = $this->Admin_model->getAllClass();
        $data['sidebar'] = 'admin/admin_sidebar';
        $data['content'] = 'admin/admin_all_staff_view';
        $this->load->view($this->template, $data);
    }

    public function addStaff(){
        if($this->general->checkPrivilege($this->nativesession->get('role'), 'p0002') != 1){
            $this->nativesession->set('error', 'Access Denied');
            redirect('admin/home');
        }

        if($this->input->post('role')=='operator') {
            $lastparentid = $this->Parent_model->getLatestID();
            foreach ($lastparentid as $lastid) {
                $value = $value = substr($lastid,1) + 1;

                if($value < 10) {
                    $newid= 'p000'.$value;
                } else if ($value>=10 and $value<100) {
                    $newid= 'p00'.$value;
                } else if ($value>=100 and $value<1000) {
                    $newid = 'p0' . $value;
                } else if ($value>=1000 and $value<10000) {
                    $newid = 'p' . $value;
                }
            }
        } else {
            $lastadminid = $this->Admin_model->getLatestID();
            foreach ($lastadminid as $lastid) {
                $value = $value = substr($lastid,1) + 1;
            }

            if($value < 10) {
                $newid= 'd000'.$value;
            } else if ($value>=10 and $value<100) {
                $newid= 'd00'.$value;
            } else if ($value>=100 and $value<1000) {
                $newid= 'd0' . $value;
            } else if ($value>=1000 and $value<10000) {
                $newid= 'd' . $value;
            }

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
        $this->form_validation->set_rules('experience', 'experience', 'required');

        $this->form_validation->set_error_delimiters('', '<br/>');

        if ($this->form_validation->run() == TRUE) {
            if($this->input->post('role')=='operator') {

            } else {
                $this->Admin_model->addAdmin($newid);
                if ($_FILES['photo']['error'] != 4) {
                    $config['upload_path'] = $this->profileadminphotopath;
                    $config['allowed_types'] = "jpg|jpeg|png|JPG|JPEG|PNG";
                    $config['max_size'] = 200000;
                    $config['overwrite'] = TRUE;
                    $config['file_name'] = $newid;
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
                        if ($this->Admin_model->editProfilePhoto($newid, $filename)) {
                            $this->nativesession->set('success', 'Photo Changed');
                        } else {
                            $this->nativesession->set('error', 'Upload Photo Failed, try again !');
                            redirect(current_url());
                        }
                    }
                }

                $this->nativesession->set('success', 'New Staff Added');
                $eid = $this->general->encryptParaID($newid, 'admin');
            }

//            $eid = $this->general->encryptParaID($newstudentid, 'student');
            redirect('admin/editAdmin/'.$eid);
        }

        $data['title'] = 'SMS';
//        $data['parent']  = $this->Parent_model->getProfileDataByID($id);
        $data['admin'] = $this->Admin_model->getProfileDataByID($this->nativesession->get('id'));
        $data['allcourses']  = $this->Admin_model->getAllCourses();
        $data['classes']  = $this->Admin_model->getAllClass();
        $data['roles'] = $this->Admin_model->getAllRoles();
        $data['sidebar'] = 'admin/admin_sidebar';
        $data['topnavigation'] = 'admin/admin_topnavigation';
        $data['content'] = 'admin/admin_add_staff_view';
        $this->load->view($this->template, $data);
    }

    public function deleteAdmin($id){
        $did = $this->general->decryptParaID($id,'admin');

        if($this->general->checkPrivilege($this->nativesession->get('role'), 'p0030') != 1){
            $this->nativesession->set('error', 'Access Denied');
            redirect('admin/home');
        }

        if($this->Admin_model->deleteAdmin($did)){
            $this->nativesession->set('success', 'Staff Deleted');
        }
        else{
            $this->nativesession->set('error', 'Failed to Delete Staff');
        }
        redirect('admin/staffView');
    }

    public function editAdmin($stid){
        if($this->general->checkPrivilege($this->nativesession->get('role'), 'p0029') != 1){
            $this->nativesession->set('error', 'Access Denied');
            redirect('admin/home');
        }
        $id = $this->general->decryptParaID($stid, 'admin');
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
        $adminid = $this->input->post('adminid');

        if ($this->input->post('password')):
            $this->form_validation->set_rules('password', 'password', 'required');
            $this->form_validation->set_rules('confirmpassword', 'confirm password', 'required|matches[password]');
        endif;

        $this->form_validation->set_error_delimiters('', '<br/>');


        if ($this->form_validation->run() == TRUE) {
            if ($_FILES['photo']['error'] != 4) {
                $config['upload_path'] = $this->profileadminphotopath;
                $config['allowed_types'] = "jpg|jpeg|png";
                $config['max_size'] = 200000;
                $config['overwrite'] = TRUE;
                $config['file_name'] = $adminid;
                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('photo')) {

                    $this->nativesession->set('error', $this->upload->display_errors());
                    redirect(current_url());
                } else {
                    $data = $this->upload->data();
                    $config_image = array(
                        'image_library' => 'gd2',
                        'source_image' => $this->profileadminphotopath.'/'.$data['orig_name'],
                        'new_image' => $this->profileadminphotopath.'/'.$data['orig_name'],
                        'width' => 1240,
                        'maintain_ratio' => TRUE,
                        'rotate_by_exif' => TRUE,
//                'strip_exif' => TRUE,
                    );
                    $this->load->library('image_lib', $config_image);
                    $this->image_lib->resize();

                    $filename = $data['orig_name'];
                    if ($this->Admin_model->editProfilePhoto($adminid, $filename)) {
                    } else {
                        $this->nativesession->set('error', 'Upload Photo Failed, try again !');
                        redirect(current_url());
                    }
                }
            }

            $availabletime = '';
            $workinghour = $this->input->post('workinghour');
            for($i=0;$i<sizeof($workinghour);$i++)
            {
                $availabletime = $availabletime.'|'.$workinghour[$i];
            }
//            $this->Teacher_model->editRole($teacherid);
            $this->Admin_model->editProfile($adminid, $availabletime);
            $this->nativesession->set('success', 'Profile saved');

//            $eid = $this->general->encryptParaID($id, 'admin');
            redirect('admin/editAdmin/'.$stid);
        }

        $data['title'] = 'SMS';
        $data['parent']  = $this->Parent_model->getProfileDataByID($id);
        $data['admin'] = $this->Admin_model->getProfileDataByID($this->nativesession->get('id'));
        $data['info_db'] = $this->Admin_model->getProfileDataByID($id);
        $data['roles'] = $this->Admin_model->getAllRoles();
        $data['allcourses']  = $this->Admin_model->getAllCourses();
        $data['classes']  = $this->Admin_model->getAllClass();
        $data['sidebar'] = 'admin/admin_sidebar';
        $data['topnavigation'] = 'admin/admin_topnavigation';
        $data['content'] = 'admin/admin_edit_admin_view';
        $this->load->view($this->template, $data);
    }

    public function deleteOperator($id){
        $did = $this->general->decryptParaID($id,'operator');

        if($this->general->checkPrivilege($this->nativesession->get('role'), 'p0027') != 1){
            $this->nativesession->set('error', 'Access Denied');
            redirect('admin/home');
        }

        if($this->Admin_model->deleteOperator($did)){
            $this->nativesession->set('success', 'Staff Deleted');
        }
        else{
            $this->nativesession->set('error', 'Failed to Delete Staff');
        }
        redirect('admin/staffView');
    }

    public function TeacherView() {
        $teachers = $this->Teacher_model->getAllTeacher();
        $i = 0;
        $j = 0;
        foreach ($teachers as $teacher) {
            if($found = $this->Teacher_model->checkTeacherHomeroom($teacher['teacherid'])){
                $twh[$i]['teacherid'] = $teacher['teacherid'];
                $twh[$i]['photo'] = $teacher['photo'];
                $twh[$i]['firstname'] = $teacher['firstname'];
                $twh[$i]['lastname'] = $teacher['lastname'];
                $twh[$i]['phone'] = $teacher['phone'];
                $twh[$i]['email'] = $teacher['email'];
                $twh[$i]['address'] = $teacher['address'];
                $twh[$i]['classroom'] = $found['classroom'];
                $i++;
            }
            else{
                $th[$j]['teacherid'] = $teacher['teacherid'];
                $th[$j]['photo'] = $teacher['photo'];
                $th[$j]['firstname'] = $teacher['firstname'];
                $th[$j]['lastname'] = $teacher['lastname'];
                $th[$j]['phone'] = $teacher['phone'];
                $th[$j]['email'] = $teacher['email'];
                $th[$j]['address'] = $teacher['address'];
                $j++;
            }
        }
        $data['teachers'] = $twh;
        $data['teachersWithoutHomeroom'] =  $th;

        $data['title'] = 'SIMS';
        $data['admin'] = $this->Admin_model->getProfileDataByID($this->nativesession->get('id'));
        $data['allcourses']  = $this->Admin_model->getAllCourses();
        $data['classes']  = $this->Admin_model->getAllClass();
        $data['topnavigation'] = 'admin/admin_topnavigation';
        $data['sidebar'] = 'admin/admin_sidebar';
        $data['content'] = 'admin/admin_all_teacher_view';
        $this->load->view($this->template, $data);
    }

    public function deleteTeacher($id){
        if($this->general->checkPrivilege($this->nativesession->get('role'), 'p0005') != 1){
            $this->nativesession->set('error', 'Access Denied');
            redirect('admin/home');
        }
        $id = $this->general->decryptParaID($id, 'teacher');
        if($this->Teacher_model->deleteTeacher($id)){
            $this->nativesession->set('success', 'Teacher Deleted');
        }
        else{
            $this->nativesession->set('error', 'Failed to Delete Teacher');
        }
        redirect('admin/teacherView');
    }

    public function editTeacher($id)
    {
        if($this->general->checkPrivilege($this->nativesession->get('role'), 'p0005') != 1){
            $this->nativesession->set('error', 'Access Denied');
            redirect('teacher/home');
        }
        $id = $this->general->decryptParaID($id, 'teacher');
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
        $teacherid = $this->input->post('teacherid');
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
                $config['upload_path'] = $this->profileteacherphotopath;
                $config['allowed_types'] = "jpg|jpeg|png";
                $config['max_size'] = 200000;
                $config['overwrite'] = TRUE;
                $config['file_name'] = $teacherid;
                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('photo')) {

                    $this->nativesession->set('error', $this->upload->display_errors());
                    redirect(current_url());
                } else {
                    $data = $this->upload->data();
                    $config_image = array(
                        'image_library' => 'gd2',
                        'source_image' => $this->profileteacherphotopath.'/'.$data['orig_name'],
                        'new_image' => $this->profileteacherphotopath.'/'.$data['orig_name'],
                        'width' => 1240,
                        'maintain_ratio' => TRUE,
                        'rotate_by_exif' => TRUE,
//                'strip_exif' => TRUE,
                    );
                    $this->load->library('image_lib', $config_image);
                    $this->image_lib->resize();

                    $filename = $data['orig_name'];
                    if ($this->Teacher_model->editProfilePhoto($teacherid, $filename)) {
                    } else {
                        $this->nativesession->set('error', 'Upload Photo Failed, try again !');
                        redirect(current_url());
                    }
                }
            }

            $availabletime = '';
            $workinghour = $this->input->post('workinghour');
            for($i=0;$i<sizeof($workinghour);$i++)
            {
                $availabletime = $availabletime.'|'.$workinghour[$i];
            }
            $this->Teacher_model->editRole($teacherid);
            $this->Teacher_model->editProfile($teacherid, $availabletime);
            $this->nativesession->set('success', 'Profile saved');
            $eid = $this->general->encryptParaID($id, 'teacher');
            redirect('admin/editTeacher/'.$eid);
        }

        $data['title'] = 'SIMS';
        $data['admin'] = $this->Admin_model->getProfileDataByID($this->nativesession->get('id'));

        $data['topnavigation'] = 'admin/admin_topnavigation';
        $data['sidebar'] = 'admin/admin_sidebar';
        $data['content'] = 'admin/admin_edit_teacher_view';
        $data['allcourses']  = $this->Admin_model->getAllCourses();
        $data['classes']  = $this->Admin_model->getAllClass();
        $data['day'] = $this->Teacher_model->getSetting('s0005');
        $data['period'] = $this->Teacher_model->getSetting('s0006');
        $data['hour'] = $this->Teacher_model->getSetting('s0007');
        $data['starttime'] = $this->Teacher_model->getSetting('s0008');
        $data['breakstarttime'] = $this->Teacher_model->getSetting('s0009');
        $data['breaktime'] = $this->Teacher_model->getSetting('s0011');
        $data['lunchstarttime'] = $this->Teacher_model->getSetting('s0010');
        $data['lunchtime'] = $this->Teacher_model->getSetting('s0012');
        $data['rolechoice'] = $this->Teacher_model->getRoleCategory(1);

        $data['info_db'] = $this->Teacher_model->getProfileDataByID($id);
        $this->load->view($this->template, $data);
    }

    public function addTeacher(){
        if($this->general->checkPrivilege($this->nativesession->get('role'), 'p0004') != 1){
            $this->nativesession->set('error', 'Access Denied');
            redirect('teacher/home');
        }
//        $this->form_validation->set_rules('password', 'password', 'required');
//        $this->form_validation->set_rules('confirmpassword', 'confirm password', 'required|matches[password]');
        $this->form_validation->set_rules('role', 'role', 'required');
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
        $this->form_validation->set_rules('experience', 'experience', 'required');

        $this->form_validation->set_error_delimiters('', '<br/>');

        if ($this->form_validation->run() == TRUE) {
            $availabletime = '';
            $workinghour = $this->input->post('workinghour');
            for($i=0;$i<sizeof($workinghour);$i++)
            {
                $availabletime = $availabletime.'|'.$workinghour[$i];
            }

            $latestID = $this->Teacher_model->getLatestID();
            $latestID = $latestID['teacherid'];
            $latestID = substr($latestID, 1);
            $teacherID = 't'.str_pad((int) $latestID+1, 4, "0", STR_PAD_LEFT);
            $this->Teacher_model->addTeacher($teacherID, $availabletime);
            if ($_FILES['photo']['error'] != 4) {
                $config['upload_path'] = $this->profileteacherphotopath;
                $config['allowed_types'] = "jpg|jpeg|png";
                $config['max_size'] = 200000;
                $config['overwrite'] = TRUE;
                $config['file_name'] = $teacherID;
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
                    if ($this->Teacher_model->editProfilePhoto($teacherID, $filename)) {
                        $this->nativesession->set('success', 'Photo Changed');
                    } else {
                        $this->nativesession->set('error', 'Upload Photo Failed, try again !');
                        redirect(current_url());
                    }
                }
            }
            $this->nativesession->set('success', 'New Teacher Added');
            $eid = $this->general->encryptParaID($teacherID, 'teacher');
            redirect('admin/editTeacher/'.$eid);
        }


        $data['title'] = 'SIMS';
        $data['courses'] = $this->Teacher_model->getAllCoursesByTeacher($this->nativesession->get('id'));
        $data['admin'] = $this->Admin_model->getProfileDataByID($this->nativesession->get('id'));
        $data['allcourses']  = $this->Admin_model->getAllCourses();
        $data['classes']  = $this->Admin_model->getAllClass();
        $data['topnavigation'] = 'admin/admin_topnavigation';
        $data['sidebar'] = 'admin/admin_sidebar';
        $data['day'] = $this->Teacher_model->getSetting('s0005');
        $data['period'] = $this->Teacher_model->getSetting('s0006');
        $data['hour'] = $this->Teacher_model->getSetting('s0007');
        $data['starttime'] = $this->Teacher_model->getSetting('s0008');
        $data['breakstarttime'] = $this->Teacher_model->getSetting('s0009');
        $data['breaktime'] = $this->Teacher_model->getSetting('s0011');
        $data['lunchstarttime'] = $this->Teacher_model->getSetting('s0010');
        $data['lunchtime'] = $this->Teacher_model->getSetting('s0012');
        $data['rolechoice'] = $this->Teacher_model->getRoleCategory(1);
        $data['content'] = 'admin/admin_add_teacher_view';
        $this->load->view($this->template, $data);
}



/*********************************** ATTENDANCE **********************************/
    public function attendanceClassView($id)
    {
        $classid = $this->general->decryptParaID($id, 'class');

        $datebutton = $this->input->post('datebutton');
        if($datebutton == 'setdate'){
            $setdate = $this->input->post('datechoosen');
            $data['setdate'] = $setdate;
        }
        else{
            $setdate = date('Y-m-d', now());
            $data['setdate'] = $setdate;
        }

        $savebutton = $this->input->post('savebutton');
        if($savebutton == 'true'){
            $studentids = $this->input->post('studentid');
            $status = $this->input->post('attendance');
            $comments = $this->input->post('comment');
            $latestID = $this->Teacher_model->getAttendanceLatestID();
            $latestID = $latestID['attendanceid'];
            for($i=0;$i<sizeof($studentids);$i++)
            {
                if($result = $this->Teacher_model->checkAttendance($classid, $studentids[$i], $setdate)){
                    $this->Teacher_model->editAttendance($result['attendanceid'], $status[$i], $comments[$i]);
                    $this->nativesession->set('success', 'Attendance Saved');
                }
                else{
                    $latestID = substr($latestID, 1);
                    $latestID = 'e'.str_pad((int) $latestID+1, 4, "0", STR_PAD_LEFT);
                    $this->Teacher_model->addAttendance($latestID, $classid, $studentids[$i], $status[$i], $comments[$i]);
                    $this->nativesession->set('success', 'Attendance Saved');
                }
            }
        }

        if($attendancedata = $this->Teacher_model->getStudentsAttendanceByClassID($classid, $setdate)){
            $data['students'] = $attendancedata;
        }
        else{
            $data['students'] = $this->Teacher_model->getStudentsAttendanceList($classid);
        }


        $data['title'] = 'SMS';
        $data['admin'] = $this->Admin_model->getProfileDataByID($this->nativesession->get('id'));
        $data['topnavigation'] = 'admin/admin_topnavigation';
        $data['allcourses']  = $this->Admin_model->getAllCourses();
        $data['classes']  = $this->Admin_model->getAllClass();
        $data['classroom']  = $this->general->getClassroom($classid);
        $data['classid']  = $classid;
        $data['sidebar'] = 'admin/admin_sidebar';
        $data['content'] = 'admin/admin_attendance_inclass_view';
        $this->load->view($this->template, $data);

    }

    public function addCourse()
    {
        if($this->general->checkPrivilege($this->nativesession->get('role'), 'p0013') != 1){
            $this->nativesession->set('error', 'Access Denied');
            redirect('teacher/home');
        }
        $this->form_validation->set_rules('coursename', 'Course Name', 'required');
        $this->form_validation->set_rules('coursedescription', 'Course Description', 'required');
        $this->form_validation->set_rules('courseresources', 'Course Resources', 'required');

        $this->form_validation->set_error_delimiters('', '<br/>');

        if ($this->form_validation->run() == TRUE) {
            $latestID = $this->Teacher_model->getCourseLatestID();
            $latestID = $latestID['courseid'];
            $latestID = substr($latestID, 1);
            $courseID = 'c'.str_pad((int) $latestID+1, 4, "0", STR_PAD_LEFT);
            $this->Teacher_model->addCourse($courseID);

            $chapters = $this->input->post('chapter');
            $objective = $this->input->post('objective');
            $activities = $this->input->post('activities');
            $material = $this->input->post('material');
            $latestID = $this->Teacher_model->getPlanLatestID();
            $latestID = $latestID['lessonid'];
            for($i=0;$i<sizeof($chapters);$i++)
            {
                if($chapters[$i] != null){
                    $latestID = substr($latestID, 1);
                    $latestID = 'l'.str_pad((int) $latestID+1, 4, "0", STR_PAD_LEFT);
                    $lessoncount = $i+1;
                    $this->Teacher_model->addPlan($latestID, $lessoncount, $chapters[$i], $objective[$i], $activities[$i], $material[$i], $courseID);
                }
            }

            $this->nativesession->set('success', 'New Course Added');
            $id = $this->general->encryptParaID($courseID, 'course');
            redirect('admin/courseView/c'.$id);
        }


        $data['title'] = 'SMS';
        $data['admin'] = $this->Admin_model->getProfileDataByID($this->nativesession->get('id'));
        $data['topnavigation'] = 'admin/admin_topnavigation';
        $data['sidebar'] = 'admin/admin_sidebar';
        $data['classes']  = $this->Admin_model->getAllClass();
        $data['allcourses']  = $this->Admin_model->getAllCourses();

        $data['content'] = 'admin/admin_add_course_view';
        $this->load->view($this->template, $data);
    }

    public function allCourse()
    {
        $data['title'] = 'SMS';
        $data['admin'] = $this->Admin_model->getProfileDataByID($this->nativesession->get('id'));
        $data['topnavigation'] = 'admin/admin_topnavigation';
        $data['sidebar'] = 'admin/admin_sidebar';
        $data['classes']  = $this->Admin_model->getAllClass();
        $data['allcourses']  = $this->Admin_model->getAllCourses();

        $data['info_dbs'] = $this->Teacher_model->getAllCourses();
        $data['content'] = 'admin/admin_courses_list_view';
        $this->load->view($this->template, $data);
    }

    public function editCourse($fid)
    {
        if($this->general->checkPrivilege($this->nativesession->get('role'), 'p0014') != 1){
            $this->nativesession->set('error', 'Access Denied');
            redirect('teacher/home');
        }
        if(substr($fid, 0 ,1) == 's'){
            $id = $this->general->decryptParaID(substr($fid, 1), 'courseassigned');
        }
        else{
            $id = $this->general->decryptParaID(substr($fid, 1), 'course');
        }

        $this->form_validation->set_rules('coursename', 'Course Name', 'required');
        $this->form_validation->set_rules('coursedescription', 'Course Description', 'required');
        $this->form_validation->set_rules('courseresources', 'Course Resources', 'required');
        $courseid = $this->input->post('courseid');

        $this->form_validation->set_error_delimiters('', '<br/>');

        if ($this->form_validation->run() == TRUE) {
            $this->Teacher_model->editCourse($courseid);

            $lessonid = $this->input->post('lessonido');
            $chapters = $this->input->post('chaptero');
            $objective = $this->input->post('objectiveo');
            $activities = $this->input->post('activitieso');
            $material = $this->input->post('materialo');
            for($i=0;$i<sizeof($lessonid);$i++)
            {
                $lessoncount = $i+1;
                $this->Teacher_model->editPlan($lessonid[$i], $chapters[$i], $objective[$i], $activities[$i], $material[$i]);
            }
            $chapters = $this->input->post('chapter');
            $objective = $this->input->post('objective');
            $activities = $this->input->post('activities');
            $material = $this->input->post('material');
            $latestID = $this->Teacher_model->getPlanLatestID();
            $latestID = $latestID['lessonid'];
            for($i=0;$i<sizeof($chapters);$i++)
            {
                if($chapters[$i] != null){
                    $latestID = substr($latestID, 1);
                    $latestID = 'l'.str_pad((int) $latestID+1, 4, "0", STR_PAD_LEFT);
                    $lessoncount = $lessoncount+1;
                    $this->Teacher_model->addPlan($latestID, $lessoncount, $chapters[$i], $objective[$i], $activities[$i], $material[$i], $courseid);
                }
            }

            $this->nativesession->set('success', 'Course saved');
            if(substr($fid, 0 ,1) == 's'){
                $id = $this->general->encryptParaID($id, 'courseassigned');
                redirect('admin/courseView/s'.$id);
            }
            else{
                $id = $this->general->encryptParaID($id, 'course');
                redirect('admin/allCourse');
            }

        }

        $data['title'] = 'SMS';
        $data['admin'] = $this->Admin_model->getProfileDataByID($this->nativesession->get('id'));
        $data['topnavigation'] = 'admin/admin_topnavigation';
        $data['sidebar'] = 'admin/admin_sidebar';
        $data['classes']  = $this->Admin_model->getAllClass();
        $data['allcourses']  = $this->Admin_model->getAllCourses();
        $data['top2navigation'] = 'admin/admin_top2navigation';

        $data['content'] = 'admin/admin_edit_course_view';
        if(!$info = $this->Teacher_model->getCourseDataByAssignID($id)){
            $info = $this->Teacher_model->getCourseDataByID($id);
        }
        $data['info_db'] = $info;
        $courseid = $info['courseid'];
        $data['plans'] = $this->Teacher_model->getLessonPlan($courseid);
        $this->load->view($this->template, $data);
    }

    public function deleteCourse($id){
        if($this->general->checkPrivilege($this->nativesession->get('role'), 'p0014') != 1){
            $this->nativesession->set('error', 'Access Denied');
            redirect('admin/home');
        }
        $id = $this->general->decryptParaID($id, 'course');
        if($this->Teacher_model->deleteCourse($id)){
            $this->nativesession->set('success', 'Course Deleted');
        }
        else{
            $this->nativesession->set('error', 'Failed to Delete Course');
        }
        redirect('admin/allCourse');
    }

    public function courseView($fid)
    {
        if(substr($fid, 0 ,1) == 's'){
            $id = $this->general->decryptParaID(substr($fid, 1), 'courseassigned');
        }
        else{
            $id = $this->general->decryptParaID(substr($fid, 1), 'course');
        }

        $data['title'] = 'SMS';
        $data['allcourses']  = $this->Admin_model->getAllCourses();
        $data['admin'] = $this->Admin_model->getProfileDataByID($this->nativesession->get('id'));
        $data['topnavigation'] = 'admin/admin_topnavigation';
        $data['sidebar'] = 'admin/admin_sidebar';
        $data['classes']  = $this->Admin_model->getAllClass();
        $data['allcourses']  = $this->Admin_model->getAllCourses();
        $data['top2navigation'] = 'admin/admin_top2navigation';

        $data['content'] = 'admin/admin_course_view';
        if(!$info = $this->Teacher_model->getCourseDataByAssignID($id)){
            $info = $this->Teacher_model->getCourseDataByID($id);
        }
        $data['info_db'] = $info;
        $courseid = $info['courseid'];
        $data['plans'] = $this->Teacher_model->getLessonPlan($courseid);
        $this->load->view($this->template, $data);
    }

    public function courseSemester($id)
    {
        $id = $this->general->decryptParaID($id, 'courseassigned');
        $data['title'] = 'SMS';
        $data['allcourses']  = $this->Admin_model->getAllCourses();
        $data['admin'] = $this->Admin_model->getProfileDataByID($this->nativesession->get('id'));
        $data['topnavigation'] = 'admin/admin_topnavigation';
        $data['sidebar'] = 'admin/admin_sidebar';
        $data['classes']  = $this->Admin_model->getAllClass();
        $data['allcourses']  = $this->Admin_model->getAllCourses();
        $data['top2navigation'] = 'admin/admin_top2navigation';

        $data['content'] = 'admin/admin_course_semester_view';
        if(!$info = $this->Teacher_model->getCourseDataByAssignID($id)){
            $info = $this->Teacher_model->getCourseDataByID($id);
        }
        $data['info_db'] = $info;
        $courseid = $info['courseid'];
        $data['plans'] = $this->Teacher_model->getSemesterPlan($courseid);
        $this->load->view($this->template, $data);
    }

    public function printPreviewSemester($id)
    {
        $id = $this->general->decryptParaID($id, 'courseassigned');
        $data['title'] = 'SMS';
        $data['content'] = 'admin/admin_course_semester_print_view';
        if(!$info = $this->Teacher_model->getCourseDataByAssignID($id)){
            $info = $this->Teacher_model->getCourseDataByID($id);
        }
        $data['info_db'] = $info;
        $courseid = $info['courseid'];
        $data['plans'] = $this->Teacher_model->getSemesterPlan($courseid);
        $this->load->view($this->print_template, $data);
    }

    public function editSemester($id)
    {
        if($this->general->checkPrivilege($this->nativesession->get('role'), 'p0014') != 1){
            $this->nativesession->set('error', 'Access Denied');
            redirect('teacher/home');
        }
        $id = $this->general->decryptParaID($id, 'courseassigned');
        $this->form_validation->set_rules('courseid', 'Course ID', 'required');
        $courseid = $this->input->post('courseid');

        $this->form_validation->set_error_delimiters('', '<br/>');

        if ($this->form_validation->run() == TRUE) {
            $semesterid = $this->input->post('semesterido');
            $weeks = $this->input->post('weeko');
            $topics = $this->input->post('topico');
            $outcomes = $this->input->post('outcomeo');
            $assessments = $this->input->post('assessmento');
            $resources = $this->input->post('resourceo');
            for($i=0;$i<sizeof($semesterid);$i++)
            {
                $this->Teacher_model->editSemester($semesterid[$i], $weeks[$i], $topics[$i], $outcomes[$i], $assessments[$i], $resources[$i]);
            }
            $weeks = $this->input->post('week');
            $topics = $this->input->post('topic');
            $outcomes = $this->input->post('outcome');
            $assessments = $this->input->post('assessment');
            $resources = $this->input->post('resource');
            $latestID = $this->Teacher_model->getSemesterLatestID();
            $latestID = $latestID['semesterid'];
            for($i=0;$i<sizeof($weeks);$i++)
            {
                if($weeks[$i] != null){
                    $latestID = substr($latestID, 1);
                    $latestID = 's'.str_pad((int) $latestID+1, 4, "0", STR_PAD_LEFT);
                    $this->Teacher_model->addSemester($latestID, $weeks[$i], $topics[$i], $outcomes[$i], $assessments[$i],$resources[$i], $courseid);
                }
            }

            $this->nativesession->set('success', 'Course saved');
            $encryptid = $this->general->encryptParaID($id, 'courseassigned');
            redirect('admin/courseSemester/'.$encryptid);
        }

        $data['title'] = 'SMS';
        $data['allcourses']  = $this->Admin_model->getAllCourses();
        $data['admin'] = $this->Admin_model->getProfileDataByID($this->nativesession->get('id'));
        $data['topnavigation'] = 'admin/admin_topnavigation';
        $data['sidebar'] = 'admin/admin_sidebar';
        $data['classes']  = $this->Admin_model->getAllClass();
        $data['allcourses']  = $this->Admin_model->getAllCourses();
        $data['top2navigation'] = 'admin/admin_top2navigation';

        $data['content'] = 'admin/admin_edit_semester_view';
        if(!$info = $this->Teacher_model->getCourseDataByAssignID($id)){
            $info = $this->Teacher_model->getCourseDataByID($id);
        }
        $data['info_db'] = $info;
        $courseid = $info['courseid'];
        $data['plans'] = $this->Teacher_model->getSemesterPlan($courseid);
        $this->load->view($this->template, $data);
    }

    public function courseImplementation($id){
        $id = $this->general->decryptParaID($id, 'courseassigned');

        $this->form_validation->set_rules('assignid', 'assignid', 'required');

        $this->form_validation->set_error_delimiters('', '<br/>');

        if ($this->form_validation->run() == TRUE) {
            $chapters = $this->input->post('chapter');
            $objective = $this->input->post('objective');
            $activities = $this->input->post('activities');
            $material = $this->input->post('material');
            $latestID = $this->Teacher_model->getImplementationLatestID();
            $latestID = $latestID['implementationid'];
            for($i=0;$i<sizeof($chapters);$i++)
            {
                $lessoncount = $i+1;
                if($result = $this->Teacher_model->checkImplementation($lessoncount, $id)){
                    $this->Teacher_model->editImplementation($result['implementationid'], $chapters[$i], $objective[$i], $activities[$i], $material[$i]);
                }
                else{
                    $latestID = substr($latestID, 1);
                    $latestID = 'i'.str_pad((int) $latestID+1, 4, "0", STR_PAD_LEFT);
                    $this->Teacher_model->addImplementation($latestID, $lessoncount, $chapters[$i], $objective[$i], $activities[$i], $material[$i], $id);
                }
            }

            $this->nativesession->set('success', 'Implementation saved');
            $encryptid = $this->general->encryptParaID($id, 'courseassigned');
            redirect('admin/courseImplementation/'.$encryptid);
        }

        $data['title'] = 'SMS';
        $data['allcourses']  = $this->Admin_model->getAllCourses();
        $data['admin'] = $this->Admin_model->getProfileDataByID($this->nativesession->get('id'));
        $data['topnavigation'] = 'admin/admin_topnavigation';
        $data['sidebar'] = 'admin/admin_sidebar';
        $data['classes']  = $this->Admin_model->getAllClass();
        $data['allcourses']  = $this->Admin_model->getAllCourses();
        $data['top2navigation'] = 'admin/admin_top2navigation';

        $info = $this->Teacher_model->getCourseDataByAssignID($id);
        $data['info_db'] = $info;
        $courseid = $info['courseid'];
        $data['plans'] = $this->Teacher_model->getLessonPlan($courseid);
        $data['implementation'] = $this->Teacher_model->getLessonImplementation($id);
        $data['content'] = 'admin/admin_course_implementation_view';
        $this->load->view($this->template, $data);
    }

    public function printPreviewImplementation($id){
        $id = $this->general->decryptParaID($id, 'courseassigned');
        $data['title'] = 'SMS';
        $info = $this->Teacher_model->getCourseDataByAssignID($id);
        $data['info_db'] = $info;
        $data['plans'] = $this->Teacher_model->getLessonImplementation($id);
        $data['content'] = 'admin/admin_course_implementation_print_view';
        $this->load->view($this->print_template, $data);
    }

    public function courseMaterial($id){
        $id = $this->general->decryptParaID($id, 'courseassigned');
        $data['title'] = 'SMS';
        $data['allcourses']  = $this->Admin_model->getAllCourses();
        $data['admin'] = $this->Admin_model->getProfileDataByID($this->nativesession->get('id'));
        $data['topnavigation'] = 'admin/admin_topnavigation';
        $data['sidebar'] = 'admin/admin_sidebar';
        $data['classes']  = $this->Admin_model->getAllClass();
        $data['allcourses']  = $this->Admin_model->getAllCourses();
        $data['top2navigation'] = 'admin/admin_top2navigation';

        $data['info_db'] = $this->Teacher_model->getCourseDataByAssignID($id);
        $data['materials'] = $this->Teacher_model->getMaterialsByAssignID($id);
        $data['content'] = 'admin/admin_course_material_view';
        $this->load->view($this->template, $data);
    }

    public function addMaterial($id){
        $id = $this->general->decryptParaID($id, 'courseassigned');
        $this->form_validation->set_rules('topic', 'topic', 'required');
        $this->form_validation->set_rules('type', 'type', 'required');
        $this->form_validation->set_error_delimiters('', '<br/>');
        if ($this->form_validation->run() == TRUE) {
            if ($this->input->post('existingfile')==null && empty($_FILES['userfile']['name'])){
                $this->nativesession->set('error', 'Existing file or New file is required');
                redirect(current_url());
            }
            else{
                $latestID = $this->Teacher_model->getMaterialLatestID();
                $latestID = $latestID['materialid'];
                $latestID = substr($latestID, 1);
                $materialID = 'm'.str_pad((int) $latestID+1, 4, "0", STR_PAD_LEFT);
                if ($_FILES['userfile']['error'] != 4) {
                    $config['upload_path'] = $this->materialpath;
                    $config['allowed_types'] = "doc|pdf|docx";
                    $config['max_size'] = 200000;
                    $config['overwrite'] = TRUE;
                    $this->load->library('upload', $config);

                    if (!$this->upload->do_upload('userfile')) {
                        $this->nativesession->set('error', $this->upload->display_errors());
                        redirect(current_url());
                    } else {
                        $data = $this->upload->data();
                        $filename = $data['orig_name'];
                        $latestID = $this->Teacher_model->getFileLatestID();
                        $latestID = $latestID['fileid'];
                        $latestID = substr($latestID, 1);
                        $fileID = 'f'.str_pad((int) $latestID+1, 4, "0", STR_PAD_LEFT);
                        $teacherid = $this->Teacher_model->getTeacherOfAssignID($id);
                        $teacherid = $teacherid['teacherid'];

                        $this->Teacher_model->addFile($fileID, $filename, $teacherid);
                        $newfile = true;
                        $this->nativesession->set('success', 'File Uploaded');

                    }
                }
                if(isset($newfile) && $newfile == true){
                    $this->Teacher_model->addMaterial($materialID, $id, $fileID);
                }
                else{
                    $fileID = $this->input->post('existingfile');
                    $this->Teacher_model->addMaterial($materialID, $id, $fileID);
                }
                $this->nativesession->set('success', 'New Material Added');
                $eid = $this->general->encryptParaID($id, 'courseassigned');
                redirect('admin/courseMaterial/'.$eid);
            }
        }

        $data['title'] = 'SMS';
        $data['allcourses']  = $this->Admin_model->getAllCourses();
        $data['admin'] = $this->Admin_model->getProfileDataByID($this->nativesession->get('id'));
        $data['topnavigation'] = 'admin/admin_topnavigation';
        $data['sidebar'] = 'admin/admin_sidebar';
        $data['classes']  = $this->Admin_model->getAllClass();
        $data['allcourses']  = $this->Admin_model->getAllCourses();
        $data['top2navigation'] = 'admin/admin_top2navigation';

        $info = $this->Teacher_model->getCourseDataByAssignID($id);
        $data['info_db'] = $info;
        $courseid = $info['courseid'];
        $data['lessons'] = $this->Teacher_model->getLessonPlan($courseid);
        $data['files'] = $this->Teacher_model->getFilesByAssignID($id);
        $data['content'] = 'admin/admin_course_material_add_view';
        $this->load->view($this->template, $data);
    }

    public function courseAssignmentQuiz($id){
        $id = $this->general->decryptParaID($id, 'courseassigned');
        $data['title'] = 'SMS';
        $data['allcourses']  = $this->Admin_model->getAllCourses();
        $data['admin'] = $this->Admin_model->getProfileDataByID($this->nativesession->get('id'));
        $data['topnavigation'] = 'admin/admin_topnavigation';
        $data['sidebar'] = 'admin/admin_sidebar';
        $data['classes']  = $this->Admin_model->getAllClass();
        $data['allcourses']  = $this->Admin_model->getAllCourses();
        $data['top2navigation'] = 'admin/admin_top2navigation';

        $data['info_db'] = $this->Teacher_model->getCourseDataByAssignID($id);
        $data['qnas'] = $this->Teacher_model->getQnAByAssignID($id);
        $data['content'] = 'admin/admin_course_qna_view';
        $this->load->view($this->template, $data);
    }

    public function addQnA($id){
        $id = $this->general->decryptParaID($id, 'courseassigned');
        $this->form_validation->set_rules('topic', 'topic', 'required');
        $this->form_validation->set_rules('type', 'type', 'required');
        $this->form_validation->set_rules('duedate', 'due date', 'required');
        $this->form_validation->set_error_delimiters('', '<br/>');

        if ($this->form_validation->run() == TRUE) {
            $teacherid = $this->Teacher_model->getTeacherOfAssignID($id);
            $teacherid = $teacherid['teacherid'];

            if ($this->input->post('existingfile')==null && empty($_FILES['userfile']['name'])){
                $this->nativesession->set('error', 'Existing file or New file is required');
                redirect(current_url());
            }
            else{
                $latestID = $this->Teacher_model->getQnALatestID();
                $latestID = $latestID['anqid'];
                $latestID = substr($latestID, 1);
                $materialID = 'a'.str_pad((int) $latestID+1, 4, "0", STR_PAD_LEFT);
                if ($_FILES['userfile']['error'] != 4) {
                    $config['upload_path'] = $this->materialpath;
                    $config['allowed_types'] = "doc|pdf|docx";
                    $config['max_size'] = 200000;
                    $config['overwrite'] = TRUE;
                    $this->load->library('upload', $config);

                    if (!$this->upload->do_upload('userfile')) {
                        $this->nativesession->set('error', $this->upload->display_errors());
                        redirect(current_url());
                    } else {
                        $data = $this->upload->data();
                        $filename = $data['orig_name'];
                        $latestID = $this->Teacher_model->getFileLatestID();
                        $latestID = $latestID['fileid'];
                        $latestID = substr($latestID, 1);
                        $fileID = 'f'.str_pad((int) $latestID+1, 4, "0", STR_PAD_LEFT);

                        $this->Teacher_model->addFile($fileID, $filename, $teacherid);
                        $newfile = true;
                        $this->nativesession->set('success', 'File Uploaded');

                    }
                }
                if(isset($newfile) && $newfile == true){
                    $this->Teacher_model->addQnA($materialID, $id, $fileID);
                }
                else{
                    $fileID = $this->input->post('existingfile');
                    $this->Teacher_model->addQnA($materialID, $id, $fileID);
                }

                if($this->input->post('type') == 'Quiz' || $this->input->post('type') == 'Assignment'){
                    $latestID = $this->Teacher_model->getEventLatestID();
                    $latestID = $latestID['eventid'];
                    $latestID = substr($latestID, 1);
                    $latestID = 'v'.str_pad((int) $latestID+1, 4, "0", STR_PAD_LEFT);
                    $teacherid = $this->Teacher_model->getTeacherOfAssignID($id);
                    $teacherid = $teacherid['teacherid'];
                    $this->Teacher_model->addQnAEvent($latestID, $teacherid, $id);
                }


                $this->nativesession->set('success', 'New Material Added');
                $eid = $this->general->encryptParaID($id, 'courseassigned');
                redirect('admin/courseAssignmentQuiz/'.$eid);
            }
        }

        $data['title'] = 'SMS';
        $data['allcourses']  = $this->Admin_model->getAllCourses();
        $data['admin'] = $this->Admin_model->getProfileDataByID($this->nativesession->get('id'));
        $data['topnavigation'] = 'admin/admin_topnavigation';
        $data['sidebar'] = 'admin/admin_sidebar';
        $data['classes']  = $this->Admin_model->getAllClass();
        $data['allcourses']  = $this->Admin_model->getAllCourses();
        $data['top2navigation'] = 'admin/admin_top2navigation';

        $info = $this->Teacher_model->getCourseDataByAssignID($id);
        $data['info_db'] = $info;
        $courseid = $info['courseid'];
        $data['lessons'] = $this->Teacher_model->getLessonPlan($courseid);
        $data['files'] = $this->Teacher_model->getFilesByAssignID($id);
        $data['content'] = 'admin/Admin_course_qna_add_view';
        $this->load->view($this->template, $data);
    }

    public function courseAssignmentQuizSubmission($id, $qid){
        $id = $this->general->decryptParaID($id, 'courseassigned');
        $qid = $this->general->decryptParaID($qid, 'anq');

        $data['title'] = 'SMS';
        $data['allcourses']  = $this->Admin_model->getAllCourses();
        $data['admin'] = $this->Admin_model->getProfileDataByID($this->nativesession->get('id'));
        $data['topnavigation'] = 'admin/admin_topnavigation';
        $data['sidebar'] = 'admin/admin_sidebar';
        $data['classes']  = $this->Admin_model->getAllClass();
        $data['allcourses']  = $this->Admin_model->getAllCourses();
        $data['top2navigation'] = 'admin/admin_top2navigation';

        $info = $this->Teacher_model->getCourseDataByAssignID($id);
        $data['info_db'] = $info;
        $data['qna'] = $this->Teacher_model->getQnA($qid);
        $data['submit'] = $this->Teacher_model->getSubmission($qid);
        $classid = $info['classid'];
        $students = $this->Teacher_model->getStudentsByClassID($classid);
        $i=0;
        $latestID = $this->Teacher_model->getScoreLatestID();
        $latestID = $latestID['anqscoreid'];
        foreach ($students as $student) {
            if($found = $this->Teacher_model->checkNoSubmission($student['studentid'], $qid)){
            }
            else{
                $latestID = substr($latestID, 1);
                $latestID = 'n'.str_pad((int) $latestID+1, 4, "0", STR_PAD_LEFT);
                $notfound[$i]['anqscoreid'] = $latestID;
                $notfound[$i]['studentid'] = $student['studentid'];
                $notfound[$i]['photo'] = $student['photo'];
                $notfound[$i]['firstname'] = $student['firstname'];
                $notfound[$i]['lastname'] = $student['lastname'];
                $notfound[$i]['submissiondate'] = '-';
                $notfound[$i]['score'] = null;
                $i++;
            }
        }
        $data['nosubmit'] = $notfound;
        $data['content'] = 'admin/admin_course_qna_submission_view';
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