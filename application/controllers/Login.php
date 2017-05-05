<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class login extends CI_Controller {

	var $template = 'login/login_template';

	function __construct() {
		parent::__construct();
		$this->load->model('Teacher_model');
		$this->load->model('Parent_model');
		$this->load->model('Student_model');
		$this->load->model('Admin_model');
	}

	public function index()
	{
		$this->form_validation->set_rules('loginas', 'loginas', 'required');
		$this->form_validation->set_rules('username', 'username', 'required|alpha_numeric');
		$this->form_validation->set_rules('password', 'password', 'required');
		$this->form_validation->set_error_delimiters('', '<br/>');

		if ($this->form_validation->run() == TRUE) {
			$loginas = $this->input->post('loginas');
			$username = $this->input->post('username');
			$password = $this->input->post('password');

			if($loginas == 'student'){
                $user = $this->Student_model->checkLogin($username, $password);
                if (!empty($user)) {
                    $this->nativesession->set( 'id', $user['studentid'] );
                    $this->nativesession->set( 'name', $user['firstname'].' '.$user['lastname'] );
                    $this->nativesession->set( 'classid', $user['classid'] );
                    $this->nativesession->set( 'role', $user['role'] );
                    $this->nativesession->set( 'is_login', 'TRUE' );

                    $this->Student_model->changeLastLogin($user['studentid'], $user['currentlogin']);
                    $this->Student_model->setCurrentLogin($user['studentid']);

				redirect('student/home');
				}
			}
			else if($loginas == 'teacher'){
				$user = $this->Teacher_model->checkLogin($username, $password);
				if (!empty($user)) {
					$this->nativesession->set( 'id', $user['teacherid'] );
					$this->nativesession->set( 'name', $user['firstname'].' '.$user['lastname'] );
					$this->nativesession->set( 'photo', $user['photo'] );
					$this->nativesession->set( 'role', $user['role'] );
					$this->nativesession->set( 'lastlogin', $user['lastlogin'] );
					$this->nativesession->set( 'is_login', 'TRUE' );
					
//					$sessionData['id'] = $user['teacherid'];
//					$sessionData['name'] = $user['firstname'].' '.$user['lastname'];
//					$sessionData['photo'] = $user['photo'];
//					$sessionData['role'] = $user['role'];
//					$sessionData['lastlogin'] = $user['lastlogin'];
//					$sessionData['is_login'] = TRUE;

					$this->Teacher_model->changeLastLogin($user['teacherid'], $user['currentlogin']);
					$this->Teacher_model->setCurrentLogin($user['teacherid']);
//					$this->session->set_userdata($sessionData);
//					$this->Teacher_model->updateLastLogin($user['id']);

					redirect('teacher/home');
				}
			}
			else if($loginas == 'parent'){
				$user = $this->Parent_model->checkLogin($username, $password);
				if (!empty($user)) {
					$this->nativesession->set( 'id', $user['parentid'] );
					$this->nativesession->set( 'name', $user['firstname'].' '.$user['lastname'] );
					$this->nativesession->set( 'photo', $user['photo'] );
//					$this->nativesession->set( 'role', $user['role'] );
					$this->nativesession->set( 'lastlogin', $user['lastlogin'] );
					$this->nativesession->set( 'is_login', 'TRUE' );

					$this->Parent_model->changeLastLogin($user['parentid'], $user['currentlogin']);
					$this->Parent_model->setCurrentLogin($user['parentid']);
					$childs = $this->Parent_model->getAllChildren($this->nativesession->get('id'));
					foreach ($childs as $c){
						$this->nativesession->set( 'current_child', $c['studentid'] );
					}
//					$this->Parent_model->updateLastLogin($user['id']);

				redirect('parents/home');
				}
			}
			else if($loginas == 'operation'){
//				$user = $this->Operation_model->checkLogin($username, $password);
//				if (!empty($user)) {
//					$sessionData['id'] = $user['id'];
//					$sessionData['email'] = $user['email'];
//					$sessionData['full_name'] = $user['full_name'];
//					$sessionData['level'] = $user['level'];
//					$sessionData['is_login'] = TRUE;
//
//					$this->session->set_userdata($sessionData);
//					$this->Operation_model->updateLastLogin($user['id']);

				redirect('operation/home');
//				}
			}
			else if($loginas == 'admin'){
                $user = $this->Admin_model->checkLogin($username, $password);
                if (!empty($user)) {
                    $this->nativesession->set( 'id', $user['adminid'] );
                    $this->nativesession->set( 'name', $user['firstname'].' '.$user['lastname'] );
                    $this->nativesession->set( 'role', $user['role'] );
                    $this->nativesession->set( 'is_login', 'TRUE' );

                    $this->Student_model->changeLastLogin($user['adminid'], $user['currentlogin']);
                    $this->Student_model->setCurrentLogin($user['adminid']);

                    redirect('admin/home');
                }
			}

			$this->nativesession->set('error', 'Login Failed!, username and password combination are wrong');
		}

		$data['title'] = 'SMS';
		$data['content'] = 'login/login_view';
		$this->load->view($this->template, $data);
	}

	public function forgot_password()
	{
		$this->form_validation->set_rules('loginas', 'loginas', 'required');
		$this->form_validation->set_rules('email', 'email', 'required|valid_email');
		$this->form_validation->set_error_delimiters('', '<br/>');

		if ($this->form_validation->run() == TRUE) {
			$loginas = $this->input->post('loginas');
			$email = $this->input->post('email');
			$token = $this->general->generateRandomCode();

			if($loginas == 'student'){
				$user = $this->Student_model->getByEmail($email);
				if (!empty($user)) {
					$userData = $this->Student_model->getById($user['id']);

					$this->load->library('email');
					$this->email->from('kharismaeve@gmail.com', 'SMS');
					$this->email->to($email);

					$this->email->subject('Request New Password - SMS');
					$message = '';
					$message .= 'You have sent request to reset password.<br/>';
					$message .= 'Here is your New Password: '.$token;
					$this->email->message($message);
					$this->email->send();
					$this->nativesession->set('success', 'Check your email for new password');

					$this->Student_model->resetPassword($userData['id'], $token);

					redirect('login/loginAs?choice='.$loginas);
				} else {
					$this->nativesession->set('error', 'Email not registered');
					redirect('login/forgot_password?choice='.$loginas);
				}
			}
			else if($loginas == 'teacher'){
				$userData = $this->Teacher_model->getByEmail($email);
				if (!empty($userData)) {
//					$userData = $this->Teacher_model->getById($user['id']);

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
					$this->email->to($userData['email']);
					$this->email->subject('Request New Password - SMS');

					$message = '';
					$message .= 'You have sent request to reset password. ';
					$message .= 'Here is your New Password: ' . $token;
					$this->email->message($message);

					if ($this->email->send()){
						$this->nativesession->set("success", "Email sent successfully.");
						$this->Teacher_model->resetPassword($userData['id'], $token);
						redirect('login/');
					}
					else {
						$this->nativesession->set("error", $this->email->print_debugger());
						redirect('login/forgot_password');
					}
					
					return TRUE;
				}
			}
			else if($loginas == 'parent'){
				$user = $this->Parent_model->getByEmail($email);
				if (!empty($user)) {
					$userData = $this->Parent_model->getById($user['id']);

					$this->load->library('email');
					$this->email->from('chelsylim@gmail.com', 'SMS');
					$this->email->to($email);

					$this->email->subject('Request New Password - SMS');
					$message = '';
					$message .= 'You have sent request to reset password.<br/>';
					$message .= 'Here is your New Password: '.$token;
					$this->email->message($message);
					$this->email->send();
					$this->nativesession->set('success', 'Check your email for new password');

					$this->Parent_model->resetPassword($userData['id'], $token);

					redirect('login/loginAs?choice='.$loginas);
				} else {
					$this->nativesession->set('error', 'Email not registered');
					redirect('login/forgot_password?choice='.$loginas);
				}
			}
			else if($loginas == 'operation'){
				$user = $this->Operation_model->getByEmail($email);
				if (!empty($user)) {
					$userData = $this->Operation_model->getById($user['id']);

					$this->load->library('email');
					$this->email->from('kharismaeve@gmail.com', 'SMS');
					$this->email->to($email);

					$this->email->subject('Request New Password - SMS');
					$message = '';
					$message .= 'You have sent request to reset password.<br/>';
					$message .= 'Here is your New Password: '.$token;
					$this->email->message($message);
					$this->email->send();
					$this->nativesession->set('success', 'Check your email for new password');

					$this->Operation_model->resetPassword($userData['id'], $token);

					redirect('login/loginAs?choice='.$loginas);
				} else {
					$this->nativesession->set('error', 'Email not registered');
					redirect('login/forgot_password?choice='.$loginas);
				}
			}
			else if($loginas == 'admin'){
				$user = $this->Admin_model->getByEmail($email);
				if (!empty($user)) {
					$userData = $this->Admin_model->getById($user['id']);

					$this->load->library('email');
					$this->email->from('kharismaeve@gmail.com', 'SMS');
					$this->email->to($email);

					$this->email->subject('Request New Password - SMS');
					$message = '';
					$message .= 'You have sent request to reset password.<br/>';
					$message .= 'Here is your New Password: '.$token;
					$this->email->message($message);
					$this->email->send();
					$this->nativesession->set('success', 'Check your email for new password');

					$this->Admin_model->resetPassword($userData['id'], $token);

					redirect('login/loginAs?choice='.$loginas);
				} else {
					$this->nativesession->set('error', 'Email not registered');
					redirect('login/forgot_password?choice='.$loginas);
				}
			}
		}

		$data['title'] = 'SMS';
		$data['content'] = 'login/forgot_password_view';
		$this->load->view($this->template, $data);
	}
}
