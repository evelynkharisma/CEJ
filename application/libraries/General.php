<?php
class General
{

    var $ci;

    function __construct()
    {
        $this->ci = &get_instance();
        $this->ci->load->model('Privilege_model');
//        $this->isLogin();
    }

    function isLogin() {
        if ($this->ci->nativesession->get('is_login') == TRUE) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function TeacherLogin() {
        if ($this->isLogin() == TRUE) {
            if ($this->ci->nativesession->get('role') != 0 && $this->ci->nativesession->get('role') != 1 && $this->ci->nativesession->get('role') != 2) {
                $this->ci->nativesession->set('error', 'Access Denied');
                redirect('');
            }
        } else {
            $this->ci->nativesession->set('error', 'Access Denied');
            redirect('');
        }
    }

    function StudentLogin() {
        if ($this->isLogin() == TRUE) {
            if ($this->ci->nativesession->get('role') != 'r0004' && $this->ci->nativesession->get('role') != 'r0005') {
                $this->ci->nativesession->set('error', 'Access Denied');
                redirect('');
            }
        } else {
            $this->ci->nativesession->set('error', 'Access Denied');
            redirect('');
        }
    }

    function AdminLogin() {
        if ($this->isLogin() == TRUE) {
            if ($this->ci->nativesession->get('role') != 'r0005') {
                $this->ci->nativesession->set('error', 'Access Denied');
                redirect('');
            }
        } else {
            $this->ci->nativesession->set('error', 'Access Denied admin');
            redirect('');
        }
    }

    function encryptParaID($id, $type){
        if($type == 'teacher'){
            $variable = ord('t');
            $value = substr($id,1) + 123;
            $id = $variable.$value;
        }
        elseif($type == 'student'){
            $variable = ord('m');
            $value = substr($id,1) + 234;
            $id = $variable.$value;
        }
        elseif($type == 'courseassigned'){
            $variable = ord('s');
            $value = substr($id,1) + 345;
            $id = $variable.$value;
        }
        elseif($type == 'anq'){
            $variable = ord('a');
            $value = substr($id,1) + 456;
            $id = $variable.$value;
        }
        elseif($type == 'anqscore'){
            $variable = ord('n');
            $value = substr($id,1) + 567;
            $id = $variable.$value;
        }
        elseif($type == 'event'){
            $variable = ord('v');
            $value = substr($id,1) + 678;
            $id = $variable.$value;
        }
        elseif($type == 'form'){
            $variable = ord('f');
            $value = substr($id,1) + 789;
            $id = $variable.$value;
        }
        elseif($type == 'course'){
            $variable = ord('c');
            $value = substr($id,1) + 891;
            $id = $variable.$value;
        }
        elseif($type == 'eventimage'){
            $variable = ord('i');
            $value = substr($id,1) + 912;
            $id = $variable.$value;
        }
        elseif($type == 'schedulesetting'){
            $variable = ord('s');
            $value = substr($id,1) + 987;
            $id = $variable.$value;
        }
        elseif($type == 'admin'){
            $variable = ord('d');
            $value = substr($id,1) + 876;
            $id = $variable.$value;
        }
        elseif($type == 'parent'){
            $variable = ord('p');
            $value = substr($id,1) + 765;
            $id = $variable.$value;
        }
        elseif($type == 'role'){
            $variable = ord('r');
            $value = substr($id,1) + 654;
            $id = $variable.$value;
        }
        elseif($type == 'privilege_assigned'){
            $variable = ord('a');
            $value = substr($id,1) + 543;
            $id = $variable.$value;
        }
        elseif($type == 'class'){
            $variable = ord('k');
            $value = substr($id,1) + 432;
            $id = $variable.$value;
        }
        elseif($type == 'operation'){
            $variable = ord('n');
            $value = substr($id,1) + 321;
            $id = $variable.$value;
        }
        elseif($type == 'collection'){
            $variable = ord('c');
            $value = substr($id,1) + 211;
            $id = $variable.$value;
        }
        elseif($type == 'collectionauthor'){
            $variable = ord('a');
            $value = substr($id,1) + 210;
            $id = $variable.$value;
        }
        elseif($type == 'collectionsubject'){
            $variable = ord('s');
            $value = substr($id,1) + 101;
            $id = $variable.$value;
        }
        elseif($type == 'exam'){
            $variable = ord('e');
            $value = substr($id,1) + 159;
            $id = $variable.$value;
        }
        elseif($type == 'libservice'){
            $variable = ord('p');
            $value = substr($id,1) + 103;
            $id = $variable.$value;
        }
        elseif($type == 'libborrowed'){
            $variable = ord('b');
            $value = substr($id,1) + 105;
            $id = $variable.$value;
        }
        elseif($type == 'studenteducational'){
            $variable = ord('e');
            $value = substr($id,1) + 107;
            $id = $variable.$value;
        }
        elseif($type == 'libnews'){
            $variable = ord('b');
            $value = substr($id,1) + 109;
            $id = $variable.$value;
        }

        elseif($type == 'correspond'){
            $variable = ord('c');
            $value = substr($id,1) + 260;
            $id = $variable.$value;
        }

        return $id;
    }

    function decryptParaID($id, $type){
        if($type == 'teacher'){
            $variable = strlen(ord('t'));
            $id = substr($id, $variable) - 123;
            $id = 't'.str_pad((int) $id, 4, "0", STR_PAD_LEFT);
        }
        elseif($type == 'student'){
            $variable = strlen(ord('m'));
            $id = substr($id, $variable) - 234;
            $id = 'm'.str_pad((int) $id, 4, "0", STR_PAD_LEFT);
        }
        elseif($type == 'courseassigned'){
            $variable = strlen(ord('s'));
            $id = substr($id, $variable) - 345;
            $id = 's'.str_pad((int) $id, 4, "0", STR_PAD_LEFT);
        }
        elseif($type == 'anq'){
            $variable = strlen(ord('a'));
            $id = substr($id, $variable) - 456;
            $id = 'a'.str_pad((int) $id, 4, "0", STR_PAD_LEFT);
        }
        elseif($type == 'anqscore'){
            $variable = strlen(ord('n'));
            $id = substr($id, $variable) - 567;
            $id = 'n'.str_pad((int) $id, 4, "0", STR_PAD_LEFT);
        }
        elseif($type == 'event'){
            $variable = strlen(ord('v'));
            $id = substr($id, $variable) - 678;
            $id = 'v'.str_pad((int) $id, 4, "0", STR_PAD_LEFT);
        }
        elseif($type == 'form'){
            $variable = strlen(ord('f'));
            $id = substr($id, $variable) - 789;
            $id = 'f'.str_pad((int) $id, 4, "0", STR_PAD_LEFT);
        }
        elseif($type == 'course'){
            $variable = strlen(ord('c'));
            $id = substr($id, $variable) - 891;
            $id = 'c'.str_pad((int) $id, 4, "0", STR_PAD_LEFT);
        }
        elseif($type == 'eventimage'){
            $variable = strlen(ord('i'));
            $id = substr($id, $variable) - 912;
            $id = 'i'.str_pad((int) $id, 4, "0", STR_PAD_LEFT);
        }
        elseif($type == 'schedulesetting'){
            $variable = strlen(ord('s'));
            $id = substr($id, $variable) - 987;
            $id = 's'.str_pad((int) $id, 4, "0", STR_PAD_LEFT);
        }
        elseif($type == 'admin'){
            $variable = strlen(ord('d'));
            $id = substr($id, $variable) - 876;
            $id = 'd'.str_pad((int) $id, 4, "0", STR_PAD_LEFT);
        }
        elseif($type == 'parent'){
            $variable = strlen(ord('p'));
            $id = substr($id, $variable) - 765;
            $id = 'p'.str_pad((int) $id, 4, "0", STR_PAD_LEFT);
        }
        elseif($type == 'role'){
            $variable = strlen(ord('r'));
            $id = substr($id, $variable) - 654;
            $id = 'r'.str_pad((int) $id, 4, "0", STR_PAD_LEFT);
        }
        elseif($type == 'privilege_assigned'){
            $variable = strlen(ord('a'));
            $id = substr($id, $variable) - 543;
            $id = 'a'.str_pad((int) $id, 4, "0", STR_PAD_LEFT);
        }
        elseif($type == 'class'){
            $variable = strlen(ord('k'));
            $id = substr($id, $variable) - 432;
            $id = 'k'.str_pad((int) $id, 4, "0", STR_PAD_LEFT);
        }
        elseif($type == 'operation'){
            $variable = strlen(ord('k'));
            $id = substr($id, $variable) - 321;
            $id = 'n'.str_pad((int) $id, 4, "0", STR_PAD_LEFT);
        }
        elseif($type == 'collection'){
            $variable = strlen(ord('c'));
            $id = substr($id, $variable) - 211;
            $id = 'c'.str_pad((int) $id, 6, "0", STR_PAD_LEFT);

        }
        elseif($type == 'collectionauthor'){
            $variable = strlen(ord('a'));
            $id = substr($id, $variable) - 210;
            $id = 'a'.str_pad((int) $id, 6, "0", STR_PAD_LEFT);

        }
        elseif($type == 'collectionsubject'){
            $variable = strlen(ord('s'));
            $id = substr($id, $variable) - 101;
            $id = 's'.str_pad((int) $id, 6, "0", STR_PAD_LEFT);

        }
        elseif($type == 'exam'){
            $variable = strlen(ord('e'));
            $id = substr($id, $variable) - 159;
            $id = 'e'.str_pad((int) $id, 4, "0", STR_PAD_LEFT);
        }
        elseif($type == 'libservice'){
            $variable = strlen(ord('p'));
            $id = substr($id, $variable) - 103;
            $id = 'p'.str_pad((int) $id, 4, "0", STR_PAD_LEFT);
        }
        elseif($type == 'libborrowed'){
            $variable = strlen(ord('b'));
            $id = substr($id, $variable) - 105;
            $id = 'b'.str_pad((int) $id, 6, "0", STR_PAD_LEFT);
        }
        elseif($type == 'studenteducational'){
            $variable = strlen(ord('e'));
            $id = substr($id, $variable) - 107;
            $id = 'e'.str_pad((int) $id, 8, "0", STR_PAD_LEFT);
        }
        elseif($type == 'libnews'){
            $variable = strlen(ord('b'));
            $id = substr($id, $variable) - 109;
            $id = 'b'.str_pad((int) $id, 4, "0", STR_PAD_LEFT);
        }

        elseif($type == 'correspond'){
            $variable = strlen(ord('c'));
            $id = substr($id, $variable) - 260;
            $id = 'c'.str_pad((int) $id, 6, "0", STR_PAD_LEFT);
        }
        return $id;
    }
    
    function checkPrivilege($role, $privilege){
        $result = $this->ci->Privilege_model->checkPrivilege($role, $privilege);
        return $result['status'];
    }

    function generateRandomCode(){
        $length = 8;
        $chars = '0123456789abcdefghjkmnoprstvwxyz';

        $Code = '';
        for ($i = 0; $i < $length; ++$i) {
            $Code .= substr($chars, (((int) mt_rand(0, strlen($chars))) - 1), 1);
        }
        return strtoupper($Code);
    }
    
    function getClassroom($id){
        return $this->ci->Teacher_model->getClassByClassid($id);
    }

}

?>
