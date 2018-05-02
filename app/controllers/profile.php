<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * Made a mistake once not making this controller earlier
 * thought won't need it. so didn't make /**
 * not its needed
 */

class Profile extends CI_Controller {
  public function __construct() {
    parent::__construct();
    $this->load->model('profile_m');
  }


}
