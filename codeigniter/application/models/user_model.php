<?php
class User_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();

	}

	public function set_user()
	{
		$this->load->helper('url');

		$this->db->select_max('UserID');
		$query = $this->db->get('User');
		$row=$query->row_array(1);
		$data = array(
			'UserID' => $row['UserID']+1,
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
