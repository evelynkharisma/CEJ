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
            if ($this->ci->nativesession->get('role') != 0 && $this->ci->nativesession->get('role') != 1 && $this->ci->nativesession->get('role') != 2) {
                $this->ci->nativesession->set('error', 'Access Denied');
                redirect('');
            }
        } else {
            $this->ci->nativesession->set('error', 'Access Denied');
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

}

?>
