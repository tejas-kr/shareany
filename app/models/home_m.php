<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Home_m extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

	function get_all_userdata($last_insert_id) {
		return $this->db->select('users.*')->from('users')->where('userID', $last_insert_id)->get()->row();
	}

	function sign_up_new_user($array) {
		$this->db->insert('users', $array);
		$last_insert_id =$this->db->insert_id();

		// echo "last id ---";
		// print_r($last_insert_id);
		// echo "----";

		$q = $this->get_all_userdata($last_insert_id);
		// print_r($q); die();
		return $q;
	}

	function check_if_username_exists($u_name) {
		$message = true;
		$q = $this->db->select('users.username')->from('users')->where('username', $u_name)->get()->row();
		// print_r($q); die();
		if(count($q) >= 1) {
			$message = false; // false == username exists
		}
		return $message;
	}

	function sign_in_user($arr) {
		$data = array();
		$user_authenticated = false;
		$userID = '';
		if(count($this->db->get_where('users', $arr)->row()) == 1) {
			$user_authenticated = true;
			$userID = $this->db->get_where('users', $arr)->row()->userID;
		}
		$data['userID'] = $userID;
		$data['user_authenticated'] = $user_authenticated;
		return $data;
	}

	function user_exists($username) {
		if(isset($this->db->select('users.username')->from('users')->where('username', $username)->get()->row()->username)) {
			$username_found = $this->db->select('users.username')->from('users')->where('username', $username)->get()->row()->username;
		}
		if(isset($username_found)) {return true;}
		else{return false;}
	}

	function get_user_data($username) {
		return $this->db->get_where('users', array('username' => $username))->row();
	}

	function get_follows_data($username) {
		$user_id = $this->db->get_where('users', array('username' => $username))->row()->userID;
		
		return $this->db->get_where('follows', array('user_id' => $user_id, 'active' => 1))->result();
	}

}

/* End of file home_m.php */
/* Location: .//var/www/html/shareany/app/models/home_m.php */