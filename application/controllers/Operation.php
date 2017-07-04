<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class operation extends CI_Controller
{

    var $template = 'template';
    var $profilephotopath = 'assets/img/operation/profile/';

    function __construct() {
        parent::__construct();
        $this->load->model('Operation_model');
        $this->load->model('Parent_model');
    }

    public function home()
    {
        $data['title'] = 'SMS';
        $data['sidebar'] = 'operation/operation_sidebar';
        $data['topnavigation'] = 'operation/operation_topnavigation';
        $data['content'] = 'operation/operation_home_view';

        $data['operation'] = $this->Operation_model->getProfileDataByID($this->nativesession->get('id'));
        
        $this->load->view($this->template, $data);
    }
    public function operation_profile()
    {
        $data['title'] = 'SMS';
        $data['sidebar'] = 'operation/operation_sidebar';
        $data['topnavigation'] = 'operation/operation_topnavigation';
        $data['content'] = 'operation/operation_profile_view';

        $data['operation'] = $this->Operation_model->getProfileDataByID($this->nativesession->get('id'));

        $this->load->view($this->template, $data);
    }
    public function profile_edit($id)
    {
        $id = $this->general->decryptParaID($id, 'operation');
        if($this->nativesession->get('id') != $id){
            $this->nativesession->set('error', 'Access Denied');
            redirect('operation/home');
        }

        $this->form_validation->set_rules('firstname', 'firstname', 'required');
        $this->form_validation->set_rules('lastname', 'lastname', 'required');
        $this->form_validation->set_rules('gender', 'gender', 'required');
        $this->form_validation->set_rules('phone', 'phone', 'required');
        $this->form_validation->set_rules('mobile', 'mobile', 'required');
        $this->form_validation->set_rules('email', 'email', 'required|valid_email');
        $this->form_validation->set_rules('address', 'address', 'required');
        $operationid = $this->input->post('operationid');
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
                $config['file_name'] = $operationid;
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
                        'width' => 512,
                        'height' => 512,
                        'maintain_ratio' => TRUE,
                        'rotate_by_exif' => TRUE,
//                'strip_exif' => TRUE,
                    );
                    $this->load->library('image_lib', $config_image);
                    $this->image_lib->resize();

                    $filename = $data['orig_name'];
                    if ($this->Operation_model->editProfilePhoto($operationid, $filename)) {
                    } else {
                        $this->nativesession->set('error', 'Upload Photo Failed, try again !');
                        redirect(current_url());
                    }
                }
            }
            $this->Operation_model->editProfile($operationid);
            $this->nativesession->set('success', 'Profile saved');
            $eid = $this->general->encryptParaID($id, 'operation');
            redirect('operation/operation_profile/'.$eid);
        }
        $data['title'] = 'SMS';
        $data['sidebar'] = 'operation/operation_sidebar';
        $data['topnavigation'] = 'operation/operation_topnavigation';
        $data['content'] = 'operation/operation_profile_edit_view';

        $data['operation'] = $this->Operation_model->getProfileDataByID($this->nativesession->get('id'));

        $this->load->view($this->template, $data);
    }
    public function outstanding_payment()
    {
        $data['title'] = 'SMS';
        $data['sidebar'] = 'operation/operation_sidebar';
        $data['topnavigation'] = 'operation/operation_topnavigation';
        $data['content'] = 'operation/operation_outstanding_payment_view';

        $data['operation'] = $this->Operation_model->getProfileDataByID($this->nativesession->get('id'));
        $data['orders'] = $this->Operation_model->getAllOutstandingPayment();

        $this->load->view($this->template, $data);
    }
    public function history_payment()
    {
        $data['title'] = 'SMS';
        $data['sidebar'] = 'operation/operation_sidebar';
        $data['topnavigation'] = 'operation/operation_topnavigation';
        $data['content'] = 'operation/operation_history_payment_view';

        $data['operation'] = $this->Operation_model->getProfileDataByID($this->nativesession->get('id'));
        $data['orders'] = $this->Operation_model->getAllHistoryPayment();

        $this->load->view($this->template, $data);
    }
    public function outstanding_book()
    {
        $data['title'] = 'SMS';
        $data['sidebar'] = 'operation/operation_sidebar';
        $data['topnavigation'] = 'operation/operation_topnavigation';
        $data['content'] = 'operation/operation_outstanding_book_view';

        $data['operation'] = $this->Operation_model->getProfileDataByID($this->nativesession->get('id'));
//        $data['orders'] = $this->Operation_model->getAllOutstandingPayment();

        $this->load->view($this->template, $data);
    }
    public function history_book()
    {
        $data['title'] = 'SMS';
        $data['sidebar'] = 'operation/operation_sidebar';
        $data['topnavigation'] = 'operation/operation_topnavigation';
        $data['content'] = 'operation/operation_history_book_view';

        $data['operation'] = $this->Operation_model->getProfileDataByID($this->nativesession->get('id'));
//        $data['orders'] = $this->Operation_model->getAllHistoryPayment();

        $this->load->view($this->template, $data);
    }
    public function order_stationary_new()
    {
        $data['title'] = 'SMS';
        $data['sidebar'] = 'operation/operation_sidebar';
        $data['topnavigation'] = 'operation/operation_topnavigation';
        $data['content'] = 'operation/operation_order_stationary_new_view';

        $data['operation'] = $this->Operation_model->getProfileDataByID($this->nativesession->get('id'));
        $data['orders'] = $this->Operation_model->getAllStationaryNew();

        $this->load->view($this->template, $data);
    }
    public function order_stationary_history()
    {
        $data['title'] = 'SMS';
        $data['sidebar'] = 'operation/operation_sidebar';
        $data['topnavigation'] = 'operation/operation_topnavigation';
        $data['content'] = 'operation/operation_order_stationary_history_view';

        $data['operation'] = $this->Operation_model->getProfileDataByID($this->nativesession->get('id'));
        $data['orders'] = $this->Operation_model->getAllStationaryHistory();

        $this->load->view($this->template, $data);
    }
    public function order_resource_original_new()
    {
        $data['title'] = 'SMS';
        $data['sidebar'] = 'operation/operation_sidebar';
        $data['topnavigation'] = 'operation/operation_topnavigation';
        $data['content'] = 'operation/operation_order_resource_original_new_view';

        $data['operation'] = $this->Operation_model->getProfileDataByID($this->nativesession->get('id'));
        $data['orders'] = $this->Operation_model->getAllResourceOriNew();

        $this->load->view($this->template, $data);
    }
    public function order_resource_original_history()
    {
        $data['title'] = 'SMS';
        $data['sidebar'] = 'operation/operation_sidebar';
        $data['topnavigation'] = 'operation/operation_topnavigation';
        $data['content'] = 'operation/operation_order_resource_original_history_view';

        $data['operation'] = $this->Operation_model->getProfileDataByID($this->nativesession->get('id'));
        $data['orders'] = $this->Operation_model->getAllResourceOriHistory();

        $this->load->view($this->template, $data);
    }
    public function order_resource_photocopy_new()
    {
        $data['title'] = 'SMS';
        $data['sidebar'] = 'operation/operation_sidebar';
        $data['topnavigation'] = 'operation/operation_topnavigation';
        $data['content'] = 'operation/operation_order_resource_photocopy_new_view';

        $data['operation'] = $this->Operation_model->getProfileDataByID($this->nativesession->get('id'));
        $data['orders'] = $this->Operation_model->getAllResourceCopyNew();

        $this->load->view($this->template, $data);
    }
    public function order_resource_photocopy_history()
    {
        $data['title'] = 'SMS';
        $data['sidebar'] = 'operation/operation_sidebar';
        $data['topnavigation'] = 'operation/operation_topnavigation';
        $data['content'] = 'operation/operation_order_resource_photocopy_history_view';

        $data['operation'] = $this->Operation_model->getProfileDataByID($this->nativesession->get('id'));
        $data['orders'] = $this->Operation_model->getAllResourceCopyHistory();

        $this->load->view($this->template, $data);
    }

    public function notifyall(){
        $payments = $this->Operation_model->getAllNotify();
        foreach ($payments as $payment){
            $child = $this->Parent_model->getParent($payment['studentid']);
            $student = $this->Parent_model->getChild($payment['studentid']);
            $parent = $this->Parent_model->getProfileDataByID($child['parentid']);
            if (!empty($parent)) {
//            if (!empty($student)) {
                $config = Array(
                    'protocol' => 'smtp',
                    'smtp_host' => 'ssl://smtp.googlemail.com',
                    'smtp_port' => 465,
                    'smtp_user' => 'healthybonefamily@gmail.com',
                    'smtp_pass' => 'healthybonefamilycb4',
                );

                $this->load->library('email', $config);
                $this->email->set_newline('\r\n');
                $this->email->from('healthybonefamily@gmail.com', 'XYZ International School');
                $this->email->to($parent['email']);
//                $this->email->to($student['email']);
                $this->email->subject('School Fee Reminder - XYZ International School');

                $message = "\r\n";
                $message .= "Dear ".$parent['firstname']." ".$parent['lastname'].",  \r\n";
                $message .= "\r\n\r\n";
                $message .= "We would like to remind you of the following invoice:\r\n\r\n";
                $message .= "Name: ".$student['firstname']." ".$student['lastname']."\r\n";
                $message .= "Description: ".$payment['description']."\r\n";
                $message .= "\r\n";
                $message .= "TOTAL   : $".$payment['value'];
                $message .= "\r\n\r\n";
                $message .= "Payment Method: \r\n";
                $message .= "(1) Online Payment: Please access the school website to use the online payment method (www.rumputilmu.com/sms) \r\n\r\n";
                $message .= "(2) Offline Payment: XYZ International School\r\n";
                $message .= "BCA - XXXXXXXXXX\r\n";
                $message .= "BNI - XXXXXXXXXX\r\n";
                $message .= "Mandiri - XXXXXXXXXX\r\n";
                $message .= "\r\n\r\n";
                $message .= "Best Regards,\r\n";
                $message .= "XYZ International School\r\n";
                $message .= "Phone: xx-xx-xxx\r\n";
                $message .= "Support Service: info@xyzinternationalschool.com\r\n";


                $this->email->message($message);
            }
            if ($this->email->send()){
                $this->nativesession->set("success", "Email sent successfully.");
                $this->Parent_model->notify($payment['paymentid']);
            }
        }
        redirect('operation/outstanding_payment');
    }
    public function notify($paymentid){
        $payment = $this->Operation_model->getOutstandingPayment($paymentid);
        $child = $this->Parent_model->getParent($payment['studentid']);
        $student = $this->Parent_model->getChild($payment['studentid']);
        $parent = $this->Parent_model->getProfileDataByID($child['parentid']);
        
        if (!empty($parent)) {
//            if (!empty($student)) {
                $config = Array(
                    'protocol' => 'smtp',
                    'smtp_host' => 'ssl://smtp.googlemail.com',
                    'smtp_port' => 465,
                    'smtp_user' => 'healthybonefamily@gmail.com',
                    'smtp_pass' => 'healthybonefamilycb4',
                );

                $this->load->library('email', $config);
                $this->email->set_newline('\r\n');
                $this->email->from('healthybonefamily@gmail.com', 'XYZ International School');
                $this->email->to($parent['email']);
//                $this->email->to($student['email']);
                $this->email->subject('School Fee Reminder - XYZ International School');

                $message = "\r\n";
                $message .= "Dear ".$parent['firstname']." ".$parent['lastname'].",  \r\n";
                $message .= "\r\n\r\n";
                $message .= "We would like to remind you of the following invoice:\r\n\r\n";
                $message .= "Name: ".$student['firstname']." ".$student['lastname']."\r\n";
                $message .= "Description: ".$payment['description']."\r\n";
                $message .= "\r\n";
                $message .= "TOTAL   : $".$payment['value'];
                $message .= "\r\n\r\n";
                $message .= "Payment Method: \r\n";
                $message .= "(1) Online Payment: Please access the school website to use the online payment method (www.rumputilmu.com/sms) \r\n\r\n";
                $message .= "(2) Offline Payment: XYZ International School\r\n";
                $message .= "BCA - XXXXXXXXXX\r\n";
                $message .= "BNI - XXXXXXXXXX\r\n";
                $message .= "Mandiri - XXXXXXXXXX\r\n";
                $message .= "\r\n\r\n";
                $message .= "Best Regards,\r\n";
                $message .= "XYZ International School\r\n";
                $message .= "Phone: xx-xx-xxx\r\n";
                $message .= "Support Service: info@xyzinternationalschool.com\r\n";


                $this->email->message($message);

                if ($this->email->send()){
                    $this->nativesession->set("success", "Email sent successfully.");
                    $this->Parent_model->notify($paymentid);
                    redirect('operation/outstanding_payment');
                }
                return TRUE;
//            }
        }
    }
    public function logout(){
        $this->nativesession->delete('id');
        $this->nativesession->delete('name');
        $this->nativesession->delete('photo');
        $this->nativesession->delete('lastlogin');
        $this->nativesession->delete('is_login');
        $this->nativesession->delete('current_child_id');
        $this->nativesession->delete('current_child_name');
        redirect('');
    }
}