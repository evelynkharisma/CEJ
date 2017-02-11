<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class operation extends CI_Controller
{

    var $template = 'template';

    public function home()
    {
        $data['title'] = 'SMS';
        $data['sidebar'] = 'operation/operation_sidebar';
        $data['topnavigation'] = 'operation/operation_topnavigation';
        $data['content'] = 'operation/operation_home_view';
        $this->load->view($this->template, $data);
    }
}