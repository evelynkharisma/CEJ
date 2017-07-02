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
    var $formpath = 'assets/file/forms/';

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
        $data['allteacher']  = $this->Teacher_model->getAllTeacher();
        $data['eventnotif'] = $this->Admin_model->getAllEventsCount($this->nativesession->get('id'),$this->nativesession->get('lastlogin'));

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
        $data['allteacher']  = $this->Teacher_model->getAllTeacher();
        $data['eventnotif'] = $this->Admin_model->getAllEventsCount($this->nativesession->get('id'),$this->nativesession->get('lastlogin'));

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
        $this->form_validation->set_rules('familyname', 'familyname', 'required');
        $this->form_validation->set_rules('firstname', 'firstname', 'required');
        $this->form_validation->set_rules('lastname', 'lastname', 'required');
        $this->form_validation->set_rules('gender', 'gender', 'required');
        $this->form_validation->set_rules('dateofbirth', 'date of birth', 'required');
        $this->form_validation->set_rules('placeofbirth', 'place of birth', 'required');
        $this->form_validation->set_rules('religion', 'religion', 'required');
        $this->form_validation->set_rules('phone', 'phone', 'required');
        $this->form_validation->set_rules('email', 'email', 'required|valid_email');
        $this->form_validation->set_rules('nationality', 'nationality', 'required');
        $this->form_validation->set_rules('ethnic', 'ethnic', 'required');
        $this->form_validation->set_rules('citizenship', 'citizenship', 'required');
        $this->form_validation->set_rules('passportcountry', 'passport country', 'required');
        $this->form_validation->set_rules('passportexpired', 'passport expired', 'required');
        $this->form_validation->set_rules('idcardtype', 'ID card type', 'required');
        $this->form_validation->set_rules('address', 'address', 'required');

        $this->form_validation->set_rules('rcname', 'recent school name', 'required');
        $this->form_validation->set_rules('rccontact', 'recent school contact person', 'required');
        $this->form_validation->set_rules('rcposition', 'recent school contact person position', 'required');
        $this->form_validation->set_rules('rcemail', 'recent school contact person email', 'required|valid_email');
        $this->form_validation->set_rules('rcphone', 'recent school contact person phone', 'required');
        $this->form_validation->set_rules('rcreason', 'reason leaving recent school', 'required');

        $this->form_validation->set_rules('cdlearningdiff', 'learning difficulties', 'required');
        $this->form_validation->set_rules('cdlearningdiffnature', 'nature of learning difficlties', 'required');
        $this->form_validation->set_rules('cdacademicsuport', 'academic difficulties', 'required');
        $this->form_validation->set_rules('cdacademicsuportnature', 'nature of academic support', 'required');
        $this->form_validation->set_rules('cdtalented', 'gift or talent', 'required');
        $this->form_validation->set_rules('cdtalenteddetail', 'nature of the gift', 'required');
        $this->form_validation->set_rules('cdnativelang', 'native language', 'required');
        $this->form_validation->set_rules('cdsecondlang', 'second language', 'required');
        $this->form_validation->set_rules('cdenglishproficiency', 'english proficiency', 'required');
        $this->form_validation->set_rules('cdlearningenglish', 'learning english duration', 'required');
        $this->form_validation->set_rules('cdlangathome', 'language at home', 'required');
        $this->form_validation->set_rules('cdlangproficient', 'other proficient language', 'required');
        $this->form_validation->set_rules('cdprevcountry', 'previous country residence', 'required');
        $this->form_validation->set_rules('cdstudiedotherlang', 'studied language  other than english', 'required');
        $this->form_validation->set_rules('cddifficultvocab', 'difficulties in acquiring language', 'required');
        $this->form_validation->set_rules('cdfirstlangSupport', 'first language support', 'required');
        $this->form_validation->set_rules('cdvocabEnglishSupportDetail', 'english suport detail', 'required');

        $this->form_validation->set_rules('hrallegies', 'allergies', 'required');
        $this->form_validation->set_rules('hrallegiesdetail', 'allergies detail', 'required');
        $this->form_validation->set_rules('hrmedication', 'required medication detail', 'required');
        $this->form_validation->set_rules('hrmedicationdetail', 'detail of required medication', 'required');
        $this->form_validation->set_rules('hrpsychologicalAssessment', 'psychological assessment', 'required');
        $this->form_validation->set_rules('hrpsychologicalAssessmentdetail', 'nature of psychological assessment', 'required');
        $this->form_validation->set_rules('hrhearingSpeechDifficulty', 'hearing and speech difficulty', 'required');
        $this->form_validation->set_rules('hrhearingSpeechDifficultydetail', 'nature of hearing and speech difficulty', 'required');
        $this->form_validation->set_rules('hrbehaviouralDifficulty', 'behavioural difficulty', 'required');
        $this->form_validation->set_rules('hrbehaviouralDifficultydetail', 'nature of behavioural difficulty', 'required');
        $this->form_validation->set_rules('hrother', 'other detail', 'required');
        $this->form_validation->set_rules('hrotherinformation', 'other comments/information', 'required');
        $this->form_validation->set_rules('hreyesight', 'eyesight', 'required');
        $this->form_validation->set_rules('hrhearing', 'hearing', 'required');
        $this->form_validation->set_rules('hrfoodallergies', 'food allergies', 'required');
        $this->form_validation->set_rules('hrissueexplanation', 'other issues explanation', 'required');
        $this->form_validation->set_rules('hrdocname', 'doctor name', 'required');
        $this->form_validation->set_rules('hrdocphone', 'doctor phone', 'required');
        $this->form_validation->set_rules('hrecname', 'emergency contact name', 'required');
        $this->form_validation->set_rules('hrecphone', 'emergency contact phone', 'required');
        $this->form_validation->set_rules('hrecrelationship', 'emergency contact relationship', 'required');

        $this->form_validation->set_rules('vchepatitisb', 'hepatitis b', 'required');
        $this->form_validation->set_rules('vchepatitisbyear', 'hepatitis b year', 'required');
        $this->form_validation->set_rules('vcmeasles', 'measles, mumps rubella', 'required');
        $this->form_validation->set_rules('vcmeaslesyear', 'measles, mumps rubella', 'required');
        $this->form_validation->set_rules('vcpolio', 'polio', 'required');
        $this->form_validation->set_rules('vcpolioyear', 'polio year', 'required');
        $this->form_validation->set_rules('vctetanus', 'tetanus', 'required');
        $this->form_validation->set_rules('vctetanusyear', 'tetanus year', 'required');
        $this->form_validation->set_rules('vchib', 'HiB', 'required');
        $this->form_validation->set_rules('vchibyear', 'HiB year', 'required');
        $this->form_validation->set_rules('vcmenzb', 'MenzB', 'required');
        $this->form_validation->set_rules('vcmenzbyear', 'MenzB year', 'required');
        $this->form_validation->set_rules('vcmenzb', 'MenzB', 'required');
        $this->form_validation->set_rules('vcmenzbyear', 'MenzB year', 'required');
        $this->form_validation->set_rules('vctb', 'TB', 'required');
        $this->form_validation->set_rules('vctbyear', 'TB year', 'required');

        $this->form_validation->set_rules('mp1', 'medical problem', 'required');
        $this->form_validation->set_rules('mp2', 'medical problem', 'required');
        $this->form_validation->set_rules('mp3', 'medical problem', 'required');
        $this->form_validation->set_rules('mp4', 'medical problem', 'required');
        $this->form_validation->set_rules('mp5', 'medical problem', 'required');
        $this->form_validation->set_rules('mp6', 'medical problem', 'required');
        $this->form_validation->set_rules('mp7', 'medical problem', 'required');
        $this->form_validation->set_rules('mp8', 'medical problem', 'required');


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
            $this->Admin_model->editStudentRecentSchool($studentid);
            $this->Admin_model->editStudentChildDevelopment($studentid);
            $this->Admin_model->editStudentVaccination($studentid);
            $this->Admin_model->editStudentHealthRecord($studentid);

            for($i=1;$i<10;$i++) {
                $id = $this->input->post('mp'.$i.'id');
                $prob = $this->input->post('mp'.$i.'problem');
                $status = $this->input->post('mp'.$i);
                $severity = $this->input->post('mp'.$i.'severity');
                $med = $this->input->post('mp'.$i.'medication');
                $act = $this->input->post('mp'.$i.'action');

                $this->Admin_model->editStudentMedicalProblem($id, $prob, $status, $severity, $med, $act);
            }
            $this->nativesession->set('success', 'Profile saved');
            $eid = $this->general->encryptParaID($id, 'student');
            redirect('admin/editStudent/'.$stid);
        }

        $data['title'] = 'SMS';
        $data['student']  = $this->Student_model->getProfileDataByID($id);
        $data['admin'] = $this->Admin_model->getProfileDataByID($this->nativesession->get('id'));
        $data['allcourses']  = $this->Admin_model->getAllCourses();
        $data['allteacher']  = $this->Teacher_model->getAllTeacher();
        $data['eventnotif'] = $this->Admin_model->getAllEventsCount($this->nativesession->get('id'),$this->nativesession->get('lastlogin'));

        $data['studentRecentSchool']  = $this->Admin_model->getStudentRecentSchoolByID($id);
        $data['studentChildDevelopment']  = $this->Admin_model->getStudentChildDevelopmentDataByID($id);
        $data['studentHealthRecord']  = $this->Admin_model->getStudentHealthRecordDataByID($id);
        $data['studentVaccination']  = $this->Admin_model->getStudentVaccinationDataByID($id);
        $data['studentMedicalProblem']  = $this->Admin_model->getStudentMedicalProblemDataByID($id);
        $data['classes']  = $this->Admin_model->getAllClass();
        $data['sidebar'] = 'admin/admin_sidebar';
        $data['topnavigation'] = 'admin/admin_topnavigation';
        $data['content'] = 'admin/admin_edit_student_view';
        $this->load->view($this->template, $data);
    }

    public function addStudentEducational($stid){
        if($this->general->checkPrivilege($this->nativesession->get('role'), 'p0002') != 1){
            $this->nativesession->set('error', 'Access Denied');
            redirect('admin/home');
        }

        $this->form_validation->set_rules('school', 'school name', 'required');
        $this->form_validation->set_rules('start', 'start year', 'required');
        $this->form_validation->set_rules('end', 'finish year', 'required');
        $this->form_validation->set_rules('highest', 'highest grade', 'required');
        $this->form_validation->set_rules('language', 'language', 'required');

        $id = $this->general->decryptParaID($stid, 'student');

        $this->form_validation->set_error_delimiters('', '<br/>');
        if ($this->form_validation->run() == TRUE) {
            $latestID =  $this->Admin_model->getStudentEducationalLatestID();
            if($latestID) {
                $latestID = $latestID['seid'];
                $latestID = substr($latestID, 1);
//                    ECHO $latestID;
                $latestID = 'e' . str_pad((int)$latestID + 1, 8, "0", STR_PAD_LEFT);
            } else {
                $latestID = 'e000000001';
            }
            $this->Admin_model->addStudentEducational($latestID, $id);
            $this->nativesession->set('success', 'Student Educational saved');



            $data['title'] = 'SMS';
            $data['student']  = $this->Student_model->getProfileDataByID($id);
            $data['admin'] = $this->Admin_model->getProfileDataByID($this->nativesession->get('id'));
            $data['allcourses']  = $this->Admin_model->getAllCourses();
            $data['allteacher']  = $this->Teacher_model->getAllTeacher();
            $data['eventnotif'] = $this->Admin_model->getAllEventsCount($this->nativesession->get('id'),$this->nativesession->get('lastlogin'));

            $data['studentEducational']  = $this->Admin_model->getStudentEducationalByID($id);
            $data['studentRecentSchool']  = $this->Admin_model->getStudentRecentSchoolByID($id);
            $data['studentRecentSchool']  = $this->Admin_model->getStudentRecentSchoolByID($id);
            $data['studentChildDevelopment']  = $this->Admin_model->getStudentChildDevelopmentDataByID($id);
            $data['studentHealthRecord']  = $this->Admin_model->getStudentHealthRecordDataByID($id);
            $data['studentVaccination']  = $this->Admin_model->getStudentVaccinationDataByID($id);
            $data['studentMedicalProblem']  = $this->Admin_model->getStudentMedicalProblemDataByID($id);
            $data['classes']  = $this->Admin_model->getAllClass();
            $data['sidebar'] = 'admin/admin_sidebar';
            $data['topnavigation'] = 'admin/admin_topnavigation';
            $data['content'] = 'admin/admin_edit_student_educational_view';
            $this->load->view($this->template, $data);

        }

        else {

                $this->nativesession->set('error', 'All field are required');
                redirect('admin/studentEducational/' . $id);
        }


    }

    public function editStudentEducational($id){
        if($this->general->checkPrivilege($this->nativesession->get('role'), 'p0003') != 1){
            $this->nativesession->set('error', 'Access Denied');
            redirect('admin/home');
        }
        $this->form_validation->set_rules('school', 'school name', 'required');
        $this->form_validation->set_rules('start', 'start year', 'required');
        $this->form_validation->set_rules('end', 'finish year', 'required');
        $this->form_validation->set_rules('highest', 'highest grade', 'required');
        $this->form_validation->set_rules('language', 'language', 'required');

        $this->form_validation->set_error_delimiters('', '<br/>');
        if ($this->form_validation->run() == TRUE) {
            $this->Admin_model->editStudentEducational($id);
            $this->nativesession->set('success', 'Student Educational saved');

            $data['title'] = 'SMS';
            $data['student']  = $this->Student_model->getProfileDataByID($id);
            $data['admin'] = $this->Admin_model->getProfileDataByID($this->nativesession->get('id'));
            $data['allcourses']  = $this->Admin_model->getAllCourses();
            $data['allteacher']  = $this->Teacher_model->getAllTeacher();
            $data['eventnotif'] = $this->Admin_model->getAllEventsCount($this->nativesession->get('id'),$this->nativesession->get('lastlogin'));

            $data['studentEducational']  = $this->Admin_model->getStudentEducationalByID($id);
            $data['studentRecentSchool']  = $this->Admin_model->getStudentRecentSchoolByID($id);
            $data['studentRecentSchool']  = $this->Admin_model->getStudentRecentSchoolByID($id);
            $data['studentChildDevelopment']  = $this->Admin_model->getStudentChildDevelopmentDataByID($id);
            $data['studentHealthRecord']  = $this->Admin_model->getStudentHealthRecordDataByID($id);
            $data['studentVaccination']  = $this->Admin_model->getStudentVaccinationDataByID($id);
            $data['studentMedicalProblem']  = $this->Admin_model->getStudentMedicalProblemDataByID($id);
            $data['classes']  = $this->Admin_model->getAllClass();
            $data['sidebar'] = 'admin/admin_sidebar';
            $data['topnavigation'] = 'admin/admin_topnavigation';
            $data['content'] = 'admin/admin_edit_student_educational_view';
            $this->load->view($this->template, $data);

        }

        else {

            $this->nativesession->set('error', 'All field are required');
            redirect('admin/studentEducational/' . $id);
        }
    }

    public function deleteStudentEducational($id, $stid){
        if($this->general->checkPrivilege($this->nativesession->get('role'), 'p0003') != 1){
            $this->nativesession->set('error', 'Access Denied');
            redirect('admin/home');
        }
        $did = $this->general->decryptParaID($id,'studenteducational');
        $stdtid = $this->general->decryptParaID($stid,'student');

        if($this->Admin_model->deleteStudentEducational($did)){
            $this->nativesession->set('success', 'Student Educational Deleted');
        }
        else{
            $this->nativesession->set('error', 'Failed to Delete Student Educational');
        }
        redirect('admin/studentEducational/' . $stid);
    }

    public function studentEducational($stid){
        if($this->general->checkPrivilege($this->nativesession->get('role'), 'p0003') != 1){
            $this->nativesession->set('error', 'Access Denied');
            redirect('admin/home');
        }
        $id = $this->general->decryptParaID($stid, 'student');

        $data['title'] = 'SMS';
        $data['student']  = $this->Student_model->getProfileDataByID($id);
        $data['admin'] = $this->Admin_model->getProfileDataByID($this->nativesession->get('id'));
        $data['allcourses']  = $this->Admin_model->getAllCourses();
        $data['allteacher']  = $this->Teacher_model->getAllTeacher();
        $data['eventnotif'] = $this->Admin_model->getAllEventsCount($this->nativesession->get('id'),$this->nativesession->get('lastlogin'));

        $data['studentEducational']  = $this->Admin_model->getStudentEducationalByID($id);
        $data['studentRecentSchool']  = $this->Admin_model->getStudentRecentSchoolByID($id);
        $data['studentRecentSchool']  = $this->Admin_model->getStudentRecentSchoolByID($id);
        $data['studentChildDevelopment']  = $this->Admin_model->getStudentChildDevelopmentDataByID($id);
        $data['studentHealthRecord']  = $this->Admin_model->getStudentHealthRecordDataByID($id);
        $data['studentVaccination']  = $this->Admin_model->getStudentVaccinationDataByID($id);
        $data['studentMedicalProblem']  = $this->Admin_model->getStudentMedicalProblemDataByID($id);
        $data['classes']  = $this->Admin_model->getAllClass();
        $data['sidebar'] = 'admin/admin_sidebar';
        $data['topnavigation'] = 'admin/admin_topnavigation';
        $data['content'] = 'admin/admin_edit_student_educational_view';
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

        $this->form_validation->set_rules('familyname', 'familyname', 'required');
        $this->form_validation->set_rules('firstname', 'firstname', 'required');
        $this->form_validation->set_rules('lastname', 'lastname', 'required');
        $this->form_validation->set_rules('gender', 'gender', 'required');
        $this->form_validation->set_rules('dateofbirth', 'date of birth', 'required');
        $this->form_validation->set_rules('placeofbirth', 'place of birth', 'required');
        $this->form_validation->set_rules('religion', 'religion', 'required');
        $this->form_validation->set_rules('phone', 'phone', 'required');
        $this->form_validation->set_rules('email', 'email', 'required|valid_email');
        $this->form_validation->set_rules('nationality', 'nationality', 'required');
        $this->form_validation->set_rules('ethnic', 'ethnic', 'required');
        $this->form_validation->set_rules('citizenship', 'citizenship', 'required');
        $this->form_validation->set_rules('passportcountry', 'passport country', 'required');
        $this->form_validation->set_rules('passportexpired', 'passport expired', 'required');
        $this->form_validation->set_rules('idcardtype', 'ID card type', 'required');
        $this->form_validation->set_rules('address', 'address', 'required');

        $this->form_validation->set_rules('rcname', 'recent school name', 'required');
        $this->form_validation->set_rules('rccontact', 'recent school contact person', 'required');
        $this->form_validation->set_rules('rcposition', 'recent school contact person position', 'required');
        $this->form_validation->set_rules('rcemail', 'recent school contact person email', 'required|valid_email');
        $this->form_validation->set_rules('rcphone', 'recent school contact person phone', 'required');
        $this->form_validation->set_rules('rcreason', 'reason leaving recent school', 'required');

        $this->form_validation->set_rules('cdlearningdiff', 'learning difficulties', 'required');
        $this->form_validation->set_rules('cdlearningdiffnature', 'nature of learning difficlties', 'required');
        $this->form_validation->set_rules('cdacademicsuport', 'academic difficulties', 'required');
        $this->form_validation->set_rules('cdacademicsuportnature', 'nature of academic support', 'required');
        $this->form_validation->set_rules('cdtalented', 'gift or talent', 'required');
        $this->form_validation->set_rules('cdtalenteddetail', 'nature of the gift', 'required');
        $this->form_validation->set_rules('cdnativelang', 'native language', 'required');
        $this->form_validation->set_rules('cdsecondlang', 'second language', 'required');
        $this->form_validation->set_rules('cdenglishproficiency', 'english proficiency', 'required');
        $this->form_validation->set_rules('cdlearningenglish', 'learning english duration', 'required');
        $this->form_validation->set_rules('cdlangathome', 'language at home', 'required');
        $this->form_validation->set_rules('cdlangproficient', 'other proficient language', 'required');
        $this->form_validation->set_rules('cdprevcountry', 'previous country residence', 'required');
        $this->form_validation->set_rules('cdstudiedotherlang', 'studied language  other than english', 'required');
        $this->form_validation->set_rules('cddifficultvocab', 'difficulties in acquiring language', 'required');
        $this->form_validation->set_rules('cdfirstlangSupport', 'first language support', 'required');
        $this->form_validation->set_rules('cdvocabEnglishSupportDetail', 'english suport detail', 'required');

        $this->form_validation->set_rules('hrallegies', 'allergies', 'required');
        $this->form_validation->set_rules('hrallegiesdetail', 'allergies detail', 'required');
        $this->form_validation->set_rules('hrmedication', 'required medication detail', 'required');
        $this->form_validation->set_rules('hrmedicationdetail', 'detail of required medication', 'required');
        $this->form_validation->set_rules('hrpsychologicalAssessment', 'psychological assessment', 'required');
        $this->form_validation->set_rules('hrpsychologicalAssessmentdetail', 'nature of psychological assessment', 'required');
        $this->form_validation->set_rules('hrhearingSpeechDifficulty', 'hearing and speech difficulty', 'required');
        $this->form_validation->set_rules('hrhearingSpeechDifficultydetail', 'nature of hearing and speech difficulty', 'required');
        $this->form_validation->set_rules('hrbehaviouralDifficulty', 'behavioural difficulty', 'required');
        $this->form_validation->set_rules('hrbehaviouralDifficultydetail', 'nature of behavioural difficulty', 'required');
        $this->form_validation->set_rules('hrother', 'other detail', 'required');
        $this->form_validation->set_rules('hrotherinformation', 'other comments/information', 'required');
        $this->form_validation->set_rules('hreyesight', 'eyesight', 'required');
        $this->form_validation->set_rules('hrhearing', 'hearing', 'required');
        $this->form_validation->set_rules('hrfoodallergies', 'food allergies', 'required');
        $this->form_validation->set_rules('hrissueexplanation', 'other issues explanation', 'required');
        $this->form_validation->set_rules('hrdocname', 'doctor name', 'required');
        $this->form_validation->set_rules('hrdocphone', 'doctor phone', 'required');
        $this->form_validation->set_rules('hrecname', 'emergency contact name', 'required');
        $this->form_validation->set_rules('hrecphone', 'emergency contact phone', 'required');
        $this->form_validation->set_rules('hrecrelationship', 'emergency contact relationship', 'required');

        $this->form_validation->set_rules('vchepatitisb', 'hepatitis b', 'required');
        $this->form_validation->set_rules('vchepatitisbyear', 'hepatitis b year', 'required');
        $this->form_validation->set_rules('vcmeasles', 'measles, mumps rubella', 'required');
        $this->form_validation->set_rules('vcmeaslesyear', 'measles, mumps rubella', 'required');
        $this->form_validation->set_rules('vcpolio', 'polio', 'required');
        $this->form_validation->set_rules('vcpolioyear', 'polio year', 'required');
        $this->form_validation->set_rules('vctetanus', 'tetanus', 'required');
        $this->form_validation->set_rules('vctetanusyear', 'tetanus year', 'required');
        $this->form_validation->set_rules('vchib', 'HiB', 'required');
        $this->form_validation->set_rules('vchibyear', 'HiB year', 'required');
        $this->form_validation->set_rules('vcmenzb', 'MenzB', 'required');
        $this->form_validation->set_rules('vcmenzbyear', 'MenzB year', 'required');
        $this->form_validation->set_rules('vcmenzb', 'MenzB', 'required');
        $this->form_validation->set_rules('vcmenzbyear', 'MenzB year', 'required');
        $this->form_validation->set_rules('vctb', 'TB', 'required');
        $this->form_validation->set_rules('vctbyear', 'TB year', 'required');

        $this->form_validation->set_rules('mp1', 'medical problem', 'required');
        $this->form_validation->set_rules('mp2', 'medical problem', 'required');
        $this->form_validation->set_rules('mp3', 'medical problem', 'required');
        $this->form_validation->set_rules('mp4', 'medical problem', 'required');
        $this->form_validation->set_rules('mp5', 'medical problem', 'required');
        $this->form_validation->set_rules('mp6', 'medical problem', 'required');
        $this->form_validation->set_rules('mp7', 'medical problem', 'required');
        $this->form_validation->set_rules('mp8', 'medical problem', 'required');


        $this->form_validation->set_error_delimiters('', '<br/>');

        if ($this->form_validation->run() == TRUE) {
            $this->Student_model->addStudent($newstudentid);
            $this->Admin_model->addStudentRecentSchool($newstudentid);
            $this->Admin_model->addStudentChildDevelopment($newstudentid);
            $this->Admin_model->addStudentHealthRecord($newstudentid);
            $this->Admin_model->addStudentVaccination($newstudentid);
            for($i=1;$i<10;$i++) {

                $latestID =  $this->Admin_model->getStudentMedicalProblemLatestID();
                if($latestID) {
                    $latestID = $latestID['hpid'];
                    $latestID = substr($latestID, 1);
//                    ECHO $latestID;
                    $latestID = 'h' . str_pad((int)$latestID + 1, 8, "0", STR_PAD_LEFT);
                } else {
                    $latestID = 'h000000001';
                }
                $hpid = $latestID;
                $stdid = $newstudentid;
                $prob = $this->input->post('mp'.$i.'problem');
                $status = $this->input->post('mp'.$i);
                $severity = $this->input->post('mp'.$i.'severity');
                $med = $this->input->post('mp'.$i.'medication');
                $act = $this->input->post('mp'.$i.'action');
//                echo "NOMOR ".$i;
//                echo $hpid.";  ".$stdid.";  ".$prob.";  ".$status;
                $this->Admin_model->addStudentMedicalProblem($hpid, $stdid, $prob, $status, $severity, $med, $act);

            }


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
            } else {
                if ($this->Student_model->editProfilePhoto($newstudentid, "default.png")) {
                    $this->nativesession->set('success', 'Photo Changed');
                }
            }
            $this->nativesession->set('success', 'New Student Added');
            $eid = $this->general->encryptParaID($newstudentid, 'student');
            redirect('admin/editStudent/'.$eid);
        }

        $data['title'] = 'School Administrator SMS';
        $data['admin'] = $this->Admin_model->getProfileDataByID($this->nativesession->get('id'));
        $data['allcourses']  = $this->Admin_model->getAllCourses();
        $data['allteacher']  = $this->Teacher_model->getAllTeacher();
        $data['sidebar'] = 'admin/admin_sidebar';
        $data['topnavigation'] = 'admin/admin_topnavigation';
        $data['eventnotif'] = $this->Admin_model->getAllEventsCount($this->nativesession->get('id'),$this->nativesession->get('lastlogin'));

        $data['classes']  = $this->Admin_model->getAllClass();
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
        $data['allteacher']  = $this->Teacher_model->getAllTeacher();
        $data['eventnotif'] = $this->Admin_model->getAllEventsCount($this->nativesession->get('id'),$this->nativesession->get('lastlogin'));

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
        $data['allteacher']  = $this->Teacher_model->getAllTeacher();
        $data['eventnotif'] = $this->Admin_model->getAllEventsCount($this->nativesession->get('id'),$this->nativesession->get('lastlogin'));

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
            else {
                if ($this->Parent_model->editProfilePhoto($newsparentid, "default.png")) {
                    $this->nativesession->set('success', 'Photo Changed');
                }
            }
            $this->nativesession->set('success', 'New Parent Added');
            $eid = $this->general->encryptParaID($newsparentid, 'parent');
            redirect('admin/editParent/'.$eid);
        }

        $data['title'] = 'School Administrator SMS';
        $data['admin'] = $this->Admin_model->getProfileDataByID($this->nativesession->get('id'));
        $data['allcourses']  = $this->Admin_model->getAllCourses();
        $data['allteacher']  = $this->Teacher_model->getAllTeacher();
        $data['eventnotif'] = $this->Admin_model->getAllEventsCount($this->nativesession->get('id'),$this->nativesession->get('lastlogin'));

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
        $data['allteacher']  = $this->Teacher_model->getAllTeacher();
        $data['eventnotif'] = $this->Admin_model->getAllEventsCount($this->nativesession->get('id'),$this->nativesession->get('lastlogin'));

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
        $data['allteacher']  = $this->Teacher_model->getAllTeacher();
        $data['eventnotif'] = $this->Admin_model->getAllEventsCount($this->nativesession->get('id'),$this->nativesession->get('lastlogin'));

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
        $data['allteacher']  = $this->Teacher_model->getAllTeacher();
        $data['topnavigation'] = 'admin/admin_topnavigation';
        $data['eventnotif'] = $this->Admin_model->getAllEventsCount($this->nativesession->get('id'),$this->nativesession->get('lastlogin'));

        $data['classes']  = $this->Admin_model->getAllClass();
        $data['sidebar'] = 'admin/admin_sidebar';
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
        $data['allteacher']  = $this->Teacher_model->getAllTeacher();
        $data['eventnotif'] = $this->Admin_model->getAllEventsCount($this->nativesession->get('id'),$this->nativesession->get('lastlogin'));

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
        $data['allteacher']  = $this->Teacher_model->getAllTeacher();
        $data['sidebar'] = 'admin/admin_sidebar';
        $data['topnavigation'] = 'admin/admin_topnavigation';
        $data['eventnotif'] = $this->Admin_model->getAllEventsCount($this->nativesession->get('id'),$this->nativesession->get('lastlogin'));

        $data['classes']  = $this->Admin_model->getAllClass();
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
        $data['allteacher']  = $this->Teacher_model->getAllTeacher();
        $data['sidebar'] = 'admin/admin_sidebar';
        $data['topnavigation'] = 'admin/admin_topnavigation';
        $data['eventnotif'] = $this->Admin_model->getAllEventsCount($this->nativesession->get('id'),$this->nativesession->get('lastlogin'));

        $data['classes']  = $this->Admin_model->getAllClass();
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
        $data['allteacher']  = $this->Teacher_model->getAllTeacher();
        $data['sidebar'] = 'admin/admin_sidebar';
        $data['eventnotif'] = $this->Admin_model->getAllEventsCount($this->nativesession->get('id'),$this->nativesession->get('lastlogin'));

        $data['classes']  = $this->Admin_model->getAllClass();
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
        $data['allteacher']  = $this->Teacher_model->getAllTeacher();
        $data['topnavigation'] = 'admin/admin_topnavigation';
        $data['sidebar'] = 'admin/admin_sidebar';
        $data['eventnotif'] = $this->Admin_model->getAllEventsCount($this->nativesession->get('id'),$this->nativesession->get('lastlogin'));

        $data['classes']  = $this->Admin_model->getAllClass();
        $data['roles'] = $this->Admin_model->getAllRoles();
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
        $data['allteacher']  = $this->Teacher_model->getAllTeacher();
        $data['eventnotif'] = $this->Admin_model->getAllEventsCount($this->nativesession->get('id'),$this->nativesession->get('lastlogin'));

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
        $data['allteacher']  = $this->Teacher_model->getAllTeacher();
        $data['eventnotif'] = $this->Admin_model->getAllEventsCount($this->nativesession->get('id'),$this->nativesession->get('lastlogin'));

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
            redirect('admin/home');
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
        $data['allteacher']  = $this->Teacher_model->getAllTeacher();
        $data['classes']  = $this->Admin_model->getAllClass();
        $data['eventnotif'] = $this->Admin_model->getAllEventsCount($this->nativesession->get('id'),$this->nativesession->get('lastlogin'));

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
            redirect('admin/home');
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
        $data['allteacher']  = $this->Teacher_model->getAllTeacher();
        $data['topnavigation'] = 'admin/admin_topnavigation';
        $data['sidebar'] = 'admin/admin_sidebar';
        $data['eventnotif'] = $this->Admin_model->getAllEventsCount($this->nativesession->get('id'),$this->nativesession->get('lastlogin'));

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
        $data['allteacher']  = $this->Teacher_model->getAllTeacher();
        $data['sidebar'] = 'admin/admin_sidebar';
        $data['eventnotif'] = $this->Admin_model->getAllEventsCount($this->nativesession->get('id'),$this->nativesession->get('lastlogin'));

        $data['classes']  = $this->Admin_model->getAllClass();
        $data['classroom']  = $this->general->getClassroom($classid);
        $data['classid']  = $classid;
        $data['content'] = 'admin/admin_attendance_inclass_view';
        $this->load->view($this->template, $data);

    }

    public function addCourse()
    {
        if($this->general->checkPrivilege($this->nativesession->get('role'), 'p0013') != 1){
            $this->nativesession->set('error', 'Access Denied');
            redirect('admin/home');
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
        $data['allteacher']  = $this->Teacher_model->getAllTeacher();
        $data['eventnotif'] = $this->Admin_model->getAllEventsCount($this->nativesession->get('id'),$this->nativesession->get('lastlogin'));

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
        $data['allteacher']  = $this->Teacher_model->getAllTeacher();
        $data['eventnotif'] = $this->Admin_model->getAllEventsCount($this->nativesession->get('id'),$this->nativesession->get('lastlogin'));

        $data['info_dbs'] = $this->Teacher_model->getAllCourses();
        $data['content'] = 'admin/admin_courses_list_view';
        $this->load->view($this->template, $data);
    }

    public function editCourse($fid)
    {
        if($this->general->checkPrivilege($this->nativesession->get('role'), 'p0014') != 1){
            $this->nativesession->set('error', 'Access Denied');
            redirect('admin/home');
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
        $data['allteacher']  = $this->Teacher_model->getAllTeacher();
        $data['eventnotif'] = $this->Admin_model->getAllEventsCount($this->nativesession->get('id'),$this->nativesession->get('lastlogin'));

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
        $data['admin'] = $this->Admin_model->getProfileDataByID($this->nativesession->get('id'));
        $data['topnavigation'] = 'admin/admin_topnavigation';
        $data['sidebar'] = 'admin/admin_sidebar';
        $data['classes']  = $this->Admin_model->getAllClass();
        $data['allcourses']  = $this->Admin_model->getAllCourses();
        $data['top2navigation'] = 'admin/admin_top2navigation';
        $data['allteacher']  = $this->Teacher_model->getAllTeacher();
        $data['eventnotif'] = $this->Admin_model->getAllEventsCount($this->nativesession->get('id'),$this->nativesession->get('lastlogin'));

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
        $data['admin'] = $this->Admin_model->getProfileDataByID($this->nativesession->get('id'));
        $data['topnavigation'] = 'admin/admin_topnavigation';
        $data['sidebar'] = 'admin/admin_sidebar';
        $data['classes']  = $this->Admin_model->getAllClass();
        $data['allcourses']  = $this->Admin_model->getAllCourses();
        $data['top2navigation'] = 'admin/admin_top2navigation';
        $data['allteacher']  = $this->Teacher_model->getAllTeacher();
        $data['eventnotif'] = $this->Admin_model->getAllEventsCount($this->nativesession->get('id'),$this->nativesession->get('lastlogin'));

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
            redirect('admin/home');
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
        $data['admin'] = $this->Admin_model->getProfileDataByID($this->nativesession->get('id'));
        $data['topnavigation'] = 'admin/admin_topnavigation';
        $data['sidebar'] = 'admin/admin_sidebar';
        $data['classes']  = $this->Admin_model->getAllClass();
        $data['allcourses']  = $this->Admin_model->getAllCourses();
        $data['top2navigation'] = 'admin/admin_top2navigation';
        $data['allteacher']  = $this->Teacher_model->getAllTeacher();
        $data['eventnotif'] = $this->Admin_model->getAllEventsCount($this->nativesession->get('id'),$this->nativesession->get('lastlogin'));

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
        $data['admin'] = $this->Admin_model->getProfileDataByID($this->nativesession->get('id'));
        $data['topnavigation'] = 'admin/admin_topnavigation';
        $data['sidebar'] = 'admin/admin_sidebar';
        $data['classes']  = $this->Admin_model->getAllClass();
        $data['allcourses']  = $this->Admin_model->getAllCourses();
        $data['top2navigation'] = 'admin/admin_top2navigation';
        $data['allteacher']  = $this->Teacher_model->getAllTeacher();
        $data['eventnotif'] = $this->Admin_model->getAllEventsCount($this->nativesession->get('id'),$this->nativesession->get('lastlogin'));

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
        $data['admin'] = $this->Admin_model->getProfileDataByID($this->nativesession->get('id'));
        $data['topnavigation'] = 'admin/admin_topnavigation';
        $data['sidebar'] = 'admin/admin_sidebar';
        $data['classes']  = $this->Admin_model->getAllClass();
        $data['allcourses']  = $this->Admin_model->getAllCourses();
        $data['top2navigation'] = 'admin/admin_top2navigation';
        $data['allteacher']  = $this->Teacher_model->getAllTeacher();
        $data['eventnotif'] = $this->Admin_model->getAllEventsCount($this->nativesession->get('id'),$this->nativesession->get('lastlogin'));

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
        $data['admin'] = $this->Admin_model->getProfileDataByID($this->nativesession->get('id'));
        $data['topnavigation'] = 'admin/admin_topnavigation';
        $data['sidebar'] = 'admin/admin_sidebar';
        $data['classes']  = $this->Admin_model->getAllClass();
        $data['allcourses']  = $this->Admin_model->getAllCourses();
        $data['top2navigation'] = 'admin/admin_top2navigation';
        $data['allteacher']  = $this->Teacher_model->getAllTeacher();
        $data['eventnotif'] = $this->Admin_model->getAllEventsCount($this->nativesession->get('id'),$this->nativesession->get('lastlogin'));

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
        $data['admin'] = $this->Admin_model->getProfileDataByID($this->nativesession->get('id'));
        $data['topnavigation'] = 'admin/admin_topnavigation';
        $data['sidebar'] = 'admin/admin_sidebar';
        $data['classes']  = $this->Admin_model->getAllClass();
        $data['allcourses']  = $this->Admin_model->getAllCourses();
        $data['top2navigation'] = 'admin/admin_top2navigation';
        $data['allteacher']  = $this->Teacher_model->getAllTeacher();
        $data['eventnotif'] = $this->Admin_model->getAllEventsCount($this->nativesession->get('id'),$this->nativesession->get('lastlogin'));

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
        $data['admin'] = $this->Admin_model->getProfileDataByID($this->nativesession->get('id'));
        $data['topnavigation'] = 'admin/admin_topnavigation';
        $data['sidebar'] = 'admin/admin_sidebar';
        $data['classes']  = $this->Admin_model->getAllClass();
        $data['allcourses']  = $this->Admin_model->getAllCourses();
        $data['top2navigation'] = 'admin/admin_top2navigation';
        $data['allteacher']  = $this->Teacher_model->getAllTeacher();
        $data['eventnotif'] = $this->Admin_model->getAllEventsCount($this->nativesession->get('id'),$this->nativesession->get('lastlogin'));

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
        $data['admin'] = $this->Admin_model->getProfileDataByID($this->nativesession->get('id'));
        $data['topnavigation'] = 'admin/admin_topnavigation';
        $data['sidebar'] = 'admin/admin_sidebar';
        $data['classes']  = $this->Admin_model->getAllClass();
        $data['allcourses']  = $this->Admin_model->getAllCourses();
        $data['top2navigation'] = 'admin/admin_top2navigation';
        $data['allteacher']  = $this->Teacher_model->getAllTeacher();
        $data['eventnotif'] = $this->Admin_model->getAllEventsCount($this->nativesession->get('id'),$this->nativesession->get('lastlogin'));

        $info = $this->Teacher_model->getCourseDataByAssignID($id);
        $data['info_db'] = $info;
        $data['qna'] = $this->Teacher_model->getQnA($qid);
        $data['submit'] = $this->Teacher_model->getSubmission($qid);
        $classid = $info['classid'];
        $students = $this->Teacher_model->getStudentsByClassID($classid);
        $i=0;
        $latestID = $this->Teacher_model->getScoreLatestID();
        $latestID = $latestID['anqscoreid'];
        $notfound =  NULL;
        if( $students) {
            foreach ($students as $student) {
                if ($found = $this->Teacher_model->checkNoSubmission($student['studentid'], $qid)) {
                } else {
                    echo "i" . $i;
                    $latestID = substr($latestID, 1);
                    $latestID = 'n' . str_pad((int)$latestID + 1, 4, "0", STR_PAD_LEFT);
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
        }
        $data['nosubmit'] = $notfound;
        $data['content'] = 'admin/admin_course_qna_submission_view';
        $this->load->view($this->template, $data);
    }

    public function courseSubmissionGrading($id, $nid){
        $id = $this->general->decryptParaID($id, 'courseassigned');
        echo $nid;
        $nid = $this->general->decryptParaID($nid, 'anqscore');

        $this->form_validation->set_rules('score', 'Score', 'required');
        $this->form_validation->set_error_delimiters('', '<br/>');

        if ($this->form_validation->run() == TRUE) {
            if($result = $this->Teacher_model->checkSubmission($nid)){
                $this->Teacher_model->editSubmission($nid);
            }
            else{
                $this->Teacher_model->addSubmission($nid);
                echo "wrog";
            }

            $this->nativesession->set('success', 'Score updated');
            $qid = $this->Teacher_model->checkSubmission($nid);
            $qid = $qid['anqid'];

            $eid = $this->general->encryptParaID($id, 'courseassigned');
            $qid = $this->general->encryptParaID($qid, 'anq');
            redirect('admin/courseAssignmentQuizSubmission/'.$eid.'/'.$qid);
        }
    }

    public function sendQnAEmailToAll($id, $qid){
        $id = $this->general->decryptParaID($id, 'courseassigned');
        $qid = $this->general->decryptParaID($qid, 'anq');

        $info = $this->Teacher_model->getCourseDataByAssignID($id);
        $qnainfo = $this->Teacher_model->getQnA($qid);
        $students = $this->Teacher_model->getStudentsByClassID($info['classid']);
        $emaillist = array();
        foreach ($students as $student) {
            if($found = $this->Teacher_model->checkNoSubmission($student['studentid'], $qid)){
            }
            else{
                array_push($emaillist, $student['email']);
            }
        }

        $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_port' => 465,
            'smtp_user' => 'healthybonefamily@gmail.com',
            'smtp_pass' => 'healthybonefamilycb4',
        );

        $this->load->library('email', $config);
        $this->email->set_newline('\r\n');
        $this->email->from('healthybonefamily@gmail.com', 'SMS');
        $this->email->to($emaillist);
        $this->email->subject($info['coursename'].' '.$qnainfo['type'].' Notification');
        $this->email->message('This is the notification for:
        Course : '.$info['coursename'].'
        Type : '.$qnainfo['type'].'
        Due Date : '.$qnainfo['duedate'].'');

        if($this->email->send())
            $this->nativesession->set("success","Email sent successfully.");
        else
            $this->nativesession->set("error",$this->email->print_debugger());

        $eid = $this->general->encryptParaID($id, 'courseassigned');
        $qid = $this->general->encryptParaID($qid, 'anq');
        redirect('admin/courseAssignmentQuizSubmission/'.$eid.'/'.$qid);

        return TRUE;
    }

    public function sendQnAEmail($sid, $qid)
    {
        $sid = $this->general->decryptParaID($sid, 'student');
        $qid = $this->general->decryptParaID($qid, 'anq');


        $qnainfo = $this->Teacher_model->getQnA($qid);
        $assign = $this->Teacher_model->getAssignDataByQuizID($qid);
        $info = $this->Teacher_model->getCourseDataByAssignID($assign['assignid']);
        $student = $this->Teacher_model->getStudentDataByStudentID($sid);

        $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_port' => 465,
            'smtp_user' => 'healthybonefamily@gmail.com',
            'smtp_pass' => 'healthybonefamilycb4',
        );

        $this->load->library('email', $config);
        $this->email->set_newline('\r\n');
        $this->email->from('healthybonefamily@gmail.com', 'SMS');
        $this->email->to($student['email']);
        $this->email->subject($info['coursename'].' '.$qnainfo['type'].' Notification');
        $this->email->message('This is the notification for:
            Course : '.$info['coursename'].'
            Type : '.$qnainfo['type'].'
            Due Date : '.$qnainfo['duedate'].'');

        if($this->email->send())
            $this->nativesession->set("success","Email sent successfully.");
        else
            $this->nativesession->set("error",$this->email->print_debugger());

        $eid = $this->general->encryptParaID($assign['assignid'], 'courseassigned');
        $qid = $this->general->encryptParaID($qid, 'anq');
        redirect('admin/courseAssignmentQuizSubmission/'.$eid.'/'.$qid);

        return TRUE;

    }

    public function courseStudent($id){
        $id = $this->general->decryptParaID($id, 'courseassigned');
        $data['title'] = 'SMS';
        $data['admin'] = $this->Admin_model->getProfileDataByID($this->nativesession->get('id'));
        $data['topnavigation'] = 'admin/admin_topnavigation';
        $data['sidebar'] = 'admin/admin_sidebar';
        $data['classes']  = $this->Admin_model->getAllClass();
        $data['allcourses']  = $this->Admin_model->getAllCourses();
        $data['top2navigation'] = 'admin/admin_top2navigation';
        $data['allteacher']  = $this->Teacher_model->getAllTeacher();
        $data['eventnotif'] = $this->Admin_model->getAllEventsCount($this->nativesession->get('id'),$this->nativesession->get('lastlogin'));

        $info = $this->Teacher_model->getCourseDataByAssignID($id);
        $data['info_db'] = $info;
        $classid = $info['classid'];
        $data['students'] = $this->Teacher_model->getStudentsByClassID($classid);
        $data['content'] = 'admin/admin_course_student_view';
        $this->load->view($this->template, $data);
    }

    public function courseStudentPerformance($assignid, $studentid){
        $assignid = $this->general->decryptParaID($assignid, 'courseassigned');
        $studentid = $this->general->decryptParaID($studentid, 'student');
        $eid = $this->general->encryptParaID($assignid, 'courseassigned');
        $esid = $this->general->encryptParaID($studentid, 'student');

        $class = $this->Teacher_model->getClassByStudentID($studentid);
        $class = explode('-', $class['classroom']);

        $a = $this->Teacher_model->getSetting('s0014');
        $amin = $this->Teacher_model->getSetting('s0015');
        $b = $this->Teacher_model->getSetting('s0016');
        $bplus = $this->Teacher_model->getSetting('s0017');
        $bmin = $this->Teacher_model->getSetting('s0018');
        $c = $this->Teacher_model->getSetting('s0019');
        $cplus = $this->Teacher_model->getSetting('s0020');
        $d = $this->Teacher_model->getSetting('s0021');

        $homeworkevaluation = $this->Teacher_model->getSetting('s0022');
        $classworkevaluation = $this->Teacher_model->getSetting('s0023');
        $assessmentevaluation = $this->Teacher_model->getSetting('s0024');
        $examevaluation = $this->Teacher_model->getSetting('s0025');

        $homework = $this->Teacher_model->getAllQnAByStudent($studentid, $assignid, 1);
        $homeworkscore = 0;
        foreach ($homework as $h){
            $homeworkscore = $homeworkscore + $h['score'];
        }
        $homeworkscore = $homeworkscore/sizeof($homework);
        $homeworkscore = $homeworkscore * $homeworkevaluation['value'] / 100;

        $classwork = $this->Teacher_model->getAllQnAByStudent($studentid, $assignid, 2);
        $classworkscore = 0;
        foreach ($classwork as $h){
            $classworkscore = $classworkscore + $h['score'];
        }
        $classworkscore = $classworkscore/sizeof($classwork);
        $classworkscore = $classworkscore * $classworkevaluation['value'] / 100;

        $assessment = $this->Teacher_model->getAllQnAByStudent($studentid, $assignid, 3);
        $assessmentscore = 0;
        foreach ($assessment as $h){
            $assessmentscore = $assessmentscore + $h['score'];
        }
        $assessmentscore = $assessmentscore/sizeof($assessment);
        $assessmentscore = $assessmentscore * $assessmentevaluation['value'] / 100;

        $savebutton = $this->input->post('savebutton');
        if($savebutton == 'term1'){
            $this->form_validation->set_rules('op1', 'Mid Term Is self-motivated', 'required');
            $this->form_validation->set_rules('op2', 'Mid Term Shows initiatives and asks questions', 'required');
            $this->form_validation->set_rules('op3', 'Mid Term Persists despite difficulties', 'required');
            $this->form_validation->set_rules('op4', 'Mid Term Is well-organised and punctual', 'required');
            $this->form_validation->set_rules('op5', 'Mid Term Completes classroom tasks', 'required');
            $this->form_validation->set_rules('op6', 'Mid Term Completes homework on time', 'required');
            $this->form_validation->set_error_delimiters('', '<br/>');

            if ($this->form_validation->run() == TRUE) {
                if($result = $this->Teacher_model->checkReport($assignid, $studentid, 1)){
                    $this->Teacher_model->editTerm1Report($result['reportid']);
                }
                else{
                    $latestID = $this->Teacher_model->getReportLatestID();
                    $latestID = $latestID['reportid'];
                    $latestID = substr($latestID, 1);
                    $latestID = 'r'.str_pad((int) $latestID+1, 4, "0", STR_PAD_LEFT);
                    $this->Teacher_model->addMidReport($latestID, $assignid, $studentid, $class[0]);
                }
                $this->nativesession->set('success', 'Report saved');
            }
            redirect('admin/courseStudentPerformance/'.$eid.'/'.$esid);
        }
        else if($savebutton == 'term2'){
            $this->form_validation->set_rules('mark', 'Mid Term Exam Mark', 'required');
//            $this->form_validation->set_rules('grade', 'Mid Term Course Grade', 'required');
            $this->form_validation->set_rules('comment', 'Mid Term Comment', 'required');
            $this->form_validation->set_error_delimiters('', '<br/>');

            if ($this->form_validation->run() == TRUE) {
                if($result = $this->Teacher_model->checkReport($assignid, $studentid, 1)){
                    $examscore = $this->input->post('mark') * $examevaluation['value'] / 100;
                    $totalscore = $homeworkscore + $classworkscore + $assessmentscore + $examscore;
                    if($totalscore >= $a['value']){
                        $grade = 'A';
                    }
                    elseif($totalscore >= $amin['value'] && $totalscore < $a['value']){
                        $grade = 'A-';
                    }
                    elseif($totalscore >= $bplus['value'] && $totalscore < $amin['value']){
                        $grade = 'B+';
                    }
                    elseif($totalscore >= $b['value'] && $totalscore < $bplus['value']){
                        $grade = 'B';
                    }
                    elseif($totalscore >= $bmin['value'] && $totalscore < $b['value']){
                        $grade = 'B-';
                    }
                    elseif($totalscore >= $cplus['value'] && $totalscore < $bmin['value']){
                        $grade = 'C+';
                    }
                    elseif($totalscore >= $c['value'] && $totalscore < $cplus['value']){
                        $grade = 'C';
                    }
                    elseif($totalscore >= $d['value'] && $totalscore < $c['value']){
                        $grade = 'D';
                    }
                    elseif($totalscore < $d['value']){
                        $grade = 'E';
                    }
                    $this->Teacher_model->editMidReport($result['reportid'], $grade);
                    $this->nativesession->set('success', 'Report saved');
                }
            }
            redirect('admin/courseStudentPerformance/'.$eid.'/'.$esid);
        }
        else if($savebutton == 'term3'){
            $this->form_validation->set_rules('opf1', 'Final Term Is self-motivated', 'required');
            $this->form_validation->set_rules('opf2', 'Final Term Shows initiatives and asks questions', 'required');
            $this->form_validation->set_rules('opf3', 'Final Term Persists despite difficulties', 'required');
            $this->form_validation->set_rules('opf4', 'Final Term Is well-organised and punctual', 'required');
            $this->form_validation->set_rules('opf5', 'Final Term Completes classroom tasks', 'required');
            $this->form_validation->set_rules('opf6', 'Final Term Completes homework on time', 'required');
            $this->form_validation->set_error_delimiters('', '<br/>');

            if ($this->form_validation->run() == TRUE) {
                if($result = $this->Teacher_model->checkReport($assignid, $studentid, 2)){
                    $this->Teacher_model->editTerm3Report($result['reportid']);
                }
                else{
                    $latestID = $this->Teacher_model->getReportLatestID();
                    $latestID = $latestID['reportid'];
                    $latestID = substr($latestID, 1);
                    $latestID = 'r'.str_pad((int) $latestID+1, 4, "0", STR_PAD_LEFT);
                    $this->Teacher_model->addFinalReport($latestID, $assignid, $studentid, $class[0]);
                }
                $this->nativesession->set('success', 'Report saved');
            }
            redirect('admin/courseStudentPerformance/'.$eid.'/'.$esid);
        }
        else if($savebutton == 'term4'){
            $this->form_validation->set_rules('mark', 'Mid Term Exam Mark', 'required');
//            $this->form_validation->set_rules('grade', 'Mid Term Course Grade', 'required');
            $this->form_validation->set_rules('comment', 'Mid Term Comment', 'required');
            $this->form_validation->set_error_delimiters('', '<br/>');

            if ($this->form_validation->run() == TRUE) {
                if($result = $this->Teacher_model->checkReport($assignid, $studentid, 2)){
                    $examscore = $this->input->post('fmark') * $examevaluation['value'] / 100;
                    $totalscore = $homeworkscore + $classworkscore + $assessmentscore + $examscore;
                    if($totalscore >= $a['value']){
                        $grade = 'A';
                    }
                    elseif($totalscore >= $amin['value'] && $totalscore < $a['value']){
                        $grade = 'A-';
                    }
                    elseif($totalscore >= $bplus['value'] && $totalscore < $amin['value']){
                        $grade = 'B+';
                    }
                    elseif($totalscore >= $b['value'] && $totalscore < $bplus['value']){
                        $grade = 'B';
                    }
                    elseif($totalscore >= $bmin['value'] && $totalscore < $b['value']){
                        $grade = 'B-';
                    }
                    elseif($totalscore >= $cplus['value'] && $totalscore < $bmin['value']){
                        $grade = 'C+';
                    }
                    elseif($totalscore >= $c['value'] && $totalscore < $cplus['value']){
                        $grade = 'C';
                    }
                    elseif($totalscore >= $d['value'] && $totalscore < $c['value']){
                        $grade = 'D';
                    }
                    elseif($totalscore < $d['value']){
                        $grade = 'E';
                    }
                    $this->Teacher_model->editFinalReport($result['reportid'], $grade);
                    $this->nativesession->set('success', ''.$totalscore.' '.$homeworkscore.' '.''.$classworkscore.' '.$assessmentscore.' '.$examscore.'');
                }
            }
            redirect('admin/courseStudentPerformance/'.$eid.'/'.$esid);
        }

        $data['homework'] = $this->Teacher_model->getAllQnAByStudent($studentid, $assignid, 1);
        $data['classwork'] = $this->Teacher_model->getAllQnAByStudent($studentid, $assignid, 2);
        $data['assessment'] = $this->Teacher_model->getAllQnAByStudent($studentid, $assignid, 3);


        $data['title'] = 'SMS';
        $data['admin'] = $this->Admin_model->getProfileDataByID($this->nativesession->get('id'));
        $data['topnavigation'] = 'admin/admin_topnavigation';
        $data['sidebar'] = 'admin/admin_sidebar';
        $data['classes']  = $this->Admin_model->getAllClass();
        $data['allcourses']  = $this->Admin_model->getAllCourses();
        $data['top2navigation'] = 'admin/admin_top2navigation';
        $data['allteacher']  = $this->Teacher_model->getAllTeacher();
        $data['eventnotif'] = $this->Admin_model->getAllEventsCount($this->nativesession->get('id'),$this->nativesession->get('lastlogin'));

        $data['info_db'] = $this->Teacher_model->getCourseDataByAssignID($assignid);
        $data['student'] = $this->Teacher_model->getStudentDataByStudentID($studentid);
        $data['report'] = $this->Teacher_model->getReportDataBy($assignid, $studentid);
        $data['content'] = 'admin/admin_course_student_performance_view';
        $this->load->view($this->template, $data);
    }

    public function createSchedule()
    {
        $data['title'] = 'SMS';
        $data['admin'] = $this->Admin_model->getProfileDataByID($this->nativesession->get('id'));
        $data['topnavigation'] = 'admin/admin_topnavigation';
        $data['sidebar'] = 'admin/admin_sidebar';
        $data['classes']  = $this->Admin_model->getAllClass();
        $data['allcourses']  = $this->Admin_model->getAllCourses();
        $data['allteacher']  = $this->Teacher_model->getAllTeacher();
        $data['eventnotif'] = $this->Admin_model->getAllEventsCount($this->nativesession->get('id'),$this->nativesession->get('lastlogin'));

        $data['teachers'] = $this->Teacher_model->getAllTeacher();
        $data['coursesList'] = $this->Teacher_model->getAllCourses();
        $data['assign'] = $this->Teacher_model->getAllScheduleSetting();
        $data['content'] = 'admin/admin_create_schedule_view';
        $this->load->view($this->template, $data);
    }

    public function generateSchedule()
    {
        $day = $this->Teacher_model->getSetting('s0005');
        $period = $this->Teacher_model->getSetting('s0006');

        $allclass = $this->Teacher_model->getAllClasses();
        $tablecount = 1;
        foreach ($allclass as $class) {
            ${"table" . $tablecount} = array('');
            ${"grade" . $class['classroom']} = $this->Teacher_model->getAllCourseForGrade($class['classid']);
            $tablecount++;
        }

        $schedule = array('');

//        $done = false;
//        $retry = true;

//        while($done == false){
//            if($retry == true){
//                $grade1 = $this->Teacher_model->getAllCourseForGrade(1);
//                $grade2 = $this->Teacher_model->getAllCourseForGrade(2);
//                $grade3 = $this->Teacher_model->getAllCourseForGrade(3);
//                $grade4 = $this->Teacher_model->getAllCourseForGrade(4);
//                $grade5 = $this->Teacher_model->getAllCourseForGrade(5);
//                $grade6 = $this->Teacher_model->getAllCourseForGrade(6);
//                $grade7 = $this->Teacher_model->getAllCourseForGrade(7);
//                $grade8 = $this->Teacher_model->getAllCourseForGrade(8);
//                $grade9 = $this->Teacher_model->getAllCourseForGrade(9);
//                $grade10 = $this->Teacher_model->getAllCourseForGrade('A');
//                $grade11 = $this->Teacher_model->getAllCourseForGrade('B');
//                $grade12 = $this->Teacher_model->getAllCourseForGrade('C');
//                $grade13 = $this->Teacher_model->getAllCourseForGrade('D');
//
//                $table1 = null;
//                $table2 = null;
//                $table3 = null;
//                $table4 = null;
//                $table5 = null;
//                $table6 = null;
//                $table7 = null;
//                $table8 = null;
//                $table9 = null;
//                $table10 = null;
//                $table11 = null;
//                $table12 = null;
//                $table13 = null;
//
//                $retry = false;
//            }
//            else{
        $currentTable = 1;
        for($i=1; $i<sizeof($allclass)+1; $i++){
            if(isset(${'grade'.$allclass[$i-1]['classroom']})){
                for($a=0; $a<$period['value']; $a++){
                    for($b=0; $b<$day['value']; $b++){
                        unset($availablecourse);
                        $availablecourse = ${'grade'.$allclass[$i-1]['classroom']};
                        $availablecourseExist = false;

                        for($j=1; $j<$currentTable; $j++){
                            $currentindex = 0;
                            foreach ($availablecourse as $available){
                                if(isset(${'table'.$j}[$a][$b]) && ${'table'.$j}[$a][$b]['teacherid'] == $available['teacherid']){
                                    unset($availablecourse[$currentindex]);
                                    $availablecourse = array_values($availablecourse);
                                    $availablecourseExist = true;
                                    break;
                                }
                                $currentindex++;
                            }
                        }

                        for($c=0; $c<$a; $c++){
                            $currentindex = 0;
                            foreach ($availablecourse as $available){
                                if(isset(${'table'.$i}[$c][$b]) && ${'table'.$i}[$c][$b]['courseid'] == $available['courseid']){
                                    unset($availablecourse[$currentindex]);
                                    $availablecourse = array_values($availablecourse);
                                    $availablecourseExist = true;
                                    break;
                                }
                                $currentindex++;
                            }
                        }

                        $allteacher = $this->Teacher_model->getAllTeacher();
                        foreach ($allteacher as $t) {
                            $worktimestring = substr($t['workinghour'], 1, strlen($t['workinghour']));
                            $worktime = explode('|', $worktimestring);
                            if(isset($worktime[$a*$day['value']+$b]) && $worktime[$a*$day['value']+$b] == '0'){
                                $currentindex = 0;
                                foreach ($availablecourse as $available){
                                    if($t['teacherid'] == $available['teacherid']){
                                        unset($availablecourse[$currentindex]);
                                        $availablecourse = array_values($availablecourse);
                                        $availablecourseExist = true;
                                        break;
                                    }
                                    $currentindex++;
                                }
                            }
                        }

                        if(isset($availablecourse[0]) && $availablecourseExist == true){
                            $size = count($availablecourse);
                            $index = rand(0, $size-1);

                            ${'table'.$i}[$a][$b]['classid'] = $allclass[$i-1]['classid'];
                            ${'table'.$i}[$a][$b]['classroom'] = $allclass[$i-1]['classroom'];
                            ${'table'.$i}[$a][$b]['courseid'] = $availablecourse[$index]['courseid'];
                            ${'table'.$i}[$a][$b]['teacherid'] = $availablecourse[$index]['teacherid'];
                            ${'table'.$i}[$a][$b]['coursename'] = $availablecourse[$index]['coursename'];
                            ${'table'.$i}[$a][$b]['teachername'] = $availablecourse[$index]['firstname'].' '.$availablecourse[$index]['lastname'];

                            $initialcounter = 0;
                            foreach (${'grade'.$allclass[$i-1]['classroom']} as $initial){
                                if($initial['scid'] == $availablecourse[$index]['scid']){
                                    ${'grade'.$allclass[$i-1]['classroom']}[$initialcounter]['frequency'] = ${'grade'.$allclass[$i-1]['classroom']}[$initialcounter]['frequency'] - 1;
                                    if($initial['frequency'] == 0){
//                                                $this->nativesession->set('success', print_r($initial));
                                        unset(${'grade'.$allclass[$i-1]['classroom']}[$initialcounter]);
                                        ${'grade'.$allclass[$i-1]['classroom']} = array_values(${'grade'.$allclass[$i-1]['classroom']});
                                    }
                                }
                                $initialcounter++;
                            }
                        }
                        else{
                            $size = count(${'grade'.$allclass[$i-1]['classroom']});
                            $index = rand(0, $size-1);

                            ${'table'.$i}[$a][$b]['classid'] = $allclass[$i-1]['classid'];
                            ${'table'.$i}[$a][$b]['classroom'] = $allclass[$i-1]['classroom'];
                            ${'table'.$i}[$a][$b]['courseid'] = ${'grade'.$allclass[$i-1]['classroom']}[$index]['courseid'];
                            ${'table'.$i}[$a][$b]['teacherid'] = ${'grade'.$allclass[$i-1]['classroom']}[$index]['teacherid'];
                            ${'table'.$i}[$a][$b]['coursename'] = ${'grade'.$allclass[$i-1]['classroom']}[$index]['coursename'];
                            ${'table'.$i}[$a][$b]['teachername'] = ${'grade'.$allclass[$i-1]['classroom']}[$index]['firstname'].' '.${'grade'.$allclass[$i-1]['classroom']}[$index]['lastname'];
                            ${'table'.$i}[$a][$b]['conflict'] = 1;
                            ${'grade'.$allclass[$i-1]['classroom']}[$index]['frequency'] = ${'grade'.$allclass[$i-1]['classroom']}[$index]['frequency'] - 1;
                            if(${'grade'.$allclass[$i-1]['classroom']}[$index]['frequency'] == 0){
                                unset(${'grade'.$allclass[$i-1]['classroom']}[$index]);
                                ${'grade'.$allclass[$i-1]['classroom']} = array_values(${'grade'.$allclass[$i-1]['classroom']});
                            }
                        }
                    }
                }
                array_push($schedule, ${'table'.$i});
                $currentTable++;
            }
        }
//                $done = true;
//            }
//        }

//        $data['allclasses'] = $allclass;
        $data['schedule'] = $schedule;


        $data['day'] = $this->Teacher_model->getSetting('s0005');
        $data['period'] = $this->Teacher_model->getSetting('s0006');
        $data['hour'] = $this->Teacher_model->getSetting('s0007');
        $data['starttime'] = $this->Teacher_model->getSetting('s0008');
        $data['breakstarttime'] = $this->Teacher_model->getSetting('s0009');
        $data['breaktime'] = $this->Teacher_model->getSetting('s0011');
        $data['lunchstarttime'] = $this->Teacher_model->getSetting('s0010');
        $data['lunchtime'] = $this->Teacher_model->getSetting('s0012');
        $data['eventnotif'] = $this->Admin_model->getAllEventsCount($this->nativesession->get('id'),$this->nativesession->get('lastlogin'));

        $data['title'] = 'SMS';
        $data['allcourses']  = $this->Admin_model->getAllCourses();
        $data['admin'] = $this->Admin_model->getProfileDataByID($this->nativesession->get('id'));
        $data['topnavigation'] = 'admin/admin_topnavigation';
        $data['sidebar'] = 'admin/admin_sidebar';
        $data['classes']  = $this->Admin_model->getAllClass();
        $data['allteacher']  = $this->Teacher_model->getAllTeacher();

        $data['content'] = 'admin/admin_generate_schedule_view';
        $this->load->view($this->template, $data);
    }

    public function addScheduleSetting(){
        $this->form_validation->set_rules('teacher', 'Teacher', 'required');
        $this->form_validation->set_rules('course', 'Course', 'required');
        $this->form_validation->set_rules('frequency', 'Frequency', 'required');
        $this->form_validation->set_error_delimiters('', '<br/>');

        if ($this->form_validation->run() == TRUE) {
            $tid = $this->input->post('teacher');
            $cid = $this->input->post('course');
            $frequency = $this->input->post('frequency');

            $i = 0;
//            for($g=1; $g<14; $g++){
            $gradeList = $this->input->post('grade');
            for($i=0;$i<sizeof($gradeList);$i++)
            {
                $thisgrade = $gradeList[$i];
//                if($thisgrade == '10'){
//                    $thisgrade = 'A';
//                }
//                elseif($thisgrade == '11'){
//                    $thisgrade = 'B';
//                }
//                elseif($thisgrade == '12'){
//                    $thisgrade = 'C';
//                }
//                elseif($thisgrade == '13'){
//                    $thisgrade = 'D';
//                }
                $allschedule = $this->Teacher_model->getAllFrequencyForGrade($thisgrade);

                $totalperiod = 0;
                if($allschedule){
                    foreach ($allschedule as $s){
                        $totalperiod = $totalperiod + $s['frequency'];
                    }

                    $addedperiod = $totalperiod + $frequency;

                    $day = $this->Teacher_model->getSetting('s0005');
                    $period = $this->Teacher_model->getSetting('s0006');
                    $periodcount = $day['value']*$period['value'];


                    if($addedperiod > $periodcount){
                        $classname = $this->Teacher_model->getClassByClassid($gradeList[$i]);
                        $periodallowed[$i]['grade'] = $classname['classroom'];
                        $periodallowed[$i]['count'] = $periodcount - $totalperiod;
                        $i++;
                    }
                }
            }

            $message = '';
            if(isset($periodallowed)) {
                foreach ($periodallowed as $p) {
                    $message .= 'Total period for grade ' . $p['grade'] . ' exceed limit, ' . $p['count'] . ' more period allowed</br>';
                }
            }

            if(isset($periodallowed)){
                $this->nativesession->set('error', $message);
                redirect('admin/createSchedule');
            }

            $workinghour = $this->Teacher_model->getWorkingHour($tid);
            $workinghourList = explode('|', $workinghour['workinghour']);
            $workinghourcount = 0;
            foreach ($workinghourList as $w){
                $workinghourcount = $workinghourcount + $w;
            }

            $teachingfrequency = $this->Teacher_model->getTeachingFrequency($tid);
            $frequencycount = 0;
            foreach ($teachingfrequency as $f){
                $frequencycount = $frequencycount + $f['frequency'];
            }
            $addedfrequencycount = $frequencycount + $frequency;
            $frequencyallowed = $workinghourcount - $frequencycount;

            if($addedfrequencycount > $workinghourcount){
                $this->nativesession->set('error', 'Teacher working hour not enough, '.$frequencyallowed.' more frequency allowed');
                redirect('admin/createSchedule');
            }

            $gradeList = $this->input->post('grade');
//            $grade = implode("|", $gradeList);
            $grade = '';
            for($i=0;$i<sizeof($gradeList);$i++)
            {
                $g = $gradeList[$i];
//                if($g == '10'){
//                    $g = 'A';
//                }
//                elseif($g == '11'){
//                    $g = 'B';
//                }
//                elseif($g == '12'){
//                    $g = 'C';
//                }
//                elseif($g == '13'){
//                    $g = 'D';
//                }
                $grade = $grade.'|'.$g;
            }

            $latestID = $this->Teacher_model->getScheduleSettingLatestID();
            $latestID = $latestID['scid'];
            $latestID = substr($latestID, 1);
            $latestID = 's'.str_pad((int) $latestID+1, 4, "0", STR_PAD_LEFT);
            $this->Teacher_model->addScheduleSetting($latestID, $tid, $cid, $grade, $frequency);
            $this->nativesession->set('success', 'Schedule Assign saved');
            redirect('admin/createSchedule');
        }
        else{
            $this->nativesession->set('error', 'All field required');
            redirect('admin/createSchedule');
        }
    }

    public function deleteScheduleSetting($id){
        $id = $this->general->decryptParaID($id, 'schedulesetting');
        if($this->Teacher_model->deleteScheduleSetting($id)){
            $this->nativesession->set('success', 'Schedule Setting Deleted');
        }
        else{
            $this->nativesession->set('error', 'Failed to Delete Schedule Setting');
        }
        redirect('admin/createSchedule');
    }

    public function editSchedule()
    {
        $day = $this->Teacher_model->getSetting('s0005');
        $period = $this->Teacher_model->getSetting('s0006');

        $allclass = $this->Teacher_model->getAllClasses();
        foreach ($allclass as $class) {
            ${"grade" . $class['classid']} = $this->Teacher_model->getAllScheduleForGrade($class['classid']);
        }

        $schedule = array('');

        for($i=1; $i<sizeof($allclass)+1; $i++){
            if(isset(${'grade'.$allclass[$i-1]['classid']})){
                for($a=0; $a<$period['value']; $a++){
                    for($b=0; $b<$day['value']; $b++){
                        $currentgrade = ${'grade'.$allclass[$i-1]['classid']}[$a*$day['value']+$b]['classid'];
                        $conflict1 = false;
                        $conflict2 = false;
                        $conflict3 = false;

                        if(isset(${'grade'.$allclass[$i-1]['classid']}[$a*$day['value']+$b])){
                            $notthisid = ${'grade'.$allclass[$i-1]['classid']}[$a*$day['value']+$b]['scheduleid'];
                            $thisteacherworkinghour = $this->Teacher_model->getWorkingHour(${'grade'.$allclass[$i-1]['classid']}[$a*$day['value']+$b]['teacherid']);
                        }
                        $othertablewithsamerowandcolom = $this->Teacher_model->getScheduleWithRowColom($a, $b, $notthisid);
                        foreach ($othertablewithsamerowandcolom as $other){
                            if(isset(${'grade'.$allclass[$i-1]['classid']}[$a*$day['value']+$b]) && ${'grade'.$allclass[$i-1]['classid']}[$a*$day['value']+$b]['teacherid'] == $other['teacherid']){
                                $conflict1 = true;
                            }
                        }
                        unset($othertablewithsamerowandcolom);

                        $otherperiodsameday = $this->Teacher_model->getScheduleWithDayOfGrade($b, $currentgrade, $notthisid);
                        foreach ($otherperiodsameday as $other){
                            if(isset(${'grade'.$allclass[$i-1]['classid']}[$a*$day['value']+$b]) && ${'grade'.$allclass[$i-1]['classid']}[$a*$day['value']+$b]['courseid'] == $other['courseid']){
                                $conflict2 = true;
                            }
                        }
                        unset($otherperiodsameday);

                        $worktimestring = substr($thisteacherworkinghour['workinghour'], 1, strlen($thisteacherworkinghour['workinghour']));
                        $worktime = explode('|', $worktimestring);
                        if(isset($worktime[$a*$day['value']+$b]) && $worktime[$a*$day['value']+$b] == '0'){
                            $conflict3 = true;
                        }

                        if($conflict1 == true || $conflict2 == true || $conflict3 == true){
                            ${'grade'.$allclass[$i-1]['classid']}[$a*$day['value']+$b]['conflict'] = 1;
                        }
                    }
                }
                array_push($schedule, ${'grade'.$allclass[$i-1]['classid']});
            }
        }

        $data['schedule'] = $schedule;


        $data['day'] = $this->Teacher_model->getSetting('s0005');
        $data['period'] = $this->Teacher_model->getSetting('s0006');
        $data['hour'] = $this->Teacher_model->getSetting('s0007');
        $data['starttime'] = $this->Teacher_model->getSetting('s0008');
        $data['breakstarttime'] = $this->Teacher_model->getSetting('s0009');
        $data['breaktime'] = $this->Teacher_model->getSetting('s0011');
        $data['lunchstarttime'] = $this->Teacher_model->getSetting('s0010');
        $data['lunchtime'] = $this->Teacher_model->getSetting('s0012');
        $data['eventnotif'] = $this->Admin_model->getAllEventsCount($this->nativesession->get('id'),$this->nativesession->get('lastlogin'));

        $data['title'] = 'SMS';
        $data['allcourses']  = $this->Admin_model->getAllCourses();
        $data['admin'] = $this->Admin_model->getProfileDataByID($this->nativesession->get('id'));
        $data['topnavigation'] = 'admin/admin_topnavigation';
        $data['sidebar'] = 'admin/admin_sidebar';
        $data['classes']  = $this->Admin_model->getAllClass();
        $data['allcourses']  = $this->Admin_model->getAllCourses();
        $data['allteacher']  = $this->Teacher_model->getAllTeacher();

        $data['content'] = 'admin/admin_edit_schedule_view';
        $this->load->view($this->template, $data);
    }

    public function selectSchedule()
    {
        $savebutton = $this->input->post('savebutton');
        if($savebutton == 'save'){
            $this->Teacher_model->deleteAllScheduleApplied();

            $grade = $this->input->post('class');
            $row = $this->input->post('row');
            $colom = $this->input->post('colom');
            $teacherid = $this->input->post('teacherid');
            $courseid = $this->input->post('courseid');
            $latestID = $this->Teacher_model->getScheduleAppliedLatestID();
            $latestID = $latestID['scheduleid'];
            $latestSID = $this->Teacher_model->getAssignLatestID();
            $latestSID = $latestSID['assignid'];
            for($i=0;$i<sizeof($teacherid);$i++)
            {
                $latestID = substr($latestID, 1);
                $latestID = 'j'.str_pad((int) $latestID+1, 4, "0", STR_PAD_LEFT);

                $latestSID = substr($latestSID, 1);
                $latestSID = 's'.str_pad((int) $latestSID+1, 4, "0", STR_PAD_LEFT);

                $schedule[$i] = array(
                    'scheduleid' => $latestID,
                    'classid' => $grade[$i],
                    'period' => $row[$i],
                    'day' => $colom[$i],
                    'teacherid' => $teacherid[$i],
                    'courseid' => $courseid[$i],
                );

                if($result = $this->Teacher_model->checkAssignCourse($grade[$i], $teacherid[$i], $courseid[$i])){
                }
                else{
                    $assign = array(
                        'assignid' => $latestSID,
                        'teacherid' => $teacherid[$i],
                        'courseid' => $courseid[$i],
                        'classid' => $grade[$i],
                    );
                    $this->Teacher_model->addAssignCourses($assign);
                }
            }
            $this->Teacher_model->addScheduleApplied($schedule);
            redirect('admin/classScheduleView/');
        }
        else{
            $this->Teacher_model->deleteAllSchedule();

            $grade = $this->input->post('class');
            $row = $this->input->post('row');
            $colom = $this->input->post('colom');
            $teacherid = $this->input->post('teacherid');
            $courseid = $this->input->post('courseid');
            $latestID = $this->Teacher_model->getScheduleLatestID();
            $latestID = $latestID['scheduleid'];
            for($i=0;$i<sizeof($teacherid);$i++)
            {
                $latestID = substr($latestID, 1);
                $latestID = 'j'.str_pad((int) $latestID+1, 4, "0", STR_PAD_LEFT);

                $schedule[$i] = array(
                    'scheduleid' => $latestID,
                    'classid' => $grade[$i],
                    'period' => $row[$i],
                    'day' => $colom[$i],
                    'teacherid' => $teacherid[$i],
                    'courseid' => $courseid[$i],
                );
            }
            $this->Teacher_model->addSchedule($schedule);
            redirect('admin/editSchedule/');
        }
    }

    public function teacherClassScheduleView($id)
    {
        $id = $this->general->decryptParaID($id, 'teacher');
        $timeinterval = array();
        $period = $this->Teacher_model->getSetting('s0006');
        $hour = $this->Teacher_model->getSetting('s0007');
        $starttime = $this->Teacher_model->getSetting('s0008');
        $breakstarttime = $this->Teacher_model->getSetting('s0009');
        $breaktime = $this->Teacher_model->getSetting('s0011');
        $lunchstarttime = $this->Teacher_model->getSetting('s0010');
        $lunchtime = $this->Teacher_model->getSetting('s0012');

        $thisperiod = $starttime['value'];
        $break = false;
        $lunch = false;
        for($i=0; $i < $period['value'];){
            if($break == false && $thisperiod >= date('H:i', strtotime($breakstarttime['value']))){
                $thisperiod; //break
                $thisperiod = date('H:i', strtotime($thisperiod) + 60*$breaktime['value']);
                $break = true;
            }
            elseif ($lunch == false && $thisperiod >= date('H:i', strtotime($lunchstarttime['value']))){
                $thisperiod; //lunch
                $thisperiod = date('H:i', strtotime($thisperiod) + 60*$lunchtime['value']);
                $lunch = true;
            }
            else{
                array_push($timeinterval, $thisperiod);
                $thisperiod = date('H:i', strtotime($thisperiod) + 60*$hour['value']);
                $i++;
            }
        }

        $data['hour'] = $hour;
        $data['time'] = $timeinterval;
        $data['schedule'] = $this->Teacher_model->getAllScheduleOfTeacher($id);

        $data['title'] = 'SMS';
        $data['allcourses']  = $this->Admin_model->getAllCourses();
        $data['admin'] = $this->Admin_model->getProfileDataByID($this->nativesession->get('id'));
        $data['topnavigation'] = 'admin/admin_topnavigation';
        $data['sidebar'] = 'admin/admin_sidebar';
        $data['classes']  = $this->Admin_model->getAllClass();
        $data['allcourses']  = $this->Admin_model->getAllCourses();
        $data['allteacher']  = $this->Teacher_model->getAllTeacher();
        $data['eventnotif'] = $this->Admin_model->getAllEventsCount($this->nativesession->get('id'),$this->nativesession->get('lastlogin'));

        $data['content'] = 'admin/admin_class_schedule_view';
        $this->load->view($this->template, $data);
    }

    public function examScheduleView()
    {
        $period = array();
        $starttime = $this->Teacher_model->getSetting('s0008');
        $thisperiod = $starttime['value'];
        array_push($period, $thisperiod);
        $examtime = $this->Teacher_model->getSetting('s0013');
        $thisperiod = date('H:i', strtotime($thisperiod) + 60*$examtime['value']);
        array_push($period, $thisperiod);
        $breaktime = $this->Teacher_model->getSetting('s0011');
        $thisperiod = date('H:i', strtotime($thisperiod) + 60*$breaktime['value']);
        array_push($period, $thisperiod);
        $thisperiod = date('H:i', strtotime($thisperiod) + 60*$examtime['value']);
        array_push($period, $thisperiod);

        $data['time'] = $period;
        $data['schedule'] = $this->Teacher_model->getExamScheduleApplied();

        $data['title'] = 'SMS';
        $data['allcourses']  = $this->Admin_model->getAllCourses();
        $data['admin'] = $this->Admin_model->getProfileDataByID($this->nativesession->get('id'));
        $data['topnavigation'] = 'admin/admin_topnavigation';
        $data['sidebar'] = 'admin/admin_sidebar';
        $data['classes']  = $this->Admin_model->getAllClass();
        $data['allteacher']  = $this->Teacher_model->getAllTeacher();
        $data['eventnotif'] = $this->Admin_model->getAllEventsCount($this->nativesession->get('id'),$this->nativesession->get('lastlogin'));

        $data['content'] = 'admin/admin_exam_schedule_view';
        $this->load->view($this->template, $data);
    }

    public function classScheduleView($id)
    {
        $id = $this->general->decryptParaID($id, 'class');
        $timeinterval = array();
        $period = $this->Teacher_model->getSetting('s0006');
        $hour = $this->Teacher_model->getSetting('s0007');
        $starttime = $this->Teacher_model->getSetting('s0008');
        $breakstarttime = $this->Teacher_model->getSetting('s0009');
        $breaktime = $this->Teacher_model->getSetting('s0011');
        $lunchstarttime = $this->Teacher_model->getSetting('s0010');
        $lunchtime = $this->Teacher_model->getSetting('s0012');

        $thisperiod = $starttime['value'];
        $break = false;
        $lunch = false;
        for($i=0; $i < $period['value'];){
            if($break == false && $thisperiod >= date('H:i', strtotime($breakstarttime['value']))){
                $thisperiod; //break
                $thisperiod = date('H:i', strtotime($thisperiod) + 60*$breaktime['value']);
                $break = true;
            }
            elseif ($lunch == false && $thisperiod >= date('H:i', strtotime($lunchstarttime['value']))){
                $thisperiod; //lunch
                $thisperiod = date('H:i', strtotime($thisperiod) + 60*$lunchtime['value']);
                $lunch = true;
            }
            else{
                array_push($timeinterval, $thisperiod);
                $thisperiod = date('H:i', strtotime($thisperiod) + 60*$hour['value']);
                $i++;
            }
        }

        $data['hour'] = $hour;
        $data['time'] = $timeinterval;
        $data['schedule'] = $this->Teacher_model->getAllScheduleForGrade($id);

        $data['title'] = 'SMS';
        $data['allcourses']  = $this->Admin_model->getAllCourses();
        $data['admin'] = $this->Admin_model->getProfileDataByID($this->nativesession->get('id'));
        $data['topnavigation'] = 'admin/admin_topnavigation';
        $data['sidebar'] = 'admin/admin_sidebar';
        $data['classes']  = $this->Admin_model->getAllClass();
        $data['allcourses']  = $this->Admin_model->getAllCourses();
        $data['allteacher']  = $this->Teacher_model->getAllTeacher();
        $data['eventnotif'] = $this->Admin_model->getAllEventsCount($this->nativesession->get('id'),$this->nativesession->get('lastlogin'));

        $data['content'] = 'admin/admin_class_schedule_view';
        $this->load->view($this->template, $data);
    }

    public function classesView()
    {
        $data['title'] = 'SMS';
        $data['allcourses']  = $this->Admin_model->getAllCourses();
        $data['admin'] = $this->Admin_model->getProfileDataByID($this->nativesession->get('id'));
        $data['topnavigation'] = 'admin/admin_topnavigation';
        $data['sidebar'] = 'admin/admin_sidebar';
        $data['classes']  = $this->Admin_model->getAllClass();
        $data['allcourses']  = $this->Admin_model->getAllCourses();
        $data['allteacher']  = $this->Teacher_model->getAllTeacher();
        $data['eventnotif'] = $this->Admin_model->getAllEventsCount($this->nativesession->get('id'),$this->nativesession->get('lastlogin'));


        $data['classTeacher'] = $this->Teacher_model->getAllClassesWithTeacher();
        $data['content'] = 'admin/admin_all_classes_view';
        $this->load->view($this->template, $data);
    }

    public function addClass()
    {
        if($this->general->checkPrivilege($this->nativesession->get('role'), 'p0025') != 1){
            $this->nativesession->set('error', 'Access Denied');
            redirect('admin/home');
        }
        $this->form_validation->set_rules('class', 'Classroom', 'required');
        $this->form_validation->set_rules('teacher', 'Homeroom Teacher', 'required');
        $this->form_validation->set_rules('capacity', 'capacity', 'required');
        $this->form_validation->set_error_delimiters('', '<br/>');
        if ($this->form_validation->run() == TRUE) {
            $latestID = $this->Teacher_model->getClassLatestID();
            $latestID = $latestID['classid'];
            $latestID = substr($latestID, 1);
            $latestID = 'k'.str_pad((int) $latestID+1, 4, "0", STR_PAD_LEFT);
            $this->Teacher_model->addClass($latestID);

            $this->nativesession->set('success', 'Class Added');
            redirect('admin/classesView/');
        }


        $data['title'] = 'SMS';
        $data['allcourses']  = $this->Admin_model->getAllCourses();
        $data['admin'] = $this->Admin_model->getProfileDataByID($this->nativesession->get('id'));
        $data['topnavigation'] = 'admin/admin_topnavigation';
        $data['sidebar'] = 'admin/admin_sidebar';
        $data['classes']  = $this->Admin_model->getAllClass();
        $data['allcourses']  = $this->Admin_model->getAllCourses();
        $data['allteacher']  = $this->Teacher_model->getAllTeacher();
        $data['eventnotif'] = $this->Admin_model->getAllEventsCount($this->nativesession->get('id'),$this->nativesession->get('lastlogin'));


        $data['content'] = 'admin/admin_add_class_view';
        $this->load->view($this->template, $data);
    }

    public function editClass($id){
        if($this->general->checkPrivilege($this->nativesession->get('role'), 'p0026') != 1){
            $this->nativesession->set('error', 'Access Denied');
            redirect('admin/home');
        }
        $id = $this->general->decryptParaID($id, 'class');
        $this->form_validation->set_rules('class', 'Classroom', 'required');
        $this->form_validation->set_rules('teacher', 'Homeroom Teacher', 'required');
        $this->form_validation->set_rules('capacity', 'Capacity', 'required');
        $this->form_validation->set_error_delimiters('', '<br/>');
        if ($this->form_validation->run() == TRUE) {
            $this->Teacher_model->editClass($id);
            $this->nativesession->set('success', 'Class Added');
            redirect('admin/classesView/');
        }

        $data['class'] = $this->Teacher_model->getClassByClassidWithTeacher($id);
        $data['title'] = 'SMS';
        $data['allcourses']  = $this->Admin_model->getAllCourses();
        $data['admin'] = $this->Admin_model->getProfileDataByID($this->nativesession->get('id'));
        $data['topnavigation'] = 'admin/admin_topnavigation';
        $data['sidebar'] = 'admin/admin_sidebar';
        $data['classes']  = $this->Admin_model->getAllClass();
        $data['allcourses']  = $this->Admin_model->getAllCourses();
        $data['allteacher']  = $this->Teacher_model->getAllTeacher();
        $data['eventnotif'] = $this->Admin_model->getAllEventsCount($this->nativesession->get('id'),$this->nativesession->get('lastlogin'));


        $data['content'] = 'admin/admin_edit_class_view';
        $this->load->view($this->template, $data);
    }

    public function classStudents($id){
        $id = $this->general->decryptParaID($id, 'class');
        $data['title'] = 'SMS';
        $data['admin'] = $this->Admin_model->getProfileDataByID($this->nativesession->get('id'));
        $data['topnavigation'] = 'admin/admin_topnavigation';
        $data['sidebar'] = 'admin/admin_sidebar';
        $data['classes']  = $this->Admin_model->getAllClass();
        $data['allcourses']  = $this->Admin_model->getAllCourses();
        $data['allteacher']  = $this->Teacher_model->getAllTeacher();
        $data['eventnotif'] = $this->Admin_model->getAllEventsCount($this->nativesession->get('id'),$this->nativesession->get('lastlogin'));


        $info = $this->Teacher_model->getClassByClassid($id);

        $data['info_db'] = $info;
        $data['students'] = $this->Teacher_model->getStudentsByClassID($id);
        $data['content'] = 'admin/admin_class_student_view';
        $this->load->view($this->template, $data);
    }


    public function editClassStudent($id){
        if($this->general->checkPrivilege($this->nativesession->get('role'), 'p0026') != 1){
            $this->nativesession->set('error', 'Access Denied');
            redirect('admin/home');
        }
        $did = $this->general->decryptParaID($id, 'class');

        $this->form_validation->set_rules('class', 'Classroom', 'required');

        $students = $this->input->post('students');
        $this->form_validation->set_error_delimiters('', '<br/>');

        if ($this->form_validation->run() == TRUE) {
            for($i=0; $i<sizeof($students);$i++){
                $this->Admin_model->setClassOfStudent($students[$i], $this->input->post('class'));
            }
            $this->nativesession->set('success', 'Class Saved');
            redirect('admin/classStudents/'.$id);
        }

        $data['class'] = $this->Teacher_model->getClassByClassidWithTeacher($did);
        $data['title'] = 'SMS';
        $data['admin'] = $this->Admin_model->getProfileDataByID($this->nativesession->get('id'));
        $data['topnavigation'] = 'admin/admin_topnavigation';
        $data['sidebar'] = 'admin/admin_sidebar';
        $data['classes']  = $this->Admin_model->getAllClass();
        $data['students'] = $this->Teacher_model->getStudentsByClassID($did);
        $data['allcourses']  = $this->Admin_model->getAllCourses();
        $data['allteacher']  = $this->Teacher_model->getAllTeacher();
        $data['eventnotif'] = $this->Admin_model->getAllEventsCount($this->nativesession->get('id'),$this->nativesession->get('lastlogin'));


        $data['content'] = 'admin/admin_edit_class_student_view';
        $this->load->view($this->template, $data);
    }

    public function payment()
    {
        if($this->general->checkPrivilege($this->nativesession->get('role'), 'p0001') != 1){
            $this->nativesession->set('error', 'Access Denied');
            redirect('admin/home');
        }
        $data['title'] = 'SMS';
        $data['admin'] = $this->Admin_model->getProfileDataByID($this->nativesession->get('id'));
        $data['topnavigation'] = 'admin/admin_topnavigation';
        $data['sidebar'] = 'admin/admin_sidebar';
        $data['classes']  = $this->Admin_model->getAllClass();
        $data['allcourses']  = $this->Admin_model->getAllCourses();
        $data['allteacher']  = $this->Teacher_model->getAllTeacher();
        $data['eventnotif'] = $this->Admin_model->getAllEventsCount($this->nativesession->get('id'),$this->nativesession->get('lastlogin'));


        $data['content'] = 'admin/admin_payments_view';
        $this->load->view($this->template, $data);
    }

    public function addEvent()
    {
        if($this->general->checkPrivilege($this->nativesession->get('role'), 'p0006') != 1){
            $this->nativesession->set('error', 'Access Denied');
            redirect('admin/home');
        }
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('description', 'Description', 'required');
        $this->form_validation->set_rules('duedate', 'Date', 'required');
//        $this->form_validation->set_rules('participant[]', 'Participant', 'required');
        $this->form_validation->set_error_delimiters('', '<br/>');
        if ($this->form_validation->run() == TRUE) {
            $latestID = $this->Teacher_model->getEventLatestID();
            $latestID = $latestID['eventid'];
            $latestID = substr($latestID, 1);
            $latestID = 'v'.str_pad((int) $latestID+1, 4, "0", STR_PAD_LEFT);
            $participantList = $this->input->post('participant');
            $participant = '';
            for($i=0;$i<sizeof($participantList);$i++)
            {
                if($participantList[$i] == '0'){
                    $this->Teacher_model->addEvent($latestID, 0);
                    $notall = false;
                    break;
                }
                elseif($participantList[$i] == '1'){
                    $this->Teacher_model->addEvent($latestID, 1);
                    $notall = false;
                    break;
                }
                elseif($participantList[$i] == '3'){
                    $this->Teacher_model->addEvent($latestID, 2);
                    $notall = false;
                    break;
                }
                else{
                    $participant = $participant.'|'.$participantList[$i];
                    $notall = true;
                }
            }
            if($notall == true){
                $this->Teacher_model->addEvent($latestID, $participant);
                $this->nativesession->set('success', 'New Event Added '.$participant);
                redirect('admin/eventList/');
            }

            $this->nativesession->set('success', 'New Event Added '.$participant);
            redirect('admin/eventList/');
        }
        $data['title'] = 'SMS';
        $data['admin'] = $this->Admin_model->getProfileDataByID($this->nativesession->get('id'));
        $data['topnavigation'] = 'admin/admin_topnavigation';
        $data['sidebar'] = 'admin/admin_sidebar';
        $data['classes']  = $this->Admin_model->getAllClass();
        $data['allcourses']  = $this->Admin_model->getAllCourses();
        $data['allteacher']  = $this->Teacher_model->getAllTeacher();
        $data['eventnotif'] = $this->Admin_model->getAllEventsCount($this->nativesession->get('id'),$this->nativesession->get('lastlogin'));


        $data['students'] = $this->Teacher_model->getAllStudent();
        $data['images'] = $this->Teacher_model->getAllEventImages();
        $data['content'] = 'admin/admin_add_event_view';
        $this->load->view($this->template, $data);
    }

    public function eventList()
    {
        $data['title'] = 'SMS';
        $data['admin'] = $this->Admin_model->getProfileDataByID($this->nativesession->get('id'));
        $data['topnavigation'] = 'admin/admin_topnavigation';
        $data['sidebar'] = 'admin/admin_sidebar';
        $data['classes']  = $this->Admin_model->getAllClass();
        $data['allcourses']  = $this->Admin_model->getAllCourses();
        $data['allteacher']  = $this->Teacher_model->getAllTeacher();
        $data['eventnotif'] = $this->Admin_model->getAllEventsCount($this->nativesession->get('id'),$this->nativesession->get('lastlogin'));

        if($this->general->checkPrivilege($this->nativesession->get('role'), 'p0007') == 1){
            $data['info_dbs'] = $this->Teacher_model->getAllEventNoRestriction();
        }
        else{
            $data['info_dbs'] = $this->Teacher_model->getAllEvents($this->nativesession->get('id'));
        }
        $data['content'] = 'admin/admin_event_view';
        $this->load->view($this->template, $data);
    }

    public function eventDetail($id){
        $id = $this->general->decryptParaID($id, 'event');

        $data['title'] = 'SMS';
        $data['admin'] = $this->Admin_model->getProfileDataByID($this->nativesession->get('id'));
        $data['topnavigation'] = 'admin/admin_topnavigation';
        $data['sidebar'] = 'admin/admin_sidebar';
        $data['classes']  = $this->Admin_model->getAllClass();
        $data['allcourses']  = $this->Admin_model->getAllCourses();
        $data['allteacher']  = $this->Teacher_model->getAllTeacher();
        $data['eventnotif'] = $this->Admin_model->getAllEventsCount($this->nativesession->get('id'),$this->nativesession->get('lastlogin'));
        $data['event'] = $this->Teacher_model->getEvent($id);

        $data['content'] = 'admin/admin_event_detail_view';
        $this->load->view($this->template, $data);
    }

    public function editEvent($id){
        if($this->general->checkPrivilege($this->nativesession->get('role'), 'p0007') != 1){
            $this->nativesession->set('error', 'Access Denied');
            redirect('admin/home');
        }
        $id = $this->general->decryptParaID($id, 'event');
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('description', 'Description', 'required');
        $this->form_validation->set_rules('duedate', 'Date', 'required');
        $this->form_validation->set_error_delimiters('', '<br/>');
        if ($this->form_validation->run() == TRUE) {
            $this->Teacher_model->editEvent($id);

            $this->nativesession->set('success', 'Event Edited');
            redirect('admin/eventList/');
        }

        $data['title'] = 'SMS';
        $data['admin'] = $this->Admin_model->getProfileDataByID($this->nativesession->get('id'));
        $data['topnavigation'] = 'admin/admin_topnavigation';
        $data['sidebar'] = 'admin/admin_sidebar';
        $data['classes']  = $this->Admin_model->getAllClass();
        $data['allcourses']  = $this->Admin_model->getAllCourses();
        $data['allteacher']  = $this->Teacher_model->getAllTeacher();
        $data['eventnotif'] = $this->Admin_model->getAllEventsCount($this->nativesession->get('id'),$this->nativesession->get('lastlogin'));

        $data['event'] = $this->Teacher_model->getEvent($id);
        $data['images'] = $this->Teacher_model->getAllEventImages();
        $data['content'] = 'admin/admin_edit_event_view';
        $this->load->view($this->template, $data);
    }

    public function deleteEvent($id){
        if($this->general->checkPrivilege($this->nativesession->get('role'), 'p0007') != 1){
            $this->nativesession->set('error', 'Access Denied');
            redirect('admin/home');
        }
        $id = $this->general->decryptParaID($id, 'event');
        if($this->Teacher_model->deleteEvent($id)){
            $this->nativesession->set('success', 'Event Deleted');
        }
        else{
            $this->nativesession->set('error', 'Failed to Delete Event');
        }
        redirect('admin/eventList');
    }

    public function addEventImage($id = null)
    {
        if (empty($_FILES['userfile']['name'])){
            $this->nativesession->set('error', 'Image is required');
            if($id == null){
                redirect('admin/addEvent');
            }
            redirect('admin/editEvent/'.$id);
        }
        else{
            $latestID = $this->Teacher_model->getEventImageLatestID();
            $latestID = $latestID['eiid'];
            $latestID = substr($latestID, 1);
            $latestID = 'i'.str_pad((int) $latestID+1, 4, "0", STR_PAD_LEFT);
            if ($_FILES['userfile']['error'] != 4) {
                $config['upload_path'] = $this->eventimagepath;
                $config['allowed_types'] = "jpeg|jpg|png";
                $config['max_size'] = 200000;
                $config['overwrite'] = TRUE;
                $config['file_name'] = $latestID;
                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('userfile')) {
                    $this->nativesession->set('error', $this->upload->display_errors());
                    if($id == null){
                        redirect('admin/addEvent');
                    }
                    redirect('admin/editEvent/'.$id);
                } else {
                    if($data = $this->upload->data()){
                        $filename = $data['orig_name'];
                        $this->Teacher_model->addEventImage($latestID, $filename);
                        $this->nativesession->set('success', 'New Event Image Added');
                        if($id == null){
                            redirect('admin/addEvent');
                        }
                        redirect('admin/editEvent/'.$id);
                    }
                }
            }
        }
    }

    public function deleteEventImage($id, $eid = null){
        $id = $this->general->decryptParaID($id, 'eventimage');
        if($this->Teacher_model->deleteEventImage($id)){
            $this->nativesession->set('success', 'Event Image Deleted');
        }
        else{
            $this->nativesession->set('error', 'Failed to Delete Event Image');
        }
        if($eid == null){
            redirect('admin/addEvent');
        }
        redirect('admin/editEvent/'.$eid);
    }

    public function forms()
    {
        $data['title'] = 'SMS';
        $data['admin'] = $this->Admin_model->getProfileDataByID($this->nativesession->get('id'));
        $data['topnavigation'] = 'admin/admin_topnavigation';
        $data['sidebar'] = 'admin/admin_sidebar';
        $data['classes']  = $this->Admin_model->getAllClass();
        $data['allcourses']  = $this->Admin_model->getAllCourses();
        $data['allteacher']  = $this->Teacher_model->getAllTeacher();
        $data['eventnotif'] = $this->Admin_model->getAllEventsCount($this->nativesession->get('id'),$this->nativesession->get('lastlogin'));

        $data['info_dbs'] = $this->Teacher_model->getAllForms();
        $data['content'] = 'admin/admin_forms_view';
        $this->load->view($this->template, $data);
    }

    public function addForm()
    {
        if($this->general->checkPrivilege($this->nativesession->get('role'), 'p0011') != 1){
            $this->nativesession->set('error', 'Access Denied');
            redirect('admin/home');
        }
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('description', 'Description', 'required');
        $this->form_validation->set_error_delimiters('', '<br/>');
        if ($this->form_validation->run() == TRUE) {
            if (empty($_FILES['userfile']['name'])){
                $this->nativesession->set('error', 'File is required');
                redirect(current_url());
            }
            else{
                $latestID = $this->Teacher_model->getFormLatestID();
                $latestID = $latestID['formid'];
                $latestID = substr($latestID, 1);
                $latestID = 'f'.str_pad((int) $latestID+1, 4, "0", STR_PAD_LEFT);
                if ($_FILES['userfile']['error'] != 4) {
                    $config['upload_path'] = $this->formpath;
                    $config['allowed_types'] = "doc|pdf|docx";
                    $config['max_size'] = 200000;
                    $config['overwrite'] = TRUE;
                    $config['file_name'] = $latestID;
                    $this->load->library('upload', $config);

                    if (!$this->upload->do_upload('userfile')) {
                        $this->nativesession->set('error', $this->upload->display_errors());
                        redirect(current_url());
                    } else {
                        $data = $this->upload->data();
                        $filename = $data['orig_name'];
                        $this->Teacher_model->addForm($latestID, $filename);
                    }
                }
                $this->nativesession->set('success', 'New Form Added');
                redirect('admin/forms/');
            }
        }

        $data['title'] = 'SMS';
        $data['admin'] = $this->Admin_model->getProfileDataByID($this->nativesession->get('id'));
        $data['topnavigation'] = 'admin/admin_topnavigation';
        $data['sidebar'] = 'admin/admin_sidebar';
        $data['classes']  = $this->Admin_model->getAllClass();
        $data['allcourses']  = $this->Admin_model->getAllCourses();
        $data['allteacher']  = $this->Teacher_model->getAllTeacher();
        $data['eventnotif'] = $this->Admin_model->getAllEventsCount($this->nativesession->get('id'),$this->nativesession->get('lastlogin'));

        $data['content'] = 'admin/admin_add_form_view';
        $this->load->view($this->template, $data);
    }

    public function editForm($id){
        if($this->general->checkPrivilege($this->nativesession->get('role'), 'p0012') != 1){
            $this->nativesession->set('error', 'Access Denied');
            redirect('admin/home');
        }
        $id = $this->general->decryptParaID($id, 'form');
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('description', 'Description', 'required');
        $this->form_validation->set_error_delimiters('', '<br/>');
        if ($this->form_validation->run() == TRUE) {
            if (empty($_FILES['userfile']['name'])){
                $this->Teacher_model->editForm($id);
            }
            else{
                if ($_FILES['userfile']['error'] != 4) {
                    $config['upload_path'] = $this->formpath;
                    $config['allowed_types'] = "doc|pdf|docx";
                    $config['max_size'] = 200000;
                    $config['overwrite'] = TRUE;
                    $config['file_name'] = $id;
                    $this->load->library('upload', $config);

                    if (!$this->upload->do_upload('userfile')) {
                        $this->nativesession->set('error', $this->upload->display_errors());
                        redirect(current_url());
                    } else {
                        $data = $this->upload->data();
                        $filename = $data['orig_name'];
                        $this->Teacher_model->editFormWithFile($id, $filename);
                    }
                }
            }
            $this->nativesession->set('success', 'Form Edited');
            redirect('admin/forms/');
        }

        $data['title'] = 'SMS';
        $data['admin'] = $this->Admin_model->getProfileDataByID($this->nativesession->get('id'));
        $data['topnavigation'] = 'admin/admin_topnavigation';
        $data['sidebar'] = 'admin/admin_sidebar';
        $data['classes']  = $this->Admin_model->getAllClass();
        $data['allcourses']  = $this->Admin_model->getAllCourses();
        $data['allteacher']  = $this->Teacher_model->getAllTeacher();
        $data['eventnotif'] = $this->Admin_model->getAllEventsCount($this->nativesession->get('id'),$this->nativesession->get('lastlogin'));

        $data['form'] = $this->Teacher_model->getForm($id);
        $data['content'] = 'admin/admin_edit_form_view';
        $this->load->view($this->template, $data);
    }

    public function deleteForm($id){
        if($this->general->checkPrivilege($this->nativesession->get('role'), 'p0012') != 1){
            $this->nativesession->set('error', 'Access Denied');
            redirect('admin/home');
        }
        $id = $this->general->decryptParaID($id, 'form');
        if($this->Teacher_model->deleteForm($id)){
            $this->nativesession->set('success', 'Form Deleted');
        }
        else{
            $this->nativesession->set('error', 'Failed to Delete Form');
        }
        redirect('admin/forms');
    }

    public function settings()
    {
        if($this->general->checkPrivilege($this->nativesession->get('role'), 'p0009') != 1){
            $this->nativesession->set('error', 'Access Denied');
            redirect('admin/home');
        }
        $data['title'] = 'SMS';
        $data['admin'] = $this->Admin_model->getProfileDataByID($this->nativesession->get('id'));
        $data['topnavigation'] = 'admin/admin_topnavigation';
        $data['sidebar'] = 'admin/admin_sidebar';
        $data['classes']  = $this->Admin_model->getAllClass();
        $data['allcourses']  = $this->Admin_model->getAllCourses();
        $data['allteacher']  = $this->Teacher_model->getAllTeacher();
        $data['eventnotif'] = $this->Admin_model->getAllEventsCount($this->nativesession->get('id'),$this->nativesession->get('lastlogin'));

        $data['scheduling'] = $this->Teacher_model->getAllSchedulingSettings();
        $data['grading'] = $this->Teacher_model->getAllGradingSettings();
        $data['content'] = 'admin/admin_settings_view';
        $this->load->view($this->template, $data);
    }

    public function editSetting($id){
        if($this->general->checkPrivilege($this->nativesession->get('role'), 'p0010') != 1){
            $this->nativesession->set('error', 'Access Denied');
            redirect('admin/home');
        }
        $this->form_validation->set_rules('value', 'Value', 'required');
        $this->form_validation->set_error_delimiters('', '<br/>');
        if ($this->form_validation->run() == TRUE) {
            $this->Teacher_model->editSetting($id);
            $this->nativesession->set('success', 'Setting Edited');
            redirect('admin/settings/');
        }
    }

    public function requestItem()
    {
        $id = $this->nativesession->get('id');

//        $savebutton = $this->input->post('savebutton');
//        if($savebutton == 'itemrequest'){
//            $itemid = $this->input->post('itemid');
//            $number = $this->input->post('value');
//            for($i=0;$i<sizeof($itemid);$i++)
//            {
//                if($result = $this->Teacher_model->getAllRequestedByTeacher($itemid[$i], $id)){
//                    $this->Teacher_model->editRequestedItem($result['itemid'], $number[$i]);
//                }
//                else{
//                    $latestID = $this->Teacher_model->getRequestLatestID();
//                    $latestID = $latestID['requestid'];
//                    $latestID = substr($latestID, 1);
//                    $latestID = 'r'.str_pad((int) $latestID+1, 4, "0", STR_PAD_LEFT);
//                    $this->Teacher_model->addRequest($latestID, $itemid[$i], $id, $number[$i]);
//                }
//            }
//            $this->nativesession->set('success', 'Request Submitted');
//            redirect('admin/requestItem/');
//        }

        $itemlist = $this->Teacher_model->getAllItems();
        $a = 0;
        $j = 0;
        foreach ($itemlist as $i){
            if($found = $this->Teacher_model->getAllRequestedByTeacher($i['itemid'], $id)){
                $request[$a]['itemid'] = $i['itemid'];
                $request[$a]['name'] = $i['name'];
                $request[$a]['value'] = $found['number'];
                $a++;
            }
            else{
                $items[$j]['itemid'] = $i['itemid'];
                $items[$j]['name'] = $i['name'];
                $j++;
            }
        }
        if(isset($items)){
            $data['items'] = $items;
        }
        if(isset($request)){
            $data['request'] = $request;
        }
        $data['requestbook'] = $this->Teacher_model->getAllBooksRequested($id);
        $data['requestfotocopy'] = $this->Teacher_model->getAllFotocopyRequested($id);

        $data['title'] = 'SMS';
        $data['admin'] = $this->Admin_model->getProfileDataByID($this->nativesession->get('id'));
        $data['topnavigation'] = 'admin/admin_topnavigation';
        $data['sidebar'] = 'admin/admin_sidebar';
        $data['classes']  = $this->Admin_model->getAllClass();
        $data['allcourses']  = $this->Admin_model->getAllCourses();
        $data['allteacher']  = $this->Teacher_model->getAllTeacher();
        $data['eventnotif'] = $this->Admin_model->getAllEventsCount($this->nativesession->get('id'),$this->nativesession->get('lastlogin'));

        $data['content'] = 'admin/admin_request_item_view';
        $this->load->view($this->template, $data);
    }

    public function addItem()
    {
        if ($this->general->checkPrivilege($this->nativesession->get('role'), 'p0033') != 1) {
            $this->nativesession->set('error', 'Access Denied');
            redirect('admin/home');
        }
        $this->form_validation->set_rules('item', 'Item', 'required');

        $this->form_validation->set_error_delimiters('', '<br/>');
        if ($this->form_validation->run() == TRUE) {
            $item = $this->input->post('item');
            $latestID = $this->Admin_model->getItemLatestID();
            $latestID = $latestID['itemid'];
            $latestID = substr($latestID, 1);
            $latestID = 'i'.str_pad((int) $latestID+1, 4, "0", STR_PAD_LEFT);
            $this->Admin_model->addItem($latestID);
            $this->nativesession->set('success', 'New Form Added');
            redirect('admin/requestItem/');

        }
    }

    public function addRequestItem()
    {
        $id = $this->nativesession->get('id');

        $itemid = $this->input->post('itemid');
        $number = $this->input->post('value');
        for($i=0;$i<sizeof($itemid);$i++)
        {
            if($result = $this->Teacher_model->getAllRequestedByTeacher($itemid[$i], $id)){
                $this->Teacher_model->editRequestedItem($result['itemid'], $number[$i]);
            }
            else{
                if($number[$i] != null || $number[$i] != 0){
                    $latestID = $this->Teacher_model->getRequestLatestID();
                    $latestID = $latestID['requestid'];
                    $latestID = substr($latestID, 1);
                    $latestID = 'r'.str_pad((int) $latestID+1, 4, "0", STR_PAD_LEFT);
                    $this->Teacher_model->addRequest($latestID, $itemid[$i], $id, $number[$i]);
                }
            }
        }
        $this->nativesession->set('success', 'Request Submitted');
        redirect('admin/requestItem/');
    }

    public function editBookRequest($id){
        $this->Teacher_model->editBookRequest($id);
        $this->nativesession->set('success', 'Book Request Edited');
        redirect('admin/requestItem/');
    }

    public function addBookRequest()
    {
        $id = $this->nativesession->get('id');

        $this->form_validation->set_rules('isbn', 'ISBN', 'required');
        $this->form_validation->set_rules('name', 'Title', 'required');
        $this->form_validation->set_rules('value', 'Number', 'required');
        $this->form_validation->set_error_delimiters('', '<br/>');
        if ($this->form_validation->run() == TRUE) {
            $latestID = $this->Teacher_model->getBookRequestLatestID();
            $latestID = $latestID['brequestid'];
            $latestID = substr($latestID, 1);
            $latestID = 'b'.str_pad((int) $latestID+1, 4, "0", STR_PAD_LEFT);

            $this->Teacher_model->addBookRequest($latestID, $id);

            $this->nativesession->set('success', 'New Book Request Added');
            redirect('admin/requestItem/');
        }else{
            redirect('admin/requestItem/');
        }
    }

    public function editFotocopyRequest($id){
        $this->Teacher_model->editFotocopyRequest($id);
        $this->nativesession->set('success', 'Fotocopy Request Edited');
        redirect('admin/requestItem/');
    }

    public function addFotocopyRequest()
    {
        $id = $this->nativesession->get('id');

        $this->form_validation->set_rules('isbn', 'ISBN', 'required');
        $this->form_validation->set_rules('name', 'Title', 'required');
        $this->form_validation->set_rules('value', 'Number', 'required');
        $this->form_validation->set_error_delimiters('', '<br/>');
        if ($this->form_validation->run() == TRUE) {
            $latestID = $this->Teacher_model->getFotocopyRequestLatestID();
            $latestID = $latestID['frequestid'];
            $latestID = substr($latestID, 1);
            $latestID = 'f'.str_pad((int) $latestID+1, 4, "0", STR_PAD_LEFT);

            $this->Teacher_model->addFotocopyRequest($latestID, $id);

            $this->nativesession->set('success', 'New Fotocopy Request Added');
            redirect('admin/requestItem/');
        }else{
            redirect('admin/requestItem/');
        }
    }

    public function feedback()
    {
        $data['title'] = 'SMS';
        $data['admin'] = $this->Admin_model->getProfileDataByID($this->nativesession->get('id'));
        $data['topnavigation'] = 'admin/admin_topnavigation';
        $data['sidebar'] = 'admin/admin_sidebar';
        $data['classes']  = $this->Admin_model->getAllClass();
        $data['allcourses']  = $this->Admin_model->getAllCourses();
        $data['allteacher']  = $this->Teacher_model->getAllTeacher();
        $data['eventnotif'] = $this->Admin_model->getAllEventsCount($this->nativesession->get('id'),$this->nativesession->get('lastlogin'));

        $data['info_dbs'] = $this->Admin_model->getFeedback();
        $data['content'] = 'admin/admin_all_feedback_view';
        $this->load->view($this->template, $data);
    }

    public function viewFeedback($id)
    {
        $id = $this->general->decryptParaID($id, 'courseassigned');

        $data['title'] = 'SMS';
        $data['admin'] = $this->Admin_model->getProfileDataByID($this->nativesession->get('id'));
        $data['topnavigation'] = 'admin/admin_topnavigation';
        $data['sidebar'] = 'admin/admin_sidebar';
        $data['classes']  = $this->Admin_model->getAllClass();
        $data['allcourses']  = $this->Admin_model->getAllCourses();
        $data['allteacher']  = $this->Teacher_model->getAllTeacher();
        $data['eventnotif'] = $this->Admin_model->getAllEventsCount($this->nativesession->get('id'),$this->nativesession->get('lastlogin'));

        $data['info_dbs'] = $this->Admin_model->getFeedbackByAssignID($id);
        $data['courseassign'] = $id;
        $data['content'] = 'admin/admin_view_feedback_view';
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