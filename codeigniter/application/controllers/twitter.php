<?php

class Twitter extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('user_model');
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('javascript');

	}

	function index()
	{
		$this->load->library('form_validation');
		$this->load->library('session');

		//echo $this->user_model->check_session();
		//echo $this->session->userdata('session_id');
		if ($this->user_model->check_session()==0){
				redirect('twitter/login','refresh');
		}

		$email=$this->session->userdata('email');
		$data['username']=$this->session->userdata('username');
		$this->load->view('twitter/header',$data);
		$this->form_validation->set_rules('tweet', 'ツイート', 'trim|required');

		if ( $this->form_validation->run() == FALSE){
			$this->load->view('twitter/input');
		}else{
			$this->db->select_max('TweetID');
			$query = $this->db->get('Tweet');
			$row=$query->row_array(1);
			$data = array(
				'TweetID' => $row['TweetID']+1,
				'MailAdd' => $email,
				'TweetText' => $this->input->post('tweet'),
				'Date' => date('Y-m-d H:i:s')

			);

			$this->db->insert('Tweet', $data);
			$this->load->view('twitter/input');
			echo '送信されました。';
		}
		$this->db->where('Tweet.MailAdd',$email);
		$this->db->order_by("Date", "desc");
		$this->db->from('Tweet');
		$this->db->join('User','Tweet.MailAdd=User.MailAdd','left');
		$data['tweets']=$this->db->get()->result_array();
		
		$this->load->view('twitter/tweet',$data);
		
	}

	function post_action()
	{   
		if($this->input->post('textbox') == "")
		{
			$message = "You can't send empty text";

		}
		else
		{
			$message = $this->input->post('textbox');

		}
		echo $message;
	}

	function login()
	{
		$this->load->library('form_validation');
		$this->load->library('session');

		$this->form_validation->set_rules('email', 'メールアドレス', 'trim|required|valid_email');
		$this->form_validation->set_rules('password', 'パスワード', 'trim|required|md5');
		if ($this->form_validation->run() === FALSE)
		{
			$this->load->view('twitter/login');

		}
		else
		{
			if ($this->user_model->check_user()==1){
				$this->db->where('MailAdd',$this->input->post('email'));
				$query=$this->db->get('User');
				$row=$query->row_array(1);
				$newdata = array(
					'username'  => $row['UserName'],
					'email'     => $this->input->post('email'),
					'logged_in' => TRUE
				);
				$this->session->set_userdata($newdata);
				$session_id=$this->session->userdata('session_id');
				$this->db->where('session_id',$session_id);
				$query=$this->db->from('Session');
				if($this->db->count_all_results()==0){
					$array = array(
						'session_id' => $session_id 
					);
					$this->db->insert('Session',$array);

				}
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
		$this->load->library('form_validation');
		$this->load->library('session');

		$this->form_validation->set_rules('username', 'ユーザ名', 'trim|required|min_length[4]|max_length[12]|xss_clean');
		$this->form_validation->set_rules('password', 'パスワード', 'trim|required|min_length[6]|matches[passconf]|md5');
		$this->form_validation->set_rules('passconf', 'パスワードの確認', 'trim|required');
		$this->form_validation->set_rules('email', 'メールアドレス', 'trim|required|valid_email|callback_email_check');
		if ($this->form_validation->run() === FALSE)
		{
			$this->load->view('twitter/myform');

		}
		else
		{
			$this->user_model->set_user();
			$newdata = array(
				'username'  => $this->input->post('username'),
				'email'     => $this->input->post('email'),
				'logged_in' => TRUE
			);
			$this->session->set_userdata($newdata);
			$session_id=$this->session->userdata('session_id');
			$this->db->where('session_id',$session_id);
			$query=$this->db->from('Session');
			if($this->db->count_all_results()==0){
				$array = array(
					'session_id' => $session_id 
				);
				$this->db->insert('Session',$array);
			}
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
