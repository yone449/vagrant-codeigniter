<?php
class User_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();

	}

	public function set_user()
	{
		$this->load->helper('url');


		$data = array(
			'UserID' => $this->db->count_all('User'),
			'UserName' => $this->input->post('username'),
			'password' => $this->input->post('password'),
			'MailAdd' => $this->input->post('email')

		);

		return $this->db->insert('User', $data);

	}

	public function check_user()
	{
		$this->load->helper('url');

		$this->db->where('MailAdd',$this->input->post('email'));
		$this->db->where('password',$this->input->post('password'));
		return $this->db->count_all_results('User');
	}
}
