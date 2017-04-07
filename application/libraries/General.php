<?php
class General
{

    var $ci;

    function __construct()
    {
        $this->ci = &get_instance();
//        $this->isLogin();
    }

    function isLogin() {
        if ($this->ci->session->userdata('is_login') == TRUE) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function TeacherLogin() {
        if ($this->isLogin() == TRUE) {
            if ($this->ci->session->userdata('role') != 0 || $this->ci->session->userdata('role') != 1 || $this->ci->session->userdata('role') != 2) {
                $this->ci->session->set_flashdata('error', 'Access Denied');
                redirect('');
            }
        } else {
            $this->ci->session->set_flashdata('error', 'Access Denied');
            redirect('');
        }
    }

}

?>
