<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Status_update_m extends CI_Model {


	function save_status_update($status_arr) {
		$this->db->insert('posts', $status_arr);
		return true;
	}
	

}

/* End of file status_update_m.php */
/* Location: .//var/www/html/shareany/app/models/status_update_m.php */