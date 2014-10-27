<?php

class Twitter extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('user_model');

	}
	function index()
	{
		echo 'aa';

	}
	function login()
	{
		$this->load->helper('url');
		$this->load->library('form_validation');

		$this->form_validation->set_rules('email', 'メールアドレス', 'trim|required|valid_email');
		$this->form_validation->set_rules('password', 'パスワード', 'trim|required|md5');
		if ($this->form_validation->run() === FALSE)
		{
			$this->load->view('twitter/login');

		}
		else
		{
			if ($this->user_model->check_user()==1){
				$this->load->view('twitter/loginsuccess');
				redirect('twitter','refresh');
				
			}
			else{
				echo 'パスワードかメールアドレスが間違っています。';
				$this->load->view('twitter/login');

			}

		}
	}
	function register()
	{
		$this->load->helper('form');

		$this->load->library('form_validation');
		$this->form_validation->set_rules('username', 'ユーザ名', 'trim|required|min_length[4]|max_length[12]|xss_clean');
		$this->form_validation->set_rules('password', 'パスワード', 'trim|required|matches[passconf]|md5');
		$this->form_validation->set_rules('passconf', 'パスワードの確認', 'trim|required');
		$this->form_validation->set_rules('email', 'メールアドレス', 'trim|required|valid_email|callback_email_check');
		if ($this->form_validation->run() === FALSE)
		{
			$this->load->view('twitter/myform');

		}
		else
		{
			$this->user_model->set_user();
			$this->load->view('twitter/formsuccess');
			redirect('twitter','refresh');

		}
	}
	function email_check($str)
	{
		$this->db->where('MailAdd',$str);
		if ($this->db->count_all_results('User')==1)
		{
			$this->form_validation->set_message('email_check', '既に登録されているメールアドレスです。');
			return FALSE;

		}
		else
		{
			return TRUE;
		}

	}


}
?>