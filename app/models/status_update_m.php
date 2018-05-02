<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Status_update_m extends CI_Model {


	function save_status_update($status_arr) {
		$this->db->insert('posts', $status_arr);
		return true;
	}

	function delete_post($post_id) {
		$user_id = $this->session->userdata('userID');

		$this->db->where('post_id', $post_id);
		$this->db->where('user_id', $user_id);
		$this->db->delete('posts');
	}


}

/* End of file status_update_m.php */
/* Location: .//var/www/html/shareany/app/models/status_update_m.php */
