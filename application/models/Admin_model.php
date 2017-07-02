<?php
class Admin_model extends CI_Model {

    var $table = 'admin';
    var $parents_table = 'parents';
    var $parents_child_table = 'parent_child';
    var $roles_table = 'roles';
    var $privileges_table = 'privileges';
    var $privilege_assigned_table = 'privilege_assigned';
    var $course_table = 'course';
    var $course_assign_table = 'course_assign';
    var $material_table = 'material';
    var $file_table = 'file';
    var $qna_table = 'assignmentandquiz';
    var $qnascore_table = 'assignmentandquizscore';
    var $lesson_plan_table = 'lesson_plan';
    var $lesson_implementation_table = 'lesson_implementation';
    var $student_table = 'student';
    var $student_recent_school_table = 'student_recent_school';
    var $student_child_development_table = 'student_child_development';
    var $student_health_record_table = 'student_health';
    var $student_vaccination_table = 'student_vaccination';
    var $student_health_problem_table = 'student_health_problelm';
    var $student_educational_table = 'student_educational';
    var $report_table = 'report';
    var $class_table = 'class';
    var $attendance_table = 'attendance';
    var $homeroom_table = 'homeroom';
    var $semester_table = 'semester';
    var $form_table = 'forms';
    var $event_table = 'events';
    var $setting_table = 'settings';
    var $event_image_table = 'event_images';
    var $schedule_course_table = 'schedule_course';
    var $item_table = 'items';
    var $item_request_table = 'item_request';
    var $book_request_table = 'book_request';
    var $fotocopy_request_table = 'fotocopy_request';
    var $librarian_table = 'librarian';
    var $operation_table = 'operations';

    function __construct() {
        parent::__construct();
    }

    function checkLogin($username, $password) {
        $this->db->select('*');
        $this->db->where('adminid', $this->security->xss_clean($username));
//        $password = hash('sha512', $password);
        $password = crypt($this->security->xss_clean($password),'$6$rounds=5000$simsthesisproject$');
        $this->db->where('password', $password);
        $query = $this->db->get($this->table, 1);

        if ($query->num_rows() == 1) {
            return $query->row_array();
        }
    }
    
    function setCurrentLogin($id){
        $data = array(
            'currentlogin' => date('Y-m-d', now()),
        );

        $this->db->where('adminid', $id);
        $this->db->update($this->table, $data);

        return TRUE;
    }
    
    function changeLastLogin($id, $current){
        $data = array(
            'lastlogin' => $current,
        );

        $this->db->where('adminid', $id);
        $this->db->update($this->table, $data);

        return TRUE;
    }

    function getProfileDataByID($id) {
        $this->db->select('admin.*, roles.name');
        $this->db->from('roles');
        $this->db->where('adminid', $id);
        $this->db->where('roles.roleid=admin.role');
        $query = $this->db->get($this->table, 1);

        if ($query->num_rows() == 1) {
            return $query->row_array();
        }
    }

    function getLatestID()
    {
        $this->db->select('adminid');
        $this->db->order_by("adminid", "desc");
        $this->db->limit(1);
        $query = $this->db->get($this->table, 1);

        if ($query->num_rows() == 1) {
            return $query->row_array();
        }
    }

//    function editProfile($id, $at) {
    function editProfile($id) {
        if ($this->input->post('password')) {
            $data = array(
//                'password' => hash('sha512', $this->input->post('password')),
                'password' => crypt($this->input->post('password'),'$6$rounds=5000$simsthesisproject$'),
                'firstname' => $this->input->post('firstname'),
                'lastname' => $this->input->post('lastname'),
                'gender' => $this->input->post('gender'),
                'phone' => $this->input->post('phone'),
                'email' => $this->input->post('email'),
                'address' => $this->input->post('address'),
                'dateofbirth' => $this->input->post('dateofbirth'),
                'placeofbirth' => $this->input->post('placeofbirth'),
                'religion' => $this->input->post('religion'),
                'elementary' => $this->input->post('elementary'),
                'juniorhigh' => $this->input->post('juniorhigh'),
                'seniorhigh' => $this->input->post('seniorhigh'),
                'undergraduate' => $this->input->post('undergraduate'),
                'graduate' => $this->input->post('graduate'),
                'postgraduate' => $this->input->post('postgraduate'),
                'experience' => $this->input->post('experience'),
//                'workinghour' => $at
            );
        } else {
            $data = array(
                'firstname' => $this->input->post('firstname'),
                'lastname' => $this->input->post('lastname'),
                'gender' => $this->input->post('gender'),
                'phone' => $this->input->post('phone'),
                'email' => $this->input->post('email'),
                'address' => $this->input->post('address'),
                'dateofbirth' => $this->input->post('dateofbirth'),
                'placeofbirth' => $this->input->post('placeofbirth'),
                'religion' => $this->input->post('religion'),
                'elementary' => $this->input->post('elementary'),
                'juniorhigh' => $this->input->post('juniorhigh'),
                'seniorhigh' => $this->input->post('seniorhigh'),
                'undergraduate' => $this->input->post('undergraduate'),
                'graduate' => $this->input->post('graduate'),
                'postgraduate' => $this->input->post('postgraduate'),
                'experience' => $this->input->post('experience'),
//                'workinghour' => $at
            );
        }
        $this->db->where('adminid', $id);
        $this->db->update($this->table, $data);
    }

    function editProfilePhoto($id, $filename) {
        $data = array(
            'photo' => $filename,
        );

        $this->db->where('adminid', $id);
        $this->db->update($this->table, $data);

        return TRUE;
    }

    function addParent($id){
        $dbrth = $this->input->post('dateofbirth');
        $dob= strtotime($dbrth);
        $pass = 'xyz'.date('Ymd', $dob);
        $data = array(
            'parentid' => $id,
            'password' => crypt($pass,'$6$rounds=5000$simsthesisproject$'),
            'firstname' => $this->input->post('firstname'),
            'lastname' => $this->input->post('lastname'),
            'gender' => $this->input->post('gender'),
            'phone' => $this->input->post('phone'),
            'phoneoverseas' => $this->input->post('phoneoverseas'),
            'mobile' => $this->input->post('mobile'),
            'mobileoverseas' => $this->input->post('mobileoverseas'),
            'address' => $this->input->post('address'),
            'addressoverseas' => $this->input->post('addressoverseas'),
            'email' => $this->input->post('email'),
            'passportno' => $this->input->post('passportno'),
            'passportcountry' => $this->input->post('passportcountry'),
            'passportexp' => $this->input->post('passportexp'),
            'occupation' => $this->input->post('occupation'),
            'companyname' => $this->input->post('companyname'),
            'industry' => $this->input->post('industry'),
            'phoneoffice' => $this->input->post('phoneoffice'),
            'active' => '1'
    );
        $this->db->insert($this->parents_table, $data);
    }

    function getAllParents(){
        $this->db->select('*');
        $this->db->where('active', '1');

        $query = $this->db->get($this->parents_table);

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
    }

    function getParentLatestID(){
        $this->db->select('parentid');
        $this->db->order_by("parentid", "desc");
        $this->db->limit(1);
        $query = $this->db->get($this->parents_table, 1);

        if ($query->num_rows() == 1) {
            return $query->row_array();
        }
    }

    function activateParent($id){
        $data = array(
            'active' => '1',
        );
        $this->db->where('parentid', $id);
        $this->db->update($this->parents_table, $data);
        if ($this->db->affected_rows() == 1) {
            return TRUE;
        }
        return FALSE;
    }

    function deactivateParent($id){
        $data = array(
            'active' => '0',
        );
        $this->db->where('parentid', $id);
        $this->db->update($this->parents_table, $data);
        if ($this->db->affected_rows() == 1) {
            return TRUE;
        }
        return FALSE;
    }

    function getAllParentsChild() {
        $this->db->select('student.firstname, student.lastname, parent_child.*');
        $this->db->from('student');
        $this->db->where('student.studentid=parent_child.studentid');

        $query = $this->db->get($this->parents_child_table);

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
    }

    function getAllRoles(){
        $this->db->select('*');
//        $this->db->order_by("name","asc");
        $query = $this->db->get($this->roles_table);

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
    }

    function getRoleDataByID($id){
        $this->db->select('*');
        $this->db->where('roles.roleid',$id);


        $query = $this->db->get($this->roles_table, 1);

        if ($query->num_rows() == 1) {
            return $query->row_array();
        }
    }

    function getRoleLatestID(){
        $this->db->select('roleid');
        $this->db->order_by("roleid", "desc");
        $this->db->limit(1);
        $query = $this->db->get($this->roles_table, 1);

        if ($query->num_rows() == 1) {
            return $query->row_array();
        }
    }

    function deleteRole($id) {
        $this->db->where('roleid', $id);
        $this->db->delete($this->roles_table);
        if ($this->db->affected_rows() == 1) {
            return TRUE;
        }
        return FALSE;
    }

    function editRole($id) {
        $data = array(
            'name' => $this->input->post('rolename'),
            'category' => $this->input->post('rolecategory'));
        $this->db->where('roleid', $id);
        $this->db->update($this->roles_table, $data);
    }

    function addRole($id){
        $data = array(
            'roleid' => $id,
            'name' => $this->input->post('rolename'),
            'category' => $this->input->post('rolecategory'),
        );
        $this->db->insert($this->roles_table, $data);
    }

    function getRoleCategoryByRoleID($id) {
        $this->db->select('category');
        $this->db->where('roleid', $id);

//        $this->db->limit(1);
        $query = $this->db->get($this->roles_table);

        if ($query->num_rows() > 0) {
            return $query->row_array();
        }
    }

    function getAllPrivileges(){
        $this->db->select('*');
        $this->db->order_by("name", "asc");
        $query = $this->db->get($this->privileges_table);

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
    }

    function getAssignedRole(){
        /*$sql = 'SELECT privilege_assigned.paid as paid, privilege_assigned.roleid as roleid, roles.name as rolename, PRIVILEGES.privilegeid as privilegeid, privileges.name as privilegename FROM privilege_assigned, PRIVILEGES, roles WHERE privileges.privilegeid=privilege_assigned.privilegeid AND privilege_assigned.roleid=roles.roleid';*/

        $sql = 'SELECT DISTINCT * FROM roles Where roleid IN (SELECT roleid FROM privilege_assigned)';

        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
    }

    function getNotAssignedRole(){
          $sql = 'SELECT DISTINCT * FROM roles Where roleid NOT IN (SELECT roleid FROM privilege_assigned)';

        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
    }

    function getAssignedLatestID(){
        $this->db->select('paid');
        $this->db->order_by("paid", "desc");
        $this->db->limit(1);
        $query = $this->db->get($this->privilege_assigned_table, 1);

        if ($query->num_rows() == 1) {
            return $query->row_array();
        }
    }

    function getAssignedPrivilegeDataByRole($id)
    {
        $sql = 'SELECT *FROM privilege_assigned, privileges WHERE privilege_assigned.privilegeid=privileges.privilegeid AND privilege_assigned.roleid=\''.$id.'\'';

        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
    }

    function deleteAssignedPrivilegeOfRole($id) {
        $this->db->where('roleid', $id);
        $this->db->delete($this->privilege_assigned_table);
        if ($this->db->affected_rows() != 0) {
            return TRUE;
        }
        return FALSE;
    }

    function addAssignedPrivilege($id,$role,$privilege ) {
        $data = array(
            'paid' => $id,
            'roleid' => $role,
            'privilegeid' => $privilege,
            'status' => '1');
        $this->db->insert($this->privilege_assigned_table, $data);
    }

    function getAllEvents($id){
        $this->db->select('*');
//        $status_array = array($id,'0');
//        $where1 = "(teacherid='0' OR teacherid='1' OR teacherid='$id')";
        $where = "(assignid='0' OR participant LIKE '$id')";

        $this->db->where('date >=' ,date('Y-m-d', now()));
        $this->db->where($where);
//        $this->db->or_where($where2);
        $this->db->order_by('date', 'asc');

        $query = $this->db->get($this->event_table);

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
    }

    function getAllAdministrator(){
        $this->db->select('roles.name, admin.*');
        $this->db->from('roles');
        $this->db->where('roles.roleid=admin.role');


        $query = $this->db->get($this->table);

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
    }

    function deleteAdmin($id) {
        $this->db->where('adminid', $id);
        $this->db->delete($this->table);
        if ($this->db->affected_rows() == 1) {
            return TRUE;
        }
        return FALSE;
    }

    function addAdmin($id){
        $data = array(
            'adminid' => $id,
//            'password' => crypt($this->input->post('password'),'$6$rounds=5000$simsthesisproject$'),
            'firstname' => $this->input->post('firstname'),
            'lastname' => $this->input->post('lastname'),
            'gender' => $this->input->post('gender'),
            'phone' => $this->input->post('phone'),
            'address' => $this->input->post('address'),
            'email' => $this->input->post('email'),
            'dateofbirth' => $this->input->post('dateofbirth'),
            'placeofbirth' => $this->input->post('placeofbirth'),
            'religion' => $this->input->post('religion'),
            'elementary' => $this->input->post('elementary'),
            'juniorhigh' => $this->input->post('juniorhigh'),
            'seniorhigh' => $this->input->post('seniorhigh'),
            'undergraduate' => $this->input->post('undergraduate'),
            'postgraduate' => $this->input->post('postgraduate'),
            'experience' => $this->input->post('experience'),
            'role' => $this->input->post('role'),


//            'active' => '1'
        );
        $this->db->insert($this->table, $data);
    }

    function getAllClass()
    {
        $this->db->select('*');

        $query = $this->db->get($this->class_table);

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
    }

    function getAllCourses() {

        $this->db->select('course_assign.*, class.classroom, course.coursename');

        $this->db->join('class', 'class.classid = course_assign.classid');
        $this->db->join('course', 'course.courseid = course_assign.courseid');
        $this->db->order_by('class.classroom', 'asc');

        $query = $this->db->get($this->course_assign_table);

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
    }

    function setClassOfStudent($studentid,$classid) {
        $data = array(
            'classid    ' => $classid,
        );

        $this->db->where('studentid', $studentid);
        $this->db->update($this->student_table, $data);

        return TRUE;
    }

    function getAllEventsCount($id, $lastlogin){
        $this->db->select('*');
//        $status_array = array($id,'0','1');
        $where1 = "(participant='0' OR participant='4' OR participant LIKE '%$id%')";

        $this->db->where('date >=' ,$lastlogin);
        $this->db->where('date >=' ,date('Y-m-d', now()));
        $this->db->where($where1);
//        $this->db->or_where($where2);


        $this->db->order_by('date', 'desc');

        $query = $this->db->get($this->event_table);

        return $query->num_rows();
    }

    function getItemLatestID()
    {
        $this->db->select('itemid');
        $this->db->order_by("itemid", "desc");
        $this->db->limit(1);
        $query = $this->db->get($this->item_table, 1);

        if ($query->num_rows() == 1) {
            return $query->row_array();
        }
    }

    function addItem($id){
        $data = array(
            'itemid' => $id,
            'name' => $this->input->post('item'),
        );
        $this->db->insert($this->item_table, $data);
    }

    function getStudentRecentSchoolByID($id){
        $this->db->select('*');
        $this->db->where('studentid',$id);


        $query = $this->db->get($this->student_recent_school_table, 1);

        if ($query->num_rows() == 1) {
            return $query->row_array();
        }
    }

    function getStudentChildDevelopmentDataByID($id){
        $this->db->select('*');
        $this->db->where('studentid',$id);


        $query = $this->db->get($this->student_child_development_table, 1);

        if ($query->num_rows() == 1) {
            return $query->row_array();
        }
    }

    function getStudentHealthRecordDataByID($id){
        $this->db->select('*');
        $this->db->where('studentid',$id);


        $query = $this->db->get($this->student_health_record_table, 1);

        if ($query->num_rows() == 1) {
            return $query->row_array();
        }
    }

    function getStudentVaccinationDataByID($id){
        $this->db->select('*');
        $this->db->where('studentid',$id);


        $query = $this->db->get($this->student_vaccination_table, 1);

        if ($query->num_rows() == 1) {
            return $query->row_array();
        }
    }

    function getStudentMedicalProblemDataByID($id){
        $this->db->select('*');
        $this->db->where('studentid',$id);

        $query = $this->db->get($this->student_health_problem_table);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
    }



    function editStudentRecentSchool($id) {
        $data = array(
            'school' => $this->input->post('rcname'),
            'contactperson' => $this->input->post('rccontact'),
            'position' => $this->input->post('rcposition'),
            'email' => $this->input->post('rcemail'),
            'phone' => $this->input->post('rcphone'),
            'reason' => $this->input->post('rcreason')
            );

        $this->db->where('studentid', $id);
        $this->db->update($this->student_recent_school_table, $data);
    }

    function editStudentChildDevelopment($id) {
        $data = array(
            'learningdifficulties' => $this->input->post('cdlearningdiff'),
            'learningdificultiesdetail' => $this->input->post('cdlearningdiffnature'),
            'academicsuport' => $this->input->post('cdacademicsuport'),
            'academicsuportdetail' => $this->input->post('cdacademicsuportnature'),
            'talented' => $this->input->post('cdtalented'),
            'talenteddetail' => $this->input->post('cdtalenteddetail'),
            'nativelanguage' => $this->input->post('cdnativelang'),
            'secondlanguage' => $this->input->post('cdsecondlang'),
            'englishproficiency' => $this->input->post('cdenglishproficiency'),
            'learningenglish' => $this->input->post('cdlearningenglish'),
            'langathome' => $this->input->post('cdlangathome'),
            'langproficient' => $this->input->post('cdlangproficient'),
            'prevcountry' => $this->input->post('cdprevcountry'),
            'studiedotherlang' => $this->input->post('cdstudiedotherlang'),
            'difficultvocab' => $this->input->post('cddifficultvocab'),
            'firstlangSupport' => $this->input->post('cdfirstlangSupport'),
            'vocabEnglishSupportDetail' => $this->input->post('cdvocabEnglishSupportDetail'),
        );

        $this->db->where('studentid', $id);
        $this->db->update($this->student_child_development_table, $data);
    }

    function editStudentHealthRecord($id) {
        $data = array(
            'allergies' => $this->input->post('hrallegies'),
            'allergiesdetail' => $this->input->post('hrallegiesdetail'),
            'medication' => $this->input->post('hrmedication'),
            'medicationdetail' => $this->input->post('hrmedicationdetail'),
            'psychologicalAssessment' => $this->input->post('hrpsychologicalAssessment'),
            'psychologicalAssessmentDetail' => $this->input->post('hrpsychologicalAssessmentdetail'),
            'hearingSpeechDifficulty' => $this->input->post('hrhearingSpeechDifficulty'),
            'hearingSpeechDifficultyDetail' => $this->input->post('hrhearingSpeechDifficultydetail'),
            'behaviouralDifficulty' => $this->input->post('hrbehaviouralDifficulty'),
            'behaviouralDifficultyDetail' => $this->input->post('hrbehaviouralDifficultydetail'),
            'others' => $this->input->post('hrother'),
            'otherinformation' => $this->input->post('hrotherinformation'),
            'eyesight' => $this->input->post('hreyesight'),
            'hearing' => $this->input->post('hrhearing'),
            'foodallergies' => $this->input->post('hrfoodallergies'),
            'issuesexplanation' => $this->input->post('hrissueexplanation'),
            'docname' => $this->input->post('hrdocname'),
            'docphone' => $this->input->post('hrdocphone'),
            'ecname' => $this->input->post('hrecname'),
            'ecrelationship' => $this->input->post('hrecrelationship'),
            'ecphone' => $this->input->post('hrecphone'),
        );

        $this->db->where('studentid', $id);
        $this->db->update($this->student_health_record_table, $data);
    }

    function editStudentVaccination($id) {
        $data = array(
            'hepatitisb' => $this->input->post('vchepatitisb'),
            'hepatitisbYear' => $this->input->post('vchepatitisbyear'),
            'measlesMumpsRubella' => $this->input->post('vcmeasles'),
            'measlesMumpsRubellaYear' => $this->input->post('vcmeaslesyear'),
            'polio' => $this->input->post('vcpolio'),
            'polioYear' => $this->input->post('vcpolioyear'),
            'tetanus' => $this->input->post('vctetanus'),
            'tetanusYear' => $this->input->post('vctetanusyear'),
            'hib' => $this->input->post('vchib'),
            'hibYear' => $this->input->post('vchibyear'),
            'menzb' => $this->input->post('vcmenzb'),
            'menzbYear' => $this->input->post('vcmenzbyear'),
            'tb' => $this->input->post('vctb'),
            'tbYear' => $this->input->post('vctbyear')
        );

        $this->db->where('studentid', $id);
        $this->db->update($this->student_vaccination_table, $data);
    }

    function editStudentMedicalProblem($id, $prob, $status, $severity, $med, $act) {
        $data = array(
            'healthproblem' => $prob,
            'status' => $status,
            'severity' => $severity,
            'medication' => $med,
            'action' => $act
        );

        $this->db->where('hpid', $id);
        $this->db->update($this->student_health_problem_table, $data);
    }

    function addStudentRecentSchool($id) {
        $data = array(
            'studentid' => $id,
            'school' => $this->input->post('rcname'),
            'contactperson' => $this->input->post('rccontact'),
            'position' => $this->input->post('rcposition'),
            'email' => $this->input->post('rcemail'),
            'phone' => $this->input->post('rcphone'),
            'reason' => $this->input->post('rcreason')
        );

        $this->db->insert($this->student_recent_school_table, $data);
    }

    function addStudentChildDevelopment($id) {
        $data = array(
            'studentid' => $id,
            'learningdifficulties' => $this->input->post('cdlearningdiff'),
            'learningdificultiesdetail' => $this->input->post('cdlearningdiffnature'),
            'academicsuport' => $this->input->post('cdacademicsuport'),
            'academicsuportdetail' => $this->input->post('cdacademicsuportnature'),
            'talented' => $this->input->post('cdtalented'),
            'talenteddetail' => $this->input->post('cdtalenteddetail'),
            'nativelanguage' => $this->input->post('cdnativelang'),
            'secondlanguage' => $this->input->post('cdsecondlang'),
            'englishproficiency' => $this->input->post('cdenglishproficiency'),
            'learningenglish' => $this->input->post('cdlearningenglish'),
            'langathome' => $this->input->post('cdlangathome'),
            'langproficient' => $this->input->post('cdlangproficient'),
            'prevcountry' => $this->input->post('cdprevcountry'),
            'studiedotherlang' => $this->input->post('cdstudiedotherlang'),
            'difficultvocab' => $this->input->post('cddifficultvocab'),
            'firstlangSupport' => $this->input->post('cdfirstlangSupport'),
            'vocabEnglishSupportDetail' => $this->input->post('cdvocabEnglishSupportDetail'),
        );

        $this->db->insert($this->student_child_development_table, $data);
    }

    function addStudentHealthRecord($id) {
        $data = array(
            'studentid' => $id,
            'allergies' => $this->input->post('hrallegies'),
            'allergiesdetail' => $this->input->post('hrallegiesdetail'),
            'medication' => $this->input->post('hrmedication'),
            'medicationdetail' => $this->input->post('hrmedicationdetail'),
            'psychologicalAssessment' => $this->input->post('hrpsychologicalAssessment'),
            'psychologicalAssessmentDetail' => $this->input->post('hrpsychologicalAssessmentdetail'),
            'hearingSpeechDifficulty' => $this->input->post('hrhearingSpeechDifficulty'),
            'hearingSpeechDifficultyDetail' => $this->input->post('hrhearingSpeechDifficultydetail'),
            'behaviouralDifficulty' => $this->input->post('hrbehaviouralDifficulty'),
            'behaviouralDifficultyDetail' => $this->input->post('hrbehaviouralDifficultydetail'),
            'others' => $this->input->post('hrother'),
            'otherinformation' => $this->input->post('hrotherinformation'),
            'eyesight' => $this->input->post('hreyesight'),
            'hearing' => $this->input->post('hrhearing'),
            'foodallergies' => $this->input->post('hrfoodallergies'),
            'issuesexplanation' => $this->input->post('hrissueexplanation'),
            'docname' => $this->input->post('hrdocname'),
            'docphone' => $this->input->post('hrdocphone'),
            'ecname' => $this->input->post('hrecname'),
            'ecrelationship' => $this->input->post('hrecrelationship'),
            'ecphone' => $this->input->post('hrecphone'),
        );

        $this->db->insert($this->student_health_record_table, $data);
    }

    function addStudentVaccination($id) {
        $data = array(
            'studentid' => $id,
            'hepatitisb' => $this->input->post('vchepatitisb'),
            'hepatitisbYear' => $this->input->post('vchepatitisbyear'),
            'measlesMumpsRubella' => $this->input->post('vcmeasles'),
            'measlesMumpsRubellaYear' => $this->input->post('vcmeaslesyear'),
            'polio' => $this->input->post('vcpolio'),
            'polioYear' => $this->input->post('vcpolioyear'),
            'tetanus' => $this->input->post('vctetanus'),
            'tetanusYear' => $this->input->post('vctetanusyear'),
            'hib' => $this->input->post('vchib'),
            'hibYear' => $this->input->post('vchibyear'),
            'menzb' => $this->input->post('vcmenzb'),
            'menzbYear' => $this->input->post('vcmenzbyear'),
            'tb' => $this->input->post('vctb'),
            'tbYear' => $this->input->post('vctbyear')
        );

        $this->db->insert($this->student_vaccination_table, $data);
    }



    function getStudentEducationalByID($id){
        $this->db->select('*');
        $this->db->where('studentid',$id);


        $query = $this->db->get($this->student_educational_table);

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }

    }

    function addStudentEducational($id, $stid) {
        $data = array(
            'seid' => $id,
            'studentid' => $stid,
            'school' => $this->input->post('school'),
            'start' => $this->input->post('start'),
            'end' => $this->input->post('end'),
            'highestgrade' => $this->input->post('highest'),
            'language' => $this->input->post('language'),
        );

        $this->db->insert($this->student_educational_table, $data);
    }

    function getStudentEducationalLatestID(){
        $this->db->select('seid');
        $this->db->order_by("seid", "desc");
        $this->db->limit(1);
        $query = $this->db->get($this->student_educational_table, 1);

        if ($query->num_rows() == 1) {
            return $query->row_array();
        }
    }

    function editStudentEducational($id) {
        $data = array(
            'school' => $this->input->post('school'),
            'start' => $this->input->post('start'),
            'end' => $this->input->post('end'),
            'highestgrade' => $this->input->post('highest'),
            'language' => $this->input->post('language'),
        );

        $this->db->where('seid', $id);
        $this->db->update($this->student_educational_table, $data);
    }

    function deleteStudentEducational($id) {
        $this->db->where('seid', $id);
        $this->db->delete($this->student_educational_table);
        if ($this->db->affected_rows() == 1) {
            return TRUE;
        }
        return FALSE;
    }



    function getFeedback()
    {
        $sql = 'SELECT course_assign.*, teacher.firstname as teacherfirstname, teacher.lastname as teacherlastname, course.coursename, class.classroom, class.periode FROM course_assign, teacher, course, class WHERE course_assign.teacherid=teacher.teacherid AND course_assign.courseid=course.courseid AND course_assign.classid=class.classid ';

        $query = $this->db->query($sql);

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
    }

    function getFeedbackByAssignID($id)
    {
        $sql = 'SELECT * FROM feedback WHERE assignid=\''.$id.'\'';

        $query = $this->db->query($sql);

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
    }


    function addStudentMedicalProblem($hpid, $stdid, $prob, $status, $severity, $med, $act) {
        $data = array(
            'hpid' => $hpid,
            'studentid' => $stdid,
            'healthproblem' => $prob,
            'status' => $status,
            'severity' => $severity,
            'medication' => $med,
            'action' => $act
        );

        $this->db->insert($this->student_health_problem_table, $data);
    }

    function getStudentMedicalProblemLatestID()
    {
        $this->db->select('hpid');
        $this->db->order_by("hpid", "desc");
        $this->db->limit(1);
        $query = $this->db->get($this->student_health_problem_table, 1);

        if ($query->num_rows() == 1) {
            return $query->row_array();
        }
    }

    function getByEmail($email) {
        $this->db->select('*');
        $this->db->where('email', $email);
        $query = $this->db->get($this->table, 1);

        if ($query->num_rows() == 1) {
            return $query->row_array();
        }
    }


    function getAllLibrarian(){
        $this->db->select('*');
//        $this->db->where('active', '1');

        $query = $this->db->get($this->librarian_table);

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
    }

    function getAllOperations(){
        $this->db->select('*');
//        $this->db->where('active', '1');

        $query = $this->db->get($this->operation_table);

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
    }
}

?>
