<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Demo extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
	}

	public function index() {
		echo "<h1>Worked!</h1>";
		echo base_url();
	}

}
