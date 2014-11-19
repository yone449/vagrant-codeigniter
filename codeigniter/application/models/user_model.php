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
    $this->db->where('MailAdd',$this->input->post('email'));
    $this->db->where('password',$this->input->post('password'));
    return $this->db->count_all_results('User');
  }

  public function check_session()
  {
    $this->db->where('session_id',$this->session->userdata('session_id'));
    return $this->db->count_all_results('ci_sessions');
  }

  public function set_session($username){
    $newdata = array(
      'username'  => $username,
      'email'     => $this->input->post('email'),
      'login' => 'TRUE'
    );
    $this->session->set_userdata($newdata);
    //		$session_id=$this->session->userdata('session_id');
    //		$sql = "INSERT INTO `Session` (`session_id`)"
    //			." SELECT ? FROM DUAL WHERE 0 ="
    //			." ( SELECT COUNT(*) FROM `Session` WHERE `session_id` = ?)";
    //		$this->db->query($sql,array($session_id,$session_id));

  }

  function convert_to_fuzzy_time($time_db)
  {
    $unix   = strtotime($time_db);
    $now    = time();
    $diff_sec   = $now - $unix;

    if($diff_sec < 60)
    {
      $time   = $diff_sec;
      $unit   = "秒前";

    }
    elseif($diff_sec < 3600)
    {
      $time   = $diff_sec/60;
      $unit   = "分前";

    }
    elseif($diff_sec < 86400)
    {
      $time   = $diff_sec/3600;
      $unit   = "時間前";

    }
    elseif($diff_sec < 2764800)
    {
      $time   = $diff_sec/86400;
      $unit   = "日前";

    }
    else
    {
      if(date("Y") != date("Y", $unix))
      {
        $time   = date("Y年n月j日", $unix);

      }
      else
      {
        $time   = date("n月j日", $unix);

      }

      return $time;

    }

    return (int)$time .$unit;

  }
}
