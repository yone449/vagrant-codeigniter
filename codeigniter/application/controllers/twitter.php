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

//		echo $this->session->userdata('email')."\n";
//		echo $this->session->userdata('session_id');
//			if ($this->user_model->check_session()==0){
//				redirect('twitter/login','refresh');
//			}else{
//			}

		if($this->session->userdata('login')!=='TRUE'){
			redirect('twitter/login','refresh');
		}

		$email=$this->session->userdata('email');
		$data['username']=$this->session->userdata('username');
		
		$data['mailadd']=$email;
		
		$this->load->view('twitter/tweet',$data);
		
	}

	function new_tweet()
	{   
		$sql="SELECT `TweetText`,`Date`,`UserName` FROM `Tweet`"
			." LEFT JOIN `User` ON `Tweet`.`MailAdd`=`User`.`MailAdd`"
			." WHERE `Tweet`.`MailAdd`=?"
			." ORDER BY `Date` DESC LIMIT 10 OFFSET ?";
		$sqlvl=array(
			$this->input->post('mailadd'),
			(int)$this->input->post('num')
		);

		$result=$this->db->query($sql,$sqlvl)->result_array();
		foreach($result as &$row){
			$row['Date']=$this->user_model->convert_to_fuzzy_time($row['Date']);
		}
		$data['tweets']=$result;
		$this->load->view('twitter/hyouji',$data);
	}

	function submit_tweet(){
		if($this->input->post('tweettext')==""){
			return FALSE;
		}
			$sql="SELECT MAX(`TweetID`) AS `TweetID` FROM `Tweet`";
			$row=$this->db->query($sql)->row_array();
			$sqldata = array(
				'TweetID' => $row['TweetID']+1,
				'MailAdd' => $this->input->post('mailadd'),
				'TweetText' => $this->input->post('tweettext'),
				'Date' => date('Y-m-d H:i:s')

			);
			$this->db->insert('Tweet', $sqldata);

			$sql="SELECT `TweetText`,`Date`,`UserName` FROM `Tweet`"
				." LEFT JOIN `User` ON `Tweet`.`MailAdd`=`User`.`MailAdd`"
			." WHERE `Tweet`.`TweetID`='".($row['TweetID']+1)."'";
			$result=$this->db->query($sql)->result_array();
			foreach($result as &$row){
				$row['Date']=$this->user_model->convert_to_fuzzy_time($row['Date']);
			}
			$data['tweets']=$result;
			$this->load->view('twitter/hyouji',$data);
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
				$sql = "SELECT * FROM `User` WHERE `MailAdd` = ?";
				$row = $this->db->query($sql,$this->input->post('email'))->row_array();
				$username=$row['UserName'];
				$this->user_model->set_session($username);

				redirect('twitter','refresh');
			}
			else{
				echo 'パスワードかメールアドレスが間違っています。';
				$this->load->view('twitter/login');

			}

		}
	}

	function logout(){
		$this->load->library('session');
		$this->session->sess_destroy();
		redirect('twitter/login');
	}

	function register()
	{
		$this->load->library('form_validation');
		$this->load->library('session');

		$this->form_validation->set_rules('username', 'ユーザ名', 'trim|required|min_length[4]|max_length[12]|xss_clean');
		$this->form_validation->set_rules('password', 'パスワード', 'trim|required|min_length[6]|matches[passconf]|md5');
		$this->form_validation->set_rules('passconf', 'パスワードの確認', 'trim|required');
		$this->form_validation->set_rules('email', 'メールアドレス', 'trim|required|valid_email|callback_email_check');
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('twitter/myform');

		}
		else
		{
			$this->user_model->set_user();
			$username=$this->input->post('username');
			$this->user_model->set_session($username);

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
