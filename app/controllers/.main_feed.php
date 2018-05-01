<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main_feed extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}

	public function index()
	{
		$this->data['sub_view'] = "main_feed/main_feed";
		$this->load->view('common_view/common_view', $this->data);
	}

}

/* End of file main_feed.php */
/* Location: .//var/www/html/shareany/app/controllers/main_feed.php */